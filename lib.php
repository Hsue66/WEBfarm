<?


//####################################
//
// 사용자 정의 함수파일 : lib.php
//
//
//####################################

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password='apmsetup';
$mysql_db = 'webfarm';

function sql_connect($db_host, $db_user, $db_pass,$db_name)
{
	$result = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_query("set names utf8");
	mysql_select_db($db_name) or die(mysql_error());
	return $result;
}

function sql_query($sql)
{
	global $connect;
	$result = @mysql_query($sql, $connect) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
	return $result;
	
}

function sql_total($sql)
{
	global $connect;
	$result_total = sql_query($sql, $connect);
	$data_total = mysql_fetch_array($result_total);
	$total_count = $data_total[cnt];
    return $total_count;
}

function sql_fetch($sql, $error=TRUE)
{
	$result = sql_query($sql, $error);
	$row = mysql_fetch_array($result);
	return $row;
}

function sql_list($sql)
{
	$sql_q = sql_query($sql);
	$sql_list = array();
	while($sql_r = mysql_fetch_array($sql_q))
	{
		$sql_list[]=$sql_r;
	}
	return $sql_list;
}

function alert($msg='', $url='')
{
	if(!$msg) $msg = '올바른 방법으로 이용해 주십시오.';
	echo "<script language='javascript'>alert('$msg');";
	echo "</script>";
	if($url){
		goto_url($url);
	}else{
		echo "<script language='javascript'>history.back();";
		echo "</script>";
	}
	exit;
}

function goto_url($url)
{
	echo "<script language='javascript'> location.replace('$url'); </script>";
	exit;
	
}

function paging($page, $page_row, $page_scale, $total_count,$ext='')
{
	$total_page = ceil($total_count/$page_row);
	$paging_str="";
	
	if($page>1){
		 $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=1&'".$ext.">처음</a>";
	}
	
	$start_page = ((ceil($page/$page_scale)-1) *page_scale )+1;

    $end_page = $start_page + $page_scale -1;
    if($end_page >= total_page) $end_page = $total_page;

    if($start_page>1)
	{
		$paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".($start_page - 1)."&'".$ext.">이전</a>";
	}		
	if($total_page >1)
	{
		for($i=$start_page; $i<=$end_page; $i++){
			if($page !=$i){
				$paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".$i."&'".$ext."><span>$i</span>";
				}
			else{
				$paging_str.=" &nbsp;<b>$i</b> ";
			}
		}
	}
	
	if($total_page > $end_page)
	{
		    $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".($end_page + 1)."&'".$ext.">다음</a>";
	}
	   if ($page < $total_page) {
        $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".$total_page."&'".$ext.">맨끝</a>";
    }
	return $paging_str;
}

@session_start();

//$connect=sql_connect($mysql_host,$mysql_user, $mysql_password,$mysql_db);
?>