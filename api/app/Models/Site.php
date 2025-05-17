<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'sites';

    protected $fillable = [
        'domain',
        'title',
        'user_id',
        'enabled',
        'allow_email',
        'theme_id',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'allow_email' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
