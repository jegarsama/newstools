<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: list.php
	// ���		: [orchestra]/_include/elements/bbs/classic/
	// �ڵ�		: ANSI
	// ����		: BBS(classic) list ���
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
$gcls_Page->SetListInfoFieldOfBBS( "LinkOption", "class=\"marR2 marL2\"" );
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
						<td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mar5050">
								<tr>
									<td width="70" align="center">&nbsp;<img src="http://image.heart-heart.org/img/www_board01_th_num.gif" align="absmiddle"></td>
									<td width="480" align="center"><img src="http://image.heart-heart.org/img/www_board01_th_title.gif" align="absmiddle"></td>
									<td width="95" align="center"><img src="http://image.heart-heart.org/img/www_board01_th_date.gif" align="absmiddle">&nbsp;</td>
									<td width="60" align="center"><img src="http://image.heart-heart.org/img/www_board01_th_inquiry.gif" align="absmiddle">&nbsp;&nbsp;</td>
								</tr>
							</table>
						</td>
						<td background="../image/bg/www_board01_RM.gif"></td>
					</tr>
					<tr>
						<td height="10"><img src="http://image.heart-heart.org/bg/www_board01_LB.gif" width="10" height="10"></td>
						<td background="../image/bg/www_board01_CB.gif"></td>
						<td><img src="http://image.heart-heart.org/bg/www_board01_RB.gif" alt="" width="10" height="10"></td>
					</tr>
				</table>
				<!--Title Table:END -->

				<table width="100%" border="0" cellspacing="0" cellpadding="0"><?
					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, "(notice='Y')" );
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfBBS();
					$li_LoopCnt	= $gcls_Page->CountOfRows( $lrs_loop );
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
						?>

					<tr>
						<td width="65" class="board01_td_ac">[����]</td>
						<td width="450" class="board01_td_al"><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_bbs", "subject", 200 );?></a></td>
						<td width="85" class="board01_td_ac"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "wdate", "Y. m. d" )?></td>
						<td width="55" class="board01_td_ac"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedNumber( "ez_bbs", "count", 0 )?></td>
					</tr><?
					}

					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, "(notice<>'Y')", " ORDER BY prino DESC " );
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfBBS();
					$li_LoopCnt+= $gcls_Page->CountOfRows( $lrs_loop );
					$no = $gcls_Page->GetListInfoFieldOfBBS( "TopNumber" );
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
					?>
					<tr>
						<td width="65" class="board01_td_ac"><?=$no?></td>
						<td width="450" class="board01_td_al"><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_bbs", "subject", 200 );?></a></td>
						<td width="85" class="board01_td_ac"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "wdate", "Y. m. d" )?></td>
						<td width="55" class="board01_td_ac"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedNumber( "ez_bbs", "count", 0 )?></td>
					</tr><?
						$no--;
					}

					if( $li_LoopCnt <= 0 )
					{
						?>

					<tr>
						<td colspan="4" class="pdT10 pdB10 center">��ϵ� ������ �����ϴ�</td>
					</tr><?
					}
					?>

				</table>

				<!--// �Խù� �ϴ� ��ȣ��ũ(����) //-->
				<?= $gcls_Page->PrintPageLinkOfBBS( true);?>
				<!--// �Խù� �ϴ� ��ȣ��ũ(����) //-->

				<!--// �˻� ����(����) //-->
				<form id="listSearchForm" method="get" onSubmit="return chkForm(this);">
				<table width="705" border="0" cellspacing="0" cellpadding="0" class="marT10" id="">
					<tr>
						<td width="575"><select name="search_option">
								<option value="all"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "all") ? " selected" : "";?>>��ü</option>
								<option value="subject"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "subject") ? " selected" : "";?>>����</option>
								<option value="content"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "content") ? " selected" : "";?>>����</option>
							</select>
							<input name="keyword" type="text" size="40" style="width:150px" value="<?=$gcls_Page->GetRequest( "keyword", "", true )?>" />
							<input type="image" src="http://image.heart-heart.org/btn/www_board_search.gif" align="absmiddle" alt="�˻�" />
						</td>
						<td width="130" class="right">
						<a href="<?=$gcls_Page->GetPageLinkOfList()?>"><img src="http://image.heart-heart.org/btn/www_list.gif" align="absmiddle" alt="��Ϻ���" />
						</td>
					</tr>
				</table>
				</form>
				<!--// �˻� ����(����) //-->

			</div>
