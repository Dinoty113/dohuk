<?php
if (@eregi("policy.php","$_SERVER[PHP_SELF]")) {
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

if (mlv < 1) {

echo'<font color="red"><b><font color="black" size="-1"><center>
<table dir="rtl" cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table width="100%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10">
				<table width="100%" id="table3">
					<tr>
						<td><br>
						<p align="center">'.icons($logo, $forum_title).'</td>
						<td>
					</tr>
				</table>
				'.$lang['other']['register_policy'].'
                
<input type="submit" onclick="location.href=&#39;index.php?mode=register_member&#39;;" value="'.$lang['admin_svc']['ok'].'">
<font color="red"><b><font color="black" size="-1">
<input type="submit" onclick="location.href=&#39;index.php&#39;;" value="'.$lang['admin_svc']['no_ok'].'"></font></b></font>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</center></font></b></font>';

} else {
redirect();
}
?>