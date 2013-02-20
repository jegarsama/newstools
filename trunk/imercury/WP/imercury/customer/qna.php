<?php
/**
 * Board Skin: 용도
 * 4.고객지원 – 1:1고객상담
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );
require_once( NEW_IMERCURY_DIR . '/include/paging_class.php' );
?>
<script type="text/javascript">
//<![CDATA[
	function sub(){
			document.formQnA.submit();
	}
//]]>
</script>
<form name="formQnA" method="post">
<input type="hidden" name="mode" value="req" />
<table width="640" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr height="27">
		<td><img src="/imercury/images/customer/img_04.gif"  ></td>
		<td valign="middle" background="/imercury/images/customer/img_05.gif"><input type="text" value="" name=subject  style="WIDTH: 500px; HEIGHT: 22px ;  border-color: #62B0FF" ></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="104"><img src="/imercury/images/customer/img_01.gif" width="104" height="27"></td>
		<td width="536"><input name="fromName" type="text" style="WIDTH: 250px; HEIGHT: 22px" ></td>
	</tr>
	<tr>
		<td colspan="2"><img src="/imercury/images/customer/img_zul.gif" width="640" height="11"></td>
	</tr>
	<tr>
		<td width="104"><img src="/imercury/images/customer/img_02.gif" width="104" height="30" ></td>
		<td><input name="fromEmail" type="text" style="WIDTH: 250px; HEIGHT: 22px" ></td>
	</tr>
	<tr>
		<td colspan="2"><img src="/imercury/images/customer/img_zul.gif" width="640" height="11"></td>
	</tr>
	<tr>
		<td colspan="2"><table width="640" height="300" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td align="center" valign=""><textarea name="content" cols="600" style="WIDTH: 600px; HEIGHT: 300px">
※ 상담문의시 아래사항을 꼭 기재하여 주시기 바랍니다.
▶보유단말기:
▶고객명    :
▶회원아이디:
▶연락처    :
▶차종    :
					</textarea></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td height="14" colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><table width="640" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="259">&nbsp;</td>
					<td width="59"><a href="javascript:sub();"><img src="/imercury/images/customer/img_btn1.gif" border=0 width="59" height="26" ></a></td>
					<td width="16">&nbsp;</td>
					<td width="50"><a href="javascript:history.back();"><img src="/imercury/images/customer/img_btn2.gif" border=0 width="50" height="26" ></a></td>
					<td width="256">&nbsp;</td>
				</tr>
			</table></td>
	</tr>
</table>
</form>