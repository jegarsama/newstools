<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: footer.php
	// 경로		: [www]/_include/elements/
	// 코드		: ANSI
	// 설명		: Footer Elements 출력
	// 작성자	: 김성호 (sh.kim@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090503
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}
global $pageElement;
?>

<div id="footer">
	<img src="http://image.heart-heart.org/img/www_footer.gif" width="1000" height="90" border="0" align="center" usemap="#footerMap">
	<map name="footerMap">
		<area shape="rect" coords="191,12,239,31" href="http://manager.heart-heart.org/" target="_blank" onFocus="this.blur()">
		<area shape="rect" coords="240,13,277,31" href="#" onFocus="this.blur()">
		<area shape="rect" coords="278,13,326,31" href="http://www.heart-heart.org/sitemap.php" onFocus="this.blur()">
		<area shape="rect" coords="328,13,383,30" href="http://www.heart-heart.org/tool/pop_mail.php" onClick="return pop_mail();" onFocus="this.blur()">
		<area shape="rect" coords="425,52,535,65" href="mailto:info@heart-heart.org" onFocus="this.blur()">
	</map>
</div>
