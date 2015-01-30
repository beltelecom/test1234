
<?php

class DB {
	protected $dbname='test2';
	protected $dbuser='test';
	protected $dbhost='127.0.0.1';
	protected $dbpass='test';
	private $_connect;
	private $db_select;
	public $row;
	/*Подключаемся к базе данных*/
	public function __construct() {
		$this->_connect=@mysql_connect ($this->dbhost, $this->dbuser, $this->dbpass);
		if (!$this->_connect) {
   			exit ("В настоящий момент сервер базы данных недоступен");
   		}
	mysql_query('set names utf8');
	//mysql_query('SET CHARSET windows-1251');
		$this->db_select=mysql_select_db ($this->dbname, $this->_connect);
	    if (!$this->db_select) {
     		exit('В настоящий момент база данных недоступна');
      	}
	return $this->db_select;
	}
	/*Делаем запрос к базе данных*/
	public function query($q) {
		$this->result=mysql_query($q, $this->_connect);
		//echo $q;
		if (!$this->result)	{
			echo "<div style=\"font-size:10px; color:#666666;\"> ";
           // echo $q."";
            echo "<br> Возможно база пуста. Проверьте загруженные файлы.</div>";
			
		}
		//echo "<div style=\"font-size:10px; color:#666666;\">$q</div>";
		return $this->result;
	}
	/*Количество строк в запросе*/
	public function query_count($result) {
		$this->row_count=mysql_num_rows($this->result);
		return $this->row_count;
	}
	/*Переводим строку в ассоциативный массив*/
	public function fetch_assoc($result) {
		$this->fetch=mysql_fetch_assoc($result);
		return $this->fetch;
	}
	/*Переводим весь запрос в ассоциативный массив*/
	public function fetch_all($result) {
		while ($fetch=mysql_fetch_assoc($result)) {
			$rows[]=$fetch;
		}
	return $rows;
	}
	public function transofrm_date($dat) {
		$data['day']=substr($dat, 8, 2);
		$data['month']=substr($dat, 5, 2);
		$data['year']=substr($dat, 0, 4);
		return $data;
	}
	/*Удалить запись из таблицы $table по полю $id_field равному $id*/
	public function delete_record($table, $id_field, $id) {
		$q="DELETE FROM $table WHERE $id_field='$id'";
		//echo "<div style=\"font-size:10px; color:#CCCCCC;\">".$q."</div>";
		$delete_record=$this->query($q);
		return $delete_record;
	}
	public function delete_set($table, $set) {
		$q="DELETE FROM $table WHERE $set";
		echo "<div style=\"font-size:10px; color:#CCCCCC;\">".$q."</div>";
		$delete_record=$this->query($q);
		return $delete_record;
	}
	/*Вставляет набор данных $set в таблицу $table*/
	public function insert_record($table, $set) {
		$q="INSERT INTO $table SET $set";
		//echo "<div style=\"font-size:10px; color:#CCCCCC;\">".$q."</div>";
		$insert_record=$this->query($q);
	}
	public function update_record($table, $set, $id_field, $id) {
		$q="UPDATE $table SET $set WHERE $id_field='$id'";
		//echo "<div style=\"font-size:10px; color:#CCCCCC;\">".$q."</div>";
		$update_record=$this->query($q);
	}
	public function get_last_id($table) {
		$q="SELECT LAST_INSERT_ID() FROM $table";
		$last=$this->fetch_assoc($this->query($q));
		$last_id=$last['LAST_INSERT_ID()'];
		return $last_id;
	}
}
?>
