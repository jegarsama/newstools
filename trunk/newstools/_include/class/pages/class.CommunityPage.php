<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// Ŭ������	: CommunityPage
	// ���		: [www]/_include/class/
	// �ڵ�		: ANSI
	// ����		: �⺻ ������ ��� Ŭ����
	// �ۼ���	: ������ (jw.choi@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090424
#endregion

if( !class_exists("CommunityPage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BBSPage" );

	class CommunityPage extends BBSPage
	{
		//Ŭ���� ������
		function CommunityPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "community" );	//�����޴�Ŭ����
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