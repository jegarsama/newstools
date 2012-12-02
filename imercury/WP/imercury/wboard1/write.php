<?

if($admin != 1){
  include "login_chk2.php";
}

if($mode == "edit"){

  $sql = "select * from $code where no = '$no'";
  $info = $db->query($sql);

  if($info[pwd] != $pwd && $admin != 1){
    err_back("패스워드가 일치하지 않습니다.");
  }
  $title = $info[title];
  $content = $info[contents];
  $name = $info[name];
  $pwd = $info[pwd];
}else if($mode == "reply"){
  $sql = "select name,title,contents from $code where no = '$no'";
  $info = $db->query($sql);
  $title = "[답글]".$info[title];
  $content = "\n\n\n\n\n--------------------------------------------------------\n".$info[name]."님이 작성하신 글입니다.\n\n". $info[contents]."\n\n--------------------------------------------------------";

  if($admin == 1){
  $sql = "select * from admin_tbl";
  $info = $db->query($sql);
  $name = $info[name];
  $pwd = $info[admin_pwd];
  }else if($_COOKIE[mid]){
    $sql = "select * from member_tbl where userid = '$_COOKIE[mid]'";
    $info = $db->query($sql);
    $name = $info[userid];
    $pwd = $info[pwd];
  }
}else if($admin == 1){
  $sql = "select * from admin_tbl";
  $info = $db->query($sql);
  $name = $info[name];
  $pwd = $info[admin_pwd];
}else if($_COOKIE[mid]){
    $sql = "select * from member_tbl where userid = '$_COOKIE[mid]'";
    $info = $db->query($sql);
    $name = $info[userid];
    $pwd = $info[pwd];
  }
?>

<?

	$query1 = "select no,mname from model_tbl" ;
	$result1 = mysql_query($query1) ;

	//제품정보
	$query2 = "select * from good_reg left outer join model_tbl on good_reg.model_no =model_tbl.no where userid = '$name' " ;
//	echo $query2;
    $info2 = $db->query($query2);

if ($info2[mname]) {
	$category = $info2[mname] ;
}


