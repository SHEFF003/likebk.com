function mysql_real_escape_string (str) {
    if (typeof str != 'string')
        return str;

    return str.replace(/[\0\x08\x09\x1a\n\r"'\\\%]/g, function (char) {
        switch (char) {
            case "\0":
                return "\\0";
            case "\x08":
                return "\\b";
            case "\x09":
                return "\\t";
            case "\x1a":
                return "\\z";
            case "\n":
                return "\\n";
            case "\r":
                return "\\r";
            case "\"":
            case "'":
            case "\\":
            case "%":
                return "\\"+char; // prepends a backslash to backslash, percent,
                                  // and double/single quotes
        }
    });
}

var MD5 = function(s){function L(k,d){return(k<<d)|(k>>>(32-d))}function K(G,k){var I,d,F,H,x;F=(G&2147483648);H=(k&2147483648);I=(G&1073741824);d=(k&1073741824);x=(G&1073741823)+(k&1073741823);if(I&d){return(x^2147483648^F^H)}if(I|d){if(x&1073741824){return(x^3221225472^F^H)}else{return(x^1073741824^F^H)}}else{return(x^F^H)}}function r(d,F,k){return(d&F)|((~d)&k)}function q(d,F,k){return(d&k)|(F&(~k))}function p(d,F,k){return(d^F^k)}function n(d,F,k){return(F^(d|(~k)))}function u(G,F,aa,Z,k,H,I){G=K(G,K(K(r(F,aa,Z),k),I));return K(L(G,H),F)}function f(G,F,aa,Z,k,H,I){G=K(G,K(K(q(F,aa,Z),k),I));return K(L(G,H),F)}function D(G,F,aa,Z,k,H,I){G=K(G,K(K(p(F,aa,Z),k),I));return K(L(G,H),F)}function t(G,F,aa,Z,k,H,I){G=K(G,K(K(n(F,aa,Z),k),I));return K(L(G,H),F)}function e(G){var Z;var F=G.length;var x=F+8;var k=(x-(x%64))/64;var I=(k+1)*16;var aa=Array(I-1);var d=0;var H=0;while(H<F){Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=(aa[Z]| (G.charCodeAt(H)<<d));H++}Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=aa[Z]|(128<<d);aa[I-2]=F<<3;aa[I-1]=F>>>29;return aa}function B(x){var k="",F="",G,d;for(d=0;d<=3;d++){G=(x>>>(d*8))&255;F="0"+G.toString(16);k=k+F.substr(F.length-2,2)}return k}function J(k){k=k.replace(/rn/g,"n");var d="";for(var F=0;F<k.length;F++){var x=k.charCodeAt(F);if(x<128){d+=String.fromCharCode(x)}else{if((x>127)&&(x<2048)){d+=String.fromCharCode((x>>6)|192);d+=String.fromCharCode((x&63)|128)}else{d+=String.fromCharCode((x>>12)|224);d+=String.fromCharCode(((x>>6)&63)|128);d+=String.fromCharCode((x&63)|128)}}}return d}var C=Array();var P,h,E,v,g,Y,X,W,V;var S=7,Q=12,N=17,M=22;var A=5,z=9,y=14,w=20;var o=4,m=11,l=16,j=23;var U=6,T=10,R=15,O=21;s=J(s);C=e(s);Y=1732584193;X=4023233417;W=2562383102;V=271733878;for(P=0;P<C.length;P+=16){h=Y;E=X;v=W;g=V;Y=u(Y,X,W,V,C[P+0],S,3614090360);V=u(V,Y,X,W,C[P+1],Q,3905402710);W=u(W,V,Y,X,C[P+2],N,606105819);X=u(X,W,V,Y,C[P+3],M,3250441966);Y=u(Y,X,W,V,C[P+4],S,4118548399);V=u(V,Y,X,W,C[P+5],Q,1200080426);W=u(W,V,Y,X,C[P+6],N,2821735955);X=u(X,W,V,Y,C[P+7],M,4249261313);Y=u(Y,X,W,V,C[P+8],S,1770035416);V=u(V,Y,X,W,C[P+9],Q,2336552879);W=u(W,V,Y,X,C[P+10],N,4294925233);X=u(X,W,V,Y,C[P+11],M,2304563134);Y=u(Y,X,W,V,C[P+12],S,1804603682);V=u(V,Y,X,W,C[P+13],Q,4254626195);W=u(W,V,Y,X,C[P+14],N,2792965006);X=u(X,W,V,Y,C[P+15],M,1236535329);Y=f(Y,X,W,V,C[P+1],A,4129170786);V=f(V,Y,X,W,C[P+6],z,3225465664);W=f(W,V,Y,X,C[P+11],y,643717713);X=f(X,W,V,Y,C[P+0],w,3921069994);Y=f(Y,X,W,V,C[P+5],A,3593408605);V=f(V,Y,X,W,C[P+10],z,38016083);W=f(W,V,Y,X,C[P+15],y,3634488961);X=f(X,W,V,Y,C[P+4],w,3889429448);Y=f(Y,X,W,V,C[P+9],A,568446438);V=f(V,Y,X,W,C[P+14],z,3275163606);W=f(W,V,Y,X,C[P+3],y,4107603335);X=f(X,W,V,Y,C[P+8],w,1163531501);Y=f(Y,X,W,V,C[P+13],A,2850285829);V=f(V,Y,X,W,C[P+2],z,4243563512);W=f(W,V,Y,X,C[P+7],y,1735328473);X=f(X,W,V,Y,C[P+12],w,2368359562);Y=D(Y,X,W,V,C[P+5],o,4294588738);V=D(V,Y,X,W,C[P+8],m,2272392833);W=D(W,V,Y,X,C[P+11],l,1839030562);X=D(X,W,V,Y,C[P+14],j,4259657740);Y=D(Y,X,W,V,C[P+1],o,2763975236);V=D(V,Y,X,W,C[P+4],m,1272893353);W=D(W,V,Y,X,C[P+7],l,4139469664);X=D(X,W,V,Y,C[P+10],j,3200236656);Y=D(Y,X,W,V,C[P+13],o,681279174);V=D(V,Y,X,W,C[P+0],m,3936430074);W=D(W,V,Y,X,C[P+3],l,3572445317);X=D(X,W,V,Y,C[P+6],j,76029189);Y=D(Y,X,W,V,C[P+9],o,3654602809);V=D(V,Y,X,W,C[P+12],m,3873151461);W=D(W,V,Y,X,C[P+15],l,530742520);X=D(X,W,V,Y,C[P+2],j,3299628645);Y=t(Y,X,W,V,C[P+0],U,4096336452);V=t(V,Y,X,W,C[P+7],T,1126891415);W=t(W,V,Y,X,C[P+14],R,2878612391);X=t(X,W,V,Y,C[P+5],O,4237533241);Y=t(Y,X,W,V,C[P+12],U,1700485571);V=t(V,Y,X,W,C[P+3],T,2399980690);W=t(W,V,Y,X,C[P+10],R,4293915773);X=t(X,W,V,Y,C[P+1],O,2240044497);Y=t(Y,X,W,V,C[P+8],U,1873313359);V=t(V,Y,X,W,C[P+15],T,4264355552);W=t(W,V,Y,X,C[P+6],R,2734768916);X=t(X,W,V,Y,C[P+13],O,1309151649);Y=t(Y,X,W,V,C[P+4],U,4149444226);V=t(V,Y,X,W,C[P+11],T,3174756917);W=t(W,V,Y,X,C[P+2],R,718787259);X=t(X,W,V,Y,C[P+9],O,3951481745);Y=K(Y,h);X=K(X,E);W=K(W,v);V=K(V,g)}var i=B(Y)+B(X)+B(W)+B(V);return i.toLowerCase()};


