<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'block';
    protected $primaryKey = 'bid';

    protected $fillable = [
        'region',
        'site_id',
        'user_id',
        'status',
        'weight',
        'custom',
        'visibility',
        'content',
        'title',
    ];

    protected $casts = [
        'status' => 'boolean',
        'custom' => 'integer',
        'visibility' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
