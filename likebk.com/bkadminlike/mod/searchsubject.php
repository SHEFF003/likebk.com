<div style="margin-left: 10px;">
  <h3 style="text-align:left;">����� ��������</h3>
 <form name="test" method="post" class="id_update">
  <p><b>������� id ��������:</b><br>
   <input class='form-control' style="width: 20%" id="id_pr" name="id_sub" type="text" pattern="[0-9]{0,10}" placeholder="id ��������">
  </p>
  <p><input class="update btn btn-default" type="submit" value="�����">
   <input class="btn btn-default" type="reset" value="��������"></p>
 </form>
<p>
    <b>�������� ����� ��� ��������:</b><br>
    <input class="add1 btn btn-default" style="font-size: 13px!important;" type="submit" value="�������� �����"/>
</p>
<div class="form_add"></div>

<div class="form"></div>

</div>
<script>
$('.add1').click(function(){
  $.ajax({
      type: 'POST',
      dataType: 'html',
      url: '/bkadminlike/mod/searchSub/add.php',
      data: 'type=add1',
      success: function(html) {
        $('.form_add').html(html);
      }
    });  
});
$('.update').click(function(){
  var data ="";
  var this2 = $('#id_pr');
  data = this2.attr('name')+'='+parseFloat(this2.val());
  if(this2.val()){
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: '/bkadminlike/mod/searchSub/form.php',
      data: data,
      success: function(html) {
        $('.form').html(html);
      }
    });  
    return false;
  }
});
</script>