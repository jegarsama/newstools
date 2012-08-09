<?
include "head.php";
// 취소버튼 클릭시
if ($orderCancel=="y")
{
	$MySQL->query("DELETE from trade_goods WHERE tradecode='$tradecode'");
	$MySQL->query("DELETE from trade WHERE tradecode='$tradecode'");
	$MySQL->query("DELETE from cart WHERE userid='$_SESSION[GOOD_SHOP_USERID]'");
	Refresh("index.php");
	exit;
}
if($act =="edit")
{
	// 장바구니 수정
	$cart_row = $MySQL->fetch_array("select * from cart where idx=$cartIdx");
	$new_point = ($cart_row[point]/$cart_row[cnt]) * $cnt;
	$edit_qry = "update cart set cnt = $cnt,point=$new_point where idx=$cartIdx";
	if($MySQL->query($edit_qry)){}
	else echo"Err. : $edit_qry";
}
else if($act =="del")
{
	//장바구니 삭제
	$del_qry = "delete from cart  where idx=$cartIdx";
	if($MySQL->query($del_qry)){}
	else echo"Err. : $del_qry";
}
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");//관리자정보
}
if($admin_row[bUsepoint] && $_SESSION[GOOD_SHOP_PART] =="member")
{
	$__TNAME_TD_WIDTH =147;
}
else
{
	$__TNAME_TD_WIDTH =214;
}
if($_SESSION[GOOD_SHOP_PART] =="member")
{
	$member_row = $MySQL->fetch_array("select * from member where userid='$_SESSION[GOOD_SHOP_USERID]'");
	$tel	= explode("-",$member_row[tel]);
	$hand	= explode("-",$member_row[hand]);
	$zip	= explode("-",$member_row[zip]);
	$ceo_zip= explode("-",$member_row[ceo_zip]);
}

//주문코드 생성
srand(time());
$time = substr(time(),5,5);
for($i=0;$i<3;$i++)
{
	$asc=rand()%26+65;
	$c.=chr($asc);
}
$iparr = explode(".",$REMOTE_ADDR);
$tradecode=$c.$time.$iparr[3];
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//우편번호 찾기
function searchZip(po)
{
	window.open("search_post.php?po="+po,"","scrollbars=yes,width=490,height=200,left=250,top=250");
}

//배송지 동일
function infoEqual()
{
	var form=document.orderForm;
	if(form.eql.checked)
	{
		//주문자,배송지 동일
		form.rname.value	=form.name.value;
		form.remail.value	=form.email.value;
		form.rtel1.value	=form.tel1.value;
		form.rtel2.value	=form.tel2.value;
		form.rtel3.value	=form.tel3.value;
		form.rhand1.value	=form.hand1.value;
		form.rhand2.value	=form.hand2.value;
		form.rhand3.value	=form.hand3.value;
		form.rzip1.value	=form.zip1.value;
		form.rzip2.value	=form.zip2.value;
		form.radr1.value	=form.adr1.value;
		form.radr2.value	=form.adr2.value;
	}
	else
	{
		form.rname.value	="";
		form.remail.value	="";
		form.rtel1.value	="";
		form.rtel2.value	="";
		form.rtel3.value	="";
		form.rhand1.value	="";
		form.rhand2.value	="";
		form.rhand3.value	="";
		form.rzip1.value	="";
		form.rzip2.value	="";
		form.radr1.value	="";
		form.radr2.value	="";
	}
}

function trim(str)
{
	str = str.replace(/(^\s*)|(\s*$)/g, "");
	return str;
}

