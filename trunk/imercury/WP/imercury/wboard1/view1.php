<?php
/**
 * Board Skin: 용도
 * 1.아이머큐리 - 공지사항
 * 5.다운로드 – 비회원 다운로드
 * 7.대리점전용관
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );



$category	= $_GET[category];
$search		= $_GET[search];
$word		= $_GET[word];
$no		= $_GET[no];
$thread	= $_GET[thread];
$pagenum= $_GET[pagenum] == "" ? '1' : $_GET[pagenum];




if($code == "board5" || $code == "board6" || $code == "board7" || $code == "board8" || $code == "board9"){
	if(!$_COOKIE[mid] &&  $admin != "1"){
		move_to("../html/mem_login.html?r_url=$post->post_name");
	}
}


if(!$no){
	$sql = "select no from $code where thread = '$thread'";
	$no = $db->query_one($sql);
}

$sql = "update $code set hit = hit + 1 where no = '$no'";
$db->execute($sql);

$sql = "select * from $code where no = '$no'";
$info	= $db->query($sql);
$contents	= str_replace(" ","&nbsp;",$info[contents]);
$contents	= stripslashes($info[contents]);
if($info[html_yn] != "Y"){
	$contents = str_replace(" ","&nbsp;",$contents);
	$contents = nl2br($contents);
	//$contents = showText($contents);
}
$contents = find_replace($contents,$word);

if($info[file1]){
	$img = explode(".",$info[file1]);
	if(is_file(NEW_IMERCURY_DIR ."/". $skin ."/file_img/".strtoupper($img[1]).".gif")){
		if($admin == "1"){
			$file = "<a href='/$skin/download.php?code=".$code."&f1=".$info[file1]."&f2=".$info[rfile1]."'><img src='".BOARDSKINPATH."/file_img/".strtoupper($img[1]).".gif' border='0' alt='".$info[rfile1]."' title='".$info[rfile1]."' /></a>";
		}else if($code == "board5" || $code == "board6" || $code == "board7" || $code == "board8"){
			if($_COOKIE[mid]){
				$sql = "select count(*) from good_reg where userid = '$_COOKIE[mid]'";
				$chk = $db->query_one($sql);
				if($chk > 0){
					$file = "<a href='/$skin/download.php?code=".$code."&f1=".$info[file1]."&f2=".$info[rfile1]."'><img src='".BOARDSKINPATH."/file_img/".strtoupper($img[1]).".gif' border='0' alt='".$info[rfile1]."' title='".$info[rfile1]."' /></a>";
				}else{
					$file = "<a href='javascript:login()'><img src='".BOARDSKINPATH."/file_img/".strtoupper($img[1]).".gif' border='0' alt='".$info[rfile1]."' title='".$info[rfile1]."' /></a>";
				}
			}else{
				$file = "<a href='javascript:login()'><img src='".BOARDSKINPATH."/file_img/".strtoupper($img[1]).".gif' border='0' alt='".$info[rfile1]."' title='".$info[rfile1]."' /></a>";
			}
		}else{
			$file = "<a href='/$skin/download.php?code=".$code."&f1=".$info[file1]."&f2=".$info[rfile1]."'><img src='".BOARDSKINPATH."/file_img/".strtoupper($img[1]).".gif' border='0' alt='".$info[rfile1]."' title='".$info[rfile1]."' /></a>";
		}
	}else{
		$file = "<a href='/$skin/download.php?code=".$code."&f1=".$info[file1]."&f2=".$info[rfile1]."'><img src='".BOARDSKINPATH."/file_img/unknown.gif' border='0' alt='".$info[rfile1]."' title='".$info[rfile1]."' /></a>";
	}
	if(strtoupper($img[1]) == "JPG" || strtoupper($img[1]) == "GIF" || strtoupper($img[1]) == "BMP" || strtoupper($img[1]) == "PNG"){
		$img2 = image_re("/WP/imercury/".$skin."/data/".$code."/".$info[file1],600,3000);
		//$review = "<img src='$img2[0]' width='$img2[1]' height='$img2[2]' onclick=\"img_pop('/WP/imercury/".$skin."/data/".$code."/".$info[file1]."');\" style='cursor:hand' />";
		$review = "<img src='$img2[0]' width='$img2[1]' height='$img2[2]' />";
	}
}
else $file = "&nbsp;";


$sql = "select max(no) from $code where no < '$no' ";
if($category) $sql .= "AND category='$category' " ;
$prev = $db->query_one($sql);

$sql = "select min(no) from $code where no > '$no' ";
if($category) $sql .= "AND category='$category' " ;
$next = $db->query_one($sql);
?>

<link href="WP/imercury/css/css.css" rel="stylesheet" type="text/css">
<link href="WP/imercury/css/style.css" rel="stylesheet" type="text/css">

<script language="javascript" src="<?=BOARDSKINPATH?>/imgcbox.js"></script>
<script type="text/javascript">
//<![CDATA[
	function linkblur(){
		if (event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG")
			document.body.focus();
	}
	document.onfocusin=linkblur;

	function img_pop(img){
		window.open('../include/img_pop.php?img='+img,'','width=100,height=100,left=100,top=100,scrollbars=yes');
	}

	function login(){
		alert("제품인증을 하셔야 해당 파일을 다운로드 하실 수 있습니다.");
	}
//]]>
</script>

<table width="80%" border="0" align="center"  cellpadding="0" cellspacing="0">
	<tr>
		<td><img src="<?= BOARDSKINPATH?>/images/img_b_zul2.gif" width="100%" height="3"></td>
	</tr>
	<tr>
		<td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="<?= BOARDSKINPATH?>/btn_img/bg02.gif">
				<tr>
					<td width="65" align="right"><img src="<?= BOARDSKINPATH?>/btn_img/write_writer.gif" width="53" height="11"></td>
					<td style="padding-left:10px"><font color="#0781C0"><?=$info[name]?> (<?=$info[rdate]?>)</font></td>
					<td align="right"><img src="<?= BOARDSKINPATH?>/btn_img/write_file.gif" width="53" height="11"></td>
					<td width="13" align="right"><img src="<?= BOARDSKINPATH?>/btn_img/bar01.gif" width="1" height="11"></td>
					<td width="40" align="center"><?=$file?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="<?= BOARDSKINPATH?>/btn_img/bg02.gif">
				<tr>
					<td width="65" align="right"><img src="<?= BOARDSKINPATH?>/btn_img/view_subject.gif" width="53" height="12"></td>
					<td style="padding-left:10px"><?=$info[title]?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="padding:5px"><?=$contents?></td>
	</tr>
	<?
		if($review)
		{
			?>
	<tr>
		<td align="center"><?=$review?></td>
	</tr><?
		}



		if( $code == "board4" || $code == "board3" || $code == "board2" )
		{
			?>
	<tr>
		<td style="padding:5px">&nbsp;<br></td>
	</tr>

	<script type="text/javascript">
	//<![CDATA[
		function taildel(j_tblno, j_bno, j_no) {
			// j_tblno : 테이블번호
			// j_bno : 게시판글번호
			// j_no : 꼬릿말번호
			// j_uid : 꼬릿말 작성자
			if( confirm("정말 삭제하시겠습니까?") ){
				j_url  = "<?= BOARDSKINPATH?>/tail_del_ok.php?tblno="+j_tblno+"&bno="+j_bno+"&no="+j_no;
				j_url = j_url + "&url=<?=$post->post_name?>&pagenum=<?=$pagenum?>&code=<?=$code?>";
				location.href = j_url;
			}
		}
	//]]>
	</script>
	<tr>
		<td>
			<table width="590" border="0" cellspacing="0" cellpadding="0"><?

				$tail_squery =  " select * from tail_board ";
				$tail_squery .= " where bno=".$info[no];
				$tail_squery .= " AND code = '$code' "  ;

				$tail_squery .= " order by no desc ";
				$tail_sresult = @mysql_query($tail_squery);

				while( $tail_row = @mysql_fetch_array($tail_sresult) )
				{
					$content=trim($tail_row[content]) ;
					$content = htmlspecialchars($content);
					$content = stripslashes($content);
					$content = str_replace("\n","<br>",$content);
				?>
				<tr>
					<td><table width="590" border="0" cellpadding="0" cellspacing="0" background="<?= BOARDSKINPATH?>/btn_img/btn_box_bg.gif">
							<tr>
								<td width="15"><img src="<?= BOARDSKINPATH?>/btn_img/btn_box_l.gif" width="15" height="32"></td>
								<td width="400"><?=$tail_row["uid"]?> / <?=$tail_row["nick"]?> </td>
								<td width="159"><span style="padding-left:10"><?=$tail_row["wdate"]?></span></td>
								<td width="16"><img src="<?= BOARDSKINPATH?>/btn_img/btn_box_r.gif" width="15" height="32"></td>
							</tr>
						</table>
					</td>
				</tr>
				<?
					if($_COOKIE["mid"] == $tail_row[uid] ||  auth_chk(3))
					{	// 로그인아이디와 글쓴이 아이디가 같으면..
				?>
				<tr>
					<td align="right"><a href="javascript:taildel('<?=$no?>','<?=$tail_row["bno"]?>','<?=$tail_row["no"]?>');">[삭제]</a></td>
				</tr><?
					}
				?>
				<tr>
					<td style="padding:5px"><?= $content?></td>
				</tr>
				<tr>
					<td height="1" bgcolor="e6e6e6"></td>
				</tr><?
				}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
	</tr>

	<script type="text/javascript">
	//<![CDATA[
		function tailok(){
			if (tailform.content.value==""){
				alert ('내용을 입력해주세요');
				tailform.content.focus();
				return false;
			}
		}
	//]]>
	</script>
	<tr>
		<td style="padding:5px">&nbsp;<br></td>
	</tr><?

			if( ($code == "board4"  && auth_chk(1) ) || ($code == "board3"  && auth_chk(1) ) || ($code == "board2"  && auth_chk(1)) || auth_chk(3))
			{
				?>
				<form name="tailform" method="post" action="<?= BOARDSKINPATH?>/tail_ok.php" onsubmit="return tailok();">
				<input type="hidden" name="number" value="<?= $info[no]?>">
				<input type="hidden" name="uid" value="<?=$_COOKIE["mid"]?>">
				<input type="hidden" name="nick" value="<?=$_COOKIE["mname_name"]?>">

				<input type="hidden" name="no" value="<?= $info[no]?>">
				<input type="hidden" name="code" value="<?=$code?>">
				<input type="hidden" name="url" value="<?=$post->post_name?>">
				<input type="hidden" name="ti" value="<?=$ti?>">
				<input type="hidden" name="co" value="<?=$co?>">
				<input type="hidden" name="word" value="<?=$word?>">
				<input type="hidden" name="pagenum" value="<?=$pagenum?>">
				<input type="hidden" name="search" value="<?=$search?>">

				<tr>
					<td align="center"><table width="590" border="0" cellpadding="5" cellspacing="0" bgcolor="e6e6e6">
							<tr>
								<td width="503"><img src="<?= BOARDSKINPATH?>/btn_img/btn_tx04.gif" width="47" height="11"></td>
								<td width="55">&nbsp;</td>
							</tr>
							<script type="text/javascript">
							//<![CDATA[
								function clrImg(obj){ obj.style.backgroundImage="";obj.onkeydown=obj.onmousedown=null; }
							//]]>
							</script>

							<tr>
								<td><textarea name="content" cols="70" rows="3" onkeydown="clrImg(this)" onmousedown="clrImg(this)" style="background-image:url(../images/comment.jpg);background-repeat:no-repeat;background-position:center;"></textarea></td>
								<td><input type="image" src="<?= BOARDSKINPATH?>/btn_img/btn_icon.gif" width="55" height="51" border="0" /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td><img src="<?= BOARDSKINPATH?>/images/img_b_zul2.gif" width="100%" height="3"></td>
				</tr>
				</form><?
			}
		}
			?>



	<tr>
		<td><img src="<?= BOARDSKINPATH?>/images/img_b_zul2.gif" width="100%" height="3"></td>
	</tr>
	<tr>
		<td style="padding:7px 10px 0 10px"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:0px 0px 40px 0px;">
				<tr>
					<td width="43"><?if($prev){?><a href="<?=$post->post_name?>?mode=view&no=<?=$prev?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&pagenum=<?=$pagenum?>&search=<?=$search?>&category=<?=$category?>"><img src="<?= BOARDSKINPATH?>/btn_img/bt_back2.gif" width="43" height="11" border="0"></a><?}?></td>
					<td><?if($next){?><a href="<?=$post->post_name?>?mode=view&no=<?=$next?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&pagenum=<?=$pagenum?>&search=<?=$search?>&category=<?=$category?>"><img src="<?= BOARDSKINPATH?>/btn_img/bt_next2.gif" width="43" height="11" border="0"></a><?}?></td>
					<td align="right"><a href="<?=$post->post_name?>?pagenum=<?=$pagenum?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&search=<?=$search?>&category=<?=$category?>"><img src="<?= BOARDSKINPATH?>/btn_img/bt_list.gif" width="56" height="23" border="0"></a>
						<?if($admin == "1"){?>
							<a href="<?=$post->post_name?>?mode=edit&no=<?=$no?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&pagenum=<?=$pagenum?>&search=<?=$search?>"><img src="<?= BOARDSKINPATH?>/btn_img/bt_modify.gif" border="0"></a>
							<a href="<?=$post->post_name?>?mode=del&url=<?=$post->post_name?>&no=<?=$no?>&code=<?=$code?>&pagenum=<?=$pagenum?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&search=<?=$search?>"><img src="<?= BOARDSKINPATH?>/btn_img/bt_del.gif" border="0"></a>
						<?}else if( $code == "board4" || $code == "board11" || $code == "board13" || $code == "board2" || $code == "board14" || auth_chked(3)){?>
							<a href="<?=$post->post_name?>?mode=edit&url=<?=$post->post_name?>&no=<?=$no?>&code=<?=$code?>&pagenum=<?=$pagenum?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&search=<?=$search?>"><img src="<?= BOARDSKINPATH?>/btn_img/bt_modify.gif" border="0"></a>
							<a href="<?=$post->post_name?>?mode=del&&url=<?=$post->post_name?>&no=<?=$no?>&code=<?=$code?>&pagenum=<?=$pagenum?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&search=<?=$search?>"><img src="<?= BOARDSKINPATH?>/btn_img/bt_del.gif" border="0"></a>
						<?}?>
						<?if(($code == "board4" && auth_chk(3) ) || $code == "board11" || $code == "board13" || ($code == "board2" && auth_chk(3) ) || ($code == "board3" && auth_chk(3) ) || $code == "board14" )
						{
							if ($info[notice] ==0){ ?>
								<a href="<?=$post->post_name?>?mode=reply&no=<?=$no?>"><img src="<?= BOARDSKINPATH?>/btn_img/bt_reply.gif" width="56" height="23" border="0"></a><?
							}
						}
						?>
						<?if( $admin == 1  || $code == "board4" || ( $code == "board11" && auth_chk(2) ) || ($code == "board13" && auth_chk(2) ) || $code == "board2" || ($code == "board14" && auth_chk(2)) ){?>
							<a href="<?=$post->post_name?>?mode=write"><img src="<?= BOARDSKINPATH?>/btn_img/bt_write.gif" width="56" height="23" border="0"></a>
						<?}?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>