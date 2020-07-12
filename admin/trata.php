<?php

include("admin_header.php");

$op = 'form'; 


function formliens() {

global $XoopsDB, $photoid,$photo,$lien,$nomlien ;
      include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
$my_form = new XoopsThemeForm("MODIFIEZ VOS LIENS", "formulaire", "trata.php");
$my_form->addElement(new XoopsFormHidden("photoid",  $photoid), true);
$my_form->addElement(new XoopsFormHidden("photo",  $photo), true);
$my_form->addElement(new XoopsFormText("Lien", "lien", 50, 100, $lien), false);
$my_form->addElement(new XoopsFormText("Nom Lien", "nomlien", 50, 100, $nomlien), false);
$button_tray = new XoopsFormElementTray('' ,'');
$button_tray->addElement(new XoopsFormButton('', 'post',"submit", 'submit'));
$button_tray->addElement(new XoopsFormButton('', 'post3',"Tout supprimer", 'submit'));
$my_form->addElement($button_tray);
	$my_form->display(); }
		
	
function formphoto() {
global $XoopsDB, $photoid,$photo,$lien,$nomlien ;
$my_form2 = new XoopsThemeForm("MODIFIEZ L'IMAGE", "formulaire", "trata.php");	
$my_form2->addElement(new XoopsFormHidden("photoid",  $photoid), true);
$my_form2->addElement(new XoopsFormHidden("photo",  $photo), true);
$my_form2->setExtra( "enctype='multipart/form-data'" ) ; 
$img_box = new XoopsFormFile("Image", "photo", $max_imgsize);
$img_box->setExtra( "size ='50'") ;
$my_form2->addElement($img_box); 
$button_tray = new XoopsFormElementTray('' ,'');
$button_tray->addElement(new XoopsFormButton('', 'post2',"Submit", 'submit'));
$my_form2->addElement($button_tray);
$my_form2->display(); 
echo "Image actuelle :";
            if( !strstr($photo, 'swf'))
{
  $h_vign = "100";
    $urlphoto = "".XOOPS_URL."/modules/aleatoire/images/";
	$taille = getimagesize($urlphoto."/".$photo);
    $reduc  = floor(($h_vign*100)/($taille[1]));
    $l_vign = floor(($taille[0]*$reduc)/100);
	
   echo "<a target=\"blank\" href=\"$urlphoto/$photo\">";
    echo "<img src=\"$urlphoto/$photo\" ";
    echo "width='$l_vign' height='$h_vign'>";
    echo "</a>&nbsp;"; 
	echo "(cliquez sur l'image pour voir en taille originale)";

  
   
	 }
	else  {
	
	echo "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'>
  <param name='movie' value=".XOOPS_URL."/modules/aleatoire/images/$photo>
  <param name='quality' value='high'>
  <embed src=".XOOPS_URL."/modules/aleatoire/images/$photo quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' ></embed></object>";
			} }

# --
foreach ( $_POST as $k => $v ) { 
${$k} = $v; 
}
if ( isset($post2) ) {
$op = 'post2';
}
if ( isset($post) ) {
$op = 'post';
}
if ( isset($post3) ) {
$op = 'post3';
}
switch($op) {
        case 'post':
	     $req="UPDATE ".$xoopsDB->prefix("aleatoire")." set lien='$lien',nomlien='$nomlien' where photoid=$photoid "; 
				$result=$xoopsDB->queryF($req); 
			  redirect_header("traital.php",1,'Modification effectué');	  
        break;
		
		case 'post3':
		$urlphoto = "".XOOPS_ROOT_PATH."/modules/aleatoire/images/";
 @unlink($urlphoto."/".$photo);		
		 $sql = "DELETE FROM ".$xoopsDB->prefix("aleatoire")." WHERE photoid=$photoid";
$result=$xoopsDB->queryF($sql); 

$sqlb = "ALTER TABLE ".$xoopsDB->prefix("aleatoire")." DROP photoid";
$result=$xoopsDB->queryF($sqlb); 

$sqla = "ALTER TABLE ".$xoopsDB->prefix("aleatoire")." ADD `photoid` INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
$result=$xoopsDB->queryF($sqla);
 redirect_header("traital.php",1,'Suppression effectué');
  break;
		
	    case 'post2':
$urlphoto = "".XOOPS_ROOT_PATH."/modules/aleatoire/images/";
 @unlink($urlphoto."/".$photo);

$max_imgsize = 100000; 
$max_imgwidth = 156; 
$max_imgheight = 134; 
$allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png');
$img_dir = XOOPS_ROOT_PATH . "/modules/aleatoire/images" ;

include_once(XOOPS_ROOT_PATH."/class/uploader.php");
$field = $_POST["xoops_upload_file"][0] ; 

if( !empty( $field ) || $field != "" ) { 


$uploader = new XoopsMediaUploader($img_dir, $allowed_mimetypes, $max_imgsize, $max_imgwidth, $max_imgheight);
$uploader->setPrefix( 'img' ) ;
if( $uploader->fetchMedia( $field ) && $uploader->upload() ) { 
$photo=$uploader->getSavedFileName();

} else { 
echo $uploader->getErrors();
}
}

			    $req="UPDATE ".$xoopsDB->prefix("aleatoire")." set photo='$photo' where photoid=$photoid "; 
				$result=$xoopsDB->queryF($req); 
			  redirect_header("traital.php",1,'Modification effectué');	  
        break;
		case 'form':
default:
xoops_cp_header();

formliens();
formphoto();
xoops_cp_footer();
break;
}  
   
?>

