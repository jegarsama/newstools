<?php
/**
 * Login Form 용도
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );
?>
<script type="text/javascript">
//<![CDATA[
function sub(){
	if(form1.userid.value == ""){
		alert("아이디를 입력하세요");
		form1.userid.focus();
		return;
	}
	if(form1.pwd.value == ""){
		alert("패스워드를 입력하세요");
		form1.pwd.focus();
		return;
	}
	form1.submit();
}
//]]>
</script>

<table width="680" border="0" cellpadding="0" cellspacing="0" background="<?=BOARDSKINPATH?>/images/sub_body_bg.gif">
	<tr>
		<td><img src="<?=BOARDSKINPATH?>/images/top_login.gif"></td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<form name="form1" method="post">
			<input type="hidden" name="mode" value="login" />
			<input type="hidden" name="r_url" value="<?=$_GET[r_url]?><?=$_GET[etc_url]?>" />
			<table width="608" height="281" border="0" cellspacing="0" cellpadding="0" background="<?=BOARDSKINPATH?>/images/login_bg.gif">
				<tr>
					<td width="243" rowspan="2" align="right" valign="middle"><img src="<?=BOARDSKINPATH?>/images/login_img.gif" width="212" height="217"></td>
					<td width="240" height="159" valign="bottom"><img src="<?=BOARDSKINPATH?>/images/login_txt.gif" width="240" height="139"></td>
					<td width="125"></td>
				</tr>
				<tr valign="top">
					<td><table background="<?=BOARDSKINPATH?>/images/login_bg2.gif" width="240" height="60">
							<tr>
								<td></td>
								<td width="156" align="left" valign="middle"><input name="userid" type="text" size="19" /></td>
							</tr>
							<tr>
								<td></td>
								<td align="left"><input name="pwd" type="password" size="20" onKeyDown="if(event.keyCode == 13) sub();" /></td>
							</tr>
						</table></td>
					<td><img src="<?=BOARDSKINPATH?>/images/login_btn.gif" width="88" height="60" border="0" onClick="sub();" style="cursor:pointer;" /></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td height="150">&nbsp;</td>
	</tr>
</table>