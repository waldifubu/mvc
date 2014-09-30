<?php
namespace View;

echo "MAIN - Login";
?>

<form action="login/run" method="post">
	<label>Login</label><input type="text" name="login"/><br />
	<label>Kennwort</label><input type="password" name="password"/><br />
	<br />
	<label></label><input type="submit"/>
</form>