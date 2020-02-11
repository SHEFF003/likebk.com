<?php
$Dungeon = array();
if($dungeon_edit['dungeon_id'] != ''){
	$Cords = array(
		'min_x' => $this->db->select_min('x')->where('id_dng', $dungeon_edit['dungeon_id'])->get('dungeon_map')->row_array()['x'],
		'min_y' => $this->db->select_min('y')->where('id_dng', $dungeon_edit['dungeon_id'])->get('dungeon_map')->row_array()['y'],
		'max_x' => $this->db->select_max('x')->where('id_dng', $dungeon_edit['dungeon_id'])->get('dungeon_map')->row_array()['x'],
		'max_y' => $this->db->select_max('y')->where('id_dng', $dungeon_edit['dungeon_id'])->get('dungeon_map')->row_array()['y']
	);
	
	$query = $this->db->query("SELECT * FROM dungeon_map WHERE id_dng = ? AND x >= ? AND x <= ? AND y >= ? AND y <= ?", array(
		$dungeon_edit['dungeon_id'],
		$Cords['min_x'],
		$Cords['max_x'],
		$Cords['min_y'],
		$Cords['max_y']
	));
	foreach ($query->result_array() as $row){
		$Dungeon[$row['x']][$row['y']] = $row;
	}
}
?><h3><?php echo ($dungeon_edit['id'] != '' ? 'Изменить подземелье' : 'Добавить подземелье'); ?></h3>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://static.escilon.ru/js/mousewheel.js"></script>
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
	border-bottom: 3px solid gray;
}
.genirator .head_X{
	border-bottom: 3px solid gray;
}
.genirator .head_Y{
	border-left: 3px solid gray;
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
	z-index: 999;
	width: 400px;
	top: 250px;
}
</style>
<script>
var viewMap = <?php echo ($Dungeon ? json_encode($Dungeon) : '{}'); ?>;
var cdnserv = '<?php echo $Configs['cdnserv']; ?>';
var moves = true;

buildTable = function(){
	var returnHTML = '<table border="0" cellpadding="0" cellspacing="0" id="genirator" class="genirator">';
	for(var y = $('#yMax').val(); y >= ($('#yMin').val()-1); y--){
		returnHTML += '<tr>';
		for(var x = ($('#xMin').val() - 1); x <= $('#xMax').val(); x++){
			if( x == ($('#xMin').val() - 1) && y == ($('#yMin').val() - 1)){
				returnHTML += '<td class="head"><img src="' + cdnserv + 'assets/system/spacer.gif" width="40" height="40" /></td>';
			}else if( x == ($('#xMin').val() - 1) && y > ($('#yMin').val() - 1) ){
				returnHTML += '<td class="head_Y" id="axesY_' + y + '"><b>' + y + '</b></td>';
			}else if( x > ($('#xMin').val() - 1) && y == ($('#yMin').val() - 1) ){
				returnHTML += '<td class="head_X" id="axesX_' + x + '"><b>' + x + '</b></td>';
			}else{
				var style = 'border-width: 1px;border-color: rgb(222, 222, 222);background-color: rgb(255, 255, 255);';
				var title = 'Хода нет (' + x + ',' + y + ')';
				if(viewMap[x]){
					if(viewMap[x][y]){
						// Проверяем основную карту
						style = 'border: none; background-color: #EBEBD3;';
						title = '<b>' + ( viewMap[x][y]['name'] ? viewMap[x][y]['name'] : '') + '</b> (' + x + ',' + y + ')';
						if(viewMap[x][y]['st']){
							style += ( viewMap[x][y]['st'][0] == '1' ? 'border-top:2px solid #9E965C;' : 'padding-top:1px;' );
							style += ( viewMap[x][y]['st'][1] == '1' ? 'border-left:2px solid #9E965C;' : 'padding-left:1px;' );
							style += ( viewMap[x][y]['st'][2] == '1' ? 'border-bottom:2px solid #9E965C;' : 'padding-bottom:1px;' );
							style += ( viewMap[x][y]['st'][3] == '1' ? 'border-right:2px solid #9E965C;' : 'padding-right:1px;' );
						}
					}
				}
				returnHTML += '<td style="' + style + '" onContextMenu="runDragAndDrop(' + x + ', ' + y + ');return false;" onmouseover="moveTable(' + x + ', ' + y + ', true, this);" onmouseout="moveTable(' + x + ', ' + y + ', false, this);" title="' + title + '"><img src="' + cdnserv + 'assets/system/spacer.gif" width="40" height="40" /></td>';
			}
		}
		returnHTML += '</tr>';
	}
	returnHTML += '</table>';
	$('#constructor').html(JSON.stringify(viewMap, null, 2));
	$('#viewTable').css({
		'width': $('#cms_content').width() + 'px',
	});
	$('#viewTable').html(returnHTML);
	$('img[title], input[title], td[title]').mTip();
}

