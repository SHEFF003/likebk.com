/*if( $ == undefined ) {
	alert('Требуется подключение библиотеки JQuery!');
	_bk = { start:function(){  } , mod:{ open:function(a){ } } };
}else{*/

	var encodings= {
		// Windows code page 1252 Western European
		//
		cp1252: '\x00\x01\x02\x03\x04\x05\x06\x07\x08\t\n\x0b\x0c\r\x0e\x0f\x10\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1a\x1b\x1c\x1d\x1e\x1f !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~\x7f\u20ac\ufffd\u201a\u0192\u201e\u2026\u2020\u2021\u02c6\u2030\u0160\u2039\u0152\ufffd\u017d\ufffd\ufffd\u2018\u2019\u201c\u201d\u2022\u2013\u2014\u02dc\u2122\u0161\u203a\u0153\ufffd\u017e\u0178\xa0\xa1\xa2\xa3\xa4\xa5\xa6\xa7\xa8\xa9\xaa\xab\xac\xad\xae\xaf\xb0\xb1\xb2\xb3\xb4\xb5\xb6\xb7\xb8\xb9\xba\xbb\xbc\xbd\xbe\xbf\xc0\xc1\xc2\xc3\xc4\xc5\xc6\xc7\xc8\xc9\xca\xcb\xcc\xcd\xce\xcf\xd0\xd1\xd2\xd3\xd4\xd5\xd6\xd7\xd8\xd9\xda\xdb\xdc\xdd\xde\xdf\xe0\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8\xe9\xea\xeb\xec\xed\xee\xef\xf0\xf1\xf2\xf3\xf4\xf5\xf6\xf7\xf8\xf9\xfa\xfb\xfc\xfd\xfe\xff',
	
		// Windows code page 1251 Cyrillic
		//
		cp1251: '\x00\x01\x02\x03\x04\x05\x06\x07\x08\t\n\x0b\x0c\r\x0e\x0f\x10\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1a\x1b\x1c\x1d\x1e\x1f !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~\x7f\u0402\u0403\u201a\u0453\u201e\u2026\u2020\u2021\u20ac\u2030\u0409\u2039\u040a\u040c\u040b\u040f\u0452\u2018\u2019\u201c\u201d\u2022\u2013\u2014\ufffd\u2122\u0459\u203a\u045a\u045c\u045b\u045f\xa0\u040e\u045e\u0408\xa4\u0490\xa6\xa7\u0401\xa9\u0404\xab\xac\xad\xae\u0407\xb0\xb1\u0406\u0456\u0491\xb5\xb6\xb7\u0451\u2116\u0454\xbb\u0458\u0405\u0455\u0457\u0410\u0411\u0412\u0413\u0414\u0415\u0416\u0417\u0418\u0419\u041a\u041b\u041c\u041d\u041e\u041f\u0420\u0421\u0422\u0423\u0424\u0425\u0426\u0427\u0428\u0429\u042a\u042b\u042c\u042d\u042e\u042f\u0430\u0431\u0432\u0433\u0434\u0435\u0436\u0437\u0438\u0439\u043a\u043b\u043c\u043d\u043e\u043f\u0440\u0441\u0442\u0443\u0444\u0445\u0446\u0447\u0448\u0449\u044a\u044b\u044c\u044d\u044e\u044f'
	};
	
	function decodeBytes(bytes, encoding) {
		var enc= encodings[encoding];
		var n= bytes.length;
		var chars= new Array(n);
		for (var i= 0; i<n; i++)
			chars[i]= enc.charAt(bytes.charCodeAt(i));
		return chars.join('');
	}

	var _bk = {
		ver:'0.0.0.1',
		user:{
			info:{
				id:0, align:0, clan:0, login:'<i>Нет Логина</i>', level:0 , admin:0
			},
			stats:{
				
			}
		},
		start:function() {
			
		},
		
		showmenu_data:[1,1,1,1,1,1,1,1,1,1],
		showmenu:function(id) {
			if( this.showmenu_data[id] == 1 ) {
				$('#shw'+id+'v1').hide();
				$('#shw'+id+'v2').show();
				$('#rz'+(id-1)).hide();
				this.showmenu_data[id] = 0;
			}else{
				$('#shw'+id+'v1').show();
				$('#shw'+id+'v2').hide();
				$('#rz'+(id-1)).show();
				this.showmenu_data[id] = 1;
			}
		},		
				
		getLine:function(id,name,a,b,o,id2)
		{
			
			o = this.showmenu_data[id2];
			
			if( o == 0 ) {
				var tss  = '<td id="shw'+id2+'v1" style="display:none;" width="20"><img src="http://img.likebk.com/i/minus.gif" style="display:block;cursor:pointer;margin-bottom:3px;" title="Скрыть" class="btn-slide" onClick="_bk.showmenu('+id2+');"></td>';
					tss += '<td id="shw'+id2+'v2" width="20"><img src="http://img.likebk.com/i/plus.gif" style="display:block;cursor:pointer;margin-bottom:3px;" title="Показать" class="btn-slide" onClick="_bk.showmenu('+id2+');"></td>';
			}else{
				var tss  = '<td id="shw'+id2+'v1" width="20"><img src="http://img.likebk.com/i/minus.gif" style="display:block;cursor:pointer;margin-bottom:3px;" title="Скрыть" class="btn-slide" onClick="_bk.showmenu('+id2+');"></td>';
					tss += '<td id="shw'+id2+'v2" style="display:none;" width="20"><img src="http://img.likebk.com/i/plus.gif" style="display:block;cursor:pointer;margin-bottom:3px;" title="Показать" class="btn-slide" onClick="_bk.showmenu('+id2+');"></td>';
			}
			
			var sts01 = '<img class="cp" onclick="_bk.updowndiv('+id2+',-1);" style="display:block;float:right; margin-bottom:3px;" src="http://img.likebk.com/i/3.gif">';
			if(id==0)
			{
				sts01 = '<img style="display:block;float:right;margin-bottom:3px;" src="http://img.likebk.com/i/4.gif">';
			}
			var sts02 = '<img class="cp" onclick="_bk.updowndiv('+id2+',1);" style="display:block; margin-bottom:3px; float:right;" src="http://img.likebk.com/i/1.gif">';
			if(id==7)
			{
				sts02 = '<img style="display:block;float:right;margin-bottom:3px;" src="http://img.likebk.com/i/2.gif">';
			}
			var sts2 = '<td width="40"><div style="float:right;">'+sts01+''+sts02+'</div></td>';
			return '<table class="mroinv" width="100%" border="0" cellspacing="2" cellpadding="0">'+
			'<tr>'+tss+
			'<td style="font-size:9px;"><span class="linestl1">&nbsp;'+name+'&nbsp;</span></td>'+sts2+'</tr>'+ 
			'</table>';
		},
		showDiv:function(id)
		{
			var block = document.getElementById('block_'+id);
			block.style.display = 'block';	
		},
		hiddenDiv:function(id)
		{
			var block = document.getElementById('block_'+id);
			block.style.display = 'none';	
		},
		uppositem:function(id) {
			var newinv = {};
			var i = 0 , j = 1;
			while( i != -1 ) {
				if( _bk.user.data.items[i] != undefined ) {
					if( _bk.user.data.items[i].id == id ) {
						newinv[0] = _bk.user.data.items[i];
					}else{
						newinv[j] = _bk.user.data.items[i];
						j++;
					}
				}else{
					i = -2;
				}
				i++;
			}
			_bk.user.data.items = newinv;
		},
		newItems:function(data) {
			var i = 1;
			if( data.length < 2 ) {
				i = -1;
			}
			while( i != -1 ) {
				if( data[i] != undefined ) {
					//
					var j = 0 , jx = 0 , add = 0;
					while( j != -1 ) {
						if( _bk.user.data.items[j] != undefined ) {
							if( _bk.user.data.items[j].id == data[i].id ) {
								add = 1;
								//переносим вверх
								_bk.user.data.items[j] = data[i];
								//this.uppositem(data[i].id);
							}
						}else{
							jx = j;
							j = -2;
						}
						j++;
					}
					if( add == 0 ) {
						//новый предмет
						//jx++;
						_bk.user.data.items[jx] = data[i];
						if( _bk.user.data.items[jx].time_create > _bk.user.data.items_lastID ) {
							_bk.user.data.items_lastID = _bk.user.data.items[jx].time_create;
							this.uppositem(data[i].id);
						}
						if( _bk.user.data.items[jx].lastUPD > _bk.user.data.items_lastID ) {
							_bk.user.data.items_lastID = _bk.user.data.items[jx].lastUPD;
							this.uppositem(data[i].id);
						}
					}
					//
				}else{
					i = -2;
				}
				i++;
			}
			
			$.cookie('liid',_bk.user.data.items_lastID);

		},
		bonusPers:function() {
			var r = [1,0];
			if( _bk.user.info.level > 7 ) {
				if( ( parseFloat(_bk.user.info.align) > 0 && parseFloat(_bk.user.info.align) != 2 ) || parseFloat(_bk.user.info.clan) > 0 ) {
					r[0] = 2;
					r[1] = 0.02;
					var lev = _bk.user.info.level - 8;
					if( lev > 0 ) {
						r[1] += lev * 0.01;
					}
				}else{
					r[0] = 1;
					var bns = [0,0,0,0,0,0,0,0,8,12,16,20,24,24,24,24,24,24,24,24,24];
					r[1] = bns[_bk.user.info.level];
				}
				if( parseFloat(this.data('w')) == 0 || parseFloat(this.data('w')) == 6 ) {
					r[1] += r[1];
				}
			}
			return r;
		},
		bonusTakeNow:function() {
			if( this.user.global.stats.auto[2] > this.timenow() ) {
				//
				alert('Бонус не восстановился...');
			}else{				
				_bk.mod.module.inventory.refItemsOnline('bonusonline=true');
			}
		},
		zago:function(val) {
			if( val > 1700 ) {
				val = 1700;
			}
			val = Math.round( (1-( Math.pow(0.5, (val/(399.51)) ) ))*100 , 2 );
			return val;
		},
		posdivs:[0,1,2,3,4,5,6,7,8,9],
		locStats:function(vis) {
			var html = '';
			
			html += 'Опыт: <a href="/exp.php" target="_blank">'+_bk.user.global.exp[0]+'</a> <b>('+_bk.user.global.exp[1]+')</b>';
			html += '<br>Бои: '+_bk.user.global.fight[0]+' <img title="Победы" width="7" height="7" src="http://img.likebk.com/i/ico/wins.gif">';
				html += ' '+_bk.user.global.fight[1]+' <img title="Поражения" width="7" height="7" src="http://img.likebk.com/i/ico/looses.gif">';
				html += ' '+_bk.user.global.fight[2]+' <img title="Ничья" width="7" height="7" src="http://img.likebk.com/i/ico/draw.gif">';
			html += '<br>Деньги: <b>'+_bk.user.global.money[0]+' кр.</b>';
			html += '<br>Деньги: <b style="color:#23527c">'+_bk.user.global.money[1]+' екр.</b>';
				html += ' <b><a style="display: inline-block; text-decoration: underline; font-size: 13px; color: #339900; cursor: pointer;" class="cp" href="/main.php?bill=1" onclick="_bk.oUrl(\'/main.php?bill=1\'); return false;">Пополнить баланс</a></b>';
			if( _bk.user.global.money[2] > 0 ) {
				html += '<br>Деньги: <b style="color:#23527c">'+_bk.user.global.money[2]+' Gold ekr.</b>';
			}
			//
			var bns = this.bonusPers();
			if( bns[1] > 0 ) {
				if( bns[0] == 2 ) {
					html += '<div class="txt_bonus">Ваш бонус '+bns[1]+' екр.: </div>';
				}else{
					html += '<div class="txt_bonus">Ваш бонус '+bns[1]+' кр.: </div>';
				}
				if( this.user.global.stats.auto[2] >= this.timenow() ) {
					var bnsost = this.user.global.stats.auto[2]+1-this.timenow();
					if( bnsost < 0 ) {
						bnsost = 0;
					}
					bnsost = this.timeOut(bnsost);
					html += '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" disabled="disabled" class="btnnew" id="bonus_btn" onclick="alert(\'Вы сможете взять бонус через '+bnsost+'\'); return false;">Через '+bnsost+'</button>';
				}else{
					html += '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="_bk.bonusTakeNow(); return false;">Получить!</button>';
				}
			}
			//
			html += '<br>';
			//			
			var $rz = [];
				//
				$rz[0]  = this.getLine(1,"Характеристики ","0","0",1,1);
				var rzid = 0; if( this.showmenu_data[rzid+1] == 1 ) { $rz[rzid] += '<font id="rz'+rzid+'">'; }else{ $rz[rzid] += '<font style="display:none;" id="rz'+rzid+'">'; }
					$rz[0] += 'Сила: <b>'+_bk.user.global.stats['s1']+'</b>';
					$rz[0] += '<br>Ловкость: <b>'+_bk.user.global.stats['s2']+'</b>';
					$rz[0] += '<br>Интуиция: <b>'+_bk.user.global.stats['s3']+'</b>';
					$rz[0] += '<br>Выносливость: <b>'+_bk.user.global.stats['s4']+'</b>';
					$rz[0] += '<br>Интеллект: <b>'+_bk.user.global.stats['s5']+'</b>';
					$rz[0] += '<br>Мудрость: <b>'+_bk.user.global.stats['s6']+'</b>';
					$rz[0] += '<br>Духовность: <b>'+_bk.user.global.stats['s7']+'</b>';
					/*$rz[0] += '<br>Воля: <b>'+_bk.user.global.stats['s8']+'</b>';
					$rz[0] += '<br>Свобода духа: <b>'+_bk.user.global.stats['s9']+'</b>';
					$rz[0] += '<br>Божественный: <b>'+_bk.user.global.stats['s10']+'</b>';*/
					if( _bk.user.global.stats.skills[0] > 0 ) {
						$rz[0] += '<br><a onclick="_bk.oUrl(\'/main.php?skills&side=1\');" class="cp"> + Способности</a>';
					}
					if( _bk.user.global.stats.skills[1] > 0 ) {
						$rz[0] += '<br><a onclick="_bk.oUrl(\'/main.php?skills&side=1\');" class="cp"> &bull; Обучение</a>';
					}
				$rz[0] += '</font>';
				//
				$rz[1]  = this.getLine(1,"Модификаторы ","0","0",1,2);
				rzid++; if( this.showmenu_data[rzid+1] == 1 ) { $rz[rzid] += '<font id="rz'+rzid+'">'; }else{ $rz[rzid] += '<font style="display:none;" id="rz'+rzid+'">'; }
					$rz[1] += 'Урон: ' + _bk.user.global.inform.yron + '';
					$rz[1] += '<br>Мф. мощности урона: ' + _bk.user.global.inform['m10'] + '';
					$rz[1] += '<br>Мф. мощности крит. удара: ' + _bk.user.global.inform['m3'] + '';
					$rz[1] += '<br>Мф. крит. удара: ' + _bk.user.global.inform['m1'] + '';
					$rz[1] += '<br>Мф. против крит. удара: ' + _bk.user.global.inform['m2'] + '';
					$rz[1] += '<br>Мф. увертывания: ' + _bk.user.global.inform['m4'] + '';
					$rz[1] += '<br>Мф. против увертывания: ' + _bk.user.global.inform['m5'] + '';
					$rz[1] += '<br>Мф. пробоя брони: ' + _bk.user.global.inform['m9'] + '';
					$rz[1] += '<br>Мф. контрудара: ' + _bk.user.global.inform['m6'] + '';
					$rz[1] += '<br>Мф. парирования: ' + _bk.user.global.inform['m7'] + '';
					$rz[1] += '<br>Мф. блока щитом: ' + _bk.user.global.inform['m8'] + '';
					$rz[1] += '<br>Защита от урона: ' + _bk.user.global.inform['za'] + ' ('+this.zago(_bk.user.global.inform['za'])+'%)';
					$rz[1] += '<br>Защита от магии: ' + _bk.user.global.inform['zm'] + ' ('+this.zago(_bk.user.global.inform['zm'])+'%)';
					$rz[1] += '<br>Понижение защиты от магии: ' + _bk.user.global.inform['pzm'] + '';
				$rz[1] += '</font>';
				//
				$rz[2]  = this.getLine(1,"Броня ","0","0",1,3);
				rzid++; if( this.showmenu_data[rzid+1] == 1 ) { $rz[rzid] += '<font id="rz'+rzid+'">'; }else{ $rz[rzid] += '<font style="display:none;" id="rz'+rzid+'">'; }
					$rz[2] += 'Броня головы: ' + _bk.user.global.inform['mb1'][0] + '-' + _bk.user.global.inform['mb1'][1] + '';
					$rz[2] += '<br>Броня корпуса: ' + _bk.user.global.inform['mb2'][0] + '-' + _bk.user.global.inform['mb2'][1] + '';
					$rz[2] += '<br>Броня пояса: ' + _bk.user.global.inform['mb3'][0] + '-' + _bk.user.global.inform['mb3'][1] + '';
					$rz[2] += '<br>Броня ног: ' + _bk.user.global.inform['mb4'][0] + '-' + _bk.user.global.inform['mb4'][1] + '';
				$rz[2] += '</font>';
				//
				$rz[3]  = this.getLine(1,"Мощность ","0","0",1,4);
				rzid++; if( this.showmenu_data[rzid+1] == 1 ) { $rz[rzid] += '<font id="rz'+rzid+'">'; }else{ $rz[rzid] += '<font style="display:none;" id="rz'+rzid+'">'; }
					$rz[3] += 'Мощность колющего урона: ' + _bk.user.global.inform['pa1'] + '';
					$rz[3] += '<br>Мощность рубящего урона: ' + _bk.user.global.inform['pa2'] + '';
					$rz[3] += '<br>Мощность дробящего урона:' + _bk.user.global.inform['pa3'] + '';
					$rz[3] += '<br>Мощность режущего урона: ' + _bk.user.global.inform['pa4'] + '';
					$rz[3] += '<br>Мощность магии огня: ' + _bk.user.global.inform['pm1'] + '';
					$rz[3] += '<br>Мощность магии воздуха: ' + _bk.user.global.inform['pm2'] + '';
					$rz[3] += '<br>Мощность магии воды: ' + _bk.user.global.inform['pm3'] + '';
					$rz[3] += '<br>Мощность магии земли: ' + _bk.user.global.inform['pm4'] + '';
					$rz[3] += '<br>Мощность магии Света: ' + _bk.user.global.inform['pm5'] + '';
					$rz[3] += '<br>Мощность магии Тьмы: ' + _bk.user.global.inform['pm6'] + '';
					$rz[3] += '<br>Мощность серой магии: ' + _bk.user.global.inform['pm7'] + '';
				$rz[3] += '</font>';
				//
				$rz[4]  = this.getLine(1,"Кнопки ","0","0",1,5);
				rzid++; if( this.showmenu_data[rzid+1] == 1 ) { $rz[rzid] += '<font id="rz'+rzid+'">'; }else{ $rz[rzid] += '<font style="display:none;" id="rz'+rzid+'">'; }
					$rz[4] += '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="_bk.snatVse(); return false;">Снять все</button>';
					$rz[4] += '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="_bk.vozvrat(); return false;">Возврат</button>';
				$rz[4] += '</font>';
				//
				$rz[5]  = this.getLine(1,"Комплекты &nbsp; <a class='cp' onclick='top.saveCom2();'>запомнить</a> ","0","0",1,6);
				rzid++; if( this.showmenu_data[rzid+1] == 1 ) { $rz[rzid] += '<font id="rz'+rzid+'">'; }else{ $rz[rzid] += '<font style="display:none;" id="rz'+rzid+'">'; }

					var comhtml = '';
					
					var i = 0;
					while( i != -1 ) {
						if( _bk.user.global.stats.com_items[i] != undefined ) {
							comhtml += '<div><img onclick="if(confirm(\'Удалить набор предметов -'+_bk.user.global.stats.com_items[i][1]+'- ?\')){ _bk.deletecomitm('+_bk.user.global.stats.com_items[i][0]+'); }" class="cp" src="http://img.likebk.com/i/close2.gif" width="9" height="9"> &nbsp;&nbsp; <a class="cp" onclick="_bk.choosecomitm('+_bk.user.global.stats.com_items[i][0]+');">Надеть &quot;'+_bk.user.global.stats.com_items[i][1]+'&quot;</a></div>';
						}else{
							i = -2;
						}
						i++;
					}
					
					if( comhtml == '' ) {
						comhtml = '<center>Комплектов предметов нет</center>';
					}
					$rz[5] += '<small>'+comhtml+'</small>'; 

				$rz[5] += '</font>';
				//
				$rz[6]  = this.getLine(1,"Приемы &nbsp; <a class='cp' onclick='_bk.oUrl(\"/main.php?skills&rz=4\");'>настроить</a> ","0","0",1,7);
				rzid++; if( this.showmenu_data[rzid+1] == 1 ) { $rz[rzid] += '<font id="rz'+rzid+'">'; }else{ $rz[rzid] += '<font style="display:none;" id="rz'+rzid+'">'; }
					
					var comhtml = '';
					
					var i = 0;
					while( i != -1 ) {
						if( _bk.user.global.stats.com_priems[i] != undefined ) {
							comhtml += '<div><img onclick="if(confirm(\'Удалить набор приемов -'+_bk.user.global.stats.com_priems[i][1]+'- ?\')){ _bk.deletecompr('+_bk.user.global.stats.com_priems[i][0]+'); }" class="cp" src="http://img.likebk.com/i/close2.gif" width="9" height="9"> &nbsp;&nbsp; <a class="cp" onclick="_bk.choosecompr('+_bk.user.global.stats.com_priems[i][0]+');">Исп-ть &quot;'+_bk.user.global.stats.com_priems[i][1]+'&quot;</a></div>';
						}else{
							i = -2;
						}
						i++;
					}
					
					if( comhtml == '' ) {
						comhtml = '<center>Комплектов приемов нет</center>';
					}
					$rz[6] += '<small>'+comhtml+'</small>'; 
					
					//$rz[6] += '... приемы ...';
				$rz[6] += '</font>';
				//
				
			html += '<div style="padding-left:5px;padding-right:7px;">';
			var i = 0;
			while( i <= 10 ) {
				if( $rz[this.posdivs[i]] != undefined ) {
					html += $rz[this.posdivs[i]];
				}
				i++;
			}
			html += '</div>';
				
			//
			html += '<br><br><label>'; // style="font-weight:bold" \\ checked="checked"
			//html += '<input type="checkbox" onclick="alert(\'fx(1);\');" /> Автопополнение свитков</label>';
			//html += '<br><label ><input type="checkbox" onclick="if(confirm(\'Вы дествительно хотите скрыть отображение плащей?\')){ alert(\'fx(2);\'); }" /> Спрятать плащи</label>';
			if( vis == 0 ) {
				html = '<div id="locstatsinv" style="padding-top:35px;padding-left:10px;font-size:9pt;">'+html+'</div>';
			}
			return html;
		},
		updowndiv:function(id,val) {
			// this.posdivs[id - 1]
			id--;
			var i = 0;
			while( i <= 10 ) {
				if( this.posdivs[i] == id ) {
					if( (i+val) >= 0 && (i+val) <= 6 ) {
						nw = this.posdivs[i];
						this.posdivs[i] = this.posdivs[i+val];
						this.posdivs[i+val] = nw;
						//alert('['+i+'|'+(i+val)+']');
					}
					i = 11;
				}
				i++;
			}
			//alert(nw);
			//this.posdivs = nw;
			$('#locstatsinv').html( _bk.locStats(1) );
		},
		deletecomitm:function(id) {
			_bk.mod.module.inventory.refItemsOnline('com_deleteitems='+id);
		},
		choosecomitm:function(id) {
			_bk.mod.module.inventory.refItemsOnline('com_takeitems='+id);
		},
		deletecompr:function(id) {
			_bk.mod.module.inventory.refItemsOnline('com_deletepriems='+id);
		},
		choosecompr:function(id) {
			_bk.mod.module.inventory.refItemsOnline('com_takepriems='+id);
		},
		snatVse:function() {
			_bk.mod.module.inventory.refItemsOnline('snatvse=true');
		},
		vozvrat:function() {
			this.oUrl('/main.php?homeworld');
		},
		oUrl:function(url) {
			if( top._bk.mod.module.inventory != undefined ) {
				top._bk.mod.module.inventory.error = '';
			}
			console.log('oUrl => '+url);
			if( top.frames.main == undefined ) {
				$('#touchmain').css({'overflow':'none'}).html('<iframe id="main" name="main" src="main.php" frameborder="0" style="display:block;padding-top:0px;padding:0;margin:0;width:100%;border:0;" scrolling="auto"></iframe>');
			}
			top.frames.main.location.href = url;
		},
		intval:function( mixed_var, base ) {
			var tmp;
			if( typeof( mixed_var ) == 'string' ){
				tmp = parseInt(parseFloat(mixed_var));
				if(isNaN(tmp)){
					return 0;
				} else{
					return parseInt(tmp.toString(base || 10));
				}
			} else if( typeof( mixed_var ) == 'number' ){
				return parseInt(parseFloat(mixed_var));
			} else{
				return 0;
			}
		},
		timenow_server:0,
		timenow_server_zone:0,
		timenow_server_timer:false,
		timenow:function(){
			if( this.timenow_server == 0 ) {
				return parseInt( new Date().getTime()/1000 );
			}else{
				return this.timenow_server;
			}
		},
		timeOut:function($ttm,tp1sec) {	
			var $out = '';
			$time_still = $ttm;
			$tmp = Math.floor($time_still/2592000);
			$id=0;
			if ($tmp > 0) { 
				$id++;
				if ($id < 3) {$out += $tmp+" мес. ";}
				$time_still = $time_still-$tmp*2592000;
			}
			$tmp = Math.floor($time_still/86400);
			if ($tmp > 0) { 
				$id++;
				if ($id<3) {$out += $tmp+" дн. ";}
				$time_still = $time_still-$tmp*86400;
			}
			$tmp = Math.floor($time_still/3600);
			if ($tmp > 0) { 
				$id++;
				if ($id<3) {$out += $tmp+" ч. ";}
				$time_still = $time_still-$tmp*3600;
			}
			$tmp = Math.floor($time_still/60);
			if ($tmp > 0) { 
				$id++;
				if ($id<3) {$out += $tmp+" мин. ";}
				$time_still = $time_still-$tmp*60;
			}
			if( tp1sec != undefined ) {
				$tmp = Math.floor($time_still/1);			
				$out += $tmp+" сек. ";
			}else{
				if($out=='') {
					if($time_still<0)
					{
						$time_still = 0;
					}
					$out = $time_still+' сек.';
				}
			}
			return this.trim($out);
		},
		tmcount:parseInt( new Date().getTime()/1000 ),
		timenow_server_start:0,
		startServerTime:function(val,val2) {
			if( this.timenow_server_timer == false ) {
				this.timenow_server = val;
				this.timenow_server_start = val;
				this.timenow_server_zone = val2;
				this.timenow_server_timer = setInterval(function(){
					_bk.timenow_server = _bk.timenow_server_start + ( parseInt( new Date().getTime()/1000 ) - _bk.tmcount );
				},1000);
			}
		},
		data:function(format,UNIX_timestamp){
			if(UNIX_timestamp == null) {
				UNIX_timestamp = this.timenow();
			}
			UNIX_timestamp = this.intval(UNIX_timestamp);
			UNIX_timestamp += ((new Date().getTimezoneOffset()) - this.timenow_server_zone)*60;		
			var a = new Date(UNIX_timestamp*1000);
			var months = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
			var year = a.getFullYear();
			var month = a.getMonth();
			var date = a.getDate();
			var hour = a.getHours();
			var min = a.getMinutes();
			var sec = a.getSeconds();
			var wwdate = a.getDay();
			var time = format;
			month += 1;
			if(date < 10) {
				date = '0'+date;
			}
			if(month < 10) {
				month = '0'+month;
			}
			if(hour < 10) {
				hour = '0'+hour;
			}
			if(min < 10) {
				min = '0'+min;
			}
			if(sec < 10) {
				sec = '0'+sec;
			}
			time = this.str_replace('d',''+date,time);
			time = this.str_replace('m',''+month,time);
			time = this.str_replace('Y',''+year,time);
			time = this.str_replace('H',''+hour,time);
			time = this.str_replace('i',''+min,time);
			time = this.str_replace('s',''+sec,time);
			time = this.str_replace('w',''+wwdate,time);
			return time;
		},
		trim:function(s) {
		  return this.rtrim(this.ltrim(s));
		},
		ltrim:function(s) {
		  return s.replace(/^\s+/, ''); 
		},
		rtrim:function(s) {
		  return s.replace(/\s+$/, ''); 
		},
		str_replace:function ( search, replace, subject ) {
			if(!(replace instanceof Array)){
				replace=new Array(replace);
				if(search instanceof Array){
					while(search.length>replace.length){
						replace[replace.length]=replace[0];
					}
				}
			}
			if(!(search instanceof Array))search=new Array(search);
			while(search.length>replace.length){
				replace[replace.length]='';
			}
			if(subject instanceof Array){
				for(k in subject){
					subject[k]=str_replace(search,replace,subject[k]);
				}
				return subject;
			}
			for(var k=0; k<search.length; k++){
				var i = subject.indexOf(search[k]);
				while(i>-1){
					subject = subject.replace(search[k], replace[k]);
					i = subject.indexOf(search[k],i);
				}
			}
			return subject;
		},
		loginLook:function(id,login,level,clan,align,type) {
			var r = '';
			if( align != 0 ) {
				r += '<img src="http://img.likebk.com/i/align/align'+align+'.gif" width="12" height="15">';
			}
			if( clan != 0 ) {
				r += '<img src="http://img.likebk.com/i/clan/'+clan+'.gif" width="24" height="15">';
			}
			if( type == 2 ) {
				r += '<b>'+login+'</b>';
			}else{
				r += '<a class="cp">'+login+'</a>';
			}
			r += ' ['+level+']';
			r += '<a href="/inf.php?'+id+'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif" width="12" height="11" title="Инф. о '+login+'"></a>';
			return r;
		},
		userMyHpMp:function(id,hpNow,hpAll,mpNow,mpAll) {
			var html = '';

			if( mpAll > 0 ) {
				var shp = [ 
					'hp_mp',
					120 * Math.floor( mpNow / mpAll )
				];
				
				html += '<div id="vmp'+id+'" title="Уровень жизни" align="left" class="seemp" style="position:absolute; top:10px; width:120px; height:10px; z-index:12;"> '+Math.floor(mpNow)+'/'+(0+mpAll)+'</div>';
				
				html += '<div title="Уровень маны" class="hpborder" style="position:absolute; top:10px; width:120px; height:9px; z-index:13;"><img src="http://img.likebk.com/1x1.gif" height="9" width="1"></div>';
				
				html += '<div class="'+shp[0]+' senohp" style="height:9px; width:'+shp[1]+'px; position:absolute; top:10px; z-index:11;" id="lmp'+id+'"><img src="http://img.likebk.com/1x1.gif" height="9" width="1"></div>';
				
				html += '<div title="Уровень маны" class="hp_none" style="position:absolute; top:10px; width:120px; height:10px; z-index:10;"><img src="http://img.likebk.com/1x1.gif" height="10"></div>';

			}
						
			shp = [ 
				'hp_1',
				120 * Math.floor( hpNow / hpAll )
			];
			if(shp[1]>0){  shp[0] = 'hp_1'; }
			if(shp[1]>32){ shp[0] = 'hp_2'; }
			if(shp[1]>65){ shp[0] = 'hp_3'; }
			
			html += '<div id="vhp'+id+'" title="Уровень жизни" align="left" class="seehp" style="position:absolute; top:0px; width:120px; height:10px; z-index:12;"> '+Math.floor(hpNow)+'/'+(0+hpAll)+'</div>';
			
			html += '<div title="Уровень жизни" class="hpborder" style="position:absolute; top:0px; width:120px; height:9px; z-index:13;"><img src="http://img.likebk.com/1x1.gif" height="9" width="1"></div>';
			
			html += '<div class="'+shp[0]+' senohp" style="height:9px; width:'+shp[1]+'px; position:absolute; top:0px; z-index:11;" id="lhp'+id+'"><img src="http://img.likebk.com/1x1.gif" height="9" width="1"></div>';
			
			html += '<div title="Уровень жизни" class="hp_none" style="position:absolute; top:0px; width:120px; height:10px; z-index:10;"><img src="http://img.likebk.com/1x1.gif" height="10"></div>';
			
			html = '<div style="position:relative;">'+html+'</div>';
			
			var regennow = 1;
			var mpRegen = 10;
			var hpRegen = 10;
			
			html += '<script>startHpRegen("top",'+id+','+Math.floor(hpNow)+','+Math.floor(hpAll)+','+Math.floor(mpNow)+','+Math.floor(mpAll)+',0,0,'+Math.floor(hpRegen)+','+Math.floor(mpRegen)+','+regennow+');</script>';
			
			return html;
		},
		itemsversionglobal:0,
		newInfo:function(data) {

			if( data.itemsversionglobal != undefined ) {
				_bk.itemsversionglobal = data.itemsversionglobal;
			}

			var us = ['level','align','clan','obraz','sex'];
			var i = 0;
			while( i != -1 ) {
				if( us[i] != undefined ) {
					_bk.user.info[us[i]] = data.info[i];
				}else{
					i = -2;
				}
				i++;
			}
			
			_bk.user.stats.hpNow = data.stats.hp[0];
			_bk.user.stats.hpAll = data.stats.hp[1];
			_bk.user.stats.hpReg = data.stats.hp[2];
			
			_bk.user.stats.mpNow = data.stats.mp[0];
			_bk.user.stats.mpAll = data.stats.mp[1];
			_bk.user.stats.mpReg = data.stats.mp[2];	
			
			_bk.user.global = data;
			
			_bk.vespers = data.aves;
			_bk.pagesitems = data.pages_all;	
			
			if( _bk.mod != undefined ) {
				_bk.mod.module.inventory.pg = _bk.pagesitems[1];
				_bk.mod.module.inventory.rz = _bk.pagesitems[2];
			}
			
			//$.cookie('liid',_bk.user.data.items_lastID);
			
		},
		vespers:[],
		pagesitems:0,
		itmInfoFx:function(itm,itm_usr) {
			
			
			var r = '<b>'+itm.name+'</b>';
			var po = _bk.mod.module.inventory.takeStats(itm_usr.data);
			
										if( po.upatack_lvl != undefined ) {
											r += ' <b>+' + po.upatack_lvl + '</b>';
										}
										
										r += '<br>Долговечность: '+Math.floor(itm_usr.iznosNOW)+'/'+Math.floor(itm_usr.iznosMAX)+'';
										
										//Действует на
										var tr = '';
										var j = 0;
										var addbron = '';
										var brnnamez = ['','головы','корпуса','пояса','ног'];
										while( j != -1 ) {
											if( _bk.items.add[j] != undefined ) {
												if( po['add_'+_bk.items.add[j]] != undefined ) {
													if(
														_bk.items.add[j] != 'mib1' && _bk.items.add[j] != 'mib2' && _bk.items.add[j] != 'mib3' && _bk.items.add[j] != 'mib4'
														&&
														_bk.items.add[j] != 'mab1' && _bk.items.add[j] != 'mab2' && _bk.items.add[j] != 'mab3' && _bk.items.add[j] != 'mab4'
													) {
														var addval = po['add_'+_bk.items.add[j]];
														if( po['upartitm'] != undefined ) {
															addval = parseInt(addval) + Math.floor(addval/100*(po['upartitm']*10));
														}
														if( addval > 0 ) {
															addval = '+'+addval;
														}
														tr += '<br><span>&bull; '+_bk.is[_bk.items.add[j]]+'</span>: ' + addval;
													}else{
														var bi = 1;
														while(bi <= 4) {
															if( _bk.items.add[j] == 'mib'+bi ) {
																addbron += '<br><span>&bull; Броня '+brnnamez[bi]+'</span>: ' + po['add_mib'+bi] + '-' + po['add_mab'+bi];
															}
															bi++;
														}
													}
												}
												if( po['sv_'+_bk.items.add[j]] != undefined ) {
													if( _bk.items.add[j] == 'yron_max' ) {
	
													}else if( _bk.items.add[j] == 'yron_min' ) {
														var addval = po['sv_yron_min']+'-'+po['sv_yron_max'];
														tr += '<br><span>&bull; Урон</span>: ' + addval;
													}else{
														var addval = po['sv_'+_bk.items.add[j]];
														if( po['upartitm'] != undefined ) {
															addval = parseInt(addval) + Math.floor(addval/100*(po['upartitm']*10));
														}
														if( addval > 0 ) {
															addval = '+'+addval;
														}
														tr += '<br><span>&bull; '+_bk.is[_bk.items.add[j]]+'</span>: ' + addval;
													}
												}
											}else{
												j = -2;
											}
											j++;
										}
										r += tr+addbron;
										//
										//
										var tr = '';
										if( po['upartitm'] != undefined ) {
											tr += '<br>• Уровень усиления: '+po['upartitm']+' (+'+(po['upartitm']*10)+'%)';
										}
										if( po.rune != undefined && po.rune > 0 ) {
											tr += '<br>&bull; Руна: '+decodeBytes(po.rune_name,'cp1251')+'';
										}
										//
										if( po.spell != undefined && po.spell > 0 ) {
											tr += '<br>&bull; '+_bk.is[po.spell_st_name]+': +'+po.spell_st_val+'';
										}
										if( tr != '' ) {
											r += '<br><b>Улучшения предмета:</b>'+tr;
										}
										//
										//
										if( itm.info != '' ) {
											r += '<br><small><b>Описание:</b>';
											r += '<br><i>'+itm.info+'</i></small>';
										}									
										//
										if( po.noremont != undefined ) {
											r += '<br><small><font color=maroon >Предмет не подлежит ремонту</font></small>';	
										}
										if( po.frompisher != undefined ) {
											r += '<br><small><font color=maroon >Предмет из подземелья</font></small>';	
										}
										
			return r;
		},
		userMy:function(data) {
			var html = '';
			
			var witm = {
				0: '<img src="http://img.likebk.com/i/slot_bottom1.gif" width="120" height="40">',
				8: '<img src="http://img.likebk.com/i/items/w/w1.gif" width="60" height="20" title="Пустой слот серьги">',
				9: '<img src="http://img.likebk.com/i/items/w/w2.gif" width="60" height="20" title="Пустой слот ожерелье">',
				3: '<img src="http://img.likebk.com/i/items/w/w3.gif" width="60" height="60" title="Пустой слот оружие (правая рука)">',
				4: '',
				5: '<img src="http://img.likebk.com/i/items/w/w4.gif" width="60" height="80" title="Пустой слот броня">',
				6: '',
				7: '<img src="http://img.likebk.com/i/items/w/w5.gif" width="60" height="40" title="Пустой слот пояс">',
				10: '<img src="http://img.likebk.com/i/items/w/w6.gif" width="20" height="20" title="Пустой слот кольцо">',
				11: '<img src="http://img.likebk.com/i/items/w/w6.gif" width="20" height="20" title="Пустой слот кольцо">',
				12: '<img src="http://img.likebk.com/i/items/w/w6.gif" width="20" height="20" title="Пустой слот кольцо">',
				1: '<img src="http://img.likebk.com/i/items/w/w9.gif" width="60" height="60" title="Пустой слот шлем">',
				14:'<img src="http://img.likebk.com/i/items/w/w10.gif" width="60" height="60" title="Пустой слот щит (левая рука)">',
				13:'<img src="http://img.likebk.com/i/items/w/w11.gif" width="60" height="40" title="Пустой слот перчатки">',
				17:'<img src="http://img.likebk.com/i/items/w/w12.gif" width="60" height="40" title="Пустой слот ботинки">',
				2:'<img src="http://img.likebk.com/i/items/w/w13.gif" width="60" height="40" title="Пустой слот наручи">',
				16:'<img src="http://img.likebk.com/i/items/w/w19.gif" width="60" height="80" title="Пустой слот поножи">',
				
				53:'<img src="http://img.likebk.com/i/items/w/w15.gif">',
				54:'<img src="http://img.likebk.com/i/items/w/w15.gif">',
				55:'<img src="http://img.likebk.com/i/items/w/w15.gif">',
				
				59:'<img src="http://img.likebk.com/i/items/w/w83.gif">',
				60:'<img src="http://img.likebk.com/i/items/w/w83.gif">',
				61:'<img src="http://img.likebk.com/i/items/w/w83.gif">',
				62:'<img src="http://img.likebk.com/i/items/w/w83.gif">',
				
				63:'<img width="60" height="60" style="margin-left:8px;margin-top:4px;display:block;" title="Пустой слот руны" src="http://img.likebk.com/rune_none.png">',
				64:'<img width="60" height="60" style="margin-left:8px;margin-top:4px;display:block;" title="Пустой слот руны" src="http://img.likebk.com/rune_none.png">',
				66:'<img width="60" height="60" style="margin-left:8px;margin-top:4px;display:block;" title="Пустой слот руны" src="http://img.likebk.com/rune_none.png">'
			};
			var i = 40;
			while( i <= 52 ) {
				witm[i] = '<img src="http://img.likebk.com/i/items/w/w101.gif" width="40" height="25" title="Пустой слот заклинание">';
				i++;
			}
			
			var i = 0;
			var jh = [];
			while( i != -1 ) {
				if( data.items[i] != undefined ) {
					if( data.items[i].inOdet > 0 && witm[data.items[i].inOdet] != undefined ) {
						var itm = _bk.user.data.items_main[data.items[i].item_id];
						var itmd = '';
						
						var itminfo = this.itmInfoFx(itm,data.items[i]);
						
						jh[itm.inslot] = [itminfo,itm.img,data.items[i].id];
						
						if( itm.inslot == 63 ) {
							itmd += '<img style="margin-left:-2px;margin-top:8px;display:block;" class="cp" onclick="_bk.mod.module.inventory.snatItem('+data.items[i].id+',true);" onMouseOver="top.hi(this,\''+itminfo+'\',event,3,0,1,4,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/i/items/'+itm.img+'">';
						}else{
							itmd += '<span class="cp" onclick="_bk.mod.module.inventory.snatItem('+data.items[i].id+',true);" onMouseOver="top.hi(this,\''+itminfo+'\',event,3,0,1,4,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();">';
							itmd += '<img src="http://img.likebk.com/i/items/'+itm.img+'">';
							itmd += '</span>';
						}
						
						witm[data.items[i].inOdet] = itmd;
					}
				}else{
					i = -2;
				}
				i++;
			}
			
			//связка венок, шлем
			var title1 = '';
			var img1 = '';
			var id1 = 0;
			if( jh[1] != undefined ) { //венок
				title1 = jh[1][0];
				img1 = jh[1][1];
				id1 = jh[1][2];
			}
			if( jh[52] != undefined ) { //шлем
				if( title1 != '' ) {
					jh[52][0] += '<hr>';
				}
				title1 = jh[52][0] + title1;
				img1 = jh[52][1];
				id1 = jh[52][2];
			}
			if( title1 != '' ) {
				witm[1] = '<span class="cp" onclick="_bk.mod.module.inventory.snatItem('+id1+',true);" onMouseOver="top.hi(this,\''+title1+'\',event,3,0,1,4,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();">';
				witm[1] += '<img src="http://img.likebk.com/i/items/'+img1+'">';
				witm[1] += '</span>';
			}
			
			//связка плащ,броня,рубаха
			var title5 = '';
			var img5 = '';
			var id5 = 0;
			if( jh[4] != undefined ) { //рубаха
				title5 = jh[4][0];
				img5 = jh[4][1];
				id5 = jh[4][2];
			}
			if( jh[5] != undefined ) { //броня
				if( title5 != '' ) {
					jh[5][0] += '<hr>';
				}
				title5 = jh[5][0] + title5;
				img5 = jh[5][1];
				id5 = jh[5][2];
			}
			if( jh[6] != undefined ) { //плащ
				if( title5 != '' ) {
					jh[6][0] += '<hr>';
				}
				title5 = jh[6][0] + title5;
				img5 = jh[6][1];
				id5 = jh[6][2];
			}
			if( title5 != '' ) {
				witm[5] = '<span class="cp" onclick="_bk.mod.module.inventory.snatItem('+id5+',true);" onMouseOver="top.hi(this,\''+title5+'\',event,3,0,1,4,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();">';
				witm[5] += '<img src="http://img.likebk.com/i/items/'+img5+'">';
				witm[5] += '</span>';
			}
			
			var runes = '<table width="240" border="0" cellspacing="0" cellpadding="0">'+
							  '<tr>'+
								 '<td width="60" height="60">'+witm[59]+'</td>'+
								 '<td width="60">'+witm[60]+'</td>'+
								 '<td width="60">'+witm[61]+'</td>'+
								 '<td width="60">'+witm[62]+'</td>'+
							  '</tr>'+
							'</table>';
			
			runes += '<table background="http://img.likebk.com/rune_bg.png" width="240" border="0" cellspacing="0" cellpadding="0">'+
							  '<tr>'+
								 '<td width="80" height="80">'+witm[63]+'</td>'+
								 '<td width="80">'+witm[66]+'</td>'+
								 '<td width="80">'+witm[64]+'</td>'+
							  '</tr>'+
							'</table>';
			
			witm[0] = '<table width="100%" border="0" cellspacing="0" cellpadding="0">'+
					  '<tr>'+
						'<td>'+witm[53]+'</td>'+
						'<td>'+witm[55]+'</td>'+
						'<td>'+witm[54]+'</td>'+
					  '</tr>'+
					  '<tr>'+
						'<td><img src="http://img.likebk.com/i/items/w/w20.gif"></td>'+
						'<td><img src="http://img.likebk.com/i/items/w/w20.gif"></td>'+
						'<td><img src="http://img.likebk.com/i/items/w/w20.gif"></td>'+
					  '</tr>'+
					'</table>';
			
			html += '<div style="box-shadow: 1px 1px 7px 0px #000000; width:240px; padding:2px; border-bottom:1px solid #666666; border-right:1px solid #666666; border-left:1px solid #FFFFFF; border-top:1px solid #FFFFFF;">';
			html += '<table width="240" border="0" cellspacing="0" cellpadding="0">'+
					  '<tr>'+
						'<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
						  '<tr>'+
							'<td width="60" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
							  '<tr>'+
								'<td width="60" height="60">'+witm[1]+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">'+witm[2]+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="60">'+witm[3]+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="80">'+witm[5]+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">'+witm[7]+'</td>'+
							  '</tr>'+
							'</table></td>'+
							'<td width="120" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
							  '<tr>'+
								'<td width="120" height="20" valign="top">'+this.userMyHpMp(data.id,data.hpNow,data.hpAll,data.mpNow,data.mpAll)+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="120" height="220" align="left" valign="top" style="background-image:url(\'http://img.likebk.com/i/obraz/'+data.sex+'/'+data.obraz+'\');">'+this.myEff()+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="120" height="40">'+witm[0]+'</td>'+
							  '</tr>'+
							'</table></td>'+
							'<td width="60" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
							  '<tr>'+
								'<td width="60" height="60"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
								  '<tr>'+
									'<td width="60" height="20">'+witm[8]+'</td>'+
								  '</tr>'+
								  '<tr>'+
									'<td width="60" height="20">'+witm[9]+'</td>'+
								  '</tr>'+
								  '<tr>'+
									'<td width="60" height="20">'+witm[10]+''+witm[11]+''+witm[12]+'</td>'+
								  '</tr>'+
								'</table></td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">'+witm[13]+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="60">'+witm[14]+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="80">'+witm[16]+'</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">'+witm[17]+'</td>'+
							  '</tr>'+
							'</table></td>'+
						  '</tr>'+
						'</table></td>'+
					  '</tr>'+
					  '<tr>'+
						'<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
						  '<tr>'+
							'<td width="40" height="25" align="center" valign="middle">'+witm[40]+'</td>'+
							'<td width="40" align="center" valign="middle">'+witm[41]+'</td>'+
							'<td width="40" align="center" valign="middle">'+witm[42]+'</td>'+
							'<td width="40" align="center" valign="middle">'+witm[43]+'</td>'+
							'<td width="40" align="center" valign="middle">'+witm[44]+'</td>'+
							'<td width="40" height="25" align="center" valign="middle">'+witm[45]+'</td>'+
						  '</tr>'+
						  '<tr>'+
							'<td width="40" height="25" align="center" valign="middle">'+witm[46]+'</td>'+
							'<td align="center" valign="middle">'+witm[47]+'</td>'+
							'<td align="center" valign="middle">'+witm[48]+'</td>'+
							'<td align="center" valign="middle">'+witm[49]+'</td>'+
							'<td align="center" valign="middle">'+witm[50]+'</td>'+
							'<td width="40" height="25" align="center" valign="middle">'+witm[51]+'</td>'+
						  '</tr>'+
						'</table></td>'+
					  '</tr>'+
					  '<tr>'+
						'<td height="60" align="center" valign="middle">'+runes+'</td>'+
					  '</tr>'+
					'</table>';
			html += '</div>';
		
			return html;
		},
		getEff:function(id) {
			var r = false;
			var i = 0;
			while( i != -1 ) {
				if( _bk.user.data.eff_main[i] != undefined ) {
					if( _bk.user.data.eff_main[i].id2 == id ) {
						r = _bk.user.data.eff_main[i];
						i = -2;
					}
				}else{
					i = -2;
				}
				i++;
			}
			return r;
		},
		myEff:function() {
			var r = '';
			
			var i = 0;
			while( i != -1 ) {
				if( _bk.user.global.stats.eff_users[i] != undefined ) {
					if( _bk.user.global.stats.eff_users[i][4] == 0 && _bk.user.global.stats.eff_users[i][3] - _bk.timenow() > 0 && _bk.user.global.stats.eff_users[i][1] == 435 ) {
						_bk.user.global.stats.eff_users[i][4] = _bk.user.global.stats.eff_users[i][3];
					}
					if( _bk.user.global.stats.eff_users[i][2] == 'VIP' ) {
						var effdata = '<b>VIP Аккаунт</b>';
						if( _bk.user.global.stats.eff_users[i][6] == 2 ) {
							effdata += '<br>Мощность урона(%): +10<br>Мощность магии(%): +10';
						}
						r += '<img width="28" height="17" style="padding:1px" onMouseOver="top.hi(this,\''+effdata+'\',event,3,0,1,4,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/i/eff/aprem1.gif">';
					}else if( _bk.user.global.stats.eff_users[i][4] - _bk.timenow() > 0  ) {
						var eff = this.getEff(_bk.user.global.stats.eff_users[i][1]);
						
						var po = _bk.user.global.stats.eff_users[i][6];
							po = _bk.mod.module.inventory.takeStats(po);
						var effdata = '';
						
						var tr = '';
						var j = 0;
						var addbron = '';
						var brnnamez = ['','головы','корпуса','пояса','ног'];
						while( j != -1 ) {
							if( _bk.items.add[j] != undefined ) {
								if( po['add_'+_bk.items.add[j]] != undefined ) {
									if(
										_bk.items.add[j] != 'mib1' && _bk.items.add[j] != 'mib2' && _bk.items.add[j] != 'mib3' && _bk.items.add[j] != 'mib4'
										&&
										_bk.items.add[j] != 'mab1' && _bk.items.add[j] != 'mab2' && _bk.items.add[j] != 'mab3' && _bk.items.add[j] != 'mab4'
									) {
										var addval = po['add_'+_bk.items.add[j]];
										if( addval > 0 ) {
											addval = '+'+addval;
										}
										tr += '<br>&bull; '+_bk.is[_bk.items.add[j]]+': ' + addval;
									}else{
										var bi = 1;
										while(bi <= 4) {
											if( _bk.items.add[j] == 'mib'+bi ) {
												addbron += '<br>&bull; Броня '+brnnamez[bi]+': ' + po['add_mib'+bi] + '-' + po['add_mab'+bi];
											}
											bi++;
										}
									}
								}
							}else{
								j = -2;
							}
							j++;
						}
						
						var effinfo = '<u><b>'+eff.mname+'</b></u><br>';
						effinfo += 'Осталось: ';
						r += '<img width="28" height="17" style="padding:1px" onMouseOver="top.hi(this,\''+effinfo+'\' + _bk.timeOut( '+_bk.user.global.stats.eff_users[i][4]+' - _bk.timenow() ) + \''+tr+addbron+'\',event,3,0,1,4,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/i/eff/'+eff.img+'">';
					}
				}else{
					i = -2;
				}
				i++;
			}
			
			return r;
		},
		userUser:function(data) {
			var html = '';
			
			html += '<table width="240" border="0" cellspacing="0" cellpadding="0">'+
					  '<tr>'+
						'<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
						  '<tr>'+
							'<td width="60" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
							  '<tr>'+
								'<td width="60" height="60">&nbsp;</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">&nbsp;</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="60">&nbsp;</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="80">&nbsp;</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">&nbsp;</td>'+
							  '</tr>'+
							'</table></td>'+
							'<td width="120" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
							  '<tr>'+
								'<td width="120" height="20"></td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="120" height="220" align="left" valign="top">&nbsp;</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">&nbsp;</td>'+
							  '</tr>'+
							'</table></td>'+
							'<td width="60" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
							  '<tr>'+
								'<td width="60" height="60"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
								  '<tr>'+
									'<td width="60" height="20"></td>'+
								  '</tr>'+
								  '<tr>'+
									'<td width="60" height="20"></td>'+
								  '</tr>'+
								  '<tr>'+
									'<td width="60" height="20"></td>'+
								  '</tr>'+
								'</table></td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">&nbsp;</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="60">&nbsp;</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="80">&nbsp;</td>'+
							  '</tr>'+
							  '<tr>'+
								'<td width="60" height="40">&nbsp;</td>'+
							  '</tr>'+
							'</table></td>'+
						  '</tr>'+
						'</table></td>'+
					  '</tr>'+
					  '<tr>'+
						'<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">'+
						  '<tr>'+
							'<td width="40" height="25" align="center" valign="middle">&nbsp;</td>'+
							'<td width="40" align="center" valign="middle">&nbsp;</td>'+
							'<td width="40" align="center" valign="middle">&nbsp;</td>'+
							'<td width="40" align="center" valign="middle">&nbsp;</td>'+
							'<td width="40" align="center" valign="middle">&nbsp;</td>'+
							'<td width="40" height="25" align="center" valign="middle">&nbsp;</td>'+
						  '</tr>'+
						  '<tr>'+
							'<td width="40" height="25" align="center" valign="middle">&nbsp;</td>'+
							'<td align="center" valign="middle">&nbsp;</td>'+
							'<td align="center" valign="middle">&nbsp;</td>'+
							'<td align="center" valign="middle">&nbsp;</td>'+
							'<td align="center" valign="middle">&nbsp;</td>'+
							'<td width="40" height="25" align="center" valign="middle">&nbsp;</td>'+
						  '</tr>'+
						'</table></td>'+
					  '</tr>'+
					  '<tr>'+
						'<td align="center" valign="middle">&nbsp;</td>'+
					  '</tr>'+
					'</table>';
			
			return html;
		}
	};
//}