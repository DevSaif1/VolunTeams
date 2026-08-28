<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'opportunity_id',
        'user_id',
        'reason',
        'manager_notes',
        'status',
        'applied_at',
    ];


    protected $casts = [
    'applied_at' => 'datetime',
];



    /**
     * Opportunity being applied for.
     */
    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }

    /**
     * Volunteer who submitted the application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}