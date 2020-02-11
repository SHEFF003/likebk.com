var expDays = 30;
var exp = new Date(); 
exp.setTime(exp.getTime() + (expDays*24*60*60*1000));

function getCookieVal (offset)
{ 
    var endstr = document.cookie.indexOf (";", offset); 
    if (endstr == -1) 
    endstr = document.cookie.length; 
    return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name)
{ 
    var arg = name + "="; 
    var alen = arg.length; 
    var clen = document.cookie.length; 
    var i = 0; 
    while (i < clen) { 
        var j = i + alen; 
        if (document.cookie.substring(i, j) == arg) 
        return getCookieVal (j); 
        i = document.cookie.indexOf(" ", i) + 1; 
        if (i == 0) break; 
    } 
    return null;
}

function SetCookie (name, value)
{ 
    var argv = SetCookie.arguments; 
    var argc = SetCookie.arguments.length; 
    var expires = (argc > 2) ? argv[2] : null; 
    var path = (argc > 3) ? argv[3] : null; 
    var domain = (argc > 4) ? argv[4] : null; 
    var secure = (argc > 5) ? argv[5] : false; 
    document.cookie = name + "=" + escape (value) + 
    ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) + 
    ((path == null) ? "" : ("; path=" + path)) + 
    ((domain == null) ? "" : ("; domain=" + domain)) + 
    ((secure == true) ? "; secure" : "");
}

function DeleteCookie (name)
{ 
    var exp = new Date(); 
    exp.setTime (exp.getTime() - 1); 
    var cval = GetCookie (name); 
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}

function Browser() {
	var b=navigator.appName;
	if (b.indexOf('Netscape')!=-1) { if(navigator.userAgent.indexOf('Firefox/')<0) this.b="ns"; else this.b="ff"; }
	else if ((b=="Opera") || (navigator.userAgent.indexOf("Opera")>0)) this.b = "opera";
	else if (b=="Microsoft Internet Explorer") this.b="ie";
	if (!b) {this.b="invalid"; this.invalid=true;}
	this.version=navigator.appVersion;
	this.v=parseInt(this.version);

	this.ns=(this.b=="ns" && this.v>=4);
	this.ns4=(this.b=="ns" && this.v==4);
	this.ns6=(this.b=="ns" && this.v==5);
	this.ff=(this.b=="ff");
	this.ff2=(this.b=="ff" && navigator.userAgent.indexOf('Firefox/2')>0);
	this.ie=(this.b=="ie" && this.v>=4);
	this.ie4=(this.version.indexOf('MSIE 4')>0);
	this.ie5=(this.version.indexOf('MSIE 5')>0);
	this.ie55=(this.version.indexOf('MSIE 5.5')>0);
	this.ie6=(this.version.indexOf('MSIE 6.0')>0);
	this.opera=(this.b=="opera");
	this.dom=(document.createElement && document.appendChild && document.getElementsByTagName)?true:false;
	this.def=(this.ie||this.dom); // most used browsers, for faster if loops
	var ua=navigator.userAgent.toLowerCase();
	if (ua.indexOf("win")>-1) this.platform="win32";
	else if (ua.indexOf("mac")>-1) this.platform="mac";
	else this.platform="other";
}
is=new Browser();

function getLayer(name) {
	if (is.ns4)
		return findLayer(name, document);
	if (is.ie && !is.dom)
		return eval('document.all.' + name);
	if (is.dom)
		return document.getElementById(name);
	return null;
}

function findLayer(name, doc) {
	var i, layer;

	for (i = 0; i < doc.layers.length; i++) {
		layer = doc.layers[i];
		if (layer.name == name)
			return layer;
		if (layer.document.layers.length > 0)
			if ((layer = findLayer(name, layer.document)) != null)
				return layer;
	}
	return null;
}

//--------------------------------------------------

function hideLayer(layer) {
	unhideElements();
	if (is.ns4){
		layer.visibility = "hide"
	}else{
		layer.style.visibility = "hidden"
	};
}

function showLayer(layer) {
	if (is.ns4){
		layer.visibility = "show"
	}else{
		layer.style.visibility = "visible"
	};
}

function getVisibility(layer) {

	if (is.ns4) {
		if (layer.visibility == "show")
			return "visible";
		if (layer.visibility == "hide")
			return "hidden";
		return layer.visibility;
	}else{
		return layer.style.visibility
	};
	return "";
}

//--------------------------------------------------

function moveLayerTo(layer, x, y) {
	if (is.ns4){
		layer.moveTo(x, y);
	}else{
		layer.style.left = x;
		layer.style.top  = y
	};
}

//--------------------------------------------------

