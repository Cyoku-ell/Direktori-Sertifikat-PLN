<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nip',
        'unit_id',
        'certification_id',
        'file',
        'user_id',
        'remarks'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function certification()
    {
        return $this->belongsTo(Certification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}