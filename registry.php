<?
include "lib.php";

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
</body>
</html>

<?
// 1. 공통 인클루드 파일


$result = mysql_connect('localhost', 'root', 'apmsetup') or die(mysql_error());
mysql_query("set names utf8");
mysql_select_db('webfarm') or die(mysql_error());


// 2. 로그인한 회원은 뒤로 보내기
if($_SESSION[id]){
        echo "<script> alert('로그인 하신 상태입니다..');</script>";
		echo "<script language='javascript'>history.back();";
		echo "</script>";
}

// 3. 넘어온 변수 검사
else if(trim($_POST[id]) == ""){
        echo "<script> alert('id를 입력하시지 않았습니다.');</script>";
		echo "<script language='javascript'>history.back();";
		echo "</script>";
}

else if(trim($_POST[name]) == ""){
        echo "<script> alert('이름을 입력하세요.');</script>";
		echo "<script language='javascript'>history.back();";
		echo "</script>";
}

else if($_POST[password] == ""){
        echo "<script> alert('비밀번호를 입력하시지 않았습니다..');</script>";
		echo "<script language='javascript'>history.back();";
		echo "</script>";
}

//if($_POST[m_pass] != $_POST[m_pass2]){
 //   alert("비밀번호를 확인해 주세요.");
//}

$chk_sql = "select * from USER where USERID = '".trim($_POST[id])."' ";
$chk_result = mysql_query($chk_sql);
$chk_data = mysql_fetch_array($chk_result);

if($chk_data[USERID]){
	alert("이미 가입된 아이디 입니다.");
}

$user_id = htmlspecialchars($_POST[id]);
$user_pass = htmlspecialchars($_POST[password]);
$user_name = htmlspecialchars($_POST[name]);
$f_num =$_POST[f_num];
$p_num =$_POST[p_num];
$buy_count =$_POST[buy_count];
$price =$_POST[$price];


$user_name = mysql_real_escape_string($user_name);
$user_id=mysql_real_escape_string($user_id);
$user_pass=mysql_real_escape_string($user_pass);




$sql = "insert into USER (USERID,USERPW,NAME,UPHOTO) values ('".trim($user_id)."', '".trim($user_pass)."', '".trim($user_name)."', ' ')";
mysql_query($sql);

alert("회원가입이 완료 되었습니다.","http://localhost//web//main.html");
?>
