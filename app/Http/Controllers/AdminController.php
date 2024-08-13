<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Str;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function list_user()
    {
        $users = User::all();
        return view('partials.admin.list_users', compact('users'));
    }

    public function profile()
    {

        return view('partials.admin.profile');
    }
    public function list_actuality()
    {
        $news = News::all();
        return view('partials.admin.list_actuality', compact('news'));
    }

    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:admin,user',
        ]);

        $user->rule = $request->input('role');
        $user->save();

        return redirect()->back()->with('success', 'Le rôle de l\'utilisateur a été mis à jour avec succès.');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
    }


    public function create()
    {
        return view('partials.admin.create_actuality');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'videos_url' => 'required|file|mimes:mp4,mov,ogg,qt|max:50000',
        ]);

        $videoUrl = null;

        try {
            if ($request->hasFile('videos_url')) {
                $video = $request->file('videos_url');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = public_path('videos');
                $video->move($videoPath, $videoName);
                $videoUrl = asset('videos/' . $videoName);
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'upload de la vidéo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de l\'upload de la vidéo.');
        }

        $dateTime = now()->format('YmdHis');
        $slug = Str::slug($request->title, '-') . '-' . $dateTime;

        News::create([
            'slug' => $slug,
            'title' => $request->title,
            'content' => $request->content,
            'videos_url' => $videoUrl,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Actualité ajoutée avec succès.');
    }

    public function index()
    {
        $news = News::with('user')->latest()->get();

        return view('news.index', compact('news'));
    }

    public function edit(News $news)
    {
        return view('partials.admin.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'videos_url.*' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $videoUrls = json_decode($news->videos_url);

        try {
            if ($request->hasFile('videos_url')) {
                foreach ($request->file('videos_url') as $video) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $videoPath = public_path('videos');
                    $video->move($videoPath, $videoName);
                    $videoUrls[] = asset('videos/' . $videoName);
                }
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'upload des vidéos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de l\'upload des vidéos.');
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'videos_url' => json_encode($videoUrls),
        ]);

        return redirect()->route('list_actuality')->with('success', 'Actualité modifiée avec succès.');
    }

    public function delete_news(News $news)
    {
        $news->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function show($slug)
    {
        $newsItem = News::where('slug', $slug)->firstOrFail();
        $newsItem->increment('views');
        $news = News::all();
        $viewCount = $newsItem->views;
        $commentCount = $newsItem->comments->count();
        return view('partials.detail_blog', compact('newsItem', 'news', 'commentCount', 'viewCount'));
    }

    public function showComments()
    {
        $comments = Comment::with('user')->paginate('10');
        return view('partials.admin.comment', compact('comments'));
    }
    public function delete_comment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Commentaire supprimé avec succès.');
    }


    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('partials.admin.edit_profile', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $profilePhotoPath;
        }

        $user->save();

        return redirect()->route('profile', $id)->with('success', 'User updated successfully.');
    }
}
