<?
if (@eregi("forum_info.php","$_SERVER[PHP_SELF]")) {
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
$f_hide = forums("HIDE", $f);
$f_level = forums("F_LEVEL", $f);
$c = forums("CAT_ID", $f);
$c_hide = cat("HIDE", $c);
$c_level = cat("LEVEL", $c);
$f_login = check_forum_login($f);
$c_login = check_cat_login($c);

if($c_level == 0 or ($c_level > 0 && $c_level <= $Mlevel)) {
} else {
redirect();
}	
if($c_hide == 0 or ($c_hide == 1 && $c_login == 1)) {
} else {
redirect();
}	
if($f_level == 0 or ($f_level > 0 && $f_level <= $Mlevel)) {
} else {
redirect();
}	
if($f_hide == 0 or ($f_hide == 1 && $f_login == 1)) {
} else {
redirect();
}
if ($f == "") {
 redirect();
}
if(!is_numeric($f) || forums("SUBJECT", $f) == "" || forums("SUBJECT", $f) == false){
	header("Location: ".index()."");
	exit();
}
if ($Mlevel > 0) {

function forum_info_mods($id){
	global $Prefix;
	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."MODERATOR WHERE FORUM_ID = '$id' ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$forum_mods = '<table class="mods" cellspacing="0" cellpadding="0"><tr>';
 	$j = 0;
	$i = 0;
	while ($i < $num){
		$member_id = mysqli_result($sql, $i, "MEMBER_ID");
		if ($j == 5){
			$forum_mods .= '</tr></table><table class="mods" cellspacing="0" cellpadding="0"><tr>';
			$j = 0;
		}
		$forum_mods .= '<td><nobr>&nbsp;';
		if ($j){
			$forum_mods .= ' + ';
		}
		$forum_mods .= normal_profile(members("NAME", $member_id), $member_id).'</td>';
	$i++;
	$j++;
	}
	$forum_mods .= '</tr></table>';
return($forum_mods);
}

echo'
<center>
<table dir="rtl" cellSpacing="2" width="99%" border="0" id="table11">
	<tr>
		<td width="100%"></td>';
		go_to_forum();
	echo'
	</tr>
</table>
</center>';

$f_name = forums("SUBJECT", $f);
$f_desc = forums("DESCRIPTION", $f);
$f_topics = topics_num($f);
$f_replies = replies_num($f);
$f_archive_topics = archive_topics_num($f);
$f_logo = forums("LOGO", $f);
$f_moderators = forum_info_mods($f);
$f_total_topics = forums("TOTAL_TOPICS", $f);
$f_total_replies = forums("TOTAL_REPLIES", $f);

$cat_id = forums("CAT_ID", $f);
$cat_name = cat("NAME", $cat_id);
$cat_monitor = normal_profile(members("NAME", cat("MONITOR", $cat_id)), cat("MONITOR", $cat_id));
$cat_deputy_monitor = normal_profile(members("NAME", cat("DEPUTY_MONITOR", $cat_id)), cat("DEPUTY_MONITOR", $cat_id));
$show_info = cat("SHOW_INFO", $cat_id);

echo'
<center>
	<table bgcolor="gray" class="grid" width="600px" cellSpacing="1" cellPadding="4" border="0">
		<tr class="fixed">
			<td class="optionheader" colspan="4"><nobr>'.$lang['others']['forum_info'].'&nbsp;<font color="yellow">'.$f_name.'</nobr></td>
		</tr>					
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['forum_name'].'</font></nobr></td>
			<td class="list" colSpan="3">
			<table cellSpacing="0" cellPadding="0">
				<tr>
					<td>'.icons($f_logo).'&nbsp;&nbsp;</td>
					<td><font size="4"><a href="index.php?mode=f&f='.$f.'">'.$f_name.'</a></font></td>
				</tr>
			</table>
			</td>
		</tr>
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['forum_category'].'</font></nobr></td>
			<td class="list" colspan="3"><nobr><font color="red">'.$forum_title.':</font>&nbsp;'.$cat_name.'</nobr></td>
		</tr>
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['forum_description'].'</font></nobr></td>
			<td class="list" colspan="3"><nobr><font size="2" color="black">'.$f_desc.'</font></nobr></td>
		</tr>';
			if ($show_info == 0) {
echo'
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['forum_monitor'].'</font></nobr></td>
			<td class="list" colspan="3"><nobr>'.$cat_monitor.'</nobr></td>
		</tr>';}
		
			if ($show_info == 0) {
echo'
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['forum_deputy_monitor'].'</font></nobr></td>
			<td class="list" colspan="3"><nobr>'.$cat_deputy_monitor.'</nobr></td>
		</tr>';}
				
		
	if (forums("SHOW_INFO", $f) == 0) {
		echo'
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['forum_moderators'].'</font></nobr></td>
			<td class="list" colspan="3"><nobr>';
			if ($f_moderators != "") {
				echo $f_moderators;
			}
			else{
				echo $lang['others']['no_moderators'];
			}
			echo'
			</nobr></td>
		</tr>';
	}
		echo'
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['total_topics'].'</font></nobr></td>
			<td class="list" width="60%"><nobr>'.member_topics_today($DBMemberID, $f).'</nobr></td>
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['all_topics'].'</font></nobr></td>
			<td class="list" width="10%"><nobr><font color="red">'.$f_total_topics.'</font></nobr></td>
		</tr>
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['total_replies'].'</font></nobr></td>
			<td class="list" width="60%"><nobr>'.member_replies_today($DBMemberID, $f).'</nobr></td>
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['all_replies'].'</font></nobr></td>
			<td class="list" width="10%"><nobr><font color="red">'.$f_total_replies.'</font></nobr></td>
		</tr>
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['forum_stat'].'</font></nobr></td>
			<td class="list" colspan="3"><nobr>'.$lang['home']['topics'].':&nbsp;<font color="red">'.$f_topics.'</font>&nbsp;&nbsp;&nbsp;&nbsp;'.$lang['home']['posts'].':&nbsp;<font color="red">'.$f_replies.'</font>&nbsp;&nbsp;&nbsp;&nbsp;'.$lang['forum_function']['topics_in_archive'].':&nbsp;<font color="red">'.$f_archive_topics.'</font></nobr></td>
		</tr>
		<tr class="fixed">
			<td class="optionheader"><nobr><font size="-1">'.$lang['others']['forum_online'].'</font></nobr></td>
			<td class="list" colspan="3" style="FONT-SIZE: 75%;">';
		if ($Mlevel == 1){
			forum_online_name("WHERE O_FORUM_ID = '$f' AND O_MEMBER_BROWSE = '1'");
			echo'<font color="red">&nbsp;+&nbsp;'.$lang['others']['forum_hide_online'].'&nbsp;</font>';
			$online_sql = DBi::$con->query("SELECT * FROM ".$Prefix."ONLINE WHERE O_FORUM_ID = '$f' AND O_MEMBER_BROWSE = '0' ") or die (DBi::$con->error);
			$online_num = mysqli_num_rows($online_sql);
			echo $online_num;	
		}
		if ($Mlevel > 1){
			forum_online_name("WHERE O_FORUM_ID = '$f'");
		}
			echo'
			</td>
		</tr>
	</table>
</center>';

}else{
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['others']['sign_in_to_show_forum_info'].'</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
}
?>