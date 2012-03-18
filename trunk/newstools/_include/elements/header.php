<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: header.php
	// 경로		: [www]/_include/elements/
	// 코드		: ANSI
	// 설명		: Header Elements 출력
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090503
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}
global $pageElement, $gcls_Page;
$pageElement['headerright']['login'] = ( $gcls_Page->AuthorizeMember() ? "<a href='http://www.heart-heart.org/mypage/login.php?mode=logout'><img src='http://image.heart-heart.org/btn/www_quick_logout.gif' alt='로그아웃'/></a>" : "<a href='http://www.heart-heart.org/mypage/login.php'><img src='http://image.heart-heart.org/btn/www_quick_login.gif' alt='로그인'/></a>" );
?>

	<div id="header">
		<table height="56px" border="0" align="center" cellpadding="0" cellspacing="0" class="positionLayer">
			<tr>
				<td ><a href="http://www.heart-heart.org/"><img src="http://image.heart-heart.org/img/www_logo.gif"></a><img src="http://image.heart-heart.org/img/www_20th.gif" hspace="20"></td>
				<td class="top"><table border="0" align="right" cellpadding="0" cellspacing="0">
						<tr>
							<td><a href="http://www.heart-heart.org/"><img src="http://image.heart-heart.org/btn/www_quick_home.gif"></a></td>
							<td><?=$pageElement['headerright']['login']?></td>
							<td><a href="http://www.heart-heart.org/mypage/join.php"><img src="http://image.heart-heart.org/btn/www_quick_join.gif"></a></td>
							<td><a href="http://www.heart-heart.org/mypage/"><img src="http://image.heart-heart.org/btn/www_quick_mypage.gif"></a></td>
							<td><a href="http://www.heart-heart.org/sitemap.php"><img src="http://image.heart-heart.org/btn/www_quick_sitemap.gif"></a></td>
							<td><a href="http://www.heart-heart.org/tool/pop_mail.php" onClick="return pop_mail();"><img src="http://image.heart-heart.org/btn/www_quick_contactus.gif"></a></td>
						</tr>
					</table></td>
			</tr>
		</table>
		<table width="100%" height="64px" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td background="http://image.heart-heart.org/bg/www_gnb_left.gif" >&nbsp;</td>
				<td width="1000px"><script type="text/javascript">AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','1000','height','64','title','gnb','src','/swf/www_gnb','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','/swf/www_gnb','pagenum','<?= $pageElement['headerswf']['pageNum']?>','subnum','<?= $pageElement['headerswf']['subNum']?>'); //end AC code</script>
					<noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="1000" height="64">
						<param name="movie" value="http://www.heart-heart.org/swf/www_gnb.swf">
						<param name="quality" value="high">
						<embed src="http://www.heart-heart.org/swf/www_gnb.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1000" height="64"></embed>
						</object></noscript></td>
				<td background="http://image.heart-heart.org/bg/www_gnb_right.gif" >&nbsp;</td>
			</tr>
		</table>
	</div>
