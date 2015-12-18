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
        <h1>Hyuk's 농장</h1>
    </div>

	<?
		$p_num = $_GET['pnum'];
		$f_num = $_GET['fnum'];
		//$f_num = 3;
		 
		 include "./connect_db.php";
		
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
	<div class="container">
		<div id ="img" >
			<img id="image" src = <?= $PPHOTO?> class="img-rounded">
		</div>
		
		<div id = "info">
		<?
			$product = $show[PNAME];
			$pcost = $show[PRICE];
			$pcount = $show[PCOUNT];
			$count = 0;
		?>	
		<h1><? echo $product ?></h1>
		가격 : <? echo $pcost ?>	</br></br>						
		남은 수량 : <? echo $pcount ?>kg	</br>
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
				총 결제금액 : <strong id="totalPrice">0</strong>원
				<?
				//echo $var;
				?>

			</br>
			</br>
		<script>
			function send(){//이 함수를 호출하면
				var count = $("#spinner").val();
				location.href="/web/pay.php?fnum=<?=$f_num?>&pnum=<?=$p_num?>&buycount="+count;
			}
			
			function gocart(){//이 함수를 호출하면
				alert("장바구니에 등록되었습니다!");			
			}
		//"location.href='/web/pay.php?pnum=<?=$p_num?>&buycount=<?=$count?>'"
		</script>

		<div class = "btn-group">
		<button id = "buy" class="btn btn-success" onclick="send()">바로구매</button>
      	<button id = "cart" class="btn btn-default" onclick="gocart()">장바구니담기</button>			
		</div>

			
      </div>
</div>
		</br>
		<div id = "text">
			<h2>제품 상세 설명</h2>
		</br>
				<? echo "$show[description]" ?>
			</br>				
			</div>
</body>
</html>