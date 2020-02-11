<?php
//include_once('./__db_connect.php');

/**
 * Логер
 */
class Loger
{
    public $dbName = 'loger';

    public $timeStart = 0;

    public $timeStop = 0;

    /**
     * запомнить время начала выполения скрипта
     */
    public function setStart()
    {
        $this->timeStart = $this->time();
        return $this;
    }

    /**
     * запомнить время остоновки скрипта
     */
    public function setStop()
    {
        $this->timeStop = $this->time();
        return $this;
    }

    /**
     * Получить время выполнения скрипта
     * @return [type] [description]
     */
    protected function getTime()
    {
        if ($this->timeStop>0 && $this->timeStart>0) {
            return $this->timeStop - $this->timeStart;
        }
        return null;
    }
    /**
     * Записать лог
     */
    public function set($loger_last_uid, $use_id, $url, $users_battle, $stats_dnow, $room, $ip, $time_script = null)
    {
       /*
	   $dbgo = mysql_pconnect('localhost','like_mainbd','8O8v3Z0c');
        mysql_select_db('like_mainbd',$dbgo);
        mysql_query('SET NAMES cp1251');
        $insertData = array();
        $insertData['use_id']       = $use_id;
        $insertData['url']          = $url;
        $insertData['time'] = microtime();
		$insertData['room'] = $room;
        if ($time_script===null) {
            $insertData['time_script'] = $this->getTime();
        } else {
            $insertData['time_script'] = $time_script;
        }
        $insertData['users_battle'] = $users_battle;
        $insertData['stats_dnow']   = $stats_dnow;

        $result = mysql_query('INSERT INTO `'.$this->dbName.'` (`timenow`,`last_uid`,`ip`,`room`,`use_id`, `url`, `time`, `time_script`, `users_battle`, `stats_dnow`)
        VALUES(
			"'.time().'",
			"'.$loger_last_uid.'",
			"'.mysql_real_escape_string($ip).'","'
            .$insertData["room"].'","'
            .$insertData["use_id"].'", "'
            .$insertData["url"].'", "'
            .$insertData["time"].'", "'
            .$insertData["time_script"].'", "'
            .$insertData["users_battle"].'", "'
            .$insertData["stats_dnow"].'")');

        if (!$result) {
            die('error query' . mysql_error());
        }
        return $this;
		*/
    }

    protected function time()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}
