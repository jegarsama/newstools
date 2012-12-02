<?
include $DOCUMENT_ROOT.$__SUB_DIR__."/".$skin."/paging_class.php";
$pg = new paging;
$page = $_GET[page] == "" ? '1' : $_GET[page];
$list_num = 15;
$limit_num = $pg -> get_limit($page, $list_num);

//if($search) $ad_q = "AND $search like '%$word%'" ;

//$sql1 = "select count(*) from $code $ad_q";
//$total = $db->query_one($sql1);

//echo 	$category  ."<br>";

function auth_chk($type){

	//회원 체크+제품인증
	if($type == 2){

		global $db;

		$query2 = "select * from good_reg left outer join model_tbl on good_reg.model_no =model_tbl.no where userid = '".$_COOKIE["mid"]."' " ;
		$info2 = $db->query($query2);

		if($_COOKIE["mid"] && $info2[mname]){
			return true;
		}else{
			return false;
		}
				// 관리자 권한체크
	}else if($type == 3){

		if($_COOKIE["admin_lever"] == '1'){
			return false;
		}else{
			return true;
		}

	} else { //회원 체크

		if($_COOKIE["mid"]){
			return true;
		}else{
			return false;
		}

	}
} // auth_chk



if (!$category) {

	$sql1 = "select count(*) from $code where role<='$_COOKIE[role]' ";
	if($search) $sql1 .= " AND $search like '%$word%' and notice < 1 " ;


	$sql = "select * from $code where role<='$_COOKIE[role]' " ;
	if($search) $sql .= "AND $search like '%$word%'" ;
	$sql .= " and notice < 1 order by thread desc ";


} else {
	$sql1 = "select count(*) from $code  where role='$_COOKIE[role]'";
	if($search) $sql1 .= "AND $search like '%$word%' and notice < 1" ;

	$sql = "select * from $code where role='$_COOKIE[role]' " ;
	echo($sql);
	if($search) $sql .= "AND $search like '%$word%' " ;
	$sql .= " order by thread desc and notice < 1 ";
//	$sql = "select * from $code $ad_q where category='$category' order by thread desc" ;

}
	$total = $db->query_one($sql1);

$info = $db->query_between($sql,$limit_num[0],$list_num);

$ecturl = $pg -> mk_getstr($_GET);
$pg -> get_env($total, $list_num, $page, $PHP_SELF, $ecturl);
$pg -> use_block('10');
$pg -> use_img('../'.$skin.'/btn_img/bt_back.gif', '../'.$skin.'/btn_img/bt_next.gif');
$no = $total - ($list_num*($page-1));

?>

<meta http-equiv="content-type" content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="Cho Sang-Won">
<link href="<?=$__SUB_DIR__?>/<?=$skin?>/css.css" rel="stylesheet" type="text/css">
<link href="<?=$__SUB_DIR__?>/<?=$skin?>/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?=$__SUB_DIR__?>/<?=$skin?>/imgcbox.js"></script>
<Script>
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

</script>

