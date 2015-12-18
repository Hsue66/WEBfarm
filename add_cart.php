<?
header("Content-Type: text/html; charset= UTF-8 ");

 include "./connect_db.php"; // 데이터 베이스 접속 프로그램 불러오기
   $pnum = $_GET['pnum'];
   $id = $_GET['id'];
   $count = $_GET['count'];
   $save = "insert into CART (USERID, PNUM, PCOUNT) values ('".$id."', '".$pnum."', '".$count."')";
   mysql_query($save);

   echo '<script>alert("장바구니에 저장되었습니다!");history.back();</script>';
   

?> 