<?php
/**
 * Board Skin: 용도
 * 6. 마이페이지 - 주문이력
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );
require_once( NEW_IMERCURY_DIR . '/include/paging_class.php' );



$sql1 = "select count(*) from order_tbl where userid = '".$_COOKIE["mid"]."' " ;
$sql = "select * from order_tbl where userid = '".$_COOKIE["mid"]."'  order by no desc";

$pg	= new paging;
$pagenum	= $_GET[pagenum] == "" ? '1' : $_GET[pagenum];
$list_num	= 20;
$limit_num	= $pg->get_limit($pagenum, $list_num);

$total	= $db->query_one($sql1);
$info	= $db->query_between($sql,$limit_num[0],$list_num);
$ecturl	= $pg->mk_getstr($_GET);

$pg->get_env($total, $list_num, $pagenum, $post->post_name, $ecturl);
$pg->use_block('10');
$pg->use_img(BOARDSKINPATH.'/btn_img/bt_back.gif', BOARDSKINPATH.'/btn_img/bt_next.gif');
$no		= $total - ($list_num*($pagenum-1));
?>
<link href="<?=BOARDSKINPATH?>/css.css" rel="stylesheet" type="text/css">
<link href="<?=BOARDSKINPATH?>/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
//<![CDATA[
	function linkblur(){
		if (event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG")
			document.body.focus();
	}
	document.onfocusin=linkblur;

	function sub(){
		/*
		if(form1.title.checked == false && form1.contents.checked == false){
			alert("검색조건을 하나이상 선택하세요.");
			return;
		}
		if(form1.word.value == ""){
			alert("검색어를 입력하세요");
			form1.word.focus();
			return;
		}
		*/
		form1.submit();
	}
//]]>
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center"><img src="<?=BOARDSKINPATH?>/images/ju_tittl.gif"></td>
	</tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr align="middle" bgcolor="#f6f6f6">
				<td height="25">no</td>
				<td>제품명</td>
				<td>가격</td>
				<td>이름</td>
				<td>연락처</td>
				<td>작성일</td>
				<td>송장번호(로젠택배)</td>
			</tr>
			<?
				if (!$total==0)
				{
					for($i=0;$i<count($info);$i++)
					{
						?>
			<tr bgcolor="#ffffff" align="Center">
				<td height="25"><?=$no--?></td>
				<td><?=$info[$i][gname]?></td>
				<td><?=number_format($info[$i][price])?>원</td>
				<td><?=$info[$i][name]?>(<?=$info[$i][userid]?>)</td>
				<td><?=$info[$i][tel]?></td>
				<td><?=$info[$i][rdate]?></td>
				<td><?=$info[$i][numbers]?></td>
			</tr><?
					}
				}
				else
				{
					?>
			<tr bgcolor="#ffffff" align="Center">
				<td height="25" colspan="7">주문내역이 없습니다.</td>
			</tr><?
				}
			?>
		</table></td>
	</tr>
	<tr>
		<td height="42" align="center"><?=$pg->mk_numbering()?></td>
	</tr>
</table>