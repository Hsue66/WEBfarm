<?
    $men=0;
    $userpic=0;
    $farmpic=0;
    $fnum = $_POST['farmnum'];
    $conn = mysql_connect('localhost', 'root', 'apmsetup');
    mysql_query("set names utf8");
    if(!$conn)
    {
        echo "Fail";
    }
    $db_name="webfarm";
    mysql_select_db($db_name, $conn);

    $men=$_POST['mention'];
    $userpic=$_POST['userpic'];
    $farmpic=$_POST['farmpic'];

    echo $fnum, "    ", $men;

        $que1=mysql_query("UPDATE farm set MENTION='$men' where fnum='$fnum'");
 
  
        $que2=mysql_query("UPDATE farm set FPHOTO='$farmpic' where fnum='$fnum'");
   
        $que3=mysql_query("UPDATE user INNER JOIN farm ON (user.userID=farm.userID) set UPHOTO='$userpic' WHERE fnum=$fnum");
   

    //echo "<script>location.href='Farmmanage.html?farmnum=$fnum';</script>"; 
?>