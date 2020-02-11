// JScript source code

// common JavaScript code 
// Author: Akzhan Abdulin

// This code is common to all my DarkClan scripts.

var dcACommonScriptVersion = 200;


var popupDivId = "popupDiv";
var defaultTipOpacity = 85;
var popupXOffset = 30;
var popupYOffset = 10;
var popupWidth = 200;
var popupTimer = "";
var popupActive = false;

var menuDivId = "menuDiv";
var pmenuDivId = "pmenuDiv";
var defaultMenuOpacity = 92;
var menuXOffset = -64;
var menuYOffset = 5;
var clearMenuOnceWhenClosed = false;
var dc_menuItemCount = 0;
var persistMenuReady = false;
var persistMenuOpened = false;

var cursorX = 0;
var cursorY = 0;
var moz = (document.getElementById && !document.all);

// string manipulation

function replacestr(source, what, replaceWith)
{
	var retValue = [];
	var i;
	while (true)
	{
		i = source.indexOf(what);
		if (i >= 0)
		{
			retValue.push(source.substr(0, i));
			retValue.push(replaceWith);
			source = source.substr(i + what.length);
		}
		else
		{
			break;
		}
	}
	retValue.push(source);
	return retValue.join('');
}

var htmlEntities = new Array(
	{ what: '<', replaceWith: '&lt;' },
	{ what: '>', replaceWith: '&gt;' },
	{ what: "'", replaceWith: '&apos;' },
	{ what: '"', replaceWith: '&quot;' }
	);

function htmlstring(s)
{
	for (var i = 0; i < htmlEntities.length; i++)
	{
		s = replacestr(s, htmlEntities[i].what, htmlEntities[i].replaceWith);
	}
	return s;
}

function format(fmt)
{
  var retValue = fmt;
  for (var i = 1; i < format.arguments.length; i++)
  {
    var sp = '{' + (i - 1) + '}';
    retValue = replacestr(retValue, sp, '' + format.arguments[i]);
  }
  return retValue;
}

function trim(s)
{
	var li = 0;
	var ri = s.length - 1;
	for (; li < ri; li++)
	{
		if (s.charAt(li) != ' ')
		{
			break;
		}
	}
	for (; ri >= li; ri--)
	{
		if (s.charAt(ri) != ' ')
		{
			break;
		}
	}
	return s.substring(li, ri);
}

// browser compatibility

if(document.all && !document.getElementById)
{
    document.getElementById = function(id)
    {
         return document.all[id];
    }
}

// images preloading

function dc_preimg()
{
  for (var i = 0; i < dc_preimg.arguments.length; i++)
  {
    var img = new Image();
    img.src = dc_preimg.arguments[i];
  }
}

// popups

function showPopup(message) 
{
	var obj_id = document.getElementById(popupDivId);
	obj_id.innerHTML = message;
	objWidth = obj_id.offsetWidth;
	popupActive = true;
	if (uiOptions.useTransitionEffects)
	{
		obj_id.filters['blendtrans'].apply();
	}
	obj_id.style.visibility = "visible";
	if (uiOptions.useTransitionEffects)
	{
		obj_id.filters['blendtrans'].play();
	}
	followMouse();
}

function followMouse()
{
	if (!popupActive)
	{
		return;
	}
	var obj_id = document.getElementById(popupDivId);
	var x = 0;
	var y = 0;
	if(cursorX > document.body.clientWidth / 2 && cursorX < document.body.clientWidth)
	{
		x = cursorX - objWidth;
		y = cursorY + popupYOffset;
	}
	else
	{
		x = cursorX + popupXOffset;
		y = cursorY + popupYOffset;
	}
	obj_id.style.left = x + "px";
	obj_id.style.top  = y + "px";
	popupTimer = setTimeout("followMouse()", 50);
}

function hidePopup()
{
	var obj_id = document.getElementById(popupDivId);
	obj_id.style.visibility = "hidden";
	clearTimeout(popupTimer);
	popupActive = false;
}

// menus

