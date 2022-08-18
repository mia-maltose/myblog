<!DOCTYPE html>
<link rel="stylesheet" href="/blog.css">

<h1>Log in</h1>

<form method="POST" action="/login">
    @csrf
    <table class="table1">
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
    <button type="submit">Log in</button>
</form>
<br>
<div>
    <a href="/google/redirect"><img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"></a>
    <a href="/facebook/redirect"><img src="https://1.bp.blogspot.com/-S8HTBQqmfcs/XN0ACIRD9PI/AAAAAAAAAlo/FLhccuLdMfIFLhocRjWqsr9cVGdTN_8sgCPcBGAYYCw/s1600/f_logo_RGB-Blue_1024.png" class="fb"></a>
</div>

<br><br><p><a href="/"> Back</p>

</html>
