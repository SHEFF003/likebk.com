// JavaScript Document

var rznow = 0;
function getrazdel(id) {
	if( $('#rz'+id).attr('id') != 'rz'+id ) {
		alert('Раздел не существует!');
	}else{
		var i = 1;
		while( i != -1 ) {
			if( $('#rz'+i).attr('id') != 'rz'+i ) {
				i = -2;
			}else{
				$('#rz'+i).removeClass('s');
				$('#rz'+i).removeClass('m');
				$('#rz'+i).addClass('m');
				$('#rzii'+i).hide();
			}
			i++;
		}
		$('#rz'+id).removeClass('m');
		$('#rz'+id).addClass('s');
		//$('#rzii'+id).show();
		rznow = id;
		reflesh();
	}
}

function reflesh() {
	if( rznow == 0 ) {
		$('#maindata').html('<div style="padding:20px;" align="center"><b>Выберите раздел поединков</b></div>');
	}else{
		var html = '';
		//
		html += '<b style="color:red">Ошибка загрузки раздела</b>';
		//
		$('#maindata').html(html);
		//
	}
}