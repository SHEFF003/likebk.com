<style>
.thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
}
</style>
<h3 style="text-align:left;">���������� ������ ��������:</h3>
  <p>
  <form id="newS">
    <b>�������� ��������:</b><br/>
    <input class='form-control' style="width: 30%" id="name_sub" name="name" type="text" placeholder="�������� ��������" />
    <br/><b>���� � ��.:</b><br/>
    <input class='form-control' style="width: 20%" id="price" name="price1" type="text" placeholder="���� ��������" />
    <br/><b>���� � ���.:</b><br/>
    <input class='form-control' style="width: 20%" id="price" name="price2" type="text" placeholder="���� ��������" />
    <!-- <input id="pric_check" type="checkbox" name="pric_check"/> <label>���� � ���.</label> -->
    <br/><b>�������������:</b><br/>
    <input class='form-control' style="width: 30%" id="iznosMax_sub" name="iznosMAXi" type="text" placeholder="������������� ��������" />
    <br/><b>��������:</b><br/>
    <input class='form-control' style="width: 30%" id="info_sub" name="info" type="text" placeholder="�������� ��������" />
    <br/><b>�������:</b><br/>
    <input class='form-control' style="width: 30%" id="level_sub" name="level" type="text" placeholder="������� ��������" />
    <br/><b>�����:</b><br/>
    <input class='form-control' style="width: 30%" id="level_sub" name="massa" type="text" placeholder="����� ��������" />
    <br/><b>�������:</b><br/>
    <select name="type">
        <option value="1">�����</option>
        <option value="3">������</option>
        <option value="18">������: ������</option>
        <option value="19">������: �����</option>
        <option value="20">������: ������</option>
        <option value="21">������: ���</option>
        <option value="22">������: ���. �����</option>
        <option value="5">������ �����</option>
        <option value="6">������� �����</option>
        <option value="8">�����</option>
        <option value="9">�����</option>
        <option value="10">��������</option>
        <option value="11">������</option>
        <option value="12">��������</option>
        <option value="13">����</option>
        <option value="14">�����</option>
        <option value="15">�����</option>
        <option value="">������</option>
        <option value="">�����</option>
        <!-- <option value="0">������</option> -->
    </select>
    <br/><b>���� ��� ��������:</b><br/>
    <select name="inslot">
        <option value="1">���� ��� �����</option>
        <option value="2">���� ��� ������</option>
        <option value="3">���� ��� ������</option>
        <option value="5">���� ��� �����</option>
        <option value="7">���� ��� �����</option>
        <option value="8">���� ��� �����</option>
        <option value="9">���� ��� ��������</option>
        <option value="10">���� ��� ������</option>
        <option value="13">���� ��� ��������</option>
        <option value="14">���� ��� ����</option>
        <option value="16">���� ��� �����</option>
        <option value="17">���� ��� �����</option>
        <option value="4">���� ��� ������</option>
        <option value="6">���� ��� �����</option>
        <!-- <option value="0">������</option> -->
    </select>
    <br><b>������ ������:</b><br/>
    <input class='form-control' style="width: 30%" id="2too" name="2too" type="text" placeholder="������� 1, ���� ������ ������" />
    <br><b>���������:</b><br/>
    <input class='form-control' style="width: 30%" id="2too" name="2h" type="text" placeholder="������� 1, ���� ���������" />
  </p>
  <input type="hidden" name="lvl_exp" value="600">
  <input type="hidden" name="lvl_aexp" value="100">
  <input type="hidden" name="lvl_itm" value="1">
  <input type="hidden" name="class" value="5">
  <input type="hidden" name="inRazdel" value="1">
</form>
<input class="add_s btn btn-default" style="font-size: 13px!important;" name="mainIt" type="submit" value="���������"/>
<div id="block_img"></div>

<script>
//������ ���������
$('.add_s').click(function(){
    $.ajax({
        url: '/bkadminlike/mod/newSub/add_items_main.php',
        data: $('#newS').serialize(),
        type: 'POST',
        success: function (data) {
            //alert(data);
            $('#block_img').html(data);
        }
    });
});

//��������� ���� � ���
var price;
$("#pric_check").change(function(){
    if(this.checked) {  
        //price = 'price2='+parseFloat($('#price').val());
        $('#price').attr('name','price2');
    } else {
        //price = 'price1='+parseFloat($('#price').val());
        $('#price').attr('name','price1');
    }
});

</script>