<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamMember extends Model
{
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'team_id',
        'user_id',
        'status',
        'joined_at',
    ];

    /**
     * Team that the user belongs to.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * User who belongs to the team.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}