<?php
/*
	This plug-in was developed by Andrés Perea.
	Copyright 2010  Wp-copyrightPro, IN  (http://wp-copyrightpro.com/)
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details: http://www.gnu.org/licenses/gpl.txt
*/

/*update protection*/
if($_POST['updatecopy']=="y"){
$updatecopy=update_copyprov1($_POST['click'], $_POST['selec'], $_POST['iframe'], $_POST['drop']);
}
	global $wpdb;
	$fivesdrafts = $wpdb->get_results("SELECT*FROM copyrightpro");

	foreach ($fivesdrafts as $fivesdraft) {
			$result[0]=$fivesdraft->copy_click;
			$result[1]=$fivesdraft->copy_selection;
			$result[2]=$fivesdraft->copy_iframe;
			$result[3]=$fivesdraft->copy_drop;
	}
/* cambiar imagen*/
if ($result[0]=="y"){
$nuncopy=1;
}
if ($result[1]=="y"){
$nuncopy2=1;
}
if ($result[2]=="y"){
$nuncopy3=1;
}
if ($result[3]=="y"){
$nuncopy4=1;
}
$nuncopy=$nuncopy+$nuncopy2+$nuncopy3+$nuncopy4;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
</head>

<body>
<div align="center">
  <p class="style1"><img src="<?php echo plugins_url('copyrightpro/images/copyrightpro.jpg');?>" /></p>
  <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo plugin_basename(__FILE__); ?>"><div align="left"><center><table width="716" border="0">
        <tr>
          <td><p><img src="<?php echo plugins_url('copyrightpro/images/p'.$nuncopy.'.png');?>" /></p>
            <p align="justify">CopyRightPro is a free version of <b>Wp-Copyrightpro</b> plug-in that prevents the copying of texts and images from your blog, if you install this plug-in, your content of wordpress will be protected. <b>Need 100% of protection? please download <a href="http://wp-copyrightpro.com/" target="_blank" title="Download">wp-copyrightpro version</a></b></p>
            <p align="left"><strong>Please select the protections to activate in your Wordpress.</strong><br />
              <input type="checkbox" name="click" id="checkbox" value="y" <?php if ($result[0]=="y"){?>checked<?php }?> />
              Disable right click on your Wordpress.<br />
              <input type="checkbox" name="selec" id="checkbox2" value="y" <?php if ($result[1]=="y"){?>checked<?php }?> />
              Disable selection of text.<br />
              <input type="checkbox" name="iframe" id="checkbox3" disabled="disabled" style="background:#F00;" value="y" <?php if ($result[2]=="y"){?>checked<?php }?> />
              Protects from iframes. <a href="http://wp-copyrightpro.com/" target="_blank" title="Download">Update to wp-copyrightpro</a><br />
              <input type="checkbox" name="drop" id="checkbox4" disabled="disabled" value="y" <?php if ($result[3]=="y"){?>checked<?php }?> />
              Protects from drag and drop images.
              <input type="hidden" name="updatecopy" id="checkbox5" value="y" />
              <a href="http://wp-copyrightpro.com/" target="_blank" title="Download">Update to wp-copyrightpro</a>
            </p>
            <p align="left">
              <label>
              <input type="submit" name="button" id="button" value="Update Options" />
              </label>
            </p></td>
        </tr>
      </table>
  </center>
    </div>
  </form>
</div>
</body>
</html>
