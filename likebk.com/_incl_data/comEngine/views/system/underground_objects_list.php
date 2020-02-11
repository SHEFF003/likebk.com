<h3>Список объектов</h3>
<div class="cms_ind">
<br />
Объекты: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">#</td>
	  <td class="cms_cap2">Объект</td>
    </tr>
	<?php foreach ($underground_objects_list as $item):?>
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот объект?\');" href="underground_objects_list.htm?delete_underground_objects_id=<?php echo $item['id']; ?>" title="Удалить место"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="underground_objects_edit.htm?underground_objects_id=<?php echo $item['id']; ?>"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><?php echo $item['id']; ?></td>
      <td class="cms_middle"  align="left"><a href="underground_objects_edit.htm?underground_objects_id=<?php echo $item['id']; ?>"><?php echo $item['name']; ?></a></td>
    </tr>
	<?php endforeach; ?>
    </table>
    <br />
 </div>
 <img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_add.gif" /><a href="underground_objects_edit.htm">Добавить объекта</a> &nbsp;<br />
 <br />