function prepareMenuCore(menu)
{
	if (is.ie)
	{
		menu.style.backgroundColor = 'window';
		menu.style.color = 'windowtext';
		menu.style.borderColor = 'windowtext';
	}
}

function prepareMenu()
{
	var menu = document.getElementById(menuDivId);
	prepareMenuCore(menu);
}

function showMenuCore(menu, capture)
{
	var x = cursorX;
	var y = cursorY;
	menu.style.left = x + "px";
	menu.style.top  = y + "px";
	hidePopup();
	if (menu.style.visibility != "visible") 
	{
		if (uiOptions.useTransitionEffects)
		{
			menu.filters['blendtrans'].apply();
		}
		menu.style.visibility = "visible";
		if (uiOptions.useTransitionEffects)
		{
			menu.filters['blendtrans'].play();
		}
		if (is.ie)
		{
			var trange = document.body.createTextRange();
			trange.moveToElementText(menu);
			trange.scrollIntoView();
		}
	}
	if ((capture == null || capture) && menu.setCapture && uiOptions.captureMouse)
	{
		menu.setCapture(false);
	}
}

function showMenu(content, capture)
{
	if (document.releaseCapture)
	{
		document.releaseCapture();
	}
	if (persistMenuOpened)
	{
		hideMenuCore();
	}
	var menu = document.getElementById(menuDivId);
	menu.innerHTML = content;
	showMenuCore(menu, capture);
	persistMenuOpened = false;
}

function initPersistMenu(menu)
{
	prepareMenuCore(menu);
}

function dropPersistMenuSection(pid)
{
	pid = 'pmid_' + pid;
	var pd = document.getElementById(pid);
	if (pd != null)
	{
		pd.style.display = 'none';
		pd.innerHTML = '';
	}
}

function hasPersistMenuSection(pid)
{
	pid = 'pmid_' + pid;
	var pd = document.getElementById(pid);
	return (pd != null) && (pd.innerHTML != '');
}

function hidePersistSections(menu)
{
	if (!menu.childNodes)
	{
		return;
	}
	for (var i = 0; i < menu.childNodes.length; i++)
	{
		var elt = menu.childNodes[i];
		if (elt.id.indexOf('pmid_') != 0)
		{
			continue;
		}
		elt.style.display = 'none';
	}
}

function showPersistMenuSection(pid, capture)
{
	if (document.releaseCapture)
	{
		document.releaseCapture();
	}
	hideMenuCore();
	var menu = document.getElementById(pmenuDivId);
	hidePersistSections(menu);
	pid = 'pmid_' + pid;
	var pd = document.getElementById(pid);
	pd.style.display = '';
	showMenuCore(menu, capture);
	persistMenuOpened = true;
}

function showPersistMenu(pid, content, capture)
{
	if (document.releaseCapture)
	{
		document.releaseCapture();
	}
	hideMenuCore();
	var menu = document.getElementById(pmenuDivId);
	if (!persistMenuReady)
	{
		initPersistMenu(menu);
	}
	hidePersistSections(menu);
	pid = 'pmid_' + pid;
	var pd = document.getElementById(pid);
	if (pd == null)
	{
		pd = document.createElement('div');
		pd.id = pid;
		pd.innerHTML = content;
		menu.appendChild(pd);
	}
	else
	{
		if (pd.innerHTML != content)
		{
			pd.innerHTML = content;
		}
		pd.style.display = '';
	
	}
	showMenuCore(menu, capture);
	persistMenuOpened = true;
}

function reshowMenu(capture)
{
	var menu = document.getElementById(persistMenuOpened ? pmenuDivId : menuDivId);
	hidePopup();
	menu.style.visibility = "visible";
	if ((capture == null || capture) && menu.setCapture && uiOptions.captureMouse)
	{
		menu.setCapture(false);
	}
}

function hideMenu()
{
	if (document.releaseCapture)
	{
		document.releaseCapture();
	}
	hideMenuCore();
}

