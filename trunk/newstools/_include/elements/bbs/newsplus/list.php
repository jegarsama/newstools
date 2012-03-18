<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: list.php
	// 경로		: [orchestra]/_include/elements/bbs/normal/
	// 코드		: ANSI
	// 설명		: BBS(normal) list 출력
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090323
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
						<td width="10" height="10"><img src="http://image.heart-heart.org/bg/www_annual01_LT.gif" width="10" height="10"></td>
						<td background="http://image.heart-heart.org/bg/www_annual01_CT.gif"></td>
						<td width="10"><img src="http://image.heart-heart.org/bg/www_annual01_RT.gif" alt="" width="10" height="10"></td>
					</tr>
					<tr>
						<td background="http://image.heart-heart.org/bg/www_annual01_LM.gif"></td>
						<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><?
										$gcls_Page->cls_EZ_BBSControl->Load( "ez_bbsinfo", "(code='".$gcls_Page->cls_EZ_BBSControl->BBSCode."')" );
										$ls_Grp = $gcls_Page->GetRequest( "grp", "", true );
										$bbs_info_grp = $gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbsinfo", "grp" );
										$catlist = explode(",",$bbs_info_grp);
										?>
										<select name="grp" onChange="if(this.value!=''){location.href='<?=$gcls_Page->GetPageLink( "LIST" )?>?grp='+this.value;}"><?
											for($ii=0;$ii<count($catlist);$ii++)
											{
												$ls_Grp = (empty($ls_Grp) ? $catlist[$ii] : $ls_Grp);
												$selected = ($ls_Grp == $catlist[$ii]) ? " selected" : "";
												?>
											<option value="<?=urlencode($catlist[$ii])?>"<?=$selected?>><?=$catlist[$ii]?></option><?
											}
												?>

										</select></td>
									<td class="right"><a href="AdbeRdr810_ko_KR.msi" target="_blank"><img src="http://image.heart-heart.org/btn/www_install_pdf.gif"></a></td>
								</tr>
							</table>
						</td>
						<td background="http://image.heart-heart.org/bg/www_annual01_RM.gif"></td>
					</tr>
					<tr>
						<td height="10"><img src="http://image.heart-heart.org/bg/www_annual01_LB.gif" width="10" height="10"></td>
						<td background="http://image.heart-heart.org/bg/www_annual01_CB.gif"></td>
						<td><img src="http://image.heart-heart.org/bg/www_annual01_RB.gif" alt="" width="10" height="10"></td>
					</tr>
				</table>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="marT10"><?
					$ls_Grp = empty($ls_Grp) ? "" : "(grp='".$ls_Grp."')";
					$gcls_Page->LoadListInfoOfBBS( $gcls_Page->cls_EZ_BBSControl->BBSCode, $ls_Grp, " ORDER BY prino DESC " );
					$lrs_loop	= $gcls_Page->cls_EZ_BBSControl->GetSelectRecords( "ez_bbs", $gcls_Page->GetListInfoFieldOfBBS( "Addwhere" ), " ORDER BY prino DESC " );
					$li_LoopCnt+= $gcls_Page->CountOfRows( $lrs_loop );
					$no = 0;
					while( $gcls_Page->LoopForBBS( $lrs_loop ) )
					{
						$no++;
						if( $no%2 == 0 )
						{
							$ls_SeperatorTop = "\n";
							$ls_SeperatorBottom = "</tr>";
						}
						else if( $no%2 == 1 )
						{
							$ls_SeperatorTop = "<tr>\n";
							$ls_SeperatorBottom = "						<td width=\"15\">&nbsp;</td>";
						}
						?>

					<?=$ls_SeperatorTop?>
						<td>
							<table width="345" border="0" cellspacing="0" cellpadding="0" class="marB10">
								<tr>
									<td width="10" height="10"><img src="http://image.heart-heart.org/bg/www_annual02_LT.gif" width="10" height="10"></td>
									<td background="http://image.heart-heart.org/bg/www_annual02_CT.gif"></td>
									<td width="10"><img src="http://image.heart-heart.org/bg/www_annual02_RT.gif" alt="" width="10" height="10"></td>
								</tr>
								<tr>
									<td background="http://image.heart-heart.org/bg/www_annual02_LM.gif"></td>
									<td><table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="140" rowspan="2" class="pdR10 top"><?=$gcls_Page->GetThumbnailTagOfBBS( 'upfile' )?></td>
												<td><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "subject" );?></td>
											</tr>
											<tr>
												<td height="40" class="bottom"><?=$gcls_Page->GetSelectedAttachDownloadTagOfBBS( 'upfile2', '<img src="http://image.heart-heart.org/btn/www_down_pdf.gif" />', '<img src="http://image.heart-heart.org/btn/www_down_none.gif" />' )?></td>
											</tr>
										</table></td>
									<td background="http://image.heart-heart.org/bg/www_annual02_RM.gif"></td>
								</tr>
								<tr>
									<td height="10"><img src="http://image.heart-heart.org/bg/www_annual02_LB.gif" width="10" height="10"></td>
									<td background="http://image.heart-heart.org/bg/www_annual02_CB.gif"></td>
									<td><img src="http://image.heart-heart.org/bg/www_annual02_RB.gif" alt="" width="10" height="10"></td>
								</tr>
							</table>
						</td>
					<?=$ls_SeperatorBottom?><?
					}

					$no = 2 - ($no%2);
					if( $no%2 > 0 )
					{
						for($i=1; $i<=$no; $i++)
						{
							echo "<td>&nbsp;</td>";
						}
						echo "</tr>";
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

				<!--// 검색 영역(시작) //-->
				<form id="listSearchForm" method="get" onSubmit="return chkForm(this);">
				<table width="705" border="0" cellspacing="0" cellpadding="0" class="marT10" id="">
					<tr>
						<td>&nbsp;</td>
						<td width="445"><select name="search_option">
								<option value="all"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "all") ? " selected" : "";?>>전체</option>
								<option value="subject"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "subject") ? " selected" : "";?>>제목</option>
								<option value="content"<?=($gcls_Page->GetRequest( "search_option", "", true ) == "content") ? " selected" : "";?>>내용</option>
							</select>
							<input name="keyword" type="text" size="40" style="width:300px" value="<?=$gcls_Page->GetRequest( "keyword", "", true )?>" />
							<input type="image" src="http://image.heart-heart.org/btn/www_board_search.gif" align="absmiddle" alt="검색" />
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				</form>
				<!--// 검색 영역(종료) //-->
			</div>
