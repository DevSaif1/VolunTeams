<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Opportunity extends Model
{
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'team_id',
        'title',
        'description',
        'image_path',
        'location',
        'type',
        'start_date',
        'end_date',
        'application_deadline',
        'required_volunteers',
        'hours',
        'status',
        'is_active',
    ];

    /**
     * Team that owns this opportunity.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Applications submitted for this opportunity.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Verified volunteer hours for this opportunity.
     */
    public function volunteerHours(): HasMany
    {
        return $this->hasMany(VolunteerHour::class);
    }

    /**
     * Certificates issued for this opportunity.
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }
}