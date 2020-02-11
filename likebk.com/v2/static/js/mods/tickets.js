var modx = {
	'name':'tickets'
};

_bk.mod.module[modx.name] = {
	modx:{ },
	start:function() {
		//this.getWinHtml(this.getHtml());
		this.getMainHtml(this.getHtml());
		//if( this.rzpg == 0 ) {
		this.gorz(1,1);
		//}
	},
	getHtml:function() {
		var html = '';
		//
		html += '<table width="100%" border="0" cellspacing="0" cellpadding="0">'+
				  '<tr>'+
					'<td align="center"><h3 class="pH3">Обратная связь</h3></td>'+
					'<td width="200" align="right" valign="top">'+
						'<button style="margin-top:10px;margin-right:12px" class="btnnew2 fr" type="button" onclick="top._bk.oUrl(\'/main.php\');">Вернуться</button>'+
					'</td>'+
				  '</tr>'+
				'</table>';
		//
		html += '<table width="100%" style="max-width:1200px" align="center" border="0" cellspacing="0" cellpadding="0">'+
				  '<tr>'+
					'<td width="215" align="left" valign="top">'+
						
						'<div align="center">' + _bk.loginLook(_bk.user.info.id,_bk.user.info.login,_bk.user.info.level,_bk.user.info.clan,_bk.user.info.align,2) + '</div>'+
						'<div class="tk_menu1">'+ 
							'<a onclick="top._bk.mod.module.tickets.gorz(1,1);" class="cp">Активные тикеты</a>'+
							'<a onclick="top._bk.mod.module.tickets.gorz(2,1);" class="cp">Архив тикетов</a>'+
						'</div>'+
						
					'</td>'+
					'<td align="left" valign="top"><div id="tickets_error"></div><div id="tickets_main" style="margin-left:10px;">'+
						/*'<b>Обратная связь</b>, здесь Вы можете оставить свои предложения и сообщить о багах в игре. На каждое сообщение Вы получите ответ в течении 12 часов (максимум) с возможными решениями проблемы.'+
						'<br><br><font color="red">Внимание!</font> Не флудите и не оставляйте бесмысленные сообщения. За это Вы можете быть наказаны.'+
						'<br><br>Для начала работы выберите раздел в меню слева.'+*/
					'</div></td>'+
				  '</tr>'+
				'</table>';
		
		html = '<div style="padding:10px;">'+html+'</div>';	
		//
		return html;
	},
	//обновление данных
	update_data:function(data) {
	
		return true;
	},
	
	types:['Предложения по игре','Вопросы по игре','Ошибки и баги','Коммерческий отдел','Жалобы на модераторов','Прочее'],
	
	rzpg:0,
	gorz:function(id,pg) {
		this.rzpg = pg;
		$.getJSON('/v2/ticket',{ 'act':'open_rz' , 'rz':id , 'pg':pg },function(data){
			if( data.error != undefined ) {
				alert(data.error);
			}else{
				_bk.mod.module.tickets.rzdata(data,id);
			}
		});
	},
	
	gotk:function(id,pg) {
		$.getJSON('/v2/ticket',{ 'act':'open_tk' , 'tk':id , 'pg':pg },function(data){
			if( data.error != undefined ) {
				alert(data.error);
			}else{
				_bk.mod.module.tickets.tkdata(data,id);
			}
		});
	},
	
	newticket:function(btn) {
		$(btn).hide();
		$('#tkblock1').fadeIn('slow');
	},
	
	sendTicket1:function() {
		
		$.post('/v2/ticket?act=newticket',{
				'title':$('#tk_title1').val(),
				'text':	$('#tk_text1').val(),
				'type':	$('#tk_type1').val()
			},function(data){
			data = $.parseJSON(data);
			if( data.error != undefined ) {
				alert(data.error);
			}else{
				_bk.mod.module.tickets.gorz(1,1);
			}
		});
	},
	
	tkdata:function(data,id) {
		
		$('#tickets_error').html('');
		
		if( data.error != undefined ) {
			$('#tickets_error').html('<font color="red"><b>'+data.error+'</b></font>');
		}
		
		var html = '';
		
		var tk = data.datatk;
		
		html += '<div class="tk_box1">';
			html += '<div class="fl">' + _bk.loginLook(tk.uid,tk.login,tk.level,tk.clan,tk.align,2) + '</div>';
			html += '<div class="fr">'+_bk.data( 'd.m.Y H:i', tk.update )+'</div>';
			html += '<br><br>';
			html += '<div style="padding:10px;border-bottom:1px solid #9a9a9a;margin-bottom:10px;"><b style="font-size:11pt;color:navy;">' + tk.title + '</b><br>Раздел: '+this.types[tk.type]+'</div>';
			html += '<div>'+tk.tk.text+'</div>';
		html += '</div>';
		
		html += '<div align="center">';
		
		//
		var i = 0;
		while( i != -1 ) {
			if( tk.com[i] != undefined ) {
				html += '<div class="tk_com2 tk_ticket">';
					var logina = '';
					if( tk.com[i].admin > 0 ) {
						logina = '<b><font color="red"><i>Администрация ЛайкБК</i></font></b>';
					}else{
						logina = _bk.loginLook(tk.com[i].uid,tk.com[i].login,tk.com[i].level,tk.com[i].clan,tk.com[i].align,2);
					}
					html += '<div class="fl">' + logina + '</div>';
					html += '&nbsp;<div class="fr">'+_bk.data( 'd.m.Y H:i', tk.com[i].time )+'</div>';
					html += '<div align="left" style="padding:10px;">'+tk.com[i].text+'</div>';	
				html += '</div>';
			}else{
				i = -2;
			}
			i++;
		}
		//
		
		if( tk.close == 0 || _bk.user.info.admin > 0 ) {
			html += '<br><table width="800" border="0" cellspacing="0" cellpadding="0">'+
					  '<tr>'+
						'<td style="white-space:nowrap" valign="bottom"><div style="padding-bottom:38px;">'+_bk.loginLook(_bk.user.info.id,_bk.user.info.login,_bk.user.info.level,_bk.user.info.clan,_bk.user.info.align,2)+':</div></td>'+
						'<td width="600"><textarea id="tk_text2" style="width:600px;max-width:600px;min-width:600px;" rows="1"></textarea><script>autosize($(\'#tk_text2\'));</script>';
						
						html += '<button onclick="_bk.mod.module.tickets.sendMsg2('+tk.id+');" class="btnnew2" type="button">Отправить сообщение</button>&nbsp;&nbsp;&nbsp;';
						html += '<button onclick="_bk.mod.module.tickets.closeTk('+tk.id+');" class="btnnew2" type="button">Закрыть тикет</button>';
						if( _bk.user.info.admin > 0 ) {
							html += '<button onclick="_bk.mod.module.tickets.deleteTk('+tk.id+');" class="btnnew2" type="button">Удалить тикет</button>';
						}
						
						html += '</td>'+
						
					  '</tr>'+
					'</table>';
			html += '</div>';
		}else{
			html += '<div align="center" style="color:red;padding:20px;">Тикет закрыт '+_bk.data( 'd.m.Y H:i', tk.close )+'.</div>';
		}
				
		$('#tickets_main').html(html);
		
	},
	
	rzdata:function(data,rz) {
		
		$('#tickets_error').html('');
		
		if( data.error != undefined ) {
			$('#tickets_error').html('<font color="red"><b>'+data.error+'</b></font>');
		}
		
		var html = '';
		
		if( rz != 2 ) {
			var cats = '<select id="tk_type1">';
			var i = 0;
			while( i != -1 ) {
				if( this.types[i] != undefined ) {
					cats += '<option value="'+i+'">'+this.types[i]+'</option>';
				}else{
					i = -2;
				}
				i++;
			}
			cats += '</select>';		
			
			html += '<div align="center" style="min-height:50px;"><button style="margin-left:20px;margin-top:10px;margin-right:12px" class="btnnew2 fl" type="button" onclick="_bk.mod.module.tickets.newticket(this);">Создать новый тикет</button><table id="tkblock1" style="display:none" class="tk_blockin" width="800" border="0" cellspacing="0" cellpadding="5">'+
					  '<tr>'+
						'<td>&nbsp;</td>'+
						'<td style="padding:10px;color:grey;">Сообщения не относяшиеся к игре не рассматриваются и удаляются, не тратьте своё и наше время.<br>Благодарим за понимание.</td>'+					
					  '</tr>'+
					  '<tr>'+
						'<td width="125">Персонаж:</td>'+
						'<td>' + _bk.loginLook(_bk.user.info.id,_bk.user.info.login,_bk.user.info.level,_bk.user.info.clan,_bk.user.info.align,2) + '</td>'+
					  '</tr>'+
					  '<tr>'+
						'<td>Категория:</td>'+
						'<td>'+cats+'</td>'+
					  '</tr>'+
					  '<tr>'+
						'<td>Тема:<font color="red">*</font></td>'+
						'<td><input type="text" style="width:600px;" id="tk_title1" value=""></td>'+
					  '</tr>'+
					  '<tr>'+
						'<td>Сообщение:<font color="red">*</font></td>'+
						'<td><textarea id="tk_text1" rows="3" style="max-width:600px;width:600px;"></textarea><script>autosize($(\'#tk_text1\'));</script></td>'+
					  '</tr>'+
					  '<tr>'+
						'<td>&nbsp;</td>'+
						'<td>&nbsp;</td>'+
					  '</tr>'+
					  '<tr>'+
						'<td>&nbsp;</td>'+
						'<td><button onclick="_bk.mod.module.tickets.sendTicket1();" class="btnnew2" type="button">Создать тикет</button></td>'+
					  '</tr>'+
					'</table>'+
					'</div>';
		}
		
		if( data.data != undefined ) {
			
			var pgs = '';			
			var i = 1;
			if( this.rzpg < 1 ) {
				this.rzpg = 1;
			}
			var j = Math.ceil(data.all/10);
			if( this.rzpg > j ) {
				this.rzpg = j;
			}
			while( i <= j ) {
				if( this.rzpg == i ) {
					pgs += '<span onclick="_bk.mod.module.tickets.gorz('+rz+','+i+');" class="pgpg2">'+i+'</span> ';
				}else{
					pgs += '<span onclick="_bk.mod.module.tickets.gorz('+rz+','+i+');" class="pgpg1">'+i+'</span> ';
				}
				i++;
			}
			pgs = '<div style="padding-bottom:10px;padding-top:10px;">'+pgs+'</div>';
			
			
			html += pgs;
			
			var i = 0;
			while( i != -1 ) {
				if( data.data[i] != undefined ) {
					var tk = data.data[i];
					var dtcolor = '';
					if( tk.update > 0 && _bk.user.info.admin > 0 && rz == 1 ) {
						dtcolor = '2';
					}else if( tk.update == 0 && _bk.user.info.admin == 0 ) {
						dtcolor = '2';
					}
					html += '<div onclick="_bk.mod.module.tickets.gotk('+tk.id+',1);" style="'+dtcolor+'" class="tk_ticket'+dtcolor+'" >';
					html += '<div class="fl">' + _bk.loginLook(tk.uid,tk.login,tk.level,tk.clan,tk.align,2) + '</div>';
					html += '&nbsp;<div class="fr">'+_bk.data( 'd.m.Y H:i', tk.update )+'</div>';
					html += '<div style="padding:10px;"><b style="font-size:11pt;color:navy;">' + tk.title + '</b><br>Раздел: '+this.types[tk.type]+'</div>';
					html += '</div>';					
				}else{
					delete tk;
					i = -2;
				}
				i++;
			}
			
			html += pgs;
			
		}else{
			html += '<div align="center"><br><br>Раздел пуст<br><br></div>';
		}
		
		$('#tickets_main').html(html);
	},
	
	sendMsg2:function(id) {
		$.post('/v2/ticket?act=newmsg',{
				'text':	$('#tk_text2').val(),
				'tid':	id
		},function(data){
			data = $.parseJSON(data);
			if( data.error != undefined ) {
				alert(data.error);
			}else{
				_bk.mod.module.tickets.gotk(id,1);
			}
		});
	},
	
	closeTk:function(id) {
		$.post('/v2/ticket?act=closetk',{
				'tid':	id
		},function(data){
			data = $.parseJSON(data);
			if( data.error != undefined ) {
				alert(data.error);
			}else{
				_bk.mod.module.tickets.gorz(1,1);
			}
		});
	},
	
	deleteTk:function(id) {
		$.post('/v2/ticket?act=deletetk',{
				'tid':	id
		},function(data){
			data = $.parseJSON(data);
			if( data.error != undefined ) {
				alert(data.error);
			}else{
				_bk.mod.module.tickets.gorz(1,1);
			}
		});
	},
	
	getMainHtml:function(r) {
		_bk.mod.html(r);
	},
	getWinHtml:function(r) {
		var winid = 'wintestnew1';
		win.add(winid,'Обратная связь &nbsp;','',{'a1':'alert("action.win.'+winid+'.action:a1");','usewin':'','d':r},0,1,'width:800px;height:650px;');
	}
};
_bk.mod.module[modx.name].modx = modx;
delete modx;

if( _bk.mod.modstart == true ) {
	_bk.mod.modstart = false;
	_bk.mod.module[modx.name].start();
}