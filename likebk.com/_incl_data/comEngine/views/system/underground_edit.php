<?php
if($underground_edit['id'] != ''){
	$Dungeon = unserialize($underground_edit['constructor']);
	$CountX = $CountY = 3;
	if(is_array($Dungeon)){
		ksort($Dungeon);
		foreach($Dungeon as $key=>$val){
			list($ExplodeX, $ExplodeY) = explode("x", $key);
			$CountX = $ExplodeX > $CountX ? $ExplodeX : $CountX;
			$CountY = $ExplodeY > $CountY ? $ExplodeY : $CountY;
		}
	}
}
?><h3><?php echo ($underground_edit['id'] != '' ? 'Изменить подземелье' : 'Добавить подземелье'); ?></h3>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $Configs['cdnserv']; ?>js/tooltip.js"></script>
<style>
.genirator tr td{
	border: none; border-right: 1px solid gray; border-bottom: 1px solid gray; background-color:whitesmoke;
	width: 40px;
	height: 40px;
	text-align: center;
}
.genirator .head{
	border-left: 3px solid gray;
	border-top: 3px solid gray;
}
.genirator .head_X{
	border-left: 3px solid gray;
}
.genirator .head_Y{
	border-top: 3px solid gray;
}
.tooltip{
	border: 1px solid rgba(255,255,255,0.25);
	-webkit-box-shadow: 0 0 3px #555;
	-moz-box-shadow: 0 0 3px #555;
	-webkit-border-radius: 3px;
	text-shadow: 0 0 2px #fff;
	box-shadow: 0 0 3px #555;
	-moz-border-radius: 3px;
	background: #cfcfcf;
	border-radius: 3px;
	position: absolute;
	padding: 4px 8px;
	font-size: 11px;
	display: none;
	z-index: 100;
	color: #000;
}
#DungeonForm{
	background-color: whitesmoke;
	border: 3px groove orange;
	border-radius: 7px;
	position: absolute;
	display: none;
	width: 400px;
	top: 250px;
	left: 50%;
}
</style>
<script>
var viewMap = <?php echo ($Dungeon ? json_encode($Dungeon) : '{}'); ?>;

