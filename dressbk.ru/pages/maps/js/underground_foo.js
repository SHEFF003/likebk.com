var imgSRC = '';
	var sections = [
		{	
			name:'Карты', 
			id:'undergroundMaps',
			active: true,
			desc:'Карты подземелий',
			hash: '#maps'
		},
		{	
			name:'Монстры', 
			id:'undergroundMonsters',
			active: true,
			desc:'Монстры которых можно встретить в пещере',
			hash: '#bots'
		},
		{	
			name:'Задания', 
			id:'undergroundJob',
			active: true,
			desc:'Задания получаемые в пещерах и опыт получаемый за них',
			hash: '#jobs'
		},
	];
	
	var initvars = {
		currentUnderground: 0,
		currentFloor:0,
		zoom: 100,
		direct: 0, // Направление сторон света: 0 - Север, 1 - Восток, 2 - Юг, 3 - Запад
		cellSize: 40, // Размер генерируемых ячеек, влияет и на размер общую ширину таблицы
		delay: 200,
		duration: 8,
		cellBorderColor: ['#7d8699','#608399','#978c6e','#906c6c','#70906a','#777777','#546A04','#336699','#669999','#6666CC','#837610'],    //граница ячеек
		cellBackgroundColor: ['#e0e5e9','#e0ebf0','#e8e7d1','#e9d7d7','#c4e5c1','#dddddd','#CEE3AC','#CCddFF','#CCCCFF','#CCCCFF','#ddcf9f'],  //фон ячейки
		mapBackgroundColor: '#ffffff',
		mapBorderColor: '#cccccc',
		mapBackgroundImage: imP1+'ugcell.gif',
		coordBackgroundColor: ['#55627a','#335e79','#7a6b4b','#734747','#4c6f45','#999999','#507026','#336699','#336666','#6666CC','#a99348'],   //фон шкалы
		compassBG: imP11+'compass_gr.gif',
		tooltipBG: imP1+'tooltip_bg.png',
		imageBlank: imP1+'blank.gif',
		imgPos1:4,
		imgPos2:21,
		imgPos3:12,
		firstFlag: imP1+'ugflag1.gif',
		secondFlag: imP1+'ugflag2.gif',
		isOpera: (navigator.userAgent.indexOf("Opera") != -1),
		hlColor: ['#FF8C00','#00FF00','#0000FF','#FF0000','#00FFFF','#FFFF00','#800000','#2E8B57','#FF00FF','#00008B','#FFA500','#32CD32','#2F4F4F','#FF1493','#708090','#5F4F3F','#981433','#731090','#cccccc','#ffffff',],
	city: { 
	capital: imP2+'city/brand/8.gif',
	angel: imP2+'city/brand/2.gif',
	demons: imP2+'city/brand/3.gif',
	devils: imP2+'city/brand/4.gif',
	sun: imP2+'city/brand/5.gif',
	sand: imP2+'city/brand/7.gif',
	moon: imP1+'city/moon_m.gif',
	emerald: imP2+'city/brand/6.gif',
	newcapital: imP1+'city/newcap_m.gif',
	novice: imP1+'brend1.gif',
	ice: imP1+'brend2.gif',
 abdon: imP1+'brend3.gif',
 abdon2: imP1+'brend4.gif'
 	}
	};
	//44448. openinfo
	var area = [
		{ name: 'Пещера тысячи проклятий', monstr: ['pg', 'pm', 'pu', 'pa', 'dk', 'im', 'sk', 'ms','dpg','zldsh','dhr','mhk','mhgol','mhub','mhohr','kstr','strsokrs','strsokrl','strsokri','strsokril','strsokrv','kzm','gzm','mgrt','brzldsh','brmhgol','odduxgol']},
		{ name: 'Бездна', monstr: ['pgb', 'rg', 'ng', 'lit', 'sg', 'sb', 'sd', 'btm', 'kg', 'gjs', 'olgrt','besBezdna','bes2Bezdna','bes3Bezdna','il8Bezdna','rbtm9Bezdna']},
		{ name: 'Пещеры мглы', monstr: ['pgsand','rm','sm','smm','zldshsnd', 'rh', 'krpt', 'hroch' ]},
		{ name: 'Катакомбы', monstr: ['sm','smm', 'rm', 'lit','rg', 'ng','sg','sl','zsl','hsl','chk','pp','og','zmb','bzmb','ep','bs','stg','trp','drs','prok','prp','shp','pk']},
		{ name: 'Шахты', monstr: ['sirenaSHaht','krisSHaht','prozerpinaSHaht','banshiSHaht','duhSHaht','strajSHaht']},
		{ name: 'Канализация', monstr: ['lka','mrtn','gmrz','tgad','obpodv','sp','bsp','stsp','bstsp','santzmb','kanzk','bkanzk','kanp','bzgsnt','bbzgsnt','bloodsnt','strkr','bstrkr','letb','bletb','slzmb','hozkan','mstngtl','glprb','strgl','tplzmb','grprn','plsnt','bplsnt','grslz','ognslz','akk','pchnk']},
		{ name: 'Грибница', monstr: ['muhgg','duhgg','mdgus','kolstr','mokr','skrog','plprzt','iskrprzt','upal','mgus','grmol','shup','strgrib','krlgrb','hlup','glgr','ugus','trut','posgr','kog','rog','macr','shiz','hish','gribn','pit','pozh','zash','zgig','scorp','brscorp']},
		{ name: 'Ледяная пещера', monstr: ['otmk','otmb']},
		{ name: 'Сторожевая Башня', monstr: ['pgab','dkrab','bloodsntab','pgk','dkk','bsk','srgnt','vncom','warsp','beshpr']},
 { name: 'Некровилль', monstr: ['hbld','pgbol','mrdptr','mrdrk','mrdshn','bltrl','zakolZombak','vnezapKarkun','svirepDusha','amadeusP','necroKing1']},
  { name: 'Гора Легиона', monstr: ['glodpr','glzadsk','glzmbmat','glgkey','glgovgol','glbuk','glferm','glmkrk','glohr','glchas','glnohr','sobt','axv','butch','leyt','bigb','glemtel','glemo','gltenm','glmgol','glpzakl','gldbrtrp','glbezr','glgmtk','glgmgl','glzmb','glvsmrt','gysna','bsob','mar','glmpo','glmrdt','glmto','glmarst','glmarst1']}
 	];

	var citys = [
		{ name: 'Пещера тысячи проклятий', city: 'Moon City', id: 1},
		{ name: 'Бездна', city: 'Angels City', id: 2},
		{ name: 'Пещеры Мглы', city: 'Sand City', id: 3},
		{ name: 'Катакомбы', city: 'Demons City', id: 4},
		{ name: 'Шахты', city: 'Emerald City', id: 5},
	{ name: 'Канализация', city: 'Moon, Dreams, Low, Old City', id: 6},
		{ name: 'Грибница', city: 'Sun City', id: 7},
	{ name: 'Ледяная пещера', city: 'Все города', id: 8},
	{ name: 'Сторожевая Башня', city: 'Abandoned Plains', id: 9},
	{ name: 'Некровилль', city: 'Некровилль', id: 10},
		{ name: 'Гора Легиона', city: 'Abandoned Plains', id: 11}
	];	

	var all_maps = [
			{name:'Пещера тысячи проклятий', city: 'Moon City', src: initvars.city.capital},
			{name:'Бездна', city: 'Angel City', src: initvars.city.angel},
			{name:'Пещеры Мглы', city: 'Sand City',  src: initvars.city.sand},
			{name:'Катакомбы', city: 'Demons City', src: initvars.city.demons},
			{name:'Шахты', city: 'Emerald City', src: initvars.city.emerald},
			{name:'Канализация', city: 'Moon, Dreams, Low, Old City', src: initvars.city.novice},
			{name:'Грибница', city: 'Sun City', src: initvars.city.sun},
			{name:'Ледяная пещера', city: 'Все города', src: initvars.city.ice},
			{name:'Сторожевая Башня', city: 'Abandoned Plains', src: initvars.city.abdon},
			{name:'Туманные низины', city: 'Devils City', src: initvars.city.devils},
			{name:'Гора Легиона', city: 'Abandoned Plains', src: initvars.city.abdon2}
		];

