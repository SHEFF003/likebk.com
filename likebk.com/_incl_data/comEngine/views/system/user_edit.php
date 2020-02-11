<h3><?php echo ($user_edit['id'] == '' ? 'Добавить пользователя' : 'Редактировать пользователя'); ?></h3>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>Логин: &nbsp;  </td>
  <td><input name="login" type="text" class="cms_fieldstyle1" value="<?php echo $user_edit['login']; ?>" disabled size="30" maxlength="20" /></td>
</tr>
</table>
Права доступа:<br />
<table border="0" cellpadding="0" cellspacing="1">
<?php foreach ($permissions as $code=>$name):?>
<tr>
  <td><input type="checkbox" name="permission[<?php echo $code; ?>]" id="permission_<?php echo $code; ?>" value="Y" <?php echo ($user_edit['admin'] & $code ? 'checked="checked"' : '' ); ?> /></td>
  <td><label for="permission_<?php echo $code; ?>"><?php echo $name; ?></label></td>
</tr>
<?php endforeach; ?>
</table>
<p></p>
  <input name="id" type="hidden" value="<?php echo $user_edit['id']; ?>" />
  <input type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input type="submit" onclick="document.location='user_list.htm'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>