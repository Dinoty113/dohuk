<?
if (@eregi("pm_to_admin.php","$_SERVER[PHP_SELF]")) {
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

if ($DBMemberID > 0) {

if ($msg == "1") {

if (members("LEVEL",$m) == 4) {

echo'<center>
<table border="1" width="80%">
	<tr class="normal">
		<td class="list_center"><br>'.icons($logo, $forum_title, "").'<br>
<u><b><font color="red" size="5">'.$lang['member']['send_pm_to_admin'].'</font></b></u><br><br>
<b><font size="3">'.$lang['pm_to_admin']['thanks_for_pm'].' '.$forum_title.'.<br>'.$lang['pm_to_admin']['note_admin'].'</font></b><br><br>
<table border="0" bodercolor="#FFFFFF" width="100%" dir="rtl" cellSpacing="1" cellPadding="5">
	<tr>
		<td class="stats_h">'.$lang['pm_to_admin']['question_1'].'</td>
		<td class="stats_h">'.$lang['pm_to_admin']['question_2'].'</td>
		<td class="stats_h">'.$lang['pm_to_admin']['question_3'].'</td>
	</tr>
	<tr>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_1'].'</font></td>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_2'].'</font></td>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_3'].'</font></td>
	</tr>
	<tr>
		<td class="stats_h">'.$lang['pm_to_admin']['question_4'].'</td>
		<td class="stats_h">'.$lang['pm_to_admin']['question_5'].'</td>
		<td class="stats_h">'.$lang['pm_to_admin']['question_6'].'</td>
	</tr>
	<tr>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_4'].'</font></td>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_5'].'</font></td>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_6'].'</font></td>
	</tr>
	<tr>
		<td class="stats_h">'.$lang['pm_to_admin']['question_7'].'</td>
		<td class="stats_h">'.$lang['pm_to_admin']['question_8'].'</td>
		<td class="stats_h">'.$lang['pm_to_admin']['question_9'].'</td>
	</tr>
	<tr>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_7'].'</font></td>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_8'].'</font></td>
		<td class="stats_p" Valign="top"><font color="red">'.$lang['pm_to_admin']['answer_9'].'</font></td>
	</tr>
</table><br><br><br>
<b><font size="3">'.$lang['pm_to_admin']['if_you_dont_need'].'</font></b><br>
<b><font color="red" size="3">'.$lang['pm_to_admin']['note_reply'].'</font></b>

<form method="post" action="index.php?mode=editor&method=sendmsg&m='.$m.'">
<input type="submit" value="'.$lang['pm_to_admin']['click_to_send_pm_admin'].'">
</form>
		</td>
	</tr>
</table>
</center>';

}

}

}

?>