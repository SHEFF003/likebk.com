<?php
// 278057245:AAHgruvUlkLOfJIB2_Vsgt8ZaWym1xBq7fs
// https://api.telegram.org/bot278057245:AAHgruvUlkLOfJIB2_Vsgt8ZaWym1xBq7fs/setwebhook?url=https://devgeneral.com/telegram_in/3/test

class TelegramAPI {
	
	public function callAPI( $method, $params) {
		$url = sprintf(
			"https://api.telegram.org/bot278057245:AAHgruvUlkLOfJIB2_Vsgt8ZaWym1xBq7fs%s/%s",
			'',
			$method
		);
		
		$ch = curl_init();
		@curl_setopt_array( $ch, array(
			CURLOPT_URL             => $url,
			CURLOPT_POST            => TRUE,
			CURLOPT_RETURNTRANSFER  => TRUE,
			CURLOPT_FOLLOWLOCATION  => FALSE,
			CURLOPT_HEADER          => FALSE,
			CURLOPT_TIMEOUT         => 10,
			CURLOPT_HTTPHEADER      => array( 'Accept-Language: ru,en-us'),
			CURLOPT_POSTFIELDS      => $params,
			
		));
	
		$response = curl_exec($ch);
		return json_decode( $response);
	}
	
	public static function connect() {
		
		//$post = json_decode( @$_POST['post'] );
		//$get = json_decode( @$_POST['get'] );
		$_POST['content'] = iconv('UTF-8','cp1251',$_POST['content']);
		$content = json_decode( @$_POST['content'] );		
		if( isset($content->message->chat->id) ) {
			$r = $content;
		}else{
			$r = false;
		}		
		return $r;
		
	}
	
