//update 22.04.09 by язон 
function highlightMonster(m, self, color){
	var id, creatures, ug, style;

	ug = underground[initvars.currentUnderground].floors[initvars.currentFloor];

	for(var i = 0; i < ug.length; i++){
		if(ug[i].creatures){
			creatures = ug[i].creatures;
			for( var j = 0; j < creatures.length; j++){
				if(m == creatures[j].name){
					id = creatures[j].name+'_'+creatures[j].level+'_'+creatures[j].count+'_'+((creatures[j].alignment)?1:0)+'_'+ug[i].x+ug[i].y;
					style = document.getElementById(id).style;
					if(document.all && !initvars.isOpera){
						style.top = parseInt(style.top)+((!self.checked)?3:-3)+'px';
						style.left = parseInt(style.left)+((!self.checked)?3:-3)+'px';
						style.filter = (self.checked)?'progid:DXImageTransform.Microsoft.Glow(color='+initvars.hlColor[color]+',strength=3)':'none';
					}else{
						style.background = (self.checked)?initvars.hlColor[color]:'none';
					}
				}
			}
		}

	}
}

function Statistic(){
	this.bank = new Array();
}

Statistic.prototype.addMonstr = function(){

	if(!this.bank[arguments[0]]) this.bank[arguments[0]] = new Object();

	if(this.bank[arguments[0]][arguments[1]] == null) this.bank[arguments[0]][arguments[1]] = 0;
	this.bank[arguments[0]][arguments[1]] += arguments[2];
};

/*Statistic.prototype.showMonstr = function(){
	var count1, count2;
	var c = 0;
	var color = initvars.hlColor;
	var minlevel = 21;
	var maxlevel = 0;
	for(var i in this.bank){
		if(typeof(this.bank[i]) != 'function'){
			for(var j = 0; j <= 21; j++){
				if (this.bank[i][j] != undefined)
				{
					if (minlevel > j) minlevel = j;
					if (maxlevel < j) maxlevel = j;
				}
			}
		}
	}
	var table = '<center><table border="0" cellpadding="0" cellspacing="0" style="font:normal 14px Times, serif"><tr style="font-weight:bold;text-align:center;"><td width="7">&nbsp;</td><td width="15">&nbsp;</td><td colspan="2">&nbsp;</td>';
	for (var i = minlevel; i <= maxlevel; i++)
	{
		table += '<td width="35"><span title="[' + i + '] уровень">[' + i + ']</span></td>';
	}
	table += '<td width="35"><b title="Суммарно">&#931;</b></td></tr>';
	count1 = 0;
	for(var i in this.bank){
		if(typeof(this.bank[i]) != 'function'){
			table += '<tr style="background:'+(((c)%2)?'#E4E4E4':'#F2F2F2')+';">';
			count2 = 0;
			table += '<td style="background:'+color[c]+'"><label for="hlchbx_'+c+'">&nbsp;</label></td><td><input name="hlchbx_'+c+'" type="checkbox" title="Подсветить '+creatures[i].name+'" onclick="highlightMonster(\''+i+'\',this, '+(c++)+')" /></td>';
			table += '<td><img hspace="10" src="'+creatures[i].icon+'" width="17" height="26" /></td><td>'+creatures[i].name+'</td>';
			for(var j = minlevel; j <= maxlevel; j++)
			{
				count2 += (this.bank[i][j]!= undefined)? this.bank[i][j]:0;
				table += '<td style="text-align:center;">'+((this.bank[i][j]!=undefined)?this.bank[i][j]:'&nbsp;')+'</td>';
			}
			table +='<td style="text-align:center;">'+count2+'</td>';
			table +='</tr>';
			count1 += count2;
		}
	}
	table +='<tr style="font-weight:bold;"><td>&nbsp;</td><td colspan="10" align="right" >Всего монстров: </td><td align="center">'+count1+'</td></tr>';
	table +='</table></center>';
	document.getElementById('monstStat').innerHTML = table;
};*/

//added by Язон Дин Альт
function g(a,b)
{
if(a > b) return 1;
if(a < b) return -1;
if(a==b) return 0;
}

