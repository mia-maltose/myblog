<!DOCTYPE html>
<link rel="stylesheet" href="/blog.css">


<h1>Register</h1>

<form method="POST" action="/register">
    @csrf
    <table class="table1">
        <tr>
            <th>Username</th>
            <td><input name="username" type="text" class="register" value="{{old('username')}}"></td>
        </tr>
        @error('username')
        <tr class="register_error">
            <th class="register_error"></th>
            <td class="register_error">{{$message}}</td>
        </tr>
        @enderror
        <tr>
            <th>Email</th>
            <td><input name="email" class="register" type="text" value="{{old('email')}}">
            </td>
        </tr>
        @error('email')
        <tr class="register_error">
            <th class="register_error"></th>
            <td class="register_error">{{$message}}</td>
        </tr>
        @enderror
        <tr>
            <th>Password</th>
            <td><input name="password" class="register" type="password"></td>
        </tr>
        @error('password')
        <tr class="register_error">
            <th class="register_error"></th>
            <td class="register_error">{{$message}}</td>
        </tr>
        @enderror
    </table>
    <button type="submit">Register</button>
</form>

<p><a href="/"> Back</p>

</html>
