<?

include "lib.php";


if(!isset($_SESSION["id"])){
   echo "<script> alert('로그인 하셔야 이용 가능합니다.');</script>";
   echo "<script language='javascript'>location.replace('login.html');";
   echo "</script>";
}

$result = mysql_connect('localhost', 'root', 'apmsetup') or die(mysql_error());
mysql_query("set names utf8");
mysql_select_db('webfarm') or die(mysql_error());


$p_num = $_GET['pnum'];
$buy_count = $_GET['buycount'];
$f_num = $_GET['fnum'];
$chk_sql = "select * from product where PNUM = '".trim($p_num)."'";
$chk_result = mysql_query($chk_sql);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>결제하기</title>
	<HR size="3" color="black" WIDTH="100%">
		<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="./bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="pay.css"/>

		  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		  <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body background="./photo/back.jpg">
	  <div id="body1">
 <!-- 상단 네비게이션 바 -->
<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
          <!-- 브라우저가 좁아졋을때 나오는 버튼(클릭시 메뉴출력) -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://localhost/web/main.html">Web farm</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active">
            <a href="http://localhost/web/main.html">홈으로</a></li>
            <? if(!isset($_SESSION["id"])){ ?>
            <li><a href="http://localhost/web/login.html">로그인</a></li>
            <li><a href="http://localhost/web/registry.html">회원가입</a></li>
             <?
            }else{
            $id = $_SESSION["id"];
            $sql = "select UPhoto from USER where USERID ='".$id."'";
             $res=mysql_query($sql);
              $loginphoto = './photo/'.mysql_result($res, 0);
          ?>
            <li><input type="button"  onclick="location.href='http://localhost//web//mypage.php?id=<?=$_SESSION['id']?>'";  style="height: 50px; width:80px; background-color: white; border:solid 0px;" value="<?=$_SESSION["name"]."님"?>"></li>
            <li><img src=<?=$loginphoto?> style="width: 40px; height: 50px;"></li>
            <?
            }
          ?>
          </ul>
        </div>
</div>
<!-- 상단 네비게이션 바 끝 -->

<div align="center"  id="header" class="header">
		<font SIZE="9" color="black" face="돋움">
		결제 하기
		</font>
	</div>

<br/>
<br/>
<table align="center" cellpadding="5" cellspacing="0" border="1" bordercolor="#CCEEFF">
	<tr>
		<td width="300" align="center">제품</td>
		<td width="200" align="center">판매 농장</td>
		<td width="150" align="center">수량</td>
		<td width="150" align="center">가격</td>
	</tr>
	<tr>
	
<?
$price=0;
while($row = mysql_fetch_array($chk_result))
{
	echo "<tr><td><img src='./photo/".$row['PPHOTO']."' style=\"width:200px;  height:200px;\"></td>
	<td align='center'>".$row['FNUM']."</td>
	<td align='center'>".$buy_count."</td>
	<td align='center'>".$row['PRICE']*$buy_count."</td></tr>";
	
	$price=$row['PRICE']*$buy_count;
}


?>
</table>

<br/>
<br/>
<br/>
<form name="baesong" action="paystore.php" method="post">

<table  align="center" cellpadding="5" cellspacing="0" border="1" bordercolor="black">
<tr>
	<td width="200">이름</td>
	<td width="600"><input type=text name="username" style="width: 600px;"></td>
</tr>
<tr>
	<td width="200">휴대폰 번호</td>
	<td width="600"><input type=text name="userphone" style="width: 600px;"></td>
</tr>
<tr>
	<td width="200">배송 주소</td>
	<td width="600"><input type=text name="useraddress" style="width: 600px;"></td>
</tr>
</table>
		<input type=hidden name="p_num" value="<?=$p_num?>"> 
		<input type=hidden name="f_num" value="<?=$f_num?>"> 
		<input type=hidden name="buy_count" value="<?=$buy_count?>">
		<input type=hidden name="price" value="<?=$price?>"> 

</br>
</br>
<div style="float: right;">
총 상품금액 : <?=$price?>원 

	<input type="submit" value="결제하기" style="height: 30px; width:80px; background-color: green; font-size='5'">
</form>
<td align="right" ><input type="button" onclick="goBack()" style="height: 30px; width:80px;" value="취소하기"></button></td>
</div>

<br/><br/><br/><br/>
<br/><br/>


<footer>
  <div style="float: right">
	made by 손웅배, 정주혁, 홍수민 &nbsp sw.kau.ac.kr
  </div>
  <div style="float: right">
	<img src="./images/logo.png" style="width: 30px; height: 30px;">
  </div>
</footer>
<script>
function goBack()
{
	
  if( confirm(" 정말로 취소하시겠습니까?" ) ){
window.history.back();
   }
}
</script>


</script>

<div id="footer">
            <img src="./photo/copyright.png" height="50px">
        </div>
</div>
</body>
</html>