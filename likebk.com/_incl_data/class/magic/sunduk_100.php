<?
if(!defined('GAME'))
{
	die();
}	
	if($tr['var_id'] != '') {
		 
		$io = '';

		$itmlid = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$this->info['id'].'" AND `delete` = 0 ORDER BY `id` DESC LIMIT 1'));
		$itmlid = $itmlid['id'];
		
		if( (int)date('Y') < 2020 || ( (int)date('m') == 1 && (int)date('d') < 10 ) )  {
			$no_open_itm = true;		
			$this->error = 'Открыть возможно 10 января 2020! ;) (Сейчас '.date('d.m.Y').')';
			if( $this->info['admin'] > 0 ) {
				$this->error .= '(Если '.(int)date('Y').' >= 2018 и ( '.(int)date('m').' > 1 или '.(int)date('d').' >= 10 ))';
			}
			$this->error = '';
		}elseif($tr['var_id'] == 5) {
			/*
				весь гос обкаст + екр эликсиры на статы + жажда жизни 6 + екровый бутер на хп
			*/
			
			//$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			//$this->addItem(6844,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			//$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			//$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			//$i = array( 911 , 1172 , 1173 , 2141 );
			//$i = $i[rand(0,count($i)-1)];
			//$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
						
			//$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,30);
			//$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,30);
			
			//if( rand(0,100) < 31 ) {
			//	$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			//}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3101,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			//$this->addItem(6858,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= 'Все предметы добавлены к вам в инвентарь! Крушите и ломайте черепа вашим противникам, а эти предметы вам помогут!';
			
		}elseif($tr['var_id'] == 4) {
			/*
				тактика боя 5 (5084) 0/3
				 Нелечимое нападение [1ч.] 0\5
				 излечение нелечимого нападения 0\3
				Сфера непроницаемости, закрыть поединок 0\1
				один из свитка +50 статов на 3 часа 0\2
				Восстановление энергии 1500HP 0\30
				Восстановление энергии 1500MP  0\30
				бронзовая книга шанс выпасть 30%
				набор екр и гос свитков и эликсиров
				свиток опыт +10% на 7 дней не суммируется с тем что +100 в 500 екровом сундуке
			*/
			
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			$this->addItem(6844,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			//$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			//$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
						
			$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,30);
			$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,30);
			
			if( rand(0,100) < 31 ) {
				$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			$this->addItem(6858,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= 'Все предметы добавлены к вам в инвентарь! Крушите и ломайте черепа вашим противникам, а эти предметы вам помогут!';
			
		}elseif($tr['var_id'] == 3) {
			/*
				тактика боя 5 (5084) 0/5
				 Нелечимое нападение [2ч.] 0\5
				 излечение нелечимого нападения 0\1
				Сфера непроницаемости, закрыть поединок 0\2
				один из свитка +50 статов на 3 часа 0\2
				 неуз маг на 3 часа 0\1, неуяз воин 0\1
				Восстановление энергии 1500HP 0\40
				Восстановление энергии 1500MP  0\40
				бронзовая книга шанс выпасть 50%
				набор екр и гос свитков и эликсиров
				свиток опыт +20% на 7 дней не суммируется с тем что +100 в 500 екровом сундуке
			*/
			
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			$this->addItem(6844,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			//$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
			
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
			
			//$this->addItem(6853,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1); //42 eff 475
			//$this->addItem(6854,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1); //43 eff 476
			
			$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,40);
			$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,40);
			
			if( rand(0,100) < 51 ) {
				$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			$this->addItem(6857,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= 'Все предметы добавлены к вам в инвентарь! Крушите и ломайте черепа вашим противникам, а эти предметы вам помогут!';
			
		}elseif($tr['var_id'] == 2) {
			/*
				тактика боя 5 (5084) 0/5
				 Нелечимое нападение [3ч.] 0\5
				 излечение нелечимого нападения 0\3
				Сфера непроницаемости, закрыть поединок 0\3
				один из свитка +50 статов на 3 часа 0\3
				 неуз маг на 3 часа 0\1, неуяз воин 0\1
				Восстановление энергии 1500HP 0\50
				Восстановление энергии 1500MP  0\50
				бронзовая книга шанс выпасть 80%
				набор екр и гос свитков и эликсиров
				свиток опыт +30% на 7 дней не суммируется с тем что +100 в 500 екровом сундуке
			*/
			
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			$this->addItem(6845,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			//$this->addItem(6853,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1); //42 eff 475
			//$this->addItem(6854,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1); //43 eff 476
			
			$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,50);
			$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,50);
			
			if( rand(0,100) < 81 ) {
				$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			$this->addItem(6856,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');

			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= 'Все предметы добавлены к вам в инвентарь! Крушите и ломайте черепа вашим противникам, а эти предметы вам помогут!';
			
		}elseif($tr['var_id'] == 1) {
			/*
				тактика боя 5 (5084) 0/10 
				 Нелечимое нападение [5ч.] 0\10,
				 излечение нелечимого нападения 0\10				 
				Сфера непроницаемости, закрыть поединок 0\10
				один из свитка +50 статов на 3 часа 0\5
				неуз маг на 3 часа 0\3, неуяз воин 0\3 2143 ? 2144
				Восстановление энергии 1500HP 0\100
				Восстановление энергии 1500MP  0\75				
				золотая книга шанс выпасть 20%				
				набор екр и гос свитков и эликсиров				
				опыт +100% на 7 дней
			*/
			
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			
			$this->addItem(6921,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			
			$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			
			$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			//$this->addItem(6853,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3); //42 eff 475
			//$this->addItem(6854,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3); //43 eff 476
			
			$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,75);
			
			//if( rand(0,100) < 81 ) {
				$this->addItem(3198,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
				$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			//}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			$this->addItem(6855,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= 'Все предметы добавлены к вам в инвентарь! Крушите и ломайте черепа вашим противникам, а эти предметы вам помогут!';
			
		}else{
			$no_open_itm = true;		
			$this->error = 'В сундуке ничего нет! Напишите администрации, мы вам поможем! :)';
		}
		
		if( $no_open_itm != true ) {
			$sp50 = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$this->info['id'].'" AND `delete` = 0 AND `id` > "'.$itmlid.'"');
			while( $pl50 = mysql_fetch_array($sp50) ) {
				$itmmz = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$pl50['item_id'].'" LIMIT 1'));
				$itmlidtxt .= ', &quot;'.$itmmz['name'].' (0/'.ceil($pl50['iznosMAX']).')&quot;';
			}
			$itmlidtxt = ltrim($itmlidtxt,', ');
			$io = 'Внутри были предметы: '.$itmlidtxt;
			unset($pl50,$sp50,$itmlidtxt,$itmlid);
		}
		
	}
	unset($i5,$i3,$i4);
?>