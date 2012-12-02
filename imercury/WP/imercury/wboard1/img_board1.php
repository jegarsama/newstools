<?php
/**
 * Board Skin: 용도
 * 3.차량별AV – 장착갤러리
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );
require_once( NEW_IMERCURY_DIR . '/include/paging_class.php' );



if (!$category) {
	$sql1 = "select count(*) from $code where 1 ";
	//if($search) $sql1 .= " AND $search like '%$word%' and notice < 1 " ;

	$sql = "select * from $code order by seq_number desc " ;
	//if($search) $sql .= "AND $search like '%$word%'" ;
	//$sql .= " and notice < 1 order by rdate desc ";
} else {
	$sql1 = "select count(*) from $code  where 1 ";
	//if($search) $sql1 .= "AND $search like '%$word%' and notice < 1" ;

	$sql = "select * from $code where 1 " ;
	//if($search) $sql .= "AND $search like '%$word%' " ;
	//$sql .= " order by thread desc and notice < 1 ";
	//$sql = "select * from $code $ad_q where category='$category' order by thread desc" ;
}

$pg	= new paging;
$pagenum	= $_GET[pagenum] == "" ? '1' : $_GET[pagenum];
$list_num	= 9;
$limit_num	= $pg -> get_limit($pagenum, $list_num);

$total	= $db->query_one($sql1);
$info	= $db->query_between($sql,$limit_num[0],$list_num);
$ecturl	= $pg -> mk_getstr($_GET);

$pg -> get_env($total, $list_num, $pagenum, $post->post_name, $ecturl);
$pg -> use_block('10');
$pg -> use_img(BOARDSKINPATH.'/btn_img/bt_back.gif', BOARDSKINPATH.'/btn_img/bt_next.gif');
$no		= $total - ($list_num*($pagenum-1));
?>
<link href="<?=BOARDSKINPATH?>/css.css" rel="stylesheet" type="text/css">
<link href="<?=BOARDSKINPATH?>/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?=BOARDSKINPATH?>/imgcbox.js"></script>
<script type="text/javascript">
//<![CDATA[
	function linkblur(){
		if (event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG")
			document.body.focus();
	}
	document.onfocusin=linkblur;

	function sub(){
		if(form1.title.checked == false && form1.contents.checked == false){
			alert("검색조건을 하나이상 선택하세요.");
			return;
		}
		if(form1.word.value == ""){
			alert("검색어를 입력하세요");
			form1.word.focus();
			return;
		}
		form1.submit();
	}
//]]>
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<?
	if($search == 1){
		if($na == "Y") $chk1 = "checked";
		else $chk1 = "";

		if($ti == "Y") $chk2 = "checked";
		else $chk2 = "";

		if($co == "Y") $chk3 = "checked";
		else $chk3 = "";
	}else{
		$chk1 = "";
		$chk2 = "checked";
		$chk3 = "";
	}
?>
	<tr>
		<td style="padding:8px 10px 0 10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<form name="form1" method="post">
						<input type="hidden" name="search" value="1" />
						</form>
						</table>
					</td>
					<td align="right" valign="bottom"><?
						if(($admin == 1) || ($code == "board4" && auth_chk(1)) || ($code == "board11" && auth_chk(2)) || $code == "board13" || ($code == "board2" && auth_chk(1)) || ($code == "board14" && auth_chk(2)) || ($code == "board3" && auth_chk(1)) )
						{
							?><a href="<?=$post->post_name?>?mode=write"><img src="<?=BOARDSKINPATH?>/btn_img/bt_write.gif" width="56" height="23" border="0"></a><?
						}
						?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr align="center">
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr align="center">
					<td align="center">
					<?
						$query2 = "select * from $code where notice > 0 order by thread desc ";
						$rs2 = @mysql_query($query2);

						while($row1 = @mysql_fetch_array($rs2))
						{
							// 댓글 수량
							$query = "select * from tail_board where bno=".$row1[no];
							$query .= " AND code = '$code' "  ;

							$resultDD=mysql_query("$query");
							$rows1=mysql_num_rows($resultDD);
							if ($rows1>0){
								$nu="[$rows1]";
							} else {
								$nu="";
							}
						}
					?>



					<?
						if(count($info) > 0)
						{
							for($i=0;$i<count($info);$i++)
							{
								$title = stripslashes($info[$i][title]);
								$title = find_replace($title,$word);
								$depth = "";
								if($info[$i][depth] > 0)
								{
									for($j=0;$j<$info[$i][depth];$j++){
										$depth .= "&nbsp;&nbsp;";
									}
									$depth .= "<img src='".BOARDSKINPATH."/btn_img/icon_re.gif' border='0' />&nbsp;";
								}


								// 댓글 수량
								$query = "select * from t_gallery";
								$resultDD=mysql_query("$query");
								$rows1=mysql_num_rows($resultDD);
								if ($rows1>0){
									$nu="[$rows1]";
								} else {
									$nu="";
								}


								if($info[$i][file1])
								{
									$img = explode(".",$info[$i][file1]);
									if(is_file(NEW_IMERCURY_DIR ."/". $skin ."/file_img/".strtoupper($img[1]).".gif"))
									{
										$file = "<img src='".BOARDSKINPATH."/file_img/".strtoupper($img[1]).".gif' border='0' alt='".$info[$i][rfile1]."' title='".$info[$i][rfile1]."' />";
									}else{
										$file = "<img src='".BOARDSKINPATH."/file_img/unknown.gif' border='0' alt='".$info[$i][rfile1]."' title='".$info[$i][rfile1]."' />";
									}
								}
								else
									$file = "&nbsp;";

								if($i%3==0)
								{
									?>

						<table border="0" align="center" valign="top">
							<tr><?
								}

									?>

								<td valign="top" style="width:33%;">
									<table valign="top">
										<tr valign="top">
											<td width="41" rowspan="2"></td>
											<td width="180" background="<?= BOARDSKINPATH?>/images/bg_img.gif" width="180" height="120"><a href="<?=$post->post_name?>?mode=view&seq=<?=$info[$i][seq_number]?>&pagenum=<?=$pagenum?>"><img align="center" src="/attach/images/<?=$info[$i][thumb_img]?>" border="0" width="176" height="116" /></a></td>
											<td width="26" rowspan="2"></td>
										</tr>
										<tr>
											<td width="180"><div align="left"><a href="<?=$post->post_name?>?mode=view&seq=<?=$info[$i][seq_number]?>&pagenum=<?=$pagenum?>"><?=$info[$i][content]?></a></div></td>
										</tr>
									</table>
								</td><?

								if($i>0 && ( ($i%3)==2 || ($i+1)==count($info) ) )
								{
									?>

							</tr>
						</table><?
								}
							}
						}
						else
						{
							?>
						<div style="height:30px; text-align:center;">등록된 글이 없습니다.</div><?
						}
							?>

					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><br /><img src="<?= BOARDSKINPATH?>/images/img_zul.gif" width="606" height="6"></td>
	</tr>
	<tr>
		<td height="42" align="center"><?=$pg->mk_numbering()?></td>
	</tr>
</table>
<script>imgCbox("na");</script>
<script>imgCbox("ti");</script>
<script>imgCbox("co");</script>