function hideMenuCore()
{
	var menu = document.getElementById(menuDivId);
	if (clearMenuOnceWhenClosed)
	{
		menu.innerHTML = '';
		clearMenuOnceWhenClosed = false;
	}
	menu.style.visibility = 'hidden';
	var menu = document.getElementById(pmenuDivId);
	menu.style.visibility = 'hidden';
	hidePersistSections(menu);
	hidePopup();
	closeInfoSpace();
}

function onMenuClick()
{
	var menu = document.getElementById(persistMenuOpened ? pmenuDivId : menuDivId);
	if (!is.ie)
	{
		return;
	}
	var o = window.event.srcElement;
	if (menu != o && !menu.contains(o))
	{
		hideMenu();
	}
}


function getMenuItemHtml(html, action)
{
	return format('<a class="ABLink" href="#" onclick="hideMenu(); {1}; return false">{0}</a>', html, action);
}

function onCellOver(id)
{
	var elt = document.getElementById(id);
	if (elt != null)
	{
		elt.className = "ABLinkH";
	}
}

function onCellOut(id)
{
	var elt = document.getElementById(id);
	if (elt == null)
	{
		return;
	}
	elt.className = "ABLink";
}

function onCellClick_Core(id)
{
	var oldv = clearMenuOnceWhenClosed;
	clearMenuOnceWhenClosed = false;
	var r = onCellClick(id);
	clearMenuOnceWhenClosed = oldv;
	return r;
}

function onCellClick(id)
{
	onCellOut(id);
	hideMenu();
	return true;
}

function getCellMenuItemHtml_Core(html, action, over, out)
{
	if (over == null)
	{
		over = '';
	}
	if (out == null)
	{
		out = '';
	}
	var newid = 'cmi_' + dc_menuItemCount;
	dc_menuItemCount++;
	var qnewid = "'" + newid + "'";
	return format('<td align="center"><div id="{4}" class="ABLink" onmouseover="onCellOver({5}); {2}" onmouseout="onCellOut({5}); {3}" onclick="onCellClick_Core({5}); {1}">{0}</div></td>', html, action, over, out, newid, qnewid);
}

function getCellMenuItemHtml(html, action, over, out)
{
	if (over == null)
	{
		over = '';
	}
	if (out == null)
	{
		out = '';
	}
	var newid = 'cmi_' + dc_menuItemCount;
	dc_menuItemCount++;
	var qnewid = "'" + newid + "'";
	return format('<td align="center"><div id="{4}" class="ABLink" onmouseover="onCellOver({5}); {2}" onmouseout="onCellOut({5}); {3}" onclick="onCellClick({5}); {1}">{0}</div></td>', html, action, over, out, newid, qnewid);
}

function getCellMenuSeparatorHtml()
{
	return '<td align="center">|</td>';
}

function getRowMenuItemHtml(html, action, over, out)
{
	return '<tr>' + getCellMenuItemHtml(html, action, over, out) + '</tr>';
}

function getRowMenuSeparatorHtml()
{
	return '<tr><td align="center"><hr class="dashed" /></td></tr>';
}

function onCellOver2(id)
{
	var elt = document.getElementById(id);
	if (elt != null)
	{
		elt.className = "ABLinkH2";
	}
}

function onCellOut2(id)
{
	var elt = document.getElementById(id);
	if (elt != null)
	{
		elt.className = "ABLink2";
	}
}

function onCellClick2(id)
{
	onCellOut2(id);
	return true;
}

function getCell2MenuItemHtml(html, action, over, out)
{
	if (over == null)
	{
		over = '';
	}
	if (out == null)
	{
		out = '';
	}
	var newid = 'cmi2_' + dc_menuItemCount;
	dc_menuItemCount++;
	var qnewid = "'" + newid + "'";
	return format('<td id="{4}" unselectable="on" valign="bottom" align="center" class="ABLink2" onmouseover="onCellOver2({5}); {2}" onmouseout="onCellOut2({5}); {3}" onclick="onCellClick2({5}); {1}">{0}</td>', html, action, over, out, newid, qnewid);
}