runDragAndDrop = function(x, y){
	var inputs = [["movesright","false","checked"],["movescenter","false","checked"],["movesleft","false","checked"],["movesdown","false","checked"],["movestop","false","checked"],["botsright","false","checked"],["botsleft","false","checked"],["botsdown","false","checked"],["botstop","false","checked"],["pointname","",""]];
	for(var i = 0; i < inputs.length; i++){
		if(inputs[i][2] != ''){
			$('#' + inputs[i][0]).removeAttr(inputs[i][2]);
		}
		$('#' + inputs[i][0]).val(inputs[i][1]);
	}
	$('#posx').val(x);
	$('#posy').val(y);	
	if(viewMap[x]){
		if(viewMap[x][y]){
			if(viewMap[x][y]['go_1'] == '1'){
				$('#movesright').attr('checked','checked').val('true');
			}
			if(viewMap[x][y]['go_2'] == '1'){
				$('#movesleft').attr('checked','checked').val('true');
			}
			if(viewMap[x][y]['go_3'] == '1'){
				$('#movestop').attr('checked','checked').val('true');
			}
			if(viewMap[x][y]['go_4'] == '1'){
				$('#movesdown').attr('checked','checked').val('true');
			}
			if(viewMap[x][y]['go_5'] == '1'){
				$('#movescenter').attr('checked','checked').val('true');
			}
			if(viewMap[x][y]['no_bot'][0] == '1'){
				$('#botstop').attr('checked','checked').val('true');
			}
			if(viewMap[x][y]['no_bot'][1] == '1'){
				$('#botsleft').attr('checked','checked').val('true');
			}
			if(viewMap[x][y]['no_bot'][2] == '1'){
				$('#botsdown').attr('checked','checked').val('true');
			}
			if(viewMap[x][y]['no_bot'][3] == '1'){
				$('#botsright').attr('checked','checked').val('true');
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
	var tmpJSON = {
		'id_dng' : $('#dungeon_id').val(),
		'x' : $('#posx').val(),
		'y' : $('#posy').val()
	};
	// Создаем массивы
	if( !viewMap[$('#posx').val()] ){
		viewMap[$('#posx').val()] = {};
	}
	if( !viewMap[$('#posx').val()][$('#posy').val()] ){
		viewMap[$('#posx').val()][$('#posy').val()] = {};
	}
	// Наделяем их данными
	viewMap[($('#posx').val())][($('#posy').val())]['no_bot'] = tmpJSON['no_bot'] = ($('#botstop').attr('checked') ? '1' : '0') + ($('#botsleft').attr('checked') ? '1' : '0') + ($('#botsdown').attr('checked') ? '1' : '0') + ($('#botsright').attr('checked') ? '1' : '0');
	viewMap[($('#posx').val())][($('#posy').val())]['st'] = tmpJSON['st'] = ($('#movestop').attr('checked') ? '0' : '1') + ($('#movesleft').attr('checked') ? '0' : '1') + ($('#movesdown').attr('checked') ? '0' : '1') + ($('#movesright').attr('checked') ? '0' : '1');
	viewMap[($('#posx').val())][($('#posy').val())]['name'] = tmpJSON['name'] = $('#pointname').val();
	// Показываем прохадимость
	viewMap[($('#posx').val())][($('#posy').val())]['go_1'] = tmpJSON['go_1'] = ($('#movesright').attr('checked') ? '1' : '0');
	viewMap[($('#posx').val())][($('#posy').val())]['go_2'] = tmpJSON['go_2'] = ($('#movesleft').attr('checked') ? '1' : '0');
	viewMap[($('#posx').val())][($('#posy').val())]['go_3'] = tmpJSON['go_3'] = ($('#movestop').attr('checked') ? '1' : '0');
	viewMap[($('#posx').val())][($('#posy').val())]['go_4'] = tmpJSON['go_4'] = ($('#movesdown').attr('checked') ? '1' : '0');
	viewMap[($('#posx').val())][($('#posy').val())]['go_5'] = tmpJSON['go_5'] = ($('#movescenter').attr('checked') ? '1' : '0');

	console.log(tmpJSON);
	$.ajax({
		url: "dungeon_edit_ajax.htm",
		cache: false,
		type: "POST",
		data: { 
			"json" : JSON.stringify(tmpJSON)
		},
		dataType: "json",
		success: function(response){
			if( response['status'] == 'success' ){
				$('#DungeonForm').toggle(300);
			}else if( response['status'] == 'error' ){
				alert(response['description']);
				window.location = window.location;
			}
		}
	});
	
	buildTable();
}

removePos = function(){
	delete viewMap[ $('#posx').val() + 'x' + $('#posy').val() ];
	$('#DungeonForm').toggle(300);
	buildTable();
}

moveTable = function(x, y, show, el){
	$( "#axesX_" + x ).css({
		'border-bottom':( show ? '3px groove orange' : '3px solid gray' ),
		'background-color':( show ? 'wheat' : 'whitesmoke' )
	});
	$( "#axesY_" + y ).css({
		'border-left':( show ? '3px groove orange' : '3px solid gray' ),
		'background-color':( show ? 'wheat' : 'whitesmoke' )
	});
}

$( document ).ready(function() {
	var last_click_x = last_click_y = 0;
	var moving = false;
	$("#viewTable").mousedown(function(e){
		if (e.which != 1) return;
		if (moves == false) return;
		$("#viewIMG").show();
		moving = true;
		last_click_x = e.pageX;
		last_click_y = e.pageY;
		return false;
	});
	$("#viewTable").mouseup(function(e){
		if (e.which!=1) return;
		if (moves == false) return;
		moving = false;
		return false;
    });
	$("#viewTable").mouseleave(function() {
		moving = false;
		return false;
    });
	$("#viewTable").mousemove(function(e){
		if (moving!=1) return;
		if (moves == false) return;
        $('#viewTable').scrollTop($('#viewTable').scrollTop()+last_click_y-e.pageY);
        $('#viewTable').scrollLeft($('#viewTable').scrollLeft()+last_click_x-e.pageX);
        last_click_x = e.pageX;
        last_click_y = e.pageY;
    });	
	$('img[title], input[title], td[title]').mTip();
	$('#DungeonForm').css('left', ($(window).width()/2-200) + 'px');
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
				<td width="50%">Название комнаты/клетки: &nbsp; </td>
				<td width="50%"><input id="pointname" type="text" class="cms_fieldstyle1" value="" /></td>
			</tr>
			<tr>
				<td align="center">Возможные движения:<br /><table border="0" cellpadding="0" cellspacing="0" width="60">
					<tr>
						<td colspan="3" align="center" width="60" height="20">
							<input id="movestop" value="false" type="checkbox" />
						</td>
					</tr>
					<tr>
						<td align="center" width="20" height="20">
							<input id="movesleft" value="false" type="checkbox" />
						</td>
						<td align="center" width="20" height="20">
							<input id="movescenter" value="false" type="checkbox" />
						</td>
						<td align="center" width="20" height="20">
							<input id="movesright" value="false" type="checkbox" />
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center" width="60" height="20">
							<input id="movesdown" value="false" type="checkbox" />
						</td>
					</tr>
				</table></td>
				<td align="center">Запрет для ботов:<br /><table border="0" cellpadding="0" cellspacing="0" width="60">
					<tr>
						<td colspan="3" align="center" width="60" height="20">
							<input id="botstop" value="false" type="checkbox" />
						</td>
					</tr>
					<tr>
						<td align="center" width="20" height="20">
							<input id="botsleft" value="false" type="checkbox" />
						</td>
						<td align="center" width="20" height="20">
							&nbsp;
						</td>
						<td align="center" width="20" height="20">
							<input id="botsright" value="false" type="checkbox" />
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center" width="60" height="20">
							<input id="botsdown" value="false" type="checkbox" />
						</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td width="50%" align="center"><a href="javascript:void(0);" onClick="">редактор монстров</a></td>
				<td width="50%" align="center"><a href="javascript:void(0);" onClick="">редактор объектов</a></td>
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
  <td><input name="dungeon_id" id="dungeon_id" type="text" style="width:100%;" class="cms_fieldstyle1" value="<?php echo $dungeon_edit['dungeon_id']; ?>" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Название подземелья: &nbsp;  </td>
  <td><input name="dungeon_name" type="text" style="width:100%;" class="cms_fieldstyle1" value="<?php echo $dungeon_edit['dungeon_name']; ?>" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Город подземелья: &nbsp;  </td>
  <td><input name="city" type="text" style="width:100%;" class="cms_fieldstyle1" value="<?php echo $dungeon_edit['city']; ?>" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Тэг подземелья: &nbsp;  </td>
  <td><input name="dungeon_tag" type="text" style="width:100%;" class="cms_fieldstyle1" value="<?php echo $dungeon_edit['dungeon_tag']; ?>" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Размеры подземелья: &nbsp;  </td>
  <td>
	X (Min/Max): <input id="xMin" onkeyup="buildTable();" type="text" class="cms_fieldstyle1" value="<?php echo isset($Cords['min_x']) ? $Cords['min_x'] : 0 ; ?>" size="5" maxlength="255" /> <input id="xMax" onkeyup="buildTable();" type="text" class="cms_fieldstyle1" value="<?php echo isset($Cords['max_x']) ? $Cords['max_x'] : 10 ; ?>" size="5" maxlength="255" /><br />
	Y (Min/Max): <input id="yMin" onkeyup="buildTable();" type="text" class="cms_fieldstyle1" value="<?php echo isset($Cords['min_y']) ? $Cords['min_y'] : 0 ; ?>" size="5" maxlength="255" /> <input id="yMax" onkeyup="buildTable();" type="text" class="cms_fieldstyle1" value="<?php echo isset($Cords['max_y']) ? $Cords['max_y'] : 10 ; ?>" size="5" maxlength="255" />
  </td>
</tr>
</table>
<textarea id="constructor" name="constructor"></textarea>
<div id="viewTable" style="height:500px;overflow:auto;position:relative;">
</div>
<p></p>
  <input type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input type="submit" onclick="document.location='dungeon_list.htm'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>