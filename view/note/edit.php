<?php
namespace View;
?>
<h1>Note: bearbeiten</h1>

<form method="post" action="<?= URL ?>note/editSave/<?= $this->note['noteid'] ?>">
    <label>Titel</label>
    <input style="position:relative;left:0px" type="text"
           name="title" value="<?= $this->note['title'] ?>"/><br/>
    <label>Inhalt</label>
    <textarea style="position:relative;top:5px" name="content" rows="3"
              cols="50"><?= $this->note['content'] ?></textarea>
    <br/>

    <label>&nbsp;</label><input type="submit"/>
</form>
