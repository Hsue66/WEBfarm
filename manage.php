<? include "lib.php" ?>
<?
header("Content-Type: text/html; charset= UTF-8 ");
$flag=0;
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
//$userpic=$_POST['userpic'];
// $farmpic=$_POST['farmpic'];



$que1=mysql_query("UPDATE farm set MENTION='$men' where fnum='$fnum'");



if ($_FILES['upload']['error'] > 0) {
    switch ($_FILES['upload']['error']) {
        case 1:
            $flag=1;
        case 2:
            $flag=1;
        case 3:
            $flag=1;
        case 4:
            $flag=1;
            // echo "<script> alert(\"업로드 파일 존재하지 않음3\");
            //        history.back();
            // </script>";
        case 6:
            $flag=1;
        case 7:
            $flag=1;
        case 8:
            $flag=1;
        default:
            $flag=1;

        default:
            $flag=1;
    } // switch
}//if

if($flag!=1)
{
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

        $id = $_SESSION['id'];

        $sql = "update USER set UPHOTO ='".$fileName."' where USERID='".$id."'";

        $res = mysql_query($sql);
       // echo $sql;
        if($res){

            echo "<script> alert(\"업로드 성공!\");
                  </script>";
        }
    }
    else{
        echo "<script> alert(\"업로드 실패\");
                    history.back();
                        </script>";
        //echo mysql_errno($connect) . ": " . mysql_error($connect) . "\n";
    }
}

//     $que2=mysql_query("UPDATE farm set FPHOTO='$farmpic' where fnum='$fnum'");

//     $que3=mysql_query("UPDATE user INNER JOIN farm ON (user.userID=farm.userID) set UPHOTO='$userpic' WHERE fnum=$fnum");


echo "<script>location.href='Farmmanage.html?farmnum=$fnum';</script>";
?>