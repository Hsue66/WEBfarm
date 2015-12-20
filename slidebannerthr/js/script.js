
 $( function () 
   {
    //첫번째 배너
    $( "#image_list_1" ).jQBanner( {//롤링을 할 영역의 ID 값
        nWidth: 904,				//영역의 width
        nHeight: 456,				//영역의 height
        nCount: 3,					//돌아갈 이미지 개수
        isActType: "up",			//움직일 방향 (left, right, up, down)
        nOrderNo: 1,				//초기 이미지
        nDelay: 2000				//롤링 시간 타임 (1000 = 1초)

    } );
    //두번째 배너
    $( "#image_list_2" ).jQBanner( {
                                    //롤링을 할 영역의 ID 값
        nWidth: 900,				//영역의 width
        nHeight: 400,				//영역의 height
        nCount: 5,					//돌아갈 이미지 개수
        isActType: "right",			//움직일 방향 (left, right, up, down)
        nOrderNo: 1,				//초기 이미지
        nDelay: 3000				//롤링 시간 타임 (1000 = 1초)
        
    } );
    //세번째 배너
    $( "#image_list_3" ).jQBanner( {
        nWidth: 600,
        nHeight: 150,
        nCount: 5,
        isActType: "right",
        nOrderNo: 1,
        isStartAct: "N",
        isStartDelay: "Y",
        nDelay: 3000,
        isBtnType: "img"
    } );
} );

 