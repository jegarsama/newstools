<?php
/**
 * ID/Password 찾기 Form 용도
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );
?>
<script type="text/javascript">
//<![CDATA[
	function sub(){
		if(form1.name_user.value == ""){
			alert("이름을 입력하세요");
			form1.name_user.focus();
			return;
		}
		if(form1.email1.value == ""){
			alert('이메일을 입력하세요');
			form1.email1.focus();
			return;
		}
		if(form1.email2.value == ""){
			alert('이메일을 입력하세요');
			form1.email2.focus();
			return;
		}
		form1.submit();
	}

	function sub2(){
		if(form2.userid.value == ""){
			alert("아이디를 입력하세요");
			form2.userid.focus();
			return;
		}
		if(form2.name_user.value == ""){
			alert("이름을 입력하세요");
			form2.name_user.focus();
			return;
		}
		if(form2.pwd_q.value == ""){
			alert("질문을 선택하세요");
			form2.pwd_q.focus();
			return;
		}
		if(form2.pwd_a.value == ""){
			alert("답변을 입력하세요");
			form2.pwd_a.focus();
			return;
		}
		form2.submit();
	}
//]]>
</script>

<table width="680" border="0" cellpadding="0" cellspacing="0" background="<?=BOARDSKINPATH?>/images/sub_body_bg.gif">
	<tr>
		<td><img src="<?=BOARDSKINPATH?>/images/top_login3.gif"></td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table width="90%" border="0" cellspacing="0" cellpadding="1">
				<tr>
					<td><img src="/imercury/images/mypage/join_id.gif" width="143" height="25"></td>
				</tr>
			</table>
			<TABLE cellSpacing=0 cellPadding=0 width="90%" border=0>
				<TR>
					<TD bgColor=#437e9b height=2></TD>
				</TR>
				<TR>
					<TD height=1></TD>
				</TR>
				<TR>
					<TD bgColor=#c1c1c1 height=1></TD>
				</TR>
				<TR>
					<TD align="center" bgcolor="FAFAFA">
						<!-- 검색결과 출력용 iframe -->
						<iframe id="board" name="board" marginHeight='0' marginWidth='0' frameborder='0' scrolling="no" width="100%" height="0"></iframe>

						<form name="form1" method="post" target="board">
						<input type="hidden" name="mode" value="uid" />
						<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
						<TBODY>
							<TR>
								<TD bgColor=#ededed height=2></TD>
								<TD width="400"></TD>
							</TR>
							<TR>
								<TD width=131 height=30 bgColor=#f7f7f7 style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ이름</span></TD>
								<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><input type = 'text' class=text_style name="name_user" maxlength=12 size=15></TD>
							</TR>
							<TR>
								<TD bgColor=#ededed colSpan=2 height=1></TD>
							</TR>
							<TR>
								<TD width=131 height=30 bgColor=#f7f7f7 style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ</span>이메일</TD>
								<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><input type='text' class=text_style name="email1" size=10 maxlength="45">
									&nbsp;@&nbsp;
									<input type=text class=text_style name=email2 size=15 maxlength="45">
									<select name="email_select" size=1  class="select_style" onChange="form1.email2.value=this.value">
									  <option value="">직접입력</option>
									  <option value="chollian.net">chollian.net</option>
									  <option value="dreamwiz.com">dreamwiz.com</option>
									  <option value="empal.com">empal.com</option>
									  <option value="freechal.com">freechal.com</option>
									  <option value="hanafos.com">hanafos.com</option>
									  <option value="paran.com">paran.com</option>
									  <option value="hotmail.com">hotmail.com</option>
									  <option value="kebi.com">kebi.com</option>
									  <option value="korea.com">korea.com</option>
									  <option value="lycos.co.kr">lycos.co.kr</option>
									  <option value="nate.com">nate.com</option>
									  <option value="naver.com">naver.com</option>
									  <option value="netian.com">netian.com</option>
									  <option value="unitel.com">unitel.com</option>
									  <option value="yahoo.co.kr">yahoo.co.kr</option>
									  <option value="hanmail.net">hanmail.net</option>
									</select>
								  </span></TD>
							</TR>
						</TBODY>
						</TABLE>
						</form>

					</TD>
				</TR>
			</TABLE>
			<table width="90%" height="40" border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td align="right"><img src="<?=BOARDSKINPATH?>/images/login_btn5.gif" width="62" height="23" onClick="sub()" style="cursor:pointer"></td>
					<td><img src="<?=BOARDSKINPATH?>/images/login_btn6.gif" width="62" height="23" onClick="form1.reset()" style="cursor:pointer"></td>
				</tr>
			</table>



			<table width="90%" border="0" cellspacing="0" cellpadding="1">
				<tr>
					<td><img src="/imercury/images/mypage/join_pw.gif" width="143" height="25"></td>
				</tr>
				<tr>
					<td class="Font-Eng12Px ">&nbsp;비밀번호는 가입하신 이메일 주소로 발송됩니다. </td>
				</tr>
			</table>
			<TABLE cellSpacing=0 cellPadding=0 width="90%" border=0>
				<TBODY>
				<TR>
					<TD bgColor=#437e9b height=2></TD>
				</TR>
				<TR>
					<TD height=1></TD>
				</TR>
				<TR>
					<TD bgColor=#c1c1c1 height=1></TD>
				</TR>
				<TR>
					<TD align="center" bgcolor="FAFAFA">

						<form name="form2" method="post" target="board">
						<input type="hidden" name="mode" value="pass" />
						<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
							<TR>
								<TD bgColor=#ededed height=2></TD>
								<TD width="400"></TD>
							</TR>
							<TR>
								<TD width=131 height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ아이디</span></TD>
								<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><input type = 'text' class=text_style name = "userid" maxlength=12 size=15></TD>
							</TR>
							<TR>
								<TD bgColor=#ededed colSpan=2 height=1></TD>
							</TR>
							<TR>
								<TD height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ</span>이름</TD>
								<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><input name="name_user" type="text" size="15" maxlength="12"></TD>
							</TR>
							<TR>
								<TD bgColor=#ededed colSpan=2 height=1></TD>
							</TR>
							<TR>
								<TD height=30 bgColor=#f7f7f7 style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ</span>비밀번호분실시질문</TD>
								<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px">
									<select name="pwd_q" class="select_style">
										<option value="" selected>선택하세요</option>
										<option value="아버님 성함은?">아버님 성함은?</option>
										<option value="어머님 성함은?">어머님 성함은?</option>
										<option value="태어난 곳은?">태어난 곳은?</option>
										<option value="좋아하는 색깔은?">좋아하는 색깔은?</option>
										<option value="어릴적 별명은?">어릴적 별명은?</option>
										<option value="가보고 싶은곳은?">가보고 싶은곳은?</option>
										<option value="애완동물 이름은?">애완동물 이름은?</option>
										<option value="결혼 기념일은?">결혼 기념일은?</option>
										<option value="가장 소중한 물건은?">가장 소중한 물건은?</option>
									</select>
								</TD>
							</TR>
							<TR>
								<TD bgColor=#ededed colSpan=2 height=1></TD>
							</TR>
							<TR>
								<TD height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ</span>답변</TD>
								<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><input name="pwd_a" type="text" size="15" maxlength="25"></TD>
							</TR>
							<TR>
								<TD bgColor=#ededed colSpan=2 height=1></TD>
							</TR>
							<TR>
								<TD bgColor=#ededed colSpan=2 height=1></TD>
							</TR>
						</TABLE>
						</form>

					</TD>
				</TR>
			</TABLE>
			<table width="90%" height="50" border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td align="right"><img src="<?=BOARDSKINPATH?>/images/login_btn5.gif"width="62" height="23" onClick="sub2()" style="cursor:pointer"></td>
					<td><img src="<?=BOARDSKINPATH?>/images/login_btn6.gif" width="62" height="23" onClick="form2.reset()" style="cursor:pointer"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>