buildTable = function(){
	var letters = new Array('','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','aa','ab','ac','ad','ae','af','ag','ah','ai','aj','ak','al');
	var returnHTML = '<table border="0" cellpadding="0" cellspacing="0" class="genirator">';
	for(var x = 0; x <= $('#CountX').val(); x++){
		returnHTML += '<tr>';
		for(var y = 0; y <= $('#CountY').val(); y++){
			if( x == 0 && y == 0){
				returnHTML += '<td class="head">#</td>';
			}else if( x > 0 && y == 0 ){
				returnHTML += '<td class="head_X" id="axesX_' + x + '"><b>' + x + '</b></td>';
			}else if( x == 0 && y > 0 ){
				returnHTML += '<td class="head_Y" id="axesY_' + y + '"><b>' + y + '</b></td>';
			}else{
				var style = 'cursor: pointer;';
				var title = 'Хода нет (' + x + ',' + y + ')';
				if(viewMap[x + 'x' + y]){
					// Проверяем основную карту
					style = 'cursor: pointer;border: none; background-color: #EBEBD3;';
					title = '<b>' + ( viewMap[x + 'x' + y] ? (viewMap[x + 'x' + y]['name'] ? viewMap[x + 'x' + y]['name'] : '') : '' ) + '</b> (' + x + ',' + y + ')';
					for(var viewX = (x-1); viewX <= (x+1); viewX++){
						for(var viewY = (y-1); viewY <= (y+1); viewY++){
							// Основная карта
							if( !viewMap[viewX + 'x' + y] && viewY == y && viewX != x ){
								style += 'border-' + ( viewX > x ? 'bottom' : 'top' ) + ': 2px solid #9E965C;';
							}
							if( !viewMap[x + 'x' + viewY] && viewX == x && viewY != y ){
								style += 'border-' + ( viewY > y ? 'right' : 'left' ) + ': 2px solid #9E965C;';
							}
							// Построение проходов
							if( viewMap[viewX + 'x' + y] && viewMap[viewX + 'x' + y]['moves'] && viewY == y && viewX != x ){
								if(viewMap[viewX + 'x' + y]['moves'][x + 'x' + y] == 'false'){
									style += 'border-' + ( viewX > x ? 'bottom' : 'top' ) + ': 2px solid #9E965C;';
								}
							}
							if( viewMap[x + 'x' + viewY] && viewMap[x + 'x' + viewY]['moves'] && viewX == x && viewY != y ){
								if(viewMap[x + 'x' + viewY]['moves'][x + 'x' + y] == 'false'){
									style += 'border-' + ( viewY > y ? 'right' : 'left' ) + ': 2px solid #9E965C;';
								}
							}
						}
					}
				}
				returnHTML += '<td style="' + style + '" onClick="runDragAndDrop(' + x + ',' + y + ');" onmouseover="moveTable(' + x + ', ' + y + ', true, this);" onmouseout="moveTable(' + x + ', ' + y + ', false, this);" title="' + title + '">&nbsp;</td>';
			}
		}
		returnHTML += '</tr>';
	}
	returnHTML += '</table>';
	$('#constructor').html(JSON.stringify(viewMap, null, 2));
	$('#viewTable').html(returnHTML);
	$('img[title], input[title], td[title]').mTip();
}
runDragAndDrop = function(x, y){
	var inputs = [["movesright","false","checked"],["movesleft","false","checked"],["movesdown","false","checked"],["movestop","false","checked"],["pointname","",""]];
	for(var i = 0; i < inputs.length; i++){
		if(inputs[i][2] != ''){
			$('#' + inputs[i][0]).removeAttr(inputs[i][2]);
		}
		$('#' + inputs[i][0]).val(inputs[i][1]);
	}
	$('#posx').val(x);
	$('#posy').val(y);	
	if(viewMap[x + 'x' + y]){
		if(viewMap[x + 'x' + y]['name']){
			$('#pointname').val(viewMap[x + 'x' + y]['name']);
		}
		if(viewMap[x + 'x' + y]['moves']){
			if(viewMap[x + 'x' + y]['moves'][(x - 1) + 'x' + y] == 'true'){
				$('#movestop').attr('checked','checked').val('true');
			}
			if(viewMap[x + 'x' + y]['moves'][x + 'x' + (y - 1)] == 'true'){
				$('#movesleft').attr('checked','checked').val('true');
			}
			if(viewMap[x + 'x' + y]['moves'][x + 'x' + (y + 1)] == 'true'){
				$('#movesright').attr('checked','checked').val('true');
			}
			if(viewMap[x + 'x' + y]['moves'][(x + 1) + 'x' + y] == 'true'){
				$('#movesdown').attr('checked','checked').val('true');
			}
		}
	}

	$('#DungeonForm').toggle(300,function(){
		$(this).draggable({
			appendTo: '#viewTable',
			containment: 'document',
			scroll: false,
			drag: function(event, ui){
				ui.position.left = ui['position']['left'];
				ui.position.top = ui['position']['top'];
			}
		});
	});
}
editPos = function(){
	viewMap[ $('#posx').val() + 'x' + $('#posy').val() ] = {};
	viewMap[ $('#posx').val() + 'x' + $('#posy').val() ]['moves'] = {};
	viewMap[ $('#posx').val() + 'x' + $('#posy').val() ]['name'] = $('#pointname').val();
	viewMap[ $('#posx').val() + 'x' + $('#posy').val() ]['moves'][($('#posx').val()-1) + 'x' + $('#posy').val()] = $('#movestop').attr('checked') ? 'true' : 'false';
	viewMap[ $('#posx').val() + 'x' + $('#posy').val() ]['moves'][$('#posx').val() + 'x' + ($('#posy').val()-1)] = $('#movesleft').attr('checked') ? 'true' : 'false';
	viewMap[ $('#posx').val() + 'x' + $('#posy').val() ]['moves'][$('#posx').val() + 'x' + (parseInt($('#posy').val())+1)] = $('#movesright').attr('checked') ? 'true' : 'false';
	viewMap[ $('#posx').val() + 'x' + $('#posy').val() ]['moves'][(parseInt($('#posx').val())+1) + 'x' + $('#posy').val()] = $('#movesdown').attr('checked') ? 'true' : 'false';

	$('#DungeonForm').toggle(300);
	buildTable();
}
removePos = function(){
	delete viewMap[ $('#posx').val() + 'x' + $('#posy').val() ];
	$('#DungeonForm').toggle(300);
	buildTable();
}
moveTable = function(x, y, show, el){
	$( "#axesX_" + x ).css({
		'border-left':( show ? '3px groove orange' : '3px solid gray' ),
		'background-color':( show ? 'wheat' : 'whitesmoke' )
	});
	$( "#axesY_" + y ).css({
		'border-top':( show ? '3px groove orange' : '3px solid gray' ),
		'background-color':( show ? 'wheat' : 'whitesmoke' )
	});
}
$( document ).ready(function() {
	$('img[title], input[title], td[title]').mTip();
	buildTable();
});
</script>
<div id="DungeonForm">
	<form method="POST" onsubmit="editPos() return false;">
		<div style="background-color: wheat;padding: 5px;cursor: move;">
			Редактировать клетку
			<span style="float:right;cursor:pointer;" onclick="$('#DungeonForm').toggle(300);"><img src="<?php echo $Configs['cdnserv']; ?>i/clear.gif" title="Закрыть" /></span>
		</div>
		<input type="hidden" id="posx" value="" />
		<input type="hidden" id="posy" value="" />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" align="center">
			<tr>
				<td>Название комнаты/клетки: &nbsp; </td>
				<td><input id="pointname" type="text" class="cms_fieldstyle1" value="" /></td>
			</tr>
			<tr>
				<td>Проходимость: &nbsp; </td>
				<td><table border="0" cellpadding="0" cellspacing="1" width="64">
					<tr>
						<td colspan="3" align="center">
						<input id="movestop" value="false" type="checkbox" />
						</td>
					</tr>
					<tr>
						<td align="center">
						<input id="movesleft" value="false" type="checkbox" />
						</td>
						<td>&nbsp;</td>
						<td align="center">
						<input id="movesright" value="false" type="checkbox" />
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
						<input id="movesdown" value="false" type="checkbox" />
						</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="button" class="cms_button1" value="Сохранить" onclick="editPos();"> <input class="cms_button1" type="button" onClick="removePos();" value="Удалить">
				</td>
			</tr>
			
		</table>
	</form>
