<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: top.php
	// ���		: [orchestra]/_include/elements/
	// �ڵ�		: ANSI
	// ����		: Top Elements ���
	// �ۼ���	: ������ (jw.choi@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090427
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
