<?
if (@eregi("rules.php","$_SERVER[PHP_SELF]")) {
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

echo'
<center>
<table width="98%" border="1">
	                   <tr class="normal">
	                       <td class="list_center">

<br>
<center>
<table  width="50%">
	<tr>
		<td align="center"><u><b><font size="5" color="red">'.$lang['other']['rules_in'].'</font></b></u></td>
	</tr>
</table>
</center><br>
<center>
<table  width="50%">
	<tr>
		<td align="center"><b><font size="3" color="#191970">'.$lang['other']['to_post_in'].'</font></b></td></tr></table></center>
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table1">
	<tr>
		<td align="center">
'.$lang['other']['rules_in_forum'].'
		</td>
	</tr>
</table>
<center>
<table  width="80%"><tr>
		<td align="center"><b><font size="3" color="#191970">'.$lang['other']['if_you_have_any_send_to_admin'].'</font></b></td>
	</tr>
</table>
</center><br>&nbsp;
	</tr>
</table>
</center>';


?>
