<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author: mZer0ne
 * Engine: comEngine
 * Copyright: mZer0ne works (c) 2015
 */
class System extends comEngine {
	
	var $info = array();
	
	function __construct(){
		parent::__construct();
		// Загрузка дополнений
		$this->load->model('Players_model', 'players');
		$this->load->helper('url');
		
		// Проверяем авторизацию
		$this->info = $this->players->getUser();
		if(!isset($this->info['id'])){
			show_404();
		}
	}
	
	/********************/
	/* Главная страница */
	/********************/
	public function index(){
		if(!isset($this->info['admin'])){
			redirect(base_url('/index.php'), 'location', 301);
		}
		if($this->input->server('PATH_INFO') != '/system/index.htm'){
			redirect('/system/index.htm', 'location', 301);
		}
		
		$this->view('system/main',array(
			'content'	=> '<h3>Admin home page</h3>'
		));
	}
	
	/**************************/
	/* Редактор Пользователей */
	/**************************/
	public function user_list(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 2) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$user_list = array();
		
		// Удаляем полномочия
		if ($this->input->get('delete_user_id') != '') {
			$this->db->update('users', array('admin' => '0'), array('id' => intval($this->input->get('delete_user_id'))));
			redirect(site_url('/system/user_list.htm'), 'location', 301);
		}
		
		// Получаем список
		$query = $this->db->get_where('users', array('admin > ' => 0));
		foreach($query->result_array() as $row){
			$user_list[] = $row;
		}
		
