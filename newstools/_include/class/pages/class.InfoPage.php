<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 클래스명	: InfoPage
	// 경로		: [www]/_include/class/
	// 코드		: ANSI
	// 설명		: 기본 페이지 출력 클래스
	// 작성자	: 최진원 (jw.choi@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090424
#endregion

if( !class_exists("InfoPage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BBSPage" );

	class InfoPage extends BBSPage
	{
		//클래스 생성자
		function InfoPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "info" );	//좌측메뉴클래스
		}

		#region 상속받은 메소드 보완
			/**
			* 데이터 초기화
			*
			*/
			function InitField()
			{
				parent::InitField();
			}
		#endregion
	}
}
?>