Statistic.prototype.showMonstr = function()
{
	var count1, count2;
	var c = 0;
	var color = initvars.hlColor;
	var minlevel = 21;
	var maxlevel = 0;
	var isMstrLvl=false;
	var isLvl=false;
	var isMstrLvlArr=new Array();
	for(var i in this.bank){
		if(typeof(this.bank[i]) != 'function'){
			for(var j = 0; j <= 21; j++){
				if (this.bank[i][j] != undefined)
				{
					if (minlevel > j) minlevel = j;
					if (maxlevel < j) maxlevel = j;
				}
			}
		}
	}

	var table = '<center><table border="0" cellpadding="0" cellspacing="0" style="font:normal 14px Times, serif"><tr style="font-weight:bold;text-align:center;"><td width="7">&nbsp;</td><td width="15">&nbsp;</td><td colspan="2">&nbsp;</td>';

	for(var j = minlevel; j <= maxlevel; j++)
	{
		isMstrLvl=false;
		for(var i in this.bank)
		{
			if(typeof(this.bank[i]) != 'function')
			{
				if (this.bank[i][j]!= undefined) isMstrLvl=true;
			}
		}
		if (isMstrLvl==true)
		{
			table += '<td width="35"><span title="[' + j + '] уровень!">[' + j + ']</span></td>';
			isMstrLvlArr.push(j);
		}
	}
	isMstrLvlArr=isMstrLvlArr.sort(g);
	table += '<td width="35"><b title="Суммарно">&#931;</b></td></tr>';
	count1 = 0;
	for(var i in this.bank){
		if(typeof(this.bank[i]) != 'function'){
			table += '<tr style="background:'+(((c)%2)?'#E4E4E4':'#F2F2F2')+';">';
			count2 = 0;
			table += '<td style="background:'+color[c]+'"><label for="hlchbx_'+c+'">&nbsp;</label></td><td><input name="hlchbx_'+c+'" type="checkbox" title="Подсветить '+creatures[i].name+'" onclick="highlightMonster(\''+i+'\',this, '+(c++)+')" /></td>';
			table += '<td><img hspace="10" src="'+creatures[i].icon+'" width="17" height="26" /></td><td>'+creatures[i].name+'</td>';
			// дописааать!!!
			for(var j = 0; j <= (isMstrLvlArr.length-1); j++)
			{
				count2 += (this.bank[i][isMstrLvlArr[j]]!= undefined)? this.bank[i][isMstrLvlArr[j]]:0;
				if (this.bank[i][isMstrLvlArr[j]]!=undefined)
				{
					//table += '<td style="text-align:center;">'+i+'</td>';
					table += '<td style="text-align:center;">'+this.bank[i][isMstrLvlArr[j]]+'</td>';
				}
				else
				{
					table += '<td style="text-align:center;">&nbsp;</td>';
				}
			}
			table +='<td style="text-align:center;">'+count2+'</td>';
			table +='</tr>';
			count1 += count2;
		}
	}
	table +='<tr style="font-weight:bold;"><td>&nbsp;</td><td colspan="10" align="right" >Всего монстров: </td><td align="center">'+count1+'</td></tr>';
	table +='</table></center>';
	document.getElementById('monstStat').innerHTML = table;
};

function Cell(){
	this.x = arguments[0];
	this.y = arguments[1];
	this.id = 'cell_'+arguments[0]+'_'+arguments[1];
	this.borders = arguments[2];
	this.name = arguments[3];
	this.creatures = arguments[4] || null;
	this.features = arguments[5] || null;
	this.persons = arguments[6] || null;
	this.htmlSrc = '';
	this.xpos = 0;
	this.ypos = 0;
}

Cell.prototype.drawCell = function(){
	this.offsetX = arguments[0].x;
	this.offsetY = arguments[0].y;
	var style = 'position:absolute;background-color:'+initvars.cellBackgroundColor[initvars.currentUnderground]+';margin-bottom:'+initvars.cellSize+'px;';
	this.htmlSrc  = '<div id="'+this.id+'" align="center" style="'+style+'">';// onclick="callRightClickMenu(event)"

	this.attacheFeatures();
	this.attacheMobs();
	this.htmlSrc += '</div>';

};

Cell.prototype.attacheDigger = function(){
	var style = 'position:absolute;left:'+(parseInt(this.xpos,10)+10)+'px;top:'+(parseInt(this.ypos,10)+12)+'px;z-index:99;';
	//this.htmlSrc += = '<img src="'+initvars.firstFlag+'" style="'+style+'" />';

	//document.getElementById('plane').innerHTML += img;
};

Cell.prototype.attacheFeatures = function(){
	var img, src, style, owp2_direct;
	if(this.features){
		for( var i = 0; i < this.features.length; i++){
			// Направление сторон света: 0 - Север, 1 - Восток, 2 - Юг, 3 - Запад
			if(this.features[i] == 'oneWayPass'){
				src = features[this.features[i]].icon.replace(/\/\d./,initvars.direct+'.');

			}else if(this.features[i] == 'oneWayPass2' || this.features[i] == 'oneWayPass3' || this.features[i] == 'oneWayPass4' || this.features[i] == 'emmeraldEnter' || this.features[i] == 'laddercap45' || this.features[i] == 'laddercap5' || this.features[i] == 'oneWayPass3')
			{
				owp2_direct = ((initvars.direct + 1) == 4)? 0:initvars.direct + 1;
				src = features[this.features[i]].icon.replace(/\/\d./, owp2_direct+'.');

			}else if(this.features[i] == 'oneWayPass5' ){
				owp2_direct = ((initvars.direct - 1) == -1)? 3:(initvars.direct - 1);
				src = features[this.features[i]].icon.replace(/\/\d./, owp2_direct+'.');

			}else if(this.features[i] == 'enterDem31'){
				////owp2_direct = ((initvars.direct - 1) == -1)? 3:(initvars.direct - 1);
				//src = features[this.features[i]].icon.replace(/\/\d./, owp2_direct+'.');
				src = features[this.features[i]].icon.replace(/\/\d./,initvars.direct+'.');


			}else{
				src = features[this.features[i]].icon;
			}
			var filter = '';
			if ('highlight' in features[this.features[i]])
			{
				var filterColor = '#ff0000';
				switch (features[this.features[i]].highlight)
				{
					case 2:
					filterColor = '#00ff00';
					break;
					default:
					break;
				}
				filter = (document.all && !initvars.isOpera)?'filter:Glow(color=' + filterColor + ',strength=3);' : 'border:1px solid ' + filterColor + ';';
			}
			style = 'cursor:help;margin-top:3px;'+ filter;
			img  = '<img id="'+this.features[i]+'" src="'+src+'" style="'+style+'" ';
			img += 'onmouseover="callShowToolTip(event)" onmouseout="callHideToolTip(event)" />';

			this.htmlSrc += img;
		}
	}
};

