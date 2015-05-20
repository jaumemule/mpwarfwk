<?php
namespace Mpwarfwk\Component\Firewall;

use Mpwarfwk\Component\Controllers\BaseController;
use Mpwarfwk\Component\Request\Request;

/* ******** DEVELOPING THE IMPLEMENTATION ********* */
/* ****** THIS IS NOT AN USABLE SERVICE YET ********* */


class Firewall extends BaseController{

	private $time;
	private $section;
	private $user;
	private $risky;
	private $ip;
	private $useragent;

	const MAX_RISKY_LEVEL 	= 4;
	const SERVER_NAME 		= 'http://seguretat_practica.dev';
	const KICK_TIME 		= 30;

	public function __construct( Request $request ){

		if($request->_server->HTTP_ORIGIN != self::SERVER_NAME){
			return false;
		}

		parent::__construct();

		$this->connection 	= $this->container->get("PDO");

		$this->user 		= $request->session->getValue("id");
		$this->useragent 	= $request->_server->HTTP_USER_AGENT;
		$this->ip 			= $request->_server->REMOTE_ADDR;
		$this->uid 			= false; 
		$this->date 		= date('Y-m-d H:i:s');

		if(@$request->session->getValue("id")){
			$this->uid = $request->session->getValue("id");
		}

	}

	public function setInput( $section, $risky = 1 )
	{

    	$query = "INSERT INTO user_inputs_firewall (users_id, risky_level, section, ip, user_agent, date) VALUES ( :uid, :risky_level, :section, :ip, :useragent, :date )";


 	    $setFirewall 	= array('uid' => $this->uid ,
 	    							 'risky_level' 	=> $risky,
 	    							 'section' 		=> $section,
 	    							 'ip' 			=> $this->ip,
 	    							 'useragent' 	=> $this->useragent,
 	    							 'date' 		=> $this->date
 	    							 );

		$response 	= $this->connection->insertInTable($query, $setFirewall);

		return $response;

	}

	public function checkPermission( $time, $section = null )
	{

		$this->section 	= $section;
		$this->time 	= $time;

	    $query = "SELECT * FROM user_inputs_firewall WHERE users_id = :uid or (ip = :ip and user_agent = :user_agent) and section = :section order by id DESC";

 	    $getFirewall 	= array('uid' => $this->uid ,
 	    							 'section' 		=> $section,
 	    							 'ip' 			=> $this->ip,
 	    							 'user_agent' 	=> $this->useragent
 	    							 );

    	return $this->firewallLogic( $this->connection->selectFromTable($query, $getFirewall) );
	}

	public function checkPermissionWithoutLogin( $time, $section = null )
	{

		$this->section 	= $section;
		$this->time 	= $time;

	    $query = "SELECT * FROM user_inputs_firewall WHERE ip = :ip and section = :section order by id DESC";

 	    $getFirewall 	= array(
 	    						'section' 	=> $section,
 	    						'ip' 		=> $this->ip
 	    						 );

    	return $this->firewallLogic( $this->connection->selectFromTable( $query, $getFirewall ) );
	}

	private function firewallLogic( $firewall )
	{
    	$time_in_incremental_risky = date('Y-m-d H:i:s', strtotime($firewall[0]['date'] . '+' . $this->time . 'seconds'));

    	if($firewall == false || strtotime($this->date) > strtotime($time_in_incremental_risky)){
    		$response = $this->setInput( $this->section, 1 ); //save action
    		return true;
    	}

    	if( strtotime($this->date) < strtotime($time_in_incremental_risky) ){

    		if($firewall[0]['risky_level'] > self::MAX_RISKY_LEVEL){
    			echo "kicked";  //programar
    			return false;	//kick user from app
    		}

    		//incremental risky
    		$this->setInput($firewall[0]['section'], $firewall[0]['risky_level'] + 1);
    		return true;
    	}

    	return true;
	}

	public function destroyFirewall( $user )
	{
			$query 			= "DELETE FROM user_inputs_firewall WHERE users_id = $user";
    		$this->connection->deleteFromFreeQuery($query);
	}
}

