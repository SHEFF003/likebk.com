<?php 
	$timeout = timeout($_SESSION['timestamp'] - time());
	if(!isset($kolodec['id']) || $kolodec['time'] < time()){
		echo '<a href="/main.php?inv=1&kolod=1">Восстановить HP.</a>';
	}else{
		echo '<a style="cursor: pointer;">Восстановление возможно через <span id="timer">'.$timeout.'</span></a>';
	}
?>
