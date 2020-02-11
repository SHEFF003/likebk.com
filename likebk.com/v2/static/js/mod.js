if( _bk == undefined ) {
	alert('Игровое ядро не определено!');
}else{
	_bk.mod = {
		module:{},
		add:function(name) {
			$(document.body).append('<script type="text/javascript" src="http://likebk.com/v2/static/js/mods/'+name+'.js"></script>');
			$(document.body).append('<link rel="stylesheet" type="text/css" href="http://likebk.com/v2/static/css/mods/'+name+'.css" />');
		},
		html:function(html) {
			$('#touchmain').css({'overflow':'auto'}).html( html );
		},
		open:function(name) {
			if( this.module[name] != undefined ) {
				this.module[name].start();
			}else{
				this.modstart = true;
				this.add(name);
			}
		}
	};
}