Cell.prototype.attacheMobs = function(){
	var img, id, src, top, left;
	if(this.creatures){
		for( var i = 0; i < this.creatures.length; i++){

			if(this.creatures.length == 1){

				left = initvars.cellSize / 2 - 8;
				top  = initvars.cellSize / 2 - 13;

			}else if(this.creatures.length == 2){

				left = initvars['imgPos'+(i + 1)];
				top  = initvars.cellSize / 2 - 13;

			}else if(this.creatures.length == 3){

				left = initvars['imgPos'+(i+1)];
				top  = (i < 2) ? 0 : initvars.cellSize / 2 - 8;

			}else if(this.creatures.length > 3){

				left = initvars['imgPos' + ( ( (i < 2)? i : i - 2) + 1) ];
				top  = (i < 2) ? -3 : initvars.cellSize / 2 - ((i == 4)? 10 : 4);

			}
			initvars.monstrStat.addMonstr(this.creatures[i].name, this.creatures[i].level, this.creatures[i].count);

			id = this.creatures[i].name+'_'+this.creatures[i].level+'_'+this.creatures[i].count+'_'+((this.creatures[i].alignment)?this.creatures[i].alignment:0)+'_'+this.x+this.y;
			style = 'cursor:help;position:absolute;top:'+top+'px;left:'+left+'px;';
			src = creatures[this.creatures[i].name].icon;
			src = (this.creatures[i].alignment)? src.replace(/\.gif/,'a.gif'):src;
			img  = '<img id="'+id+'" style="'+style+'" src="'+src+'" width="17" height="26" ';
			img += 'onmouseover="callShowToolTip(event)" onmouseout="callHideToolTip(event)" />';

			this.htmlSrc += img;
		}
	}
};