function getCell2MenuControlHtml(text)
{
	return format('<td valign="center" unselectable="on" align="center" class="ABLink2" style="cursor: default;">{0}</td>', text);
}

function getCell2MenuFillerHtml(text)
{
	return '<td valign="center" unselectable="on" align="center" class="ABLink2" width="100%" style="cursor: default;">&nbsp;</td>';
}

function getCell2MenuSeparatorHtml()
{
	return '<td valign="center" unselectable="on" align="center" class="ABLink2" style="cursor: default;">|</td>';
}

function getCell2MenuLabelHtml(html)
{
	if (html == null)
	{
		html = '';
	}
	return '<td valign="center" unselectable="on" align="center" class="ABLink2" style="cursor: default;">' + html + '</td>';
}



// blending

//change the opacity for different browsers
function changeOpac(opacity, id) {

	var object = document.getElementById(id).style; 
	object.opacity = (opacity / 100);
	object.MozOpacity = (opacity / 100);
	object.KhtmlOpacity = (opacity / 100);
	object.filter = "alpha(opacity=" + opacity + ")";
}

function blendimage(divid, imageid, imagefile, millisec) {
	var div = document.getElementById(divid);
	var img = document.getElementById(imageid);
	var speed = Math.round(millisec / 100);
	var timer = 0;
	
	//set the current image as background
	div.style.backgroundImage = "url(" + img.src + ")";
	
	//make image transparent
	changeOpac(0, imageid);
	
	//make new image
	img.src = imagefile;
	
	//fade in image
	for(i = 0; i <= 100; i++) {
		setTimeout("changeOpac(" + i + ",'" + imageid + "')",(timer * speed));
		timer++;
	}
}


// scroll and fade

var DarkClanScrollFade = new Array();

function DarkClanScrollFade(divid, texts)
{
	divid = divid.toString();
	var div = document.getElementById(divid);
	var odivid = divid + '_DarkClanScrollFade_odiv';
	var odiv = document.createElement('DIV');
	div.appendChild(odiv);
	odiv.id = odivid;
	odiv.style.position = 'absolute';
	odiv.style.posLeft = 0;
	odiv.style.posTop = 0;
	odiv.style.posWidth = div.style.posWidth;
	odiv.style.posHeight = div.style.posHeight;
	this.timer = '';
	this.speed = 50;
	this.step = -1;
	this.message = 0;
	this.IE = is.ie;
	this.opac = 100;
	this.contid = divid;
	this.odiv = odivid;
	this.texts = texts;
	this.index = DarkClanScrollFade.length;
	this.init = DarkClanScrollFade_init;
	DarkClanScrollFade[this.index] = this;
}

function DarkClanScrollFade_motion(index)
{
	var data = DarkClanScrollFade[index];
	clearTimeout(data.timer);

	var cont_elm = document.getElementById(data.contid);
	var display_elm = document.getElementById(data.odiv);

	var posnow = parseInt(display_elm.style.top);
	var step = 100 / ((cont_elm.offsetHeight - (cont_elm.offsetHeight / 4)) / -data.step)

	if (data.message >= data.texts.length)
	{
		data.message = 0
	}

	if (parseInt(display_elm.style.top) < -display_elm.scrollHeight)
	{
		display_elm.style.top = cont_elm.offsetHeight - 20;
		display_elm.innerHTML = data.texts[data.message];
		data.message++;
		data.opac = 0;
		changeOpac(opac, data.odiv);

		DarkClanScrollFade_motion(index);
	}
	else
	{
		posnow += data.step;
		display_elm.style.top = posnow;

		data.opac += step;

		changeOpac(opac, data.odiv);
	}
	data.timer = setTimeout("DarkClanScrollFade_motion(" + index + ")", data.speed);
}

