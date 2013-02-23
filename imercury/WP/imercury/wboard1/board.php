<?php
/**
 * Board Skin: 용도
 * 3.차량별AV – 제품리뷰
 * 4.고객지원 – 자주하는질문
 * 5.다운로드 - 회원전용
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );
require_once( NEW_IMERCURY_DIR . '/include/paging_class.php' );



$category = $_GET[category];
if ($category=="") {
	$query002 = "select * from good_reg left outer join model_tbl on good_reg.model_no =model_tbl.no where userid = '".$_COOKIE["mid"]."' " ;
	$info002 = $db->query($query002);

	if ($info002[mname] && $code!= "board10" && $code!= "board5" && $code!= "board6"  ) {
		$category = $info002[mname] ;
	}
}


if (!$category) {
	$sql1 = "select count(*) from $code where 1 ";
	if($search) $sql1 .= " AND $search like '%$word%' and notice < 1 " ;

	$sql = "select * from $code where 1 " ;
	if($search) $sql .= "AND $search like '%$word%'" ;
	$sql .= " and notice < 1 order by thread desc ";
} else {
	$sql1 = "select count(*) from $code  where 1 ";
	if($search) $sql1 .= "AND $search like '%$word%' " ;
	$sql1 .= " and category='$category' and notice < 1 ";

	$sql = "select * from $code where 1 " ;
	if($search) $sql .= "AND $search like '%$word%' " ;
	$sql .= " and category='$category' and notice < 1 order by thread desc";
}

$pg	= new paging;
$pagenum	= $_GET[pagenum] == "" ? '1' : $_GET[pagenum];
$list_num	= 15;
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
<script language="javascript" src="<?=BOARDSKINPATH?>/imgcbox.js"></script>
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
						<tr>
							<td style="width:55px"><?
								if ($admin == 1 || $code == "board1" || $code == "board7" || $code == "board12" || $code == "board10" ) {
									$query1 = "select no,mname from model_tbl" ;
								} else {
									$query1 = "select * from good_reg left outer join model_tbl on good_reg.model_no =model_tbl.no where userid = '".$_COOKIE["mid"]."' " ;
								}
								$result1 = mysql_query($query1);
								?><select name="category" >
									<option value="" >선택하세요</option><?

									while( $b_row = @mysql_fetch_array($result1) ){
										$mname = $b_row[mname];
										?>

									<option value='<?=$mname?>' <?if($category == $mname ) echo "selected";?>><?=$mname?></option><?
									}
								?>

								</select>&nbsp;&nbsp;
							</td>
							<td style="width:55px">
								<select name="search">
									<option value="title" <?if($search == "title") echo "selected";?>>제목</option>
									<option value="contents" <?if($search == "contents") echo "selected";?>>내용</option>
									<option value="name" <?if($search == "name") echo "selected";?>>아이디</option>
								</select>
							</td>
							<td width="110"><input name="word" type="text" class="border08" size="15" value="<?=$word?>"></td>
							<td><img src="<?=BOARDSKINPATH?>/btn_img/bt_search.gif" width="44" height="23" onclick="sub()" style="cursor:hand"></td>
						</tr>
						</form>
						</table>
					</td>
					<td align="right" valign="bottom"><?
						if( ($code == "board4" && auth_chk(2)) || ($code == "board11" && auth_chk(2)) || ($code == "board13" && auth_chk(2)) || ($code == "board2" && auth_chk(1)) || ($code == "board14" && auth_chk(2)) || ($code == "board3" && auth_chk(1)) || auth_chk(3) )
						{
							?><a href="<?=$post->post_name?>?mode=write"><img src="<?=BOARDSKINPATH?>/btn_img/bt_write.gif" width="56" height="23" border="0"></a><?
						}
						?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><img src="<?=BOARDSKINPATH?>/images/img_06.jpg"></td>
	</tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<?
					$query2 = "select * from $code where notice > 0 order by thread desc ";
					$rs2 = @mysql_query($query2);

					while($row1 = @mysql_fetch_array($rs2))
					{
						// 댓글 수량
						$query = "select * from tail_board where bno=".$row1[no]  ;
						$query .= " AND code = '$code' "  ;

						$resultDD=mysql_query("$query");
						$rows1=mysql_num_rows($resultDD);
						if ($rows1>0){
							$nu="[$rows1]";
						} else {
							$nu="";
						}
						?>
				<tr>
					<td width="41" height="25" align="center" class="border07"><font color="red">공지</font></td>
					<td width="51" align="center" class="border07">&nbsp;</td>
					<td width="301" class="link2" style="padding-left:5px" colspan="2"><?=$depth?>
						<a href="<?=$post->post_name?>?mode=view&no=<?=$row1[no]?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&pagenum=<?=$pagenum?>&search=<?=$search?>&category=<?=$row1[category]?>"><?=cut_string($row1[title],45)?>&nbsp;<? echo $nu?></a>
					</td>
					<td width="91" align="center" class="border07">&nbsp;</td>
					<td width="40" align="center" class="border07"><?=$row1[hit]?></td>
				</tr><?
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
						$query = "select * from tail_board where bno=".$info[$i][no];
						$query .= " AND code = '$code' ";
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
						?>
			<tr>
				<td width="36" height="25" align="center" class="border07"><?=$no--?></td>
				<td width="101" align="center" class="border07"><?=$info[$i][category]?></td>
				<td width="301" class="link2" style="padding-left:5px"><?=$depth?>
					<a href="<?=$post->post_name?>?mode=view&no=<?=$info[$i][no]?>&ti=<?=$ti?>&code=<?=$code?>&co=<?=$co?>&word=<?=$word?>&page=<?=$page?>&search=<?=$search?>&category=<?=$info[$i][category]?>"><?=cut_string($info[$i][title],45)?>&nbsp;<? echo $nu?></a>
				</td>
				<td width="61" align="center" class="border07"><?=$info[$i][name]?></td>
				<td width="66" align="center" class="border07"><?=substr($info[$i][rdate],0,10)?></td>
				<td width="40" align="center" class="border07"><?=$info[$i][hit]?></td>
			</tr><?
					}
				}
				else
				{
					?>
			<tr>
				<td colspan="6" height="30" align="center">등록된 글이 없습니다.</td>
			</tr><?
			}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="42" align="center"><?=$pg->mk_numbering()?></td>
	</tr>
	<tr>
		<td height="3" bgcolor="#94CCF4"><img src="<?= BOARDSKINPATH?>/images/img_b_zul2.gif" width="620" height="3" /></td>
	</tr>
</table>
<script>imgCbox("na");</script>
<script>imgCbox("ti");</script>
<script>imgCbox("co");</script>