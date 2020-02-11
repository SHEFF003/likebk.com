// JScript File



var dcInfoSpaceScriptId = 'dcInfoSpaceS';
var dcInfoSpaceOutputId = 'dcInfoSpaceOutput';
var dcInfoSpaceDataSource = 'http://www.darkclan.ru/cgi/getisdata.pl';
var dcInfoSpaceNoCache = true;

var cityhash = {
    Capital: 'Capital city',
    Angels: ' Angels city',
    Demons: 'Demons city',
    Devils: ' Devils city',
    Sun: 'Suncity',
    Sand: 'Sandcity',
    Emeralds: 'Emeralds city',
    Moon: 'Moon city',
    East: 'East city',
    capital: 'Capital city',
    emeralds: 'Emeralds city'
    };

var stateshop = "Государственный";
var privateshop = "Комиссионный";

var moz = (document.getElementById && !document.all);

var cursorX = 0;
var cursorY = 0;

var infoSpaceRequest = new Object();

function dcInfoSpace(id, ctx)
{
    infoSpaceRequest = {
        id: id,
        ctx: ctx,
        response: null,
        activeTab: 0
        };
    cleanupScriptElement(dcInfoSpaceScriptId);
    var href = dcInfoSpaceDataSource + '?rnd=' + Math.random() + '&i=' + escape(id) + '&ctx=' + escape(ctx);
    getScriptElement(dcInfoSpaceScriptId, href);
    
    return false;
}

function cleanupScriptElement(id)
{
    var span = document.getElementById(id);
    if (span != null)
    {
        setTimeout(function() 
            {
                // without setTimeout - crash in IE 5.0!
                span.parentNode.removeChild(span);
            },
            50
            );
    }
}

function getScriptElement(id, href)
{
    var span = document.body.appendChild(document.createElement('SPAN'));
    span.style.display = 'none';
    span.innerHTML = 'MSIE fix<s' + 'cript></s' + 'cript>';
    setTimeout(function() 
        {
            var s = span.getElementsByTagName("script")[0];
            s.language = "JavaScript";
            if (s.setAttribute) s.setAttribute('src', href); else s.src = href;
        },
        10
        );
    return span;
}

function handleResponse(response)
{
	var imgHtml = '<img src="http://primerca.h1n.ru' + response.name + '.gif" border="0" />';
	var html = '';
	html += imgHtml + '<b>' + response.caption + '</b><br />';
	html += '<table border="0" cellspacing="8">';
	html += '<tr><td><b>Местонахождение</b></td><td>';
	html += '<b>Тип</b></td><td align="right">';
	html += '<b>Количество</b></td><td align="right">';
	html += '<b>Цена</b></td></tr>';
	for (var shopi = 0; shopi < response.shops.length; shopi++)
	{
		var shop = response.shops[shopi];
		html += '<tr><td>' + cityhash[shop.where] + '</td><td>';
		html += (shop.which == 'state') ? stateshop : privateshop;
		html += '</td><td align="right">';
		html += shop.count;
		html += '</td><td align="right">';
		html += (shop.which == 'state') ? shop.price : ('(' + shop.minprice + '&nbsp;-&nbsp;' + shop.maxprice + ')');
		html += '</td></tr>';
		
	}
	html += '</table>';
	var html2 = '';
	html2 += imgHtml + '<b>' + response.caption + '</b><br />';
	for (var auci = 0; auci < response.auctions.length; auci++)
	{
	    var ahtml = '';
	    var auc = response.auctions[auci];
	    for (var ii = 0; ii < auc.instances.length; ii++)
	    {
	        var instance = auc.instances[ii];
	        ahtml += '<tr><td valign="top">' + imgHtml + response.caption + instance.htmlcode + '</td>';
	        ahtml += '<td valign="top">' + instance.from + '</td><td valign="top" align="right">' + instance.price + '</td>';
	        ahtml += '</tr>';
	    }
	    if (ahtml != '')
	    {
	        html2 += '<table border="0" cellspacing="8">';
	        html2 += '<tr><td><b>Информация о предмете</b></td><td>';
	        html2 += '<b>От кого</b></td>';
	        html2 += '<td align="right"><b>Цена</b></td></tr>';
	        html2 += '<b>' + cityhash[auc.where] + '</b><br />' + ahtml;
           	html2 += '</table>';
	    }
	}
	var isr = {
		shops: {
			caption: 'Магазины',
			content: html
			},
		auctions: {
			caption: 'Аукционы',
			content: html2
			}
		};
	infoSpaceRequest.response = isr;
	handleInfoSpaceResponse();
}

function handleInfoSpaceResponse()
{
    recreateInfoSpace();
    var div = document.getElementById(dcInfoSpaceOutputId);
    var x = cursorX - 8;
    var y = cursorY + 8;
    div.style.left = x + 'px';
    div.style.top = y + 'px';
    div.style.visibility = '';
}

function closeInfoSpace()
{
    var div = document.getElementById(dcInfoSpaceOutputId);
    div.style.visibility = 'hidden';
    cleanupScriptElement(dcInfoSpaceScriptId);
    return false;
}

function recreateInfoSpace()
{
    var div = document.getElementById(dcInfoSpaceOutputId);
    if (infoSpaceRequest.response == null)
    {
        div.innerHTML = '<font color="red">Данных нет</font>';
        return;
    }
    var i = 0;
    var html = '';
    for (var tabn in infoSpaceRequest.response)
    {
        if (i == infoSpaceRequest.activeTab)
        {
            html = infoSpaceRequest.response[tabn].content;
            break;
        }
        i++;
    }
    var content = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td>';
    content += '<table border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;"><tr><td style="font-size: 10pt">';
    content += html;
    content += '</td></tr></table>';
    content += '</td></tr></table>';
    content = getInfoSpaceTabsHtml() + content;
    div.innerHTML = content;
}

function getInfoSpaceTabsHtml()
{
    if (infoSpaceRequest.response == null)
    {
        return;
    }
    var tabs = '<table class="tcontent" width="100%" border="0" cellspacing="0" cellpadding="2"><tr>';
  
    var i = 0;
    for (var tabn in infoSpaceRequest.response)
    {
        var classn = 'tab-off';
        var onclick = ' onclick="changeInfoSpaceTab(' + "'" + tabn + "'" +')"';
        if (i == infoSpaceRequest.activeTab)
        {
            classn = 'tab-on';
            onclick = '';
        }
        tabs += '<td align="center" valign="middle" class="' + classn + '"' + onclick + '>&nbsp;' + infoSpaceRequest.response[tabn].caption + '&nbsp;</td>';
        i++;
    }
    tabs += '<td class="tab-none" align="right" valign="top" width="100%">';
    tabs += '<a href="#" onclick="return closeInfoSpace()"><img alt="Закрыть" src="/images/infospace/close.gif" width="16" height="16" border="0" /></a>';
    tabs += '</td>';
    tabs += '</tr></table>';
    return tabs;
}


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

document.onmousemove = CurPos;


function changeInfoSpaceTab(id)
{
    if (infoSpaceRequest.response == null)
    {
        return;
    }
    var i = 0;
    for (var tabn in infoSpaceRequest.response)
    {
        if (tabn == id)
        {
            break;
        }
        i++;
    }
    infoSpaceRequest.activeTab = i;
    recreateInfoSpace();
}
