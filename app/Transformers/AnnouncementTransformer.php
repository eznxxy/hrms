<?php

namespace App\Transformers;

use App\Models\Announcement;
use League\Fractal\TransformerAbstract;

class AnnouncementTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Announcement $announcement)
    {
        return [
            'title' => $announcement->title,
            'announced_at' => $announcement->announced_at->format('d M Y (H:i)'),
            'actions' => view('partials.announcement.table-action', compact('announcement'))->render(),
        ];
    }
}
