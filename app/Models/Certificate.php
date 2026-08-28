<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'user_id',
        'opportunity_id',
        'issued_by',
        'certificate_code',
        'file_path',
        'verification_url',
        'issued_at',
    ];

    /**
     * Volunteer who owns the certificate.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Opportunity related to this certificate.
     */
    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }

    /**
     * User who issued the certificate.
     */
    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
}