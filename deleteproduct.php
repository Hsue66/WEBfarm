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
?>
<html>
    <head><meta charset="utf-8">
    </head>
    <body>
        <?=$productname?> 을(를) 정말 지우시겠습니까?
        <br/>
        <script type="text/javascript">
            function del()
            {
                <?
                $del=mysql_query("DELETE FROM product WHERE PNum=$pnum");
                ?>
                location.href="farmmanage.html?farmnum=<?=$farmnum?>";
            }
            function cel()
            {
                location.href="farmmanage.html?farmnum=<?=$farmnum?>";
            }
        </script>
        <input type="submit" value="삭제" onclick="del()">
        <input type="submit" value="되돌아가기" onclick="cel()">
        
        
        
    </body>
</html>
