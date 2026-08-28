<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VolunteerHour extends Model
{
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'user_id',
        'opportunity_id',
        'approved_by',
        'hours',
        'date_logged',
        'notes',
    ];

    /**
     * Volunteer who earned the hours.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Opportunity related to these hours.
     */
    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }

    /**
     * User who approved the hours.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}