<?
include "head.php";

//if($_SESSION['GOOD_SHOP_USERID'] == "zigishop" || $_SESSION['GOOD_SHOP_USERID'] == "dodamdodam") $admin_row[bCyberpay] = 1;	//가상계좌 테스트

//$admin_row[pG_test] = "y";

// 취소버튼 클릭시
if ($orderCancel=="y")
{
	$MySQL->query("DELETE from trade_goods WHERE tradecode='$tradecode'");
	$MySQL->query("DELETE from trade WHERE tradecode='$tradecode'");
	$MySQL->query("DELETE from cart WHERE userid='$_SESSION[GOOD_SHOP_USERID]'");
	Refresh("index.php");
	exit;
}
if (empty($tradecode))
{
	MsgViewHref("주문번호가 존재하지 않습니다.","cart.php");
	exit;
}
if (!$MySQL->articles("SELECT idx from cart WHERE userid='$_SESSION[GOOD_SHOP_USERID]' limit 1"))
{
	MsgViewHref("장바구니에 상품이 존재하지 않습니다.","cart.php");
	exit;
}
if($GOOD_SHOP_PART =="member")
{
	$member_row = $MySQL->fetch_array("select *from member where userid='$_SESSION[GOOD_SHOP_USERID]'");
	$ssh = explode("-",$member_row[ssh]);		//회원 주민등록번호
}
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");//관리자정보
}
if($admin_row[xTrans_bhtml])
{
	$xTrans = $admin_row[xTrans];
}
else
{
	$xTrans = nl2br(htmlspecialchars($admin_row[xTrans]));
}
if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
{
	//적립금 사용
	$__TNAME_TD_WIDTH =267;	//상품명 타이틀 TD 길이
	$__VNAME_TD_WIDTH =173; //상품명 TD 길이
}
else
{
	$__TNAME_TD_WIDTH =334;
	$__VNAME_TD_WIDTH =239;
}
//무통장입금 정보
$bBank		=explode("|",$admin_row[bBank]);		//은행사용여부 배열
$bankName	=explode("|",$admin_row[bankName]);		//은행명 배열
$bankId		=explode("|",$admin_row[bankId]);		//계좌번호 배열
$bankOwn	=explode("|",$admin_row[bankOwn]);		//예금주 배열

// 주문자 정보 임시 테이블 저장 시작

$tel	= $tel1."-".$tel2."-".$tel3;
$hand	= $hand1."-".$hand2."-".$hand3;
$zip	= $zip1."-".$zip2;
$rtel	= $rtel1."-".$rtel2."-".$rtel3;
$rhand	= $rhand1."-".$rhand2."-".$rhand3;
$rzip	= $rzip1."-".$rzip2;
$ceo_zip= $ceo_zip1."-".$ceo_zip2;
$ceonum =  $ceonum1."-".$ceonum2."-".$ceonum3;
$goodsIdx =0;
$cnt	  =0;

$MySQL->query("select idx from trade_temp where tradecode='$tradecode' limit 1");
if(!empty($tradecode) && !$MySQL->is_affected())
{
	//주문번호 존재 &&주문번호중복방지
	$content = addslashes($content);
	$adr1 = addslashes($adr1);
	$adr2 = addslashes($adr2);
	$radr1 = addslashes($radr1);
	$radr2 = addslashes($radr2);
	$temp_qry = "insert into trade_temp (tradecode,userid,userid_part,name,email,tel,hand,";
	$temp_qry.= "zip,adr1,adr2,city,rname,remail,rtel,rhand,rzip,radr1,radr2,writeday,content,";
	$temp_qry.= "goodsIdx,cnt,tprice_array,code_array,bTax,level_gubun,transM_array,eventDayInfo) values(";
	$temp_qry.= "'$tradecode','$_SESSION[GOOD_SHOP_USERID]','$GOOD_SHOP_PART','$name','$email','$tel','$hand','$zip',";
	$temp_qry.= "'$adr1','$adr2','$city','$rname','$remail','$rtel','$rhand','$rzip','$radr1','$radr2',";
	$temp_qry.= "now(),'$content',$goodsIdx,$cnt,'$tprice_array','$code_array','$bTax','$GOOD_SHOP_PART_GUBUN','$transM_array','$eventDayInfo')";
	$MySQL->query($temp_qry);
}

$MySQL->query("select idx from trade where tradecode='$tradecode' limit 1");
if(!empty($tradecode) && !$MySQL->is_affected() )
{
	//주문번호 존재 &&주문번호중복방지
	$temp_row = $MySQL->fetch_array("select * from trade_temp where tradecode='$tradecode'");
	$qry = "insert into trade(tradecode,userid,userid_part,name,email,tel,hand,zip,adr1,";
	$qry.= "adr2,city,rname,remail,rtel,rhand,rzip,radr1,radr2,writeday,content,bPsupply,tprice_array,code_array,sday1,bTax,level_gubun,userIp,transM_array,eventDayInfo";
	$qry.= ")values(";
	$qry.= "'$tradecode',";
	$qry.= "'$temp_row[userid]',";
	$qry.= "'$temp_row[userid_part]',";
	$qry.= "'$temp_row[name]',";
	$qry.= "'$temp_row[email]',";
	$qry.= "'$temp_row[tel]',";
	$qry.= "'$temp_row[hand]',";
	$qry.= "'$temp_row[zip]',";
	$qry.= "'$temp_row[adr1]',";
	$qry.= "'$temp_row[adr2]',";
	$qry.= "'$temp_row[city]',";
	$qry.= "'$temp_row[rname]',";
	$qry.= "'$temp_row[remail]',";
	$qry.= "'$temp_row[rtel]',";
	$qry.= "'$temp_row[rhand]',";
	$qry.= "'$temp_row[rzip]',";
	$qry.= "'$temp_row[radr1]',";
	$qry.= "'$temp_row[radr2]',";
	$qry.= "now(),";
	$qry.= "'$temp_row[content]',";
	$qry.= "1,";
	$qry.= "'$temp_row[tprice_array]', ";
	$qry.= "'$temp_row[code_array]', ";
	$qry.= "now(),";
	$qry.= "'$bTax',";
	$qry.= "'$temp_row[level_gubun]', ";
	$qry.= "'$REMOTE_ADDR',";
	$qry.= "'$transM_array',";
	$qry.= "'$eventDayInfo'";
	$qry.= ")";

	if($MySQL->query($qry))
	{
		$cart_result = $MySQL->query("select * from cart where userid='$temp_row[userid]'");
		$inSuccess =true;
		while($cart_row = mysql_fetch_array($cart_result))
		{
			$qry = "select idx,name,supplyprice,code,category,img1,img3,img_onetoall,bOptionStock,reid_category from goods where idx=$cart_row[goodsIdx] limit 1";
			$goods_row = $MySQL->fetch_array($qry);
			$gname=addslashes($goods_row[name]);
			if (empty($goods_row[supplyprice])) $sprice = 0;
			else $sprice = $goods_row[supplyprice];

			if ($MySQL->articles("SELECT idx from position WHERE goodsIdx=$goods_row[idx] limit 1"))
			{
				$pos_row = $MySQL->fetch_array("SELECT part from position WHERE goodsIdx=$goods_row[idx] limit 1");
				$goods_row[goodtype] = $pos_row[part];
			}
			$in_qry = "insert into trade_goods(tradecode,goodsIdx,goodsP,cnt,";
			$in_qry.= "option1, option2, option3,option4, price,sday1,name,img1,code,category,sprice,userid,bOptionStock,goodtype";
			$in_qry.= ") values('$tradecode',";
			$in_qry.= "$cart_row[goodsIdx],";
			$in_qry.= "$cart_row[point],";
			$in_qry.= "$cart_row[cnt],";
			$in_qry.= "'$cart_row[option1]',";
			$in_qry.= "'$cart_row[option2]',";
			$in_qry.= "'$cart_row[option3]',";
			$in_qry.= "'$cart_row[option4]',";
			$in_qry.= "$cart_row[price], ";
			$in_qry.= "now(), ";
			$in_qry.= "'$gname',"; // 각각의 상품에 맞는 상품명
			if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
			else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
			else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
			else $img_str = $goods_row[img1];
			$in_qry.= "'$img_str',"; // 각각의 상품에 맞는 상품이미지
			$in_qry.= "'$goods_row[code]',"; // 각각의 상품에 맞는 상품코드
			$in_qry.= "'$goods_row[category]',"; // 카테고리
			$in_qry.= "$sprice,"; // 공급가
			$in_qry.= "'$_SESSION[GOOD_SHOP_USERID]',"; //구매자 ID
			$in_qry.= "'$goods_row[bOptionStock]',"; //옵션재고사용 여부
			$in_qry.= "'$goods_row[goodtype]'";
			$in_qry.= ")";
			if(!$MySQL->query($in_qry)) $inSuccess = false;
		}
	}
	else
	{
		echo"Err. : $qry";
	}
}
$temp_row = $MySQL->fetch_array("select * from trade_temp where tradecode='$tradecode'");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//결제방식 확인
function ch_payMethod()
{
	var Arr_payM = document.payForm.payMethod;
	var ch_payM = "";

	//결제방식 확인
	if(document.usePform.pay_ready.value == '')	// 결제 준비작업 진행중
	{
		alert("결제를 위한 준비작업 중입니다.\n\n잠시만 기다려 주십시요.");
		return false;
	}
	else if(Arr_payM == null)	// 상점에서 결정한 결제 방식이 없는 경우
	{
		alert("사용가능한 결제방식이 없습니다.\n\n상점관리자에게 문의 바랍니다.");
		return false;
	}
	else if(Arr_payM.length == undefined)	// 결제방식이 한가지일 경우
	{
		ch_payM = Arr_payM.value;
	}
	else									// 결제방식이 여러가지일 경우
	{
		for(i=0; i < Arr_payM.length; i++)
		{
			if(Arr_payM[i].checked)
			{
				ch_payM = Arr_payM[i].value;
			}
		}
	}

	if(ch_payM == "")		//선택된 결제방식이 없는 경우
	{
		alert("결제방식을 선택해 주시기 바랍니다.");
		return false;
	}
	else
	{
		return ch_payM;
	}
}

