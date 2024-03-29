<?php 

$sql_time = date('Y-m-d h:i:s', time());
//sql注入过滤
function fliter_sql($str) {
	$str = str_replace("and","",$str);
	$str = str_replace("execute","",$str);
	$str = str_replace("update","",$str);
	$str = str_replace("count","",$str);
	$str = str_replace("chr","",$str);
	$str = str_replace("mid","",$str);
	$str = str_replace("master","",$str);
	$str = str_replace("truncate","",$str);
	$str = str_replace("char","",$str);
	$str = str_replace("declare","",$str);
	$str = str_replace("select","",$str);
	$str = str_replace("create","",$str);
	$str = str_replace("delete","",$str);
	$str = str_replace("insert","",$str);
	$str = str_replace("'","",$str);
	$str = str_replace('"',"",$str);
	$str = str_replace(" ","",$str);
	$str = str_replace("or","",$str);
	$str = str_replace("=","",$str);
	$str = str_replace("%20","",$str);
	//echo $str;
	return $str;
}
//数据库连接
function Connect($host=DB_HOST,$user=DB_USER,$password=DB_PASSWORD,$database=DB_DATABASE,$port=DB_PORT){
	$link=@mysqli_connect($host, $user, $password, $database, $port);
	if(mysqli_connect_errno()){
		exit(mysqli_connect_error());
	}
	mysqli_set_charset($link,'utf8');
	return $link;
}
//执行一条SQL语句,返回结果集对象或者返回布尔值
function Execute($link,$query){
	$result=mysqli_query($link,$query);
	if(mysqli_errno($link)){
		exit(mysqli_error($link));
	}
	return $result;
}
//执行一条SQL语句，只会返回布尔值
function ExecuteBool($link,$query){
	$bool=mysqli_real_query($link,$query);
	if(mysqli_errno($link)){
		exit(mysqli_error($link));
	}
	return $bool;
}
function ExecuteMulti($link,$arr_sqls,&$error){
	$sqls=implode(';',$arr_sqls).';';
	if(mysqli_multi_query($link,$sqls)){
		$data=array();
		$i=0;//计数
		do {
			if($result=mysqli_store_result($link)){
				$data[$i]=mysqli_fetch_all($result);
				mysqli_free_result($result);
			}else{
				$data[$i]=null;
			}
			$i++;
			if(!mysqli_more_results($link)) break;
		}while (mysqli_next_result($link));
		if($i==count($arr_sqls)){
			return $data;
		}else{
			$error="sql语句执行失败：<br />&nbsp;数组下标为{$i}的语句:{$arr_sqls[$i]}执行错误<br />&nbsp;错误原因：".mysqli_error($link);
			return false;
		}
	}else{
		$error='执行失败！请检查首条语句是否正确！<br />可能的错误原因：'.mysqli_error($link);
		return false;
	}
}
//获取记录数
function Num($link,$sql_count){
	$result=execute($link,$sql_count);
	$count=mysqli_fetch_row($result);
	return $count[0];
}
//数据入库之前进行转义，确保，数据能够顺利的入库
function Escape($link,$data){
	if(is_string($data)){
		return mysqli_real_escape_string($link,$data);
	}
	if(is_array($data)){
		foreach ($data as $key=>$val){
			$data[$key]=escape($link,$val);
		}
	}
	return $data;
	//mysqli_real_escape_string($link,$data);
}


//关闭与数据库的连接
function Close($link){
	mysqli_close($link);
}
?>