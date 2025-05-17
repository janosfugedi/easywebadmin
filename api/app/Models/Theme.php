<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    protected $table = 'themes';

    protected $fillable = [
        'name',
        'description',
        'regions',
        'assets',
        'status',
        'user_id',
        'site_id',
    ];

    protected $casts = [
        'regions' => 'array',
        'assets' => 'array',
    ];
}
