<? include "lib.php";
include "./connect_db.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<head>
		<title>농작물 상세보기</title>
		<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="./bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="pinfo.css"/>

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
            <li> <li><a href="http://localhost/web/logout.php">로그아웃</a></li>;
            <?
            }
          ?>
          </ul>
        </div>
</div>
<!-- 상단 네비게이션 바 끝 -->

	<?
		$p_num = $_GET['pnum'];
		$f_num = $_GET['fnum'];
		//$f_num = 3;
		 
		
		 $sql = "select PCOUNT,PNAME,PPHOTO,description,PRICE from product where PNUM=";
		 $sql .= $p_num." and FNUM=".$f_num;

		 $res = mysql_query($sql,$connect);
		 $show = mysql_fetch_assoc($res);


		 $PNAME = $show[PNAME];
		 $PCOUNT = $show[PCOUNT];
		 $DESCRIPTION = $show[description];
		 $PRICE = $show[PRICE];
		 $PPHOTO = "./photo/".$show[PPHOTO];

	?>

      <div id="header" align="center">
      
      	<?

            
            
            $sql = "select UPhoto,Name from USER, FARM where USER.USERID=FARM.USERID and FNUM=".$f_num;
             $res=mysql_query($sql);
             $user = mysql_fetch_assoc($res);
              $userphoto = './photo/'.$user[UPhoto];
              $username=$user[Name];
          ?>
         <img width = "100" heigth = "100" src=<?=$userphoto?>>
	    <?
	        echo $username, "님의 농장", "<br/>";
	    ?>
		            
       </div>
   </br>
	<div class="container">
		<div id ="img" >
				
			<img id="image" style="height:100%; height:100%;" src = <?= $PPHOTO?> class="img-rounded">
		</div>
		
		<div id = "info">
		
		<?
			$product = $show[PNAME];
		
					$pcost = $show[PRICE];
			$pcount = $show[PCOUNT];
			$count = 0;
		?>	
		<div style="font-family: '배달의민족 한나','맑은 고딕'; font-size:50px;">
		<? echo $product ?>
		
	</div>
		가격 : <? echo $pcost ?>	</br></br>						
		남은 수량 : <? echo $pcount ?>g	</br>
		</br>
		수량
			<input id="spinner" type="text"  min="1"/>
				<div id="slider"></div>
				<script>
				$(function(){
				    //스피너 함수
				 
				    $("#spinner").spinner({
				    	max : <?=$pcount?>,
				    	stop: function(event,ui){
				    		var val = $(event.target).val();
				    		$("#totalPrice").text(val*<?=$pcost?>);
				    	}

				    });				   
				})
				</script>
			</br>
			<h4>
				총 결제금액 : <strong id="totalPrice">0</strong>원
				<?
				//echo $var;
				$count =0;
				?>
			</h4>
			</br>
		<script>
			function send(){//이 함수를 호출하면
				var count = $("#spinner").val();
				location.href="/web/pay.php?fnum=<?=$f_num?>&pnum=<?=$p_num?>&buycount="+count;
			}
			

			
			function gocart(){//이 함수를 호출하면
            var count = $("#spinner").val();
            <?
               $pnum = $_GET['pnum'];
               $id = $_SESSION['id'];
            ?>
            location.href="/web/add_cart.php?pnum=<?=$pnum?>&id=<?=$id?>&count="+count;
         }   
        </script>

		<div class = "btn-group">
		<button id = "buy" class="btn btn-success" onclick="send()">바로구매</button>
      	<button id = "cart" class="btn btn-default" onclick="gocart()">장바구니담기</button>			
		</div>

			
      </div>
</div>
		</br></br></br>
		<div id = "text">
		</br>
			<div style="font-family: '배달의민족 한나','맑은 고딕'; font-size:30px;">
			제품 상세 설명
		</div>
		</br>
				<? echo "$show[description]" ?>
			</br>				
			</div>
</br></br>
<center>
<div id="footer">
            <img src="./photo/copyright.png" height="50px">
        </div>
	</div>
	</center>
</body>
</html>