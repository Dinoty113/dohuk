<?
if (@eregi("mem_forum.php","$_SERVER[PHP_SELF]")) {
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

if($type != "c" && $type != "f" && $type != "liste") {
redirect();
}
if($method != "edit" && $method != "add") {
redirect();	
}

if ($Mlevel == 4) {

if ($type == "c") {

	if ($method == "edit") {
 $query = "SELECT * FROM " . $Prefix . "CATEGORY WHERE CAT_ID = '" . $c . "' ";
 $result = @DBi::$con->query($query, $connection) or die (DBi::$con->error);

$cat_hide = cat("HIDE", $c);

 if(mysqli_num_rows($result) > 0){

 $rs = @mysqli_fetch_array($result);

 $Subject = $rs['CAT_NAME'];
 $MonitorID = $rs['CAT_MONITOR'];
 $DeputyMonitorID = $rs['CAT_DEPUTY_MONITOR'];

 }
 
 $title = $lang['add_cat_forum']['edit_cat'];
 $title2 = $lang['add_cat_forum']['cat_address'];
 $info = info_icon(1);
	}
	else {
 $title = $lang['add_cat_forum']['add_new_cat'];
 $title2 = $lang['add_cat_forum']['cat_address'];
 $info = info_icon(1);
	}	
}

if ($type == "f") {

if ($c == "") {
$cat_check = forums("CAT_ID", $f);
} else {
$cat_check = $c;
}

	if ($method == "edit") {
		$Subject = forums("SUBJECT", $f);
		$F_Desc = forums("DESCRIPTION", $f);
		$F_Logo = forums("LOGO", $f);
        $F_sex = forums("SEX", $f);
		$F_total_topics = forums("TOTAL_TOPICS", $f);
		$F_total_replies = forums("TOTAL_REPLIES", $f);
		$f_hide = forums("HIDE", $f);
		$hide_mod = forums("HIDE_MOD", $f);
		$hide_photo = forums("HIDE_PHOTO", $f);
		$hide_sig = forums("HIDE_SIG", $f);
		$title = $lang['add_cat_forum']['edit_forum'];
		$title2 = $lang['add_cat_forum']['forum_address'];
		$day_archive = forums("DAY_ARCHIVE", $f);
		$active_archive = forums("CAN_ARCHIVE", $f);
		$info = info_icon(2);
	}
	else {
		$F_total_topics = 5;
		$F_total_replies = 200;
		$f_hide = 0;
		$hide_photo = 0;
		$hide_sig = 0;
		$title = $lang['add_cat_forum']['add_new_forum'];
		$title2 = $lang['add_cat_forum']['forum_address'];
		$day_archive = 30;
		$active_archive = 0;
		$info = info_icon(2);
	}
}


echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="50%">
	<form method="post" action="index.php?mode=cat_forum_info">
	<input type="hidden" name="method" value="'.$method.'">
    <input type="hidden" name="type" value="'.$type.'">
    <input type="hidden" name="cat_id" value="'.$c.'">
    <input type="hidden" name="forum_id" value="'.$f.'">
	
	</tr>';
    echo info_text(1,$lang['info']['write_subject_of_cat'],$title2);
    echo info_text(2,$lang['info']['write_subject_of_forum'],$title2);
if ($type == "c") {

if ($MonitorID == 0 OR $MonitorID == "") {
$Name = $lang['add_cat_forum']['non_monitor'];
}
else {
$Name = link_profile(member_name($MonitorID), $MonitorID);
}
if ($DeputyMonitorID == 0 OR $DeputyMonitorID == "") {
$DName = $lang['add_cat_forum']['non_deputy_monitor'];
}
else {
$DName = link_profile(member_name($DeputyMonitorID), $DeputyMonitorID);
}

    echo'

 ';
}
	echo'
	<tr>

		<td class="cat" colspan="2" align="middle">'.$lang['others']['list_hide_forum'].'<b><font color="#FF0000"> <nobr>  '.$Subject.' </nobr></td>
		</font></b>
		 		</tr>
				<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['others']['list_hide_forum'].'</nobr></td>
		<td class="list">

		</select>
		'.info_icon(5).'
		</td>
	</tr>
	'.info_text(5, $lang['others']['list_hide_forum_description'], $lang['others']['list_hide_forum']);

if ($f_hide == 0){
echo'
		</font></b>
		 		</tr>
								<tr class="fixed">

		<td class="optionheader " align="middle"  ><nobr>'.$lang['others']['not_hide_forum'].'</nobr></td>
		<td class="list">

		</select>
		'.info_icon(6).'
		</td>
	</tr>
	'.info_text(6, $lang['others']['not_hide_forum_description'], $lang['others']['not_hide_forum'] );

	}
if ($f_hide == 1){
	echo'
	</tr>
	'.info_text(8,$lang['add_cat_forum']['add_member_to_hide_forum_description'],$lang['add_cat_forum']['add_member_to_this_hide_forum']).'
  	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['other']['mem_forum'].'</nobr></td>
		<td class="list">
		<center>
		<table width="80%" cellSpacing="1" cellPadding="2" border="0">
			<tr>
				<td class="stats_h" align="middle">'.$lang['add_cat_forum']['member_number'].'</td>
				<td class="stats_h" align="middle">'.$lang['add_cat_forum']['member_name'].'</td>
				<td class="stats_h" align="middle">'.$lang['add_cat_forum']['options'].'</td>
			</tr>';
	$forum_hide = @DBi::$con->query("SELECT * FROM ".$Prefix."HIDE_FORUM WHERE HF_FORUM_ID = '$f' ") or die (DBi::$con->error);
	$hf_num = @mysqli_num_rows($forum_hide);
	if ($hf_num <= 0) {
			echo'
			<tr>
				<td class="stats_p" align="middle" colspan="3"><br><font color="black">'.$lang['add_cat_forum']['no_member_allow_to_show_hide_forum'].'</font><br><br></td>
			</tr>';
	}
	$hf_i = 0;
	while ($hf_i < $hf_num) {
		$hf_id = @mysqli_result($forum_hide, $hf_i, "HF_ID");
		$hf_member_id = @mysqli_result($forum_hide, $hf_i, "HF_MEMBER_ID");
            echo'
            <tr>
                <td class="stats_h" align="middle"><font color="yellow" size="-1">'.$hf_member_id.'</td>
                <td class="stats_p" align="middle"><nobr>'.link_profile(members("NAME", $hf_member_id), $hf_member_id).'</nobr></td>
                <td class="stats_h" align="middle"><a href="index.php?mode=delete&type=del_mem&m='.$hf_id.'&f='.$f.'"  onclick="return confirm(\''.$lang['add_cat_forum']['confirm_delete_member_from_list'].'\');">'.icons($icon_trash, $lang['add_cat_forum']['delete_member_from_list']).'</a></td>
            </tr>';
	++$hf_i;
	} 
		echo'
        </table>
		</center>
		</td>
	</tr>';
}

	echo'
    </form>
</center></table><br>';

}



else {
redirect();
}
@mysqli_close();
?>