function viewAct(state)
{
	document.getElementById('nsPre').style.display='none';
	document.getElementById('nsAct').style.display='none';
	document.getElementById('nsWait').style.display='none';
	document.getElementById(state).style.display='block';
}

function bank_select(p)
{
	var form=document.payForm;
	var usePform=document.usePform;
	var togform=document.tog;

	//결제방식 확인
	var ch_payM = ch_payMethod();
	if(ch_payM != false)	//결제작업 위한 추가 입력사항 필요
	{
		usePform.payMethod.value = ch_payM;
		<?if($admin_row[bBankpay]){?>
		if(ch_payM == "bank")	//결제작업 위한 추가 입력사항 필요
		{
			if(togform.togVal.value!=1)
			{
				togform.togVal.value = 1;
				chk_dc('bank');
				document.all.saleinfo.style.display="";
				document.all.saleinfo_bar.style.display="";
				showObject(form.bankInfo,true);		//상점자체 무통장
			}
		}
		else
		{
			togform.togVal.value = 2;
			if(p!="usePoint") chk_dc('card');	//적립금을 사용했을 경우에만 chk_dc()를 실행
			document.all.saleinfo.style.display="none";
			document.all.saleinfo_bar.style.display="none";
			showObject(form.bankInfo,false);	//PG사 결제방식
			<?if($GOOD_SHOP_PART=="member"){?>
			form.selectSale[0].checked = true;
			<?}else{?>
			form.selectSale[1].checked = true;
			<?}?>
		}
		<? } ?>
	}
}

function trade_update() // 주문정보 IFRAME 으로 DB에 갱신
{
	<?if($admin_row[pG_test]=="y"){//테스트?>
	alert('카드결제 시스템 구축중입니다.\n실결제가 되지 않으니 무통장 입금을 이용해주세요');
	<? } ?>

	var form=document.payForm;
	var usePform=document.usePform;
	usePform.target = "ifrm";
	usePform.action = "card_update.php";
	usePform.payM.value = form.payM.value;
	usePform.useP.value = form.useP.value;
	usePform.transM.value = form.transM.value;
	usePform.totalM.value = form.totalM.value;
	<? if ($admin_row[bTransmethod]=="y"){ /// 배송방법 사용시?>
	for(i=0; i < form.transMethod.length; i++)
	{
		if(form.transMethod[i].checked)
		{
			usePform.transMethod.value = form.transMethod[i].value;
		}
	}
	<? } ?>
	<?
	switch($admin_row[pgName])
	{
		case 'dacom':
			echo "document.dacomForm.amount.value = form.payM.value;";
			break;
		case 'allat':
			echo "document.allatForm.allat_amt.value = form.payM.value;";
			break;
		case 'inicis':
			echo "document.ini.price.value = form.payM.value;";
			break;
		case 'kcp':
			echo "document.kcpForm.good_mny.value = form.payM.value;";
			break;
	}
	?>

	usePform.submit();
}
function trade_update2() // 주문정보 IFRAME 으로 DB에 갱신
{
	var form=document.payForm;
	var usePform=document.usePform;
	usePform.target = "ifrm";
	usePform.action = "card_update2.php";
	usePform.payM.value = form.payM.value;
	usePform.useP.value = form.useP.value;
	usePform.transM.value = form.transM.value;
	usePform.totalM.value = form.totalM.value;

	usePform.submit();
}
//적립금 사용
function setPaymoney(possP,payM)
{
	var popayM = <?=$admin_row[popayM]?>;

	var form=document.payForm;
	var usePform=document.usePform;
	var usePoint = form.usePoint.value;
	/*
	if(form.payMethod[0].checked)
	{
		alert("카드결제 시 적립금은 사용할 수 없습니다.");
	}
	else if(!numCheck(usePoint))
	*/
	if(!numCheck(usePoint))
	{
		alert("사용 적립금이 올바르지 않습니다.");
		form.usePoint.focus();
	}
<?if($admin_row[bCashDC] == "y"){?>
	//else if(form.payMethod[1].checked && (form.payM.value >= <?=$admin_row[cashlimit]?>))
	//{
	//	alert("무통장 할인 적용시 적립금은 사용할 수 없습니다.");
	//}
<?}?>
	else if(usePoint > possP)
	{
		alert("사용가능 적립금을 초과하였습니다.\n\n사용가능 적립금 : "+possP);
		form.usePoint.focus();
	}
	else if(payM <usePoint)
	{
		alert("지불가격 이상의 적립금을 사용할 수 없습니다.");
		form.usePoint.focus();
	}
	else if(payM <popayM)
	{
		alert("적립금 사용은 상품구매금액이 "+popayM+"원 이상일때 사용가능합니다");
		form.usePoint.focus();
	}
	else if(usePoint < <?=$admin_row[poMin]?>)
	{
		alert("적립금은 <?=$admin_row[poMin]?>원 이상일때 사용가능합니다.");
		form.usePoint.focus();
	}
	else
	{
		alert("적립금이 사용되었습니다.");
		usePform.pay_ready.value = "usePoint";
		form.useP.value=usePoint;
		form.payM.value=payM - usePoint;
		trade_update();
	}
}

