<?
if (@eregi("ip.php","$_SERVER[PHP_SELF]")) {
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

if($type != "") {
redirect();	
}

if (mlv == 4 or (mlv == 3 && $deputy == 0)) {
if ($type == "") {
echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="1" width="25%">
	<tr class="fixed">
			<td class="cat" colspan="2"><nobr>'.$lang['admin']['check_ip'].'
	</tr>';

  if($_GET['ip']){
                      $ip = $_GET['ip'];
                      $sql = @DBi::$con->query("select * from ".prefix."MEMBERS WHERE M_IP = '$ip' OR M_LAST_IP = '$ip' ");
                               if(@mysqli_num_rows($sql) == 0){
                                 echo '<tr class="fixed"><td align="center" class="list" colspan="2">'.$lang['others']['no_ip'].'</td></tr>';
                               }else{
                               while($r = @mysqli_fetch_array($sql)){
                                 echo '<tr class="fixed"><td align="center" class="list" colspan="2">'.link_profile($r['M_NAME'], $r['MEMBER_ID']).'</td></tr>';
                               }           }
                    }

echo'</table>';
}
}
else {
header("Location: ".index()."");
}

?>
