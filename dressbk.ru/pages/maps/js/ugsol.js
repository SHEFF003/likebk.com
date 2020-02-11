// JavaScript Document

var sol_url_root = 'http://www.darkclan.ru';

var chapters = {
	solutions: {
		id: 'solutions',
		caption: '&nbsp;&nbsp;&nbspПрохождения'
		},
	knightquests: {
		id: 'knightquests',
		caption: '&nbsp;&nbsp;&nbspРыцарские задания'
		},
	misc: {
		id: 'misc',
		caption: '&nbsp;&nbsp;&nbspРазное'
		}
	}
                              
var sols = {
	sun: {
		id: 'sun',
		chapter: 'solutions',
		caption: '<IMG title="Suncity" height=19 alt="Sun city" src="'+imP2+'city/brand/5.gif" width=34 border=0 /> Грибница',
		url: '/cgi/dresjs.pl?resource=sunugsol'
		},
	sun2: {
		id: 'sun2',
		chapter: 'solutions',
		caption: '<IMG title="Suncity" height=19 alt="Sun city" src="'+imP2+'city/brand/5.gif" width=34 border=0 />3й этаж Грибницы',
		url: '/cgi/dresjs.pl?resource=mushrooms'
		},
	novice: {
		id: 'novice',
		chapter: 'solutions',
		caption: '<IMG title="все города" height=19 alt="все города" src="'+imP1+'brend1.gif" width=34 border=0 /> Канализация',
		url: '/cgi/dresjs.pl?resource=noviceugsol'
		},
	capital: {
		id: 'capital',
		chapter: 'solutions',
		caption: '<IMG title="Capital city" height=19 alt="Capital city" src="'+imP2+'city/brand/8.gif" width=34 border=0 /> Пещера Тысячи Проклятий',
		url: '/cgi/dresjs.pl?resource=capitalugsol'
		},
	angels: {
		id: 'angels',
		chapter: 'solutions',
		caption: '<IMG title="Angels city" height=19 alt="Angels city" src="'+imP2+'city/brand/2.gif" width=34 border=0 /> Бездна',
		url: '/cgi/dresjs.pl?resource=angelsugsol'
		},
	sand: {
		id: 'sand',
		chapter: 'solutions',
		caption: '<IMG title="Sandcity" height=19 alt="Sandcity" src="'+imP2+'city/brand/7.gif" width=34 border=0 /> Пещеры Мглы',
		url: '/cgi/dresjs.pl?resource=sandugsol'
		},
	demons: {
		id: 'demons',
		chapter: 'solutions',
		caption: '<IMG title="Demons city" height=19 alt="Demons city" src="'+imP2+'city/brand/3.gif" width=34 border=0 /> Катакомбы',
		url: '/cgi/dresjs.pl?resource=demonsugsol'
		},
	emeralds: {
		id: 'emeralds',
		chapter: 'solutions',
		caption: '<IMG title="Emeralds city" height=19 alt="Emeralds city" src="'+imP2+'city/brand/6.gif" width=34 border=0 /> Потерянный Вход',
		url: '/cgi/dresjs.pl?resource=emeraldsugsol'
		},
	capitalknight: {
		id: 'capitalknight',
		chapter: 'knightquests',
		caption: '<IMG title="Рыцарь первого круга" height=24 alt="Рыцарь первого круга" src="'+imP2+'misc/zn9_1.gif" width=35 border=0 />Пещера Тысячи Проклятий',
		url: '/cgi/dresjs.pl?resource=capitalknightugsol'
		},
	angelsknight: {
		id: 'angelsknight',
		chapter: 'knightquests',
		caption: '<IMG title="Рыцарь первого круга" height=24 alt="Рыцарь первого круга" src="'+imP2+'misc/zn2_1.gif" width=35 border=0 />Бездна',
		url: '/cgi/dresjs.pl?resource=angelsknightugsol'
		},
	sandknight: {
		id: 'sandknight',
		chapter: 'knightquests',
		caption: '<IMG title="Рыцарь первого круга" height=24 alt="Рыцарь первого круга" src="'+imP2+'misc/zn7_1.gif" width=35 border=0 />Пещеры Мглы',
		url: '/cgi/dresjs.pl?resource=sandknightugsol'
		},
	sunknight: {
		id: 'sunknight',
		chapter: 'knightquests',
		caption: '<IMG title="Рыцарь первого круга" height=24 alt="Рыцарь первого круга" src="'+imP2+'misc/zn5_1.gif" width=35 border=0 />Грибница',
		url: '/cgi/dresjs.pl?resource=sunknightugsol'
		},



	gl: {
		id: 'gl',
		chapter: 'misc',                                                                                 
		caption: '<IMG height=24 alt="Незнакомец с поверхности" src="'+imP2+'misc/gl_rep.gif" width=35 border=0 />Прохождение Горы Легиона',
		newurl: 'http://www.darkclan.ru/cgi/lib.pl?p=kvestgl'
		},

/*	altar: {
		id: 'altar',
		chapter: 'misc',
		caption: '<IMG title="Посвящённый первого круга" height=24 alt="Посвящённый первого круга" src="'+imP2+'misc/znbl_1.gif" width=35 border=0 />Алтарь Крови',
		newurl: 'http://www.darkclan.ru/cgi/lib.pl?p=altar'
		},
	runes: {
		id: 'runes',
		chapter: 'misc',
		caption: '<IMG title="Посвященный второго круга" height=24 alt="Посвященный второго круга" src="'+imP2+'misc/znrune_2.gif" width=35 border=0 />Руны и Храм Знаний',
		newurl: 'http://www.darkclan.ru/cgi/lib.pl?p=runes'
		},

	charkid: {
		id: 'charkid',
		chapter: 'misc',
		caption: 'Модификаторы зачарования вещей',
		newurl: 'http://www.darkclan.ru/cgi/lib.pl?p=charkid'
		},


	setcomponents: {
		id: 'setcomponents',
		chapter: 'misc',
		caption: 'Комплекты 9 уровня и требуемые ингредиенты',
		newurl: 'http://www.darkclan.ru/cgi/lib.pl?p=set'
		},
	setcomponents2: {
		id: 'setcomponents',
		chapter: 'misc',
		caption: 'Модифицирование вещей на 10й уровень',
		newurl: 'http://www.darkclan.ru/cgi/lib.pl?p=settoo'
		},
	sbor: {
		id: 'sbor',
		chapter: 'misc',
		caption: 'Места сбора тактик свитков и предметов',
		newurl:  'http://www.darkclan.ru/cgi/lib.pl?p=sbor'
		},
*/
	books: {
		id: 'books',
		chapter: 'misc',
		caption: 'Книги и книжные приёмы',
		newurl: 'http://www.darkclan.ru/cgi/lib.pl?p=books'
		}

	};