function paySendit(str,str2)
{
	var form=document.payForm;
	var ch_payM = false;
	var paybtn_Status = 'nsWait';
	viewAct(paybtn_Status);		//결제버튼 숨기기
	if(str ==1)
	{
		// 재고품절
		var tell = "죄송합니다. ("+str2+") 상품의 마지막 재고가 조금전에 구매되었습니다.";
		paybtn_Status = 'nsAct';
		location.href="cart.php";
	}
	else if(str ==2)
	{
		// 재고초과
		var tell = "죄송합니다. ("+str2+") ";
		paybtn_Status = 'nsAct';
		location.href="cart.php";
	}
<?
	if($admin_row[pgName]=="allat")	//allat 소스
	{
		echo "	document.allatForm.allat_card_yn.value = 'N';\n";
		echo "	document.allatForm.allat_bank_yn.value = 'N';\n";
		echo "	document.allatForm.allat_vbank_yn.value = 'N';\n";
	}
?>
	//결제방식 확인
	var ch_payM = ch_payMethod();
	if(ch_payM == false)	// 결제작업 위한 추가 입력사항 필요
	{
		paybtn_Status = 'nsAct';
	}
	else if(ch_payM == "card")						//신용카드
	{
<?		//PG사별 신용카드 결제 옵션처리
		if($admin_row[pgName]=="dacom")			//dacom 소스
		{
			if($admin_row[pG_test]=="y")	echo "		document.dacomForm.action = 'http://pg.dacom.net:7080/card/cardAuthAppInfo.jsp';\n";
			else							echo "		document.dacomForm.action = 'http://pg.dacom.net/card/cardAuthAppInfo.jsp';\n";
		}
		else if($admin_row[pgName]=="allat")	//allat 소스
		{
			echo "		document.allatForm.allat_card_yn.value = 'Y';\n";
		}
		else if($admin_row[pgName]=="inicis")	//inicis 소스
		{
			echo "		document.ini.mid.value = '".($admin_row[pG_test]=="y" ? "INIpayTest":$admin_row[shopId])."';\n";
			echo "		document.ini.gopaymethod.value = 'onlycard';\n";
		}
		else if($admin_row[pgName]=="kcp")		//kcp 소스
		{
			echo "document.kcpForm.pay_method.value = '100000000000';\n";
		}
		else
		{
			echo "		alert('해당 PG사의 카드결제는 준비중 입니다');\n";
			echo "		paybtn_Status = 'nsAct';\n";
		}
		//PG사별 신용카드 결제 옵션처리 끝
?>
	}
	else if(ch_payM == "hand")					//핸드폰
	{
<?		//PG사별 핸드폰 결제 옵션처리
		if($admin_row[pgName]=="dacom")			//dacom 소스
		{
			if($admin_row[pG_test]=="y")	echo "		document.dacomForm.action = 'http://pg.dacom.net:7080/wireless/wirelessAuthAppInfo1.jsp';\n";
			else							echo "		document.dacomForm.action = 'https://pg.dacom.net/wireless/wirelessAuthAppInfo1.jsp';\n";
		}
		else if($admin_row[pgName]=="allat")	//allat 소스
		{
			echo "		alert('해당 PG사의 핸드폰 결제는 제공되지 않는 서비스 입니다');\n";
			echo "		paybtn_Status = 'nsAct';\n";
		}
		else if($admin_row[pgName]=="inicis")	//inicis 소스
		{
			echo "		document.ini.mid.value = '".($admin_row[pG_test]=="y" ? "INIpayTest":$admin_row[shopId])."';\n";
			echo "		document.ini.gopaymethod.value = 'onlyhpp';\n";
		}
		else if($admin_row[pgName]=="kcp")		//kcp 소스
		{
			echo "document.kcpForm.pay_method.value = '000010000000';\n";
		}
		else
		{
			echo "		alert('해당 PG사의 핸드폰 결제는 준비중 입니다');\n";
			echo "		paybtn_Status = 'nsAct';\n";
		}
		//PG사별 핸드폰 결제 옵션처리 끝
?>
	}
	else if(ch_payM == "iche")					//계좌이체
	{
<?		//PG사별 계좌이체 결제 옵션처리
		if($admin_row[pgName]=="dacom")			//dacom 소스
		{
			if($admin_row[pG_test]=="y")	echo "		document.dacomForm.action = 'http://pg.dacom.net:7080/transfer/transferSelectBank.jsp';\n";
			else							echo "		document.dacomForm.action = 'http://pg.dacom.net/transfer/transferSelectBank.jsp';\n";
			echo "		document.dacomForm.buyerssn.value = form.ssh1.value + form.ssh2.value;\n";
			echo "		document.dacomForm.pid.value = form.ssh1.value + form.ssh2.value;\n";
		}
		else if($admin_row[pgName]=="allat")	//allat 소스
		{
			echo "		document.allatForm.allat_bank_yn.value = 'Y';\n";
		}
		else if($admin_row[pgName]=="inicis")	//inicis 소스
		{
			echo "		document.ini.mid.value = '".($admin_row[pG_test]=="y" ? "INIpayTest":$admin_row[shopId])."';\n";
			echo "		document.ini.gopaymethod.value = 'onlydbank';\n";
		}
		else if($admin_row[pgName]=="kcp")		//kcp 소스
		{
			echo "	document.kcpForm.pay_method.value = '010000000000';\n";
			echo "	document.kcpForm.escw_used.value='N';\n";
			echo "	document.kcpForm.pay_mod.value='N';\n";

		}
		else
		{
			echo "		alert('해당 PG사의 계좌이체 결제는 준비중 입니다');\n";
			echo "		paybtn_Status = 'nsAct';\n";
		}
		//PG사별 계좌이체 결제 옵션처리 끝
?>
	}
	else if(ch_payM == "cyber")					//무통장(가상계좌)
	{
<?		//PG사별 가상계좌 결제 옵션처리
		if($admin_row[pgName]=="dacom")			//dacom 소스
		{
			if($admin_row[pG_test]=="y")	echo "		document.dacomForm.action = 'http://pg.dacom.net:7080/cas/casRequestSA.jsp';\n";
			else							echo "		document.dacomForm.action = 'http://pg.dacom.net/cas/casRequestSA.jsp';\n";
			echo "		document.dacomForm.buyerssn.value = form.ssh1.value + form.ssh2.value;\n";
			echo "		document.dacomForm.pid.value = form.ssh1.value + form.ssh2.value;\n";
		}
		else if($admin_row[pgName]=="allat")	//allat 소스
		{
			echo "		document.allatForm.allat_vbank_yn.value = 'Y';\n";
		}
		else if($admin_row[pgName]=="inicis")	//inicis 소스
		{
			echo "		document.ini.mid.value = '".($admin_row[pG_test]=="y" ? "INIpayTest":$admin_row[shopId])."';\n";
			echo "		document.ini.gopaymethod.value = 'onlyvbank';\n";
			echo "		document.ini.INIregno.value = form.ssh1.value + form.ssh2.value;\n";
		}
		else if($admin_row[pgName]=="kcp")//kcp소스
		{
			echo "	document.kcpForm.pay_method.value = '001000000000';\n";
			echo "	document.kcpForm.escw_used.value='Y';\n";
			echo "	document.kcpForm.pay_mod.value='Y';\n";
		}
		else
		{
			echo "		alert('해당 PG사의 가상계좌 결제는 준비중 입니다');\n";
			echo "		paybtn_Status = 'nsAct';\n";
		}
		//PG사별 가상계좌 결제 옵션처리 끝
?>
	}
	else if(ch_payM == "bank")					//무통장(상점측)
	{
		if(form.bankInfo.selectedIndex==0)		//무통장 계좌선택여부 확인
		{
			alert("은행을 선택해 주십시오.");
			form.bankInfo.focus();
			paybtn_Status = 'nsAct';
		}
	}

	if(paybtn_Status == 'nsAct')
	{
		viewAct(paybtn_Status);		//결제버튼 보이기
	}
	else
	{
		trade_update();
	}
}

//카드결제 통합
function go_card()
{
	//카드결제 일괄처리 소스 시작
	<?
	if($admin_row[pgName]=="dacom")
	{
		//데이콤 소스
		?>
	var popWindow = window.open("","Window","width=470, height=500, menubar=no, status, scrollbars");
	if(popWindow == null)
	{
		var g_fIgSP2 = false;
		g_fIgSP2 = (window.navigator.appMinorVersion.indexOf("SP2") != -1);
		if (g_fIgSP2)
		{
			alert("고객님의 안전한 결제를 위하여 결제용 암호화 프로그램의 설치가 필요합니다.\n\n고객님의 컴퓨터 환경은 Windows XP(SP2)이므로 "
					+ "다음 단계에 따라 진행하십시오.\n\n\n"
					+ "1. 브라우저(인터넷 익스플로어) 상단의 노란색 알림 표시줄을 마우스로 클릭 하십시오.\n\n"
					+ "2. 'ActiveX 컨트롤 설치'를 선택하십시오.\n\n"
					+ "3. 보안 경고창이 나타나면 '설치'를 눌러서 진행하십시오.\n");
			viewAct('nsAct');		//결제버튼 보이기
		}
	}
	else
	{
		document.dacomForm.target = "Window";
		document.dacomForm.submit();
	}<?

	}
	elseif($admin_row[pgName]=="allat")
	{
		//allat 소스
		?>
	var rtn=ftn_approval(document.allatForm);
	if(rtn == false)
	{
		viewAct('nsAct');		//결제버튼 보이기
	}<?

	}
	elseif($admin_row[pgName]=="inicis")
	{
		//inicis 소스
		?>
	var aa=pay(document.ini);
	///////////////////////////////////////////////////////////////
	//pay함수는 결제 콘트롤의 종료표시를 누르면 false를 반납한다.//
	//결제사항을 모두 만족시키면 true를 반납한다.//////////////////
	///////////////////////////////////////////////////////////////

	if (aa == true)
	{
		document.ini.submit();
	}
	else
	{
		viewAct('nsAct');		//결제버튼 보이기
	}
<?}else if($admin_row[pgName]=="kcp"){?>
	var aa=jsf__pay(document.kcpForm);
	if (aa == true)
	{
		document.kcpForm.submit();
	}
	<? } ?>
}

function payMethodUseChk()
{
}

