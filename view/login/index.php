MAIN - Login
<div id="loginBox">
    <form action="login/checkLogin" method="post" id="login" accept-charset="UTF-8">
        <label>Login</label><br>
            <input type="text" name="login" id="formLogin" required data-errormessage-value-missing="Bitte Benutzernamen angeben"/><br>
        <label>Kennwort</label><br>
            <input type="password" name="password" id="formPass" required data-errormessage-value-missing="Bitte Passwortfeld ausfüllen"/><br>

        <br>
        <input type="submit" id="subby"/>
    </form>
</div>