<?php
namespace View;

//include 'cover.php';
?>

<h1>Pizzaliste</h1>
<hr />

<table width="100%">
<th>Name</th>
<th>Bild</th>
<th>Bearbeiten</th>
<th>Menge</th>
<th>Preis</th>
<?php	
	foreach($this->pizzaList as $key => $value)
	{		
		echo '<tr><td>';
		echo $value['name'].'</td><td>';
        $bild = 'uploads/' . $value['id'].'.png';
        $crc = crc32($value['picture']);
        if(!file_exists($bild) || !$crc == crc32($bild))
        file_put_contents($bild, $value['picture']);        
        echo '<img src="'.$bild.'" height="200"></td><td>Bild<br/>';
        echo '<a href="'.URL.'pizza/edit/'.$value['id'].'"><span class="glyphicon glyphicon-pencil">';
        echo '<a style="left:20px;position: relative" class="delete" href="'.URL.'pizza/delete/'.$value['id'].'"><span class="glyphicon glyphicon-trash red"></a>';
        echo '</td><td>';
		echo $value['amount'].'</td><td>';        
        echo $value['price'] . ' &euro;';
		echo '</td></tr>';        
	}	
?>
</table>
<br/><br/>
<a href="#newPizza" id="newPizza">Neue Pizza einfügen</a><br />

<form action="<?=URL?>pizza/create" method="post" enctype="multipart/form-data" id="pizzaForm" style="display: none;">
<label>Name:</label><input name="name" type="text"/><br/>
<label>Bild:</label><br/><input type="file" size="20" accept="image/*" name="image" 
style="position: relative;left :10px;border: 0px solid"/><br/>
<label>Menge:</label><input name="amount" type="text" size="2"/><br/>
<label>Preis:</label><input name="price" type="text" size="2"/> &euro;<br/>
<label></label><input type="submit" value="erstellen"/>
</form>

<script>
$('.delete').click(function() {                    
    return confirm("Pizza wirklich löschen?");
});
</script>