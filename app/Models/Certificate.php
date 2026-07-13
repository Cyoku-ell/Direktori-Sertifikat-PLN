<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',

        'perner',

        'title',

        'certificate_number',

        'registration_number',

        'institution',

        'accreditor',

        'issue_date',

        'start_date',

        'end_date',

        'expired_at',

        'remarks',

        'pdf',

        'created_by',

        'is_matched',

    ];

    protected $casts = [

        'start_date' => 'date',

        'end_date' => 'date',

        'issue_date' => 'date',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
}
