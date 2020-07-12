<?php 
$xoopsOption['pagetype'] = 'user';
include 'admin_header.php';
xoops_cp_header();
$xoopsOption['show_rblock'] =1;

if ( !$xoopsUser ) {
	redirect_header('index.php',3,_US_NOEDITRIGHT);
	exit();
}

$result = $xoopsDB->query("SELECT photoid,lien, nomlien, photo FROM ".$xoopsDB->prefix("aleatoire")." ");
	 if ($result == 0) {
    // Il n'y a aucun enregistrement dans la table
    echo "<font face='Geneva, Arial, Helvetica, sans-serif'><div align='center'><strong><font size='2'>Il n'y a pas de pèlerinage dans cette région au mois que vous avez demandé</font></strong> </div></font>";
  }
  else {
	
	
	while($row = $xoopsDB->fetchRow($result)) {  
$photoid=$row[0];
$lien=$row[1];
$nomlien=$row[2];
$photo=$row[3];
echo "
 <form action=trata.php method=get>
   <table width=600  class='outer'>
    <tr> 
      <td width='195' class='bg3'><small>$lien</small> </td>
      <td width='193' class='even'> <small>$nomlien</small></td>
      <td width='131' class='bg3'> <small>$photo</small></td>
      
	  <input name='photoid' type='hidden' value='$photoid'>
	  <input name='lien' type='hidden' value='$lien'>
	  <input name='nomlien' type='hidden' value='$nomlien'>
	  <input name='photo' type='hidden' value='$photo'>
             <td width='61' class='even'> 
        <input name='submit' type=submit class=bouton Value=Editer></td>
    </tr>
  </table>
   </form>
   
   ";

}
}

//xoops_cp_footer();

?>
