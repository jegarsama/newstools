<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// Ŭ������	: FilePage
	// ���		: [www]/_include/class/
	// �ڵ�		: ANSI
	// ����		: �⺻ ������ ��� Ŭ����
	// �ۼ���	: ������ (jw.choi@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090424
#endregion

if( !class_exists("FilePage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BBSPage" );

	class FilePage extends BBSPage
	{
		//Ŭ���� ������
		function FilePage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "file" );	//�����޴�Ŭ����
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