Cell.prototype.moveCell = function(){
	var i, borders, cwidth, cheight, btop, bright, bbottom, bleft;

	cwidth  = initvars.cellSize + 1;
	cheight = initvars.cellSize + 1;

	var currentBorderDirection = this.borders.slice(initvars.direct).concat(this.borders);

	btop    = (!currentBorderDirection[0])? '2px solid '+initvars.cellBorderColor[initvars.currentUnderground]:'none';
	bright  = (!currentBorderDirection[1])? '2px solid '+initvars.cellBorderColor[initvars.currentUnderground]:'none';
	bbottom = (!currentBorderDirection[2])? '2px solid '+initvars.cellBorderColor[initvars.currentUnderground]:'none';
	bleft   = (!currentBorderDirection[3])? '2px solid '+initvars.cellBorderColor[initvars.currentUnderground]:'none';

	if(!document.all){
		cheight -= (!currentBorderDirection[0])? 2: 0;
		cwidth -= (!currentBorderDirection[1])? 2: 0;
		cheight -=  (!currentBorderDirection[2])? 2: 0;
		cwidth -= (!currentBorderDirection[3])? 2: 0;
	}
	//alert(this.offsetX+' - '+this.offsetY);
	switch(initvars.direct){
		case 0:
		this.xpos = this.x * initvars.cellSize - 1;
		this.ypos = this.y * initvars.cellSize - 1;
		break;
		case 1:
		this.xpos = this.y * initvars.cellSize - 1;
		this.ypos = (initvars.cellSize * (this.offsetX-1)) - this.x * initvars.cellSize - 1;
		break;
		case 2:
		this.xpos = (initvars.cellSize * (this.offsetX-1)) - this.x * initvars.cellSize - 1;
		this.ypos = (initvars.cellSize * (this.offsetY-1)) - this.y * initvars.cellSize - 1;
		break;
		case 3:
		this.xpos = (initvars.cellSize * (this.offsetY-1)) - this.y * initvars.cellSize - 1;
		this.ypos = this.x * initvars.cellSize - 1;
		break;
	}
	if(initvars.isOpera){
		this.xpos -= 1;
		this.ypos -= 1;
	}
	with(document.getElementById(this.id).style){
		top = this.ypos + 'px';
		left = this.xpos + 'px';
		width = cwidth + 'px';
		height = cheight + 'px';
		borderTop = btop;
		borderRight = bright;
		borderBottom = bbottom;
		borderLeft = bleft;
	}
	if(this.features){
		var x, owp2_direct;
		for( i = 0; i < this.features.length; i++){

			if(( x = document.getElementById('oneWayPass')) != null && this.features[i] == 'oneWayPass' ){
				x.src = features['oneWayPass'].icon.replace(/\d./, initvars.direct+'.');

			}else if(( x = document.getElementById('oneWayPass2')) != null && this.features[i] == 'oneWayPass2' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				x.src = features['oneWayPass2'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('oneWayPass3')) != null && this.features[i] == 'oneWayPass3' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				x.src = features['oneWayPass3'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('oneWayPass4')) != null && this.features[i] == 'oneWayPass4' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				x.src = features['oneWayPass4'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('oneWayPass5')) != null && this.features[i] == 'oneWayPass5' ){
				owp2_direct = ((initvars.direct - 1) == -1)? 3:(initvars.direct - 1);
				x.src = features['oneWayPass5'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('emmeraldEnter')) != null && this.features[i] == 'emmeraldEnter' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				x.src = features['emmeraldEnter'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('enterDem31')) != null && this.features[i] == 'enterDem31' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				x.src = features['enterDem31'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('enterDem32')) != null && this.features[i] == 'enterDem32' ){
				x.src = features['enterDem32'].icon.replace(/\d./, initvars.direct+'.');

			}else if(( x = document.getElementById('enterDem41')) != null && this.features[i] == 'enterDem41' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				x.src = features['enterDem41'].icon.replace(/\d./, owp2_direct+'.');



			}else if(( x = document.getElementById('enterGG')) != null && this.features[i] == 'enterGG' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				x.src = features['enterGG'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('enterab')) != null && this.features[i] == 'enterab' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				x.src = features['enterab'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('enterab1')) != null && this.features[i] == 'enterab1' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				x.src = features['enterab1'].icon.replace(/\d./, owp2_direct+'.');



			}else if(( x = document.getElementById('laddercap45')) != null && this.features[i] == 'laddercap45' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				x.src = features['laddercap45'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('laddercap5')) != null && this.features[i] == 'laddercap5' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				x.src = features['laddercap5'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('enterDem22')) != null && this.features[i] == 'enterDem22' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				x.src = features['enterDem22'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('enterDem33')) != null && this.features[i] == 'enterDem33' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				x.src = features['enterDem33'].icon.replace(/\d./, owp2_direct+'.');

			}else if(( x = document.getElementById('Enterlabirint')) != null && this.features[i] == 'Enterlabirint' ){
				x.src = features['Enterlabirint'].icon.replace(/\d./, initvars.direct+'.');

			}

		}
	}


};
function callRightClickMenu(evt){
	evt = (evt) ? evt : ((window.event) ? event : null);
	if (evt) {
		var elem = (evt.target) ? evt.target : evt.srcElement;
		var offsetLeft = 0;
		var offsetTop = 0;
		var text = '<ul><li><a href="javascript:void(0)">переместить</a></li><li>';
		text += '<a href="javascript:void(0)">расчитать маршрут</a></li></ul>';

		while (elem.id != 'plane') {
			offsetLeft += elem.offsetLeft;
			offsetTop += elem.offsetTop;
			elem = elem.offsetParent;
		}



		initvars.rightClickMenu.style.left = offsetLeft + 12 + 'px';
		initvars.rightClickMenu.style.top = offsetTop + 18 + 'px';
		initvars.rightClickMenu.innerHTML = text;

		if (initvars.delay != -1){
			clearTimeout(initvars.TimeoutID);
			initvars.rc_TimeoutID = setTimeout("showRightClickMenu()", initvars.delay);
		}
	}
}

function callHideRightClickMenu(){
	clearTimeout(initvars.rc_TimeoutID);
	initvars.rc_TimeoutID = setTimeout("hideRightClickMenu()", initvars.delay);
}

function showRightClickMenu(){
	initvars.rightClickMenu.style.display = "";
	clearTimeout(initvars.rc_TimeoutID);
	initvars.rc_TimeoutID = setTimeout("hideRightClickMenu()", initvars.duration * 500);
}

function hideRightClickMenu(){
	clearTimeout(initvars.rc_TimeoutID);
	initvars.rightClickMenu.style.display = "none";
}







