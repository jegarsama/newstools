<?

$db->debug=true;
$sql = "select * from $code where no = '$no'";

 
 $info = $db->query($sql);

  if($info[pwd] != $pwd && $admin != 1){
    err_back("패스워드가 일치하지 않습니다.");
  }

$sql = "select file1 from $code where no = '$no'";
$file1 = $db->query_one($sql);
@unlink("./data/".$code."/".$file1);

$sql = "delete from $code where no = '$no'";
$db->execute($sql);
$url = urldecode($url);
move_to($PHP_SELF."?page=$page&search=$search&word=$word&ti=$ti&co=$co");
?>