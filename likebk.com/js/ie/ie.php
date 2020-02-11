<link href="http://<?= $c['host']?>/js/ie/iemodal.css" rel="stylesheet" type="text/css">
<?php
  $user_agent = $_SERVER["HTTP_USER_AGENT"];
  if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
  elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
  elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
  elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
  elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
  else $browser = "Неизвестный";
  if($browser != 'Firefox' && $browser != 'Opera' && $browser != 'Chrome' && $browser != 'Safari'){?>
<!-- само модальное окно -->
 <div id="ModalOpen" class="Window">
	 <div>
		 <a style="cursor: pointer;" title="Закрыть" class="close">X</a>
		 <h3>Внимание! Ваш браузер не поддерживается проектом LikeBK!</h3>
		 <p>Для корректной работы игры, советуем воспользоваться одним из перечисленных ниже браузеров: </p>
		 <div id="jr_inner" style="min-width: 500px; max-width: 700px; width: auto;">
			 <ul>
			 <li id="jr_chrome" style="background: url('http://<?= $c['host']?>/js/ie/browser/background_browser.gif') left top no-repeat scroll transparent;">
				 <div class="jr_icon" style="background: url('http://<?= $c['host']?>/js/ie/browser/browser_chrome.gif') left top no-repeat scroll transparent;"></div>
				 <div><a target="_blank" href="http://www.google.com/chrome/">Google Chrome</a></div>
			 </li>
			 <li id="jr_firefox" style="background: url('http://<?= $c['host']?>/js/ie/browser/background_browser.gif') left top no-repeat scroll transparent;">
			 	<div class="jr_icon" style="background: url('http://<?= $c['host']?>/js/ie/browser/browser_firefox.gif') left top no-repeat scroll transparent;"></div>
			 	<div><a target="_blank" href="http://www.mozilla.com/firefox/">Mozilla Firefox</a></div>
			 </li>
			 <li id="jr_safari" style="background: url('http://<?= $c['host']?>/js/ie/browser/background_browser.gif') left top no-repeat scroll transparent;">
			 	<div class="jr_icon" style="background: url('http://<?= $c['host']?>/js/ie/browser/browser_safari.gif') left top no-repeat scroll transparent;"></div>
			 	<div><a target="_blank" href="http://www.apple.com/safari/download/">Safari</a></div>
			 </li>
			 <li id="jr_opera" style="background: url('http://<?= $c['host']?>/js/ie/browser/background_browser.gif') left top no-repeat scroll transparent;">
			 	<div class="jr_icon" style="background: url('http://<?= $c['host']?>/js/ie/browser/browser_opera.gif') left top no-repeat scroll transparent;"></div>
			 	<div><a target="_blank" href="http://www.opera.com/download/">Opera</a></div>
			 </li>
			 </ul>
			 <div style="clear: both;"></div>
		 </div>
	 </div>
 </div>
<? }
?>
<script type="text/javascript">
	jQuery( document ).ready(function($) {
		$('.Window').slideToggle('slow');
		$('.close').click(function(){
			$('.Window').slideToggle('slow');
		});
		//setInterval(win, 60000);
		function win(){
			if($('.Window').css('display') === 'none'){
				$('.Window').slideToggle('slow');
			}
		}
	})
</script>