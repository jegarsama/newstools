<?php#region License Statement	// Copyright (c) SeniorPartners. All rights reserved.	//	// 클래스명	: EZ_SupportJawon	// 경로		: [framework]/_include/class/data/	// 코드		: ANSI	// 설명		: 자원봉사 신청 커뮤니케이션 모듈 클래스	// 작성자	: 김성호 (sh.kim@yourstage.com)	// 소속명	: Development Team	// 수정일	: 20090527#endregionif( !class_exists("EZ_SupportJawon") ){	require_once "class.BaseModule.php";	class EZ_SupportJawon extends BaseModule	{		var $PCode = 0;	//자원봉사 구분코드		//클래스 생성자		function EZ_SupportJawon()		{			parent::BaseModule();			$this->InitField( "ez_supportjawon" );		//기업후원 신청정보			$this->InitListInfo( "ez_supportjawon" );	//기업후원 신청정보 List 관리용 변수 초기화		}		#region Base Statement			/**			* 데이터 초기화			*			* @param string		$as_TableName			:	테이블명			*/			function InitField( $as_TableName )			{				switch( $as_TableName )				{					case "ez_supportjawon":						$this->Fields[$as_TableName]	= Array(															'idx'	=> Array('ISFIELD'=>true, 'USED'=>false, 'TYPE'=>"VALUE", 'DATA'=>0),		//고유키															'pidx'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>0),		//부모글 고유키															'title'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),		//모집활동 제목															'content'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),	//상세내용															'series'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),	//봉사유형															'area'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),		//활동지역/단체명															'target'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>0),	//모집/봉사인원															'proposecnt'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>0),//지원건수															'edate'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),		//신청마감일															'memid'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),		//작성자 아이디															'name'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),		//담당자명															'cata'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),		//봉사자 유형															'tphone'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>"--"),	//전화(집)															'hphone'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>"--"),	//휴대폰															'email'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),		//이메일															'actdate'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),	//봉사활동 가능일자/시간															'ip'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>""),															'wdate'	=> Array('ISFIELD'=>true, 'USED'=>true, 'TYPE'=>"VALUE", 'DATA'=>"")															);						break;					default:						parent::InitField( $as_TableName );						break;				}			}			/**			* 레코드 삽입			*			* @param string		$as_TableName			:	테이블명			* @return boolean			*/			function Insert( $as_TableName )			{				switch( $as_TableName )				{					case "ez_supportjawon":	//특정필드 데이터 설정						$this->SetUsable( $as_TableName, 'idx', false );						if( $this->GetData( $as_TableName, 'wdate' )=='' )	$this->SetData( $as_TableName, "wdate", "now()", "METHOD" );						break;					default:						break;				}				return parent::Insert( $as_TableName );			}			/**			* 레코드 반영			*			* @param string		$as_TableName			:	테이블명			* @param string		$as_Condition			:	쿼리 조건부			* @return boolean			*/			function Update( $as_TableName, $as_Condition )			{				switch( $as_TableName )				{					case "ez_supportjawon":	//키값 및 기타 데이터 변경방지						$this->SetUsable( $as_TableName, 'idx', false );						$this->SetUsable( $as_TableName, 'wdate', false );						break;					default:						break;				}				return parent::Update( $as_TableName, $as_Condition );			}			/**			* 레코드 삭제			*			* @param string		$as_TableName			:	테이블명			* @param string		$as_Condition			:	쿼리 조건부			* @return boolean			*/			function Del( $as_TableName, $as_Condition )			{				return parent::Del( $as_TableName, $as_Condition );			}		#endregion		#region Base Statement			/**			* List 관리용 변수 필드 설정 반환			*			* @param string		$as_TableName		:	테이블명			* @param integer	$ai_Pidx			:	Pidx			* @return integer			*/			function UpdateProposecnt( $as_TableName, $ai_Pidx )			{				$ii_cnt = $this->GetRecordCounts( $as_TableName, " WHERE (pidx='".$ai_Pidx."') " );				$this->ExecQuery( " UPDATE ".$as_TableName." SET proposecnt='".$ii_cnt."' WHERE (idx='".$ai_Pidx."') " );				return $ii_cnt;			}		#endregion	}}?>