//-->
</SCRIPT><?
if($admin_row[pgName]=="inicis") $modOnload="onload='trade_update();enable_click();'";
else $modOnload="onload='trade_update();payMethodUseChk();createGoodsInfo();'";
?>
<? include "top.php";?>
<table width="1100" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
<form name="tog"><input type="hidden" name="togVal"></form>
	<tr>
		<? include "left_menu.php";?>
		<td valign="top" width="920" bgcolor="<?=$arColor[9]?>">
			<table width="920" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="<?=$arColor[9]?>" valign="top">
					<td colspan="2">
						<table width="920" height="30" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc17]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc17]?>" rowspan="2"></td>
								<td width="220" bgcolor="<?=$subdesign[bc17]?>"><img src="./upload/design/<?=$subdesign[img17]?>" ></td>
								<td bgcolor="<?=$subdesign[bc17]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc17]?>"> <img src='image/good/icon0.gif'>&nbsp; 현재위치 : HOME &gt; 결제정보</font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="920">
						<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td align="center"><?
								if ($subdesign[titimg17])
								{
									?><img src="./upload/design/<?=$subdesign[titimg17]?>" ><?
								}
								else
								{
									?><img src="image/work/order_end.gif" ><?
								}
								?></td>
							</tr>
						</table>
						<br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height='2' bgcolor='<?=$arColor[0]?>'></td>
							</tr>
							<tr>
								<td>
									<table width="670" border="0" cellspacing="0" cellpadding="0" height="30" align="center">
										<tr bgcolor="<?=$arColor[1]?>" align="center">
											<td width="40"><font color='<?=$arColor[2]?>'><b>번호</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="<?=$__TNAME_TD_WIDTH?>"><font color='<?=$arColor[2]?>'><b>상품명</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="100"><font color='<?=$arColor[2]?>'><b>옵션</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="70"><font color='<?=$arColor[2]?>'><b>상품가</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<?if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member"){?>
											<td width="66"><font color='<?=$arColor[2]?>'><b>적립금</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<?}?>
											<td width="41"><font color='<?=$arColor[2]?>'><b>수량</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="80"><font color='<?=$arColor[2]?>'><b>합계 (원)</b></font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='1' bgcolor='<?=$arColor[0]?>'></td>
							</tr>
							<tr>
								<td valign="top">
									<table width="670" border="0" cellspacing="0" cellpadding="0" height="25" align="center"><?
									$gcnt = 0;
									$cart_qry = "select * from cart where userid='$_SESSION[GOOD_SHOP_USERID]' order by goodsIdx desc";
									$cart_result	 = $MySQL->query($cart_qry);
									$cart_goods_cnt = $MySQL->is_affected();
									$total_price = 0;
									$total_point = 0;
									while($cart_row = mysql_fetch_array($cart_result))
									{
										$goods_row = $MySQL->fetch_array("select * from goods where idx=$cart_row[goodsIdx]"); //상품정보
										$gname = addslashes($goods_row[name]);
										$gprice = new CGoodsPrice($goods_row[idx]);
										if ($admin_row[bNew])
										{
											$bNew = limitday($goods_row[writeday],$admin_row[new_day]);
											if (empty($bNew) && $goods_row[bNew]) $bNew = "<img src='upload/goods_new_img'>";
										}
										$bHit =$goods_row[bHit]?"<img src='upload/goods_hit_img'>":"";
										$bEtc =$goods_row[bEtc]?"<img src='upload/goods_etc_img'>":"";

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

										$optionArr = Array("$cart_row[option1]","$cart_row[option2]","$cart_row[option3]");
										$tprice = $cart_row[price] * $cart_row[cnt];
										$total_point += $cart_row[point];
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

										//에스크로용 변수 생성
										$goodsname[$gcnt]=StringCut($gname,6);
										$goodsprice[$gcnt]=$cart_row[price];
										$goodsquantity[$gcnt]=$cart_row[cnt];
										?>
										<tr>
											<td width="41" height="25" align="center"><?=$cart_goods_cnt?></td>
											<td width="45" height="25" align="center"><img src="./upload/goods/<?=$img_str?>" width="40" height="40"></td>
											<td width="<?=$__TNAME_TD_WIDTH-44?>" height="25" align="left"><?=$goods_row[name]?> <?=$bHit?> <?=$bNew?> <?=$bEtc?> <?=$user_icon?></td>
											<td width="101" height="25" align="center" align="center">
												<table width="100" border="0" cellspacing="0" cellpadding="0"><?
												for($i=0;$i<count($optionArr);$i++)
												{
													if(!empty($optionArr[$i]))
													{
														$option = explode("」「",$optionArr[$i]);
														?>
													<tr>
														<td width="45"  bgcolor="<?=$arColor[5]?>"> <div align="center"><?=$option[0]?> </div></td>
														<td bgcolor="<?=$arColor[6]?>"> <div align="left"> : <?=($option[1]=='0')?"선택안함":$option[1]?></div></td>
													</tr>
													<tr bgcolor="<?=$arColor[7]?>">
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
												?>
												</table>
											</td>
											<td width="71" height="25" align="right"><?=$gprice->PutPrice();?>&nbsp;</td><?
											if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
											{
												?><!-- 관리자적립금사용 && 회원 -->
											<td width="67" height="25" align="right"><?=PriceFormat($cart_row[point])?>&nbsp;</td><?
											}
											?>
											<td width="42" height="25" align="center"><?=$cart_row[cnt]?></td>
											<td width="80" height="25" align="right"> <FONT COLOR="<?=$arColor[14]?>"><?=PriceFormat($tprice)?></FONT>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="8" height="1" bgcolor='<?=$arColor[4]?>'></td>
										</tr><?
											$total_price +=$tprice;	//총구매가격
											$cart_goods_cnt --;
											$gcnt++;
									}
									?>
									</table>
								</td>
							</tr><?
							if(empty($admin_row[bTrans]) && empty($admin_row[chakbul]))
							{
								$transM = 0;
								$transMstr = "무료";
							}
							else if(empty($admin_row[bTrans]) && $admin_row[chakbul])	//배송비미사용
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
							// 추가배송비 모듈
							$trans_zip = $MySQL->fetch_array("SELECT * from trans_add limit 1");
							if($trans_zip[first_zip] > $trans_zip[last_zip])
							{
								$trans_row = $MySQL->fetch_array("SELECT transP from trans_add WHERE '$rzip' between last_zip  and first_zip limit 1");
							}else{
								$trans_row = $MySQL->fetch_array("SELECT transP from trans_add WHERE '$rzip' between first_zip  and last_zip limit 1");
							}
							if ($trans_row && $transMstr!="착불")
							{
								$MySQL->query("UPDATE trade SET trans_add='y' WHERE tradecode='$tradecode'");
								$MySQL->query("UPDATE trade_temp SET trans_add='y' WHERE tradecode='$tradecode'");
								$transM+= $trans_row[transP];
								// 무료일때 추가배송비 정보만 추가
								if ($transMstr=="무료") $transMstr = "</font>도서산간 추가배송비 <font color=green>".PriceFormat($trans_row[transP])." 원";
								// 일반적인 금액일때 일반배송비에 추가배송비 문자열추가/////
								else if ($transMstr!="착불" && $transMstr!="무료")  $transMstr.= " </font>+ 도서산간 추가배송비 <font color=green>".PriceFormat($trans_row[transP])." 원";
							}
							# 무통장 결제시 현금 할인
							if($admin_row[bCashDC] == "y")
							{
								$total_price_dc = $total_price-($total_price * ( $admin_row[DCRate] / 100 ));
								if($transM > 0) $total_price_dc += $transM; // 배송비가 있을 경우 추가
							}
							$payMoney = $total_price +$transM;  ///////////////// 결제 금액
							$MySQL->query("update  trade set payM=$payMoney,transM='$transM',totalM=$total_price where tradecode='$tradecode'");
							?>
							<tr>
								<td height="30">
									<table width="670" border="0" cellspacing="1" cellpadding="0">
										<tr>
											<td bgcolor="<?=$arColor[3]?>" height="30" align="right">[ 배송비 : <font color="<?=$arColor[8]?>"><?=$transMstr?></font> <?
											if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
											{
												?>, 적립금 <?=PriceFormat($total_point)?>원<?}?> ] <B>결제금액</B> : <b><font color="<?=$arColor[8]?>"><?=PriceFormat($total_price+$transM)?>원</font></b></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<script>
						function chk_dc(fg)
						{
						<?
						if($admin_row[bCashDC] == "y")
						{
						?>
							var preprice = <?=$total_price+$transM?>;
							var form=document.payForm;
							if(fg=="bank")
							{
								form.selectSale[1].checked = true;
								<?if($GOOD_SHOP_PART=="member"){?>
								form.useP.value = "";
								form.usePoint.value= "";
								<?}?>
								form.payM.value = preprice;
								<?if($admin_row[cashlimit]){?>
								//if(form.payMethod[1].checked)
								if($("input[name=payMethod]:checked").val() == "bank")
								{
									if(form.payM.value >= <?=$admin_row[cashlimit]?>)
									{
										document.all.pricetitle.style.display="";
										<?if($GOOD_SHOP_PART=="member"){?>
										document.all.pointTable.style.display="none";
										<?}?>
										document.all.pricetitle.innerHTML=" ▶ 무통장결제시 <font color='blue'><b><?=$admin_row[DCRate]?>%</b></font>할인 적용, 세금계산서는 할인적용안됨 ";
										form.payM.value = <?=$total_price_dc?>;
									}
									else
									{
										alert("현금할인은 상품금액이 <?=$admin_row[cashlimit]?>원 이상일 경우 적용됩니다.");
										form.selectSale[0].checked = true;
									}
								}
								else
								{
									alert("카드결제 시 현금할인은 받으실 수 없습니다.");
									form.selectSale[0].checked = true;
								}
								trade_update2();
								<?}?>
							}
							//else if(fg=="card")
							else
							{
								var preprice = <?=$payMoney?>;
								<?if($GOOD_SHOP_PART=="member"){?>
								document.all.pointTable.style.display="";
								<?}?>
								form.payM.value = preprice;
								document.all.pricetitle.style.display="none";
								trade_update2();
							}
							/*
							else if(fg=="anycard")
							{
								var preprice = <?=$payMoney?>;
								<?if($GOOD_SHOP_PART=="member"){?>
								//form.useP.value = "";
								//form.usePoint.value= "";
								document.all.pointTable.style.display="";
								<?}?>
								//if(form.payMethod[0].checked)
								//{
									form.payM.value = preprice;
								//}
								document.all.pricetitle.style.display="none";
							}
							else
							{
								alert("페이지데이터가 잘못되었습니다. 새로고침을 해주세요");
							}
							*/
						<?
						}
						?>
						}
						</script>
						<br>
						<!-- 적립금사용시 사용되는 폼 및 카드결제시 사용-->
						<form name="usePform" method="post" action="card_update.php">
						<input type="hidden" name="useP">
						<input type="hidden" name="tradecode" value="<?=$tradecode?>">
						<input type="hidden" name="payM">
						<input type="hidden" name="transM">
						<input type="hidden" name="totalM">
						<input type="hidden" name="transMethod">
						<input type="hidden" name="pay_ready">
						<input type="hidden" name="payMethod">
						</form>
						<iframe name="ifrm" width='0' height='0' frameborder='0'></iframe>
						<!-- 딜러의 도소매 구입을 위한 폼-->
						<form name="dealform" method="post" action="order_table.php">
						<input type="hidden" name="deal" value=""> <!-- so : 소매 do : 도매-->
						<input type="hidden" name="tradecode" value="<?=$tradecode?>">
						</form>
						<form name="payForm" method="post" action="<?=$SSLURL?>order_table_ok.php">
						<input type="hidden" name="GM_Shop_PayMethod" value="OffBank"><!-- 무통장 여부 확인 -->
						<input type="hidden" name="useP"><!-- 사용한 적립금 -->
						<input type="hidden" name="tradecode" value="<?=$tradecode?>"><!-- 주문코드 -->
						<input type="hidden" name="channel" value="<?=$channel?>"><!--ex)cart:장바구니에서구매 direct:바로구매하기 --><?
						if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
						{
							if($member_row[point] < $admin_row[poMin])
							{
								$possPoint	= 0;
							}
							else if($member_row[point] >=$admin_row[poMin] && $member_row[point] <$admin_row[poMax])
							{
								$possPoint  = $member_row[point];
							}
							else
							{
								if($admin_row[poMaxunlimit]) $possPoint = $member_row[point];
								else $possPoint = $admin_row[poMax];
							}
							if($admin_row[poMaxunlimit])	$maxPointStr="<FONT COLOR='blue'>무제한</FONT>";
							else							$maxPointStr="<FONT COLOR='blue'>".PriceFormat($admin_row[poMax])."</FONT> 원까지";
							?>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height="30" colspan="2">&nbsp;<img src='image/member/icon_my.gif' align='absmiddle'><b>&nbsp;구매금액정보</b></td>
							</tr>
							<tr>
								<td colspan='3' bgcolor='<?=$arColor[0]?>' height='2'></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[1]?>"> &nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>상품금액</font></td>
								<td height="25" width="496" colspan="2"> &nbsp;&nbsp;<input class="box_s" type="text" name="totalM" size="15" style="font-size: 9pt; border:0 solid #000000;background-color:white;text-align:right;" readonly value="<?=$total_price?>"> 원 &nbsp; </td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[1]?>">&nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>배 송 료</font></td>
								<td height="25" width="496"> &nbsp;&nbsp;<input class="box_s" type="text" name="transM" size="15" style="font-size: 9pt; border:0 solid #000000;background-color:white;text-align:right;" readonly value="<?=$transM?>"> 원&nbsp;&nbsp; </td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[1]?>">&nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>결제금액</font></td>
								<td height="25" width="496"> &nbsp;&nbsp;<input class="box_s" type="text" name="payM" size="15" style="font-size: 9pt; border:0 solid #000000;background-color:white;text-align:right;color:red;" readonly value="<?=$payMoney?>"> 원 &nbsp; <span id="pricetitle" style="display:none"></span> </td>
							</tr>
							<!--
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr id="saleinfo" name="saleinfo">
								<td height="25" width="104" bgcolor="<?=$arColor[1]?>">&nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>할인선택</font></td>
								<td height="25"style="padding:0 0 0 60px">
									<input type="radio" name="selectSale" value="po" onclick="chk_dc('card');" checked>적립금 <input type="radio" name="selectSale" value="per" onclick="chk_dc('bank');"> 현금할인
								</td>
							</tr>
							-->
							<tr id="saleinfo_bar" name="saleinfo_bar">
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td colspan="2"><br><br></td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor="<?=$arColor[9]?>"></td>
							</tr><!-- 배송방법 --><?
							if ($admin_row[bTransmethod]=="y")
							{
								?>
							<tr>
								<td height="1" colspan="3" bgcolor="<?=$arColor[9]?>"></td>
							</tr>
							<tr>
								<td height="30" colspan="3">&nbsp;<img src='image/member/icon_my.gif' align='absmiddle'><b>&nbsp;배송방법선택</b></td>
							</tr>
							<tr>
								<td colspan='3' bgcolor='<?=$arColor[0]?>' height='2'></td>
							</tr>
							<tr>
								<td height="25" width="496"  colspan="3">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" width="30"><input type="radio" name="transMethod" value="t" checked></td>
											<td align="left" width="80">택배발송 </td>
											<td><?=nl2br($admin_row[method_1])?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="496"  colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" width="30"><input type="radio" name="transMethod" value="k" ></td>
											<td align="left" width="80">화물배송 </td>
											<td><?=nl2br($admin_row[method_2])?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="496"  colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" width="30"><input type="radio" name="transMethod" value="q" ></td>
											<td align="left" width="80">퀵배송 </td>
											<td><?=nl2br($admin_row[method_3])?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td colspan="3"><br><br></td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor="<?=$arColor[9]?>"></td>
							</tr><!-- 배송방법 --><?
							}
							else
							{
								$transMethod="t";
							}
							?>
						</table>
						<?
						}
						else //비회원
						{
							?>







						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height="30" colspan="2">&nbsp;<img src='image/member/icon_my.gif' align='absmiddle'><b>&nbsp;구매금액정보</b></td>
							</tr>
							<tr>
								<td colspan='3' bgcolor='<?=$arColor[0]?>' height='2'></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[1]?>"> &nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>상품금액</font></td>
								<td height="25" width="496" colspan="2"> &nbsp;&nbsp;<input class="box_s" type="text" name="totalM" size="15" style="font-size: 9pt; border:0 solid #000000;background-color:white;text-align:right;" readonly value="<?=$total_price?>"> 원 &nbsp; </td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[1]?>">&nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>배 송 료</font></td>
								<td height="25" width="496"> &nbsp;&nbsp;<input class="box_s" type="text" name="transM" size="15" style="font-size: 9pt; border:0 solid #000000;background-color:white;text-align:right;" readonly value="<?=$transM?>"> 원&nbsp;&nbsp; </td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="<?=$arColor[1]?>">&nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>결제금액</font></td>
								<td height="25" width="496"> &nbsp;&nbsp;<input class="box_s" type="text" name="payM" size="15" style="font-size: 9pt; border:0 solid #000000;background-color:white;text-align:right;color:red;" readonly value="<?=$payMoney?>"> 원 &nbsp; <span id="pricetitle" style="display:none"></span> </td>
							</tr>
							<!--
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr id="saleinfo" name="saleinfo">
								<td height="25" width="104" bgcolor="<?=$arColor[1]?>">&nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>할인선택</font></td>
								<td height="25"style="padding:0 0 0 60px">
									<input type="radio" name="selectSale" value="po" disabled>적립금 <input type="radio" name="selectSale" value="per" checked disabled> 현금할인
								</td>
							</tr>
							-->
							<tr id="saleinfo_bar" name="saleinfo_bar">
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td colspan="2"><br><br></td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor="<?=$arColor[9]?>"></td>
							</tr><!-- 배송방법 --><?
							if ($admin_row[bTransmethod]=="y")
							{
								?>
							<tr>
								<td height="1" colspan="3" bgcolor="<?=$arColor[9]?>"></td>
							</tr>
							<tr>
								<td height="30" colspan="3">&nbsp;<img src='image/member/icon_my.gif' align='absmiddle'><b>&nbsp;배송방법선택</b></td>
							</tr>
							<tr>
								<td colspan='3' bgcolor='<?=$arColor[0]?>' height='2'></td>
							</tr>
							<tr>
								<td height="25" width="496"  colspan="3">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" width="30"><input type="radio" name="transMethod" value="t" checked></td>
											<td align="left" width="80">택배발송 </td>
											<td><?=nl2br($admin_row[method_1])?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="496"  colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" width="30"><input type="radio" name="transMethod" value="k" ></td>
											<td align="left" width="80">화물배송 </td>
											<td><?=nl2br($admin_row[method_2])?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="496"  colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" width="30"><input type="radio" name="transMethod" value="q" ></td>
											<td align="left" width="80">퀵배송 </td>
											<td><?=nl2br($admin_row[method_3])?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td colspan="3"><br><br></td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor="<?=$arColor[9]?>"></td>
							</tr><!-- 배송방법 --><?
							}
							else
							{
								$transMethod="t";
							}
							?>
						</table>







							<?
						}
						?>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">

							<tr>
								<td height="30" colspan="2">&nbsp;<img src='image/member/icon_my.gif' align='absmiddle'><b>&nbsp;결제방법선택</b></td>
							</tr><?
							if(0 < ($admin_row[bCardpay] + $admin_row[bIchepay] + $admin_row[bHpppay] + $admin_row[bCyberpay]))
							{
								?>
							<tr>
								<td colspan='2' bgcolor='<?=$arColor[0]?>' height='2'></td>
							</tr>
							<tr>
								<td width="496" colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr><?
										if($admin_row[bCardpay])
										{
											?>
											<td align="center" height="25" width="30"><input type="radio" name="payMethod" value="card" onclick="javascript:bank_select();chk_dc('card');"></td>
											<td align="left">신용카드 </td><?
										}
										if($admin_row[bHpppay])
										{
											?>
											<td align="center" height="25" width="30"><input type="radio" name="payMethod" value="hand" onclick="javascript:bank_select();"></td>
											<td align="left">핸드폰</td><?
										}
										if($admin_row[bIchepay])
										{
											?>
											<td align="center" height="25" width="30"><input type="radio" name="payMethod" value="iche" onclick="javascript:bank_select();"></td>
											<td align="left">계좌이체</td><?
										}
										if($admin_row[bCyberpay])
										{
											?>
											<td align="center" height="25" width="30"><input type="radio" name="payMethod" value="cyber" onclick="javascript:bank_select();"></td>
											<td align="left">에스크로</td><?
										}
											?>
										</tr><?
										//KCP는 불필요, 결제플러그인에서 받음
										if(0 < ($admin_row[bIchepay] + $admin_row[bCyberpay]))	//실시간/가상계좌 결제시 주민번호 입력요구
										{
											?>
											<!--
										<tr>
											<td height="30" align='center' colspan="<?=($admin_row[bCardpay] + $admin_row[bIchepay] + $admin_row[bHpppay] + $admin_row[bCyberpay]) * 2?>"><input type=text name=ssh1 size=6 maxlength=6 value="<?=$ssh[0]?>">-<input type=password name=ssh2 size=7 maxlength=7 value="<?=$ssh[1]?>"> 비회원 주민번호입력(필수)</td>
										</tr>--><?
										}
											?>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1"  colspan="2" bgcolor='<?=$arColor[4]?>'></td>
							</tr><?
							}
							if($admin_row[bBankpay])
							{
								?>
							<tr>
								<td height="25" width="496"  colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" width="30" height="30"><input type="radio" name="payMethod" value="bank" onclick="javascript:bank_select();" <?if(empty($admin_row[bCardpay])) echo"checked";?> checked></td>
											<td align="left" width="120" >무통장입금 </td>
											<td align="left"><select name="bankInfo">
											<option value="0">.................통장 선택...................</option><?
											for($i=1,$j=0;$i<=10;$i++,$j++)
											{
												//통장 1 ~ 10
												if($bBank[$j])
												{
													?><option style="background-color:<?=$arColor[19]?>;" <? if ($i==1) echo "selected";?> value="<?=$bankName[$j]?> <?=$bankId[$j]?> (<?=$bankOwn[$j]?>)"><?=$bankName[$j]?> <?=$bankId[$j]?> (<?=$bankOwn[$j]?>)</option><?
												}
											}
											?></select><?
											$now = time();
											$now = date("Y-m-d",$now);
											$now = explode("-",$now);
											?><br>입금예정일 &nbsp;&nbsp;<select name="year"><?
											for ($i=$now[0]; $i<$now[0]+1; $i++)
											{
												?><option value="<?=$i?>"><?=$i?></option><?
											}
											?></select>년 <select name="month"><?
											for ($i=1; $i<13; $i++)
											{
												?><option value="<?=$i?>" <? if ($i == $now[1]) echo "selected";?>><?=$i?></option><?
											}
											?></select>월 <select name="day"><?
											for ($i=1; $i<32; $i++)
											{
												?><option value="<?=$i?>" <? if ($i == $now[2]) echo "selected";?>><?=$i?></option><?
											}
											?></select>일<br> 입금자명 <input type="text" class="box_s" name="payer" size=10 value="<?=$name?>"></td>
										</tr>
									</table>
								</td>
							</tr><?
							}
							?>
							<?
							if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
							{
								?>
							<tr>
								<td height="25" width="496"  colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
										</tr>
										<tr id="saleinfo" name="saleinfo">
											<td height="25" width="120">&nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>할인선택</font></td>
											<td height="25"style="padding:0 0 0 25px">
												<input type="radio" name="selectSale" value="po" onclick="chk_dc('card');" checked>적립금 <input type="radio" name="selectSale" value="per" onclick="chk_dc('bank');"> 현금할인
											</td>
										</tr>
										<tr>
											<td height="1" colspan="2" bgcolor='<?=$arColor[4]?>'></td>
										</tr>
									</table>
								</td>
							</tr>
							<?
							}
							else
							{
								?>
							<tr>
								<td height="25" width="496"  colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
										</tr>
										<tr id="saleinfo" name="saleinfo">
											<td height="25" width="120">&nbsp;&nbsp;&nbsp;<font color='<?=$arColor[2]?>'>할인선택</font></td>
											<td height="25"style="padding:0 0 0 25px">
												<input type="radio" name="selectSale" value="po" disabled>적립금 <input type="radio" name="selectSale" value="per" checked disabled> 현금할인
											</td>
										</tr>
									</table>
								</td>
							</tr>
								<?
							}
							?>
						</table>
						<?
						if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
						{
							?>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" id="pointTable">
							<tr>
								<td height="30" colspan="3">&nbsp;<img src='image/member/icon_my.gif' align='absmiddle'><b>&nbsp;적립금 정보</b></td>
							</tr>
							<tr>
								<td colspan='3' bgcolor='<?=$arColor[0]?>' height='2'></td>
							</tr>
							<tr>
								<td height="25" width="180" bgcolor="<?=$arColor[1]?>"> &nbsp;&nbsp;<font color='<?=$arColor[2]?>'>적립금</font></td>
								<td height="25" colspan="2" > &nbsp;&nbsp;<?=PriceFormat($member_row[point])?> 원</td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="180" bgcolor="<?=$arColor[1]?>"> &nbsp;&nbsp;<font color='<?=$arColor[2]?>'>사용가능 적립금</font></td>
								<td height="25" colspan="2">&nbsp;&nbsp;<?=PriceFormat($possPoint)?> 원 </td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" width="180" bgcolor="<?=$arColor[1]?>"> &nbsp;&nbsp;<font color='<?=$arColor[2]?>'>적립금 사용</font></td>
								<td height="25" width="490" align="center"> 사용할 적립금 입력 : <input class="box" type="text" name="usePoint" size="15" <?=__ONLY_NUM?>></td>
								<td  valign="middle" align="left" width="386"><a href="javascript:setPaymoney(<?=$possPoint?>,<?=$payMoney?>);"><img src="image/icon/point_use.gif" border="0"></a></td>
							</tr>
							<tr>
								<td height="1" colspan="3" bgcolor='<?=$arColor[4]?>'></td>
							</tr>
							<tr>
								<td height="25" colspan="3">&nbsp;&nbsp;&nbsp;<FONT  COLOR="#993300">※ 결제금액이 <FONT COLOR="blue"><?=PriceFormat($admin_row[popayM])?></FONT> 원 이상이며 적립금이 <FONT COLOR="blue"><?=PriceFormat($admin_row[poMin])?></FONT>원 이상일때 <?=$maxPointStr?> 사용 가능합니다.</FONT></td>
							</tr>
							<?
							if($admin_row[bCashDC] == "y")
							{
							?>
							<tr>
								<td height="1" colspan="3" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" colspan="3">&nbsp;&nbsp;&nbsp;알림1)결제방법이 변경되면 적립금을 적용은 무효화됩니다.</td>
							</tr>
							<tr>
								<td height="25" colspan="3">&nbsp;&nbsp;&nbsp;알림2)상품금액이 <font color="blue"><b><?=$admin_row[cashlimit]?>원</b></font> 이상일경우 <b>무통장</b>을 선택하시면 <font color="red"><b><?=$admin_row[DCRate]?>%</b></font>의 할인을 받으실 수 있으며<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red"><b><?=$admin_row[DCRate]?>%</b></font>의 할인 적용 대상일 경우 적립금은 사용하실 수 없습니다.</td>
							</tr>
							<tr>
							<?
							}
							?>
						</table><br>
							<?
						}
						?>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr align="center">
								<td colspan="2" height="30"><br>오늘은 <B><?=date("Y년 m월 d일")?></B> 입니다.<br><br></td>
							</tr>
							<tr align="center">
								<td colspan="2">
									<table width="250" border="0" cellspacing="0" cellpadding="0" align="center" id='nsPre' style='display:block'>
										<tr align="center">
											<td colspan="2">결제 준비중 입니다. 잠시만 기다려 주십시요.</td>
										</tr>
									</table>
									<table width="250" border="0" cellspacing="0" cellpadding="0" align="center" id='nsAct' style='display:none'>
										<tr align="center">
											<td><img src="image/icon/account.gif" border="0" onclick="javascript:paySendit('<?=$limit?>','<?=$limit_good?>');" style="cursor:pointer;"></td>
											<td><a href="order_table.php?orderCancel=y&tradecode=<?=$tradecode?>"><img src="image/icon/cancel_lag.gif" border="0"></a></td>
										</tr>
									</table>
									<table width="480" border="0" cellspacing="0" cellpadding="0" align="center" id='nsWait' style='display:none'>
										<tr align="center">
											<td colspan="2">결제가 진행중 입니다. 결제창을 닫으신 경우에는 페이지 새로고침을 하여 주십시요.</td>
										</tr>
									</table><br>
								</td>
							</tr>
							<tr>
								<td colspan="2" bgcolor='<?=$arColor[10]?>' height='1'></td>
							</tr>
							<tr>
								<td colspan="2" height="30" bgcolor='<?=$arColor[11]?>' style='padding:0 0 0 10'><img src='image/index/icon_cate00.gif'> <font color='3d5b75'><b>배송정보</b></font></td>
							</tr>
							<tr>
								<td colspan="2" bgcolor='<?=$arColor[10]?>' height='1'></td>
							</tr>
							<tr valign="top">
								<td colspan="2" style='padding:10 10 10 10'><?=$xTrans?></td>
							</tr>
							<tr>
								<td colspan="2" bgcolor='<?=$arColor[10]?>' height='1'></td>
							</tr>
						</table>
						</form><!-- payForm --><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?
	$cart_result = @$MySQL->query("select *from cart where userid='$_SESSION[GOOD_SHOP_USERID]'");
	$inSuccess =true;
	while($cart_row = mysql_fetch_array($cart_result))
	{
		$qry = "select code, name from goods where idx=$cart_row[goodsIdx] limit 1";
		$goods_row = $MySQL->fetch_array($qry);
		$gname = addslashes($goods_row[name]);
	}
	?>
