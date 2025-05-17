<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NodeRevision extends Model
{
    protected $table = 'node_revisions';
    protected $primaryKey = 'vid';
    public $timestamps = false;

    protected $fillable = [
        'nid',
        'user_id',
        'title',
        'body',
        'log',
        'published',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'published' => 'boolean',
    ];

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'nid');
    }
}