<table width="600" border="0" cellpadding="0" cellspacing="0">
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
    <td style="padding:8 10 0 10"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="400"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <form name="form1" method=post action="">
          <input type="hidden" name="search" value="1">
              <tr>
                <td width="55">
				<select name="search">
                  <option value="title" <?if($search == "title") echo "selected";?>>제목</option>
                  <option value="contents" <?if($search == "contents") echo "selected";?>>내용</option>
                  <option value="name" <?if($search == "name") echo "selected";?>>아이디</option>
				</select>
				</td>
                <td width="110"><input name="word" type="text" class="border08" size="15" value="<?=$word?>"></td>
                <td><img src="<?=$__SUB_DIR__?>/<?=$skin?>/btn_img/bt_search.gif" width="44" height="23" onclick="sub()" style="cursor:hand"></td>
              </tr>
            </form>
            </table></td>
          <td align="right" valign="bottom">

          <?
		  if($admin == 1 || ($code == "board4" && auth_chk(1)) || ($code == "board11" && auth_chk(2)) || $code == "board13" || ($code == "board2" && auth_chk(1)) || ($code == "board14" && auth_chk(2)) || ($code == "board3" && auth_chk(1)) ){
		   ?>
                 <a href="<?=$PHP_SELF?>?mode=write"><img src="<?=$__SUB_DIR__?>/<?=$skin?>/btn_img/bt_write.gif" width="56" height="23" border="0"></a>
          <?}?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><img src="/imercury/images/img_06.gif"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <?

   	$query2 = "select * from $code where notice > 0 order by thread desc ";
	$rs2 = @mysql_query($query2);

   while($row1 = @mysql_fetch_array($rs2)){

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
          <td width="301" class="link2" style="padding-left:5" colspan="2"><?=$depth?>

		  <a href="<?=$PHP_SELF?>?mode=view&no=<?=$row1[no]?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&page=<?=$page?>&search=<?=$search?>&category=<?=$row1[category]?>"><?=cut_string($row1[title],45)?>&nbsp;<? echo $nu?></a>

		  </td>
          <td width="91" align="center" class="border07">&nbsp;</td>
          <td width="40" align="center" class="border07"><?=$row1[hit]?></td>
        </tr>
<?	 } ?>



  <?
  if(count($info) > 0){
  for($i=0;$i<count($info);$i++){

    $title = stripslashes($info[$i][title]);
    $title = find_replace($title,$word);
    $depth = "";
      if($info[$i][depth] > 0){
        for($j=0;$j<$info[$i][depth];$j++){
          $depth .= "&nbsp;&nbsp;";
        }
        $depth .= "<img src='../$skin/btn_img/icon_re.gif' border='0'>&nbsp;";
      }


  			// 댓글 수량

			$query = "select * from tail_board where bno=".$info[$i][no]  ;
			$query .= " AND code = '$code' "  ;

			$resultDD=mysql_query("$query");
			$rows1=mysql_num_rows($resultDD);
			if ($rows1>0){
				$nu="[$rows1]";
			} else {
				$nu="";
			}



    if($info[$i][file1]){
      $img = explode(".",$info[$i][file1]);
      if(is_file($DOCUMENT_ROOT."/$skin/file_img/".strtoupper($img[1]).".gif")){

          $file = "<img src='/$skin/file_img/".strtoupper($img[1]).".gif' border='0' alt='".$info[$i][rfile1]."'>";

      }else{

          $file = "<img src='/$skin/file_img/unknown.gif' border='0' alt='".$info[$i][rfile1]."'>";

      }
    }else $file = "&nbsp;";
    ?>
    <tr>
          <td width="41" height="25" align="center" class="border07"><?=$no--?></td>
          <td width="51" align="center" class="border07"><?=$file?></td>
          <td width="301" class="link2" style="padding-left:5"><?=$depth?>

          <a href="<?=$PHP_SELF?>?mode=view&no=<?=$info[$i][no]?>&ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&page=<?=$page?>&search=<?=$search?>"><?=cut_string($info[$i][title],45)?>&nbsp;<? echo $nu?></a>

          </td>
          <td width="76" align="center" class="border07"><?=$info[$i][name]?></td>
          <td width="91" align="center" class="border07"><?=substr($info[$i][rdate],0,10)?></td>
          <td width="40" align="center" class="border07"><?=$info[$i][hit]?></td>
        </tr>
  <?}}else{?>
  <tr>
    <Td colspan="6" height="30" align="center">등록된 글이 없습니다.</td>
  </tr>
  <?}?>
  </table></td>
  </tr>
  <tr>
    <td height="42" align="center">
    <?=$pg->mk_numbering()?></td>
  </tr>
  <tr>
    <td height="3" bgcolor="#94CCF4"><img src="/imercury/images/img_b_zul2.gif" width="620" height="3"></td>
  </tr>
</table>
<script>imgCbox("na");</script>
<script>imgCbox("ti");</script>
<script>imgCbox("co");</script>


