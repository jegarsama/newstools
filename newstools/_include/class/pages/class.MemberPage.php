<?php#region License Statement	// Copyright (c) SeniorPartners. All rights reserved.	//	// 클래스명	: MemberPage	// 경로		: [www]/_include/class/	// 코드		: ANSI	// 설명		: 고객정보 관리 페이지 출력 클래스	// 작성자	: 김성호 (sh.kim@yourstage.com)	// 소속명	: Development Team	// 수정일	: 20090501#endregionif( !class_exists("MemberPage") ){	global $gcls_ClassCollection;	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BasePage" );	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_Member", GDC_INC_ROOT );	$gcls_ClassCollection->LoadClassDefine( "/SMS", "TelInfo", GDC_SYSTEM_ROOT );	$gcls_ClassCollection->LoadClassDefine( "/data", "BankInfo", GDC_SYSTEM_ROOT );	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_Support", GDC_INC_ROOT );	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_Support_Manager", GDC_INC_ROOT );	$gcls_ClassCollection->LoadClassDefine( "/data", "Paging", GDC_SYSTEM_ROOT );	class MemberPage extends BasePage	{		var $cls_Member		= null;	//고객 관리용 클래스		var $cls_TelInfo	= null;	//전화번호 관리용 클래스		var $cls_BankInfo	= null;	//은행정보 관리용 클래스		var $cls_Support	= null;	//정기후원정보 관리용 클래스		var $cls_Support_Manager	= null;	//후원금 관리용 클래스		var $cls_Paging		= null;	//Paging 처리 클래스		//클래스 생성자		function MemberPage()		{			$this->InitField();			$this->cls_LeftMenuArea = new LeftMenuArea( "mypage2" );	//좌측메뉴클래스		}		#region 상속받은 메소드 보완			/**			* 데이터 초기화			*			*/			function InitField()			{				parent::InitField();				$this->cls_Member= new EZ_Member();				$this->cls_TelInfo = new TelInfo();				$this->cls_BankInfo = new BankInfo();				$this->cls_Support = new EZ_Support();				$this->cls_Support_Manager = new EZ_Support_Manager();				$this->cls_Paging = new Paging();			}			/**			* DBA 셋팅			*			* @param class		$acls_DBA				:	DBA 클래스			*/			function SetDBA( $acls_DBA )			{				parent::SetDBA( $acls_DBA );				$this->cls_Member->SetDBA( $acls_DBA );				$this->cls_Support->SetDBA( $acls_DBA );				$this->cls_Support_Manager->SetDBA( $acls_DBA );			}		#endregion		#region EZ_Member 영역			/**			* 로그아웃 설정처리			*			*/			function SetLogout()			{				$this->SetCookie( "ez_session[id]", "", time() - 3600, '/', "heart-heart.org" );				$this->SetCookie( "ez_session[name]", "", time() - 3600, '/', "heart-heart.org" );				$this->SetCookie( "ez_session[email]", "", time() - 3600, '/', "heart-heart.org" );				$this->SetCookie( "ez_session[level]", "", time() - 3600, '/', "heart-heart.org" );			}		#endregion		#region Support 영역 데이터 관리			/**			* 정기후원 정보 존재여부 체크			*			* @param string		$as_no			:	주민/사업자 등록번호			* @param string		$as_case		:	개인/단체 구분			* @return boolean			*/			function IsExistSupportInfo( $as_no, $as_case="개인" )			{				$rtn = false;				switch( $as_case )				{					case "개인":	$rtn = $this->cls_Support->IsExistSupportInfoByResno( $as_no );	break;					case "단체":	$rtn = $this->cls_Support->IsExistSupportInfoByComno( $as_no );	break;				}				return $rtn;			}			/**			* 정기후원 정보 존재여부 확인 및 로딩			*			* @param integer	$ai_Idx			:	조회 기본 Key			* @return boolean			*/			function LoadRecordOfSupportInfo( $ai_Idx )			{				if( 0 < $ai_Idx )				{					return $this->cls_Support->Load( "ez_support", " WHERE (idx='".$ai_Idx."') " );				}				return false;			}			/**			* 정기후원 정보 입력(추가)처리			*			* @return boolean			*/			function RegistSupportInfo()			{				$this->cls_Support->InitField( "ez_support" );				$this->cls_Support->SetData( "ez_support", "series", $this->GetRequest( "series", "" ) );				$this->cls_Support->SetData( "ez_support", "cata", $this->GetRequest( "cata", "" ) );				$this->cls_Support->SetData( "ez_support", "name", $this->GetRequest( "name", "" ) );				$this->cls_Support->SetData( "ez_support", "resno", $this->GetRequest( "resno", "" )."-".$this->GetRequest( "resno2", "" ) );				$this->cls_Support->SetData( "ez_support", "comno", $this->GetRequest( "comno", "" )."-".$this->GetRequest( "comno2", "" )."-".$this->GetRequest( "comno3", "" ) );				$this->cls_Support->SetData( "ez_support", "email", $this->GetRequest( "email", "" ) );				$this->cls_Support->SetData( "ez_support", "post1", $this->GetRequest( "post", "" )."-".$this->GetRequest( "post2", "" ) );				$this->cls_Support->SetData( "ez_support", "address11", $this->GetRequest( "address", "" ) );				$this->cls_Support->SetData( "ez_support", "address12", $this->GetRequest( "address2", "" ) );				$this->cls_Support->SetData( "ez_support", "hphone", $this->GetRequest( "hphone", "" )."-".$this->GetRequest( "hphone2", "" )."-".$this->GetRequest( "hphone3", "" ) );				$this->cls_Support->SetData( "ez_support", "resms", $this->GetRequest( "resms", "" ) );				$this->cls_Support->SetData( "ez_support", "tphone", $this->GetRequest( "tphone1_1", "" )."-".$this->GetRequest( "tphone1_2", "" )."-".$this->GetRequest( "tphone1_3", "" ) );				$this->cls_Support->SetData( "ez_support", "tphone2", $this->GetRequest( "tphone2_1", "" )."-".$this->GetRequest( "tphone2_2", "" )."-".$this->GetRequest( "tphone2_3", "" ) );				return $this->cls_Support->Insert( "ez_support" );			}			/**			* 정기후원 기본정보 변경처리			*			* @param integer	$ai_Idx			:	조회 기본 Key			* @return boolean			*/			function UpdateSupportInfoBasic( $ai_Idx )			{				if( $this->LoadRecordOfSupportInfo( $ai_Idx ) )				{					$this->cls_Support->SetData( "ez_support", "series", $this->GetRequest( "series", "" ) );					$this->cls_Support->SetData( "ez_support", "cata", $this->GetRequest( "cata", "" ) );					$this->cls_Support->SetData( "ez_support", "name", $this->GetRequest( "name", "" ) );					$this->cls_Support->SetData( "ez_support", "resno", $this->GetRequest( "resno", "" )."-".$this->GetRequest( "resno2", "" ) );					$this->cls_Support->SetData( "ez_support", "comno", $this->GetRequest( "comno", "" )."-".$this->GetRequest( "comno2", "" )."-".$this->GetRequest( "comno3", "" ) );					$this->cls_Support->SetData( "ez_support", "email", $this->GetRequest( "email", "" ) );					$this->cls_Support->SetData( "ez_support", "post1", $this->GetRequest( "post", "" )."-".$this->GetRequest( "post2", "" ) );					$this->cls_Support->SetData( "ez_support", "address11", $this->GetRequest( "address", "" ) );					$this->cls_Support->SetData( "ez_support", "address12", $this->GetRequest( "address2", "" ) );					$this->cls_Support->SetData( "ez_support", "hphone", $this->GetRequest( "hphone", "" )."-".$this->GetRequest( "hphone2", "" )."-".$this->GetRequest( "hphone3", "" ) );					$this->cls_Support->SetData( "ez_support", "resms", $this->GetRequest( "resms", "" ) );					$this->cls_Support->SetData( "ez_support", "tphone", $this->GetRequest( "tphone1_1", "" )."-".$this->GetRequest( "tphone1_2", "" )."-".$this->GetRequest( "tphone1_3", "" ) );					$this->cls_Support->SetData( "ez_support", "tphone2", $this->GetRequest( "tphone2_1", "" )."-".$this->GetRequest( "tphone2_2", "" )."-".$this->GetRequest( "tphone2_3", "" ) );					return $this->cls_Support->Update( "ez_support", "WHERE (idx='".$ai_Idx."')" );				}				return false;			}			/**			* 정기후원 입금정보 변경처리			*			* @param integer	$ai_Idx			:	조회 기본 Key			* @return boolean			*/			function UpdateSupportInfoPayment( $ai_Idx )			{				if( $this->LoadRecordOfSupportInfo( $ai_Idx ) )				{					$this->cls_Support->SetData( "ez_support", "cate", $this->GetRequest( "cate", "" ) );					$this->cls_Support->SetData( "ez_support", "bank", $this->GetRequest( "bank", "" ) );					$this->cls_Support->SetData( "ez_support", "smoney", $this->GetRequest( "smoney", "" ) );					$this->cls_Support->SetData( "ez_support", "account", $this->GetRequest( "account", "" ) );					$this->cls_Support->SetData( "ez_support", "payername", $this->GetRequest( "payername", "" ) );					$this->cls_Support->SetData( "ez_support", "payerresno", $this->GetRequest( "payerresno", "" )."-".$this->GetRequest( "payerresno2", "" ) );					$this->cls_Support->SetData( "ez_support", "cday", $this->GetRequest( "cday", "" ) );					$this->cls_Support->SetData( "ez_support", "comment", $this->GetRequest( "comment", "" ) );					$this->cls_Support->SetUsable( "ez_support", "comment", ($this->cls_Support->GetData( "ez_support", "comment" )!="") );					return $this->cls_Support->Update( "ez_support", "WHERE (idx='".$ai_Idx."')" );				}				return false;			}		#endregion		#region SupportManager 영역 데이터 관리			/**			* List 관리용 변수 설정			*			* @param string		$as_Condition			:	쿼리 조건부			* @param string		$as_Orderby				:	정렬순서			* @param integer	$ai_RecordCntPerPage	:	페이지당 레코드 수			* @param integer	$ai_PageCntPerBlock		:	블럭당 페이지 수			*/			function LoadListInfoOfSupportManager( $as_Condition="", $as_Orderby=" ORDER BY idx DESC ", $ai_RecordCntPerPage=20, $ai_PageCntPerBlock=5 )			{				$ii_page = $this->GetRequest( "page", 1, true );				$ii_page = ($ii_page < 1) ? 1 : $ii_page;				$this->SetListInfoFieldOfSupportManager( "page", $ii_page );				$this->SetListInfoFieldOfSupportManager( "RecordCntPerPage", $ai_RecordCntPerPage );				$this->SetListInfoFieldOfSupportManager( "PageCntPerBlock", $ai_PageCntPerBlock );				//$this->SetListInfoFieldOfSupportManager( "PageQuery", "" );				$this->SetListInfoFieldOfSupportManager( "SearchSet", "&search_option=".$this->GetRequest( "search_option", "", true )."&keyword=".urlencode($this->GetRequest( "keyword", "", true )) );				//$this->SetListInfoFieldOfSupportManager( "LinkOption", "" );				$is_SubSql = ($this->GetRequest( "search_option", "", true )=="") ? "" : (($this->GetRequest( "search_option", "", true )=="all") ? " AND (content like '%".$this->GetRequest( "keyword", "", true )."%')" : " AND (".$this->GetRequest( "search_option", "", true )." like '%".$this->GetRequest( "keyword", "", true )."%')");				$this->SetListInfoFieldOfSupportManager( "Addwhere", $as_Condition.$is_SubSql );				//$this->SetListInfoFieldOfSupportManager( "SpecialTop", 0 );				$this->ReSetListInfoOfSupportManager( $as_Orderby );			}			/**			* List 관리용 변수 재계산			*			* @param string		$as_Orderby				:	정렬순서			*/			function ReSetListInfoOfSupportManager( $as_Orderby="" )			{				$this->cls_Support_Manager->ReSetListInfo( "ez_support_manager", $as_Orderby );			}			/**			* List 관리용 변수 필드 셋팅			*			* @param string		$as_FieldName			:	필드명			* @param string		$as_Data				:	데이터			*/			function SetListInfoFieldOfSupportManager( $as_FieldName, $as_Data )			{				$this->cls_Support_Manager->SetListInfoField( "ez_support_manager", $as_FieldName, $as_Data );			}			/**			* List 관리용 변수 필드 설정값 획득			*			* @param string		$as_FieldName			:	필드명			* @return string/integer			*/			function GetListInfoFieldOfSupportManager( $as_FieldName )			{				return $this->cls_Support_Manager->GetListInfoField( "ez_support_manager", $as_FieldName );			}			/**			* List 관리용 변수 필드 설정 반환			*			* @return array			*/			function GetListInfoOfSupportManager()			{				return $this->cls_Support_Manager->GetListInfo( "ez_support_manager" );			}			/**			* 게시물 조회			*			* @param string		$as_Condition			:	쿼리 조건부			* @param string		$as_Orderby				:	정렬순서			* @return recordset			*/			function GetSelectRecordsOfSupportManager( $as_Condition="", $as_Orderby=" ORDER BY idx DESC " )			{				return $this->cls_Support_Manager->GetSelectRecords( "ez_support_manager", $as_Condition, $as_Orderby );			}			/**			* 레코드 루프적용			*			* @param recordset	$ars_Source				:	데이터 원본 레코드셋			* @param array		$arr_Fields				:	데이터 셋팅적용 필드배열			* @return boolean			*/			function LoopForSupportManager( $ars_Source, $arr_Fields=null )			{				return $this->cls_Support_Manager->Loop( "ez_support_manager", $ars_Source, $arr_Fields );			}		#endregion		#region SupportManager 게시물 페이징 출력			/**			* 페이징 처리			*			* @param boolean	$ab_pniView				:	이전/다음블럭 링크 출력여부			* @param string		$as_peIcon				:	처음블럭 링크 아이콘			* @param string		$as_pIcon				:	이전블럭 링크 아이콘			* @param string		$as_nIcon				:	다음블럭 링크 아이콘			* @param string		$as_neIcon				:	마지막블럭 링크 아이콘			* @param string		$as_FileLink			:	링크되는 페이지명			* @param string		$as_IndexName			:	페이지 번호 변수명			* @return string			*/			function PrintPageLinkOfSupportManager( $ab_pniView='none', $as_peIcon="<img src=\"http://image.heart-heart.org/btn/www_first.gif\" alt=\"처음으로\" />", $as_pIcon="<img src=\"http://image.heart-heart.org/btn/www_prev.gif\" alt=\"이전 블럭\" />", $as_nIcon="<img src=\"http://image.heart-heart.org/btn/www_next.gif\" alt=\"다음 블럭\" />", $as_neIcon="<img src=\"http://image.heart-heart.org/btn/www_last.gif\" alt=\"마지막으로\" />", $as_FileLink='', $as_IndexName='' )			{				return $this->cls_Paging->PrintPageLink( $this->GetListInfoOfSupportManager(), $ab_pniView, $as_peIcon, $as_pIcon, $as_nIcon, $as_neIcon, $as_FileLink, $as_IndexName );			}		#endregion	}}?>