	public static function start() {
		//
		$r = self::connect();		
		if( $r == false ) {
			echo 'Error message!';
		}else{
			//
			$NO_RETURN = false;
			$keyboard = array(
				array( iconv('CP1251','UTF-8','Обновить') )
			);
			//
			$pers = mysql_fetch_array(mysql_query('SELECT * FROM `telegram_user` WHERE `chat_id` = "'.mysql_real_escape_string($r->message->from->id).'" LIMIT 1'));
			if(!isset($pers['id'])) {
				$html = 'Ваш аккаунт не привязан ни к одному из игроков. Чтобы это сделать наберите команду в чате телеграмм: connect < id-персонажа > < пароль от персонажа > (Например: connect 12345 password). После этого все сообщения будут приходить к вам в Телеграмм.';
			}else{
				$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$pers['uid'].'" LIMIT 1'));
				$html = 'Ваш аккаунт привязан к персонажу: ' . $usr['login'] . ' ['.$usr['level'].']  | Чтобы начать диалог с кем-то наберите команду: dialog < логин персонажа > | Чтобы отправить сообщение без диалога, наберите команду: send < логин персонажа > private < текст сообщения >.';
			}
			//
			if( iconv('UTF-8','cp1251',$r->message->text) == 'Закрыть этот диалог' ) {
				$r->message->text = 'dialog exit';
			}
			//Команды для бота
			if( mb_substr( $r->message->text, 0, 4 ) == 'help' ) {
				
			}elseif( mb_substr( $r->message->text, 0, 4 ) == 'test' ) {
				$html = '#OUTPUT_TEST';
			}elseif( mb_substr( $r->message->text, 0, 7 ) == 'connect' ) {
				//
				$uid = explode(' ',$r->message->text);
				$uid = $uid[1];
				$psw = str_replace('connect '.$uid.' ','',$r->message->text);
				//
				$pers = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($uid).'" AND `pass` = "'.mysql_real_escape_string(md5($psw)).'" LIMIT 1'));
				if(!isset($pers['id'])) {
					$html = 'Персонаж с таким ID и паролем не найден!';
				}else{
					mysql_query('INSERT INTO `telegram_user` (`uid`,`chat_id`,`chat_room`) VALUES ("'.$pers['id'].'","'.mysql_real_escape_string($r->message->from->id).'","'.mysql_real_escape_string($r->message->chat->id).'")');
					$html = 'Персонаж "'.$pers['login'].' ['.$pers['level'].']" успешно подключен к вашему телеграмму! Теперь вы будете получать сообщения от других игроков прямо здесь!';
				}
			}elseif( mb_substr( $r->message->text, 0, 5 ) == 'send ' && isset($usr['id']) ) {
				$r->message->text = iconv('UTF-8','cp1251',$r->message->text);
				$login = str_replace('send ','',$r->message->text);
				$login = explode(' to ', $login);
				$type = -1;
				$type_v = '';
				if(isset($login[0]) && isset($login[1])) {
					$type = 1;
					$type_v = 'to';
				}else{
					$login = str_replace('send ','',$r->message->text);
					$login = explode(' private ', $login);
					if(isset($login[0]) && isset($login[1])) {
						$type = 3;
						$type_v = 'private';
					}
				}
				//
				if( $type == -1 ) {
					$html = 'Тип сообщение не опознан! Используйте обычную отправку"send < логин персонажа > to < текст сообщение >" или приватной отправки "send < логин персонажа > private < текст сообщение >"';
				}else{
					$login = $login[0];
					//send admin private test
					$text = str_replace('send '.$login.' '.$type_v.' ','',$r->message->text);
					$touser = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($login).'" ORDER BY `id` ASC LIMIT 1'));
					if(isset($touser['id'])) {
						$text = str_replace('"','',$text);
						$text = str_replace("'",'',$text);
						$text = str_replace("<",'',$text);
						$text = str_replace(">",'',$text);
						$text = str_replace("\x3C",'',$text);
						$text = str_replace("&lt;",'',$text);
						if(mysql_query('INSERT INTO `chat` (
							`city`,`room`,`new`,`login`,`to`,`type`,`text`,`time`,`color`
						) VALUES (
							"'.$usr['city'].'","'.$usr['room'].'",
							"1","'.$usr['login'].'","'.$touser['login'].'","'.$type.'","'.mysql_real_escape_string($text).'",
							"'.time().'","'.$usr['chatColor'].'"
						)')) {
							$html = 'Сообщение для "'.$login.'" было успешно доставлено!';
						}else{
							$html = 'Сбой в отправке сообщения!';
						}
					}else{
						$html = 'Персонаж с логином "'.$login.'" не найден!';
					}
				}
				//				
			}elseif( mb_substr( $r->message->text, 0, 7 ) == 'dialog ' && isset($usr['id']) ) {
				$r->message->text = iconv('UTF-8','cp1251',$r->message->text);
				$login = str_replace('dialog ','',$r->message->text);
				if( $login == 'exit' || $login == 'off' ) {
					mysql_query('UPDATE `telegram_user` SET `dialog` = "" WHERE `id` = "'.$pers['id'].'" LIMIT 1');
					$html = 'Вы успешно закрыли личный диалог!';
				}else{
					$touser = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($login).'" ORDER BY `id` ASC LIMIT 1'));
					if(isset($touser['id'])) {
						mysql_query('UPDATE `telegram_user` SET `dialog` = "'.$touser['login'].'" WHERE `id` = "'.$pers['id'].'" LIMIT 1');
						$html = 'Вы открыли диалог с персонажем "'.$login.'", теперь все сообщения (кроме команд) будут поступать к этому персонажу! (Чтобы завершить идалог наберите команду "dialog exit")';
					}else{
						$html = 'Персонаж с логином "'.$login.'" не найден!';
					}
				}
			}elseif(isset($usr['id'])) {
				$r->message->text = iconv('UTF-8','cp1251',$r->message->text);
				if($pers['dialog'] != '') {
					$touser = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($pers['dialog']).'" ORDER BY `id` ASC LIMIT 1'));
					if(isset($touser['id'])) {
						$text = $r->message->text;
						$text = str_replace('"','',$text);
						$text = str_replace("'",'',$text);
						$text = str_replace("<",'',$text);
						$text = str_replace(">",'',$text);
						$text = str_replace("\x3C",'',$text);
						$text = str_replace("&lt;",'',$text);
						if( $r->message->text == '<--' || $r->message->text == '-->' || $r->message->text == $touser['login'] || $r->message->text == 'Обновить' ) {
							$html = '';
						}elseif(mysql_query('INSERT INTO `chat` (
							`city`,`room`,`new`,`login`,`to`,`type`,`text`,`time`,`color`
						) VALUES (
							"'.$usr['city'].'","'.$usr['room'].'",
							"1","'.$usr['login'].'","'.$touser['login'].'","3","'.mysql_real_escape_string($text).'",
							"'.time().'","'.$usr['chatColor'].'"
						)')) {
							$html = 'Сообщение для "'.$touser['login'].'" было успешно доставлено! (Чтобы завершить идалог наберите команду "dialog exit")';
							$html = '';
						}else{
							$html = 'Сбой в отправке сообщения! (Чтобы завершить идалог наберите команду "dialog exit")';
						}
					}else{
						$html = 'Персонаж с логином "'.$pers['dialog'].'" не найден! (Чтобы завершить идалог наберите команду "dialog exit")';
					}
				}
			}
			//
			if( $NO_RETURN == false ) { 
				$resp = array("keyboard" => $keyboard,"resize_keyboard" => true,"one_time_keyboard" => true);
				$reply = json_encode($resp);
				$input = self::callAPI(
					'sendMessage', array(
						'chat_id'		=> $r->message->chat->id,
						'text'			=> iconv('CP1251','UTF-8',$html),
						'reply_markup'	=> $reply
					)
				);
				if( $input == false ) {
					$input = '#false';
				}
				mysql_query('INSERT INTO `input` (`get`,`post`,`content`) VALUES ("#OUTPUT","'.mysql_real_escape_string($r->message->chat->id).'","'.mysql_real_escape_string($input).'")');
			}
			//
		}
		//
	}
	
}

?>