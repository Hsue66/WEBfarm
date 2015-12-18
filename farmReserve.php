<? include "lib.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<title>농장 예약</title>
	<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="reserve.css"/>

	<!--datepicker 사용용-->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" media="all" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
	<link href ="bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<style>
	.ui-datepicker{ font-size: 20px; width: 400px; }
	.ui-datepicker select.ui-datepicker-month{ width:30%; font-size: 11px; }
	.ui-datepicker select.ui-datepicker-year{ width:40%; font-size: 11px; }
	</style>
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
	
	<div id = "header" >

				<? # 추후에 num을 받아서 img를 보일것
				$f_num = $_GET['farmnum'];
				//$f_num = '4';

				?>
				<?
				include "./connect_db.php";
				
				$sql = "select SIZE,PRICE from FARM where FNUM=";
				//$sql = "select SIZE,PRICE,FPHOTO from FARM where FNUM=";
				$sql .= $f_num;

				$res = mysql_query($sql,$connect);
				$show = mysql_fetch_assoc($res);

				$PSIZE = $show[SIZE];
				$PRICE = $show[PRICE];
				//$FPHOTO = "./photo/".$show[FPHOTO];
				$FPHOTO = "./photo/".$f_num."farm.png";	
				?>		
				<h1><? echo $f_num ?>번 농장</h1>
				
			</div>
			<div id = "container" align= "center">

				<div id ="img">
					<img src = <?= $FPHOTO ?>>
				</div>

		 <script>

         var flag = 0;
         var duration, edateObj, sdateObj;
         var sdate;
           $(function() {
            
             $( "#datepicker" ).datepicker({
                changeMonth: true,
                onSelect: function(selectedDate){
                   if(flag == 0){
                      flag = 1;
                      $("#datepicker").datepicker("option","maxDate",null);
                      $("#datepicker").datepicker("option","minDate",null);
                      $("#datepicker").datepicker("option","minDate",selectedDate);
                       $("#start").text($("#datepicker").val());
                      sdate = $("#datepicker").val().split("/");
                      sdateObj = new Date(sdate[2], Number(sdate[0])-1, sdate[1]);
                   }
                   else{
                      $("#datepicker").datepicker("option","maxDate",selectedDate);
                      flag = 0;
                      $("#finish").text($("#datepicker").val());
                      var edate = $("#datepicker").val().split("/");
                      edateObj = new Date(edate[2], Number(edate[0])-1, edate[1]); 

                      var duration = (edateObj.getTime() - sdateObj.getTime()) / 1000 / 60 / 60 / 24;
                      $("#duration").text(duration);
                      var cost = <?=$PRICE?>/6;
                      
                      var due = Math.ceil(duration/30);

                      cost = cost*due;
                      $("#costcount").text(cost);
                   }
                   
                }
             });

           });
        </script>
		  
		<div id="datepicker">
		</br>
			<strong id="start">시작날짜</strong>~
			<strong id="finish">종료날짜</strong>
			<button id="refresh" class="btn btn-default" onclick="location.href='http://localhost/web/farmReserve.php?farmnum=<?=$f_num?>'">refresh</button>
		</br>
		</br>
		</div>

	</div>
</br>
		<div id = "cost">
		면적 : <?=$PSIZE ?>평
		</br>
		대여비(반년) : <strong><?=$PRICE ?></strong>
	</br>	
		<script>

		</script>
		<? 
		
		//$cost = $duration*10000;
		?>
		이용달수 : <strong id="duration">0</strong>일
	</br>	
		총 예약금액 :<h4> <strog id="costcount">0</strong> 원</h4>
	</br>

		<center>
		<div class = "btn-group">
		<button id = "reserve" class="btn btn-success">예약하기</button>
      	<button id = "back" class="btn btn-default" onclick="history.back()">돌아가기</button>			
		</div>
		</center>

	</div>

</body>
</html>
