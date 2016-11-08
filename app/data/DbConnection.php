<?php
/**
 * Usage:
 * $pdo = DbConnection::getInstance();
 * $conn = $pdo->getConnection( dsn, username, password );
 * $results = $conn->query("SELECT * FROM Table");
 *
 */
require_once $_SERVER['DOCUMENT_ROOT']."/_config/config.php";

Class DbConnection {

    private static $_instance = NULL;

    private function __construct() {
    }

    private function __clone() {
    }

    public function __wakeup() {
    }

    public function __destruct() {
    }

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new DbConnection;
        }
        return self::$_instance;
    }

    // 'mysql:host=localhost;dbname=funded_db', root,''
    public function getConnection($dsn = _HOST, $uname = _USER, $passwd = _PASSWD) {
        $conn = NULL;
        //try {
            $conn = new \PDO($dsn, $uname, $passwd);
            //TODO: turn this off
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING); // remember to turn this off during production
        //} catch (PDOException $pdoe) {
            //TODO: remove debug codes
          //  echo $pdoe->getMessage();
        //} catch (Exception $e) {
            //TODO: remove debug codes
          //  echo $e->getMessage();
        //}
        return $conn;
    }
}
