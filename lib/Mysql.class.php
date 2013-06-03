<?php
/*
 * @author:Laven
 * @copyright:Copyright 2009 Laven
 * @create:2010-11-13
 * @modify:2010-11-13
 */
/*--------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------*/
class Mysql{

	private $host;
	private $name;
	private $pwd;
	private $db;
	private $charset;
	private $conn;


	function __construct(){//类初始化操作
            try {
                $config = Config::item("mysql.master");
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
		$this->host    =$config['host'];
		$this->name    =$config['user'];
		$this->pwd     =$config['pwd'];
		$this->db      =$config['dbname'];
		$this->charset =$config['charset'];
		$this->connect();//初始化执行连接操作
	}

	function __tostring(){//类作用注释
		return "\n<br />tip:this class <span style=\"color:red;\">\"mysql\"</span> is used to control database connection<br />\n";
	}

	function __call($fnName,$args){//运行未定义的方法时提示错误
		echo "\n<br />run a undefined method name: <span style=\"color:red;\">$fnName()</span><br />\n";
		if($args){
			echo "with worng arguments:<span style=\"color:red;\">";
			print_r($args);
			echo "</span><br />\n";
		}
		exit();
	}


	function connect(){
		$this->conn=@mysql_connect($this->host,$this->name,$this->pwd) or die("\n<br />Error Message:".mysql_error()."<br />\n");//连接数据库
		@mysql_select_db($this->db,$this->conn) or die("\n<br />Error Message:".mysql_error()."<br />\n");//选择数据库
		@mysql_query("SET NAMES '$this->charset'") or die("\n<br />Error Message:".mysql_error()."<br />\n");
	}



	//php100
	function show($message = '', $sql = '') {
		if(!$sql) echo $message;
		else echo $message.'<br>'.$sql;
	}

    function affected_rows() {
		return mysql_affected_rows();
	}

	function result($query, $row) {
		return mysql_result($query, $row);
	}

	function num_rows($query) {
		return @mysql_num_rows($query);
	}

	function num_fields($query) {
		return mysql_num_fields($query);
	}

	function free_result($query) {
		return mysql_free_result($query);
	}

	function insert_id() {
		return mysql_insert_id();
	}

	function fetch_row($query) {
		return mysql_fetch_row($query);
	}

	function version() {
		return mysql_get_server_info();
	}

	function close() {
		return mysql_close();
	}


/*
函数名称：query()
函数作用：执行sql语句
参　　数：$sql=要执行的sql语句
返 回 值：错误输出sql，无错误执行
*/
	function query($sql,$debug=0){//执行sql语句方法
		if($debug==1){
			echo $sql;
			exit();
		}
		$query=@mysql_query($sql,$this->conn) or die("\n<br />Error Message:".mysql_error()."<br />\n");
		return $query;
	}



/*
函数名称：insert()
函数作用：增加一条记录
参　　数：$table表名 $name字段名 $value插入值
返 回 值：错误输出sql，无错误执行
*/
		function insert($table,$name,$value){
		@$this->query("insert into $table ($name) value ($value)") or die("发生错误");
		return "添加成功";
	}


/*
函数名称：delById()
函数作用：通过主键删除一条记录
参　　数：$tblName='表名', $pkName=主键名称,$pkValue=主键值
返 回 值：true 或 false
*/
	function delById($tblName,$pkName,$pkValue){
		$sql="DELETE FROM `$tblName` WHERE `$pkName`='$pkValue'";
		@$this->query($sql) or die("发生错误");
		return "删除成功";
	}



/*
函数名称：update()
函数作用：增加一条记录
参　　数：$table表名 $name字段名 $value插入值
返 回 值：错误输出sql，无错误执行
*/
		function update($table,$name,$value){
		$sql="update `$table` set `$name` = '$value' WHERE `id`=47";
		//echo $sql;
		@$this->query($sql) or die("发生错误");
		return "修改成功";
	}






/*
函数名称：queryNum()
函数作用：通过sql获取记录条数
参　　数：$sql=要执行的sql语句
返 回 值：返回记录条数
*/
	function queryNum($sql){//返回记录条数
		$queryNum=mysql_num_rows($this->query($sql));
		return $queryNum;
	}



/*
函数名称：fetchArray()
函数作用：通过sql获取记录集
参　　数：$sql=要执行的sql语句
返 回 值：返回记录数组
*/
	function fetchArray($sql){
		$fetchArray=mysql_fetch_array($this->query($sql));
		return $fetchArray;
	}



/*
函数名称：getRowById()
函数作用：通过主键获取一条记录内容
参　　数：$tblName='表名', $pkName=主键名称,$pkValue=主键值
返 回 值：返回记录数组 或false
*/
	function getRowById($tblName,$pkName,$pkValue){
		$sql="SELECT * FROM `$tblName` WHERE `$pkName`='$pkValue' LIMIT 1";
		return $this->fetchArray($sql);
	}


/*
函数名称：delById()
函数作用：通过in条件删除记录
参　　数：$tblName='表名', $pkName=主键名称,$idValue=(1,2,3,4)形式的id
返 回 值：true 或 false
*/
	function delInId($tblName,$pkName,$idValue){
		$sql="DELETE FROM `$tblName` WHERE `$pkName` IN ($idValue)";
		return $this->query($sql);
	}



/*
函数名称：lastID()
函数作用：获取最后一条插入数据库的主键ID
参　　数：无
返 回 值：最后insert的记录的ID
*/
	function lastID(){
		return mysql_insert_id();
	}



/*
函数名称：fetchArrayInId()
函数作用：通过in条件获取记录集
参　　数：$tblName='表名', $pkName=主键名称,$idValue=(1,2,3,4)形式的id
返 回 值：返回记录数组 或false
*/
	function fetchArrayInId($tblName,$pkName,$idValue){
		$sql="SELECT * FROM `$tblName` WHERE `$pkName` IN ($idValue)";
		return $this->query($sql);
	}



//! 获取结果集
/**
* 以数组形式返回查询结果的所有记录
* @return mixed
*/
	function fetchRows($sql) {
		$result=$this->query($sql);
		$arr=array();
		$i=0;
		while($row=mysql_fetch_array($result) ){
			$arr[$i]=$row;
			$i++;
		}
		return $arr;
	}
	function __destruct(){//对象释放时关闭连接
		if($this->conn){
			mysql_close($this->conn);
		}
	}
}

$Mysql=new Mysql();//实例化

date_default_timezone_set('PRC'); //设置时区
?>