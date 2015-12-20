<? include "lib.php";
include "./connect_db.php";
?>
<?

$check = $_POST["product"]; 
$test = $_POST["list"];
$list_check = $_POST["list_check"];
$f_num = $_POST["f_num"];
$count = $_POST["buy_count"];

print_r($f_num);
print_r($count);

$name=htmlspecialchars($_POST["username"]);
$phone=htmlspecialchars($_POST["userphone"]);
$address=htmlspecialchars($_POST["useraddress"]);

echo $name,$phone,$address;

$user_name = mysql_real_escape_string($name);
$user_phone=mysql_real_escape_string($phone);
$user_address=mysql_real_escape_string($address);


for($i=0;$i<sizeof($check);$i++){ 
  echo $check[$i] . "<br>";  
} 

for($i=0;$i<sizeof($test);$i++){ 
  if($list_check[$i]==1){
    echo $test[$i] . "<br>";
	$sql = "insert into ORDERS
		 values ('".trim($f_num[$i])."','".trim($_SESSION['id'])."','".trim($test[$i])."','".trim($count[$i])."','".trim($check[$i])."','".trim($user_name)."','".trim($user_phone)."','".trim($user_address)."')";
    mysql_query($sql) or die(mysql_error);	
	$sql = "delete 
		    from cart
            where PNUM=$test[$i]";
    mysql_query($sql) or die(mysql_error);
}	
}


$sql = "delete 
		from product	
		where PCOUNT=0";
 mysql_query($sql) or die(mysql_error);

 
  echo "<script> alert('결제 완료 되었습니다.');";
  echo "location.href='./mypage.php?id=$_SESSION[id]'; </script>";







?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
</body>
</html>

