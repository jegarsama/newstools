<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: top.php
	// 경로		: [orchestra]/_include/elements/
	// 코드		: ANSI
	// 설명		: Top Elements 출력
	// 작성자	: 최진원 (jw.choi@yourstage.com)
	// 소속명	: Development Team
	// 수정일	: 20090427
#endregion




if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}
global $pageElement;
?>

<div id="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="<?= $pageElement['topdesc']['titleimg']?>" alt="<?= $pageElement['topdesc']['titlealt']?>" /></td>
			<td class="right x11"><img src="http://image.heart-heart.org/icon/www_home_navi.gif" align="absmiddle"><?=$pageElement['topnavi'];?></td>
		</tr>
	</table>
</div>
