<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Announcement;
use App\Transformers\AnnouncementTransformer;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcement = Announcement::orderByDesc('created_at');

        return DataTables::of($announcement)
            ->setTransformer(new AnnouncementTransformer)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(StoreAnnouncementRequest $request)
    {
        $data = [
            'title' => $request->title ?? 'Announcement',
            'announced_at' => $request->announced_at ?? Carbon::now(),
        ];

        if ($request->type == 'new') {
            $data['description'] = 'First of all, congratulations '.$request->name.' for joining us!<br>We are elated to welcome you to the team and i hope you enjoy your stay here!';
        }

        if ($request->type == 'promoted') {
            $data['description'] = 'Dear '.$request->name.', Congratulations for your promotion as a '.$request->position.'!';
        }

        $announcement = Announcement::create($data);

        return response()->json([
            'message' => __('Success, Your broadcast has been sent!')
        ]);
    }

    public function getAnnouncement(Announcement $announcement)
    {
        return response()->json([
            'message' => __('Success'),
            'data' => [
                'title' => $announcement->title,
                'description' => $announcement->description,
                'announced_at' => Carbon::parse($announcement->announced_at)->format('d M Y (H:i)'),
            ]
        ]);
    }

    public function update(Announcement $announcement, UpdateAnnouncementRequest $request)
    {
        $data = $request->validated();

        $pinnedAnnouncement = Announcement::where('is_pinned', true)->first();

        $message = isset($data['is_pinned']) ? 'Announcement has been posted, and will be pinned':'Announcement has been posted';

        if (isset($data['is_pinned']) && $pinnedAnnouncement != null) {
            $pinnedAnnouncement->update([
                'is_pinned' => false
            ]);
        }

        $data['is_pinned'] = isset($data['is_pinned']) ?? $data['is_pinned'] = false;

        $announcement->update($data);

        return redirect()->back()->with('success', __($message));
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return response()->json([
            'message' => __('Success, ' . $announcement->title . ' has been deleted.')
        ]);
    }
}
