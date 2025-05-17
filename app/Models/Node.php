<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Node extends Model
{
    use HasFactory;
    protected $table = 'node';
    protected $primaryKey = 'nid';

    protected $fillable = [
        'type',
        'site_id',
        'user_id',
        'published',
        'vid',
    ];

    public function revisions(): HasMany
    {
        return $this->hasMany(NodeRevision::class, 'nid');
    }

    public function latestRevision()
    {
        return $this->hasOne(NodeRevision::class, 'nid', 'nid')->latest('vid');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
