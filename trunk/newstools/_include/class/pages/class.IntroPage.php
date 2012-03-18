<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 클래스명	: IntroPage
	// 경로		: [www]/_include/class/
	// 코드		: ANSI
	// 설명		: Intro 기본 클래스
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090504
#endregion

if( !class_exists("IntroPage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BBSPage" );

	class IntroPage extends BBSPage
	{
		//클래스 생성자
		function IntroPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "intro" );	//좌측메뉴클래스
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



