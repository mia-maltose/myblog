<!DOCTYPE html>
<link rel="stylesheet" href="/blog.css">

<h1>New post</h1>

<form method="POST" action="/publish">
    @csrf
    <table class="table1">
        <tr>
            <th>Title</th>
            <th><input name="title" type="text" class="title" value="{{old('title')}}"></th>
        </tr>
        @error('title')
        <tr class="register_error">
            <th class="register_error"></th>
            <td class="register_error">{{$message}}</td>
        </tr>
        @enderror
        <tr>
            <th>Excerpt</th>
            <th><textarea name="excerpt" class="excerpt" type="text"></textarea></th>
        </tr>
        <tr>
            <th>Content</th>
            <th><textarea name="content" class="content" type="text">{{old('content')}}</textarea></th>
        </tr>
        @error('content')
        <tr class="register_error">
            <th class="register_error"></th>
            <td class="register_error">{{$message}}</td>
        </tr>
        @enderror
        <tr>
            <th>Tags #</th>
            <th><input name="tags" class="title" type="text" value="{{old('tags')}}"></th>
        </tr>
        @error('tags')
        <tr class="register_error">
            <th class="register_error"></th>
            <td class="register_error">{{$message}}</td>
        </tr>
        @enderror
    </table>
    <button type="submit">Add</button>
</form>

<p><a href="/"> back</p>

</html>
