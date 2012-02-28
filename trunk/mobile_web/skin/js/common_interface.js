/*#region License Statement								*/
/*Copyright (c) www.newstools.kr All rights reserved.	*/
/*코드	: UTF-8											*/
/*설명	: 공용 interface 클래스							*/
/*작성자	: LastDragon								*/
/*소속명	: www.newstools.kr							*/
/*수정일	: 20120226									*/
/*#endregion											*/

/* STR : 기본 인터페이스용 함수*/
	function readWebData() {
		return '';
	}

	function WmReadMsg(arg) {
		if (arg=="android") {
			window.HybridApp.javascriptToAppMessage( readWebData() );	// android 메소드 호출
		}
		else {
			windows.location="jsall://"+readWebData();
		}
	}

	function WmWriteMsg(arg) {
		var arryData = new Array();
		arryData = arg.split("#");
	}
/* END : 기본 인터페이스용 함수*/