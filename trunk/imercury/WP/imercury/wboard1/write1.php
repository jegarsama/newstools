<?php
/**
 * Board Skin: 용도
 * 1.아이머큐리 - 공지사항
 * 3.차량별AV - 장착갤러리
 * 5.다운로드 - 비회원 다운로드
 * 7.대리점전용관
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );



$category	= $_GET[category];
$search		= $_GET[search];
$word		= $_GET[word];
$no		= $_GET[no];
$pagenum= $_GET[pagenum] == "" ? '1' : $_GET[pagenum];

if($admin != 1){
	include NEW_IMERCURY_DIR . '/member/login_chk.php';
}

//저장처리 process area start
if(substr($_POST[enc],0,3)=='enc'){
	if(!is_dir(".".BOARDSKINPATH."/data/".$code)){
	  mkdir(".".BOARDSKINPATH."/data/".$code,0707);
	  chmod(".".BOARDSKINPATH."/data/".$code,0707);
	}

	if($_FILES[file1][name]){
	  @unlink(".".BOARDSKINPATH."/data/".$code."/".$old_file);
	  $fname = upload_file($_FILES[file1],".".BOARDSKINPATH."/data/".$code);
	  $rname = $_FILES[file1][name];
	}else{
	  if($file_del == "Y"){
		@unlink(".".BOARDSKINPATH."/data/".$code."/".$old_file);
		$fname = "";
		$rname = "";
	  }else{
		$fname = $old_file;
		$rname = $old_rfile;
	  }
	}
	$today = date("Y/m/d H:i:s");
	$user_name= addslashes($_POST[user_name]);
	$title = addslashes($_POST[title]);
	$contents = addslashes($_POST[contents]);

	if($html_yn != "Y") $contents = htmlspecialchars($contents);

	if($mode == "edit"){
	  $sql = "update $code set name = '$name', pwd = '$pwd', email = '$email', title = '$title', html_yn = '$html_yn', contents = '$contents', file1 = '$fname', rfile1 = '$rname' ,notice = '$notice' where no = '$no'";
	  $db->execute($sql);
	  move_to($post->post_name."?no=$no&mode=view&ti=$ti&co=$co&word=$word&pagenum=$pagenum&search=$search&category=$category");
	}else if($mode == "reply"){
	  $sql = "select thread,depth from $code where no = '$no'";
	  $info = $db -> query($sql);
	  $thread = $info[thread];
	  $depth = $info[depth];
	  $thread2 = $thread - 1;
	  $depth2 = $depth + 1;
	  $thread3 = round($thread/1000,2)*1000 - 1000;

	  $sql = "update $code set thread = thread - 1 where thread < $thread and thread > $thread3";
	  $db -> execute($sql);

	  $sql = "insert into $code (no, thread, depth, name, pwd, email, title, html_yn, contents, file1, rfile1, rdate, hit, category, notice) ";
	  $sql.= " values('','$thread2','$depth2','$name','$pwd','$email','$title','$html_yn','$contents','$fname','$rname','$today','0','$category','$notice')";
	  $db->execute($sql);

	  move_to($post->post_name."?thread=$thread2&mode=view&ti=$ti&co=$co&word=$word&pagenum=$pagenum&search=$search&category=$category");

	}else{
	  $sql = "select max(thread) from $code";
	  $thread = $db -> query_one($sql);
	  $thread2 = $thread + 1000;
	  $sql = "insert into $code (no, thread, depth, name, pwd, email, title, html_yn, contents, file1, rfile1, rdate, hit, category, notice) ";
	  $sql.= " values('','$thread2','0','$name','$pwd','$email','$title','$html_yn','$contents','$fname','$rname','$today','0','$category','$notice')";
	  $db->execute($sql);
	  move_to($post->post_name."?thread=$thread2&mode=view&ti=$ti&co=$co&word=$word&pagenum=$pagenum&search=$search&category=$category");
	}
}
//저장처리 process area end

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
<link href="WP/imercury/css/css.css" rel="stylesheet" type="text/css">
<link href="WP/imercury/css/style.css" rel="stylesheet" type="text/css">
<!--
<link href="<?=BOARDSKINPATH?>/css.css" rel="stylesheet" type="text/css">
<link href="<?=BOARDSKINPATH?>/style.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript">
//<![CDATA[
	function linkblur(){
		if (event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG")
			document.body.focus();
	}
	document.onfocusin=linkblur;

	function sub(){
	  f = document.form1;
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
//]]>
</script>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="form1" method="post" enctype="multipart/form-data">
  <input type="hidden" name="enc" value="enc<?=time()?>">
  <input type="hidden" name="code" value="<?=$code?>">
  <input type="hidden" name="url" value="<?=$PHP_SELF?>">
  <input type="hidden" name="no" value="<?=$no?>">
  <input type="hidden" name="mode" value="<?=$mode?>">
  <input type="hidden" name="old_file" value="<?=$info[file1]?>">
  <input type="hidden" name="old_rfile" value="<?=$info[rfile1]?>">
  <input type="hidden" name="ti" value="<?=$ti?>">
  <input type="hidden" name="co" value="<?=$co?>">
  <input type="hidden" name="word" value="<?=$word?>">
  <input type="hidden" name="pagenum" value="<?=$pagenum?>">
  <input type="hidden" name="search" value="<?=$search?>">
  <input type="hidden" name="notice" value="0" value="<?=$info[notice]?>">
  <tr>
    <td height="3" bgcolor="#94CCF4"></td>
  </tr>
<!--
<? if  ($HTTP_COOKIE_VARS[admin_id]) { ?>
  <tr>
    <td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="../<?=$skin?>/btn_img/bg02.gif">
        <tr>
          <td width="65" align="right">

<?
	$query1 = "select no,mname from model_tbl" ;
	$result1 = mysql_query($query1) ;

?>
				<select name="category">
                  <option value="title">선택하세요</option>
<? 	while( $b_row = @mysql_fetch_array($result1) ){
				$mname = $b_row[mname] ;
				echo "<option value='$mname'> $mname</option>" ;

?>
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
<? } ?>
-->
  <tr>
    <td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="../<?=$skin?>/btn_img/bg02.gif">
        <tr>
          <td width="65" align="right"><img src="../<?=$skin?>/btn_img/write_writer.gif" width="53" height="11"></td>
          <td width="250" style="padding-left:10"><input name="name" type="text" class="border08" size="20" value="<?=$name?>" readonly></td>
          <td width="66" align="right"><img src="../<?=$skin?>/btn_img/write_pass.gif" width="66" height="11"></td>
          <td style="padding-left:10"><input name="pwd" type="password" class="border08" size="10" value="<?=$pwd?>" readonly></td>
        </tr>
      </table></td>
  </tr>
<? if( auth_chked(3) ) { ?>
  <tr>
    <td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="../<?=$skin?>/btn_img/bg02.gif">
        <tr>
          <td width="65" align="right">공지기능</td>
          <td style="padding-left:10"><input type="radio" name="notice" value="1" style="border:0;">&nbsp;yes&nbsp;<input type="radio" name="notice" value="0" style="border:0;" checked>&nbsp;no</td>
        </tr>
      </table></td>
  </tr>
  <? } ?>
  <tr>
    <td class="border09"><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="../<?=$skin?>/btn_img/bg02.gif">
        <tr>
          <td width="65" align="right"><img src="../<?=$skin?>/btn_img/write_subject.gif" width="53" height="11"></td>
          <td style="padding-left:10"><input name="title" type="text" class="border08" size="60" value="<?=stripslashes($title)?>"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class="border09"><table width="100%" height="279" border="0" cellpadding="0" cellspacing="0" background="../<?=$skin?>/btn_img/bg03.gif">
        <tr>
          <td width="65" align="right" valign="top" style="padding-top:30"><img src="../<?=$skin?>/btn_img/write_body.gif" width="53" height="11"></td>
          <td valign="top" style="padding:7 0 0 10"><input type="checkbox" name="html_yn" style="border:0" value="Y" <?if($info[html_yn] == "Y") echo "checked";?>> html 사용<br><textarea name="contents" rows="18" class="border08" style="width:100%"><?=stripslashes($content)?></textarea></td>
        </tr>
      </table></td>
  </tr>

  <tr>
    <td><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="65" align="right"><img src="../<?=$skin?>/btn_img/write_file.gif" width="53" height="11"></td>
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
    <td align="center" style="padding:7 10 0 10"><img src="../<?=$skin?>/btn_img/bt_write.gif" width="56" height="23" onclick="sub()" style="cursor:hand">&nbsp;
      <img src="../<?=$skin?>/btn_img/bt_cancel.gif" width="56" height="23" onclick="history.back()" style="cursor:hand"></td>
  </tr>
</form>
</table>
