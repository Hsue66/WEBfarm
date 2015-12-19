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

<body>
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
            <li class="active"><a href="http://localhost/web/main.html">홈으로</a></li>
            <li><a href="http://localhost/web/login.html">로그인</a></li>
            <li><a href="#contact">회원가입</a></li>
          </ul>
        </div>
</div>

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
            $sql = "select PNAME,PPHOTO,COUNT,PRICE
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
                  if(checkArr[i].checked == true)
                    price += Number(checkArr[i].value);
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
          while($row = mysql_fetch_array($res))
          {
            echo "<tr><td><input type=checkbox name='product[]' value=".$row['PRICE']*$row['COUNT']." onclick=\"checkfunc();\"></td>
            <td><img src='./photo/".$row['PPHOTO']."' width = '20' heigth = '20'></td>
            <td>".$row['PNAME']."</td>
            <td>".$row['COUNT']."</td>
            <td>".$row['PRICE']*$row['COUNT']."</td></tr>";
          }
          ?>
          <script>
            function check()
            { 
             // $("#price").text($("#").val());
            }
          </script>
          </table>
            결제금액<strong id = "price"></strong>
          </br>
            <button id="buy" class="btn btn-success"> 구매하기</button>
        </div>


        <div>주문목록 페이지
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
          <script>
            function check()
            { 
             // $("#price").text($("#").val());
            }
          </script>
          </table>

        </div>



        <div>예약목록 </div>
      </div>
    </div>  

</body>
</html>