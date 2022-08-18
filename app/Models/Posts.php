<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $fillable=['title','excerpt','content','slug','tags'];

    public function tags() //what tags are applied
    {
        return $this->belongsToMany(Tag::class);
    }

}

