var modx = {
	'name':'test'
};

_bk.mod.module[modx.name] = {
	modx:{ },
	start:function() {
		this.getMainHtml();
		this.getWinHtml();
		alert('Модуль ' + this.modx.name + ' запущен!');
	},
	getMainHtml:function() {
		var r = '';
		r += 'Модуль "test" был успешно загружен в главный фрейм!';
		$(top.frames.main.document.body).html( r );
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
	_bk.mod.modstart = false;
	_bk.mod.module[modx.name].start();
}