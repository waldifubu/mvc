<?php
namespace View;
?>
<h1>Note: bearbeiten</h1>

<form method="post" action="<?php echo URL;?>note/editSave/<?php echo $this->note['noteid']; ?>">
	<label>Titel</label><input style="position:relative;left:0px" type="text"
    name="title" value="<?php echo $this->note['title']; ?>"/><br />
	<label>Inhalt</label>
    <textarea style="position:relative;left:8px" name="content" rows="3" 
    cols="50"><?php echo $this->note['content']; ?></textarea>
    <br />
    
	<label>&nbsp;</label><input type="submit"/>
</form>
