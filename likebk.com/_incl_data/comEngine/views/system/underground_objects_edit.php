<h3><?php echo ($underground_objects_edit['id'] != '' ? 'Изменить объект' : 'Добавить объект'); ?></h3>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>ID объекта: &nbsp;  </td>
  <td><input name="id" type="text" class="cms_fieldstyle1" value="<?php echo $underground_objects_edit['id']; ?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Название объекта: &nbsp;  </td>
  <td><input id="name" name="name" type="text" class="cms_fieldstyle1" value="<?php echo $underground_objects_edit['name']; ?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Графика объекта: &nbsp;  </td>
  <td><input id="image" name="image" type="text" class="cms_fieldstyle1" value="<?php echo $underground_objects_edit['image']; ?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Метод объекта: &nbsp;  </td>
  <td><input id="class" name="class" type="text" class="cms_fieldstyle1" value="<?php echo $underground_objects_edit['class']; ?>" size="30" maxlength="255" /></td>
</tr>
</table>
<p></p>
  <input type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input type="submit" onclick="document.location='underground_objects_list.htm'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>