</table>
<? include "copy.php"; ?>
<?
$_SELF=explode("/",$_SERVER[PHP_SELF]);
$_SELF[count($_SELF)-1]="";
$_PAY_OK_FILE=implode("/", $_SELF);
$_This_folder="http://".$_SERVER[HTTP_HOST].$_PAY_OK_FILE;

if($admin_row[pgName]=="dacom")	// 데이콤 소스
{
	//암호화 기능 적용
	$hashdata = md5($admin_row[shopId].$tradecode.$payMoney.$admin_row[shop_pg_mertkey]);	//암호화된 hashdata 결과물
	?>
<form name="dacomForm" method="POST" action="">
<input type="hidden" name="mid" value="<?=$admin_row[shopId]?>">
<input type="hidden" name="oid" value="<?=$tradecode?>">
<input type="hidden" name="amount" value="<?=$payMoney?>">
<input type="hidden" name="note_url" value="<?= $_This_folder?>AllplanPG/dacom/normal_note_url.php">
<input type="hidden" name="ret_url" value="<?= $_This_folder?>order_table_ok.php">
<input type="hidden" name="fail_url" value="<?= $_This_folder?>cart.php">
<input type="hidden" name="hashdata" value="<?=$hashdata?>">
<input type="hidden" name="buyer" value="<?=$temp_row[name]?>">
<!-- 통계서비스를 위한 선택적인 hidden정보 -->
<input type="hidden" name="producttype" value="">
<input type="hidden" name="productcode" value="">
<input type="hidden" name="productinfo" value="<?=$goods_row[name]?>">
<input type="hidden" name="buyerid" value="<?=$_SESSION[GOOD_SHOP_USERID]?>">
<input type="hidden" name="buyerip" value="<?=$REMOTE_ADDR?>">
<input type="hidden" name="buyerssn" value="">
<input type="hidden" name="pid" value="<?=$ssh[0]?><?=$ssh[1]?>">
<input type="hidden" name="buyeraddress" value="<?=$temp_row[adr1] ." " .$temp_row[adr2]?>">
<input type="hidden" name="buyeremail" value="<?=$temp_row[email]?>">
<input type="hidden" name="buyerphone" value="<?=$temp_row[hand]?>">
<input type="hidden" name="deliveryinfo" value="<?=$temp_row[radr1] ." " .$temp_row[radr2]?>">
<input type="hidden" name="receiver" value="<?=$temp_row[rname]?>">
<input type="hidden" name="receiverphone" value="<?=$temp_row[rhand]?>">
<!-- 할부개월 선택창 제어를 위한 선택적인 hidden정보 -->
<input type="hidden" name="install_fr" value="">
<input type="hidden" name="install_to" value="">
<input type="hidden" name="install_range" value="">
<!-- 무이자 할부 여부를 선택하는 hidden정보 -->
<input type="hidden" name="nointerest" value="0">
<input type="hidden" name="escrowflag" value=""><?//에스크로 거래여부는 널값 : 데이콤이 결제창에서 구매자에게 에스크로거래여부 선택창을 보여줌도록 함?>
</form><?

}
elseif($admin_row[pgName]=="allat")	//allat
{
	$pG_shopId = ($admin_row[pG_test]=="y") ? "allat_test02":$admin_row[shopId];
	?>
<script language=JavaScript src="https://tx.allatpay.com/common/AllatPayRE.js"></script>
<script language=Javascript>
function ftn_approval(dfm)
{
	var ret;
	ret = visible_Approval(dfm);	//Function 내부에서 submit을 하게 되어있음.
	if( ret.substring(0,4)!="0000" && ret.substring(0,4)!="9999")
	{
		// 오류 코드 : 0001~9998 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
		alert(ret.substring(4,ret.length));		// Message 가져오기
		return false;
	}
	if( ret.substring(0,4)=="9999" )
	{
		// 오류 코드 : 9999 의 오류(사용자 취소)에 대해서 적절한 처리를 해주시기 바랍니다.
		alert(ret.substring(8,ret.length));		// Message 가져오기
		return false;
	}
}
</script>
<form name="allatForm"  method=POST action="order_table_ok.php">
<?//필수정보 :결제 필수 항목?>
<?//상점 ID?><input type='hidden' name="allat_shop_id" value="<?=$pG_shopId?>">
<?//주문번호?><input type='hidden' name="allat_order_no" value="<?=$tradecode?>">
<?//결제금액?><input type='hidden' name="allat_amt" value="<?=$payMoney?>">
<?//회원ID?><input type='hidden' name="allat_pmember_id" value="<?=$_SESSION[GOOD_SHOP_USERID]?>">
<?//상품코드?><input type='hidden' name="allat_product_cd" value="<?=$goods_row[code]?>">
<?//상품명?><input type='hidden' name="allat_product_nm" value="<?=$goods_row[name]?>">
<?//결제자성명?><input type='hidden' name="allat_buyer_nm" value="<?=$temp_row[name]?>">
<?//수취인성명?><input type='hidden' name="allat_recp_nm" value="<?=$temp_row[rname]?>">
<?//수취인주소?><input type='hidden' name="allat_recp_addr" value="<?=$temp_row[radr1]." ".$temp_row[radr2]?>">
<?//과세여부 : Y(과세), N(비과세)?><input type='hidden' name="allat_tax_yn" value="Y">
<?//주문정보암호화필드?><input type='hidden' name=allat_enc_data value="">
<?//올앳참조필드?><input type='hidden' name=allat_opt_pin value="VIEW">
<?//올앳참조필드?><input type='hidden' name=allat_opt_mod value="WEB">

<?//옵션정보 : D값이나 필드가 없을 경우 상점 속성이 반영됨, 사용(Y),사용하지 않음(N),상점 속성(D)?>
<?//신용카드 결제 사용 여부?><input type='hidden' name="allat_card_yn" value="N">
<?//계좌이체 결제 사용 여부?><input type='hidden' name="allat_bank_yn" value="N">
<?//무통장(가상계좌) 결제 사용 여부?><input type='hidden' name="allat_vbank_yn" value="N">
<?//무통장(가상계좌) 인증 Key : 계좌 채번방식이 Key별 방식일 때만 사용함?><input type='hidden' name="allat_account_key" value="">
<?//일반/무이자 할부 사용여부 : 일반(N), 무이자 할부(Y), 상점 속성(D)?><input type='hidden' name="allat_zerofee_yn" value="D">
<?//카드 인증 여부 : 인증(Y), 인증 사용않음(N), 인증만 사용(X)?><input type='hidden' name="allat_cardcert_yn" value="N">
<?//자동 매입 사용 여부 : 자동매입(Y), 수동 매입(N), 상점속성(D)?><input type='hidden' name="allat_sanction_yn" value="D">
<?//보너스포인트 사용 여부 : 사용(Y), 사용 않음(N)?><input type='hidden' name="allat_bonus_yn" value="N">
<?//현금 영수증 발급 여부?><input type='hidden' name="allat_cash_yn" value="D">
<?//상품이미지 URL?><input type='hidden' name="allat_product_img" value="">
<?//결제 정보 수신 E-mail : 에스크로 서비스 사용시에 필수 필드임?><input type='hidden' name="allat_email_addr" value="<?=$temp_row[email]?>">
<?//테스트 여부 : 테스트(Y),서비스(N)?><input type='hidden' name="allat_test_yn" value="<?=$admin_row[pG_test]=="y"?"Y":"N"?>">
<?//상품 실물 여부 : 실물(Y), 실물아님(N), 상품이 실물이고, 10만원 이상 계좌이체시 에스크로 적용여부 이용
?><input type='hidden' name="allat_real_yn" value="Y">
</form>
<script language=Javascript>initCheckOB();</script><?

}
elseif($admin_row[pgName]=="inicis")	//이니시스소스
{
	$pG_shopId = ($admin_row[pG_test]=="y") ? "INIpayTest":$admin_row[shopId];
	?>
<!-------------------------------------->
<!-이니시스 소스 추가 시작(JAVASCRIPT)-->
<!-------------------------------------->
<script language=javascript src="http://plugin.inicis.com/pay40.js">
</script>
<script language=javascript>
StartSmartUpdate();

var openwin;

function pay(frm)
{
	// MakePayMessage()를 호출함으로써 플러그인이 화면에 나타나며, Hidden Field
	// 에 값들이 채워지게 됩니다. 일반적인 경우, 플러그인은 결제처리를 직접하는 것이
	// 아니라, 중요한 정보를 암호화 하여 Hidden Field의 값들을 채우고 종료하며,
	// 다음 페이지인 INIsecurepay.php로 데이터가 포스트 되어 결제 처리됨을 유의하시기 바랍니다.

	if(document.ini.clickcontrol.value == "enable")
	{

		if(document.ini.goodname.value == "")  // 필수항목 체크 (상품명, 상품가격, 구매자명, 구매자 이메일주소, 구매자 전화번호)
		{
			alert("상품명이 빠졌습니다. 필수항목입니다.");
			return false;
		}
		else if(document.ini.price.value == "")
		{
			alert("상품가격이 빠졌습니다. 필수항목입니다.");
			return false;
		}
		else if(document.ini.buyername.value == "")
		{
			alert("구매자명이 빠졌습니다. 필수항목입니다.");
			return false;
		}
		else if(document.ini.buyeremail.value == "")
		{
			alert("구매자 이메일주소가 빠졌습니다. 필수항목입니다.");
			return false;
		}
		else if(document.ini.buyertel.value == "")
		{
			alert("구매자 전화번호가 빠졌습니다. 필수항목입니다.");
			return false;
		}
		else if(document.INIpay == null || document.INIpay.object == null)  // 플러그인 설치유무 체크
		{
			alert("\n이니페이 플러그인 128이 설치되지 않았습니다. \n\n안전한 결제를 위하여 이니페이 플러그인 128의 설치가 필요합니다. \n\n다시 설치하시려면 Ctrl + F5키를 누르시거나 메뉴의 [보기/새로고침]을 선택하여 주십시오.");
			return false;
		}
		else
		{
			/******
			 * 플러그인이 참조하는 각종 결제옵션을 이곳에서 수행할 수 있습니다.
			 * (자바스크립트를 이용한 동적 옵션처리)
			 */

			/*
			50000원 미만은 할부불가, 일시불만 플러그인에서 선택 제한하기 위한 적용
			*/

			if(parseInt(frm.price.value) < 50000)
			{
				/****  ※ 주의 ※  - 무이자 가맹점만 계약된 경우는 nointerest 값을 "yes"로 수정
									 그 외에는 일반적으로 "no"으로 세팅
				****/
				frm.nointerest.value = "no";
				frm.quotabase.value = "일시불";
			}
			else
			{
				/*
					※ 주의 ※ - 위의 5만원미만 조건에 대해 맞지않을 때 무이자 관련 필드(nointerest, quotabase)의
						 기준조건을 그대로 유지할 수 있도록 아래 소스 중에 nointerest, quotabase 값과 동일하게 적용
				*/

				frm.nointerest.value = "no";
				frm.quotabase.value = "선택:일시불:3개월:4개월:5개월:6개월:7개월:8개월:9개월:10개월:11개월:12개월";
			}

			if (MakePayMessage(frm))
			{
				disable_click();
				openwin = window.open("AllplanPG/inicis/INIpay41/sample/childwin.html","childwin",
												"width=299,height=149");
				return true;
			}
			else
			{
				alert("결제를 취소하셨습니다.");
				return false;
			}
		}
	}
	else
	{
		return false;
	}
}


function enable_click()
{
	document.ini.clickcontrol.value = "enable"
}

function disable_click()
{
	document.ini.clickcontrol.value = "disable"
}

function focus_control()
{
	if(document.ini.clickcontrol.value == "disable")
		openwin.focus();
}
</script>
<!-- pay()가 "true"를 반환하면 post된다 -->
<form name="ini" method=post action="order_table_ok.php" onSubmit="return pay(this)">
<input type=hidden name=gopaymethod value="onlycard">
<input type=hidden name=goodname value="<?=$goods_row[name]?>">
<input type=hidden name=oid value="<?=$tradecode?>">
<input type=hidden name=price value="<?=$payMoney?>">
<input type=hidden name=buyername value="<?=$temp_row[name]?>">
<input type=hidden name=buyeremail value="<?=$temp_row[email]?>">
<input type=hidden name=buyertel value="<?=$temp_row[hand]?>">
<input type=hidden name=INIregno value="">
<input type=hidden name=mid value="<?=$pG_shopId?>">
<input type=hidden name=currency value="WON">
<input type=hidden name=nointerest value="no">
<input type=hidden name=quotabase value="선택:일시불:3개월:4개월:5개월:6개월:7개월:8개월:9개월:10개월:11개월:12개월">
<input type=hidden name=acceptmethod value="HPP(2):NEMO(1)">
<input type=hidden name=quotainterest value="">
<input type=hidden name=paymethod value="">
<input type=hidden name=ini_escrow_dlv  value="5">
<input type=hidden name=recvname value="<?=$temp_row[rname]?>">
<input type=hidden name=recvtel value="<?=$temp_row[rtel]?>">
<input type=hidden name=recvaddr value="<?=$temp_row[radr1] ." " .$temp_row[radr2]?>">
<input type=hidden name=recvpostnum value="<?=$temp_row[rzip]?>">
<input type=hidden name=recvmsg value="<?=$temp_row[content]?>">
<input type=hidden name=cardcode value="">
<input type=hidden name=cardquota value="">
<input type=hidden name=rbankcode value="">
<input type=hidden name=reqsign value="DONE">
<input type=hidden name=encrypted value="">
<input type=hidden name=sessionkey value="">
<input type=hidden name=uid value="">
<input type=hidden name=sid value="">
<input type=hidden name=version value=4000>
<input type=hidden name=clickcontrol value="">
</form>
<!-------------------------->
<!-이니시스 소스 추가 종료-->
<!--------------------------><?
}elseif($admin_row[pgName]=="kcp"){
	//$admin_row[pG_test] = "y";
	if($admin_row[pG_test]=="y")
	{
		?>
<script language='javascript' src='http://pay.kcp.co.kr/plugin/payplus_test.js'></script>
		<?
	}
	else
	{
		?>
<script language='javascript' src='http://pay.kcp.co.kr/plugin/payplus.js'></script>
		<?
	}
	?>
<SCRIPT LANGUAGE="JavaScript">StartSmartUpdate();</SCRIPT>
<?
	if($admin_row[pG_test]=="y")
	{
		$act_url = "https://testpay.kcp.co.kr/Pay/payplus.jsp";//테스트
		$site_cd="T0007";
		$site_key="4Ho4YsuOZlLXUZUdOxM1Q7X__";
	}
	else
	{
		$act_url = "https://pay.kcp.co.kr/Pay/payplus.jsp";
		$site_cd=$admin_row[shopId];
		$site_key=$admin_row[shop_pg_mertkey];
	}
	/*
	$cQry = "SELECT * FROM cart WHERE userid='$_SESSION[GOOD_SHOP_USERID]'";
	$cResult = @mysql_query($cQry);
	$cNum = @mysql_num_rows($cResult);
	*/
	$transTermDay ="05";
	if($cNum>1) $goodInfo = $goods_row[name]."외 ".$cNum-1;
	else $goodInfo = $goods_row[name];


?>
<SCRIPT LANGUAGE="JavaScript">
<!--
var GNARR = new Array();
var GPARR = new Array();
var GCARR = new Array();
var cNum="1";
if(cNum=="") cNum=0;
<?
$gnStr=$goodsname[0]."외".($gcnt-1)."개||";
$gpStr="";
$gcStr="";
for($k=0; $k<$gcnt; $k++)
{
	//$gnStr .= $goodsname[$k]."||";
	//$gpStr .= $goodsprice[$k]."||";
	//$gcStr .= $goodsquantity[$k]."||";
	$gp+= $goodsprice[$k];
	$gc+= $goodsquantity[$k];
}
$gpStr .= $gp."||";
$gcStr .= $gc."||";
?>
var gnStr="<?=$gnStr?>";
var gpStr="<?=$gpStr?>";
var gcStr="<?=$gcStr?>";
GNARR = gnStr.split("||");
GPARR = gpStr.split("||");
GCARR = gcStr.split("||");

function createGoodsInfo()
{
	var chr30 = String.fromCharCode(30);// Record Separator 변수 생성
	var chr31 = String.fromCharCode(31);// Unit Separator 변수 생성
	if(cNum >= 20) cNum=20;
	var goodInfo ="";
	for(var i=0; i<cNum; i++)
	{
		var num =i+1;
		goodInfo = goodInfo + "seq=" + num + chr31 + "ordr_numb=<?=$tradecode?>" + chr31 + "good_name="+GNARR[i]+ chr31 + "good_cntx="+GCARR[i]+ chr31 + "good_amtx="+GPARR[i]+ chr30;
	}
	document.kcpForm.good_info.value = goodInfo;
}

function  jsf__pay( form )
{
	if( document.Payplus.object == null )
	{
		openwin = window.open( 'AllplanPG/kcp/chk_plugin.html', 'chk_plugin', 'width=420, height=100, top=300, left=300' );
	}

	if ( MakePayMessage( form ) == true )
	{
		openwin = window.open( 'AllplanPG/kcp/proc_win.html', 'proc_win', 'width=420, height=100, top=300, left=300' );
		return  true;
	}
	else
	{
		return  false;
	}
}
//-->
</SCRIPT>
<FORM name='kcpForm' action="AllplanPG/kcp/pp_ax_hub.php" method="post">
<input type='hidden' name='site_cd'        value='<?=$site_cd?>'>";
<input type='hidden' name='site_key'       value='<?=$site_key?>'>";
<input type='hidden' name='pay_method'     value='100000000000'>
<input type='hidden' name='tran_cd'        value='00100000'>
<input type='hidden' name='module_type'    value='01'>
<input type='hidden' name='currency'       value='WON'>
<input type='hidden' name='escw_used'      value='N'>
<input type='hidden' name='pay_mod'        value='N'>
<input type='hidden' name='deli_term'      value='<?=$transTermDay?>'>
<input type='hidden' name='bask_cntx'      value='1'>
<input type='hidden' name='good_info'      value=''>
<input type='hidden' name='req_tx'         value='pay'>

<input type='hidden' name='res_cd'         value=''>
<input type='hidden' name='res_msg'        value=''>
<input type='hidden' name='tno'            value=''>
<input type='hidden' name='trace_no'       value=''>
<input type='hidden' name='enc_info'       value=''>
<input type='hidden' name='enc_data'       value=''>
<input type='hidden' name='use_pay_method' value=''>
<input type='hidden' name='userkey'        value=''>
<input type='hidden' name='soc_no'         value=''>
<input type='hidden' name='ordered'        value=''>
<input type='hidden' name='quotaopt'       value='12'>

<input type='hidden' name='good_mny'       value='<?=$payMoney?>'>
<input type='hidden' name='ordr_idxx'      value='<?=$tradecode?>'>
<input type='hidden' name='buyr_tel1'      value='<?=$temp_row[hand]?>'>
<input type='hidden' name='buyr_tel2'      value='<?=$temp_row[hand]?>'>
<input type='hidden' name='buyr_name'      value='<?=$temp_row[name]?>'>
<input type='hidden' name='buyr_mail'      value='<?=$temp_row[email]?>'>
<input type='hidden' name='good_name'      value='<?=$goods_row[name]?>'>
<input type='hidden' name='returnUrl'      value='http://dodamdodam.com/order_table_ok.php'>
<input type='hidden' name='name'           value='<?=$temp_row[name]?>'>
<input type='hidden' name='tel'            value='<?=$temp_row[tel]?>'>
<input type='hidden' name='email'          value='<?=$temp_row[email]?>'>
<input type='hidden' name='rcvr_name'      value='<?=$temp_row[rname]?>'>
<input type='hidden' name='rcvr_tel1'      value='<?=$temp_row[rtel]?>'>
<input type='hidden' name='rcvr_tel2'      value='<?=$temp_row[rhand]?>'>
<input type='hidden' name='rcvr_mail'      value='<?=$temp_row[remail]?>'>
<input type='hidden' name='rcvr_zipx'      value='<?=$temp_row[rzip]?>'>
<input type='hidden' name='rcvr_add1'      value='<?=$temp_row[radr1]?>'>
<input type='hidden' name='rcvr_add2'      value='<?=$temp_row[radr2]?>'>
<input type='hidden' name='site_logo'      value='http://www.kcp.co.kr/logo.gif'>
</FORM>
<?}?>
</div>
</body>
</html>
