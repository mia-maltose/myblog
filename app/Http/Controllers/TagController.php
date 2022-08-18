<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagController extends Controller
{

    public function store(Request $request)
    {
        // // dd($request);
        // $request->validate([
        //     'tags'=> ['nullable','max:255',Rule::unique('tags','tag'), 'starts_with:#'],
        // ]);
        // $list=$request->only('tags');
        // // dd($list);
        // if ($list != null) {
        //     $tags = explode( '#', $list['tags']);
        //     unset($tags[0]);
        //     foreach($tags as $tag) {
        //         dd($tag);
        //         Tag::firstOrCreate(
        //             ['tags' => $tag],
        //         );
        //     }
        //     // return redirect('/')->with('success', 'Post added.');
        // }
    }
}
