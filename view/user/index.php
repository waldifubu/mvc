<h1>Users</h1>

<form method="post" action="<?=URL?>user/create">
	<label>Login</label><input type="text" name="login"/><br />
	<label>Kennwort</label><input type="password" name="password"/><br />
	<label>Role</label>
		<select name="role">
			<option value="default">Default</option>
			<option value="admin">Admin</option>
			<option value="owner">Owner</option>
		</select>
		<br />	
	<label>&nbsp;</label><input type="submit"/>
</form>

<hr />

<table width="80%">
<?php
	
	foreach($this->userList as $key => $value)
	{		
		echo '<tr><td>'.$value['userid'].'</td><td>';
		echo $value['login'].'</td><td>';
		echo $value['role'].'</td><td>';
		echo '<a href="'.URL.'user/edit/'.$value['userid'].'">EDIT</a> ';
		echo ' <a href="'.URL.'user/delete/'.$value['userid'].'">DEL</a>';
		echo '</td></tr>';
	}
	
?>
</table>