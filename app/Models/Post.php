<?php

// namespace App\Models;

// class Post
// {
//     public static function all(){
//         return File::files(resource_path("posts/{$slug}.html"));
//     }

//     public static function find($slug){
//         base_path();
//         if (!file_exists($path = resource_path("posts/{$slug}.html"))){
//             throw new ModelNotFoundException();
//         }
//         return cache()->remember("posts.{$slug}",1200,fn() => file_get_contents($path));
//     }
// }