var io = require('socket.io').listen(2052); 
var express = require("express");
var mysql = require('mysql');
var cachedData = {
		'clan':[0,{ }],
		'cron':false,
		'bversion':{}
	};

io.sockets.on('connection', function (socket) {
	var ID = (socket.id).toString().substr(0, 5);
	var time = (new Date).toLocaleTimeString();	
	socket.on('message', function (msg) {});
	socket.on('getbattle', function (msg) {
		//Подключаемся к поединку
		socket.join('battle'+msg+'room');
		io.in('battle'+msg+'room').json.send({ 'event':'battle','data':'NEW_CONNECT_USER[battle'+msg+'room]' });
		socket.json.send({ 'event':'battle','data':{'SID':ID,'BID':msg} });
	});
	socket.on('leavebattle', function (msg) {
		//Отключаемся от поединка
		socket.json.send({ 'event':'battle','data':{'SID':ID,'BID':msg,'LEAVE':true} });
	});
	socket.on('disconnect', function() {});
});

var client = mysql.createConnection({
	host:		'localhost',
	user:		'like',
	password:	'23wesdxc',
	database:	'like'
});	

var battle_cache = {};
var battle_cache_new = {};

/*
io.sockets.clients(someRoom).forEach(function(s){
    s.leave(someRoom);
});
*/

