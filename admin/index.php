<?
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

include("admin_header.php");


$op = 'form'; 


function formulaire() {

include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
$my_form = new XoopsThemeForm("Random Image", "formulaire", "index.php");

$my_form->addElement(new XoopsFormText("Image link", "lien", 50, 100, $lien), false);
$my_form->addElement(new XoopsFormText("Image name", "nomlien", 50, 100, $nomlien), false);
$my_form->setExtra( "enctype='multipart/form-data'" ) ; 
$img_box = new XoopsFormFile("Image", "photo", $max_imgsize);
$img_box->setExtra( "size ='50'") ;
$my_form->addElement($img_box); 
$button_tray = new XoopsFormElementTray('' ,'');
$button_tray->addElement(new XoopsFormButton('', 'post',"Submit", 'submit'));
$my_form->addElement($button_tray);
$my_form->display();
}

foreach ( $_POST as $k => $v ) { 
${$k} = $v; 
}
if ( isset($post) ) {
$op = 'post';
}

switch ($op) {


case "post": 
$max_imgsize = 100000; 
$max_imgwidth = 500; 
$max_imgheight = 500; 
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

$sql = "INSERT INTO ".$xoopsDB->prefix("aleatoire")." (lien,nomlien,photo) VALUES ('$lien','$nomlien','$photo')";
				$result=$xoopsDB->queryF($sql); 
			  redirect_header("index.php",1,'Enregistrement effectué');	    

break; 

case 'form':
default:
xoops_cp_header();

formulaire();

xoops_cp_footer();
break;
}
?>