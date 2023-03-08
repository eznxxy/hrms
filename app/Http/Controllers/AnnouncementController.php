<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcement = Announcement::where('is_pinned', true)->first();

        return view('pages.announcement.index')->with(compact('announcement'));
    }

    public function create()
    {
        return view('pages.announcement.create');
    }

    public function store(StoreAnnouncementRequest $request)
    {
        $data = $request->validated();
        $data['announced_at'] = Carbon::now();

        $pinnedAnnouncement = Announcement::where('is_pinned', true)->first();

        $message = isset($data['is_pinned']) ? 'Announcement has been posted, and will be pinned':'Announcement has been posted';

        if (isset($data['is_pinned']) && $pinnedAnnouncement != null) {
            $pinnedAnnouncement->update([
                'is_pinned' => false
            ]);
        }

        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', __($message));
    }

    public function edit(Announcement $announcement)
    {
        return view('pages.announcement.edit')->with(compact('announcement'));
    }
}
