<?php
	class dbstuff {
		var $version = '';
		var $querynum = 0;
		var $link;

		function connect($host,$user,$pwd,$dbname,$pconnect = false) {
			$this->link = $pconnect ? @mysql_pconnect($host,$user,$pwd) : @mysql_connect($host,$user,$pwd);
			if ( !$this->link ) {
				$this->halt('Connect to MySQL failed!');
			}
			if ( !mysql_select_db($dbname, $this->link) ) {
				$this->halt('Cannot use database!');
			}
			if ( $this->version() > '4.1' ) {
				mysql_query('SET NAMES ' . strtolower(str_replace('-', '', DB_CHARSET)) . ';', $this->link);
			}
		}
		
		function query($sql, $unbuffer = false ) {
			if ( $unbuffer && function_exists('mysql_unbuffered_query') ) {
				$query = @mysql_unbuffered_query($sql, $this->link);
			} else {
				$query = @mysql_query($sql,$this->link);
			}
			$this->querynum ++;
			!$query && $this->halt('Query Error: ',$sql);
			return $query;
		}
		
		// 从结果集中取得一行作为关联数组
		function fetch_array($query, $result_type = MYSQL_ASSOC) {
			return mysql_fetch_array($query, $result_type);
		}
		
		function fetch_one_array($sql) {
			$query = $this->query($sql);
			return $this->fetch_array($query);
		}

		function fetch_all($sql) {
			$result = array();
			$query = $this->query($sql);
			while($row = $this->fetch_array($query)) {
				$result[] = $row;
			}
			return $result;
		}
		
		// 返回结果集中一个字段的值
		function result ($sql, $row = 0) {
			$query = $this->query($sql);
			return @mysql_result($query, $row);
		}
		
		// 释放内存
		function free_result($query) {
			return mysql_free_result($query);
		}
	
		// 返回上一次insert的id
		function insert_id() {
			return ($id = mysql_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
		}
		
		// 返回结果集中字段的数
		function num_fields($query) {
			return mysql_num_fields($query);
		}
		
		// 返回结果集中行的数目
		function num_rows($query) {
			return mysql_num_rows($query);
		}

		// 返回前一次 MySQL 操作所影响的记录行数
		function affected_rows() {
			return mysql_affected_rows($this->link);
		}
		
		// 关闭非持久的 MySQL 连接
		function close() {
			return @mysql_close($this->link);
		}
		
		// 返回 MySQL 服务器的信息
		function version() {
			return mysql_get_server_info($this->link);
		}

		// 返回上一个 MySQL 操作产生的文本错误信息
		function error() {
			return (($this->link) ? mysql_error($this->link) : mysql_error());
		}
		
		// 返回上一个 MySQL 操作中的错误信息的数字编码
		function errno() {
			return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
		}

		function halt($msg = '', $sql = '') {
			$output = '<div style="font-size:11px;font-family:Verdana">msg:'.$msg.'<br />sql:'.$sql.'<br />errno:'.$this->errno().'<br />error:'.$this->error().'</div>';
			exit($output);
		}
	}
?>