function DarkClanScrollFade_init()
{
	var cont_elm = document.getElementById(this.contid);
	var display_elm = document.getElementById(this.odiv);

	var w = cont_elm.style.posWidth;
	var h = cont_elm.style.posHeight;
	var cw = w;
	var ch = h;
	if (!this.IE)
	{
		// for ns clip size add border and padding x 2
		cw -= 8;
		ch -= 8;
	}
	cont_elm.style.clip = format('rect(0 {0} {1} 0)', cw, ch);
	display_elm.style.posWidth = w;
	display_elm.style.posHeight = h;
	changeOpac(100, this.odiv);
	
	this.timer = setTimeout("DarkClanScrollFade_motion(" + this.index + ")", this.speed);
}

// tabs

function tabOn(eltn, useFX)
{
	var elt = document.getElementById(eltn);
	if (elt == null)
	{
		return;
	}
	if ((useFX == null || useFX == true) && (elt.filters) && (elt.filters.length > 0))
	{
		elt.filters[0].apply();
	}
	document.getElementById('eltn').className = 'tab-on';
	if ((useFX == null || useFX == true) && (elt.filters) && (elt.filters.length > 0))
	{
		elt.filters[0].play();
	}
}

function tabOn(eltn, useFX)
{
	var elt = document.getElementById(eltn);
	if (elt == null || elt.className == 'tab-on')
	{
		return;
	}
	if ((useFX == null || useFX == true) && is.ie && (elt.filters) && (elt.filters.length > 0))
	{
		elt.filters[0].apply();
	}
	elt.className = 'tab-on';
	if ((useFX == null || useFX == true) && is.ie && (elt.filters) && (elt.filters.length > 0))
	{
		elt.filters[0].play();
	}
}

function tabOff(eltn, useFX)
{
	var elt = document.getElementById(eltn);
	if (elt == null || elt.className == 'tab-off')
	{
		return;
	}
	if ((useFX == null || useFX == true) && is.ie && (elt.filters) && (elt.filters.length > 0))
	{
		elt.filters[0].apply();
	}
	elt.className = 'tab-off';
	if ((useFX == null || useFX == true) && is.ie && (elt.filters) && (elt.filters.length > 0))
	{
		elt.filters[0].play();
	}
}

function tabTo(eltn, isOn, useFX)
{
	if (isOn)
	{
		tabOn(eltn, useFX);
	}
	else
	{
		tabOff(eltn, useFX);
	}
}

// utils

function CurPos(e)
{
	cursorX = !moz ? event.clientX : e.clientX;
	cursorY = !moz ? event.clientY : e.clientY;
	cursorX += document.body.scrollLeft;
	cursorY += document.body.scrollTop;
	if (!is.opera)
	{
		cursorX += document.documentElement.scrollLeft;
		cursorY += document.documentElement.scrollTop;
	}
}

function isDeveloperMode()
{
	return (window.location.search && window.location.search.indexOf("dev=") >= 0);
}

function d2h(d) {return d.toString(16);}
function h2d(h) {return parseInt(h,16);}

function urlesc(s)
{
	var r = [];
	var cFL = 'À'.charCodeAt(0);
	var cLL = 'À'.charCodeAt(0);
	var cFS = 'à'.charCodeAt(0);
	var cLS = 'ÿ'.charCodeAt(0);
	for (var i = 0; i < s.length; i++)
	{
		var c = s.charAt(i);
		var cc = s.charCodeAt(i);
		if (cc >= cFL && cc <= cLL)
		{
			r.push('%');
			var ccv = 192 + (cc - cFL);
			if (ccv < 16) r.push('0');
			r.push(d2h(ccv));
		}
		else if (cc >= cFS && cc <= cLS)
		{
			r.push('%');
			var ccv = 224 + (cc - cFS);
			if (ccv < 16) r.push('0');
			r.push(d2h(ccv));
		}
		else
		{
			if (window.encodeURIComponent) c = window.encodeURIComponent(c);
			else if (window.encodeURI) c = window.encodeURI(c);
			else c = window.escape(c);
			r.push(c);
		}
	}
	return r.join('');
}

// init

if (typeof (uiOptions) == 'undefined')
{
	uiOptions = {
		useAlphaForMenuAndTip: true,
		useTransitionEffects: false,
		captureMouse: false
		};
}

document.onmousemove = CurPos;
