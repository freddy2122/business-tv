<?php

namespace App\Http\Controllers;

use App\Models\SiteVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function someMethod()
    {

        if (Auth::check()) {
            SiteVisit::create([
                'user_id' => Auth::id(),
                'page' => request()->path(),
                'visit_date' => now()->toDateString(),
            ]);
        }
    }
}
