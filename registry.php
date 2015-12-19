<?
include "lib.php";
?>
<html>
<head>
	<title> 회원가입 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?

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
else{
//현재 업로드 상태인지를 체크
 if($_POST['mode'] == 'upload') {

//1. 업로드 파일 존재여부 확인
 	if(!isset($_FILES['upload'])) {

 		echo "<script> alert(\"업로드 파일 존재하지 않음1\");
 		</script>";
	}//if

//2. 업로드 오류여부 확인
	if ($_FILES['upload']['error'] > 0) {
		switch ($_FILES['upload']['error']) {
			case 1:
				exit("php.ini 파일의 upload_max_filesize 설정값을 초과함(업로드 최대용량 초과)");
			case 2:
				exit("Form에서 설정된 MAX_FILE_SIZE 설정값을 초과함(업로드 최대용량 초과)");
			case 3:
				exit("파일 일부만 업로드 됨");
			case 4:
				echo "<script> alert(\"업로드 파일 존재하지 않음\");
						history.back();
		</script>";
			case 6:
				exit("사용가능한 임시폴더가 없음");
			case 7:
				exit("디스크에 저장할수 없음");
			case 8:
				exit("파일 업로드가 중지됨");
			default:
				exit("시스템 오류가 발생");
				
				default:
				echo "<script> alert(\"업로드 실패2\");
				history.back();
				</script>";
		} // switch
	}//if

//3. 업로드 제한용량 체크(서버측에서 5M로 제한)
	if($_FILES['upload']['size'] > 5242880) {
		echo "<script> alert(\"업로드 용량초과\");
		history.back();
		</script>";
	}//if

//4. 업로드 허용 확장자 체크(보편적인 jpg,jpeg,gif,png,bmp 확장자만 필터링)
	$ableExt = array('jpg','jpeg','gif','png','bmp');
	$path = pathinfo($_FILES['upload']['name']);
	$ext = strtolower($path['extension']);

	if(!in_array($ext, $ableExt)) {
		echo "<script> alert(\"허용되지 않는 확장자입니다.\");
		history.back();
		</script>";
	}//if

//5. MIME를 통해 이미지파일만 허용(2차 확인)
	$ableImage = array('image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png', 'image/gif','image/bmp','image/pjpeg');
	if(!in_array($_FILES['upload']['type'], $ableImage)) {
		echo "<script> alert(\"허용되지 않는 이미지입니다.\");
		history.back();
		</script>";
	}//if
	$time = explode(' ',microtime());
	$fileName = $time[1].substr($time[0],2,6).'.'.strtoupper($ext);
		//$fileName = $p_photo.".".($ext);

		//중요 이미지의 경우 웹루트(www) 밖에 위치할 것을 권장(예제 편의상 아래와 같이 설정)
	$filePath = $_SERVER['DOCUMENT_ROOT'].'/web/photo/';

	$file_size = $_FILES['upload']['size'];
	$file_type = $_FILES['upload']['type'];
	$upload_date = date("Y-m-d H:i:s");
	$ip = $_SERVER['REMOTE_ADDR'];

	if (move_uploaded_file($_FILES['upload']['tmp_name'], $filePath.$fileName)) {

		$chk_sql = "select * from USER where USERID = '".trim($_POST[id])."' ";
		$chk_result = mysql_query($chk_sql);
		$chk_data = mysql_fetch_array($chk_result);
		if($chk_data[USERID]){
			alert("이미 가입된 아이디 입니다.");
		}

		$user_id = htmlspecialchars($_POST[id]);
		$user_pass = htmlspecialchars($_POST[password]);
		$user_name = htmlspecialchars($_POST[name]);
		
		$user_name = mysql_real_escape_string($user_name);
		$user_id=mysql_real_escape_string($user_id);
		$user_pass=mysql_real_escape_string($user_pass);

		$sql = "insert into USER (USERID,USERPW,NAME,UPHOTO) values ('".trim($user_id)."', '".trim($user_pass)."', '".trim($user_name)."', '$fileName')";
		$res = mysql_query($sql);
			if($res){
				$link="http://localhost/web/main.html";
			echo "<script> alert(\"가입되셨습니다!\");
			location.href=\"$link\";
			</script>";
			}
/*
		$f_num = $_POST['f_num'];
		$p_name = $_POST['p_name'];
		$p_count = $_POST['p_count'];		
		$p_cost = $_POST['p_cost'];	
	//	$p_photo = $_POST['p_photo'];

		$nse_content = $_POST['ir1'];
		$sql = "insert into product(PNUM,FNUM,PCOUNT,PNAME,PPHOTO,DESCRIPTION,PRICE)";
		$sql .= "values ('',$f_num,$p_count,'$p_name','$fileName','{$nse_content}',$p_cost)";
		$res = mysql_query($sql,$connect);
		if($res){
		$link="http://localhost/web/Farmmanage.html?farmnum=".$f_num;
		echo "<script> alert(\"업로드 성공!\");
		location.href=\"$link\";
		</script>";
*/
		}
		else{
		echo "<script> alert(\"업로드 실패\");
		history.back();
		</script>";
		//echo mysql_errno($connect) . ": " . mysql_error($connect) . "\n";
		}

		mysql_query("set session character_set_connection=utf8;");

		mysql_query("set session character_set_results=utf8;");

		mysql_query("set session character_set_client=utf8;");

	}else{
		echo "<script> alert(\"업로드 실패\");
		history.back();
		</script>";
		}//if
	}//if




/*

*/
?>

</body>
</html>