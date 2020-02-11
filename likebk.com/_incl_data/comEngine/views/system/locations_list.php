<h3>Список Локаций</h3>
<div class="cms_ind">
<br />
Локации: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">#</td>
	  <td class="cms_cap2">Название места</td>
    </tr>
	<?php foreach ($locations_list as $item):?>
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить это место?\');" href="locations_list.htm?delete_location_id=<?php echo $item['id']; ?>" title="Удалить место"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="locations_edit.htm?location_id=<?php echo $item['id']; ?>" title="Изменить место"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><?php echo $item['id']; ?></td>
      <td class="cms_middle"  align="left"><a href="locations_edit.htm?location_id=<?php echo $item['id']; ?>" title="Изменить место"><?php echo $item['title']; ?></a></td>
    </tr>
	<?php endforeach; ?>
    </table>
    <br />
 </div>
 <img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_add.gif" alt="Добавить место" /><a href="locations_edit.htm" title="Добавить место">Добавить место</a> &nbsp;<br />
 <br />