<?php
#region License Statement
	// Copyright (c) Sitemaps.co.kr All rights reserved.
	//
	// Filename	: index.php
	// Path		: [www]/
	// Code		: UTF-8
	// Desc		: 메인화면
	// Author	: Sergei Kim (김성호, master@newstools.kr)
	// Update	: 20091018
#endregion

#region Basic Config
	session_start();
	define("__WEBTOOLS__", true);
	include_once "_include/package.php";
#endregion

#region Package Loading
	Packager::LoadNamespace( "System" );
	Packager::LoadNamespace( "System/MarkupLanguage" );
#endregion
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="Format" content="text/html" />
<meta name="Robots" content="index,follow" />
<meta name="Charset" content="utf-8" />
<meta name="Author" content="LastDragon" />
<meta name="Generator" content="EditPlus Text Editor v3.31" />
<title>sample page</title>
</head>
<body>
<?
	//echo Tag::CreateTag("div", false, "myid", "myname", "isoption");
	echo Tag::CreateTagBlock("div", "출력내용", "myid", "myname", "isoption");

	//Package 활용 테스트
	$s = new SystemClass();

	if( isset($s) )	echo "1".$s."<br />";

	if( isset($s->MyVar) )	echo "2".$s->MyVar."<br />";
	if( isset($s->pri) )	echo "3".$s->pri."<br />";		//private 영역 접근불가
	if( isset($s->pro) )	echo "4".$s->pro."<br />";		//protected 영역 접근불가
	if( isset($s->pub) )	echo "5".$s->pub."<br />";

	if( $s->issetPri() )	echo "6".$s->pri."<br />";
	if( $s->issetPro() )	echo "7".$s->pro."<br />";
	if( $s->issetPub() )	echo "8".$s->pub."<br />";
?>
</body>
</html>
<?
#region 공용 리소스 반환
#endregion

exit;
?>