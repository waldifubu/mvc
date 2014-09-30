<h1>User edit</h1>

<form method="post" action="<?=URL?>user/editSave/<?=$this->user['userid']?>">
	<label>Login</label><input type="text" name="login" value="<?php echo $this->user['login'] ?>"/><br />
	<label>Kennwort</label><input type="password" name="password"/><br />
	<label>Role</label>
		<select name="role">
			<option value="default" <?php if($this->user['role'] == 'default') echo 'selected';?>>Default</option>
			<option value="admin" <?php if($this->user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
			<option value="owner" <?php if($this->user['role'] == 'owner') echo 'selected'; ?>>Owner</option>
		</select>
		<br />	
	<label>&nbsp;</label><input type="submit"/>
</form>
