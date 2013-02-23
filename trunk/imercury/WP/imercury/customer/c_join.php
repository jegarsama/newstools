<?php
/**
 * Board Skin: 용도
 * 4.고객지원 – 제품인증
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );
require_once( NEW_IMERCURY_DIR . '/include/paging_class.php' );
?>
<script type="text/javascript">
//<![CDATA[
	function sno_chk(){
	  if(form1.model_no.value == ""){
		alert("제품이름을 선택하세요");
		form1.model_no.focus();
		return;
	  }
	  if(form1.barcode.value == ""){
		alert("바코드번호를 입력하세요");
		form1.barcode.focus();
		return;
	  }
	  window.open("/imercury/include/id_chk.html?mno="+form1.model_no.value+"&barcode="+form1.barcode.value,"SSS","width=300,height=120");
	}

	function sno_chk2(num){
	  if(form1.model_no.value == ""){
		alert("제품이름을 선택하세요");
		form1.model_no.focus();
		return;
	  }
	   if(form1.barcode.value == ""){
		alert("바코드번호를 입력하세요");
		form1.barcode.focus();
		return;
	  }
	  if(form1.s_no1.value == ""){
		alert("맵번호를 선택하세요");
		form1.s_no1.focus();
		return;
	  }
	  if(form1.s_no2.value == ""){
		alert("맵번호를 선택하세요");
		form1.s_no2.focus();
		return;
	  }
	  if(form1.s_no3.value == ""){
		alert("맵번호를 선택하세요");
		form1.s_no3.focus();
		return;
	  }
	  if(form1.s_no4.value == ""){
		alert("맵번호를 선택하세요");
		form1.s_no4.focus();
		return;
	  }

		if (num==1) {
		window.open("/imercury/include/id_chk2.html?barcode="+form1.barcode.value+"&mno="+form1.model_no.value+"&s_no1="+form1.s_no1.value+"&s_no2="+form1.s_no2.value+"&s_no3="+form1.s_no3.value+"&s_no4="+form1.s_no4.value+"&barcode="+form1.barcode.value,"SSS","width=300,height=120");

		} else {
		window.open("/imercury/include/id_chk3.html?barcode="+form1.barcode.value+"&mno="+form1.model_no.value+"&s_no1="+form1.s_no1.value+"&s_no2="+form1.s_no2.value+"&s_no3="+form1.s_no3.value+"&s_no4="+form1.s_no4.value+"&barcode="+form1.barcode.value,"SSS","width=300,height=120");
		}

	}

	function sub(num){
	  if(form1.model_no.value == ""){
		alert("제품이름을 선택하세요");
		form1.model_no.focus();
		return;
	  }
	  if(form1.barcode.value == ""){
		alert("일련번호를 입력하세요");
		form1.barcode.focus();
		return;
	  }
			if (num==1) {
				  if(form1.id_check.value != 1){
					alert("일련번호 중복확인을 해주세요");
					return;
				  }
			}

	  if(form1.s_no1.value == ""){
		alert("맵번호를 입력하세요");
		form1.s_no1.focus();
		return;
	  }
	  if(form1.s_no2.value == ""){
		alert("맵번호를 입력하세요");
		form1.s_no2.focus();
		return;
	  }
	  if(form1.s_no3.value == ""){
		alert("맵번호를 입력하세요");
		form1.s_no3.focus();
		return;
	  }
	  if(form1.s_no4.value == ""){
		alert("맵번호를 입력하세요");
		form1.s_no4.focus();
		return;
	  }
	  if(form1.id_check2.value != 1){
		alert("맵번호 중복확인을 해주세요");
		return;
	  }
	  if(form1.year.value == ""){
		alert("구입연도를 선택하세요");
		form1.year.focus();
		return;
	  }
	  if(form1.month.value == ""){
		alert("구입월을 선택하세요");
		form1.month.focus();
		return;
	  }
	  if(form1.area1.value == ""){
		alert("제품구입처를 선택하세요");
		form1.area1.focus();
		return;
	  }
	  if(form1.area2.value == ""){
		alert("제품구입처를 입력하세요");
		form1.area2.focus();
		return;
	  }
	  form1.submit();

	}
//]]>
</script>
<table width="680" border="0"  cellpadding="0" cellspacing="0" >
	<tr>
		<td align="center"><img src="/imercury/images/customer/join_top.gif" width="680" ></td>
	</tr>
	<tr>
		<td align="center"><img src="/imercury/images/customer/join_banner.gif" width="680" ></td>
	</tr>
	<tr>
		<td>
			<table align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="680"  height="600" align='center' bgcolor="#FFFFFF">
						<table width="100%" border="0" cellspacing="0" cellpadding="1">
							<tr>
								<td width="6%" height="29">&nbsp;</td>
								<td width="94%"><img src="/imercury/images/in_title02.gif" width="88" height="18"></td>
							</tr>
						</table><?

							$sql = "select * from good_reg where userid = '$_COOKIE[mid]'";
							$info = $db->querys($sql);

							if(count($info) == 0) {
								?>
								<TABLE cellSpacing="0" cellPadding="0" width="600" border="0">
									<TBODY>
										<TR>
											<TD height=30>&nbsp;제품 인증내역이 없습니다.</TD>
										</TR>
									</TBODY>
								</TABLE>
								<br><?
							} else {
								for($i=0;$i<count($info);$i++){
									$sql = "select mname from model_tbl where no = '".$info[$i][model_no]."'";
									$mname = $db->query_one($sql);
									?>
									<TABLE cellSpacing=0 cellPadding=0 width="600" align="center" border=0>
										<TBODY>
											<TR>
												<TD bgColor=#c1c1c1 height=1 colspan="2"></TD>
											</TR>
											<TR>
												<TD bgColor=#ededed height=2></TD>
												<TD width="417"></TD>
											</TR>
											<TR>
												<TD width=114 height=30 bgColor=#f7f7f7 style="PADDING-LEFT: 5px"><span
													class="member_txt_02">ㆍ제품이름</span></TD>
												<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><?=$mname?> </span></TD>
											</TR>
											<TR>
												<TD bgColor=#ededed colSpan=2 height=1></TD>
											</TR>
											<TR>
												<TD width=114 height=30 bgColor=#f7f7f7 style="PADDING-LEFT: 5px"><span
													class="member_txt_02">ㆍ제품번호</span></TD>
												<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px">일련번호 : <?=$mname?>-<?=$info[$i][barcode]?><br>
												맵번호 : <?=$info[$i][s_no]?></TD>
											</TR>
											<TR>
												<TD bgColor=#ededed colSpan=2 height=1></TD>
											</TR>
											<TR>
												<TD width=114 height=30 bgColor=#f7f7f7 style="PADDING-LEFT: 5px"><span
													class="member_txt_02">ㆍ구입년도/월</span></TD>
												<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><?=$info[$i][year]?>년
												<?=$info[$i][month]?>월</TD>
											</TR>
											<TR>
												<TD bgColor=#ededed colSpan=2 height=1></TD>
											</TR>
											<TR>
												<TD height=30 bgColor=#f7f7f7 style="PADDING-LEFT: 5px"><span
													class="member_txt_02">ㆍ제품구입처</span></TD>
												<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><?=$info[$i][area1]?>
												</span></TD>
											</TR>
											<TR>
												<TD height=30 bgColor=#f7f7f7 style="PADDING-LEFT: 5px">&nbsp;</TD>
												<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><?=$info[$i][area2]?>
												</TD>
											</TR>
											<TR>
												<TD bgColor=#ededed colSpan=2 height=1></TD>
											</TR>
											<TR>
												<TD bgColor=#ededed colSpan=2 height=1></TD>
											</TR>

										</TBODY>
									</TABLE>
									<br><?
								}
							}
								?>

						<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
							<tr>
								<td width="6%">&nbsp;</td>
								<td width="94%"><img src="/imercury/images/in_title03.gif" width="88" height="18"></td>
							</tr>
						</table>
						<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
							<tr>
								<td bgcolor="E7E7E7"><table width="100%" border="0" cellspacing="0" cellpadding="3">
									<tr>
										<td bgcolor="#FFFFFF"><table width="590" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td>
													<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
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
																<form name="form1" method="post">
																<input type="hidden" name="mode" value="req" />
																<input type="hidden" name="id_check">
																<input type="hidden" name="id_check2">
																<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
																	<TBODY>
																	<TR>
																		<TD bgColor=#ededed height=2></TD>
																		<TD width="495"></TD>
																	</TR>
																	<TR align="center">
																		<TD colspan="2" height=50 bgColor=#f7f7f7><img src="/imercury/images/serial.jpg"></TD>
																	</TR>
																	<TR>
																		<TD width=95 height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ제품이름</span></TD>
																		<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px">
																			<SELECT class=select_style name=model_no onChange="form1.model_no2.value=this.value;redirect2(this.options.selectedIndex);">
																				<OPTION value="" selected>선택하세요</OPTION><?
																				$sql = "select * from model_tbl order by no";
																				$info = $db->querys($sql);
																				for($i=0;$i<count($info);$i++){
																					?><option value="<?=$info[$i][no]?>"><?=$info[$i][mname]?></option><?
																				}?>
																			</SELECT>
																		</span></TD>
																	</TR>
																	<TR>
																		<TD bgColor=#ededed colSpan=2 height=1></TD>
																	</TR>
																	<TR>
																		<TD height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ제품번호</span></TD>
																		<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><span class="Font-Kor12Px">일련번호:</span>
																			<SELECT class=select_style name=model_no2 disabled>
																			<OPTION value="" selected>선택하세요</OPTION><?
																			$sql = "select * from model_tbl order by no";
																			$info = $db->querys($sql);
																			for($i=0;$i<count($info);$i++){
																				?><option value="<?=$info[$i][no]?>"><?=$info[$i][mname]?></option><?
																			}?></SELECT>
																			- <input name="barcode" type='text' class=text_style size=6 >
																			<span id="vhtml"><img src="/imercury/images/join_overlap.gif" width="60" height="19" onClick="sno_chk()" style="cursor:hand"></span> <a href="#" ONCLICK="window.open('/imercury/images/join_in_mappy.jpg','pop','width=490,height=371,toolbar=no,resizable=no,scrollbars=no,left=0,top=0')"><img src="/imercury/images/join_in.gif" width="83" height="19" border="0"></a>
																		</TD>
																	</TR>
																	<TR>
																		<TD width=95 height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px">&nbsp;</TD>
																		<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px">
																			<span class="Font-Kor12Px">맵번호:</span>
																			<input name="s_no1" type='text' class='text_style' size=5 maxlength="4">
																			-
																			<input name="s_no2" type='text' class='text_style' size=5 maxlength="4">
																			-
																			<input name="s_no3" type='text' class='text_style' size=5 maxlength="4">
																			-
																			<input name="s_no4" type='text' class='text_style' size=5 maxlength="4">
																			<span id="vhtml1">
																				<img src="/imercury/images/join_overlap.gif" width="60" height="19" onClick="sno_chk2(1)"  style="cursor:hand">
																			</span>
																			<span id="vhtml2" >
																				<img src="/imercury/images/join_overlap.gif" width="60" height="19" onClick="sno_chk2(2)" style="cursor:hand">
																			</span>
																		</TD>
																	</TR>
																	<TR>
																		<TD bgColor=#ededed colSpan=2 height=1></TD>
																	</TR>
																	<TR>
																		<TD width=95 height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ구입년도/월</span></TD>
																		<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px">
																			<SELECT class=select_style name=year>
																			<OPTION value="" selected>선택</OPTION><?
																			for($i=2005;$i<=date("Y");$i++){
																				?><OPTION value=<?=$i?>><?=$i?></OPTION><?
																			}?>
																			</SELECT> 년
																			<SELECT class=select_style name=month>
																			<OPTION value="" selected>선택</OPTION><?
																			for($i=1;$i<13;$i++){
																				?><OPTION value="<?=$i?>"><?=$i?></OPTION><?
																			}?>
																			</SELECT> 월</TD>
																	</TR>
																	<TR>
																		<TD bgColor=#ededed colSpan=2 height=1></TD>
																	</TR>
																	<TR>
																		<TD height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px"><span class="member_txt_02">ㆍ제품구입처</span></TD>
																		<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px">
																			<SELECT class='select_style' name='area1'>
																			<OPTION selected>선택하세요</OPTION>
																			<OPTION value="삼성디지탈프라자">삼성디지탈프라자</OPTION>
																			<OPTION value="하이마트">하이마트</OPTION>
																			<OPTION value="전자랜드">전자랜드</OPTION>
																			<OPTION value="GM대우">GM대우</OPTION>
																			<OPTION value="하나카드">하나카드</OPTION>
																			<OPTION value="머큐리(용산체험매장)">머큐리(용산체험매장)</OPTION>
																			<OPTION value="온라인쇼핑몰">온라인쇼핑몰</OPTION>
																			<OPTION value="삼성카드">삼성카드</OPTION>
																			<OPTION value="기타/직접입력">기타/직접입력</OPTION>
																			</SELECT></TD>
																	</TR>
																	<TR>
																		<TD height=30 bgColor=#f7f7f7  style="PADDING-LEFT: 5px">&nbsp;</TD>
																		<TD bgcolor="#FFFFFF" style="PADDING-LEFT: 5px"><input type = 'text' class='text_style' name="area2" size=25 > : 구입하신 대리점을 입력해 주세요 </TD>
																	</TR>
																	<TR>
																		<TD bgColor=#ededed colSpan=2 height=1></TD>
																	</TR>
																	<TR>
																		<TD bgColor=#ededed colSpan=2 height=1></TD>
																	</TR>
																	</TBODY>
																</TABLE>
																</form>
															</TD>
														</TR>
														</TBODY>
													</TABLE>

													<table width="100%" height="50" border="0" cellpadding="5" cellspacing="0">
														<tr>
															<td align="right" id="vhtml3"><img src="/imercury/images/icon_my_05.gif" onClick="sub(1)" style="cursor:hand"></td>
															<td align="right" id="vhtml4" style="display:none"><img src="/imercury/images/icon_my_05.gif" onClick="sub(2)" style="cursor:hand"></td>
															<td><img src="/imercury/images/icon_my_07.gif" onClick="form1.reset()" style="cursor:hand"></td>
														</tr>
													</table>
												</td>
											</tr>
										</table></td>
									</tr>
								</table></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table align="center">
				<tr>
					<td height="50"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<script type="text/javascript">
//<![CDATA[
	var f = document.form1;
	var cnj_groups = f.model_no.options.length
	var cnj_group=new Array(cnj_groups)
	for (i=0; i<cnj_groups; i++)
	cnj_group[i]=new Array()

	var cnj_group2=new Array(cnj_groups)
	for (i=0; i<cnj_groups; i++)
	cnj_group2[i]=new Array()
	// 추가시에는 메인 항목 추가시에는

	// CginJs.Com cnj_group[0] 내용
	<?
	$chk = 0;

	$sql = "select * from model_tbl order by no";
	$infos = $db->querys($sql);

	for($i=0;$i<count($infos);$i++){
	  ?>
		cnj_group[<?=$i+1?>][0]=new Option("선택","")
		cnj_group2[<?=$i+1?>][0]=new Option("선택","")
	  <?
	  $sql = "select distinct s_no1 from serial_tbl where ctg = '".$infos[$i][no]."' order by no";
	  $info = $db->querys($sql);
	  for($j=0;$j<count($info);$j++){
	  ?>
		cnj_group[<?=$i+1?>][<?=$j+1?>]=new Option("<?=$info[$j][s_no1]?>","<?=$info[$j][s_no1]?>");

	  <?
	  }

	  $sql = "select distinct s_no2 from serial_tbl where ctg = '".$infos[$i][no]."' order by no";
	  $info = $db->querys($sql);
	  for($j=0;$j<count($info);$j++){
	  ?>

		cnj_group2[<?=$i+1?>][<?=$j+1?>]=new Option("<?=$info[$j][s_no2]?>","<?=$info[$j][s_no2]?>");
	  <?
	  }

	}



	?>
	//var cnj_str =f.s_no1;
	//var cnj_str2 =f.s_no2;

	function redirect2(x){

	//alert(form1.model_no2.value) ;

		f = form1.model_no2.value ;

		if(f == 2){
		vhtml.style.display = "";
		vhtml1.style.display = "";
		vhtml2.style.display = "none";
		vhtml3.style.display = "";
		vhtml4.style.display = "none";

		}else{
		vhtml.style.display = "none";
		vhtml1.style.display = "none";
		vhtml2.style.display = "";
		vhtml4.style.display = "";
		vhtml3.style.display = "none";
		}
	/*
	for (m=cnj_str.options.length-1;m>0;m--)
	cnj_str.options[m]=null
	for (i=0;i<cnj_group[x].length;i++){
	cnj_str.options[i]=new Option(cnj_group[x][i].text,cnj_group[x][i].value)

	}

	for (m=cnj_str2.options.length-1;m>0;m--)
	cnj_str2.options[m]=null
	for (i=0;i<cnj_group2[x].length;i++){
	cnj_str2.options[i]=new Option(cnj_group2[x][i].text,cnj_group2[x][i].value)
	}
	*/

	}

	function go(){
		location=cnj_str.options[cnj_str.selectedIndex].value
	}

	//redirect2(form1.model_no.selectedIndex);
//]]>
</script>