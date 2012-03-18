<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 클래스명	: SupportPage
	// 경로		: [www]/_include/class/
	// 코드		: ANSI
	// 설명		: 기본 페이지 출력 클래스
	// 작성자	: 최진원 (jw.choi@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090427
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
		var $cls_TelInfo	= null;	//전화번호 관리용 클래스
		var $cls_BankInfo	= null;	//은행정보 관리용 클래스
		var $cls_Support	= null;	//정기후원정보 관리용 클래스
		var $cls_Support2	= null;	//일시후원정보 관리용 클래스
		var $cls_Mailing	= null;	//메일링서비스 신청고객 관리용 클래스
		var $cls_SupportCompany= null;	//기업후원 신청정보 관리용 클래스
		var $cls_SupportJawon= null;	//자원봉사 관리용 클래스

		//클래스 생성자
		function SupportPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "support" );	//좌측메뉴클래스
		}

		#region 상속받은 메소드 보완
			/**
			* 데이터 초기화
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
			* DBA 셋팅
			*
			* @param class		$acls_DBA				:	DBA 클래스
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

		#region Support 영역 데이터 관리
			/**
			* 정기후원 정보 존재여부 체크
			*
			* @param string		$as_no			:	주민/사업자 등록번호
			* @param string		$as_case		:	개인/단체 구분
			* @return boolean
			*/
			function IsExistSupportInfo( $as_no, $as_case="개인" )
			{
				$rtn = false;

				switch( $as_case )
				{
					case "개인":	$rtn = $this->cls_Support->IsExistSupportInfoByResno( $as_no );	break;
					case "단체":	$rtn = $this->cls_Support->IsExistSupportInfoByComno( $as_no );	break;
				}

				return $rtn;
			}

			/**
			* 정기후원 정보 존재여부 확인 및 로딩
			*
			* @param integer	$ai_Idx			:	조회 기본 Key
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
			* 정기후원 정보 입력(추가)처리
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
			* 정기후원 기본정보 변경처리
			*
			* @param integer	$ai_Idx			:	조회 기본 Key
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
			* 정기후원 입금정보 변경처리
			*
			* @param integer	$ai_Idx			:	조회 기본 Key
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

		#region Support2 영역 데이터 관리
			/**
			* 정기후원 정보 존재여부 확인 및 로딩
			*
			* @param integer	$ai_Idx			:	조회 기본 Key
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
			* 정기후원 정보 입력(추가)처리
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

				$this->cls_Support2->SetData( "ez_support2", "motivation", "결제정보입력중" );	//진행중 구분처리

				return $this->cls_Support2->Insert( "ez_support2" );
			}

			/**
			* 정기후원 기본정보 변경처리
			*
			* @param integer	$ai_Idx			:	조회 기본 Key
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
			* 정기후원 입금정보 변경처리
			*
			* @param integer	$ai_Idx			:	조회 기본 Key
			* @return boolean
			*/
			function UpdateSupportInfoPayment2( $ai_Idx )
			{
				if( $this->LoadRecordOfSupportInfo2( $ai_Idx ) )
				{
					$this->cls_Support2->SetData( "ez_support2", "job", $this->GetRequest( "job", "" ) );				//처리코드
					$this->cls_Support2->SetData( "ez_support2", "motivation", $this->GetRequest( "motivation", "" ) );	//처리결과
					$this->cls_Support2->SetData( "ez_support2", "pay", $this->GetRequest( "pay", "" ) );				//기부금액
					$this->cls_Support2->SetData( "ez_support2", "condition", $this->GetRequest( "condition", "" ) );	//기부방식
					$this->cls_Support2->SetData( "ez_support2", "payername", $this->GetRequest( "payername", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "payerresno", $this->GetRequest( "payerresno", "" )."-".$this->GetRequest( "payerresno2", "" ) );
					$this->cls_Support2->SetData( "ez_support2", "comment", $this->GetRequest( "comment", "" ) );
					$this->cls_Support2->SetUsable( "ez_support2", "comment", ($this->cls_Support2->GetData( "ez_support2", "comment" )!="") );

					return $this->cls_Support2->Update( "ez_support2", "WHERE (idx='".$ai_Idx."')" );
				}

				return false;
			}

			/**
			* 정기후원 상태정보 변경처리
			*
			* @param integer	$ai_Idx			:	조회 기본 Key
			* @return boolean
			*/
			function UpdateSupportInfoStatus2( $ai_Idx, $res_cd, $res_msg, $tno )
			{
				if( $this->LoadRecordOfSupportInfo2( $ai_Idx ) )
				{
					$this->cls_Support2->SetData( "ez_support2", "job", $res_cd );			//처리코드
					$this->cls_Support2->SetData( "ez_support2", "motivation", $res_msg );	//처리결과
					$this->cls_Support2->SetData( "ez_support2", "religion", $tno );		// KCP 거래 고유 번호

					return $this->cls_Support2->Update( "ez_support2", "WHERE (idx='".$ai_Idx."')" );
				}

				return false;
			}
		#endregion

		#region SupportCompany 영역 데이터 관리
			/**
			* 기업후원 정보 입력(추가)처리
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

		#region SupportJawon 영역 데이터 관리
			/**
			* List 관리용 변수 설정
			*
			* @param string		$as_Condition			:	쿼리 조건부
			* @param string		$as_Orderby				:	정렬순서
			* @param integer	$ai_RecordCntPerPage	:	페이지당 레코드 수
			* @param integer	$ai_PageCntPerBlock		:	블럭당 페이지 수
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
			* List 관리용 변수 재계산
			*
			* @param string		$as_Orderby				:	정렬순서
			*/
			function ReSetListInfoOfSupportJawon( $as_Orderby="" )
			{
				$this->cls_SupportJawon->ReSetListInfo( "ez_supportjawon", $as_Orderby );
			}

			/**
			* List 관리용 변수 필드 셋팅
			*
			* @param string		$as_FieldName			:	필드명
			* @param string		$as_Data				:	데이터
			*/
			function SetListInfoFieldOfSupportJawon( $as_FieldName, $as_Data )
			{
				$this->cls_SupportJawon->SetListInfoField( "ez_supportjawon", $as_FieldName, $as_Data );
			}

			/**
			* List 관리용 변수 필드 설정값 획득
			*
			* @param string		$as_FieldName			:	필드명
			* @return string/integer
			*/
			function GetListInfoFieldOfSupportJawon( $as_FieldName )
			{
				return $this->cls_SupportJawon->GetListInfoField( "ez_supportjawon", $as_FieldName );
			}

			/**
			* List 관리용 변수 필드 설정 반환
			*
			* @return array
			*/
			function GetListInfoOfSupportJawon()
			{
				return $this->cls_SupportJawon->GetListInfo( "ez_supportjawon" );
			}

			/**
			* 게시물 조회
			*
			* @param string		$as_Condition			:	쿼리 조건부
			* @param string		$as_Orderby				:	정렬순서
			* @return recordset
			*/
			function GetSelectRecordsOfSupportJawon( $as_Condition="", $as_Orderby=" ORDER BY idx DESC " )
			{
				return $this->cls_SupportJawon->GetSelectRecords( "ez_supportjawon", $as_Condition, $as_Orderby );
			}

			/**
			* 레코드 루프적용
			*
			* @param recordset	$ars_Source				:	데이터 원본 레코드셋
			* @param array		$arr_Fields				:	데이터 셋팅적용 필드배열
			* @return boolean
			*/
			function LoopForSupportJawon( $ars_Source, $arr_Fields=null )
			{
				return $this->cls_SupportJawon->Loop( "ez_supportjawon", $ars_Source, $arr_Fields );
			}

			/**
			* 자원봉사 구분용 변수 설정
			*
			* @param integer		$ai_PIdx				:	자원봉사 구분코드
			*/
			function SetCodeOfJawon( $ai_PIdx )
			{
				$this->cls_SupportJawon->PCode = $ai_PIdx;
			}

			/**
			* 자원봉사 코드확인
			*
			* @param integer		$ai_PIdx				:	자원봉사 구분코드
			* @return boolean
			*/
			function IsCodeOfJawon( $ai_PIdx )
			{
				return ($this->cls_SupportJawon->PCode == $ai_PIdx);
			}
		#endregion

		#region SupportJawon 게시물 페이징 출력
			/**
			* 페이징 처리
			*
			* @param boolean	$ab_pniView				:	이전/다음블럭 링크 출력여부
			* @param string		$as_peIcon				:	처음블럭 링크 아이콘
			* @param string		$as_pIcon				:	이전블럭 링크 아이콘
			* @param string		$as_nIcon				:	다음블럭 링크 아이콘
			* @param string		$as_neIcon				:	마지막블럭 링크 아이콘
			* @param string		$as_FileLink			:	링크되는 페이지명
			* @param string		$as_IndexName			:	페이지 번호 변수명
			* @return string
			*/
			function PrintPageLinkOfSupportJawon( $ab_pniView='none', $as_peIcon='none', $as_pIcon='none', $as_nIcon='none', $as_neIcon='none', $as_FileLink='', $as_IndexName='' )
			{
				return $this->cls_Paging->PrintPageLink( $this->GetListInfoOfSupportJawon(), $ab_pniView, $as_peIcon, $as_pIcon, $as_nIcon, $as_neIcon, $as_FileLink, $as_IndexName );
			}
		#endregion

		#region SupportJawon Link 관리
			/**
			* 리스트 페이지 링크 반환
			*
			*/
			function GetPageLinkOfListSupportJawon()
			{
				return $this->GetPageLink("LIST")."?page=".$this->GetRequest( "page", 1, true )."&amp;search_option=".$this->GetRequest( "search_option", "", true )."&amp;keyword=".urlencode($this->GetRequest( "keyword", "", true ))."&amp;sort=".$this->GetRequest( "sort", "wdate", true )."&amp;dir=".$this->GetRequest( "dir", "DESC", true );
			}

			/**
			* 뷰 페이지 링크 반환
			*
			*/
			function GetPageLinkOfViewSupportJawon()
			{
				return $this->GetPageLink("VIEW")."?page=".$this->GetRequest( "page", 1, true )."&amp;search_option=".$this->GetRequest( "search_option", "", true )."&amp;keyword=".urlencode($this->GetRequest( "keyword", "", true ))."&amp;idx=".$this->cls_SupportJawon->GetData( "ez_supportjawon", "idx" );
			}

			/**
			* 작성 페이지 링크 반환
			*
			*/
			function GetPageLinkOfWriteSupportJawon()
			{
				return $this->GetPageLink("WRITE")."?mode=insert";
			}

			/**
			* 수정 페이지 링크 반환
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