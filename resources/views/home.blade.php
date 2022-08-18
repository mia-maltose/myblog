<!DOCTYPE html>

<title> Mia's blog </title>
<link rel="stylesheet" href="/blog.css">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


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

<h1>Mia's Blog</h1>

@admin
<form action="/publish">
    <button type="submit">Add new post</button>
</form>
@endadmin
</div>
<div x-data="{ open: false }" x-on:click.outside="open = false">
    <button x-on:click="open = !open" class="tag_btn">
        Search by
        <span :class="{'rotated': open}">&raquo;</span>
      </button>
      <ul x-show="open" x-transition.opacity class="tag_menu">
        @foreach($tags as $tag)
        <li class="tag_options"><a href="/tag/{{$tag->slug}}" class="tag_link">{{$tag->tag}}</a></li>
        @endforeach
      </ul>
      <input type='text' class='search'>
</div>



@foreach ($posts as $post)

<h2><a href="/home/{{$post->slug}}">{{$post->title}}</a></h2>
@admin
    <table class="table2">
        <tr>
            <td><a class="manage" href="/publish/{{$post->id}}/edit">Edit</a></td>
            <td><form method="POST" action="/publish/{{$post->id}}">
                @csrf
                @method('DELETE')
                <button class="manage delete">Delete</button>
            </form></td>
        </table>
@endadmin
<p class="posts">{{$post->excerpt}}</p>

@endforeach

@if (session()-> has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="success">
        <p><b>{{session('success')}}</b></p>
    </div>
@endif

<body>
</body>
</html>