function getImage(name) {
	if (is.ns4){
		return findImage(name, document)
	};
	if (is.ie && !is.dom){
		return eval('document.all.' + name)
	};
	if (is.dom){
		return document.getElementById(name);
	}
	return null;
}

function findImage(name, doc) {
	var i, img;

	for (i = 0; i < doc.images.length; i++)
		if (doc.images[i].name == name)
			return doc.images[i];
	for (i = 0; i < doc.layers.length; i++)
		if ((img = findImage(name, doc.layers[i].document)) != null) {
			img.container = doc.layers[i];
			return img;
		}
	return null;
}

function getImagePageLeft(img) {
	var x, obj;

	if (is.ns4) {
		if (img.container != null)
			return img.container.pageX + img.x;
		else
			return img.x;
	}else{
		x = 0;
		obj = img;
		while (obj.offsetParent != null) {
			x += obj.offsetLeft;
			obj = obj.offsetParent;
		}
		x += obj.offsetLeft;
		return x;
	};
	return -1;
}

function getImagePageTop(img) {
	var y, obj;
	if (is.ns4) {
		if (img.container != null)
			return img.container.pageY + img.y;
		else
			return img.y;
	}else{
		y = 0;
		obj = img;
		while (obj.offsetParent != null) {
			y += obj.offsetTop;
			obj = obj.offsetParent;
		}
		y += obj.offsetTop;
		return y;
	};
	return -1;
}

var currentDMenu = null;
var dmTimer = 0;
var dmTimeOut = 100;


function DMenuInit (){
	if (is.ns4) return;
	lM1 = getLayer ('dmM1');
//	moveLayerTo (lM1, getImagePageLeft(getImage('M1'))-1, 117);
    moveLayerTo (lM1, 250, 115);

	lM2 = getLayer ('dmM2');
//	moveLayerTo (lM2, getImagePageLeft(getImage('M2'))-1, 117);
	moveLayerTo (lM2, 377, 115);

	lM3 = getLayer ('dmM3');
//	moveLayerTo (lM3, getImagePageLeft(getImage('M3'))-1, 117);
	moveLayerTo (lM3, 503, 115);

	lM4 = getLayer ('dmM4');
//	moveLayerTo (lM4, getImagePageLeft(getImage('M4'))-1, 117);
	moveLayerTo (lM4, 630, 115);
	
//	lM5 = getLayer ('dmM5');
//	moveLayerTo (lM5, getImagePageLeft(getImage('M5'))-1, 117);
//	moveLayerTo (lM5, 750, 117);
	
	window.tmDMenu = setInterval ('DMenuTimer()', 100);
}

function DMenu (dm) {
	if (is.ns4 || (dmReady != true)) return;
	if (currentDMenu != null){
		hideLayer (currentDMenu);
		DMenuTrace (dm);
	}else{
		DMenuTrace (dm);
	};
}

function DMenuTrace (dm){
	if (is.ns4 || (dmReady != true)) return;
	currentDMenu = getLayer (dm);
	showLayer (currentDMenu);
	hideElementsIfNeeded(currentDMenu);
	dmTimer = dmTimeOut;
}

function DMenuTimer (){
	if (is.ns4 || (dmReady != true)) return;
	if (dmTimer > 0){
		dmTimer -= 100;
	}else{
		if (currentDMenu != null) hideLayer (currentDMenu);
		currentDMenu = null;
	};
}

function dmTimerOver (){
	if (is.ns4 || (dmReady != true)) return;
	dmTimer = 10000000;
}

function dmTimerOut (){
	if (is.ns4 || (dmReady != true)) return;
	dmTimer = dmTimeOut;
}

function genMenu(MA,MI,MU)
{
	var bgcolor = '';
	document.write('<DIV id=dm'+MA+' onmouseover=dmTimerOver(); style="LEFT: 100px; VISIBILITY: hidden; POSITION: absolute; z-index: 100; TOP: 0px" onmouseout=dmTimerOut();><table cellspacing="0" cellpadding="0" border="0" width="120"><td bgcolor="#c5c5c5" class="LayerNavText" valign="center"><table cellspacing="1" cellpadding="3" border="0" width="100%">');

	var ITEM = MI.split('|');
	var URL = MU.split('|');

	for(var i=0; i<ITEM.length; i++)
	{
		var icheck = i % 2 == 0 ? 1 : 0
		icheck == 1 ? bgcolor = 'bgcolor=#dcdcdc' : bgcolor = 'bgcolor=#dcdcdc'

		document.write('<tr><td '+bgcolor+' onMouseOver="this.style.backgroundColor=\'A9A9A9\'" onMouseOut="this.style.backgroundColor=\'dcdcdc\'" nowrap><div id=n1><div id=n2><a href="'+URL[i]+'" class="LayerNavLink"><img src=/images/pixel.gif height=13 width=100% border=0></div></div><font color="#464646">•</font>&nbsp;'+ITEM[i]+'</a></td></tr>');
	}

	document.write('</table></td></table></DIV>');
}

