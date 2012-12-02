<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<?
  foreach($_POST as $a => $b){
    if($count > 0){
      $chk = array_search($a,$ext);
      if(!$chk){
        $info .= "&".$a."=".$b;
        if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
      }    
    }else{
      $info .= "&".$a."=".$b;
      if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
    }
  }

function err_move1($msg,$url){
  echo("
  <script>
    alert('$msg');
    location.href = '$url';
  </script>
  ");
  exit;
}


if(!$_COOKIE[mid]){
  foreach($_POST as $a => $b){
    $etc_url .= "&".$a."=".$b;
  }
  foreach($_GET as $a => $b){
    $etc_url .= "&".$a."=".$b;
  }
  err_move1("회원전용 페이지입니다.","/imercury/jsp/member/login.php?r_url=$PHP_SELF?".$etc_url);
}
?>