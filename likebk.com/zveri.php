<?php 
define('GAME', 1);

include_once('_incl_data/__config.php');
include_once('_incl_data/class/__db_connect.php');
include_once('_incl_data/class/__user.php');
include('_incl_data/class/__zv.php');

?>
<style type="text/css">
	.tbl_zv{
		width: 100%;
	}
	.tbl_zv thead td{
		text-align: center;
	}
	.tbl_zv tbody td{
		height: 350px;
	    vertical-align: top;
	    width: 16.66666%;
	    font-size: 11px;
		border: 1px solid #000;
	}
	.img_border{
		width: 120px;
		margin: 0 auto;
		height: 220px;
		border: 1px solid #000;
	}
</style>
<?php 
	$zve = mysql_query("SELECT * FROM `users_animal` WHERE `uid` = ".$u->info['id']."");
	while ($i = mysql_fetch_array($zve)) {
		$name = $i['name'];
		$img = '<div class="img_border"><img src ="http://img.likebk.com/i/obraz/0/'.$i['obraz'].'.gif" /></div>';

	}
	$an = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `id` = "'.$u->info['animal'].'" LIMIT 1'));
	$sa = $u->lookStats($an['stats']);
$sa['hpAll'] += 30+$sa['s4']*6;
?>
<table class="tbl_zv">
<thead>
	<tr>
		<td><?php echo $name;?></td>
	</tr>
</thead>
<tbody>
	<tr>
		<td><?php echo $img;?>
			<p>HP: <?=$sa['hpAll']?></p>
          <p>Сила: <?=$sa['s1']?><br>Ловкость: <?=$sa['s2']?><br>Интуиция: <?=$sa['s3']?><br>Выносливость: <?=$sa['s4']?></p>
          <p>Уровень: <?=$an['level']?><br>Опыт: <?=$an['exp']?> / <?=$ne['exp']?><br>
          Сытость: <?=$an['eda']?></p>
          <p>
          Освоенные навыки:<br>
          &bull; <i>Отсутствуют</i></p>
          <p>
          Боевые бонусы:<br>
          <?
		  $ba = '';
			$i = 0;
			while($i<count($u->items['add'])) {
				if(isset($anl['add_'.$u->items['add'][$i]])) {
					$ba .= '&bull; '.$u->is[$u->items['add'][$i]].': +'.$anl['add_'.$u->items['add'][$i]].'<br>';
				}
				$i++;
			}
		  
		  if($ba == '') {
			 $ba = '&bull; <i>Отсутствуют</i>'; 
		  }
		  echo $ba;
		  ?>
          </p>
		</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</tbody>
</table>
