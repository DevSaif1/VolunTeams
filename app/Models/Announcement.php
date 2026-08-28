<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'title',
        'content',
        'created_by',
        'is_active',
    ];

    /**
     * User who created the announcement.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}