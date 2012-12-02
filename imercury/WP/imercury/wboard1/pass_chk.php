<meta http-equiv="content-type" content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="Cho Sang-Won">
<link href="/<?=$skin?>/css.css" rel="stylesheet" type="text/css">
<link href="/<?=$skin?>/style.css" rel="stylesheet" type="text/css">

<Script>
function linkblur(){
if (event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG")
document.body.focus();
}
document.onfocusin=linkblur;

function sub(){
  if(form1.pwd.value == ""){
    alert("비밀번호를 입력하세요");
    form1.pwd.focus();
    return;
  }

    form1.submit();

}
</script>

<table border="0" cellpadding="2" cellspacing="1" width="600">
<form name="form1" method=post action="<?=$PHP_SELF?>">
<input type="hidden" name="no" value="<?=$no?>">
<input type="hidden" name="ti" value="<?=$ti?>">
<input type="hidden" name="co" value="<?=$co?>">
<input type="hidden" name="word" value="<?=$word?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="search" value="<?=$search?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="url" value="<?=$url?>">

  <tr>
    <Td align="Center" bgcolor="#ffffff">
      <table border="0" cellpadding="2" cellspacing="0" width="300">

        <tr>
          <td height="30" align="center">비밀번호를 입력하세요.</td>
        </tr>
        <tr>
          <td align="center"><input type="password" name="pwd" size="15"></tD>
        </tr>
        <tr>
          <Td align="center" height="40"><img src="/wboard1/btn_img/ok.gif" onclick="sub()" style="cursor:hand">&nbsp;&nbsp;<a href="<?=$PHP_SELF?>?ti=<?=$ti?>&co=<?=$co?>&word=<?=$word?>&page=<?=$page?>&search=<?=$search?>"><img src="/wboard1/btn_img/list.gif" border="0"></a>&nbsp;&nbsp;<img src="/wboard1/btn_img/back.gif" onclick="history.back()" style="cursor:hand"></td>
        </tr>
      </table>
    </td>
  </tR>
</form>
</table>
