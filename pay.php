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

$chk_sql = "select * from cart where USERID = '".trim($_SESSION["id"])."'";
$chk_result = mysql_query($chk_sql);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
a:link     {color:green;text-decoration:none} 
a:visited  {color:green;text-decoration:none} 
a:active   {color:green;text-decoration:none} 
a:hover    {color:green;text-decoration:none} 


</style>



<div>
	<font  SIZE="6" color="green" face="궁서체">
	   <a href="http://localhost/web/main.html" align="left">WEB FARM</a>
	</font>
<input type="button"  onclick="location.href='http://localhost//web//mypage.html'";	style="height: 40px; width:80px; background-color: white; float: right; border:solid 0px;" value="<?=$_SESSION["name"]."님"?>">
<img src="./photo/user.jpg" width="40" height="40" style="float: right;">
<div>
	<br/>
	<br/>
	<div align="center">
	<font SIZE="9" color="black" face="돋움">
	결제 하기
	</font>
	</div>
	<HR size="3" color="black" WIDTH="100%">
	
</head>
<body>
<br/>
<br/>
<form name=registForm action="registry.php" method="post">
<table align="center" cellpadding="5" cellspacing="0" border="1" bordercolor="#CCEEFF">
	<tr>
		<td width="200">제품</td>
		<td width="300">판매 농장</td>
		<td width="150">수량</td>
		<td width="150">가격</td>
	</tr>
	<tr>
	
<?
$price=0;
while($row = mysql_fetch_array($chk_result))
{
	echo "<tr><td>".$row['PNUM']."</td>
	<td>".$row['FNUM']."</td>
	<td>".$row['PCOUNT']."</td>
	<td>".$row['PRICE']."</td></tr>";
	$name = $row['USERID'];
	$phone = $row['PHONE'];
	$addr = $row['ADDR'];
	$price=$price+$row['PRICE'];
}


?>
</table>

<br/>
<br/>
<br/>
<table  align="center" cellpadding="5" cellspacing="0" border="1" bordercolor="black">
<tr>
	<td width="200">이름</td>
	<td width="600"><?=$name?></td>
</tr>
<tr>
	<td width="200">휴대폰 번호</td>
	<td width="600"><?=$phone?></td>
</tr>
<tr>
	<td width="200">배송 주소</td>
	<td width="600"><?=$addr?></td>
</tr>

</table>
<br/><br/>
<div style="float: right;">
총 상품금액 : <?=$price?>원 

		<input type="submit" value="결제하기" style="height: 30px; width:80px; background-color: green; font-size='5'">

		<td align="right" ><button onclick="goBack()" style="height: 30px; width:80px;">취소하기</button></td>
</div>

<script>
function goBack()
{
	window.history.back();
}


</script>
</body>
</html>