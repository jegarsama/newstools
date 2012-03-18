<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: comment.php
	// 경로		: [www]/_include/elements/bbs/event/
	// 코드		: ANSI
	// 설명		: BBS(event) comment 출력
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090503
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
			<div class="marT15 marB5 b" ><img src="http://image.heart-heart.org/icon/bullet03.gif">&nbsp;댓글달기</div>
			<div class="marB10 pd10" style="border:1px #CCCCCC solid; background-color:#f7f6f6">
				<form name="commentForm" action="<?=$gcls_Page->SERVER['PHP_SELF']?>" method="post" onSubmit="return commentCheck(this);">
				<input type="hidden" name="mode" value="comment">
				<input type="hidden" name="idx" value="<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "idx" )?>">
				<input type="hidden" name="page" value="<?=$gcls_Page->GetRequest( "page", 1, true )?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" height="24px">
					<tr>
						<td width="300">작성자 :
						<input type="text" name="name" value="<?=$writer?>" onClick="memberCheck();" size="15" /></td>
						<td width="400">비밀번호 :
						<input type="password" name="passwd" onClick="memberCheck();" size="15" /></td>
					</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0"  height="24px">
					<tr>
						<td>보안단어 :
						<?=$gcls_Page->GetSecureCode();?>&nbsp;&nbsp;왼쪽의 숫자 중 빨간글만 입력하세요.
						<input type="text" name="sec" style="width:100px" onClick="memberCheck();" /></td>
					</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="50">내용 : </td>
						<td width="200"><textarea name="content" cols="80" rows="3" onClick="memberCheck();"><?=$content?></textarea></td>
						<td class="pdL5 "><input type="image" src="http://image.heart-heart.org/btn/reply.gif" alt="댓글달기" onClick="return memberCheck();" /></td>
					</tr>
				</table>
				</form>
			</div>

			<div class="marT10">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:2px #E4E4E4 solid;border-bottom:1px #E4E4E4 solid;"><?
					$lrs_loop	= $gcls_Page->GetSelectRecordsOfComment( "(bbsidx='".$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "idx" )."')" );
					$li_LoopCnt = $gcls_Page->CountOfRows( $lrs_loop );
					while( $gcls_Page->LoopForComment( $lrs_loop ) )
					{
						?>

					<tr>
						<td class="pd10" style="border-bottom:dotted #dedede 0.2em;">
							<div class="marB5" style="height:20px;">
								<div class="fl"><span class="b marT10"><?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "name" )?></span><span class="marL30 date"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByFormattedDayTime( "ez_comment", "wdate", "Y. m. d" )?></span></div>
								<div class="fr">
									<span id='co_<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )?>' style="margin:0px; padding:0px; display:none;">
										<form action="<?=$gcls_Page->SERVER['PHP_SELF']?>" method="post" style="display:inline;">
										<input type="hidden" name="mode" value="delco">
										<input type="hidden" name="authcode" value="<?=$gcls_Page->GetSecureCodeOfAllow();?>">
										<input type="hidden" name="idx" value="<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_bbs", "idx" )?>">
										<input type="hidden" name="cmtidx" value="<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )?>">
										<input type="hidden" name="page" value="<?=$gcls_Page->GetRequest( "page", 1, true )?>">
										비밀번호 : <input type="password" name="passwd" size="10" /> <input type="submit" value="삭제" class="input" />
										</form>
									</span>
									<img src="http://image.heart-heart.org/btn/re_del.gif" alt="삭제하기" hspace="10" border="0" align="absmiddle" style="cursor:pointer;" onClick="$('co_<?=$gcls_Page->cls_EZ_BBSControl->GetData( "ez_comment", "idx" )?>').toggle();" />
								</div>
							</div>
							<div style="clear:both;"><?=$gcls_Page->cls_EZ_BBSControl->GetDataByReplace( "ez_comment", "content", "\n", "<br />" );?></div>
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
			</div>
