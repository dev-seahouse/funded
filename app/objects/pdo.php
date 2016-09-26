<?php

class PDOConn {
	private $dsn;
	private $userName;
	private $password;

	private $instance;
	public static function getPDO(){
		require_once(__DIR__.'/../_config/config.php');
		$dsn = _HOST;
		$userName = _USER;
		$password = _PASSWD;

		try{
		$instance = new PDO($dsn, $userName, $password);
		$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $pdoe) {
					echo $pdoe->getMessage(); // in real life never do this
					echo "error!!!!!";
		} catch (Exception $e) {
					echo $e->getMessage();
		}

		return $instance;
	}
}