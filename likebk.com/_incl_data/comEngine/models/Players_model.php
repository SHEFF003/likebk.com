<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author: mZer0ne
 * Engine: comEngine
 * Copyright: mZer0ne works (c) 2015
 */
class Players_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function getUser($id = NULL){
		$this->db->select('u.nextBonus,u.stopexp,u.twink,u.send,u.activ,u.b1,u.nadmin,u.fnq,u.id,u.login,u.login2,u.pass,u.pass2,u.repass,u.notrhod,u.emailconfirmation,u.securetime,u.sys,u.palpro,u.online,u.ip,u.ipreg,u.joinIP,u.admin,u.city,u.room,u.banned,u.auth,u.align,u.mod_zvanie,u.clan,u.nextMsg,u.molch1,u.molch2,u.molch3,u.level,u.money,u.money4,u.money3,u.money3,u.battle,u.cityreg,u.invBlock,u.allLock,u.invBlockCode,u.zag,u.a1,u.q1,u.mail,u.name,u.bithday,u.sex,u.city_real,u.icq,u.icq_hide,u.homepage,u.deviz,u.hobby,u.chatColor,u.timereg,u.add_smiles,u.obraz,u.win,u.lose,u.nich,u.cityreg2,u.host,u.info_delete,u.dateEnter,u.afk,u.dnd,u.timeMain,u.clan_prava,u.addpr,u.marry,u.city2,u.invis,u.bot_id,u.haos,u.host_reg,u.inUser,u.inTurnir,u.inTurnirnew,u.jail,u.animal,u.vip,u.catch,u.frg,u.no_ip,u.type_pers,u.bot_room,st.id,st.btl_cof,st.last_hp,st.last_pr,st.smena,st.stats,st.hpNow,st.mpNow,st.enNow,st.transfers,st.regHP,st.regMP,st.showmenu,st.prmenu,st.ability,st.skills,st.sskills,st.nskills,st.exp,st.minHP,st.minMP,st.zv,st.dn,st.dnow,st.team,st.battle_yron,st.battle_exp,st.enemy,st.last_a,st.last_b,st.battle_text,st.upLevel,st.wipe,st.bagStats,st.timeGo,st.timeGoL,st.nextAct,st.active,st.bot,st.lastAlign,st.tactic1,st.tactic2,st.tactic3,st.tactic4,st.tactic5,st.tactic6,st.tactic7,st.x,st.y,st.s,st.battleEnd,st.priemslot,st.priems,st.priems_z,st.bet,st.clone,st.atack,st.bbexp,st.ref_data,st.res_x,st.res_y,st.res_s,st.bn_capitalcity,st.bn_demonscity,r.noatack')->
			from('users AS u')->
			join('stats AS st', 'u.id = st.id', 'left')->
			join('room AS r', 'u.room = r.id', 'left');
		if($id != NULL){
			$this->db->where(array(
				'u.id' => intval($id)
			));
		} else {
			$this->db->where(array(
				'u.login' => $this->db->escape_str($this->input->cookie('login', true)),
				'u.pass' => $this->db->escape_str($this->input->cookie('pass', true))
			));
		}
		$query = $this->db->get();
		
//		echo $this->db->last_query();
		return $query->row_array();
	}
/*
	'SELECT 
		`u`.`nextBonus`,`u`.`stopexp`,`u`.`twink`,`u`.`send`,`u`.`activ`,`u`.`b1`,`u`.`nadmin`,`u`.`fnq`,`u`.`id`,`u`.`login`,`u`.`login2`,`u`.`pass`,`u`.`pass2`,`u`.`repass`,`u`.`notrhod`,`u`.`emailconfirmation`,`u`.`securetime`,`u`.`sys`,`u`.`palpro`,`u`.`online`,`u`.`ip`,`u`.`ipreg`,`u`.`joinIP`,`u`.`admin`,`u`.`city`,`u`.`room`,`u`.`banned`,`u`.`auth`,`u`.`align`,`u`.`mod_zvanie`,`u`.`clan`,`u`.`nextMsg`,`u`.`molch1`,`u`.`molch2`,`u`.`molch3`,`u`.`level`,`u`.`money`,`u`.`money4`,`u`.`money3`,`u`.`money3`,`u`.`battle`,`u`.`cityreg`,`u`.`invBlock`,`u`.`allLock`,`u`.`invBlockCode`,`u`.`zag`,`u`.`a1`,`u`.`q1`,`u`.`mail`,`u`.`name`,`u`.`bithday`,`u`.`sex`,`u`.`city_real`,`u`.`icq`,`u`.`icq_hide`,`u`.`homepage`,`u`.`deviz`,`u`.`hobby`,`u`.`chatColor`,`u`.`timereg`,`u`.`add_smiles`,`u`.`obraz`,`u`.`win`,`u`.`lose`,`u`.`nich`,`u`.`cityreg2`,`u`.`host`,`u`.`info_delete`,`u`.`dateEnter`,`u`.`afk`,`u`.`dnd`,`u`.`timeMain`,`u`.`clan_prava`,`u`.`addpr`,`u`.`marry`,`u`.`city2`,`u`.`invis`,`u`.`bot_id`,`u`.`haos`,`u`.`host_reg`,`u`.`inUser`,`u`.`inTurnir`,`u`.`inTurnirnew`,`u`.`jail`,`u`.`animal`,`u`.`vip`,`u`.`catch`,`u`.`frg`,`u`.`no_ip`,`u`.`type_pers`,`u`.`bot_room`,
		`st`.`id`,`st`.`btl_cof`,`st`.`last_hp`,`st`.`last_pr`,`st`.`smena`,`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`enNow`,`st`.`transfers`,`st`.`regHP`,`st`.`regMP`,`st`.`showmenu`,`st`.`prmenu`,`st`.`ability`,`st`.`skills`,`st`.`sskills`,`st`.`nskills`,`st`.`exp`,`st`.`minHP`,`st`.`minMP`,`st`.`zv`,`st`.`dn`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,`st`.`battle_exp`,`st`.`enemy`,`st`.`last_a`,`st`.`last_b`,`st`.`battle_text`,`st`.`upLevel`,`st`.`wipe`,`st`.`bagStats`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`nextAct`,`st`.`active`,`st`.`bot`,`st`.`lastAlign`,`st`.`tactic1`,`st`.`tactic2`,`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`s`,`st`.`battleEnd`,`st`.`priemslot`,`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`ref_data`,`st`.`res_x`,`st`.`res_y`,`st`.`res_s`,`st`.`bn_capitalcity`,`st`.`bn_demonscity`,
		`r`.`noatack` 
		FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) LEFT JOIN `room` AS `r` ON (`u`.`room` = `r`.`id`) WHERE
		FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) LEFT JOIN `room` AS `r` ON (`u`.`room` = `r`.`id`)
		`u`.`login`="'.mysql_real_escape_string($_COOKIE['login']).'" AND `u`.`pass`="'.mysql_real_escape_string($_COOKIE['pass']).'" LIMIT 1'
*/
	function hasPermission($id = NULL, $userInfo = NULL, $code){
		$viewInfo = $id != NULL ? $this->getUser($id) : $userInfo;
		
		if (!isset($viewInfo['admin']))
			return false;
			
		return $viewInfo['admin'] & $code;
	}
}