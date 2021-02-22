<h1>Login</h1>
<form action="login" method="POST" >
    @csrf
    <input type="text" name="account">
    <br>
    <input type="password" name="password">
    <br>
    <button type="submit">Login</button>
</form>