<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: view.php
	// 경로		: [orchestra]/_include/elements/bbs/photo/
	// 코드		: ANSI
	// 설명		: BBS(photo) view 출력
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090324
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}

global $gcls_Page;
$gcls_Page->MatchAttach();	//첨부 이미지 로딩 적용
?>

			<div id="view">
				<!--Photo View Table :STR -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="10" height="10"><img src="http://image.heart-heart.org/bg/www_photo01_LT.gif"></td>
						<td height="10" background="http://image.heart-heart.org/bg/www_photo01_CT.gif"></td>
						<td width="10"><img src="http://image.heart-heart.org/bg/www_photo01_RT.gif"></td>
					</tr>
					<tr>
						<td background="http://image.heart-heart.org/bg/www_photo01_LM.gif"></td>
						<td bgcolor="#F1F1F1"><!--Photo Content : STR -->
							<div style="background-image:url(http://image.heart-heart.org/bg/www_photo01_title.gif); height:30px" class="marB10"><img src="http://image.heart-heart.org/title/www_photo01_detailview.gif"></div>
							<div class="pd10 marB20" style="background-color:#FFFFFF">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td class="top" width="370px"><div class="photo03" id="postMainImg"><?=$gcls_Page->GetThumbnailTagOfBBS( 'upfile', '', 350, 320 )?></div></td>
										<td width="315" class="top left line18px"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="marB10">
												<tr>
													<td class="pd5050 colOrange x14 b left"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "subject" )?></td>
												</tr>
												<tr>
													<td height="1" background="http://image.heart-heart.org/bg/www_line_dot11.gif"></td>
												</tr>
											</table>
											<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="marB10">
												<tr>
													<td width="10" height="18"><IMG src="http://image.heart-heart.org/icon/bullet01.gif" align="absmiddle"></td>
													<td width="50"  class="b">등록일</td>
													<td width="10"><IMG src="http://image.heart-heart.org/img/vline_board.gif" align="absmiddle"></td>
													<td><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "wdate", "Y. m. d" )?></td>
												</tr>
												<tr>
													<td width="10" height="18"><IMG src="http://image.heart-heart.org/icon/bullet01.gif" align="absmiddle"></td>
													<td>작성자</td>
													<td width="10"><IMG src="http://image.heart-heart.org/img/vline_board.gif" align="absmiddle"></td>
													<td><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "name" )?></td>
												</tr>
												<tr>
													<td width="10" height="18"><IMG src="http://image.heart-heart.org/icon/bullet01.gif" align="absmiddle"></td>
													<td>조회수</td>
													<td width="10"><IMG src="http://image.heart-heart.org/img/vline_board.gif" align="absmiddle"></td>
													<td><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedNumber( "ez_bbs", "count", 0 )?> 회</td>
												</tr>
											</table>
											<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "content" )?>

											<div id="postMainImgDesc"></div>

										</td>
									</tr>
								</table>
							</div>

							<div style="background-image:url(http://image.heart-heart.org/bg/www_photo01_title.gif); height:30px" class="marT10 marB10"><img src="http://image.heart-heart.org/title/www_photo01_anotherview.gif"></div>
							<div style="width:685px; height:160px; overflow-x:auto; overflow-y:hidden; scrollbar-face-color:#fdfdfd;">
								<table border="0" align="left" cellpadding="0" cellspacing="0" >
									<tr><?
										$lrs_loop	= $gcls_Page->GetSelectRecordsOfAttach( "(bbsidx='".$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "idx" )."')" );
										$li_LoopCnt = $gcls_Page->CountOfRows( $lrs_loop );
										$firstNodeId = 0;
										while( $gcls_Page->LoopForAttach( $lrs_loop ) )
										{
											$firstNodeId = empty($firstNodeId) ? $gcls_Page->cls_EZ_BBSControl->GetData( "ez_attach", 'idx' ) : $firstNodeId;
											?>
										<td class="mar10" style="width:136px">
											<a href="<?=$gcls_Page->GetPageLinkOfView();?>" onClick="return viewAttachPhoto('<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_attach", 'idx' );?>');" />
												<div class="photo01 marB5" style="cursor:pointer;"><?=$gcls_Page->GetThumbnailTagOfAttach( 'attachImg' );?></div>
												<div class="center marT10" style="width:130px; height:20px; overflow-x:hidden; overflow-y:hidden;" id="attachDesc<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_attach", 'idx' );?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_attach", "content", 45 );?></div>
											</a>
										</td><?
										}

										if( $li_LoopCnt <= 0 )
										{
											?>

											<td class="center middle">등록된 내용이 없습니다</td><?
										}
										?>
									</tr>
								</table>
							</div>
							<!--Photo Content : END -->
						</td>
						<td background="http://image.heart-heart.org/bg/www_photo01_RM.gif"></td>
					</tr>
					<tr>
						<td height="10"><img src="http://image.heart-heart.org/bg/www_photo01_LB.gif"></td>
						<td background="http://image.heart-heart.org/bg/www_photo01_CB.gif"></td>
						<td><img src="http://image.heart-heart.org/bg/www_photo01_RB.gif"></td>
					</tr>
				</table>
				<!--Photo View Table :END -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="btnBar">
					<tr>
						<td class="right" ><a href="<?=$gcls_Page->GetPageLinkOfList()?>"><img src="http://image.heart-heart.org/btn/www_list.gif" align="absmiddle" alt="목록보기" /></a></td>
					</tr>
				</table>
				<script type="text/javascript">
				//<![CDATA[
					function viewAttachPhoto( id )
					{
						var imgsrc = $('attachImg'+id).src;
						$('postMainImg').down('img').src = imgsrc.replace("thumbM_","");
						$('postMainImgDesc').innerHTML = $('attachDesc'+id).innerHTML;

						return false;
					}

					<?
					if( $firstNodeId )
					{
						echo "viewAttachPhoto( '" . $firstNodeId . "' );";
					}
					?>

				//]]>
				</script>
			</div>
