// Создаем текст сообщений для событий
strings = {
	'connected': '[sys][time]%time%[/time]: [user]%name%[/user].[/sys]',
	'userJoined': '[sys][time]%time%[/time]: [user]%name%[/user].[/sys]',
	'messageSent': '[out][time]%time%[/time]: [user]%name%[/user]: %text%[/out]',
	'messageReceived': '[in][time]%time%[/time]: [user]%name%[/user]: %text%[/in]',
	'userSplit': '[sys][time]%time%[/time]: [user]%name%[/user].[/sys]'
};
window.onload = function() {
	// Создаем соединение с сервером; websockets почему-то в Хроме не работают, используем xhr
	socket = io.connect('http://likebk.com:8081');
	socket.on('connect', function () {
		alert('connect!');
		socket.on('message', function (msg) {
			if( msg.event == 'onlineList' ) {
				//console.log( msg.online );
			}else if( msg.event == 'chatList' ) {
				//console.log( msg.chat );
			}else{
				// Добавляем в лог сообщение, заменив время, имя и текст на полученные
				document.querySelector('#log').innerHTML += strings[msg.event].replace(/\[([a-z]+)\]/g, '<span class="$1">').replace(/\[\/[a-z]+\]/g, '</span>').replace(/\%time\%/, msg.time).replace(/\%name\%/, msg.name).replace(/\%text\%/, unescape(msg.text).replace('<', '&lt;').replace('>', '&gt;')) + '<br>';
				// Прокручиваем лог в конец
				document.querySelector('#log').scrollTop = document.querySelector('#log').scrollHeight;
			}
		});
		// При нажатии <Enter> или кнопки отправляем текст
		document.querySelector('#input').onkeypress = function(e) {
			if (e.which == '13') {
				// Отправляем содержимое input'а, закодированное в escape-последовательность
				socket.send(escape(document.querySelector('#input').value));
				// Очищаем input
				document.querySelector('#input').value = '';
			}
		};
		/*document.querySelector('#send').onclick = function() {
			socket.send(escape(document.querySelector('#input').value));
			document.querySelector('#input').value = '';
		};*/		
	});
};