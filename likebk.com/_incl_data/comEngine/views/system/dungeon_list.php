<h3>Список Подземелий</h3>
<div class="cms_ind">
<br />
Подземелья: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">#</td>
	  <td class="cms_cap2">Подземелья</td>
    </tr>
	<?php foreach ($dungeon_list as $item):?>
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить это подземелье?\');" href="dungeon_edit.htm?delete_dungeon_id=<?php echo $item['id']; ?>" title="Удалить место"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="dungeon_edit.htm?dungeon_id=<?php echo $item['dungeon_id']; ?>"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><?php echo $item['dungeon_id']; ?></td>
      <td class="cms_middle"  align="left"><a href="dungeon_edit.htm?dungeon_id=<?php echo $item['dungeon_id']; ?>"><?php echo $item['dungeon_name']; ?></a></td>
    </tr>
	<?php endforeach; ?>
    </table>
    <br />
 </div>
 <img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_add.gif" /><a href="dungeon_edit.htm">Добавить подземелье</a> &nbsp;<br />
 <br />