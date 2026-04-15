<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // aktifkan soft delete
    use SoftDeletes;
    protected $fillable = ['uuid', 'name'];

    // casts agar bisa bisa baca function method format waktu
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
