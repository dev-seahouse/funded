<?php
/**
 *
 * $pdo = DbConnection::getInstance();
 * $conn = $pdo->getConnection( dsn, username, password );
 * $results = $conn->query("SELECT * FROM Table");
 *
 */
require_once "../_config/config.php";

Class DbConnection {

	private static $_instance = NULL;

	private function __construct() {}
	private function __clone() {}
	private function __wakeup() {}
	function __destruct() {}

	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new DbConnection;
		}
		return self::$_instance;
	}

	// 'mysql:host=localhost;dbname=funded_db', root,''
	public function getConnection($dsn = _HOST, $uname = _USER, $passwd = _PASSWD) {
		$conn = NULL;

		try {
			$conn = new \PDO($dsn, $uname, $passwd);
			$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch (PDOException $pdoe) {
			echo $pdoe->getMessage(); // in real life never do this
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
