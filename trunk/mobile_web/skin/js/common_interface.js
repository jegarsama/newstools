/*#region License Statement								*/
/*Copyright (c) www.newstools.kr All rights reserved.	*/
/*코드	: UTF-8											*/
/*설명	: 공용 interface 클래스							*/
/*작성자	: LastDragon								*/
/*소속명	: www.newstools.kr							*/
/*수정일	: 20120226									*/
/*#endregion											*/

/* STR : 기본 인터페이스용 함수*/
	//데이터 분리구분자 및 해당 처리 함수
	var _splitkey_ = "#";	//'#'은 쉽게 입력이 가능하므로, '\t'를 제안드립니다.
	function SplitData(arg) {	return arg.split(_splitkey_);	}
	function MergeData(list, data) {	return (list + _splitkey_ + data);	}


	//데이터 검증 반환용 인터페이스 선언 : 페이지마다 별도 구현 필요
	function readWebData() {
		return '';
	}

	//Phone으로 부터 초기값을 전달받는 인터페이스 선언 : 페이지마다 별도 구현 필요
	function WmWriteMsg(arg) {
		var arryData = new Array();
		arryData = SplitData(arg);
	}


	//Phone에서 데이터를 읽어들이는 함수 : 입력에러 발생시에는 데이터 전달 중지
	function WmReadMsg(arg) {
		var data = readWebData();
		if ( data=='' ) {	//입력에러 발생시에는 빈 문자열
			return;
		}
		else if (arg=="android") {
			window.HybridApp.javascriptToAppMessage(  );	// android 메소드 호출
		}
		else {
			windows.location="jsall://"+readWebData();
		}
	}
/* END : 기본 인터페이스용 함수*/


/* STR : jQuery 메소드 선언 */
(function ($) {
	//이미지 태그 소스 파일명 교체
	$.fn.ImageStateChanger = function (stateVal, onstate, offstate) {
		if( stateVal )
		{
			$(this).attr('src', $(this).attr('src').replace(offstate, onstate));
		}
		else
		{
			$(this).attr('src', $(this).attr('src').replace(onstate, offstate));
		}
	};
})(jQuery);
/* END : jQuery 메소드 선언 */