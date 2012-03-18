<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// Ŭ������	: SupportPage
	// ���		: [www]/_include/class/
	// �ڵ�		: ANSI
	// ����		: �⺻ ������ ��� Ŭ����
	// �ۼ���	: ������ (jw.choi@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090427
#endregion

if( !class_exists("SupportPage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BBSPage" );
	$gcls_ClassCollection->LoadClassDefine( "/SMS", "TelInfo", GDC_SYSTEM_ROOT );
	$gcls_ClassCollection->LoadClassDefine( "/data", "BankInfo", GDC_SYSTEM_ROOT );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_Support", GDC_INC_ROOT );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_Support2", GDC_INC_ROOT );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_Mailing", GDC_INC_ROOT );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_SupportCompany", GDC_INC_ROOT );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_SupportJawon", GDC_INC_ROOT );

	class SupportPage extends BBSPage
	{
		var $cls_TelInfo	= null;	//��ȭ��ȣ ������ Ŭ����
		var $cls_BankInfo	= null;	//�������� ������ Ŭ����
		var $cls_Support	= null;	//�����Ŀ����� ������ Ŭ����
		var $cls_Support2	= null;	//�Ͻ��Ŀ����� ������ Ŭ����
		var $cls_Mailing	= null;	//���ϸ����� ��û�� ������ Ŭ����
		var $cls_SupportCompany= null;	//����Ŀ� ��û���� ������ Ŭ����
		var $cls_SupportJawon= null;	//�ڿ����� ������ Ŭ����

		//Ŭ���� ������
		function SupportPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "support" );	//�����޴�Ŭ����
		}

		#region ��ӹ��� �޼ҵ� ����
			/**
			* ������ �ʱ�ȭ
			*
			*/
			function InitField()
			{
				parent::InitField();
				$this->cls_TelInfo = new TelInfo();
				$this->cls_BankInfo = new BankInfo();
				$this->cls_Support = new EZ_Support();
				$this->cls_Support2 = new EZ_Support2();
				$this->cls_Mailing= new EZ_Mailing();
				$this->cls_SupportCompany= new EZ_SupportCompany();
				$this->cls_SupportJawon= new EZ_SupportJawon();
			}

			/**
			* DBA ����
			*
			* @param class		$acls_DBA				:	DBA Ŭ����
			*/
			function SetDBA( $acls_DBA )
			{
				parent::SetDBA( $acls_DBA );
				$this->cls_Support->SetDBA( $acls_DBA );
				$this->cls_Support2->SetDBA( $acls_DBA );
				$this->cls_Mailing->SetDBA( $acls_DBA );
				$this->cls_SupportCompany->SetDBA( $acls_DBA );
				$this->cls_SupportJawon->SetDBA( $acls_DBA );
			}
		#endregion

		#region Support ���� ������ ����
			/**
			* �����Ŀ� ���� ���翩�� üũ
			*
			* @param string		$as_no			:	�ֹ�/����� ��Ϲ�ȣ
			* @param string		$as_case		:	����/��ü ����
			* @return boolean
			*/
			function IsExistSupportInfo( $as_no, $as_case="����" )
			{
				$rtn = false;

				switch( $as_case )
				{
					case "����":	$rtn = $this->cls_Support->IsExistSupportInfoByResno( $as_no );	break;
					case "��ü":	$rtn = $this->cls_Support->IsExistSupportInfoByComno( $as_no );	break;
				}

				return $rtn;
			}

			/**
			* �����Ŀ� ���� ���翩�� Ȯ�� �� �ε�
			*
			* @param integer	$ai_Idx			:	��ȸ �⺻ Key
			* @return boolean
			*/
			function LoadRecordOfSupportInfo( $ai_Idx )
			{
				if( 0 < $ai_Idx )
				{
					return $this->cls_Support->Load( "ez_support", " WHERE (idx='".$ai_Idx."') " );
				}

				return false;
			}

			/**
			* �����Ŀ� ���� �Է�(�߰�)ó��
			*
			* @return boolean
			*/
			function RegistSupportInfo()
			{
				$this->cls_Support->InitField( "ez_support" );

				$this->cls_Support->SetData( "ez_support", "series", $this->GetRequest( "series", "" ) );
				$this->cls_Support->SetData( "ez_support", "cata", $this->GetRequest( "cata", "" ) );
				$this->cls_Support->SetData( "ez_support", "name", $this->GetRequest( "name", "" ) );
				$this->cls_Support->SetData( "ez_support", "resno", $this->GetRequest( "resno", "" )."-".$this->GetRequest( "resno2", "" ) );
				$this->cls_Support->SetData( "ez_support", "comno", $this->GetRequest( "comno", "" )."-".$this->GetRequest( "comno2", "" )."-".$this->GetRequest( "comno3", "" ) );
				$this->cls_Support->SetData( "ez_support", "email", $this->GetRequest( "email", "" ) );

				$this->cls_Support->SetData( "ez_support", "post1", $this->GetRequest( "post", "" )."-".$this->GetRequest( "post2", "" ) );
				$this->cls_Support->SetData( "ez_support", "address11", $this->GetRequest( "address", "" ) );
				$this->cls_Support->SetData( "ez_support", "address12", $this->GetRequest( "address2", "" ) );

				$this->cls_Support->SetData( "ez_support", "hphone", $this->GetRequest( "hphone", "" )."-".$this->GetRequest( "hphone2", "" )."-".$this->GetRequest( "hphone3", "" ) );
				$this->cls_Support->SetData( "ez_support", "resms", $this->GetRequest( "resms", "" ) );

				$this->cls_Support->SetData( "ez_support", "tphone", $this->GetRequest( "tphone1_1", "" )."-".$this->GetRequest( "tphone1_2", "" )."-".$this->GetRequest( "tphone1_3", "" ) );
				$this->cls_Support->SetData( "ez_support", "tphone2", $this->GetRequest( "tphone2_1", "" )."-".$this->GetRequest( "tphone2_2", "" )."-".$this->GetRequest( "tphone2_3", "" ) );

				return $this->cls_Support->Insert( "ez_support" );
			}

			/**
			* �����Ŀ� �⺻���� ����ó��
			*
			* @param integer	$ai_Idx			:	��ȸ �⺻ Key
			* @return boolean
			*/
			function UpdateSupportInfoBasic( $ai_Idx )
			{
				if( $this->LoadRecordOfSupportInfo( $ai_Idx ) )
				{
					$this->cls_Support->SetData( "ez_support", "series", $this->GetRequest( "series", "" ) );
					$this->cls_Support->SetData( "ez_support", "cata", $this->GetRequest( "cata", "" ) );
					$this->cls_Support->SetData( "ez_support", "name", $this->GetRequest( "name", "" ) );
					$this->cls_Support->SetData( "ez_support", "resno", $this->GetRequest( "resno", "" )."-".$this->GetRequest( "resno2", "" ) );
					$this->cls_Support->SetData( "ez_support", "comno", $this->GetRequest( "comno", "" )."-".$this->GetRequest( "comno2", "" )."-".$this->GetRequest( "comno3", "" ) );
					$this->cls_Support->SetData( "ez_support", "email", $this->GetRequest( "email", "" ) );

					$this->cls_Support->SetData( "ez_support", "post1", $this->GetRequest( "post", "" )."-".$this->GetRequest( "post2", "" ) );
					$this->cls_Support->SetData( "ez_support", "address11", $this->GetRequest( "address", "" ) );
					$this->cls_Support->SetData( "ez_support", "address12", $this->GetRequest( "address2", "" ) );

					$this->cls_Support->SetData( "ez_support", "hphone", $this->GetRequest( "hphone", "" )."-".$this->GetRequest( "hphone2", "" )."-".$this->GetRequest( "hphone3", "" ) );
					$this->cls_Support->SetData( "ez_support", "resms", $this->GetRequest( "resms", "" ) );

					$this->cls_Support->SetData( "ez_support", "tphone", $this->GetRequest( "tphone1_1", "" )."-".$this->GetRequest( "tphone1_2", "" )."-".$this->GetRequest( "tphone1_3", "" ) );
					$this->cls_Support->SetData( "ez_support", "tphone2", $this->GetRequest( "tphone2_1", "" )."-".$this->GetRequest( "tphone2_2", "" )."-".$this->GetRequest( "tphone2_3", "" ) );

					return $this->cls_Support->Update( "ez_support", "WHERE (idx='".$ai_Idx."')" );
				}

				return false;
			}

			/**
			* �����Ŀ� �Ա����� ����ó��
			*
			* @param integer	$ai_Idx			:	��ȸ �⺻ Key
			* @return boolean
			*/
			function UpdateSupportInfoPayment( $ai_Idx )
			{
				if( $this->LoadRecordOfSupportInfo( $ai_Idx ) )
				{
					$this->cls_Support->SetData( "ez_support", "cate", $this->GetRequest( "cate", "" ) );
					$this->cls_Support->SetData( "ez_support", "bank", $this->GetRequest( "bank", "" ) );
					$this->cls_Support->SetData( "ez_support", "smoney", $this->GetRequest( "smoney", "" ) );
					$this->cls_Support->SetData( "ez_support", "account", $this->GetRequest( "account", "" ) );
					$this->cls_Support->SetData( "ez_support", "payername", $this->GetRequest( "payername", "" ) );
					$this->cls_Support->SetData( "ez_support", "payerresno", $this->GetRequest( "payerresno", "" )."-".$this->GetRequest( "payerresno2", "" ) );
					$this->cls_Support->SetData( "ez_support", "cday", $this->GetRequest( "cday", "" ) );
					$this->cls_Support->SetData( "ez_support", "comment", $this->GetRequest( "comment", "" ) );
					$this->cls_Support->SetUsable( "ez_support", "comment", ($this->cls_Support->GetData( "ez_support", "comment" )!="") );

					return $this->cls_Support->Update( "ez_support", "WHERE (idx='".$ai_Idx."')" );
				}

				return false;
			}
		#endregion

		#region Support2 ���� ������ ����
			/**
			* �����Ŀ� ���� ���翩�� Ȯ�� �� �ε�
			*
			* @param integer	$ai_Idx			:	��ȸ �⺻ Key
			* @return boolean
			*/
			function LoadRecordOfSupportInfo2( $ai_Idx )
			{
				if( 0 < $ai_Idx )
				{
					return $this->cls_Support2->Load( "ez_support2", " WHERE (idx='".$ai_Idx."') " );
				}

				return false;
			}

			/**
			* �����Ŀ� ���� �Է�(�߰�)ó��
			*
			* @return boolean
			*/
			function RegistSupportInfo2()
			{
				$this->cls_Support2->InitField( "ez_support2" );

				$this->cls_Support2->SetData( "ez_support2", "series", $this->GetRequest( "series", "" ) );
				$this->cls_Support2->SetData( "ez_support2", "cata", $this->GetRequest( "cata", "" ) );
				$this->cls_Support2->SetData( "ez_support2", "name", $this->GetRequest( "name", "" ) );
				$this->cls_Support2->SetData( "ez_support2", "resno", $this->GetRequest( "resno", "" )."-".$this->GetRequest( "resno2", "" ) );
				$this->cls_Support2->SetData( "ez_support2", "comno", $this->GetRequest( "comno", "" )."-".$this->GetRequest( "comno2", "" )."-".$this->GetRequest( "comno3", "" ) );
				$this->cls_Support2->SetData( "ez_support2", "email", $this->GetRequest( "email", "" ) );

				$this->cls_Support2->SetData( "ez_support2", "post1", $this->GetRequest( "post", "" )."-".$this->GetRequest( "post2", "" ) );
				$this->cls_Support2->SetData( "ez_support2", "address11", $this->GetRequest( "address", "" ) );
				$this->cls_Support2->SetData( "ez_support2", "address12", $this->GetRequest( "address2", "" ) );

				$this->cls_Support2->SetData( "ez_support2", "hphone", $this->GetRequest( "hphone", "" )."-".$this->GetRequest( "hphone2", "" )."-".$this->GetRequest( "hphone3", "" ) );

				$this->cls_Support2->SetData( "ez_support2", "tphone", $this->GetRequest( "tphone1_1", "" )."-".$this->GetRequest( "tphone1_2", "" )."-".$this->GetRequest( "tphone1_3", "" ) );

				$this->cls_Support2->SetData( "ez_support2", "motivation", "���������Է���" );	//������ ����ó��

				return $this->cls_Support2->Insert( "ez_support2" );
			}

			/**
			* �����Ŀ� �⺻���� ����ó��
			*
			* @param integer	$ai_Idx			:	��ȸ �⺻ Key
			* @return boolean
			*/
			function UpdateSupportInfoBasic2( $ai_Idx )
			{
				if( $this->LoadRecordOfSupportInfo2( $ai_Idx ) )
				{
					$this->cls_Support2->SetData( "ez_support2", "series", $this->GetRequest( "series", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "cata", $this->GetRequest( "cata", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "name", $this->GetRequest( "name", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "resno", $this->GetRequest( "resno", "" )."-".$this->GetRequest( "resno2", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "comno", $this->GetRequest( "comno", "" )."-".$this->GetRequest( "comno2", "" )."-".$this->GetRequest( "comno3", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "email", $this->GetRequest( "email", "" ) );

					$this->cls_Support2->SetData( "ez_support2", "post1", $this->GetRequest( "post", "" )."-".$this->GetRequest( "post2", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "address11", $this->GetRequest( "address", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "address12", $this->GetRequest( "address2", "" ) );

					$this->cls_Support2->SetData( "ez_support2", "hphone", $this->GetRequest( "hphone", "" )."-".$this->GetRequest( "hphone2", "" )."-".$this->GetRequest( "hphone3", "" ) );

					$this->cls_Support2->SetData( "ez_support2", "tphone", $this->GetRequest( "tphone1_1", "" )."-".$this->GetRequest( "tphone1_2", "" )."-".$this->GetRequest( "tphone1_3", "" ) );

					return $this->cls_Support2->Update( "ez_support2", "WHERE (idx='".$ai_Idx."')" );
				}

				return false;
			}

			/**
			* �����Ŀ� �Ա����� ����ó��
			*
			* @param integer	$ai_Idx			:	��ȸ �⺻ Key
			* @return boolean
			*/
			function UpdateSupportInfoPayment2( $ai_Idx )
			{
				if( $this->LoadRecordOfSupportInfo2( $ai_Idx ) )
				{
					$this->cls_Support2->SetData( "ez_support2", "job", $this->GetRequest( "job", "" ) );				//ó���ڵ�
					$this->cls_Support2->SetData( "ez_support2", "motivation", $this->GetRequest( "motivation", "" ) );	//ó�����
					$this->cls_Support2->SetData( "ez_support2", "pay", $this->GetRequest( "pay", "" ) );				//��αݾ�
					$this->cls_Support2->SetData( "ez_support2", "condition", $this->GetRequest( "condition", "" ) );	//��ι��
					$this->cls_Support2->SetData( "ez_support2", "payername", $this->GetRequest( "payername", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "payerresno", $this->GetRequest( "payerresno", "" )."-".$this->GetRequest( "payerresno2", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "comment", $this->GetRequest( "comment", "" ) );
					$this->cls_Support2->SetUsable( "ez_support2", "comment", ($this->cls_Support2->GetData( "ez_support2", "comment" )!="") );

					return $this->cls_Support2->Update( "ez_support2", "WHERE (idx='".$ai_Idx."')" );
				}

				return false;
			}

			/**
			* �����Ŀ� �������� ����ó��
			*
			* @param integer	$ai_Idx			:	��ȸ �⺻ Key
			* @return boolean
			*/
			function UpdateSupportInfoStatus2( $ai_Idx, $res_cd, $res_msg, $tno )
			{
				if( $this->LoadRecordOfSupportInfo2( $ai_Idx ) )
				{
					$this->cls_Support2->SetData( "ez_support2", "job", $res_cd );			//ó���ڵ�
					$this->cls_Support2->SetData( "ez_support2", "motivation", $res_msg );	//ó�����
					$this->cls_Support2->SetData( "ez_support2", "religion", $tno );		// KCP �ŷ� ���� ��ȣ

					return $this->cls_Support2->Update( "ez_support2", "WHERE (idx='".$ai_Idx."')" );
				}

				return false;
			}
		#endregion

		#region SupportCompany ���� ������ ����
			/**
			* ����Ŀ� ���� �Է�(�߰�)ó��
			*
			* @return boolean
			*/
			function RegistSupportCompanyInfo()
			{
				$this->cls_SupportCompany->InitField( "ez_supportcompany" );

				$this->cls_SupportCompany->SetData( "ez_supportcompany", "comname", $this->GetRequest( "comname", "" ) );
				$this->cls_SupportCompany->SetData( "ez_supportcompany", "departname", $this->GetRequest( "departname", "" ) );
				$this->cls_SupportCompany->SetData( "ez_supportcompany", "contactname", $this->GetRequest( "contactname", "" ) );
				$this->cls_SupportCompany->SetData( "ez_supportcompany", "tphone", $this->GetRequest( "tphone_1", "" )."-".$this->GetRequest( "tphone_2", "" )."-".$this->GetRequest( "tphone_3", "" ) );
				$this->cls_SupportCompany->SetData( "ez_supportcompany", "hphone", $this->GetRequest( "hphone", "" )."-".$this->GetRequest( "hphone2", "" )."-".$this->GetRequest( "hphone3", "" ) );
				$this->cls_SupportCompany->SetData( "ez_supportcompany", "email", $this->GetRequest( "email", "" ) );
				$this->cls_SupportCompany->SetData( "ez_supportcompany", "content", $this->GetRequest( "content", "" ) );
				$this->cls_SupportCompany->SetData( "ez_supportcompany", "ip", $this->SERVER['REMOTE_ADDR'] );

				return $this->cls_SupportCompany->Insert( "ez_supportcompany" );
			}
		#endregion

		#region SupportJawon ���� ������ ����
			/**
			* List ������ ���� ����
			*
			* @param string		$as_Condition			:	���� ���Ǻ�
			* @param string		$as_Orderby				:	���ļ���
			* @param integer	$ai_RecordCntPerPage	:	�������� ���ڵ� ��
			* @param integer	$ai_PageCntPerBlock		:	���� ������ ��
			*/
			function LoadListInfoOfSupportJawon( $as_Condition="", $as_Orderby=" ORDER BY idx DESC ", $ai_RecordCntPerPage=20, $ai_PageCntPerBlock=5 )
			{
				$ii_page = $this->GetRequest( "page", 1, true );
				$ii_page = ($ii_page < 1) ? 1 : $ii_page;
				$this->SetListInfoFieldOfSupportJawon( "page", $ii_page );
				$this->SetListInfoFieldOfSupportJawon( "RecordCntPerPage", $ai_RecordCntPerPage );
				$this->SetListInfoFieldOfSupportJawon( "PageCntPerBlock", $ai_PageCntPerBlock );
				//$this->SetListInfoFieldOfSupportJawon( "PageQuery", "" );
				$this->SetListInfoFieldOfSupportJawon( "SearchSet", "&search_option=".$this->GetRequest( "search_option", "", true )."&keyword=".urlencode($this->GetRequest( "keyword", "", true )) );
				//$this->SetListInfoFieldOfSupportJawon( "LinkOption", "" );
				$is_SubSql = ($this->GetRequest( "search_option", "", true )=="") ? "" : (($this->GetRequest( "search_option", "", true )=="all") ? " AND (content like '%".$this->GetRequest( "keyword", "", true )."%')" : " AND (".$this->GetRequest( "search_option", "", true )." like '%".$this->GetRequest( "keyword", "", true )."%')");
				$this->SetListInfoFieldOfSupportJawon( "Addwhere", $as_Condition.$is_SubSql );
				//$this->SetListInfoFieldOfSupportJawon( "SpecialTop", 0 );

				$this->ReSetListInfoOfSupportJawon( $as_Orderby );
			}

			/**
			* List ������ ���� ����
			*
			* @param string		$as_Orderby				:	���ļ���
			*/
			function ReSetListInfoOfSupportJawon( $as_Orderby="" )
			{
				$this->cls_SupportJawon->ReSetListInfo( "ez_supportjawon", $as_Orderby );
			}

			/**
			* List ������ ���� �ʵ� ����
			*
			* @param string		$as_FieldName			:	�ʵ��
			* @param string		$as_Data				:	������
			*/
			function SetListInfoFieldOfSupportJawon( $as_FieldName, $as_Data )
			{
				$this->cls_SupportJawon->SetListInfoField( "ez_supportjawon", $as_FieldName, $as_Data );
			}

			/**
			* List ������ ���� �ʵ� ������ ȹ��
			*
			* @param string		$as_FieldName			:	�ʵ��
			* @return string/integer
			*/
			function GetListInfoFieldOfSupportJawon( $as_FieldName )
			{
				return $this->cls_SupportJawon->GetListInfoField( "ez_supportjawon", $as_FieldName );
			}

			/**
			* List ������ ���� �ʵ� ���� ��ȯ
			*
			* @return array
			*/
			function GetListInfoOfSupportJawon()
			{
				return $this->cls_SupportJawon->GetListInfo( "ez_supportjawon" );
			}

			/**
			* �Խù� ��ȸ
			*
			* @param string		$as_Condition			:	���� ���Ǻ�
			* @param string		$as_Orderby				:	���ļ���
			* @return recordset
			*/
			function GetSelectRecordsOfSupportJawon( $as_Condition="", $as_Orderby=" ORDER BY idx DESC " )
			{
				return $this->cls_SupportJawon->GetSelectRecords( "ez_supportjawon", $as_Condition, $as_Orderby );
			}

			/**
			* ���ڵ� ��������
			*
			* @param recordset	$ars_Source				:	������ ���� ���ڵ��
			* @param array		$arr_Fields				:	������ �������� �ʵ�迭
			* @return boolean
			*/
			function LoopForSupportJawon( $ars_Source, $arr_Fields=null )
			{
				return $this->cls_SupportJawon->Loop( "ez_supportjawon", $ars_Source, $arr_Fields );
			}

			/**
			* �ڿ����� ���п� ���� ����
			*
			* @param integer		$ai_PIdx				:	�ڿ����� �����ڵ�
			*/
			function SetCodeOfJawon( $ai_PIdx )
			{
				$this->cls_SupportJawon->PCode = $ai_PIdx;
			}

			/**
			* �ڿ����� �ڵ�Ȯ��
			*
			* @param integer		$ai_PIdx				:	�ڿ����� �����ڵ�
			* @return boolean
			*/
			function IsCodeOfJawon( $ai_PIdx )
			{
				return ($this->cls_SupportJawon->PCode == $ai_PIdx);
			}
		#endregion

		#region SupportJawon �Խù� ����¡ ���
			/**
			* ����¡ ó��
			*
			* @param boolean	$ab_pniView				:	����/������ ��ũ ��¿���
			* @param string		$as_peIcon				:	ó���� ��ũ ������
			* @param string		$as_pIcon				:	������ ��ũ ������
			* @param string		$as_nIcon				:	������ ��ũ ������
			* @param string		$as_neIcon				:	�������� ��ũ ������
			* @param string		$as_FileLink			:	��ũ�Ǵ� ��������
			* @param string		$as_IndexName			:	������ ��ȣ ������
			* @return string
			*/
			function PrintPageLinkOfSupportJawon( $ab_pniView='none', $as_peIcon='none', $as_pIcon='none', $as_nIcon='none', $as_neIcon='none', $as_FileLink='', $as_IndexName='' )
			{
				return $this->cls_Paging->PrintPageLink( $this->GetListInfoOfSupportJawon(), $ab_pniView, $as_peIcon, $as_pIcon, $as_nIcon, $as_neIcon, $as_FileLink, $as_IndexName );
			}
		#endregion

		#region SupportJawon Link ����
			/**
			* ����Ʈ ������ ��ũ ��ȯ
			*
			*/
			function GetPageLinkOfListSupportJawon()
			{
				return $this->GetPageLink("LIST")."?page=".$this->GetRequest( "page", 1, true )."&amp;search_option=".$this->GetRequest( "search_option", "", true )."&amp;keyword=".urlencode($this->GetRequest( "keyword", "", true ))."&amp;sort=".$this->GetRequest( "sort", "wdate", true )."&amp;dir=".$this->GetRequest( "dir", "DESC", true );
			}

			/**
			* �� ������ ��ũ ��ȯ
			*
			*/
			function GetPageLinkOfViewSupportJawon()
			{
				return $this->GetPageLink("VIEW")."?page=".$this->GetRequest( "page", 1, true )."&amp;search_option=".$this->GetRequest( "search_option", "", true )."&amp;keyword=".urlencode($this->GetRequest( "keyword", "", true ))."&amp;idx=".$this->cls_SupportJawon->GetData( "ez_supportjawon", "idx" );
			}

			/**
			* �ۼ� ������ ��ũ ��ȯ
			*
			*/
			function GetPageLinkOfWriteSupportJawon()
			{
				return $this->GetPageLink("WRITE")."?mode=insert";
			}

			/**
			* ���� ������ ��ũ ��ȯ
			*
			*/
			function GetPageLinkOfModifySupportJawon()
			{
				return $this->GetPageLink("EDIT")."?mode=update&amp;page=".$this->GetRequest( "page", 1, true )."&amp;search_option=".$this->GetRequest( "search_option", "", true )."&amp;keyword=".urlencode($this->GetRequest( "keyword", "", true ))."&amp;sort=".$this->GetRequest( "sort", "wdate", true )."&amp;dir=".$this->GetRequest( "dir", "DESC", true )."&amp;idx=".$this->cls_SupportJawon->GetData( "ez_supportjawon", "idx" );
			}
		#endregion
	}
}
?>