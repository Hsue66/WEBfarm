<?

include "lib.php";

$conn = mysql_connect('localhost', 'root', 'apmsetup');
$db_name="webfarm";
mysql_query("set names utf8");
mysql_select_db($db_name, $conn);


if($_POST[id]=="")
	echo "<script> alert('아이디를 입력하지 않으셨습니다.');</script>";

if($_POST[password]=="")
	echo "<script> alert('비밀번호를 입력하지 않으셨습니다.');</script>";


$chk_sql = "select * from USER where USERID = '".trim($_POST[id])."'";
$chk_result = mysql_query($chk_sql);
$chk_data = mysql_fetch_array($chk_result);

// 5. 아이디가 존재 하는 경우
if($chk_data[USERID]){

    // 6. 입력된 비밀번호와 저장된 비밀번호가 같은지 비교해서
    if($_POST[password] == $chk_data[USERPW]){
        // 7. 비밀번호가 같으면 세션값 부여 후 이동
        //$_SESSION[user_idx] = $chk_data[m_idx];
        $_SESSION["id"] = $chk_data[USERID];
        $_SESSION["name"] = $chk_data[NAME];
        
		echo "<script> alert('환영 합니다..');</script>";
		echo "<script language='javascript'>location.replace('main.html');";
		echo "</script>";
        
    }else{
        // 8. 비밀번호가 다르면
        echo "<script> alert('잘못된 비밀번호 입니다..');</script>";
		echo "<script language='javascript'>history.back();";
		echo "</script>";
    }
}else{
    // 9. 아이디가 존재하지 않으면
        echo "<script> alert('존재하지 않는 회원입니다.');</script>";
		echo "<script language='javascript'>history.back();";
		echo "</script>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
</body>
</html>