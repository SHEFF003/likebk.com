<?php
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/*$dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
// ������ $_FILES.
$id_main = $_GET['id'];
$price1 = $_GET['price1'];
$price2 = $_GET['price2'];
if($_FILES){
    // $url = dirname($_SERVER['DOCUMENT_ROOT']);
    // $uploaddir = $url.'/img.'.$_SERVER['SERVER_NAME'].'/i/items';
    $uploaddir = '../../../../img.likebk.com/i/items';
    //@mkdir("uploads", 0777);
    $uploadfile = $uploaddir."/".basename($_FILES['filename']['name']);
    //echo $uploadfile;
    //print_r($_FILES);
    
    if($_FILES['filename']['type'] != "image/gif" && $_FILES['filename']['type'] != "image/png") {
       echo "��������� ����� ������ GIF ����������� � png";
       exit;
    }
    else{
        if($_FILES["filename"]["size"] > 300000)
        {
            echo ("������ ����� ��������� 20 ��");
            exit;
        }
        else{
           // ��������� �������� �� ����
          if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
          {
             // ���� ���� �������� �������, ���������� ���
             // �� ��������� ���������� � ��������
            $name = $_FILES['filename']['name'];
             if(move_uploaded_file($_FILES["filename"]["tmp_name"], $uploadfile)){
                echo "<span style='font-size: 15px; color: red;'>����������� ������� ���������</span>";
                mysql_query('UPDATE `items_main` SET `img` = "'.mysql_real_escape_string($name).'" WHERE `id` = '.$id_main.' LIMIT 1');
              }
           } else {
              echo("������ �������� �����������");
           }
       }
   }
}

?>
<p>
  <b>�������� � �������</b><br>
  <form id="shop_form"> 
    <b>�������� ��������:</b><br/>
    <select name="sid">
    <option value="2">�������</option>
        <option value="1">������</option>
        
        <option value="777">�����������</option>
    </select>
    <br/><b>������ ��������:</b><br/>
    <select name="r">
        <option value="117">"������ ���"</option>
        <option value="116">"�������� ����"</option>
        <option value="115">"�������� �������"</option>
        <option value="114">"���������� ����"</option>
        <!-- <option value="117">"����"</option> -->
        <option value="11">"������: �����"</option>
        <option value="12">"������: ������"</option>
        <option value="1">"������: �������,����"</option>
        <option value="2">"������: ������"</option>
        <option value="3">"������: ������,������"</option>
        <option value="4">"������: ����"</option>
        <option value="5">"������: ���������� ������"</option>
        <option value="9">"������: ������ �����"</option>
        <option value="10">"������: ������� �����"</option>
        <option value="13">"������: �����"</option>
        <option value="16">"��������� ������: ������"</option>
        <option value="17">"��������� ������: ��������"</option>
        <option value="18">"��������� ������: ������"</option>
        <option value="7">"������: ��������"</option>
        <option value="15">"����"</option>
        <option value="14">"������: ������"</option>
        <option value="6">"������: ������"</option>
    </select>
    <input type="hidden" name="price_1" value="<?php echo $price1;?>">
    <input type="hidden" name="price_2" value="<?php echo $price2;?>">
    <!-- <br/><b>���� � ��.:</b><br/>
    <input class='form-control' style="width: 20%" id="price" name="price_1" type="text" placeholder="���� �������� � ��." />
    <br/><b>���� � ���.:</b><br/>
    <input class='form-control' style="width: 20%" id="price" name="price_2" type="text" placeholder="���� �������� � ���." /> -->
    <br/><b>�������:</b><br/>
    <input class='form-control' style="width: 30%" id="level_sub" name="level" type="text" placeholder="������� ��������" />
    <input type="hidden" name="real" value="1">
    <input type="hidden" name="kolvo" value="2000000000">
  </form>

    <input class="add_shop btn btn-default" style="font-size: 13px!important;" type="submit" value="��������"/>
</p>
<script type="text/javascript">
$('.add_shop').click(function(){
    var id = "<?php echo $id_main;?>";
    $.ajax({
        url: '/bkadmin/mod/newSub/add_items_shop.php?id='+id,
        data: $('#shop_form').serialize(),
        type: 'POST',
        success: function (data) {
            alert(data);
        }
    });
});
</script>