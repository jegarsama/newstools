<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: list.php
	// 경로		: [www]/_include/elements/bbs/event/
	// 코드		: ANSI
	// 설명		: BBS(event) list 출력
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090503
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}

global $gcls_Page;
$gcls_Page->SetListInfoFieldOfBBS( "LinkOption", "class=\"marR2 marL2\"" );

$ls_Status = $gcls_Page->GetRequest( "status", "ing", true );
switch( $ls_Status )
{
	case "old":
		$ls_SubQuery = " AND (edate < now())";
		break;

	default:
		$ls_Status = "ing";
		$ls_SubQuery = " AND (now() between sdate AND edate)";
		break;
}
?>
			<div id="view">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class=" marB5">
					<tr>
						<td width="10" height="10"><img src="http://image.heart-heart.org/bg/www_annual01_LT.gif" width="10" height="10"></td>
						<td background="http://image.heart-heart.org/bg/www_annual01_CT.gif"></td>
						<td width="10"><img src="http://image.heart-heart.org/bg/www_annual01_RT.gif" alt="" width="10" height="10"></td>
					</tr>
					<tr>
						<td background="http://image.heart-heart.org/bg/www_annual01_LM.gif"></td>
						<td><select name="status" onChange="if(this.value!=''){location.href='<?=$gcls_Page->GetPageLink( "LIST" )?>?status='+this.value;}">
							<option value="ing"<?if($ls_Status=="ing") echo " selected";?>>진행중인 캠페인/이벤트</option>
							<option value="old"<?if($ls_Status=="old") echo " selected";?>>지난 캠페인/이벤트</option>
						</select></td>
						<td background="http://image.heart-heart.org/bg/www_annual01_RM.gif"></td>
					</tr>
					<tr>
						<td height="10"><img src="http://image.heart-heart.org/bg/www_annual01_LB.gif" width="10" height="10"></td>
						<td background="http://image.heart-heart.org/bg/www_annual01_CB.gif"></td>
						<td><img src="http://image.heart-heart.org/bg/www_annual01_RB.gif" alt="" width="10" height="10"></td>
					</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0"style=" border-bottom:1px #CCCCCC solid"><?

					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, "(code in ('a_campaign','t_campaign')) AND (notice='Y')".$ls_SubQuery, " ORDER BY prino DESC " );
					$gcls_Page->SetListInfoFieldOfBBS( "PageQuery", "&status=".$ls_Status );
					//$gcls_Page->SetListInfoFieldOfBBS( "RecordCntPerPage", 5 );
					$gcls_Page->SetListInfoFieldOfBBS( "Addwhere", "(code in ('a_campaign','t_campaign')) AND (notice='Y')".$ls_SubQuery );
					$gcls_Page->ReSetListInfoOfBBS( " ORDER BY prino DESC " );
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfBBS();
					$li_LoopCnt	= $gcls_Page->CountOfRows( $lrs_loop );
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
						?>

					<tr>
						<td width="140px" class="line_td pdT10 pdB10 center"><div class="photo01 marR10"><?=$gcls_Page->GetThumbnailTagOfBBS()?></div></td>
						<td class="line_td pdT10 pdB10 top">
							<div class="title"><a href="<?=$gcls_Page->GetPageLinkOfView();?>&amp;status=<?=$ls_Status?>"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "subject" );?></a></div>
							<div><a href="<?=$gcls_Page->GetPageLinkOfView();?>&amp;status=<?=$ls_Status?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_bbs", "playprogram", 280 );?></a></div>
							<div class="marT5 b date"><img src="http://image.heart-heart.org/icon/www_bullet01.gif">기간 :
								<span class="colOrange">
									<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "sdate", "Y.m.d" );?>
									~
									<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "edate", "Y.m.d" );?>
									</span>							</div>
							<table border="0" cellspacing="0" cellpadding="0" height="6"><tr><td></td></tr></table>

						</td>
					</tr><?
					}

					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, "(code in ('a_campaign','t_campaign')) AND (notice<>'Y')".$ls_SubQuery, " ORDER BY prino DESC " );
					$gcls_Page->SetListInfoFieldOfBBS( "PageQuery", "&status=".$ls_Status );
					//$gcls_Page->SetListInfoFieldOfBBS( "RecordCntPerPage", 5 );
					$gcls_Page->SetListInfoFieldOfBBS( "Addwhere", "(code in ('a_campaign','t_campaign')) AND (notice<>'Y')".$ls_SubQuery );
					$gcls_Page->ReSetListInfoOfBBS( " ORDER BY prino DESC " );
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfBBS();
					$li_LoopCnt+= $gcls_Page->CountOfRows( $lrs_loop );
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
					?>

					<tr>
						<td width="140px" class="line_td pdT10 pdB10 center"><div class="photo01 marR10"><?=$gcls_Page->GetThumbnailTagOfBBS()?></div></td>
						<td class="line_td pdT10 pdB10 top">
							<div class="title"><a href="<?=$gcls_Page->GetPageLinkOfView();?>&amp;status=<?=$ls_Status?>"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "subject" );?></a></div>
							<div><a href="<?=$gcls_Page->GetPageLinkOfView();?>&amp;status=<?=$ls_Status?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_bbs", "playprogram", 280 );?></a></div>
							<div class="marT5 b date"><img src="http://image.heart-heart.org/icon/www_bullet01.gif">기간 :
								<span class="colOrange">
									<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "sdate", "Y.m.d" );?>
									~
									<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "edate", "Y.m.d" );?>
									</span>                            </div>
							<table border="0" cellspacing="0" cellpadding="0" height="6"><tr><td></td></tr></table>

						</td>
					</tr><?
					}

					if( $li_LoopCnt <= 0 )
					{
						?>

					<tr>
						<td class="pdT10 pdB10 center">등록된 내용이 없습니다</td>
					</tr><?
					}
					?>

				</table>

				<!--// 게시물 하단 번호링크(시작) //-->
				<?=$gcls_Page->PrintPageLinkOfBBS( true );?>
				<!--// 게시물 하단 번호링크(종료) //-->

				<!--// 검색 영역(시작) //-->
				<form id="listSearchForm" method="get" onSubmit="return chkForm(this);">
				<table width="705" border="0" cellspacing="0" cellpadding="0" class="marT10" id="">
					<tr>
						<td><select name="search_option">
								<option value="all"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "all") ? " selected" : "";?>>전체</option>
								<option value="subject"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "subject") ? " selected" : "";?>>제목</option>
								<option value="content"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "content") ? " selected" : "";?>>내용</option>
							</select>
							<input name="keyword" type="text" size="40" style="width:150px" value="<?=$gcls_Page->GetRequest( "keyword", "", true )?>" />
							<input type="image" src="http://image.heart-heart.org/btn/www_board_search.gif" align="absmiddle" alt="검색" />						</td>
					</tr>
				</table>
				</form>
				<!--// 검색 영역(종료) //-->
			</div>
