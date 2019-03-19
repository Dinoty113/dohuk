<?
/*if (@eregi("other_cat_info.php","$_SERVER[PHP_SELF]")) {
header("HTTP/1.0 404 Not Found");
require_once("customavatars/foundfile.htm");
exit();
}*/
/*/////////////////////////////////////////////////////////////////////////////////
// ############################################################################# //
// #                              Duhok Forum 2.1                              # //
// ############################################################################# //
// #                                                                           # //
// #                   --  DuHok Forum Is Free Software  --                    # //
// #                                                                           # //
// #      ================== Programming By Dilovan ====================       # //
// #                                                                           # //
// #               Copyright © 2015-2016 Dilovan. All Rights Reserved          # //
// #                                                                           # //
// #                       Developing By DuHok Forum Team :                    # //
// #                                                                           # //
// #     Programming Team : DevMedoo & Temy & Dr Zikoo && General BouGassa     # //
// #                                                                           # //
// #        Following Team : M Haroun & Dr Bad-r & reda_cool & Dz-OMAR         # //
// #                                                                           # //
// #          Thanks To All Who Helped Us To Get This Version Of DuHok         # //
// #                                                                           # //
// # ------------------------------------------------------------------------- # //
// # ------------------------------------------------------------------------- # //
// #                                                                           # //
// # If You Want Any Support Vist Down Address:-                               # //
// # Email: admin@dahuk.info                                                   # //
// # Site: http://www.startimes.com/f.aspx?mode=f&f=211                        # //
// ############################################################################# //
/////////////////////////////////////////////////////////////////////////////////*/

//------------------------------------------ OTHERS CAT --------------------------------------------

$query = "SELECT * FROM " . $Prefix . "OTHERS_CAT ";
$result = DBi::$con->query($query) or die (DBi::$con->error);

if(mysqli_num_rows($result) > 0){
$rs=mysqli_fetch_array($result);

$Cat_Name = $rs['O_CAT_NAME'];
$Cat_Url = $rs['O_CAT_URL'];
}
else{
	$Cat_Name = "";
	$Cat_Url = "";
}

$others_cat = "<a target='_blank' href='http://".$Cat_Url."'><font style='font-size: 15px; color:yellow; vertical-align: middle; font-weight: 700'>".$Cat_Name."</font></a></nobr>";

//------------------------------------------ OTHERS CAT --------------------------------------------

//----------------------------------------- OTHERS FORUM -------------------------------------------

 $queryOF = "SELECT * FROM " . $Prefix . "OTHERS_FORUM ";
 $queryOF .= " ORDER BY O_FORUMID ASC";
 $resultOF = DBi::$con->query($queryOF) or die (DBi::$con->error);

 $numOF = mysqli_num_rows($resultOF);

$iOF=0;
while ($iOF < $numOF) {

    $Forum_Name = mysqli_result($resultOF, $iOF, "O_FORUM_NAME");
    $Forum_Url = mysqli_result($resultOF, $iOF, "O_FORUM_URL");

 if ($numOF == 1){
     $others_forum = "<nobr><a class='menu' target='_blank' href='http://".$Forum_Url."'>".$Forum_Name."</a></nobr>";
 }
 else {
     $others_forum = $others_forum;
     if ($others_forum != "") {
        $others_forum .= "<nobr>  <font size='3' color='red'>*</font>  ";
     }
     $others_forum .= "<a class='menu' target='_blank' href='http://".$Forum_Url."'>".$Forum_Name."</a></nobr>";
 }
    ++$iOF;
}

//----------------------------------------- OTHERS FORUM -------------------------------------------

if ($Cat_Name != "") {

echo'

<table cellSpacing="0" cellPadding="0" width="100%" border="0">
	<tr>
		<td>
		
				<table class="grid" cellSpacing="1" cellPadding="0" width="100%" border="0">
	
	<tr>
		<td class="cat_new" width="85%">'.$others_cat.'</td>';

                      if ($Mlevel == 4) {
	echo'	<td class="cat_new" vAlign="middle" align="middle" width="10%">';
	echo'<a href="index.php?mode=other_cat_add&method=forum">'.icons($folder_other_forum, $lang['other_cat_forum']['add_forum'], "hspace=\"3\"").'</a>';
	echo'<a href="index.php?mode=other_cat_add&method=cat&type=edit">'.icons($folder_new_edit, $lang['home']['edit_cat'], "hspace=\"3\"").'</a>';
	echo'<a href="index.php?mode=other_cat_add&method=cat&type=delete">'.icons($folder_new_delete, $lang['home']['delete_cat'], "hspace=\"3\"").'</a>
		</td>';
                      }
echo'	</tr>
        </table>
        	</td>
    	</tr>
</table>
';

echo'
<table cellSpacing="0" cellPadding="0" width="100%" border="0">
	<tr>
		<td>
	';
echo'
<table class="grid" width="100%" cellSpacing="1" cellPadding="4" border="0">
';

	echo'
	<tr class="normal">
		<td dir="'.$lang['global']['dir'].'" class="f11" vAlign="middle" style="FONT-SIZE: 75%">'.$others_forum.'</td>';

                      if ($Mlevel == 4) {
	echo'	<td class="f11" vAlign="middle" align="middle" width="10.6%">';
	echo'<a href="index.php?mode=other_cat_add&method=forum&type=options">'.icons($folder_edit, $lang['home']['edit_forum'], "hspace=\"3\"").'</a>

		</td>';
                      }
echo'	</tr>
	</table>
		</td>
	</tr>
</table>';

}



?>