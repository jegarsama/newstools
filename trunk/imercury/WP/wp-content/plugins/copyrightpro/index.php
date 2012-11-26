<?php
/*
      Plugin Name: CopyRightPro
      Plugin URI: http://wp-copyrightpro.com/
      Description: CopyRightPro is a free version of Wp-Copyrightpro plug-in that prevents the copying of texts and images from your blog, if you install this plug-in, your content of wordpress will be protected.
      Version: 1.1
      Author: Andres Felipe Perea V.
      Author URI: http://wp-copyrightpro.com/
*/

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
	
	FOR MORE INFO: info@wp-copyrightpro.com
*/

/* INSTALL AND UNISTALL PLUG-IN */
function copypro_installv1() {
	global $wpdb;
 
	$sql = 'CREATE TABLE `copyrightpro` (
			`copy_click` VARCHAR( 1 ) NOT NULL ,
			`copy_selection` VARCHAR( 1 ) NOT NULL ,
			`copy_iframe` VARCHAR( 1 ) NOT NULL ,
			`copy_drop` VARCHAR( 1 ) NOT NULL
			) ENGINE = MYISAM DEFAULT CHARSET=utf8';
 
	$wpdb->query($sql);
	$wpdb->query('INSERT INTO `'.copyrightpro.'` SET copy_click = "y", copy_selection = "y", copy_iframe = "n", copy_drop = "n"');
}

function copypro_uninstallv1() {
	global $wpdb;
 
	$sql = "DROP TABLE `copyrightpro`";
	$wpdb->query($sql);
}


/* FUNCIONES DE PROTECCION */ 
function copyright_headv1(){

global $wpdb;
	$fivesdrafts = $wpdb->get_results("SELECT*FROM copyrightpro");

	foreach ($fivesdrafts as $fivesdraft) {
			$result[0]=$fivesdraft->copy_click;
			$result[1]=$fivesdraft->copy_selection;
	}
	
if ($result[0]=="y"){?>
<script language="Javascript">
<!-- Begin
document.oncontextmenu = function(){return false}
// End -->
</script>
<?php }

if ($result[1]=="y"){?>
<script type="text/javascript">
// IE Evitar seleccion de texto
document.onselectstart=function(){
if (event.srcElement.type != "text" && event.srcElement.type != "textarea" && event.srcElement.type != "password")
return false
else return true;
};
// FIREFOX Evitar seleccion de texto
if (window.sidebar){
document.onmousedown=function(e){
var obj=e.target;
if (obj.tagName.toUpperCase() == "INPUT" || obj.tagName.toUpperCase() == "TEXTAREA" || obj.tagName.toUpperCase() == "PASSWORD")
return true;
/*else if (obj.tagName=="BUTTON"){
return true;
}*/
else
return false;
}
}
// End -->
</script>

<?php }

}

/* PANEL DE CONTROL */

function update_copyprov1($clickpro, $selecpro, $iframepro, $droppro){
global $wpdb;
	if($clickpro==""){
	$clickpro="n";
	}
	if($selecpro==""){
	$selecpro="n";
	}
	if($iframepro==""){
	$iframepro="n";
	}
	if($droppro==""){
	$droppro="n";
	}
$wpdb->query("UPDATE copyrightpro SET copy_click = '$clickpro', copy_selection = '$selecpro', copy_iframe = '$iframepro', copy_drop = '$droppro'");
}

function panel_copyprov1() {
	include ('panel.php');
}

function config_copyprov1() {
	add_menu_page('CopyRightPro Panel', 'CopyRightPro', 'administrator', 'copyrightpro/panel.php', 'panel_copyprov1', plugins_url('copyrightpro/images/Computer.gif'));
}

/* Añadir comando wordpress */
register_activation_hook(__FILE__,'copypro_installv1'); //gancho para instalar
register_deactivation_hook(__FILE__,'copypro_uninstallv1'); //gancho para desinstalar

add_action('admin_menu','config_copyprov1');
add_action('wp_head','copyright_headv1');
?>