<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // aktifkan soft delete, jangn lupa import diatas (eloquent)
    // use SoftDeletes;
    protected $fillable = ['uuid', 'name'];

    // casts agar bisa bisa baca function method format waktu
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
