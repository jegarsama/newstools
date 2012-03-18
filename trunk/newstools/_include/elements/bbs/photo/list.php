<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: list.php
	// ���		: [orchestra]/_include/elements/bbs/photo/
	// �ڵ�		: ANSI
	// ����		: BBS(photo) list ���
	// �ۼ���	: �輺ȣ (sh.kim@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090323
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
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="http://image.heart-heart.org/img/www_title_photolist.gif" vspace="5"></td>
					</tr>
					<tr>
						<td height="2" bgcolor="#669900"></td>
					</tr>
				</table>
				<table  border="0" cellspacing="0" cellpadding="0"><?
					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, "", " ORDER BY prino DESC " );
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfBBS();
					$li_LoopCnt+= $gcls_Page->CountOfRows( $lrs_loop );
					$no = 0;
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
						$gcls_Page->MatchAttach();	//÷�� �̹��� �ε� ����

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
						<td class="photo01_td_ac">
							<div class="photo01"><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->GetThumbnailTagOfBBS()?></a></div>
							<div class="b marT10 center" style="width:120px"><a href="<?=$gcls_Page->GetPageLinkOfView();?>"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByKStrCut( "ez_bbs", "subject", 45 );?></a></div>
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
						<td class="pdT10 pdB10 center">��ϵ� ������ �����ϴ�</td>
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
