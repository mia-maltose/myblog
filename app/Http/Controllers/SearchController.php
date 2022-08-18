<?php
// The search function (unfinished)
// Need to create a search page for tags and text
// More future search functions: search by date

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SearchController extends Controller
{
    public function viewtag(Posts $post){
        $tags = $post->tags()->get();
        return view("publish.post",[
                    'post' => $post,
                    'tags'=>$tags
                ]);
    }

    public function filter(Tag $tag){
        $posts = $tag->posts()->get();
        return view("publish.tag",[
            'posts' => $posts,
            'tags'=>Tag::all(),
            'tag' => $tag->tag,
        ]);
    }

    public function create(){
        return view('publish.create');
    }

    public function store(Request $request)
    {
        $request->request->add(["slug"=>Str::slug($request->title)]); //slug for navigating through posts
        $request->validate([
            'title' => ['required','max:20','min:1'],
            'slug' => ['required', Rule::unique('posts','slug')],
            'excerpt' => ['nullable','max:255'],
            'content'=> ['required','max:1000','min:1'],
            'tags'=> ['nullable','max:255','starts_with:#','regex:/^\S*$/u',],
        ]);
        $post = Posts::create($request->only('title', 'slug','excerpt', 'content','tags'));

        $list=$request->only('tags');

        if ($list != null) {
            $tags = explode( '#', $list['tags']);
            $models = collect();
            unset($tags[0]);
            foreach($tags as $tag) {
                $slug = Str::slug($tag);
                $models[] = Tag::firstOrCreate(
                    ['tag' => $tag],
                    ['slug'=>$slug],
                );
            }

            $post->tags()->sync($models->pluck('id')->toArray()); //database relationship
        }

        return redirect('/')->with('success', 'Post added.');
    }

    // Call variable passed to this function an instance of the Posts class as $post
    public function edit(Posts $post)
    {
        return view('publish.edit', ['post'=>$post]);
    }

    public function update(Posts $post)
    {
        $request=request();
        $request->request->add(["slug"=>Str::slug($request->title)]);
        $request->validate([
            'title' => ['required','max:20','min:1', Rule::unique('posts','title')->ignore($post->id)],
            'slug' => ['required', Rule::unique('posts','slug')->ignore($post->id)],
            'excerpt' => ['nullable','max:255'],
            'content'=> ['required','max:1000','min:1'],
            'tags'=> ['nullable','max:255','starts_with:#','regex:/^\S*$/u',],
        ]);

        $post->update($request->only('title', 'slug','excerpt', 'content','updated_at','tags'));

        $list=$request->only('tags');

        if ($list != null) {
            $tags = explode( '#', $list['tags']);
            $models = collect();
            unset($tags[0]);
            foreach($tags as $tag) {
                $slug = Str::slug($tag);
                $models[] = Tag::firstOrCreate(
                    ['tag' => $tag],
                    ['slug'=>$slug],
                );
            }

            $post->tags()->sync($models->pluck('id')->toArray()); //database relationship
        }

        return redirect('/');
    }

    public function destroy(Posts $post){
        $post->delete();
        return redirect('/');
    }
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
