<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /**
     * Display a paginated listing of announcements.
     *
     * Admin, Super Admin, Demo Admin: can view all announcements.
     * Team Manager: can view active announcements.
     * Member: can view active announcements.
     */
   public function index(): View
{
    $user = auth()->user();

    /*
     * Super Admin, Admin, and Demo Admin can view all announcements.
     */
    if ($user->hasAnyRole(['Super Admin', 'Admin', 'Demo Admin'])) {

        $announcements = Announcement::with('creator')
            ->latest()
            ->paginate(10);

    /*
     * Team Manager and Member can view active announcements only.
     */
    } elseif (
        $user->hasRole('Team Manager') ||
        $user->hasRole('Member')
    ) {

        $announcements = Announcement::with('creator')
            ->where('is_active', true)
            ->latest()
            ->paginate(10);

    } else {

        abort(403);
    }

    return view('announcements.index', compact('announcements'));
}


    /**
     * Show the form for creating a new announcement.
     *
     * Super Admin and Admin only.
     */
    public function create(): View
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Super Admin', 'Admin'])) {
            abort(403);
        }

        return view('announcements.create');
    }


    /**
     * Store a newly created announcement.
     *
     * Super Admin and Admin only.
     */
    public function store(
        StoreAnnouncementRequest $request
    ): RedirectResponse {

        $user = auth()->user();

        if (! $user->hasAnyRole(['Super Admin', 'Admin'])) {
            abort(403);
        }

        $validated = $request->validated();

        /*
         * The creator is always the authenticated Admin/Super Admin.
         * It must never come from the form.
         */
        $validated['created_by'] = $user->id;

        $announcement = Announcement::create($validated);

        return redirect()
            ->route('announcements.show', $announcement)
            ->with('success', 'Announcement created successfully.');
    }


    /**
     * Display the specified announcement.
     *
     * Admin, Super Admin, Demo Admin: can view any announcement.
     * Team Manager: can view active announcements.
     * Member: can view active announcements.
     */
    public function show(
    Announcement $announcement
): View {

    $user = auth()->user();

    /*
     * Super Admin, Admin, and Demo Admin can view any announcement.
     */
    if ($user->hasAnyRole(['Super Admin', 'Admin', 'Demo Admin'])) {

        $announcement->load('creator');

        return view(
            'announcements.show',
            compact('announcement')
        );
    }

    /*
     * Team Manager and Member can view active announcements only.
     */
    if (
        (
            $user->hasRole('Team Manager') ||
            $user->hasRole('Member')
        )
        &&
        $announcement->is_active
    ) {

        $announcement->load('creator');

        return view(
            'announcements.show',
            compact('announcement')
        );
    }

    abort(403);
}

    /**
     * Show the form for editing the specified announcement.
     *
     * Super Admin and Admin only.
     */
    public function edit(
        Announcement $announcement
    ): View {

        $user = auth()->user();

        if (! $user->hasAnyRole(['Super Admin', 'Admin'])) {
            abort(403);
        }

        return view(
            'announcements.edit',
            compact('announcement')
        );
    }


    /**
     * Update the specified announcement.
     *
     * Super Admin and Admin only.
     */
    public function update(
        UpdateAnnouncementRequest $request,
        Announcement $announcement
    ): RedirectResponse {

        $user = auth()->user();

        if (! $user->hasAnyRole(['Super Admin', 'Admin'])) {
            abort(403);
        }

        $validated = $request->validated();

        /*
         * created_by is intentionally not updated.
         */
        $announcement->update($validated);

        return redirect()
            ->route('announcements.show', $announcement)
            ->with('success', 'Announcement updated successfully.');
    }


    /**
     * Remove the specified announcement.
     *
     * Super Admin and Admin only.
     */
    public function destroy(
        Announcement $announcement
    ): RedirectResponse {

        $user = auth()->user();

        if (! $user->hasAnyRole(['Super Admin', 'Admin'])) {
            abort(403);
        }

        $announcement->delete();

        return redirect()
            ->route('announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}