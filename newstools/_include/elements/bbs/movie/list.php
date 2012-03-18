<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: list.php
	// ���		: [orchestra]/_include/elements/bbs/normal/
	// �ڵ�		: ANSI
	// ����		: BBS(normal) list ���
	// �ۼ���	: �輺ȣ (sh.kim@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090323
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}

global $pageElement, $gcls_Page;
$gcls_Page->SetListInfoFieldOfBBS( "LinkOption", "class=\"marR2 marL2\"" );
?>

			<div id="view">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" background="http://image.heart-heart.org/bg/www_tab01_bg.gif" class="marB10">
					<tr>
						<td width="110"><a href="<?=$gcls_Page->GetCategoryLink( "ȫ������" );?>"><?=$pageElement['contenttab']['tab01']?></a></td>
						<td width="110"><a href="<?=$gcls_Page->GetCategoryLink( "ķ����" );?>"><?=$pageElement['contenttab']['tab02']?></a></td>
						<td width="110"><a href="<?=$gcls_Page->GetCategoryLink( "��Ÿ" );?>"><?=$pageElement['contenttab']['tab03']?></a></td>
						<td class="right"><img src="http://image.heart-heart.org/bg/www_tab01_last.gif" width="10" height="32"></td>
					</tr>
				</table>
					<!--Photo View Table :STR -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="marB15">
			<tr>
				<td width="10" height="10"><img src="http://image.heart-heart.org/bg/www_photo01_LT.gif"></td>
				<td height="10" background="http://image.heart-heart.org/bg/www_photo01_CT.gif"></td>
				<td width="10"><img src="http://image.heart-heart.org/bg/www_photo01_RT.gif"></td>
			</tr>
			<tr>
				<td background="http://image.heart-heart.org/bg/www_photo01_LM.gif"></td>
				<td bgcolor="#F1F1F1"><!--Photo Content : STR -->
					<div style="background-image:url(http://image.heart-heart.org/bg/www_photo01_title.gif); height:30px" class="marB10"><img src="http://image.heart-heart.org/img/www_movie01_detailview.gif"></div>
					<div class="pd10" style="background-color:#FFFFFF">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="marB10">
							<tr>
								<td width="420" rowspan="2" class="top left"><div class="movie01"><?=$gcls_Page->cls_EZ_BBSControl->GetMoveTagOfBBS( 410, 326 );?></div></td>
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
										</table>									</td>
							</tr>
							<tr>
								<td class="bottom left"><a href="#" onClick="Effect.ScrollTo('bbsList'); return false;" onFocus="this.blur()"><img src="http://image.heart-heart.org/btn/www_movielist.gif" alt="��Ϻ���" /></a></td>
							</tr>
						</table>
						<div>
						  <?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "content" )?>
						</div>
					</div>
				<!--Photo Content : END -->				</td>
				<td background="http://image.heart-heart.org/bg/www_photo01_RM.gif"></td>
			</tr>
			<tr>
				<td height="10"><img src="http://image.heart-heart.org/bg/www_photo01_LB.gif"></td>
				<td background="http://image.heart-heart.org/bg/www_photo01_CB.gif"></td>
				<td><img src="http://image.heart-heart.org/bg/www_photo01_RB.gif"></td>
			</tr>
		</table>
		<!--Photo View Table :END -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="bbsList">
					<tr>
						<td><img src="http://image.heart-heart.org/img/www_title_movielist.gif" vspace="5"></td>
					</tr>
					<tr>
						<td height="2" bgcolor="#669900"></td>
					</tr>
				</table>

				<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="photo01_table"><?
					$ls_Grp = empty($pageElement['contentgrp']) ? "" : "(grp='".$pageElement['contentgrp']."')";

					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, $ls_Grp, " ORDER BY prino DESC " );
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfBBS();
					$li_LoopCnt+= $gcls_Page->CountOfRows( $lrs_loop );
					$no = 0;
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
						$no++;
						if( $no%4 == 0 )
						{
							$ls_SeperatorTop = "\n";
							$ls_SeperatorBottom = "</tr>";
						}
						else if( $no%4 == 1 )
						{
							$ls_SeperatorTop = "<tr>\n";
							$ls_SeperatorBottom = "	<td width=\"50\" class=\"photo01_td_al\"></td>";
						}
						else
						{
							$ls_SeperatorTop = "\n";
							$ls_SeperatorBottom = "	<td width=\"50\" class=\"photo01_td_al\"></td>";
						}
					?>

					<?=$ls_SeperatorTop?>
						<td class="photo01_td_ac"><div class="photo04"><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->GetThumbnailTagOfBBS( 'upfile3', 'thumbF_' )?></a></div>
							<div class="b marT10"><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_bbs", "subject", 36 );?></a></div>
							<div class="date marT5"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_bbs", "wdate", "Y. m. d" )?> | ��ȸ�� <?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedNumber( "ez_bbs", "count", 0 )?></div></td>
					<?=$ls_SeperatorBottom?><?
					}

					$no = 4 - ($no%4);
					if( $no%4 > 0 )
					{
						for($i=1; $i<=$no; $i++)
						{
							echo "<td class=\"photo01_td_ac\">&nbsp;</td>";
							if( $i != $no ) echo "<td width=\"50\" class=\"photo01_td_al\"></td>";
						}
						echo "</tr>";
					}

					if( $li_LoopCnt <= 0 )
					{
						?>

					<tr>
						<td class="center middle pdT10 pdB10">��ϵ� ������ �����ϴ�</td>
					</tr><?
					}
					?>

				</table>

				<!--// �Խù� �ϴ� ��ȣ��ũ(����) //-->
				<?=$gcls_Page->PrintPageLinkOfBBS( true );?>
				<!--// �Խù� �ϴ� ��ȣ��ũ(����) //-->

				<!--// �˻� ����(����) //-->
				<form id="listSearchForm" method="get" onSubmit="return chkForm(this);">
				<table width="705" border="0" cellspacing="0" cellpadding="0" class="marT10" id="">
					<tr>
						<td>&nbsp;</td>
						<td width="445"><select name="search_option">
								<option value="all"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "all") ? " selected" : "";?>>��ü</option>
								<option value="subject"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "subject") ? " selected" : "";?>>����</option>
								<option value="content"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "content") ? " selected" : "";?>>����</option>
							</select>
							<input name="keyword" type="text" size="40" style="width:300px" value="<?=$gcls_Page->GetRequest( "keyword", "", true )?>" />
							<input type="image" src="http://image.heart-heart.org/btn/www_board_search.gif" align="absmiddle" alt="�˻�" />
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				</form>
				<!--// �˻� ����(����) //-->
			</div>
