<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: comment.php
	// ���		: [www]/_include/elements/research/
	// �ڵ�		: ANSI
	// ����		: Research comment ���
	// �ۼ���	: �輺ȣ (sh.kim@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090825
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}

global $gcls_Page;

#region DBó��
	$writer		= $gcls_Page->GetMemberInfoByCookie( 'name' );
	$content	= "";
	if( 'comment'==$gcls_Page->GetRequest( "mode", "" ) )
	{
		$writer		= $gcls_Page->GetRequest( "name", "" );
		$content	= $gcls_Page->GetRequest( "content", "" );

		//����ó��
		if( !$gcls_Page->IsSecureCodeAllow( $gcls_Page->GetRequest( "sec", "" ) ) )
		{
			echo Message::Alert( "�����ڵ尡 ��ġ���� �ʽ��ϴ�." );
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
				echo Message::Alert( "����� ����Ͽ����ϴ�." );
			}
			else
			{
				echo Message::Alert( "��Ͻ� ������ �߻��Ͽ����ϴ�." );
			}
		}
	}
	else if( 'delco'==$gcls_Page->GetRequest( "mode", "" ) )
	{
		//����ó��
		if( !$gcls_Page->IsSecureCodeAllow( $gcls_Page->GetRequest( "authcode", "" ) ) )
		{
			echo Message::Alert( "�����ڵ尡 ��ġ���� �ʽ��ϴ�." );
		}
		else
		{
			if( $gcls_Page->LoadRecordOfComment( "passwd = '".$gcls_Page->GetRequest( "passwd", "" )."'" ) )
			{
				if( $gcls_Page->cls_EZ_BBSControl->Del( "ez_comment", "(idx='".$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )."')" ) )
				{
					echo Message::Alert( "����� �����Ǿ����ϴ�." );
				}
				else
				{
					echo Message::Alert( "��� ������ ������ �߻��Ͽ����ϴ�." );
				}
			}
			else
			{
				echo Message::Alert( "��й�ȣ�� ��ġ���� �ʰų�, �ش� ����� �������� �ʽ��ϴ�." );
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
					<!-- STR : ��� ��Ϻ� -->
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
										<td width="200"><b><img src="/image/icon/www_bullet01.gif">�ۼ��� : </b>
										<input type="text" name="name" value="<?=$writer?>" onClick="memberCheck();" size="15" /></td>
										<td><b><img src="/image/icon/www_bullet01.gif">��й�ȣ : </b>
										<input type="password" name="passwd" onClick="memberCheck();" size="15" /></td>
									</tr>
								</table></td>
							<td rowspan="2" valign="bottom"><input type="image" src="http://www.heart-heart.org/love/images/btn_register.gif" alt="����ϱ�" onClick="return memberCheck();" /></td>
						</tr>
						<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><?
											$gcls_Page->GetSecureCode(); //�����ڵ� ����
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
								//echo "alert( '�α����ϼž� �ۼ��� �����մϴ�.' ); return false;";
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
							$('commentForm').name.setAttribute("hname", "�ۼ��ڸ� �Է��ϼ���.");

							$('commentForm').passwd.setAttribute("required", "1");
							$('commentForm').passwd.setAttribute("hname", "��й�ȣ�� �Է��ϼ���.");

							$('commentForm').content.setAttribute("required", "1");
							$('commentForm').content.setAttribute("hname", "������ �Է��ϼ���.");
						}

						addWindowLoadEvent(initInput);
					//]]>
					</script>
					<!-- END : ��� ��Ϻκ� -->

					<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="2">
								<!-- STR : ��� ��� -->
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
																	��й�ȣ :
																	<input type="password" name="passwd" size="10" />
																	<input type="image" src="/image/btn/re_del_confirm.gif" title="����" />
																</form>
																</span> <img src="http://image.heart-heart.org/btn/re_del.gif" alt="�����ϱ�" hspace="10" border="0" align="absmiddle" style="cursor:pointer;" onClick="$('co_<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )?>').toggle();" /></td>
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
										<td class="pdT10 pdB10 center">��ϵ� ����� �����ϴ�</td>
									</tr><?
									}
									?>

								</table>
								<!-- END : ��� ��� -->


							</td>
						</tr>
					</table>
					<div><!--// �Խù� �ϴ� ��ȣ��ũ(����) //-->
								<?= $gcls_Page->PrintPageLinkOfComment( true, '<img src="http://image.heart-heart.org/btn/prev10.gif" alt="ó������" />', '<img src="http://image.heart-heart.org/btn/prev.gif" alt="���� ��" / hspace="2" >', '<img src="http://image.heart-heart.org/btn/next.gif" alt="���� ��" / hspace="2">', '<img src="http://image.heart-heart.org/btn/next10.gif" alt="����������" />' );?>
								<!--// �Խù� �ϴ� ��ȣ��ũ(����) //--></div>
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