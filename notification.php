<?
if (@eregi("header.php","$_SERVER[PHP_SELF]")) {
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
// #               Copyright © 2016 2019 Dilovan. All Rights Reserved          # //
// #                                                                           # //
// #                       This File Developing By Dinoty                      # //
// #                                                                           # //
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
 require_once("./engine/function.php");

$NEW_NOTS = @DBi::$con->query("SELECT * FROM ".$Prefix."NOTS WHERE USER1 = '$DBMemberID' ");
$num = @mysqli_num_rows($NEW_NOTS);
echo'
<table class="optionsbar" width="100%">
      <tr>
	     <td>
		 الأشعارات
		 </td>
	  </tr>';
	  if($num == 0){
	  echo'
	  <tr class="normal">
	  <td class="list_center" vAlign="center" colspan="10"><br>'.$lang['message']['non_notice'].'<br><br></td>';}
	  }
		  echo'
    </tr>
	  <tr>
							<td class="optionsbar_menus"><font color="red"><center>'.members_new_notice(m_id).'</center></font></td>
	  </tr>
	  
</table>

';

?>