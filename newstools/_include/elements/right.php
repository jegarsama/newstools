<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// ���ϸ�	: right.php
	// ���		: [www]/_include/elements/
	// �ڵ�		: ANSI
	// ����		: Right Elements ���
	// �ۼ���	: �輺ȣ (sh.kim@yourstage.com)
	// �ҼӸ�	: Development Team
	// ������	: 20090503
#endregion

if( !defined("__INCLUDE_SYSTEM_PACKAGE__") )
{
	include_once "/web/home/heart/framework/_system/data/class.HttpErrorPrint.php";
	HttpErrorPrint::OccurHttpError( 412 );
}
global $pageElement;
?>

		<div id="skyscraper" class="fr" style="width:65px">
			<div id="divSkyScraper" style="position:absolute; width:65px; height:270px; z-index:1;">
				<table width="65" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="http://image.heart-heart.org/img/www_skyscraper_top.gif"></td>
					</tr>
					<tr>
						<td><a href="http://www.heart-heart.org/support/" target="_self" alt="�������"><img src="http://image.heart-heart.org/img/www_skyscraper_01.gif" onMouseOver="this.src='http://image.heart-heart.org/img/www_skyscraper_01_on.gif';" onMouseOut="this.src='http://image.heart-heart.org/img/www_skyscraper_01.gif';" /></a></td>
					</tr>
					<tr>
						<td><a href="http://www.heart-heart.org/community/campaign.php" alt="ķ����"><img src="http://image.heart-heart.org/img/www_skyscraper_02.gif" onMouseOver="this.src='http://image.heart-heart.org/img/www_skyscraper_02_on.gif';" onMouseOut="this.src='http://image.heart-heart.org/img/www_skyscraper_02.gif';" /></a></td>
					</tr>
					<tr>
						<td><a href="http://www.heart-heart.org/mypage/" alt="����������" ><img src="http://image.heart-heart.org/img/www_skyscraper_03.gif" onMouseOver="this.src='http://image.heart-heart.org/img/www_skyscraper_03_on.gif';" onMouseOut="this.src='http://image.heart-heart.org/img/www_skyscraper_03.gif';" /></a></td>
					</tr>
					<tr>
						<td><a href="http://sps.hsit.co.kr/default.aspx?Server=vZM1/ICyaRTAUXP/P%2Bp3Wg==&Module=Sps" target="_blank" alt="�Ŀ�����"><img src="http://image.heart-heart.org/img/www_skyscraper_04.gif" onMouseOver="this.src='http://image.heart-heart.org/img/www_skyscraper_04_on.gif';" onMouseOut="this.src='http://image.heart-heart.org/img/www_skyscraper_04.gif';" /></a></td>
					</tr>
					<tr>
						<td><img src="http://image.heart-heart.org/img/www_skyscraper_bottom.gif"></td>
					</tr>
					<tr>
						<td><a href="#" onClick="Effect.ScrollTo('header'); return false;" onFocus="this.blur()"><img src="http://image.heart-heart.org/img/www_skyscraper_btn.gif"></a></td>
					</tr>
				</table>
			</div>
		</div>
		<script type="text/javascript">
		//<![CDATA[
			var clsSkyScraper = null;
			function initSkyScraper()
			{
				clsSkyScraper = new SkyScraper($('divSkyScraper'), 125, 140, 1000);
			}
			addWindowLoadEvent(initSkyScraper);
		//]]>
		</script>
