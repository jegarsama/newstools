<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: view.php
	// ���		: [orchestra]/_include/elements/bbs/movie/
	// �ڵ�		: ANSI
	// ����		: BBS(movie) view ���
	// �ۼ���	: �輺ȣ (sh.kim@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090324
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}

global $gcls_Page;
?>
			<div id="view">
				<!--Movie View Table :STR -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="marT15">
					<tr>
						<td width="10" height="10"><img src="http://image.heart-heart.org/bg/www_photo01_LT.gif"></td>
						<td height="10" background="http://image.heart-heart.org/bg/www_photo01_CT.gif"></td>
						<td width="10"><img src="http://image.heart-heart.org/bg/www_photo01_RT.gif"></td>
					</tr>
					<tr>
						<td background="http://image.heart-heart.org/bg/www_photo01_LM.gif"></td>
						<td bgcolor="#F1F1F1"><!--Movie Content : STR -->
							<div style="background-image:url(http://image.heart-heart.org/bg/www_photo01_title.gif); height:30px" class="marB10"><img src="http://image.heart-heart.org/img/www_movie01_detailview.gif"></div>
							<div class="pd10" style="background-color:#FFFFFF">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="marB10">
							<tr>
								<td width="420" class="top left"><div class="movie01"><?=$gcls_Page->cls_EZ_BBSControl->GetMoveTagOfBBS( 410, 326 );?></div></td>
								<td width="225" class="top left line18px pdL10"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="marB10">
										<tr>
											<td class="pd5050 colOrange x14 b left"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "subject" )?></td>
										</tr>
										<tr>
											<td height="1" background="http://image.heart-heart.org/bg/www_line_dot11.gif"></td>
										</tr>
									</table>
										<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="marB10">
											<tr>
												<td width="10" height="18"><img src="http://image.heart-heart.org/icon/bullet01.gif" align="absmiddle"></td>
												<td width="50"  class="b">�����</td>
												<td width="10"><img src="http://image.heart-heart.org/img/vline_board.gif" align="absmiddle"></td>
												<td><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "wdate", "Y. m. d" )?></td>
											</tr>
											<tr>
												<td width="10" height="18"><img src="http://image.heart-heart.org/icon/bullet01.gif" align="absmiddle"></td>
												<td>�ۼ���</td>
												<td width="10"><img src="http://image.heart-heart.org/img/vline_board.gif" align="absmiddle"></td>
												<td><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "name" )?></td>
											</tr>
											<tr>
												<td width="10" height="18"><img src="http://image.heart-heart.org/icon/bullet01.gif" align="absmiddle"></td>
												<td>��ȸ��</td>
												<td width="10"><img src="http://image.heart-heart.org/img/vline_board.gif" align="absmiddle"></td>
												<td><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedNumber( "ez_bbs", "count", 0 )?></td>
											</tr>
										</table>
									</td>
							</tr>
						</table>
						<div>
						  <?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "content" )?>
						</div>
					</div>
							<!--Movie Content : END -->
						</td>
						<td background="http://image.heart-heart.org/bg/www_photo01_RM.gif"></td>
					</tr>
					<tr>
						<td height="10"><img src="http://image.heart-heart.org/bg/www_photo01_LB.gif"></td>
						<td background="http://image.heart-heart.org/bg/www_photo01_CB.gif"></td>
						<td><img src="http://image.heart-heart.org/bg/www_photo01_RB.gif"></td>
					</tr>
				</table>
				<!--Movie View Table :END -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="btnBar">
					<tr>
						<td class="right" ><a href="<?=$gcls_Page->GetPageLinkOfList()?>"><img src="http://image.heart-heart.org/btn/www_list.gif" align="absmiddle" alt="��Ϻ���" /></a></td>
					</tr>
				</table>
			</div>
