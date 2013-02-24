<?php
/**
 * Board Skin: 용도
 * 6.마이페이지 - 회원가입 : 약관동의
**/
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

	function sub(){
		if(getRadioValue(form1.agree) == "N"){
			alert("이용약관에 동의를 하셔야 가입하실 수 있습니다.");
			return;
		}
		form1.submit();
	}

	function getRadioValue(x) {
		if(x.value == 1){
			if(x.checked == true) return x.value;
			return "";
		}
		else
		{
			for(var i=0; i<x.length; i++)
			if (x[i].checked==true) return x[i].value;

			return "";
		}
	}
//]]>
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center"><img src="<?=BOARDSKINPATH?>/images/com_img4.gif"></td>
	</tr>
	<tr>
		<td align="center"><img src="<?=BOARDSKINPATH?>/images/join_t03.gif" width="680" height="57"></td>
	</tr>
	<tr>
		<td align="center">
			<table width="590" border="0" cellpadding="0" cellspacing="5" bgcolor="E6E6E6" align="center">
				<tr>
					<td bgcolor="E7E7E7"><table width="590" border="0" cellspacing="0" cellpadding="10">
							<tr>
								<td bgcolor="#FFFFFF">
									<DIV style="border:1px dotted #D7D7BD; padding:9px; overflow-y:scroll; height:350px;">
									  <p align="center"><strong>이용약관</strong></p>
									  <br>
									  <span class="Font-Kor13Px"><strong>제1조(목적)</strong></span><br>
									  이 서비스 약관은 ㈜아이머큐리(이하 &quot;회사&quot;)가 운영하는 www.imercury.co.kr(이하 &quot;사이트&quot;)에서 제공하는 인터넷 관련 서비스(이하 &quot;서비스&quot;)를 이용함에 있어 이용자와 회사간의 권리·의무 및 책임사항을 규정함을 목적으로 합니다.
									  <p><span class="Font-Kor13Px"><strong>제2조(약관의 명시·설명 및 개정)</strong></span><br>
										1) &quot;회사&quot;는 이 약관의 내용을 이용자가 쉽게 알 수 있도록 서비스 화면에 게재하거나 이용자가 연결화면을 통하여 볼 수 있도록 합니다.<br>
										2) &quot;회사&quot;는 필요하다고 인정되는 경우 『정보통신망이용촉진및정보보호등에관한법률』 등 관련법을 위배하지 않는 범위에서 이 약관을 개정할 수 있으며, 약관을 개정한 경우에는 적용일자 및 개정사유를 명시하여 현행 약관과 함께 서비스 화면에 그 적용일자 7일전부터 적용일자 전일까지 공지합니다.다만, 이용자에게 불리하게 약관 내용을 변경하는 경우에는 최소한 30일 이상의 사전 유예기간을 두고 공지합니다.<br>
										3) &quot;회사&quot;가 약관을 개정할 경우에는 그 개정약관은 그 적용일자 이전에 회원 가입한 이용자에게도 적용되는 것을 원칙으로 합니다.<br>
										4) 이 약관에 명시되지 않은 사항에 대해서는 『정보통신망이용촉진및정보보호등에관한법률』 등에 관계 법령 및 회사가 정한 서비스의 세부이용지침 등의 규정에 따릅니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제3조(용어의 정의)</strong></span><br>
										1) 이 약관에서 사용하는 용어의 정의는 다음과 같습니다.<br>
										1. 이용자 : &quot;사이트&quot;에 접속하여 이 약관에 따라 &quot;서비스&quot;를 제공받는 자<br>
										2. 회원 : &quot;사이트&quot;에 개인정보를 제공하여 회원등록을 하고, ID(고유번호)와 Password(비밀번호)를 발급 받은자<br>
										3. ID(고유번호) : 회원 식별과 회원의 서비스 이용을 위하여 회원이 선정하고 회사가 승인하는 영문자와 숫자의 조합<br>
										4. PASSWORD(비밀번호) : 회원의 정보 보호를 위해 회원 자신이 설정한 문자와 숫자의 조합<br>
										5. 서비스 : 이용자에게 상품의 소개 및 안내, 유용한 각종 정보 및 업데이트를 할 수 있도록 구축한 인터넷 웹사이트를 접속하여 관련 정보를 이용하는 것<br>
										2) 이 약관에서 사용하는 용어의 정의는 제1항에서 정하는 것을 제외하고는 관계 법령 및 서비스별 안내에서 정하는 바에 의합니다.</p>
									  <p> </p>
									  <p><span class="Font-Kor13Px"><strong>제4조(회원가입)</strong></span><br>
										1) 이용자는 &quot;회사&quot;가 정한 가입 양식에 따라 회원정보를 기입한 후 &quot;위의 이용약관에 동의하십니까?&quot; 라는 이용 신청시의 물음에 &quot;동의&quot; 버튼을 누름으로써 회원가입을 신청합니다.<br>
										2) &quot;회사&quot;는 제1항에 의하여 회원가입을 신청한 이용자가 다음 각 호에 해당하지 않는 한 회원으로 등록합니다.<br>
										1. 기술상 서비스 제공이 불가능한 경우<br>
										2. 실명이 아니거나, 다른 사람의 명의사용 등 이용자 등록 시 허위로 신청하는 경우<br>
										3. 이용자 등록 사항을 누락하거나 오기하여 신청하는 경우<br>
										4. 사회의 안녕질서 또는 미풍양속을 저해하거나, 저해할 목적으로 신청한 경우<br>
										5. 기타 회사가 정한 이용신청 요건이 만족되지 않았을 경우<br>
										3) &quot;회사&quot;는 다음 각호의 기준으로 회원의 자격 및 권한 등을 세분하여, 회원의 자격에 따라 서비스 이용의 일부를 제한할 수 있습니다.<br>
										1. 구매회원 : &quot;회사&quot;의 제품을 구매한 회원<br>
										2. 일반회원 : 구매회원이 아닌 회원</p>
									  <p><span class="Font-Kor13Px"><strong>제5조(개인정보의 제공)</strong></span><br>
										1) 이용자는 회원가입 신청 시 서비스의 이용자 등록 화면에서 다음 사항을 가입신청 양식에 기록합니다.<br>
										1. 이름<br>
										2. ID(고유번호)<br>
										3. Password(비밀번호)<br>
										4. 주민등록번호<br>
										5. 주소<br>
										6. 일반전화번호<br>
										7. 이동전화번호<br>
										8. E-mail(전자우편) 주소<br>
										9. 제품번호<br>
										10. 기타 회사가 필요하다고 인정하는 사항<br>
										2) 회원은 회원가입 신청 시 기재한 사항이 변경되었을 경우 &quot;회사&quot;가 정한 별도의 양식 및 방법에 의하여 변경 사항을 수정하여야 합니다.<br>
									  </p>
									  <p><span class="Font-Kor13Px"><strong>제6조(서비스의 이용)</strong></span><br>
										1) 서비스의 이용은 연중무휴 1일 24시간을 원칙으로 합니다. 다만, 업무상이나 기술상의 이유로 서비스가 일시 중지되거나 &quot;사이트&quot;의 운영상의 목적으로 일정기간 서비스가 일시 중지될 수 있습니다.<br>
										2) &quot;회사&quot;는 서비스를 일정범위로 분할하여 각 범위 별로 이용 가능한 시간을 별도로 정할 수 있습니다.<br>
										3) 제1항 및 제2항에 의한 상황 발생시 &quot;회사&quot;는 가능한 방법으로 이용자에게 공지합니다. 다만, 회사가 통제할 수 없는 사유로 인한 서비스의 중단(운영자의 고의, 과실이 없는 디스크 장애, 시스템 다운 등)으로 인하여 공지가 불가능한 경우에는 그러하지 아니합니다.<br>
										4) &quot;회사&quot;는 서비스의 중지로 발생하는 문제에 대해서는 어떠한 책임도 지지 않습니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제7조(게시물 또는 내용물의 삭제)</strong></span><br>
										1) &quot;회사&quot;는 이용자가 게시하거나 전달하는 서비스 내의 모든 내용물(회원간 전달 포함)이 다음 각 호의 경우에 해당한다고 판단되는 경우 사전통지 없이 삭제할 수 있으며, 이에 대해 어떠한 책임도 지지 않습니다.<br>
										1. 회사, 다른 이용자 또는 제3자를 비방하거나 중상모략으로 명예를 손상시키는 내용인 경우<br>
										2. 공공질서 및 미풍양속에 위반되는 내용의 정보, 문장, 도형 등의 유포에 해당하는 경우<br>
										3. 범죄적 행위에 결부된다고 인정되는 내용인 경우<br>
										4. 회사의 저작권, 제3자의 저작권 등 기타 권리를 침해하는 내용인 경우<br>
										5. 제2항 소정의 세부이용지침을 통하여 회사에서 규정한 게시기간을 초과한 경우<br>
										6. &quot;사이트&quot;에서 제공하는 서비스와 관련 없는 내용인 경우<br>
										7. 불필요하거나 승인되지 않은 광고, 판촉물을 게재하는 경우<br>
										8. 기타 관계 법령 및 회사의 지침 등에 위반된다고 판단되는 경우<br>
										2) &quot;회사&quot;는 게시물에 관련된 세부 이용지침을 별도로 정하여 시행할 수 있으며, 이용자는 그 지침에 따라 각 종 게시물(회원간 전달 포함)을 등록하거나 삭제하여야 합니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제8조(게시물의 저작권)</strong></span><br>
										1) 이용자가 서비스 내에 게시한 게시물(이용자간 전달 포함)의 저작권을 포함한 모든 권리 및 책임은 이를 게시한 이용자에게 있으며 &quot;회사&quot;는 서비스 내에 이를 게시할 수 있는 권리를 갖습니다.<br>
										2) &quot;회사&quot;는 게시한 이용자의 동의 없이 게시물을 다른 목적으로 사용할 수 없습니다.<br>
										3) &quot;회사&quot;는 이용자가 서비스 내에 게시한 게시물이 타인의 저작권 등을 침해하더라도 이에 대한 민,형사상의 책임을 부담하지 않습니다. 만일 이용자가 타인의 저작권 등을 침해하였음을 이유로 회사가 타인으로부터 손해배상청구 등 이의 제기를 받은 경우 이용자는 회사의 면책을 위하여 노력하여야 하며, 회사가 면책되지 못한 경우 회원은 그로 인해 회사에 발생한 모든 손해를 부담하여야 합니다.<br>
										4) &quot;회사&quot;가 작성한 저작물에 대한 저작권은 &quot;회사&quot;에 귀속합니다.<br>
										5) 이용자는 서비스를 이용하여 얻은 정보를 가공, 판매하는 행위 등 서비스에 게재된 자료를 영리목적으로 이용하거나 제3자에게 이용하게 할 수 없으며, 게시물에 대한 저작권 침해는 관계 법령의 적용을 받습니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제9조(&quot;회사&quot;의 의무)</strong></span><br>
										1) &quot;회사&quot;는 특별한 사정이 없는 한 회원이 서비스 이용을 신청한 날에 서비스를 이용할 수 있도록 합니다.<br>
										2) &quot;회사&quot;는 서비스 제공과 관련하여 알고 있는 회원의 신상정보를 본인의 승낙 없이 제3자에게 누설, 배포하지 않습니다. 단, 관계법령에 의한 수사상의 목적으로 관계기관으로부터 요구 받은 경우나 정보통신윤리위원회의 요청이 있는 경우 등 법률의 규정에 따른 적법한 절차에 의한 경우에는 그러하지 않습니다.<br>
										3) &quot;회사&quot;는 서비스와 관련한 회원의 불만사항이 접수되는 경우 이를 신속하게 처리하여야 하며, 신속한 처리가 곤란한 경우 그 사유와 처리 일정을 서비스 화면에 게재하거나 e-mail 등을 통하여 동 회원에게 통지합니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제10조(이용자의 의무)</strong></span><br>
										1) 이용자는 서비스를 이용할 때 다음 각 호의 행위를 하여서는 아니 됩니다.<br>
										1. 신청 또는 변경시 허위 내용의 등록<br>
										2. 타인의 정보 도용<br>
										3. &quot;사이트&quot;에 게시된 정보의 변경<br>
										4. &quot;회사&quot;가 정한 정보 이외의 정보(컴퓨터 프로그램 등) 등의 송신 또는 게시<br>
										5. &quot;회사&quot; 기타 제3자의 저작권 등 지적재산권에 대한 침해<br>
										6. &quot;회사&quot; 기타 제3자의 명예를 손상시키거나 업무를 방해하는 행위<br>
										7. 서비스와 관련된 설비의 오동작이나 정보 등의 파괴 및 혼란을 유발시키는 컴퓨터 바이러스 감염 자료를 등록 또는 유포하는 행위<br>
										8. 서비스 운영을 고의로 방해하거나 서비스의 안정적 운영을 방해할 수 있는 정보 및 수신자의 명시적인 수신거부의사에 반하여 광고성 정보를 전송하는 행위<br>
										9. 외설 또는 폭력적인 메시지, 화상, 음성, 기타 공서양속에 반하는 정보를 &quot;회사&quot;에 공개 또는 게시하는 행위<br>
										10. 다른 회원의 개인정보를 수집, 저장, 공개하는 행위<br>
										11. 기타 불법적이거나 부당한 행위 <br>
										2) 이용자는 관계 법령, 본 약관의 규정, 이용안내 및 서비스상에 공지한 주의사항, &quot;회사&quot;가 통지하는 사항 등을 준수하여야 하며, 기타 &quot;회사&quot;의 업무에 방해되는 행위를 하여서는 아니 됩니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제11조(회원ID(고유번호)와 PASSWORD(비밀번호) 관리에 대한 의무와 책임)</strong></span><br>
										1) 회원은 회원 ID(고유번호) 및 Password(비밀번호) 관리를 철저히 하여야 합니다.<br>
										2) 회원 ID(고유번호)와 Password(비밀번호)의 관리 소홀, 부정 사용에 의하여 발생하는 모든 결과에 대한 책임은 회원 본인에게 있으며, &quot;사이트&quot;의 시스템 고장 등 &quot;회사&quot;의 책임 있는 사유로 발생하는 문제에 대해서는 회사가 책임을 집니다.<br>
										3) 회원은 본인의 ID(고유번호) 및 Password(비밀번호)를 제3자에게 이용하게 해서는 안되며, 회원 본인의 ID(고유번호) 및 Password(비밀번호)를 도난 당하거나 제3자가 사용하고 있음을 인지하는 경우에는 바로 &quot;회사&quot;에 통보하고 &quot;회사&quot;의 안내가 있는 경우 그에 따라야 합니다.<br>
										4) 회원의 ID(고유번호)는 &quot;회사&quot;의 사전 동의 없이 변경할 수 없습니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제12조(회원에 대한 통지)</strong></span><br>
										1) 회원에 대한 통지를 하는 경우 &quot;회사&quot;는 회원이 등록한 e-mail 주소 또는 SMS 등으로 할 수 있습니다.<br>
										2) &quot;회사&quot;는 불특정 다수 회원에 대한 통지의 경우 서비스 게시판 등에 게시함으로써 개별 통지에 갈음할 수 있습니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제13조(이용자의 개인정보보호)</strong></span><br>
										&quot;회사&quot;는 관련법령이 정하는 바에 따라서 회원 등록정보를 포함한 회원의 개인정보를 보호하기 위하여 노력합니다. 회원의 개인정보보호에 관해서는 관련법령 및 회사가 정하는 &quot;개인정보보호정책&quot; 에 정한 바에 의합니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제14조(이용제한)</strong></span><br>
										1) 회원이 회원가입을 해지하고자 할 경우에는 본인이 사이트 상에서 또는 회사가 정한 별도의 이용방법으로 &quot;사이트&quot;에 해지신청을 하여야 합니다.<br>
										2) &quot;회사&quot;는 회원이 제10조에 규정한 이용자의 의무를 이행하지 않을 경우 사전 통지 없이 서비스 이용을 중지할 수 있습니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제15조(손해배상 등)</strong></span><br>
										1) 회원이 본 약관의 규정을 위반함으로 인하여 회사에 손해가 발생하게 되는 경우, 이 약관을 위반한 회원은 회사에 발생하는 모든 손해를 배상하여야 합니다.<br>
										2) &quot;회사&quot;는 회원이 서비스를 이용하여 기대하는 수익을 상실한 것에 대하여 책임을 지지 않으며 그 밖에 서비스를 통하여 얻은 자료로 인한 손해 등에 대하여도 책임을 지지 않습니다.</p>
									  <p><span class="Font-Kor13Px"><strong>제16조(분쟁해결)</strong></span><br>
										1) 서비스 이용과 관련하여 &quot;회사&quot;와 회원 사이에 분쟁이 발생한 경우, &quot;회사&quot;와 회원은 분쟁의 해결을 위해 성실히 협의합니다.<br>
										2) 본 조 제1항의 협의에서도 분쟁이 해결되지 않을 경우 양 당사자는 민사소송법상의 관할법원에 소를 제기할 수 있습니다.<br></p>
									</DIV>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table width="680" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<tr>
					<td align="center">
						<form name="form1" method="post">
						<input type="hidden" name="mode" value="step2">
						<table>
							<tr>
								<td width="88" height=50 align="right"> <input name="agree" type="radio" value="Y" checked> 동의함</td>
								<td width="100"> <input name="agree" type="radio" value="N"> 동의안함</td>
							</tr>
							<tr>
								<td align="center"><img src="<?=BOARDSKINPATH?>/images/login_btn5.gif" border="0" onClick="sub();" style="cursor:pointer"></td>
								<td align="center"><img src="<?=BOARDSKINPATH?>/images/login_btn6.gif" border="0" style="cursor:pointer" onClick="location.href='/'"></td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>