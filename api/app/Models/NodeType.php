<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeType extends Model
{
    protected $primaryKey = 'type';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['type', 'site_id', 'title'];
}
