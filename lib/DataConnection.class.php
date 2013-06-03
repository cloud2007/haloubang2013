<?php
//连接数据库
class DataConnection {

	private static $connection = null;
        /*
	const HOST   = 'localhost';
	const USR    = 'root';
	const PASSWD = '';
	const DBNAME = 'hlb2013';
        */
	public static function getConnection() {
            try {
                $config = Config::item("mysql.master");
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

		if (self::$connection == null) {
			self::$connection = mysql_connect($config['host'], $config['user'], $config['pwd']) or die(mysql_error());
			mysql_select_db($config['dbname']) or die(mysql_error());
			mysql_query('set names utf8') or die(mysql_error());
		}
		return self::$connection;
	}

}

?>