function getbot(id,pass) {
	var key = MD5(id+'_cbrfCOreW@!_'+pass);
	var url = 'http://likebk.com/jx/battle/refresh_bot.php?bogsdf=true&cron_core='+key+'&uid='+id+'&pass='+pass;
	var http = require('http');
	var options = {
		host: 'likebk.com',
		path: url
	};
	//
	callback = function(response) {
		//Результат ответа	
	};
	var req = http.request(options, callback).end();
}

function cron(tm) {
	
	var timenow = parseInt(new Date().getTime()/1000);
	
	if( tm == 10 ) {
		//Каждые 10 сек
			
			//Проверка завершения поединков и удара ботов
			//db.query( 'SELECT `id`,`pass`,`battle` FROM `users` WHERE `id` IN (SELECT `id` FROM `stats` WHERE `bot` > 0 AND `timeGo` < '+(timenow-10)+') GROUP BY `battle`' ,function( e , r , f ){
			client.query( 'SELECT `a`.`id`,`a`.`pass`,`a`.`battle` FROM `users` AS `a` LEFT JOIN `stats` AS `b` ON (`b`.`bot` > 0 AND `a`.`id` = `b`.`id`) GROUP BY `a`.`battle` ORDER BY `b`.`hpNow` DESC' ,function( e , r , f ){
				var i = 0;
				while( i != -1 ) {
					if( r[i] != undefined ) {
						//Вселяемся в бота для размена
						getbot(r[i].id,r[i].pass);
					}else{
						i = -2;
					}
					i++;
				}
			});
	}
};

setInterval(function(){
	cron(10);
},15000);

function update_battle(id,key,data) {
	//timenow = parseInt(new Date().getTime()/1000);	
	client.query('UPDATE `battle` SET `update` = "'+key+'" WHERE `id` = "'+id+'" LIMIT 1',function(au1,bu2,cu3){
		client.query('SELECT * FROM `battle_logs` WHERE `battle` = "'+id+'" ORDER BY `id` DESC LIMIT 60',function(a,logs,c){
			client.query('SELECT `id`,`uid1`,`uid2`,`battle` FROM `battle_act` WHERE `battle` = "'+id+'" ORDER BY `id` DESC',function(a,acts,c){
				io.in('battle'+id+'room').json.send({ 'event':'battle_data_update','logs':logs,'acts':acts,'data':data,'key':key });		
			});		
		});		
	});
}

