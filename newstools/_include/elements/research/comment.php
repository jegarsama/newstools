<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: comment.php
	// 경로		: [www]/_include/elements/research/
	// 코드		: ANSI
	// 설명		: Research comment 출력
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090825
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}

global $gcls_Page;

#region DB처리
	$writer		= $gcls_Page->GetMemberInfoByCookie( 'name' );
	$content	= "";
	if( 'comment'==$gcls_Page->GetRequest( "mode", "" ) )
	{
		$writer		= $gcls_Page->GetRequest( "name", "" );
		$content	= $gcls_Page->GetRequest( "content", "" );

		//인증처리
		if( !$gcls_Page->IsSecureCodeAllow( $gcls_Page->GetRequest( "sec", "" ) ) )
		{
			echo Message::Alert( "보안코드가 일치하지 않습니다." );
		}
		else
		{
			$gcls_Page->cls_EZ_BBSControl->SetData( "ez_comment", "bbsidx", $gcls_Page->GetRequest( "idx", "" ) );
			$gcls_Page->cls_EZ_BBSControl->SetData( "ez_comment", "prdcode", $gcls_Page->cls_EZ_BBSControl->BBSCode );
			$gcls_Page->cls_EZ_BBSControl->SetData( "ez_comment", "id", $gcls_Page->GetMemberInfoByCookie( 'id' ) );
			$gcls_Page->cls_EZ_BBSControl->SetData( "ez_comment", "name", $gcls_Page->GetRequest( "name", "" ) );
			$gcls_Page->cls_EZ_BBSControl->SetData( "ez_comment", "content", $gcls_Page->GetRequest( "content", "" ) );
			$gcls_Page->cls_EZ_BBSControl->SetData( "ez_comment", "passwd", $gcls_Page->GetRequest( "passwd", "" ) );
			$gcls_Page->cls_EZ_BBSControl->SetData( "ez_comment", "wip", $gcls_Page->SERVER['REMOTE_ADDR'] );

			if( $gcls_Page->cls_EZ_BBSControl->Insert( "ez_comment" ) )
			{
				$content	= "";
				echo Message::Alert( "댓글을 등록하였습니다." );
			}
			else
			{
				echo Message::Alert( "등록시 에러가 발생하였습니다." );
			}
		}
	}
	else if( 'delco'==$gcls_Page->GetRequest( "mode", "" ) )
	{
		//인증처리
		if( !$gcls_Page->IsSecureCodeAllow( $gcls_Page->GetRequest( "authcode", "" ) ) )
		{
			echo Message::Alert( "보안코드가 일치하지 않습니다." );
		}
		else
		{
			if( $gcls_Page->LoadRecordOfComment( "passwd = '".$gcls_Page->GetRequest( "passwd", "" )."'" ) )
			{
				if( $gcls_Page->cls_EZ_BBSControl->Del( "ez_comment", "(idx='".$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )."')" ) )
				{
					echo Message::Alert( "댓글이 삭제되었습니다." );
				}
				else
				{
					echo Message::Alert( "댓글 삭제시 에러가 발생하였습니다." );
				}
			}
			else
			{
				echo Message::Alert( "비밀번호가 일치하지 않거나, 해당 댓글이 존재하지 않습니다." );
			}
		}
	}