function VHMenu (name) 
{ 
    var type_old = document.getElementById(name).style.display 
    if (type_old == "block"){ 
         type='none';text_td='/images/open.gif'; 
     }else{ 
         type='block';text_td='/images/close.gif'; 
    }; 
    document.getElementById(name).style.display=type; 
    document.getElementById("img_"+name).src=text_td;
    SetCookie(name, type, exp);
    return;
} 

function VHMenuSet (name)
{
    var type_old = GetCookie (name);
    if (type_old!=null){
      if (type_old == "block"){ 
           type='block';text_td='/images/close.gif'; 
      }else{ 
           type='none';text_td='/images/open.gif';
      }; 
      document.getElementById(name).style.display=type; 
      document.getElementById("img_"+name).src=text_td;
    }
    return;
}

var hiddenObjects = new Array();

function hideElementsIfNeeded(overDiv){
	hideElements('SELECT', overDiv);
}

function hideElements(elmID, overDiv){
	unhideElements();
	hiddenObjects = new Array();
	if( is.ie ) {
		for( var i = 0;	i <	document.all.tags( elmID ).length; i++ ){
			obj = document.all.tags(elmID)[i];
			if( !obj || !obj.offsetParent	)
				continue;

			// Find the element's	offsetTop and offsetLeft relative to the BODY tag.
			objLeft	= obj.offsetLeft;
			objTop = obj.offsetTop;
			objParent = obj.offsetParent;

			while( objParent.tagName.toUpperCase() != "BODY" ){
				objLeft	+= objParent.offsetLeft;
				objTop += objParent.offsetTop;
				objParent =	objParent.offsetParent;
			}

			objHeight	= obj.offsetHeight;
			objWidth = obj.offsetWidth;

			if ( ( overDiv.offsetLeft + overDiv.offsetWidth ) <= objLeft );
			else if ( ( overDiv.offsetTop + overDiv.offsetHeight ) <= objTop );
			else if ( overDiv.offsetTop >= ( objTop + objHeight ) );
			else if ( overDiv.offsetLeft >= ( objLeft + objWidth ) );
			else if ( obj.style.visibility = "visible" ){
				hiddenObjects[hiddenObjects.length] = obj;
				obj.style.visibility = "hidden";
			}
		}
	}
}

function unhideElements(){
	if ( is.ie ){
		for ( var i = 0; i < hiddenObjects.length; i++ ){
			obj = hiddenObjects[i];
			obj.style.visibility = "visible";
		}
		hiddenObjects = new Array();
	}
}

var winW = 630, winH = 460;

function getCurrentWindowSize(){
	if ( parseInt(navigator.appVersion) > 3 ) {
		if ( navigator.appName == "Netscape" ) {
			winW = window.innerWidth;
			winH = window.innerHeight;
		}
		if ( navigator.appName.indexOf("Microsoft") != -1 ) {
			winW = document.body.offsetWidth;
			winH = document.body.offsetHeight;
		}
	}
}

function prepareScriptStatus(w, h, id, closingFunction){
	if ( !document.getElementById(id) ){
		var str = "<table id='"+id+"' class='info_table' style='width:"+w+"px;'>";
		str += "<tr><td class='info_header' id='"+id+"Header'></td></tr>";
		str += "<tr><td class='info_content'><div id='"+id+"Text' style='height:20px;width:100%;overflow:auto;text-align:center;'></div></td></tr>";
		if ( closingFunction != null ){
			str += "<tr><td align='center'>";
			str += "<input type='button' class='info_button' value='Закрыть' onClick=\"javascript:"+closingFunction+"\"></td></tr>";
		}
		str += "</table>";
		document.body.innerHTML += str;
	}
	getCurrentWindowSize();
	document.getElementById(id).style.left = parseInt((winW-w)/2);
	document.getElementById(id).style.top = parseInt((winH-h)/2);
}

function showDialogWindow(dialogName, dialogText, dialogHeight){
	prepareScriptStatus(500, 400, "dialogWindowTable", "hideDialogWindow()");
	document.getElementById("dialogWindowTableHeader").innerHTML = dialogName;
	document.getElementById("dialogWindowTableText").style.height = dialogHeight;
	document.getElementById("dialogWindowTableText").innerHTML = dialogText;

	hideElementsIfNeeded("dialogWindowTable");
	document.getElementById("dialogWindowTable").style.display = "block";
}

function hideDialogWindow(){
	unhideElements();
	if ( document.getElementById("dialogWindowTable") )
		document.getElementById("dialogWindowTable").style.display = "none";
}