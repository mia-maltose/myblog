<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['tag','slug'];

    public function posts() //what posts belongs to the tag
    {
        return $this->belongsToMany(Posts::class);
    }

    public function filter()
    {
        $posts = Posts::with('tags')->get();
    }

}
