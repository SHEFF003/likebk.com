<?php
$row_id = 0;
$locations = '';
if($locations_edit['id'] != ''){
	$locations_list = unserialize($locations_edit['locations']);
	if(is_array($locations_list)){
		foreach($locations_list as $items){
			$locations .= '<tr id="tr_locations_'.($row_id).'"><td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_locations_'.$row_id.'\'); return false;" title="Remove"><img src="' . $Configs['cdnserv'] . 'assets/system/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>';
			foreach($items as $key=>$val){
				$locations .= '<td align="left" class="cms_middle"><input type="text" id="locations_' . $row_id  . '_' . $key . '_input" onkeyup="visualUpdate();"; name="locations[' . $row_id  . '][' . $key . ']" value="' . $val . '" size="13" /></td>';
			}
			$locations .= '</tr>';
			$row_id++;
		}
	}
}
?><h3><?php echo ($locations_edit['id'] != '' ? 'Изменить локацию' : 'Добавить локацию'); ?></h3>
<a href="javascript:void(0);" onclick="visualEditor();" id="visualButton">Показать графический редактор</a>
<div id="visualEditor" style="float:right;"></div>
<br />
<br />
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript">
var Configs = {
	cdn: '<?php echo $Configs['cdnserv']; ?>'
};
var last_id = <?php echo $row_id; ?>;
var viewEditor = false;
addItem_buildings = function(tableId, trPrefix, inputFilds){
    var table = el(tableId);
    var tr = d.createElement('TR');
    var new_id = trPrefix+last_id;
    tr.id = new_id;
    table.lastChild.appendChild(tr);
    var td1 = d.createElement('TD');
    var td2 = d.createElement('TD');
	var td3 = d.createElement('TD');
    var td4 = d.createElement('TD');
	var td5 = d.createElement('TD');
    var td6 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td2);
	tr.appendChild(td3);
    tr.appendChild(td4);
	tr.appendChild(td5);
    tr.appendChild(td6);
	
	// delete image
    var del_img = d.createElement('IMG');
    del_img.src = '<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_delete.gif';
    del_img.width = '16';
    del_img.height = '16';
    var del_a = d.createElement('A');
    del_a.href = '#';
    del_a.onclick = function() { removeItem(new_id); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
	
	td2.className = 'cms_fieldstyle1';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'locations[' + last_id + '][title]';
    ed.size = '13';
    td2.appendChild(ed);
	
	td3.className = 'cms_fieldstyle1';
    ed = d.createElement('INPUT');
    ed.name = 'locations[' + last_id + '][background_img]';
	ed.id = 'locations_' + last_id + '_background_img_input';
	ed.onkeyup = 'visualUpdate();';
    ed.type = 'text';
    ed.size = '13';
    td3.appendChild(ed);
	
	td4.className = 'cms_fieldstyle1';
    ed = d.createElement('INPUT');
    ed.name = 'locations[' + last_id + '][left]';
	ed.id = 'locations_' + last_id + '_left_input';
	ed.onkeyup = 'visualUpdate();';
    ed.type = 'text';
    ed.size = '13';
    td4.appendChild(ed);
	
	td5.className = 'cms_fieldstyle1';
    ed = d.createElement('INPUT');
    ed.name = 'locations[' + last_id + '][top]';
	ed.id = 'locations_' + last_id + '_top_input';
	ed.onkeyup = 'visualUpdate();';
    ed.type = 'text';
    ed.size = '13';
    td5.appendChild(ed);
	
	td6.className = 'cms_fieldstyle1';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'locations[' + last_id + '][goid]';
    ed.size = '13';
    td6.appendChild(ed);
	
	last_id++;	
}
visualEditor = function(){
	viewEditor = viewEditor ? false : true;
	visualUpdate(viewEditor);
}
visualUpdate = function(){
	var returnHtml = '';
	if(viewEditor){
		returnHtml += '<div id="container" style="background-image:url(' + Configs['cdn'] + 'i/city/' + $('#cityname').val() + '/' + sprintf($('#background_img').val(),'day','summer') + ');background-repeat: no-repeat;position: relative;width:' + $('#width').val() + ';height:' + $('#height').val() + ';">';
		for(var i = 0; i < last_id; i++){
			returnHtml += '<img class="dragElement" id="locations_' + i + '" style="position:absolute;cursor:pointer;left:' + $('#locations_' + i + '_left_input').val() + ';top:' + $('#locations_' + i + '_top_input').val() + ';z-index:90;" src="' + Configs['cdn'] + 'i/city/' + $('#cityname').val() + '/' + sprintf($('#locations_' + i + '_background_img_input').val(),'summer') + '">';
		}
		returnHtml += '</div><div id="position" style="float:left;">&nbsp;</div>';
	}
	$('#visualEditor').html( returnHtml );
	runDragAndDrop();
	$('#visualButton').html( viewEditor ? 'Скрыть графический редактор' : 'Показать графический редактор' );
}
runDragAndDrop = function(){
	  $('.dragElement').draggable({
        containment: "parent",
		drag: function( event, ui ) {
			$('#' + $(this).attr('id') + '_left_input').val(ui['position']['left'] + 'px');
			$('#' + $(this).attr('id') + '_top_input').val(ui['position']['top'] + 'px');
		},
		stop: function( event, ui ) {
//			alert( ui['position']['left'] + ' x ' + ui['position']['top'] );
		}
    });

}
</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>ID локацию: &nbsp;  </td>
  <td><input name="id" type="text" class="cms_fieldstyle1" value="<?php echo $locations_edit['id']; ?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Название локации: &nbsp;  </td>
  <td><input id="title" name="title" type="text" class="cms_fieldstyle1" value="<?php echo $locations_edit['title']; ?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Название города: &nbsp;  </td>
  <td><input id="cityname" name="cityname" type="text" class="cms_fieldstyle1" value="<?php echo $locations_edit['cityname']; ?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Фон локации: &nbsp;  </td>
  <td><input id="background_img" name="background_img" type="text" class="cms_fieldstyle1" onkeyup="visualUpdate();" value="<?php echo $locations_edit['background_img']; ?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Размер фона: &nbsp;  </td>
  <td><input id="width" name="width" type="text" class="cms_fieldstyle1" onkeyup="visualUpdate();" value="<?php echo $locations_edit['width']; ?>" size="13" maxlength="255" /> x <input id="height" name="height" type="text" class="cms_fieldstyle1" onkeyup="visualUpdate();" value="<?php echo $locations_edit['height']; ?>" size="13" maxlength="255" /></td>
</tr>
<tr>
  <td>Перенапровление: &nbsp;  </td>
  <td><input name="redirect" type="text" class="cms_fieldstyle1" value="<?php echo $locations_edit['redirect']; ?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Зимний снег: &nbsp;  </td>
  <td><input name="showfall" type="text" class="cms_fieldstyle1" value="<?php echo $locations_edit['showfall']; ?>" size="30" maxlength="255" /></td>
</tr>
</table>
<br />
Навигация:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_buildings" >
    <tr>
        <td class="cms_cap2 normal">Удалить</td>
        <td class="cms_cap2">Название локации</td>
		<td class="cms_cap2">Фон локации</td>
		<td class="cms_cap2">Отступ от лева</td>
		<td class="cms_cap2">Отступ с верху</td>
		<td class="cms_cap2">ID Перехода</td>
    </tr>
<?php echo $locations; ?>
</table>
<a onclick="addItem_buildings('table_buildings', 'tr_locations_'); return false;" href="#">Добавить навигацию</a><br />
<p></p>
  <input type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input type="submit" onclick="document.location='locations_list.htm'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>