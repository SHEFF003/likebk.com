<div style="margin-left: 10px;">
  <h3 style="text-align:left;">�������� ������� �� ���</h3>
 <form name="test" method="post" class="id_update">
  <p><b>������� id ���:</b><br>
   <input class='form-control' style="width: 20%" id="id_pr" name="id_battle" type="text" pattern="[0-9]{0,10}" placeholder="id ���">
  </p>
  <p><input class="update btn btn-default" type="submit" value="��������"></p>
 </form>
<script>

$('.update').click(function(){
  var data ="";
  var this2 = $('#id_pr');
  data = this2.attr('name')+'='+parseFloat(this2.val());
  if(this2.val()){
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: '/bkadminlike/mod/clearBattle/clear_user.php',
      data: data,
      success: function(html) {
        alert(html);
      }
    });  
    return false;
  }
});
</script>