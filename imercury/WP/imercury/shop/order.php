<?php
/**
 * Board Skin: 용도
 * 8.쇼핑하기 - 주문하기
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );

if($_COOKIE[mid]){
	$sql = "select * from member_tbl where userid = '$_COOKIE[mid]'";
	$info = $db->query($sql);
}
?>
<script type="text/javascript">
//<![CDATA[
	function sub(){
		f = document.form1;
		if(f.name.value == ""){
			alert("이름을 입력하세요");
			f.name.focus();
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
		if(f.zip1.value == ""){
			alert("주소를 입력하세요");
			f.zip1.focus();
			return;
		}
		if(f.addr2.value == ""){
			alert("주소를 입력하세요");
			f.addr2.focus();
			return;
		}
		f.submit();
	}
//]]>
</script>
<table width="680" border="0"  cellpadding="0" cellspacing="0" >
	<tr>
		<td align="center"><img src="<?=BOARDSKINPATH?>/images/shop_title.gif"></td>
	</tr>
	<tr>
		<td height="575" align="center" valign="top">
			<table width="680" border="0" cellspacing="0" cellpadding="3">
				<tr bgcolor="#FFFFFF">
					<td align="center"><br>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
							<TBODY>
							<TR>
								<TD bgColor=#3aa9c1 height=2></TD>
							</TR>
							<TR>
								<TD height=1></TD>
							</TR>
							<TR>
								<TD bgColor=#c1c1c1 height=1></TD>
							</TR>
							<TR>
								<TD bgcolor="CBCBCB">
									<form name="form1" method="post">
									<input type="hidden" name="mode" value="req" />
									<input type="hidden" name="gname" value="<?=$_GET[gname]?>">
									<input type="hidden" name="price" value="<?=$_GET[price]?>">
									<table width="100%" border="0" cellspacing="1" cellpadding="6">
										<tr>
											<td height="20" align="right" bgcolor="#f7f7f7"><strong>제품명</strong></td>
											<td bgcolor="#FFFFFF"><p>&nbsp;<?=$_GET[gname]?></p></td>
										</tr>
										<tr>
											<td height="20" align="right" bgcolor="#f7f7f7"><strong>판매가</strong></td>
											<td bgcolor="#FFFFFF"><p>&nbsp;<?=number_format($_GET[price])?>원</p></td>
										</tr>
										<tr>
											<td width="22%" height="20" align="right" bgcolor="#f7f7f7"><strong>이 름</strong></td>
											<td bgcolor="#FFFFFF"><input type="text" name="name_user" value="<?=$info[name]?>" readonly></td>
										</tr>
										<tr>
											<td height="20" align="right" bgcolor="#f7f7f7"><strong>메 일</strong></td>
											<td bgcolor="#FFFFFF"><input type='text' class=text_style name="email1" size=10 maxlength="45" value="<?=$info[email1]?>">
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
											<td height="20" align="right" bgcolor="#f7f7f7"><strong>핸드폰</strong></td>
											<td bgcolor="#FFFFFF"><p><input type="text" name="tel" value="<?=$info[tel1]?>-<?=$info[tel2]?>-<?=$info[tel3]?>"></p></td>
										</tr>
										<tr>
											<td height="20" align="right" bgcolor="#f7f7f7"><strong>주 소</strong></td>
											<td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td><input type = 'text' class=text_style size=8 name=zip1 readonly value="<?=$info[zip1]?>"> - <input type = 'text' class=text_style size=8 name=zip2 readonly value="<?=$info[zip2]?>">
															<img src="/imercury/images/customer/join_search.gif" width="90" height="19" border="0" align="absmiddle" onClick="window.open('../include/post_check.html','','width=401,height=430')" style="cursor:pointer">
														</td>
													</tr>
													<tr>
														<td><input type = 'text' class=text_style name="addr1" size=50 readonly value="<?=$info[addr1]?>">
															<input type = 'text' class=text_style name="addr2" size=50 value="<?=$info[addr2]?>">
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="20" align="right" bgcolor="#f7f7f7"><strong>문의사항</strong></td>
											<td bgcolor="#FFFFFF"><label>
												<textarea name="contents" cols="70" rows="25" class="Scrollbar--01">
	※ 제품가격 및 택배비 입금계좌는 기업은행 390-033512-04-020
	예금주 (주)아이머큐리이며 4시 전에 입금 확인하여 입금된 건에 대해
	당일 처리됩니다.

	※ 제품대금이 5만원 이상일 경우에는 택배비가 무료이며 5만원 이하일
	경우에 입금 시 택배비를 2500원 별도로 입금하셔야 합니다.
	주문이 여러 건일 경우에는 비고란에 적어주시고 한번만
	입금하시면 됩니다. 택배비 미 입금 시에는 착불 배송 되오니
	이점 착오 없으시기 바랍니다.
	(기본 택배비 이외에 항공/선박 도선료는 고객 부담입니다.)

	※ 상품주문 시 아래 사항이 없거나 잘못 기재된 경우 배송이 지연되거나
	오배송될 수 있으니 정확하게 기재해 주시기 바랍니다.


	▶사용모델:


	▶입금일자:

	▶입금금액:

	▶입금자명:

	▶주소변경신청 및 기타:




												</textarea>
											</label></td>
										</tr>
									</table>
									</form>
								</TD>
							</TR>
							</TBODY>
						</TABLE>
					</td>
				</tr>
			</table>
			<table width="680" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF">
				<tr>
					<td align="right"><img src="<?=BOARDSKINPATH?>/images/img_btn22.gif" width="50" height="26" border="0" onClick="sub()" style="cursor:pointer"></td>
					<td><img src="<?=BOARDSKINPATH?>/images/img_btn2.gif" width="50" height="26" border="0" onClick="history.back()" style="cursor:pointer"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50">
		</td>
	</tr>
</table>