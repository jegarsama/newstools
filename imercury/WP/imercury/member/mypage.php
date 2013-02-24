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

		chkid = /^[a-zA-Z0-9]+[\-\_]*[a-z0-9]+$/;
		if(f.pwd.value == ""){
			alert('패스워드를 입력하세요');
			f.pwd.focus();
			return;
		}
		if(f.pwd.value.length < 4 || f.pwd.value.length > 13){
			alert('패스워드는 4자 이상 12자 이하로 입력해 주세요');
			f.pwd.focus();
			return;
		}
		if(f.pwd.value.search(chkid) == -1){
			alert('패스워드는 영문, 숫자조합으로 입력해 주세요');
			f.pwd.focus();
			return;
		}
		if(f.pwd.value != f.pwd2.value){
			alert('패스워드를 확인해주세요');
			f.pwd2.focus();
			return;
		}

		if(f.email1.value == ""){
			alert('이메일을 입력하세요');
			f.email1.focus();
			return;
		}
		if(f.email2.value == ""){
			alert('이메일을 입력하세요');
			f.email2.focus();
			return;
		}



		if(f.zip1.value == ""){
			alert('주소를 입력하세요');
			f.zip1.focus();
			return;
		}
		if(f.addr2.value == ""){
			alert('주소를 입력하세요');
			f.addr2.focus();
			return;
		}

		if(f.tel1.value == ""){
			alert('전화번호를 입력하세요');
			f.tel1.focus();
			return;
		}
		if(f.tel2.value == ""){
			alert('전화번호를 입력하세요');
			f.tel2.focus();
			return;
		}
		if(f.tel3.value == ""){
			alert('전화번호를 입력하세요');
			f.tel3.focus();
			return;
		}
		if(!IsNumber(f.tel1.value)){
			alert('전화번호에는 숫자만 입력하세요');
			f.tel1.focus();
			return;
		}
		if(!IsNumber(f.tel2.value)){
			alert('전화번호에는 숫자만 입력하세요');
			f.tel2.focus();
			return;
		}
		if(!IsNumber(f.tel3.value)){
			alert('전화번호에는 숫자만 입력하세요');
			f.tel3.focus();
			return;
		}
		 if(f.hp1.value == ""){
			alert('핸드폰번호를 입력하세요');
			f.hp1.focus();
			return;
		}
		if(f.hp2.value == ""){
			alert('핸드폰번호를 입력하세요');
			f.hp2.focus();
			return;
		}
		if(f.hp3.value == ""){
			alert('핸드폰번호를 입력하세요');
			f.hp3.focus();
			return;
		}
		if(!IsNumber(f.hp1.value)){
			alert('핸드폰번호에는 숫자만 입력하세요');
			f.hp1.focus();
			return;
		}
		if(!IsNumber(f.hp2.value)){
			alert('핸드폰번호에는 숫자만 입력하세요');
			f.hp2.focus();
			return;
		}
		if(!IsNumber(f.hp3.value)){
			alert('핸드폰번호에는 숫자만 입력하세요');
			f.hp3.focus();
			return;
		}
		f.submit();
	}


	function CheckEmail(str)
	{
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
		if (filter.test(str)) { return true; }
		else { return false; }
	}
	function getRadioValue(x) {
	   if(x.value == 1){
		 if(x.checked == true) return x.value;
		 return "";
	   }else
		{
		for(var i=0; i<x.length; i++)
		  if (x[i].checked==true) return x[i].value;

		  return "";
		}
	  }

	function IsNumber(num) {

		 for(var i=0; i<num.length; i++)
		 {
		   var chr = num.substr(i, 1);
		   if(chr<'0' || chr>'9')
		   {
			 return false;
		   }
		 }
		 return true;
	}