#endregion
?>
		<table width="938" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="3"><img src="http://www.heart-heart.org/love/images/paper_top.gif"/></td>
			</tr>
			<tr>
				<td width="34" valign="top"><img src="http://www.heart-heart.org/love/images/paper_left.gif" width="34" height="562" /></td>
				<td valign="top"  height="562">
					<!-- STR : 댓글 등록부 -->
					<form name="commentForm" action="<?=$gcls_Page->SERVER['PHP_SELF']?>" method="post" onSubmit="return commentCheck(this);" style="margin:0px">
					<input type="hidden" name="mode" value="comment">
					<input type="hidden" name="idx" value="<?=$gcls_Page->ResearchCode?>">
					<input type="hidden" name="page" value="<?=$gcls_Page->GetRequest( "page", 1, true )?>">
					<table width="855" border="0" align="center" cellpadding="0" cellspacing="0" class="marB10">
						<tr>
							<td height="30" valign="top"><img src="http://www.heart-heart.org/love/images/message.gif" width="138" height="21" /></td>
							<td></td>
						</tr>
						<tr>
							<td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
									<tr>
										<td width="200"><b><img src="/image/icon/www_bullet01.gif">작성자 : </b>
										<input type="text" name="name" value="<?=$writer?>" onClick="memberCheck();" size="15" /></td>
										<td><b><img src="/image/icon/www_bullet01.gif">비밀번호 : </b>
										<input type="password" name="passwd" onClick="memberCheck();" size="15" /></td>
									</tr>
								</table></td>
							<td rowspan="2" valign="bottom"><input type="image" src="http://www.heart-heart.org/love/images/btn_register.gif" alt="등록하기" onClick="return memberCheck();" /></td>
						</tr>
						<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><?
											$gcls_Page->GetSecureCode(); //보안코드 생성
											?><input type="hidden" name="sec" value="<?= $gcls_Page->GetSecureCodeOfAllow()?>" />
											<textarea name="content" cols="118" style="height:34px" onClick="memberCheck();"><?=$content?></textarea></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</form>
					<script type="text/javascript">
					//<![CDATA[
						function memberCheck()
						{
							<?
							if( !$gcls_Page->AuthorizeMember() )
							{
								//echo "alert( '로그인하셔야 작성이 가능합니다.' ); return false;";
								echo "return true;";
							}
							else
							{
								echo "return true;";
							}
							?>

						}

						function commentCheck( frm )
						{
							if( memberCheck() && chkForm( frm ) )
							{
								return true;
							}

							return false;
						}

						function initInput()
						{
							$('commentForm').name.setAttribute("required", "1");
							$('commentForm').name.setAttribute("hname", "작성자를 입력하세요.");

							$('commentForm').passwd.setAttribute("required", "1");
							$('commentForm').passwd.setAttribute("hname", "비밀번호를 입력하세요.");

							$('commentForm').content.setAttribute("required", "1");
							$('commentForm').content.setAttribute("hname", "내용을 입력하세요.");
						}

						addWindowLoadEvent(initInput);
					//]]>
					</script>
					<!-- END : 댓글 등록부분 -->

					<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="2">
								<!-- STR : 댓글 목록 -->
								<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px #E4E4E4 solid;border-bottom:1px #E4E4E4 solid;"><?

									$gcls_Page->LoadListInfoOfComment( "(bbsidx='".$gcls_Page->ResearchCode."')", " ORDER BY idx DESC ", 10, 5 );
									$lrs_loop	= $gcls_Page->GetSelectRecordsOfComment( $gcls_Page->GetListInfoFieldOfComment( "Addwhere" ), $gcls_Page->GetListInfoFieldOfComment( "Orderby" ) );
									$li_LoopCnt	= $gcls_Page->CountOfRows( $lrs_loop );
									$no = $gcls_Page->GetListInfoFieldOfComment( "TopNumber" );
									while( $gcls_Page->LoopForComment( $lrs_loop ) )
									{
										?>

									<tr>
										<td class="pd10" style="border-bottom:dotted #dedede 0.2em;">
											<div  style="height:20px;">
												<div class="fl">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="80" class="b colOrange"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "name" )?></td>
															<td class="pdR30">
															<span>
																<?=$gcls_Page->cls_EZ_BBSControl->GetDataByReplace( "ez_comment", "content", "\n", "&nbsp;" );?>
																</span>
																<span>
																<?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_comment", "wdate", "Y. m. d" )?>
																</span>
																<span id='co_<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )?>' style="margin:0px; padding:0px; display:none;">
																<form action="<?=$gcls_Page->SERVER['PHP_SELF']?>" method="post" style="display:inline;">
																	<input type="hidden" name="mode" value="delco">
																	<input type="hidden" name="authcode" value="<?=$gcls_Page->GetSecureCodeOfAllow();?>">
																	<input type="hidden" name="idx" value="<?=$gcls_Page->ResearchCode?>">
																	<input type="hidden" name="cmtidx" value="<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )?>">
																	<input type="hidden" name="page" value="<?=$gcls_Page->GetRequest( "page", 1, true )?>">
																	비밀번호 :
																	<input type="password" name="passwd" size="10" />
																	<input type="image" src="/image/btn/re_del_confirm.gif" title="삭제" />
																</form>
																</span> <img src="http://image.heart-heart.org/btn/re_del.gif" alt="삭제하기" hspace="10" border="0" align="absmiddle" style="cursor:pointer;" onClick="$('co_<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )?>').toggle();" /></td>
														</tr>
													</table>
												</div>

											</div>
										</td>
									</tr><?
									}

									if( $li_LoopCnt <= 0 )
									{
										?>

									<tr>
										<td class="pdT10 pdB10 center">등록된 댓글이 없습니다</td>
									</tr><?
									}
									?>

								</table>
								<!-- END : 댓글 목록 -->


							</td>
						</tr>
					</table>
					<div><!--// 게시물 하단 번호링크(시작) //-->
								<?= $gcls_Page->PrintPageLinkOfComment( true, '<img src="http://image.heart-heart.org/btn/prev10.gif" alt="처음으로" />', '<img src="http://image.heart-heart.org/btn/prev.gif" alt="이전 블럭" / hspace="2" >', '<img src="http://image.heart-heart.org/btn/next.gif" alt="다음 블럭" / hspace="2">', '<img src="http://image.heart-heart.org/btn/next10.gif" alt="마지막으로" />' );?>
								<!--// 게시물 하단 번호링크(종료) //--></div>
				</td>
				<td width="50" valign="top"><img src="http://www.heart-heart.org/love/images/paper_right.gif" width="50" height="562" /></td>
			</tr>
			<tr>
				<td colspan="3" valign="top"><img src="http://www.heart-heart.org/love/images/paper_bottom.gif" width="938" height="67" /></td>
			</tr>
			<tr>
				<td height="90" colspan="3"><img src="http://www.heart-heart.org/love/images/with.gif" width="937" height="48" /></td>
			</tr>
		</table>