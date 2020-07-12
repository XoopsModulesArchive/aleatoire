<?php


function b_aleatoire_random($options){

global $xoopsDB;
	$myts =& MyTextSanitizer::getInstance();
	$block = array();
$sql = mysql_query("SELECT * FROM ".$xoopsDB->prefix("aleatoire").""); 
$count = mysql_numrows($sql); 

mt_srand((double)microtime()*1000000);
$alea = mt_rand(1, $count);


$result = $xoopsDB->query("SELECT lien, nomlien, photo FROM ".$xoopsDB->prefix("aleatoire")." where photoid=$alea limit 1");
	
	while($row = $xoopsDB->fetchRow($result)) {  
	  
if( !strstr($row[2], 'swf'))

{
$h_vign = $options[0];
    $urlphoto = "".XOOPS_URL."/modules/aleatoire/images/";
	$taille = getimagesize($urlphoto."/".$row[2]);
    $reduc  = floor(($h_vign*100)/($taille[1]));
    $l_vign = floor(($taille[0]*$reduc)/100);
	$block['content'] .= "<a target=\"blank\" href=\"$row[0]\">";
    $block['content'] .= "<img src=\"$urlphoto/$row[2]\" ";
    $block['content'] .="width='$l_vign' height='$h_vign'>";
    $block['content'] .= "</a>&nbsp;"; 
	$block['content'] .= "<center><small><a href=$row[0]>$row[1]</a></small></center><br />";
    
	 }
	else  {
	$block['content'] .="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'>
  <param name='movie' value=".XOOPS_URL."/modules/aleatoire/images/$row[2]>
  <param name='quality' value='high'>
  <embed src=".XOOPS_URL."/modules/aleatoire/images/$row[2] quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' ></embed></object>";
	}		
	}
	return $block;
	
}

function b_aleatoire_edit($options)
{
	$form = "Resize de &nbsp;
		<input type='text' size='6' name='options[]' value='".$options[0]."' />&nbsp;pixel
		\n" ;

	return $form ;
}
?>