//]]>
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td><img src="<?=BOARDSKINPATH?>/images/data_banner2.gif"></td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table width="590" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>&nbsp;&nbsp;<font color="#FF0000">*</font> 필수 입력사항 입니다.</td>
				</tr>
				<tr>
					<td>
						<form name="form1" method="post">
						<input type="hidden" name="mode" value="req">
						<TABLE cellSpacing=0 cellPadding=0 width="90%" border=0>
						<TBODY>
							<TR>
								<TD bgColor=#089BA8 height=2></TD>
							</TR>
							<TR>
								<TD height=1></TD>
							</TR>
							<TR>
								<TD bgColor=#c1c1c1 height=1></TD>
							</TR>
							<TR>
								<TD align="center" bgcolor="FAFAFA">
									<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
										<TBODY>
										<TR>
											<TD bgColor=#ededed height=2></TD>
											<TD width="400"></TD>
										</TR>
										<TR>
											<TD width=131 height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> 아이디</span></TD>
											<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
												<?=$info[userid]?></span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
											<TD width=131 height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> </span>비밀번호</TD>
											<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
												<input type='password' class=text_style name="pwd" maxlength="50" size=15 value="<?=$info[pwd]?>"></span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
											<TD height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> </span>비밀번호확인</TD>
											<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
												<input type='password' class=text_style name="pwd2" maxlength="50" size=15 value="<?=$info[pwd]?>"></span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
											<TD height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> </span>비밀번호분실시질문</TD>
											<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10pt">
												<select name="pwd_q" class="select_style">
													<option value="">선택하세요</option>
													<option value="아버님 성함은?" <?if($info[pwd_q] == "아버님 성함은?") echo "selected";?>>아버님 성함은?</option>
													<option value="어머님 성함은?" <?if($info[pwd_q] == "어머님 성함은?") echo "selected";?>>어머님 성함은?</option>
													<option value="태어난 곳은?" <?if($info[pwd_q] == "태어난 곳은?") echo "selected";?>>태어난 곳은?</option>
													<option value="좋아하는 색깔은?" <?if($info[pwd_q] == "좋아하는 색깔은?") echo "selected";?>>좋아하는 색깔은?</option>
													<option value="어릴적 별명은?" <?if($info[pwd_q] == "어릴적 별명은?") echo "selected";?>>어릴적 별명은?</option>
													<option value="가보고 싶은곳은?" <?if($info[pwd_q] == "가보고 싶은곳은?") echo "selected";?>>가보고 싶은곳은?</option>
													<option value="애완동물 이름은?" <?if($info[pwd_q] == "애완동물 이름은?") echo "selected";?>>애완동물 이름은?</option>
													<option value="결혼 기념일은?" <?if($info[pwd_q] == "결혼 기념일은?") echo "selected";?>>결혼 기념일은?</option>
													<option value="가장 소중한 물건은?" <?if($info[pwd_q] == "가장 소중한 물건은?") echo "selected";?>>가장 소중한 물건은?</option>
												</select>
												</span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
											<TD width=131 height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> </span>답변</TD>
											<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 10px"><span style="padding-left:5pt">
												<input type="text" name="pwd_a" value="<?=$info[pwd_a]?>" size="40"></span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
											<TD height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> </span>성명</TD>
											<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
												<?=$info[name]?></span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
																										<TR>
																											<TD
																												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> </span>성별</TD>
																											<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
																												<INPUT TYPE="radio" NAME="sex" value="M" style="border:0;" <?if($info[sex] == "M") echo "checked";?>>남 &nbsp;&nbsp;
																												<INPUT TYPE="radio" NAME="sex" value="F" style="border:0;" <?if($info[sex] == "F") echo "checked";?>>여
																												</span></TD>
																										</TR>
																										<TR>
																											<TD bgColor=#ededed colSpan=2 height=1></TD>
																										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> 생년월일</span></TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
											<select name='bir_y' class=select_style>
											  <?
											  $bir = explode("-",$info[birthday]);
											  $year = $bir[0];
											  for($i=date("Y");$i>1900;$i--){
												if($year == $i) $a = "selected";
												else $a = "";
												?>
												<option value="<?=$i?>" <?=$a?>><?=$i?>년</option>
											  <?}?>
											</select>
											<select name='bir_m' class=select_style>
											  <?
											  $month = $bir[1];
											  for($i=1;$i<13;$i++){
												if($month == $i) $a = "selected";
												else $a = "";
												?>
												<option value="<?=$i?>" <?=$a?>><?=$i?>월</option>
											  <?}?>
											</select>
											<select name='bir_d' class=select_style>
											  <?
											  $day = $bir[2];
											  for($i=1;$i<32;$i++){
												if($day == $i) $a = "selected";
												else $a = "";
												?>
												<option value="<?=$i?>" <?=$a?>><?=$i?>일</option>
											  <?}?>
											</select>
											&nbsp;&nbsp;
											<input type="radio" name="bir_chk" value="양력" <?if($info[bir_chk] == "양력") echo "checked";?>>
											양력&nbsp;
											<input type="radio" name="bir_chk" value="음력" <?if($info[bir_chk] == "음력") echo "checked";?>>
											음력</span></TD>
										</TR>
										<TR>
										  <TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> 전화번호</span></TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
											<select name="tel1">
												<option selected value="02" <?if($info[tel1] == "02") echo "selected";?>>02</option>
												<option value="031" <?if($info[tel1] == "031") echo "selected";?>>031</option>
												<option value="032" <?if($info[tel1] == "032") echo "selected";?>>032</option>
												<option value="033" <?if($info[tel1] == "033") echo "selected";?>>033</option>
												<option value="041" <?if($info[tel1] == "041") echo "selected";?>>041</option>
												<option value="042" <?if($info[tel1] == "042") echo "selected";?>>042</option>
												<option value="043" <?if($info[tel1] == "043") echo "selected";?>>043</option>
												<option value="051" <?if($info[tel1] == "051") echo "selected";?>>051</option>
												<option value="052" <?if($info[tel1] == "052") echo "selected";?>>052</option>
												<option value="053" <?if($info[tel1] == "053") echo "selected";?>>053</option>
												<option value="054" <?if($info[tel1] == "054") echo "selected";?>>054</option>
												<option value="055" <?if($info[tel1] == "055") echo "selected";?>>055</option>
												<option value="061" <?if($info[tel1] == "061") echo "selected";?>>061</option>
												<option value="062" <?if($info[tel1] == "062") echo "selected";?>>062</option>
												<option value="063" <?if($info[tel1] == "063") echo "selected";?>>063</option>
												<option value="064" <?if($info[tel1] == "064") echo "selected";?>>064</option>
											</select>
											&nbsp;-&nbsp;
											<input type='text' class=text_style size=5 name="tel2" value="<?=$info[tel2]?>" >
											&nbsp;-&nbsp;
											<input type='text' class=text_style size=5 name="tel3" value="<?=$info[tel3]?>">
										  </span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> </span>휴대폰번호</TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
											<select name='hp1'>
												<option value='010' <?if($info[hp1] == "010") echo "selected";?>>010</option>
												<option value='011' <?if($info[hp1] == "011") echo "selected";?>>011</option>
												<option value='016' <?if($info[hp1] == "016") echo "selected";?>>016</option>
												<option value='017' <?if($info[hp1] == "017") echo "selected";?>>017</option>
												<option value='018' <?if($info[hp1] == "018") echo "selected";?>>018</option>
												<option value='019' <?if($info[hp1] == "019") echo "selected";?>>019</option>
											</select>
											&nbsp;-&nbsp;
											<input type='text' class=text_style size=5 name="hp2" value="<?=$info[hp2]?>">
											&nbsp;-&nbsp;
											<input type='text' class=text_style size=5 name="hp3" value="<?=$info[hp3]?>">
											</span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> 이메일</span></TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
											<input type='text' class=text_style name="email1" size=10  value="<?=$info[email1]?>">
											&nbsp;@&nbsp;
											<input type=text class=text_style name=email2  size=15  value="<?=$info[email2]?>">
											<select name="email_select" size=1  class="select_style" onChange="form1.email2.value=this.value">
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
										  </span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02"><font color="#FF0000">*</font> </span>주소</TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
											<input type = 'text' class=text_style size=3 name=zip1 readonly value="<?=$info[zip1]?>"> - <input type = 'text' class=text_style size=3 name=zip2 readonly value="<?=$info[zip2]?>">
											<img src="<?=BOARDSKINPATH?>/images/join_search.gif" width="90" height="19" border="0" align="absmiddle" onClick="window.open('/imercury/include/post_check.html','','width=401,height=430')" style="cursor:pointer"></span></TD>
										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px">&nbsp;</TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
											<input type = 'text' class=text_style name="addr1" size=50 readonly value="<?=$info[addr1]?>">
											&nbsp;&nbsp;
											<input type = 'text' class=text_style name="addr2" size=50 value="<?=$info[addr2]?>">
										  </span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ직업</span></TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
											<select name="job" size=1 class="select_style">
												<option value="">&nbsp;직업 선택해 주세요.</option>
												<option value="중고생" <?if($info[job] == "중고생") echo "selected";?>>중고생</option>
												<option value="대학생" <?if($info[job] == "대학생") echo "selected";?>>대학생</option>
												<option value="사무관리직" <?if($info[job] == "사무관리직") echo "selected";?>>사무관리직</option>
												<option value="영업직" <?if($info[job] == "영업직") echo "selected";?>>영업직</option>
												<option value="전산직" <?if($info[job] == "전산직") echo "selected";?>>전산직</option>
												<option value="인터넷관련직" <?if($info[job] == "인터넷관련직") echo "selected";?>>인터넷관련직</option>
												<option value="디자인/광고전문직" <?if($info[job] == "디자인/광고전문직") echo "selected";?>>디자인/광고전문직</option>
												<option value="기술직" <?if($info[job] == "기술직") echo "selected";?>>기술직</option>
												<option value="반도체기술직" <?if($info[job] == "반도체기술직") echo "selected";?>>반도체기술직</option>
												<option value="전문사무직" <?if($info[job] == "전문사무직") echo "selected";?>>전문사무직</option>
												<option value="교육직" <?if($info[job] == "교육직") echo "selected";?>>교육직</option>
												<option value="의료/보건" <?if($info[job] == "의료/보건") echo "selected";?>>의료/보건</option>
												<option value="문화/예술/스프츠" <?if($info[job] == "문화/예술/스프츠") echo "selected";?>>문화/예술/스프츠</option>
												<option value="대인/음식/기타서비스" <?if($info[job] == "대인/음식/기타서비스") echo "selected";?>>대인/음식/기타서비스</option>
												<option value="기타" <?if($info[job] == "기타") echo "selected";?>>기타</option>
											</select>
										  </span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ</span>가입경로</TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 15px">
											<select name="gaip_corse" class="select_style" onchange="if(this.value == '기타'){ gaip_tr.style.display=''; form1.ga.value=''; form1.ga.focus();}else{ gaip_tr.style.display='none';}">
												<option value="">선택하세요</option>
												<option value="친구 등 지인의 추천" <?if($info[gaip_corse] == "친구 등 지인의 추천") echo "selected";?>>친구 등 지인의 추천</option>
												<option value="온라인 보도기사/리뷰" <?if($info[gaip_corse] == "온라인 보도기사/리뷰") echo "selected";?>>온라인 보도기사/리뷰</option>
												<option value="신문(일간지)보도기사/리뷰" <?if($info[gaip_corse] == "신문(일간지)보도기사/리뷰") echo "selected";?>>신문(일간지)보도기사/리뷰</option>
												<option value="무과지 보도기사/리뷰/광고" <?if($info[gaip_corse] == "무과지 보도기사/리뷰/광고") echo "selected";?>>무과지 보도기사/리뷰/광고</option>
												<option value="온라인광고" <?if($info[gaip_corse] == "온라인광고") echo "selected";?>>온라인광고</option>
												<option value="인쇄매체(잡지제외)광고" <?if($info[gaip_corse] == "인쇄매체(잡지제외)광고") echo "selected";?>>인쇄매체(잡지제외)광고</option>
												<option value="TV광고" <?if($info[gaip_corse] == "TV광고") echo "selected";?>>TV광고</option>
												<option value="검색사이트" <?if($info[gaip_corse] == "검색사이트") echo "selected";?>>검색사이트</option>
												<option value="커뮤니티 사이트" <?if($info[gaip_corse] == "커뮤니티 사이트") echo "selected";?>>커뮤니티 사이트</option>
												<option value="기타 사이트" <?if($info[gaip_corse] == "기타 사이트") echo "selected";?>>기타 사이트</option>
												<option value="이벤트 행사" <?if($info[gaip_corse] == "이벤트 행사") echo "selected";?>>이벤트 행사</option>
												<option value="TTL존" <?if($info[gaip_corse] == "TTL존") echo "selected";?>>TTL존</option>
												<option value="기타" <?if($info[gaip_corse] == "기타") echo "selected";?>>기타</option>
											</select> <span id="gaip_tr" style="display:<?if($info[gaip_corse] == "기타") echo ""; else echo "none"?>"><input type="text" name="ga" value="<?=$info[ga]?>"></span>
										  </TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
										  <TD
												height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ</span>이메일수신동의</TD>
										  <TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span style="padding-left:10px;">
											<input type="radio" name="email_chk" value="Y" style="border:solid #FFFFFF 0px;background:FFFFFF;" <?if($info[email_chk] == "Y") echo "checked";?>>
											예
											<input type="radio" name="email_chk" value="N" style="border:solid #FFFFFF 0px;background:FFFFFF;" <?if($info[email_chk] == "N") echo "checked";?>>
											아니오
										  </span></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										<TR>
											<TD bgColor=#ededed colSpan=2 height=1></TD>
										</TR>
										</TBODY>
									</TABLE>
								</TD>
							</TR>
						</TBODY>
						</TABLE>
						</form>

						<table width="90%" height="100" border="0" cellpadding="5" cellspacing="0">
							<tr>
								<td align="right"><img src="<?=BOARDSKINPATH?>/images/icon_my_05.gif" onClick="sub(form1)" style="cursor:pointer"></td>
								<td><img src="<?=BOARDSKINPATH?>/images/icon_my_07.gif" onClick="form1.reset()" style="cursor:pointer"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>