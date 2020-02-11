<h3>Список пользователей</h3>
<div class="cms_ind">
<br />
Пользователи: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">#</td>
      <td class="cms_cap2">Логин</td>
    </tr>
	<?php foreach ($user_list as $item):?>
	<tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы действительно хотите удалить этого пользователя?\');" href="user_list.htm?delete_user_id=<?php echo $item['id']; ?>" title="Удалить пользователя"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="user_edit.htm?user_id=<?php echo $item['id']; ?>" title="Редактировать пользователя"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle"><?php echo $item['id']; ?></td>
      <td align="left" class="cms_middle"><a href="user_edit.htm?user_id=<?php echo $item['id']; ?>" title="Редактировать пользователя"><?php echo $item['login']; ?></a></td>
    </tr>
    <?php endforeach; ?>
    </table>
    <br />
 </div>
 <img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_icons/cms_add.gif" alt="Добавить пользователя" /><a href="user_edit.htm" title="Добавить пользователя">Добавить пользователя</a> &nbsp;<br />
 <br />