function callShowToolTip(evt){
	evt = (evt) ? evt : ((window.event) ? event : null);
	if (evt) {
		var elem = (evt.target) ? evt.target : evt.srcElement;
		var offsetLeft = 0;
		var offsetTop = 0;
		var source = elem.id.split('_');

		var text = '';

		if(source.length > 1){
			var hp;
			text  = '<img src="'+creatures[source[0]].src+'" ';
			text += 'style="margin-right:10px;margin-bottom:5px; width:65px; height:115px;" align="left" ';
			var feature = creatures[source[0]].levels;
			var align;

			for(var i = 0; i < feature.length; i++)
			{
				align = (parseInt(source[3],10))? (parseInt(source[3],10)==feature[i].align) : true;
				if(feature[i].level == source[1] && align)
				{
					hp = feature[i].hp;
					break;
				}
			}

			text += '/>';
			text += ((creatures[source[0]].alignment || parseInt(source[3],10))?'<img src="'+imP2+'align'+((creatures[source[0]].alignment==1 || parseInt(source[3],10)==1)?9:3)+'.gif" align="absmiddle" />':'');
			text += '<b>'+creatures[source[0]].name+' ['+source[1]+'] ('+hp+'HP)</b><br />';
			text += '<b>В количестве: '+source[2]+' шт.</b>';
			text += '<br />Сила: '+feature[i].str+'<br />Ловкость: '+feature[i].dex;
			text += '<br />Интуиция: '+feature[i].inst+'<br />Выносливость: '+feature[i].power;
			text += '<br />Интеллект: '+feature[i].intel+'<br />Мудрость: '+feature[i].wis+'<hr>';
			text += ''+creatures[source[0]].descr+'<br /><b>Место рождения: '+creatures[source[0]].birthplace+'</b>';


			initvars.tooltip.style.width = '320px';
		}

		else{
			var owp2_direct, src;
			src = features[elem.id].src;
			if( elem.id == 'oneWayPass' ){
				src = features['oneWayPass'].icon.replace(/\d./, initvars.direct+'.');

			}else if(elem.id == 'oneWayPass2' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				src = features['oneWayPass2'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'oneWayPass3' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				src = features['oneWayPass3'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'oneWayPass4' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				src = features['oneWayPass4'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'oneWayPass5' ){
				owp2_direct = ((initvars.direct - 1) == -1)? 3:(initvars.direct - 1);
				src = features['oneWayPass5'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'emmeraldEnter' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				src = features['emmeraldEnter'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'enterDem31' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				src = features['enterDem31'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'enterDem32' ){
				src = features['enterDem32'].icon.replace(/\d./, initvars.direct+'.');

			}else if(elem.id == 'laddercap45' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				src = features['laddercap45'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'laddercap5' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				src = features['laddercap5'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'enterDem22' ){
				owp2_direct = ((initvars.direct + 1) == 4)? 0:(initvars.direct + 1);
				src = features['enterDem22'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'enterDem33' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				src = features['enterDem33'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'enterDem41' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				src = features['enterDem41'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'enterGG' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				src = features['enterGG'].icon.replace(/\d./, owp2_direct+'.');

			}else if(elem.id == 'enterab' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				src = features['enterab'].icon.replace(/\d./, owp2_direct+'.');
			}else if(elem.id == 'enterab1' ){
				owp2_direct = ((initvars.direct + 2) == 4)? 0:((initvars.direct + 2)==5?1:(initvars.direct + 2));
				src = features['enterab1'].icon.replace(/\d./, owp2_direct+'.');


			}else if(elem.id == 'Enterlabirint' ){
				src = features['Enterlabirint'].icon.replace(/\d./, initvars.direct+'.');

			}

			var useFilter = (features[elem.id].src.indexOf('.png') !=-1) && document.all && !initvars.isOpera;

			text  = '<img src="'+((useFilter)? initvars.imageBlank:src)+'" ';
			text += 'style="margin-right:10px;margin-bottom:10px;'+((src.indexOf('.png') !=-1 && features[elem.id].w)? ' width:'+features[elem.id].w+'px; height:'+features[elem.id].h+'px;':' width:60px; height:60px;');
			text += ((useFilter)?'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='+src+',sizingmethod=scale);':'')+'" align="left" />';
			text += '<b>'+features[elem.id].name+'</b><br />';
			text += (features[elem.id].descr)? features[elem.id].descr:'';
			initvars.tooltip.style.width = '300px';
		}

		while (elem.id != 'plane') {
			offsetLeft += elem.offsetLeft;
			offsetTop += elem.offsetTop;
			elem = elem.offsetParent;
		}

		initvars.tooltip.style.left = offsetLeft * initvars.zoom/100 + 100 + 'px';
		initvars.tooltip.style.top = offsetTop * initvars.zoom/100 + 140 + 'px';
		initvars.tooltip.innerHTML = text;

		if (initvars.delay != -1){
			clearTimeout(initvars.TimeoutID);
			initvars.TimeoutID = setTimeout("showToolTip()", initvars.delay);
		}

	}
}

function callHideToolTip(){
	clearTimeout(initvars.TimeoutID);
	initvars.TimeoutID = setTimeout("hideToolTip()", initvars.delay);
}

function showToolTip(){
	initvars.tooltip.style.visibility = 'visible';
	clearTimeout(initvars.TimeoutID);
	initvars.TimeoutID = setTimeout("hideToolTip()", initvars.duration * 1000);
}

function hideToolTip(){
	clearTimeout(initvars.TimeoutID);
	initvars.tooltip.style.visibility = 'hidden';
}

function Underground(){
	this.name = arguments[0];
	this.floors = arguments[1];
	this.icon = arguments[2];
	this.dim = arguments[3];
	this.direct = arguments[4];
}

function startMapDrawing(cU, cF){
	SetCookie('ug_cF', cF, exp);
	SetCookie('ug_cU', cU, exp);
	initvars.currentUnderground = cU;
	initvars.currentFloor = cF;
	underground[cU].drawMap(cF);
}
function redrawMap(cF){
	SetCookie('ug_cF', cF, exp);
	initvars.currentFloor = cF;
	underground[initvars.currentUnderground].redrawMap(cF);
}
function changeZoom(zoom){
	initvars.zoom = zoom;
	underground[initvars.currentUnderground].redrawMap(initvars.currentFloor);
}
Underground.prototype.drawMap = function(fnum){
	var baseDiv;
	baseDiv  = '<h2 id="umheader" style="margin:0px; padding-top:0px; ">&nbsp;</h2>';
	baseDiv += '<table border="0" cellpadding="0" cellspacing="10" style="" ><tr>';

	baseDiv += '<td valign="top"><div id="floor" style="margin:0px 25px 25px;"></div></td>';
	baseDiv += '<td valign="top" rowspan="2" width="130"><div style="position:relative;width:128px;height:145px;background:url('+initvars.compassBG+') no-repeat center top;text-transform:uppercase;font:bold 12px Arial, sans-serif;">';
	baseDiv += '<div id="compass1" style="position:absolute;top:72px;right:0px;"><a href="javascript:underground[0].turnMap(1);">с</a></div>';
	baseDiv += '<div id="compass2" style="position:absolute;top:132px;left:60px;"><a href="javascript:underground[0].turnMap(2);">в</a></div>';
	baseDiv += '<div id="compass3" style="position:absolute;top:72px;left:0px;"><a href="javascript:underground[0].turnMap(3);">З</a></div></div>';
	baseDiv += '<ul id="floorMenu" style="width:240px;margin:15px 0px;"></ul></td></tr><tr>';
	baseDiv += '<td><fieldset><legend>Количество монстров</legend><div id="monstStat"></div></fieldset></td>';
	baseDiv += '</tr></table>';

	document.getElementById(sections[0].id).innerHTML = baseDiv;

	document.getElementById('umheader').innerHTML = "";

	initvars.direct = this.direct;

	this.redrawMap(fnum);
};
function scrollPlane(obj){
	document.getElementById('gorLine').scrollLeft = obj.scrollLeft;
	document.getElementById('vertLine').scrollTop = obj.scrollTop;
	window.status = obj.scrollLeft+" - "+obj.scrollTop
}
Underground.prototype.redrawMap = function(fnum){
	var li = '';
	var floors;
	for(var j = 0; j < all_maps.length; j++){
		if(j == initvars.currentUnderground){
			li += '<li style="list-style-type:disc;color:#990000;"><img src="'+all_maps[j].src+'" border="0" align="absmiddle" />&nbsp;'+all_maps[j].name+'<ul>';
		}else{
			li += '<li style="list-style:none;"><a href="javascript:startMapDrawing('+j+',0)" ><img src="'+all_maps[j].src+'" border="0" align="absmiddle" />&nbsp;'+all_maps[j].name+'</a><ul>';
		}
		floors = underground[j].floors;
		for(var i = 0; i < floors.length; i++){
			if(i == initvars.currentFloor && j == initvars.currentUnderground){
				li += '<li style="list-style-type:disc;color:#990000;">'+(i+1)+'-й этаж</li>';
			}else{
				li += '<li style="list-style:none;"><a href="';
				li += (j == initvars.currentUnderground)?'javascript:redrawMap('+i+')" >':'javascript:startMapDrawing('+j+','+i+')" >';
				li += (i+1)+'-й этаж</a></li>';
			}
		}
		li += '</ul>'
	}

	var comp_dir = ['cевер','восток','юг','запад'];
	var link_str, directID;

	for(var i = 0; i < 4; i++){
		directID = ((i + initvars.direct) < 4)? i + initvars.direct: i + initvars.direct-4;

		link_str  = '<span>';
		link_str += comp_dir[directID].charAt(0)+'</span>';

		if(i)document.getElementById('compass'+i).innerHTML = link_str;
	}
	var offcetX, offcetY;
	if(initvars.direct == 0 || initvars.direct == 2){
		offcetX = this.dim[fnum].x;
		offcetY = this.dim[fnum].y;
	}
	if(initvars.direct == 1 || initvars.direct == 3){
		offcetX = this.dim[fnum].y;
		offcetY = this.dim[fnum].x;
	}

	var style = 'font:bold 18px;text-align:center;color:#990000;    font-weight: bold;padding-bottom: 10px;';
	var table_str  = '<div id="currentPlace" style="'+style+'">Этаж '+(initvars.currentFloor+1)+'</div>';
	// added by Язон Дин Альт
	var letters=new Array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','aa','ab','ac','ad','ae','af','ag','ah','ai','aj','ak','al');
	
	table_str += '<div id="currentDirection" style="text-align:right;"></div>';
	// горизонталь
	table_str += '<div style="position:relative;top:0px;left:0px;zoom:'+initvars.zoom+'%;">';
	style = 'width:'+((offcetX+1)*initvars.cellSize)+'px;height:'+initvars.cellSize+'px;position:relative;';
	style += 'background:'+initvars.coordBackgroundColor[initvars.currentUnderground]+';';
	table_str += '<div id="gorLine" style="'+style+'">';

	for(i = 0; i < offcetX + 1; i++){
		style  = 'font:bold 16px Arial,sans-serif;color:#ffffff;border-right:1px solid '+initvars.mapBorderColor+';text-align:center;line-height:40px;';
		style += 'position:absolute;top:0px;left:'+((initvars.cellSize)*i)+'px;';
		style += 'width:'+(initvars.cellSize+1)+'px;height:'+(initvars.cellSize+1)+'px';

		table_str += '<div style="'+style+'" >';
		if(i){
			switch( initvars.direct ){
				case 0:
				table_str += letters[i-1];
				//table_str += String.fromCharCode(96+i); // 
				break;
				case 1:
				table_str += i;
				break;
				case 2:
				table_str += letters[offcetX-i];
				//table_str += String.fromCharCode(96+offcetX+1-i);
				break;
				case 3:
				table_str += offcetX+1-i;
				break;
			}
		}

		table_str += '</div>';
	}
	
	table_str += '</div>';

	// вертикаль
	style = 'width:'+initvars.cellSize+'px;height:'+(offcetY*initvars.cellSize)+'px;position:relative;';
	style += 'background:'+initvars.coordBackgroundColor[initvars.currentUnderground]+';';
	table_str += '<div id="vertLine" style="'+style+'">';

	for(i = 1; i < offcetY + 1; i++){
		style  = 'font:bold 16px Arial,sans-serif;color:#ffffff;border-top:1px solid '+initvars.mapBorderColor+';text-align:center;line-height:40px;';
		style += 'position:absolute;top:'+(initvars.cellSize*(i-1))+'px;left:0px;';
		style += 'width:'+(initvars.cellSize+1)+'px;height:'+(initvars.cellSize+1)+'px;';

		table_str += '<div style="'+style+'" >';
		switch( initvars.direct ){
			case 0:
			table_str += i;
			break;
			case 1:
			table_str += letters[offcetY-i];
			//table_str += String.fromCharCode(96+offcetY+1-i);
			break;
			case 2:
			table_str += offcetY+1-i;
			break;
			case 3:
			table_str += letters[i-1];
			//table_str += String.fromCharCode(96+i);
			break;
		}
		table_str += '</div>';
	}
	table_str += '</div>';

	//поле

	style  = 'position:absolute; top:'+(initvars.cellSize)+'px;left:'+(initvars.cellSize)+'px;';
	style += 'width:'+(initvars.cellSize*offcetX)+'px;height:'+(initvars.cellSize*offcetY)+'px;border:1px solid '+initvars.mapBorderColor+';';
	style += 'background: #ffffff url('+initvars.mapBackgroundImage+') top left;';
	table_str += '<div id="plane" style="'+style+'"></div>';



	document.getElementById('floor').innerHTML = table_str;
	
	var li1 = '';
	var li2 = '';
	var li3 = '';
	var li4 = '';
	var li5 = '';

	if(localStorage.PtpFloor == undefined){
		li1 = '<li style="list-style:none;font-size: 16px;font-weight: bold;" id="menuFloor1Click">1-й этаж</li>'
	}else if(localStorage.PtpFloor != 1){
		li1 = '<li style="list-style:none;" id="menuFloor1Click"><a href="javascript:startMapDrawing(0,0)" style="font-size: 16px;" >1-й этаж</a></li>'
	}else{
		li1 = '<li style="list-style:none;font-size: 16px;font-weight: bold;" id="menuFloor1Click">1-й этаж</li>'
	}
	if(localStorage.PtpFloor != 2){
		li2 = '<li style="list-style:none;" id="menuFloor2Click"><a href="javascript:startMapDrawing(0,1)" style="font-size: 16px;" >2-й этаж</a></li>'
	}else{
		li2 = '<li style="list-style:none;font-size: 16px;font-weight: bold;" id="menuFloor2Click">2-й этаж</li>'
	}
	if(localStorage.PtpFloor != 3){
		li3 = '<li style="list-style:none;" id="menuFloor3Click"><a href="javascript:startMapDrawing(0,2)" style="font-size: 16px;" >3-й этаж</a></li>'
	}else{
		li3 = '<li style="list-style:none;font-size: 16px;font-weight: bold;" id="menuFloor3Click">3-й этаж</li>'
	}

	if(localStorage.PtpFloor != 4){
		li4 = '<li style="list-style:none;" id="menuFloor4Click"><a href="javascript:startMapDrawing(0,3)" style="font-size: 16px;" >4-й этаж</a></li>'
	}else{
		li4 = '<li style="list-style:none;font-size: 16px;font-weight: bold;" id="menuFloor4Click">4-й этаж</li>'
	}	
	if(localStorage.PtpFloor != 5){
		li5 = '<li style="list-style:none;" id="menuFloor5Click"><a href="javascript:startMapDrawing(0,4)" style="font-size: 16px;" >5-й этаж</a></li>'
	}else{
		li5 = '<li style="list-style:none;font-size: 16px;font-weight: bold;" id="menuFloor5Click">5-й этаж</li>'
	}
	document.getElementById('floorMenu').innerHTML = '<ul style="margin-left: -70px; font-size: 16px;"><li style="list-style-type:none;color:#990000;font-size: 18px;font-weight: bold;"><img src="pages/maps/images/city/8.gif" border="0" align="absmiddle">&nbsp;Пещера тысячи проклятий<ul >'+li1+li2+li3+li4+li5+'</ul></li></ul>';

	var menuLink1 = document.getElementById('menuFloor1Click');
	var menuLink2 = document.getElementById('menuFloor2Click');
	var menuLink3 = document.getElementById('menuFloor3Click');
	var menuLink4 = document.getElementById('menuFloor4Click');
	var menuLink5 = document.getElementById('menuFloor5Click');
	menuLink1.onclick = function() {
		localStorage.PtpFloor = 1;
	}
	menuLink2.onclick = function() {
		localStorage.PtpFloor = 2;
	}
	menuLink3.onclick = function() {
		localStorage.PtpFloor = 3;
	}
	menuLink4.onclick = function() {
		localStorage.PtpFloor = 4;
	}
	menuLink5.onclick = function() {
		localStorage.PtpFloor = 5;
	}
	var style, rightClickMenu, tooltip;

	style  = 'position:absolute;font:12px Arial, sans-serif;padding:5px;';
	style += 'border:1px solid #b4b4b4;width:150px;display:none;';
	style += 'filter:alpha( style=0,opacity=80);z-index:101;';
	style += 'background:'+((document.all && !initvars.isOpera)?'#ffffff':'url('+initvars.tooltipBG+')')+';';

	rightClickMenu  = '<div id="rightClickMenu" style="'+style+'" ';
	rightClickMenu += 'onmouseover="clearTimeout(initvars.rc_TimeoutID);" ';
	rightClickMenu += 'onmouseout="clearTimeout(initvars.rc_TimeoutID);initvars.rc_TimeoutID = setTimeout(\'hideRightClickMenu()\', initvars.delay);" ></div>';

	// всплывающие подсказки
	style  = 'position:absolute; top:0px; left:0px; color: #444444; font:12px Arial, sans-serif; padding:10px;';
	style += 'border:1px solid #b4b4b4; width:300px; visibility: hidden;';
	style += 'filter:alpha( style=0,opacity=85); z-index:100;';
	style += 'background:'+((document.all && !initvars.isOpera)?'#ffffcc':'url('+initvars.tooltipBG+')')+';';

	tooltip = '<div id="tooltip" style="'+style+'" ';
	tooltip += 'onmouseover="clearTimeout(initvars.TimeoutID);" ';
	tooltip += 'onmouseout="clearTimeout(initvars.TimeoutID);initvars.TimeoutID = setTimeout(\'hideToolTip()\', initvars.delay);" ></div>';

	document.getElementById('floor').innerHTML += tooltip;//rightClickMenu + tooltip;


	initvars.rightClickMenu = document.getElementById('rightClickMenu');
	initvars.tooltip = document.getElementById('tooltip');

	var htmlTemp = '';
	initvars.monstrStat = new Statistic();

	for( i = 0; i < this.floors[fnum].length; i++){

		this.floors[fnum][i].drawCell(this.dim[fnum]);
		htmlTemp += this.floors[fnum][i].htmlSrc;

	}
	initvars.monstrStat.showMonstr();

	document.getElementById('plane').innerHTML = htmlTemp;


	for( i = 0; i < this.floors[fnum].length; i++){

		this.floors[fnum][i].moveCell();

	}
};

Underground.prototype.turnMap = function(direct){

	/*var old_direct = initvars.direct;
	var scrollLeft = document.getElementById('scrollPlane').scrollLeft;
	var scrollTop = document.getElementById('scrollPlane').scrollTop;*/

	initvars.direct = direct;
	SetCookie('ug_cD', direct, exp);



	this.redrawMap(initvars.currentFloor);

	/*if(old_direct + 2 == direct || old_direct - 2 == direct){
	document.getElementById('scrollPlane').scrollTop = 438 - scrollTop;
	document.getElementById('scrollPlane').scrollLeft = 438 - scrollLeft;
	}else{
	document.getElementById('scrollPlane').scrollTop = 438 - scrollLeft;
	document.getElementById('scrollPlane').scrollLeft = 438 - scrollTop;
	}*/

	//alert(scrollLeft+" - "+scrollTop);

};