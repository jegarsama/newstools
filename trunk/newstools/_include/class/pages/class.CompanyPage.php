<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// Ŭ������	: CompanyPage
	// ���		: [www]/_include/class/
	// �ڵ�		: ANSI
	// ����		: �⺻ ������ ��� Ŭ����
	// �ۼ���	: ������ (jw.kim@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090424
#endregion

if( !class_exists("CompanyPage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BBSPage" );

	class CompanyPage extends BBSPage
	{
		//Ŭ���� ������
		function CompanyPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "company" );	//�����޴�Ŭ����
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



