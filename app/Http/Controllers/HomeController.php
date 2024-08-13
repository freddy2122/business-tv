<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\SiteVisit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users_count = User::count();
        $comment_count = Comment::count();
        $news_count = News::count();
       /*  $trafficData = $this->getTrafficData(); */
        return view('home',compact('users_count','comment_count','news_count'));
    }
    private function getTrafficData()
{
    // Définir la période pour les données
    $startDate = Carbon::now()->startOfYear();
    $endDate = Carbon::now()->endOfMonth();

    // Obtenir les visites par mois
    $visits = SiteVisit::whereBetween('visit_date', [$startDate, $endDate])
        ->selectRaw('MONTH(visit_date) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

    // Préparer les labels (mois) et les données (nombre de visites)
    $months = [];
    $data = [];

    for ($i = 1; $i <= 12; $i++) {
        $months[] = Carbon::create()->month($i)->format('M');
        $data[] = $visits->get($i, 0);
    }

    return [
        'labels' => $months,
        'data' => $data
    ];
}
}
