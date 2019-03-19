<?php
if (@eregi("order.php","$_SERVER[PHP_SELF]")) {
header("HTTP/1.0 404 Not Found");
require_once("customavatars/foundfile.htm");
exit();
}
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

if($type != "" && $type != "set") {
redirect();	
}

if ($Mlevel == 4) {

if ($type == "set") {

$cat = $_POST["cat"];
$cat_id = $_POST["cat_id"];

$i_c = 0;
$j_c = 0;
while($i_c < count($cat_id)) {

		$updatingCat = @DBi::$con->query("UPDATE ".$Prefix."CATEGORY SET CAT_ORDER = '".$cat[$j_c]."' WHERE CAT_ID = ".$cat_id[$i_c]." ");
        $j_c++;
        $i_c++;
        
}

$forum = $_POST["forum"];
$forum_id = $_POST["forum_id"];

$i_f = 0;
$j_f = 0;
while($i_f < count($forum_id)) {
		$updatingForum = @DBi::$con->query("UPDATE ".$Prefix."FORUM SET F_ORDER = '".$forum[$j_f]."' WHERE FORUM_ID = ".$forum_id[$i_f]." ");
        $j_f++;
        $i_f++;

}
	                echo'
                    <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['order']['the_order_is_saved'].'</font><br><br>
                           <meta http-equiv="refresh" content="2; URL=index.php?mode=order">
                           <a href="index.php?mode=order">'.$lang['all']['click_here_to_go_cat_forum'].'</a><br><br>
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
}
if ($type == "") {
echo'
<center>
<table class="optionsbar" cellSpacing="2" width="99%" border="0" id="table11">
	<tr>
		<td class="optionsbar_title" Align="middle" vAlign="center" width="100%">'.$lang['order']['the_order_cat_and_forum'].'</td>';
  go_to_forum();
  echo '
    </tr>
</table>
</center><br>';

echo'
<form method="post" action="index.php?mode=order&type=set">
<center>
<table bgcolor="gray" class="grid" cellSpacing="1" cellPadding="3" width="40%" border="0">
';

	$result = @DBi::$con->query("SELECT * FROM " . $Prefix . "CATEGORY WHERE SITE_ID = '$Site_ID' OR SITE_ID = '0' ORDER BY CAT_ORDER ASC") or die (DBi::$con->error);

	$num = @mysqli_num_rows($result);


	if ($num <= 0) {


                      echo'
                      <tr>
                          <td class="f1" vAlign="center" align="middle" colspan="2"><br>'.$lang['order']['non_cat'].'<br><br></td>
                      </tr>';
	}

while ($row = @mysqli_fetch_array($result)) {

                      echo'
                      <tr>
                          <td class="cat">'.$row[CAT_NAME].'</td>
                          <td class="cat"><input type="text" name="cat[]" size="2" value="'.$row[CAT_ORDER].'">
                          <input type="hidden" name="cat_id[]" value="'.$row[CAT_ID].'"></td>
                      </tr>';
                      
	$result2 = @DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE CAT_ID = '$row[CAT_ID]' ORDER BY F_ORDER ASC") or die (DBi::$con->error);

	$num2 = @mysqli_num_rows($result2);
	if ($num2 <= 0) {


                      echo'
                      <tr>
                          <td class="f1" vAlign="center" align="middle" colspan="2"><br>'.$lang['order']['non_forum'].'<br><br></td>
                      </tr>';
	}

while ($row2 = @mysqli_fetch_array($result2)) {
                      echo'
                      <tr>
                          <td class="f1">'.$row2[F_SUBJECT].'</td>
                          <td class="f1" align="middle"><input type="text" name="forum[]" size="2" value="'.$row2[F_ORDER].'">
                          <input type="hidden" name="forum_id[]" value="'.$row2[FORUM_ID].'"></td>
                      </tr>';

}
}
echo'
</table>
</center>
<div align="center"><br><input type="submit" value="'.$lang['order']['ok'].'"></div>
</form>
';

}
}
?>