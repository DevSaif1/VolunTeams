<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'manager_id',
        'name',
        'description',
        'logo_path',
        'email',
        'phone',
        'address',
        'is_active',
    ];

    /**
     * Team manager.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Opportunities created by this team.
     */
    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class);
    }

    /**
     * Members belonging to this team.
     */
    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }
}