?>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="Cho Sang-Won">
<link href="/<?=$skin?>/css.css" rel="stylesheet" type="text/css">
<link href="/<?=$skin?>/style.css" rel="stylesheet" type="text/css">
<Script>
function linkblur(){
if (event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG")
document.body.focus();
}
document.onfocusin=linkblur;

function sub(){
  f = document.form1;

	if(!form1.category.value){
		alert("제품을 선택해주세요!");
		return false;
	}

  if(f.name.value == ""){
    alert("이름을 입력하세요.");
    f.name.focus();
    return;
  }
  if(f.title.value == ""){
    alert("제목을 입력하세요.");
    f.title.focus();
    return;
  }
  if(f.pwd.value == ""){
    alert("패스워드를 입력하세요.");
    f.pwd.focus();
    return;
  }
  if(f.contents.value == ""){
    alert("내용을 입력하세요.");
    f.contents.focus();
    return;
  }
  f.submit();
}
</script>
<table width="600" border="0" cellpadding="0" cellspacing="0">
<form name="form1" method=post action="/<?=$skin?>/write_ps.php" enctype="multipart/form-data">
  <input type="hidden" name="code" value="<?=$code?>">
  <input type="hidden" name="url" value="<?=$PHP_SELF?>">
  <input type="hidden" name="no" value="<?=$no?>">
  <input type="hidden" name="mode" value="<?=$mode?>">
  <input type="hidden" name="old_file" value="<?=$info[file1]?>">
  <input type="hidden" name="old_rfile" value="<?=$info[rfile1]?>">
  <input type="hidden" name="ti" value="<?=$ti?>">
  <input type="hidden" name="co" value="<?=$co?>">
  <input type="hidden" name="word" value="<?=$word?>">
  <input type="hidden" name="page" value="<?=$page?>">
  <input type="hidden" name="search" value="<?=$search?>">
  <input type="hidden" name="category" value="<?=$category?>">
  <input type="hidden" name="notice" value="0" value="<?=$info[notice]?>">

  <tr>
    <td height="3" bgcolor="#94CCF4"></td>
  </tr>
  <tr>
    <td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="../<?=$skin?>/btn_img/bg02.gif">
        <tr>
          <td width="65" align="right">
<?

	if ($admin == 1 || $code == "board1" || $code == "board12" || $code == "board10" ) {
		$query1 = "select no,mname from model_tbl" ;
	} else {
		$query1 = "select * from good_reg left outer join model_tbl on good_reg.model_no =model_tbl.no where userid = '".$_COOKIE["mid"]."' " ;
	}
	$result1 = mysql_query($query1) ;

//		if ($mode != "write" || $info2[mname]) {
?>
				<select name="category2" onchange="category.value=this.value">

				  <option value="title">선택하세요</option>
<? 	while( $b_row = @mysql_fetch_array($result1) ){
				$mname = $b_row[mname] ;
?>
								<option value='<?=$mname?>' <?if($category == $mname ) echo "selected";?>><?=$mname?></option>
<? } ?>
                </select>&nbsp;&nbsp;
		</td>
          <td width="250" style="padding-left:10">
		</td>
          <td width="66" align="right">&nbsp;</td>
          <td style="padding-left:10">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="../<?=$skin?>/btn_img/bg02.gif">
        <tr>
          <td width="65" align="right"><img src="../../<?=$skin?>/btn_img/write_writer.gif" width="53" height="11"></td>
          <td width="250" style="padding-left:10"><input name="name" type="text" class="border08" size="20" value="<?=$name?>" readonly></td>
          <td width="66" align="right"><img src="../../<?=$skin?>/btn_img/write_pass.gif" width="66" height="11"></td>
          <td style="padding-left:10"><input name="pwd" type="password" class="border08" size="10" value="<?=$pwd?>" readonly></td>

		</tr>
      </table></td>
  </tr>

<? if( auth_chked(3) ) { ?>
  <tr>
    <td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="../../<?=$skin?>/btn_img/bg02.gif">
        <tr>
          <td width="65" align="right">공지기능</td>
          <td style="padding-left:10"><input type="radio" name="notice" value="1" style="border:0;">&nbsp;yes&nbsp;<input type="radio" name="notice" value="0" style="border:0;" checked>&nbsp;no</td>
        </tr>
      </table></td>
  </tr>
  <? } ?>
  <tr>
    <td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="../../<?=$skin?>/btn_img/bg02.gif">
        <tr>
          <td width="65" align="right"><img src="../../<?=$skin?>/btn_img/write_subject.gif" width="53" height="11"></td>
          <td style="padding-left:10"><input name="title" type="text" class="border08" size="60" value="<?=stripslashes($title)?>"></td>
        </tr>
      </table></td>
  </tr>

  <tr>
    <td class="border09"><table width="100%" height="279" border="0" cellpadding="0" cellspacing="0" background="../../<?=$skin?>/btn_img/bg03.gif">
        <tr>
          <td width="65" align="right" valign="top" style="padding-top:30"><img src="../../<?=$skin?>/btn_img/write_body.gif" width="53" height="11"></td>
          <td valign="top" style="padding:7 0 0 10"><input type="checkbox" name="html_yn" style="border:0" value="Y" <?if($info[html_yn] == "Y") echo "checked";?>> html 사용<br><textarea name="contents" rows="18" class="border08" style="width:100%"><?=stripslashes($content)?></textarea></td>
        </tr>
      </table></td>
  </tr>

  <tr>
    <td><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="65" align="right"><img src="../../<?=$skin?>/btn_img/write_file.gif" width="53" height="11"></td>
          <td style="padding-left:10"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td ><?if($info[file1]){?>기존파일 : <?=$info[rfile1]?> <input type="checkbox" name="file_del" value="Y" style="border:0"> 기존파일삭제시 체크<br><?}?><input name="file1" type="file" class="border08" size="60"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>

  <tr>
    <td height="3" bgcolor="#94CCF4"></td>
  </tr>
  <tr>
    <td align="center" style="padding:7 10 0 10"><img src="../../<?=$skin?>/btn_img/bt_write.gif" width="56" height="23" onclick="sub()" style="cursor:hand">&nbsp;
      <img src="../../<?=$skin?>/btn_img/bt_cancel.gif" width="56" height="23" onclick="history.back()" style="cursor:hand"></td>
  </tr>
</form>
</table>
