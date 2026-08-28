<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Models\Certificate;
use App\Models\Opportunity;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CertificateController extends Controller
{
    /**
     * Display certificates according to the authenticated user's role.
     */
    public function index(): View
    {
        $user = auth()->user();

        // Admin can view all certificates.
        if ($user->hasRole('Admin')) {
            $certificates = Certificate::with(['user', 'opportunity', 'issuer'])
                ->latest()
                ->paginate(10);

            return view('certificates.index', compact('certificates'));
        }

        // Team Manager can view certificates related to their teams only.
        if ($user->hasRole('Team Manager')) {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');

            $certificates = Certificate::whereHas('opportunity', function ($query) use ($teamIds) {
                    $query->whereIn('team_id', $teamIds);
                })
                ->with(['user', 'opportunity', 'issuer'])
                ->latest()
                ->paginate(10);

            return view('certificates.index', compact('certificates'));
        }

        // Member can view their own certificates only.
        if ($user->hasRole('Member')) {
            $certificates = Certificate::where('user_id', $user->id)
                ->with(['user', 'opportunity', 'issuer'])
                ->latest()
                ->paginate(10);

            return view('certificates.index', compact('certificates'));
        }

        abort(403);
    }

    /**
     * Publicly verify a certificate by its certificate code.
     */
    public function verify(string $certificateCode): View
    {
        $certificate = Certificate::where('certificate_code', $certificateCode)
            ->with(['user', 'opportunity', 'issuer'])
            ->first();

        if (! $certificate) {
            abort(404);
        }

        return view('certificates.verify', compact('certificate'));
    }

    /**
     * Show the form for issuing a new certificate.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function create(): View
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        // Admin can issue certificates for all users/opportunities.
        if ($user->hasRole('Admin')) {
            $users = User::role('Member')
                ->select(['id', 'name', 'email'])
                ->orderBy('name')
                ->get();

            $opportunities = Opportunity::select(['id', 'title'])
                ->where('is_active', true)
                ->orderBy('title')
                ->get();

            $issuers = User::select(['id', 'name', 'email'])
                ->orderBy('name')
                ->get();

            return view('certificates.create', compact(
                'users',
                'opportunities',
                'issuers'
            ));
        }

        // Team Manager can issue certificates only for their own teams.
        $teamIds = Team::where('manager_id', $user->id)->pluck('id');

        $opportunities = Opportunity::whereIn('team_id', $teamIds)
            ->where('is_active', true)
            ->select(['id', 'title'])
            ->orderBy('title')
            ->get();

        $users = User::role('Member')
            ->select(['id', 'name', 'email'])
            ->orderBy('name')
            ->get();

        $issuers = User::where('id', $user->id)
            ->select(['id', 'name', 'email'])
            ->get();

        return view('certificates.create', compact(
            'users',
            'opportunities',
            'issuers'
        ));
    }

    /**
     * Store a newly created certificate.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function store(StoreCertificateRequest $request): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        $validated = $request->validated();

        /*
         * Team Manager can only issue certificates
         * for opportunities belonging to their teams.
         */
        if ($user->hasRole('Team Manager')) {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');

            $opportunityBelongsToManager = Opportunity::whereIn('team_id', $teamIds)
                ->where('id', $validated['opportunity_id'])
                ->exists();

            if (! $opportunityBelongsToManager) {
                abort(403);
            }

            // Manager should be recorded as the issuer.
            $validated['issued_by'] = $user->id;
        }

        // Admin can use the selected issuer.
        $validated['certificate_code'] = 'VT-' . strtoupper(Str::uuid());

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request
                ->file('file')
                ->store('certificates', 'public');
        }

        $certificate = Certificate::create($validated);

        return redirect()
            ->route('certificates.show', $certificate)
            ->with('success', 'Certificate issued successfully.');
    }

    /**
     * Display the specified certificate.
     */
    public function show(Certificate $certificate): View
    {
        $user = auth()->user();

        // Admin can view any certificate.
        if ($user->hasRole('Admin')) {
            $certificate->load(['user', 'opportunity', 'issuer']);

            return view('certificates.show', compact('certificate'));
        }

        // Team Manager can view certificates for their teams only.
        if ($user->hasRole('Team Manager')) {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');

            $allowed = Certificate::where('id', $certificate->id)
                ->whereHas('opportunity', function ($query) use ($teamIds) {
                    $query->whereIn('team_id', $teamIds);
                })
                ->exists();

            if (! $allowed) {
                abort(403);
            }

            $certificate->load(['user', 'opportunity', 'issuer']);

            return view('certificates.show', compact('certificate'));
        }

        // Member can view their own certificate only.
        if ($user->hasRole('Member')) {
            if ($certificate->user_id !== $user->id) {
                abort(403);
            }

            $certificate->load(['user', 'opportunity', 'issuer']);

            return view('certificates.show', compact('certificate'));
        }

        abort(403);
    }

    /**
     * Show the form for editing the specified certificate.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function edit(Certificate $certificate): View
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        if ($user->hasRole('Team Manager')) {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');

            $allowed = Certificate::where('id', $certificate->id)
                ->whereHas('opportunity', function ($query) use ($teamIds) {
                    $query->whereIn('team_id', $teamIds);
                })
                ->exists();

            if (! $allowed) {
                abort(403);
            }
        }

        if ($user->hasRole('Admin')) {
            $users = User::role('Member')
                ->select(['id', 'name', 'email'])
                ->orderBy('name')
                ->get();

            $opportunities = Opportunity::select(['id', 'title'])
                ->orderBy('title')
                ->get();

            $issuers = User::select(['id', 'name', 'email'])
                ->orderBy('name')
                ->get();
        } else {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');

            $opportunities = Opportunity::whereIn('team_id', $teamIds)
                ->select(['id', 'title'])
                ->orderBy('title')
                ->get();

            $users = User::role('Member')
                ->select(['id', 'name', 'email'])
                ->orderBy('name')
                ->get();

            $issuers = User::where('id', $user->id)
                ->select(['id', 'name', 'email'])
                ->get();
        }

        return view('certificates.edit', compact(
            'certificate',
            'users',
            'opportunities',
            'issuers'
        ));
    }

    /**
     * Update the specified certificate.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function update(
        UpdateCertificateRequest $request,
        Certificate $certificate
    ): RedirectResponse {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        if ($user->hasRole('Team Manager')) {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');

            $allowed = Certificate::where('id', $certificate->id)
                ->whereHas('opportunity', function ($query) use ($teamIds) {
                    $query->whereIn('team_id', $teamIds);
                })
                ->exists();

            if (! $allowed) {
                abort(403);
            }
        }

        $validated = $request->validated();

        // Manager remains the issuer of certificates they manage.
        if ($user->hasRole('Team Manager')) {
            $validated['issued_by'] = $user->id;
        }

        if ($request->hasFile('file')) {
            if (
                $certificate->file_path &&
                Storage::disk('public')->exists($certificate->file_path)
            ) {
                Storage::disk('public')->delete($certificate->file_path);
            }

            $validated['file_path'] = $request
                ->file('file')
                ->store('certificates', 'public');
        }

        $certificate->update($validated);

        return redirect()
            ->route('certificates.show', $certificate)
            ->with('success', 'Certificate updated successfully.');
    }

    /**
     * Remove the specified certificate.
     *
     * Only Admin and Team Manager are allowed.
     */
    public function destroy(Certificate $certificate): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->hasAnyRole(['Admin', 'Team Manager'])) {
            abort(403);
        }

        if ($user->hasRole('Team Manager')) {
            $teamIds = Team::where('manager_id', $user->id)->pluck('id');

            $allowed = Certificate::where('id', $certificate->id)
                ->whereHas('opportunity', function ($query) use ($teamIds) {
                    $query->whereIn('team_id', $teamIds);
                })
                ->exists();

            if (! $allowed) {
                abort(403);
            }
        }

        if (
            $certificate->file_path &&
            Storage::disk('public')->exists($certificate->file_path)
        ) {
            Storage::disk('public')->delete($certificate->file_path);
        }

        $certificate->delete();

        return redirect()
            ->route('certificates.index')
            ->with('success', 'Certificate deleted successfully.');
    }
}