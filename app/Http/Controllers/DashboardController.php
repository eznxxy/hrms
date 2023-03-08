<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Employee;
use App\Models\Profile;
use App\Models\Structural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employees = Employee::select('id', 'status')->get();
        $profile = Profile::first();
        $announcements = Announcement::get();
        $structurals = Structural::orderBy('id', 'desc')->take(3)->get();
        // $PinnedAnnouncement = Announcement::where('is_pinned', true)->first();

        return view('pages.dashboard')->with(compact(['profile', 'employees', 'announcements', 'structurals']));
    }
}