function showScriptStatus(msg)
{
}

var req = null;

function loadXMLDoc(url) 
{
	showScriptStatus("Отправка запроса на сервер");
	try
	{
		try 
		{
			req = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) 
		{
			try 
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e1) 
			{
				req = false;
			}
		}
		if (!req && typeof XMLHttpRequest != 'undened')
		{
			req = new XMLHttpRequest();
		}
		if (req)
		{
			req.open("GET", url, false);
			req.send(null);
		} 
		else 
		{
			alert("Kill yourself or change the browser...");
			return false;
		}
	}
	catch (e)
	{
		alert("Request error:\n" + e.message);
		return false;
	}
	showScriptStatus("Данные получены");
	return true;
}

function drawSol()
{
	var html = '';

	html += '<h3 style="margin:0px; padding:8px; font-size:18px; text-align:center;">Статьи</h3>';
	html += '<table width="100%" cellspacing="0" cellpadding="0" border="0">';	
	html += '<tr>';
	html += '<td valign="top" width="220" height="500">';
	for (chapn in chapters)
	{
		html += '<h5>' + chapters[chapn].caption + '</h5>';
		html += '<blockquote>';
		var firstSol = true;
		for (var soli in sols)
		{
			var sol = sols[soli];
			if (sol.chapter != chapn) continue;
			if (firstSol)
			{
				firstSol = false;
			}
			else
			{
				html += '<br /><br />';
			}
			if ('newurl' in sol)
			{
				html += '<a href="' + sol.newurl + '" target="_blank" class="TLink">';
			}
			else
			{
				html += '<a href="javascript:;" target="_self" class="TLink" onclick="openSol(' + "'" + soli + "'" + ')">';
			}
			html += sol.caption;
			if ('newurl' in sol)
			{
				html += '<img src="'+imP1+'inner_link.png" width="10" height="10" border="0" title="ссылка на статью в Библиотеке" alt="ссылка на статью в Библиотеке" />';
			}
			html += '</a>';
		}
		html += '</blockquote>';
	}
	html += '</blockquote></td>';
	html += '<td valign="top" id="sol_c" style="padding-right:10px;"><center>Пожалуйста, выберите интересующую Вас статью из списка слева.</center></td>';
	html += '</tr>';
	html += '</table>';

	document.getElementById(sections[6].id).innerHTML = html;
}

function openSol(id)
{
	var sol = sols[id];
	if (!('html' in sol))
	{
		var url = sol_url_root + sols[id].url;
		if (!loadXMLDoc(url))
		{
			return;
		}
		sol.html = req.responseText;
	}
	document.getElementById('sol_c').innerHTML = sol.html;
}

 
