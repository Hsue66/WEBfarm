<? include "lib.php";
include "./connect_db.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<title>판매품목 등록</title>
	<script type="text/javascript" src="./nse_files/js/HuskyEZCreator.js" charset="utf-8"></script> 
	<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="register.css"/>
	<style>
	.nse_content{width:660px;height:500px}
	</style>
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
	<div id = "header">
		
			<? # 추후에 num을 받아서 img를 보일것
			
			$num = $_GET['farmnum'];
				// DB에서 인자 불러오기
			?>
			판매품목 등록
			
		</div>
		</br></br>
		<div id = "container" align="center">
			<form  enctype="multipart/form-data"  name="nse" action="add_db_nse.php" method="post">
				<div id = "strInfo" align="center">
					<input name = "f_num" type="hidden" value = <?=$num?>>
					<div class="form-group">
						<label class="col-lg-2 control-label">품명</label>
						<input id="P_name" placeholder="품명을 입력하세요." name = "p_name" class="form-control" type="text">
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label">재고량</label>
						<input id="P_count" placeholder="재고량을 입력하세요." name = "p_count" class="form-control" type="text">
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label">가격</label>
						<input id="P_cost" placeholder="가격을 입력하세요." name = "p_cost" class="form-control" type="text">
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">대표이미지</label>
						<input type="file" class="btn btn-default" class="file_input_hidden" onchange="javascript: 
						document.getElementById('fileName').value = this.value" name="upload"/>
						<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
						<input type="hidden" name="mode" value="upload" />
					</div>
				</div>
			</br>
			<center>
			<div id ="contents" align="center">
				
				<textarea name="ir1" id="ir1" class="nse_content" ></textarea>
			</div>
		</center>
				<script type="text/javascript">
				var oEditors = [];
				nhn.husky.EZCreator.createInIFrame({
					oAppRef: oEditors,
					elPlaceHolder: "ir1",
					sSkinURI: "./nse_files/SmartEditor2Skin.html",
					fCreator: "createSEditor2"
				});
				function submitContents(elClickedObj) {
		 oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다. 
		 // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

		 try {
		 	elClickedObj.form.submit();
		 } catch(e) {}
		}
		</script> 
		</br>
		</br>
		<script>
			function cancel()
			{
				history.back();
			}
		</script>
		<center><input type="submit"  value="등록하기" class="btn btn-success" onclick="submitContents(this);" />
			
		</center>
		</br>
	</form>
	<button class="btn btn-default" id="cancel" onclick="history.back()">취소하기</button>
</br>
		</br>
		</br>
</div>
<center>
<div id="footer">
            <img src="./photo/copyright.png" height="50px">
        </div>
        </center>
</div>

</div>


</body>
</html>