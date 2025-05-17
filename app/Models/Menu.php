<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['site_id', 'name', 'slug'];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