function check_st_data() {
	// боевая система
	client.query('SELECT `a`.`upd`,`b`.`login`,`b`.`battle`,`b`.`align`,`b`.`clan`,`b`.`level`,`b`.`sex`,`b`.`obraz`,`a`.`enemy`,`a`.`id`,`a`.`hpNow`,`a`.`mpNow`,`a`.`hpAll`,`a`.`mpAll`,`a`.`team`,`a`.`tactic1`,`a`.`tactic2`,`a`.`tactic3`,`a`.`tactic4`,`a`.`tactic5`, `a`.`tactic6`,`a`.`tactic7`,`a`.`bot`,`a`.`priems_z` FROM `stats` AS `a` LEFT JOIN `users` AS `b` ON `b`.`id` = `a`.`id` WHERE `b`.`battle` > 0 ORDER BY `b`.`battle` ASC , `a`.`team` ASC',function(a,b,c) {
		// a , b , c
		/*
		client.query('UPDATE `battle` SET `update` = "new2"',function(au1,bu2,cu3){
			setTimeout(function(){ check_st_data(); },100);	
		});
		*/
		//Данные которые нужно будет передавать пользователям
		a = {
			'battle_id':[0],
			'battle_key':{},
			'battle_data':{},
			'i':0
		}; 
		
		while( a.i != -1 ) {
			if( b[a.i] != undefined ) {
				/*
				client.query('UPDATE `battle` SET `update` = "'+a.i+'.'+b[a.i].id+'" WHERE `id` = "'+b[a.i].battle+'" LIMIT 1',function(au1,bu2,cu3){
						
				});
				*/
				if( a.battle_data[b[a.i].battle] == undefined ) {
					//Добавляем позицию
					a.battle_id[0]++;
					a.battle_id[a.battle_id[0]] = b[a.i].battle;
					a.battle_key[b[a.i].battle] = '['+b[a.i].id+','+b[a.i].hpNow+','+b[a.i].mpNow+','+b[a.i].upd+']';
					a.battle_data[b[a.i].battle] = [1];
					a.battle_data[b[a.i].battle][ a.battle_data[b[a.i].battle][0] ] = b[a.i];
				}else{
					//Обновляем позицию
					a.battle_key[b[a.i].battle] += '['+b[a.i].id+','+b[a.i].hpNow+','+b[a.i].mpNow+','+b[a.i].upd+','+b[a.i].priems_z+']';
					a.battle_data[b[a.i].battle][0]++;
					a.battle_data[b[a.i].battle][ a.battle_data[b[a.i].battle][0] ] = b[a.i];
				}
			}else{
				a.i = -2;
			}
			a.i++;
		}
		
		a.i = 1;
		while( a.i <= a.battle_id[0] ) {
			if( a.battle_id[a.i] != undefined ) {
				a.battle_key[a.battle_id[a.i]] = MD5(a.battle_key[a.battle_id[a.i]]);
				
				battle_cache_new[a.battle_id[a.i]] = a.battle_data[a.battle_id[a.i]];
				
				if( battle_cache[a.battle_id[a.i]] == undefined ) {
					battle_cache[a.battle_id[a.i]] = a.battle_key[a.battle_id[a.i]];
					//Передаем данные
					update_battle(a.battle_id[a.i],a.battle_key[a.battle_id[a.i]],a.battle_data[a.battle_id[a.i]]);
				}else{
					if( battle_cache[a.battle_id[a.i]] != a.battle_key[a.battle_id[a.i]] ) {
						battle_cache[a.battle_id[a.i]] = a.battle_key[a.battle_id[a.i]];
						update_battle(a.battle_id[a.i],a.battle_key[a.battle_id[a.i]],a.battle_data[a.battle_id[a.i]]);
					}
				}
			}else{
				a.i = -2;
			}
			a.i++;
		}
		
		setTimeout(function(){ check_st_data(); },5);
		
	});
}

check_st_data();

