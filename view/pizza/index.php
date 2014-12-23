<?php
namespace View;

?>

<h1>Pizzaliste</h1>
<hr />

<p><a id="newPizzaUp" style="cursor: pointer">Neue Pizza einf&uuml;gen</a></p>
<small style="float: right">Mittels Doppelklick &Auml;nderungen m&ouml;glich</small>
<table data-toggle="table" width="100%" id="mainTable" class="table table-striped table-bordered">
<th>Name</th>
<th>Bild</th>
<th>Menge</th>
<th>Preis</th>
<th></th>
<?php	
	foreach($this->pizzaList as $key => $value)
	{		
		echo '<tr data-uid='.$value['id'].'><td>';
		echo '<span class="dblclick" data-type="name">'.$value['name'].'</span></td><td>';

        $bild = 'uploads/' . $value['id'].'.png';
        $crc = crc32($value['picture']);
        if(!file_exists($bild) || $crc != crc32($bild))
        file_put_contents($bild, $value['picture']);

        echo '<img src="'.$bild.'" height="200" title="'.$value['name'].'" id="pic'.$value['id'].'">';
        echo '<button class="button-file" title="Bild tauschen" style="vertical-align: bottom"';
        echo 'data-target="pic'.$value['id'].'"><span class="glyphicon glyphicon-pencil"></span></button>';
        echo '</td>';
        echo '<td><span class="dblclick" data-type="amount">';
		echo $value['amount'].'</span></td>';
        echo '<td><span class="dblclick" data-type="price">';
        echo $value['price'].'</span>&euro;</td><td>';
        echo '<a class="delete" href="'.URL.'pizza/delete/'.$value['id'].'"><span class="glyphicon glyphicon-trash red"></span></a>';
		echo '</td></tr>';        
	}	
?>
</table>

<input id="file-input" type="file" />

<p>
<a id="newPizza" style="cursor: pointer">Neue Pizza einf&uuml;gen</a><br />
</p>

<form action="<?=URL?>pizza/create" method="post" accept-charset="UTF-8" enctype="multipart/form-data" id="pizzaForm" style="display: none;">
<label>Name:</label><input name="name" type="text"/><br/>
<label>Bild:</label><br/><input type="file" size="20" accept="image/*" name="image" 
style="position: relative;left :10px;border: 0px solid"/><br/>
<label>Menge:</label><input name="amount" type="text" size="2" placeholder="1"/><br/>
<label>Preis:</label><input name="price" type="text" size="4" placeholder="5.95"/> &euro;<br/>
<label></label><input type="submit" value="erstellen"/>
</form>

<div id='goup'></div>