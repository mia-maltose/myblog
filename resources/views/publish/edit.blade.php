<!DOCTYPE html>
<link rel="stylesheet" href="/blog.css">

<h1>Edit post</h1>

<form method="POST" action="/publish/{{$post->id}}">
    @csrf
    @method('PATCH')
    <table>
        <tr>
            <th>Title</th>
            <th><input name="title" type="text" class="title" value="{{$post->title}}"></th>
        </tr>
        <tr>
            <th>Excerpt</th>
            <th><textarea name="excerpt" class="excerpt" type="text">{{$post->excerpt}}</textarea></th>
        </tr>
        <tr>
            <th>Content</th>
            <th><textarea name="content" class="content" type="text">{{$post->content}}</textarea></th>
        </tr>
        <tr>
            <th>Tags #</th>
            <th><input name="tags" class="title" type="text" value="{{$post->tags}}"></th>
        </tr>
        @error('tags')
        <tr class="register_error">
            <th class="register_error"></th>
            <td class="register_error">{{$message}}</td>
        </tr>
        @enderror
    </table>
    <button type="submit">Update</button>
</form>

<p><a href="/"> Back</p>

</html>