/*
setInterval(function() {
	// боевая система
	updatex++;
	client.query('SELECT `id` FROM `battle` WHERE `team_win` < 0 ORDER BY `id` ASC', function(error , result , fields) {
		//Обновляем Логов , НР + тактики участников , Эффекты участников , список участников
		if( result != undefined ) {
			var bi = 0;
			while( bi != -1 ) {
				if( result[bi] != undefined ) {
					client.query('SELECT `id`,"'+result[bi].id+'" AS `battle`,`hpNow`,`mpNow`,`hpAll`,`mpAll`,`team`,`tactic1`,`tactic2`,`tactic3`,`tactic4`,`tactic5`,`tactic6`,`tactic7`,`bot` FROM `stats` WHERE `id` IN ( SELECT `id` FROM `users` WHERE `battle` = "'+result[bi].id+'" ) ORDER BY `team` ASC',function(a,b,c) {
						// a , b , c
						var linemd5 = 'btl:';
						var i = 0;
						var bid = 0;
						while( i != -1 ) {
							if( b[i] != undefined ) {
								if( bid == 0 ) {
									bid = b[i].battle;
								}
								linemd5 += ','+b[i].id+','+b[i].hpNow+','+b[i].mpNow+','+b[i].team+','+b[i].tactic1+','+b[i].tactic2+','+b[i].tactic3+','+b[i].tactic4+','+b[i].tactic5+','+b[i].tactic6+','+b[i].tactic7;
							}else{
								i = -2;
							}
							i++;
						}
						linemd5 = MD5(linemd5);
						client.query('UPDATE `battle` SET `update` = "'+linemd5+'" WHERE `id` = "'+bid+'" LIMIT 1',function(u1a,u1b,u1c){});
					});
				}else{
					bi = -2;
				}
				bi++;
			}
		}
	});
	//
},100);
*/


var btlfinish = {};
setInterval(function() { 
			
		/*client.query('SELECT `id` FROM `battle` WHERE `team_win` = -1 AND `time_test` > 0 ORDER BY `id` ASC',function(error,result,fields){
			var i = 0;
			while( i != -1 ) {
				if( result[i] != undefined ) {
					var http_bot = require('http');
					var options_bot = {
					  host: 'likebk.com',
						  path: '/battle_finish.php?bid=' + result[i].id
					};
					//
					callback_bot = function(response) {	}
					//
					var req_bot = http_bot.request(options_bot, callback_bot).end();
				}else{
					i = -2;
				}
				i++;
			}
		});	*/
		
		client.query('UPDATE `users` SET `money` = `money` + 1 WHERE `id` = 987220 LIMIT 1', function(error, result, fields){});		
		if( cachedData.clan[0] < parseInt(new Date().getTime()/1000) - 60 ) {
			cachedData.clan[0] = parseInt(new Date().getTime()/1000);
			client.query('SELECT `id`,`name_mini`,`join1`,`join2` FROM `clan` ORDER BY `id` ASC', function(error, result, fields){
				cachedData.clan[1] = result;
				io.sockets.json.send({'event': 'clanList', 'clans': cachedData.clan[1]});
			});
			client.query('SELECT `id`,`clan1`,`clan2`,`type` FROM `clan_wars` WHERE `time_finish` > "' + parseInt(new Date().getTime()/1000) + '" ORDER BY `id` ASC', function(error, result, fields){
				cachedData.clan[2] = result;
				io.sockets.json.send({'event': 'warList', 'wars': cachedData.clan[2]});
			});
		}else{
			io.sockets.json.send({'event': 'clanList', 'clans': cachedData.clan[1]});
			io.sockets.json.send({'event': 'warList', 'wars': cachedData.clan[2]});
		}		
		client.query('SELECT `b`.`dnow`,`a`.`id`,`a`.`login`,`a`.`level`,`a`.`align`,`a`.`clan`,`a`.`online`,`a`.`room`,`a`.`battle`,`a`.`molch1`,`a`.`dealer`,`a`.`sex` FROM `users` AS `a` LEFT JOIN `stats` AS `b` ON `a`.`id` = `b`.`id` WHERE `a`.`online` > "' + ( parseInt(new Date().getTime()/1000) - 120 ) + '" ORDER BY `a`.`login` ASC', function(error, result, fields){
			io.sockets.json.send({'event': 'onlineList', 'online': result});
		});		
		var td = new Date();
		td = [td,null,null,null];
		td[1] = td[0].getHours();
		if( td[1] < 10 ) {
			td[1] = '0'+td[1];
		}
		td[2] = td[0].getMinutes();
		if( td[2] < 10 ) {
			td[2] = '0'+td[2];
		}
		td[3] = td[0].getSeconds(); 
		if( td[3] < 10 ) {
			td[3] = '0'+td[3];
		}
		td[4] = td[0].getDay(); 
		td[5] = td[0].getMonth();
		td[6] = td[0].getYear();		
		client.query('SELECT `id`,`dn`,`type`,`login`,`to`,`text`,`time`,`color`,`room`,`delete`,`typeTime` FROM `chat` WHERE `time` > "' + ( parseInt(new Date().getTime()/1000) - 2 ) + '" AND `new` > 0 ORDER BY `id` ASC', function(error, result, fields){
			io.sockets.json.send({'event': 'chatList', 'chat': result , 'time':td });
		});		
		client.query('SELECT `id` FROM `chat` WHERE `time` > "' + ( parseInt(new Date().getTime()/1000) - 15*60 ) + '" AND `new` > 0 AND `delete` > 0', function(error, result, fields){
			io.sockets.json.send({'event': 'chatDeleteList', 'chatDelete': result});
		});
	
}, 500);

