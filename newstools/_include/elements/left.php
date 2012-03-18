<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: left.php
	// ���		: [www]/_include/elements/
	// �ڵ�		: ANSI
	// ����		: Left Elements ���
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
<div id="left">
	<table width="170" border="0" cellspacing="0" cellpadding="0">
		<?
		$is_rtn = "";
		while( list($i_key, $i_val) = each($pageElement['leftmenu']) )
		{
			switch( $i_val['TYPE'] )
			{
				case "DESC":
					$is_rtn.="<tr><td><img src=\"".$i_val['IMG']."\" alt=\"".$i_val['ALT']."\" /></td></tr>";
					break;

				case "MENU":
					$is_rtn.="<tr><td><a href=\"".$i_val['LINK']."\"".$i_val['OPTION']."><img src=\"".$i_val['IMG']."\" alt=\"".$i_val['ALT']."\" /></a></td></tr>";
					break;

				default:
					break;
			}
		}
		echo $is_rtn;
		?>

		<tr>
			<td height="37"><img src="http://image.heart-heart.org/menu/www_intro_bottom.gif"></td>
		</tr>
	</table>
</div>
