<?  include "lib.php";
    include "./connect_db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <head>
      <title>마이 페이지</title>
      <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
      <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
      <script src="./bootstrap/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="myinfo.css"/>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
   </head>

<script type="text/javascript">
  $(function (){
    tab('#tab',0);
  });

  function tab(e, num){
    var menu = $(e).children();
    var con = $(e+'_menu').children();
    var select = $(menu).eq(num);
    var i = num;

    select.addClass('on');
    con.eq(num).show();
    menu.click(function(){
      if(select !==null){
        select.removeClass("on");
        con.eq(i).hide();
      }
        select = $(this);
        i = $(this).index();

        select.addClass("on");
        con.eq(i).show();
    });
  }

</script>

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
  

    <div class="header" >
        <h1>마이페이지</h1>
    </div>
    <div id="wrapper">
      <ul class="tab" id="tab">
        <li class="on">장바구니</li>
        <li>주문목록</li>
        <li>예약목록</li>
      </ul>

      <div class="tab_menu" id="tab_menu">
        <div>
          <?
            $id = $_GET['id'];
            $sql = "select PNAME,PPHOTO,COUNT,PRICE,CART.PNUM,PRODUCT.FNUM
                      from PRODUCT join CART on CART.PNUM = PRODUCT.PNUM
                      where USERID='".$id."'";

            $res = mysql_query($sql);
          ?>

          <script type="text/javascript">
           function checkfunc()
          {
                var price = 0;      
                var checkArr = document.getElementsByName("product[]");
                for(var i = 0 ; i<checkArr.length ; i++){
                  if(checkArr[i].checked == true){
                    price += Number(checkArr[i].value);

                  }
                }
                $("#price").text(" "+price+" 원");
            }

          </script>
          <table align="center" cellpadding="5" cellspacing="0" border="1" bordercolor="#CCEEFF">
            <tr>
              <th width ="50">선택</th>
              <th width="100">제품사진</th>
              <th width="150">제품명</th>
              <th width="150">수량</th>
              <th width="150">가격</th>
            </tr>
            <tr>
           <?
          $price;
		  $k=0;
		  echo "<form name=cartform action='mypage_cartpay.php' method='post'>";
          while($row = mysql_fetch_array($res))
          {
            $tmp.=$row['PPHOTO']."/".$row['PNAME']."/".$row['COUNT']."/".$row['PRICE']."/".$row['PRICE']*$row['COUNT'];
            echo "<tr><td><input type=checkbox name='product[]' value=".$row['PRICE']*$row['COUNT']." onclick=\"checkfunc();\"></td>
			<input type='hidden' name='list[]' value=".$row['PNUM'].">
			<input type='hidden' name='list_check[]' value=".$k.">
			<input type='hidden' name='buy_count[]' value=".$row['COUNT'].">
			<input type='hidden' name='f_num[]' value=".$row['FNUM'].">
            <td><img src='./photo/".$row['PPHOTO']."' width = '20' heigth = '20'></td>
            <td>".$row['PNAME']."</td>
            <td>".$row['COUNT']."</td>
            <td>".$row['PRICE']*$row['COUNT']."</td></tr>";
			$k++;
          }
		  
          ?>
          </table>
		  <br/>
		  <table  align="center" cellpadding="5" cellspacing="0" border="1"  bordercolor="#CCEEFF">
			<tr>
				<td width="200">이름</td>
				<td width="600"><input type=text name="username" style="width: 600px"></td>
			</tr>
			<tr>
				<td width="200" >휴대폰 번호</td>
				<td width="600"><input type=text name="userphone" style="width: 600px"></td>
			</tr>
			<tr>
				<td width="200">배송 주소</td>
				<td width="600"><input type=text name="useraddress" style="width: 600px"></td>
			</tr>
		  </table>

            결제금액<strong id = "price"> 0원 </strong> 
          <?
            echo '<button id="buy" name="buy" class="btn btn-success" value='.$tmp.' onclick="postCart()">구매하기</button>';
			       echo "</form>";
		      ?>

          
        </div>
		   

        <div> 
          <script type="text/javascript">
           function postCart()
           {
         var f = document.getElementsByName("cartform");
         var ch =  document.getElementsByName("product[]");
         var hidden =  document.getElementsByName("list_check[]");
         for(var i = 0 ; i<ch.length ; i++){
                  if(ch[i].checked == true){
                    hidden[i].value=1;
                  }
          else
            hidden[i].value=0;
                }
         f.submit();
           }

          </script>
 <?
            $id = $_GET['id'];
            $sql = "select PNAME,PPHOTO,COUNT,ORDERS.PRICE, ADDR, PHONE, CUSTOMER
                      from PRODUCT join ORDERS on ORDERS.PNUM = PRODUCT.PNUM
                      where USERID='".$id."'";

            $res = mysql_query($sql);
          ?>

          <table align="center" cellpadding="5" cellspacing="0" border="1" bordercolor="#CCEEFF">
            <tr>
              <th width="100">주문자</th>
              <th width="100">제품사진</th>
              <th width="100">제품명</th>
              <th width="100">수량</th>
              <th width="100">가격</th>
              <th width="150">주소</th>
              <th width="100">전화번호</th>

            </tr>
            <tr>
			
          <?
          $price=0;
          while($row = mysql_fetch_array($res))
          {
            echo "<tr>
            <td>".$row['CUSTOMER']."</td>
            <td><img src='./photo/".$row['PPHOTO']."' width = '20' heigth = '20'></td>
            <td>".$row['PNAME']."</td>
            <td>".$row['COUNT']."</td>
            <td>".$row['PRICE']*$row['COUNT']."</td>
            <td>".$row['ADDR']."</td>
            <td>".$row['PHONE']."</td>
            </tr>";
            
            //$price=$row['PRICE']*$buy_count;
          }
          ?>
          </table>

        </div>



        <div> 
        <?
            $id = $_GET['id'];
            $sql = "select FNUM, SDATE, FDATE
                      from RESERVE
                      where USERID='".$id."'";
            $res = mysql_query($sql);
          ?>
          <table align="center" cellpadding="5" cellspacing="0" border="1" bordercolor="#CCEEFF">
            <tr>
              <th width="100">농장번호</th>
              <th width="100">시작일자</th>
              <th width="100">끝일자</th>
            </tr>
            <tr>
          <?
          while($row = mysql_fetch_array($res))
          {
            echo "<tr>
            <td>".$row['FNUM']."</td>
            <td>".$row['SDATE']."</td>
            <td>".$row['FDATE']."</td>
            </tr>";
          }
          ?>
          </table>
      </div>
    </div>  


    </div>  

</body>
</html>