/*
		var time = (new Date).toLocaleTimeString();	
		
		client.query('INSERT INTO `online_chat_zp` (`data`,`time`) VALUES ("AUTO_REFLESH","' + time + '")', function(error, result, fields){	});
		
		if( cachedData.clan[0] < parseInt(new Date().getTime()/1000) - 60 ) {
			cachedData.clan[0] = parseInt(new Date().getTime()/1000);
			client.query('SELECT `id`,`name_mini`,`join1`,`join2` FROM `clan` ORDER BY `id` ASC', function(error, result, fields){
				cachedData.clan[1] = result;
				io.sockets.json.send({'event': 'clanList', 'clans': cachedData.clan[1]});
			});
			client.query('SELECT `id`,`clan1`,`clan2`,`type` FROM `clan_wars` WHERE `time_finish` > "' + parseInt(new Date().getTime()/1000) + '" ORDER BY `id` ASC', function(error, result, fields){
				cachedData.clan[2] = result;
				io.sockets.json.send({'event': 'warList', 'wars': cachedData.clan[2]});
			});
			//console.log('UPDATE-clans');
		}else{
			io.sockets.json.send({'event': 'clanList', 'clans': cachedData.clan[1]});
			io.sockets.json.send({'event': 'warList', 'wars': cachedData.clan[2]});
		}
		
		client.query('SELECT `id`,`login`,`level`,`align`,`clan`,`online`,`room`,`battle`,`molch1`,`dealer` FROM `users` WHERE `online` > "' + ( parseInt(new Date().getTime()/1000) - 120 ) + '" AND `real` > 0 ORDER BY `login` ASC', function(error, result, fields){
			//socket.json.send({'event': 'onlineList', 'online': result});
			io.sockets.json.send({'event': 'onlineList', 'online': result});
		});
		
		//Время
		var td = new Date();
		td = [td,null,null,null];
		td[1] = td[0].getHours();
		if( td[1] < 10 ) {
			td[1] = '0'+td[1];
		}
		td[2] = td[0].getMinutes();
		if( td[2] < 10 ) {
			td[2] = '0'+td[2];
		}
		td[3] = td[0].getSeconds(); 
		if( td[3] < 10 ) {
			td[3] = '0'+td[3];
		}
		td[4] = td[0].getDay(); 
		td[5] = td[0].getMonth();
		td[6] = td[0].getYear();	
		
		client.query('SELECT `id`,`dn`,`type`,`login`,`to`,`text`,`time`,`color`,`room`,`delete`,`typeTime` FROM `chat` WHERE `time` > "' + ( parseInt(new Date().getTime()/1000) - 2 ) + '" AND `new` > 0 ORDER BY `id` ASC', function(error, result, fields){
			//socket.json.send({'event': 'chatList', 'chat': result});
			io.sockets.json.send({'event': 'chatList', 'chat': result , 'time':td });
		});
		
		client.query('SELECT `id` FROM `chat` WHERE `time` > "' + ( parseInt(new Date().getTime()/1000) - 15*60 ) + '" AND `new` > 0 AND `delete` > 0', function(error, result, fields){
			//socket.json.send({'event': 'chatList', 'chat': result});
			io.sockets.json.send({'event': 'chatDeleteList', 'chatDelete': result});
		});
		
		client.end();
*/