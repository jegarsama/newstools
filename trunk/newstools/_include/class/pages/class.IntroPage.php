<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// Ŭ������	: IntroPage
	// ���		: [www]/_include/class/
	// �ڵ�		: ANSI
	// ����		: Intro �⺻ Ŭ����
	// �ۼ���	: �輺ȣ (sh.kim@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090504
#endregion

if( !class_exists("IntroPage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BBSPage" );

	class IntroPage extends BBSPage
	{
		//Ŭ���� ������
		function IntroPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "intro" );	//�����޴�Ŭ����
		}

		#region ��ӹ��� �޼ҵ� ����
			/**
			* ������ �ʱ�ȭ
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



