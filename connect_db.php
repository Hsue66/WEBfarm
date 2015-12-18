<?
 $host = "localhost";
 $user = "root";
 $password = "apmsetup";
 $db_name = "webfarm";

 $connect = mysql_connect($host,$user,$password) or die("MySQL Connection Error");
 
 mysql_query("set names utf8");

 mysql_select_db($db_name,$connect) or die("no database");

 //mysql_query("set session character_set_connection=utf8;");

//mysql_query("set session character_set_results=utf8;");

//mysql_query("set session character_set_client=utf8;");

 ?> 