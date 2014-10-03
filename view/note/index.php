<?php
namespace View;
use DateTime;
?>

<h1>Note</h1>

<form method="post" action="<?=URL?>note/create">
	<label>Titel</label><input style="position:relative;left:0px" type="text" placeholder="Titel" name="title"/><br />
	<label>Inhalt</label>
    <textarea style="position:relative;top: 4px;left:10px" name="content" rows="3" cols="50" placeholder="Text"></textarea>
    <br />
    
	<label></label><input type="submit"/>
</form>

<hr />

<table width="80%">
<?php	
	foreach($this->noteList as $key => $value)
	{		
		echo '<tr><td>';
		echo $value['title'].'</td><td>';
		echo $value['content'].'</td><td>';        
        echo (new DateTime($value['date_added']))->format('d.m.Y - H:i:s \U\h\r');                        
        echo '</td><td style="width:30px">';
		echo '<a href="'.URL.'note/edit/'.$value['noteid'].'"><span class="glyphicon glyphicon-pencil"></a></td><td>';
		echo '<a class="delete" href="'.URL.'note/delete/'.$value['noteid'].'"><span class="glyphicon glyphicon-trash red"></a>';
		echo '</td></tr>';
	}	
?>
</table>

<br/>
<button class="btn btn-primary" type="button">
      Eintr&auml;ge  <span class="badge"><?=count($this->noteList)?></span>
</button>

<script>
$(function() {    
    $('.delete').click(function(e) {                
        var c = confirm("Are you sure you want to delete?");
        if(c == false) return false;
    })
});    
</script>