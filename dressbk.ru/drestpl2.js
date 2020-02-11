//update 11.01.09 by gram
// JavaScript Document

var dresserScriptVersion = 199;

var saveSetOnServerUrl = '/dressroom/?action=save&saveset=1&texttosave={0}';
var absoluteDressRoomUrl = 'http://www.darkclan.ru/dressroom/';
var battleScriptId = 'battleScriptId';
var battleProviderUrl = 'http://resources.darkclan.ru/cgi/dresbatl.pl';

//var getCharacterInfoUrlFormat = 'http://likebk.com/inf.php?login={0}';
var getCharacterInfoUrlFormat = 'http://likebk.com/inf.php?login={0}';

var loadSetDialogParameters = "dialogHeight=326px";
var saveSetDialogParameters = "dialogHeight=316px";

var dressOptionsCookieName = 'dressOptions';

var serializableStateFormatVersion = 1;

var helpDivId = "helpDiv";
var infoDivId = "infoDiv";
var summaryDivId = "summaryDiv";
var expTableDivId = "expTableDiv";
var healerDivId = "healerDiv";
var battlesDivId = "battlesDiv";
var builderDivId = 'builderDiv';
var favStoreId = "favstore";
var historyStoreId = "historystore";
var offlineCookieId = "offlinecookie";
var menuImageIdPrefix = 'mnudrs_';
var hpMeterSuffix = '_HP';
var manaMeterSuffix = '_MP';
var minSharpLevels=[0,0,0,0,1,2,3,4,5,6,0,8];
var regSharpPrices=[0,20,40,80,0,320,640,1000,2000,3000,0,5000];
var dblSharpPrices=[0,40,80,160,320,640,1280,2000,4000,6000,0,10000];

var benderOmsk = {
	saveLink: 'benderomsk://save?name={0}&value={1}',
	loadLink: 'benderomsk://load?name={0}',
	getInfoLink: 'benderomsk://getinf?login={0}'
	};

var defaultImageFilter = 'revealtrans(duration = 0.5, transition = 23)';

var dressExData = {
	exdata: 4,
	fakes: {},
	fakeDefs: {}
	};

var dressOptions = {
	showImages: true,
	useAlphaForMenuAndTip: true,
	useTransitionEffects: false,
	preloadImages: false,
	fminlevel: null,
	fmaxlevel: null,
	fshowold: false,
	fshow_com: true,
	fshow_ru: true,
	fshow_artefacts: true,
	ffiltermf: null,
	frewardonly: false,
	captureMouse: false,
	embeddedMode: false,
	hasGetCharInfo: false,
	hasGetDSCharInfo: false,
	showHealer: true,
	showExp: true,
	showBuilder: true,
	newCapEdition: false,
	helpWritten: false,
	currentFilterTab: 0,
	benderOmskMode: false,
	colorizedDummy: true
};
var uiOptions = dressOptions;

var unusedStateId = 1;
var activeState = null;
var expTableBuilt = false;
var imagesToBeLoaded = {};
var preloadImagesDelay = 1000;
var someStatesLoaded = false;

if (typeof (dressItems) == 'undefined')
{
	dressItems = {};
}
if (typeof (dressStates) == 'undefined')
{
	dressStates = {};
}
if (typeof (droppedDressStates) == 'undefined')
{
	droppedDressStates = {};
}
if (typeof (dressSets) == 'undefined')
{
	dressSets = {};
}
if (typeof (dressStrengthenings) == 'undefined')
{
	dressStrengthenings = {};
}
if (typeof (categories) == 'undefined')
{
	categories = {};
}
if (typeof (pets) == 'undefined')
{
	pets = {};
}
if (typeof (tricks) == 'undefined')
{
	tricks = {};
}
if (typeof (dressExchangePoints) == 'undefined')
{
	dressExchangePoints = {};
}

function informAboutProgress(msg)
{
	document.getElementById(infoDivId).innerHTML = msg;
}

var filterDialogProps = {};

var turnData = { strikes: {}, blockZones: 0 };

var menuhash = {};
var catselsources = {};
var catlistsources = {};

function showHelp()
{
	var helpDiv = document.getElementById(helpDivId);
	helpDiv.style.display = '';
	if (!dressOptions.helpWritten)
	{
		document.getElementById('helpDivContent').innerHTML = helpChapterHtml;
		dressOptions.helpWritten = true;
	}
	helpDiv.scrollIntoView();
}

function hideHelp()
{
	var helpDiv = document.getElementById(helpDivId);
	helpDiv.style.display = 'none';
	window.scrollTo(0);
}

/* Common utilities */

function areArraysIntersect(A1, A2)
{
	for (var i1 = 0; i1 < A1.length; i1++)
	{
		for (var i2 = 0; i2 < A2.length; i2++)
		{
			if (A1[i1] == A2[i2])
			{
				return true;
			}
		}
	}
	return false;
}

function cloneArray(a)
{
	var r = a.concat([]);
	return r;
}

function cloneObject(o)
{
	var r = {};
	for (var pname in o)
	{
		var v = o[pname];
		if ((v != null) && ((typeof v) == 'object'))
		{
			if (v instanceof Array)
			{
				v = cloneArray(v);
			}
			else
			{
				v = cloneObject(v);
			}
		}
		r[pname] = v;
	}
	return r;
}

function combineObjects(x, y)
{
	var r = cloneObject(x);
	for (var pname in y)
	{
		var v = y[pname];
		if ((v != null) && ((typeof v) == 'object'))
		{
			if (v instanceof Array)
			{
				if (pname in r)
				{
					v = r[pname].concat(v);
				}
				else
				{
					v = cloneArray(v);
				}
			}
			else
			{
				if (pname in r)
				{
					v = combineObjects(r[pname], v);
				}
				else
				{
					v = cloneObject(v);
				}
			}
		}
		r[pname] = v;
	}
	return r;
}

// Dresser specific code

function readOptionsCore(v)
{
	if (v != null)
	{
		dressOptions.showImages = (v.length > 0) && (v.charAt(0) == 'Y');
		dressOptions.useAlphaForMenuAndTip = (v.length > 1) && (v.charAt(1) == 'Y');
		dressOptions.useTransitionEffects = (v.length > 2) && (v.charAt(2) == 'Y');
		dressOptions.preloadImages = (v.length > 3) && (v.charAt(3) == 'Y');
		dressOptions.fminlevel = (v.length > 4) && (v.charAt(4) != ' ') ? parseInt(v.charAt(4), 26) : null;
		dressOptions.fmaxlevel = (v.length > 5) && (v.charAt(5) != ' ') ? parseInt(v.charAt(5), 26) : null;
		dressOptions.fshowold = (v.length > 6) && (v.charAt(6) == 'Y');
		dressOptions.captureMouse = (v.length <= 7) || (v.charAt(7) == 'Y');
		if (v.length > 10 && v.charAt(8) != '_')
		{
			dressOptions.ffiltermf = parseInt(v.substr(8, 3), 16);
		}
		dressOptions.fshow_com = (v.length <= 11) || (v.charAt(11) == 'Y');
		dressOptions.fshow_ru = (v.length <= 12) || (v.charAt(12) == 'Y');
		dressOptions.fshow_artefacts = (v.length <= 13) || (v.charAt(13) == 'Y');
		dressOptions.frewardonly = (v.length > 14) && (v.charAt(14) == 'Y');
		dressOptions.colorizedDummy = (v.length <= 15) || (v.charAt(15) == 'Y');
		if (dressOptions.preloadImages)
		{
			preloadImagesWanted();
		}
//		dressOptions.useAlphaForMenuAndTip &= is.ie;
		dressOptions.useTransitionEffects &= is.ie;
		dressOptions.captureMouse &= is.ie;
		applyAlphaForMenuAndTipOption();
	}
}

function onLoadBenderOmskVariable(name, value)
{
	if (name == dressOptionsCookieName)
	{
		readOptionsCore(value);
		return;
	}
}

function readOptions()
{
	var v = null;
	if (dressOptions.benderOmskMode)
	{
		window.navigate(format(benderOmsk.loadLink, dressOptionsCookieName));
		return;
	}
	if (isOfflineMode())
	{
		v = GetOfflineCookie(dressOptionsCookieName);
	}
	else
	{
		v = GetCookie(dressOptionsCookieName);
	}
	readOptionsCore(v);
}

function saveOptions()
{
	var v = '';
	v += dressOptions.showImages ? 'Y' : 'N';
	v += dressOptions.useAlphaForMenuAndTip ? 'Y' : 'N';
	v += dressOptions.useTransitionEffects ? 'Y' : 'N';
	v += dressOptions.preloadImages ? 'Y' : 'N';
	v += (dressOptions.fminlevel != null) ? dressOptions.fminlevel.toString(26) : ' ';
	v += (dressOptions.fmaxlevel != null) ? dressOptions.fmaxlevel.toString(26) : ' ';
	v += dressOptions.fshowold ? 'Y' : 'N';
	v += dressOptions.captureMouse ? 'Y' : 'N';
	if (dressOptions.ffiltermf != null)
	{
		var av = parseInt(dressOptions.ffiltermf).toString(16);
		while (av.length < 3)
		{
			av = '0' + av;
		}
		v += av;
	}
	else
	{
		v += '___';
	}
	v += dressOptions.fshow_com ? 'Y' : 'N';
	v += dressOptions.fshow_ru ? 'Y' : 'N';
	v += dressOptions.fshow_artefacts ? 'Y' : 'N';
	v += dressOptions.frewardonly ? 'Y' : 'N';
	v += dressOptions.colorizedDummy ? 'Y' : 'N';

	if (dressOptions.benderOmskMode)
	{
		window.navigate(format(benderOmsk.saveLink, dressOptionsCookieName, v));
	}
	else if (isOfflineMode())
	{
		SetOfflineCookie(dressOptionsCookieName, v, exp);
	}
	else
	{
		SetCookie(dressOptionsCookieName, v, exp);
	}
}

function clearAllStats(state)
{
	state.natural = {
			level: 0,
			levelup: 0,
			pstat: 0,
			pskil: 0,
			strength: 3,
			dexterity: 3,
			intuition: 3,
			endurance: 3,
			intellect: 0,
			wisdom: 0,
			spirituality: 0
		};
	state.statElix = null;
	state.damageElixes = {};
	state.defElixes = {};
	state.spellIntel = 0;
	state.spellHitpoints = 0;
	state.spellBD = 0;
	state.spellPowerUps = {};
	state.combatTricks = {};

	state.pet = null;
}

function applyCleanItemsToState(state)
{
	state.fitArmor = false;
	state.w3sharp = 0;
	state.w10sharp = 0;

	state.objects = new Array(slots.length);
	state.upgradeSlots = new Array(slots.length);
	state.fitSlots = new Array(slots.length);
	state.charmSlots = new Array(slots.length);
	state.addSlots = new Array(slots.length);
	state.runeSlots = new Array(slots.length);

	state.objCache = new Array(slots.length);

	state.trickSlots = new Array(21);
	state.combatSpells = {};

	state.statElix = null;
	state.damageElixes = {};
	state.defElixes = {};
	state.spellIntel = 0;
	state.spellHitpoints = 0;
	state.spellBD = 0;
	state.spellPowerUps = {};
	state.combatTricks = {};

	state.pet = null;
}

function createNewDresserState(stateid, persName, persImage, persSign)
{
	if (stateid == null)
	{
		stateid = unusedStateId;
		unusedStateId++;
	}
	var state = {
		id: stateid,
		name: persName || '',
		align: '0',
		clan: '',
		sex: 0,
		image: persImage || '0',
		sign: persSign || '',
		required: {},
		appliedSets: [],
		appliedStrengthenings: [],
		powerUps: {},
		modify: {},
		results: {},
		battlemf: {},
		inbattle: {},
		w3props: {},
		w10props: {},
		rendered: false
		};
	clearAllStats(state);
	applyCleanItemsToState(state);
	dressStates[state.id] = state;
	return state;
}

function applyStyle(style, where, what, how)
{
	if (where.indexOf(what) >= 0)
	{
		if (style.length > 0)
		{
			style += ', ';
		}
		style += how;
	}
	return style;
}

function getRealImagePath(objid, slot)
{
	return ((objid == null) && ('emptyImageHere' in slot) && slot.emptyImageHere) ? hereItemImgPath : itemImgPath;
}

function getRealFilter(filter)
{
	var style = defaultImageFilter;
	if (dressOptions.colorizedDummy && filter != null && filter != '')
	{
		style = applyStyle(style, filter, 'redshadow', "shadow(color=red, direction=180, strength=3)");
		style = applyStyle(style, filter, 'goldshadow', "shadow(color=gold, direction=90, strength=4)");
		style = applyStyle(style, filter, 'purpleshadow', "shadow(color=purple, direction=270, strength=3)");
		style = applyStyle(style, filter, 'blueshadow', "shadow(color=blue, direction=180, strength=3)");
		style = applyStyle(style, filter, 'glow', 'glow(color=teal, strength=2)');
		style = applyStyle(style, filter, 'glo2', 'glow(color=green, strength=2)');
		style = applyStyle(style, filter, 'blur', 'blur');
		style = applyStyle(style, filter, 'alpha', 'alpha(opacity = 70, style = 3)');
		style = applyStyle(style, filter, 'wave', 'wave()');
	}
	return style;
}

function getImageId(state, slot, isMenu)
{
	var imgId = state.id.toString();
	if (isMenu)
	{
		imgId = menuImageIdPrefix + imgId;
	}
	imgId += slot.id;
	return imgId;
}

function getObjectOverText(state, slot)
{
	if (state == null || slot == null)
	{
		return '';
	}
	var html = '';
	if (slot.id == 'w3' && state.w3sharp > 0)
	{
		html += '<img src="' + hereItemImgPath + 'sharpen_all_' + state.w3sharp + '.gif" width="40" height="25" border="0" />';
	}
	if (slot.id == 'w10' && state.w10sharp > 0)
	{
		html += '<img src="' + hereItemImgPath + 'sharpen_all_' + state.w10sharp + '.gif" width="40" height="25" border="0" />';
	}
	return html;
}

function getPersObjectImageHtml(state, slot, mode, showImages, xclick, runes)
{
	var r = '';
	var style = 'cursor: hand; filter:';
	var onclick = '';
	if (xclick != null)
	{
		onclick = xclick;
	}
	else if (mode == null)
	{
		onclick = format("onObjectClick('{0}', '{1}')", state.id, slot.id);
	}
	if (onclick != '')
	{
		onclick = format(' onclick="{0}" oncontextmenu="{0}"', onclick);
	}

	var objid = (mode == null) ? state.objects[slot.index] : mode;
	var oimg = (objid == null) ? slot.id : objid;
	var o = (mode == null) ? getObjectByStateSlot(state, slot) : getObjectById(oimg);
	var sizeX = (runes == 1) ? o.width : slot.width;
	var sizeY = (runes == 1) ? o.height : slot.height;
	var filter = (mode == null) ? getObjectFilter(state, slot, o) : '';
	var imgId = getImageId(state, slot, (mode != null));
	style += getRealFilter(filter);
	if (xclick == null) r += '<td valign="top">';
	if (showImages == null || showImages)
	{
		var realItemImgPath = getRealImagePath(objid, slot);
/*
		if (mode == null)
		{
			r += format('<div style="position: relative; z-index: 0; left: {0}px; top: 0px; wrap: off">', slot.width - 40);
			r += getObjectOverText(state, slot);
			r += '</div>';
		}
		*/
		r += format(
					'<img id="{5}" name="x{1}" src="{0}{1}.gif" width="{2}" height="{3}" style="{4}" border="0"{6} onmouseover="showItemProps(this)" onmouseout="hidePopup()" />',
					realItemImgPath,
					oimg,
					sizeX,
					sizeY,
					style,
					imgId,
					onclick
					);
	}
	else
	{
		r += format(
					'<span id="{1}" name="x{4}" style="{0}" border="0"{2} onmouseover="showItemProps(this)" onmouseout="hidePopup()">{3}</span>',
					style,
					imgId,
					onclick,
					o.caption,
					oimg
					);
	}
	if (xclick == null) r += '</td>';
	return r;
}

function isImgInSlot(imgElt)
{
	var id = imgElt.id;
	var yes = (id.indexOf(menuImageIdPrefix) !== 0);
	return yes;
}

function getImgEltState(imgElt)
{
	return activeState;
}

function getImgEltSlot(imgElt)
{
	var id = imgElt.id;
	if (id.indexOf(menuImageIdPrefix) === 0)
	{
		id = id.substr(menuImageIdPrefix.length, id.length - menuImageIdPrefix.length)
	}
	id = id.substr(activeState.id.toString().length);
	return getSlotById(id);
}

function setMeter(state, meterSuffix, value)
{
	var baseId = format('{1}{0}', state.id, meterSuffix);
	if (document.getElementById(baseId) == null)
	{
		return;
	}
	if (value == null)
	{
		value = 0;
	}
	var s = value.toString();
	s = s + '/' + s;
	var w = 240 - ((s.length + 2) * 7);
	var displayMode = (value > 0) ? '' : 'none';
	document.getElementById(baseId).style.display = displayMode;
	document.getElementById(baseId + 'v').innerHTML = s;
	document.getElementById(baseId + 'i').width = w;
}

function getPersNickString(state)
{
	if (state.name == '')
	{
		return '';
	}
	var clanimg = '';
	if (state.clan != '')
	{
		clanimg = format('<img src="{1}{0}.gif" width="24" height="15" border="0" alt="{0}" />', state.clan, clanImgPath);
	}
	return format('<nobr><img src="{4}align{3}.gif" width="12" height="15" border="0" />{5}<b>{0}</b> [{2}]<a target="_blank" href="{6}{1}"><img src="{4}inf.gif" width="12" height="11" border="0" /></a></nobr>', htmlstring(state.name), state.name, state.natural.level, state.align, baseImgPath, clanimg, charInfoUrlFormat);
}

function showPetProps(e)
{
	var state = activeState;
	if (state == null || state.pet == null)
	{
		return;
	}
	var pet = pets[state.pet.n];
	var pl = pet.levels['L' + state.pet.level];
	var html = '<b>' + pet.caption2 + ' [' + pl.level + ']</b><br />';
	html += 'Имя: ' + state.pet.name + '<br />';
	if ('skill' in pl)
	{
		html += '<b>Освоенные навыки</b><br />';
		html += pl.skill.caption + ' [' + pl.skill.level + ']';
	}
	showPopup(html);
	if (!is.ie && e.stopPropagation)
	{
		e.stopPropagation();
	}
	if (is.ie)
	{
		window.event.cancelBubble = true;
		window.event.returnValue = false;
	}
	return false;
}

function showCharPopup()
{
	showPopup(localizer.charHint);
}

function getPersImageHtml(state)
{
	var oimg;
	var i;
	var hp = ('hitpoints' in state.results) ? state.results.hitpoints : 0;
	hp = hp.toString();
	hp = hp + '/' + hp;

	var r = '';
	r += '<table border="0" cellspacing="0" cellpadding="0"';
	if (state.sign != '')
	{
		r += ' style="background-image: url(';
		r += zodiacImgPath + state.sign;
		r += '.gif); background-repeat: no-repeat; background-position: top right;"';
	}
	r += '>';
	r += format('<tr><td id="{1}{0}" align="center" style="font-size: 12px;">{2}</td></tr>', state.id, 'nick', getPersNickString(state));
	r += format('<tr><td id="{1}{0}" width="240" align="right" nowrap="yes" style="font-size: 10px;">', state.id, hpMeterSuffix);
	r += format('<span id="{1}{0}v">{2}</span>&#160;', state.id, hpMeterSuffix, hp);
	var w = 240 - ((hp.length + 2) * 7);
	r += format('<img id="{4}{3}i" src="{0}" width="{2}" height="8" alt="{1} (100%)" border="0" />', hpMeterGreenImg, getItemPropLabel('hitpoints'), w, state.id, hpMeterSuffix);
	r += format('<img src="{0}herz.gif" width="10" height="9" alt="{1}"/>', baseImgPath, getItemPropLabel('hitpoints'));
	var mana = ('mana' in state.results) ? state.results.mana : 0;
	var manaDisplayMode = (mana > 0) ? '' : 'none';
	mana = mana.toString();
	mana = mana + '/' + mana;
	r += format('</td></tr><tr><td id="{1}{0}" width="240" align="right" nowrap="yes" style="font-size: 10px; display: {2}">', state.id, manaMeterSuffix, manaDisplayMode);
	r += format('<span id="{1}{0}v">{2}</span>&#160;', state.id, manaMeterSuffix, mana);
	w = 240 - ((mana.length + 2) * 7);
	r += format('<img id="{4}{3}i" src="{0}" width="{2}" height="8" alt="{1} (100%)" border="0" />', manaMeterImg, getItemPropLabel('mana'), w, state.id, manaMeterSuffix);
	r += format('<img src="{0}Mherz.gif" width="10" height="9" alt="{1}"/>', baseImgPath, getItemPropLabel('mana'));
	r += '</td></tr><tr height="4"><td height="4"></td></tr><tr><td><table border="0" cellspacing="0" cellpadding="0"><tr>';
	// w100 - w109
	for (i = 100; i < 105; i++)
	{
		r += getPersObjectImageHtml(state, getSlotById('w' + i));
	}
	// this slot is handled as book slot.
	r += getPersObjectImageHtml(state, slot_wbook);
//	r += format('<td><img style="filter:alpha(opacity = 40, style = 3)" src="{0}w{1}.gif" width="40" height="25" border="0" /></td>', itemImgPath, 109);
	r += '</tr><tr>';
	for (i = 105; i < 110; i++)
	{
		r += getPersObjectImageHtml(state, getSlotById('w' + i));
	}
	// this slot is handled separately like as BK.
	r += format('<td><img style="opacity: 0.4; MozOpacity: 0.4; KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w{1}.gif" width="40" height="25" border="0" /></td>', itemImgPath, 109);
	r += '</tr></table></td></tr><tr><td><table border="0" cellspacing="0" cellpadding="0"><tr><td width="60"><table width="60" border="0" cellpadding="0" cellspacing="0"><tr>';
	// w9
	r += getPersObjectImageHtml(state, slot_w9);
	r += '</tr><tr>';
	// w13
	r += getPersObjectImageHtml(state, slot_w13);
	r += '</tr><tr>';
	// w3
	r += getPersObjectImageHtml(state, slot_w3);
	r += '</tr><tr>';
	// w4
	r += getPersObjectImageHtml(state, slot_w4);
	r += '</tr><tr>';
	// w5
	r += getPersObjectImageHtml(state, slot_w5);
	r += '</tr></table></td>';
	r += '<td width="120"><table width="120" border="0" cellpadding="0" cellspacing="0"><tr><td colspan="3" width="120" onclick="onPersMenu()" oncontextmenu="onPersMenu()" onmouseover="showCharPopup()" onmouseout="hidePopup()" height="220" align="left" valign="bottom" style="background-image:url(';
	r += charImgPath + state.sex + '/' + state.image;
	r += '.gif); background-repeat: no-repeat; background-position: center center;">';
	if (state.statElix != null)
	{
		var selix = knownElix[state.statElix.elixn];
		r += '<a onclick="onConcreteElixMenu(' + "'" + state.statElix.elixn + "'" + ')" href="javascript:;">';
		r += '<img src="' + iconImgPath + selix.id + '.gif" title="' + selix.caption + ' +' + state.statElix.v + '" width="36" height="23" border="0" />';
		r += '</a>';
	}
	for (var damageelixn in state.damageElixes)
	{
		var damageelix = knownDamageElix[damageelixn];
		r += '<a onclick="onApplyConcreteElix(' + "'" + damageelixn + "'" + ', 0)" href="javascript:;">';
		r += '<img src="' + iconImgPath + damageelix.id + '.gif" title="' + damageelix.caption + '" width="36" height="23" border="0" />';
		r += '</a>';
	}
	for (var defelixn in state.defElixes)
	{
		var defelix = knownDefElix[defelixn];
		r += '<a onclick="onConcreteElixMenu(' + "'" + defelix.id + "'" + ')" href="javascript:;">';
		r += '<img src="' + iconImgPath + defelix.id + '.gif" title="' + defelix.caption + '" width="36" height="23" border="0" />';
		r += '</a>';
	}
	if (state.spellHitpoints != 0)
	{
		var spellHitpointsId = 'spellHitpointsUp';
		var spellHitpointsName = knownApplicableSpells.spellHitpointsUp.id;
		var spellHitpointsCaption = knownApplicableSpells.spellHitpointsUp.caption;
		if (state.spellHitpoints < 0)
		{
			var spellHitpointsId = 'spellHitpointsDown';
			spellHitpointsName = knownApplicableSpells.spellHitpointsDown.id;
			spellHitpointsCaption = knownApplicableSpells.spellHitpointsDown.caption;
		}
		r += '<a onclick="onConcreteElixMenu(' + "'" + spellHitpointsId + "'" + ')" href="javascript:;">';
		r += '<img src="' + itemImgPath + format(spellHitpointsName, Math.abs(state.spellHitpoints)) + '.gif" title="' + spellHitpointsCaption + ' ' + state.spellHitpoints + '" width="36" height="23" border="0" />';
		r += '</a>';
	}
	if (state.spellIntel > 0)
	{
		r += '<a onclick="onConcreteElixMenu(' + "'spellIntel'" + ')" href="javascript:;">';
		r += '<img src="' + itemImgPath + knownApplicableSpells.spellIntel.id + '.gif" title="' + knownApplicableSpells.spellIntel.caption + ' +' + state.spellIntel + '" width="36" height="23" border="0" />';
		r += '</a>';
	}
	if (state.spellBD > 0)
	{
		r += '<a onclick="onConcreteElixMenu(' + "'spellBD'" + ')" href="javascript:;">';
		r += '<img src="' + trickImgPath + knownApplicableSpells.spellBD.id + '.gif" title="' + knownApplicableSpells.spellBD.caption + '" width="36" height="23" border="0" />';
		r += '</a>';
	}

	if (state.pet != null)
	{
		var pet = pets[state.pet.n];
		r += format('<br /><img align="right" src="{0}{2}/{1}.gif" alt="" title="" onmouseover="showPetProps()" onmouseout="hidePopup()" width="40" height="73" border="0" />', charImgPath, pet.image.def, pet.image.sex);
	}
	r += '</td></tr><tr>';
	r += getPersObjectImageHtml(state, slot_w14);
	// w16 is skipped
	r += format('<td height="20"><img style="opacity: 0.4; MozOpacity: 0.4; KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w14.gif" width="40" height="20" border="0" /></td>', itemImgPath);
	r += getPersObjectImageHtml(state, slot_w15);
	r += '</tr><tr>';
	r += format('<td height="20"><img style="opacity: 0.4; MozOpacity: 0.4; KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w20_1.gif" width="40" height="20" border="0" /></td>', itemImgPath);
	r += format('<td height="20"><img style="opacity: 0.4; MozOpacity: 0.4; KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w20_1.gif" width="40" height="20" border="0" /></td>', itemImgPath);
	r += format('<td height="20"><img style="opacity: 0.4; MozOpacity: 0.4; KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w20_1.gif" width="40" height="20" border="0" /></td>', itemImgPath);
	r += '</tr></table></td><td width="60"><table width="60" border="0" cellpadding="0" cellspacing="0"><tr>';
	// w1
	r += getPersObjectImageHtml(state, slot_w1);
	r += '</tr><tr>';
	// w2
	r += getPersObjectImageHtml(state, slot_w2);
	r += '</tr><tr><td><table border="0" cellspacing="0" cellpadding="0"><tr>';
	// w6
	r += getPersObjectImageHtml(state, slot_w6);
	// w7
	r += getPersObjectImageHtml(state, slot_w7);
	// w8
	r += getPersObjectImageHtml(state, slot_w8);
	r += '</tr></table></td></tr><tr>';
	// w11
	r += getPersObjectImageHtml(state, slot_w11);
	r += '</tr><tr>';
	// w10
	r += getPersObjectImageHtml(state, slot_w10);
	r += '</tr><tr>';
	// w19
	r += getPersObjectImageHtml(state, slot_w19);
	r += '</tr><tr>';
	// w12
	r += getPersObjectImageHtml(state, slot_w12);
	r += '</tr></table></td>';
	r += '<td width="60" valign="bottom"><table width="60" border="0" cellpadding="0" cellspacing="0"><tr>';
	// w18
	r += getPersObjectImageHtml(state, slot_w18);
	r += '</tr><tr>';
	// wshirt (w0)
	r += getPersObjectImageHtml(state, slot_w0);
	r += '</tr><tr>';
	// w17
	r += getPersObjectImageHtml(state, slot_w17);
	r += '</tr></tr></table></td></tr></table></td></tr><tr><td><table border="0" cellspacing="0" cellpadding="0">';
	for (var ci = 0; ci < 3; ci++)
	{
		r += '<tr>';
		for (var i = 0; i < 7; i++)
		{
// 	if (ci==2 && i==7) {continue;}
			var trickNumber = (ci * 7) + i;
			r += getSingleTrickSlotHtml(state, trickNumber, state.trickSlots[trickNumber]);
		}
		r += '</tr>';
	}

	r += '</table></td></tr></table>';
	return r;
}

function changePersName()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var name = window.prompt('Введите имя этого персонажа', state.name);
	if (name == null)
	{
	    return;
	}
	state.name = name.toString();
	hardUpdateDresserState(state);
}

function changePersAlignTo(align)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	state.align = align;
	hardUpdateDresserState(state);
}

function changePersAlign()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var menuHtml = '<b>' + localizer.alignments + '</b>';
	menuHtml += '<table cellspacing="0" cellpadding="0" border="0"><tr><td>';
	menuHtml += '<table cellspacing="0" cellpadding="0" border="0"><tr>';
	var groupCount = 0;
	for (var ai = 0; ai < aligns.length; ai++)
	{
		var a = aligns[ai];
		if ('id' in a)
		{
			menuHtml += getRowMenuItemHtml('<img width="12" height="15" border="0" src="' + baseImgPath + 'align' + a.id + '.gif" />&nbsp;' + a.caption, 'changePersAlignTo(' + "'" + a.id + "'" + ')');
		}
		else
		{
			if (groupCount > 0)
			{
				menuHtml += '</table></td>';

			}
			menuHtml += '<td valign="top">';
			menuHtml += '<table cellspacing="0" cellpadding="0" border="0">';

			menuHtml += '<tr><td align="center"><small><b>';
			menuHtml += a.caption;
			menuHtml += '</b></small></td></tr>';
			groupCount++;
		}
	}
	menuHtml += '</table></td></tr>';
	menuHtml += '</table></td></tr>';
	menuHtml += '<tr><td>';
	menuHtml += '<hr class="dashed" />';
	menuHtml += '</td></tr>';
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table>';
	cursorX -= 40;
	cursorY -= 100;
	showMenu(menuHtml);
}

function changePersClan()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var clan = window.prompt('Введите название клана', state.clan);
	if (clan == null)
	{
	    return;
	}
	state.clan = clan.toString();
	hardUpdateDresserState(state);
}

function changePersGender()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	// test nonstandard image
	if (isNaN(state.image))
	{
		state.image = '0';
	}
	state.sex = 1 - state.sex;
	// test unexistent sex image
	if (maxPersImageNumber[state.sex] < parseInt(state.image))
	{
		state.image = '0';
	}
	for (var i = 0; i < excludePersImageNumbers[state.sex].length; i++)
	{
		if (excludePersImageNumbers[state.sex][i] == parseInt(state.image))
		{
			state.image = '0';
			break;
		}
	}
	hardUpdateDresserState(state);
}

function changePersImageTo(imagestr)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	state.image = imagestr.toString();
	hardUpdateDresserState(state);
}

function changePersImage()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var cpin = 'cpimag_' + state.sex;
	if (cpin in menuhash)
	{
		showMenu(menuhash[cpin]);
		return;
	}
	// test nonstandard image
	if (isNaN(state.image))
	{
		state.image = '0';
	}
	var perRow = ((8 * 60) / 60);
	var menuHtml = '<b>' + localizer.appearances + '</b>';
	menuHtml += '<table cellspacing="0" cellpadding="0" border="0"><tr><td>';
	menuHtml += '<table cellspacing="0" cellpadding="0" border="0"><tr>';
	var ri = 0;
	for (var i = 0; i <= maxPersImageNumber[state.sex]; i++)
	{
		var needCont = false;
		for (var ei = 0; ei < excludePersImageNumbers[state.sex].length; ei++)
		{
			if (excludePersImageNumbers[state.sex][ei] == i)
			{
				needCont = true;
				break;
			}
		}
		if (needCont)
		{
			continue;
		}
		var onclick = format("hideMenu(); changePersImageTo('{0}')", i);
		menuHtml += getCellMenuItemHtml(format('<img src="{0}{1}/{2}.gif" width="60" height="110" border="0" />',
		                            charImgPath,
		                            state.sex,
		                            i),
		                            onclick);
		if ((ri % perRow) == (perRow - 1))
		{
			menuHtml += '</tr><tr>';
		}
		ri += 1;
	}
	for (var i = 0; i < uniquePersImageNumbers[state.sex].length; i++)
	{
		var code = uniquePersImageNumbers[state.sex][i];
		var onclick = format("hideMenu(); changePersImageTo('{0}')", code);
		menuHtml += getCellMenuItemHtml(format('<img src="{0}{1}/{2}.gif" width="60" height="110" border="0" />',
		                            charImgPath,
		                            state.sex,
		                            code),
		                            onclick);
		if ((ri % perRow) == (perRow - 1))
		{
			menuHtml += '</tr><tr>';
		}
		ri += 1;
	}
	menuHtml += '</tr></table>';
	menuHtml += '</td></tr><tr><td>';
	menuHtml += '<hr class="dashed" />';
	menuHtml += '</td></tr>';
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table>';
	menuhash[cpin] = menuHtml;
	showMenu(menuHtml);
}

function changePersSignTo(sign)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	state.sign = sign;
	hardUpdateDresserState(state);
}

function changePersSign()
{
	var menuHtml  ='<table width="180px" border="0">';
	for (var i = 1; i <= 12; i++)
	{
		menuHtml += getRowMenuItemHtml(localizer['zodiac' + i], 'changePersSignTo(' + i + ')');
	}
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.zodiac0, "changePersSignTo('')");
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table>';
	showMenu(menuHtml);
	if (is.ie)
	{
		window.event.returnValue = false;
	}
	return false;
}

function onPersMenu()
{
	var menuHtml  ='<table width="180px" border="0">';
	menuHtml += getRowMenuItemHtml(localizer.changeName, 'changePersName()');
	menuHtml += getRowMenuItemHtml(localizer.changeGender, 'changePersGender()');
	menuHtml += getRowMenuItemHtml(localizer.changeSign, 'changePersSign()');
	menuHtml += getRowMenuItemHtml(localizer.changeImage, 'changePersImage()');
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.changeAlign, 'changePersAlign()');
	menuHtml += getRowMenuItemHtml(localizer.changeClan, 'changePersClan()');
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table>';
	showMenu(menuHtml);
	if (is.ie)
	{
		window.event.returnValue = false;
	}
	return false;
}

function onSharpeningMenu(slotid, minlevel, allownew, isstf, isdbl)
{
	var state = activeState;
	var slot = getSlotById(slotid);
	if (state == null || slot == null)
	{
		return;
	}

	var menuHtml  ='<table width="360px" border="0"><tr><td valign="middle" align="center"><table width="180px" border="0">';
	menuHtml += getRowMenuItemHtml(localizer.noSharpening, format("onSharpWeapon('{0}', '{1}', 0)", state.id, slot.id));
	if (allownew == 1)
	{
	menuHtml += getRowMenuSeparatorHtml();
	if (isstf != 1) { menuHtml += getRowMenuItemHtml(format('{0} +1', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 101)", state.id, slot.id)); }
	if (isstf != 1) { menuHtml += getRowMenuItemHtml(format('{0} +2', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 102)", state.id, slot.id)); }
	if (isstf != 1) { menuHtml += getRowMenuItemHtml(format('{0} +3', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 103)", state.id, slot.id)); }
	if ((isstf != 1) && (minlevel >= 1) && (isdbl == 1)) { menuHtml += getRowMenuItemHtml(format('{0} +4', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 104)", state.id, slot.id)); }
	if (minlevel >=2) { menuHtml += getRowMenuItemHtml(format('{0} +5', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 105)", state.id, slot.id)); }
	if (minlevel >=3) { menuHtml += getRowMenuItemHtml(format('{0} +6', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 106)", state.id, slot.id)); }
	if (minlevel >=4) { menuHtml += getRowMenuItemHtml(format('{0} +7', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 107)", state.id, slot.id)); }
	if (minlevel >=5) { menuHtml += getRowMenuItemHtml(format('{0} +8', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 108)", state.id, slot.id)); }
	if (minlevel >=6) { menuHtml += getRowMenuItemHtml(format('{0} +9', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 109)", state.id, slot.id)); }
	if (minlevel >=8) { menuHtml += getRowMenuItemHtml(format('{0} +11', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 111)", state.id, slot.id)); }
	}
	menuHtml += '</table></td><td valign="middle" align="center"><table width="180px" border="0">';
	menuHtml += getRowMenuItemHtml(format('{0} +1 [old]', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 1)", state.id, slot.id));
	menuHtml += getRowMenuItemHtml(format('{0} +2 [old]', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 2)", state.id, slot.id));
	menuHtml += getRowMenuItemHtml(format('{0} +3 [old]', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 3)", state.id, slot.id));
	menuHtml += getRowMenuItemHtml(format('{0} +4 [old]', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 4)", state.id, slot.id));
	menuHtml += getRowMenuItemHtml(format('{0} +5 [old]', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 5)", state.id, slot.id));
	menuHtml += getRowMenuItemHtml(format('{0} +7 [old]', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 7)", state.id, slot.id));
	menuHtml += getRowMenuItemHtml(format('{0} +10 [old]', localizer.sharpening), format("onSharpWeapon('{0}', '{1}', 10)", state.id, slot.id));
	menuHtml += '</table></td></tr><tr><td colspan="2" align="middle"><table align="center" width="360" border="0">';
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table></td></tr></table>';
	cursorY -= 200;
	showMenu(menuHtml);
	if (is.ie)
	{
		window.event.returnValue = false;
	}
	return false;
}

function areSameObjectsWeared(state, slot1, slot2)
{
	if (state == null) return false;
	if (slot1 == slot2) return true;
	if (slot1 == slot_w3 || slot1 == slot_w10)
	{
		if ((slot2 != slot_w3 && slot2 != slot_w10) || (state.w3sharp != state.w10sharp))
		{
			return false;
		}
	}

	var oid1 = state.objects[slot1.index];
	var oid2 = state.objects[slot2.index];
	if (oid1 == null || oid2 == null) return false;
	return true
		&& (oid1 == oid2)
		&& (state.upgradeSlots[slot1.index] == state.upgradeSlots[slot2.index])
		&& (state.fitSlots[slot1.index] == state.fitSlots[slot2.index])
		&& (state.charmSlots[slot1.index] == state.charmSlots[slot2.index])
		&& (state.addSlots[slot1.index] == state.addSlots[slot2.index])
		&& (state.runeSlots[slot1.index] == state.runeSlots[slot2.index])
		;
}

function openObjectData(slotid)
{
	var state = activeState;
	var slot = getSlotById(slotid);
	var o = getObjectByStateSlot(state, slot);
	var html = '';
	html += '<div style="width: 100%">';
	html += getDresserInfoPaneTabsHtml(-1);
	html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
	html += '<tr><td>';

	html += getObjectDescHtml(state, o);

	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr></table>';
	html += '</div>';
	document.getElementById('infopane' + state.id).innerHTML = html;
}

function onObjectClick(stateid, slotid)
{
	var i;
	var state = dressStates[stateid];
	var slot = getSlotById(slotid);
	if (state == null || slot == null)
	{
		return;
	}
	var origin = getObjectById(state.objects[slot.index]);
	var o = getObjectByStateSlot(state, slot);
	var menuHtml  ='<table width="180px" border="0">';
	if (slot.id == 'w6')
	{
		var ow7 = getObjectByStateSlot(state, slot_w7);
		if (ow7 != null)
		{
			menuHtml += getRowMenuItemHtml(localizer.dressSameItem + ' ' + ow7.caption, format("onItemWearFrom('{0}', '{1}')", slotid, slot_w7.id));
		}
		var ow8 = getObjectByStateSlot(state, slot_w8);
		if (ow8 != ow7 && ow8 != null)
		{
			menuHtml += getRowMenuItemHtml(localizer.dressSameItem + ' ' + ow8.caption, format("onItemWearFrom('{0}', '{1}')", slotid, slot_w8.id));
		}
	}
	if (slot.id == 'w7')
	{
		var ow6 = getObjectByStateSlot(state, slot_w6);
		if (ow6 != null)
		{
			menuHtml += getRowMenuItemHtml(localizer.dressSameItem + ' ' + ow6.caption, format("onItemWearFrom('{0}', '{1}')", slotid, slot_w6.id));
		}
		var ow8 = getObjectByStateSlot(state, slot_w8);
		if (ow8 != ow6 && ow8 != null)
		{
			menuHtml += getRowMenuItemHtml(localizer.dressSameItem + ' ' + ow8.caption, format("onItemWearFrom('{0}', '{1}')", slotid, slot_w8.id));
		}
	}
	if (slot.id == 'w8')
	{
		var ow6 = getObjectByStateSlot(state, slot_w6);
		if (ow6 != null)
		{
			menuHtml += getRowMenuItemHtml(localizer.dressSameItem + ' ' + ow6.caption, format("onItemWearFrom('{0}', '{1}')", slotid, slot_w6.id));
		}
		var ow7 = getObjectByStateSlot(state, slot_w7);
		if (ow7 != ow6 && ow7 != null)
		{
			menuHtml += getRowMenuItemHtml(localizer.dressSameItem + ' ' + ow7.caption, format("onItemWearFrom('{0}', '{1}')", slotid, slot_w7.id));
		}
	}
	for (var catid in categories)
	{
		if (categories[catid].slot == slotid)
		{
			menuHtml += getRowMenuItemHtml(categories[catid].caption, format("onCategorySelect('{0}', '{1}', '{2}')", state.id, slotid, catid));
		}
	}

	var isSpellSlot = 0;
	for (var SpellFinder = 100; SpellFinder <= 109; SpellFinder++)
		{ if (slot.id == 'w'+SpellFinder) { isSpellSlot = 1 ;} }

	if (isSpellSlot == 1)
		{
		menuHtml += getRowMenuSeparatorHtml();
		menuHtml += getRowMenuItemHtml(localizer.dropAllSpells, format("DropAllScrolls('{0}')", state.id));
		}

	if (o != null && origin != null)
	{
		var hasExtensions = false;
		menuHtml += getRowMenuSeparatorHtml();
		if (!('fakebase' in origin))
		{
			if (('upgrade' in o) || ('wasUpgrade' in o))
			{
				hasExtensions = true;
				menuHtml += getRowMenuItemHtml(localizer.upgradeObject, format("onUpgradeObject('{0}', '{1}', '')", state.id, slot.id));
			}
		}
		if (o.adjustment || ('setlinks' in o))
		{
			hasExtensions = true;
			menuHtml += getRowMenuItemHtml(localizer.fitObject, format("onFitObject('{0}', '{1}')", state.id, slot.id));
		}
		if (slot.id == 'w4')
		{
			hasExtensions = true;
			if (state.fitArmor)
			{
				menuHtml += getRowMenuItemHtml(localizer.unfitArmor, format("onFitArmor('{0}', false)", state.id));
			}
			else
			{
				menuHtml += getRowMenuItemHtml(localizer.fitArmor, format("onFitArmor('{0}', true)", state.id));
			}
		}
		if (slot.id == 'w3' || slot.id == 'w10')
		{
			var ocat = categories[o.category];
			if (('canBeSharpen' in ocat) && ocat.canBeSharpen)
			{
				hasExtensions = true;
				var minlv=0;
				var allowNewSharp=1;

				if ('required' in o)
					{ if ('level' in o.required)
						{
						minlv=o.required.level;
						//if ('artefact' in o) { if (minlv < 10) { allowNewSharp=0; } }
						}
					}

				var isStaff=0;
				if ('category' in o)
					{
					if (o.category == 'staffs') { isStaff=1; }
					}

				var isDouble=0;
				if ('properties' in o)
					{
					if ('twohandled' in o.properties)
						{
						isDouble=1;
						}
					}

				menuHtml += getRowMenuItemHtml(localizer.sharpening, format("onSharpeningMenu('{0}','{1}','{2}','{3}','{4}')", slot.id, minlv, allowNewSharp, isStaff, isDouble));
			}
		}

//		if (('canCharm' in slot) && !('artefact' in o))
		if ('category' in o)
			{
			if ('canRune' in categories[o.category])
				{
				hasExtensions = true;
				menuHtml += getRowMenuItemHtml(localizer.rune, format("ShowCatRunes('{0}', '{1}', '{2}')", o.category, state.id, slot.id));
				//menuHtml += getRowMenuItemHtml(localizer.rune, format("alert('Coming soon...')"));
				if ('wasRuned' in o)
				{
					menuHtml += getRowMenuItemHtml(localizer.unRune, format("onUnRuneObject('{0}', '{1}', '')", state.id, slot.id));
				}
				}
			}
		if (('modify' in o) && ('stats' in o.modify))			{

				hasExtensions = true;
				var ki = o.modify.stats;
				menuHtml += getRowMenuItemHtml(localizer.addStats, format("onaddStats('{0}', '{1}', '{2}')", state.id, slot.id,ki));
				if ('wasAdded' in o)
				{
					menuHtml += getRowMenuItemHtml(localizer.unaddStats, format("onUnaddStats('{0}', '{1}', '')", state.id, slot.id));
				}

			}
		if ('canCharm' in slot)
		{
			hasExtensions = true;
			menuHtml += getRowMenuItemHtml(localizer.charmObject, format("onCharmObject('{0}', '{1}', '')", state.id, slot.id));
			if ('wasCharmed' in o)
			{
				menuHtml += getRowMenuItemHtml(localizer.uncharmObject, format("onUncharmObject('{0}', '{1}', '')", state.id, slot.id));
			}
		}
		if (hasExtensions)
		{
		    menuHtml += getRowMenuSeparatorHtml();
		}
		menuHtml += getRowMenuItemHtml(localizer.dropItem, format("onObjectDrop('{0}', '{1}')", state.id, slotid));
	}
	if (o != null)
	{
		menuHtml += getRowMenuSeparatorHtml();
		menuHtml += getRowMenuItemHtml(localizer.showObjectData, format("openObjectData('{0}')", slotid));
	}
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table>';
	showMenu(menuHtml);
	if (is.ie)
	{
		window.event.returnValue = false;
	}
	return false;
}

function getItemPropTNMRBHtml(mf, total, natural, modify, maxv, req, noLabel, battlemf)
{
	var html =  ((noLabel != null) && noLabel) ? '': (getItemPropLabel(mf) + ': ');
	var hint = '';
	if (natural !== 0 || modify !== 0)
	{
		if (natural !== 0)
		{
			hint += localizer.describeNativeStats + getItemPropFormattedValue(mf, natural);
		}
		if (modify !== 0)
		{
			hint += (modify >= 0) ? '+' : '';
			hint += getItemPropFormattedValue(mf, modify);
			hint += localizer.describeSetStats;
		}
		hint += '.';
	}
	html += ' <span';
	if (hint != '')
	{
		html += ' title="' + hint + '"';
	}
	html += '>';
	html += getItemPropFormattedValue(mf, total, maxv);
	html += '</span>';
	if (battlemf != 0)
	{
		html += '<span title="от зверя только в бою">';
		html += (battlemf >= 0) ? '+' : '';
		html += getItemPropFormattedValue(mf, battlemf);
		html += '</span>';
	}
	if (req != null && req > 0)
	{
		html += ', <span title="' + localizer.requiredHint + '">';
		var s = ' [';
		s += getItemPropFormattedValue(mf, req);
		if (modify != 0)
		{
			var reqnatural = req - modify;
			if (reqnatural > 0)
			{
				s += ' (';
				s += getItemPropFormattedValue(mf, reqnatural);
				s += ')';
			}
		}
		s += ']';
		if (req > total)
		{
			s = s.fontcolor('red');
		}
		html += s;
		html += '</span>';
	}
	return html;
}

function getItemPropAdvWeaponHtml(mf, vobj, maxv, noLabel)
{
	var html = '';
	if (noLabel == null || !noLabel)
	{
		html += getItemPropLabel(mf) + ': ';
	}
	if (vobj == null)
	{
		html += '-';
		return html;
	}
	var vsum = vobj.minv + vobj.maxv;
	var fv = getItemPropFormattedValue(mf, vobj.minv);
	fv += '-';
	fv += getItemPropFormattedValue(mf, vobj.maxv);
	if (maxv != null && vsum < maxv)
	{
		fv = fv.fontcolor('blue');
	}
	else
	{
		fv = fv.fontcolor('darkgreen');
	}
	html += fv;
	return html;
}

function getWeaponSkillValueOf(state, wo, skillname)
{
	var skill = 0;
	if (skillname in state.results)
	{
		skill = state.results[skillname];
	}
	if ('weaponskill' in state.results)
	{
		skill += state.results.weaponskill;
	}
	if (('properties' in wo) && (skillname in wo.properties))
	{
		skill += wo.properties[skillname];
	}
	if (('properties' in wo) && ('weaponskill' in wo.properties))
	{
		skill += wo.properties.weaponskill;
	}
	return skill;
}


function getWeaponSkillData(state, wslot)
{
	var wo = getObjectByStateSlot(state, wslot);
	if ((wo == null) || (wo.slot != 'w3'))
	{
		return {name: null, value: 0};
	}
	var skillname = null;
	if ('required' in wo)
	{
		for (var i = 0; i < knownWeaponSkills.length; i++)
		{
			if (knownWeaponSkills[i] in wo.required)
			{
				skillname = knownWeaponSkills[i];
				break;
			}
		}
	}
	if ((skillname == null) && ('skillname' in categories[wo.category]))
	{
		skillname = categories[wo.category].skillname;
	}
	if (skillname == null)
	{
		return {name: null, value: 0};
	}
	var v = getWeaponSkillValueOf(state, wo, skillname);
	return {name: skillname, value: v};
}

function getWeaponSkillValue(state, wslot)
{
	var d = getWeaponSkillData(state, wslot);
	return d.value;
}

function hasTwoWeapons(state)
{
	var w3o = getObjectByStateSlot(state, slot_w3);
	if (w3o == null)
	{
		return false;
	}
	var w10o = getObjectByStateSlot(state, slot_w10);
	if ((w10o == null) || (w10o.slot != slot_w3.id))
	{
		return false;
	}
	return true;
}

function getDresserInfoPaneWeaponHtml(state, wslot)
{
	var wo = getObjectByStateSlot(state, wslot);
	if (wo == null && wslot.id != slot_w3.id)
	{
		return '';
	}
	var html = '<tr><td colspan="2"><hr size="1" noshade="noshade" /></td></tr>';
	html += '<tr><td valign="top"><b>';
	html += localizer.strikeGroup;
	html += '</b></td><td valign="top"><font color="#336699"><b>';
	var caption = (wo == null) ? localizer.fists : wo.caption;
	html += caption;
	html += '</b></font></td></tr>';
	var chapterHtml = '';
	for (var mf in knownAdvWeaponModifiers)
	{
		if (!item_props[mf].view)
		{
			continue;
		}
		var vt = (mf in state[wslot.id + 'props']) ? state[wslot.id + 'props'][mf] : null;
		var mvt = (vt != null) ? (vt.minv + vt.maxv) : 0;
		for (var staten in dressStates)
		{
			var astate = dressStates[staten];
			var avt1 = (mf in astate.w3props) ? astate.w3props[mf] : null;
			var mavt1 = (avt1 != null) ? (avt1.minv + avt1.maxv) : 0;
			var avt2 = (mf in astate.w10props) ? astate.w10props[mf] : null;
			var mavt2 = (avt1 != null) ? (avt1.minv + avt1.maxv) : 0;
			if (mvt < mavt1)
			{
				mvt = mavt1;
			}
			if (mvt < mavt2)
			{
				mvt = mavt2;
			}
		}
		if (mvt != 0)
		{
			chapterHtml += '<tr><td valign="top">';
			chapterHtml += getItemPropLabel(mf);
			chapterHtml += ': </td><td valign="top">';
			chapterHtml += getItemPropAdvWeaponHtml(mf, vt, mvt, true);
			chapterHtml += '</td></tr>';
		}
	}
	if (chapterHtml)
	{
		html += chapterHtml;
		html += '<tr><td><hr class="dashed" /></td><td><a href="#" class="TLink" onclick="showDamagePane(); return false"><small>' + localizer.showDetails + '</small></a></td></tr>';
		chapterHtml = '';
	}
	for (var i = 0; i < knownWeaponModifiers.length; i++)
	{
		var mf = knownWeaponModifiers[i];
		if (mf == '-')
		{
			if (chapterHtml)
			{
				html += chapterHtml + '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
				chapterHtml = '';
			}
			continue;
		}
		if (!item_props[mf].view)
		{
			continue;
		}
		var vn = (mf in state.natural) ? state.natural[mf] : 0;
		var vm = (mf in state[wslot.id + 'props']) ? state[wslot.id + 'props'][mf] : 0;
		var vt = vn + vm;
		var mvt = vt;
		for (var staten in dressStates)
		{
			var astate = dressStates[staten];
			var avn = (mf in astate.natural) ? astate.natural[mf] : 0;
			var avm1 = (mf in astate.w3props) ? astate.w3props[mf] : 0;
			var avm2 = (mf in astate.w10props) ? astate.w10props[mf] : 0;
			var avt1 = avn + avm1;
			var avt2 = avn + avm2;
			if (mvt < avt1)
			{
				mvt = avt1;
			}
			if (mvt < avt2)
			{
				mvt = avt2;
			}
		}
		if (mvt != 0 || vn != 0 || vm != 0)
		{
			chapterHtml += '<tr><td valign="top">';
			chapterHtml += getItemPropLabel(mf);
			chapterHtml += ': </td><td valign="top">';
			chapterHtml += getItemPropTNMRBHtml(mf, vt, vn, vm, mvt, null, true, 0);
			chapterHtml += '</td></tr>';
		}
	}
	if (chapterHtml)
	{
		html += chapterHtml;
	}
	return html;
}

function getDresserInfoPaneCombatSpellHtml(state, spellid)
{
	var r = state.combatSpells[spellid];
	var o = getObjectById(spellid);
	var html = '<tr><td colspan="2"><hr size="1" noshade="noshade" /></td></tr>';
	if (isHeavyArmor(getObjectByStateSlot(state, slot_w4)))
	{
		html += format(localizer.badHeavyArmor,
			getMenuItemHtml(localizer.here, format("onObjectDrop('{0}', 'w4')", state.id))
			);
	}
	if (areNotMagicGloves(getObjectByStateSlot(state, slot_w11)))
	{
		html += format(localizer.badGloves,
			getMenuItemHtml(localizer.here, format("onObjectDrop('{0}', 'w11')", state.id))
			);
	}
	html += '<tr><td valign="top"><b>';
	html += localizer.strikeGroup;
	html += '</b></td><td valign="top"><font color="#336699"><b>';
	html += o.caption;
	html += '</b></font></td></tr>';
	var chapterHtml = '';
	for (var mf in r)
	{
		if (!item_props[mf].view)
		{
			continue;
		}
		var vt = r[mf];
		var mvt = (vt.minv + vt.maxv);
		for (var staten in dressStates)
		{
			var astate = dressStates[staten];
			var avt = (spellid in astate.combatSpells) ? astate.combatSpells[spellid][mf] : null;
			var mavt = (avt != null) ? (avt.minv + avt.maxv) : 0;
			if (mvt < mavt)
			{
				mvt = mavt;
			}
		}
		if (mvt != 0)
		{
			chapterHtml += '<tr><td valign="top">';
			chapterHtml += getItemPropLabel(mf);
			chapterHtml += ': </td><td valign="top">';
			chapterHtml += getItemPropAdvWeaponHtml(mf, vt, mvt, true);
			chapterHtml += '</td></tr>';
		}
	}
	if (chapterHtml)
	{
		html += chapterHtml;
		html += '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
		chapterHtml = '';
	}
	if (chapterHtml)
	{
		html += chapterHtml;
	}
	return html;
}

function getDresserInfoPaneCombatTrickHtml(ctrick)
{
	var trick = tricks[ctrick.name];
	var html = '<tr><td colspan="2"><hr size="1" noshade="noshade" /></td></tr>';

	html += '<tr><td valign="top"><b>';
	html += localizer.trick;
	html += '</b></td><td valign="top"><font color="#336699"><b>';
	html += ctrick.caption;
	html += '</b></font></td></tr>';
	var chapterHtml = '';
	for (var mf in ctrick)
	{
	    if (mf == 'name' || mf == 'caption')
	    {
	        continue;
	    }
		if (!item_props[mf].view)
		{
			continue;
		}
		var vt = ctrick[mf];
		var mvt = vt;
		for (var staten in dressStates)
		{
			var astate = dressStates[staten];
			var avt = (ctrick.name in astate.combatSpells) ? astate.combatSpells[ctrick.name][mf] : 0;
			if (mvt < avt)
			{
				mvt = avt;
			}
		}
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += getItemPropLabel(mf);
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += getItemPropFormattedValue(mf, vt, mvt);
		chapterHtml += '</td></tr>';
	}
	var targeter = null;
	if ('attack' in trick)
	{
	    targeter = trick.attack;
	} else if ('healing' in trick)
	{
	    targeter = trick.healing;
	}
	if (targeter != null)
	{
	    var count = 'Одна цель';
	    if ('mincount' in targeter)
	    {
	        count = targeter.mincount + ' - ' + targeter.maxcount + ' целей';
	    }
	    else if ('count' in targeter)
	    {
	        count = targeter.count + ' целей';
	    }
	    chapterHtml += '<tr><td valign="top">';
	    chapterHtml += 'Количество целей';
	    chapterHtml += ': </td><td valign="top">';
	    chapterHtml += count;
	}

	if (chapterHtml)
	{
		html += chapterHtml;
		html += '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
		chapterHtml = '';
	}
	if (chapterHtml)
	{
		html += chapterHtml;
	}
	return html;
}

function getDefElixSecondValue(defelix, firstValue)
{
	var index = 0;
	for (var i = 0; i < defelix.values.length; i++)
	{
		if (defelix.values[i] > firstValue)
		{
			break;
		}
		index = i;
	}
	return defelix.values2[index];
}

function toggleViewOption(isItemProp, prop)
{
	if (isItemProp)
	{
		item_props[prop].view = !item_props[prop].view;
	}
	else
	{
		common_props[prop].view = !common_props[prop].view;
	}
}

function getDresserInfoPaneTabHtml(tabText, tabFunc, on)
{
	var html = '';
	var classn = on ? 'activeLink' : 'usualLink';
	var onclick = on ? '' : (' onclick="' + tabFunc + '"');
	html += format('<li class="{0}"><a href="javascript:;"{1}>{2}</a></li>', classn, onclick, tabText);
	return html;
}

function getDresserInfoPaneTabsHtml(tabIndex)
{
	var state = activeState;
	var html = '';
	html += '<br />';
	html += '<div class="dtab"><ul class="dtab" style="float:right; margin-right: 16px;">';
	html += getDresserInfoPaneTabHtml(localizer.infoPaneHeader, 'showInfoPane()', (tabIndex == 0));
	html += getDresserInfoPaneTabHtml(localizer.damagePaneHeader, 'showDamagePane()', (tabIndex == 4));
	html += getDresserInfoPaneTabHtml(localizer.componentsPaneHeader, 'showComponentsPane()', (tabIndex == 5));
	html += getDresserInfoPaneTabHtml(localizer.listPaneHeader, 'showListPane()', (tabIndex == 1));
	if (state != null && state.pet != null)
	{
		html += getDresserInfoPaneTabHtml(localizer.petPaneHeader, 'showPetPane()', (tabIndex == 2));
	}
	html += getDresserInfoPaneTabHtml(localizer.viewOptionsPaneHeader, 'showViewOptionsPane()', (tabIndex == 3));
	html += '</ul></div>';
	return html;
}

function getDresserPetPaneHtml()
{
	var state = activeState;
	if (state == null || state.pet == null)
	{
		return '';
	}
	var html = '';
	var pet = pets[state.pet.n];
	var pl = pet.levels['L' + state.pet.level];
	html += '<div style="width: 100%">';
	html += getDresserInfoPaneTabsHtml(2);
	html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
	html += '<tr><td>';
	html += '<b>Информация о выбранном питомце</b><br />';
	html += 'Тип: ' + pet.caption;
	for (var name in pl)
	{
		if (name in item_props)
		{
			html += '<br />' + getItemPropLabel(name) + ': ' + getItemPropFormattedValue(name, pl[name]);
		}
	}
	if ('foods' in pet)
	{
		html += '<hr class="dashed" />';
		html += '<small>Еда</small><br />';
		for (var foodn in pet.foods)
		{
			var food = pet.foods[foodn];
			html += format('<img src="{0}{1}.gif" title="{2}" alt="{2}" width="60" height="60" border="0" />', itemImgPath, food.name, food.caption);
		}
	}

	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr></table>';
	html += '</div>';
	return html;
}

function getCharmChooserHtml(sloti)
{
	var html = '';
	var slot = getSlotByIndex(sloti);
	var o = getObjectByStateSlot(activeState, slot);
	html += '<table cellspacing="0" cellpadding="0" border="0"><tr><td>';
	html += format(localizer.charmHint, clanImgPath);
	html += '<div style="text-align: right;">';
	html += '<table cellspacing="0" cellpadding="0" border="0"><tr>';
	for (var i = 0; i < knownPredefinedCharms.length; i++)
	{
		var charm = knownPredefinedCharms[i];
		if ('categories' in charm)
		{
			var found = false;
			for (var ci = 0; ci < charm.categories.length; ci++)
			{
				if (charm.categories[ci] == o.category)
				{
					found = true;
					break;
				}
			}
			if (!found)
			{
				continue;
			}
		}
		var text = '<img border="0" width="40" height="25" src="' + itemImgPath + charm.id + '.gif" + title="Наложить ' + charm.caption + '" />';
		var action = "doPredefinedCharm('" + sloti + "', '" + charm.v + "')";
		html += getCellMenuItemHtml(text, action);
	}
	html += '</tr></table>';
	html += '</div>';
	html += '<label for="charm_mf_name">' + localizer.charmChooseMf + ':</label><br />';
	html += '<select class="ABText80" id="charm_mf_name">';
	for (var ipi in item_props)
	{
		var prop = item_props[ipi];
		if ('nocharm' in prop)
		{
			continue;
		}
		html += format('<option value="{0}">{1}</option>', ipi, prop.lbl);
	}
	html += '</select><br />';
	html += '<label for="charm_mf_value">' + localizer.charmEnterV + ':</label><br />';
	html += '<input class="ABText80" id="charm_mf_value" type="text" maxlength="5" value="" /><br />';
	html += '<input id="charm_mf_replace" type="checkbox" value="replace" />';
	html += '<label for="charm_mf_replace">' + localizer.charmReplace + '.</label><br />';
	if (!('canCharm' in slot))
	{
		html += '<div style="color: red; font-size: x-small;">Зачарование этого слота в БК невозможно.</div>';
	}
	if ('artefact' in o)
	{
	if ('required' in o)
		{
		if ('level' in o.required)
			{
			if (o.required.level < 10)
				{ html += '<div style="color: red; font-size: x-small;">Зачарование артефактов менее 10-го уровня в БК невозможно.</div>'; }
			}
		}
	}
	html += '<input class="inpButton" type="button" value="' + localizer.charmObject + '" onclick="doCharm(' + sloti + ')" />';
	html += ' <input class="inpButton" type="button" value="' + localizer.cancel + '" onclick="hideMenu()" />';
	html += '</td></tr></table>';
	return html;
}
 ///////////////////////////////////////////////////////////////////////////////////
function getASChooserHtml(sloti,numb)
{
	var html = '';
	var slot = getSlotByIndex(sloti);
	var o = getObjectByStateSlot(activeState, slot);
	html += '<table cellspacing="0" cellpadding="0" border="0"><tr><td>';
	html += format(localizer.addstatsHint, clanImgPath);
	html += '<div style="text-align: left;">';
	html += '<table cellspacing="0" cellpadding="0" border="0"><tr>';
    html += '<td><div id="awsdstats">Количество увеличений:';
    html += '<input type="hidden" id="itemstat" class="ABTextAA" value="'+numb+'">';
    html += '<input type="text" id="alst" class="ABTextAA" value="'+numb+'" READONLY></div></td><tr><td>';

    html += '<input class="ABTextAA" id="add_strength" type="text" maxlength="3" value="0" READONLY/>   Сила</td><td>'
    html += '<a onclick="item_ad_p(\'add_strength\')" href="javascript:;"><img src="http://img.combats.com/i/plus.gif" alt="увеличить" border=0> </a>';
    html += '<a onclick="item_ad_m(\'add_strength\')" href="javascript:;"><img src="http://img.combats.com/i/minus.gif" alt="уменшить" border=0> </a>';
    html += '</td></tr><tr><td>';

    html += '<input class="ABTextAA" id="add_dexterity" type="text" maxlength="3" value="0" READONLY />   Ловкость</td><td>';
    html += '<a onclick="item_ad_p(\'add_dexterity\')" href="javascript:;"><img src="http://img.combats.com/i/plus.gif" alt="увеличить" border=0> </a>';
    html += '<a onclick="item_ad_m(\'add_dexterity\')" href="javascript:;"><img src="http://img.combats.com/i/minus.gif" alt="уменшить" border=0> </a>';
    html += '</td></tr><tr><td>';

    html += '<input class="ABTextAA" id="add_intuition" type="text" maxlength="3" value="0" READONLY/>   Интуиция</td><td>';
    html += '<a onclick="item_ad_p(\'add_intuition\')" href="javascript:;"><img src="http://img.combats.com/i/plus.gif" alt="увеличить" border=0> </a>';
    html += '<a onclick="item_ad_m(\'add_intuition\')" href="javascript:;"><img src="http://img.combats.com/i/minus.gif" alt="уменшить" border=0> </a>';
    html += '</td></tr><tr><td>';
	
	html += '<input class="ABTextAA" id="add_endurance" type="text" maxlength="3" value="0" READONLY/>   Выносливость</td><td>';
    html += '<a onclick="item_ad_p(\'add_endurance\')" href="javascript:;"><img src="http://img.combats.com/i/plus.gif" alt="увеличить" border=0> </a>';
    html += '<a onclick="item_ad_m(\'add_endurance\')" href="javascript:;"><img src="http://img.combats.com/i/minus.gif" alt="уменшить" border=0> </a>';
    html += '</td></tr><tr><td>';
	
	html += '<input class="ABTextAA" id="add_wisdom" type="text" maxlength="3" value="0" READONLY/>   Мудрость</td><td>';
    html += '<a onclick="item_ad_p(\'add_wisdom\')" href="javascript:;"><img src="http://img.combats.com/i/plus.gif" alt="увеличить" border=0> </a>';
    html += '<a onclick="item_ad_m(\'add_wisdom\')" href="javascript:;"><img src="http://img.combats.com/i/minus.gif" alt="уменшить" border=0> </a>';
    html += '</td></tr><tr><td>';

    html += '<input class="ABTextAA" id="add_intellect" type="text" maxlength="3" value="0" READONLY />   Интеллект</td><td>';
    html += '<a onclick="item_ad_p(\'add_intellect\')" href="javascript:;"><img src="http://img.combats.com/i/plus.gif" alt="увеличить" border=0> <a>';
    html += '<a onclick="item_ad_m(\'add_intellect\')" href="javascript:;"><img src="http://img.combats.com/i/minus.gif" alt="уменшить" border=0> <a>';
    html += '</td></tr></table>';
    html += '</div>';
    html += '</td></tr></table>';
	html += '<input class="inpButton" type="button" value="' + localizer.addstatsObject + '" onclick="doAddStats(' + sloti + ')" />';
	html += ' <input class="inpButton" type="button" value="' + localizer.cancel + '" onclick="hideMenu()" />';
	html += '</td></tr></table>';
	return html;
}



function item_ad_p(stat)
   {
    as = document.getElementById('alst');
    var istat = document.getElementById('itemstat').value;
    elem = document.getElementById(stat);
    document.getElementById(stat).focus();
    if ((parseInt(as.value) <= parseInt(istat)) && (parseInt(as.value) > 0))
    {
    elem.value ++;
    as.value--;
    }
    document.getElementById(stat).blur();
   }

function item_ad_m(stat)
   {
    as = document.getElementById('alst');
    elem = document.getElementById(stat);
    var istat = document.getElementById('itemstat').value;
    document.getElementById(stat).focus();

    if ((as.value <=istat) && (as.value >= 0) )
    {
     if (elem.value >= 1)
    {
    elem.value --;
    as.value ++;
    }
    }
    document.getElementById(stat).blur();
   }

function getDresserViewOptionsPaneHtml()
{
	var html = '';
	html += '<div style="width: 100%">';
	html += getDresserInfoPaneTabsHtml(3);
	html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
	html += '<tr><td>';
	html += localizer.indicesPaneHeader;
	for (var ci in common_props)
	{
		var prop = common_props[ci];
		html += format('<input onclick="toggleViewOption(false, {2})" type="checkbox" id="{0}" name="{0}"{1} /><label for="{0}">', ci, (prop.view ? ' checked="true"' : ''), format("'{0}'", ci));
		html += htmlstring(prop.lbl);
		html += '</label><br />';
	}
	html += '<hr class="dashed" />';
	for (var ipi in item_props)
	{
		var prop = item_props[ipi];
		html += format('<input onclick="toggleViewOption(true, {2})" type="checkbox" id="{0}" name="{0}"{1} /><label for="{0}">', ipi, (prop.view ? ' checked="true"' : ''), format("'{0}'", ipi));
		html += htmlstring(prop.lbl);
		html += '</label><br />';
	}
	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr></table>';
	html += '</div>';
	return html;
}

function getDresserListPaneHtml(state)
{
	var html = '';
	html += '<div style="width: 100%">';
	html += getDresserInfoPaneTabsHtml(1);
	html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
	html += '<tr><td>';
	html += '<b>' + localizer.naturalStats + '</b><br />';
	for (var i = 0; i < knownStats.length; i++)
	{
		html += getItemPropLabel(knownStats[i]);
		html += ': ';
		html += getItemPropFormattedValue(knownStats[i], state.natural[knownStats[i]]);
		html += '<br />';
	}
	html += '<hr class="dashed" />';

	html += '<b>' + localizer.resultStats + '</b><br />';
	for (var i = 0; i < knownStats.length; i++)
	{
		html += getItemPropLabel(knownStats[i]);
		html += ': ';
		html += getItemPropFormattedValue(knownStats[i], state.results[knownStats[i]]);
		html += '<br />';
	}
	html += '<hr class="dashed" />';

	html += '<b>' + localizer.wearedItems + '</b><br />';
	for (var i = 0; i < slots.length; i++)
	{
		var o = getObjectByStateSlot(state, slots[i]);
		if (o == null)
		{
			continue;
		}
		html += '<a class="ISLink" href="#" onclick="return dcInfoSpace(';
		var o2 = getObjectById(state.objects[slots[i].index]);
		html += "'" + o2.id + "', 'goodies'";
		html += ')" >';
		html += htmlstring(o.caption);
		html += '&nbsp;<img alt="Информация" src="' + infospaceImgPath + 'info.gif" width="12" height="11" border="0" /></a>';
		html += '<br />';
	}
	html += '<hr class="dashed" />';

	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr></table>';
	html += '</div>';
	return html;
}

function showPetPane()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	document.getElementById('infopane' + state.id).innerHTML = getDresserPetPaneHtml();
}

function showViewOptionsPane()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	document.getElementById('infopane' + state.id).innerHTML = getDresserViewOptionsPaneHtml();
}

function showListPane()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	document.getElementById('infopane' + state.id).innerHTML = getDresserListPaneHtml(state);
}

function showDamagePane()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	document.getElementById('infopane' + state.id).innerHTML = getDresserDamagePaneHtml(state);
}

function showComponentsPane()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	document.getElementById('infopane' + state.id).innerHTML = getDresserComponentsPaneHtml(state);
}

function showPetSkillProps()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var pet = pets[state.pet.n];
	var pl = pet.levels['L' + state.pet.level];
	showPopup(getObjectDescHtml(state, pl.skill));
}

function getDamageHtml(caption, damageData)
{
	var html = '';

	var chapterHtml = '';
	for (var mf in knownAdvWeaponModifiers)
	{
		if (!item_props[mf].view)
		{
			continue;
		}
		var vt = (mf in damageData) ? damageData[mf] : null;
		var mvt = (vt != null) ? (vt.minv + vt.maxv) : 0;
		if (mvt != 0)
		{
			chapterHtml += '<tr><td valign="top">';
			chapterHtml += getItemPropLabel(mf);
			chapterHtml += ': </td><td valign="top">';
			chapterHtml += getItemPropAdvWeaponHtml(mf, vt, mvt, true);
			chapterHtml += '</td></tr>';
		}
	}
	if (item_props._power_v.view && ('_power_v' in damageData))
	{
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += getItemPropLabel('_power_v');
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += getItemPropFormattedValue('_power_v', damageData._power_v);
		chapterHtml += '</td></tr>';
	}

	if (chapterHtml)
	{
		html += '<tr><td><b>' + caption + '</b></td></tr>';
		html += chapterHtml;
		html += '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
	}

	return html;
}

function getDresserDamagePaneHtmlFor(state, wslot)
{
	var wo = getObjectByStateSlot(state, wslot);
	if (wo == null && wslot.id != slot_w3.id)
	{
		return '';
	}
	var html = '<tr><td colspan="2"><hr size="1" noshade="noshade" /></td></tr>';
	html += '<tr><td valign="top"><b>';
	html += localizer.strikeGroup;
	html += '</b></td><td valign="top"><font color="#336699"><b>';
	var caption = (wo == null) ? localizer.fists : wo.caption;
	html += caption;
	html += '</b></font></td></tr>';
	var wd = state[wslot.id + 'props'];
	html += getDamageHtml(localizer.averageDamage + ':', wd);
	var wsd = getWeaponSkillData(state, wslot);
	if (wsd != null && wsd.name != null)
	{
		html += '<tr><td valign="top">';
		html += getItemPropLabel(wsd.name);
		html += ': </td><td valign="top">';
		html += wsd.value;
		html += '</td></tr>';
		html += '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
	}
	for (var attackn in wd.damages)
	{
		var d = wd.damages[attackn];
		var caption = localizer['attackt' + attackn];
		caption += ' (' + d.attack.freal + '%):';
		html += getDamageHtml(caption, d);
	}
	return html;
}

function getDresserDamagePaneHtml(state)
{
	var html = '';
	html += '<div style="width: 100%">';
	html += getDresserInfoPaneTabsHtml(4);
	html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;"><tr>';

	var wo3 = getObjectByStateSlot(state, slot_w3);
	var wo10 = getObjectByStateSlot(state, slot_w10);

	html += '<td valign="top"><table border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
	html += getDresserDamagePaneHtmlFor(state, slot_w3);
	html += '</table></td>';
	if ((wo10 != null) && (wo10.slot == 'w3'))
	{
		if (!areSameObjectsWeared(state, slot_w3, slot_w10))
		{
			html += '<td valign="top"><table border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
			html += getDresserDamagePaneHtmlFor(state, slot_w10);
			html += '</table></td>';
		}
		else
		{
			html += '<td valign="top"><table border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
			html += '<tr><td colspan="2"><hr size="1" noshade="noshade" /></td></tr>';
			html += '<tr><td colspan="2" valign="top">';
			html += localizer.sameWeapon;
			html += '</td></tr>';
			html += '</table></td>';
		}
	}
	html += '</table></td>';


	html += '</tr></table>';
	html += '</td></tr></table>';
	html += '</div>';
	return html;
}


function getDresserComponentsPaneHtml(state)
{
	var html = '';
	html += '<div style="width: 100%">';
	html += getDresserInfoPaneTabsHtml(5);
	html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;"><tr>';
	html += '<td valign="top">';

	var eps = {};
	for (var epn in dressExchangePoints)
	{
		var ep = dressExchangePoints[epn];
		eps[epn] = { id: epn, caption: ep.caption, description: ep.description, items: [] };
	}

	html += '<b>' + localizer.componentsPaneHeader + '</b>';
	var chtml = '';
	var totals = {};
	for (var i = 0; i < slots.length; i++)
	{
		var slot = slots[i];
		var o = getObjectByStateSlot(state, slot);
		if (o == null) continue;
		if ('requireditems' in o)
		{
			for (var oi in o.requireditems)
			{
				eps[oi].items.push({ id: o.id, caption: o.caption, items: o.requireditems[oi].items});
			}
		}
		if (!('clist' in o)) continue;
		chtml += '<br /><b><i>' + o.caption + '</i></b>: ';
		for (var ccn in o.clist)
		{
			var firstc = true;
			for (var cn in o.clist[ccn])
			{
				var c = o.clist[ccn][cn];
				if (!(cn in totals)) totals[cn] = {id:cn, count:0, caption:c.caption};
				totals[cn].count += c.count;
				if (firstc) firstc = false; else chtml += ',';
				chtml += ' ' + c.caption + ' - ' + c.count;
			}
			chtml += '.';
		}
	}
	if (chtml != '')
	{
		html += '<br /><b><i>' + 'Создание' + '</i></b>';
		html += chtml;
		html += '<br /><i><b>Всего</b></i>: ';
		html +- '<ul>';
		var firstc = true;
		for (var cn in totals)
		{
			var c = totals[cn];
			if (firstc) firstc = false; //else html += '';
			html += '<li> ' + c.caption + ' - ' + c.count + ' </li>';
		}
		html += '</ul>';
		html += '<br />';
	}
	for (var epi in eps)
	{
		var ep = eps[epi];
		var ephtml = '';
		totals = {};
		for (var i in ep.items)
		{
			var item = ep.items[i];
			ephtml += item.caption + ': ';
			var firstc = true;
			for (var ci in item.items)
			{
				var c = item.items[ci];
				if (!(ci in totals)) totals[ci] = {id:ci, count:0, caption:c.caption};
				totals[ci].count += c.count;
				if (firstc) firstc = false; else ephtml += ',';
				ephtml += ' ' + c.caption + ' - ' + c.count;
			}
			ephtml += '.<br />';
		}
		if (ephtml != '')
		{
			html += '<br /><b title="' + ep.description + '"><i>' + ep.caption + '</i></b><br />';
			html += ephtml;
			html += '<i>Всего</i>: ';
			var firstc = true;
			for (var ci in totals)
			{
				var c = totals[ci];
				if (firstc) firstc = false; else html += ',';
				html += ' ' + c.caption + ' - ' + c.count;
			}
			html += '<br />';
		}
	}

	html += '</td>';
	html += '</tr></table>';
	html += '</td></tr></table>';
	html += '</div>';
	return html;
}

function getMatvikZoneValue(v)
{
	v = 1 - Math.pow(0.5, (v / 250.0));
	v *= 100.0;
	v = Math.floor(v * 100.0 + 0.5) / 100.0;
	return v;
}

function getMatvikZoneValue800(v)
{
	if (v > 800) v = 800;
	return getMatvikZoneValue(v);
}

function getMatvikZoneValue1000(v)
{
	if (v > 1000) v = 1000;
	return getMatvikZoneValue(v);
}

function getDresserInfoPaneHtml(state)
{
	var html = '';
	html += '<div style="width: 100%">';
	html += getDresserInfoPaneTabsHtml(0);
	html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';

	var chapterHtml = '';
	for (var sloti = 0; sloti < slots.length; sloti++)
	{
		var slot = slots[sloti];
		var o = getObjectByStateSlot(state, slot);
		if (o != null && 'required' in o)
		{
			var needHtml = '';
			var canFit = false;
			if ('sex' in o.required)
			{
			    var statesex = state.sex ? 'female' : 'male';
			    if (o.required.sex != statesex)
			    {
					needHtml += localizer.badGender;
			    }
			}
			for (var mfname in o.required)
			{
				var rv = state.results[mfname];
				var bmf = 0;
				if (mfname in state.battlemf)
				{
					bmf = state.battlemf[mfname];
				}
				rv -= bmf;
				if (rv < o.required[mfname])
				{
					if (needHtml != '')
					{
						needHtml += '<br />';
					}
					needHtml += format(localizer.reqInfo, getItemPropLabel(mfname), o.required[mfname], (o.required[mfname] - state.modify[mfname] + bmf));
					canFit = true;
				}
			}
			if (needHtml != '')
			{
				chapterHtml += '<tr><td colspan="2" class="hintview">';
				chapterHtml += '<table class="reqinfo" width="100%" border="0"><tr><td>' + o.caption.bold() + '</td>';
				chapterHtml += '<td>' + needHtml + '</td></tr></table>';
				if (canFit)
				{
				    chapterHtml += format(localizer.adjustHint, getMenuItemHtml(localizer.here, format("onFitStats('{0}')", state.id)));
				}
				chapterHtml +=  '</td></tr>';
			}
		}
	}
	for (var tricki = 0; tricki < state.trickSlots.length; tricki++)
	{
		var trickn = state.trickSlots[tricki];
		var o = null;
		if (trickn != null)
		{
			o = tricks[getJSName(trickn)];
		}
		if (o != null && 'required' in o)
		{
			var needHtml = '';
			var canFit = false;
			if ('sex' in o.required)
			{
			    var statesex = state.sex ? 'female' : 'male';
			    if (o.required.sex != statesex)
			    {
					needHtml += localizer.badGender;
			    }
			}
			for (var mfname in o.required)
			{
				var rv = state.results[mfname];
				if (mfname in state.battlemf)
				{
					rv -= state.battlemf[mfname];
				}
				if (rv < o.required[mfname])
				{
					if (needHtml != '')
					{
						needHtml += '<br />';
					}
					needHtml += format(localizer.reqInfo, getItemPropLabel(mfname), o.required[mfname], (o.required[mfname] - state.modify[mfname]));
					canFit = true;
				}
			}
			if (needHtml != '')
			{
				chapterHtml += '<tr><td colspan="2" class="hintview">';
				chapterHtml += '<table class="reqinfo" width="100%" border="0"><tr><td>' + o.caption.bold() + '</td>';
				chapterHtml += '<td>' + needHtml + '</td></tr></table>';
				if (canFit)
				{
				    chapterHtml += format(localizer.adjustHint, getMenuItemHtml(localizer.here, format("onFitStats('{0}')", state.id)));
				}
				chapterHtml +=  '</td></tr>';
			}
		}
	}
	if (chapterHtml != '')
	{
		html += chapterHtml; // + '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
	}

	html += '</table></td></tr>';
	html += '<tr><td valign="top">';
	html += '<table border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
	html += '<tr><td colspan="2"><hr size="1" noshade="noshade" /></td></tr>';

	chapterHtml = '';
	var waddo = getObjectByStateSlot(state, slot_wadd);
	if (waddo != null)
	{
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += localizer.waddInfo;      //Продукты - Подарок
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += format(
					   '<u onmouseout="hidePopup()" onmouseover="showItemProps2({1}, {2})">{0}</u></td></tr>',
					   waddo.caption,
					   format("'{0}'", state.id),
					   format("'{0}'", waddo.id)
					   );
	}
	for (i = 0; i < state.appliedSets.length; i++)
	{
		var set = state.appliedSets[i];
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += localizer.set;
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += format(
					   '<u onmouseout="hidePopup()" onmouseover="showSetProps({1}, {2})">{0}</u></td></tr>',
					   set.caption,
					   format("'{0}'", state.id),
					   format("'{0}'", set.id)
					   );
	}
	for (i = 0; i < state.appliedStrengthenings.length; i++)
	{
		var strengthening = state.appliedStrengthenings[i];
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += localizer.strengthening;
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += format(
					   '<u onmouseout="hidePopup()" onmouseover="showStrengtheningProps({1}, {2})">{0}</u></td></tr>',
					   strengthening.caption,
					   format("'{0}'", state.id),
					   format("'{0}'", strengthening.id)
					   );
	}
	if (state.statElix != null)
	{
		var elix = knownElix[state.statElix.elixn];
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += localizer.statWeakness;
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += format(
					   '{0} <i>{1} +{2}</i> </td></tr>',
					   elix.caption,
					   getItemPropLabel(elix.makeUp),
					   state.statElix.v
					   );
		if ('makeUp2' in elix)
		{
			chapterHtml += '<tr><td valign="top">';
			chapterHtml += localizer.statWeakness;
			chapterHtml += ': </td><td valign="top">';
			chapterHtml += format(
						   '{0} <i>{1} +{2}</i> </td></tr>',
						   elix.caption,
						   getItemPropLabel(elix.makeUp2),
						   elix.values2[0]
						   );
		}
	}
	for (var damageelixn in state.damageElixes)
	{
		var damageelix = knownDamageElix[damageelixn];
		var caption = damageelix.caption;
		if ('buylink' in damageelix)
		{
			caption += '&nbsp;<a title="Купить" target="_blank" class="TLink" href="' + damageelix.buylink + '">&gt;&gt;</a>';
		}
		chapterHtml += format(
					   '<tr><td valign="top">{1}: </td><td valign="top">{0}</td></tr>',
					   caption,
					   localizer.statWeakness
					   );
	}
	for (var defelixn in state.defElixes)
	{
		var defelix = knownDefElix[defelixn];
		chapterHtml += format(
					   '<tr><td valign="top">{3}: </td><td valign="top">{0}: {2} на <i>{1} ед.</i></td></tr>',
					   defelix.caption,
					   state.defElixes[defelixn],
					   getItemPropLabel(defelix.makeUp),
					   localizer.statWeakness
					   );
		if ('makeUp2' in defelix)
		{
			chapterHtml += format(
						'<tr><td valign="top">{3}: </td><td valign="top">{0}: {2} на <i>{1} ед.</i></td></tr>',
						defelix.caption,
						getDefElixSecondValue(defelix, state.defElixes[defelixn]),
						getItemPropLabel(defelix.makeUp2),
						localizer.statWeakness
						);
		}
	}
	if (state.pet != null)
	{
		var pet = pets[state.pet.n];
		var pl = pet.levels['L' + state.pet.level];
		if ('skill' in pl)
		{
			chapterHtml += '<tr><td valign="top">';
			chapterHtml += localizer.appliedPetSkill;
			chapterHtml += ': </td><td valign="top">';
			chapterHtml += format(
						'<u onmouseover="showPetSkillProps()" onmouseout="hidePopup()">{0} [{1}]</u>',
						pl.skill.caption,
						pl.level
						);
			chapterHtml += '</td></tr>';
		}
	}
	if (state.spellIntel != 0)
	{
		var spell = knownApplicableSpells.spellIntel;
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += localizer.appliedSpell;
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += format(
					   '{0} <i>{1} + {2}</i> </td></tr>',
					   spell.caption,
					   getItemPropLabel(spell.makeUp),
					   state.spellIntel
					   );
	}
	if (state.spellBD != 0)
	{
		var spell = knownApplicableSpells.spellBD;
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += localizer.appliedSpell;
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += format(
					   '{0} <i>{1} + {2}</i> </td></tr>',
					   spell.caption,
					   getItemPropLabel(spell.makeUp),
					   state.spellBD
					   );
	}
	if (state.spellHitpoints != 0)
	{
		var sv = state.spellHitpoints.toString();
		var shp = (state.spellHitpoints * state.natural.endurance).toString();
		if (state.spellHitpoints > 0)
		{
			sv = '+' + sv;
			shp = '+' + shp;
		}
		var spell =  (state.spellHitpoints > 0) ? knownApplicableSpells.spellHitpointsUp : knownApplicableSpells.spellHitpointsDown;
		chapterHtml += '<tr><td valign="top">';
		chapterHtml += localizer.appliedSpell;
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += format(
					   '{0}{2} <i>{1} {3}</i></td></tr>',
					   spell.caption,
					   getItemPropLabel(spell.makeUp),
					   sv,
					   shp
					   );
	}
	for (var powerupn in state.spellPowerUps)
	{
		var spell = getObjectById(powerupn);
		var caption = spell.caption;
		if ('buylink' in spell)
		{
			caption += '&nbsp;<a title="Купить" target="_blank" class="TLink" href="' + spell.buylink + '">&gt;&gt;</a>';
		}
        if (spell.id in knownPowerUps)
        {
        var	link = '<font size="1"><a onclick="onPowerUp(' + "'" + spell.id + "'" + ')" href="javascript:;">(remove)</a></font>';
       	}
       	else
       	{
       	var	link = '<font size="1"><a onclick="onECRPowerUp(' + "'" + spell.id + "'" + ')" href="javascript:;">(remove)</a></font>';
       	}

		chapterHtml += '<tr><td valign="top">';
		chapterHtml += localizer.appliedSpell;
		chapterHtml += ': </td><td valign="top">';
		chapterHtml += format(
					   '{0} на <i>{1} ед.</i>'+link+'</td></tr>',
					   caption,
					   state.spellPowerUps[powerupn]
					   );
	}
	if (chapterHtml != '')
	{
		html += chapterHtml + '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
	}

	chapterHtml = '';
	for (i = 0; i < knownCleanModifiers.length; i++)
	{
		var mfname = knownCleanModifiers[i];
		if (mfname == '-')
		{
			if (chapterHtml != '')
			{
				html += chapterHtml + '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
				chapterHtml = '';
			}
			continue;
		}
		if (!item_props[mfname].view)
		{
			continue;
		}
		var isEditField = false;
		for (j = 0; j < knownNaturalEditors.length; j++)
		{
			if (knownNaturalEditors[j] != '-' && knownNaturalEditors[j] == mfname)
			{
				isEditField = true;
				break;
			}
		}
		if (isEditField)
		{
			continue;
		}
		if (mfname in state.results)
		{
			var vt = state.results[mfname];
			var vr = (mfname in state.required) ? state.required[mfname] : 0;
			var vn = (mfname in state.natural) ? state.natural[mfname] : 0;
			var vm = (mfname in state.modify) ? state.modify[mfname] : 0;
			var mvt = vt;
			for (var staten in dressStates)
			{
				var astate = dressStates[staten];
				var avn = (mfname in astate.natural) ? astate.natural[mfname] : 0;
				var avm = (mfname in astate.modify) ? astate.modify[mfname] : 0;
				var avt = avn + avm;
				if (mvt < avt)
				{
					mvt = avt;
				}
			}
			if (mvt === 0 && vn === 0 && vm === 0 && vr === 0)
			{
				continue;
			}
			chapterHtml += '<tr><td valign="top">';
			chapterHtml += getItemPropLabel(mfname);
			chapterHtml += ': </td><td valign="top">';
			chapterHtml += getItemPropTNMRBHtml(mfname, vt, vn, vm, mvt, vr, true, 0);
			chapterHtml += '</td></tr>';
		}
	}
	if (chapterHtml != '')
	{
		html += chapterHtml + '<tr><td colspan="2"><hr class="dashed" /></td></tr>';
	}

	html += '</table></td>';
	html += '<td valign="top">';
	html += '<table border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';

	var wo3 = getObjectByStateSlot(state, slot_w3);
	var wo10 = getObjectByStateSlot(state, slot_w10);
	html += getDresserInfoPaneWeaponHtml(state, slot_w3);
	if ((wo10 != null) && (wo10.slot == 'w3'))
	{
		if (!areSameObjectsWeared(state, slot_w3, slot_w10))
		{
			html += getDresserInfoPaneWeaponHtml(state, slot_w10);
		}
		else
		{
			html += '<tr><td colspan="2"><hr size="1" noshade="noshade" /></td></tr>';
			html += '<tr><td colspan="2" valign="top">';
			html += localizer.sameWeapon;
			html += '</td></tr>';
		}
	}
	for (var spellid in state.combatSpells)
	{
		html += getDresserInfoPaneCombatSpellHtml(state, spellid);
	}
	for (var ctrickn in state.combatTricks)
	{
		html += getDresserInfoPaneCombatTrickHtml(state.combatTricks[ctrickn]);
	}

	html += '</table></td></tr>';
	html += '<tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';

	html += '<tr><td colspan="2">';
	html += '<table class="tabZ" width="100%" border="1" cellspacing="0" cellpadding="2">';
	html += format(
		'<tr><td><b>{0}</b></td><td align="center"><b>{1}</b></td><td align="center"><b>{2}</b></td><td align="center"><b>{3}</b></td><td align="center"><b>{4}</b></td><td align="center"><b>{5}</b></td></tr>',
		localizer.zoneVariable,
		localizer.zonehead,
		localizer.zonebody,
		localizer.zonewaist,
		localizer.zoneleg,
		localizer.zoneavg
		);
	html += '<tr><td>' + localizer.armor + '</td>';
	for (var armorn in knownArmorModifiers)
	{
		var vobj = { minv: state.results[armorn + '1'], maxv: state.results[armorn + '2'] };
		var mvt = (vobj.minv + vobj.maxv);
		for (var staten in dressStates)
		{
			var astate = dressStates[staten];
			var av1 = ((armorn + '1') in astate.results) ? astate.results[armorn + '1'] : 0;
			var av2 = ((armorn + '2') in astate.results) ? astate.results[armorn + '2'] : av1;
			if (mvt < (av1 + av2))
			{
				mvt = av1 + av2;
			}
		}
		html += '<td align="center">' + getItemPropAdvWeaponHtml(armorn, vobj, mvt, true) + '</td>';
	}
	html += '</tr>';

	for (var mfname in knownZoneModifiers)
	{
		if (!(mfname in state.results))
		{
			continue;
		}
		var vt = state.results[mfname];
		var mvt = { head: 0, body: 0, waist: 0, leg: 0, avg: 0 };
		for (var staten in dressStates)
		{
			var astate = dressStates[staten];
			var avt = { head: 0, body: 0, waist: 0, leg: 0, avg: 0 };
			if (mfname in astate.results)
			{
				avt = astate.results[mfname];
			}
			if (mvt.head < avt.head)
			{
				mvt.head = avt.head;
			}
			if (mvt.body < avt.body)
			{
				mvt.body = avt.body;
			}
			if (mvt.waist < avt.waist)
			{
				mvt.waist = avt.waist;
			}
			if (mvt.leg < avt.leg)
			{
				mvt.leg = avt.leg;
			}
			if (mvt.avg < avt.avg)
			{
				mvt.avg = avt.avg;
			}
		}
		if (mvt.head !== 0 || mvt.body !== 0 || mvt.waist !== 0 || mvt.leg !== 0)
		{
			var pc = {head: getMatvikZoneValue1000(vt.head), body: getMatvikZoneValue1000(vt.body), waist: getMatvikZoneValue1000(vt.waist), leg: getMatvikZoneValue1000(vt.leg), avg: getMatvikZoneValue1000(vt.avg)};
			for (var pcn in pc)
			{
				pc[pcn] = Math.floor(pc[pcn] * 100 + 0.5) / 100;
			}
			html += format(
				'<tr><td>{0}</td><td align="center">{1} ({5}%)</td><td align="center">{2} ({6}%)</td><td align="center">{3} ({7}%)</td><td align="center">{4} ({8}%)</td><td align="center">{9} ({10}%)</td></tr>',
				getItemPropLabel(mfname),
				getItemPropFormattedValue(mfname, vt.head, mvt.head),
				getItemPropFormattedValue(mfname, vt.body, mvt.body),
				getItemPropFormattedValue(mfname, vt.waist, mvt.waist),
				getItemPropFormattedValue(mfname, vt.leg, mvt.leg),
				pc.head, pc.body, pc.waist, pc.leg,
				getItemPropFormattedValue(mfname, vt.avg, mvt.avg),
				pc.avg
				);
		}
	}
	html += '</table>';
	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr></table>';
	html += '</div>';
	return html;
}

function onToggleShowImagesOption()
{
	dressOptions.showImages = !dressOptions.showImages;
	saveOptions();
	catlistsources = {};
}

function applyAlphaForMenuAndTipOption()
{
	var newMenuOpacity = dressOptions.useAlphaForMenuAndTip ? defaultMenuOpacity : 100;
	var newTipOpacity = dressOptions.useAlphaForMenuAndTip ? defaultTipOpacity : 100;
	var menu = document.getElementById(menuDivId);
	var popup = document.getElementById(popupDivId);
	if (is.ie)
	{
		menu.filters['alpha'].opacity = newMenuOpacity;
		popup.filters['alpha'].opacity = newTipOpacity;
	}
	else
	{
		menu.style.opacity = (newMenuOpacity / 100);
		menu.style.MozOpacity = (newMenuOpacity / 100);
		menu.style.KhtmlOpacity = (newMenuOpacity / 100);
		popup.style.opacity = (newTipOpacity / 100);
		popup.style.MozOpacity = (newTipOpacity / 100);
		popup.style.KhtmlOpacity = (newTipOpacity / 100);
	}
}

function onToggleUseAlphaForMenuAndTipOption()
{
	dressOptions.useAlphaForMenuAndTip = !dressOptions.useAlphaForMenuAndTip;
	applyAlphaForMenuAndTipOption();
	saveOptions();
}

function onToggleUseTransitionEffectsOption()
{
	dressOptions.useTransitionEffects = !dressOptions.useTransitionEffects;
	saveOptions();
}

function onToggleCaptureMouseOption()
{
	dressOptions.captureMouse = !dressOptions.captureMouse;
	saveOptions();
}

function onTogglePreloadImagesOption()
{
	dressOptions.preloadImages = !dressOptions.preloadImages;
	if (dressOptions.preloadImages)
	{
		preloadImagesWanted();
	}
	saveOptions();
}
function onToggleColorizedDummyOption()
{
	dressOptions.colorizedDummy = !dressOptions.colorizedDummy;
	if (activeState != null)
	{
		hardUpdateDresserState(activeState);
	}
	saveOptions();
}

function onOptionsMenu()
{
	var menuHtml  ='<table width="300px" border="0">';
	if (dressOptions.showImages)
	{
		menuHtml += getRowMenuItemHtml(localizer.optionsHideImages, "onToggleShowImagesOption()");
	}
	else
	{
		menuHtml += getRowMenuItemHtml(localizer.optionsShowImages, "onToggleShowImagesOption()");
	}
	if (dressOptions.useAlphaForMenuAndTip)
	{
		menuHtml += getRowMenuItemHtml(localizer.optionsDontUseAlphaForMenuAndTip, "onToggleUseAlphaForMenuAndTipOption()");
	}
	else
	{
		menuHtml += getRowMenuItemHtml(localizer.optionsUseAlphaForMenuAndTip, "onToggleUseAlphaForMenuAndTipOption()");
	}
	if (is.ie)
	{
		if (dressOptions.useTransitionEffects)
		{
			menuHtml += getRowMenuItemHtml(localizer.optionsDontUseTransitionEffects, "onToggleUseTransitionEffectsOption()");
		}
		else
		{
			menuHtml += getRowMenuItemHtml(localizer.optionsUseTransitionEffects, "onToggleUseTransitionEffectsOption()");
		}
		if (dressOptions.captureMouse)
		{
			menuHtml += getRowMenuItemHtml(localizer.optionsDontCaptureMouse, "onToggleCaptureMouseOption()");
		}
		else
		{
			menuHtml += getRowMenuItemHtml(localizer.optionsCaptureMouse, "onToggleCaptureMouseOption()");
		}
	}
	if (dressOptions.preloadImages)
	{
		menuHtml += getRowMenuItemHtml(localizer.optionsDontPreloadImages, "onTogglePreloadImagesOption()");
	}
	else
	{
		menuHtml += getRowMenuItemHtml(localizer.optionsPreloadImages, "onTogglePreloadImagesOption()");
	}
	if (dressOptions.colorizedDummy)
	{
		menuHtml += getRowMenuItemHtml(localizer.optionsColorizedDummyOff, "onToggleColorizedDummyOption()");
	}
	else
	{
		menuHtml += getRowMenuItemHtml(localizer.optionsColorizedDummyOn, "onToggleColorizedDummyOption()");
	}
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table>';
	showMenu(menuHtml);
}

function onApplyConcreteElix(elixn, v)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	if (elixn == 'spellIntel')
	{
		state.spellIntel = v;
	}
	else if (elixn == 'spellHitpointsUp' || elixn == 'spellHitpointsDown')
	{
		state.spellHitpoints = v;
	}
	else if (elixn == 'spellBD')
	{

		state.spellBD = v;
	}
	else if (elixn in knownDamageElix)
	{
		if (v > 0)
		{
			state.damageElixes[elixn] = v;
		}
		else if (elixn in state.damageElixes)
		{
			delete state.damageElixes[elixn];
		}
	}
	else if (elixn in knownDefElix)
	{
		for (var delixn in state.defElixes)
		{
			if (areArraysIntersect(knownDefElix[delixn].places, knownDefElix[elixn].places))
			{
				delete state.defElixes[delixn];
			}
		}
		if (v > 0)
		{
			state.defElixes[elixn] = v;
		}
	}
	else
	{
		if (elixn == null || v <= 0 || knownElix[elixn] == null)
		{
			state.statElix = null;
		}
		else
		{
			var elix = knownElix[elixn] || knownApplicableSpells[elixn];
			state.statElix = { elixn: elixn, v: v };
		}
	}
	hardUpdateDresserState(state);
}

function onConcreteElixMenu(elixn)
{
	var state = activeState;
	var elix = knownElix[elixn] || knownApplicableSpells[elixn] || knownDefElix[elixn];
	if (state == null || elix == null)
	{
		return;
	}
	var menuHtml  ='<table width="240px" border="0"><tr><td>';
	if (elix.id.indexOf('{0}') < 0)
	{
		menuHtml += format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;', itemImgPath, elix.id, elix.caption);
		menuHtml += elix.caption.bold();
	}
	else
	{
		menuHtml += format(elix.caption, '').bold();
	}
	menuHtml += '</td></tr>';
	var captionHead = (('isSpell' in elix) && elix.isSpell) ? localizer.appliedSpell : localizer.statWeakness;
	for (var i = 0; i < elix.values.length; i++)
	{
	     var caption = (('isSpell' in elix) && elix.isSpell) ? localizer.dropSpell : localizer.dropElix;
 		 var v = elix.values[i];
		 var sv = (v > 0) ? ('+' + v.toString()) : v.toString();
		 if ((elix.check == 1) && (state.natural.level == v))
		 { sv=sv.bold();}


		if (v != 0)
		{
			if (elix.id.indexOf('{0}') < 0)
			{
			 caption = captionHead
			 + ' '
			 + getItemPropLabel(elix.makeUp)
			 + sv;
     		}
			else
			{
			   if (elix.check == 1)
			   {
			   	caption =
					format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;', trickImgPath, elix.pic, elix.caption)
					+ '&nbsp;'
					+ captionHead
					+ ' '
					+ elix.caption
					+ sv;
			   }
			   else
		       {
				caption =
					format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;', itemImgPath, format(elix.id, Math.abs(v)), (elix.caption + sv))
					+ '&nbsp;'
					+ captionHead
					+ ' '
					+ elix.caption
					+ sv
					;
				}
			}
		}


 		menuHtml += getRowMenuItemHtml(caption, format("onApplyConcreteElix('{0}', {1})", elixn, v));
	}
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table>';
	showMenu(menuHtml);
	if (!is.ie && e.stopPropagation)
	{
		e.stopPropagation();
	}
	if (is.ie)
	{
		window.event.cancelBubble = true;
		window.event.returnValue = false;
	}
}

function onSwitchConcreteElix(elixn)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var putOn = (elixn in state.damageElixes) ? 0 : 1;
	onApplyConcreteElix(elixn, putOn);
}

function onElixMenu()
{
	cursorX -= 240;

	if ('onElixMenu' in menuhash)
	{
		showMenu(menuhash.onElixMenu);
		return;
	}
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var menuHtml  = '<table width="640" border="0"><tr><td>';
	menuHtml += '<table width="240" border="0">';
	menuHtml += getRowMenuItemHtml(localizer.noElix, "onApplyConcreteElix(null, 0)");
	menuHtml += getRowMenuSeparatorHtml();
	for (var elixn in knownElix)
	{
		var elix = knownElix[elixn];
		if (elix == null)
		{
			menuHtml += getRowMenuSeparatorHtml();
			continue;
		}
		var caption = elix.caption;
		caption = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;', itemImgPath, elix.id, elix.caption) + caption;
		menuHtml += getRowMenuItemHtml(caption, format("onConcreteElixMenu('{0}')", elixn));
	}
	menuHtml += '</table></td><td><table width="240" border="0">';
	for (var elixn in knownDamageElix)
	{
		var elix = knownDamageElix[elixn];
		if (elix == null)
		{
			menuHtml += getRowMenuSeparatorHtml();
			continue;
		}
		var caption = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;', itemImgPath, elix.id, elix.caption) + elix.caption;
		var action = format("onSwitchConcreteElix('{0}')", elixn);
		menuHtml += getRowMenuItemHtml(caption, action);
	}
	menuHtml += getRowMenuSeparatorHtml();
	var a=0;
	for (var elixn in knownDefElix)
	{
		a++;
		if (a<9)
			{
			var elix = knownDefElix[elixn];
			if (elix == null)
			{
				menuHtml += getRowMenuSeparatorHtml();
				continue;
			}
			var caption = elix.caption;
			caption = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;', itemImgPath, elix.id, elix.caption) + caption;
			menuHtml += getRowMenuItemHtml(caption, format("onConcreteElixMenu('{0}')", elixn));
			}
	}
	menuHtml += '</table></td><td><table width="240" border="0">';
	var a=0;
	for (var elixn in knownDefElix)
	{
		a++;
		if (a>=9)
			{
			var elix = knownDefElix[elixn];
			if (elix == null)
			{
				menuHtml += getRowMenuSeparatorHtml();
				continue;
			}
			var caption = elix.caption;
			caption = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;', itemImgPath, elix.id, elix.caption) + caption;
			menuHtml += getRowMenuItemHtml(caption, format("onConcreteElixMenu('{0}')", elixn));
			}
	}
	menuHtml += '</table></td></tr><tr><td colspan="3"><table width="640" border="0">';
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table></td></tr></table>';
	menuhash.onElixMenu = menuHtml;
	showMenu(menuHtml);
}

function onApplyWAdd(waddn)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	state.objects[slot_wadd.index] = null;
	state.fitSlots[slot_wadd.index] = null;
	state.upgradeSlots[slot_wadd.index] = null;
	state.charmSlots[slot_wadd.index] = null;
	state.addSlots[slot_wadd.index] = null;
	state.runeSlots[slot_wadd.index] = null;
	state.objCache[slot_wadd.index] = null;
	state.objects[slot_wadd.index] = waddn;
	updateDresserState();
}

function onWAddMenu()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var menuHtml = '';
	menuHtml += '<table width="240" border="0">';
	if (state.objects[slot_wadd.index] != null)
	{
		menuHtml += getRowMenuItemHtml(localizer.noWAdd, 'onApplyWAdd(null)');
		menuHtml += getRowMenuSeparatorHtml();
	}
	for (var waddn in knownAdds)
	{
		if (state.objects[slot_wadd.index] == waddn)
		{
			continue;
		}
		var wadd = knownAdds[waddn];
		var caption = wadd.caption;
		caption = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;', itemImgPath, wadd.id, wadd.caption) + caption;
		menuHtml += getRowMenuItemHtml(caption, format("onApplyWAdd('{0}')", waddn));
	}
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table>';
	showMenu(menuHtml);
}

function onPowerUp(spellid)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var maxv = 33;
	var del = false;
	var spell = knownPowerUps[spellid];
	if (spell != null && !spell.damageup)
	{
		maxv = 125;
	}
	var v = maxv;
	if (spellid in state.spellPowerUps)
	{
      v = state.spellPowerUps[spellid];
	}
	v = spell['value'];
	v = parseInt(v);
    if (spellid in state.spellPowerUps)
	{
		v = 0 ;
	}
	if (isNaN(v))
	{
		return;
	}
	if (v < 0)
	{
		v = 0;
	}
	if (v > maxv)
	{
		v = maxv;
	}
	if (v > 0)
	{
		state.spellPowerUps[spellid] = v;

	}
	else
	{
		delete state.spellPowerUps[spellid];
	}
	updateDresserStateWanted();
}

function onECRPowerUp(spellid)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var v = 100;
	if (spellid in state.spellPowerUps)
	{
	    delete state.spellPowerUps[spellid];
	}
	else
	{
	    state.spellPowerUps[spellid] = knownECRPowerUps[spellid].v;
	}
	updateDresserStateWanted();
}

function onSpellMenu()
{
	cursorX -= 100;
	if ('onSpellMenu' in menuhash)
	{
		showMenu(menuhash.onSpellMenu);
		return;
	}
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var menuHtml = '<table width="480px" border="0">';
	menuHtml += '<tr><td valign="top"><table width="240px" border="0">';
	for (var spelln in knownApplicableSpells)
	{
		var spell = knownApplicableSpells[spelln];
		if (spell == null)
		{
			menuHtml += getRowMenuSeparatorHtml();
			continue;
		}
		var spellHtml = spell.caption;
		if (spell.check == 1)
		{
			spellHtml = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;{2}', trickImgPath, spell.id, spell.caption);
		}else if (spell.id.indexOf('(0}') < 0)
		{
			spellHtml = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;{2}', itemImgPath, format(spell.id, 5), spell.caption);
		}
		menuHtml += getRowMenuItemHtml(spellHtml, format("onConcreteElixMenu('{0}')", spelln));
	}
	menuHtml += getRowMenuSeparatorHtml();
	for (var powerupn in knownPowerUps)
	{
		var o = getObjectById(powerupn);
		var caption = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp;{3}', itemImgPath, o.id, o.caption, htmlstring(o.caption));
		menuHtml += getRowMenuItemHtml(caption, format("onPowerUp('{0}')", powerupn));
	}
	menuHtml += '</table></td><td valign="top"><table width="240px" border="0">';
	for (var powerupn in knownECRPowerUps)
	{
		var o = getObjectById(powerupn);
		var caption = format('<img src="{0}{1}.gif" width="15" height="15" alt="{2}" border="0" />&nbsp; Наложить {3}', itemImgPath, o.id, o.caption, htmlstring(o.caption));
		menuHtml += getRowMenuItemHtml(caption, format("onECRPowerUp('{0}')", powerupn));
	}
	menuHtml += '</table></td></tr><tr><td colspan="2" valign="top"><table width="480px" border="0">';
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table></td></tr></table>';
	menuhash.onSpellMenu = menuHtml;
	showMenu(menuHtml);
}

function summonPet(petn, level)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	if (petn == null)
	{
		state.pet = null;
		hardUpdateDresserState(state);
		return;
	}
	var pet = pets[petn];
	if (level <= state.natural.level)
		{
		state.pet = { n: petn, name: pet.caption, level: level };
		}
		else
			{
			state.pet = { n: petn, name: pet.caption, level: state.natural.level };
			}
	hardUpdateDresserState(state);

}

function onConcretePetMenu(petn)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var pet = pets[petn];
	var menuHtml  ='<table width="240px" border="0">';

	menuHtml += format('<img src="{2}{1}.gif" width="40" height="25" border="0" alt="{0}" />{0}', pet.caption, pet.summon.name, itemImgPath);

	if (state.pet != null)
	{
		menuHtml += getRowMenuItemHtml(localizer.dropPet, 'summonPet()');
		menuHtml += getRowMenuSeparatorHtml();
	}
	// see here
	for (var leveln in pet.levels)
	{
		var level = pet.levels[leveln];
		if (level.level <= state.natural.level)
			{
			var text = format('[{0}] Уровень', level.level);
			menuHtml += getRowMenuItemHtml(text, format("summonPet('{0}', {1})", petn, level.level));
			}
	}

	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table>';
	showMenu(menuHtml);
}

function onPetMenu()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var menuHtml  ='<table width="240px" border="0">';
	if (state.pet != null)
	{
		menuHtml += getRowMenuItemHtml(localizer.dropPet, 'summonPet()');
		menuHtml += getRowMenuSeparatorHtml();
	}
	for (var petn in pets)
	{
		var pet = pets[petn];
		var petHtml = format('<img src="{2}{1}.gif" width="40" height="25" border="0" alt="{0}" />{0}', pet.caption, pet.summon.name, itemImgPath);
		menuHtml += getRowMenuItemHtml(petHtml, format("onConcretePetMenu('{0}')", petn));
	}
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table>';
	showMenu(menuHtml);
}

function loadFriendLinks()
{
	var qs = window.location.search;
	if (qs == null || qs.length < 4)
	{
		return;
	}
	var params = qs.match("[^\?=&]*=[^\?=&]*");
	for (var i = 0; i < params.length; i++)
	{
		var paramName = params[i];
		var paramValue = '';
		if (paramName.indexOf('=') >= 0)
		{
			var sp = paramName.split('=');
			paramName = sp[0];
			paramValue = unescape(sp[1]);
		}
		if (paramName == 'data')
		{
			var newState = deserializeObject(paramValue);
			if (newState != null)
			{
				applyDeserializedState(null, newState);
			}
		}
		if (paramName == 'raw')
		{
			var newState = createNewDresserState();
			updateTabs(false);
			recalcDresserState(newState);
			updateCabs();
			changeCab(newState.id);
			someStatesLoaded = true;
			handleCharInfo(newState, paramValue);
		}
	}
}

function onFriendLink(stateid)
{
	var state = dressStates[stateid];
	if (state == null)
	{
		return;
	}
	var menuHtml  ='<table border="0"><tr><td>';
	var url = absoluteDressRoomUrl
	url += '?data=';
	url += escape(serializeObject(getSerializableState(state)));
	menuHtml += format(localizer.friendLinkHint, clanImgPath);
	menuHtml += '<br /><textarea id="friendLink" class="inpText" cols="50" rows="8" wrap="VIRTUAL" readonly="true">';
	menuHtml += url;
	menuHtml += '</textarea></td></tr>';
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table>';
	showMenu(menuHtml, false);
	var telt = document.getElementById('friendLink');
	if (telt != null)
	{
		telt.focus();
		telt.select();
	}
}

function updateEnduranceLimit(level)
{
	var end = 3;
	for (var i = 0; i <= level; i++)
	{
		var leveln = 'L' + i;
		if (!(leveln in expd))
		{
			break;
		}
		var ld = expd[leveln];
		if (!('U0' in ld.ups))
		{
			break;
		}
		end += ld.ups.U0.aendurance;
	}
	knownStatLimits.endurance = end;
}

function onFitStats(stateid)
{
	var state = dressStates[stateid];
	if (state == null)
	{
		return;
	}
	updateEnduranceLimit(state.natural.level);
	for (var name in state.required)
	{
		var newnv = state.required[name];
		if (name in state.modify)
		{
			newnv -= state.modify[name];
		}
		if (name in state.battlemf)
		{
			newnv += state.battlemf[name];
		}
		if (newnv < 0)
		{
			newnv = 0;
		}
		if (name in knownStatLimits)
		{
			if (newnv < knownStatLimits[name])
			{
				newnv = knownStatLimits[name];
			}
		}
		if (name.indexOf('skill') > 0)
		{
			if (name.indexOf('magicskill') > 0)
			{
				if (newnv > 10)
				{
					newnv = 10;
				}
			}
			else
			{
				if (newnv > 5)
				{
					newnv = 5;
				}
			}
		}
		if (!(name in state.natural) || (state.natural[name] < newnv))
		{
			state.natural[name] = newnv;
		}
	}
	updateDresserState(state);
}

function handleCharInfo(state, text)
{
	var stateid = state.id;
	var objects = [];
	var doneState = {};
	// Combats VIP bug wrapping
	text = replacestr(text, shortVip, shortVip + "\n");

	var pet_type = '';
	var pet_level = 0;
	var pet_name = '';
	var align = '0';
	var clan = '';
	var sex = 0;
	var img = 0;
	var zodiac = '';
	var propDefs = text.split("\n");
	var rstats = {};
	for (var propi  = 0; propi < propDefs.length; propi++)
	{
		var propDef = propDefs[propi];
		var propName = propDef;
		var propVal = '';
		var eqi = propDef.indexOf('=');
		if (eqi > 0)
		{
			propName = propDef.substr(0, eqi);
			propVal = propDef.substr(eqi + 1);
		}
		if (propName in shortInfoMap)
		{
			doneState[shortInfoMap[propName]] = parseInt(propVal);
			continue;
		}
		if (propName in shortInfoMap2)
		{
			rstats[shortInfoMap2[propName]] = parseInt(propVal);
			continue;
		}
		if (propName == 'login')
		{
			nick = propVal;
			continue;
		}
		if (propName == 'align')
		{
			align = propVal;
			continue;
		}
		if (propName == 'klan')
		{
			clan = propVal;
			continue;
		}
		if (propName == 'sex')
		{
			sex = parseInt(propVal);
			continue;
		}
		if (propName == 'img')
		{
			img = propVal;
			continue;
		}
		if (propName == 'zodiac')
		{
			zodiac = propVal;
			continue;
		}
		if (propName == 'objects')
		{
			objects = propVal.split(',');
			continue;
		}
		if (propName == 'pet_type')
		{
			pet_type = propVal;
			continue;
		}
		if (propName == 'pet_level')
		{
			pet_level = propVal;
			continue;
		}
		if (propName == 'pet_name')
		{
			pet_name = propVal;
			continue;
		}
		if (propName == 'found')
		{
			if (parseInt(propVal) === 0)
			{
				alert('Персонаж с такими ником не найден');
				return;
			}
		}
	}
	var state = createNewDresserState(state.id);
	state.name = nick;
	state.align = align;
	state.clan = clan;
	state.sign = zodiac;
	state.sex = sex;
	state.image = img;
	if ((pet_type != '') && (pet_type in pets))
	{
		var pet = pets[pet_type];
		if (('L' + pet_level) in pet.levels)
		{
			state.pet = { n: pet_type, name: pet_name, level: pet_level };
		}

	}
	if ('level' in doneState)
	{
		state.natural.level = doneState.level;
	}
	for (var oi = 0; oi < objects.length; oi++)
	{
		var oname = objects[oi];
		var oval = '';
		var eqi = oname.indexOf('=');
		if (eqi >= 0)
		{
			oval = oname.substr(eqi + 1);
			oname = oname.substr(0, eqi);
		}
		if (oname == '')
		{
			continue;
		}
		oval = oval.split('\\n');
		applyAssortedObject(state, oname, oval);
	}
	recalcDresserState(state);
	for (var stat in doneState)
	{
		state.natural[stat] = doneState[stat] - state.modify[stat];
		if (stat in state.battlemf)
		{
			state.natural[stat] += state.battlemf[stat];
		}
	}
	for (var stat in rstats)
	{
		state.natural[stat] = rstats[stat];
	}
	activeState = state;
	hardUpdateDresserState(state);
//	changeCab(state.id);
}

function onDressFromCombatsNick(stateid)
{
	var state = dressStates[stateid];
	if (state == null)
	{
		return;
	}
	var nick = document.getElementById('dfcnick').value;
	var text = '';
	if (dressOptions.benderOmskMode)
	{
		window.navigate(format(benderOmsk.getInfoLink, nick));
		return;
	}
	if (dressOptions.hasGetDSCharInfo)
	{
		var dstatestr = window.external.getDSCharInfo(nick);
		if (dstatestr == null)
		{
			return;
		}
		applyDeserializedState(stateid, deserializeObject(dstatestr));
		return;
	}
	if (dressOptions.hasGetCharInfo)
	{
		text = window.external.getCharInfo(nick);
		if (text == null)
		{
			text = 'found=0';
		}
	}
	else
	{
		//nick = urlesc(nick);
		var url = format(getCharacterInfoUrlFormat, nick);
		if (!loadXMLDoc(url))
		{
			return;
		}
		text = req.responseText;
	}
	handleCharInfo(state, text);
}

function onDressFromCombatsMenu(stateid)
{
	var state = dressStates[stateid];
	if (state == null)
	{
		return;
	}
	var menuHtml  ='<table width="260px" border="0"><tr><td><img src="' + clanImgPath + 'DarkClan.gif" width="24" height="15" border="0" align="right" /><b>Загрузка манекена с персонажа БК</b><form name="dfc" method="GET" onreset="hideMenu()" onsubmit="return false"><center>';
	menuHtml += localizer.FCPlayerNick + ': <input id="dfcnick" name="dfcnick" type="text" value="';
	menuHtml += state.name;
	menuHtml += '" class="ABText80" />';
	menuHtml += '<hr class="dashed" />';
	menuHtml += '<input class="inpButton" type="submit" name="Submit" value="' + localizer.FCPlayerLoadIn + '" onclick="onDressFromCombatsNick(' + format("'{0}'", state.id) + '); hideMenu(); return false" /> <input name="cancel" class="inpButton" type="reset" id="cancel" value="' + localizer.cancel + '" onclick="hideMenu()" />';
	menuHtml += '<hr class="dashed" />';
	menuHtml += localizer.informAboutCharLoading;
	menuHtml += '</center></form></td></tr></table>';
	showMenu(menuHtml, false);
	document.getElementById('dfcnick').focus();
}

function onCopyCab(stateid)
{
	var state = dressStates[stateid];
	if (state == null)
	{
		return;
	}
	var serstate = getSerializableState(state);
	applyDeserializedState(null, serstate);
}

function getDresserCommands(state)
{
	var html = '<table cellpadding="0" cellspacing="0" border="0"><tr>';
	//html += '<img src="http://upload.wikimedia.org/wikipedia/commons/e/e5/Crystal_Clear_app_x.png" width="32" height="32">'
	html += getCell2MenuItemHtml(localizer.clearAllStats, format("onClearAllStats('{0}')", state.id));
	html += getCell2MenuSeparatorHtml();
	html += getCell2MenuItemHtml(localizer.fitStats, format("onFitStats('{0}')", state.id));
	html += getCell2MenuSeparatorHtml();
	html += getCell2MenuItemHtml(localizer.elixMenu, 'onElixMenu()');
	if (!dressOptions.newCapEdition)
	{
		html += getCell2MenuSeparatorHtml();
		html += getCell2MenuItemHtml(localizer.spellMenu, 'onSpellMenu()');
		html += getCell2MenuSeparatorHtml();
		html += getCell2MenuItemHtml(localizer.petMenu, 'onPetMenu()');
	}
	
	html += '</tr></table><table cellpadding="0" cellspacing="0" border="0"><tr>';
	html += getCell2MenuItemHtml(localizer.dropAll, 'onDropAll()');
	html += getCell2MenuSeparatorHtml();
	html += getCell2MenuItemHtml(localizer.saveSet, format("onSaveSet('{0}')", state.id));
	html += getCell2MenuSeparatorHtml();
	html += getCell2MenuItemHtml(localizer.loadSet, format("onLoadSet('{0}')", state.id));
	html += getCell2MenuSeparatorHtml();
	
	var s = localizer.dressFromCombats;
	
	html += getCell2MenuItemHtml(localizer.copyCab, format("onCopyCab('{0}')", state.id));
	html += getCell2MenuSeparatorHtml();
	html += getCell2MenuItemHtml(localizer.waddMenu, 'onWAddMenu()');
	html += getCell2MenuSeparatorHtml();
	
	html += '</table>';
	return html;
}

function getDresserNaturalEditorInfo(state, name)
{
	var html = '';
	if (name in state.results)
	{
		var vt = state.results[name];
		var vr = (name in state.required) ? state.required[name] : 0;
		var vn = (name in state.natural) ? state.natural[name] : 0;
		var vm = (name in state.modify) ? state.modify[name] : 0;
		var vb = (name in state.battlemf) ? state.battlemf[name] : 0;
		vt -= vb;
		vm -= vb;
		var mvt = vt;
		for (var staten in dressStates)
		{
			var astate = dressStates[staten];
			var avn = (name in astate.natural) ? astate.natural[name] : 0;
			var avm = (name in astate.modify) ? astate.modify[name] : 0;
			var avt = (name in astate.results) ? astate.results[name] : 0;
			if (name in astate.battlemf)
			{
				avt -= astate.battlemf[name];
				avm -= astate.battlemf[name];
			}
			if (mvt < avt)
			{
				mvt = avt;
			}
		}
		html += getItemPropTNMRBHtml(name, vt, vn, vm, mvt, vr, true, vb);
	}
	return html;
}

function getLevelUpInfo(state)
{
	if (('L' + state.natural.level) in expd)
	{
		var ldata = expd['L' + state.natural.level];
		if (!('ups' in ldata) || !(('U' + state.natural.levelup) in ldata.ups))
		{
			if ('count' in ldata)
			{
				state.natural.levelup = ldata.count - 1;
			}
			else
			{
				state.natural.levelup = 0;
			}
		}
		if (!('ups' in ldata) || !('U0' in ldata.ups))
		{
			return null;
		}
		return ldata.ups['U' + state.natural.levelup];
	}
	return null;
}

function getEditHeaderInfo(state)
{
	var html = '';
	var totalnskills = 0;
	for (skilln in state.natural)
	{
		if (skilln.indexOf('skill') > 0)
		{
			totalnskills += state.natural[skilln];
		}
	}
	if (state.pet != null)
	{
	    if (state.pet.level > state.natural.level)
	    {
			html += '<div class="hintview">';
			html += format(localizer.badPetLevel, state.natural.level, state.pet.level);
			html +=  '</div>';
	    }
	}
	var availskills = state.natural.level + state.natural.pskil + 1;
	if (availskills < totalnskills)
	{
		var pskilstr = '';
		if (state.natural.pskil > 0)
		{
			pskilstr = format(localizer.badSkillRewardedCount);
		}
		html += '<div class="hintview">';
		html += format(localizer.badSkillCount, state.natural.level, pskilstr, availskills, totalnskills);
		html +=  '</div>';
	}
	if (state.natural.pskil > 10)
	{
		html += '<div class="hintview">';
		html += format(localizer.badRewardedSkillCount, state.natural.pskil);
		html +=  '</div>';
	}
	if (state.natural.pstat > 30)
	{
		html += '<div class="hintview">';
		html += format(localizer.badRewardedStatCount, state.natural.pstat);
		html +=  '</div>';
	}
	var upd = getLevelUpInfo(state);
	if (upd && upd.sstats && state.natural.totalstats)
	{
		html += '<div class="hintview">';
		var availstats = upd.sstats + state.natural.pstat;
		var s = availstats.toString();
		if (state.natural.totalstats != availstats)
		{
			s = s.bold();
		}
		var pstatstr = '';
		if (state.natural.pstat > 0)
		{
			pstatstr = format(localizer.rewardedStatsCount, state.natural.pstat);
		}

		html +=  format(localizer.nativeStatsCount, state.natural.level, upd.id, pstatstr, s);
		if (state.natural.totalstats != availstats)
		{
			s = state.natural.totalstats.toString();
			if (state.natural.totalstats > availstats)
			{
				s = s.fontcolor('red');
			}
			html += format(localizer.neqStatsCount, s);
			if (state.natural.totalstats < availstats)
			{
				html += format(localizer.gtStatsCount, (availstats - state.natural.totalstats));
			}
			else
			{
				html += format(localizer.ltStatsCount, (state.natural.totalstats - availstats));
			}
		}
		else
		{
			html += localizer.eqStatsCount;
		}
		html +=  '</div>';
	}
	return html;
}

function getDresserNaturalEditors(state)
{
	var html = '<table class="tcontent" width="100%" cellspacing="0" border="0" style="padding: 2px 4px 0px 0px">';
	html += format('<tr><td id="{1}{0}" colspan="3">{2}</td></tr>', state.id, 'editheader', getEditHeaderInfo(state));
	for (var i = 0; i < knownNaturalEditors.length; i++)
	{
		var name = knownNaturalEditors[i];
		if (name == '-')
		{
			html += '<tr><td colspan="3"><hr class="dashed" /></td></tr>';
			continue;
		}
		if (!item_props[name].view)
		{
			continue;
		}
		html += '<tr><td align="right" valign="top">';
		html += format(
			'<input name="edit{0}" type="text" id="edit{0}" class="ABTextR" value="{1}" size="3" maxlength="3" onblur="onChangeEdit({2})" />',
			state.id + name,
			state.natural[name] ? state.natural[name] : 0,
			format("this, '{0}', '{1}'", state.id, name)
			);

		html += '</td><td align="left" valign="top">';
		html += getItemPropLabel(name);
		html += format('</td><td id="editi{0}{1}" valign="top">', state.id, name);
		html += getDresserNaturalEditorInfo(state, name);
		html += '</td>';
		html += '<td>';
		var fiop = 'edit'+state.id+name;
		html += '<a onclick="adm(\''+fiop+'\')" href="javascript:;"><img src="http://img.combats.com/i/minus.gif" alt="уменшить" border=0> </a></td>';
		html += '<td><a onclick="adp(\''+fiop+'\')" href="javascript:;"><img src="http://img.combats.com/i/plus.gif" alt="увеличить" border=0> </a>';
		html += '</td>';
		html += '</tr>';
	}
	html += '</table>';
	return html;
}
function adp(formt)
{
 document.getElementById(formt).focus();
 elem = document.getElementById(formt);
 elem.value ++;
 document.getElementById(formt).blur();
}
function adm(formt)
{
 document.getElementById(formt).focus();
 elem = document.getElementById(formt);
 elem.value --;
 document.getElementById(formt).blur();
}
function updateDresserNaturalEditors(state)
{
	var eheader = document.getElementById('editheader' + state.id);
	if (eheader == null)
	{
		document.getElementById('editpane' + state.id).innerHTML = getDresserNaturalEditors(state);
		return;
	}
	eheader.innerHTML = getEditHeaderInfo(state);
	for (var i = 0; i < knownNaturalEditors.length; i++)
	{
		var name = knownNaturalEditors[i];
		if (name == '-')
		{
			continue;
		}
		var eltname = format('edit{0}{1}', state.id, name);
		var elt = document.getElementById(eltname);
		if (elt == null)
		{
			document.getElementById('editpane' + state.id).innerHTML = getDresserNaturalEditors(state);
			return;
		}
		var v = '0';
		if (name in state.natural)
		{
			v = state.natural[name].toString();
		}
		elt.value = v;
		var infname = format('editi{0}{1}', state.id, name);
		var inf = document.getElementById(infname);
		if (inf == null)
		{
			document.getElementById('editpane' + state.id).innerHTML = getDresserNaturalEditors(state);
			return;
		}
		inf.innerHTML = getDresserNaturalEditorInfo(state, name);
	}
}

function onChangeEdit(field, stateId, propName)
{
	var state = dressStates[stateId];
	if (state == null)
	{
		return;
	}
	var v = parseInt(field.value);
	if (isNaN(v) || v < 0)
	{
		updateDresserState(state);
		return;
	}
	if (propName.lastIndexOf('skill') > 0)
	{
		if (propName.lastIndexOf('magicskill') > 0)
		{
			if (v > 25)
			{
				v = 25;
			}
		}
		else
		{
			if (v > 25)
			{
				v = 25;
			}
		}
	}
	if (propName == 'levelup')
	{
		if (('L' + state.natural.level) in expd)
		{
			var ldata = expd['L' + state.natural.level];
			if (('ups' in ldata) && (('U' + v) in ldata.ups))
			{
				var udata = ldata.ups['U' + v];
			}
			else
			{
				if ('count' in ldata)
				{
					v = ldata.count - 1;
				}
				else
				{
					v = 0;
				}
			}
		}
	}
	state.natural[propName] = v;
	updateEnduranceLimit(state.natural.level);
	for (propName in knownStatLimits)
	{
		if (!(propName in state.natural) || (state.natural[propName] < knownStatLimits[propName]))
		{
			state.natural[propName] = knownStatLimits[propName];
		}
	}
	updateDresserState(state);
}

function getDresserShortcuts(state)
{
	var html = '';
	var btn = '<img src="' + blankImgPath + '" border="0" width="80" height="51" />';
	html += '<a class="elixmenu" href="#" onclick="hideMenu(); onElixMenu(); return false" title="' + localizer.elixMenu + '">' + btn + '</a>';
	if (!dressOptions.newCapEdition)
	{
		html += '<a class="spellmenu" href="#" onclick="hideMenu(); onSpellMenu(); return false" title="' + localizer.spellMenu + '">' + btn + '</a>';
		html += '<a class="petmenu" href="#" onclick="hideMenu(); onPetMenu(); return false" title="' + localizer.petMenu2 + '">' + btn + '</a>';
	}
	html += '<hr class="dashed" />';
	html += '<a class="dressset" href="#" onclick="hideMenu(); onDressAnyCombatsSet(); return false" title="' + localizer.dressCombatsSet + '">' + btn + '</a>';
	html += '<a class="dropitems" href="#" onclick="hideMenu(); onDropAll(); return false" title="' + localizer.dropAll + '">' + btn + '</a>';
	html += btn;
	return html;
}

function getDresserInnerHtml(state, placeholdersOnly)
{
	var fmt = '<table class="tcontent" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top" colspan="2">{3}</td></tr><tr><td valign="top" width="400"><table border="0" cellspacing="0" cellpadding="0" width="400"><tr><td width="320" valign="top">{0}</td><td width="80" valign="bottom">{5}</td></tr><tr><td colspan="2" valign="top"><div id="editpane{2}">{4}</div></td></tr></table></td><td valign="top"><div id="infopane{2}">{1}</div></td></tr></table>';
	return format(
				  fmt,
				  getPersImageHtml(state),
				  getDresserInfoPaneHtml(state),
				  state.id,
				  getDresserCommands(state),
				  getDresserNaturalEditors(state),
				  getDresserShortcuts(state)
				  );
}

function getCellHtml(s, odd)
{
	var r = '';
	r += '<td ';
	if (odd)
	{
		r += 'class="infolighttd" ';
	}
	r += '>' + s + '</td>';
	return r;
}

function getHeaderHtml(separator)
{
	var cattr = separator ? ' class="infoseparator"' : '';
	var html = '<tr><th colspan="2"' + cattr + '>';
	if (separator)
	{
		html += '<hr class="dashed" />';
	}
	else
	{
		html += '&nbsp;';
	}
	html += '</th>';
	var stateCount = 0;
	var i = 1;
	for (var staten in dressStates)
	{
		var state = dressStates[staten];
		var n = '&nbsp;' + localizer.upperCab + ' ' + i + '&nbsp;';
		if (state.name != '')
		{
			n += '<br />' + htmlstring(state.name);
		}

		html += '<th' + cattr + '><nobr>' + n + '</nobr></th>';
		stateCount++;
		i++;
	}
	html += '</tr>';
	return html;
}

function getLeftCellHtml(s, odd, s2)
{
	var c = 'infoleftth';
	var r = '<tr><th class="' + c + '" ';
	if (s2 == null)
	{
		r += 'colspan="2">' + s;
	}
	else
	{
		r += '>' + s + '</th><th class="' + c + '">' + s2;
	}
	r += '</th>';
	return r;
}

function getSummaryInnerHtml()
{
	var html = '<table class="tcontent" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center" valign="top">';
	html += '<p>' + localizer.summaryTableDesc + '</p>';
	html += '<table class="info" border="0" cellspacing="0" cellpadding="0">';
	var stateCount = 0;
	for (var staten in dressStates)
	{
		var state = dressStates[staten];
		recalcDresserState(state);
		stateCount++;
	}
	html += getHeaderHtml(false);
	var firstChapter = true;
	var chapterHtml = '';
	var odd = false;
	for (var mfi in knownCleanModifiers)
	{
		var mf = knownCleanModifiers[mfi];
		if (mf == '-')
		{
			if (chapterHtml != '')
			{
				html += chapterHtml;
				html += getHeaderHtml(true);
				chapterHtml = '';
				odd = false;
			}
			continue;
		}
		if (!item_props[mf].view)
		{
			continue;
		}
		var hasValues = false;
		var maxValue = Number.MIN_VALUE;
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			hasValues |= (state.results[mf] != 0);
			if (maxValue < state.results[mf])
			{
				maxValue = state.results[mf];
			}
		}
		if (!hasValues)
		{
			continue;
		}
		chapterHtml += getLeftCellHtml(getItemPropLabel(mf), odd);
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			var v = state.results[mf];
			v = getItemPropFormattedValue(mf, v, maxValue);
			chapterHtml += getCellHtml(v, odd);
		}
		chapterHtml += '</tr>';
		odd = !odd;
	}
	if (chapterHtml != '')
	{
		html += chapterHtml;
		html += getHeaderHtml(true);
	}

	chapterHtml = '';
	odd = false;
	for (var mf in knownAdvWeaponModifiers)
	{
		if (!item_props[mf].view)
		{
			continue;
		}
		var hasValues = false;
		var maxValue = Number.MIN_VALUE;
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			if (mf in state.w3props)
			{
				var vobj = state.w3props[mf];
				if (vobj != null)
				{
					var vsum = vobj.minv + vobj.maxv;
					hasValues = true;
					if (maxValue < vsum)
					{
						maxValue = vsum;
					}
				}
			}
			if (mf in state.w10props)
			{
				var vobj = state.w10props[mf];
				if (vobj != null)
				{
					var vsum = vobj.minv + vobj.maxv;
					hasValues = true;
					if (maxValue < vsum)
					{
						maxValue = vsum;
					}
				}
			}
		}
		if (!hasValues)
		{
			continue;
		}
		chapterHtml += getLeftCellHtml(getItemPropLabel(mf), odd);
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			var vhtml = '';
			var v = '-';
			if (mf in state.w3props)
			{
				v = getItemPropAdvWeaponHtml(mf, state.w3props[mf], maxValue, true);
			}
			vhtml += v;
			if (mf in state.w10props)
			{
				v = getItemPropAdvWeaponHtml(mf, state.w10props[mf], maxValue, true);
				vhtml += '/' + v;
			}
			chapterHtml += getCellHtml(vhtml, odd);
		}
		chapterHtml += '</tr>';
		odd = !odd;
	}
	if (chapterHtml != '')
	{
		html += chapterHtml;
		html += getHeaderHtml(true);
		chapterHtml = '';
		odd = false;
	}
	for (var mfi in knownWeaponModifiers)
	{
		var mf = knownWeaponModifiers[mfi];
		if (mf == '-')
		{
			if (chapterHtml != '')
			{
				html += chapterHtml;
				html += getHeaderHtml(true);
				chapterHtml = '';
				odd = false;
			}
			continue;
		}
		if (!item_props[mf].view)
		{
			continue;
		}
		var hasValues = false;
		var maxValue = Number.MIN_VALUE;
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			if (mf in state.w3props)
			{
				var v = state.w3props[mf];
				if (mf in state.natural)
				{
					v += state.natural[mf];
				}
				hasValues |= (v != 0);
				if (maxValue < v)
				{
					maxValue = v;
				}
			}
			if (mf in state.w10props)
			{
				var v = state.w10props[mf];
				if (mf in state.natural)
				{
					v += state.natural[mf];
				}
				hasValues |= (v != 0);
				if (maxValue < v)
				{
					maxValue = v;
				}
			}
		}
		if (!hasValues)
		{
			continue;
		}
		chapterHtml += getLeftCellHtml(getItemPropLabel(mf), odd);
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			var vhtml = '';
			var v = '-';
			if (mf in state.w3props)
			{
				v = state.w3props[mf];
				if (mf in state.natural)
				{
					v += state.natural[mf];
				}
				v = getItemPropFormattedValue(mf, v, maxValue);
			}
			vhtml += v;
			if (mf in state.w10props)
			{
				v = state.w10props[mf];
				if (mf in state.natural)
				{
					v += state.natural[mf];
				}
				v = getItemPropFormattedValue(mf, v, maxValue);
				vhtml += '/' + v;
			}
			chapterHtml += getCellHtml(vhtml, odd);
		}
		chapterHtml += '</tr>';
		odd = !odd;
	}
	if (chapterHtml != '')
	{
		html += chapterHtml;
		html += getHeaderHtml(true);
	}

	chapterHtml = '';
	odd = false;
	for (var mf in knownArmorModifiers)
	{
		if (!item_props[mf].view)
		{
			continue;
		}
		var maxValue = Number.MIN_VALUE;
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			var v1 = state.results[mf + '1'];
			var v2 = state.results[mf + '2'];
			if (maxValue < (v1 + v2))
			{
				maxValue = v1 + v2;
			}
		}
		chapterHtml += getLeftCellHtml(getItemPropLabel(mf), odd);
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			var vobj = { minv: state.results[mf + '1'], maxv: state.results[mf + '2'] };
			chapterHtml += getCellHtml(getItemPropAdvWeaponHtml(mf, vobj, maxValue, true), odd);
		}
		chapterHtml += '</tr>';
		odd = !odd;
	}
	if (chapterHtml != '')
	{
		html += chapterHtml;
		html += getHeaderHtml(true);
	}

	chapterHtml = '';
	odd = false;
	for (var mf in knownZoneModifiers)
	{
		if (!item_props[mf].view)
		{
			continue;
		}
		var hasValues = false;
		var maxValues = { head: 0, body: 0, waist: 0, leg: 0, avg: 0 };
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			if (mf in state.results)
			{
				var v = state.results[mf];
				for (zone in maxValues)
				{
					if (maxValues[zone] < v[zone])
					{
						maxValues[zone] = v[zone];
						hasValues = true;
					}
				}
			}
		}
		if (!hasValues)
		{
			continue;
		}
		chapterHtml += '<tr><th rowspan="5" class="infoleftth">' + getItemPropLabel(mf) + '</th>';
		var firstZone =  true;
		for (var zone in maxValues)
		{
			if (firstZone)
			{
				firstZone = false;
			}
			else
			{
				chapterHtml += '</tr><tr>';
				odd = !odd;
			}
			chapterHtml += '<th class="infoleftth">' + localizer['zone' + zone] + '</th>';
			for (var staten in dressStates)
			{
				var state = dressStates[staten];
				var v = '-';
				if (mf in state.results)
				{
					v = state.results[mf][zone];
					var pcz = getMatvikZoneValue(parseFloat(v));
//					if (pcz > 80) pcz = 80; // no more than 80%
					if (pcz > 100) pcz = 100; // no more than 100%
					pcz = Math.floor(pcz * 100 + 0.5) / 100;
					v = getItemPropFormattedValue(mf, v, maxValues[zone]) + ' (' + pcz + '%)';
				}
				chapterHtml += getCellHtml(v, odd);
			}
		}
		chapterHtml += '</tr>';
		odd = !odd;
	}
	if (chapterHtml != '')
	{
		html += chapterHtml;
		html += getHeaderHtml(true);
	}
	html += '</table>';

	html += '</td></tr></table>';
	return html;
}

function showSummary()
{
	var summaryDiv = document.getElementById(summaryDivId);
	summaryDiv.innerHTML = getSummaryInnerHtml();
	summaryDiv.style.display = '';
}

function hideSummary()
{
	var summaryDiv = document.getElementById(summaryDivId);
	summaryDiv.style.display = 'none';
}

function getExpTableHeaderHtml(separator)
{
	var cattr = separator ? ' class="infoseparator"' : '';
	var html = '';
	if (separator)
	{
		html += '<tr><th colspan="2"' + cattr + '>';
		html += '<hr class="dashed" />';
		html += '</th>';
	}
	else
	{
		html += '<tr><th width="33%" rowspan="2"' + cattr + '>' + item_props.level.lbl + '</th>';
		html += '<th rowspan="2"' + cattr + '>' + item_props.levelup.lbl + '</th>';
		html += '<th width="1%"' + cattr + '>|</th>';
		html += '<th colspan="4"' + cattr + '>' + localizer.expIncrement + '</th>';
		html += '<th width="1%"' + cattr + '>|</th>';
		html += '<th colspan="3"' + cattr + '>' + localizer.expTotal + '</th>';
		html += '</tr><tr>';
	}
	html += '<th width="1%"' + cattr + '>|</th>';
	html += '<th' + cattr + '>' + localizer.expStats + '</th>';
	html += '<th' + cattr + '>' + localizer.expSkills + '</th>';
	html += '<th' + cattr + '>' + localizer.expEndurance + '</th>';
	html += '<th' + cattr + '>' + localizer.expCredits + '</th>';
	html += '<th width="1%"' + cattr + '>|</th>';
	html += '<th' + cattr + '>' + localizer.expStats + '</th>';
	html += '<th' + cattr + '>' + localizer.expExperience + '</th>';
	html += '<th' + cattr + '>' + localizer.expCredits + '</th>';
	html += '</tr>';
	return html;
}

function getExpTableInnerHtml()
{
	var html = '<table class="tcontent" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td  align="center" valign="top">';
	html += '<p>' + localizer.expTableDesc + '</p>';
	html += '<table width="100%" class="info" border="0" cellspacing="0" cellpadding="0">';
	html += getExpTableHeaderHtml(false);

	for (var leveln in expd)
	{
		var level = expd[leveln];
		var upc = 1;
		if ('count' in level)
		{
			upc = level.count;
		}
		html += '<tr>';

		html += '<th rowspan="' + upc + '" class="infoleftth">' + item_props.level.lbl + ': ';
		html += level.id.toString().bold();
		if ('baseExp' in level)
		{
			html += '<br />' + localizer.expBaseExperience + ': ' + level.baseExp.toString().bold();
		}
		if ('body' in level)
		{
			html += '<br />' + localizer.expBody + ': ' + level.body.toString().bold();
		}
		if ('description' in level)
		{
			html += '<br />' + localizer.expDescription + ': ' + level.description.bold();
		}
		html += '</th>';
		if ('ups' in level)
		{
			var firstUp = true;
			var odd = false;
			for (var upn in level.ups)
			{
				if (firstUp)
				{
					firstUp = false;
				}
				else
				{
					html += '</tr><tr>';
				}
				var up = level.ups[upn];
				html += '<th class="infoleftth">' + up.id + '</th>';
				html += getCellHtml('|', odd)
				html += getCellHtml(up.astats, odd)
				html += getCellHtml(up.amastery || '', odd)
				html += getCellHtml(up.aendurance || '', odd)
				html += getCellHtml(up.acredits || '', odd)
				html += getCellHtml('|', odd)
				html += getCellHtml(up.sstats, odd)
				html += getCellHtml(up.sexp, odd)
				html += getCellHtml(up.scredits.toString(), odd)
				odd = !odd;
			}
		}
		if (!('count' in level))
		{
			html += '<th class="infoleftth">&nbsp;</th>';
			html += '<td colspan="9">' + localizer.expNoInformation + '</td>';
		}
		html += '</tr>';
		html += getExpTableHeaderHtml(true);
	}

	html += '</table>';
	html += '</td></tr></table>';
	return html;
}

function showExpTable()
{
	var expTableDiv = document.getElementById(expTableDivId);
	if (!expTableBuilt)
	{
		expTableDiv.innerHTML = 'Подождите, пока идёт форматирование таблицы опыта...';
	}
	expTableDiv.style.display = '';
	if (!expTableBuilt)
	{
		expTableDiv.innerHTML = getExpTableInnerHtml();
		expTableBuilt = true;
	}
}

function hideExpTable()
{
	var expTableDiv = document.getElementById(expTableDivId);
	expTableDiv.style.display = 'none';
}

function getCabsAsOptions()
{
	var html = '';
	var i = 1;
	for (var staten in dressStates)
	{
		var state = dressStates[staten];
		html += '<option value="';
		html += state.id;
		html += '">';
		html += localizer.upperCab + ' ' + i;
		html += '</option>';
		i++;
	}
	return html;
}

var dressHealerData = new Array(
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ),
	new Array ( 5, 5, 5, 5, 5, 5 ) 
);

function evaluateHealerPrice()
{
	var errorsFound = false;
	var html = '';
	var sourceState = dressStates[document.getElementById('sourcecab').value];
	if (sourceState == null)
	{
		html += '<p><font color="red">Не выбрана исходная кабинка.</font></p>';
		errorsFound = true;
	}
	var targetState = dressStates[document.getElementById('targetcab').value];
	if (targetState == null)
	{
		html += '<p><font color="red">Не выбрана целевая кабинка.</font></p>';
		errorsFound = true;
	}
	var freeSwapsCount = parseInt(document.getElementById('freeswaps').value);
	if (isNaN(freeSwapsCount) || freeSwapsCount < 0)
	{
		html += '<p><font color="red">Количество оставшихся бесплатных перекидок статов должно быть целым неотрицательным числом.</font></p>';
		errorsFound = true;
	}
	if (freeSwapsCount > 15)
	{
		html += '<p><font color="red">Количество оставшихся бесплатных перекидок статов не может быть выше 15.</font></p>';
		errorsFound = true;
	}
	if (sourceState == targetState)
	{
		html += '<p><font color="red">Вы выбрали одну и ту же кабинку в качестве исходной и целевой. Стоимость перекидки равна 0кр.</font></p>';
		errorsFound = true;
	}
	recalcDresserState(sourceState);
	recalcDresserState(targetState);
	if (sourceState.natural.totalstats != targetState.natural.totalstats)
	{
		html += '<p><font color="red">Общая сумма родных статов в выбранных кабинках не совпадает.';
		html += ' Для исходной кабинки сумма родных статов равна ' + sourceState.natural.totalstats;
		html += ', а для целевой кабинки сумма родных статов равна ' + targetState.natural.totalstats;
		html += '. Пожалуйста, выровняйте количество родных статов в этих кабинках.</font></p>';
		errorsFound = true;
	}
	if (sourceState.natural.spirituality < targetState.natural.spirituality)
	{
		html += '<p><font color="red">Значение духовности в целевой кабинке больше, чем в исходной.';
		html += '. К сожалению, Администрация БК пока не предоставила нам информацию о стоимости перекидки статов в Духовность.</font></p>';
		errorsFound = true;
	}
	var freeStats = '';
	for (var i = 0; i < knownStats.length; i++)
	{
		var mfname = knownStats[i];
		var sval = sourceState.natural[mfname];
		var tval = targetState.natural[mfname];
		if (tval > sval && tval > dressHealerData.length)
		{
			html += '<p><font color="red">' + getItemPropLabel(mfname) + ': Значение в целевой кабинке больше, чем мы можем обработать.';
			html += 'Для перекидки больше ' + dressHealerData.length + ' статов дешевле воспользоватся кнопкой "Скинуть все" в комнате знахаря.</font></p>';
			errorsFound = true;
		}
		if (tval > sval && tval < 0)
		{
			html += '<p><font color="red">' + getItemPropLabel(mfname) + ': Значение в целевой кабинке меньше нуля, и больше значения в исходной кабинке.';
			html += '. Значения родных статов не могут быть меньше 0.</font></p>';
			errorsFound = true;
		}
		if (sval > tval)
		{
			if (freeStats != '')
			{
				freeStats += ', ';
			}
			freeStats += getItemPropLabel(mfname);
		}
	}
	if (!errorsFound)
	{
		var history = '';
		var price = 0;
		for (var i = knownStats.length - 1; i >= 0; i--)
		{
			if (i >= dressHealerData[0].length)
			{
				continue;
			}
			var mfname = knownStats[i];
			var sval = sourceState.natural[mfname];
			var tval = targetState.natural[mfname];
			var diff = tval - sval;
			if (diff > 0)
			{
				for (j = 0; j < diff; j++)
				{
					if (freeSwapsCount > 0)
					{
						freeSwapsCount--;
						history += 'Перекидываем один стат из [' + freeStats + '] в ' + getItemPropLabel(mfname) + ' бесплатно <i>(' + getItemPropLabel(mfname) + ': было ' + (sval + j).toString() + ', стало ' + (sval + j + 1).toString() + ')</i>.<br />';
					}
					else
					{
						var m = sval + j;
						var m2 = m - 1;
						if (m2 < 0) m2 = 0;
						var stepPrice = dressHealerData[m2][i];
						price += stepPrice;
						history += 'Перекидываем один стат из [' + freeStats + '] в ' + getItemPropLabel(mfname) + ' за ' + stepPrice + 'кр. <i>(' + getItemPropLabel(mfname) + ': было ' + m.toString() + ', стало ' + (m + 1).toString() + ')</i>.<br />';
					}
				}
			}
		}
		html += '<p>Общая стоимость перекидки статов: <b>' + price + '</b>кр.</p>';
		html += '<hr class="dashed" />';
		html += history;
	}
	var healerInfoDiv = document.getElementById('evaluatedHealerInfo');
	healerInfoDiv.innerHTML = html;
}

function getHealerInnerHtml()
{
	var html = '<table class="tcontent" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td  align="left" valign="top">';
	html += '<p>Комната Знахаря позволит Вам оценить затраты на перекидку статов.</p>';
	html += '<p>1. Выберите кабинку с исходным комплектом: <select id="sourcecab" name="sourcecab" class="ABTextR">';
	html += getCabsAsOptions();
	html += '</select><br />';
	html += '2. Выберите кабинку с целевым комплектом: <select id="targetcab" name="targetcab" class="ABTextR">';
	html += getCabsAsOptions();
	html += '</select><br />';
	html += '3. Укажите количество оставшихся бесплатных перекидок статов: <input type="text" id="freeswaps" name="freeswaps" value="0" class="ABTextR" size="2" maxlength="2" /><br />';
	html += '4. И нажмите на эту кнопку: <input class="inpButton" type="button" id="evaluatehealerprice" name="evaluatehealerprice" value="Рассчитать стоимость перекидки статов" onclick="evaluateHealerPrice(); return false" /></p>';
	html += '<div id="evaluatedHealerInfo"></div>';
	html += '</td></tr></table>';
	return html;
}

function showHealer()
{
	var healerDiv = document.getElementById(healerDivId);
	healerDiv.innerHTML = getHealerInnerHtml();
	healerDiv.style.display = '';
}

function hideHealer()
{
	var healerDiv = document.getElementById(healerDivId);
	healerDiv.style.display = 'none';
}

function getAttackCount(state)
{
	var r = 1;
	var w3o = getObjectById(state.objects[slot_w3.index]);
	var w10o = getObjectById(state.objects[slot_w10.index]);
	if (w10o != null && w10o.slot != 'w3')
	{
		w10o = null;
	}
	if (w3o != null && w10o != null)
	{
		r = 2;
	}
	var wearedRings = [
		state.objects[slot_w6.index],
		state.objects[slot_w7.index],
		state.objects[slot_w8.index]
		];
	for (var ri = 0; ri < wearedRings.length; ri++)
	{
		if (wearedRings[ri] == 'aring5')
		{
			r += 1;
		}
	}
	return r;
}

function adjustBlockCount(o, firstw, shieldy)
{
	if (o == null) return -1;
	if (o.category == 'shields') return 1;
	if (('properties' in o) && ('blockzones' in o.properties))
	{
		var bz = o.properties.blockzones.toString();
		if (!firstw && (bz == '++'))
		{
			return 1;
		}
		if ((!firstw || shieldy) && (bz == '&#8212;'))
		{
			return -1;
		}
	}
	return 0;
}

function getBlockCount(state)
{
	var r = 2;
	var w3o = getObjectById(state.objects[slot_w3.index]);
	var w10o = getObjectById(state.objects[slot_w10.index]);
	if (w3o == null)
	{
		return r;
	}
	if (w10o != null)
	{
		r += adjustBlockCount(w3o, true, (w10o.category=='shields'));
		r += adjustBlockCount(w10o, false, (w10o.category=='shields'));
	}
	if (r < 1) r = 1;
	if (r > 4) r = 4;

	return r;
}

function getBlockZones(blockCount)
{
	var bzd = twoBlockZones;
	if (blockCount >= 3)
	{
		bzd = threeBlockZones;
	}
	return bzd;
}

function updateTurnButton()
{
	var noStrike = false;
	for (var i = 0; i < turnData.strikes.length; i++)
	{
		if (turnData.strikes[i] == null)
		{
			noStrike = true;
			break;
		}
	}
	var en = !noStrike && (turnData.blockZones != 0);
	document.getElementById('doTurn').disabled = !en;
}

function strikeChosen(id)
{
	var el = document.getElementById(id);
	var number = parseInt(el.name.substr(4));
	var zn = parseInt(el.id.substr(el.name.length + 1));
	var v = el.checked;
	if (v)
	{
		turnData.strikes[number] = (zn-1);
	}
	else
	{
		if (turnData.strikes[number] == (zn-1))
		{
			turnData.strikes[number] = null;
		}
	}
	updateTurnButton();
}

function blockChosen(id)
{
	var el = document.getElementById(id);
	var number = parseInt(el.name.substr(4));
	var zn = parseInt(el.id.substr(el.name.length + 1));
	var v = el.checked;

	if (v)
	{
		turnData.blockZones |= turnData.bzd[(zn-1)].zones;
	}
	else
	{
		turnData.blockZones &= ~turnData.bzd[(zn-1)].zones;
	}

	updateTurnButton();
}

function doBattleTurn()
{
	document.getElementById('battlechoose').innerHTML = 'Ожидаем ответа';
	battleRequest();
}

function getBattleTurnParamsHash()
{
	var p = {};
	for (var i = 0; i < battleTurnParams.length; i++)
	{
		p[battleTurnParams[i]] = true;
	}
	return p;
}

function getStateBattleTurnParamsOf(prefix, postfix, data, p)
{
	var r = '';
	for (var mn in data)
	{
		if ((mn in p) && (data[mn] != 0))
		{
			r += '&' + prefix + mn + postfix + '=' + data[mn];
		}
	}
	return r;
}

function getStateBattleTurnParams(postfix, state, p)
{
	var r = '';
	r += getStateBattleTurnParamsOf('r.', postfix, state.results, p);
	r += getStateBattleTurnParamsOf('w3.', postfix, state.w3props, p);
	if (hasTwoWeapons(state))
	{
		r += getStateBattleTurnParamsOf('w0.', postfix, state.w10props, p);
	}
	return r;
}

function battleRequest()
{
	var p = getBattleTurnParamsHash();
	br_cleanupScriptElement(battleScriptId);
	var href = battleProviderUrl + '?rnd=' + Math.random();
	if (hasTwoWeapons(bstate1))
	{
		href += '&h2w1=1';
	}
	if (hasTwoWeapons(bstate2))
	{
		href += '&h2w2=1';
	}
	for (var i = 0; i < turnData.strikes.length; i++)
	{
		href += '&s1_' + i + '=' + turnData.strikes[i];
	}
	href += '&bz1=' + turnData.blockZones;
	href += getStateBattleTurnParams('.1', bstate1, p);
	href += getStateBattleTurnParams('.2', bstate2, p);
	if (isDeveloperMode()) informAboutProgress(href);
	br_getScriptElement(battleScriptId, href);
}

function br_cleanupScriptElement(id)
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

function br_getScriptElement(id, href)
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

var bstate1;
var bstate2;

function handleBattleResponse(response)
{
	var line = response.line;
	document.getElementById('xx_battlescreen').innerHTML = getBattleScreenHtml();
	var logelt = document.getElementById('xx_battlelog');
	line = '<div style="border-bottom: solid 1px #222222;">' + line + '</div>';
	if (logelt.insertAdjacentHTML)
	{
		logelt.insertAdjacentHTML('afterBegin', line);
	}
	else
	{
		logelt.innerHTML = line + logelt.innerHTML;
	}
}

function getStrikeBlockSelector(attackCount, blockCount)
{
	var html = '';
	var bzd = getBlockZones(blockCount);
	turnData = { bzd: bzd, strikes: new Array(attackCount), blockZones: 0 };
	html += '<table width="100%" border="0" cellspacing="0" cellpadding="8"><tr>';
	for (azi = 0; azi < attackCount; azi++)
	{
		html += '<td valign="top">';
		html += '<label>Удар</label>';
		var rn = 'atck' + azi;
		for (var i = 0; i < localizer.attackZone.length; i++)
		{
			var id = rn + '_' + (i+1);
			html += '<br />';
			html += '<input id="' + id + '" type="radio" value="' + i + '" name="' + rn + '" onclick="strikeChosen(' + "'" + id + "'" + ')" />';
			html += '<label for="' + id + '">' + localizer.attackZone[i] + '</label>';
		}
	}
	html += '</td><td valign="top">';
	html += '<label>Блок</label>';
	var rn = 'blck0';
	for (var i = 0; i < bzd.length; i++)
	{
		var id = rn + '_' + (i+1);
		html += '<br />';
		html += '<input id="' + id + '" type="radio" value="' + bzd[i].zones + '" name="' + rn + '" onclick="blockChosen(' + "'" + id + "'" + ')" />';
		html += '<label for="' + id + '">' + bzd[i].name + '</label>';
	}
	html += '</td></tr></table>';
	html += '<input id="doTurn" class="inpButton" type="button" onclick="doBattleTurn()" value="' + localizer.goStrike + '" disabled="yes" />';
	return html;
}

function getBattleScreenHtml()
{
	var html = '';
	html += '<div id="xx_battlescreen"><table width="100%" cellpadding="0" cellspacing="0"><tr>';
	html += '<td width="240" valign="top">' + getSimplePersImageHtml(bstate1, true) + '</td>';
	html += '<td align="center" valign="top" id="battlechoose">';
	html += getStrikeBlockSelector(bstate1.results.attackcount, bstate1.results.blockcount);
	html += '</td>';
	html += '<td width="240" valign="top">' + getSimplePersImageHtml(bstate2, false) + '</td>';
	html += '</tr></table></div>';

	return html;
}

function clearBattleState(state)
{
	for (var mf in knownWeaponModifiersHash)
	{
		if (!(mf in state.natural))
		{
			continue;
		}
		if (mf in state.w3props)
		{
			state.w3props[mf] += state.natural[mf];
		}
		if (mf in state.w10props)
		{
			state.w10props[mf] += state.natural[mf];
		}
		delete state.results[mf];
	}
	state.inbattle.hitpoints = state.results.hitpoints;
	state.inbattle.mana = state.results.mana;
}

function startBattle()
{
	var s1 = dressStates[document.getElementById('bcab1').value];
	var s2 = dressStates[document.getElementById('bcab2').value];
	bstate1 = cloneObject(s1);
	bstate2 = cloneObject(s2);
	clearBattleState(bstate1);
	clearBattleState(bstate2);
	var html = '';
	html += getBattleScreenHtml();

	html += '<hr class="dashed" />';
	html += '<div id="xx_battlelog">&nbsp;</div>';

	var battlesDiv = document.getElementById(battlesDivId);
	battlesDiv.innerHTML = html;
}

function getBattlesInnerHtml()
{
	var html = '<table class="tcontent" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td  align="left" valign="top">';
	html += '<p>Здесь Вы можете провести тестовые поединки.</p>';
	html += '<p><font color="red">Вплоть до официального релиза поединков оные будут лимитированы. Сперва появятся только поединки бойцов, и только потом появится магия.</font></p>';
	html += '<p>1. Выберите кабинку со своим комплектом: <select id="bcab1" name="bcab1" class="ABTextR">';
	html += getCabsAsOptions();
	html += '</select><br />';
	html += '2. Выберите кабинку с комплектом противника: <select id="bcab2" name="bcab2" class="ABTextR">';
	html += getCabsAsOptions();
	html += '</select><br />';
	html += '3. И нажмите на эту кнопку: <input class="inpButton" type="button" id="startbattle" name="startbattle" value="Начать поединок один на один" onclick="startBattle(); return false" /></p>';
	html += '</td></tr></table>';
	return html;
}

function showBattles()
{
	var battlesDiv = document.getElementById(battlesDivId);
	battlesDiv.innerHTML = getBattlesInnerHtml();
	battlesDiv.style.display = '';
}

function hideBattles()
{
	var battlesDiv = document.getElementById(battlesDivId);
	battlesDiv.style.display = 'none';
}

function getFake(oid)
{
	var o = getObjectById(oid);
	var r = o.upgrade[getJSName(oid) + '_fake'];
	if (!('caption' in r))
	{
		r.caption = o.caption;
	}
	r.category = o.category;
	r.slot = o.slot;
	r.width = o.width;
	r.height = o.height;
	return r;
}

function getCommonItemList()
{
	return common_props;
}

function getSelectItemListHtml(prefix, list)
{
	var html = '';
	html += '<select id="' + prefix + 'itemListChooser">';
	for (var mf in list)
	{
		var data = list[mf];
		var lbl = data.lbl;
		html += '<option value="' + mf + '">' + lbl + '</option>';
	}
	html += '</select>';
	return html;
}

function applyFakeParam(id)
{
	var value = parseFloat(document.getElementById('fakeParamValue').value);
	if (isNaN(value))
	{
		alert('Введите число.');
		return;
	}
	var o = getObjectById(id);
	if ('upgradecache' in o)
	{
		delete o.upgradecache;
	}
	var fake = getFake(id);
	if (!('common' in fake))
	{
		fake.common = {};
	}
	if (value != 0)
	{
		fake.common[document.getElementById('cmnitemListChooser').value] = value;
	}
	else
	{
		delete fake.common[document.getElementById('cmnitemListChooser').value];
	}

	document.getElementById('buildings').innerHTML = getFakeItemEditor(id);
}

function addFakeParam(id)
{
	var html = '';
	html += getSelectItemListHtml('cmn', getCommonItemList());
	html += '<br /><input id="fakeParamValue" type="text" value="0" />';
	html += '<br /><input class="inpButton" type="button" value="Добавить" onclick="applyFakeParam(' + "'" + id + "'" + ')" /></div>';
	document.getElementById('param_newline').innerHTML = html;
}

function getBoolItemList(boolvar)
{
	var r = {};
	for (var mf in item_props)
	{
		var data = item_props[mf];
		if ((boolvar in data) && data[boolvar])
		{
			r[mf] = data;
		}
	}
	return r;
}

function getRequiredItemList()
{
	return getBoolItemList('required');
}

function applyFakeReq(id)
{
	var value = document.getElementById('fakeReqValue').value;
	if (isNaN(value))
	{
		alert('Введите число.');
		return;
	}
	var o = getObjectById(id);
	if ('upgradecache' in o)
	{
		delete o.upgradecache;
	}
	var fake = getFake(id);
	if (!('required' in fake))
	{
		fake.required = {};
	}
	if (value > 0)
	{
		fake.required[document.getElementById('reqitemListChooser').value] = value;
	}
	else
	{
		delete fake.required[document.getElementById('reqitemListChooser').value];
	}
	document.getElementById('buildings').innerHTML = getFakeItemEditor(id);
}

function addFakeReq(id)
{
	var html = '';
	html += getSelectItemListHtml('req', getRequiredItemList());
	html += '<br /><input id="fakeReqValue" type="text" value="0" />';
	html += '<br /><input class="inpButton" type="button" value="Добавить" onclick="applyFakeReq(' + "'" + id + "'" + ')" /></div>';
	document.getElementById('req_newline').innerHTML = html;
}

function getCleanModifyItemList()
{
	return getBoolItemList('inmfg');
}

function applyFakeCleanMf(id)
{
	var value = document.getElementById('fakeMfValue').value;
	if (isNaN(value))
	{
		alert('Введите число.');
		return;
	}
	var o = getObjectById(id);
	if ('upgradecache' in o)
	{
		delete o.upgradecache;
	}
	var fake = getFake(id);
	if (!('modify' in fake))
	{
		fake.modify = {};
	}
	if (value != 0)
	{
		fake.modify[document.getElementById('cmfitemListChooser').value] = value;
	}
	else
	{
		delete fake.modify[document.getElementById('cmfitemListChooser').value];
	}
	document.getElementById('buildings').innerHTML = getFakeItemEditor(id);
}

function addFakeCleanMf(id)
{
	var html = '';
	html += getSelectItemListHtml('cmf', getCleanModifyItemList());
	html += '<br /><input id="fakeMfValue" type="text" value="0" />';
	html += '<br /><input class="inpButton" type="button" value="Добавить" onclick="applyFakeCleanMf(' + "'" + id + "'" + ')" /></div>';
	document.getElementById('mf_newline').innerHTML = html;
}

function getCleanPropertiesItemList()
{
	return getBoolItemList('inprpg');
}

function applyFakeCleanPrp(id)
{
	var value = document.getElementById('fakePrpValue').value;
	if (isNaN(value))
	{
		alert('Введите число.');
		return;
	}
	var o = getObjectById(id);
	if ('upgradecache' in o)
	{
		delete o.upgradecache;
	}
	var fake = getFake(id);
	if (!('properties' in fake))
	{
		fake.properties = {};
	}
	if (value != 0)
	{
		fake.properties[document.getElementById('prpitemListChooser').value] = value;
	}
	else
	{
		delete fake.properties[document.getElementById('prpitemListChooser').value];
	}
	document.getElementById('buildings').innerHTML = getFakeItemEditor(id);
}

function addFakeCleanPrp(id)
{
	var html = '';
	html += getSelectItemListHtml('prp', getCleanPropertiesItemList());
	html += '<br /><input id="fakePrpValue" type="text" value="0" />';
	html += '<br /><input class="inpButton" type="button" value="Добавить" onclick="applyFakeCleanPrp(' + "'" + id + "'" + ')" /></div>';
	document.getElementById('prp_newline').innerHTML = html;
}

function renameFake(id)
{
	var o = getObjectById(id);
	var fake = getFake(id);
	var caption = o.caption;
	if ('caption' in fake)
	{
		caption = fake.caption;
	}
	caption = window.prompt('Введите имя предмета', caption);
	if (caption != null)
	{
		if (caption == o.caption)
		{
			if ('caption' in fake)
			{
				delete fake.caption;
			}
		}
		else
		{
			fake.caption = caption;
		}
	}
	if ('upgradecache' in o)
	{
		delete o.upgradecache;
	}
	document.getElementById('buildings').innerHTML = getFakeItemEditor(id);
}

function getFakeItemEditor(id)
{
	var html = '';
	var fake = getFake(id);

	html += categories[fake.category].caption.bold() + '<hr class="dashed" />';

	html += format('<img border="0" align="right" src="{0}{1}.gif" width="{2}" height="{3}" />', itemImgPath, id, fake.width, fake.height);
	html += '<b>' + getUpgradeCaption(getObjectById(id), fake) + '</b> ';
	html += '<input class="inpButton" type="button" value="Переименовать" onclick="renameFake(' + "'" + id + "'" + ')" /><br />';
	if ('common' in fake)
	{
		for (var mf in fake.common)
		{
			html += getHtmlOfProp(null, fake.common, common_props[mf], mf);
		}
	}
	html += '<div id="param_newline"><input class="inpButton" type="button" value="Добавить в Параметры" onclick="addFakeParam(' + "'" + id + "'" + ')" /></div>';
	html += localizer.itemRequiredGroup.bold() + '<br />';
	if ('required' in fake)
	{
		for (var mf in fake.required)
		{
			html += getHtmlOfProp(null, fake.required, item_props[mf], mf);
		}
	}
	html += '<div id="req_newline"><input class="inpButton" type="button" value="Добавить в Требования" onclick="addFakeReq(' + "'" + id + "'" + ')" /></div>';
	html += localizer.itemModifyGroup.bold() + '<br />';
	if ('modify' in fake)
	{
		for (var mf in fake.modify)
		{
			if (mf in knownArmorModifiers)
			{
				continue;
			}
			html += getHtmlOfSignedProp(fake.modify, item_props[mf], mf, null, null, null);
		}
		for (var armorn in knownArmorModifiers)
		{
			html += getHtmlOfArmorProp(fake.modify, armorn, getItemPropLabel(armorn));
		}
	}
	html += '<div id="mf_newline"><input class="inpButton" type="button" value="Добавить в Действует на" onclick="addFakeCleanMf(' + "'" + id + "'" + ')" /></div>';
	html += localizer.itemPropertiesGroup.bold() + '<br />';
	if ('properties' in fake)
	{
		for (var mf in fake.properties)
		{
			html += getHtmlOfSignedProp(fake.properties, item_props[mf], mf, null, null, null);
		}
	}
	html += '<div id="prp_newline"><input class="inpButton" type="button" value="Добавить в Свойства предмета" onclick="addFakeCleanPrp(' + "'" + id + "'" + ')" /></div>';

	return html;
}

function createFake(id, fake)
{
	var c = categories[fake.category];
	var slot = getSlotById(c.slot);
	var oidx = getJSName(id);
	if (!(oidx in dressItems))
	{
		dressItems[oidx] = {id: id, fakebase: true, caption: fake.caption, category: c.id, slot: c.slot, width: slot.width, height: slot.height};
		c.items.push(dressItems[oidx]);
	}
	var o = getObjectById(id);
	if (!('upgrade' in o))
	{
		o.upgrade = {};
	}
	o.upgrade[oidx + '_fake'] = fake;
}

function builderEditItem(isNewItem)
{
	var ci = document.getElementById('builderCategoryChooser').value;
	var c = categories[ci];
	var slot = getSlotById(c.slot);
	var id = '';
	if (isNewItem)
	{
		id = document.getElementById('builderItemComposeName').value;
		var slashIndex = id.lastIndexOf('/');
		if (slashIndex >= 0)
		{
			id = id.substr(slashIndex + 1);
		}
		var gifIndex = id.lastIndexOf('.gif');
		if (gifIndex >= 0)
		{
			id = id.substr(0, gifIndex);
		}
		if (getObjectById(id) != null)
		{
			alert('Предмет с таким кодом уже существует!');
			return;
		}
	}
	else
	{
		id = document.getElementById('builderItemChooser').value;
	}
	if (id == '')
	{
		alert('Пустое имя предмета');
		return;
	}
	var oidx = getJSName(id);
	if (!(oidx in dressItems))
	{
		dressItems[oidx] = {id: id, fakebase: true, caption: 'Новый предмет', category: c.id, slot: c.slot, width: slot.width, height: slot.height};
		c.items.push(dressItems[oidx]);
		for (var ci in categories)
		{
			var oc = categories[ci];
			if (('basecat' in oc) && (oc.basecat == c) && (oc.items != c.items))
			{
				oc.items.push(dressItems[oidx]);
			}
		}
	}
	if (!(oidx in dressExData.fakes))
	{
		var o = getObjectById(id);
		if (!('upgrade' in o))
		{
			o.upgrade = {};
		}
		o.upgrade[oidx + '_fake'] = {id: id + '_fake', fake: Math.random()};
		if (!isNewItem)
		{
			o.upgrade[oidx + '_fake'] = combineObjects(o, o.upgrade[oidx + '_fake']);
		}
		dressExData.fakes[oidx] = id;
	}
	document.getElementById('buildings').innerHTML = getFakeItemEditor(id);
}

function rebuildItems()
{
	var ci = document.getElementById('builderCategoryChooser').value;
	if (ci == null || ci == '')
	{
		document.getElementById('builderItemChooserDiv').innerHTML = '';
		return;
	}
	var html = '';
	html += '<select id="builderItemChooser">';
	var c = categories[ci];
	var items = getFilteredItems(c.items);
	for (var iti in items)
	{
		var it = items[iti];
		html += '<option value="' + it.id + '">' + htmlstring(it.caption) + '</option>';
	}
	html += '</select>';
	html += '<br /><input class="inpButton" type="button" value="Открыть в конструкторе" onclick="builderEditItem(false);" />';
	document.getElementById('builderItemChooserDiv').innerHTML = html;
}

function builderChooseItem()
{
	var html = '';
	html += 'Выберите предмет для начала конструирования<br />';
	html += '<select id="builderCategoryChooser" onchange="rebuildItems()">';
	for (var ci in categories)
	{
		var c = categories[ci];
		if ((c.id == 'emptyitems') || ('basecat' in c))
		{
			continue;
		}
		html += '<option value="' + ci + '">';
		html += htmlstring(c.caption);
		html += '</option>';
	}
	html += '</select>';
	html += '<div id="builderItemChooserDiv">&nbsp;</div>';

	document.getElementById('buildings').innerHTML = html;
	rebuildItems();
}

function builderComposeItem()
{
	var html = '';
	html += 'Введите код предмета или ссылку на его изображение<br />';
	html += '<select id="builderCategoryChooser">';
	for (var ci in categories)
	{
		var c = categories[ci];
		if (c.id == 'emptyitems')
		{
			continue;
		}
		html += '<option value="' + ci + '">';
		html += htmlstring(c.caption);
		html += '</option>';
	}
	html += '</select>';
	html += '<br /><input id="builderItemComposeName" type="text" value="" />';
	html += '<br /><input class="inpButton" type="button" value="Открыть в конструкторе" onclick="builderEditItem(true);" />';

	document.getElementById('buildings').innerHTML = html;
}

function dropItemFromCategoryItems(c, o)
{
	for (var i = 0; i < c.items.length; i++)
	{
		if (c.items[i] == o)
		{
			delete c.items[i];
			break;
		}
	}
}

function builderDropItem()
{
	var id = document.getElementById('builderItemChooser').value;
	var o = getObjectById(id);
	delete o.upgrade[id + '_fake'];
	var hasUpgrades = false;
	for (var ui in o.upgrade)
	{
		hasUpgrades = true;
		break;
	}
	if (!hasUpgrades)
	{
		delete o.upgrade;
	}
	delete dressExData.fakes[getJSName(id)];
	if ('fakebase' in o)
	{
		var c = categories[o.category];
		dropItemFromCategoryItems(c, o);
		for (var ci in categories)
		{
			var oc = categories[ci];
			if (('basecat' in oc) && (oc.basecat == c) && (oc.items != c.items))
			{
				dropItemFromCategoryItems(oc, o);
			}
		}
		delete dressItems[getJSName(id)];
	}
	showBuilder();
}

function builderForgotItem()
{
	var html = '';
	html += 'Выберите предмет для забывания<br />';
	html += '<select id="builderItemChooser">';

	var items = [];
	for (var fi in dressExData.fakes)
	{
		items.push(getObjectById(dressExData.fakes[fi]));
	}
	for (var iti in items)
	{
		var it = items[iti];
		html += '<option value="' + it.id + '">' + htmlstring(it.caption) + '</option>';
	}
	html += '</select>';
	html += '<br /><input class="inpButton" type="button" value="Забыть в конструкторе" onclick="builderDropItem();" />';

	document.getElementById('buildings').innerHTML = html;
}

function getBuilderCommands()
{
	var html = '<table cellpadding="0" cellspacing="0" border="0"><tr>';
	html += getCell2MenuItemHtml('Модифицировать известный предмет', 'builderChooseItem()');
	html += getCell2MenuSeparatorHtml();
	html += getCell2MenuItemHtml('Создать новый предмет', 'builderComposeItem()');
	html += getCell2MenuSeparatorHtml();
	html += getCell2MenuItemHtml('Забыть сконструированный предмет', 'builderForgotItem()');
	html += '</table>';
	return html;
}

function getBuilderInnerHtml()
{
	var html = '';

	html += getBuilderCommands();
	html += '<div id="buildings">';
	html += '<p><font color="red">Конструктор в режиме тестирования и реализации, использовать пока не рекомендуется.</font></p>';
	html += '<p>Здесь Вы можете конструировать свои предметы или модифицировать существующие.</p>';
	html += '<p>Ресурс полезен при изменениях в мире БК любым игрокам, а также перед оными для гейм-мастеров.</p>';
	html += '</div>';

	return html;
}

function showBuilder()
{
	var builderDiv = document.getElementById(builderDivId);
	builderDiv.innerHTML = getBuilderInnerHtml();
	builderDiv.style.display = '';
}

function hideBuilder()
{
	var builderDiv = document.getElementById(builderDivId);
	builderDiv.style.display = 'none';
}

function recalcDresserWeaponState(state, wslot)
{
	var r = {};
	var objid;
	var o;
	for (var mfname in knownWeaponModifiersHash)
	{
		var mfvalue = 0;
		for (var sloti = 0; sloti < slots.length; sloti++)
		{
			var slot = slots[sloti];
			o = getObjectByStateSlot(state, slot);
			if (o == null)
			{
				continue;
			}
			if (('modify' in o) && (mfname in o.modify))
			{
				mfvalue += parseInt(o.modify[mfname]);
			}
		}
		for (var seti = 0; seti < state.appliedSets.length; seti++)
		{
			var set = state.appliedSets[seti];
			if (('modify' in set) && (mfname in set.modify))
			{
				mfvalue += parseInt(set.modify[mfname]);
			}
		}
		for (var strgi = 0; strgi < state.appliedStrengthenings.length; strgi++)
		{
			var strg = state.appliedStrengthenings[strgi];
			if (('modify' in strg) && (mfname in strg.modify))
			{
				mfvalue += parseInt(strg.modify[mfname]);
			}
		}
		o = getObjectByStateSlot(state, wslot);
		if (o != null)
		{
			if (('properties' in o) && (mfname in o.properties))
			{
				mfvalue += parseInt(o.properties[mfname]);
			}
		}
		if (o == null && wslot.id != 'w3')
		{
			continue;
		}
		r[mfname] = mfvalue;
	}
	for (var powerupn in state.spellPowerUps)
	{
		if (powerupn in knownECRPowerUps)
		{
			var epowerup = knownECRPowerUps[powerupn];
			if (epowerup.modify in knownWeaponModifiersHash)
			{
				r[epowerup.modify] += epowerup.v;
			}
		}
	}
	return r;
}

function calculateBaseWeaponIndices(state, wslot, o)
{
	var strength = 0;
	var mindamage = 0;
	var maxdamage = 0;
	var postmindamage = 0;
	var postmaxdamage = 0;
	var powermf = 0;
	var magicpowermf = 0;
	var skill = getWeaponSkillValue(state, wslot);
	var attacks = getAttackFreq(o);

	for (var sloti = 0; sloti < slots.length; sloti++)
	{
		var slot = slots[sloti];
		if (slot == wslot) continue;
		var so = getObjectByStateSlot(state, slot);
		if (so == null)
		{
			continue;
		}
		if ('modify' in so)
		{
			if ('mindamage' in so.modify)
			{
				postmindamage += parseInt(so.modify.mindamage);
			}
			if ('maxdamage' in so.modify)
			{
				postmaxdamage += parseInt(so.modify.maxdamage);
			}
		}
	}
	for (var i = 0; i < state.appliedStrengthenings.length; i++)
	{
		var strengthening = state.appliedStrengthenings[i];
		if ('modify' in strengthening)
		{
			if ('mindamage' in strengthening.modify)
			{
				postmindamage += parseInt(strengthening.modify.mindamage);
			}
			if ('maxdamage' in strengthening.modify)
			{
				postmaxdamage += parseInt(strengthening.modify.maxdamage);
			}
		}
	}

	if (o != null)
	{
		if ('modify' in o)
		{
			if ('mindamage' in o.modify)
			{
				mindamage += parseInt(o.modify.mindamage);
			}
			if ('maxdamage' in o.modify)
			{
				maxdamage += parseInt(o.modify.maxdamage);
			}
		}
		if ('properties' in o)
		{
			if ('mindamage' in o.properties)
			{
				mindamage += parseInt(o.properties.mindamage);
			}
			if ('maxdamage' in o.properties)
			{
				maxdamage += parseInt(o.properties.maxdamage);
			}
		}
	}

//	mindamage += state.natural.level;
//	maxdamage += state.natural.level;

	if (o != null)
	{
		if (isTwohandledWeapon(o))
		{
			skill *= 1.2;
		}

		var statBonuses = categories[o.category].statBonuses;
		if (statBonuses != null)
		{
			for (var statName in statBonuses)
			{
				if (statName in state.results)
				{
					var bonus = (state.results[statName] * statBonuses[statName]) / 100.0;
					strength += bonus;
				}
			}
		}
	}
	else
	{
		// test no weapons
		if (wslot.id == 'w3' && getObjectByStateSlot(state, slot_w10) == null)
		{
			mindamage += 2;
			maxdamage += 4;
			if ('strength' in state.results)
			{
				strength += state.results.strength;
			}
			if (strength <= 100)
			{
				strength *= 2;
			}
			else
			{
				strength += 100;
			}
		}
	}
	if (hasTwohandledWeapon(state))
	{
		strength *= 1.1;
	}
	var cpower = 0;
	if ('criticalpower' in state[wslot.id + 'props'])
	{
		cpower = state[wslot.id + 'props'].criticalpower;
		if ('criticalpower' in state.natural)
		{
			cpower += state.natural.criticalpower;
		}
	}
	else if ('criticalpower' in state.results)
	{
		cpower = state.results.criticalpower;
	}

	for (var delixn in state.damageElixes)
	{
		var delix = knownDamageElix[delixn];
		if (!('modify' in delix)) continue;
		if ('power' in delix.modify)
		{
			powermf += delix.modify.power;
		}
		if ('magicpower' in delix.modify)
		{
			magicpowermf += delix.modify.magicpower;
		}
		if ('damage1' in delix.modify)
		{
			postmindamage += delix.modify.damage1;
		}
		if ('damage2' in delix.modify)
		{
			postmaxdamage += delix.modify.damage2;
		}
	}

	return {strength: strength, skill: skill, mindamage: mindamage, maxdamage: maxdamage, cpower: cpower, attacks: attacks, powermf: powermf, magicpowermf: magicpowermf, postmindamage: postmindamage, postmaxdamage: postmaxdamage};
}

function getPowerMfValue(state, wslot, powermfn)
{
	var powerMfValue = 0;
	if (powermfn in state[wslot.id + 'props'])
	{
		powerMfValue = state[wslot.id + 'props'][powermfn];
		if (powermfn in state.natural)
		{
			powerMfValue += state.natural[powermfn];
		}
	}
	else if (powermfn in state.results)
	{
		powerMfValue = state.results[powermfn];
	}
	return powerMfValue;
}

function calculateAttackDamage(state, wslot, o, baseIndices, attackn)
{
	var attack = baseIndices.attacks[attackn];

	var k1 = 1 + (baseIndices.strength / 300.0);
	var k2 = 1 + (baseIndices.skill * 0.075);
	var k4 = 0.97;
	var k2e = 1;

	var mindamage = baseIndices.mindamage + (baseIndices.strength / 5);
	var maxdamage = baseIndices.maxdamage + (baseIndices.strength / 5);

	if (mindamage < 0 || mindamage > maxdamage)
	{
		mindamage = 0;
	}

	var powermfn = attackn + 'power';
	var powerMfValue = baseIndices.powermf;
	if (attack.elemental)
	{
		powermfn = attackn + 'magicpower';
		var estrength = 0;
		for (var powerupn in state.spellPowerUps)
		{
			if (!(powerupn in knownPowerUps))
			{
				continue;
			}
			var powerup = knownPowerUps[powerupn];
			if (powerup.damageup && ('element' in powerup))
			{
				if (attackn != powerup.element)
				{
					continue;
				}
				estrength = baseIndices.strength * 0.01 * state.spellPowerUps[powerupn];
			}
		}
		var eskill = getWeaponSkillValueOf(state, o, (attackn + 'magicskill'));
		k2e += (estrength / 300.0) + (eskill * 0.050);
//		k2 = 1 + ((k2 - 1) / 2);
		powerMfValue += getPowerMfValue(state, wslot, 'magicpower');
		powerMfValue += baseIndices.magicpowermf;
	}
//	else
//	{
		powerMfValue += getPowerMfValue(state, wslot, 'power');
//	}

	powerMfValue += getPowerMfValue(state, wslot, powermfn);

	mindamage *= k1 * k2;
	maxdamage *= k1 * k2;

	var k3 = 1 + (powerMfValue / 100.0);

	var damage1 = mindamage * k2e * k3 * k4;
	var damage2 = maxdamage * k2e * k3 * k4;

	mindamage += baseIndices.postmindamage;
	maxdamage += baseIndices.postmaxdamage;

	damage1 += baseIndices.postmindamage;
	damage2 += baseIndices.postmaxdamage;

	var cdamage1 = (damage1 + damage1) * (1 + (baseIndices.cpower / 100.0));
	var cdamage2 = (damage2 + damage2) * (1 + (baseIndices.cpower / 100.0));

	return {
		id: attackn,
		attack: attack,
		damage: {minv:mindamage, maxv:maxdamage},
		mfdamage: {minv:damage1, maxv:damage2},
		mfcdamage: {minv:cdamage1, maxv:cdamage2},
		postdamage: {minv:baseIndices.postmindamage, maxv:baseIndices.postmaxdamage},
		_power_v: powerMfValue
		};
}

function addToDamage(averages, concrete, percentage)
{
	averages.minv += concrete.minv * percentage / 100.0;
	averages.maxv += concrete.maxv * percentage / 100.0;
}

function floorDamage(damage)
{
	damage.minv = Math.floor(damage.minv + 0.5);
	damage.maxv = Math.floor(damage.maxv + 0.5);
}

function floorDamages(damages)
{
	floorDamage(damages.damage);
	floorDamage(damages.mfdamage);
	floorDamage(damages.mfcdamage);
}

function recalcDresserWeaponAdvState(state, wslot)
{
	var o = getObjectByStateSlot(state, wslot);
	var baseIndices = calculateBaseWeaponIndices(state, wslot, o);

	if ('spell_powerup10' in state.spellPowerUps)
	{
		baseIndices.strength *= 1 + (0.01 * state.spellPowerUps.spell_powerup10);
	}
	baseIndices.mindamage += (baseIndices.strength / 3);
	baseIndices.maxdamage += (baseIndices.strength / 3);

	// calculate averages in parallel
	var finalData = {};
	var averages = {damage: {minv:0, maxv:0}, mfdamage: {minv:0, maxv:0}, mfcdamage: {minv:0, maxv:0}};
	for (var attackn in baseIndices.attacks)
	{
		var fd = calculateAttackDamage(state, wslot, o, baseIndices, attackn);
		addToDamage(averages.damage, fd.damage, fd.attack.real);
		addToDamage(averages.mfdamage, fd.mfdamage, fd.attack.real);
		addToDamage(averages.mfcdamage, fd.mfcdamage, fd.attack.real);
		floorDamages(fd);
		finalData[attackn] = fd;
	}
	floorDamages(averages);
	state[wslot.id + 'props'].damage = averages.damage;
	state[wslot.id + 'props'].mfdamage = averages.mfdamage;
	state[wslot.id + 'props'].mfcdamage = averages.mfcdamage;
	state[wslot.id + 'props'].damages = finalData;
}


function recalcDresserCombatSpellsState(state)
{
	var spellsFound = {};
	for (var spellBase in combatSpells)
	{
		var spello = combatSpells[spellBase];
		for (var sloti = 0; sloti < slots.length; sloti++)
		{
			var slot = slots[sloti];
			var o = getObjectByStateSlot(state, slot);
			if (o == null)
			{
				continue;
			}
			if (o.id.substr(0, spello.id.length) == spello.id && ('required' in o) && ('mana' in o.required))
			{
				var b = o.id.substr(spello.id.length);
				spellsFound[getJSName(o.id)] = {spell: o, evd: spello, b: parseInt(b)};
			}
		}
	}
	state.combatSpells = {};
	for (var sid in spellsFound)
	{
		var spell = spellsFound[sid];
		var skillname = spell.evd.magic + 'magicskill';
		var maxdamage = spell.b;
		var skill = state.results[skillname];

		maxdamage += state.natural.level;

		var mf1 = 1 + (skill * 0.072);
		var mf2 = 1;
		mf2 += state.results[spell.evd.magic + 'magicpower'] * 0.01;
		if (spell.evd.elemental)
		{
			mf2 += state.results['magicpower'] * 0.01;
		}
		maxdamage *= mf1;
		maxdamage *= mf2;
		maxdamage *= 0.97;
		if (maxdamage > (spell.b * 10))
		{
			maxdamage = spell.b * 10;
		}
		var mindamage = (spell.evd.minzero ? 0.0 : (maxdamage * 0.9))
		maxdamage *= 1.02;
		var mincdamage = mindamage * spell.evd.critMultiplier;
		var maxcdamage = maxdamage * spell.evd.critMultiplier;
		state.combatSpells[spell.spell.id] = { magic_damage: {minv: Math.floor(mindamage), maxv: Math.floor(maxdamage)}, magic_cdamage: {minv: Math.floor(mincdamage), maxv: Math.floor(maxcdamage)} };
	}
}

function calcResults(state)
{
	for (var mfname in item_props)
	{
		if (mfname in knownZoneModifiers)
		{
			continue;
		}
		var vm = state.modify[mfname];
		var vn = state.natural[mfname];
		state.results[mfname] = (vm + vn);
	}
}

function calcArmors(state)
{
	var avgarmor1 = 0;
	var avgarmor2 = 0;
	for (var mfname in knownArmorModifiers)
	{
		if (mfname == 'avgarmor')
		{
			continue;
		}
		var mina = 0;
		var maxa = 0;
		for (var sloti = 0; sloti < slots.length; sloti++)
		{
			var slot = slots[sloti];
			var o = getObjectByStateSlot(state, slot);
			if (o == null || !('modify' in o))
			{
				continue;
			}
			if ((mfname + '1') in o.modify)
			{
				mina += parseInt(o.modify[mfname + '1']);
				maxa += parseInt(o.modify[mfname + '2']);
			}
			else if (mfname in o.modify)
			{
				mina += parseInt(o.modify[mfname]);
				maxa += parseInt(o.modify[mfname]);
			}
		}
		avgarmor1 += mina;
		avgarmor2 += maxa;
		state.results[mfname + '1'] = mina;
		state.results[mfname + '2'] = maxa;
	}
	state.results.avgarmor1 = avgarmor1 / 4.0;
	state.results.avgarmor2 = avgarmor2 / 4.0;

}

function applyDefElix(state, makeUp, v)
{
	switch (makeUp)
	{
		case 'edefence':
			state.results.thrustdefence.all += v;
			state.results.sabredefence.all += v;
			state.results.crushdefence.all += v;
			state.results.cutdefence.all += v;
			break;
		case 'emagicdefence':
			state.modify.firemagicdefence += v;
			state.modify.airmagicdefence += v;
			state.modify.watermagicdefence += v;
			state.modify.earthmagicdefence += v;
			break;
		default:
			if (makeUp in knownZoneModifiers)
			{
				state.results[makeUp].all += v;
			}
			else
			{
				state.modify[makeUp] += v;
			}
			break;
	}
}

function precalcZoneModifiers(state)
{
	for (var mfname in knownZoneModifiers)
	{
		state.results[mfname] = {all: 0, head: 0, body: 0, waist: 0, leg: 0, avg: 0, pants: 0};
	}
	state.results.defence.all = state.natural.endurance * 1.5;
}

function calcZoneModifiers(state)
{
	for (var i = 0; i < slots.length; i++)
	{
		var slot = slots[i];
		var o = getObjectByStateSlot(state, slot);
		if (o == null)
		{
			continue;
		}
		if ('modify' in o)
		{
			for (var mfname in o.modify)
			{
				if (mfname in knownZoneModifiers)
				{
					state.results[mfname].all += parseInt(o.modify[mfname]);
				}
			}
		}
		if ('properties' in o)
		{
			for (var mfname in o.properties)
			{
				if (mfname in knownZoneModifiers)
				{
					state.results[mfname][slot.zone] += parseInt(o.properties[mfname]);
				}
			}
		}
	}
	for (var i = 0; i < state.appliedSets.length; i++)
	{
		var set = state.appliedSets[i];
		if ('modify' in set)
		{
			for (var mfname in set.modify)
			{
				if (mfname in knownZoneModifiers)
				{
					state.results[mfname].all += parseInt(set.modify[mfname]);
				}
			}
		}
	}
	for (var i = 0; i < state.appliedStrengthenings.length; i++)
	{
		var strengthening = state.appliedStrengthenings[i];
		if ('modify' in strengthening)
		{
			for (var mfname in strengthening.modify)
			{
				if (mfname in knownZoneModifiers)
				{
					state.results[mfname].all += parseInt(strengthening.modify[mfname]);
				}
			}
		}
	}
	for (var delixn in state.defElixes)
	{
		var delix = knownDefElix[delixn];
		if (!(delix.makeUp in knownZoneModifiers) && !(delix.makeUp == 'edefence'))
		{
			continue;
		}
		var v = state.defElixes[delixn];
		applyDefElix(state, delix.makeUp, v);
		if ('makeUp2' in delix)
		{
			var v2 = getDefElixSecondValue(delix, v);
			applyDefElix(state, delix.makeUp2, v2);
		}
	}
	if ('spell_protect10' in state.spellPowerUps)
	{
		state.results.defence.all += state.spellPowerUps.spell_protect10;
	}
	for (var mfname in knownZoneModifiers)
	{
		if (mfname == 'defence')
		{
			continue;
		}
		var zones = state.results[mfname];
		zones.all += state.results.defence.all;
		zones.head += state.results.defence.head;
		zones.body += state.results.defence.body;
		zones.waist += state.results.defence.waist;
		zones.leg += state.results.defence.leg;
		zones.pants += state.results.defence.pants;
	}
	for (var mfname in knownZoneModifiers)
	{
		var zones = state.results[mfname];
		zones.head += zones.all;
		zones.body += zones.all;
		zones.waist += zones.all;
		zones.leg += zones.all;
		zones.waist += zones.pants;
		zones.leg += zones.pants;
		zones.avg = (zones.head + zones.body + zones.waist + zones.leg) / 4;
	}
	state.results.defence = {all: 0, head: 0, body: 0, waist: 0, leg: 0, avg: 0};
}

function recalcSpellPowerUpState(state)
{
	for (var powerUp in knownPowerUps)
	{
		knownPowerUps[powerUp].found = false;
		for (var sloti = 0; sloti < slots.length; sloti++)
		{
			var slot = slots[sloti];
			var o = getObjectByStateSlot(state, slot);
			knownPowerUps[powerUp].found |= (o != null && o.id == powerUp);
		}
		if (!knownPowerUps[powerUp].found)
		{
			continue;
		}
		var v = (2.2 * state.results[knownPowerUps[powerUp].skill] + 0.1 * state.natural.wisdom);
		if (!knownPowerUps[powerUp].damageup)
		{
			v *= 2;
			v /= 3;
		}
		var vself = v;
		if (vself > 33)
		{
			vself = 33;
		}
		vself = Math.floor(vself * 100.0 + 0.5) / 100.0;
		state.modify[powerUp + '_self'] = vself;
		var vother = vself * 0.75;
		vother = Math.floor(vother * 100.0 + 0.5) / 100.0;
		state.modify[powerUp + '_other'] = vother;
	}
}

function recalcDresserCombatTricksState(state)
{
	state.combatTricks = {};
	for (var i = 0; i < state.trickSlots.length; i++)
	{
		var trickn = state.trickSlots[i];
		if (trickn == null)
		{
			continue;
		}
		state.combatTricks[trickn] = {};
	}
    for (var trickn in state.combatTricks)
    {
	var trick = tricks[trickn];
	var skillv = 0;
	var power = state.results.magicpower;
	var manaconsumption = state.results.manaconsumption;
	var element = '';
	if (typeof (trick) == 'object' && ('required' in trick))
	{
		for (mfn in trick.required)
		{
			if (mfn.indexOf('magicskill') > 0)
			{
				skillv = state.results[mfn];
				element = mfn.substr(0, mfn.indexOf('magicskill'));
				power += state.results[element + 'magicpower'];
				break;
			}
		}
	}
	if (element != '')
	{
		for (var powerupn in state.spellPowerUps)
		{
			var v = state.spellPowerUps[powerupn];
			var kpu = knownPowerUps[powerupn];
			if ((kpu == null) || !kpu.damageup || !('element' in kpu) || (kpu.element != element))
			{
				continue;
			}
			power += (v * 2.0 / 3.0);
			break;
		}
	}
	manaconsumption += (skillv * 0.72);

	var r = state.combatTricks[trickn];
	r.name = trick.name;
        r.caption = trick.caption;
        if ('consumes' in trick)
        {
            if ('mana' in trick.consumes)
            {
                var mana = trick.consumes.mana;
                r.mana = Math.floor(mana * (1.0 - (manaconsumption / 100.0)) + 0.5);
            }
            if ('spiritlevel' in trick.consumes)
            {
                r.spiritlevel = trick.consumes.spiritlevel;
            }
        }
        if ('attack' in trick)
        {
            if ('damage' in trick.attack)
            {
                r.mfdamage = Math.floor(trick.attack.damage * (1.0 + (power / 100.0)) + 0.5);
            }
            if ('mindamage' in trick.attack)
            {
                r.mindamage = Math.floor(trick.attack.mindamage * (1.0 + (power / 100.0)) + 0.5);
                r.maxdamage = Math.floor(trick.attack.maxdamage * (1.0 + (power / 100.0)) + 0.5);
            }
            if ('nextdamage' in trick.attack)
            {
                r.nextdamage = Math.floor(trick.attack.nextdamage * (1.0 + (power / 100.0)) + 0.5);
                r.nextturns = trick.attack.nextturns;
            }
        }
        if ('healing' in trick)
        {
            if ('hitpoints' in trick.healing)
            {
                r.hitpoints = Math.floor(trick.healing.hitpoints * (1.0 + (power / 100.0)) + 0.5);
            }
            if ('minhitpoints' in trick.healing)
            {
                r.minhitpoints = Math.floor(trick.healing.minhitpoints * (1.0 + (power / 100.0)) + 0.5);
                r.maxhitpoints = Math.floor(trick.healing.maxhitpoints * (1.0 + (power / 100.0)) + 0.5);
            }
            if ('nexthitpoints' in trick.healing)
            {
                r.nexthitpoints = Math.floor(trick.healing.nexthitpoints * (1.0 + (power / 100.0)) + 0.5);
                r.nextturns = trick.healing.nextturns;
            }
        }
    }
}

function applyCommonSkillsTo(chapter)
{
	if ('weaponskill' in chapter)
	{
		for (var i = 0; i < knownWeaponSkills.length;  i++)
		{
			var skilln = knownWeaponSkills[i];
			if (skilln == 'staffskill')
			{
				continue;
			}
			if (!(skilln in chapter))
			{
				chapter[skilln] = 0;
			}
			chapter[skilln] += chapter.weaponskill;
		}
		chapter.weaponskill = 0;
	}
	if ('magicskill' in chapter)
	{
		for (var i = 0; i < naturalElements.length;  i++)
		{
			var skilln = naturalElements[i] + 'magicskill';
			if (!(skilln in chapter))
			{
				chapter[skilln] = 0;
			}
			chapter[skilln] += chapter.magicskill;
		}
		chapter.magicskill = 0;
	}
	if ('magicpower' in chapter)
	{
		for (var i = 0; i < allElements.length;  i++)
		{
			var powern = allElements[i] + 'magicpower';
			if (!(powern in chapter))
			{
				chapter[powern] = 0;
			}
			chapter[powern] += chapter.magicpower;
		}
		chapter.magicpower = 0;
	}
}

function applyCommonSkills(state)
{
//	applyCommonSkillsTo(state.natural);
	applyCommonSkillsTo(state.modify);
	applyCommonSkillsTo(state.results);
}

function recalcDresserState(state)
{
	var objid;
	var o;
	var propi;
	var sloti;
	var slot;
	var set;
	state.required = {};
	state.modify = {};
	state.results = {};
	state.battlemf = {};
	state.w3props = {};
	state.w10props = {};
	state.appliedSets = [];
	state.appliedStrengthenings = [];
	for (var mfname in item_props)
	{
		if (mfname in knownZoneModifiers)
		{
			continue;
		}
		if (!(mfname in state.natural))
		{
			state.natural[mfname] = 0;
		}
		if (!(mfname in state.modify))
		{
			state.modify[mfname] = 0;
		}
	}
	state.natural.hitpoints = (state.natural.endurance * 6);
	state.natural.knapsack = 40*(state.natural.level + 1) + state.natural.endurance;
	state.natural.magicdefence = (state.natural.endurance * 1.5);
	state.natural.defence = (state.natural.endurance * 1.5);
	state.natural.mana = (state.natural.wisdom * 10);
	state.natural.spiritlevel = 0;

	var ls = state.natural.level;

	if (ls > 6)
	{
		if (ls > 10)
		{
			ls = 10;
		}
		state.natural.spiritlevel += (ls - 6) * 10;
	}
	state.natural.counterstroke = dressOptions.newCapEdition ? 20 : 10;
	state.natural.piercearmor = dressOptions.newCapEdition ? 20 : 5;
	state.natural.attackcount = 1;
	state.modify.attackcount = getAttackCount(state) - 1;
	state.natural.blockcount = 2;
	state.modify.blockcount = getBlockCount(state) - 2;
	for (var i = 0; i < naturalElements.length; i++)
	{
		state.natural[naturalElements[i] + 'magicdefence'] = 0;
	}
	for (var i = 0; i < allElements.length; i++)
	{
		state.natural[allElements[i] + 'magicpower'] = state.natural.intellect * 0.5;
	}

	if ('spirituality' in state.natural)
	{
		state.natural.spiritlevel += state.natural.spirituality;
	}
	state.modify.knapsack = 0;
	if (state.statElix != null)
	{
		var mf = knownElix[state.statElix.elixn].makeUp;
		state.modify[mf] = state.statElix.v;
		if ('makeUp2' in knownElix[state.statElix.elixn])
		{
			var mf2 = knownElix[state.statElix.elixn].makeUp2;
			state.modify[mf2] = knownElix[state.statElix.elixn].values2[0];
		}
	}
	if (state.spellIntel != 0)
	{
		state.modify.intellect = state.spellIntel + (('intellect' in state.modify) ? state.modify.intellect : 0);
	}
	if (state.spellBD != 0)
	{
  state.modify.strength = state.spellBD + (('strength' in state.modify) ? state.modify.strength : 0);
		state.modify.dexterity = state.spellBD + (('dexterity' in state.modify) ? state.modify.dexterity : 0);
		state.modify.intuition = state.spellBD + (('intuition' in state.modify) ? state.modify.intuition : 0);
		state.modify.intellect = state.spellBD + (('intellect' in state.modify) ? state.modify.intellect : 0);
		state.modify.hitpoints = state.spellBD*6 +(('hitpoints' in state.modify) ? state.modify.hitpoints : 0);
	}
	if (state.spellHitpoints != 0)
	{
		state.modify.hitpoints = (state.natural.endurance * state.spellHitpoints) + (('hitpoints' in state.modify) ? state.modify.hitpoints : 0);
	}
	var w3o = getObjectByStateSlot(state, slot_w3);
	var w10o = getObjectByStateSlot(state, slot_w10);
	//dressStrengthenings.neutralPower.modify.mindamage = state.natural.level;
	//dressStrengthenings.neutralPower.modify.maxdamage = state.natural.level;
	for (var setn in dressSets)
	{
		set = dressSets[setn];
		var countFound = getCountForSet(state, set.id);
		if (!('details' in set) || (countFound == 0))
		{
			continue;
		}
		for (var scn in set.details)
		{
			var sc = set.details[scn];
			if ('required' in sc)
			{
				if ('itemscount' in sc.required)
				{
					if (!('caption' in sc))
					{
						sc.caption = set.caption + '&nbsp;(<span style="color:green;">' + sc.required.itemscount + '</span>)';
					}
					if (sc.required.itemscount == countFound)
					{
						state.appliedSets.push(sc);
					}
				}
				else if (('minitemscount' in sc.required) && ('maxitemscount' in sc.required))
				{
					if (!('caption' in sc))
					{
						sc.caption = set.caption + '&nbsp;(<span style="color:green;">' + sc.required.minitemscount + '&nbsp;-&nbsp;' + sc.required.maxitemscount + '</span>)';
					}
					if ((countFound >= sc.required.minitemscount) && (countFound <= sc.required.maxitemscount))
					{
						state.appliedSets.push(sc);
					}
				}
			}
		}
	}

	for (sloti = 0; sloti < slots.length; sloti++)
	{
		slot = slots[sloti];
		o = getObjectByStateSlot(state, slot);
		if (o == null)
		{
			continue;
		}

		if ('required' in o)
		{
			for (var mfname in o.required)
			{
				if (mfname in knownZoneModifiers)
				{
					continue;
				}
				var v = parseInt(o.required[mfname]);
				if (!(mfname in state.required) || (state.required[mfname] < v))
				{
					state.required[mfname] = v;
				}
			}
		}

		if ('modify' in o)
		{
			for (var mfname in o.modify)
			{
				if (mfname in knownZoneModifiers)
				{
					continue;
				}
				state.modify[mfname] += parseInt(o.modify[mfname]);
			}
		}
	}
	for (var tricki = 0; tricki < state.trickSlots.length; tricki++)
	{
		var trickn = state.trickSlots[tricki];
		if (trickn == null)
		{
			continue;
		}
		o = tricks[getJSName(trickn)];
		if (o == null)
		{
			continue;
		}
		if ('required' in o)
		{
			for (var mfname in o.required)
			{
				if (mfname in knownZoneModifiers)
				{
					continue;
				}
				var v = parseInt(o.required[mfname]);
				if (!(mfname in state.required) || (state.required[mfname] < v))
				{
					state.required[mfname] = v;
				}
			}
		}
	}
	for (var seti = 0; seti < state.appliedSets.length; seti++)
	{
		set = state.appliedSets[seti];
		if ('required' in set)
		{
			for (var mfname in set.required)
			{
				if (mfname in knownZoneModifiers)
				{
					continue;
				}
				var v = parseInt(set.required[mfname]);
				if (!(mfname in state.required) || (state.required[mfname] < v))
				{
					state.required[mfname] = v;
				}
			}
		}

		if ('modify' in set)
		{
			for (var mfname in set.modify)
			{
				if (mfname in knownZoneModifiers)
				{
					continue;
				}
				state.modify[mfname] += parseInt(set.modify[mfname]);
			}
		}
	}
	if (state.pet != null)
	{
		var pet = pets[state.pet.n];
		var pl = pet.levels['L' + state.pet.level];
		if ('skill' in pl)
		{
			if ('modify' in pl.skill)
			{
				for (var mfname in pl.skill.modify)
				{
					state.battlemf[mfname] = pl.skill.modify[mfname];
					state.modify[mfname] += pl.skill.modify[mfname];
				}
			}
		}
	}
	// preliminary results.
	for (var powerupn in state.spellPowerUps)
	{
		if (powerupn in knownPowerUps)
		{
			var powerup = knownPowerUps[powerupn];
			if (!powerup.damageup)
			{
				state.modify[powerup.element + 'magicdefence'] += state.spellPowerUps[powerupn];
			}
			else
			{
				state.modify[powerup.element + 'magicpower'] += state.spellPowerUps[powerupn];
			}
		}
		if (powerupn in knownECRPowerUps)
		{
			var epowerup = knownECRPowerUps[powerupn];
			if (!(epowerup.modify in knownZoneModifiers))
			{
				if (!(epowerup.modify in knownWeaponModifiersHash))
				{
					state.modify[epowerup.modify] += epowerup.v;
				}
			}
		}
	}
	calcResults(state);
	state.natural.criticalhit = state.natural.anticriticalhit = (state.results.intuition * 6);
	state.natural.jumpaway = state.natural.antijumpaway = (state.results.dexterity * 6);
	for (var delixn in state.damageElixes)
	{
		var delix = knownDamageElix[delixn];
		if (!('modify' in delix)) continue;
		if ('hitpoints' in delix.modify)
		{
			state.modify.hitpoints += delix.modify.hitpoints;
		}
	}
	for (var strgn in dressStrengthenings)
	{
		var strg = dressStrengthenings[strgn];
		if (dressOptions.newCapEdition)
		{
			if (strg.domain == 'ru') continue;
		}
		else
		{
			if (strg.domain == 'com') continue;
		}
		var strgOk = true;
		if ('required' in strg)
		{
			for (var mfname in strg.required)
			{
			    var rvmin = parseInt(strg.required[mfname]);
			    var rvmax = rvmin + 24;
			    if (strgn == 'spirituality50')
			    {
			        rvmax = 99;
			    }
			    if (dressOptions.newCapEdition)
			    {
			        rvmax = 10000;
			    }
				if (!(mfname in state.results) || (state.results[mfname] < rvmin) || ((rvmin < 125) && (state.results[mfname] > rvmax)))
				{
					strgOk = false;
					break;
				}
			}
			if (strgOk)
			{
				if ('zodiacs' in strg)
				{
					strgOk = false;
					var zv = parseInt(state.sign);
					if (!isNaN(zv) && (zv >= 1) && (zv <= 12))
					{
						for (var zn in strg.zodiacs)
						{
							var z = strg.zodiacs[zn];
							if (zv == parseInt(z.value))
							{
								strgOk = true;
								break;
							}
						}
					}
				}
			}
		}
		if (strgOk)
		{
			state.appliedStrengthenings.push(strg);
		}
	}
	for (propi = 0; propi < knownCleanModifiers.length; propi++)
	{
		var mfname = knownCleanModifiers[propi];
		if (mfname == '-')
		{
			continue;
		}
		var mfvalue = (mfname in state.modify) ? state.modify[mfname] : 0;
		for (var strgi = 0; strgi < state.appliedStrengthenings.length; strgi++)
		{
			var strg = state.appliedStrengthenings[strgi];
			if (('modify' in strg) && (mfname in strg.modify))
			{
				mfvalue += parseInt(strg.modify[mfname]);
			}
		}
		state.modify[mfname] = mfvalue;
	}
	if ((w10o != null) && w10o.slot == slot_w10.id)
	{
		if (('properties' in w10o) && ('shieldblock' in w10o.properties))
		{
			state.modify.shieldblock += w10o.properties.shieldblock;
		}
	}
	// final results
	/*if ('strength' in state.modify)
	{
		state.modify.knapsack = (state.modify.strength * 4);
	}
	if ('strength' in state.battlemf)
	{
		state.modify.knapsack -= (state.battlemf.strength * 4);
	}*/
	state.natural.consumed_reward = (10000 * state.natural.pskil);
	state.natural.consumed_reward += (2000 * state.natural.pstat) + (50 * (state.natural.pstat * (state.natural.pstat - 1)));
	state.modify.consumed_reward = 0;
	state.natural.totalstats = 0;
	state.modify.totalstats = 0;
	for (propi = 0; propi < knownStats.length; propi++)
	{
		var stname = knownStats[propi];
		state.natural.totalstats += state.natural[stname];
		state.modify.totalstats += state.modify[stname];
	}
	state.modify.totalprice = 0;
	state.modify.totaleprice = 0;
	state.modify.totalweight = 0;
	for (sloti = 0; sloti < slots.length; sloti++)
	{
		slot = slots[sloti];
		o = getObjectByStateSlot(state, slot);
		if (o == null || !('common' in o))
		{
			continue;
		}
		if ('price' in o.common)
		{
			state.modify.totalprice += o.common.price;
		}
		if ('eprice' in o.common)
		{
			state.modify.totaleprice += o.common.eprice;
		}
		if ('weight' in o.common)
		{
			state.modify.totalweight += o.common.weight;
		}
		else
		{
			state.modify.totalweight += 1;
		}
	}
	state.modify.totalprice = Math.floor(state.modify.totalprice * 100.0 + 0.5) / 100.0;
	state.modify.totaleprice = Math.floor(state.modify.totaleprice * 100.0 + 0.5) / 100.0;
	state.modify.totalweight = Math.floor(state.modify.totalweight * 100.0 + 0.5) / 100.0;
	var bothSkill = getWeaponSkillValue(state, slot_w3) + getWeaponSkillValue(state, slot_w10);
	//state.natural.parry = (bothSkill * 0.5);
	calcArmors(state);
	precalcZoneModifiers(state);
	for (var powerupn in state.spellPowerUps)
	{
		if (powerupn in knownECRPowerUps)
		{
    		var epowerup = knownECRPowerUps[powerupn];
    		if (epowerup.modify in knownZoneModifiers)
    		{
    			state.results[epowerup.modify].head += epowerup.v;
    			state.results[epowerup.modify].body += epowerup.v;
    			state.results[epowerup.modify].waist += epowerup.v;
    			state.results[epowerup.modify].leg += epowerup.v;
    			state.results[epowerup.modify].avg += epowerup.v;
    		}
		}
	}
	calcZoneModifiers(state);
	recalcSpellPowerUpState(state);
	for (var delixn in state.defElixes)
	{
		var delix = knownDefElix[delixn];
		var v = state.defElixes[delixn];
		applyDefElix(state, delix.makeUp, v);
		if ('makeUp2' in delix)
		{
			var v2 = getDefElixSecondValue(delix, v);
			applyDefElix(state, delix.makeUp2, v2);
		}
	}
	// updating magic skills from natural intellect
	for (var i = 0; i < allElements.length; i++)
	{
		var mfvalue= ((allElements[i]+'magicpower') in state.modify) ? state.modify[allElements[i] + 'magicpower'] : 0;
		if ('intellect' in state.modify)
  {
   mfvalue += state.modify.intellect*0.5;
   }
		state.modify[allElements[i]+'magicpower'] = mfvalue;
	}

	calcResults(state);
	applyCommonSkills(state);
	recalcDresserCombatSpellsState(state);
	recalcDresserCombatTricksState(state);
	calcResults(state);
	state.w3props = recalcDresserWeaponState(state, slot_w3);
	recalcDresserWeaponAdvState(state, slot_w3);
	if (w10o != null && w10o.slot == slot_w3.id)
	{
		state.w10props = recalcDresserWeaponState(state, slot_w10);
		recalcDresserWeaponAdvState(state, slot_w10);
	}
}

function showInfoPane(state)
{
	if (state == null)
	{
		state = activeState;
	}
	if (state == null)
	{
		return;
	}
	document.getElementById('infopane' + state.id).innerHTML = getDresserInfoPaneHtml(state);
}

// call when changes only in other cabs
function fastUpdateDresserState(state)
{
	if (state == null)
	{
		return;
	}
	recalcDresserState(state);
	showInfoPane(state);
	updateDresserNaturalEditors(state);
	showDressHint();
}

function updateDresserState(state)
{
	if (state == null)
	{
		state = activeState;
	}
	if (state == null)
	{
		return;
	}
	fastUpdateDresserState(state);
	setMeter(state, hpMeterSuffix, state.results.hitpoints);
	setMeter(state, manaMeterSuffix, ('mana' in state.results) ? state.results.mana : 0);
	var nickelt = document.getElementById('nick' + state.id);
	if (nickelt)
	{
		nickelt.innerHTML = getPersNickString(state);
	}
}

function hardUpdateDresserState(state)
{
	recalcDresserState(state);
	document.getElementById('cab_' + state.id).innerHTML = getDresserInnerHtml(state);
}

var updateDresserStateWantedTimer = null;

function updateDresserStateWanted()
{
	if (updateDresserStateWantedTimer != null)
	{
		clearTimeout(updateDresserStateWantedTimer);
		updateDresserStateWantedTimer = null;
	}
	updateDresserStateWantedTimer =  setTimeout("updateDresserState()", 300);
}


function preloadImages()
{
	informAboutProgress(localizer.startPreloadImages);
	var img = new Image(18, 16);
	if (!('artefact' in imagesToBeLoaded))
	{
		img.src = baseImgPath + 'artefact.gif';
		imagesToBeLoaded['artefact'] = img;
	}
	for (var catid in categories)
	{
		for (var j = 0; j < categories[catid].items.length; j++)
		{
			var item = categories[catid].items[j];
			var jsName = getJSName(item.id);
			if (!(jsName in imagesToBeLoaded))
			{
				img = new Image(item.width, item.height);
				img.src = itemImgPath + item.id + '.gif';
				imagesToBeLoaded[jsName] = img;
			}
		}
	}
	informAboutProgress(localizer.completePreloadImages);
}

var preloadImagesWantedTimer = null;

function preloadImagesWanted(state)
{
	if (preloadImagesWantedTimer != null)
	{
		clearTimeout(preloadImagesWantedTimer);
		preloadImagesWantedTimer = null;
	}
	preloadImagesWantedTimer =  setTimeout('preloadImages()', preloadImagesDelay);
}

function getSlotById(slotid)
{
	for (var i = 0; i < slots.length; i++)
	{
		if (slots[i].id == slotid)
		{
			return slots[i];
		}
	}
	return null;
}

function getSlotByIndex(sloti)
{
	for (var i = 0; i < slots.length; i++)
	{
		if (slots[i].index == sloti)
		{
			return slots[i];
		}
	}
	return null;
}

function getObjectIdOfSlot(state, slotid)
{
	return state.objects[getSlotById(slotid).index];
}

function hasTwohandledWeapon(state)
{
	var w3o = getObjectByStateSlot(state, slot_w3);
	return isTwohandledWeapon(w3o);
}

function DropAllScrolls(state)
{
for (var isScrollSlot = 100; isScrollSlot <= 109; isScrollSlot++)
	{
	setObjectForSlot(dressStates[state], 'w'+isScrollSlot, null);
	}

}

function setObjectForSlot(state, slotid, objid)
{
	var slot = getSlotById(slotid);
	if (state == null || slot == null)
	{
		return;
	}
	var oimg = (objid == null) ? slotid : objid;
	var o = getObjectById(objid);
	var realItemImgPath = getRealImagePath(objid, slot);
	// drop incompatible items.
	if (slotid == 'w10' && objid != null && hasTwohandledWeapon(state))
	{
		onObjectDrop(state.id, 'w3');
	}
	if (slotid == 'w3' && objid != null && isTwohandledWeapon(o))
	{
		onObjectDrop(state.id, 'w10');
	}
	// dresser is fully rebuilt and transition applied later.
	var imgElt = document.getElementById(state.id.toString() + slot.id);
	var needRebuild = (imgElt == null);
	if (slotid == 'w4')
	{
		// unfit armor if fitted before.
		state.fitArmor = false;
	}
	state.fitSlots[slot.index] = null;
	state.upgradeSlots[slot.index] = null;
	state.charmSlots[slot.index] = null;
	state.addSlots[slot.index] = null;
	state.runeSlots[slot.index] = null;
	if (slotid == 'w3')
	{
		state.w3sharp = 0;
	}
	if (slotid == 'w10')
	{
		state.w10sharp = 0;
	}
	state.objCache[slot.index] = null;
	if (needRebuild)
	{
		document.getElementById('cab_' + state.id).innerHTML = getDresserInnerHtml(state);
	}
	state.objects[slot.index] = objid;
	if ((o != null) && ('fakebase' in o))
	{
		state.upgradeSlots[slot.index] = objid + '_fake';
	}
	updateDresserSlot(state, slot);
}

function getFittedArmor(armorObject)
{
	var fittedArmor = cloneObject(armorObject);
	if (!('modify' in fittedArmor))
	{
		fittedArmor.modify = { hitpoints: 0 };
	}
	else if (!('hitpoints' in fittedArmor.modify))
	{
		fittedArmor.modify.hitpoints = 0;
	}
	var armorLevel = (('required' in fittedArmor) && ('level' in fittedArmor.required)) ? parseInt(fittedArmor.required.level) : 0;
	fittedArmor.modify.hitpoints += ((armorLevel + 1) * 6);
	fittedArmor.armorWasFit = true;
	fittedArmor.destiny = 'Броня подогнана под персонажа';
	return fittedArmor;
}

function getFittedObject(objectToFit, setIdToFit)
{
	var fittedObject = cloneObject(objectToFit);
	if (!('setlink' in fittedObject))
	{
		fittedObject.setlink = { name: setIdToFit };
	}
	else
	{
		fittedObject.setlink.name = setIdToFit;
	}
	fittedObject.wasFit = true;
    if ('common' in fittedObject)
    {
        var upgradePrice = 0;
        if ('eprice' in fittedObject.common)
        {
            upgradePrice = Math.floor(fittedObject.common.eprice * 20 + 0.5) / 100.0;
        }
        else if ('price' in fittedObject.common)
        {
            upgradePrice = Math.floor(fittedObject.common.price * 4 + 0.5) / 100.0;
        }
        if (upgradePrice > 0)
        {
            if ('eprice' in fittedObject.common)
            {
                fittedObject.common.eprice += upgradePrice;
            }
            else
            {
                fittedObject.common.eprice = upgradePrice;
            }
        }
    }
	return fittedObject;
}

function getCharmedObject(objectToCharm, modify)
{
	var charmedObject = cloneObject(objectToCharm);
	charmedObject.wasCharmed = true;
	charmedObject.charms = modify;
	if (!('modify' in charmedObject))
	{
		charmedObject.modify = {};
	}
	for (var mf in modify)
	{
		if (mf in charmedObject.modify)
		{
			charmedObject.modify[mf] = parseInt(charmedObject.modify[mf]) + modify[mf];
		}
		else
		{
			charmedObject.modify[mf] = modify[mf];
		}
	}
	return charmedObject;
}

function getAddObject(objectToCharm, modify)
{
	var charmedObject = cloneObject(objectToCharm);
	charmedObject.wasAdded = true;
	charmedObject.charms = modify;
	if (!('modify' in charmedObject))
	{
		charmedObject.modify = {};
	}
	for (var mf in modify)
	{
		if (mf in charmedObject.modify)
		{
			charmedObject.modify[mf] = parseInt(charmedObject.modify[mf]) + modify[mf];
		}
		else
		{
			charmedObject.modify[mf] = modify[mf];
		}
	}
	return charmedObject;
}

function getCharmedObject2(objectToCharm, charm)
{
	var modify = {};
	var ss = charm.split('#');
	for (var i = 0; i < ss.length; i += 2)
	{
		var v = parseInt(ss[i + 1]);
		if (!isNaN(v))
		{
			modify[ss[i]] = v;
		}
	}
	return getCharmedObject(objectToCharm, modify);
}

function getAddObject2(objectToCharm, charm)
{
	var modify = {};
	var ss = charm.split('#');
	for (var i = 0; i < ss.length; i += 2)
	{
		var v = parseInt(ss[i + 1]);
		if (!isNaN(v))
		{
			modify[ss[i]] = v;
		}
	}
	return getAddObject(objectToCharm, modify);
}

function getRunedObject(objectToRune, runeStr)
{
var appliedRune = '';
var appliedRuneOpt = '';

var ss = runeStr.split('#');
var v = parseInt(ss[1]);
if (!isNaN(v))
	{
	if (v < 1) { v = '0'; }
	appliedRune=ss[0];
	appliedRuneOpt=v;
	}

var runedObject = cloneObject(objectToRune);
if (!appliedRune) { return runedObject; }
var o=getObjectById(appliedRune);
if (!('opts' in o.modify)) { return runedObject; }
if (o.modify.opts[appliedRuneOpt] == null) { return runedObject; }

runedObject.wasRuned = true;
runedObject.rune = appliedRune;
runedObject.runeOpt = appliedRuneOpt;

if (!('modify' in runedObject))
	{
		runedObject.modify = {};
	}

var modify = o.modify.opts[appliedRuneOpt];

for (var mf in modify)
	{
		if (mf in runedObject.modify)
		{
			runedObject.modify[mf] = parseInt(runedObject.modify[mf]) + modify[mf];
		}
		else
		{
			runedObject.modify[mf] = modify[mf];
		}
	}
return runedObject;
}


function dropZeroInSection(o, sn)
{
	if (!(sn in o)) return o;
	for (var n in o[sn])
	{
		if (!isNaN(o[sn][n]) && o[sn][n] == 0) delete o[sn][n];
	}
	return o;
}



function getUpgradeObject(objectToUpgrade, upgradeIdToUpgrade)
{
	if (!('upgradecache' in objectToUpgrade))
	{
		objectToUpgrade.upgradecache = {};
	}
	if (!(upgradeIdToUpgrade in objectToUpgrade.upgradecache))
	{
		var upgradeObject = {};
		var upgrade = objectToUpgrade.upgrade[upgradeIdToUpgrade];
		if ('fake' in upgrade)
		{
			upgrade.category = objectToUpgrade.category;
			upgrade.slot = objectToUpgrade.slot;
			upgrade.width = objectToUpgrade.width;
			upgrade.height = objectToUpgrade.height;
			upgradeObject = cloneObject(upgrade);
		}
		else
		{
			upgradeObject = cloneObject(objectToUpgrade);
			upgradeObject = combineObjects(upgradeObject, upgrade);
			upgradeObject = dropZeroInSection(upgradeObject, 'modify');
			upgradeObject = dropZeroInSection(upgradeObject, 'properties');
			upgradeObject = dropZeroInSection(upgradeObject, 'required');
		}
		upgradeObject.caption = getUpgradeCaption(objectToUpgrade, upgrade);
		if ('price' in upgrade)
		{
			if (!('common' in upgradeObject))
			{
				upgradeObject.common = { eprice: 0 };
			}
			var oprice = ('eprice' in objectToUpgrade.common) ? objectToUpgrade.common.eprice : 0;
			if ('level' in upgrade)
			{
				for (var oun in objectToUpgrade.upgrade)
				{
					var ou = objectToUpgrade.upgrade[oun];
					var al = ('level' in ou) ? ou.level : 0;
					if ((al < upgrade.level) && ('price' in ou))
					{
						oprice += ou.price;
					}
				}
			}
			oprice += upgrade.price;
			upgradeObject.common.eprice = oprice;
		}
		upgradeObject.wasUpgrade = true;
		objectToUpgrade.upgradecache[upgradeIdToUpgrade] = upgradeObject;
	}
	return objectToUpgrade.upgradecache[upgradeIdToUpgrade];
}

var sharpStatValues = {
	strength: 0,
	dexterity: 0,
	intuition: 0,
	endurance: 0,
	intellect: 0,
	wisdom: 0
	};
var sharpStatsPriority = {
	strength: 10,
	dexterity: 8,
	intuition: 6,
	endurance: 4,
	intellect: 2,
	wisdom: 1
	};
var sharpStats = [];

function compareSharpStats(x, y)
{
	var r = sharpStatValues[x] - sharpStatValues[y];
	if (r == 0)
	{
		r = sharpStatsPriority[x] - sharpStatsPriority[y];
	}
	return r;
}

function getSharpenWeapon(weaponObject, sharp)
{
	if (sharp == 0 || weaponObject == null)
	{
		return weaponObject;
	}

	if (parseInt(sharp) == 11 || parseInt(sharp) == 8 || parseInt(sharp) == 6 || parseInt(sharp) == 9) { sharp=100+parseInt(sharp); }
	var oldmode=1;
	if (sharp > 100) { sharp-=100; oldmode = 0; }
	var sharpenWeapon = cloneObject(weaponObject);

	// drop sharpening for non-lv10 arts
	//if (('artefact' in sharpenWeapon) && (oldmode != 1))
	//	{
	//	if ('required' in sharpenWeapon)
	//		{
	//		if ('level' in sharpenWeapon.required)
	//			{
	//			if (sharpenWeapon.required.level < 10 ) { return weaponObject; }
	//			}
	//		}
	//	}

	var swcat = categories[sharpenWeapon.category];
	var skillname = null;
	if ('required' in sharpenWeapon)
	{
		for (var i = 0; i < knownWeaponSkills.length; i++)
		{
			if (knownWeaponSkills[i] in sharpenWeapon.required)
			{
				skillname = knownWeaponSkills[i];
				break;
			}
		}
	}
	if (skillname == null && ('skillname' in swcat))
	{
		skillname = swcat.skillname;
	}
	var increaseReq = (skillname != null);
	if (increaseReq && ('required' in weaponObject))
	{
		if ('multiplier' in weaponObject.required)
		{
			increaseReq = (weaponObject.required.multiplier != 0);
		}
	}

	if (oldmode != 1) { increaseReq = false; }
	if (increaseReq)
	{
		if (!('required' in sharpenWeapon))
		{
			sharpenWeapon.required = { strength: sharp, dexterity: sharp };
		}
		else
		{
			sharpStatValues = {
				strength: ('strength' in sharpenWeapon.required) ? sharpenWeapon.required.strength : 0,
				dexterity: ('dexterity' in sharpenWeapon.required) ? sharpenWeapon.required.dexterity : 0,
				intuition: ('intuition' in sharpenWeapon.required) ? sharpenWeapon.required.intuition : 0,
				endurance: ('endurance' in sharpenWeapon.required) ? sharpenWeapon.required.endurance : 0,
				intellect: ('intellect' in sharpenWeapon.required) ? sharpenWeapon.required.intellect : 0,
				wisdom: ('wisdom' in sharpenWeapon.required) ? sharpenWeapon.required.wisdom : 0
			};
			sharpStats = new Array('strength', 'dexterity', 'intuition', 'endurance', 'intellect', 'wisdom');
			sharpStats.sort(compareSharpStats);
			sharpStats.reverse();
			sharpenWeapon.required[sharpStats[0]] = sharpStatValues[sharpStats[0]] + sharp;
			sharpenWeapon.required[sharpStats[1]] = sharpStatValues[sharpStats[1]] + sharp;
		}
		if (skillname != 'staffskill')
		{
			var skillv = (skillname in sharpenWeapon.required) ? sharpenWeapon.required[skillname] : 0;
			skillv += sharp;
			sharpenWeapon.required[skillname] = skillv;
		}
	}
	if (!('common' in sharpenWeapon))
	{
		sharpenWeapon.common = { price: 0 };
	}
	else
	{
		if (!('price' in sharpenWeapon.common))
		{
			sharpenWeapon.common.price = 0;
		}
	}

	if (oldmode != 1)
		{
		if (!('required' in sharpenWeapon))
			{
			sharpenWeapon.required = { level: 0 };
			}
			else
				{
				if (!('level' in sharpenWeapon.required))
					{
					sharpenWeapon.required.level=0;
					}
				}
		if (sharpenWeapon.required.level < minSharpLevels[sharp]) { sharpenWeapon.required.level = minSharpLevels[sharp]; }
		}

	if (oldmode==1)
		{
		if (sharp < 7)
			{
			sharpenWeapon.common.price += 10 * Math.pow(2, sharp);
			}
			else
				{
				sharpenWeapon.common.price += (1000 * (sharp - 6));
				}
		}
		else
			{
			if ('properties' in sharpenWeapon)
				{
				if ('twohandled' in sharpenWeapon.properties)
					{ sharpenWeapon.common.price += dblSharpPrices[sharp]; }
					else { sharpenWeapon.common.price += regSharpPrices[sharp]; }
				}
				else { sharpenWeapon.common.price += regSharpPrices[sharp]; }
			}

	var generalSharp=1;
	if ('category' in sharpenWeapon)
		{
		if (sharpenWeapon.category == 'staffs') { generalSharp=0; }
		}

	if (generalSharp==1)
		{
		if (!('properties' in sharpenWeapon))
			{
				sharpenWeapon.properties = { mindamage: 0, maxdamage: 0 };
			}
			else
				{
					if (!('mindamage' in sharpenWeapon.properties))
					{
					sharpenWeapon.properties.mindamage = 0;
					}
					if (!('maxdamage' in sharpenWeapon.properties))
					{
					sharpenWeapon.properties.maxdamage = sharpenWeapon.properties.mindamage;
					}
				}
			if ('properties' in sharpenWeapon)
				{
				if (('twohandled' in sharpenWeapon.properties) && (oldmode != 1))
					{
					sharpenWeapon.properties.mindamage += 2*sharp;
					sharpenWeapon.properties.maxdamage += 2*sharp;
					}
					else
						{
						sharpenWeapon.properties.mindamage += sharp;
						sharpenWeapon.properties.maxdamage += sharp;
						}
				}
		}
		else
			{
				if (!('modify' in sharpenWeapon))
				{
					sharpenWeapon.modify = { magicpower: 0 };
				}
				else
				{
					if (!('magicpower' in sharpenWeapon.modify))
					{
					sharpenWeapon.modify.magicpower = 0;
					}
				}
				if (oldmode != 1) { sharpenWeapon.modify.magicpower += sharp*2; }
					else { sharpenWeapon.modify.magicpower += sharp; }
			}

	if (oldmode==1) { sharpenWeapon.caption += ' +' + sharp + '[old]'; }
		else { sharpenWeapon.caption += ' +' + sharp; }

	if ((sharp > 5 && oldmode == 1) || (oldmode != 1))
	{
	    sharpenWeapon.destiny = 'Связано судьбой с персонажем, заточившим это оружие';
	}
	return sharpenWeapon;
}

function onObjectDrop(stateId, slotid)
{
	setObjectForSlot(dressStates[stateId], slotid, null);
}

function onDropAll()
{
	var state = activeState;
	applyCleanItemsToState(state);
	hardUpdateDresserState(state);
}

function onClearAllStats(stateId)
{
	var state = dressStates[stateId];
	clearAllStats(state);
	updateDresserState(state);
}

function updateDresserSlot(state, slot)
{
	state.objCache[slot.index] = null;
	var o = getObjectById(state.objects[slot.index]);
	var oimg = (o == null) ? slot.id : o.id;
	var realItemImgPath = getRealImagePath(o != null ? o.id : null, slot);
	var imgElt = document.getElementById(state.id.toString() + slot.id);
	if (imgElt != null)
	{
		if (dressOptions.useTransitionEffects)
		{
			imgElt.filters['revealtrans'].apply();
		}
		imgElt.name = 'x' + oimg;
		imgElt.src = format('{0}{1}.gif', realItemImgPath, oimg);
		o = getObjectByStateSlot(state, slot);
		var newFilter = getRealFilter(getObjectFilter(state, slot, o));
		if (is.ie && newFilter != imgElt.style.filter)
		{
			imgElt.style.filter = newFilter;
		}
		if (dressOptions.useTransitionEffects)
		{
			imgElt.filters['revealtrans'].play();
		}
	}
	updateDresserStateWanted();
}

function onFitArmor(stateId, fit)
{
	var state = dressStates[stateId];
	state.fitArmor = fit;
	updateDresserSlot(state, slot_w4);
}

function onUnfitObject(stateId, slotId)
{
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	state.fitSlots[slot.index] = null;
	updateDresserSlot(state, slot);
}

function onFitObject(stateId, slotId, setId)
{
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	if (state == null || slot == null)
	{
		return;
	}
	if (setId != null)
	{
		state.fitSlots[slot.index] = setId;
		updateDresserSlot(state, slot);
	}
	else
	{
		var menuHtml  ='<table width="260px" border="0">';
		var o = getObjectByStateSlot(state, slot);
		if (('wasFit' in o) && o.wasFit)
		{
			menuHtml += getRowMenuItemHtml(localizer.unfitObject, format("onUnfitObject('{0}', '{1}')", state.id, slot.id));
		}
		if ('setlinks' in o)
		{
			for (var seti = 1; seti < o.setlinks.length; seti++) // skip first
			{
				var set = dressSets[o.setlinks[seti]];
				var sethtml = set.caption;
				menuHtml += getRowMenuItemHtml(sethtml, format("onFitObject('{0}', '{1}', '{2}')", state.id, slot.id, set.id));
			}
		}
		else
		{
			for (var setn in dressSets)
			{
				var set = dressSets[setn];
				if (('noadjust' in set) && set.noadjust)
				{
					continue;
				}
				if (('virtual' in set) && set.virtual)
				{
					continue;
				}
				if (getSetItemsForSlot(set, slot).length > 0)
				{
					var sethtml = set.caption;
					menuHtml += getRowMenuItemHtml(sethtml, format("onFitObject('{0}', '{1}', '{2}')", state.id, slot.id, set.id));
				}
			}
		}
		menuHtml += getRowMenuSeparatorHtml();
		menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
		menuHtml += '</table>';
		showMenu(menuHtml);
	}
}

function getUpgradeCaption(o, upgrade)
{
	var caption = o.caption;
	if ('caption' in upgrade)
	{
		caption = upgrade.caption;
	}
	if (('old' in upgrade) && upgrade.old)
	{
		caption = caption + '&nbsp;[old]';
	}
	if ('level' in upgrade)
	{
		caption = caption + '&nbsp;[' + upgrade.level + ']';
	}
	if ('fake' in upgrade)
	{
		caption = caption + '&nbsp;[конструктор]';
	}
	return caption;
}

function onUpgradeObject(stateId, slotId, upgradeId)
{
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	if (state == null || slot == null)
	{
		return;
	}
	if (upgradeId != '')
	{
		state.upgradeSlots[slot.index] = upgradeId;
		updateDresserSlot(state, slot);
	}
	else
	{
		var menuHtml  ='<table width="260px" border="0">';
		var o = getObjectById(state.objects[slot.index]);
		menuHtml += getRowMenuItemHtml(localizer.noUpgrade, format("onUpgradeObject('{0}', '{1}', null)", state.id, slot.id));
		for (var upgraden in o.upgrade)
		{
			var upgrade = o.upgrade[upgraden];
			menuHtml += getRowMenuItemHtml(getUpgradeCaption(o, upgrade), format("onUpgradeObject('{0}', '{1}', '{2}')", state.id, slot.id, upgrade.id));
		}
		menuHtml += getRowMenuSeparatorHtml();
		menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
		menuHtml += '</table>';
		showMenu(menuHtml);
	}
}

function onCharmObject(stateId, slotId)
{
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	if (state == null || slot == null)
	{
		return;
	}
	showMenu(getCharmChooserHtml(slot.index), false);
}

function onaddStats(stateId, slotId,numb)
{
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	onUnaddStats(stateId, slotId);
	if (state == null || slot == null)
	{
		return;
	}
	showMenu(getASChooserHtml(slot.index,numb), false);
}

function doCharm(sloti)
{
	var state = activeState;
	var slot = getSlotByIndex(sloti);
	hideMenu();
	if (state == null || slot == null)
	{
		return;
	}
	var charm_mf_name = document.getElementById('charm_mf_name').value;
	var charm_mf_value = document.getElementById('charm_mf_value').value;
	var charm_mf_replace = document.getElementById('charm_mf_replace').checked;
	if (!(charm_mf_name in item_props) || isNaN(charm_mf_value) || parseInt(charm_mf_value) == 0)
	{
		return;
	}
	var v = charm_mf_name + '#' + parseInt(charm_mf_value);
	if (state.charmSlots[slot.index] != null && !charm_mf_replace)
	{
		v += '#' + state.charmSlots[slot.index];
	}
	state.charmSlots[slot.index] = v;
	updateDresserSlot(state, slot);
}

function doAddStats(sloti)
{
	var state = activeState;
	var slot = getSlotByIndex(sloti);
	var statt = new Array('strength','dexterity','intuition','endurance','intellect','wisdom');
	hideMenu();
	if (state == null || slot == null)
	{
		return;
	}
	var stat_add_strength = document.getElementById('add_strength').value;
	var stat_add_dexterity = document.getElementById('add_dexterity').value;
	var stat_add_intuition = document.getElementById('add_intuition').value;
	var stat_add_wisdom = document.getElementById('add_wisdom').value;
	var stat_add_endurance = document.getElementById('add_endurance').value;
	var stat_add_intellect = document.getElementById('add_intellect').value;
	for (i=0;i<statt.length;i++)
	{
     charm_mf_name = statt[i];
     charm_mf_value = eval("stat_add_"+statt[i]);
    if (charm_mf_value != 0){
	if (!(charm_mf_name in item_props) || isNaN(charm_mf_value))
	{
		return;
	}
	var v = charm_mf_name + '#' + parseInt(charm_mf_value);
	if (state.addSlots[slot.index] != null)
	{
		v += '#' + state.addSlots[slot.index];
	}

	state.addSlots[slot.index] = v;
	updateDresserSlot(state, slot);
	}
    }
}

function doPredefinedCharm(sloti, v)
{
	var state = activeState;
	var slot = getSlotByIndex(sloti);
	hideMenu();
	if (state == null || slot == null)
	{
		return;
	}
	var charm_mf_replace = document.getElementById('charm_mf_replace').checked;
	if (state.charmSlots[slot.index] != null && !charm_mf_replace)
	{
		v += '#' + state.charmSlots[slot.index];
	}
	state.charmSlots[slot.index] = v;
	updateDresserSlot(state, slot);
}

function onUncharmObject(stateId, slotId)
{
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	if (state == null || slot == null)
	{
		return;
	}
	state.charmSlots[slot.index] = null;
	updateDresserSlot(state, slot);
}
function onUnaddStats(stateId, slotId)
{
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	if (state == null || slot == null)
	{
		return;
	}
	state.addSlots[slot.index] = null;
	updateDresserSlot(state, slot);
}

function onUnRuneObject(stateId, slotId)
{
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	if (state == null || slot == null)
	{
		return;
	}
	state.runeSlots[slot.index] = null;
	updateDresserSlot(state, slot);
}

function onSharpWeapon(stateId, slotId, sharp)
{
	if (parseInt(sharp) == 11 || parseInt(sharp) == 8 || parseInt(sharp) == 6 || parseInt(sharp) == 9) { sharp=100+parseInt(sharp); }
	var state = dressStates[stateId];
	var slot = getSlotById(slotId);
	if (state == null || slot == null)
	{
		return;
	}
	if (slot.id == 'w3')
	{
		state.w3sharp = parseInt(sharp);
	}
	if (slot.id == 'w10')
	{
		state.w10sharp = parseInt(sharp);
	}
	updateDresserSlot(state, slot);
}

function getSetItemsForSlot(set, slot)
{
	var setid = set.id;
	var r = [];
	for (var catid in categories)
	{
		var cat = categories[catid];
		if (cat.slot != slot.id)
		{
			continue;
		}
		for (var itemIndex = 0; itemIndex < cat.items.length; itemIndex++)
		{
			var item = cat.items[itemIndex];
			if ('baseitem' in item)
			{
				continue;
			}
			if (('setlink' in item) && (item.setlink.name == setid))
			{
				r.push(item);
			}
		}
	}
	return r;
}

function getObjectsCountOfVariant(v)
{
	var r = 0;
	for (var i = 0; i < v.length; i++)
	{
		if (v[i] != null)
		{
			r++;
		}
	}
	return r;
}

function pushVariantIfNotExists(r, v)
{
	var nv = v.concat([]);
	// exclude w10 if w3 twohandled
	var w3o = nv[slot_w3.index];
	var w10o = nv[slot_w10.index];
	if ((w10o != null) && isTwohandledWeapon(w3o))
	{
		nv[slot_w10.index] = null;
		w10o = null;
	}

	for (var i = 0; i < r.length; i++)
	{
		var different = false;
		for (var j = 0; j < r[i].length; j++)
		{
			if (r[i][j] != nv[j])
			{
				different = true;
				break;
			}
		}
		if (!different)
		{
			return;
		}
	}
	r.push(nv);
}

function getCaptionOfVariant(v, variants)
{
	var cap = localizer.setEtc;
	for (var i = slots.length - 1; i >= 0; i--)
	{
		var slot = slots[i];
		if (v[slot.index] != null)
		{
			if (variants[slot.index].length > 1)
			{
				cap = v[slot.index].caption + ' + ' + cap;
			}
		}
	}
	return cap;
}

function getSetVariant(set, slotIndexes)
{
	var v = new Array(slots.length);
	var sv = getSetVariants(set);
	for (var sloti = 0; sloti < slots.length; sloti++)
	{
		var slot = slots[sloti];
		if (slotIndexes[sloti] != null && slotIndexes[sloti] < sv[slot.index].length)
		{
			v[slot.index] = sv[slot.index][slotIndexes[sloti]];
		}
	}
	return v;
}

function pushPopulatedSetVariantsR(r, set, slotIndexes, currentIndex)
{
	if (currentIndex >= slots.length)
	{
		return;
	}
	var slot = slots[currentIndex];
	var sv = getSetVariants(set);
	if (sv[slot.index].length == 0)
	{
		pushPopulatedSetVariantsR(r, set, slotIndexes, currentIndex + 1);
	}
	else
	{
		for (slotIndexes[currentIndex] = 0; slotIndexes[currentIndex] < sv[slot.index].length; slotIndexes[currentIndex] += 1)
		{
			pushPopulatedSetVariantsR(r, set, slotIndexes, currentIndex + 1);
			var v = getSetVariant(set, slotIndexes);
			if (getObjectsCountOfVariant(v) >= set.count)
			{
				pushVariantIfNotExists(r, v);
			}
		}
	}
}

function getPopulatedSetVariants(set)
{
	if ('pvariants' in set)
	{
		return set.pvariants;
	}
	showMenu(localizer.pleaseWait);
	var r = [];
	var slotIndexes = new Array(slots.length);
	pushPopulatedSetVariantsR(r, set, slotIndexes, 0);
	set.pvariants = r;
	hideMenu();
	return r;
}

function compareSets(x, y)
{
	if (x == y)
	{
		return 0;
	}
	if (x == null)
	{
		return -1;
	}
	if (y == null)
	{
		return 1;
	}
	var xlvl = (('required' in x) && ('level' in x.required)) ? parseInt(x.required.level) : 0;
	var ylvl = (('required' in y) && ('level' in y.required)) ? parseInt(y.required.level) : 0;
	if (xlvl != ylvl)
	{
		return (xlvl - ylvl);
	}
	if (x.caption != y.caption)
	{
		return (x.caption < y.caption) ? -1 : 1;
	}
	return 0;
}

function onDressAnyCombatsSet()
{
	cursorX -= 400;
	if ('dressAnyCombatsSet' in menuhash)
	{
		showMenu(menuhash.dressAnyCombatsSet);
		return;
	}
	var menuHtml  ='<table width="780" cellspacing="0" cellpadding="0" border="0">';
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var usets8 = [];
	var usets9 = [];
	var usets10 = [];
	var isets = [];
	var vsets = [];

	for (var setn in dressSets)
	{
		var set = dressSets[setn];
		if (('virtual' in set) && set.virtual)
		{
			vsets.push(set);
		}
		else
		{
			if (('imp1' in set) && set.imp1)
			{
				isets.push(set);
			}
			else
			{
				if (set.required.level <= 8) { usets8.push(set); }
				if (set.required.level == 9) { usets9.push(set); }
				if (set.required.level > 9) { usets10.push(set); }
			}
		}
	}
	usets8.sort(compareSets);
	usets9.sort(compareSets);
	usets10.sort(compareSets);
	isets.sort(compareSets);
	vsets.sort(compareSets);
	menuHtml += '<tr><td valign="top"><table width="260" cellspacing="0" cellpadding="0" border="0">';
	for (var setn in usets8)
	{
		var set = usets8[setn];
		var sethtml = set.caption;
		menuHtml += getRowMenuItemHtml(sethtml, format("onDressCombatsSet('{0}')", set.id));
	}
	menuHtml += getRowMenuSeparatorHtml();
	for (var setn in isets)
	{
		var set = isets[setn];
		var sethtml = set.caption;
		menuHtml += getRowMenuItemHtml(sethtml, format("onDressCombatsSet('{0}')", set.id));
	}
	menuHtml += '</table></td><td valign="top"><table width="260" cellspacing="0" cellpadding="0" border="0">';
	for (var setn in usets9)
	{
		var set = usets9[setn];
		var sethtml = set.caption;
		menuHtml += getRowMenuItemHtml(sethtml, format("onDressCombatsSet('{0}')", set.id));
	}
	menuHtml += '</table></td><td valign="top"><table width="260" cellspacing="0" cellpadding="0" border="0">';
	for (var setn in usets10)
	{
		var set = usets10[setn];
		var sethtml = set.caption;
		menuHtml += getRowMenuItemHtml(sethtml, format("onDressCombatsSet('{0}')", set.id));
	}
	menuHtml += getRowMenuSeparatorHtml();
	for (var setn in vsets)
	{
		var set = vsets[setn];
		var sethtml = set.caption;
		menuHtml += getRowMenuItemHtml(sethtml, format("onDressCombatsSet('{0}')", set.id));
	}
	menuHtml += '</table></td></tr>';
	menuHtml += '<tr><td colspan="3"><table width="780" cellspacing="0" cellpadding="0" border="0">';
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table></td></tr></table>';
	menuhash.dressAnyCombatsSet = menuHtml;
	showMenu(menuHtml);
}

function dressSetVariant(state, setVariant)
{
	for (var i = slots.length - 1; i >= 0; i--)
	{
		var slot = slots[i];
		if (setVariant[slot.index] != null)
		{
			setObjectForSlot(state, slot.id, setVariant[slot.index].id);
		}
	}
}

function onDressCombatsSet(setId, setVariantIndex)
{
	if (setId.indexOf("10") == -1)
		 {
		 var VsetId=setId;
		 var addtl="";
		 }
		else
			{
			var LastPos=setId.indexOf("10");
			var VsetId=setId.substr(0, LastPos);
			var addtl=" [10]";
		 	}
	var state = activeState;
	var set = getSetById(VsetId);
	if (state == null || set == null)
	{
		return;
	}
	var variants = getPopulatedSetVariants(set);
	if (variants.length == 0)
	{
		return;
	}
	if (setVariantIndex == null && variants.length == 1)
	{
		dressSetVariant(state, variants[0]);
		// insert upgrade function here
		if (setId.indexOf("10") != -1) { UpgradeSet(state, setId); }
		return;
	}
	if (setVariantIndex != null)
	{
		dressSetVariant(state, variants[parseInt(setVariantIndex)]);
		// insert upgrade function here
		if (setId.indexOf("10") != -1) { UpgradeSet(state, setId); }
		return;
	}
	var menuHtml  ='<table width="360px" border="0">';
	menuHtml += set.caption.bold() + addtl.bold() +'<br /><center>';
	for (var vi = 0; vi < variants.length; vi++)
	{
		var v = variants[vi];
		menuHtml += getRowMenuItemHtml(getCaptionOfVariant(v, getSetVariants(set)), format("onDressCombatsSet('{0}', {1})", setId, vi));
	}
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table>';
	showMenu(menuHtml);
}

function UpgradeSet(state, setId)
{
var batslots=new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,19);
for (i=0; i<batslots.length; i++)
	{
	var slotId='w'+batslots[i];
	var slot = getSlotById(slotId);
	var o = getObjectById(state.objects[slot.index]);
	if ((o != null) && ('upgrade' in o))
	{
	for (var upgraden in o.upgrade)
		{
		var upgrade = o.upgrade[upgraden];
		if ('setlink' in upgrade && upgrade.setlink.name == setId)
			{
			onUpgradeObject(state.id, slot.id, upgrade.id);
			}
		}
	}
	}
}

function itemCompare(x, y)
{
	if (x == y)
	{
		return 0;
	}
	if (x == null)
	{
		return -1;
	}
	if (y == null)
	{
		return 1;
	}
	var xeprice = !(('imp1' in x) && x.imp1) && (('common' in x) && ('eprice' in x.common)) ? parseInt(x.common.eprice) : 0;
	var yeprice = !(('imp1' in y) && y.imp1) && (('common' in y) && ('eprice' in y.common)) ? parseInt(y.common.eprice) : 0;
	if (xeprice != yeprice)
	{
		return (xeprice - yeprice);
	}

	var xlvl = (('required' in x) && ('level' in x.required)) ? parseInt(x.required.level) : 0;
	var ylvl = (('required' in y) && ('level' in y.required)) ? parseInt(y.required.level) : 0;
	if (xlvl != ylvl)
	{
		return (xlvl - ylvl);
	}

	var xprice = (('common' in x) && ('price' in x.common)) ? parseInt(x.common.price) : 0;
	var yprice = (('common' in y) && ('price' in y.common)) ? parseInt(y.common.price) : 0;
	if (xprice != yprice)
	{
		return (xprice - yprice);
	}
	if (x.caption != y.caption)
	{
		return (x.caption < y.caption) ? -1 : 1;
	}
	return 0;
}

function getFilteredItems(items)
{
	var r = [];
	var prop = null;
	if (dressOptions.ffiltermf != null)
	{
		var propIndex = dressOptions.ffiltermf;
		var propList = item_props;
		for (mfn in propList)
		{
			propIndex--;
			if (propIndex == 0)
			{
				prop = mfn;
				break;
			}
		}
	}
	for (var i = 0; i < items.length; i++)
	{
		var itm = items[i];
		if (itm == null)
		{
			continue;
		}
		// exclude items that interpreted as upgrades.
		if ('baseitem' in itm)
		{
			continue;
		}
		// exclude old items
		if (!dressOptions.fshowold && ('old' in itm) && itm.old)
		{
			continue;
		}
		if (!dressOptions.fshow_com && ('imp1' in itm) && itm.imp1 && !('artefact' in itm))
		{
			continue;
		}
		if (!dressOptions.fshow_ru && (!(('imp1' in itm) && itm.imp1)) && !('artefact' in itm))
		{
			continue;
		}
		if (!dressOptions.fshow_artefacts && ('artefact' in itm) && itm.artefact)
		{
			continue;
		}
		if (dressOptions.frewardonly)
		{
			if (!('requireditems' in itm)) continue;
			if (!(('s_luka' in itm.requireditems) || ('luka' in itm.requireditems))) continue;
		}
		var itemLevel1 = ('required' in itm) && ('level' in itm.required) ? parseInt(itm.required.level) : null;
		var itemLevel2 = itemLevel1;
		if ('upgrade' in itm)
		{
			for (var upn in itm.upgrade)
			{
				var u = itm.upgrade[upn];
				var itemLevelUp = ('required' in u) && ('level' in u.required) ? parseInt(u.required.level) : null;
				if (itemLevelUp == null) continue;
				if (itemLevel1 > itemLevelUp) itemLevel1 = itemLevelUp;
				if (itemLevel2 < itemLevelUp) itemLevel2 = itemLevelUp;
			}
		}
		if (itemLevel1 != null)
		{
			if (dressOptions.fmaxlevel != null)
			{
				if (itemLevel1 > dressOptions.fmaxlevel)
				{
					continue;
				}
			}
		}
		if (dressOptions.fminlevel != null)
		{
			if ((itemLevel2 == null) || itemLevel2 < dressOptions.fminlevel)
			{
				continue;
			}
		}
		if (prop != null)
		{
			var propFound = ('modify'in itm) && (prop in itm.modify) && (itm.modify[prop] > 0);
			if (!propFound) propFound = ('properties'in itm) && (prop in itm.properties) && (itm.properties[prop] > 0);
			if (!propFound)
			{
				continue;
			}
		}
		r.push(items[i]);
	}
	r.sort(itemCompare);
	return r;
}

function enableCategoryItems()
{
	var filterWindow = document.getElementById('filterWindow');
	var itemsView = document.getElementById('itemsView');
	if (filterWindow == null)
	{
		return;
	}
	filterWindow.innerHTML = '';
	filterWindow.style.visibility = 'hidden';
	if (is.ie && itemsView.filters)
	{
		itemsView.filters[0].Enabled = false;
		itemsView.filters[1].Enabled = false;
	}
	else
	{
		itemsView.style.backgroundColor = '';
	}
	reshowMenu();
}

function applyFilter2()
{
	applyFilter3();
	enableCategoryItems();
}

function applyFilter3()
{
	var filterWindow = document.getElementById('filterWindow');
	storeFilterDialog();
	filterDialogProps.fminlevel = parseInt(filterDialogProps.fminlevel);
	filterDialogProps.fmaxlevel = parseInt(filterDialogProps.fmaxlevel);
	if (isNaN(filterDialogProps.fminlevel) || (filterDialogProps.fminlevel < 0) || (filterDialogProps.fminlevel > 21))
	{
		filterDialogProps.fminlevel = null;
	}
	if (isNaN(filterDialogProps.fmaxlevel) || (filterDialogProps.fmaxlevel < 0) || (filterDialogProps.fmaxlevel > 21))
	{
		filterDialogProps.fmaxlevel = null;
	}
	if ((filterDialogProps.fminlevel != null) && (filterDialogProps.fmaxlevel != null) && (filterDialogProps.fmaxlevel < filterDialogProps.fminlevel))
	{
		var tempv = filterDialogProps.fminlevel;
		filterDialogProps.fminlevel = filterDialogProps.fmaxlevel;
		filterDialogProps.fmaxlevel = tempv;
	}
	if (isNaN(filterDialogProps.ffiltermf) || (filterDialogProps.ffiltermf == 0))
	{
		filterDialogProps.ffiltermf = null;
	}
	filterWindow.innerHTML = '';
	dressOptions.fminlevel = filterDialogProps.fminlevel;
	dressOptions.fmaxlevel = filterDialogProps.fmaxlevel;
	dressOptions.fshowold = filterDialogProps.fshowold;
	dressOptions.fshow_com = filterDialogProps.fshow_com;
	dressOptions.fshow_ru = filterDialogProps.fshow_ru;
	dressOptions.fshow_artefacts = filterDialogProps.fshow_artefacts;
	dressOptions.ffiltermf = filterDialogProps.ffiltermf;
	dressOptions.frewardonly = filterDialogProps.frewardonly;
	setupFilterFialog();
	applyItemsToCategoryView();
	showCurrentFilter();
	saveOptions();
}

function onSetInlineFilter()
{
	var filterWindow = document.getElementById('filterWindow');
	var itemsView = document.getElementById('itemsView');
	if (filterWindow == null)
	{
		return;
	}
	if (is.ie && itemsView.filters)
	{
		itemsView.filters[0].Enabled = true;
		itemsView.filters[1].Enabled = true;
	}
	else
	{
		itemsView.style.backgroundColor = '#E2E0E0';
	}
	showCurrentFilter();
	filterWindow.style.visibility = 'visible';
	reshowMenu(false);
}

function getFilterHash()
{
	var r = 'hash.';
	r += dressOptions.fminlevel;
	r += '.';
	r += dressOptions.fmaxlevel;
	r += '.';
	r += dressOptions.fshowold;
	r += '.';
	r += dressOptions.fshow_com;
	r += '.';
	r += dressOptions.fshow_ru;
	r += '.';
	r += dressOptions.fshow_artefacts;
	r += '.';
	r += dressOptions.ffiltermf;
	r += '.';
	r += dressOptions.frewardonly;
	return r;
}

function onResetInlineFilter()
{
	var filterWindow = document.getElementById('filterWindow');
	filterWindow.innerHTML = '';
	dressOptions.fminlevel = null;
	dressOptions.fmaxlevel = null;
	dressOptions.fshowold = false;
	dressOptions.fshow_com = true;
	dressOptions.fshow_ru = true;
	dressOptions.fshow_artefacts = true;
	dressOptions.ffiltermf = null;
	dressOptions.frewardonly = false;
	setupFilterFialog();
	applyItemsToCategoryView();
	enableCategoryItems();
	saveOptions();
}

function getDresserFilterTabHtml(tabText, tabFunc, on)
{
	var html = '';
	var classn = on ? 'activeLink' : 'usualLink';
	var onclick = on ? '' : (' onclick="' + tabFunc + '"');
	html += format('<li class="{0}"><a href="javascript:;"{1}>{2}</li>', classn, onclick, tabText);
	return html;
}

function getDresserFilterTabsHtml(tabIndex)
{
	var windowWidth = (8 * 60) - 8;
	var html = '';
	html += '<div class="dtab"><ul class="dtab">';
	html += getDresserInfoPaneTabHtml(localizer.filterGeneralTab, 'showCommonFilter()', (tabIndex == 0));
	html += getDresserInfoPaneTabHtml(localizer.filterMfTab, 'showMfFilter()', (tabIndex == 1));
//	html += getDresserInfoPaneTabHtml(localizer.filterSortTab, 'showItemSort()', (tabIndex == 2));
	html += '</ul></div>';
	return html;
}

function getFilterHeaderHtml()
{
	var windowWidth = (8 * 60) - 8;
	var html = '';
	html += '<div style="width: ' + windowWidth + 'px; padding: 2px 2px 2px 2px;">';
	windowWidth -= 4;
	html += format(localizer.filter, clanImgPath);
	html += getDresserFilterTabsHtml(dressOptions.currentFilterTab);
	html += '<table width="' + windowWidth + '" border="0" cellspacing="0" cellpadding="0" class="tab-content"><tr><td colspan="2">';
	html += '<table width="100%" border="0" cellspacing="0" class="tcontent" style="padding: 2px 8px 0px 0px;">';
	html += '<tr><td>';
	return html;
}

function getFilterFooterHtml()
{
	var html = '';
	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr>';
	html += '</table>';
	html += '</td></tr></table>';
	html += ' <input class="inpButton" type="button" value="  OK  " onclick="applyFilter2()" />';
	html += ' <input class="inpButton" type="button" value="' + localizer.apply + '" onclick="applyFilter3()" />';
	html += ' <input class="inpButton" type="button" value="' + localizer.cancel + '" onclick="enableCategoryItems()" />';
	html += '</div>';
	return html;
}

function setupFilterFialog()
{
	filterDialogProps = {
		fminlevel: dressOptions.fminlevel,
		fmaxlevel: dressOptions.fmaxlevel,
		fshowold: dressOptions.fshowold,
		fshow_com: dressOptions.fshow_com,
		fshow_ru: dressOptions.fshow_ru,
		fshow_artefacts: dressOptions.fshow_artefacts,
		ffiltermf: dressOptions.ffiltermf,
		frewardonly: dressOptions.frewardonly
		};
}

function storeFilterDialog()
{
	var fminlevel = document.getElementById('fminlevel');
	if (fminlevel != null)
	{
		filterDialogProps.fminlevel = fminlevel.value;
	}
	var fmaxlevel = document.getElementById('fmaxlevel');
	if (fmaxlevel != null)
	{
		filterDialogProps.fmaxlevel = fmaxlevel.value;
	}
	var fshowold = document.getElementById('fshowold');
	if (fshowold != null)
	{
		filterDialogProps.fshowold = fshowold.checked;
	}
	var fshow_com = document.getElementById('fshow_com');
	if (fshow_com != null)
	{
		filterDialogProps.fshow_com = fshow_com.checked;
	}
	var fshow_ru = document.getElementById('fshow_ru');
	if (fshow_ru != null)
	{
		filterDialogProps.fshow_ru = fshow_ru.checked;
	}
	var fshow_artefacts = document.getElementById('fshow_artefacts');
	if (fshow_artefacts != null)
	{
		filterDialogProps.fshow_artefacts = fshow_artefacts.checked;
	}
	var ffiltermf = document.getElementById('ffiltermf');
	if (ffiltermf != null)
	{
		filterDialogProps.ffiltermf = ffiltermf.value;
	}
	var frewardonly = document.getElementById('frewardonly');
	if (frewardonly != null)
	{
		filterDialogProps.frewardonly = frewardonly.checked;
	}
}

function getCommonFilterHtml()
{
	var html = '';
	html += getFilterHeaderHtml();
	html += format('<label for="fminlevel">{1}: </label><input id="fminlevel" name="fminlevel" type="text" value="{0}" class="ABText80" />', (filterDialogProps.fminlevel != null) ? filterDialogProps.fminlevel : '', localizer.fminlevel);
	html += '<br />';
	html += format('<label for="fmaxlevel">{1}: </label><input id="fmaxlevel" name="fmaxlevel" type="text" value="{0}" class="ABText80" />', (filterDialogProps.fmaxlevel != null) ? filterDialogProps.fmaxlevel : '', localizer.fmaxlevel);
	html += '<hr class="dashed" />';
	html += ' <input id="fshowold" name="fshowold" type="checkbox" value="showold"' + (filterDialogProps.fshowold ? 'checked="yes"' : '') + ' /><label for="fshowold"> ' + localizer.fshowold + '</label>';
	html += ' <input id="fshow_com" name="fshow_com" type="checkbox" value="show_com"' + (filterDialogProps.fshow_com ? 'checked="yes"' : '') + ' /><label for="fshow_com"> ' + localizer.fshow_com + '</label>';
	html += ' <input id="fshow_ru" name="fshow_ru" type="checkbox" value="show_ru"' + (filterDialogProps.fshow_ru ? 'checked="yes"' : '') + ' /><label for="fshow_ru"> ' + localizer.fshow_ru + '</label>';
	html += ' <input id="fshow_artefacts" name="fshow_artefacts" type="checkbox" value="show_artefacts"' + (filterDialogProps.fshow_artefacts ? 'checked="yes"' : '') + ' /><label for="fshow_artefacts"> ' + localizer.fshow_artefacts + '</label>';
	html += '<br /><input id="frewardonly" name="frewardonly" type="checkbox" value="frewardonly"' + (filterDialogProps.frewardonly ? 'checked="yes"' : '') + ' /><label for="frewardonly"> ' + localizer.frewardonly + '</label>';
	html += getFilterFooterHtml();
	return html;
}

function showCommonFilter()
{
	dressOptions.currentFilterTab = 0;
	storeFilterDialog();
	var filterWindow = document.getElementById('filterWindow');
	filterWindow.innerHTML = getCommonFilterHtml();
}

function getMfFilterHtml()
{
	var mfi = 0;
	var html = '';
	html += getFilterHeaderHtml();
	html += format('<label for="ffiltermf">{0}: </label><br /><select id="ffiltermf" name="ffiltermf">', localizer.ffiltermf);
	html += '<option value="0"' + ((filterDialogProps.ffiltermf == null || filterDialogProps.ffiltermf == 0) ? ' selected="yes"' : '') + '>' + localizer.noFilterMf + '</option>';
	mfi = 0;
	for (var mfn in item_props)
	{
		var prop = item_props[mfn];
		mfi++;
		if (!('inprpg' in prop) && !('inmfg' in prop))
		{
			continue;
		}
		html += '<option value="' + mfi + '"' + ((filterDialogProps.ffiltermf == mfi) ? ' selected="yes"' : '') + '>' + prop.lbl + '</option>';
	}
	html += '</select><br />';
	html += localizer.ffiltermfHint;
	html += getFilterFooterHtml();
	return html;
}

function showMfFilter()
{
	dressOptions.currentFilterTab = 1;
	storeFilterDialog();
	var filterWindow = document.getElementById('filterWindow');
	filterWindow.innerHTML = getMfFilterHtml();
}

function getItemSortHtml()
{
	var html = '';
	html += getFilterHeaderHtml();
	html += 'Пока не реализовано.';
	html += getFilterFooterHtml();
	return html;
}

function showItemSort()
{
	dressOptions.currentFilterTab = 2;
	storeFilterDialog();
	var filterWindow = document.getElementById('filterWindow');
	filterWindow.innerHTML = getItemSortHtml();
}

function showCurrentFilter()
{
	switch(dressOptions.currentFilterTab)
	{
	case 2:
		showItemSort();
		break;
	case 1:
		showMfFilter();
		break;
	default:
		showCommonFilter();
		break;
	}
}

function ShowCatRunes(catid, stateId, slotId)
{
var state = dressStates[stateId];
var slot = getSlotById(slotId);
if (state == null || slot == null)
	{
	return;
	}
if (!(catid in categories) || (!catid in catRunes))
	{
	return;
	}
var html='';
var tableWidth = 5 * 60;
var subRunes = catRunes[catid];

html += '<table width="' + (tableWidth+1) + '" style="table-layout:fixed;" cellspacing="0" cellpadding="0" border="0"><tr><td align="left" valign="top" width="' + tableWidth + '">';
html += '<table width="' + tableWidth + '" style="table-layout:fixed;" cellspacing="0" cellpadding="0" border="0">';

for (var subCatRune in subRunes)
	{
	html += '<tr>';

	for (var i=0; i<=(subRunes[subCatRune].length)-1; i++)
	{
		var onclick = format("hideMenu(); ShowRuneOptions('{0}', '{1}', '{2}');", stateId, slotId, subRunes[subCatRune][i]);
		html += '<td>' + getPersObjectImageHtml(state, slot, subRunes[subCatRune][i], dressOptions.showImages, onclick, 1) + '</td>';
	}
	html += '<td>&nbsp;</td></tr>';
	}

for (var i=0; i<=superRunes.length-1; i++)
	{
	if (i==0) { html += '<tr>'; }
	if (i>0 && ((i/5)==Math.floor(i/5))) { html += '</tr><tr>'; }
	var onclick = format("onSetRune('{0}', '{1}', '{2}', '0')", state.id, slot.id, superRunes[i]);
	html += '<td>' + getPersObjectImageHtml(state, slot, superRunes[i], dressOptions.showImages, onclick, 1) + '</td>';
	if (i==superRunes.length-1) { html += '</tr>'; }
	}

html += '</table></td>';
html += '<td width="1"><img src="' + blankImgPath + '" width="1" height="100" border="0" /></td></tr>';
html += getRowMenuSeparatorHtml();
html += getRowMenuItemHtml(localizer.unRune, format("onUnRuneObject('{0}', '{1}', '')", state.id, slot.id));
html += getRowMenuSeparatorHtml();
html += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()')+'</table>';
showMenu(html);
if (is.ie)
	{
	window.event.returnValue = false;
	}
return false;
}

function ShowRuneOptions(stateId, slotId, runeId)
{
var state = dressStates[stateId];
var slot = getSlotById(slotId);
var o=getObjectById(runeId);
if (state == null || slot == null || !('modify' in o))
	{
	return;
	}
if (!('opts' in o.modify)) { return; }
if (o.modify.opts.length < 1) {return; }

var html='';
html ='<table width="300px" border="0">';
html +='<tr><td align="center">'+o.caption.bold()+'</td></tr>';
for (var a=0; a<= o.modify.opts.length-1; a++)
	{
	for (var imod in o.modify.opts[a])
		{
		if (!item_props[imod])
			{ continue; }
		html += getRowMenuItemHtml(getHtmlOfSignedProp(o.modify.opts[a], item_props[imod], imod, null, null, null), format("onSetRune('{0}', '{1}', '{2}', '{3}')", state.id, slot.id, o.id, a));
		}
	}

//html += getRowMenuItemHtml(localizer.noSharpening, format("onSharpWeapon('{0}', '{1}', 0)", state.id, slot.id));
html += getRowMenuSeparatorHtml();
html += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()')+'</table>';
showMenu(html);
if (is.ie)
	{
	window.event.returnValue = false;
	}
return false;
}

function onSetRune(stateId, slotId, runeId, optId)
{
hideMenu();
var state = dressStates[stateId];
var slot = getSlotById(slotId);
var o=getObjectById(runeId);
if (state == null || slot == null || !('modify' in o))
	{
	return;
	}
if (!('opts' in o.modify)) { return; }
if (o.modify.opts[optId] == null) { return; }
state.runeSlots[slot.index]=runeId+'#'+optId;
updateDresserSlot(state, slot);
}

function applyItemsToCategoryView()
{
	var hashv = getFilterHash();
	var state = activeState;
	var itemsView = document.getElementById('itemsView');
	var html = '';
	var catid = document.getElementById('chosenCategory').value;

	if (!(catid in catlistsources))
	{
		catlistsources[catid] = {};
	}
	var cathash = catlistsources[catid];
	if (hashv in cathash)
	{
		html = cathash[hashv];
	}
	else
	{
		var tableWidth = 8 * 60;
		var slotid = document.getElementById('chosenSlot').value;
		var cat = categories[catid];
		var slot = getSlotById(slotid);
		var perRow = (dressOptions.showImages) ? (tableWidth / slot.width) : 3;
		var fitems = getFilteredItems(cat.items);

		html += '<table width="' + (tableWidth+1) + '" style="table-layout:fixed;" cellspacing="0" cellpadding="0" border="0"><tr><td align="left" valign="top" width="' + tableWidth + '">';
		html += '<table width="' + tableWidth + '" style="table-layout:fixed;" cellspacing="0" cellpadding="0" border="0"><tr>';
		for (var i = 0; i < fitems.length; i++)
		{
			var onclick = format("hideMenu(); onItemWear('{0}', '{1}')", slotid, fitems[i].id);
			html += '<td>' +
				getPersObjectImageHtml(state, slot, fitems[i].id, dressOptions.showImages, onclick);
			html += '</td>';
			if ((i % perRow) == (perRow - 1))
			{
				html += '</tr><tr>';
			}
		}
		html += '</tr></table></td>';
		html += '<td width="1"><img src="' + blankImgPath + '" width="1" height="200" border="0" /></td></tr></table>';

		cathash[hashv] = html;
	}
	itemsView.innerHTML = html;
}

function onCategorySelect(stateid, slotid, catId)
{
	setupFilterFialog();
	clearMenuOnceWhenClosed = true;
	var cat = categories[catId];
	var state = dressStates[stateid];
	var slot = getSlotById(slotid);
	if (state == null || slot == null || cat == null)
	{
		return;
	}
	var menuHtml = '';
	if (catId in catselsources)
	{
		menuHtml = catselsources[catId];
	}
	else
	{
		var tableWidth = 8 * 60;
		tableWidth += 1;
		menuHtml += '<div id="filterWindow" style="position:absolute; visibility: hidden; left:4px; top:20px; width:' + (tableWidth - 8) + 'px; z-index:12; background-color:white; border:1px solid black; filter:alpha(opacity = 95, style = 4), blendtrans(duration = 0.3) progid:DXImageTransform.Microsoft.Shadow(color=' + "'#666666'" + ', Direction=135, Strength=4); font-size:10px"></div>';
		menuHtml += '<div style="width:' + tableWidth + 'px; ">';
		menuHtml += '<table width="' + tableWidth + '" cellspacing="0" cellpadding="0" border="0"><tr><td><b style="font-size: 16px;">';
		menuHtml += cat.caption;
		menuHtml += '</b></td>';
		menuHtml += getCellMenuItemHtml_Core('<span style="font-size: 10px;">' + localizer.setFilter + '</span>', 'onSetInlineFilter()');
		menuHtml += getCellMenuSeparatorHtml();
		menuHtml += getCellMenuItemHtml_Core('<span style="font-size: 10px;">' + localizer.resetFilter + '</span>', 'onResetInlineFilter()');
		menuHtml += '</tr></table>';

		menuHtml += '<input type="hidden" id="chosenSlot" value="' + slotid + '" />';
		menuHtml += '<input type="hidden" id="chosenCategory" value="' + catId + '" />';

		menuHtml += '<table width="' + tableWidth + '" style="cellspacing="0" cellpadding="0" border="0"><tr><td valign="top">';
		//menuHtml += '<div id="itemsView" style="width: 500px; height:250px; overflow:auto; filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1,enabled=false) progid:DXImageTransform.Microsoft.Alpha(opacity=50,style=0,enabled=false);"><center>Идёт фильтрация...</center></div>';
        menuHtml += '<div id="itemsView" style="width: 100%; filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1,enabled=false) progid:DXImageTransform.Microsoft.Alpha(opacity=50,style=0,enabled=false);"><center>Идёт фильтрация...</center></div>';
		menuHtml += '</td></tr><tr><td valign="bottom"><hr class="dashed" />';
		menuHtml += '</td></tr>';
		menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
		menuHtml += '</table>';
		menuHtml += '</div>';
		catselsources[catId] = menuHtml;
	}
	showMenu(menuHtml);
	applyItemsToCategoryView();
}

function onItemWear(slotid, objId)
{
	var state = activeState;
	if (state == null) return;
	setObjectForSlot(state, slotid, objId);
	if (objId == null) return;
	var o = getObjectById(objId);
	if (o == null) return;
	if (slotid == 'w3' && isSecondaryWeapon(o))
	{
		if (state.objects[slot_w10.index] == null)
		{
			setObjectForSlot(state, 'w10', objId);
		}
	}
	if (slotid == 'w10' && isSecondaryWeapon(o))
	{
		if (state.objects[slot_w3.index] == null)
		{
			setObjectForSlot(state, 'w3', objId);
		}
	}
	if (slotid == 'w6')
	{
		if (state.objects[slot_w7.index] == null)
		{
			setObjectForSlot(state, 'w7', objId);
		}
		if (state.objects[slot_w8.index] == null)
		{
			setObjectForSlot(state, 'w8', objId);
		}
	}
	if (slotid == 'w7')
	{
		if (state.objects[slot_w6.index] == null)
		{
			setObjectForSlot(state, 'w6', objId);
		}
		if (state.objects[slot_w8.index] == null)
		{
			setObjectForSlot(state, 'w8', objId);
		}
	}
	if (slotid == 'w8')
	{
		if (state.objects[slot_w6.index] == null)
		{
			setObjectForSlot(state, 'w6', objId);
		}
		if (state.objects[slot_w7.index] == null)
		{
			setObjectForSlot(state, 'w7', objId);
		}
	}
}

function onItemWearFrom(slotid, slotfromid)
{
	var state = activeState;
	var slotTo = getSlotById(slotid);
	var slotFrom = getSlotById(slotfromid);
	if (state == null || slotTo == null || slotFrom == null)
	{
		return;
	}
	state.objects[slotTo.index] = state.objects[slotFrom.index];
	state.upgradeSlots[slotTo.index] = state.upgradeSlots[slotFrom.index];
	state.fitSlots[slotTo.index] = state.fitSlots[slotFrom.index];
	state.charmSlots[slotTo.index] = state.charmSlots[slotFrom.index];
	state.addSlots[slotTo.index] = state.addSlots[slotFrom.index];
	state.runeSlots[slotTo.index] = state.runeSlots[slotFrom.index];
	state.objCache[slotTo.index] = state.objCache[slotFrom.index];
	updateDresserSlot(state, slotTo);
}

function showItemProps(imgElt)
{
	var o = null;
	var state = getImgEltState(imgElt);
	if (state == null)
	{
		state = activeState;
	}
	var slot = null;
	if (isImgInSlot(imgElt))
	{
		slot = getImgEltSlot(imgElt);
		o = getObjectByStateSlot(state, getImgEltSlot(imgElt));
	}
	if (o == null)
	{
		var oid = imgElt.name.substr(1);
		o = getObjectById(oid);
	}
	showPopup(getObjectDescHtml(state, o));
}

function showItemProps2(stateid, oid)
{
	var state = dressStates[stateid];
	var o = getObjectById(oid);
	showPopup(getObjectDescHtml(state, o));
}

function showSetProps(stateid, setid)
{
	var state = dressStates[stateid];
	var setd = getSetAndCountById(setid);
	var html = getObjectDescHtml(state, setd.count)
	var ahtml = '';
	for (var scn in setd.set.details)
	{
		if (scn == setd.count.id) continue;
		if (ahtml != '')
		{
			ahtml += '<hr class="dashed" width="120" />';
		}
		ahtml += getObjectDescHtml(state, setd.set.details[scn]);

	}
	if (ahtml != '')
	{
		html += '<hr width="120" /><i>' + localizer.setVariantsAvailable + '</i><blockquote>' + ahtml + '</blockquote>';
	}
	showPopup(html);
}

function showStrengtheningProps(stateid, strengtheningid)
{
	var state = dressStates[stateid];
	var strengthening = getStrengtheningById(strengtheningid);
	showPopup(getObjectDescHtml(state, strengthening));
}

function getObjectByStateSlot(state, slot)
{
	if (state == null || slot == null)
	{
		return null;
	}
	var obj = state.objCache[slot.index];
	if (obj != null)
	{
		return obj;
	}
	obj = getObjectById(state.objects[slot.index]);
	if (state.upgradeSlots[slot.index] != null)
	{
		obj = getUpgradeObject(obj, state.upgradeSlots[slot.index]);
	}
	if (state.fitSlots[slot.index] != null)
	{
		obj = getFittedObject(obj, state.fitSlots[slot.index]);
	}
	if (state.charmSlots[slot.index] != null)
	{
		obj = getCharmedObject2(obj, state.charmSlots[slot.index]);
	}
	if (state.addSlots[slot.index] != null)
	{
		obj = getAddObject2(obj, state.addSlots[slot.index]);
	}
	if (state.runeSlots[slot.index] != null)
		{
		obj = getRunedObject(obj, state.runeSlots[slot.index]);
		}

	if (state.fitArmor && (slot.id == 'w4'))
	{
		obj = getFittedArmor(obj);
	}
	else if ((state.w3sharp > 0) && (slot.id == 'w3'))
	{
		obj = getSharpenWeapon(obj, state.w3sharp);
	}
	else if ((state.w10sharp > 0) && (slot.id == 'w10'))
	{
		obj = getSharpenWeapon(obj, state.w10sharp);
	}
	state.objCache[slot.index] = obj;
	return obj;
}

function getObjectFilter(state, slot, o)
{
	var r = '';
	if (o == null)
	{
		return r;
	}
	if (slot.id == 'w3' && state.w3sharp > 0)
	{
		r += 'blur ';
	}
	if (slot.id == 'w10' && state.w10sharp > 0)
	{
		r += 'blur ';
	}
	if (('armorWasFit' in o) && o.armorWasFit)
	{
		r += 'glo2 ';
	}
	if (('wasFit' in o) && o.wasFit)
	{
		r += 'glo2 ';
	}
	if (('wasUpgrade' in o) && o.wasUpgrade)
	{
		if ('fake' in o)
		{
			r += 'blueshadow ';
		}
		else
		{
			r += 'goldshadow ';
		}
	}
	if (('wasCharmed' in o) && o.wasCharmed)
	{
		r += 'purpleshadow ';
	}
	if (('wasAdded' in o) && o.wasAdded)
	{
		r += 'redshadow ';
	}
	if (('wasRuned' in o) && o.wasRuned)
	{
		r += 'redshadow ';
	}
	return r;
}

function isImportantStateArray(a)
{
	for (var i = 0; i < a.length; i++)
	{
		if (a[i] != null)
		{
			return true;
		}
	}
	return false;
}

function getPackedObjectsRepresentation(a)
{
	var r = '';
	var rl = 0;
	for (var i = 0; i < a.length; i++)
	{
		if (a[i] != null)
		{
			rl = i + 1;
		}
	}
	for (var i = 0; i < rl; i++)
	{
		if (i > 0)
		{
			r += '/';
		}
		if (a[i] != null)
		{
			r += a[i];
		}
	}
	return r;
}

function getUnpackedObjectsRepresentation(pa)
{
	var r = new Array(slots.length);
	var a = pa.split('/');
	for (var i = 0; i < a.length; i++)
	{
		if (a[i] != '')
		{
			r[i] = a[i];
		}
	}
	return r;
}

function getSerializableState(state)
{
	var r = {};
	r.version = serializableStateFormatVersion;
	if (state.name != '')
	{
		r.name = state.name;
	}
	if (state.align != '0')
	{
		r.align = state.align;
	}
	if (state.clan != '')
	{
		r.clan = state.clan;
	}
	if (state.sex != 0)
	{
		r.sex = state.sex;
	}
	if (state.image != '0')
	{
		r.image = state.image;
	}
	if (state.sign != '')
	{
		r.sign = state.sign;
	}
	r.natural = {};
	for (var i = 0; i < knownNaturalEditors.length; i++)
	{
		var propName = knownNaturalEditors[i];
		if (propName == '-')
		{
			continue;
		}
		if (propName in state.natural)
		{
			var v = state.natural[propName];
			if (v > 0)
			{
				r.natural[propName] = v;
			}
		}
	}
	if (isImportantStateArray(state.objects))
	{
//		r.objects = cloneArray(state.objects);
		r.o1 = getPackedObjectsRepresentation(state.objects);
	}
	if (state.w3sharp > 0)
	{
		r.w3sharp = state.w3sharp;
	}
	if (state.w10sharp > 0)
	{
		r.w10sharp = state.w10sharp;
	}
	if (state.fitArmor)
	{
		r.fitArmor = state.fitArmor;
	}
	if (isImportantStateArray(state.fitSlots))
	{
//		r.fitSlots = cloneArray(state.fitSlots);
		r.fs1 = getPackedObjectsRepresentation(state.fitSlots);
	}
	if (isImportantStateArray(state.upgradeSlots))
	{
//		r.upgradeSlots = cloneArray(state.upgradeSlots);
		r.us1 = getPackedObjectsRepresentation(state.upgradeSlots);
	}
	if (isImportantStateArray(state.charmSlots))
	{
//		r.charmSlots = cloneArray(state.charmSlots);
		r.cs1 = getPackedObjectsRepresentation(state.charmSlots);
	}
	if (isImportantStateArray(state.addSlots))
	{
//		r.charmSlots = cloneArray(state.charmSlots);
		r.cs1 = getPackedObjectsRepresentation(state.addSlots);
	}
	if (isImportantStateArray(state.runeSlots))
	{
//		r.charmSlots = cloneArray(state.charmSlots);
		r.cs2 = getPackedObjectsRepresentation(state.runeSlots);
	}
	if (state.statElix != null)
	{
		r.statElix = state.statElix;
	}
	if (state.spellIntel > 0)
	{
		r.spellIntel = state.spellIntel;
	}
	if (state.spellBD > 0)
	{
		r.spellBD = state.spellBD;
	}
	if (state.spellHitpoints > 0)
	{
		r.spellHitpoints = state.spellHitpoints;
	}
	var hasPowerUps = false;
	for (var powerupn in state.spellPowerUps)
	{
		hasPowerUps = true;
		break;
	}
	if (hasPowerUps)
	{
		r.spellPowerUps = state.spellPowerUps;
	}
	var hasDamageElixes = false;
	for (var powerupn in state.damageElixes)
	{
		hasDamageElixes = true;
		break;
	}
	if (hasDamageElixes)
	{
		r.damageElixes = state.damageElixes;
	}
	var hasDefElixes = false;
	for (var powerupn in state.defElixes)
	{
		hasDefElixes = true;
		break;
	}
	if (hasDefElixes)
	{
		r.defElixes = state.defElixes;
	}
	if (state.pet != null)
	{
		r.pet = state.pet;
	}
	if (isImportantStateArray(state.trickSlots))
	{
		r.ts1 = getPackedObjectsRepresentation(state.trickSlots);
	}
	return r;
}

function getRightSizeArray(a, rightSize)
{
	if (a.length == rightSize)
	{
		return a;
	}
	var r = new Array(rightSize);
	for (var i = 0; (i < rightSize) && (i < a.length); i++)
	{
		r[i] = a[i];
	}
	return r;
}

function applyDeserializedState(stateid, r)
{
	if (r == null)
	{
		return;
	}
	if (r.version != serializableStateFormatVersion)
	{
		alert ("incompatible version of serialized state. expected " + serializableStateFormatVersion + " but got " + v);
		return;
	}
	var replaceMode = (stateid != null) && ((stateid in dressStates) || (stateid in droppedDressStates));
	var state = createNewDresserState(stateid);
	if ('name' in r)
	{
		state.name = r.name;
	}
	if ('align' in r)
	{
		state.align = r.align;
	}
	if ('clan' in r)
	{
		state.clan = r.clan;
	}
	if ('sex' in r)
	{
		state.sex = r.sex;
	}
	if ('image' in r)
	{
		state.image = r.image;
	}
	if ('sign' in r)
	{
		state.sign = r.sign;
	}
	state.natural = r.natural;
	if (!('pstat' in state.natural))
	{
		state.natural.pstat = 0;
		state.natural.pskil = 0;
	}
	if ('objects' in r)
	{
		state.objects = getRightSizeArray(r.objects, slots.length);

	}
	if ('o1' in r)
	{
		state.objects = getRightSizeArray(getUnpackedObjectsRepresentation(r.o1), slots.length);
	}
	if ('w3sharp' in r)
	{
		state.w3sharp = parseInt(r.w3sharp);
	}
	if ('w10sharp' in r)
	{
		state.w10sharp = parseInt(r.w10sharp);
	}
	if ('fitArmor' in r)
	{
		state.fitArmor = r.fitArmor;
	}
	if ('fitSlots' in r)
	{
		state.fitSlots = getRightSizeArray(r.fitSlots, slots.length);
	}
	if ('fs1' in r)
	{
		state.fitSlots = getRightSizeArray(getUnpackedObjectsRepresentation(r.fs1), slots.length);
	}
	if ('upgradeSlots' in r)
	{
		state.upgradeSlots = getRightSizeArray(r.upgradeSlots, slots.length);
	}
	if ('us1' in r)
	{
		state.upgradeSlots = getRightSizeArray(getUnpackedObjectsRepresentation(r.us1), slots.length);
	}
	if ('charmSlots' in r)
	{
		state.charmSlots = getRightSizeArray(r.charmSlots, slots.length);
	}
	if ('addSlots' in r)
	{
		state.addSlots = getRightSizeArray(r.addSlots, slots.length);
	}
	if ('charmSlots' in r)
	{
		state.charmSlots = getRightSizeArray(r.charmSlots, slots.length);
	}
	if ('runeSlots' in r)
	{
		state.runeSlots = getRightSizeArray(r.runeSlots, slots.length);
	}
	if ('cs1' in r)
	{
		state.charmSlots = getRightSizeArray(getUnpackedObjectsRepresentation(r.cs1), slots.length);
	}
	if ('cs2' in r)
	{
		state.runeSlots = getRightSizeArray(getUnpackedObjectsRepresentation(r.cs2), slots.length);
	}
	if (('statElix' in r) && (r.statElix.elixn in knownElix))
	{
		state.statElix = r.statElix;
	}
	if ('spellIntel' in r)
	{
		state.spellIntel = parseInt(r.spellIntel);
	}
	if ('spellBD' in r)
	{
		state.spellBD = parseInt(r.spellBD);
	}
	if ('spellHitpoints' in r)
	{
		state.spellHitpoints = parseInt(r.spellHitpoints);
	}
	if ('spellPowerUps' in r)
	{
		state.spellPowerUps = r.spellPowerUps;
	}
	if ('damageElixes' in r)
	{
		state.damageElixes = r.damageElixes;
	}
	if ('defElixes' in r)
	{
		state.defElixes = r.defElixes;
	}
	if ('pet' in r)
	{
		state.pet = r.pet;
	}
	if ('ts1' in r)
	{
		state.trickSlots = getRightSizeArray(getUnpackedObjectsRepresentation(r.ts1), 20);
	}
	for (var i = 0; i < slots.length; i++)
	{
		if (state.objects[i] == null)
		{
			continue;
		}
		var o = getObjectById(state.objects[i]);
		if (o == null)
		{
			state.objects[i] = null;
			state.fitSlots[i] = null;
			state.upgradeSlots[i] = null;
			state.charmSlots[i] = null;
			state.addSlots[i] = null;
			state.runeSlots[i] = null;
			continue;
		}
		if (state.upgradeSlots[i] != null)
		{
			if (!('upgrade' in o) || !(getJSName(state.upgradeSlots[i]) in o.upgrade))
			{
				state.upgradeSlots[i] = null;
			}
		}

	}
	for (var ti = 0; i < state.trickSlots.length; i++)
	{
		var trick = state.trickSlots[ti];
		if (trick != null)
		{
			if (!(getJSName(trick) in tricks))
			{
				state.trickSlots[ti] = null;
			}
		}
	}
	activeState = state;
	updateTabs(false);
	if (replaceMode)
	{
		hardUpdateDresserState(state);
	}
	else
	{
		recalcDresserState(state);
		updateCabs();
	}
	changeCab(state.id);
	someStatesLoaded = true;
}

function loadEnteredSet()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var telt = document.getElementById('setArea');
	if (telt == null)
	{
		return;
	}
	var text = telt.value;
	if (text.indexOf(absoluteDressRoomUrl) === 0)
	{
		// its friendlink.
		text = text.substr(absoluteDressRoomUrl.length + '?data='.length);
		text = unescape(text);
	}
	if (text == '')
	{
		alert('Введите сперва текст, описывающий состав комплекта.');
		return;
	}
	var dstate = deserializeObject(text);
	applyDeserializedState(state.id, dstate);
}

function onLoadSet(stateid)
{
	var menuHtml  ='<table width="340" border="0"><tr><td>';
	menuHtml += format(localizer.loadSetHint, clanImgPath);
	menuHtml += '<br /><textarea id="setArea" cols="60" rows="8" wrap="VIRTUAL">';
	menuHtml += '</textarea></td></tr>';
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.loadSet, "loadEnteredSet()");
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table>';
	showMenu(menuHtml, false);
	var telt = document.getElementById('setArea');
	if (telt != null)
	{
		telt.focus();
		telt.select();
	}
}

function saveOnServer()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var text = serializeObject(getSerializableState(state));
	var url = format(saveSetOnServerUrl, escape(text));
	window.open(url, '_blank');
}

function onSaveSet(stateid)
{
	var state = dressStates[stateid];
	if (state == null)
	{
		return;
	}
	var menuHtml  ='<table width="340" border="0"><tr><td>';
	var text = serializeObject(getSerializableState(state));
	menuHtml += format(localizer.saveSetHint, clanImgPath);
	menuHtml += '<br /><textarea id="setArea" class="inpText" cols="60" rows="8" wrap="VIRTUAL" readonly="true">';
	menuHtml += text;
	menuHtml += '</textarea></td></tr>';
	menuHtml += getRowMenuSeparatorHtml();
	//menuHtml += getRowMenuItemHtml(localizer.saveSetOnServer, "saveOnServer()");
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, "hideMenu()");
	menuHtml += '</table>';
	showMenu(menuHtml, false);
	var telt = document.getElementById('setArea');
	if (telt != null)
	{
		telt.focus();
		telt.select();
	}
}

function getNextGoodSlot(o, slot)
{
	if (slot.id == 'w3')
	{
		if (isSecondaryWeapon(o))
		{
			return getSlotById('w10');
		}
	}
	else
	{
		var ngsSpellsData = [];
		for (var i = 100; i <= 109; i++)
		{
			ngsSpellsData.push('w' + i);
		}
		var ngsData = new Array(
					   new Array('w6', 'w7', 'w8'),
					   new Array('w14', 'w15', 'w16'),
					   ngsSpellsData
					   );
		for (var i = 0; i < ngsData.length; i++)
		{
			var ngsDataRow = ngsData[i];
			for (j = 0; j < (ngsDataRow.length - 1); j++)
			{
				if (slot.id == ngsDataRow[j])
				{
					return getSlotById(ngsDataRow[j + 1]);
				}
			}
		}
	}
	return null;
}


function testShortInfoRe(state, o, s, re, sharp, minvname, maxvname)
{
	var m = s.match(re);
	if (m != null)
	{
		var ou = null;
		var minm = parseInt(m[1]);
		var maxm = parseInt(m[2]);
		for (var upgraden in o.upgrade)
		{
			var uobj = getUpgradeObject(o, upgraden);
			if (!('level' in uobj) || (uobj.level > state.natural.level))
			{
				continue;
			}
			if (sharp > 0)
			{
				uobj = getSharpenWeapon(uobj, sharp);
			}
			if ('properties' in uobj)
			{
				var pou = null;
				if (minvname in uobj.properties)
				{
					if (uobj.properties[minvname] > minm)
					{
						break;
					}
					pou = upgraden;
				}
				if (maxvname in uobj.properties)
				{
					if (uobj.properties[maxvname] > maxm)
					{
						break;
					}
					if ((minvname in uobj.properties) && pou == null)
					{
						continue;
					}
					pou = upgraden;
				}
				if (pou != null) ou = pou;
			}
			if ('modify' in uobj)
			{
				var pou = null;
				if (minvname in uobj.modify)
				{
					if (uobj.modify[minvname] > minm)
					{
						break;
					}
					pou = upgraden;
				}
				if (maxvname in uobj.modify)
				{
					if (uobj.modify[maxvname] > maxm)
					{
						break;
					}
					if ((minvname in uobj.modify) && pou == null)
					{
						continue;
					}
					pou = upgraden;
				}
				if (pou != null) ou = pou;
			}
		}
		return {upgraden: ou, found: true};
	}
	return {upgraden: null, found: false};
}

function testShortInfoRe1(state, o, s, re, sharp, vname)
{
	var m = s.match(re);
	if (m != null)
	{
		var ou = null;
		var m1 = parseInt(m[1]);
		for (var upgraden in o.upgrade)
		{
			var uobj = getUpgradeObject(o, upgraden);
			if (!('level' in uobj) || (uobj.level > state.natural.level))
			{
				continue;
			}
			if (sharp > 0)
			{
				uobj = getSharpenWeapon(uobj, sharp);
			}
			if ('properties' in uobj)
			{
				if (vname in uobj.properties)
				{
					if (uobj.properties[vname] > m1)
					{
						break;
					}
					ou = upgraden;
				}
			}
			if ('modify' in uobj)
			{
				if (vname in uobj.modify)
				{
					if (uobj.modify[vname] > m1)
					{
						break;
					}
					ou = upgraden;
				}
			}
		}
		return {upgraden: ou, found: true};
	}
	return {upgraden: null, found: false};
}

function applyAssortedObject(state, oid, odic)
{
	var o = getObjectById(oid);
	if (o == null)
	{
		return;
	}
	var ou = null;
	if ('baseitem' in o)
	{
		ou = o.id;
		o = getObjectById(o.baseitem);
	}
	var baseSlot = getSlotById(o.slot);
	for (var slot = baseSlot; slot != null; slot = getNextGoodSlot(o, slot))
	{
		if (state.objects[slot.index] == null)
		{
			state.objects[slot.index] = o.id;
			var odicname = (odic.length > 0) ? odic[0] : '';
			if (baseSlot.id == 'w3')
			{
				// look for sharpness
				var sharps = odicname.match(reSharpness);
				if (sharps != null)
				{
					state[slot.id + 'sharp'] = parseInt(sharps[1]);
				}
				if (('upgrade' in o) && (ou == null))
				{
					for (var i = 1; i < odic.length; i++)
					{
						var r = testShortInfoRe(state, o, odic[i], reDamage, state[slot.id + 'sharp'], 'mindamage', 'maxdamage');
						if (r.found)
						{
							ou = r.upgraden;
							break;
						}
					}
				}
			}
			else
			{
				if (('upgrade' in o) && (ou == null))
				{
					for (var i = 1; i < odic.length; i++)
					{
						var r = testShortInfoRe1(state, o, odic[i], reHitPoints, 0, 'hitpoints');
						if (r.found)
						{
							ou = r.upgraden;
							break;
						}
						r = testShortInfoRe(state, o, odic[i], reHeadArmor, 0, 'headarmor1', 'headarmor2');
						if (r.found)
						{
							ou = r.upgraden;
							break;
						}
						r = testShortInfoRe(state, o, odic[i], reBodyArmor, 0, 'bodyarmor1', 'bodyarmor2');
						if (r.found)
						{
							ou = r.upgraden;
							break;
						}
						r = testShortInfoRe(state, o, odic[i], reWaistArmor, 0, 'waistarmor1', 'waistarmor2');
						if (r.found)
						{
							ou = r.upgraden;
							break;
						}
						r = testShortInfoRe(state, o, odic[i], reLegArmor, 0, 'legarmor1', 'legarmor2');
						if (r.found)
						{
							ou = r.upgraden;
							break;
						}
					}
				}
			}
			if (ou != null)
			{
				state.upgradeSlots[slot.index] = ou;
			}
			state.objCache[slot.index] = null;
			break;
		}
	}
}

function _x_cabTo(id, val)
{
	var tval = val ? 'activeLink' : 'usualLink';
	document.getElementById(id).className = tval;
}

function _x_cabOn(id)
{
	document.getElementById(id).className = 'activeLink';
}

function _x_cabOff(id)
{
	document.getElementById(id).className = 'usualLink';
}

function changeCab(cabid)
{
	activeState = null;
	hidePopup();
	hideMenu();

	var stateCount = 0;
	for (var staten in dressStates)
	{
		stateCount++;
	}
	for (var staten in dressStates)
	{
		var state = dressStates[staten];
		var tval = (state.id == cabid) ? 'activeLink' : 'usualLink';
		var dval = (state.id == cabid) ? '' : 'none';
		_x_cabTo('tab_' + state.id, (state.id == cabid), dressOptions.useTransitionEffects);
		if (state.id == cabid)
		{
			activeState = state;
			fastUpdateDresserState(state);
		}
		document.getElementById('cab_' + state.id).style.display = dval;
	}
	if (cabid == 'summary')
	{
		_x_cabOn('tabx_summary', dressOptions.useTransitionEffects);
		showSummary();
	}
	else
	{
		_x_cabOff('tabx_summary', dressOptions.useTransitionEffects);
		hideSummary();
	}
	if (cabid == 'exptable')
	{
		_x_cabOn('tabx_exptable', dressOptions.useTransitionEffects);
		showExpTable();
	}
	else if (dressOptions.showExp)
	{
		_x_cabOff('tabx_exptable', dressOptions.useTransitionEffects);
		hideExpTable();
	}
	if (cabid == 'healer')
	{
		_x_cabOn('tabx_healer', dressOptions.useTransitionEffects);
		showHealer();
	}
	else if (dressOptions.showHealer)
	{
		_x_cabOff('tabx_healer', dressOptions.useTransitionEffects);
		hideHealer();
	}
	if (cabid == 'battles')
	{
		_x_cabOn('tabx_battles', dressOptions.useTransitionEffects);
		showBattles();
	}
	else
	{
		_x_cabOff('tabx_battles', dressOptions.useTransitionEffects);
		hideBattles();
	}
	if (cabid == 'builder')
	{
		_x_cabOn('tabx_builder', dressOptions.useTransitionEffects);
		showBuilder();
	}
	else if (dressOptions.showBuilder)
	{
		_x_cabOff('tabx_builder', dressOptions.useTransitionEffects);
		hideBuilder();
	}
}

function createCab()
{
	var state = createNewDresserState(null);
	activeState = null;
	updateTabs(true);
	updateCabs();
	activeState = null;
	updateDresserState(state);
	changeCab(state.id);
}

function removeCab2(cabId)
{
	var stateCount = 0;
	for (var staten in dressStates)
	{
		stateCount++;
	}
	if (stateCount < 2)
	{
		alert('Удаление единственной кабинки не разрешается');
		return;
	}
	if (activeState.id == cabId)
	{
		activeState = null;
	}
	var nextActiveState = null;
	for (var staten in dressStates)
	{
		var state = dressStates[staten];
		if (state.id == cabId)
		{
			droppedDressStates[staten] = cabId;
			document.getElementById('cab_' + state.id).style.display = 'none';
			delete dressStates[staten];
			break;
		}
		nextActiveState = state;
	}
	if (nextActiveState == null)
	{
		for (var staten in dressStates)
		{
			var state = dressStates[staten];
			nextActiveState = state;
			break;
		}
	}

	if (activeState == null)
	{
		activeState = nextActiveState;
	}
	updateTabs(false);
	changeCab(activeState.id);
}

function getTabsHtml(tabActive)
{
	var html = '';
	var stateCount = 0;
	var classn;
	var i = 1;
	for(var staten in dressStates)
	{
		var state = dressStates[staten];
		classn = (activeState != null && state.id == activeState.id) ? 'activeLink' : 'usualLink';
		html += format('<li id="tab_{5}" class="{2}"><a href="javascript:;" onclick="changeCab({4})"><nobr>{0} {1} <img onclick="removeCab2({4})" src="{3}closeCab.gif" width="10" height="10" border="0" title="{6}" /></nobr></a></li>', localizer.upperCab, i, classn, hereItemImgPath, "'" + state.id + "'", state.id, localizer.closeCab);
		stateCount++;
		i++;
	}
	html += format('<li id="tabx_newcab"><a title="{1}" onclick="createCab()" href="javascript:;"><nobr>{0}</nobr></a></li>', localizer.newCab, localizer.newCabHint);
	/*html += format('<li id="tabx_summary"><a title="{1}" onclick="changeCab({2})" href="javascript:;"><nobr>{0}</nobr></a></li>', localizer.summaryTableCab, localizer.summaryTableHint, "'summary'");
	if (dressOptions.showExp)
	{
		html += format('<li id="tabx_exptable"><a title="{1}" onclick="changeCab({2})" href="javascript:;"><nobr>{0}</nobr></a></li>', localizer.expTableCab, '', "'exptable'");
	}
	if (dressOptions.showHealer)
	{
		html += format('<li id="tabx_healer"><a title="{1}" onclick="changeCab({2})" href="javascript:;"><nobr>{0}</nobr></a></li>', localizer.healerCab, 'Комната Знахаря позволит рассчитать порядок и стоимость перекидки статов в комнате Знахаря для перехода от одного комплекта к другому.', "'healer'");
	}
	if (dressOptions.showBuilder)
	{
		html += format('<li id="tabx_builder"><a title="{1}" onclick="changeCab({2})" href="javascript:;"><nobr>{0}</nobr></a></li>', localizer.designerCab, 'Конструктор позволит Вам создать уникальные предметы и их модификации.', "'builder'");
	}
	html += format('<li id="tabx_battles"><a title="{1}" onclick="changeCab({2})" href="javascript:;"><nobr>{0}</nobr></a></li>', localizer.battlesCab, 'Позволяет провести тестовые поединки.', "'battles'");*/
	return html;
}

function getCabsHtml()
{
	var html = '';
	for(var staten in dressStates)
	{
		var state = dressStates[staten];
		if (state.rendered)
		{
			continue;
		}
		if (staten in droppedDressStates)
		{
			delete droppedDressStates[staten];
			state.rendered = true;
			hardUpdateDressState(state);
			continue;
		}
		html += format('<div id="cab_{0}" style="display: none">{1}</div>', state.id, getDresserInnerHtml(state));
		state.rendered = true;
	}
	return html;
}

function updateTabs(tabActive)
{
	document.getElementById('nav').innerHTML = getTabsHtml(tabActive);
}

function updateCabs()
{
	var cabs = document.getElementById('dressCabs');
	var appendum = getCabsHtml();
	if (cabs.insertAdjacentHTML)
	{
		cabs.insertAdjacentHTML('beforeEnd', appendum);
	}
	else
	{
		cabs.innerHTML = cabs.innerHTML + appendum;
	}
}

function showScriptStatus(msg)
{
	informAboutProgress(msg);
}


function showDressHint()
{
	var i = Math.floor(Math.random() * dressHints.length);
	informAboutProgress('<font color="red">' + localizer.tip + ':</font> ' + dressHints[i]);
}

function getSerializedDresser()
{
	var dresser = [];
	for (staten in dressStates)
	{
		var state = dressStates[staten];
		var serState = getSerializableState(state);
		dresser.push(serState);
	}
	dressExData.fakeDefs = {};
	for (var i in dressExData.fakes)
	{
		var fid = dressExData.fakes[i];
		var fake = getFake(fid);
		dressExData.fakeDefs[getJSName(fid)] = fake;
	}
	dresser.push(dressExData);
	return serializeArray(dresser);
}

function applyDeserializedDresser(serDresser)
{
	if (serDresser == '')
	{
		return;
	}
	var dresser = deserializeArray(serDresser);
	for (var i = 0; i < dresser.length; i++)
	{
		var serState = dresser[i];
		if ('exdata' in serState)
		{
			if (serState.exdata != 4)
			{
				continue;
			}
			dressExData = serState;
			// do something
			for (var i in dressExData.fakes)
			{
				var fid = dressExData.fakes[i];
				var fake = dressExData.fakeDefs[getJSName(fid)];
				if (fake != null)
				{
					createFake(fid, fake);
				}
				else
				{
					delete dressExData.fakes[i];
				}
			}
			break;
		}
	}
	for (var i = 0; i < dresser.length; i++)
	{
		var serState = dresser[i];
		if (!('exdata' in serState))
		{
			applyDeserializedState(null, serState);
		}
	}
}

function loadFav()
{
	if (isOfflineMode())
	{
		return;
	}
	var favstore = document.getElementById(favStoreId);
	favstore.value = favstore.getAttribute("sPersistAttr") || '';
	applyDeserializedDresser(favstore.value);
}

function saveFav()
{
	if (isOfflineMode())
	{
		return;
	}
	var favstore = document.getElementById(favStoreId);
	favstore.value = getSerializedDresser();
	favstore.setAttribute("sPersistAttr", favstore.value);
}

function loadHistory()
{
	if (dressOptions.embeddedMode && window.external && window.external.storage)
	{
		applyDeserializedDresser(window.external.storage.getPersistentVariable(historyStoreId));
		return;
	}
	if (isOfflineMode())
	{
		return;
	}
	if (is.ie)
	{
		var historystore = document.getElementById(historyStoreId);
		historystore.load(historyStoreId);
		historystore.value = historystore.getAttribute("sPersistAttr") || '';
		applyDeserializedDresser(historystore.value);
	}
	else if (is.ff2)//typeof (globalStorage) != 'undefined')
	{
		var storage = globalStorage[window.location.hostname];
		var dcdresser =storage.getItem('dcdresser');
		if (dcdresser && 'historyStoreId' in dcdresser)
		{
			applyDeserializedDresser(storage.dcdresser[historyStoreId]);
		}
	}
}

function saveHistory()
{
	if (dressOptions.embeddedMode && window.external && window.external.storage)
	{

		window.external.storage.setPersistentVariable(historyStoreId, getSerializedDresser());
		return;
	}
	if (isOfflineMode())
	{
		return;
	}
	if (is.ie)
	{
		var historystore = document.getElementById(historyStoreId);
		historystore.value = getSerializedDresser();
		historystore.setAttribute("sPersistAttr", historystore.value);
		historystore.save(historyStoreId);
	}
	else if (is.ff2)//typeof (globalStorage) != 'undefined')
	{
		var storage = globalStorage[window.location.hostname];
		var dcdresser = {};
		if (storage.getItem('dcdresser'))
		{
			dcdresser = storage.getItem('dcdresser');
		}
		dcdresser[historyStoreId] = getSerializedDresser();
		storage.setItem('dcdresser', dcdresser);
	}
}

window.onunload = saveHistory;

function isOfflineMode()
{
	return (location.protocol != 'http:');
}

function isEmbeddedMode()
{
	return (dressOptions.embeddedMode);
}

function prepareEmbeddedMode()
{
	baseImgPath = window.external.getCombatsClientEnv('BaseImgPath');
	itemImgPath = window.external.getCombatsClientEnv('ItemImgPath');
	hereItemImgPath = window.external.getCombatsClientEnv('HereItemImgPath');
	charImgPath = window.external.getCombatsClientEnv('CharImgPath');
	clanImgPath = window.external.getCombatsClientEnv('ClanImgPath');
	zodiacImgPath = window.external.getCombatsClientEnv('ZodiacImgPath');
	brandImgPath = window.external.getCombatsClientEnv('BrandImgPath');
	brand2ImgPath = window.external.getCombatsClientEnv('Brand2ImgPath');
	hpMeterGreenImg = window.external.getCombatsClientEnv('HpMeterGreenImg');
	manaMeterImg = window.external.getCombatsClientEnv('ManaMeterImg');
	infospaceImgPath = 'images/infospace/';
	dressImgPath = 'images/dress/';
	blankImgPath = 'images/blank.gif';
	zodiacImgPath = 'images/dress/z/';

	saveSetOnServerUrl = absoluteDressRoomUrl + '?action=save&saveset=1&offline=1&texttosave={0}';

	getCharacterInfoUrlFormat = 'http://likebk.com/inf.php?login={0}';
}

function prepareOfflineMode()
{
	if (!isOfflineMode())
	{
		return;
	}
	if (isEmbeddedMode())
	{
		prepareEmbeddedMode();
	}
	else
	{
		baseImgPath = '';
		itemImgPath = '';
		hereItemImgPath = '';
		charImgPath = 'http://img.combats.com/i/chars/';
		clanImgPath = '';
		zodiacImgPath = '';
		brandImgPath = 'brand/';
		brand2ImgPath = 'misc/';
		trickImgPath = '';
		trickResourceImgPath = '';
		hpMeterGreenImg = 'bk_life_green.gif';
		manaMeterImg = 'bk_life_beg_33.gif';
		infospaceImgPath = 'images/infospace/';
		dressImgPath = 'dress/';
		blankImgPath = 'blank.gif';
		zodiacImgPath = 'dress/z/';

		saveSetOnServerUrl = absoluteDressRoomUrl + '?action=save&saveset=1&offline=1&texttosave={0}';

		getCharacterInfoUrlFormat = 'http://likebk.com/inf.php?login={0}';
	}
}

function GetOfflineCookie(dressOptionsCookieName)
{
	if (dressOptions.embeddedMode && window.external && window.external.storage)
	{
		return window.external.storage.getPersistentVariable(dressOptionsCookieName);
	}
	if (isOfflineMode())
	{
		return null;
	}
	var offlineCookie = document.getElementById(offlineCookieId);
	offlineCookie.load(offlineCookieId);
	return offlineCookie.getAttribute(dressOptionsCookieName) || null;
}

function SetOfflineCookie(dressOptionsCookieName, v, exp)
{
	if (dressOptions.embeddedMode && window.external && window.external.storage)
	{
		window.external.storage.setPersistentVariable(dressOptionsCookieName, v);
	}
	if (isOfflineMode())
	{
		return;
	}
	var offlineCookie = document.getElementById(offlineCookieId);
	offlineCookie.setAttribute(dressOptionsCookieName, v);
	offlineCookie.save(offlineCookieId);
}

function isCompatibleBrowser()
{
	if (!is.ie)
	{
		var ffstr = 'Firefox/';
		if (navigator.userAgent.indexOf(ffstr) >= 0)
		{
			return (parseFloat(navigator.userAgent.substr(navigator.userAgent.indexOf(ffstr) + ffstr.length)) >= 1.5);
		}
		if (is.opera)
		{
			return true;
		}
		return false;
	}
	var msiestr = 'MSIE ';
	return (parseFloat(is.version.substr(is.version.indexOf(msiestr) + msiestr.length)) >= 5.5);
}

function cloneRings()
{
	for (var i = 7; i <= 8; i++)
	{
		var r = {
				caption: categories.rings.caption,
				slot: ('w' + i),
				items: categories.rings.items,
				basecat: categories.rings
				};
		categories['rings' + i] = r;
	}
}

function cloneFlowers()
{
	var r = {
			caption: categories.flowers.caption,
			slot: 'w10',
			items: categories.flowers.items,
			basecat: categories.flowers
			};
	categories['flowersw10'] = r;
}

function cloneFirs()
{
	var r = {
			caption: categories.firs.caption,
			slot: 'w10',
			items: categories.firs.items,
			basecat: categories.firs
			};
	categories['firsw10'] = r;
}

function getSetVariants(set)
{
	if (!('variants' in set))
	{
		var slotItems = [];
		for (var i = 0; i < slots.length; i++)
		{
			var slot = slots[i];
			slotItems[slot.index] = getSetItemsForSlot(set, slot);
		}
		set.variants = slotItems;
	}
	return set.variants;
}

function cloneScrolls()   //свитки в слоты
{
	for (var i = 101; i <= 109; i++)
	{
 var cscrolls = {
				caption: categories.combatscrolls.caption,
				slot: ('w' + i),
				items: categories.combatscrolls.items,
				basecat: categories.combatscrolls
				};
		categories['combatscrolls' + i] = cscrolls;
 var ascrolls = {
				caption: categories.auxiliaryscrolls.caption,
				slot: ('w' + i),
				items: categories.auxiliaryscrolls.items,
				basecat: categories.auxiliaryscrolls
				};
		categories['auxiliaryscrolls' + i] = ascrolls;
 var sscrolls = {
				caption: categories.summonscrolls.caption,
				slot: ('w' + i),
				items: categories.summonscrolls.items,
				basecat: categories.summonscrolls
				};
		categories['summonscrolls' + i] = sscrolls;
 var tscrolls = {
				caption: categories.tacticalscrolls.caption,
				slot: ('w' + i),                                                        
				items: categories.tacticalscrolls.items,
				basecat: categories.tacticalscrolls                                     
				};
		categories['tacticalscrolls' + i] = tscrolls;
// var escrolls = {                                  //зачарование
//				caption: categories.enchantscrolls.caption,
//				slot: ('w' + i),
//				items: categories.enchantscrolls.items,
//				basecat: categories.enchantscrolls
//				};
//		categories['enchantscrolls' + i] = escrolls;
	}
}

function cloneCItems()
{
	for (var i = 15; i <= 15; i++)
	{
		var citems = {
				caption: categories.carmanitems.caption,
				slot: ('w' + i),
				items: categories.carmanitems.items,
				basecat: categories.carmanitems
				};
		categories['carmanitems' + i] = citems;
	}
}

function initializeDresserAfterItemsLoaded()
{
	for (var catn in categories)
	{
		var cat = categories[catn];
		if (cat.slot == 'w3')
		{
			cat.statBonuses = { strength: 100 };
		}
	}
// зависимость урона от типа пушки?
	categories.legendaryweapon.canBeSharpen = true;
	categories.knives.canBeSharpen = true;
	categories.knives.skillname = 'knifeskill';
	categories.knives.statBonuses = { strength: 45, dexterity: 55 };
	categories.axes.canBeSharpen = true;
	categories.axes.skillname = 'axeskill';
	categories.axes.statBonuses = { strength: 60, dexterity: 30 , intuition: 10 };
	categories.clubs.canBeSharpen =  true;
	categories.clubs.skillname =  'clubskill';
	categories.clubs.statBonuses = { strength: 95 };
	categories.swords.canBeSharpen = true;
	categories.swords.skillname = 'swordskill';
	categories.swords.statBonuses = { strength: 45, intuition: 45 };
	categories.staffs.skillname = 'staffskill';
	categories.staffs.statBonuses = { intellect: 33 };
	categories.staffs.canBeSharpen = true;

	dressStrengthenings.neutralPower = {id: 'neutralPower', caption: 'Сила Нейтрала',
		required: {noWeapon: 1, neutralAlign: 1},
		modify: {mindamage: 0, maxdamage: 1}
	};

	cloneFlowers();
	cloneFirs();
	cloneRings();
	cloneScrolls();
	cloneCItems();
	createVirtualSets();
	//buildSetVariants();
	var hi = new Array('cat', 'bottle', 'hands', 'nude', 'armored');
	for (var i = 0; i < hi.length; i++)
	{
	    dc_preimg(dressImgPath + hi[i] + '_press.gif');
	}
	document.getElementById('dressCabs').innerHTML = '';
	//dressItems.spell_godprotect10.buylink = knownECRPowerUps.spell_godprotect10.buylink;
	knownAdds.food_l41 = dressItems.food_l41;
	knownAdds.food_l61 = dressItems.food_l61;
	knownAdds.food_l71 = dressItems.food_l71;
	knownAdds.food_l8 = dressItems.food_l8;
	//knownAdds.food_8m1 = dressItems.food_8m1;
	//knownAdds.food_8m2 = dressItems.food_8m2;
	knownAdds.food_l5_eng = dressItems.food_l5_eng;
	//knownAdds.pot_base_0_8m1 = dressItems.pot_base_0_8m1;
	knownAdds.food_l10_e = dressItems.food_l10_e;
	knownAdds.food_l11_e = dressItems.food_l11_e;
 //knownAdds.pot_base_0_2007_1 = dressItems.pot_base_0_2007_1;
	//knownAdds.pot_base_0_2007_6 = dressItems.pot_base_0_2007_6;
	//knownAdds.pot_base_0_2007_4 = dressItems.pot_base_0_2007_4;
	//knownAdds.pot_base_0_2007_2 = dressItems.pot_base_0_2007_2;
	//knownAdds.pot_base_0_2007_3 = dressItems.pot_base_0_2007_3;
	//knownAdds.pot_base_0_2007_8 = dressItems.pot_base_0_2007_8;
	//knownAdds.pot_base_0_2007_7 = dressItems.pot_base_0_2007_7;
	//knownAdds.pot_base_0_2007_5 = dressItems.pot_base_0_2007_5;
	//knownAdds.pot_base_0_8m3 = dressItems.pot_base_0_8m3;



	dresInitialized = true;
}

function getTricksOfCategory(catno)
{
	var tc = trickCategories[catno];
	if (!('trickCache' in tc))
	{
		var r = [];
		var cid = tc.id;
		for (var trickn in tricks)
		{
			var trick = tricks[trickn];
			if (trick.school != cid) continue;
			r.push(trick);
		}
		tc.trickCache = r;
	}
	return tc.trickCache;
}

function getFilteredTricks(state, catno)
{
	var r = [];
	var ct = getTricksOfCategory(catno);
	for (var ti = 0; ti < ct.length; ti++)
	{
		var trick = ct[ti];
		if ('required' in trick)
		{
			if ('level' in trick.required)
			{
				if (trick.required.level > state.natural.level)
				{
					continue;
				}
			}
		}
		var alreadyWeared = false;
		for (var i = 0; i < state.trickSlots.length; i++)
		{
			if (state.trickSlots[i] == trick.name)
			{
				alreadyWeared = true;
				break;
			}
		}
		if (alreadyWeared)
		{
			continue;
		}
		r.push(trick);
	}
	return r;
}

function showTrickProps(trickName)
{
	if (trickName == 'clear')
	{
		showPopup(localizer.noTrickHint);
		return;
	}
	var trick = tricks[trickName];
	showPopup(getObjectDescHtml(activeState, trick));
}

function getFullTrickId(state, id)
{
	return 'trickslot_' + state.id + '_' + id;
}

function getTrickImageHtml_Core(name, onclick, width, i)
{
	var caption = localizer.noTrick;
	var iname;
	var path = trickImgPath;
	if (name == null)
	{
		if (i >= 10)
		{
			name = 'clear';
			iname = 'booklearn_slot7';
//			iname = 'booklearn_slot' + (i - 3);
			path = itemImgPath;
		}
		else
		{
			name = iname = 'clear';
		}
	}
	else
	{
		caption = tricks[name].caption;
		if ('iname' in tricks[name])
		{
		        iname = tricks[name].iname;
		}
		else
		{
		        iname = name;
		}
	}
	if (width == null)
	{
		width = 40;
	}
	var html = format('<img src="{0}{2}.gif" width="40" height="25" border="0" onmouseover="showTrickProps(' + "'{1}'" + ')" onmouseout="hidePopup()" />', path, name, iname);
	if (onclick != '')
	{
		html = '<a href="#" onclick="' + onclick + '">' + html + '</a>';
	}
	return html;
}

function getTrickImageHtml(state, name, onclick, width, id)
{
	var rhtml = '<td';
	if (id != null)
	{
		rhtml += ' id="' + getFullTrickId(state, id) + '"';
	}
	rhtml += ' width="' + width + '">' + getTrickImageHtml_Core(name, onclick, width, id) + '</td>';
	return rhtml;
}

function getSingleTrickSlotHtml(state, trickNumber, trickSlotData)
{
	var onclick = 'hideMenu(); onChooseTrick(' + trickNumber + '); return false';
	return getTrickImageHtml(state, trickSlotData, onclick, 40, trickNumber);
}

function updateSingleTrickSlotHtml(trickNumber)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var onclick = 'hideMenu(); onChooseTrick(' + trickNumber + '); return false';
	var html = getTrickImageHtml_Core(state.trickSlots[trickNumber], onclick, 40, trickNumber);
	document.getElementById(getFullTrickId(state, trickNumber)).innerHTML = html;
	fastUpdateDresserState(activeState);
}

function onChooseTrick_InCat(trickNumber, catno)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var tableWidth = (8 * 60);
	var perRow = (tableWidth / 40);
	var ftricks = getFilteredTricks(state, catno);
	var menuHtml = format('<b>{0}</b>', trickCategories[catno].caption);
	menuHtml += '<table cellspacing="0" width="' + tableWidth + '" cellpadding="0" border="0"><tr><td>';
	menuHtml += '<table style="table-layout:fixed;" cellspacing="0" width="' + tableWidth + '" cellpadding="0" border="0"><tr>';
	for (var i = 0; i < ftricks.length; i++)
	{
		var onclick = format("hideMenu(); onWearTrick({1}, '{0}'); return false", ftricks[i].name, trickNumber);
		menuHtml += getTrickImageHtml(state, ftricks[i].name, onclick, 40);
		if ((i % perRow) == (perRow - 1))
		{
			menuHtml += '</tr><tr>';
		}
	}
	menuHtml += '</tr></table>';
	menuHtml += '</td></tr><tr><td>';
	menuHtml += '<hr class="dashed" />';
	menuHtml += '</td></tr>';
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table>';
	showMenu(menuHtml);
}

function onChooseTrick(trickNumber)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	var menuHtml = format('<b>{0}</b>', localizer.tricks);
	menuHtml += '<table cellspacing="0" cellpadding="0" border="0">';
	for (var i = 0; i < trickCategories.length; i++)
	{
		var ftricks = getFilteredTricks(state, i);
		if (ftricks.length == 0) continue;
		var onclick = format("hideMenu(); onChooseTrick_InCat({0}, {1}); return false", trickNumber, i);
		menuHtml += getRowMenuItemHtml(
									trickCategories[i].caption,
									onclick
									);
	}
	if (state.trickSlots[trickNumber] != null)
	{
		menuHtml += getRowMenuSeparatorHtml();
		var onclick = format("hideMenu(); onWearTrick({0})", trickNumber);
		menuHtml += getRowMenuItemHtml(localizer.dropTrick, onclick);
	}
	var AnyTricksOn=0;
	for (var i=0; i<state.trickSlots.length; i++)
		{ if (state.trickSlots[i] != null) { AnyTricksOn = 1; } }
	if ( AnyTricksOn == 1)
		{
		menuHtml += getRowMenuSeparatorHtml();
		menuHtml += getRowMenuItemHtml(localizer.HideAllTricks, 'onWearTrickAll()');
		}
	menuHtml += getRowMenuSeparatorHtml();
	menuHtml += getRowMenuItemHtml(localizer.closeMenu, 'hideMenu()');
	menuHtml += '</table>';
	cursorY -= 60;
	showMenu(menuHtml);
}

function onWearTrick(trickNumber, name)
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	state.trickSlots[trickNumber] = name;
	updateSingleTrickSlotHtml(trickNumber);
}

function onWearTrickAll()
{
	var state = activeState;
	if (state == null)
	{
		return;
	}
	for (var i=0; i<state.trickSlots.length; i++)
		{
		if (state.trickSlots[i] != null)
			{
			state.trickSlots[i] = null;
			updateSingleTrickSlotHtml(i);
			}
		}
}

function getSimplePersObjectImageHtml(state, slot)
{
	var r;
	var style = 'filter:';
	var objid = state.objects[slot.index];
	var oimg = (objid == null) ? slot.id : objid;
	var o = getObjectByStateSlot(state, slot);
	var filter = getObjectFilter(state, slot, o);
	style += getRealFilter(filter);
	r = '<td valign="top">';
	var realItemImgPath = getRealImagePath(objid, slot);
	r += format(
				'<img name="x{1}" src="{0}{1}.gif" width="{2}" height="{3}" style="{4}" border="0" />',
				realItemImgPath,
				oimg,
				slot.width,
				slot.height,
				style
				);
	r += '</td>';
	return r;
}

function onUseTrick(trickNumber)
{
	// does nothing yet.
}

function getSimplePersImageHtml(state, showTricks)
{
	var oimg;
	var i;
	var hp = ('hitpoints' in state.inbattle) ? state.inbattle.hitpoints : 0;
	var mhp = ('hitpoints' in state.results) ? state.results.hitpoints : 0;
	hp = hp.toString();
	hp = hp + '/' + mhp;

	var r = '';
	r += '<table border="0" cellspacing="0" cellpadding="0"';
	if (state.sign != '')
	{
		r += ' style="background-image: url(';
		r += zodiacImgPath + state.sign;
		r += '.gif); background-repeat: no-repeat; background-position: top right;"';
	}
	r += '>';
	r += format('<tr><td id="{1}{0}" align="center" >{2}</td></tr>', state.id, 'nick', getPersNickString(state));
	r += format('<tr><td id="{1}{0}" width="240" align="right" nowrap="yes" style="font-size: 10px;">', state.id, hpMeterSuffix);
	r += format('<span id="{1}{0}v">{2}</span>&#160;', state.id, hpMeterSuffix, hp);
	var w = 240 - ((hp.length + 2) * 7);
	r += format('<img id="{4}{3}i" src="{0}" width="{2}" height="8" alt="{1} (100%)" border="0" />', hpMeterGreenImg, getItemPropLabel('hitpoints'), w, state.id, hpMeterSuffix);
	r += format('<img src="{0}herz.gif" width="10" height="9" alt="{1}"/>', baseImgPath, getItemPropLabel('hitpoints'));
	var mana = ('mana' in state.inbattle) ? state.inbattle.mana : 0;
	var mmana = ('mana' in state.results) ? state.results.mana : 0;
	mana = mana.toString();
	mana = mana + '/' + mmana;
	var manaDisplayMode = (mmana > 0) ? '' : 'none';
	r += format('</td></tr><tr><td id="{1}{0}" width="240" align="right" nowrap="yes" style="font-size: 10px; display: {2}">', state.id, manaMeterSuffix, manaDisplayMode);
	r += format('<span id="{1}{0}v">{2}</span>&#160;', state.id, manaMeterSuffix, mana);
	w = 240 - ((mana.length + 2) * 7);
	r += format('<img id="{4}{3}i" src="{0}" width="{2}" height="8" alt="{1} (100%)" border="0" />', manaMeterImg, getItemPropLabel('mana'), w, state.id, manaMeterSuffix);
	r += format('<img src="{0}Mherz.gif" width="10" height="9" alt="{1}"/>', baseImgPath, getItemPropLabel('mana'));
	r += '</td></tr><tr height="4"><td height="4"></td></tr>';
	if (showTricks)
	{
		r += '<tr><td><table border="0" cellspacing="0" cellpadding="0"><tr>';
		// w100 - w109
		for (i = 100; i < 105; i++)
		{
			r += getSimplePersObjectImageHtml(state, getSlotById('w' + i));
		}
		// this slot is handled as book slot.
		r += getSimplePersObjectImageHtml(state, slot_wbook);
	//	r += format('<td><img style="filter:alpha(opacity = 40, style = 3)" src="{0}w{1}.gif" width="40" height="25" border="0" /></td>', itemImgPath, 109);
		r += '</tr><tr>';
		for (i = 105; i < 110; i++)
		{
			r += getSimplePersObjectImageHtml(state, getSlotById('w' + i));
		}
		// this slot is handled separately like as BK.
		r += format('<td><img style="opacity: 0.4; MozOpacity: 0.4; KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w{1}.gif" width="40" height="25" border="0" /></td>', itemImgPath, 109);
		r += '</tr></table></td></tr>';
	}
	r += '<tr><td><table border="0" cellspacing="0" cellpadding="0"><tr><td width="60"><table width="60" border="0" cellpadding="0" cellspacing="0"><tr>';
	// w9
	r += getSimplePersObjectImageHtml(state, slot_w9);
	r += '</tr><tr>';
	// w13
	r += getSimplePersObjectImageHtml(state, slot_w13);
	r += '</tr><tr>';
	// w3
	r += getSimplePersObjectImageHtml(state, slot_w3);
	r += '</tr><tr>';
	// w4
	r += getSimplePersObjectImageHtml(state, slot_w4);
	r += '</tr><tr>';
	// w5
	r += getSimplePersObjectImageHtml(state, slot_w5);
	r += '</tr></table></td>';
	r += '<td width="120"><table width="120" border="0" cellpadding="0" cellspacing="0"><tr><td colspan="3" height="220" align="right" valign="bottom" style="background-image:url(';
	r += charImgPath + state.sex + '/' + state.image;
	r += '.gif); background-repeat: no-repeat; background-position: center center;">';
	if (state.pet != null)
	{
		var pet = pets[state.pet.n];
		r += format('<img src="{0}{2}/{1}.gif" alt="" title="" onmouseover="showPetProps()" onmouseout="hidePopup()" width="40" height="73" border="0" />', charImgPath, pet.image.def, pet.image.sex);
	}
        r += '</td></tr><tr>';
        r += getSimplePersObjectImageHtml(state, slot_w14);
        // w16 is skipped
        r += format('<td height="20"><img style="opacity: 0.4; MozOpacity: 0.4;KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w14.gif" width="40" height="20" border="0" /></td>', itemImgPath);
        r += getSimplePersObjectImageHtml(state, slot_w15);
        r += '</tr><tr>';
        r += format('<td height="20"><img style="opacity: 0.4; MozOpacity: 0.4;KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w20_1.gif" width="40" height="20" border="0" /></td>', itemImgPath);
        r += format('<td height="20"><img style="opacity: 0.4; MozOpacity: 0.4;KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w20_1.gif" width="40" height="20" border="0" /></td>', itemImgPath);
        r += format('<td height="20"><img style="opacity: 0.4; MozOpacity: 0.4;KhtmlOpacity: 0.4; filter:alpha(opacity = 40, style = 3)" src="{0}w20_1.gif" width="40" height="20" border="0" /></td>', itemImgPath);
        r += '</tr></table></td><td width="60"><table width="60" border="0" cellpadding="0" cellspacing="0"><tr>';

	// w1
	r += getSimplePersObjectImageHtml(state, slot_w1);
	r += '</tr><tr>';
	// w2
	r += getSimplePersObjectImageHtml(state, slot_w2);
	r += '</tr><tr><td><table border="0" cellspacing="0" cellpadding="0"><tr>';
	// w6
	r += getSimplePersObjectImageHtml(state, slot_w6);
	// w7
	r += getSimplePersObjectImageHtml(state, slot_w7);
	// w8
	r += getSimplePersObjectImageHtml(state, slot_w8);
	r += '</tr></table></td></tr><tr>';
	// w11
	r += getSimplePersObjectImageHtml(state, slot_w11);
	r += '</tr><tr>';
	// w10
	r += getSimplePersObjectImageHtml(state, slot_w10);
	r += '</tr><tr>';
	// w19
	r += getSimplePersObjectImageHtml(state, slot_w19);
	r += '</tr><tr>';
	// w12
	r += getSimplePersObjectImageHtml(state, slot_w12);
	r += '</tr></table></td>';
	r += '<td width="60" valign="bottom"><table width="60" border="0" cellpadding="0" cellspacing="0"><tr>';
	// w18
	r += getSimplePersObjectImageHtml(state, slot_w18);
	r += '</tr><tr>';
	// wshirt (w0)
	r += getSimplePersObjectImageHtml(state, slot_w0);
	r += '</tr><tr>';
	// w17
	r += getSimplePersObjectImageHtml(state, slot_w17);
	r += '</tr></tr></table></td></tr></table></td></tr>';
	if (showTricks)
	{
		r += '<tr><td><table border="0" cellspacing="0" cellpadding="0">';
		for (var ci = 0; ci < 2; ci++)
		{
			r += '<tr>';
			for (var i = 0; i < 7; i++)
			{
				//if (ci==2 && i==6) {continue;}
				var trickNumber = (ci * 7) + i;
				var onclick = 'hideMenu(); onUseTrick(' + trickNumber + '); return false';
				r += getTrickImageHtml(state, state.trickSlots[trickNumber], onclick, 50);
			}
			r += '</tr>';
		}
		r += '</table></td></tr>';
	}
	r += '</table>';
	return r;
}

function getEmbeddedDresserFrameHtml()
{
	return '<IFRAME SRC="http://www.darkclan.ru/dressroom/counter.php?type=embedded" SCROLLING="no" WIDTH="100%" HEIGHT="100" BORDER="0" />';
}

function getAutoCombatsDresserFrameHtml()
{
	return '<IFRAME SRC="http://www.darkclan.ru/dressroom/counter.php?type=autocombats" SCROLLING="no" WIDTH="100%" HEIGHT="100" BORDER="0" />';
}

function getOfflineDresserFrameHtml()
{
	return '<IFRAME SRC="http://www.darkclan.ru/dressroom/counter.php?type=offline" SCROLLING="no" WIDTH="100%" HEIGHT="100" BORDER="0" />';
}

function initializeDresserForBenderOmsk()
{
	dressOptions.benderOmskMode = true;
	hereItemImgPath = '';
	charImgPath = 'http://img.combats.com/i/chars/';
	brandImgPath = 'brand/';
 brand2ImgPath = 'misc/';
	infospaceImgPath = 'images/infospace/';
	dressImgPath = 'dress/';
	blankImgPath = 'blank.gif';
	zodiacImgPath = 'dress/z/';
	saveSetOnServerUrl = absoluteDressRoomUrl + '?action=save&saveset=1&offline=1&texttosave={0}';
}

