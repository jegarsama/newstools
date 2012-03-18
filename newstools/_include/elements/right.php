<?php
#region License Statement
	// Copyright (c) SeniorPartners. All rights reserved.
	//
	// 파일명	: right.php
	// 경로		: [www]/_include/elements/
	// 코드		: ANSI
	// 설명		: Right Elements 출력
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

		<div id="skyscraper" class="fr" style="width:65px">
			<div id="divSkyScraper" style="position:absolute; width:65px; height:270px; z-index:1;">
				<table width="65" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="http://image.heart-heart.org/img/www_skyscraper_top.gif"></td>
					</tr>
					<tr>
						<td><a href="http://www.heart-heart.org/support/" target="_self" alt="기부참여"><img src="http://image.heart-heart.org/img/www_skyscraper_01.gif" onMouseOver="this.src='http://image.heart-heart.org/img/www_skyscraper_01_on.gif';" onMouseOut="this.src='http://image.heart-heart.org/img/www_skyscraper_01.gif';" /></a></td>
					</tr>
					<tr>
						<td><a href="http://www.heart-heart.org/community/campaign.php" alt="캠페인"><img src="http://image.heart-heart.org/img/www_skyscraper_02.gif" onMouseOver="this.src='http://image.heart-heart.org/img/www_skyscraper_02_on.gif';" onMouseOut="this.src='http://image.heart-heart.org/img/www_skyscraper_02.gif';" /></a></td>
					</tr>
					<tr>
						<td><a href="http://www.heart-heart.org/mypage/" alt="마이페이지" ><img src="http://image.heart-heart.org/img/www_skyscraper_03.gif" onMouseOver="this.src='http://image.heart-heart.org/img/www_skyscraper_03_on.gif';" onMouseOut="this.src='http://image.heart-heart.org/img/www_skyscraper_03.gif';" /></a></td>
					</tr>
					<tr>
						<td><a href="http://sps.hsit.co.kr/default.aspx?Server=vZM1/ICyaRTAUXP/P%2Bp3Wg==&Module=Sps" target="_blank" alt="후원내역"><img src="http://image.heart-heart.org/img/www_skyscraper_04.gif" onMouseOver="this.src='http://image.heart-heart.org/img/www_skyscraper_04_on.gif';" onMouseOut="this.src='http://image.heart-heart.org/img/www_skyscraper_04.gif';" /></a></td>
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
