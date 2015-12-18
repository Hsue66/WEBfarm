<? include "lib.php" ?>
<?
header("Content-Type: text/html; charset= UTF-8 ");

 include "./connect_db.php"; // 데이터 베이스 접속 프로그램 불러오기

	if(!isset($_SESSION["id"])){
   echo "<script> alert('로그인 하셔야 이용 가능합니다.');</script>";
   echo "<script language='javascript'>location.replace('login.html');";
   echo "</script>";
	}

	else if(trim($_GET['due']) == ""){
        echo "<script> alert('기간을 선택하지 않았습니다.'); history.back();</script>";
	}

	else{
   $fnum = $_GET['fnum'];
   $id = $_GET['id'];
   $start = $_GET['start'];
   $finish = $_GET['finish'];
   $save = "insert into RESERVE (FNUM, USERID, SDATE, FDATE) values ('".$fnum."', '".$id."', '".$start."', '".$finish."')";
   mysql_query($save);

   echo '<script>alert("예약되었습니다!");history.back();</script>';
   }

?> 