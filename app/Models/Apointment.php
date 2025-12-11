<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apointment extends Model
{
    /** @use HasFactory<\Database\Factories\ApointmentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'status',
        'created_at',
        'updated_at',
        'doctor_id',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
