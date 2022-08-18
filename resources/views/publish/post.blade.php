<!DOCTYPE html>

<link rel="stylesheet" href="/blog.css">

<div class="navbar">
    @guest
    <form action="/login">
        <button type="submit" class="login">Log in</button>
    </form>
    <form action="/register">
        <button type="submit" class="login">Register</button>
    </form>
    @else
    <form method="POST" action="/logout">
        @csrf
        <button type="submit" class="login"><b>{{auth()->user()->username}}</b> | log out</button>
    </form>
    @endguest
    <h1>{{$post->title}}</h1>
</div>
<p>{{$post->content}}</p>

<p>
    @foreach($tags as $tag)
    <span><a href="/tag/{{$tag->slug}}" style="color:dodgerblue">#{{$tag->tag}}</a></span>
    @endforeach
</p>

<div class="time">
<span>Published at: {{$post->created_at}}</span> <br><br><br>
<span>Last updated at: {{$post->updated_at}}</span>
</div>

@admin
    <table class="table3">
        <tr>
            <td><a class="manage" href="/publish/{{$post->id}}/edit">Edit</a></td>
            <td><form method="POST" action="/publish/{{$post->id}}">
                @csrf
                @method('DELETE')
                <button class="manage delete">Delete</button>
            </form></td>
        </table>
@endadmin

<p><a href="/" class="manage"> Back</p>

</html>
