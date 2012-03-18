<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 클래스명	: ResearchPage
	// 경로		: [www]/_include/class/pages/
	// 코드		: ANSI
	// 설명		: 설문조사 관리 출력 클래스
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090824
#endregion

if( !class_exists("ResearchPage") )
{
	global $gcls_ClassCollection;

	$gcls_ClassCollection->LoadClassDefine( "/class/pages", "BasePage" );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "NT_Research", GDC_INC_ROOT );
	$gcls_ClassCollection->LoadClassDefine( "/class/data", "EZ_BBS", GDC_INC_ROOT );

	class ResearchPage extends BasePage
	{
		var $ResearchCode	= 0;			//설문조사 코드
		var $cls_NT_ResearchControl	= null;	//설문조사 관리용 클래스
		var $cls_EZ_BBSControl	= null;	//게시판 관리용 클래스

		//클래스 생성자
		function ResearchPage()
		{
			$this->InitField();
			$this->cls_LeftMenuArea = new LeftMenuArea( "research" );	//좌측메뉴클래스
		}

		#region 상속받은 메소드 보완
			/**
			* 데이터 초기화
			*
			*/
			function InitField()
			{
				parent::InitField();
				$this->cls_NT_ResearchControl = new NT_Research();
				$this->cls_EZ_BBSControl = new EZ_BBS();
			}

			/**
			* DBA 셋팅
			*
			* @param class		$acls_DBA				:	DBA 클래스
			*/
			function SetDBA( $acls_DBA )
			{
				parent::SetDBA( $acls_DBA );
				$this->cls_NT_ResearchControl->SetDBA( $acls_DBA );
				$this->cls_EZ_BBSControl->SetDBA( $acls_DBA );
			}
		#endregion

		#region Comment 영역 데이터 관리
			/**
			* 게시물 조회
			*
			* @param string		$as_Condition			:	쿼리 조건부
			* @param string		$as_Orderby				:	정렬순서
			* @return recordset
			*/
			function GetSelectRecordsOfComment( $as_Condition="", $as_Orderby=" ORDER BY idx DESC " )
			{
				return $this->cls_EZ_BBSControl->GetSelectRecords( "ez_comment", $this->cls_EZ_BBSControl->GetQueryWithCommentFilter( $as_Condition ), $as_Orderby );
			}

			/**
			* 레코드 루프적용
			*
			* @param recordset	$ars_Source				:	데이터 원본 레코드셋
			* @param array		$arr_Fields				:	데이터 셋팅적용 필드배열
			* @return boolean
			*/
			function LoopForComment( $ars_Source, $arr_Fields=null )
			{
				return $this->cls_EZ_BBSControl->Loop( "ez_comment", $ars_Source, $arr_Fields );
			}

			/**
			* 조회대상 게시물 존재여부 확인 및 로딩
			*
			* @param string		$as_Filter			:	조회 기본조건 설정
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
			* 보안코드 생성 및 세션등록처리
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
			* 보안코드 생성 및 세션등록처리
			*
			* @return string
			*/
			function GetSecureCodeOfAllow()
			{
				global $_SESSION;
				return $_SESSION["answer_session"];
			}

			/**
			* 보안코드 비교체크
			*
			* @param string		$as_Code		:	보안코드
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