		// Выводим страницу
		$this->view('system/main',array(
			'content'	=> $this->load->view('system/user_list', array(
				'user_list'	=> $user_list,
				'Configs'	=> $this->EngineConfigs
			), true)
		));
	}	
	
	public function user_edit(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 2) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$user_edit = array(
			'id' => '',
			'login' => '',
			'admin' => array()
		);
		
		// Обновляем полномочия
		if ($this->input->post('id')){				
			$permission_number = 0;
			if(is_array($this->input->post('permission')))
				foreach($this->input->post('permission') as $code=>$value)
					if ($_POST['permission'][$code] == 'Y')
						$permission_number |= $code;
				
			$this->db->update('users', array('admin' => $permission_number), array('id' => intval($this->input->post('id'))));
			redirect(site_url('/system/user_list.htm'), 'location', 301);
		}

		// Получаем список
		if($this->input->get('user_id')){
			$query = $this->db->get_where('users', array('id' => intval($this->input->get('user_id'))), 1);
			$user_edit = $query->row_array();
		}

		// Выводим страницу
		$this->view('system/main', array(
			'content'	=> $this->load->view('system/user_edit', array(
				'user_edit'		=> $user_edit,
				'permissions'	=> array(
					1 => 'Администратор',
					2 => 'Редактирование полномочий ',
					4 => 'Редактирование локаций',
					8 => 'Редактирование подземелий',
					16 => 'Редактирование ботов',
				),
				'Configs'		=> $this->EngineConfigs
			), true)
		));
	}
	
	/********************/
	/* Редактор Локаций */
	/********************/
	public function locations_list(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 4) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$locations_list = array();
		
		// Удаляем локацию
		if ($this->input->get('delete_location_id') != '') {
			$this->db->delete('locations', array('id' => intval($this->input->get('delete_location_id'))));
			redirect(site_url('/system/locations_list.htm'), 'location', 301);
		}
		
		// Получаем список
		$query = $this->db->get_where('locations');
		foreach($query->result_array() as $row){
			$locations_list[] = $row;
		}
		
		// Выводим страницу
		$this->view('system/main',array(
			'content'	=> $this->load->view('system/locations_list', array(
				'locations_list'	=> $locations_list,
				'Configs'	=> $this->EngineConfigs
			), true)
		));
	}
	
	public function locations_edit(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 4) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$locations_list = array();
		$locations_edit = array(
			'id' => '',
			'title' => '',
			'cityname' => '',
			'background_img' => '',
			'redirect' => 'false',
			'width' => '0px',
			'height' => '0px',
			'showfall' => 'false',
			'locations'	=> ''
		);
		
		// Обновляем или добовляем
		if ($this->input->post('id') != '') {
			$i = 0;
			if(is_array($this->input->post('locations'))){
				foreach($this->input->post('locations') as $locations){
					foreach($locations as $key=>$val){
						$locations_list[$i][$key] = $val;
					}
					$i++;
				}
			}
			$replace = array(
				'id' => $this->input->post('id'),
				'title' => $this->input->post('title'),
				'cityname' => $this->input->post('cityname'),
				'background_img' => $this->input->post('background_img'),
				'redirect' => $this->input->post('redirect'),
				'width' => $this->input->post('width'),
				'height' => $this->input->post('height'),
				'showfall' => $this->input->post('showfall'),
				'locations'	=> serialize($locations_list)
			);
			$this->db->replace('locations', $replace);
//			redirect(site_url('/system/locations_list.htm'), 'location', 301);
		}

		// Получаем список
		if($this->input->get('location_id')){
			$query = $this->db->get_where('locations', array('id' => intval($this->input->get('location_id'))), 1);
			$locations_edit = $query->row_array();
		}

		// Выводим страницу
		$this->view('system/main',array(
			'content'	=> $this->load->view('system/locations_edit', array(
				'locations_edit'	=> $locations_edit,
				'Configs'	=> $this->EngineConfigs
			), true)
		));
	}
	
	/*********************/
	/* Редактор Подземок */
	/*********************/
	public function dungeon_list(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 8) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$dungeon_list = array();
		
		// Удаляем локацию
		if ($this->input->get('delete_dungeon_id') != '') {
			$this->db->delete('dungeon_room', array('id' => intval($this->input->get('delete_dungeon_id'))));
			redirect(site_url('/system/dungeon_list.htm'), 'location', 301);
		}
		
		// Получаем список
		$query = $this->db->get_where('dungeon_room');
		foreach($query->result_array() as $row){
			$dungeon_list[] = $row;
		}
		
		// Выводим страницу
		$this->view('system/main',array(
			'content'	=> $this->load->view('system/dungeon_list', array(
				'dungeon_list'	=> $dungeon_list,
				'Configs'	=> $this->EngineConfigs
			), true)
		));
	}

	public function dungeon_edit(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 8) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$dungeon_edit = array(
			'id' => '',
			'dungeon_id' => '',
			'subname' => '',
			'style' => '',
			'constructor' => ''
		);
		
		// Обновляем или добовляем
		if ($this->input->post('id') != '') {
			$update_replace = array(
				'dungeon_id' => $this->input->post('dungeon_id'),
				'dungeon_name' => $this->input->post('dungeon_name'),
				'city' => $this->input->post('city'),
				'dungeon_tag' => $this->input->post('style')
			);
			if($this->input->get('dungeon_id')){
				$this->db->update('dungeon_room', $update_replace, array('dungeon_id' => intval($this->input->post('dungeon_id'))));
			}else{
				$this->db->replace('dungeon_room', $update_replace);
			}
			redirect(site_url('/system/underground_list.htm'), 'location', 301);
		}

		// Получаем список
		if($this->input->get('dungeon_id')){
			$query = $this->db->get_where('dungeon_room', array('dungeon_id' => intval($this->input->get('dungeon_id'))), 1);
			$dungeon_edit = $query->row_array();
		}

		// Выводим страницу
		$this->view('system/main',array(
			'content'	=> $this->load->view('system/dungeon_edit', array(
				'dungeon_edit'	=> $dungeon_edit,
				'Configs'	=> $this->EngineConfigs
			), true)
		));
	}
	
	public function dungeon_edit_ajax(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 8) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$json = json_decode($this->input->post('json'), true);
		
		$getDungeon = $this->db->get_where('dungeon_map', array('id_dng' => $json['id_dng'],'x' => $json['x'],'y' => $json['y']))->row_array();
		if($getDungeon['id']){
			$this->db->update('dungeon_map', $json, array('id' => $getDungeon['id']));
			exit(json_encode(array('status'=>'success','type'=>'update')));
		}else{
			$this->db->insert('dungeon_map', $json);
			exit(json_encode(array('status'=>'success','type'=>'insert')));
		}
		exit(json_encode(array('status'=>'error','description'=>'Неизвестная ошибка')));
	}
	
	/*********************/
	/* Редактор Объектов */
	/*********************/
	public function underground_objects_list(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 8) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$underground_objects_list = array();
		
		// Удаляем объект
		if ($this->input->get('delete_underground_objects_id') != '') {
			$this->db->delete('underground_objects_list', array('id' => intval($this->input->get('delete_underground_objects_id'))));
			redirect(site_url('/system/underground_objects_list.htm'), 'location', 301);
		}
		
		// Получаем список
		$query = $this->db->get_where('underground_objects_list');
		foreach($query->result_array() as $row){
			$underground_objects_list[] = $row;
		}
		
		// Выводим страницу
		$this->view('system/main',array(
			'content'	=> $this->load->view('system/underground_objects_list', array(
				'underground_objects_list'	=> $underground_objects_list,
				'Configs'	=> $this->EngineConfigs
			), true)
		));
	}
	
	public function underground_objects_edit(){
		// Проверка доступа
		if($this->players->hasPermission(NULL, $this->info, 8) == false){
			redirect(base_url('/index.php'), 'location', 301);
		}
		// Стандартные переменные
		$underground_objects_edit = array(
			'id' => '',
			'name' => '',
			'image' => '',
			'class' => ''
		);
		
		// Обновляем или добовляем
		if ($this->input->post('id') != '') {
/*
			$update_replace = array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
				'subname' => $this->input->post('subname'),
				'style' => $this->input->post('style'),
				'constructor' => serialize(json_decode($this->input->post('constructor'), true))
			);
			if($this->input->get('underground_id')){
				$this->db->update('underground_list', $update_replace, array('id' => $this->input->post('id')));
			}else{
				$this->db->replace('underground_list', $update_replace);
			}
			redirect(site_url('/system/underground_list.htm'), 'location', 301);
*/
		}		
		
		// Получаем список
		if($this->input->get('underground_objects_id')){
			$query = $this->db->get_where('underground_objects_list', array('id' => intval($this->input->get('underground_objects_id'))), 1);
			$underground_objects_edit = $query->row_array();
		}
		
		// Выводим страницу
		$this->view('system/main',array(
			'content'	=> $this->load->view('system/underground_objects_edit', array(
				'underground_objects_edit'	=> $underground_objects_edit,
				'Configs'	=> $this->EngineConfigs
			), true)
		));
	}
}