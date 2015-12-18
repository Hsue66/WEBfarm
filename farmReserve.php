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

				<!--datepicker
				<div id = "date">
					<script>
					$(document).ready(function () {
						$.datepicker.regional['ko'] = {

							prevText: '이전달',
							nextText: '다음달',

							monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
							'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
							monthNamesShort: ['1월','2월','3월','4월','5월','6월',
							'7월','8월','9월','10월','11월','12월'],
							dayNames: ['일','월','화','수','목','금','토'],
							dayNamesShort: ['일','월','화','수','목','금','토'],
							dayNamesMin: ['일','월','화','수','목','금','토'],

							dateFormat: 'yy-mm-dd',

							showMonthAfterYear: true,
							yearSuffix: '',
							showOn: 'both',
							buttonText: "달력",
							changeMonth: true,
							changeYear: true,
							yearRange: 'c-99:c+99',
						};
						$.datepicker.setDefaults($.datepicker.regional['ko']);

						$('#sdate').datepicker();
						$('#sdate').datepicker("option", "maxDate", $("#edate").val());
						$('#sdate').datepicker("option", "onClose", function ( selectedDate ) {
							$("#edate").datepicker( "option", "minDate", selectedDate );
						});

						$('#edate').datepicker();
						$('#edate').datepicker("option", "minDate", $("#sdate").val());
						$('#edate').datepicker("option", "onClose", function ( selectedDate ) {
							$("#sdate").datepicker( "option", "maxDate", selectedDate );

						});
					});
					</script>
				시작날짜 : <input type="text" id="sdate"> 
				</br>
				 종료날짜 : <input type="text" id="edate">

			</div>

		</br>
-->


		  <script>

		   var flag = 0;
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
			         var sdate = $("#datepicker").val();
			          }
			          else{
			             $("#datepicker").datepicker("option","maxDate",selectedDate);
			             flag = 0;
			             $("#finish").text($("#datepicker").val());
			             var edate = $("#datepicker").val();
			          }
			          
			       }
			    });

			  });

		  </script>
		  
		<div id="datepicker">
		</br>
			<strong id="start">시작날짜</strong>~
			<strong id="finish">종료날짜</strong>
			<button id="refresh" class="btn btn-default" onclick="location.href='http://localhost/nse/farmReserve.php'">refresh</button>
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
		이용달수 : <strong id="duration">0</strong>원
	</br>	
		총 예약금액 :<h4> <? echo $cost ?>원</h4>
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
