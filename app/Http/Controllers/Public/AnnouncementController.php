<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::published()->latest('tgl_publish')->paginate(9);
        return view('public.announcement.index', compact('announcements'));
    }

    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)->firstOrFail();
        $recent = Announcement::published()
                    ->where('id', '!=', $announcement->id)
                    ->latest('tgl_publish')
                    ->take(3)->get();

        return view('public.announcement.show', compact('announcement', 'recent'));
    }
}
