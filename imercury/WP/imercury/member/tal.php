<?php
/**
 * Board Skin: 용도
 * 6.마이페이지 - 회원정보수정
**/

$sql = "select * from member_tbl where userid = '$_COOKIE[mid]'";
$info = $db->query($sql);
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

	function sub(f){
		if(f.name.value == ""){
			alert("이름을 입력하세요");
			f.name.focus();
			return;
		}
		if(f.uid.value == ""){
			alert("아이디를 입력하세요");
			f.uid.focus();
			return;
		}
		if(f.email1.value == ""){
			alert("이메일을 입력하세요");
			f.email1.focus();
			return;
		}
		if(f.email2.value == ""){
			alert("이메일을 입력하세요");
			f.email2.focus();
			return;
		}
		if(f.tel.value == ""){
			alert("연락처를 입력하세요");
			f.tel.focus();
			return;
		}
		if(f.contents.value == ""){
			alert("탈퇴사유를 입력하세요");
			f.contents.focus();
			return;
		}

		f.submit();
	}
//]]>
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td><img src="<?=BOARDSKINPATH?>/images/join_title.gif"></td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table width="590" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<form name="form1" method="post">
						<input type="hidden" name="mode" value="req">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td align=right width="63" bgcolor=#f7f7f7 height=20><strong>이 름</strong></td>
									<td width="590" bgcolor=#ffffff><input readonly value="<?=$info[name]?>" name="name_user"></td>
								</tr>
								<tr>
									<td align=right bgcolor=#f7f7f7 height=20><strong>아이디</strong></td>
									<td bgcolor=#ffffff><input readonly value="<?=$info[userid]?>" name=uid></td>
								</tr>
								<tr>
									<td align=right bgcolor=#f7f7f7 height=20><strong>메 일</strong></td>
									<td bgcolor=#ffffff><input class=text_style maxlength=45 size=10 value=funstory name=email1><input type='text' class=text_style name="email1" size=10 maxlength="45" value="<?=$info[email1]?>">
										&nbsp;@&nbsp;
										<input type=text class=text_style name=email2 size=15 maxlength="45" value="<?=$info[email2]?>">
										<select name="email_select" size=1 OnChange="form1.email2.value = this.value" class="select_style">
											<option value="">직접입력</option>
											<option value="chollian.net" <?if($info[email2] == "chollian.net") echo "selected";?>>chollian.net</option>
											<option value="dreamwiz.com" <?if($info[email2] == "dreamwiz.com") echo "selected";?>>dreamwiz.com</option>
											<option value="empal.com" <?if($info[email2] == "empal.com") echo "selected";?>>empal.com</option>
											<option value="freechal.com" <?if($info[email2] == "freechal.com") echo "selected";?>>freechal.com</option>
											<option value="hanafos.com" <?if($info[email2] == "hanafos.com") echo "selected";?>>hanafos.com</option>
											<option value="paran.com" <?if($info[email2] == "paran.com") echo "selected";?>>paran.com</option>
											<option value="hotmail.com" <?if($info[email2] == "hotmail.com") echo "selected";?>>hotmail.com</option>
											<option value="kebi.com" <?if($info[email2] == "kebi.com") echo "selected";?>>kebi.com</option>
											<option value="korea.com" <?if($info[email2] == "korea.com") echo "selected";?>>korea.com</option>
											<option value="lycos.co.kr" <?if($info[email2] == "lycos.co.kr") echo "selected";?>>lycos.co.kr</option>
											<option value="nate.com" <?if($info[email2] == "nate.com") echo "selected";?>>nate.com</option>
											<option value="naver.com" <?if($info[email2] == "naver.com") echo "selected";?>>naver.com</option>
											<option value="netian.com" <?if($info[email2] == "netian.com") echo "selected";?>>netian.com</option>
											<option value="unitel.com" <?if($info[email2] == "unitel.com") echo "selected";?>>unitel.com</option>
											<option value="yahoo.co.kr" <?if($info[email2] == "yahoo.co.kr") echo "selected";?>>yahoo.co.kr</option>
											<option value="hanmail.net" <?if($info[email2] == "hanmail.net") echo "selected";?>>hanmail.net</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align=right bgcolor=#f7f7f7 height=20><strong>연락처</strong></td>
									<td bgcolor=#ffffff><p><input value="<?=$info[tel1]?>-<?=$info[tel2]?>-<?=$info[tel3]?>" name=tel></p></td>
								</tr>
								<tr>
									<td align=right bgcolor=#f7f7f7 height=20><strong>탈퇴사유</strong></td>
									<td bgcolor=#ffffff><label><textarea class=Scrollbar--01 name=contents rows=25 cols=70></textarea></label></td>
								</tr>
							<tbody>
						</table>
						</form>

						<table width="90%" height="100" border="0" cellpadding="5" cellspacing="0">
							<tr bgcolor="#FFFFFF">
								<td align="right"><img src="<?=BOARDSKINPATH?>/images/img_btn22.gif" width="50" height="26" border="0" onClick="sub(form1)" style="cursor:pointer"></td>
								<td><img src="<?=BOARDSKINPATH?>/images/img_btn2.gif" width="50" height="26" border="0" onClick="history.back()" style="cursor:pointer"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>