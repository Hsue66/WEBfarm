<?
            $pnum = $_GET['pnum'];
            $conn = mysql_connect('localhost', 'root', 'apmsetup');

            if(!$conn)
            {
                echo "Fail";
            }
            $db_name="webfarm";
            mysql_select_db($db_name, $conn);
            $que1=mysql_query("SELECT Pname FROM product WHERE PNum=$pnum");
            $que2=mysql_query("SELECT FNum FROM product WHERE PNum=$pnum");
            
            $productname = mysql_result($que1, 0);
            $farmnum = mysql_result($que2, 0);
            $del=mysql_query("DELETE FROM product WHERE PNum=$pnum");
            echo "<script>location.href='Farmmanage.html?farmnum=$farmnum';</script>"; 

           
?>
