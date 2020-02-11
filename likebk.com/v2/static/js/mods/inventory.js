var modx = {
	'name':'inventory'
};

_bk.mod.module[modx.name] = {
	modx:{ },
	start:function() {
		//if( top.c.battle > 0 ) {
			
		//}else{
			//this.getMainHtml(1);
			//this.refItemsOnline('stat=true');
			_bk.user.data.items = [];
			this.refItemsOnline('actdata=true&otdel='+this.rz+'&page='+this.pg);
		//}
	},
	maxves:function() {
		var r = 0;
		//$r['max'] = 40+($this->stats['os7']*10)+$this->stats['s4']+$this->stats['maxves']+$this->stats['s1']*4;
		r += 40;
		r += _bk.user.global.stats.os7 * 10;
		r += _bk.user.global.stats.s4;
		r += _bk.user.global.stats.maxves;
		r += _bk.user.global.stats.s1 * 4;		
		return r;
	},
	getMainX:0,
	getMainHtml:function(pg) {
		var r = '';
		if( this.massa == -12345 ) {
			this.rzitemx();
		}
		this.getMainX++;
		var adm2 = '';
		if( _bk.user.info.admin > 0 ) {
			adm2 += '<br>Update Version: '+this.getMainX+'.'+_bk.user.data.items_lastID+'';
		}
		r += '<table id="newInvDatas" width="100%" border="0" cellspacing="0" cellpadding="5">'+
				  '<tr>'+
					'<td width="260" style="padding-top:10px" align="center" valign="top">'+this.userInfo()+'<br>'+this.userPriems()+''+this.userKolodec()+'</td>'+
					'<td width="330" valign="top">'+_bk.locStats(0)+'</td>'+
					'<td valign="top"><table style="margin-top:5px;" width="100%" border="0" cellspacing="0" cellpadding="0">'+
					  '<tr>'+
						'<td align="right">'+this.getLinksTop()+'<div align="left" class="inv_error" style="color:red;">'+_bk.mod.module.inventory.error+'</div></td>'+
						'</tr>'+
					  '<tr>'+
						'<td>'+this.getMenuTop()+'</td>'+
					  '</tr>'+
					  '<tr>'+
						'<td bgcolor="#a4a4a4" style="padding:3px;" valign="middle">'+
							//'<div class="fl"><b>Масса: '+this.massa+' / '+this.maxves()+'</b>'+adm2+'</div>'+
							'<div class="fl"><b>Масса: '+_bk.vespers[0]+' / '+_bk.vespers[1]+'</b>'+adm2+'</div>'+
							'<div class="fr">'+this.filterBlock()+'</div>'+
						'</td>'+
					  '</tr>'+
					  '<tr>'+
						'<td style="border:1px solid #a4a4a4;">'+this.getInvData()+'</td>'+
					  '</tr>'+
					'</table></td>'+
				  '</tr>'+
				'</table>';
		_bk.mod.html(r);
		//_bk.mod.module.inventory.error = '';
	},
	
	filterText:'',
	filterBlock:function() {
		var r = '';
		
		r += 'Поиск по имени: <div style="display:inline-block;position:relative;">';
			r += '<input placeholder="Введите название предмета..." style="width:200px" type="text" id="filterInv" value="'+this.filterText+'">';
			r += '<img onclick="_bk.mod.module.inventory.filterText=\'\';_bk.mod.module.inventory.getRzOnlineRef();" class="cp" style="position:absolute;right:17px;top:3px;" title="Очистить фильтр" width="13" height="13" src="http://img.likebk.com/i/clear.gif">';
			r += '&nbsp; &nbsp;';
		r += '</div>';
		r += '<input onclick="_bk.mod.module.inventory.filterText=$(\'#filterInv\').val();_bk.mod.module.inventory.getRzOnlineRef();" style="padding-top:0;padding-bottom:0" type="button" value="Фильтр">';
		r += '&nbsp;';
		
		return r;
	},
	userKolodec:function() {
		var r = '';
		
		if( _bk.user.info.align > 0 && _bk.user.info.align != 2 ) {
			//
			r += '<br><div align="center">';
				r += '<h3 style="padding-bottom: 5px; margin-bottom: 5px;">';
					r += '<img style="margin-right: 5px;" src="/images/healvortex.gif" />';
					r += '<span style="top: -5px;position: relative;">Колодец Жизни</span>';
				r += '</h3>';
				r += '<div id="btn_kolodec1">';
					//
					if( (_bk.user.global.stats.times[2]-_bk.user.global.stats.times[0]) < 1 ) {
						r += '<a class="cp" onclick="alert(\'Закончился запас колодца здоровье. Он обновится в 00:00 по серверу!\'); return false;" style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;" href="">Восстановить HP.</a>';
						r += '<br><small>Осталось '+(_bk.user.global.stats.times[2]-_bk.user.global.stats.times[0])+' HP</small>';
					}else{
						r += '<a class="cp" onclick="_bk.mod.module.inventory.refItemsOnline(\'kolodec1\'); return false;">Восстановить HP.</a>';
						r += '<br><small>Осталось '+(_bk.user.global.stats.times[2]-_bk.user.global.stats.times[0])+' HP</small>';
					}
					//
				r += '</div>';
			r += '</div>';
			//
			r += '<br><div align="center">';
				r += '<h3 style="padding-bottom: 5px; margin-bottom: 5px;">';
					r += '<img style="margin-right: 5px;" src="/images/manavortex.gif" />';
					r += '<span style="top: -5px;position: relative;">Колодец Маны</span>';
				r += '</h3>';
				r += '<div id="btn_kolodec2">';
					//
					if( (_bk.user.global.stats.times[2]-_bk.user.global.stats.times[1]) < 1 ) {
						r += '<a class="cp" onclick="alert(\'Закончился запас колодца маны. Он обновится в 00:00 по серверу!\'); return false;" style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;" href="">Восстановить MP.</a>';
						r += '<br><small>Осталось '+(_bk.user.global.stats.times[2]-_bk.user.global.stats.times[1])+' MP</small>';
					}else{
						r += '<a class="cp" onclick="_bk.mod.module.inventory.refItemsOnline(\'kolodec2\'); return false;">Восстановить MP.</a>';
						r += '<br><small>Осталось '+(_bk.user.global.stats.times[2]-_bk.user.global.stats.times[1])+' MP</small>';
					}
					//
				r += '</div>';
			r += '</div>';
			//
		}
		
		return r;
	},
	userPriems:function() {
		var r = '';
		var i = 0 , j = 0;
		var pr = _bk.user.global.stats.priems.split('|');
		while( i != -1 ) {
			if( pr[i] != undefined ) {
				if( _bk.intval( _bk.user.global.stats.priemsx ) > i ) {
					j++;
					if( pr[i] == 0 ) {
						var prm = {
							'name':'Пустой слот приема'
						};
						var img = 'http://img.likebk.com/i/items/w/clearPriem.gif';
					}else{
						var prm = _bk.user.data.priems_main[pr[i]];
						var img = 'http://img.likebk.com/i/eff/'+prm.img+'.gif';
					}
					r += '<img style="padding:1px;" title="'+prm.name+'" width="40" height="25" src="'+img+'">';
					if( j == 5 ) {
						r += '<br>';
						j = 0;
					}
				}
			}else{
				i = -2;
			}
			i++;
		}
		return '<a class="cp" onclick="_bk.oUrl(\'main.php?skills=1&rz=4\');">'+r+'</a>';
	},
	userInfo:function() {
		var r = '';
		
		r += '<div align="center" style="padding-bottom:10px">'+_bk.loginLook(_bk.user.info.id,_bk.user.info.login,_bk.user.info.level,_bk.user.info.clan,_bk.user.info.align,2)+'</div>';
		
		var data = {
			id: 	_bk.user.info.id,
			sex:	_bk.user.info.sex,
			obraz:	_bk.user.info.obraz,
			hpNow:	_bk.user.stats.hpNow,
			hpAll:	_bk.user.stats.hpAll,
			mpNow:	_bk.user.stats.mpNow,
			mpAll:	_bk.user.stats.mpAll,
			items:	_bk.user.data.items
		};
		
		r += _bk.userMy(data);
		
		return r;
	},
	itemMainDataAll:function() {
		var r = {};
		var i = 0 , j = 0;
		while( i <= 20000 ) {
			if( _bk.user.data.items_main[i] != undefined ) {
				r[_bk.user.data.items_main[i].id] = _bk.user.data.items_main[i];
			}
			i++;
		}
		r.okey = true;
		_bk.user.data.items_main = r;
	},
	itemMainData:function(id) {
		/*var r = {'no_id':id};
		var i = 0;
		while( i != -1 ) {
			if( _bk.user.data.items_main[i] != undefined ) {
				if( _bk.user.data.items_main[i].id == main ) {
					r = _bk.user.data.items_main[i];
					i = -2;
				}
			}else{
				i = -2;
			}
			i++;
		}*/
		if( _bk.user.data.items_main.okey == undefined ) {
			this.itemMainDataAll();
		}
		return _bk.user.data.items_main[id];
	},
	//
	slotItem:function(id) {
		var r = -1;
		var i = 0;
		while( i != -1 ) {
			if( _bk.user.data.items[i] != undefined ) {
				if( _bk.user.data.items[i].inOdet == id ) {
					r = i;
					i = -2;
				}
			}else{
				i = -2;
			}
			i++;
		}
		return r;
	},
	snatAllItem:function(ref) {
		var i = 0;
		while( i != -1 ) {
			if( _bk.user.data.items[i] != undefined ) {
				if( _bk.user.data.items[i].inOdet > 0 ) {
					_bk.user.data.items[i].inOdet = 0;
				}
			}else{
				i = -2;
			}
			i++;
		}
		if( ref == true ) {
			this.refItemsOnline('snatall=true');
		}
	},
	refItemsOnline:function(act,actlogin) {
		actold = act;
		if( actlogin != undefined ) {
			act += '&login='+$('#'+actlogin).val();
		}
		act += '&actdata=true&page='+this.pg+'&otdel='+this.rz+'&jsonData=true&itemsversionglobal='+_bk.itemsversionglobal;
		$.post('/v2/invAction/?liid='+_bk.user.data.items_lastID+'&'+act,{},function(data){
			data = $.parseJSON(data);
			if( data.error2 != undefined ) {
				//alert(data.error);
				_bk.mod.module.inventory.error = data.error2;
				$('#inv_error').html(data.error2);
				delete data.acterr;
			}
			if( data.error != undefined ) {
				alert(data.error);
				//_bk.mod.module.inventory.error = data.error;
				//$('#inv_error').html(data.error);
			}else{
				//
				/*if( data.stats != undefined ) {
					_bk.user.global = data;	
				}*/
				_bk.user.data.items = [];
				if( data.bonus != undefined ) {
					_bk.user.global.stats.auto[2] = data.bonus[0];
					//_bk.user.global.money[0] = data.bonus[1];
					//_bk.user.global.money[1] = data.bonus[2];
					var bns1 = _bk.bonusPers();
					if( bns1[0] == 2 ) {
						_bk.user.global.money[1] = parseFloat(_bk.user.global.money[1]) + parseFloat(bns1[1]);
						_bk.user.global.money[1] = _bk.user.global.money[1].toFixed(2);
					}else{
						_bk.user.global.money[0] = parseFloat(_bk.user.global.money[0]) + parseFloat(bns1[1]);
						_bk.user.global.money[0] = _bk.user.global.money[0].toFixed(2);
					}
				}
				if( data.jsonData != undefined ) {
					_bk.newInfo(data.jsonData);
					if( data.jsonData.itmupd != undefined ) {
						//
						if( data.jsonData.itemsversionglobalUpdate != undefined ) {
							_bk.user.data.items = [];
						}
						_bk.newItems(data.jsonData.itmupd);
					}
				}
				if( data.itemsupdate != undefined ) {
					_bk.mod.module.inventory.snatAllItem(false);
					var i = 0;
					while( i != -1 ) {
						if( data.itemsupdate[i] != undefined ) {
							var j = 0;
							while( j != -1 ) {
								if( _bk.user.data.items[j] != undefined ) {
									if( _bk.user.data.items[j].id == data.itemsupdate[i][0] ) {
										_bk.user.data.items[j].inOdet = data.itemsupdate[i][1];
									}
								}else{
									j = -2;
								}
								j++;
							}
						}else{
							i = -2;
						}
						i++;
					}
				}
				if( data.itmupd != undefined ) {
					_bk.newItems(data.itmupd);
				}
				if( data.infoupdate != undefined ) {
					_bk.newInfo(data.infoupdate);
				}
				//
				if( data.acterr != undefined ) {
					_bk.mod.module.inventory.error = data.acterr;
					$('#inv_error').html(data.acterr);
				}
				_bk.mod.module.inventory.getRz(_bk.mod.module.inventory.rz,_bk.mod.module.inventory.pg);
				//
			}
		});
	},
	error:'',
	snatItem:function(id,ref) {
		var i = 0;
		while( i != -1 ) {
			if( _bk.user.data.items[i] != undefined ) {
				if( _bk.user.data.items[i].id == id ) {
					if( _bk.user.data.items[i].inOdet == 0 ) {
						alert('Предмет не надет!');
					}else{
						this.pg = 1;
						var itm = this.itemMainData(_bk.user.data.items[i].item_id);
						_bk.uppositem(_bk.user.data.items[i].id);
						_bk.user.data.items[i].inOdet = 0;
						//_bk.mod.module.inventory.getRz(itm.inRazdel,1);
					}
					i = -2;
				}
			}else{
				i = -2;
			}
			i++;
		}
		if( ref == true ) {
			this.refItemsOnline('snat='+id);
		}
	},
	odetItem:function(id,ref) {
		var i = 0;
		while( i != -1 ) {
			if( _bk.user.data.items[i] != undefined ) {
				if( _bk.user.data.items[i].id == id ) {
					var itm = this.itemMainData(_bk.user.data.items[i].item_id);
					if( _bk.user.data.items[i].inOdet > 0 ) {
						alert('Предмет уже надет!');
					}else if( itm.inslot == 0 ) {
						alert('Предмет нельзя надеть!');
					}else{
						var inslot = itm.inslot;
						//
						var testslot = this.slotItem(inslot);
						if( testslot >= 0 ) {
							if( inslot == 63 ) {
								var testslot2 = this.slotItem(65);
								if( testslot2 == -1 ) {
									inslot = 65;
								}else{
									var testslot2 = this.slotItem(64);
									if( testslot2 == -1 ) {
										inslot = 64;
									}
								}
							}else if( inslot == 40 ) {
								var j = 40;
								while( j <= 52 ) {
									var testslot2 = this.slotItem(j);
									if( testslot == -1 ) {
										inslot = j;
										j = 52;
									}
									j++;
								}
							}else if( inslot == 3 && itm['2too'] > 0 ) {
								inslot = 14;
							}else if( inslot == 10 ) {
								var testslot2 = this.slotItem(12);
								if( testslot2 == -1 ) {
									inslot = 12;
								}else{
									var testslot2 = this.slotItem(11);
									if( testslot2 == -1 ) {
										inslot = 11;
									}
								}
							}
						}
						//
						if( itm['2h'] > 0 ) {
							var testslot = this.slotItem(14);
							if( testslot >= 0 ) {
								if( _bk.user.data.items[testslot] != undefined ) {
									this.snatItem(_bk.user.data.items[testslot].id);
								}
							}
						}
						//
						var testslot = this.slotItem(inslot);
						if( testslot >= 0 ) {
							if( _bk.user.data.items[testslot] != undefined ) {
								this.snatItem(_bk.user.data.items[testslot].id);
							}
						}
						if( inslot == 14 ) {
							var testslot = this.slotItem(3);
							if( testslot >= 0 ) {
								var testitm = this.itemMainData(_bk.user.data.items[testslot].item_id);
								if( testitm['2h'] > 0 ) {
									this.snatItem(_bk.user.data.items[testslot].id);
								}
							}
						}
						_bk.user.data.items[i].inOdet = inslot;
						_bk.uppositem(_bk.user.data.items[i].id);
						//_bk.mod.module.inventory.getRz(itm.inRazdel,this.pg);
					}
					i = -2;
				}
			}else{
				i = -2;
			}
			i++;
		}
		if( ref == true ) {
			this.refItemsOnline('odet='+id);
		}
	},
	deleteItems:function(id,yes) {
		// yes = 1 - пользователь дал согласие , 0 - отправляем запрос на согласие
		/*var i = 0;
		while( i != -1 ) {
			if( _bk.user.data.items[i] != undefined ) {
				if( _bk.user.data.items[i].id == id ) {
					var itm = this.itemMainData(_bk.user.data.items[i].item_id);
					if( _bk.user.data.items[i].delete > 0 ) {
						alert('Предмет уже выброшен!');
					}else{
						//_bk.user.data.items[i].delete = _bk.timenow();
						//_bk.mod.module.inventory.getRz(itm.inRazdel,this.pg);
						this.refItemsOnline('delete='+id);
					}
					i = -2;
				}
			}else{
				i = -2;
			}
			i++;
		}*/
		this.refItemsOnline('delete='+id);
	},
	//
	massa:-12345,
	grp:{},
	timeox:[],
	rzitemx:function() {
		this.massa = 0;
		var grp = {};
		this.grp = {};		
		var i = 0 , x = 0;
		var srokendref = 0;
		while( i != -1 ) {
			if( _bk.user.data.items[i] != undefined ) {
				var itm = this.itemMainData(_bk.user.data.items[i].item_id);
				//
				if( itm != undefined && _bk.user.data.items[i].srokX == undefined ) {
					var po = this.takeStats(_bk.user.data.items[i].data);
					//
					var srok = 0;
					if( po.srok != undefined && po.srok > 0 ) {
						srok = po.srok;
					}else if( itm.srok != undefined && itm.srok > 0 ) {
						srok = itm.srok;
					}
					if( srok > 0 ) {
						var srokend = parseInt(srok) + parseInt(_bk.user.data.items[i].time_create);
					}else{
						var srokend = 0;
					}
					_bk.user.data.items[i].srokX = srokend;
					if( _bk.user.data.items[i].srokX > _bk.timenow() ) {
						if( this.timeox[(_bk.user.data.items[i].srokX-_bk.timenow())] == undefined ) {
							/* включить позже
							setTimeout('_bk.mod.module.inventory.rzitemx();_bk.mod.module.inventory.getRz(_bk.mod.module.inventory.rz,_bk.mod.module.inventory.pg);',(_bk.user.data.items[i].srokX-_bk.timenow())*1000);
							*/
							this.timeox[(_bk.user.data.items[i].srokX-_bk.timenow())] = true;
						}
						//setTimeout('_bk.mod.module.inventory.getInvData();',(_bk.user.data.items[i].srokX-_bk.timenow())*1000);
					}
				}
				//
				if( _bk.user.data.items[i].delete == 0 && itm.massa != undefined && _bk.user.data.items[i].inOdet == 0 && ( _bk.user.data.items[i].srokX == 0 || _bk.user.data.items[i].srokX > _bk.timenow() ) ) {
					this.massa += parseFloat(itm.massa);
				}
				if( itm.inRazdel == this.rz && _bk.user.data.items[i].delete == 0 ) {
					if( _bk.user.data.items[i].inGroup == 0 || this.grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup] == undefined ) { 
						if( _bk.user.data.items[i].inGroup > 0 ) {
							this.grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup] = 1;
						}
						//
						if( _bk.user.data.items[i].srokX > _bk.timenow() || _bk.user.data.items[i].srokX == 0 ) {
							if( this.filterText == '' || ~itm.name.toLowerCase().indexOf(this.filterText.toLowerCase()) != 0 ) {
								if( _bk.user.data.items[i].inOdet == 0 ) {
									x++;
								}
							}
						}
					}else{
						if( _bk.user.data.items[i].inGroup > 0 ) {
							this.grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup]++;
						}
					}
				}
			}else{
				i = -2;
			}
			i++;
		}
		this.massa = this.massa.toFixed(2);
		return x;
	},
	srokendref:0,
	srokendref_timer:0,
	takeStats:function(data) {
		var r = {};
		var i = 0;
		if( data != undefined ) {
			data = data.split('|');
			while( i != -1 ) {
				if( data[i] != undefined ) {
					data[i] = data[i].split('=');
					if( data[i][0] != undefined ) {
						r[data[i][0]] = data[i][1];
					}
				}else{
					i = -2;
				}
				i++;
			}
		}
		return r;
	},
	useiteminv:function(id,date) {
		win.add('iuse'+id,'Подтверждение T1',date,{'a1':"_bk.mod.module.inventory.refItemsOnline(\'use_pid="+id+"\');"},2,1,'width:300px;');
	},
	useiteminv2:function(id,date) {
		win.add('iusenew'+id,'Подтверждение T2',date,{
			'a1':"_bk.mod.module.inventory.refItemsOnline(\'use_pid="+id+"\',\'iusenew"+id+"\');"
			,'d':'<center><input style="width:96%; margin:5px;" id="iusenew'+id+'" class="inpt2" type="text" value=""></center>'
		},3,1,'width:300px;');
		$('#iusenew'+id+'').val(_bk.user.info.login);
		$('#iusenew'+id+'').focus();
		top.chat.inObj = $('#iusenew'+id+'');
	},
	useiteminv3:function(id,date) {
		win.add('iuse'+id,'Подтверждение T3',date,{'a1':"_bk.mod.module.inventory.refItemsOnline(\'use_pid="+id+"\');"},3,1,'width:300px;');
	},
	
	stackItem:function(id) {
		_bk.mod.module.inventory.refItemsOnline('stack='+id);
	},
	
	delitmwin:function(id) {
		var url = '';
		if($('#chidrop'+id).attr('checked') == true) {
			url += '&deleteall7=1';
		}
		this.refItemsOnline('delete='+id+''+url);
		/*if( itm == '' ) {
			var i = 0;
			while( i != -1 ) {
				if( _bk.user.data.items[i] != undefined ) {
					if( _bk.user.data.items[i].id == id ) {
						var itm = this.itemMainData(_bk.user.data.items[i].item_id);
						if( _bk.user.data.items[i].delete > 0 ) {
							alert('Предмет уже выброшен!');
						}else{
							_bk.user.data.items[i].delete = _bk.timenow();
							_bk.mod.module.inventory.getRz(itm.inRazdel,this.pg);
							this.refItemsOnline('delete='+id+''+url);
						}
						i = -2;
					}
				}else{
					i = -2;
				}
				i++;
			}
		}else{
			var i = 0;
			while( i != -1 ) {
				if( _bk.user.data.items[i] != undefined ) {
					if( _bk.user.data.items[i].id == id ) {
						var itmid = _bk.user.data.items[i].item_id;
						i = -2;
					}
				}else{
					i = -2;
				}
				i++;
			}
			//
			if( itmid != undefined ) {
				var i = 0;
				while( i != -1 ) {
					if( _bk.user.data.items[i] != undefined ) {
						if( _bk.user.data.items[i].item_id == itmid ) {
							_bk.user.data.items[i].delete = _bk.timenow();
							if( itm == undefined ) {
								var itm = this.itemMainData(_bk.user.data.items[i].item_id);
							}
							//i = -2;
						}
					}else{
						i = -2;
					}
					i++;
				}
				_bk.mod.module.inventory.getRz(itm.inRazdel,this.pg);
				this.refItemsOnline('delete='+id+''+url);
			}
			//
		}*/
	},
	
	openItem:function(id,valno) {
		_bk.mod.module.inventory.refItemsOnline('open_itm='+id);
	},
	
	dropwin:function(id,img,name) {
		var date = '';
		date += '<table border=\'0\' width=\'100%\' cellspacing=\'0\' cellpadding=\'5\'><tr><td rowspan=2><img src=\'http://img.likebk.com/i/items/'+img+'\'></td><td align=\'left\'>Предмет <b>'+name+'</b> будет утерян, вы уверены ?</td></tr></table>';
		win.add('idrop'+id,'Выбросить предмет?',date,{'a1':'_bk.mod.module.inventory.delitmwin('+id+');','n':'<small><input type="checkbox" name="chidrop'+id+'" id="chidrop'+id+'"> <label for="chidrop'+id+'">Все предметы данного вида</label></small>'},2,1,'width:300px;');
	},
	
	timerAll:null,
	timerAllGo:function() {
		clearInterval(this.timerAll);
		/*this.timerAll = setInterval(function(){
			_bk.mod.module.inventory.error = '';
			if( _bk.mod.module.inventory.filterText != '' ) {
				if($('#newInvDatas').attr('id') == undefined ) {
					_bk.mod.module.inventory.filterText = '';
				}
			}
		},1000);*/
	},
	
	getInvData:function() {
		var r = '';	
		
		var rzx = this.rzitemx(this.rz);
		var pgx = 15; //сколько предметов на странице
		var x2 = 0;
		var pgs = Math.ceil( rzx / pgx );
		if( this.pg < 1 ) { this.pg = 1; }
		if( this.pg > pgs ) { this.pg = pgs; }
		var xstart = this.pg * pgx - pgx;
		var xstop = xstart + pgx;
		if( this.rz != 7 ) {
			r += '<span onclick="_bk.mod.module.inventory.refItemsOnline(\'groupall=true&otdel='+this.rz+'\');" class="cp pgdas">&nbsp; Группировать все предметы &nbsp;</span> &nbsp; ';
		}else{
			r += '<span onclick="_bk.mod.module.inventory.refItemsOnline(\'takesanich=true&otdel='+this.rz+'\');" class="cp pgdas">&nbsp; Забрать страницы Саныча &nbsp;</span> &nbsp; ';
		}
		/*if( pgs > 1 ) {
			r += '<div style="padding:5px;background-color:#a4a4a4;">Страницы: ';
			var i = 1;
			while( i <= pgs ) {
				if( this.pg == i ) {
					r += '<a class="cp pgdas" onclick="_bk.mod.module.inventory.getRz('+this.rz+','+i+')">'+i+'</a> ';
				}else{
					r += '<a class="cp pgdas1" onclick="_bk.mod.module.inventory.getRz('+this.rz+','+i+')">'+i+'</a> ';
				}
				i++;
			}
			r += '</div>';
		}
		*/
		if( _bk.pagesitems[0] > 1 ) {
			r += '<div style="padding:5px;background-color:#a4a4a4;">Страницы: ';
			var i = 1;
			while( i <= _bk.pagesitems[0] ) {
				if( _bk.pagesitems[1] == i ) {
					r += '<a class="cp pgdas" onclick="_bk.mod.module.inventory.getRzOnline('+this.rz+','+i+');">'+i+'</a> ';
				}else{
					r += '<a class="cp pgdas1" onclick="_bk.mod.module.inventory.getRzOnline('+this.rz+','+i+');">'+i+'</a> ';
				}
				i++;
			}
			r += '</div>';
		}			
		r += '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		
		var cl = 'c7c7c7';
		
		var grp = {};
		
		var i = 0 , x = 0 , x2s = 0 , pgg = 1;
		if( this.rz == 7 ) {
			i = -1;
		}
		while( i != -1 ) {
			if( _bk.user.data.items[i] != undefined ) {
				//
				if( _bk.user.data.items[i].time_create > _bk.user.data.items_lastID ) {
					_bk.user.data.items_lastID = _bk.user.data.items[i].time_create;
				}
				if( _bk.user.data.items[i].lastUPD > _bk.user.data.items_lastID ) {
					_bk.user.data.items_lastID = _bk.user.data.items[i].lastUPD;
				}
				$.cookie('liid',_bk.user.data.items_lastID);
				//
				if( _bk.user.data.items[i].inOdet == 0 && _bk.user.data.items[i].delete == 0 ) {
					var itm = this.itemMainData(_bk.user.data.items[i].item_id);
					var fsee = 1;
					if( fsee == 1 && itm.inRazdel == this.rz /*&& ( _bk.user.data.items[i].inGroup == 0 || grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup] == undefined )*/ ) { 
						var po = this.takeStats(_bk.user.data.items[i].data);
						//
						var srok = 0;
						
						
						if( po.srok != undefined && po.srok > 0 ) {
							srok = po.srok;
						}else if( itm.srok != undefined && itm.srok > 0 ) {
							srok = itm.srok;
						}
						
						if( srok > 0 ) {
							var srokend = parseInt(srok) + parseInt(_bk.user.data.items[i].time_create);										
						}else{
							var srokend = _bk.timenow() + 86400*365;
						}
						/*
						//
						if( srokend > _bk.timenow() ) {
							if( _bk.user.data.items[i].inGroup > 0 ) {
								grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup] = true;
							}
							if( cl == 'c7c7c7' ) {
								cl = 'd3d3d3';
							}else{
								cl = 'c7c7c7';
							}
							x++;
						}
						
						if( this.filterText != '' && itm.name.toLowerCase().indexOf(this.filterText.toLowerCase()) == -1 ) {
							fsee = 0;
						}*/
						
						fsee = 1;
						
						if( fsee != 0 && itm.id != undefined /*&& srokend > _bk.timenow()*/ ) {
							
							x2++;
														
							if( true == true || (xstart <= x2 && xstop >= x2) ) {
								
								r += '<tr bgcolor="#'+cl+'">'+
									'<td width="20%" valign="middle" align="center" style="padding:5px;min-width:90px;max-width:240px;border-bottom:1px solid #a4a4a4;">';
									//left data
										r += '<img src="http://img.likebk.com/i/items/'+itm.img+'">';
										//r += '<br><small style="color:grey" title="Дата создания: '+_bk.data('d.m.Y H:i:s',_bk.user.data.items[i].time_create)+''+"\n"+'Последнее использование: '+_bk.data('d.m.Y H:i:s',_bk.user.data.items[i].lastUPD)+'">(ID '+_bk.user.data.items[i].id+')</small>';
										r += '<br>';
										//
										var useurl = '';
										if( _bk.user.data.items[i].magic_inc == '' ) {
											_bk.user.data.items[i].magic_inc = itm.magic_inci;
										}
										if( _bk.user.data.items[i].magic_inc == '0' ) {
											_bk.user.data.items[i].magic_inc = '';
										}
										if( _bk.user.data.items[i].magic_inc != '' && itm.type == 30 ) {
											useurl = 1;
										}else if( _bk.user.data.items[i].magic_inc != '' && itm.type == 29 ) {
											if( po.useOnLogin != undefined ) {
												useurl = 2;
											}else{
												useurl = 1;
											}
										}else if( _bk.user.data.items[i].magic_inc != '' ) {
											useurl = 3;
										}
										//
										if( itm.type == 37 ) {
											r += '<a onClick="_bk.oUrl(\'main.php?inv=1&otdel=2&nonewinv&use_rune='+_bk.user.data.items[i].id+'&use_sat='+_bk.user.data.items[i].id+'&item_rune=undefined\');" title="Использовать" class="cp">Исп-ть</a> ';
											if( itm.inslot > 0 || po.open != undefined ) {
												r += '<br>';
											}
										}else if( itm.type == 46 ) {
											r += '<a onClick="_bk.oUrl(\'main.php?inv=1&otdel=2&nonewinv&use_rune='+_bk.user.data.items[i].id+'&use_sat='+_bk.user.data.items[i].id+'&item_rune=undefined\');" title="Использовать" class="cp">Исп-ть</a> ';
											if( itm.inslot > 0 || po.open != undefined ) {
												r += '<br>';
											}
										}else if( useurl != '' ) {
											useurl2 = [
												'',
												'_bk.mod.module.inventory.useiteminv('+_bk.user.data.items[i].id+',\'<table border=\\\'0\\\' width=\\\'100%\\\' cellspacing=\\\'0\\\' cellpadding=\\\'5\\\'><tr><td rowspan=2 width=\\\'80\\\' valign=\\\'middle\\\'><div align=\\\'center\\\'><img src=\\\'http://img.likebk.com/i/items/'+itm.img+'\\\'></div></td><td valign=\\\'middle\\\' align=\\\'left\\\'>&quot;<b>'+itm.name+'</b>&quot;<br>Использовать сейчас?</td></tr></table>\');',
												'_bk.mod.module.inventory.useiteminv2('+_bk.user.data.items[i].id+',\'<table border=\\\'0\\\' width=\\\'100%\\\' cellspacing=\\\'0\\\' cellpadding=\\\'5\\\'><tr><td rowspan=2 width=\\\'80\\\' valign=\\\'middle\\\'><div align=\\\'center\\\'><img src=\\\'http://img.likebk.com/i/items/'+itm.img+'\\\'></div></td><td valign=\\\'middle\\\' align=\\\'left\\\'>&quot;<b>'+itm.name+'</b>&quot;<br>Использовать сейчас?</td></tr></table>\');',
												'top.useMagic(\''+itm.name+'\',0,\''+itm.img+'\',1,\'main.php?inv=1&otdel=2&use_pid='+_bk.user.data.items[i].id+'&rnd=1&logi='+_bk.user.info.login+'\');',
												'_bk.mod.module.inventory.useiteminv2('+_bk.user.data.items[i].id+',\'<table border=\\\'0\\\' width=\\\'100%\\\' cellspacing=\\\'0\\\' cellpadding=\\\'5\\\'><tr><td rowspan=2 width=\\\'80\\\' valign=\\\'middle\\\'><div align=\\\'center\\\'><img src=\\\'http://img.likebk.com/i/items/'+itm.img+'\\\'></div></td><td valign=\\\'middle\\\' align=\\\'left\\\'>&quot;<b>'+itm.name+'</b>&quot;<br>Использовать сейчас?</td></tr></table>\');'
											];
											useurl = useurl2[useurl];
											r += '<a onClick="'+useurl+'" title="Использовать" class="cp">Исп-ть</a> ';
											if( itm.inslot > 0 || po.open != undefined ) {
												r += '<br>';
											}
										}else if( itm.type == 31 ) {
											r += '<a onclick="_bk.oUrl(\'main.php?inv=1&otdel=6&nonewinv&use_rune='+_bk.user.data.items[i].id+'&item_rune=\');" class="cp">Исп-ть</a> ';
											if( itm.inslot > 0 || po.open != undefined ) {
												r += '<br>';
											}
										}else if( itm.type == 62 || itm.type == 129 || itm.type == 130 ) {
											r += '<a onclick="_bk.oUrl(\'main.php?inv=1&otdel=2&nonewinv&use_rune='+_bk.user.data.items[i].id+'&use_char='+_bk.user.data.items[i].id+'&item_rune=\');" class="cp">Исп-ть</a> ';
											if( itm.inslot > 0 || po.open != undefined ) {
												r += '<br>';
											}
										}
										if( po.open != undefined ) {
											r += '<a onclick="_bk.mod.module.inventory.openItem('+_bk.user.data.items[i].id+',true);" class="cp">Открыть</a>';
											if( itm.inslot > 0 ) {
												r += '<br>';
											}
										}
										if( itm.inslot > 0 && itm.type != 31 && itm.type != 46 ) {
											r += '<a onclick="_bk.mod.module.inventory.odetItem('+_bk.user.data.items[i].id+',true);" class="cp">Надеть</a> ';
										}
										//
										if( itm.group > 0 ) {
											r += '<br><img onclick="_bk.mod.module.inventory.stackItem('+_bk.user.data.items[i].id+');" title="Собрать" class="cp" src="http://img.likebk.com/i/stack.gif"> ';
											//if( this.grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup] > 1 ) {
											if( _bk.user.data.items[i].xxx > 1 ) {
												var dateunst = '';
												dateunst += '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td width=90 >';
													dateunst += '<img style=padding:10px; src=http://img.likebk.com/i/items/'+itm.img+' >';
												dateunst += '</td><td>';
													dateunst += 'Разделить предмет <b>'+itm.name+'</b>?';							
												dateunst += '</td></tr></table>';
												r += '<img title="Разделить" onclick="top.unstack2('+_bk.user.data.items[i].id+',\''+itm.img+'\',\''+itm.name+'\',\''+_bk.user.data.items[i].xxx+'\',\''+dateunst+'\',0,0)" class="cp" src="http://img.likebk.com/i/unstack.gif"> ';
											}
										}
										r += '<img onclick="_bk.mod.module.inventory.dropwin('+_bk.user.data.items[i].id+',\''+itm.img+'\',\''+itm.name+'\')" title="Выбросить предмет" class="cp" src="http://img.likebk.com/i/clear.gif"> ';
										//
									//
									r += '</td>'+
									'<td valign="top" style="padding:5px;border-left:1px solid #a4a4a4;border-bottom:1px solid #a4a4a4">';
									//right data
										var itmname = itm.name;	
										var itmmassa = parseFloat(itm.massa);
										/*if( this.grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup] != undefined && this.grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup] > 1 ) {
											itmname += ' (x'+this.grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup]+')';
											itmmassa = itmmassa * this.grp[_bk.user.data.items[i].item_id+'-'+_bk.user.data.items[i].inGroup];
										}*/
										if( _bk.user.data.items[i].xxx > 1 ) {
											itmname += ' (x'+_bk.user.data.items[i].xxx+')';
											itmmassa = itmmassa * _bk.user.data.items[i].xxx;
										}
										if( po.upatack_lvl != undefined ) {
											itmname += ' +' + po.upatack_lvl;
										}
										r += '<a href="/item/'+itm.id+'" target="_blank">'+itmname+'</a> &nbsp; ';
										if( itmmassa != 0 ) {
											r += '(Масса: '+itmmassa.toFixed(2)+') ';
										}
										if( po.sudba != undefined ) {
											if( po.sudba == '1' ) {
												po.sudba = _bk.user.info.login;
											}
											r += ' <img title="Этот предмет связан общей судьбой с '+po.sudba+'. Никто другой не сможет его использовать." src="http://img.likebk.com/i/desteny.gif" width="16" height="18">';
										}
										if( _bk.user.data.items[i].gift != undefined && _bk.user.data.items[i].gift != '' && _bk.user.data.items[i].gift != '0' ) {
											r += ' <img title="Этот предмет вам подарил '+_bk.user.data.items[i].gift+'. Вы не сможете передать этот предмет кому-либо еще." src="http://img.likebk.com/i/podarok.gif" width="16" height="18">';
										}
										//r += '<div style="overflow:auto;width:500px;">'+_bk.user.data.items[i].data+'</div>';
										if( _bk.user.data.items[i]['2price'] > 0 ) {
											r += '<br><b>Цена: '+_bk.user.data.items[i]['2price']+' екр.</b>';
										}else if( _bk.user.data.items[i]['price2'] > 0 ) {
											r += '<br><b>Цена: '+_bk.user.data.items[i]['price2']+' екр.</b>';
										}else if( _bk.user.data.items[i]['1price'] > 0 ) {
											r += '<br><b>Цена: '+_bk.user.data.items[i]['1price']+' кр.</b>';
										}else if( _bk.user.data.items[i]['price1'] > 0 ) {
											r += '<br><b>Цена: '+_bk.user.data.items[i]['price1']+' кр.</b>';
										}
										if( _bk.user.data.items[i].iznosMAX > 0 ) {
											r += '<br>Долговечность: '+Math.floor(_bk.user.data.items[i].iznosNOW)+'/'+Math.floor(_bk.user.data.items[i].iznosMAX);
										}
										if( srok > 0 ) {
											r += '<br>Срок годности: '+_bk.timeOut(srok)+' (до '+_bk.data('d.m.Y H:i:s',srokend)+')';
										}
										//Требования
										var tr = '';
										var j = 0;
										while( j != -1 ) {
											if( _bk.items.tr[j] != undefined ) {
												if( po['tr_'+_bk.items.tr[j]] != undefined ) {
													var notr = false;
													if( _bk.items.tr[j] == 'lvl' ) {
														if( _bk.items.tr[j] > _bk.user.info.level ) {
															notr++;
														}
													}
													if( ( _bk.user.global.stats[_bk.items.tr[j]] != undefined && _bk.user.global.stats[_bk.items.tr[j]] < po['tr_'+_bk.items.tr[j]] ) || notr == true ) {
														tr += '<br><font color="red">&bull; '+_bk.is[_bk.items.tr[j]]+': ' + po['tr_'+_bk.items.tr[j]]+'</font>';
													}else{
														tr += '<br>&bull; '+_bk.is[_bk.items.tr[j]]+': ' + po['tr_'+_bk.items.tr[j]];
													}
												}
											}else{
												j = -2;
											}
											j++;
										}
										if( tr != '' ) {
											r += '<br><b>Требуется минимальное:</b>'+tr;
										}
										//Действует на
										var tr = '';
										if( po['upartitm'] != undefined ) {
											tr += '<br>• Уровень усиления: '+po['upartitm']+' (+'+(po['upartitm']*10)+'%)';
										}
										var j = 0;
										var addbron = '';
										var brnnamez = ['','головы','корпуса','пояса','ног'];
										if( po['upartitm'] == undefined ) {
											po['upartitm'] = 0;
										}
										while( j != -1 ) {
											if( _bk.items.add[j] != undefined ) {
												if( po['add_'+_bk.items.add[j]] != undefined ) {
													if(
														_bk.items.add[j] != 'mib1' && _bk.items.add[j] != 'mib2' && _bk.items.add[j] != 'mib3' && _bk.items.add[j] != 'mib4'
														&&
														_bk.items.add[j] != 'mab1' && _bk.items.add[j] != 'mab2' && _bk.items.add[j] != 'mab3' && _bk.items.add[j] != 'mab4'
													) {
														var addval = Math.floor(po['add_'+_bk.items.add[j]]/100*(100+parseInt(po['upartitm']*10)));
														if( addval > 0 ) {
															addval = '+'+addval;
														}
														tr += '<br><span title="add_'+_bk.items.add[j]+'">&bull; '+_bk.is[_bk.items.add[j]]+'</span>: ' + addval;
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
														tr += '<br><span title="sv_'+_bk.items.add[j]+'">&bull; Урон</span>: ' + addval;
													}else{
														var addval = po['sv_'+_bk.items.add[j]];
														if( addval > 0 ) {
															addval = '+'+addval;
														}
														tr += '<br><span title="sv_'+_bk.items.add[j]+'">&bull; '+_bk.is[_bk.items.add[j]]+'</span>: ' + addval;
													}
												}
											}else{
												j = -2;
											}
											j++;
										}
										if( tr != '' || addbron != '' ) {
											r += '<br><b>Свойства предмета:</b>'+tr+addbron;
										}
										//
										
										if( po['free_stats'] != undefined && po['free_stats'] > 0 ) {
											
											if( po['add_s1'] == undefined ) {
												po['add_s1'] = 0;
											}
											if( po['add_s2'] == undefined ) {
												po['add_s2'] = 0;
											}
											if( po['add_s3'] == undefined ) {
												po['add_s3'] = 0;
											}
											if( po['add_s5'] == undefined ) {
												po['add_s5'] = 0;
											}
											if( po['add_s6'] == undefined ) {
												po['add_s6'] = 0;
											}
											
											r += '<br><b>Свободные распределения:</b>';
											r += '<br><small>';
												r += '&nbsp; &nbsp; &nbsp; Сила: '+(po['add_s1'])+' <img onclick="_bk.mod.module.inventory.refItemsOnline(\'itmid='+_bk.user.data.items[i]['id']+'&ufs=1\');" class="cp" style="display:inline-block; vertical-align:middle;" src="http://img.likebk.com/i/plus.gif">';
												r += '<br>&nbsp; &nbsp; &nbsp; Ловкость: '+(po['add_s2'])+' <img onclick="_bk.mod.module.inventory.refItemsOnline(\'itmid='+_bk.user.data.items[i]['id']+'&ufs=2\');" class="cp" style="display:inline-block; vertical-align:middle;" src="http://img.likebk.com/i/plus.gif">';
												r += '<br>&nbsp; &nbsp; &nbsp; Интуиция: '+(po['add_s3'])+' <img onclick="_bk.mod.module.inventory.refItemsOnline(\'itmid='+_bk.user.data.items[i]['id']+'&ufs=3\');" class="cp" style="display:inline-block; vertical-align:middle;" src="http://img.likebk.com/i/plus.gif">';
												r += '<br>&nbsp; &nbsp; &nbsp; Интеллект: '+(po['add_s5'])+' <img onclick="_bk.mod.module.inventory.refItemsOnline(\'itmid='+_bk.user.data.items[i]['id']+'&ufs=5\');" class="cp" style="display:inline-block; vertical-align:middle;" src="http://img.likebk.com/i/plus.gif">';
												r += '<br>&nbsp; &nbsp; &nbsp; Мудрость: '+(po['add_s6'])+' <img onclick="_bk.mod.module.inventory.refItemsOnline(\'itmid='+_bk.user.data.items[i]['id']+'&ufs=6\');" class="cp" style="display:inline-block; vertical-align:middle;" src="http://img.likebk.com/i/plus.gif">';
											r += '</small>';
											r += '<br>• Осталось распределение: '+po['free_stats'];
										}
										
										//
										var tr = '';
										if( _bk.user.data.items[i].kamen > 1 ) {
											var kamn1 = this.itemMainData(_bk.user.data.items[i].kamen);
											var addeff = {
												10159:'+1 % к мф критического удара',
												10160:'+1 % к мф антикрита',
												10161:'+1 % к мф уворота',
												10162:'+1 % к мф антиуворота',
												10163:'+1 мф блока щитом',
												10164:'+0.5% уменьшения расхода маны',
												10165:'+1% к мане'													
											};
											if( addeff[_bk.user.data.items[i].kamen] != undefined ) {
												addeff = addeff[_bk.user.data.items[i].kamen];
											}else{
												addeff = '';
											}											
											if( addeff != '' ) {
												addeff = '('+addeff+')';
											}
											tr += '<br>&bull; Камень: '+(kamn1.name)+' '+addeff+'';
										}else if( _bk.user.data.items[i].kamen == 0 ) {
											tr += '<br>&bull; Камень: <i>ПУСТО</i>';
										}
										if( po.rune != undefined && po.rune > 0 ) {
											tr += '<br>&bull; Руна: '+decodeBytes(po.rune_name,'cp1251')+'';
										}
										//
										if( po.spell != undefined && po.spell > 0 ) {
											tr += '<br>&bull; '+decodeBytes(po.spell_name,'cp1251')+': '+(_bk.is[po.spell_st_name])+': +'+po.spell_st_val+'';
										}
										if( tr != '' ) {
											r += '<br><b>Улучшения предмета:</b>'+tr;
										}
										//
										if( itm.info != '' ) {
											r += '<br><small><b>Описание:</b>';
											r += '<br><i>'+itm.info+'</i></small>';
										}									
										//
										if(  _bk.user.data.items[i]['text_item'] != undefined ) {
											r += '<br><br><div style="background-color:#e8e8e8;padding:5px;"><code>';
											var txti = 0;
											while( txti != -1 ) {
												if( _bk.user.data.items[i]['text_item'][txti] != undefined ) {
													r += '<div><span class="date1">'+_bk.user.data.items[i]['text_item'][txti][0]+'</span> '+decodeBytes(_bk.user.data.items[i]['text_item'][txti][2],'cp1251')+'</div>';
												}else{
													txti = -2;
												}
												txti++;
											}
											r += '</code></div>';
											
										}
										//
										if( po.noremont != undefined ) {
											r += '<br><small><font color="maroon">Предмет не подлежит ремонту</font></small>';	
										}
										if( po.frompisher != undefined ) {
											r += '<br><small><font color="maroon">Предмет из подземелья</font></small>';	
										}
										
									//
									r += '</td>'+
								'</tr>';
								x2s++;
								if( x2s >= xstop-xstart ) {
									i = -2;
								}
							}
						}else if( srokend > _bk.timenow() ) {
							/*r += '<tr bgcolor="#'+cl+'">'+
								'<td width="20%" valign="middle" align="center" style="min-width:90px;max-width:240px;border-bottom:1px solid #a4a4a4;">';
								//left data
									r += '<b>NO IMG</b>';
								//
								r += '</td>'+
								'<td valign="top" style="padding:5px;border-left:1px solid #a4a4a4;border-bottom:1px solid #a4a4a4">';
								//right data
									r += '<b><font color="red">ITEM:'+_bk.user.data.items[i].item_id+' UNDEFINED</font></b>';
								//
								r += '</td>'+
							'</tr>';*/
						}
					}
				}else{
					/*
					x++;
					if( x >= xstop ) {
						i = -2;
					}
					*/
				}
			}else{
				i = -2;
			}
			i++;
		}
		
		if( this.rz == 7 ) {
			//r += '<tr><td align="center" valign="middle">Ошибка загрузки списка предметов...</td></tr>';
			/*var i = 0;
			while( i <= 20000 ) {
				if( _bk.user.data.items_main[i] != undefined ) {
					var xr = 1;
					
					if( xr > 0 ) {
						r += '<tr bgcolor="#'+cl+'">'+
							'<td width="20%" valign="middle" align="center" style="min-width:90px;max-width:240px;border-bottom:1px solid #a4a4a4;">';
							//left data
								r += '<img src="http://img.likebk.com/i/items/'+_bk.user.data.items_main[i].img+'"><br><br>';
								r += '<a class="cp">Переместить</a><br><br>';
							//
							r += '</td>'+
							'<td valign="top" style="padding:5px;border-left:1px solid #a4a4a4;border-bottom:1px solid #a4a4a4">';
							//right data
								r += '<a href="/item/'+_bk.user.data.items_main[i].id+'" target="_blank">'+_bk.user.data.items_main[i].name+' (x'+xr+')</a>';
								r += '<br><small><font color="maroon">Ресурс будет доступен в течении 30 минут после перемещения в инвентарь, затем он переместится обратно на склад.</font></small>';
							//
							r += '</td>'+
						'</tr>';
						x2++;
					}					
				}
				i++;
			}*/
			
			var i = 0;
			while( i != -1 ) {
				if( _bk.user.global.stats.res_items[i] != undefined ) {
					var xr = _bk.user.global.stats.res_items[i][1];
					var iid = _bk.user.global.stats.res_items[i][0];
					var itm = this.itemMainData(iid);
					var fsee = 1;
					if( this.filterText != '' && itm.name.toLowerCase().indexOf(this.filterText.toLowerCase()) == -1 ) {
						fsee = 0;
					}
					if( itm.id != undefined && fsee == 1 ) {
						if( cl == 'c7c7c7' ) {
							cl = 'd3d3d3';
						}else{
							cl = 'c7c7c7';
						}					
						r += '<tr bgcolor="#'+cl+'">'+
							'<td width="20%" valign="middle" align="center" style="min-width:90px;max-width:240px;border-bottom:1px solid #a4a4a4;">';
							//left data
								r += '<br><img src="http://img.likebk.com/i/items/'+itm.img+'"><br><br>';
								r += '<a class="cp" onclick="_bk.mod.module.inventory.refItemsOnline(\'skladtake='+itm.id+'\');">Переместить</a><br><br>';
							//
							r += '</td>'+
							'<td valign="top" style="padding:5px;border-left:1px solid #a4a4a4;border-bottom:1px solid #a4a4a4">';
							//right data
								r += '<a href="/item/'+itm.id+'" target="_blank">'+itm.name+' (x'+xr+')</a>';
								r += '<br><small><font color="maroon">Ресурс будет доступен в течении 30 минут после перемещения в инвентарь, затем он переместится обратно на склад.</font></small>';
							//
							r += '</td>'+
						'</tr>';
						x2++;
					}
				}else{
					i = -2;
				}
				i++;
			}
			
		}
		
		if( x2 < 1 ) {
			r += '<tr><td align="center" valign="middle">ПУСТО</td></tr>';
		}
		
		r += '</table>';		
		return r;
	},
	getRz:function(i,pg) {
		//this.getRzOnline(i,pg);
		if( this.rzname[i] != undefined && this.rzname[i] != '' ) { 
			this.rz = i;
			this.pg = pg;
			this.getMainHtml(this.pg);
		}
	},
	getRzOnline:function(i,pg) {
		this.rz = i;
		this.pg = pg;
		_bk.user.data.items = [];
		this.refItemsOnline('actdata=true&filter='+this.filterText+'&otdel='+this.rz+'&page='+this.pg);
	},
	getRzOnlineRef:function() {
		this.getRzOnline(this.rz,this.pg);
	},
	rz:1,pg:1,
	rzname:['','Обмундирование','Заклятия','Эликсиры','Руны','','Прочее','Склад'],
	rzurlx:[0,1,2,3,6,0,4,7],
	getMenuTop:function() {
		var r = '';
		
		r += '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>';
		var i = 1;
		while( i <= 7 ) {
			if( this.rzname[i] != undefined && this.rzname[i] != '' ) {
				r += '<td ';
				if ( this.rzurlx[i] == this.rz ) {
					r += 'class="inv_topmenub2"';
				}else{
					r += 'class="inv_topmenub"';
				}
				r += ' width="20%" onclick="_bk.mod.module.inventory.getRzOnline('+this.rzurlx[i]+',1);" align="center" valign="middle">'+this.rzname[i]+'</td>';
			}
			i++;
		}
		r += '</tr></table>';
		
		return r;
	},
	getLinksTop:function() {
		var r = '';
		
		//r += '<input class="btn" type="button" onclick="_bk.oUrl(\'main.php?oldinv&inv=1\');" value="Старый Инвентарь" /> ';
		r += '<input class="btn" type="button" onclick="_bk.oUrl(\'achiev.php\');" value="Достижения" /> ';
		r += '<input style="padding:6px 17px 6px 17px;" class="btnnew" type="button" onclick="_bk.oUrl(\'main.php?pet=1\');" value="Зверь" />';
		r += '<input style="padding:6px 17px 6px 17px;" class="btnnew" type="button" onclick="_bk.oUrl(\'main.php?skills=1\');" value="Умение" />';
		r += '<input style="padding:6px 17px 6px 17px;" class="btnnew" type="button" onclick="_bk.oUrl(\'main.php?obraz=1\');" value="Образ" />';
		r += '<input style="padding:6px 17px 6px 17px;" class="btnnew" type="button" onclick="_bk.oUrl(\'main.php\');" value="Вернуться" />';
		
		return r;
	},
	getWinHtml:function() {
		var r = '';
		r += 'Модуль "test" был успешно загружен в окне!';
		var winid = 'wintestnew1';
		win.add(winid,'Заголовок окна &nbsp;','Текст снизу',{'a1':'alert("action.win.'+winid+'.action:a1");','usewin':'','d':r},3,1,'min-width:300px;');
	}
};
_bk.mod.module[modx.name].modx = modx;
delete modx;

if( _bk.mod.modstart == true ) {
	_bk.mod.module.inventory.timerAllGo();
	_bk.mod.modstart = false;
	_bk.mod.module[modx.name].start();
}