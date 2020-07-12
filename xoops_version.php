<?php
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
$modversion['name'] = _MI_aleatoire_NAME;
$modversion['version'] = 1.2;
$modversion['description'] = _MI_aleatoire_DESC;
$modversion['credits'] = "";
$modversion['license'] = "";
$modversion['author']  = "Winsion";
$modversion['image'] = "images/aleatoire_logo.png";
$modversion['dirname'] = "aleatoire";

$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables
$modversion['tables'][0] = "aleatoire";

// Partie administration
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 0;

$modversion['blocks'][3]['file'] = "aleatoire.php";
$modversion['blocks'][3]['name'] = "RandomImage";
$modvertion['blocks'][3]['description'] = "Show random images in block";
$modversion['blocks'][3]['show_func'] = "b_aleatoire_random";
$modversion['blocks'][3]['edit_func'] = "b_aleatoire_edit";
$modversion['blocks'][3]['options'] = "100";


// Templates


?>