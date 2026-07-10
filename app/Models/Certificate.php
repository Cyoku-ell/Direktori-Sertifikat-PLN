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

        'title',

        'start_date',

        'end_date',

        'issue_date',

        'certificate_number',

        'registration_number',

        'institution',

        'accreditor',

        'pdf',

        'remarks',

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
}
