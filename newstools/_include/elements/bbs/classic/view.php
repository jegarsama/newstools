<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: view.php
	// ���		: [orchestra]/_include/elements/bbs/classic/
	// �ڵ�		: ANSI
	// ����		: BBS(classic) view ���
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
				<!--Title Table:STR -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="10" height="10"><img src="http://image.heart-heart.org/bg/www_board01_LT.gif" width="10" height="10"></td>
						<td background="../image/bg/www_board01_CT.gif"></td>
						<td width="10"><img src="http://image.heart-heart.org/bg/www_board01_RT.gif" alt="" width="10" height="10"></td>
					</tr>
					<tr>
						<td background="../image/bg/www_board01_LM.gif"></td>
						<td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mar5">
								<tr>
									<td width="41" ><img src="http://image.heart-heart.org/img/www_board01_th_title.gif" align="absmiddle" class="pdB5"></td>
									<td colspan="5" class="pdB5"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "subject" )?></td>
									<td width="40"><img src="http://image.heart-heart.org/img/www_board01_th_writer.gif" height="11" align="absmiddle" class="pdB5">&nbsp;</td>
									<td width="150" class="pdB5"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "name" )?></td>
								</tr>
								<tr>
									<td height="1px" colspan="8"class="line_dot11"></td>
								</tr>
								<tr>
									<td class="pdT5"><img src="http://image.heart-heart.org/img/www_board01_th_date.gif"></td>
									<td width="149" class="pdT5"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "wdate", "Y. m. d" )?></td>
									<td width="40" class="pdT5"><img src="http://image.heart-heart.org/img/www_board01_th_inquiry.gif"></td>
									<td width="100" class="pdT5"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedNumber( "ez_bbs", "count", 0 )?></td>
									<td width="70" class="pdT5"><img src="http://image.heart-heart.org/img/www_board01_th_file.gif"></td>
									<td colspan="3" class="pdT5"><?=$gcls_Page->GetAttachDownloadTagOfBBS();?></td>
								</tr>
							</table></td>
						<td background="../image/bg/www_board01_RM.gif"></td>
					</tr>
					<tr>
						<td height="10"><img src="http://image.heart-heart.org/bg/www_board01_LB.gif" width="10" height="10"></td>
						<td background="../image/bg/www_board01_CB.gif"></td>
						<td><img src="http://image.heart-heart.org/bg/www_board01_RB.gif" alt="" width="10" height="10"></td>
					</tr>
				</table>
				<!--Title Table:END -->

				<table  border="0" cellspacing="0" cellpadding="0" class="board01_table">
					<tr>
						<td class="pd10 line20px board01_td_al"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "content" )?></td>
					</tr>
				</table>
				<table width="705" border="0" cellspacing="0" cellpadding="0" class="marT10" id="btnBar">
					<tr>
						<td class="right" ><a href="<?=$gcls_Page->GetPageLinkOfList()?>"><img src="http://image.heart-heart.org/btn/www_list.gif" align="absmiddle" alt="�۸��" /></a></td>
					</tr>
				</table>
			</div>