// var all_shops = [
// //{name:'Пещера тысячи проклятий', city: 'Moon City', src: initvars.city.capital, id: 1},
// //{name:'Бездна', city: 'Angel City', src: initvars.city.angel, id: 2},
// //{name:'Магазин Грибоеда', city: 'Sun City', src: initvars.city.sun, id: 7},
// //{name:'Магазин Фелико', city: 'Sand City',  src: initvars.city.sand, id: 3},
// //{name:'Катакомбы', city: 'Demons City',  src: initvars.city.demons, id: 4},
// //{name:'Магазин Луки', city: 'Moon, Dreams, Low, Old City',  src: initvars.city.novice, id: 6}
// ];
	

	function createBaseDiv(){
 var htmlStr  = '';
			htmlStr += createDivs();
		document.getElementById('baseDiv').innerHTML = htmlStr;
	}
	
	function createDivs(){
		var show, bgStyle, ul = '', div ='';
		bgStyle  = 'position:relative;';
		bgStyle += 'text-align:left;color:#000;';
		
		ul += '<ul id="ummenu" style="margin:0px;padding:0px;display:inline;">';
		
		div += '<div id="bg" style="'+bgStyle+'">';
		
		for(var i = 0; i < sections.length; i++){
			if(window.location.hash){
				if(window.location.hash == sections[i].hash){
					show = 0;
				}else{
					show = 1;	
				}	
			}else{
				show = i;
			}
			ul += (show)?'<li '+((sections[i].active)?'onclick="openTabsMenu('+i+')"':'style="cursor:default;color:#CCCCCC;"')+' title="'+sections[i].desc+'">'+sections[i].name+'</li>':'<li class="here">'+sections[i].name+'</li>';
			div += '<div id="'+sections[i].id+'" style="'+(show?'display:none':'display:block')+'"></div>';
		}
		ul += '</ul>';
		div += '</div>';
		if(document.all && !initvars.isOpera){
			var baseDiv = '<br /><center><label for="zoomselect">Zoom: </label><select id="zoomselect" onchange="changeZoom(this.options[this.selectedIndex].value)">';
			for(var i = 5; i<11; i++){
				baseDiv += '<option '+((i*10 == initvars.zoom)?'selected="selected"':'')+' value="'+(i*10)+'">'+(i*10)+'%</option>';
			}
			baseDiv += '</select></center>';	
		}
		return ul+div;
	}
	
	function openTabsMenu(id){
		var li_str = '';
		var ul = document.getElementById('ummenu');
		for(var i = 0; i < sections.length; i++){
			
			li_str += (i != id)?'<li '+((sections[i].active)?'onclick="openTabsMenu('+i+')"':'style="cursor:default;color:#CCCCCC;"')+' title="'+sections[i].desc+'">'+sections[i].name+'</li>':'<li class="here">'+sections[i].name+'</li>';
			
			document.getElementById(sections[i].id).style.display = (i != id)?'none':'block';
			
			if(i == id){
				window.location.hash = sections[i].hash;
			}
			if(id == 0 && !i){
				document.getElementById('plane').style.backgroundImage = 'url('+initvars.mapBackgroundImage+')';	
			}
			
		}
		ul.innerHTML = li_str;
	}
	function drawMonsters(id){
		var i, j, temp_str = '<h3 style="margin:0px; padding:8px; font-size:18px; text-align:center;">Монстры</h3>';
		temp_str += '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="250" height="500" valign="top">';
		temp_str += '<select id="mnstrFilter" onchange="drawMonsters(this.options[this.selectedIndex].value)" style="margin-left:30px">';
		temp_str += '<option '+((id == '')?'selected="selected"':'')+'>Показать всех</option>';
		for(i = 0; i < area.length; i++){
			
			temp_str += '<option value="'+i+'" '+((i == id && id != '')?'selected="selected"':'')+'>'+area[i].name+'</option>';
		}
		temp_str += '</select>';
		
		temp_str += '<ul>';
		
		if(id){
			
			var monstrArray = area[id].monstr;
			for( i = 0; i < monstrArray.length; i++){
				temp_str += '<li><a href="javascript:showMonster(\''+monstrArray[i]+'\')">';
				temp_str += creatures[monstrArray[i]].name+'</a></li>';
			}
		}else{
			for( i in creatures){
				temp_str += '<li><a href="javascript:showMonster(\''+i+'\')">';
				temp_str += creatures[i].name+'</a></li>';
			}
		}
		
		temp_str += '</ul></td>';
		temp_str += '<td valign="top"><div id="monsterPlace" style="padding-right:10px;"></div></td></tr></table>';
		document.getElementById(sections[1].id).innerHTML = temp_str;
	}
	
	function showMonster(id, level){
		
		var temp_str = '<h4>'+((creatures[id].alignment)?'<img src="' + imP2 + 'align' + ((creatures[id].alignment == 1)? 9:3) + '.gif" align="absmiddle" />':'')+creatures[id].name+'</h4>';
		
		temp_str += '<table border="0" cellpadding="10" cellspacing="0"><tr>';
		temp_str += '<td width="30%" valign="top" align="center">';
		temp_str += '<img border="1" src="'+creatures[id].src+'" width="120" height="220" /></td>';
		
		var feature = creatures[id].levels;
		var lvl   = '<td>&nbsp;</td>';
		var str   = '<td>Сила:</td>';
		var dex   = '<td>Ловкость:</td>';
		var inst  = '<td>Интуиция:</td>';
		var power = '<td>Выносливость:</td>';
		var intel = '<td>Интеллект:</td>';
		var wis = '<td>Мудрость:</td>';
		var hp = '<td>HP:</td>';
		var bonus = creatures[id].job?'<td>Награда:</td>':'';
		
		temp_str += '<td>Характеристики:';
		
		for(var i = 0; i < feature.length; i++){
			lvl   += '<td width="40" style="text-align:right;font:bold;">';
			lvl   += ((feature[i].align)? '<img src="' + imP2 + 'align' + ((feature[i].align == 1)? 9:3)+'.gif" align="absmiddle" />':'') + feature[i].level+'</td>';
			str   += '<td style="text-align:right;">'+feature[i].str+'</td>';
			dex   += '<td style="text-align:right;">'+feature[i].dex+'</td>';
			inst  += '<td style="text-align:right;">'+feature[i].inst+'</td>';
			power += '<td style="text-align:right;">'+feature[i].power+'</td>';
			intel += '<td style="text-align:right;">'+feature[i].intel+'</td>';
			wis   += '<td style="text-align:right;">'+feature[i].wis+'</td>';
			hp    += '<td style="text-align:right;">'+feature[i].hp+'</td>';
			bonus += creatures[id].job?'<td style="text-align:right;">'+feature[i].bonus+'</td>':'';
		}
		
		temp_str += '<table border="0" cellspacing="0" cellpadding="2" style="font:12px Arial,sans-serif;">';
		temp_str += '<tr>'+lvl+'</tr>';
		temp_str += '<tr style="background:#fff;">'+str+'</tr>';
		temp_str += '<tr>'+dex+'</tr>';
		temp_str += '<tr style="background:#fff;">'+inst+'</tr>';
		temp_str += '<tr>'+power+'</tr>';
		temp_str += '<tr style="background:#fff;">'+intel+'</tr>';
		temp_str += '<tr>'+wis+'</tr>';
		temp_str += '<tr style="background:#fff;">'+hp+'</tr>';
		temp_str += creatures[id].job?'<tr style="font:bold;">'+bonus+'</tr>':'';
		temp_str += '</table>';
				
		temp_str += 'Место рождения: '+creatures[id].birthplace+'</td></tr>';
		temp_str += '<tr><td colspan="2"><br />'+creatures[id].descr+'</td></tr>';
		document.getElementById('monsterPlace').innerHTML = temp_str+'</table>';
	}
	function drawItems(){
		var i, j, temp_str = '<h3 style="margin:0px; padding:8px; font-size:18px; text-align:center;">Предметы из подземелья '+underground[initvars.currentUnderground].name+'</h3>';
		
		temp_str += '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="200" height="500" valign="top">';
		temp_str += '<ul>';
		for( i in items){
			
			temp_str += '<li><a href="javascript:showItems(\''+i+'\')">';
			temp_str += i+'</a></li>';
			 
		}
		temp_str += '</ul></td>';
		temp_str += '<td><div id="itemsPlace" style="padding-right:10px;"></div></td></tr></table>';
		document.getElementById(sections[2].id).innerHTML = temp_str;
	}
	function showItems(id){
		var temp_str = '<h4>'+id+'</h4>';
		
		temp_str += '<table border="0" width="100%" cellpadding="0" cellspacing="15">';
		for(var i in items[id]){
			temp_str += '<tr><td width="60" valign="top" align="center"><img src="'+items[id][i].src+'" /></td>';
			temp_str += '<td valign="top" style="font:12px Arial,sans-serif;"><strong>'+items[id][i].name+'</strong><br />';
			temp_str += '<a href="#" onclick="openCloseDesr(\'item'+id+i+'\', this);return false;" >Показать параметры</a>';
			temp_str += '<div id="item'+id+i+'" style="display:none; padding-left:15px;">';
			temp_str += items[id][i].descr ? items[id][i].descr : '';
			
			if(items[id][i].recipes){
				temp_str += '<br />';
				if(id=='Ингредиенты'){
					temp_str += '<b>Входит в состав:</b><br />';
					for(var j in items[id][i].recipes){
						for(var k = 0; k < recipes.length; k++){
							if(j == recipes[k][0]){
								temp_str += '<strong style="color:#006600">'+recipes[k][1]+'</strong> &ndash; '+items[id][i].recipes[j]+'&nbsp;шт.  ';
							}
						}
					}
					
				}else{
					temp_str += 'Рецепт:<br />';
					for(var j in items[id][i].recipes){
						temp_str += '<strong style="color:#006600">'+maters[j].name+'</strong> &ndash; '+items[id][i].recipes[j]+'&nbsp;шт. ';
					}
				}
			}
			if(id=='Ингредиенты' && items[id][i].cena)
				temp_str += '<br /><br />Сдав в государственный магазин вы получите: <strong>'+items[id][i].cena+' кр.</strong>';
			temp_str += '</div>';
			temp_str += '</td></tr>';
		}
		document.getElementById('itemsPlace').innerHTML = temp_str+'</table>';
	}
	function openCloseDesr(id, source){
		document.getElementById(id).style.display =(document.getElementById(id).style.display == 'none')?'':'none';
		source.innerHTML = (document.getElementById(id).style.display == 'none')?'Показать параметры':'Скрыть параметры';
	}
	
	function drawRecepts(){
		var i, j, temp_str = '<h3 style="margin:0px; padding:8px; font-size:18px; text-align:center;">Конструктор диггера </h3>';
		
		
		temp_str += '<div id="constructor" style="padding-right:10px;"></div>';
		document.getElementById(sections[3].id).innerHTML = temp_str;
		makeConstructor();
	}
	function drawJobs(id){
		var i, j, temp_str = '<h3 style="margin:0px; padding:8px; font-size:18px; text-align:center;">Задания</h3>';
		temp_str += '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="250" height="500" valign="top">';
		temp_str += '<select id="jobsFilter" onchange="drawJobs(this.options[this.selectedIndex].value)" style="margin-left:30px">';
		temp_str += '<option '+((id == '')?'selected="selected"':'')+'>Показать все</option>';
		for(i = 0; i < citys.length; i++){
			temp_str += '<option value="'+citys[i].id+'" '+((i == id-1 && id != '')?'selected="selected"':'')+'>'+citys[i].name+'</option>';
		}
		temp_str += '</select>';
		temp_str += '<ul>';
		temp_str += '<li><a href="javascript:showJobs( 1, '+(id?id:0)+')">Убийство монстров</a></li>';
		temp_str += '<li><a href="javascript:showJobs( 2, '+(id?id:0)+')">Собирание трофеев</a></li>';
		temp_str += '<li><a href="javascript:showJobs( 3, '+(id?id:0)+')">Собирание</a></li>';
		temp_str += '<li><a href="javascript:showJobs( 4, '+(id?id:0)+')">Рыцарские задания</a></li>';
		temp_str += '</ul></td>';
		temp_str += '<td valign="top"><div id="jobsPlace" style="padding-right:10px;"></div></td></tr></table>';
		document.getElementById(sections[2].id).innerHTML = temp_str;
	}
	function parseJobList( obj, id){
		var temp_str = '<tr>';
		var select_str = '';
		if(id == 1){
			
			var levels = obj.target.levels;
			temp_str += '<td width="20%" valign="top"><img src="'+obj.target.src+'" border="0"/></td>';
			temp_str += '<td width="80%" valign="top">';
			temp_str += ((obj.target.alignment)?'<img src="' + imP2 + 'align'+((obj.target.alignment==1)?9:3)+'.gif" align="absmiddle" />':'');
			temp_str += '<strong>'+obj.target.name+'</strong><br />';
			temp_str += '<ul style="list-style:none;margin:6px;">';
			temp_str += '<li style="margin:5px;">Введите количество монстров:</li>';
			temp_str += '<li style="margin:5px;"><input type="text" '+((obj.count == 1)?'disabled':'')+' id="count_'+obj.id+'" value="'+obj.count+'" style="width:30px;border:1px solid #999999;color:#333333;" onchange="changeJobCount(\''+obj.id+'\', this.value, '+levels.length+')" /> шт.</li>';
			
			for(var i = 0; i <= obj.count; i++){
				select_str += '<option value="'+i+'">'+i+'</option>';
			}
			var bonus = [];
			for( i = 0; i < levels.length; i++){
				if(levels[i].bonus) bonus[i] = levels[i].bonus;
			}
			
			for( i = 0; i < levels.length; i++){
				if(levels[i].bonus){
					temp_str += '<li style="margin:5px;">';
					temp_str += levels[i].align?'<img src="' + imP2 + 'align'+((levels[i].align==1)?9:3)+'.gif" align="absmiddle" />':'';
					temp_str += (!levels[i].align?'&nbsp;&nbsp;&nbsp;':'')+levels[i].level;
					temp_str += ' <select id="select_'+obj.id+'_'+i+'" style="width:40px;" onchange="redrawSelestJob(\''+obj.id+'\', '+levels.length+', this, ['+bonus.toString()+'])" >'+select_str+'</select>';
					temp_str += ' - награда: '+levels[i].bonus+' ед./шт.</li>';
				}
			}
			temp_str += '</ul>';
			temp_str += '<div id="bonus_'+obj.id+'" style="color:green;height:25px;"></div>';
			temp_str += '</td>';
			temp_str += '</tr><tr>';
			temp_str += '<td colspan="2">'+obj.descr+'<br /><br /></td>';
		}else{
			temp_str += '<td width="20%" valign="top"><img src="' + imP3 + obj.target+'.gif" border="0"/><br />';
			temp_str += '<ul style="list-style:none;margin:6px;">';
			temp_str += '<li style="margin:5px;">Введите количество:</li>';
			temp_str += '<li style="margin:5px;"><input type="text" id="count_'+obj.target+'" value="'+obj.count+'" style="width:30px;border:1px solid #999999;color:#333333;" onchange="changeJobCount2(\''+obj.target+''+obj.city+'\', this.value, '+obj.bonus+')" /> шт.</li>';
			temp_str += '</ul></td>';
			temp_str += '<td><strong>'+obj.name+'</strong><br />'+obj.descr+'</div>';
			temp_str += '<div id="bonus_'+obj.target+''+obj.city+'" style="color:green;height:25px;">Вы получите: <strong>'+(obj.count*obj.bonus)+'</strong> ед. награды.</div>';
			temp_str += '</td>';
		}
		temp_str += '</tr>';
		return temp_str;
	}
	
	function redrawSelestJob( id, length, obj, bot){
		var val = 0;
		var count = parseInt(document.getElementById('count_'+id).value, 10);
		var targ;
		var back_stap = new Array();
		var summ = 0;
		for(var i = 0; i < length; i++){
			targ = document.getElementById('select_'+id+'_'+i);
			if(targ){
				val += targ.selectedIndex;
				back_stap[i] = targ.selectedIndex;
				summ += bot[i]*targ.selectedIndex;
			}
		}
		document.getElementById('bonus_'+id).innerHTML = 'Вы получите: <strong>'+summ+'</strong>ед. награды';
		for( i = 0; i < length; i++){
			if(document.getElementById('select_'+id+'_'+i)){
				document.getElementById('select_'+id+'_'+i).options.length = 0;
				for(var j = 0; j <= count; j++){
					if(back_stap[i] && j<=back_stap[i]+count - val){
						document.getElementById('select_'+id+'_'+i).options[j] = new Option(j, j, 0, j==back_stap[i]?1:0);
					}else if(j <= count - val){
						document.getElementById('select_'+id+'_'+i).options[j] = new Option(j, j, 0, j==back_stap[i]?1:0);
					}
				}
			}
			
		}
	}
	
	function changeJobCount( id, count, length){
		document.getElementById('descr_'+id).innerHTML = count;
		for(var i = 0; i < length; i++){
			document.getElementById('select_'+id+'_'+i).options.length = 0;
			
			for(var j = 0; j <= parseInt(count,10); j++){
				document.getElementById('select_'+id+'_'+i).options[j] = new Option( j, j);
			}
		}
	}
	function changeJobCount2( obj, val, bonus){
		
		document.getElementById('descr_'+obj).innerHTML = val;
		document.getElementById('bonus_'+obj).innerHTML = 'Вы получите: <strong>'+(val*bonus)+'</strong> ед. награды.';
	}
	
	function showJobs(id, city){
		var job_name = ['Убийство монстров','Собирание трофеев','Собирание','Рыцарское задание'];
		var temp_str = '';
		var temp_id = -1;
		temp_str += '<table border="0" cellpadding="0" cellspacing="10">';
		if(!city){
			var chap = '';
			for(var i = 0; i < jobs_list.length; i++){
				var job = jobs_list[i];
				if(job.type != id) continue;
				if(temp_id != job.city){
					if (chap != '')
					{
						var s = '<tr><td colspan="2">';
						s += '<h4>'+job_name[id-1]+' в &laquo;'+citys[temp_id-1].name+'&raquo; ('+citys[temp_id-1].city+')</h4>';
						s += '</td></tr>';
						chap = s + chap;
						temp_str += chap;
						chap = '';
					}
					temp_id = job.city;
				}
				chap += parseJobList(job, id);
				
			}
			if (chap != '')
			{
				var s = '<tr><td colspan="2">';
				s += '<h4>'+job_name[id-1]+' в &laquo;'+citys[temp_id-1].name+'&raquo; ('+citys[temp_id-1].city+')</h4>';
				s += '</td></tr>';
				chap = s + chap;
				temp_str += chap;
			}
			
		}else{
			temp_str += '<tr><td colspan="2">';
			temp_str += '<h4>'+job_name[id-1]+' в &laquo;'+citys[city-1].name+'&raquo; ('+citys[city-1].city+')</h4>';
			temp_str += '</td></tr>';
			for(var i = 0; i < jobs_list.length; i++){	
				if(jobs_list[i].type == id && jobs_list[i].city == city){
					temp_str += parseJobList( jobs_list[i], id );
				}
			}
		}
		document.getElementById('jobsPlace').innerHTML = temp_str+'</table>';
	}
	// function drawShops(){
		// var i, j, temp_str = '<h3 style="margin:0px; padding:8px; font-size:18px; text-align:center;">Рыцарские магазины</h3>';
		// temp_str += '<div align="left" style="margin: 25px 45px;">Достижение 10000 (десять тысяч) очков репутации в конкретном городе дает возможность входа в Рыцарский магазин этого города. <br />В Рыцарский магазин Бездны можно зайти и без репутации, но только для покупки ингредиентов за Сущность Ресурса.</div>';
		// temp_str += '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="250" height="500" valign="top">';
		// temp_str += '<ul style="list-style:none;">';
		// for(var i = 0; i < all_shops.length; i++){
			
			// temp_str += '<li style="margin:5px 0px;"><a href="javascript:showShops(\''+all_shops[i].id+'\')" title="'+all_shops[i].city+'" ><img align="absmiddle" src="'+all_shops[i].src+'" border="0"  /> ';
			// temp_str += all_shops[i].name+'</a></li>';
			 
		// }
		// temp_str += '</ul></td>';
		// temp_str += '<td valign="top"><div id="shopsPlace" style="padding-right:10px;"></div></td></tr></table>';
		// document.getElementById(sections[5].id).innerHTML = temp_str;
	// }
	
	// function showShops(id){
		// var temp_str = '<table border="0" width="100%" cellpadding="0" cellspacing="25">';
		
		// temp_str += '<tr><td colspan="2"><h4>'+citys[id-1].name+'</h4></td></tr>';
		
		// for(var i in shop){
			// if(shop[i].city == id){
				// temp_str += '<tr><td width="60" valign="top" align="center"><img src="'+shop[i].src+'" border="0" /></td>';
				// temp_str += '<td valign="top" style="font:12px Arial,sans-serif;"><strong>'+shop[i].name+'</strong><br />';
				// temp_str += '<a href="#" onclick="openCloseDesr(\'item'+id+i+'\', this);return false;" >Показать параметры</a>';
				// temp_str += '<div id="item'+id+i+'" style="display:none; padding-left:15px;">';
				// temp_str += shop[i].descr ? shop[i].descr : '';
				// temp_str += '</div>';
				// temp_str += '</td></tr>';
			// }
		// }
		// document.getElementById('shopsPlace').innerHTML = temp_str+'</table>';
	// }