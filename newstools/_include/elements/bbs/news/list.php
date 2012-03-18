<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: list.php
	// 경로		: [www]/_include/elements/bbs/news/
	// 코드		: ANSI
	// 설명		: BBS(news) list 출력
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090504
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}

global $gcls_Page;
$gcls_Page->SetListInfoFieldOfBBS( "LinkOption", "class=\"marR2 marL2\"" );
?>
			<div id="view">
				<table width="100%" border="0" cellspacing="0" cellpadding="0"style=" border-bottom:1px #CCCCCC solid"><?
					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, "(code in ('heart_speech','hwo_speech')) AND (notice='Y')" );
					$gcls_Page->SetListInfoFieldOfBBS( "Addwhere", "(code in ('heart_speech','hwo_speech')) AND (notice='Y')" );
					$gcls_Page->ReSetListInfoOfBBS( " ORDER BY wdate DESC, idx DESC " );
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfBBS();
					$li_LoopCnt	= $gcls_Page->CountOfRows( $lrs_loop );
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
						?>

					<tr>
						<td colspan="2" height="10px"></td>
					</tr>
					<tr>
						<td width="140px" class="top left"><div class="photo01 marR10"><?=$gcls_Page->GetThumbnailTagOfBBS()?></div></td>
						<td class="pdT3 pdB5 top left">
							<div class="title marB5"><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "subject" );?></a></div>
							<div><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_bbs", "content", 280 );?></a></div>
							<table border="0" cellspacing="0" cellpadding="0" height="6"><tr><td></td></tr></table>
							<div class="date marT3"><img src="http://image.heart-heart.org/icon/www_bullet01.gif">등록일 :&nbsp;<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "wdate", "Y. m. d" )?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="http://image.heart-heart.org/icon/www_bullet01.gif">조회수 :&nbsp;<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedNumber( "ez_bbs", "count", 0 )?></div>
						</td>
					</tr>
					<tr>
						<td colspan="2" height="10px"></td>
					</tr>
					<tr>
						<td colspan="2" class="line_dot" height="1px"></td>
					</tr><?
					}

					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, "(code in ('heart_speech','hwo_speech')) AND (notice<>'Y')", " ORDER BY prino DESC " );
					$gcls_Page->SetListInfoFieldOfBBS( "Addwhere", "(code in ('heart_speech','hwo_speech')) AND (notice<>'Y')" );
					$gcls_Page->ReSetListInfoOfBBS( " ORDER BY wdate DESC, idx DESC " );
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfBBS();
					$li_LoopCnt+= $gcls_Page->CountOfRows( $lrs_loop );
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
					?>

					<tr>
						<td colspan="2" height="10px"></td>
					</tr>
					<tr>
						<td width="140px" class="top left"><div class="photo01 marR10"><?=$gcls_Page->GetThumbnailTagOfBBS()?></div></td>
						<td class="pdT3 pdB5 top left">
							<div class="title marB5"><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "subject" );?></a></div>
							<div><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_bbs", "content", 280 );?></a></div>
							<table border="0" cellspacing="0" cellpadding="0" height="6"><tr><td></td></tr></table>
							<div class="date marT3"><img src="http://image.heart-heart.org/icon/www_bullet01.gif">등록일 :&nbsp;<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "wdate", "Y. m. d" )?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="http://image.heart-heart.org/icon/www_bullet01.gif">조회수 :&nbsp;<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedNumber( "ez_bbs", "count", 0 )?></div>
						</td>
					</tr>
					<tr>
						<td colspan="2" height="10px"></td>
					</tr>
					<tr>
						<td colspan="2" class="line_dot" height="1px"></td>
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
				<?= $gcls_Page->PrintPageLinkOfBBS( true);?>
				<!--// 게시물 하단 번호링크(종료) //-->

				<!--// 검색 영역(시작) //-->
				<form id="listSearchForm" method="get" onSubmit="return chkForm(this);">
				<table width="705" border="0" cellspacing="0" cellpadding="0" class="marT10" id="">
					<tr>
						<td width="445"><select name="search_option">
								<option value="all"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "all") ? " selected" : "";?>>전체</option>
								<option value="subject"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "subject") ? " selected" : "";?>>제목</option>
								<option value="content"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "content") ? " selected" : "";?>>내용</option>
							</select>
							<input name="keyword" type="text" size="40" style="width:150px" value="<?=$gcls_Page->GetRequest( "keyword", "", true )?>" />
							<input type="image" src="http://image.heart-heart.org/btn/www_board_search.gif" align="absmiddle" alt="검색" />
						</td>
						<td width="260" class="right">&nbsp;</td>
					</tr>
				</table>
				</form>
				<!--// 검색 영역(종료) //-->
			</div>