<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author: mZer0ne
 * Engine: comEngine
 * Copyright: mZer0ne works (c) 2015
 */
$menu = array(
	'users'=>array(
		'name'=>'Пользователи',
		'icon'=>'assets/system/cms_icons/cms_UsersManagement.gif',
		'pages'=>array(
			'user_list'=>array('Список пользователей', 2)
		)
	),
	'main'=>array(
		'name'=>'Основное',
		'icon'=>'assets/system/cms_icons/cms_SystemSettings.gif',
		'pages'=>array(
			'locations_list'=>array('Список локаций', 4)
		)
	),
	'bots'=>Array(
		'name'=>'Боты',
		'icon'=>'assets/system/cms_icons/cms_SiteStructure.gif',
		'pages'=>Array(
			'bot_class_list'=>Array('Шаблоны ботов', 16), 
			'bot_list'=>Array('Список ботов', 16), 
			'bot_koef'=>Array('Коэффициент уровня ботов', 16), 
			'bot_game_add'=>Array('Добавление в игру', 16)
		)
	),
	'underground'=>array(
		'name'=>'Подземелья',
		'icon'=>'assets/system/cms_icons/cms_SiteStructure.gif',
		'pages'=>array(
			'underground_mobs_list'=>array('Список ботов', 8),
			'underground_objects_list'=>array('Список объектов', 8),
			'dungeon_list'=>array('Список подземелий', 8)
		)
	)
);
// Статистика сервера
$online = $this->db->get_where('users', array('online > ' => (time() - 600)))->num_rows();
$la = sys_getloadavg();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo $Configs['cdnserv']; ?>assets/system/files/styles.css" type="text/css" />
<title>Центр управления</title>
</head>
<body class="cms_BODY">
<script src="<?php echo $Configs['cdnserv']; ?>js/jquery.min.js" language="javascript"></script>
<script src="<?php echo $Configs['cdnserv']; ?>assets/system/jscript/kernel.js" language="javascript"></script>
<script src="<?php echo $Configs['cdnserv']; ?>assets/system/jscript/menu.js" language="javascript"></script>
<table id="cms_top" cellspacing="0" cellpadding="0" width="100%" border="0" style=" background-image:url(<?php echo $Configs['cdnserv']; ?>assets/system/cms_bgtop.jpg); background-repeat:repeat-x">
  <tbody>
    <tr>
      <td width="348" height="51" align="left" nowrap="nowrap"><a href="index.htm" title="Redline Management System"><img src="<?php echo $Configs['cdnserv']; ?>assets/system/cms_top.jpg" width="348" height="51" border="0" /></a></td>
      <td align="right" nowrap="nowrap">Онлайн: <?php echo $online; ?> / Нагрузка CPU: <?php echo round(($la[0]/4)*100,2); ?>% / Нагрузка USI: <?php echo round((round(($la[2]/4)*100,2)/$online),2); ?>% / Время сервера: <?php echo date('H:i:s'); ?> ( <?php echo time(); ?> ) / <a href="/index.php?logout=yes" title="Close">Выход</a><img src="<?php echo $Configs['cdnserv']; ?>assets/system/spacer.gif" width="15" height="1" border="0" /></td>
    </tr>
  </tbody>
</table>
<table width="100%" height="100%" border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td valign="top" height="100%" style="background:url(<?php echo $Configs['cdnserv']; ?>assets/system/leftbg.gif) top right; background-repeat:repeat-y; background-color: #E2E2E2">
        <div id="cms_leftmenu"><?php
	$menu_html='<table width="175" cellpadding="0" cellspacing="0">
            <tbody>
              ';
    foreach($menu as $section=>$prop){
        $shtml = '<tr>
                <td width="1%"><img src="' . $Configs['cdnserv'] . $prop['icon'] . '" width="18" height="18" hspace="3" title="'.$prop['name'].'" /></td>
                <td nowrap="nowrap" class="cms_liner"><a href="#" class="cms_menu1" title="'.$prop['name'].'" onclick="menuClick(\''.$section.'\')" >'.$prop['name'].'</a></td>
              </tr>
              <tr>
                <td></td>
                <td align="left" nowrap="nowrap">
                    <div id="div_'.$section.'" '.(isset($_COOKIE) && isset($_COOKIE['menu_'.$section]) && $_COOKIE['menu_'.$section]=='Y'?'style="display: none;"':'').' >
                    <ul>';
              
        $i = 0;
        $phtml = '';
        foreach($prop['pages'] as $page=>$opt){
            if ($opt[1]=='' || $this->players->hasPermission(NULL, $this->info, $opt[1])){
                $i++;
                $phtml.= '<li><a href="'.$page.'.htm'.($section=='stats'?"?set_default=Y":"").'" title="'.$opt[0].'"><img src="' . $Configs['cdnserv'] . 'assets/system/dotgreen.gif" width="3" height="3" hspace="5" vspace="2" />'.$opt[0].'</a></li>';
            }
        }
        
        if ($i>0)
        $menu_html.= $shtml.$phtml.'</ul></div></td>
              </tr>';
    }
    $menu_html.='</tbody>
          </table><br /><br />
          ';
    
echo $menu_html;
?></div>
	  </td>
      <td valign="top" width="100%" height="100%">
        <div id="cms_content"><?php echo $content; ?></div>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>