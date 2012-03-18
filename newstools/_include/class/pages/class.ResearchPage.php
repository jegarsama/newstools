<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// Ŭ������	: ResearchPage
	// ���		: [www]/_include/class/pages/
	// �ڵ�		: ANSI
	// ����		: �������� ���� ��� Ŭ����
	// �ۼ���	: �輺ȣ (sh.kim@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090824
#endregion

if( !class_exists("ResearchPage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BasePage" );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "NT_Research", GDC_INC_ROOT );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_BBS", GDC_INC_ROOT );

	class ResearchPage extends BasePage
	{
		var $ResearchCode	= 0;			//�������� �ڵ�
		var $cls_NT_ResearchControl	= null;	//�������� ������ Ŭ����
		var $cls_EZ_BBSControl	= null;	//�Խ��� ������ Ŭ����

		//Ŭ���� ������
		function ResearchPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "research" );	//�����޴�Ŭ����
		}

		#region ��ӹ��� �޼ҵ� ����
			/**
			* ������ �ʱ�ȭ
			*
			*/
			function InitField()
			{
				parent::InitField();
				$this->cls_NT_ResearchControl = new NT_Research();
				$this->cls_EZ_BBSControl = new EZ_BBS();
			}

			/**
			* DBA ����
			*
			* @param class		$acls_DBA				:	DBA Ŭ����
			*/
			function SetDBA( $acls_DBA )
			{
				parent::SetDBA( $acls_DBA );
				$this->cls_NT_ResearchControl->SetDBA( $acls_DBA );
				$this->cls_EZ_BBSControl->SetDBA( $acls_DBA );
			}
		#endregion

		#region Comment ���� ������ ����
			/**
			* �Խù� ��ȸ
			*
			* @param string		$as_Condition			:	���� ���Ǻ�
			* @param string		$as_Orderby				:	���ļ���
			* @return recordset
			*/
			function GetSelectRecordsOfComment( $as_Condition="", $as_Orderby=" ORDER BY idx DESC " )
			{
				return $this->cls_EZ_BBSControl->GetSelectRecords( "ez_comment", $this->cls_EZ_BBSControl->GetQueryWithCommentFilter( $as_Condition ), $as_Orderby );
			}

			/**
			* ���ڵ� ��������
			*
			* @param recordset	$ars_Source				:	������ ���� ���ڵ��
			* @param array		$arr_Fields				:	������ �������� �ʵ�迭
			* @return boolean
			*/
			function LoopForComment( $ars_Source, $arr_Fields=null )
			{
				return $this->cls_EZ_BBSControl->Loop( "ez_comment", $ars_Source, $arr_Fields );
			}

			/**
			* ��ȸ��� �Խù� ���翩�� Ȯ�� �� �ε�
			*
			* @param string		$as_Filter			:	��ȸ �⺻���� ����
			* @return boolean
			*/
			function LoadRecordOfComment( $as_Filter="" )
			{
				$ii_Idx		= $this->GetRequest( "cmtidx", 0 );
				$is_Filter	= " (idx='".$ii_Idx."') ".(empty($as_Filter) ? "" : "AND (".$as_Filter.") ");

				if( 0 < $ii_Idx )
				{
					return $this->cls_EZ_BBSControl->Load( "ez_comment", $this->cls_EZ_BBSControl->GetQueryWithCommentFilter( $is_Filter ) );
				}

				return false;
			}
		#endregion

		#region Secure Code
			/**
			* �����ڵ� ���� �� ���ǵ��ó��
			*
			* @return string
			*/
			function GetSecureCode()
			{
				global $_SESSION;

				$tmp_str = substr(md5(time()),0,10);

				list($usec, $sec) = explode(' ', microtime());
				$seed = (float)$sec + ((float)$usec * 100000);
				srand($seed);
				$keylen = strlen($tmp_str);
				$div = (int)($keylen / 2);
				while (count($arr) < 3)
				{
					unset($arr);
					for ($i=0; $i<$keylen; $i++)
					{
						$rnd = rand(1, $keylen);
						$arr[$rnd] = $rnd;
						if ($rnd > $div) break;
					}
				}

				sort($arr);

				$norobot_key = "";
				$norobot_str = "";
				$m = 0;
				for ($i=0; $i<count($arr); $i++)
				{
					for ($k=$m; $k<$arr[$i]-1; $k++)
						$norobot_str .= $tmp_str[$k];
					$norobot_str .= "<span class='norobot'>{$tmp_str[$k]}</span>";
					$norobot_key .= $tmp_str[$k];
					$m = $k + 1;
				}

				if ($m < $keylen)
				{
					for ($k=$m; $k<$keylen; $k++)
						$norobot_str .= $tmp_str[$k];
				}

				$norobot_str = "<span class='robot'>$norobot_str</span>";

				//session_start();
				$_SESSION["answer_session"] = $norobot_key;

				return $norobot_str;
			}

			/**
			* �����ڵ� ���� �� ���ǵ��ó��
			*
			* @return string
			*/
			function GetSecureCodeOfAllow()
			{
				global $_SESSION;
				return $_SESSION["answer_session"];
			}

			/**
			* �����ڵ� ��üũ
			*
			* @param string		$as_Code		:	�����ڵ�
			* @return boolean
			*/
			function IsSecureCodeAllow( $as_Code )
			{
				return ( empty($this->SESSION["answer_session"]) ? false : ($this->SESSION["answer_session"] == $as_Code) );
			}
		#endregion
	}
}
?>