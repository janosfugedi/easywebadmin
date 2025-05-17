<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['menu_id', 'node_id', 'label', 'url', 'weight'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function node()
    {
        return $this->belongsTo(Node::class);
    }
}