</div>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>ID подземелья: &nbsp;  </td>
  <td><input name="id" type="text" style="width:100%;" class="cms_fieldstyle1" value="<?php echo $underground_edit['id']; ?>" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Название подземелья: &nbsp;  </td>
  <td><input name="name" type="text" style="width:100%;" class="cms_fieldstyle1" value="<?php echo $underground_edit['name']; ?>" maxlength="255" /></td>
</tr>
<tr>
  <td>Этаж подземелья: &nbsp;  </td>
  <td><input name="subname" type="text" style="width:100%;" class="cms_fieldstyle1" value="<?php echo $underground_edit['subname']; ?>" maxlength="255" /></td>
</tr>
<tr>
  <td>Стиль подземелья: &nbsp;  </td>
  <td><input name="style" type="text" style="width:100%;" class="cms_fieldstyle1" value="<?php echo $underground_edit['style']; ?>" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Размеры подземелья: &nbsp;  </td>
  <td>X: <input id="CountX" onkeyup="buildTable();" type="text" class="cms_fieldstyle1" value="<?php echo $CountX; ?>" size="15" maxlength="255" /><br />Y: <input id="CountY" onkeyup="buildTable();" type="text" class="cms_fieldstyle1" value="<?php echo $CountY; ?>" size="15" maxlength="255" /></td>
</tr>
</table>
<textarea id="constructor" name="constructor" style="display:none;"></textarea>
<div id="viewTable">
</div>
<p></p>
  <input type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input type="submit" onclick="document.location='underground_list.htm'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>