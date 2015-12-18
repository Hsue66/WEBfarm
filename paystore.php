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
$name=htmlspecialchars($_POST["username"]);
$phone=htmlspecialchars($_POST["userphone"]);
$address=htmlspecialchars($_POST["useraddress"]);

$result = mysql_connect('localhost', 'root', 'apmsetup') or die(mysql_error());
mysql_query("set names utf8");
mysql_select_db('webfarm') or die(mysql_error());


$user_name = mysql_real_escape_string($name);
$user_phone=mysql_real_escape_string($phone);
$user_address=mysql_real_escape_string($address);
$f_num =$_POST[f_num];
$p_num =$_POST[p_num];
$buy_count =$_POST[buy_count];
$price =$_POST[price];
$id=$_SESSION[id];

echo $id;
//echo $f_num." ".$p_num." ".$buy_count." ".$price." ".$id;
//echo  $user_name, $name,$_POST["username"];

$sql = "insert into orders values ('$f_num','$id','$p_num','$buy_count','$price','$user_address','$user_phone','$user_name' ) ";
$chk_result=mysql_query($sql) or die(mysql_error());

    echo "<script> alert('결제 완료 되었습니다.');";
    echo "location.href='./farm.html?farmnum=$f_num'; </script>";
?>