//정보전송
function tradeSendit(str,str2)
{
	var form=document.orderForm;
	if(!inputCheckSpecial(form))
	{
		alert("특수문자는 입력하실수 없습니다.");
	}
	else if(form.name.value =="")
	{
		alert("주문자명을 입력해 주십시오.");
		form.name.focus();
	}
	else if(form.zip1.value=="")
	{
		alert("주소를 입력해 주십시오.");
		searchZip(1);
	}
	else if(form.rname.value =="")
	{
		alert("받는이명을 입력해 주십시오.");
		form.rname.focus();
	}
	else if(form.rzip1.value=="")
	{
		alert("배송지 주소를 입력해 주십시오.");
		searchZip(2);
	}
	else if(trim(form.eventDayInfo.value)=="")
	{
		alert("희망배송일/행사일을 입력해 주십시오.");
		form.eventDayInfo.focus();
	}
	else if(str ==1)
	{
		// 재고품절
		var tell = "죄송합니다. ("+str2+") 상품의 마지막 재고가 조금전에 구매되었습니다."
		alert(tell);
		location.href="cart.php";
	}
	else if(str ==2)
	{
		// 재고초과
		var tell = "죄송합니다. ("+str2+") "
		alert(tell);
		location.href="cart.php";
	}
	else if(form.agreement && form.agreement.checked != true)
	{
		alert("개인정보취급방침에 동의를 하여야 합니다");
	}
	else
	{
		form.submit();
	}
}
//장바구니 수정
function cartEdit(Obj,bLimit,limitCnt,minbuyCnt,maxbuyCnt,bOptionStock,iOptionCnt)
{
	var Cnt = Obj.cnt.value;
	if(Cnt=="" || Cnt=="0" ||Cnt==0 || !numCheck(Cnt))
	{
		alert("구매수량이 올바르지 않습니다.");
		Obj.cnt.focus();
	}
	else if(bLimit && Cnt > limitCnt)
	{
		alert("죄송합니다. 해당 상품의 전체 재고수량이 부족합니다.\n\n총 재고량 : "+limitCnt);
		Obj.cnt.value = limitCnt;
		Obj.cnt.focus();
	}
	else if(bOptionStock=='y' && bLimit && Cnt > iOptionCnt)
	{
		alert("죄송합니다. 상품옵션의 재고수량이 부족합니다.\n\n옵션재고량 : "+iOptionCnt);
		Obj.cnt.value = iOptionCnt;
		Obj.cnt.focus();
	}
	else if(minbuyCnt!=0 && Cnt<minbuyCnt)
	{
		alert("본 상품의 최소구매수량은 "+minbuyCnt+ " 개 입니다.");
		Obj.cnt.value = minbuyCnt;
		Obj.cnt.focus();
	}
	else if(maxbuyCnt!=0 && Cnt>maxbuyCnt)
	{
		alert("본 상품의 최대구매수량은 "+maxbuyCnt+ " 개 입니다.");
		Obj.cnt.value = maxbuyCnt;
		Obj.cnt.focus();
	}
	else
	{
		Obj.action = "order_sheet.php?act=edit";
		Obj.submit();
	}
}
//장바구니 삭제
function cartDel(Obj)
{
	Obj.action = "order_sheet.php?act=del";
	Obj.submit();
}
function searchZip_ceo()
{
	window.open("search_post_ceo.php?form=orderForm","","scrollbars=yes,width=490,height=200,left=250,top=250");
}
//-->
</SCRIPT>
<? include "top.php";?>
<table width="1100" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td valign="top" width="920" bgcolor="<?=$arColor[9]?>">
			<table width="920" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="<?=$arColor[9]?>" valign="top">
					<td colspan="2">
						<table width="920" height="30" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc7]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc7]?>" rowspan="2"></td>
								<td width="220" height="30" bgcolor="<?=$subdesign[bc7]?>"><img src="./upload/design/<?=$subdesign[img7]?>" ></td>
								<td height="30" bgcolor="<?=$subdesign[bc7]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc7]?>"> <img src='image/good/icon0.gif'>&nbsp;현재위치 : HOME &gt; 주문정보</font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="920">
						<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td align="center"><?
								if ($subdesign[titimg7])
								{
									?><img src="./upload/design/<?=$subdesign[titimg7]?>" ><?
								}
								else
								{
									?><img src="image/work/order_tit.gif" ><?
								}
								?></td>
							</tr>
						</table>
						<br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height='2' bgcolor='#d5d5d5'></td>
							</tr>
							<tr>
								<td>
									<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr bgcolor="#F3F9F9" height="30">
											<td height='25' width="40" align="center"><font color='<?=$arColor[2]?>'><b>번호</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="<?=$__TNAME_TD_WIDTH?>" align="center"><font color='<?=$arColor[2]?>'><b>상품명</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="130" align="center"><font color='<?=$arColor[2]?>'><b>옵션</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="70" align="center"><font color='<?=$arColor[2]?>'><b>구입가</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<?
											if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
											{
												?>
											<td width="66" align="center"><font color='<?=$arColor[2]?>'><b>적립금</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td><?
											}
											?>
											<td width="70" align="center"><font color='<?=$arColor[2]?>'><b>수량</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="80" align="center"><font color='<?=$arColor[2]?>'><b>합계 (원)</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="60" align="center"><font color='<?=$arColor[2]?>'><b>삭제</b></font></td>
										</tr>
										<tr>
											<td colspan='15' height='1' bgcolor='#d5d5d5'></td>
										</tr><?
										$cart_qry = "select * from cart where userid='$_SESSION[GOOD_SHOP_USERID]' order by goodsIdx desc";
										$cart_result	 = $MySQL->query($cart_qry);
										$cart_goods_cnt = $MySQL->is_affected();
										$cart_cnt = 0;
										$total_price = 0;
										#####로그2차변수#####
										$http_log_mp="";
										#####로그2차변수#####
										while($cart_row = mysql_fetch_array($cart_result))
										{
											$isPrtMod			= 0;
											$normOptionMod		= 0;
											$priceOptionMod		= 0;
											$goods_row = $MySQL->fetch_array("select *from goods where idx=$cart_row[goodsIdx]"); //상품정보

											########## 로그2차스크립트 #########

											$be = array('(_)', '([\"\'])', '(\&nbsp;)');
											$af = array('-', '', ' ');

											if($http_log_mp!=""){$http_log_mp.=";";}
											$http_log_mp.= preg_replace($be, $af, $goods_row[name])."_".$cart_row[price]."_".$cart_row[cnt];

											########## 로그2차스크립트 #########

											##옵션 정보를 확인하여 설정이 안된 제품이 있으면 장바구니로 돌려보냄
											for($i=1;$i<=3;$i++)
											{
												$goodsPartName	="partName".$i;
												$cartOption		="option".$i;
												if($goods_row[$goodsPartName] != '' && $cart_row[$cartOption] == '')
												{
													$normOptionMod = 1;
												}
											}
											if($goods_row[total_option_name] != '' && ($cart_row[option4] == '' || $cart_row[option4] == '/'))
											{
												$arOptKind = explode("/",$goods_row[total_option_str]);
												for($j=0;$j<count($arOptKind);$j++)
												{
													$arOptPart = explode("」「",$arOptKind[$j]);
													for($m=0;$m<count($arOptPart);$m++)
													{
														$arOptVal = explode("|",$arOptPart[$m]);
														if($arOptVal[1] == 0)
														{
															$priceOptionMod = 1;
														}
													}
												}
											}
											$isPrtMod = $normOptionMod + $priceOptionMod;
											if($isPrtMod > 0)
											{
												MsgViewHref("주문상품중 옵션선택이 안되어 있는 상품이 있습니다", "cart.php");
												exit;
											}

											$gprice = new CGoodsPrice($goods_row[idx]);
											if ($admin_row[bNew])
											{
												$bNew = limitday($goods_row[writeday],$admin_row[new_day]);
												if (empty($bNew) && $goods_row[bNew]) $bNew = "<img src='upload/goods_new_img'>";
											}
											$bHit =$goods_row[bHit]?"<img src='./upload/goods_hit_img'>":"";	// 히트 이미지
											$bEtc =$goods_row[bEtc]?"<img src='./upload/goods_etc_img'>":"";	// 기타 이미지

											// 사용자 아이콘 설정
											$user_icon = "";
											$arIcon = unserialize($goods_row[usericon]);
											$_result = $MySQL->query("SELECT * FROM NZ_ICON WHERE isuse='Y' ORDER BY seq DESC");
											while($_row = mysql_fetch_array($_result))
											{
												if($arIcon[$_row[seq]] == "Y")
												{
													$user_icon.= "<img src='./upload/usericon/".$_row[filename]."'>";
												}
											}

											$optionArr = Array("$cart_row[option1]","$cart_row[option2]","$cart_row[option3]");	//옵션 배열
											$tprice	   = $cart_row[cnt] * $cart_row[price];	// 구매가격 : 상품가격X상품수량
											$code_array = $goods_row[code].",".$code_array;	// 각상품 코드입력 11.18
											if ($goods_row[bLimit]==1)
											{
												if (empty($goods_row[limitCnt]))
												{
													$limit = 1;	// 품절이면 1
													$limit_good = $goods_row[name];
												}
												else if ($goods_row[limitCnt] < $cart_row[cnt])	// 품절은 아닌데 구매수량이 재고수량을 넘어서면
												{
													$limit = 2; // 재고초과이면 2
													$over_cnt = $cart_row[cnt] - $goods_row[limitCnt];
													$limit_good = $goods_row[name]."상품의 재고를 $over_cnt 개 초과하였습니다.";
												}
											}
											else if ($goods_row[bLimit]>1)
											{
												$limit = $goods_row[bLimit]; // 강제품절 2, 보류 3 , 단종 4
												$limit_good = "상품이 보류 또는 단종된 상태입니다.";
											}
											$bLimit	   = $goods_row[bLimit];
											$limitCnt  = $goods_row[limitCnt];
											if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
											else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
											else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
											else $img_str = $goods_row[img1];
											?>
										<form name="cartForm<?=$cart_cnt?>" method="post">
										<input type="hidden" name="cartIdx" value="<?=$cart_row[idx]?>"><!-- 장바구니 idx 번호 -->
										<tr>
											<td height="25" align="center"><?=$cart_goods_cnt?></td>
											<td width='1'></td>
											<td align="left" valign="middle">
												<table>
													<tr>
														<td><img src="./upload/goods/<?=$img_str?>" width="40" height="40"></td>
														<td><?=$goods_row[name]?> <?=$bHit?> <?=$bNew?> <?=$bEtc?> <?=$user_icon?></td>
													</tr>
												</table>
											</td>
											<td width='1'></td>
											<td align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0"><?
												for($i=0;$i<count($optionArr);$i++)
												{
													if(!empty($optionArr[$i]))
													{
														$option = explode("」「",$optionArr[$i]);
														?>
													<tr>
														<td width="40%"  bgcolor="<?=$arColor[5]?>"> <div align="center"><?=$option[0]?> </div></td>
														<td width="60%" bgcolor="<?=$arColor[6]?>"> <div align="left"> : <?=($option[1]=='0')?"선택안함":$option[1]?></div></td>
													</tr>
													<tr  bgcolor="<?=$arColor[7]?>">
														<td colspan="2" height="1"></td>
													</tr><?
													}
												}
												if ($cart_row[option4])
												{
													$str = explode("/",$cart_row[option4]);
													$total_name = $str[0]; // 옵션명 조합
													$total_str = $str[1]; // 옵션문자열 조합
													$total_str_arr = explode("」「",$total_str);
													$total_name_arr = explode("」「",$total_name);
													for ($j=0; $j<count($total_str_arr)-1; $j++)
													{
														$total_str_arr2 = explode("|",$total_str_arr[$j]);
														$option[0] = $total_name_arr[$j]; // 옵션명
														$option[1] = $total_str_arr2[0]."(+".PriceFormat($total_str_arr2[1]).")"; // 옵션문자
														?>
													<tr>
														<td width="40%"  bgcolor="<?=$arColor[5]?>"> <div align="center"><?=$option[0]?> </div></td>
														<td width="60%"  bgcolor="<?=$arColor[6]?>"> <div align="left"> : <?=$option[1]?></div></td>
													</tr>
													<tr  bgcolor="<?=$arColor[7]?>">
														<td colspan="2" height="1"></td>
													</tr><?
													}
												}
												if($goods_row[bOptionStock]=="y")
												{
													$total_str_arr3 = explode("|",$total_str_arr[0]);
													$iOptionCnt = $total_str_arr3[2];
												}
												else
												{
													$iOptionCnt = 0;
												}
												?>
												</table>
											</td>
											<td width='1'></td>
											<td height="25" align="right"><?
												if($goods_row[price] > 0)
												{
													echo $gprice->PutPrice();
												}
												else
												{
													$priceInquiries = ($goods_row[priceInquiries]!='') ? $goods_row[priceInquiries]:"가격문의";
													echo "<font color='#FF9997'>".$priceInquiries."</font>";
												}
											?>
											</td>
											<td width='1'></td><?
											if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
											{
												?>
											<td height="25" align="right"><?=PriceFormat($cart_row[point])?>&nbsp;</td>
											<td width='1'></td><?
											}
											?>
											<td height="25" align="center"><input type="text" name="cnt" size="2" value="<?=$cart_row[cnt]?>"> 개<br><a href="javascript:cartEdit(document.cartForm<?=$cart_cnt?>,<?=$bLimit?>,<?=$limitCnt?>,<?=$goods_row[minbuyCnt]?>,<?=$goods_row[maxbuyCnt]?>,'<?=$goods_row[bOptionStock]?>',<?=$iOptionCnt?>);"><img src="image/icon/edit_btn.gif" border="0"></a></td>
											<td width='1'></td>
											<td height="25" align="right"> <FONT COLOR="<?=$arColor[14]?>"><?=PriceFormat($tprice)?></FONT>&nbsp;</td>
											<td width='1'></td>
											<td height="25" align="center"><a href="javascript:cartDel(document.cartForm<?=$cart_cnt?>);"><img src="image/icon/btn_delete0.gif" border="0"></a></td>
										</tr>
										<tr>
											<td colspan="15" height="1" bgcolor='<?=$arColor[4]?>'></td>
										</tr>
										</form><?
											$total_price +=$tprice;	// 총구매가격
											$tprice_array = $tprice.",".$tprice_array;	// 주문테이블에 들어갈 가격도 ,로 각각 분리
											$cart_goods_cnt --;
											$cart_cnt ++;
										}
										?>
									</table>
								</td>
							</tr>
							<tr>
								<td height="30" colspan="15">
									<table width="670" border="0" cellspacing="1" cellpadding="0" bgcolor="<?=$arColor[9]?>" align="center">
										<tr>
											<td bgcolor="<?=$arColor[3]?>" height="30" align="right">&nbsp;&nbsp;<B>상품합계</B> : <b><font color="<?=$arColor[8]?>"><?=PriceFormat($total_price)?>원</font></b></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br><br>
			<table width="670" border="0" cellspacing="0" cellpadding="0" align="center"><?
			if(empty($admin_row[bTrans]) && empty($admin_row[chakbul]))	// 배송비미사용
			{
				$transM = 0;
				$transMstr = "무료";
			}
			else if(empty($admin_row[bTrans]) && $admin_row[chakbul])	//배송비미사용&착불
			{
				$transM = 0;
				$transMstr = "착불";
			}
			else if ($MySQL->articles("SELECT cart.idx FROM cart, goods WHERE cart.userid='$_SESSION[GOOD_SHOP_USERID]' and cart.goodsIdx = goods.idx and goods.size<>'N'") <= 0)	// 장바구니에 유료배송 상품이 없을때
			{
				$transM = 0;
				$transMstr = "0 원";
			}
			else
			{
				if($admin_row[noTrans] <=$total_price)
				{
					$transM = 0;
					$transMstr=PriceFormat($transM)." 원";
				}
				else	//배송비무료 적용금액
				{
					$transM = $admin_row[transMoney];
					$transMstr=PriceFormat($transM)." 원";
				}
				//배송비적용
			}
			?>
				<tr>
					<td height="30" colspan="7">
						<table width="670" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td bgcolor="<?=$arColor[3]?>" height="30" align="right">[ 배송비 : <font color="<?=$arColor[8]?>"><?=$transMstr?></font> ] &nbsp;&nbsp; <B>결제금액</B> : <b><font color="<?=$arColor[8]?>"><?=PriceFormat($total_price+$transM)?>원</font></b></td>
							</tr>
						</table>
					</td>
				</tr>
			</table><br>
			<form name="orderForm" method="post" action="order_table.php">
			<input type="hidden" name="tprice_array" value="<?=$tprice_array?>">
			<input type="hidden" name="code_array" value="<?=$code_array?>">
			<input type="hidden" name="transM_array" value="<?=$transM_array?>">
			<input type="hidden" name="city" value="<?=$member_row[city]?>">
			<input type="hidden" name="tradecode" value="<?=$tradecode?>">
			<input type="hidden" name="channel" value="<?=$channel?>"><!--ex)cart:장바구니에서구매 direct:바로구매하기 -->
			<!-- 주문자 정보 시작 -->
			<table width="670" border="0" cellspacing="1" cellpadding="10" valign="top" align='center' bgcolor='<?=$arColor[15]?>'>
				<tr>
					<td bgcolor='<?=$arColor[9]?>'>
						<table width="650" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td height="2" colspan="2" bgcolor="<?=$arColor[4]?>"></td>
							</tr>
							<tr>
								<td height="30" colspan="2" bgcolor="<?=$arColor[16]?>">&nbsp;&nbsp;<b>주문자정보</b></td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor="<?=$arColor[4]?>"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>"> &nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>아이디</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <?
								if($GOOD_SHOP_PART=="member")
								{
									?><FONT  COLOR="<?=$arColor[17]?>"><?=$GOOD_SHOP_USERID?></FONT><?
								}
								else
								{
									?><FONT  COLOR="<?=$arColor[18]?>">GUEST</FONT><?
								}
								?></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>성 명</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="name" size="10" value="<?=$member_row[name]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>이 메 일</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="email" size="30"  value="<?=$member_row[email]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>전화번호</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="tel1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$tel[0]?>"> - <input class="box" type="text" name="tel2" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$tel[1]?>"> - <input class="box" type="text" name="tel3" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$tel[2]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>휴대폰번호</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="hand1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$hand[0]?>"> - <input class="box" type="text" name="hand2" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$hand[1]?>"> - <input class="box" type="text" name="hand3" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$hand[2]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>우편번호</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="zip1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$zip[0]?>"> - <input class="box" type="text" name="zip2" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$zip[1]?>"> <a href="javascript:searchZip(1);"><img src="image/icon/post_search.gif" border="0" align="absmiddle"></a></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>주 소</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="adr1" size="50"  value="<?=$member_row[address1]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>상 세 주 소</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="adr2" size="50"  value="<?=$member_row[address2]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br><br>
			<table width="670" border="0" cellspacing="1" cellpadding="10" valign="top" align='center' bgcolor='<?=$arColor[15]?>'>
				<tr>
					<td bgcolor='<?=$arColor[9]?>'>
						<table width="650" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td height="2" colspan="2" bgcolor="<?=$arColor[4]?>"></td>
							</tr>
							<tr>
								<td height="30" colspan="2" bgcolor="<?=$arColor[16]?>">&nbsp;&nbsp;<b>수령자 정보</b> <input  type="checkbox" name="eql" value="checkbox" onClick="javascript:infoEqual();"> (주문자 정보와 동일함)</td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor="<?=$arColor[4]?>"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>성 명</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="rname" size="10"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>이 메 일</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="remail" size="30"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>전화번호</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="rtel1" size="3" maxlength="3" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rtel2" size="4" maxlength="4" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rtel3" size="4" maxlength="4" <?=__ONLY_NUM?>></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>휴대전화</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="rhand1" size="3" maxlength="3" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rhand2" size="4" maxlength="4" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rhand3" size="4" maxlength="4" <?=__ONLY_NUM?>></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem2' color="red">희망배송일/행사일</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="eventDayInfo" size="70"><br>&nbsp;&nbsp;&nbsp;<?=$admin_row[xOrder3]?></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>우편번호</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="rzip1" size="3" maxlength="3" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rzip2" size="3" maxlength="3" <?=__ONLY_NUM?>> <a href="javascript:searchZip(2);"><img src="image/icon/post_search.gif" border="0" align="absmiddle"></a></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>주 소</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="radr1" size="50"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>상 세 주 소</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="radr2" size="50"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[3]?>">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>전할말</font></font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <textarea name="content" cols="70" rows="4"  class="text"></textarea></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<? if($GOOD_SHOP_PART != "member") { ?>
			<br><br>
			<table width="670" border="0" cellpadding="10" cellspacing="1" border="0" valign="top" align="center" bgcolor="<?=$arColor[15]?>">
				<tr>
					<td bgcolor="<?=$arColor[9]?>" align="center">
					<table width="650" border="0" cellspacing="1" cellpadding="0" align="center">
						<tr>
							<td height="2" colspan="2" bgcolor="<?=$arColor[4]?>"></td>
						</tr>
						<tr>
							<td width="104" height="100" bgcolor="<?=$arColor[3]?>" align="center"><b>비회원 구매<br>개인정보취급방침</b></td>
							<td width="496" style="padding-left:15px">
							<div><textarea cols="70" rows="5" class="text2" readonly><?include "member_article.inc.personinfo.txt";?></textarea></div>
							<div><input type="checkbox" name="agreement" value="checkbox"> 위의 개인정보취급방침에 동의합니다.</div>
							</td>
						</tr>
						<tr>
							<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			<? } ?>
			</form><!-- orderForm --><br>
			<table width="150" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr align="center">
					<td><a href="javascript:tradeSendit('<?=$limit?>','<?=$limit_good?>');"><img src="image/icon/ok2_btn.gif" border="0"></a></td>
					<td><a href="order_table.php?orderCancel=y&tradecode=<?=$tradecode?>"><img src="image/icon/cancel_lag.gif" border="0"></a></td>
				</tr>
			</table><br>
		</td>
	</tr>
</table>
<?
$http_SO="cartend";
$http_MP=$http_log_mp;
?>
<? include "copy.php"; ?>
</div>
</body>
</html>