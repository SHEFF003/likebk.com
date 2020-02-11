<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author: mZer0ne
 * Engine: comEngine
 * Copyright: mZer0ne works (c) 2015
 */
class comEngine extends CI_Controller {
	
	protected $EngineConfigs = array();
	
	function __construct(){
		parent::__construct();
		$this->EngineConfigs = $this->config->item('comEngine');
	}
	
	public function view($file, $params = array(), $cache = NULL){
		if($cache){
			$this->output->cache($cache);
		}
		$params['Configs'] = $this->EngineConfigs;
		$this->load->view($file, $params);
	}
}