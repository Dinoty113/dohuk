<?


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
// # Email: admindahuk.info                                                   # //
// # Site: http://www.startimes.com/f.aspx?mode=f&f=211                        # //
// ############################################################################# //
/////////////////////////////////////////////////////////////////////////////////*/

function author_mod_forum($id) {
$sql = DBi::$con->query("SELECT * FROM ".prefix."AUTHOR_MOD WHERE REQ_ID = '$id'");
$num = mysqli_num_rows($sql);
$x = 0;
while($x < $num) {
$author_mod = mysqli_result($sql, $x, "REQ_FRMID");
++$x;	
}
return ($author_mod);	
}

if(svc != "special_medals_points" AND svc != "medals" AND svc != "medals" AND svc != "special_medals" AND svc != "special_points" AND svc != "edits" AND svc != "prv" AND svc != "tstats" AND svc != "" AND svc != "surveys" AND svc != "mon" AND svc != "ip" AND svc != "search" AND svc != "list_medals" AND svc != "list_titles" AND svc != "list_topics" AND svc != "titles" AND svc != "mods" AND svc != "m_stat" AND svc != "groups" AND svc != "joiners_groups" AND svc != "social" AND svc != "admin_social" AND svc != "mod_market" AND svc != "blocked_groups_members" AND svc != "set_social" AND svc != "set_mod_market" AND svc != "author_mod" AND svc != "set_author_mod" AND svc != "admin_author_mod" AND svc != "admin_set_author_mod"){
	header("Location: ".index()."");
	exit();
}
if(mlv == 1 || mlv == 0){
	redirect();
	exit();
}
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
if (mlv > 1){ // just mod or up
require_once("./engine/svc_function.php");
require_once("./engine/moderation_function.php");
require_once("./engine/groups_function.php");
require_once("engine/market_function.php")



?>
<script language="javascript">
	var check_flag = "false";
	function check(checked, alert_msg) {
		if (check_flag == "false") {
			var count = 0;
			for (i = 0; i < checked.length; i++) {
				checked[i].checked = true;
				if (checked[i].type == "checkbox"){
					count += 1;
				}
			}
			check_flag = "true";
			alert(alert_msg+": "+count);
			return (delete_select_all);
		}
		else {
			for (i = 0; i < checked.length; i++){
				checked[i].checked = false;
			}
			check_flag = "false";
			return (select_all);
		}
	}
</script>
<?php

if ($method != "insert" AND $method != "update" AND $method != "app" AND $method != "in" AND $method != "trash" AND svc != "set_social" AND $type != "admin_set_social" AND $type != "set_mod_market" AND $type != "blocked_groups_members" AND $type != "joiners_groups" AND $type != "insert_edit" AND $type != "del"){
include("svc_menu.php");
		if ($method == "svc" AND svc == "groups"){
			echo multi_page("GROUPS ".chk_groups_get(), $max_page);
		}
		if ($method == "svc" AND svc == "joiners_groups"){
			echo multi_page("GROUPS_MEMBERS", $max_page);
		}
		if ($method == "svc" AND svc == "special_medals_points"){
			echo multi_page("GLOBAL_MEDALS ".chk_global_special_medals_points_get(), $max_page);
		}
		if ($method == "svc" AND svc == "medals"){
			echo multi_page("GLOBAL_MEDALS ".chk_global_medals_get(), $max_page);
		}		
		if ($method == "svc" AND svc == "titles"){
			echo multi_page("GLOBAL_TITLES ".chk_global_titles_get(), $max_page);
		}
		if ($method == "" AND svc == "medals"){
			echo multi_page("MEDALS ".chk_medals_get(), $max_page);
		}
		if ($method == "" AND svc == "special_medals_points"){
			echo multi_page("MEDALS ".chk_medals_get(), $max_page);
		}		
		go_to_forum();
		echo'
		</tr>
	</table>
	</center><br>';
}

if ($type == "joiners_groups") {
	$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_STATUS = '0' AND M_ID = '$m' AND M_GROUP = '$id'");
	$num = mysqli_num_rows($sql);
	if($num == 0){
	redirect();	
	}	
if ($method == "approve") {
			DBi::$con->query("UPDATE ".prefix."GROUPS_MEMBERS SET M_STATUS = '1' WHERE M_ID = '$m' AND M_GROUP = '$id' AND M_STATUS = '0' ") or die (DBi::$con->error);
				$group_name = groupName($id);
				$forum = groups("FORUM", $id);
				$enter_group = $lang['social']['enter_group'];
				$query = "INSERT INTO ".prefix."GROUPS_TRANS (T_GROUP, T_TXT, T_MEM) VALUES (";
				$query .= " '$id', ";
				$query .= " '$enter_group', ";
				$query .= " '$m'";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
  
  				$subject = ''.$lang['svc_file']['message_group_part1'].' '.$group_name.'';
				$message = ''.$lang['svc_file']['message_group_part2'].' '.$group_name.'<br><br>'.$lang['svc_file']['message_group_part3'].' <br>'.$lang['svc_file']['message_group_part4'].'<br><a href="index.php?mode=social&type=groups&prd=group&id='.$id.'">'.$group_name.'</a>';
				$date = time();

	 
	$storePm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$storePm .= " '$m', ";
	$storePm .= " '$m', ";
	$storePm .= " '-$forum', ";
	$storePm .= " '$subject', ";
	$storePm .= " '$message', ";
	$storePm .= " '$date') ";
		DBi::$con->query($storePm, $connection) or die (DBi::$con->error);	 
if(allowed($forum, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}		
	                echo'			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_moderate_group'].'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=joiners_groups">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';

}
if ($method == "refused") {
			DBi::$con->query("UPDATE ".prefix."GROUPS_MEMBERS SET M_STATUS = '2' WHERE M_ID = '$m' AND M_GROUP = '$id' AND M_STATUS = '0' ") or die (DBi::$con->error);
				$group_name = groupName($id);
				$forum = groups("FORUM", $id);
    			$subject = ''.$lang['svc_file']['message_refuse_part1'].' '.$group_name.'';
				$message = ''.$lang['svc_file']['message_group_part2'].' '.$group_name.'<br><br>'.$lang['svc_file']['message_refuse_part2'].' ';
				$date = time();
		
	$send_pm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
     $send_pm .= " '$m', ";
     $send_pm .= " '$m', ";
     $send_pm .= " '-$forum', ";
     $send_pm .= " '$subject', ";
     $send_pm .= " '$message', ";
     $send_pm .= " '$date') ";

     DBi::$con->query($send_pm) or die (DBi::$con->error);
if(allowed($forum, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}	 
	                echo'			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_refuse_group'].'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=joiners_groups">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';

}
if ($method == "block") {
			DBi::$con->query("UPDATE ".prefix."GROUPS_MEMBERS SET M_STATUS = '3' WHERE M_ID = '$m' AND M_GROUP = '$id' AND M_STATUS = '0' ") or die (DBi::$con->error);
				$group_name = groupName($id);
				$forum = groups("FORUM", $id);    		
			$subject = ''.$lang['svc_file']['message_block_part1'].' '.$group_name.'';
				$message = ''.$lang['svc_file']['message_group_part2'].' '.$group_name.'<br><br>'.$lang['svc_file']['message_block_part2'].' ';
				$date = time();
		
	$send_pm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
     $send_pm .= " '$m', ";
     $send_pm .= " '$m', ";
     $send_pm .= " '-$forum', ";
     $send_pm .= " '$subject', ";
     $send_pm .= " '$message', ";
     $send_pm .= " '$date') ";

     DBi::$con->query($send_pm) or die (DBi::$con->error);
 if(allowed($forum, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
} 
	                echo'			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_block_group'].'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=joiners_groups">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';

}
}

if ($type == "blocked_groups_members") {
	$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_STATUS = '3' AND M_ID = '$m' AND M_GROUP = '$id'");
	$num = mysqli_num_rows($sql);
	if($num == 0){
	redirect();	
	}	
			DBi::$con->query("DELETE FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$m' AND M_GROUP = '$id' AND M_STATUS = '3' ") or die (DBi::$con->error);
				$group_name = groupName($id);
				$forum = groups("FORUM", $id);
  
  				$subject = ''.$lang['svc_file']['message_delete_block_subject'].' '.$group_name.'';
				$message = ''.$lang['svc_file']['message_delete_block_group'].' '.$group_name.'<br><br>'.$lang['svc_file']['please_dont_try_again'].'';
				$date = time();

	 
	$storePm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$storePm .= " '$m', ";
	$storePm .= " '$m', ";
	$storePm .= " '-$forum', ";
	$storePm .= " '$subject', ";
	$storePm .= " '$message', ";
	$storePm .= " '$date') ";
		DBi::$con->query($storePm, $connection) or die (DBi::$con->error);	 
if(allowed($forum, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}		
	                echo'			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_delete_block_group'].'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=blocked_groups_members">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';

}

if ($method == ""){
	
	
	if ($svc == "special_medals_points"){
		
		if($Mlevel != 4) {
		redirect();	
		}
		if($Mlevel == 4) {
?>
<script language="javascript">
	function on_app(obj){
		var box = obj.form.elements;
		var count = 0;
		for (i = 0; i < box.length; i++) {
			if (box[i].type == "checkbox" && box[i].checked == true){
				count += 1;
			}
		}
		if (count > 0){
			obj.form.status.value = "app";
			obj.form.submit();
		}
		else{
			confirm(select_one_medal_point);
			return;
		}
	}
	function on_ref(obj){
		var box = obj.form.elements;
		var count = 0;
		for (i = 0; i < box.length; i++) {
			if (box[i].type == "checkbox" && box[i].checked == true){
				count += 1;
			}
		}
		if (count > 0){
			obj.form.status.value = "ref";
			obj.form.submit();
		}
		else{
			confirm(select_one_medal_point_refuse);
			return;
		}
	}
</script>
<?php
		if (empty($app)){
			$app = "wait";
		}
		else{
			$app = $app;
		}
		if (empty($scope)){
			$scope = "all";
		}
		else{
			$scope = $scope;
		}
		if (empty($days)){
			$days = 30;
		}
		else{
			$days = $days;
		}
		if (empty($id)){
			define(chk_id, "");
		}
		else{
			define(chk_id, "&id=".$id);
		}
		if (empty($m)){
			define(chk_m, "");
		}
		else{
			define(chk_m, "&m=".$m);
		}

		echo'
		<center>
		<table>
			<tr>
				<td class="stats_menu'.chk_cmd($scope, "own", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app='.$app.'&scope=own&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['medals_points_do_you'].'</a></td>
				<td class="stats_menu'.chk_cmd($scope, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app='.$app.'&scope=all&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['all_medals_points'].'</a></td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="'.chk_special_medals_points_color_p().'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app=wait&scope='.$scope.'&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['pending_medals_points'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "ok", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app=ok&scope='.$scope.'&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['medals_points_accept'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "ref", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app=ref&scope='.$scope.'&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['medals_points_refuse'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app=all&scope='.$scope.'&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['all_medals_points'].'</a></td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="stats_menu'.chk_cmd($days, 30, "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app='.$app.'&scope='.$scope.'&days=30'.chk_id.chk_m.'">'.$lang['svc_file']['in_30'].'</a></td>
				<td class="stats_menu'.chk_cmd($days, 60, "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app='.$app.'&scope='.$scope.'&days=60'.chk_id.chk_m.'">'.$lang['svc_file']['in_60'].'</a></td>
				<td class="stats_menu'.chk_cmd($days, 180, "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app='.$app.'&scope='.$scope.'&days=180'.chk_id.chk_m.'">'.$lang['svc_file']['in_180'].'</a></td>
				<td class="stats_menu'.chk_cmd($days, 365, "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app='.$app.'&scope='.$scope.'&days=365'.chk_id.chk_m.'">'.$lang['svc_file']['in_365'].'</a></td>
				<td class="stats_menu'.chk_cmd($days, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=special_medals_points&app='.$app.'&scope='.$scope.'&days=all'.chk_id.chk_m.'">'.$lang['svc_file']['all_medals_points'].'</a></td>
			</tr>
		</table>
		</center><br>';

		if ($app == "wait"){
			$get_title = $lang['svc_file']['a_pending_medals_points'];
		}
		if ($app == "ok"){
			$get_title = $lang['svc_file']['a_acceptt_medals_points'];
		}
		if ($app == "ref"){
			$get_title = $lang['svc_file']['a_refused_medals_points'];
		}
		if ($app == "all"){
			$get_title = $lang['svc_file']['a_all_medals_points'];
		}

		if (chk_member_id($m) == 1){
			echo'
			<p align="center">
			<b>
			<font color="red" size="-1">'.$lang['svc_file']['show_medals_points_member'].'<br></font>
			<font size="+1"><a href="index.php?mode=member&id='.$m.'">'.members("NAME", $m).'</a></font>
			</b>
			</p>';
		}
		if (chk_gm_id($id) == 1){
			echo'
			<p align="center">
			<b>
			<font color="red" size="-1">'.$lang['svc_file']['show_a_medals_points'].'</font>
			<font size="+1" color="black">'.$id.'</font>
			</b>
			</p>';
		}

		echo'
		<center>
		<table cellSpacing="1" cellPadding="2">
		<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=special_medals_points&type=awarded">
		<input type="hidden" name="status">
			<tr>
				<td class="optionsbar_menus" colSpan="15"><font color="red" size="+1">'.$get_title.'</font></td>
			</tr>
			<tr>';
			if (mlv > 2){
				echo'
				<td class="stats_h">&nbsp;</td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['members']['members'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['message']['date'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_show_to'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['a_medal_points_give'] .'</nobr></td>
				<td class="stats_h">&nbsp;</td>
				<td class="stats_h"><nobr>'.$lang['admin_svc']['points'].'</nobr></td>';
			if ($app == "all"){
				echo'
				<td class="stats_h"><nobr>'.$lang['svc_file']['moderate'].'</nobr></td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['svc_file']['give_medals_points'].'</nobr></td>
				<td class="stats_h" colspan="2"><nobr>'.$lang['members']['options'].'</nobr></td>
			</tr>';
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MEDALS ".chk_special_medals_points_get()." ORDER BY MEDAL_ID DESC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
		$num = mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
			$m_id = mysqli_result($sql, $x, "MEDAL_ID");
			$status = medals("STATUS", $m_id);
			svc_show_special_medals_points($m_id);
			$count = $count + 1;
			if (allowed($f, 1) == 1 AND $status != 1){
				$count_chk = $count_chk + 1;
			}
		++$x;
		}
		if ($count_chk > 0){
			echo'
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class="optionsbar_menus" colspan="15">
					<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_medals_points'].'\')">&nbsp;&nbsp;
					<input onclick="on_app(this)" type="button" value="'.$lang['svc_file']['moderate_medals_points'].'">&nbsp;&nbsp;';
				if ($app != "ref"){
					echo'
					<input onclick="on_ref(this)" type="button" value="'.$lang['svc_file']['refused_medals_points'].'">';
				}
					echo'
					</td>
			</tr>';
		}
		if ($count == 0){
			echo'
			<tr>
				<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_medals_points'].'</font><br><br></td>
			</tr>';
		}
		echo'
		</form>
		</table>
		</center><br>';
	}
	

	}
	
	if (svc == "medals"){
?>
<script language="javascript">
	function on_app(obj){
		var box = obj.form.elements;
		var count = 0;
		for (i = 0; i < box.length; i++) {
			if (box[i].type == "checkbox" && box[i].checked == true){
				count += 1;
			}
		}
		if (count > 0){
			obj.form.status.value = "app";
			obj.form.submit();
		}
		else{
			confirm(select_one_medal);
			return;
		}
	}
	function on_ref(obj){
		var box = obj.form.elements;
		var count = 0;
		for (i = 0; i < box.length; i++) {
			if (box[i].type == "checkbox" && box[i].checked == true){
				count += 1;
			}
		}
		if (count > 0){
			obj.form.status.value = "ref";
			obj.form.submit();
		}
		else{
			confirm(select_one_medal_refuse);
			return;
		}
	}
</script>
<?php
		if (empty($app)){
			$app = "wait";
		}
		else{
			$app = $app;
		}
		if (empty($scope)){
			$scope = "mod";
		}
		else{
			$scope = $scope;
		}
		if (empty($days)){
			$days = 30;
		}
		else{
			$days = $days;
		}
		if (empty($id)){
			define('chk_id', "");
		}
		else{
			define('chk_id', "&id=".$id);
		}
		if (empty($m)){
			define('chk_m', "");
		}
		else{
			define('chk_m', "&m=".$m);
		}

		echo'
		<center>
		<table>
			<tr>
				<td class="stats_menu'.chk_cmd($scope, "mod", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app='.$app.'&scope=mod&days='.$days.chk_id.chk_m.'">'.$lang['title_page']['your_forums_mod'].'</a></td>
				<td class="stats_menu'.chk_cmd($scope, "own", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app='.$app.'&scope=own&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['medals_do_you'].'</a></td>
				<td class="stats_menu'.chk_cmd($scope, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app='.$app.'&scope=all&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['all_medals'].'</a></td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="'.chk_medals_all_color_p().'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app=wait&scope='.$scope.'&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['pending_medals'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "ok", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app=ok&scope='.$scope.'&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['acceptt_medals'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "ref", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app=ref&scope='.$scope.'&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['refused_medals_a'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app=all&scope='.$scope.'&days='.$days.chk_id.chk_m.'">'.$lang['svc_file']['all_medals'].'</a></td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="stats_menu'.chk_cmd($days, 30, "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app='.$app.'&scope='.$scope.'&days=30'.chk_id.chk_m.'">'.$lang['svc_file']['in_30'].'</a></td>
				<td class="stats_menu'.chk_cmd($days, 60, "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app='.$app.'&scope='.$scope.'&days=60'.chk_id.chk_m.'">'.$lang['svc_file']['in_60'].'</a></td>
				<td class="stats_menu'.chk_cmd($days, 180, "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app='.$app.'&scope='.$scope.'&days=180'.chk_id.chk_m.'">'.$lang['svc_file']['in_180'].'</a></td>
				<td class="stats_menu'.chk_cmd($days, 365, "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app='.$app.'&scope='.$scope.'&days=365'.chk_id.chk_m.'">'.$lang['svc_file']['in_365'].'</a></td>
				<td class="stats_menu'.chk_cmd($days, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&svc=medals&app='.$app.'&scope='.$scope.'&days=all'.chk_id.chk_m.'">'.$lang['svc_file']['all_medals'].'</a></td>
			</tr>
		</table>
		</center><br>';



		if (chk_member_id($m) == 1){
			echo'
			<p align="center">
			<b>
			<font color="red" size="-1">'.$lang['svc_file']['show_medals_member'].'<br></font>
			<font size="+1"><a href="index.php?mode=member&id='.$m.'">'.members("NAME", $m).'</a></font>
			</b>
			</p>';
		}
		if (chk_gm_id($id) == 1){
			echo'
			<p align="center">
			<b>
			<font color="red" size="-1">'.$lang['svc_file']['show_a_medals'].'</font>
			<font size="+1" color="black">'.$id.'</font>
			</b>
			</p>';
		}
		
		
		
$sql = DBi::$con->query("SELECT * FROM ".prefix."MEDALS ".chk_medals_get_admin()." ORDER BY MEDAL_ID DESC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
$num = mysqli_num_rows($sql);
if($num > 0 && $app == "wait") {
		if ($app == "wait"){
			$get_title = $lang['svc_file']['a_pending_medals_admin'];
		}
		if ($app == "ok"){
			$get_title = $lang['svc_file']['a_acceptt_medals'];
		}
		if ($app == "ref"){
			$get_title = $lang['svc_file']['a_refused_medals'];
		}
		if ($app == "all"){
			$get_title = $lang['svc_file']['a_all_medals'];
		}	
	echo'
		<center>
		<table cellSpacing="1" cellPadding="2">
		<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=medals&type=awarded_admin">
		<input type="hidden" name="status">
			<tr>
				<td class="optionsbar_menus" colSpan="15"><font color="red" size="+1">'.$get_title.'</font></td>
			</tr>
			<tr>';
			if (mlv > 2){
				echo'
				<td class="stats_h">&nbsp;</td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['members']['members'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['message']['date'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_show_to'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_gived'].'</nobr></td>
				<td class="stats_h">&nbsp;</td>
				<td class="stats_h"><nobr>'.$lang['admin_svc']['points'].'</nobr></td>';
			if ($app == "all"){
				echo'
				<td class="stats_h"><nobr>'.$lang['svc_file']['moderate'].'</nobr></td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['profiles']['giv_medals'].'</nobr></td>
				<td class="stats_h" colspan="2"><nobr>&nbsp;</nobr></td>
			</tr>';
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MEDALS ".chk_medals_get_admin()." ORDER BY MEDAL_ID DESC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
		$num = mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
			$m_id = mysqli_result($sql, $x, "MEDAL_ID");
			$f = medals("FORUM_ID", $m_id);
			$status = medals("STATUS", $m_id);
			svc_show_medals_admin($m_id);
			$count_admin = $count_admin + 1;
			if (allowed($f, 1) == 1 AND $status != 1){
				$count_chk_admin = $count_chk_admin + 1;
			}
		++$x;
		}
		if ($Mlevel == 4 && $count_chk_admin > 0){
			echo'
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class="optionsbar_menus" colspan="15">
					<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_medals'].'\')">&nbsp;&nbsp;
					<input onclick="on_app(this)" type="button" value="'.$lang['svc_file']['moderate_medals'].'">&nbsp;&nbsp;';
				if ($app != "ref"){
					echo'
					<input onclick="on_ref(this)" type="button" value="'.$lang['svc_file']['refused_medals'].'">';
				}
					echo'
					</td>
			</tr>';
		}
		if ($count_admin == 0){
			echo'
			<tr>
				<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_medals'].'</font><br><br></td>
			</tr>';
		}
		echo'
		</form>
		</table>
		</center><br><br>';
}


$sql = DBi::$con->query("SELECT * FROM ".prefix."MEDALS ".chk_medals_get_mod()." ORDER BY MEDAL_ID DESC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
$num = mysqli_num_rows($sql);
if($num > 0 && $app == "wait") {
			$get_title = $lang['svc_file']['a_pending_medals_mod'];
	echo'
		<center>
		<table cellSpacing="1" cellPadding="2">
		<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=medals&type=awarded_mod">
		<input type="hidden" name="status">
			<tr>
				<td class="optionsbar_menus" colSpan="15"><font color="red" size="+1">'.$get_title.'</font></td>
			</tr>
			<tr>';
			if (mlv > 2){
				echo'
				<td class="stats_h">&nbsp;</td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['members']['members'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['message']['date'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_show_to'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_gived'].'</nobr></td>
				<td class="stats_h">&nbsp;</td>
				<td class="stats_h"><nobr>'.$lang['admin_svc']['points'].'</nobr></td>';
			if ($app == "all"){
				echo'
				<td class="stats_h"><nobr>'.$lang['svc_file']['moderate'].'</nobr></td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['profiles']['giv_medals'].'</nobr></td>
				<td class="stats_h" colspan="2"><nobr>&nbsp;</nobr></td>
			</tr>';
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MEDALS ".chk_medals_get_mod()." ORDER BY MEDAL_ID DESC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
		$num = mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
			$m_id = mysqli_result($sql, $x, "MEDAL_ID");
			$f = medals("FORUM_ID", $m_id);
			$status = medals("STATUS", $m_id);
			$added = medals("ADDED", $m_id);			
			svc_show_medals_mod($m_id);
			$count_mod = $count_mod + 1;
			if (allowed($f, 1) == 1 AND $status != 1){
				$count_chk_mod = $count_chk_mod + 1;
			}
		++$x;
		}
		if ($count_chk_mod > 0 && ($Mlevel == 4 or $Mlevel == 3 or ($Mlevel == 2 && $added != $DBMemberID))){
			echo'
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class="optionsbar_menus" colspan="15">
					<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_medals'].'\')">&nbsp;&nbsp;
					<input onclick="on_app(this)" type="button" value="'.$lang['svc_file']['moderate_medals'].'">&nbsp;&nbsp;';
				if ($app != "ref"){
					echo'
					<input onclick="on_ref(this)" type="button" value="'.$lang['svc_file']['refused_medals'].'">';
				}
					echo'
					</td>
			</tr>';
		}
		if ($count_mod == 0){
			echo'
			<tr>
				<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_medals'].'</font><br><br></td>
			</tr>';
		}
		echo'
		</form>
		</table>
		</center><br><br>';
}

		if ($app == "wait"){
			$get_title = $lang['svc_file']['a_pending_medals'];
		}
		if ($app == "ok"){
			$get_title = $lang['svc_file']['a_acceptt_medals'];
		}
		if ($app == "ref"){
			$get_title = $lang['svc_file']['a_refused_medals'];
		}
		if ($app == "all"){
			$get_title = $lang['svc_file']['a_all_medals'];
		}	
		echo'
		<center>
		<table cellSpacing="1" cellPadding="2">
		<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=medals&type=awarded">
		<input type="hidden" name="status">
			<tr>
				<td class="optionsbar_menus" colSpan="15"><font color="red" size="+1">'.$get_title.'</font></td>
			</tr>
			<tr>';
			if (mlv > 2){
				echo'
				<td class="stats_h">&nbsp;</td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['members']['members'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['message']['date'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_show_to'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_gived'].'</nobr></td>
				<td class="stats_h">&nbsp;</td>
				<td class="stats_h"><nobr>'.$lang['admin_svc']['points'].'</nobr></td>';
				echo'
				<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['profiles']['giv_medals'].'</nobr></td>
				<td class="stats_h" colspan="2"><nobr>&nbsp;</nobr></td>
			</tr>';
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MEDALS ".chk_medals_get()." ORDER BY MEDAL_ID DESC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
		$num = mysqli_num_rows($sql);
		$x = 0;
		if($x == $num){
			$count_chk = 0;
		}
		while ($x < $num) {
			$m_id = mysqli_result($sql, $x, "MEDAL_ID");
			$f = medals("FORUM_ID", $m_id);
			$status = medals("STATUS", $m_id);
			svc_show_medals($m_id);
			$count = $count + 1;
			if (allowed($f, 1) == 1 AND $status != 1){
				$count_chk = $count_chk + 1;
			}
			
		++$x;
		}
		
		if ($count_chk > 0){
			echo'
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class="optionsbar_menus" colspan="15">
					<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_medals'].'\')">&nbsp;&nbsp;
					<input onclick="on_app(this)" type="button" value="'.$lang['svc_file']['moderate_medals'].'">&nbsp;&nbsp;';
				if ($app != "ref"){
					echo'
					<input onclick="on_ref(this)" type="button" value="'.$lang['svc_file']['refused_medals'].'">';
				}
					echo'
					</td>
			</tr>';
		}
	
		if (isset($count) == 0){
			echo'
			<tr>
				<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_medals'].'</font><br><br></td>
			</tr>';
		}
		echo'
		</form>
		</table>
		</center><br>';
}
	if (svc == "titles"){
		echo'
		<center>
		<table cellSpacing="1" cellPadding="2">
			<tr>
				<td class="optionsbar_menus" colSpan="15"><font size="+1">'.$lang['svc_file']['now_titles_member'].' <font color="red">'.members("NAME", $m).'</font></font></td>
			</tr>
			<tr>
				<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['a_title'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['show_in_all_forum'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
				<td class="stats_h">'.$lang['forum']['options'].'</td>
			</tr>';
		$sql = DBi::$con->query("SELECT * FROM ".prefix."TITLES WHERE MEMBER_ID = '$m' AND STATUS = '1' ORDER BY TITLE_ID DESC") or die (DBi::$con->error);
		$num = mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num){
			$t_id = mysqli_result($sql, $x, "TITLE_ID");
			svc_show_titles($t_id);
			$count = $count + 1;
		++$x;
		}
		if ($count == 0){
			echo'
			<tr>
				<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_member_titles'].'</font><br><br></td>
			</tr>';
		}
		echo'
		</table>
		</center><br>';
	}
	
	if (svc == "prv"){
		$f = topics("FORUM_ID", $t);
		$t_hide = topics("HIDDEN", $t);
		if (allowed($f, 2) == 1){
			if ($t_hide == 1){
				$f_subject = forums("SUBJECT", $f);
				$t_subject = topics("SUBJECT", $t);
				echo'
				<script language="javascript">
					function submit_form(){
						if (tm_info.m.value == ""){
							confirm("'.$lang['svc_file']['enter_member_number'].'");
							return;
						}
						var regex = /^[0-9]/;
						if (!regex.test(tm_info.m.value)){
							confirm("'.$lang['svc_file']['just_enter_number'].'");
							return;
						}
						tm_info.submit();
					}
				</script>
				<center>
				<table width="70%" cellSpacing="1" cellPadding="1" border="0">
				<form name="tm_info" method="post" action="index.php?mode=svc&method=insert&svc=prv">
				<input type="hidden" name="f" value="'.$f.'">
				<input type="hidden" name="t" value="'.$t.'">
					<tr>
						<td align="center" class="stats_t" style="FONT-WEIGHT: bold; BACKGROUND: #008000" colspan="5">
							<font size="4" color="yellow">'.$lang['svc_file']['hidden_topics_list'].'</font><br>
							<font size="4" color="white">'.$f_subject.'</font><br>
							<font size="4" color="white">'.$lang['svc_file']['topic_number'].' '.$t.'</font>
						</td>
					</tr>
					<tr>
						<td align="center" class="stats_h" align="middle" width="25%"><font size="3">'.$lang['svc_file']['topic_number'].' '.$t.'</font></td>
						<td align="center" class="stats_t" align="middle" width="25%"></td>
						<td align="center" class="stats_h" align="middle" width="50%"><nobr>'.$lang['svc_file']['to_add_member'].' 
							<input class="submit" type="text" name="m" size="10">
							<input onclick="submit_form()" type="button" class="submit" value="'.$lang['others']['add_member'].'">
						</nobr></td>
					</tr>
					<tr>
						<td class="stats_g" width="100%" colspan="5">'.$lang['editor']['topic_address'].' '.$t_subject.'</td>
					</tr>
					<tr>
						<td align="center" class="stats_p" width="100%" colspan="5"><br>
						<table width="40%" cellSpacing="1" cellPadding="1" border="1">
							<tr>
								<td class="stats_h" align="center">'.$lang['members']['members'].'</td>
								<td class="stats_h" align="center">'.$lang['svc_file']['added_by'].'</td>
								<td class="stats_h" align="center">'.$lang['svc_file']['added_date'].'</td>
								<td class="stats_h" align="center">'.$lang['members']['options'].'</td>
							</tr>';
						$sql = DBi::$con->query("SELECT * FROM ".prefix."TOPIC_MEMBERS WHERE TOPIC_ID = '$t' ORDER BY DATE ASC") or die (DBi::$con->error);
						$num = mysqli_num_rows($sql);
						if ($num == 0) {
							echo'
							<tr>
								<td vAlign="center" align="middle" colspan="20"><br>'.$lang['svc_file']['no_members_here'].'<br><br></td>
							</tr>';
						}
						$x = 0;
						while ($x < $num) {
							$tm = mysqli_result($sql, $x, "TM_ID");
							$m = topic_members("MEMBER_ID", $tm);
							$added = topic_members("ADDED", $tm);
							$date = topic_members("DATE", $tm);
							echo'
							<tr>
								<td align="center"><font size="2"><nobr>'.member_color_link($m).'</nobr></font></td>
								<td align="center"><font size="2"><nobr>'.member_color_link($added).'</nobr></font></td>
								<td align="center"><font size="2"><nobr>'.normal_date($date).'</nobr></font></td>
								<td align="center"><font size="2"><a href="index.php?mode=svc&method=trash&svc=prv&id='.$tm.'">'.icons($icon_trash, $lang['svc_file']['delete_from_list'], "hspace=\"2\"").'</a></font></td>
							</tr>';
						++$x;
						}
						echo'
						</table>
						</td>
					</tr>
				</form>
				</table>
				</center>';
			}
			else{
				error_message($lang['svc_file']['hide_topic_only']);
			}
		} else {
		redirect();	
		}
	}
	if (svc == "edits"){
		if ($t != "") {
		$f = topics("FORUM_ID", $t);
		}
		else if ($r != "") {
		$f = replies("FORUM_ID", $r);
		}

		if (allowed($f, 2) == 1) {	
			echo'
			<center>
			<table cellSpacing="1" cellPadding="1" border="0">';
			if ($t != "") {
			svc_topic_edits($t);
			}
			else if ($r != "") {
			svc_reply_edits($r);
			}
			echo'
			</table>
			</center>';
		} else {
		redirect();	
		}
	}
	if (svc == "tstats"){
if($type == "") {
			$f = topics("FORUM_ID", $t);
		if (allowed($f, 2) == 1) {	
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2" border="0">
				<tr>
					<td bgColor="green" Align="center" colSpan="7"><font size="+1" color="yellow">'.$lang['svc_file']['topic_stat'].' '.$t.'</font></td>
				</tr>
				<tr>
					<td class="stats_h">'.$lang['members']['members'].'</td>
					<td class="stats_h"><a href="index.php?mode=svc&svc=tstats&type=normal&t='.$t.'"><font color="yellow">'.$lang['svc_file']['normal_replies'].'</font></a></td>
					<td class="stats_h"><a href="index.php?mode=svc&svc=tstats&type=deleted&t='.$t.'"><font color="#AAFFAA">'.$lang['svc_file']['deleted_replies'].'</font></a></td>
					<td class="stats_h"><a href="index.php?mode=svc&svc=tstats&type=hidden&t='.$t.'"><font color="#AAFFAA">'.$lang['svc_file']['hidden_replies'].'</font></a></td>
					<td class="stats_h"><a href="index.php?mode=svc&svc=tstats&type=holded&t='.$t.'"><font color="#AAFFAA">'.$lang['svc_file']['holded_replies'].'</font></a></td>
					<td class="stats_h"><a href="index.php?mode=svc&svc=tstats&type=unmoderated&t='.$t.'"><font color="#AAFFAA">'.$lang['svc_file']['unmoderated_replies'].'</font></a></td>
					<td class="stats_h">'.$lang['svc_file']['all_replies'].'</td>
				</tr>';
			$sql = DBi::$con->query("SELECT DISTINCT R_AUTHOR FROM ".prefix."REPLY WHERE TOPIC_ID = '$t' GROUP BY R_AUTHOR ORDER BY COUNT(REPLY_ID) DESC") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			if ($num <= 0) {
				echo'
				<tr>
					<td class="stats_h" colSpan="7">'.$lang['svc_file']['no_replies'].'</td>
				</tr>';
			}
			$x = 0;
			while ($x < $num) {
				$author = mysqli_result($sql, $x, "R_AUTHOR");
				echo'
				<tr>
					<td class="stats_p">'.link_profile(member_name($author), $author).'</td>
					<td class="stats_g" align="center">'.member_replies_in_topic($author, $t, "NORMAL").'</td>
					<td class="stats_t" align="center"><font color="white">'.member_replies_in_topic($author, $t, "DELETED").'</font></td>
					<td class="stats_t" align="center"><font color="white">'.member_replies_in_topic($author, $t, "HIDDEN").'</font></td>
					<td class="stats_t" align="center"><font color="white">'.member_replies_in_topic($author, $t, "HOLDED").'</font></td>
					<td class="stats_t" align="center"><font color="white">'.member_replies_in_topic($author, $t, "UNMODERATED").'</font></td>
					<td class="stats_p" align="center"><a href="index.php?mode=t&t='.$t.'&m='.$author.'">'.member_replies_in_topic($author, $t, "TOTAL").'</a></td>
				</tr>';
			++$x;
			}
			echo'
			
			</table>
			</center>';
		} else {
		redirect();	
		}
}
if($type == "normal") {
			$f = topics("FORUM_ID", $t);
		if (allowed($f, 2) == 1) {	
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2" border="0">
				<tr>
					<td bgColor="green" Align="center" colSpan="7"><font size="+1" color="yellow">'.$lang['svc_file']['topic_stat'].' <br>'.$t.'</font><br><font size="+1" color="cyan">'.$lang['svc_file']['showed_replies_only'].'</font></td>
				</tr>
				<tr>
					<td class="stats_h">'.$lang['members']['members'].'</td>
					<td class="stats_h">'.$lang['svc_file']['num_replies'].'</td>
				</tr>';
			$sql = DBi::$con->query("SELECT DISTINCT R_AUTHOR FROM ".prefix."REPLY WHERE TOPIC_ID = '$t' AND R_STATUS = '1' AND R_HIDDEN = '0' AND R_UNMODERATED = '0' AND R_HOLDED = '0'") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$author = mysqli_result($sql, $x, "R_AUTHOR");
				echo'
				<tr>
					<td class="stats_p">'.link_profile(member_name($author), $author).'</td>
					<td class="stats_g" align="center"><a href="index.php?mode=t&t='.$t.'&m='.$author.'">'.member_replies_in_topic($author, $t, "NORMAL").'</a></td>
				</tr>';
			++$x;
			}
			echo'
	
			</table>
			</center>';
		} else {
		redirect();	
		}
}

if($type == "deleted") {
			$f = topics("FORUM_ID", $t);
		if (allowed($f, 2) == 1) {	
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2" border="0">
				<tr>
					<td bgColor="green" Align="center" colSpan="7"><font size="+1" color="yellow">'.$lang['svc_file']['topic_stat'].' <br>'.$t.'</font><br><font size="+1" color="cyan">'.$lang['svc_file']['deleted_replies_only'].'</font></td>
				</tr>
				<tr>
					<td class="stats_h">'.$lang['members']['members'].'</td>
					<td class="stats_h">'.$lang['svc_file']['num_replies'].'</td>
				</tr>';
			$sql = DBi::$con->query("SELECT DISTINCT R_AUTHOR FROM ".prefix."REPLY WHERE TOPIC_ID = '$t' AND R_STATUS = '2' AND R_HIDDEN = '0' AND R_UNMODERATED = '0' AND R_HOLDED = '0'") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$author = mysqli_result($sql, $x, "R_AUTHOR");
				echo'
				<tr>
					<td class="stats_p">'.link_profile(member_name($author), $author).'</td>
					<td class="stats_g" align="center"><a href="index.php?mode=t&t='.$t.'&m='.$author.'">'.member_replies_in_topic($author, $t, "DELETED").'</a></td>
				</tr>';
			++$x;
			}
			echo'

			</table>
			</center>';
		} else {
		redirect();	
		}
}

if($type == "hidden") {
			$f = topics("FORUM_ID", $t);
		if (allowed($f, 2) == 1) {	
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2" border="0">
				<tr>
										<td bgColor="green" Align="center" colSpan="7"><font size="+1" color="yellow">'.$lang['svc_file']['topic_stat'].' <br>'.$t.'</font><br><font size="+1" color="cyan">'.$lang['svc_file']['hidden_replies_only'].'</font></td>
				</tr>
				<tr>
					<td class="stats_h">'.$lang['members']['members'].'</td>
					<td class="stats_h">'.$lang['svc_file']['num_replies'].'</td>
				</tr>';
			$sql = DBi::$con->query("SELECT DISTINCT R_AUTHOR FROM ".prefix."REPLY WHERE TOPIC_ID = '$t' AND R_STATUS = '1' AND R_HIDDEN = '1' AND R_UNMODERATED = '0' AND R_HOLDED = '0'") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$author = mysqli_result($sql, $x, "R_AUTHOR");
				echo'
				<tr>
					<td class="stats_p">'.link_profile(member_name($author), $author).'</td>
					<td class="stats_g" align="center"><a href="index.php?mode=t&t='.$t.'&m='.$author.'">'.member_replies_in_topic($author, $t, "HIDDEN").'</a></td>
				</tr>';
			++$x;
			}
			echo'
			</table>
			</center>';
		} else {
		redirect();	
		}
}

if($type == "holded") {
			$f = topics("FORUM_ID", $t);
		if (allowed($f, 2) == 1) {	
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2" border="0">
				<tr>
										<td bgColor="green" Align="center" colSpan="7"><font size="+1" color="yellow">'.$lang['svc_file']['topic_stat'].' <br>'.$t.'</font><br><font size="+1" color="cyan">'.$lang['svc_file']['holded_replies_only'].'</font></td>
				</tr>
				<tr>
					<td class="stats_h">'.$lang['members']['members'].'</td>
					<td class="stats_h">'.$lang['svc_file']['num_replies'].'</td>
				</tr>';
			$sql = DBi::$con->query("SELECT DISTINCT R_AUTHOR FROM ".prefix."REPLY WHERE TOPIC_ID = '$t' AND R_STATUS = '1' AND R_HIDDEN = '0' AND R_UNMODERATED = '0' AND R_HOLDED = '1'") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);

			$x = 0;
			while ($x < $num) {
				$author = mysqli_result($sql, $x, "R_AUTHOR");
				echo'
				<tr>
					<td class="stats_p">'.link_profile(member_name($author), $author).'</td>
					<td class="stats_g" align="center"><a href="index.php?mode=t&t='.$t.'&m='.$author.'">'.member_replies_in_topic($author, $t, "HOLDED").'</a></td>
				</tr>';
			++$x;
			}
			echo'
			</table>
			</center>';
		} else {
		redirect();	
		}
}
	
	
	if($type == "unmoderated") {
			$f = topics("FORUM_ID", $t);
		if (allowed($f, 2) == 1) {	
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2" border="0">
				<tr>
										<td bgColor="green" Align="center" colSpan="7"><font size="+1" color="yellow">'.$lang['svc_file']['topic_stat'].' <br>'.$t.'</font><br><font size="+1" color="cyan">'.$lang['svc_file']['unmoderated_replies_only'].'</font></td>
				</tr>
				<tr>
					<td class="stats_h">'.$lang['members']['members'].'</td>
					<td class="stats_h">'.$lang['svc_file']['num_replies'].'</td>
				</tr>';
			$sql = DBi::$con->query("SELECT DISTINCT R_AUTHOR FROM ".prefix."REPLY WHERE TOPIC_ID = '$t' AND R_STATUS = '1' AND R_HIDDEN = '0' AND R_UNMODERATED = '1' AND R_HOLDED = '0'") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			
			$x = 0;
			while ($x < $num) {
				$author = mysqli_result($sql, $x, "R_AUTHOR");
				echo'
				<tr>
					<td class="stats_p">'.link_profile(member_name($author), $author).'</td>
					<td class="stats_g" align="center"><a href="index.php?mode=t&t='.$t.'&m='.$author.'">'.member_replies_in_topic($author, $t, "UNMODERATED").'</a></td>
				</tr>';
			++$x;
			}
			echo'
			</table>
			</center>';
		} else {
		redirect();	
		}
}

	}
}

if ($method == "details"){
	if (svc == "edits"){
		if (type == "t") {
			$t = edits("TOPIC_ID", $id);
			$f = topics("FORUM_ID", $t);
			if (allowed($f, 2) == 1) {
			svc_topic_edits_details($id, $n);
			} else {
		redirect();	
		}
		}
		if (type == "r") {
			$r = edits("REPLY_ID", $id);
			$f = replies("FORUM_ID", $r);
			if (allowed($f, 2) == 1) {
			svc_reply_edits_details($id, $n);
			} else {
		redirect();	
		}
		}		
	}
}

if ($method == "svc"){
	
		if (svc == "blocked_groups_members"){

if($m == "" or $m == 0) {
redirect();	
}

$f = groups("FORUM", $m);

if(allowed($f, 2) == 1) {
	
			echo'
			<center>
			
			<table dir="rtl" cellSpacing="1" cellPadding="4">
				<tr>
					<td class="optionsbar_menus" colSpan="3"><font color="red" size="+1">'.$lang['svc_file']['members_who_blocked_groups'].'<br>'.groupName($m).'</font></td>
				</tr>
				<tr>
					<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['members']['members'].'</nobr></td>
					<td class="stats_h">'.$lang['members']['options'].'</td>

				</tr>';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_STATUS = '3' AND M_GROUP = '$m' ORDER BY ID ASC") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$m_id = mysqli_result($sql, $x, "M_ID");
			$m_name = link_profile(member_name($m_id), $m_id);				
						echo'
		<tr>
			<td class="stats_h"><nobr>'.$m_id.'</nobr></td>
			<td class="stats_g"><nobr><center>'.member_link($m_id).'</center></nobr></td>
			<td class="stats_p" align="middle"><nobr><a href="index.php?mode=svc&type=blocked_groups_members&m='.$m_id.'&id='.$m.'">'.icons($icon_trash, $lang['svc_file']['delete_block_from_this_member']).'</a></nobr></td>
		</tr>';
		
		$count = $count + 1;
			++$x;
			}
						if ($count == 0){
				echo'
				<tr>
					<td class="stats_p" align="center" colspan="10"><br><font color="red">'.$lang['svc_file']['no_members_blocked_to_this'].'</font><br><br></td>
				</tr>';
			}
			echo'
			</form>
			</table>
			</center><br>';
			
} else {
redirect();	
}
			

	}
	
		if (svc == "joiners_groups"){
			

?>

	<script language="javascript">
		function on_submit(obj){
			if (obj.name == "approve"){
				var go_to = confirm(confirm_accept_this);
				if (go_to){
					obj.form.method.value = "approve";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "refused"){
				var go_to = confirm(confirm_refuse_this);
				if (go_to){
					obj.form.method.value = "refused";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "block"){
				var go_to = confirm(confirm_block_this);
				if (go_to){
					obj.form.method.value = "block";
					obj.form.submit();
				}
				else{
					return;
				}
			}
		}
	</script>
<?php


			echo'
			<center>
			
			<table dir="rtl" cellSpacing="1" cellPadding="4">
			<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=joiners_groups&type=global">
					<input type="hidden" name="method">

				<tr>
					<td class="optionsbar_menus" colSpan="11"><font color="red" size="+1">'.$lang['svc_file']['groups_joiners'].'</font></td>
				</tr>
				<tr>';

					echo'
					<td class="stats_h"><nobr><font color="yellow">'.$lang['groups_function']['moderate'].'</font></nobr></td>
					<td class="stats_h"><nobr>'.$lang['members']['members'].'</nobr></td>
					<td class="stats_h"><nobr><font color="yellow">'.$lang['svc_file']['a_refused'].'</font></nobr></td>
					<td class="stats_h"><nobr><font color="yellow">'.$lang['svc_file']['a_blocked'].'</font></nobr></td>
					<td class="stats_h"><nobr>'.$lang['message']['date'].'</nobr></td>
					<td class="stats_h">'.$lang['medals']['medals_forum'].'</td>
					<td class="stats_h"><nobr>'.$lang['add_cat_forum']['group'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['group_status'].'</nobr></td>
				</tr>';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_STATUS = '0' AND M_FORUM IN (".chk_allowed_forums_all_id().")") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$m_id = mysqli_result($sql, $x, "M_ID");
				$m_name = members("NAME", $m_id);
				$m_status = mysqli_result($sql, $x, "M_STATUS");
				$m_forum = mysqli_result($sql, $x, "M_FORUM");
				$m_forum_subject = forums("SUBJECT", $m_forum);
				$m_group = mysqli_result($sql, $x, "M_GROUP");
				$m_group_name = groupName($m_group);
				$m_date = mysqli_result($sql, $x, "M_DATE");

				echo'
		<tr>
			<td class="stats_p" align="center"><a href="index.php?mode=svc&type=joiners_groups&method=approve&m='.$m_id.'&id='.$m_group.'">'.icons($icon_unlock, '').'</a></td>
			<td class="stats_p"><nobr>'.member_link($m_id).'</nobr></td>
			<td class="stats_p" align="center"><a href="index.php?mode=svc&type=joiners_groups&method=refused&m='.$m_id.'&id='.$m_group.'">'.icons($icon_trash, '').'</a></td>
			<td class="stats_p" align="center"><a href="index.php?mode=svc&type=joiners_groups&method=block&m='.$m_id.'&id='.$m_group.'">'.icons($icon_trash, '').'</a></td>

			<td class="stats_p"><nobr>'.normal_time($m_date).'</nobr></td>
			<td class="stats_p">'.$m_forum_subject.'</font></td>
			<td class="stats_p">'.$m_group_name.'</td>
			<td class="stats_h">--</font></td>



		</tr>';
				$count = $count + 1;
				
				
			++$x;
			}

			if ($count == 0){
				echo'
				<tr>
					<td class="stats_p" align="center" colspan="10"><br><font color="red">'.$lang['svc_file']['no_groups_joiners'].'</font><br><br></td>
				</tr>';
			}
			echo'
			</form>
			</table>
			</center><br>';

	}
	

	
	
		if (svc == "groups"){

?>
<script language="javascript">
	function on_submit(obj){
		var box = obj.form.elements;
		var count = 0;
		for (i = 0; i < box.length; i++) {
			if (box[i].type == "checkbox" && box[i].checked == true){
				count += 1;
			}
		}
		if (count > 0){
			obj.form.submit();
		}
		else{
			confirm(select_one_group);
			return;
		}
	}
</script>
<?php

		if (empty($app)){
			$app = "ok";
		}
		else{
			$app = $app;
		}
		if (empty($scope)){
			$scope = "mod";
		}
		else{
			$scope = $scope;
		}

		if ($app == "design"){
			$the_title = $lang['svc_file']['in_shop'];
		}
		if ($app == "wait"){
			$the_title = $lang['svc_function']['moderation_it_pending'];
		}
		if ($app == "ok"){
			$the_title = $lang['svc_file']['opened'];
		}
		if ($app == "closed"){
			$the_title = $lang['svc_file']['closed'];
		}
		if ($app == "hidden"){
			$the_title = $lang['svc_file']['hidden_replies'];
		}		
			echo'
			<center>
			<table>
				<tr>
					<td class="stats_menu'.chk_cmd($scope, "mod", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=groups&app='.$app.'&scope=mod">'.$lang['title_page']['your_forums_mod'].'</a></td>
					<td class="stats_menu'.chk_cmd($scope, "own", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=groups&app='.$app.'&scope=own">'.$lang['svc_file']['groups_do_your'].'</a></td>
					<td class="stats_menu'.chk_cmd($scope, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=groups&app='.$app.'&scope=all">'.$lang['svc_file']['all_groups'].'</a></td>
				</tr>
			</table>
			<table>
				<tr>
					<td class="stats_menu'.chk_cmd($app, "design", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=groups&app=design&scope='.$scope.'">'.$lang['svc_file']['group_in_shop'].'</a></td>
					<td class="'.chk_groups_color_p().'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=groups&app=wait&scope='.$scope.'">'.$lang['svc_file']['group_pending'].'</a></td>
					<td class="stats_menu'.chk_cmd($app, "ok", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=groups&app=ok&scope='.$scope.'">'.$lang['svc_file']['a_open_group'].'</a></td>
					<td class="stats_menu'.chk_cmd($app, "closed", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=groups&app=closed&scope='.$scope.'">'.$lang['svc_file']['a_close_group'].'</a></td>
					<td class="stats_menu'.chk_cmd($app, "hidden", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=groups&app=hidden&scope='.$scope.'">'.$lang['svc_file']['a_hide_group'].'</a></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="stats_menuCmd"><a class="stats_menu" href="index.php?mode=svc&method=add&svc=groups">'.$lang['svc_file']['add_new_group'].'</a></td>
				</tr>
			</table><br>';
			echo'
			<table dir="rtl" cellSpacing="1" cellPadding="4">
			<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=groups&type=global">
				<tr>
					<td class="optionsbar_menus" colSpan="11"><font color="red" size="+1">'.$lang['svc_file']['real_group'].' '.$the_title.'</font></td>
				</tr>
				<tr>';
				if (mlv > 2){
					echo'
					<td class="stats_h"><nobr>&nbsp;</nobr></td>';
				}
					echo'
					<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['group_address'].'</nobr></td>
					<td class="stats_h">&nbsp;</td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['group_points'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['group_login'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['group_added'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['members']['options'].'</nobr></td>
					<td class="stats_h">'.$lang['svc_file']['group_members'].'</td>
				</tr>';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS ".chk_groups_get()." ORDER BY G_NAME ASC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$g_id = mysqli_result($sql, $x, "G_ID");
				$g_forum = groups("FORUM", $g_id);
				$g_status = groups("STATUS", $g_id);
				svc_show_groups($g_id);
				$count = $count + 1;
				if (allowed($g_forum, 1) == 1 AND $g_status != 2){
					$count_chk = $count_chk + 1;
				}
			++$x;
			}
			if ($count_chk > 0 && $app == "wait"){
				echo'
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="optionsbar_menus" colspan="10"><input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['group_selected_num'].'\')">&nbsp;&nbsp;<input onclick="on_submit(this)" type="button" value="'.$lang['svc_file']['approve_this_groups'].'"></td>
				</tr>';
			}
			if ($count == 0){
				echo'
				<tr>
					<td class="stats_p" align="center" colspan="10"><br><font color="red">'.$lang['svc_file']['no_groups_this'].'</font><br><br></td>
				</tr>';
			}
			echo'
			</form>
			</table>
			</center><br>';

	}
	
	

	if (svc == "special_medals_points"){
		
		if($Mlevel != 4) {
		redirect();	
		}
		
		if($Mlevel == 4) {

?>
<script language="javascript">
	function on_submit(obj){
		var box = obj.form.elements;
		var count = 0;
		for (i = 0; i < box.length; i++) {
			if (box[i].type == "checkbox" && box[i].checked == true){
				count += 1;
			}
		}
		if (count > 0){
			obj.form.submit();
		}
		else{
			confirm(select_medals_points);
			return;
		}
	}
</script>
<?php

		if (empty($app)){
			$app = "ok";
		}
		else{
			$app = $app;
		}
		if (empty($scope)){
			$scope = "mod";
		}
		else{
			$scope = $scope;
		}

		if ($app == "design"){
			$the_title = $lang['svc_file']['in_shop'];
		}
		if ($app == "wait"){
			$the_title = $lang['svc_function']['moderation_it_pending'];
		}
		if ($app == "ok"){
			$the_title = $lang['svc_file']['opened'];
		}
		if ($app == "closed"){
			$the_title = $lang['svc_file']['closed'];
		}
			echo'
			<center>
			<table>
				<tr>
					<td class="stats_menu'.chk_cmd($scope, "own", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=special_medals_points&app='.$app.'&scope=own">'.$lang['svc_file']['medals_points_add_you'].'</a></td>
					<td class="stats_menu'.chk_cmd($scope, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=special_medals_points&app='.$app.'&scope=all">'.$lang['svc_file']['all_medals_points'].'</a></td>
				</tr>
			</table>
			<table>
				<tr>
					<td class="stats_menu'.chk_cmd($app, "design", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=special_medals_points&app=design&scope='.$scope.'">'.$lang['svc_file']['medals_points_in_shop'].'</a></td>
					<td class="'.chk_special_medals_points_global_color_p().'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=special_medals_points&app=wait&scope='.$scope.'">'.$lang['svc_file']['medals_points_pending'].'</a></td>
					<td class="stats_menu'.chk_cmd($app, "ok", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=special_medals_points&app=ok&scope='.$scope.'">'.$lang['svc_file']['medals_points_opened'].'</a></td>
					<td class="stats_menu'.chk_cmd($app, "closed", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=special_medals_points&app=closed&scope='.$scope.'">'.$lang['svc_file']['medals_points_closed'].'</a></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="stats_menuCmd"><a class="stats_menu" href="index.php?mode=svc&method=add&svc=special_medals_points">'.$lang['svc_file']['add_new_medals_points'].'</a></td>
				</tr>
			</table><br>';
			echo'
			<table dir="rtl" cellSpacing="1" cellPadding="4">
			<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=special_medals_points&type=global">
				<tr>
					<td class="optionsbar_menus" colSpan="10"><font color="red" size="+1">'.$lang['svc_file']['a_medals_points'].' - '.$the_title.'</font></td>
				</tr>
				<tr>';

					echo'
					<td class="stats_h"><nobr>&nbsp;</nobr></td>
					<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['a_title'].'</nobr></td>
					<td class="stats_h">&nbsp;</td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['group_points'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['need_moderate_monitor'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['show_for'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['added_medals_points'].'</nobr></td>
					<td class="stats_h">'.$lang['members']['options'].'</td>
				</tr>';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."GLOBAL_MEDALS ".chk_global_special_medals_points_get()." ORDER BY SUBJECT ASC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$m = mysqli_result($sql, $x, "MEDAL_ID");
				$status = gm("STATUS", $m);
				svc_show_global_special_medals_points($m);
				$count = $count + 1;
				if ($Mlevel == 4 AND $status != 1){
					$count_chk = $count_chk + 1;
				}
			++$x;
			}
			if ($count_chk > 0){
				echo'
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="optionsbar_menus" colspan="10"><input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_medals_points'].'\')">&nbsp;&nbsp;<input onclick="on_submit(this)" type="button" value="'.$lang['svc_file']['moderate_medals_points'].'"></td>
				</tr>';
			}
			if ($count == 0){
				echo'
				<tr>
					<td class="stats_p" align="center" colspan="10"><br><font color="red">'.$lang['svc_file']['no_medals_points'].'</font><br><br></td>
				</tr>';
			}
			echo'
			</form>
			</table>
			</center><br>';
			
		} else {
		redirect();	
		}

	}
	
	
	if (svc == "medals"){

?>
<script language="javascript">
	function on_submit(obj){
		var box = obj.form.elements;
		var count = 0;
		for (i = 0; i < box.length; i++) {
			if (box[i].type == "checkbox" && box[i].checked == true){
				count += 1;
			}
		}
		if (count > 0){
			obj.form.submit();
		}
		else{
			confirm(select_a_medals);
			return;
		}
	}
</script>
<?php

		if (empty($app)){
			$app = "ok";
		}
		else{
			$app = $app;
		}
		if (empty($scope)){
			$scope = "mod";
		}
		else{
			$scope = $scope;
		}

		if ($app == "design"){
			$the_title = $lang['svc_file']['in_shop'];
		}
		if ($app == "wait"){
			$the_title = $lang['svc_function']['moderation_it_pending'];
		}
		if ($app == "ok"){
			$the_title = $lang['svc_file']['opened'];
		}
		if ($app == "closed"){
			$the_title = $lang['svc_file']['closed'];
		}
			echo'
			<center>
			<table>
				<tr>
					<td class="stats_menu'.chk_cmd($scope, "mod", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=medals&app='.$app.'&scope=mod">'.$lang['title_page']['your_forums_mod'].'</a></td>
					<td class="stats_menu'.chk_cmd($scope, "own", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=medals&app='.$app.'&scope=own">'.$lang['svc_file']['medals_you_added'].'</a></td>
					<td class="stats_menu'.chk_cmd($scope, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=medals&app='.$app.'&scope=all">'.$lang['svc_file']['all_medals'].'</a></td>
				</tr>
			</table>
			<table>
				<tr>
					<td class="stats_menu'.chk_cmd($app, "design", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=medals&app=design&scope='.$scope.'">'.$lang['svc_file']['medals_in_shop'].'</a></td>
					<td class="'.chk_medals_color_p().'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=medals&app=wait&scope='.$scope.'">'.$lang['svc_file']['pending_medals'].'</a></td>
					<td class="stats_menu'.chk_cmd($app, "ok", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=medals&app=ok&scope='.$scope.'">'.$lang['svc_file']['medals_opend'].'</a></td>
					<td class="stats_menu'.chk_cmd($app, "closed", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=medals&app=closed&scope='.$scope.'">'.$lang['svc_file']['medals_closd'].'</a></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="stats_menuCmd"><a class="stats_menu" href="index.php?mode=svc&method=add&svc=medals">'.$lang['admin_list']['add_new_medal'].'</a></td>
				</tr>
			</table><br>';
			echo'
			<table dir="rtl" cellSpacing="1" cellPadding="4">
			<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=medals&type=global">
				<tr>
					<td class="optionsbar_menus" colSpan="10"><font color="red" size="+1">'.$lang['member']['medals'].' - '.$the_title.'</font></td>
				</tr>
				<tr>';
				if (mlv > 2){
					echo'
					<td class="stats_h"><nobr>&nbsp;</nobr></td>';
				}
					echo'
					<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['a_title'].'</nobr></td>
					<td class="stats_h">&nbsp;</td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['group_points'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['need_moderate_monitor'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['show_for'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['added_medals'].'</nobr></td>
					<td class="stats_h">&nbsp;</td>
				</tr>';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."GLOBAL_MEDALS ".chk_global_medals_get()." ORDER BY SUBJECT ASC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$m = mysqli_result($sql, $x, "MEDAL_ID");
				$f = gm("FORUM_ID", $m);
				$status = gm("STATUS", $m);
				svc_show_global_medals($m);
				$count = $count + 1;
				if (allowed($f, 1) == 1 AND $status != 1){
					$count_chk = $count_chk + 1;
				}
			++$x;
			}
			if ($count_chk > 0){
				echo'
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="optionsbar_menus" colspan="10"><input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_medals'].'\')">&nbsp;&nbsp;<input onclick="on_submit(this)" type="button" value="'.$lang['svc_file']['moderate_medals'].'"></td>
				</tr>';
			}
			if ($count == 0){
				echo'
				<tr>
					<td class="stats_p" align="center" colspan="10"><br><font color="red">'.$lang['svc_file']['no_medals'].'</font><br><br></td>
				</tr>';
			}
			echo'
			</form>
			</table>
			</center><br>';

	}
	if (svc == "titles"){
		?>
		<script language="javascript">
			function on_submit(obj){
				var box = obj.form.elements;
				var count = 0;
				for (i = 0; i < box.length; i++) {
					if (box[i].type == "checkbox" && box[i].checked == true){
						count += 1;
					}
				}
				if (count > 0){
					obj.form.submit();
				}
				else{
					confirm(select_one_title);
					return;
				}
			}
		</script>
		<?php
		if (empty($app)){
			$app = "ok";
		}
		else{
			$app = $app;
		}
		if (empty($scope)){
			$scope = "mod";
		}
		else{
			$scope = $scope;
		}


		if ($app == "design"){
			$the_title = $lang['svc_file']['in_shop'];
		}
		if ($app == "wait"){
			$the_title = $lang['svc_function']['moderation_it_pending'];
		}
		if ($app == "ok"){
			$the_title = $lang['svc_file']['opened'];
		}
		if ($app == "closed"){
			$the_title = $lang['svc_file']['closed'];
		}
		if ($app == "all"){
			$the_title = $lang['admin_list']['all_titles'];
		}
		echo'
		<center>
		<table>
			<tr>
				<td class="stats_menuCmd"><a class="stats_menu" href="index.php?mode=svc&method=add&svc=titles">'.$lang['admin_list']['add_new_title'].'</a></td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="stats_menu'.chk_cmd($scope, "mod", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=titles&app='.$app.'&scope=mod">'.$lang['title_page']['your_forums_mod'].'</a></td>
				<td class="stats_menu'.chk_cmd($scope, "own", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=titles&app='.$app.'&scope=own">'.$lang['svc_file']['titles_added_you'].'</a></td>
				<td class="stats_menu'.chk_cmd($scope, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=titles&app='.$app.'&scope=all">'.$lang['admin_list']['all_titles'].'</a></td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="stats_menu'.chk_cmd($app, "design", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=titles&app=design&scope='.$scope.'">'.$lang['svc_file']['titles_in_shop'].'</a></td>
				<td class="'.chk_titles_color_p().'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=titles&app=wait&scope='.$scope.'">'.$lang['admin_list']['pending_titles'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "ok", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=titles&app=ok&scope='.$scope.'">'.$lang['svc_file']['titles_opend'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "closed", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=titles&app=closed&scope='.$scope.'">'.$lang['svc_file']['titles_closd'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=titles&app=all&scope='.$scope.'">'.$lang['admin_list']['all_titles'].'</a></td>
			</tr>
		</table><br>';

		echo'
		<table cellSpacing="1" cellPadding="2">
		<form name="app_medals" method="post" action="index.php?mode=svc&method=app&svc=titles&type=global">
			<tr>
				<td class="optionsbar_menus" colSpan="15"><font color="red" size="+1">'.$lang['title_page']['titles_list'].' - '.$the_title.'</font></td>
			</tr>
			<tr>';
			if (mlv > 2){
				echo'
				<td class="stats_h"><nobr>&nbsp;</nobr></td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['a_title'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['show_in_all_forum'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['this_added_title'].'</nobr></td>
				<td class="stats_h" colspan="2">'.$lang['members']['options'].'</td>
			</tr>';

			$sql = DBi::$con->query("SELECT * FROM ".prefix."GLOBAL_TITLES ".chk_global_titles_get()." ORDER BY SUBJECT ASC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$t = mysqli_result($sql, $x, "TITLE_ID");
				$f = gt("FORUM_ID", $t);
				$status = gt("STATUS", $t);
				svc_show_global_titles($t);
				$count = $count + 1;
				if (allowed($f, 1) == 1 AND $status != 1){
					$count_chk = $count_chk + 1;
				}
			++$x;
			}
			if ($count_chk > 0){
				echo'
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="optionsbar_menus" colspan="15"><input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_titles_selected'].'\')">&nbsp;&nbsp;<input onclick="on_submit(this)" type="button" value="'.$lang['svc_file']['moderate_this_titles'].'"></td>
				</tr>';
			}
			if ($count == 0){
				echo'
				<tr>
					<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_titles_this'].'</font><br><br></td>
				</tr>';
			}

		echo'
		</form>
		</table>
		</center><br>';
	}
	if (svc == "surveys") {
		if (empty($app)){
			$app = "running";
		}
		else{
			$app = $app;
		}
		echo'
		<center>
		<table>
			<tr>
				<td class="stats_menu'.chk_cmd($app, "running", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=surveys&app=running">'.$lang['admin_list']['open_surveys'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "ended", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=surveys&app=ended">'.$lang['svc_file']['ended_surveys'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "closed", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=surveys&app=closed">'.$lang['svc_file']['closd_surveys'].'</a></td>
				<td class="stats_menu'.chk_cmd($app, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=surveys&app=all">'.$lang['svc_file']['all_surveys'].'</a></td>
				<td></td><td></td><td></td><td></td>
				<td class="stats_menuCmd"><a class="stats_menu" href="index.php?mode=svc&method=add&svc=surveys">'.$lang['admin_list']['add_new_survey'].'</a></td>
			</tr>
		</table>
		<table cellSpacing="1" cellPadding="0">
			<tr>
				<td class="optionsbar_menus" colSpan="15"><font color="red" size="+1">'.$lang['title_page']['surveys'].'</font></td>
			</tr>
			<tr>
				<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['group_address'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['start_date'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['ended_date'].'</nobr></td>
				<td class="stats_h">'.$lang['svc_file']['secret'].'</td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['posts_to_survey'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['svc_file']['days_to_survey'].'</nobr></td>
				<td class="stats_h">'.$lang['members']['options'].'</td>
			</tr>';
		$sql = DBi::$con->query("SELECT * FROM ".prefix."SURVEYS ".chk_surveys_get($_GET)." ORDER BY SUBJECT ASC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
		$num = mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
			$s = mysqli_result($sql, $x, "SURVEY_ID");
			svc_show_surveys($s);
			$count = $count + 1;
		++$x;
		}
		if ($count == 0){
			echo'
			<tr>
				<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_surveys'].'</font><br><br></td>
			</tr>';
		}
		echo'
		</table>
		</center>';
	}
 if(!$sel){
 $where_type = "";
 }
 if (svc == "mon") {
	 
	if($Mlevel == 4) {
	 switch ($show) {
       case "mon_pending": $where_status = "WHERE M_STATUS = '0'"; $text = $lang['svc_file']['pending_requests']; $text2 = $lang['svc_file']['from_onitor']; break;
       case "all": $where_status = ""; $text = $lang['svc_file']['see_all_requests']; break;
       case "cur": $where_status = "AND M_STATUS = '1'"; $text2 = $lang['svc_function']['moderation_it_now']; break;
       case "own": $where_status = "AND M_STATUS = '1' AND M_EXECUTE = '$DBMemberID'"; $text2 = $lang['svc_file']['in_from_you']; break;
       case "exp": $where_status = "AND M_STATUS = '3'"; $text2 = $lang['svc_function']['moderation_it_cancel']; break;
       case "pending": $where_status = "AND M_STATUS = '0'"; $text2 = $lang['svc_file']['pending_requests']; break;
       case "approved": $where_status = "AND M_STATUS = '1'"; $text2 = $lang['svc_file']['accepted_requests']; break;
       case "rejected": $where_status = "AND M_STATUS = '2'"; $text2 = $lang['svc_file']['refused_requests']; break;
	   default: redirect(); exit(); break;
  }
  switch ($sel) {
	   case "1": $where_type = ""; $text = ""; break;
       case "1": $where_type = "WHERE M_TYPE = '1'"; $text = $lang['svc_function']['moderation_1']; break;
       case "2": $where_type = "WHERE M_TYPE = '2'"; $text = $lang['svc_file']['moderat_2']; break;
       case "3": $where_type = "WHERE M_TYPE = '3'"; $text = $lang['svc_file']['moderat_3']; break;
       case "4": $where_type = "WHERE M_TYPE = '4'"; $text = $lang['svc_file']['moderat_4']; break;
       case "5": $where_type = "WHERE M_TYPE = '5'"; $text = $lang['svc_function']['moderation_5']; break;
       case "7": $where_type = "WHERE M_TYPE = '7'"; $text = $lang['svc_file']['moderat_7']; break;
       case "8": $where_type = "WHERE M_TYPE = '8'"; $text = $lang['svc_file']['moderat_8']; break;
       case "9": $where_type = "WHERE M_TYPE = '9'"; $text = $lang['svc_file']['moderat_9']; break;
       case "10": $where_type = "WHERE M_TYPE = '10'"; $text = $lang['svc_file']['moderat_10']; break;
	   case "11": $where_type = "WHERE M_TYPE = '11'"; $text = $lang['svc_file']['moderat_11']; break;
       case "12": $where_type = "WHERE M_TYPE = '12'"; $text = $lang['svc_file']['moderat_12']; break;
	   default: if ($show != "all" AND $show != "mon_pending" && $sel == ""){ $sel = 1; $where_type = "WHERE M_TYPE = '1'"; $text = $lang['svc_function']['moderation_1']; } break;
  }
		} else {
				 switch ($show) {
       case "mon_pending": $where_status = "WHERE M_STATUS = '0' AND"; $text = $text = $lang['svc_file']['pending_requests']; $text2 = $lang['svc_file']['from_onitor']; break;
       case "all": $where_status = "WHERE"; $text = $lang['svc_file']['see_all_requests']; break;
       case "cur": $where_status = "AND M_STATUS = '1'  AND"; $text2 = $lang['svc_function']['moderation_it_now']; break;
       case "own": $where_status = "AND M_STATUS = '1' AND M_EXECUTE = '$DBMemberID' AND"; $text2 = $lang['svc_file']['in_from_you']; break;
       case "exp": $where_status = "AND M_STATUS = '3' AND"; $text2 = $lang['svc_function']['moderation_it_cancel']; break;
       case "pending": $where_status = "AND M_STATUS = '0'  AND"; $text2 = $lang['svc_file']['pending_requests']; break;
       case "approved": $where_status = "AND M_STATUS = '1'  AND"; $text2 = $lang['svc_file']['accepted_requests']; break;
       case "rejected": $where_status = "AND M_STATUS = '2'  AND"; $text2 = $lang['svc_file']['refused_requests']; break;
	   default: redirect(); exit(); break;
  }
  switch ($sel) {
	   case "1": $where_type = ""; $text = ""; break;
       case "1": $where_type = "WHERE M_TYPE = '1'"; $text = $lang['svc_function']['moderation_1']; break;
       case "2": $where_type = "WHERE M_TYPE = '2'"; $text = $lang['svc_file']['moderat_2']; break;
       case "3": $where_type = "WHERE M_TYPE = '3'"; $text = $lang['svc_file']['moderat_3']; break;
       case "4": $where_type = "WHERE M_TYPE = '4'"; $text = $lang['svc_file']['moderat_4']; break;
       case "5": $where_type = "WHERE M_TYPE = '5'"; $text = $lang['svc_function']['moderation_5']; break;
       case "7": $where_type = "WHERE M_TYPE = '7'"; $text = $lang['svc_file']['moderat_7']; break;
       case "8": $where_type = "WHERE M_TYPE = '8'"; $text = $lang['svc_file']['moderat_8']; break;
       case "9": $where_type = "WHERE M_TYPE = '9'"; $text = $lang['svc_file']['moderat_9']; break;
       case "10": $where_type = "WHERE M_TYPE = '10'"; $text = $lang['svc_file']['moderat_10']; break;
	   case "11": $where_type = "WHERE M_TYPE = '11'"; $text = $lang['svc_file']['moderat_11']; break;
       case "12": $where_type = "WHERE M_TYPE = '12'"; $text = $lang['svc_file']['moderat_12']; break;
	   default: if ($show != "all" AND $show != "mon_pending" && $sel == ""){
		   $sel = 1;
		   $where_type = "WHERE M_TYPE = '1'";
		   $text = $lang['svc_function']['moderation_1']; 
                }
   break;
  }
		}
  
  if ($sel == "" AND $show != "all" AND $show != "mon_pending"){
      $empty_sel = "WHERE MODERATION_ID";
  }
  else{
	  $empty_sel ="";
  }
  if ($sel != "" AND $show != "") {
          $texte = $text." - ".$text2;
  }
  else {
          $texte = $text." ".$text2;
  }
 
  echo'
  <center>
  <table width="100%" cellSpacing="0" cellPadding="0">
   <tr>
    <td>
    <table cellSpacing="2" cellPadding="3" align="center">
     <tr>';
     if ($Mlevel > 2) {
      echo'<td class="'.chk_req_mon_pending().'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&show=mon_pending">'.$lang['svc_file']['pending_requests'].'</a></nobr></td>';
     }
      echo'<td class="'.monOptionclass("all", $show, "stats_menuCmd").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&show=all">'.$lang['svc_file']['see_all_requests'].'</a></nobr></td>
     </tr>
    </table>
    <table cellSpacing="2" cellPadding="3" align="center">
     <tr>
      <td class="'.chk_req_mon_types("1").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=1&show=cur">'.$lang['svc_function']['moderation_1'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("2").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=2&show=cur">'.$lang['svc_file']['moderat_2'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("3").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=3&show=cur">'.$lang['svc_file']['moderat_3'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("4").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=4&show=cur">'.$lang['svc_file']['moderat_4'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("7").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=7&show=cur">'.$lang['svc_file']['moderat_7'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("8").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=8&show=cur">'.$lang['svc_file']['moderat_8'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("9").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=9&show=cur">'.$lang['svc_file']['moderat_9'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("10").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=10&show=cur">'.$lang['svc_file']['moderat_10'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("11").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=11&show=cur">'.$lang['svc_file']['moderat_11'].'</a></nobr></td>
      <td class="'.chk_req_mon_types("12").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=12&show=cur">'.$lang['svc_file']['moderat_12'].'</a></nobr></td>
	  <td></td>
      <td class="'.chk_req_mon_types("5").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel=5&show=cur">'.$lang['svc_function']['request_lock'].'</a></nobr></td>
     </tr>
    </table>
    <table cellSpacing="2" cellPadding="3" align="center">
     <tr>
      <td class="'.monOptionclass("cur", $show, "stats_menuSel").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel='.$sel.'&show=cur">'.$lang['svc_function']['moderation_it_now'].'</a></nobr></td>
      <td class="'.monOptionclass("own", $show, "stats_menuSel").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel='.$sel.'&show=own">'.$lang['svc_file']['in_from_you'].'</a></nobr></td>
      <td class="'.monOptionclass("exp", $show, "stats_menuSel").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel='.$sel.'&show=exp">'.$lang['svc_function']['moderation_it_cancel'].'</a></nobr></td>
      <td class="'.chk_req_mon_pend().'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel='.$sel.'&show=pending">'.$lang['svc_file']['pending_requests'].'</a></nobr></td>
      <td class="'.monOptionclass("approved", $show, "stats_menuSel").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel='.$sel.'&show=approved">'.$lang['svc_file']['accepted_requests'].'</a></nobr></td>
      <td class="'.monOptionclass("rejected", $show, "stats_menuSel").'"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&sel='.$sel.'&show=rejected">'.$lang['svc_file']['refused_requests'].'</a></nobr></td>
     </tr>	 
    </table>
    </td>
   </tr>
  </table>
  <table cellSpacing="1" cellPadding="1">
   <tr>
    <td class="optionsbar_menus" colSpan="20"><font color="red" size="4">'.$texte.'</font></td>
   </tr>
   <tr>
    <td class="stats_h"><nobr></nobr></td>
    <td class="stats_h"><nobr>'.$lang['members']['members'].'</nobr></td>
    <td class="stats_h"><nobr>'.$lang['svc_function']['type'].'</nobr></td>
    <td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
    <td class="stats_h" colspan="2"><nobr>'.$lang['svc_file']['added_the_this_request'].'</nobr></td>
    <td class="stats_h"><nobr>'.$lang['svc_file']['refus_the_this_request'].'</nobr></td>
    <td class="stats_h" colspan="2"><nobr>'.$lang['request_mon']['apply_this'].'</nobr></td>
    <td class="stats_h" colspan="2"><nobr>'.$lang['profile']['cancel'].'</nobr></td>
    <td class="stats_h"><nobr></nobr>'.$lang['request_mon']['days_req'].'</td>
    <td class="stats_h"><nobr></nobr></td>';
	if($Mlevel > 2) {
	echo'	
			<td class="stats_h"><nobr></nobr>'.$lang['others']['delete_a_requestmon'].'</td>
	';
	}
	echo'
   </tr>';
   if($Mlevel == 4) {
	 $and = "AND";	 
   } else {
	 $and = "";  
   }
   if($Mlevel == 4) {
 $sql = " SELECT * FROM " . $Prefix . "MODERATION ";
  $sql .= " ".$empty_sel." ".$where_type." ".$where_status."  ";
  $sql .= " ORDER BY M_DATE DESC ";
   } else {
  $sql = " SELECT * FROM " . $Prefix . "MODERATION ";
  $sql .= " ".$empty_sel." ".$where_type." ".$where_status." M_FORUMID IN (".chk_allowed_forums_all_id().") ";
  $sql .= " ORDER BY M_DATE DESC ";
   }
  if($sel == 10){
  $sql = " SELECT * FROM " . $Prefix . "MODERATION ";
  $sql .= " ".$empty_sel." ".$where_type." ".$where_status." ".$and." M_PM > 0 ";
  $sql .= " ORDER BY M_DATE DESC ";
  }
   if($sel == 12){
  $sql = " SELECT * FROM " . $Prefix . "MODERATION ";
  $sql .= " ".$empty_sel." ".$where_type." ".$where_status." ".$and." M_IHDAA > 0 ";
  $sql .= " ORDER BY M_DATE DESC ";
  } 

  $result = DBi::$con->query($sql) or die(database_error(__line__,1));
  $num = mysqli_num_rows($result);
  if ($num == 0) {
   echo'
   <tr>
    <td class="stats_h" align="center" colspan="14"><br><font size="3">'.$lang['svc_file']['no_requests_mon_this_a'].'</font><br><br></td>
   </tr>';
  }
  else {
  $x=0;
  while ($x < $num) {
  $m = mysqli_result($result, $x, "MODERATION_ID");
  svc_show_mon($m);
  ++$x;
  }
  }
  echo'
  </table>
  </center>';
 }
     if (svc == "m_stat"){

$f = DBi::$con->real_escape_string(trim(intval($_GET['f'])));
$svcc = DBi::$con->real_escape_string(trim($_GET['sv']));
$Monitor = chk_monitor($DBMemberID, cat_id($f));
$Moderator = chk_moderator($DBMemberID, $f);
if($Mlevel == 4 or $Moderator == 1 or $Monitor == 1) {

if(empty($svcc)) $svcc = "t";

echo '<div align="center"><table>
			<tr>
				<td class="stats_menu'.chk_cmd($svcc, "t", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=m_stat&sv=t&f='.$f.'">'.$lang['admin_svc']['by_topics'].'</a></td>
				<td class="stats_menu'.chk_cmd($svcc, "p", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=m_stat&sv=p&f='.$f.'"">'.$lang['admin_svc']['by_posts'].'</a></td>
			</tr>
		</table></div>';

if($svcc == "t"){
$sql =  DBi::$con->query("SELECT COUNT(post.TOPIC_ID) AS count, member.M_NAME,member.MEMBER_ID FROM ".prefix."MEMBERS AS member LEFT JOIN ".prefix."TOPICS  AS post ON (post.T_AUTHOR = member.MEMBER_ID)  WHERE post.FORUM_ID = '$f' GROUP BY post.T_AUTHOR ORDER BY count DESC LIMIT 10")or die (DBi::$con->error);
}
if($svcc == "p"){
$sql =  DBi::$con->query("SELECT COUNT(post.REPLY_ID) AS count, member.M_NAME,member.MEMBER_ID FROM ".prefix."MEMBERS AS member LEFT JOIN ".prefix."REPLY  AS post ON (post.R_AUTHOR = member.MEMBER_ID)  WHERE post.FORUM_ID = '$f' GROUP BY post.R_AUTHOR ORDER BY count DESC LIMIT 10")or die (DBi::$con->error);
}

echo '<table bgcolor="gray" align="center" class="grid" cellSpacing="1" cellPadding="0" width="30%" border="0">
				<tr><td class="cat" width="10%">&nbsp;</td><td class="cat" width="40%">'.$lang['admin_svc']['name'].'</td><td class="cat" width="20%">'.$lang['members_function']['posts'].'</td></tr>';

if(mysqli_num_rows($sql) == 0){
echo '<tr><td class="f1" colspan="3" align="center">'.$lang['admin_svc']['no_result'].'</td></tr>';
}

$i=1;					
while($r = mysqli_fetch_array($sql)){
echo '<tr><td class="f2ts">'.$i.'</td><td class="f1"><a href="index.php?mode=member&id='.$r[MEMBER_ID].'">'.$r[M_NAME].'</a></td><td class="f1">'.$r[count].'</td></tr>';
$i++;
}
echo'</tr></table>';

} else {
redirect();	
}
	
}


if(svc == "social") {
	
echo'

	
	<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
	<td>
	<center>
	<form method=post action=index.php?mode=svc&method=svc&svc=set_social>
	<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0" width="50%">
	<tr class="fixed">
	<td class="optionheader_selected" colSpan="5"><a><b><font color="white">'.$lang['svc_file']['a_social_options'].'</font></b></a></td>
	</tr>
	<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['members_function']['name'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	'.link_profile(m_name,$DBMemberID).'
	</td>
	</tr>
	<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['svc_file']['a_forum_active'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	<select class="forumSelect" style="HEIGHT: 20px; WIDTH:150px; FONT-SIZE:10pt" size="1" name="forum">
		<option value="0" '.check_select($f, 0).'>'.$lang['svc_file']['select_a_forum_name'].'</option>	';
					$all_forums = chk_allowed_forums();
					for($x = 0; $x < count($all_forums); $x++){
						$f_id = $all_forums[$x];
						echo'
						<option value="'.$f_id.'" '.check_select($f, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
					}	
      echo'</select>
		</td>';
	echo'</td>
	</tr>
	<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['add_cat_forum']['active'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">

<input type="radio" class="radio" name="social" value="1" '.check_radio($type, 1).'>'.$lang['svc_file']['active_in_forum'].'&nbsp;&nbsp;&nbsp;
<input type="radio" class="radio" name="social" value="0" '.check_radio($type, 0).'>'.$lang['svc_file']['not_active_in_forum'].'
				</td>
	</tr>
		<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['add_cat_forum']['hashtag'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	<font color="black" size="3">#</font> <input class="insidetitle" style="WIDTH: 170px" name="hashtag">
	</td>
	</tr>
	<tr class="fixed">
	<td class="list_center" colSpan="5">
	<input onclick="submit()" type="button" value="'.$lang['svc_file']['enter_request'].'"></td>
	</tr>
	</form>
    </center>
	</table>
	
';	
}

if(svc == "set_social") {
  $id = m_id;
	$txt=DBi::$con->real_escape_string(htmlspecialchars($_POST['hashtag']));
	$clearTxt = preg_replace( "/(<\/?)(\w+)([^>]*>)/e", "" , $txt);
	$hashtag = nl2br($clearTxt);
	$forum = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum']));
	$social = DBi::$con->real_escape_string(htmlspecialchars($_POST['social']));
	$sql2 = DBi::$con->query("SELECT * FROM ".$Prefix."SOCIAL WHERE REQ_FRMID = '$forum' and REQ_USERID = '$id' and REQ_STATUS = '2'") 
	or die(DBi::$con->error);
	$app=mysqli_num_rows($sql2);
	if($app > 0){
	$err=$lang['svc_file']['a_pending_request'];
	}
	elseif($forum == 0){
	$err=$lang['svc_file']['select_a_forum'];
	}
	elseif(!$hashtag){
	$err=$lang['svc_file']['add_a_hashtag'];
	}
	elseif($social == ""){
	$err=$lang['svc_file']['active_this'];
	}		
	else{
	$err="";
	}
    if($err == ""){
	$req = "INSERT INTO ".prefix."SOCIAL (REQ_ID, REQ_STATUS, REQ_USERID, REQ_FRMID, REQ_SOCIAL, REQ_HASHTAG) VALUES (NULL, 2, ";
	$req .= "'$id', ";	
	$req .= "'$forum', ";
	$req .= "'$social',";		
	$req .= "'$hashtag')";		
	DBi::$con->query($req) or die (DBi::$con->error);
	
	echo'
	<br><center>
	<table width="99%" border="1">
	<tr class="normal">
	 <meta http-equiv="Refresh" content="1; URL= '.$_SERVER['HTTP_REFERER'].'">
	<td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_file']['done_insert_request'].' </font><br><br>
	<a href="'.$_SERVER['HTTP_REFERER'].'"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
	</td>
	</tr>
	</table>
	</center>';
	}
	else{
	echo'
	<br><center>
	<table width="99%" border="1">
	<tr class="normal">
	<td class="list_center" colSpan="10"><font size=5 color="red"><br>'.$err.'</font><br><br>
	<a href="JavaScript:history.go(-1)"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
	</td>
	</tr>
	</table>
	</center>';	
	}
    }	
	
if($Mlevel == 4) {
if(svc == "admin_social") {
	
if($type == "") {
	echo'
	<script language="javascript">
		var check_flag = "false";
		function check(checked, alert_msg){
			if (check_flag == "false"){
				var count = 0;
				for (i = 0; i < checked.length; i++){
					checked[i].checked = true;
					if (checked[i].type == "checkbox"){
						count += 1;
					}
				}
				check_flag = "true";
				alert(alert_msg+": "+count);
				return (delete_select_all);
			}
			else {
				for (i = 0; i < checked.length; i++){
					checked[i].checked = false;
				}
				check_flag = "false";
				return (select_all);
			}
		}
		function chk_app_user(obj){
			if (obj.name == "yes"){
				var go_to = confirm("'.$lang['svc_file']['confirm_approve_this'].'");
				if (go_to){
					obj.form.method.value = "yes";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "no"){
				var go_to = confirm("'.$lang['svc_file']['confirm_refused_this'].'");
				if (go_to){
					obj.form.method.value = "no";
					obj.form.submit();
				}
				else{
					return;
				}
			}
		}
	</script>';
	echo'
	<center>
	<br>
	<table cellSpacing="1" cellPadding="5">
	<form name="req" method="post" action="index.php?mode=svc&method=svc&svc=admin_social&type=admin_set_social">
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="18"><font color="red" size="+1"><b>'.$lang['svc_file']['admin_social_list'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h"></td>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['svc_file']['a_forum_active'].'</nobr></td>			
			<td class="stats_h"><nobr>'.$lang['add_cat_forum']['active'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['add_cat_forum']['hashtag'].'</nobr></td>';
	$req = DBi::$con->query("SELECT * FROM ".$Prefix."SOCIAL WHERE REQ_STATUS = '2'") 
	or die(DBi::$con->error);
	$nreq=mysqli_num_rows($req);
	$i=0;
	while ($i < $nreq) {
	$id = mysqli_result($req, $i, "REQ_ID");	
	$uid = mysqli_result($req, $i, "REQ_USERID");	
	$fid = mysqli_result($req, $i, "REQ_FRMID");
	$social = mysqli_result($req, $i, "REQ_SOCIAL");
	$hashtag = mysqli_result($req, $i, "REQ_HASHTAG");
    $frmname = forums("SUBJECT", $fid);
	$username = link_profile(members("NAME", $uid), $uid);
	$userposts = members("POSTS", $uid);
	if($social == 1) {
	$social_msg = $lang['svc_file']['active_in_forum'];
	}
	if($social == 0) {
	$social_msg = $lang['svc_file']['not_active_in_forum'];	
	}	
	
	echo'
	<tr>
	<td class="stats_p"><nobr>&nbsp;<input class="small" type="checkbox" name="app[]" value="'.$id.'"></nobr></td>
	<td class="stats_h">'.$id.'</td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$frmname.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$social_msg.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>#'.$hashtag.'</b></font></td>
	
	</tr>';
	$x = $x + 1;
	
	$i++;
	}
		if ($x > 0){
		echo'
		<tr>
			<td height="30" colspan="18">&nbsp;</td>
		</tr>
		<tr>
			<td class="optionsbar_menus" colspan="18">
				<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_requests_selected'].'\')">&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="yes" type="button" onclick="chk_app_user(this)" value="'.$lang['svc_file']['approve_selected'].'">&nbsp;
				<input name="no" type="button" onclick="chk_app_user(this)" value="'.$lang['svc_file']['refused_selected'].'">&nbsp;
			</td>
		</tr>';
	    }
	echo'
	</form>
	
	<center>';

	if($x==0 ){
		echo'
		
		<tr>
				<td class="stats_p" align="center" colspan="13"><br><font color="red">'.$lang['svc_file']['no_this_requests'].'</font><br><br></td>
		</tr>';
		}
		echo'</table>';
		
}
	
	if($type == "admin_set_social") {
	
	$method = $_POST['method'];
	$app = $_POST['app'];
	if ($app == ""){
		$error = $lang['svc_file']['not_selected_any_this'];
	}
	if ($error != ""){
		error_message($error);
	}
	if ($error == ""){
	if ($method == "yes"){
			$req = DBi::$con->query("SELECT * FROM ".$Prefix."SOCIAL ORDER BY REQ_ID") 
	or die(DBi::$con->error);
	$i=0;
	$forumid = mysqli_result($req, $i, "REQ_FRMID");
	$hashtag = mysqli_result($req, $i, "REQ_HASHTAG");
	$social = mysqli_result($req, $i, "REQ_SOCIAL");

		$sql = "UPDATE ".prefix."FORUM SET ";
		$sql .= "F_HASHTAG = '$hashtag', ";
		if($social == 1) {
		$sql .= "F_SOCIAL = '1' ";
		}
		if($social == 0) {
		$sql .= "F_SOCIAL = '1' ";
		}	
		$sql .= "WHERE FORUM_ID = '$forumid' ";
		DBi::$con->query($sql) or die (DBi::$con->error);
		
		while($i  < count($app)){
				DBi::$con->query("DELETE FROM ".prefix."SOCIAL WHERE REQ_ID = '$app[$i]'") or die (DBi::$con->error); 

		
	    $msg_txt = $lang['svc_file']['done_approve_this_selected'];
		
		$i++;
		
		}
		}
		
if ($method == "no"){
		$req = DBi::$con->query("SELECT * FROM ".$Prefix."SOCIAL ORDER BY REQ_ID") 
	or die(DBi::$con->error);
	$i=0;
	
		while($i  < count($app)){
				DBi::$con->query("DELETE FROM ".prefix."SOCIAL WHERE REQ_ID = '$app[$i]'") or die (DBi::$con->error); 
		
		$i++;
		}
		$msg_txt = $lang['svc_file']['done_refused_this_selected'];
		
		}
		
		
		echo'
		<center>
		<table width="99%" border="1">
			<tr class="normal">
			<meta http-equiv="Refresh" content="1; URL= '.$_SERVER['HTTP_REFERER'].'">
				<td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_txt.'</b></font><br><br>
	            <a href="index.php?mode=svc&method=svc&svc=admin_social"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
				</td>
			</tr>
		</table>
		</center>';
	}
   }

}
}

if(svc == "author_mod") {
	
echo'

	
	<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
	<td>
	<center>
	<form method=post action=index.php?mode=svc&method=svc&svc=set_author_mod>
	<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0" width="50%">
	<tr class="fixed">
	<td class="optionheader_selected" colSpan="5"><a><b><font color="white">'.$lang['temy_other']['add_new_author_mod'].'</font></b></a></td>
	</tr>
	<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['members_function']['name'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	'.link_profile(m_name,$DBMemberID).'
	</td>
	</tr>
	<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['temy_other']['a_forum_author'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	<select class="forumSelect" style="HEIGHT: 20px; WIDTH:150px; FONT-SIZE:10pt" size="1" name="forum">
		<option value="0" '.check_select($f, 0).'>'.$lang['svc_file']['select_a_forum_name'].'</option>	';
					$all_forums = chk_allowed_forums();
					for($x = 0; $x < count($all_forums); $x++){
						$f_id = $all_forums[$x];
						echo'
						<option value="'.$f_id.'" '.check_select($f, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
					}	
      echo'</select>
		</td>';
	echo'</td>
	</tr>
		<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['temy_other']['author_the_name'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	 <input class="insidetitle" style="WIDTH: 170px" name="author">
	</td>
	</tr>
		<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['temy_other']['a_color1_author'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	 <input class="insidetitle" style="WIDTH: 50px" name="color1">
	</td>
	</tr>
		<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['temy_other']['a_color2_author'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	 <input class="insidetitle" style="WIDTH: 50px" name="color2">
	</td>
	</tr>	
	<tr class="fixed">
	<td class="list_center" colSpan="5">
	<input onclick="submit()" type="button" value="'.$lang['svc_file']['enter_request'].'"></td>
	</tr>
	</form>
    </center>
	</table>
	
';	
}

if(svc == "set_author_mod") {
  $id = m_id;
	$txt=DBi::$con->real_escape_string(htmlspecialchars($_POST['author']));
	$clearTxt = preg_replace( "/(<\/?)(\w+)([^>]*>)/e", "" , $txt);
	$author = nl2br($clearTxt);
	$forum = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum']));
	$color1 = DBi::$con->real_escape_string(htmlspecialchars($_POST['color1']));
	$color2 = DBi::$con->real_escape_string(htmlspecialchars($_POST['color2']));
	$sql2 = DBi::$con->query("SELECT * FROM ".$Prefix."AUTHOR_MOD WHERE REQ_FRMID = '$forum' and REQ_USERID = '$id' and REQ_STATUS = '2'") 
	or die(DBi::$con->error);
	$app=mysqli_num_rows($sql2);
	if($app > 0){
	$err=$lang['temy_other']['pending_author'];
	}
	elseif($forum == 0){
	$err=$lang['temy_other']['select_forum_author'];
	}
	elseif(!$author){
	$err=$lang['temy_other']['enter_author_mod'];
	}	
	elseif(!$color1){
	$err=$lang['temy_other']['enter_author_color'];
	}	
	elseif(!$color){
	$err=$lang['temy_other']['enter_author_color'];
	}		
	else{
	$err="";
	}
	if(allowed($forum, 1) == 1) {
	$the_status = 1;	
	} else {
	$the_status = 2;	
	}
    if($err == ""){
	$req = "INSERT INTO ".prefix."AUTHOR_MOD (REQ_ID, REQ_STATUS, REQ_USERID, REQ_FRMID, REQ_AUTHOR, REQ_COLOR1, REQ_COLOR2) VALUES (NULL, $the_status, ";
	$req .= "'$id', ";	
	$req .= "'$forum', ";
	$req .= "'$author',";		
	$req .= "'$color1',";		
	$req .= "'$color2')";		
	DBi::$con->query($req) or die (DBi::$con->error);
if(allowed($forum, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}	
	echo'
	<br><center>
	<table width="99%" border="1">
	<tr class="normal">
	 <meta http-equiv="Refresh" content="1; URL= '.$_SERVER['HTTP_REFERER'].'">
	<td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_file']['done_insert_request'].' </font><br><br>
	<a href="'.$_SERVER['HTTP_REFERER'].'"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
	</td>
	</tr>
	</table>
	</center>';
	}
	else{
	echo'
	<br><center>
	<table width="99%" border="1">
	<tr class="normal">
	<td class="list_center" colSpan="10"><font size=5 color="red"><br>'.$err.'</font><br><br>
	<a href="JavaScript:history.go(-1)"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
	</td>
	</tr>
	</table>
	</center>';	
	}
    }	
	
if(svc == "admin_author_mod") {
if($Mlevel > 2) {		
if($type == "") {
	echo'
	<script language="javascript">
		var check_flag = "false";
		function check(checked, alert_msg){
			if (check_flag == "false"){
				var count = 0;
				for (i = 0; i < checked.length; i++){
					checked[i].checked = true;
					if (checked[i].type == "checkbox"){
						count += 1;
					}
				}
				check_flag = "true";
				alert(alert_msg+": "+count);
				return (delete_select_all);
			}
			else {
				for (i = 0; i < checked.length; i++){
					checked[i].checked = false;
				}
				check_flag = "false";
				return (select_all);
			}
		}
		function chk_app_user(obj){
			if (obj.name == "yes"){
				var go_to = confirm("'.$lang['svc_file']['confirm_approve_this'].'");
				if (go_to){
					obj.form.method.value = "yes";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "no"){
				var go_to = confirm("'.$lang['svc_file']['confirm_refused_this'].'");
				if (go_to){
					obj.form.method.value = "no";
					obj.form.submit();
				}
				else{
					return;
				}
			}
		}
	</script>';
	echo'
	<center>
		<table>
		<br>	<tr>
				<td class="stats_menu'.chk_cmd($type, "", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=admin_author_mod">'.$lang['svc_file']['pending_requests'].'</a></td>
				<td class="stats_menu'.chk_cmd($type, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=admin_author_mod&type=all">'.$lang['temy_other']['the_authors'].'</a></td>
			</tr>
		</table>		
	<br>
	<table cellSpacing="1" cellPadding="5">
	<form name="req" method="post" action="index.php?mode=svc&method=svc&svc=admin_author_mod&type=admin_set_author_mod">
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="18"><font color="red" size="+1"><b>'.$lang['temy_other']['author_mod_admin_pending'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h"></td>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['temy_other']['a_forum_author'].'</nobr></td>			
			<td class="stats_h"><nobr>'.$lang['forum']['author'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['temy_other']['author_mod_style'].'</nobr></td>
			<td class="stats_h"><nobr><a href="index.php?mode=svc&method=svc&svc=author_mod">'.icons($folder_new).'</a></nobr></td>';
	$req = DBi::$con->query("SELECT * FROM ".$Prefix."AUTHOR_MOD WHERE REQ_STATUS = '2' AND REQ_FRMID IN (".chk_allowed_forums_all_id().")") 
	or die(DBi::$con->error);
	$nreq=mysqli_num_rows($req);
	$i=0;
	while ($i < $nreq) {
	$id = mysqli_result($req, $i, "REQ_ID");	
	$uid = mysqli_result($req, $i, "REQ_USERID");	
	$fid = mysqli_result($req, $i, "REQ_FRMID");
	$author_mod = mysqli_result($req, $i, "REQ_AUTHOR");
	$color1 = mysqli_result($req, $i, "REQ_COLOR1");
	$color2 = mysqli_result($req, $i, "REQ_COLOR2");
    $frmname = forums("SUBJECT", $fid);
	$username = link_profile(members("NAME", $uid), $uid);
	$userposts = members("POSTS", $uid);
	$style = author_mod_style($color1, $color2, $author_mod);
	
	echo'
	<tr>
	<td class="stats_p"><nobr>&nbsp;<input class="small" type="checkbox" name="app[]" value="'.$id.'"></nobr></td>
	<td class="stats_h">'.$id.'</td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$frmname.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$author_mod.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$style.'</b></font></td>
	<td class="stats_g" align="center"><a href="index.php?mode=svc&method=svc&svc=admin_author_mod&type=edit&id='.$id.'">'.icons($icon_edit).'</a>&nbsp;&nbsp;<a onclick="return confirm(\''.$lang['temy_other']['do_you_want_to_delete'].'\');" href="index.php?mode=svc&method=svc&svc=admin_author_mod&type=del&id='.$id.'">'.icons($icon_trash).'</a></td>
	
	</tr>';
	$x = $x + 1;
	
	$i++;
	}
		if ($x > 0){
		echo'
		<tr>
			<td height="30" colspan="18">&nbsp;</td>
		</tr>
		<tr>
			<td class="optionsbar_menus" colspan="18">
				<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_requests_selected'].'\')">&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="yes" type="button" onclick="chk_app_user(this)" value="'.$lang['svc_file']['approve_selected'].'">&nbsp;
				<input name="no" type="button" onclick="chk_app_user(this)" value="'.$lang['svc_file']['refused_selected'].'">&nbsp;
			</td>
		</tr>';
	    }
	echo'
	</form>
	
	<center>';

	if($x==0 ){
		echo'
		
		<tr>
				<td class="stats_p" align="center" colspan="13"><br><font color="red">'.$lang['svc_file']['no_this_requests'].'</font><br><br></td>
		</tr>';
		}
		echo'</table>';
		
}

if($type == "all") {
	echo'
	<center>
		<table>
		<br>	<tr>
				<td class="stats_menu'.chk_cmd($type, "", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=admin_author_mod">'.$lang['svc_file']['pending_requests'].'</a></td>
				<td class="stats_menu'.chk_cmd($type, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=admin_author_mod&type=all">'.$lang['temy_other']['the_authors'].'</a></td>
			</tr>
		</table>	
	<br>
	<table cellSpacing="1" cellPadding="5">
	<form name="req" method="post" action="index.php?mode=svc&method=svc&svc=admin_author_mod&type=admin_set_author_mod">
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="18"><font color="red" size="+1"><b>'.$lang['temy_other']['authors_list'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['temy_other']['a_forum_author'].'</nobr></td>			
			<td class="stats_h"><nobr>'.$lang['forum']['author'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['temy_other']['author_mod_style'].'</nobr></td>
			<td class="stats_h"><nobr><a href="index.php?mode=svc&method=svc&svc=author_mod">'.icons($folder_new).'</a></nobr></td>';
	$req = DBi::$con->query("SELECT * FROM ".$Prefix."AUTHOR_MOD WHERE REQ_STATUS = '1' AND REQ_FRMID IN (".chk_allowed_forums_all_id().")") 
	or die(DBi::$con->error);
	$nreq=mysqli_num_rows($req);
	$i=0;
	while ($i < $nreq) {
	$id = mysqli_result($req, $i, "REQ_ID");	
	$uid = mysqli_result($req, $i, "REQ_USERID");	
	$fid = mysqli_result($req, $i, "REQ_FRMID");
	$author_mod = mysqli_result($req, $i, "REQ_AUTHOR");
	$color1 = mysqli_result($req, $i, "REQ_COLOR1");
	$color2 = mysqli_result($req, $i, "REQ_COLOR2");
    $frmname = forums("SUBJECT", $fid);
	$username = link_profile(members("NAME", $uid), $uid);
	$userposts = members("POSTS", $uid);
	$style = author_mod_style($color1, $color2, $author_mod);
	
	echo'
	<tr>
	<td class="stats_h">'.$id.'</td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$frmname.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$author_mod.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$style.'</b></font></td>
	<td class="stats_g" align="center"><a href="index.php?mode=svc&method=svc&svc=admin_author_mod&type=edit&id='.$id.'">'.icons($icon_edit).'</a>&nbsp;&nbsp;<a onclick="return confirm(\''.$lang['temy_other']['do_you_want_to_delete'].'\');" href="index.php?mode=svc&method=svc&svc=admin_author_mod&type=del&id='.$id.'">'.icons($icon_trash).'</a></td>
	
	</tr>';
	$x = $x + 1;
	
	$i++;
	}
		if ($x > 0){
		echo'
		<tr>
			<td height="30" colspan="18">&nbsp;</td>
		</tr>';
	    }
	echo'
	</form>
	
	<center>';

	if($x==0 ){
		echo'
		
		<tr>
				<td class="stats_p" align="center" colspan="13"><br><font color="red">'.$lang['svc_file']['no_this_requests'].'</font><br><br></td>
		</tr>';
		}
		echo'</table>';
		
}
	
if($type == "edit") {
if($id != "") {	
$forum = author_mod_forum($id);
if(allowed($forum, 1) == 1) {
$req = DBi::$con->query("SELECT * FROM ".$Prefix."AUTHOR_MOD WHERE REQ_ID = '$id'")
	or die(DBi::$con->error);
	$nreq=mysqli_num_rows($req);
	$i=0;
	while ($i < $nreq) {
	$fid = mysqli_result($req, $i, "REQ_FRMID");
	$author_mod = mysqli_result($req, $i, "REQ_AUTHOR");
	$color1 = mysqli_result($req, $i, "REQ_COLOR1");
	$color2 = mysqli_result($req, $i, "REQ_COLOR2");
	
	
echo'	
	<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
	<td>
	<center>
	<form method=post action=index.php?mode=svc&method=svc&svc=admin_author_mod&type=insert_edit>
	<input type="hidden" name="id" value="'.$id.'">
	<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0" width="50%">
	<tr class="fixed">
	<td class="optionheader_selected" colSpan="5"><a><b><font color="white">'.$lang['temy_other']['edit_an_author'].'</font></b></a></td>
	</tr>
	<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['temy_other']['a_forum_author'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	<select class="forumSelect" style="HEIGHT: 20px; WIDTH:150px; FONT-SIZE:10pt" size="1" name="forum">
		<option value="0" '.check_select($fid, 0).'>'.$lang['svc_file']['select_a_forum_name'].'</option>	';
					$all_forums = chk_allowed_forums();
					for($x = 0; $x < count($all_forums); $x++){
						$f_id = $all_forums[$x];
						echo'
						<option value="'.$f_id.'" '.check_select($fid, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
					}	
      echo'</select>
		</td>';
	echo'</td>
	</tr>
		<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['temy_other']['author_the_name'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	 <input class="insidetitle" style="WIDTH: 170px" name="author" value="'.$author_mod.'">
	</td>
	</tr>
		<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['temy_other']['a_color1_author'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	 <input class="insidetitle" style="WIDTH: 50px" name="color1" value="'.$color1.'">
	</td>
	</tr>
		<tr class="fixed">
	<td class="optionheader">
	<nobr>'.$lang['temy_other']['a_color2_author'].'</nobr>
	</td>
	<td class="list" colSpan="4" width="60%">
	 <input class="insidetitle" style="WIDTH: 50px" name="color2" value="'.$color2.'">
	</td>
	</tr>	
	<tr class="fixed">
	<td class="list_center" colSpan="5">
	<input onclick="submit()" type="button" value="'.$lang['temy_other']['insert_edit_author'].'"></td>
	</tr>
	</form>
    </center>
	</table>
	
';

++$i;
	}	
} else {
redirect();	
}
} else {
redirect();	
}
}

if($type == "insert_edit") {
	$id=DBi::$con->real_escape_string(htmlspecialchars($_POST['id']));
	$txt=DBi::$con->real_escape_string(htmlspecialchars($_POST['author']));
	$clearTxt = preg_replace( "/(<\/?)(\w+)([^>]*>)/e", "" , $txt);
	$author = nl2br($clearTxt);
	$forum = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum']));
	$color1 = DBi::$con->real_escape_string(htmlspecialchars($_POST['color1']));
	$color2 = DBi::$con->real_escape_string(htmlspecialchars($_POST['color2']));
if(allowed($forum, 1) == 1) {	
	$req = DBi::$con->query("UPDATE ".prefix."AUTHOR_MOD SET REQ_FRMID = '$forum', REQ_AUTHOR = '$author', REQ_COLOR1 = '$color1', REQ_COLOR2 = '$color2' WHERE REQ_ID = '$id'");
if(allowed($forum, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}	
	echo'
	<br><center>
	<table width="99%" border="1">
	<tr class="normal">
	 <meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=admin_author_mod&type=all">
	<td class="list_center" colSpan="10"><font size="5"><br>'.$lang['temy_other']['done_edit_author'].'</font><br><br>
	<a href="index.php?mode=svc&method=svc&svc=admin_author_mod&type=all"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
	</td>
	</tr>
	</table>
	</center>';
} else {
redirect();	
}	

    }
	
if($type == "del") {
if($id != "") {	
$the_forum = author_mod_forum($id);		
if(allowed($the_forum, 1) == 1) {
	DBi::$con->query("DELETE FROM ".prefix."AUTHOR_MOD WHERE REQ_ID = '$id'");
	DBi::$con->query("UPDATE ".prefix."TOPICS SET T_AUTHOR_MOD = '0' WHERE T_AUTHOR_MOD = '$id'");
	DBi::$con->query("UPDATE ".prefix."REPLY SET R_AUTHOR_MOD = '0' WHERE R_AUTHOR_MOD = '$id'");
if(allowed($forum, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}	
	echo'
	<br><center>
	<table width="99%" border="1">
	<tr class="normal">
	 <meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=admin_author_mod&type=all">
	<td class="list_center" colSpan="10"><font size="5"><br>'.$lang['temy_other']['done_delete_author'].'</font><br><br>
	<a href="index.php?mode=svc&method=svc&svc=admin_author_mod&type=all"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
	</td>
	</tr>
	</table>
	</center>';
} else {
redirect();	
}
} else {
redirect();	
}
    }	
	
	if($type == "admin_set_author_mod") {
	
	$method = $_POST['method'];
	$app = $_POST['app'];
	if ($app == ""){
		$error = $lang['svc_file']['not_selected_any_this'];
	}
	if ($error != ""){
		error_message($error);
	}
	if ($error == ""){
	if ($method == "yes"){
			$req = DBi::$con->query("SELECT * FROM ".$Prefix."AUTHOR_MOD ORDER BY REQ_ID") 
	or die(DBi::$con->error);
	$i=0;
	$num = mysqli_num_rows($req);
	while($i < $num) {
	$forumid = mysqli_result($req, $i, "REQ_FRMID");
	if(allowed($forumid, 1) == 1) {
		
		while($i  < count($app)){
				DBi::$con->query("UPDATE ".prefix."AUTHOR_MOD SET REQ_STATUS = '1' WHERE REQ_ID = '$app[$i]'") or die (DBi::$con->error); 

if(allowed($forumid, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}		
	    $msg_txt = $lang['svc_file']['done_approve_this_selected'];
		
		$i++;
		
		}
		} else {
		redirect();	
		}
	++$i;
	}
	}
	
		
		
if ($method == "no"){
			$req = DBi::$con->query("SELECT * FROM ".$Prefix."AUTHOR_MOD ORDER BY REQ_ID") 
	or die(DBi::$con->error);
	$i=0;
	$num = mysqli_num_rows($req);
	while($i < $num) {
	$forumid = mysqli_result($req, $i, "REQ_FRMID");
	if(allowed($forumid, 1) == 1) {
		while($i  < count($app)){
				DBi::$con->query("DELETE FROM ".prefix."SOCIAL WHERE REQ_ID = '$app[$i]'") or die (DBi::$con->error); 
if(allowed($forumid, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}		
		$i++;
		}
		} else {
		redirect();	
		}
		++$i;
	}
		$msg_txt = $lang['svc_file']['done_refused_this_selected'];
		
		}
		
		
		echo'
		<center>
		<table width="99%" border="1">
			<tr class="normal">
			<meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=admin_author_mod">
				<td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_txt.'</b></font><br><br>
	            <a href="index.php?mode=svc&method=svc&svc=admin_author_mod"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
				</td>
			</tr>
		</table>
		</center>';
	}
   }


} else {
redirect();	
}
}

if(svc == "mod_market") {
if($Mlevel == 4 or $Mod_Market == 1) {
if($type == "") {
	echo'
	<script language="javascript">
		var check_flag = "false";
		function check(checked, alert_msg){
			if (check_flag == "false"){
				var count = 0;
				for (i = 0; i < checked.length; i++){
					checked[i].checked = true;
					if (checked[i].type == "checkbox"){
						count += 1;
					}
				}
				check_flag = "true";
				alert(alert_msg+": "+count);
				return (delete_select_all);
			}
			else {
				for (i = 0; i < checked.length; i++){
					checked[i].checked = false;
				}
				check_flag = "false";
				return (select_all);
			}
		}
		function chk_app_user(obj){
			if (obj.name == "yes"){
				var go_to = confirm("'.$lang['svc_file']['confirm_approve_this'].'");
				if (go_to){
					obj.form.method.value = "yes";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "no"){
				var go_to = confirm("'.$lang['svc_file']['confirm_refused_this'].'");
				if (go_to){
					obj.form.method.value = "no";
					obj.form.submit();
				}
				else{
					return;
				}
			}
		}
	</script>';
	echo'
	<center>
		<table>
		<br>	<tr>
				<td class="stats_menu'.chk_cmd($type, "", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=mod_market">'.$lang['svc_file']['pending_requests'].'</a></td>
				<td class="stats_menu'.chk_cmd($type, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=mod_market&type=all">'.$lang['admin']['sell_list'].'</a></td>
			</tr>
		</table>		
	<br>
	<table cellSpacing="1" cellPadding="5">
	<form name="req" method="post" action="index.php?mode=svc&method=svc&svc=mod_market&type=set_mod_market">
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="20"><font color="red" size="+1"><b>'.$lang['svc_file']['pending_sells_list'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h"></td>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_author'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_name'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_description'].'</nobr></td>			
			<td class="stats_h"><nobr>'.$lang['admin']['sell_date'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_photo'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_dollar'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_sell'].'</nobr></td>
			<td class="stats_h"><nobr></nobr></td>';
	$req = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS_MARKET WHERE MOD_S = '0'") 
	or die(DBi::$con->error);
	$nreq=mysqli_num_rows($req);
	$i=0;
	while ($i < $nreq) {
			$uid = mysqli_result($req, $i, "ID");
			$name = market("NAME", $uid);
			$description = market("DESCRIPTION", $uid);
			$desc = strip_tags(cutstr($description, 20));
			$img = market("IMG", $uid);
			$author = market("AUTHOR", $uid);
			$date = market("DATE", $uid);
			$customer = market("CUSTOMER", $uid);
			$status = market("STATUS", $uid);
			$buy_date = market("BUY_DATE", $uid);
			$dollar = market("DOLLAR", $uid);			
			$buy_text = market("BUY_TEXT", $uid);	
			$buy_text_desc = strip_tags(cutstr($buy_text, 40));			
	echo'
	<tr>
	<td class="stats_p"><nobr>&nbsp;<input class="small" type="checkbox" name="app[]" value="'.$uid.'"></nobr></td>
	<td class="stats_h">'.$uid.'</td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.link_profile(member_name($author), $author).'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b><a href="index.php?mode=member&id='.$author.'&prm=market&market='.$uid.'">'.$name.'</a></b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$desc.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.date_and_time($date, 1).'</b></font></td>	
	<td class="stats_g" align="center"><font color="#ffffff"><b><a target="plaquepreview" href="'.$img.'"><img src="./images/icons/icons_camera.gif"></a></b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$dollar.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$buy_text_desc.'</b></font></td>
	<td class="stats_g" align="center"><a href="index.php?mode=svc&method=svc&svc=mod_market&type=edit&id='.$uid.'">'.icons($icon_edit).'</a>&nbsp;&nbsp;<a onclick="return confirm(\''.$lang['temy_other']['do_you_want_to_delete'].'\');" href="index.php?mode=svc&method=svc&svc=mod_market&type=del&id='.$uid.'">'.icons($icon_trash).'</a></td>
	
	</tr>';
	$x = $x + 1;
	
	$i++;
	}
		if ($x > 0){
		echo'
		<tr>
			<td height="30" colspan="20">&nbsp;</td>
		</tr>
		<tr>
			<td class="optionsbar_menus" colspan="20">
				<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['svc_file']['num_requests_selected'].'\')">&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="yes" type="button" onclick="chk_app_user(this)" value="'.$lang['svc_file']['approve_selected'].'">&nbsp;
				<input name="no" type="button" onclick="chk_app_user(this)" value="'.$lang['svc_file']['refused_selected'].'">&nbsp;
			</td>
		</tr>';
	    }
	echo'
	</form>
	
	<center>';

	if($x==0 ){
		echo'
		
		<tr>
				<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_this_requests'].'</font><br><br></td>
		</tr>';
		}
		echo'</table>';
		
}

if($type == "all") {
	echo'
	<center>
		<table>
		<br>	<tr>
				<td class="stats_menu'.chk_cmd($type, "", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=mod_market">'.$lang['svc_file']['pending_requests'].'</a></td>
				<td class="stats_menu'.chk_cmd($type, "all", "Sel").'"><a class="stats_menu" href="index.php?mode=svc&method=svc&svc=mod_market&type=all">'.$lang['temy_other']['the_authors'].'</a></td>
			</tr>
		</table>	
	<br>
	<table cellSpacing="1" cellPadding="5">
	<form name="req" method="post" action="index.php?mode=svc&method=svc&svc=mod_market&type=set_mod_market">
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="18"><font color="red" size="+1"><b>'.$lang['admin']['sell_list'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_author'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_name'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_description'].'</nobr></td>			
			<td class="stats_h"><nobr>'.$lang['admin']['sell_date'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_photo'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_dollar'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin']['sell_sell'].'</nobr></td>
			<td class="stats_h"><nobr></nobr></td>';
	$req = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS_MARKET WHERE MOD_S = '1'") 
	or die(DBi::$con->error);
	$nreq=mysqli_num_rows($req);
	$i=0;
	while ($i < $nreq) {
			$uid = mysqli_result($req, $i, "ID");
			$name = market("NAME", $uid);
			$description = market("DESCRIPTION", $uid);
			$desc = strip_tags(cutstr($description, 20));
			$img = market("IMG", $uid);
			$author = market("AUTHOR", $uid);
			$date = market("DATE", $uid);
			$customer = market("CUSTOMER", $uid);
			$status = market("STATUS", $uid);
			$buy_date = market("BUY_DATE", $uid);
			$dollar = market("DOLLAR", $uid);			
			$buy_text = market("BUY_TEXT", $uid);	
			$buy_text_desc = strip_tags(cutstr($buy_text, 40));			
	echo'
	<tr>
	<td class="stats_h">'.$uid.'</td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.link_profile(member_name($author), $author).'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b><a href="index.php?mode=member&id='.$author.'&prm=market&market='.$uid.'">'.$name.'</a></b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$desc.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.date_and_time($date, 1).'</b></font></td>	
	<td class="stats_g" align="center"><font color="#ffffff"><b><a target="plaquepreview" href="'.$img.'"><img src="./images/icons/icons_camera.gif"></a></b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$dollar.'</b></font></td>
	<td class="stats_g" align="center"><font color="#ffffff"><b>'.$buy_text_desc.'</b></font></td>
	<td class="stats_g" align="center"><a href="index.php?mode=svc&method=svc&svc=mod_market&type=edit&id='.$uid.'">'.icons($icon_edit).'</a>&nbsp;&nbsp;<a onclick="return confirm(\''.$lang['temy_other']['do_you_want_to_delete'].'\');" href="index.php?mode=svc&method=svc&svc=mod_market&type=del&id='.$uid.'">'.icons($icon_trash).'</a></td>
	
	</tr>';
	$x = $x + 1;
	
	$i++;
	}
		if ($x > 0){
		echo'
		<tr>
			<td height="30" colspan="20">&nbsp;</td>
		</tr>';
	    }
	echo'
	</form>
	
	<center>';

	if($x==0 ){
		echo'
		
		<tr>
				<td class="stats_p" align="center" colspan="13"><br><font color="red">'.$lang['svc_file']['no_this_requests'].'</font><br><br></td>
		</tr>';
		}
		echo'</table>';
		
}

if($type == "edit") {
if($id != "") {	
	 			echo '
			<center>

<html>

                  <table width="1024" border="0" cellspacing="0" cellpadding="0"><tbody>';
				  ?>
				  		<script language="javascript">
									function replace_title(new_text){

					document.sell_info.name.value = new_text;
				
			}
			function submit_form(){
				if (sell_info.name.value.length < 5){
					confirm(enter_sell_name);
					return;
				}
				if (sell_info.description.value.length < 5){
					confirm(enter_sell_desc);
					return;
				}	
				if (sell_info.img.value.length < 5){
					confirm(enter_sell_photo);
					return;
				}
				if (sell_info.dollar.value.length == 0){
					confirm(enter_sell_dollar);
					return;
				}	
				if (sell_info.buy_text.value.length < 5){
					confirm(enter_sell);
					return;
				}					

			
			sell_info.submit();
			}
			


		</script>
				  <?
				  
	$sql = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS_MARKET WHERE ID = '$id'");
	$num = mysqli_num_rows($sql);
	$x = 0;
	while($x < $num) {

			$id = mysqli_result($sql, $x, "ID");
			$name = market("NAME", $id);
			$description = market("DESCRIPTION", $id);
			$img = market("IMG", $id);
			$author = market("AUTHOR", $id);
			$date = market("DATE", $id);
			$customer = market("CUSTOMER", $id);
			$status = market("STATUS", $id);
			$buy_date = market("BUY_DATE", $id);
			$dollar = market("DOLLAR", $id);			
			$buy_text = market("BUY_TEXT", $id);		  
				  
				  echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray">
		<form name="sell_info" method="post" action="index.php?mode=svc&method=svc&svc=mod_market&type=insert_edit">
		
		<input type="hidden" name="id" value="'.$id.'">
		<br><tr class="fixed">
				<td class="cat" colSpan="4"><nobr>'.$lang['admin']['edit_sell'].': '.$name.'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_name'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 400px" name="name" value="'.$name.'">&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
				echo'
				</td>
			</tr>
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_desc'].' </nobr></td>
				<td class="list" colSpan="3">
				<textarea name="description" cols="55" rows="5">'.$description.'</textarea>
				<nobr></td>
		</tr>

			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['admin']['sell_link_photo'].': </nobr></td>
				<td class="list"  colSpan="3">
				<input name="img" value="'.$img.'" size="55">
				<nobr></td>
		</tr>

			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_photo'].' </nobr></td>
				<td class="list"  colSpan="3">
				<img border="0" src="'.$img.'">
				<nobr></td>
		</tr>		
			
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_author'].' </nobr></td>
				<td class="list"  colSpan="3">
				'.link_profile(member_name($author), $author).'
				<nobr></td>
		</tr>
		';
		if($status == 1) {
				$sell_status = '<font color="green">'.$lang['admin']['for_sale'].'</font>';
		}
		if($status == 0) {
				$sell_status = '<font color="red">'.$lang['admin']['sold'].'</font>';
		}	
		echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_status'].' </nobr></td>
				<td class="list" colSpan="3">
				'.$sell_status.'
				<nobr></td>
		</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_dollar'].' </nobr></td>
				<td class="list" colSpan="3">
				<input name="dollar" value="'.$dollar.'" size="10" value="0">&nbsp;<font color="black" size="3">'.$dollar_cur.'</font>&nbsp;&nbsp;&nbsp;<font size="2" color="red">'.$lang['admin']['sell_dollar_description'].'</font>
				<nobr></td>
		</tr>		
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_message_part4'].' </nobr></td>
				<td class="list" colSpan="3">
				<textarea name="buy_text" cols="55" rows="5">'.$buy_text.'</textarea>
				<nobr></td>
		</tr>		
			
			<tr class="fixed">
				<td class="list_center" colSpan="5"><input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</form>
		</table>
		</center><br>';
		
	
		
		++$x;
	}
} else {
redirect();	
}
}

if($type == "insert_edit") {
			$id = DBi::$con->real_escape_string(htmlspecialchars($_POST['id']));
			$name = DBi::$con->real_escape_string(htmlspecialchars($_POST["name"]));
			$description = DBi::$con->real_escape_string(htmlspecialchars($_POST['description']));
			$img = DBi::$con->real_escape_string(htmlspecialchars($_POST['img']));
			$dollar = DBi::$con->real_escape_string(htmlspecialchars($_POST['dollar']));
			$buy_text = DBi::$con->real_escape_string(htmlspecialchars($_POST['buy_text']));
			$customer = market("CUSTOMER", $id);
			$author = market("AUTHOR", $id);
			$author = market("AUTHOR", $id);
				DBi::$con->query("UPDATE ".prefix."MEMBERS_MARKET SET NAME = '$name', DESCRIPTION = '$description', IMG = '$img', DOLLAR = '$dollar', BUY_TEXT = '$buy_text' WHERE ID = '$id'");
							if($customer != 0) {				
				$subject = ''.$lang['member']['sell_edit_message_part1'].' '.$name.'';
				$message = ''.$lang['members']['members'].': '.link_profile(member_name($customer), $customer).'<br><br>'.$lang['member']['sell_edit_message_part2'].' '.$name.' '.$lang['member']['sell_edit_message_part3'].' '.link_profile(member_name($author), $author).'<br><br>'.$lang['member']['sell_edit_message_part4'].'<br><br>'.$buy_text.'<br><br>'.$lang['member']['sell_edit_message_part5'].'';
				$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sendPm .= " '1', ";
				$sendPm .= " '$customer', ";
				$sendPm .= " '1', ";
				$sendPm .= " '0', ";
				$sendPm .= " '$subject', ";
				$sendPm .= " '$message', ";
				$sendPm .= " '$date') ";
				DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);				
							}
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

							echo'
	<br><center>
	<table width="99%" border="1">
	<tr class="normal">
	 <meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=mod_market&type=all">
	<td class="list_center" colSpan="10"><font size="5"><br>'.$lang['temy_other']['done_edit_sell'].'</font><br><br>
	<a href="index.php?mode=svc&method=svc&svc=mod_market&type=all"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
	</td>
	</tr>
	</table>
	</center>';

    }
	
if($type == "del") {
if($id != "") {	
	DBi::$con->query("DELETE FROM ".prefix."MEMBERS_MARKET WHERE ID = '$id'");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
	echo'
	<br><center>
	<table width="99%" border="1">
	<tr class="normal">
	 <meta http-equiv="Refresh" content="1; URL= '.$_SERVER['HTTP_REFERER'].'">
	<td class="list_center" colSpan="10"><font size="5"><br>'.$lang['temy_other']['done_delete_sell'].'</font><br><br>
	<a href="index.php?mode=svc&method=svc&svc=mod_market&type=all"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
	</td>
	</tr>
	</table>
	</center>';
} else {
redirect();	
}
    }	
	
	
	if($type == "set_mod_market") {
	
	$method = $_POST['method'];
	$app = $_POST['app'];
	if ($app == ""){
		$error = $lang['svc_file']['not_selected_any_this'];
	}
	if ($error != ""){
		error_message($error);
	}
	if ($error == ""){
	if ($method == "yes"){
	$i=0;
		while($i  < count($app)){
				DBi::$con->query("UPDATE ".prefix."MEMBERS_MARKET SET MOD_S = '1' WHERE ID = '$app[$i]'") or die (DBi::$con->error); 

DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
	
	    $msg_txt = $lang['svc_file']['done_approve_this_selected'];
		
		$i++;
		
		}
		}
		
if ($method == "no"){
	$i=0;
	
		while($i  < count($app)){
				DBi::$con->query("DELETE FROM ".prefix."MEMBERS_MARKET WHERE ID = '$app[$i]'") or die (DBi::$con->error); 
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
		$i++;
		}
		$msg_txt = $lang['svc_file']['done_refused_this_selected'];
		
		}
		
		
		echo'
		<center>
		<table width="99%" border="1">
			<tr class="normal">
			<meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&method=svc&svc=mod_market">
				<td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_txt.'</b></font><br><br>
	            <a href="index.php?mode=svc&method=svc&svc=mod_market"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a><br><br>
				</td>
			</tr>
		</table>
		</center>';
	}
   }


} else {
redirect();	
}	
}

if(svc == "mods"){
			echo'<center><table dir="rtl" cellSpacing="1" cellPadding="4">
			<thead>
				<tr>
					<td class="optionsbar_menus" colSpan="15"><font color="red" size="+1">'.$lang['title_page']['your_forums_mod'].'</font></td>
				</tr>
				
				<tr>';
					echo'
					<td class="stats_h" rowspan="5"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['admin']['monitor'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['admin']['deputy_monitor'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['svc_function']['request_status'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['svc_file']['moderation_on_posts'].'</nobr></td>
					<td class="stats_h" colspan="5"><nobr>'.$lang['svc_file']['un_moderation_members'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['svc_file']['days_for_archive'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['svc_file']['topics_in_24'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['svc_file']['replies_in_24'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['svc_file']['forum_social_options'].'</nobr></td>
					<td class="stats_h" rowspan="5"><nobr>'.$lang['svc_file']['online_stat'].'</nobr></td>
				</tr>
				<tr>
				<td class="stats_h">'.$lang['msg']['error_13'].'</td>
				<td class="stats_h">'.$lang['msg']['error_14'].'</td>
				<td class="stats_h">'.$lang['svc_file']['days'].'</td>
				<td class="stats_h">'.$lang['svc_file']['photos'].'</td>
				<td class="stats_h">'.$lang['svc_file']['links'].'</td>
				</tr>
				</thead>';
				$forums_a = chk_allowed_forums();
				echo'<tbody>';
				
foreach ($forums_a as $value) {
	echo'<tr><td class="stats_p"><center>'.forums("SUBJECT",$value).'</center></td>';
	echo'<td class="stats_p"><center>'.member_normal_link(cat("MONITOR", forums("CAT_ID",$value))).'</center></td>';
	echo'<td class="stats_p"><center>'.member_normal_link(cat("DEPUTY_MONITOR", forums("CAT_ID",$value))).'</center></td>';
	if(forums("STATUS",$value) == 1){
		echo'<td class="stats_p"><center>'.$lang['svc_file']['open_for_all'].'</center></td>';
	}
	if(forums("STATUS",$value) == 0){
		echo'<td class="stats_p"><center>'.$lang['svc_file']['close_for_all'].'</center></td>';
	}
	if(forums("MODERATE_TOPIC",$value) == 0 && forums("MODERATE_REPLY",$value) == 1){
		echo'<td class="stats_p"><center>'.$lang['svc_file']['topics_only'].'</center></td>';	
	}
	elseif(forums("MODERATE_TOPIC",$value) == 1 && forums("MODERATE_REPLY",$value) == 1){
		echo'<td class="stats_p"><center>'.$lang['svc_file']['no_moderate'].'</center></td>';
	}
	elseif(forums("MODERATE_TOPIC",$value) == 1 && forums("MODERATE_REPLY",$value) == 0){
		echo'<td class="stats_p"><center>'.$lang['svc_file']['replies_only'].'</center></td>';
	}
	elseif(forums("MODERATE_TOPIC",$value) == 0 && forums("MODERATE_REPLY",$value) == 0){
		echo'<td class="stats_p"><center>'.$lang['svc_file']['topics_replies'].'</center></td>';
	}

	echo'<td class="stats_p"><center>'.forums("MODERATE_POSTS", $value).'</center></td>';
	echo'<td class="stats_p"><center>'.forums("MODERATE_POSTS", $value).'</center></td>';
	echo'<td class="stats_p"><center>'.forums("MODERATE_DAYS", $value).'</center></td>';
	echo'<td class="stats_p"><center>0</td>';
	echo'<td class="stats_p"><center>0</td>';
	echo'<td class="stats_p"><center>'.forums("DAY_ARCHIVE",$value).'</center></td>';
	echo'<td class="stats_p"><center>'.forums("TOTAL_TOPICS",$value).'</center></td>';
	echo'<td class="stats_p"><center>'.forums("TOTAL_REPLIES",$value).'</center></td>';
	if(forums("HASHTAG", $value) == "") {
	echo'<td class="stats_p"><center><a href="index.php?mode=svc&method=svc&svc=social">'.$lang['svc_file']['active_social_options'].'</a></center></td>';
	} else {	
	echo'<td class="stats_p"><center>#'.forums("HASHTAG",$value).'</center></td>';
	}
	echo'<td class="stats_p"><a href="index.php?mode=forumstat&f='.$value.'">'.$lang['other_things']['online'].'</a> - <a href="index.php?mode=svc&method=svc&svc=m_stat&sv=p&f='.$value.'">'.$lang['home']['posts'].'</a> - <a href="index.php?mode=svc&method=svc&svc=m_stat&sv=t&f='.$value.'">'.$lang['home']['topics'].'</a></td>';
	//echo'<td class="stats_p">'.forums("MODERATE_TOPIC",$value).' + '.forums("MODERATE_REPLY",$value).'</td>';
	echo'</tr>';
}
				echo'</tbody>
				</table></center>';
}
 }

if ($method == "award"){
	if (svc == "medals"){
		if ($type == ""){
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2">
				<tr>
					<td class="optionsbar_menus"><font size="+1">'.$lang['svc_file']['select_a_forum_medals'].'<br><font color="red">'.members("NAME", $m).'</font></font></td>
				</tr>
				<tr>
					<td class="stats_p"><a href="index.php?mode=svc&method=award&svc=medals&type=special_award&m='.$m.'">'.$lang['svc_file']['a_special_medals_points'].'</a></td>
				</tr>';
			$all_forums = chk_allowed_forums();
			for($x = 0; $x < count($all_forums); $x++){
				$f_id = $all_forums[$x];
				echo'
				<tr>
					<td class="stats_p"><a href="index.php?mode=svc&method=award&svc=medals&type=award&f='.$f_id.'&m='.$m.'">'.forums("SUBJECT", $f_id).'</a>&nbsp;&nbsp;<font color="red">('.forum_medal_count($f_id).')</font></td>
				</tr>';
			}
			echo'
			</table>
			</center><br>';
		}
		if ($type == "award"){
			if (allowed($f, 2) == 1){
				echo'
				<center>
				<table cellSpacing="1" cellPadding="0">
					<tr>
						<td class="optionsbar_menus" colSpan="15"><font size="+1">'.$lang['svc_file']['select_a_medal_member'].' <font color="red">'.members("NAME", $m).'</font></font></td>
					</tr>
					<tr>
						<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['a_title'].'</nobr></td>
						<td class="stats_h">'.$lang['svc_file']['medal_photo'].'</td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['group_points'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['show_for'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['added_an_medals'].'</nobr></td>
						<td class="stats_h">'.$lang['members']['options'].'</td>
					</tr>';
				$sql = DBi::$con->query("SELECT * FROM ".prefix."GLOBAL_MEDALS WHERE FORUM_ID = '$f' AND STATUS = '1' AND CLOSE = '0' ORDER BY SUBJECT ASC") or die (DBi::$con->error);
				$num = mysqli_num_rows($sql);
				$x = 0;
				while ($x < $num) {
					$m_id = mysqli_result($sql, $x, "MEDAL_ID");
					svc_award_global_medals($m_id);
					$count = $count + 1;
				++$x;
				}
				if ($count == 0){
					echo'
					<tr>
						<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_normal_medals'].'</font><br><br></td>
					</tr>';
				}
				echo'
				</table>
				</center><br>';
			} else {
		redirect();	
		}
		}
		if ($type == "special_award"){
			if ($Mlevel > 1){
				echo'
				<center>
				<table cellSpacing="1" cellPadding="0">
					<tr>
						<td class="optionsbar_menus" colSpan="15"><font size="+1">'.$lang['svc_file']['select_a_medals_points'].' <font color="red">'.members("NAME", $m).'</font></font></td>
					</tr>
					<tr>
						<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['a_title'].'</nobr></td>
						<td class="stats_h">'.$lang['svc_file']['medal_photo'].'</td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['group_points'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['show_for'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['added_medals_points'].'</nobr></td>
						<td class="stats_h">'.$lang['members']['options'].'</td>
					</tr>';
				$sql = DBi::$con->query("SELECT * FROM ".prefix."GLOBAL_MEDALS WHERE STATUS = '1' AND CLOSE = '0' AND SPECIAL = '1' ORDER BY SUBJECT ASC") or die (DBi::$con->error);
				$num = mysqli_num_rows($sql);
				$x = 0;
				while ($x < $num) {
					$m_id = mysqli_result($sql, $x, "MEDAL_ID");
					svc_special_award_global_medals($m_id);
					$count = $count + 1;
				++$x;
				}
				if ($count == 0){
					echo'
					<tr>
						<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_medals_points_normal'].'</font><br><br></td>
					</tr>';
				}
				echo'
				</table>
				</center><br>';
			} else {
		redirect();	
		}
		}		
	}
	if (svc == "titles"){
		if ($type == ""){
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2">
				<tr>
					<td class="optionsbar_menus"><font size="+1">'.$lang['svc_file']['select_a_titles'].'<br><font color="red">'.members("NAME", $m).'</font></font></td>
				</tr>
								<tr>
					<td class="stats_p"><a href="index.php?mode=svc&method=award&svc=medals&type=special_award&m='.$m.'">'.$lang['svc_file']['a_special_medals_points'].'</a></td>
				</tr>';
			$all_forums = chk_allowed_forums();
			for($x = 0; $x < count($all_forums); $x++){
				$f_id = $all_forums[$x];
				echo'
				<tr>
					<td class="stats_p"><a href="index.php?mode=svc&method=award&svc=titles&type=award&f='.$f_id.'&m='.$m.'">'.forums("SUBJECT", $f_id).'</a>&nbsp;&nbsp;<font color="red">('.forum_title_count($f_id).')</font></td>
				</tr>';
			}
			echo'
			</table>
			</center><br>';
		}
		if ($type == "award"){
			if (allowed($f, 2) == 1){
				echo'
				<center>
				<table cellSpacing="1" cellPadding="2">
					<tr>
						<td class="optionsbar_menus" colSpan="15"><font size="+1">'.$lang['svc_file']['select_a_title_member'].' <font color="red">'.members("NAME", $m).'</font></font></td>
					</tr>
					<tr>
						<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
						<td class="stats_h"><nobr>'.$lang['svc_file']['a_title'].'</nobr></td>
						<td class="stats_h">'.$lang['svc_file']['show_in_all_forum'].'</td>
						<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>
						<td class="stats_h">'.$lang['members']['options'].'</td>
					</tr>';
				$sql = DBi::$con->query("SELECT * FROM ".prefix."GLOBAL_TITLES WHERE FORUM_ID = '$f' AND STATUS = '1' AND CLOSE = '0' ORDER BY SUBJECT ASC") or die (DBi::$con->error);
				$num = mysqli_num_rows($sql);
				$x = 0;
				while ($x < $num) {
					$t_id = mysqli_result($sql, $x, "TITLE_ID");
					svc_award_global_titles($t_id);
					$count = $count + 1;
				++$x;
				}
				if ($count == 0){
					echo'
					<tr>
						<td class="stats_p" align="center" colspan="15"><br><font color="red">'.$lang['svc_file']['no_normal_titles'].'</font><br><br></td>
					</tr>';
				}
				echo'
				</table>
				</center><br>';
			} else {
		redirect();	
		}
		}
		if ($type == "used"){
			$f = gt("FORUM_ID", $id);
			if (allowed($f, 2) == 1){
				echo'
				<center>
				<table cellSpacing="1" cellPadding="0">
					<tr>
						<td class="optionsbar_menus" colSpan="10"><font size="+1">'.$lang['svc_file']['use_this_title'].' '.$id.'<br><font color="red">'.gt("SUBJECT", $id).'</font></font></td>
					</tr>';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."TITLES WHERE GT_ID = '$id' AND STATUS = '1' ORDER BY TITLE_ID DESC") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			if ($num > 0){
					echo'
					<tr>
						<td colSpan="10">&nbsp;</td>
					</tr>
					<tr>
						<td class="optionsbar_menus" colSpan="10"><font size="+1">'.$lang['svc_file']['members_have_this_title_now'].'</font></td>
					</tr>';
				$x = 0;
				while ($x < $num) {
					$t = mysqli_result($sql, $x, "TITLE_ID");
					$m = titles("MEMBER_ID", $t);
					echo'
					<tr>
						<td class="stats_p">'.link_profile(members("NAME", $m), $m).'</td>
						<td class="stats_g" align="center">
							<a href="index.php?mode=svc&method=award&svc=titles&type=history&m='.$m.'&t='.$id.'">'.icons($icon_question, $lang['svc_function']['use_title_for_member'], " hspace=\"3\"").'</a>
							<a href="index.php?mode=svc&method=trash&svc=titles&t='.$t.'">'.icons($icon_trash, $lang['svc_function']['delete_title_from_member'], " hspace=\"3\"").'</a>
						</td>
					</tr>';
				++$x;
				}
			}
			$sql = DBi::$con->query("SELECT * FROM ".prefix."TITLES WHERE GT_ID = '$id' AND STATUS = '0' ORDER BY TITLE_ID DESC") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			if ($num > 0){
					echo'
					<tr>
						<td colSpan="10">&nbsp;</td>
					</tr>
					<tr>
						<td class="optionsbar_menus" colSpan="10"><font color="red" size="+1">'.$lang['svc_file']['members_have_this_title_back'].'</font></td>
					</tr>';
				$x = 0;
				while ($x < $num) {
					$t = mysqli_result($sql, $x, "TITLE_ID");
					$m = titles("MEMBER_ID", $t);
					echo'
					<tr>
						<td class="stats_p">'.link_profile(members("NAME", $m), $m).'</td>
						<td class="stats_g" align="center">
							<a href="index.php?mode=svc&method=award&svc=titles&type=history&m='.$m.'&t='.$id.'">'.icons($icon_question, $lang['svc_function']['use_title_for_member'], " hspace=\"3\"").'</a>
						</td>
					</tr>';
				++$x;
				}
			}
				echo'
				</table>
				</center><br>';
			} else {
		redirect();	
		}
		}
		if ($type == "history"){
			$f = gt("FORUM_ID", $t);
			if (allowed($f, 2) == 1){
				echo'
				<center>
				<table cellSpacing="1" cellPadding="0">
					<tr>
						<td class="optionsbar_menus" colSpan="10">
							<font size="+1">
								'.$lang['svc_file']['history_title_number'].' '.$t.'<br>
								<font color="red">'.gt("SUBJECT", $t).'</font><br>
								'.$lang['svc_file']['for_member_this'].' '.$m.'<br>
								'.link_profile(members("NAME", $m), $m).'
							</font>
						</td>
					</tr>';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."USED_TITLES WHERE MEMBER_ID = '$m' AND TITLE_ID = '$t' ORDER BY DATE ASC") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			if ($num > 0){
					echo'
					<tr>
						<td class="stats_h">'.$lang['svc_function']['date_and_time'].'</td>
						<td class="stats_h">'.$lang['svc_function']['type'].'</td>
						<td class="stats_h">'.$lang['svc_file']['do_this'].'</td>
					</tr>';
				$x = 0;
				while ($x < $num) {
					$id = mysqli_result($sql, $x, "ID");
					$status = ut("STATUS", $id);
					$added = ut("ADDED", $id);
					$date = ut("DATE", $id);
					if ($status == 1){
						$add_status = '<font color="yellow">'.$lang['svc_file']['add_title'].'</font>';
					}
					if ($status == 0){
						$add_status = '<font color="white">'.$lang['svc_file']['remove_title'].'</font>';
					}
					echo'
					<tr>
						<td class="stats_g"><nobr>'.normal_time($date).'</nobr></td>
						<td class="stats_t">'.$add_status.'</td>
						<td class="stats_p">'.link_profile(members("NAME", $added), $added).'</td>
					</tr>';
				++$x;
				}
			}
			else{
					echo'
					<tr>
						<td class="stats_h" colSpan="10" align="center"><br>'.$lang['svc_file']['not_use_this_title'].'<br><br></td>
					</tr>';
			}
				echo'
				</table>
				</center><br>';
			} else {
		redirect();	
		}
		}
	}
	if (svc == "surveys"){
		$subject = surveys("SUBJECT", $s);
		$f = surveys("FORUM_ID", $s);
		if (allowed($f, 2) == 1) {
			echo'
			<center>
			<table cellSpacing="1" cellPadding="2">
				<tr>
					<td class="optionsbar_menus" colSpan="11"><font size="+1">'.$lang['svc_file']['members_option_surveys'].' '.$s.'</font><br><font color="red" size="+1">'.$subject.'</font></td>
				</tr>
				<tr>
					<td class="stats_h"><nobr>'.$lang['svc_file']['number_member'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['add_cat_forum']['member_name'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['an_option_do'].'</nobr></td>
					<td class="stats_h"><nobr>'.$lang['svc_file']['option_date'].'</nobr></td>
				</tr>';
			$sql = DBi::$con->query("SELECT * FROM ".$Prefix."VOTES WHERE SURVEY_ID = '$s' ORDER BY VOTE_ID ASC ") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			if ($num <= 0) {
				echo'
				<tr>
					<td class="stats_p" align="middle" colSpan="11"><font color="black" size="3"><br>'.$lang['svc_file']['no_members_options_in_survey'].'<br><br></font></td>
				</tr>';
			}
			$x=0;
			while ($x < $num) {
				$v = mysqli_result($sql, $x, "VOTE_ID");
				$option_id = votes("OPTION_ID", $v);
				$m_id = votes("MEMBER_ID", $v);
				$value = option_value($option_id);
				$date = votes("DATE", $v); 
				echo'
				<tr>
					<td class="stats_h" align="middle"><font color="white" size="-1">'.$m_id.'</font></td>
					<td class="stats_g"><font color="white" size="-1"><a href="index.php?mode=member&id='.$m_id.'">'.member_name($m_id).'</a></font></td>
					<td class="stats_p" align="middle"><font color="red" size="-1">'.$value.'</font></td>
					<td class="stats_g" align="middle"><font color="white" size="-1">'.normal_time($date).'</font></td>
				</tr>';
			++$x;
			}
			echo'
			</table>
			<center>';
		} else {
		redirect();	
		}
	}
}
if ($method == "add"){
	if (svc == "groups"){
		if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
			?>
			<script language="javascript">
			var f = "<?php echo $f; ?>";
			function load_medal_url(){
				if (f > 0){
					document.getElementById("click_url").style.display = "none";
					document.getElementById("load_url").style.display = "block";
				}
				else{
					alert(not_selected_forum);
					return;
				}
			}


			function chk_forum_id(f_id){
				f_id = f_id.options[f_id.selectedIndex].value;
				if (f_id > 0){
					document.location = "index.php?mode=svc&method=add&svc=groups&f="+f_id;
				}
				else{
					return;
				}
			}

			function replace_title(new_text){
				if (group_info.g_forum_id.value <= 0){
					confirm(select_forum_one);
					return;
				}
				else{
					document.group_info.g_subject.value = new_text;
				}
			}

			function app_title(new_text){
				if (group_info.g_forum_id.value <= 0){
					confirm(select_forum_one);
					return;
				}
				else{
					document.group_info.g_subject.value += new_text;
				}
			}

			function submit_form(){
				if (group_info.g_subject.value.length < 5){
					confirm(enter_group_name_5);
					return;
				}
				if (group_info.g_subject.value.indexOf("[") >= 0){
					confirm(enter_group_name_5);
					return;
				}
				if (group_info.g_subject.value.indexOf("]") >= 0){
					confirm(enter_group_name_5);
					return;
				}
				if (group_info.g_subject.value.length <= 0){
					confirm(enter_group_points);
					return;
				}				
				if (group_info.g_forum_id.value <= 0){
					confirm(enter_forum_list);
					return;
				}
			
			group_info.submit();
			}
			


		</script>
				  <?
				  
				  echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
		<form name="group_info" method="post" action="index.php?mode=svc&method=insert&svc=groups">
			<tr class="fixed">
				<td class="cat" colSpan="4"><nobr>'.$lang['svc_file']['add_group_to_forum'].' '.forums("SUBJECT", $f).'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_title'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 400px" name="g_subject">&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
				echo'
				</td>
			</tr>';
			echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['all']['forum'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" size="1" name="g_forum_id" onchange="chk_forum_id(this)">
				<option value="0">'.$lang['svc_file']['select_a_forum_name'].'</option>';
				$all_forums = chk_allowed_forums();
				for($x = 0; $x < count($all_forums); $x++){
					$f_id = $all_forums[$x];
					echo'
					<option value="'.$f_id.'" '.check_select($f, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
				}
				echo'
				</select>
				</td>
			</tr>
			
						<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_description'].' </nobr></td>
				<td class="list" align="middle" colSpan="3">
				<textarea name="g_desc" cols="55" rows="5"></textarea>
				<nobr></td>
		</tr>
			';

		
		$group_url = icons($icon_groups_unknown);
			$standard = icons($icon_groups_standard);
			
	
			echo'
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_img'].' </nobr></td>
				<td class="list" colSpan="3"><center>';
				if ($m <= 0 AND $m == ""){
					echo'
				'.$group_url.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'
				';
				} else {
				
					$group_url = '<img onerror="this.src=\''.$unknown.'\';" src="'.gf("SUBJECT", $m).'">
					';
					echo $group_url;
					echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'';
				}
				echo'</center>
				<nobr></td>
		</tr>';
		
		
	
echo'
<input type="hidden" name="g_url" value="'.gf("SUBJECT", $m).'">
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['topics']['points'].' </nobr></td>
				<td class="list" colSpan="3">
				<input name="g_points" size="10" value="0">&nbsp;&nbsp;&nbsp;<font size="2" color="red">'.$lang['svc_file']['group_points_desc'].'</font>
				<nobr></td>
		</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_status'].' </nobr></td>';
				if(mlv > 2) {
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="g_mod">'.$lang['svc_file']['pending_mon'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="g_mod">'.$lang['svc_file']['in_shop'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="2" name="g_mod" CHECKED="true">'.$lang['svc_file']['true_group'].'</nobr></td>
';				} else {
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="g_mod" CHECKED="true">'.$lang['svc_file']['pending_mon'].'</nobr></td>
				<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="1" name="g_mod">'.$lang['svc_file']['in_shop'].'</nobr></td>
				';
				}	
			echo'
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['login_group'].' </nobr></td>';
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="g_login">'.$lang['svc_file']['login_0'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="g_login" CHECKED="true">'.$lang['svc_file']['login_1'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="2" name="g_login">'.$lang['svc_file']['login_2'].'</nobr></td>';
			echo'
			</tr>			
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['close_group'].' </nobr></td>';
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="g_status" CHECKED="true">'.$lang['svc_file']['an_open_group'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="2" name="g_status">'.$lang['svc_file']['an_close_group'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="g_status">'.$lang['svc_file']['an_hidden_group'].'</nobr></td>';
			echo'
			</tr>			
			
			<tr class="fixed">
				<td class="list_center" colSpan="5"><input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</form>
		</table>
		</center><br>';
			
		
	}
	if (svc == "medals"){
		if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
		$medal_folder = $image_folder.'medals/forum'.$f.'/';
		?>
		<script language="javascript">
			var f = "<?php echo $f; ?>";
			var m = "<?php echo $m; ?>";
			function load_medal_url(){
				if (f > 0){
					document.getElementById("click_url").style.display = "none";
					document.getElementById("load_url").style.display = "block";
				}
				else{
					alert(not_selected_forum);
					return;
				}
			}

			function choose_img(url){
				var unknown = "<?php echo $unknown; ?>";
				document.getElementById("click_url").style.display = "block";
				document.getElementById("load_url").style.display = "none";
				document.getElementById("un_url").style.display = "none";
				document.getElementById("img_url").style.display = "block";
				document.medal_info.m_url.value = url;
				div_img.innerHTML = "<img src="+url+" onerror=\"this.src='"+unknown+"';\">";
			}

			function chk_forum_id(f_id){
				f_id = f_id.options[f_id.selectedIndex].value;
				if (f_id > 0){
					document.location = "index.php?mode=svc&method=add&svc=medals&f="+f_id;
				}
				else{
					return;
				}
			}

			function replace_title(new_text){
				if (medal_info.m_forum_id.value <= 0){
					confirm(select_forum_one_medal);
					return;
				}
				else{
					document.medal_info.m_subject.value = new_text;
				}
			}

			function app_title(new_text){
				if (medal_info.m_forum_id.value <= 0){
					confirm(select_forum_one_medal);
					return;
				}
				else{
					document.medal_info.m_subject.value += new_text;
				}
			}

			function submit_form(){
				if (medal_info.m_subject.value.length < 10){
					confirm(enter_medal_name_10);
					return;
				}
				if (medal_info.m_subject.value.indexOf("[") >= 0){
					confirm(enter_medal_name_10);
					return;
				}
				if (medal_info.m_subject.value.indexOf("]") >= 0){
					confirm(enter_medal_name_10);
					return;
				}
				if (medal_info.m_forum_id.value <= 0){
					confirm(enter_medal_name_10);
					return;
				}
			
			medal_info.submit();
			}
			


		</script>
		<?php
		echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
		<form name="medal_info" method="post" action="index.php?mode=svc&method=insert&svc=medals">
			<tr class="fixed">
				<td class="cat" colSpan="5"><nobr>'.$lang['svc_file']['add_medal_to_forum'].' '.forums("SUBJECT", $f).'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['medal_title'].' </nobr></td>
				<td class="list" colSpan="4">';
				if ($m <= 0 AND $m == ""){
					echo'
				<input class="insidetitle" style="WIDTH: 300px" name="m_subject">
				';
				} else {
				echo'
				<input class="insidetitle" style="WIDTH: 300px" name="m_subject" value="'.$lang['svc_file']['medal_details'].' '.forums("SUBJECT", $f).'">
				';
				}
				echo'
				&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\''.$lang['svc_file']['medal_details'].' '.forums("SUBJECT", $f).'\');" type="button" value="+">&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
			if (mlv > 2){
				echo'
				&nbsp;<hr>&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="replace_title(\''.$lang['svc_file']['for_delete_in'].'\');" type="button" value="'.$lang['svc_file']['for_delete'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="replace_title(\''.$lang['svc_file']['no_monasabat_in'].'\');" type="button" value="'.$lang['svc_file']['no_tahany'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="app_title(\''.$lang['svc_file']['wrong_medal_photo'].'\');" type="button" value="'.$lang['svc_file']['no_photo'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="app_title(\''.$lang['svc_file']['wrong_medal_size'].'\');" type="button" value="'.$lang['message']['pm_size'].'">';
			}
				echo'
				</td>
			</tr>';
			echo'
		<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['all']['forum'].' </nobr></td>
				<td class="list" colSpan="4">
				<select class="insidetitle" size="1" name="m_forum_id" onchange="chk_forum_id(this)">
				<option value="0">'.$lang['svc_file']['select_a_forum_name'].'</option>';
				$all_forums = chk_allowed_forums();
				for($x = 0; $x < count($all_forums); $x++){
					$f_id = $all_forums[$x];
					echo'
					<option value="'.$f_id.'" '.check_select($f, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
				}
				echo'
				</select>
				</td>
			</tr>';
			$medal_url = icons($unknown);
			$standard = icons($icon_plaques_standard);
			
	
			echo'
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['admin']['sell_medal_photo'].': </nobr></td>
				<td class="list" align="middle" colSpan="4">';
				if ($m <= 0 AND $m == ""){
					echo'
				'.$medal_url.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'
				';
				} else {
				
					$medal_url = '<img onerror="this.src=\''.$unknown.'\';" src="'.mf("SUBJECT", $m).'">
					';
					echo $medal_url;
					echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'';
				}
				echo'
				<nobr></td>
		</tr>';
	
			echo'
			<input type="hidden" name="m_url" value="'.mf("SUBJECT", $m).'">
			<tr class="fixed" id="un_url">';
			/*
				<td class="optionheader"><nobr>صورة الوسام: </nobr></td>
				<td class="list" align="middle" colSpan="3"><nobr>
				</nobr></td>
			</tr>
			<tr class="fixed">
					*/
				echo'
				<td class="optionheader"><nobr>'.$lang['add_cat_forum']['num_days'].': </nobr></td>
				<td class="list" colSpan="4">
				<select class="insidetitle" name="m_days">';
				for($x = 1; $x <= 30; ++$x){
					echo'
					<option value="'.$x.'"';
					if ($x == 7){
						echo" selected";
					}
					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['num_days_desc'].'</font>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['points'].' </nobr></td>
				<td class="list" colSpan="4">
				<select class="insidetitle" name="m_points">';
				for($x = 1; $x <= 40; ++$x){
					echo'
					<option value="'.$x.'"';
					if ($x == 2){
						echo" selected";
					}
					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['points_desc'].'</font>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['medal_status'].' </nobr></td>';
			if (mlv > 2){
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="m_status">'.$lang['svc_file']['medal_pending_mon'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="2" name="m_status">'.$lang['svc_file']['medal_in_shop'].'</nobr></td>
				<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="1" name="m_status" CHECKED>'.$lang['svc_file']['medal_true'].'</nobr></td>';
			}
			else{
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="m_status" CHECKED>'.$lang['svc_file']['medal_pending_mon'].'</nobr></td>
				<td class="list" colSpan=3"><nobr><input class="small" type="radio" value="2" name="m_status">'.$lang['svc_file']['medal_in_shop'].'</nobr></td>';
			}
			echo'
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['give_medal_to_member'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="m_give">'.$lang['svc_file']['dont_give_medals'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" CHECKED value="1" name="m_give">'.$lang['svc_file']['have_mon_medals'].'</nobr></td>
				<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="2" name="m_give">'.$lang['svc_file']['have_admin_medals'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['medal_close'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" CHECKED value="0" name="m_close">'.$lang['svc_file']['medal_true_open'].'</nobr></td>
				<td class="list" colSpan="3"><nobr><input class="small" type="radio" value="1" name="m_close">'.$lang['svc_file']['medal_true_clos'].'</nobr></td>
			</tr>			
			<tr class="fixed">
				<td class="list_center" colSpan="5"><input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</form>
		</table>
		</center><br>';
	}
		if (svc == "special_medals_points"){
		if($Mlevel != 4) {
		redirect();
		}
		?>
		<script language="javascript">
			var m = "<?php echo $m; ?>";

			function choose_img(url){
				var unknown = "<?php echo $unknown; ?>";
				document.getElementById("click_url").style.display = "block";
				document.getElementById("load_url").style.display = "none";
				document.getElementById("un_url").style.display = "none";
				document.getElementById("img_url").style.display = "block";
				document.medal_info.m_url.value = url;
				div_img.innerHTML = "<img src="+url+" onerror=\"this.src='"+unknown+"';\">";
			}

				function chk_type(type){
				type = type.options[type.selectedIndex].value;
				if (type > 0){
					document.location = "index.php?mode=svc&method=add&svc=special_medals_points&chk_type="+type;
				}
				else{
					return;
				}
			}

			function replace_title(new_text){

					document.medal_info.m_subject.value = new_text;
				
			}

			function app_title(new_text){

					document.medal_info.m_subject.value += new_text;
				
			}

			function submit_form(){
				if (medal_info.m_subject.value.length < 5){
					confirm(enter_medal_points_name_5);
					return;
				}
				if (medal_info.m_subject.value.indexOf("[") >= 0){
					confirm(enter_medal_points_name_5);
					return;
				}
				if (medal_info.m_subject.value.indexOf("]") >= 0){
					confirm(enter_medal_points_name_5);
					return;
				}

			
			medal_info.submit();
			}
			


		</script>
		<?php
	 $chk_type = DBi::$con->real_escape_string(htmlspecialchars($_GET["chk_type"]));				
		echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
		<form name="medal_info" method="post" action="index.php?mode=svc&method=insert&svc=special_medals_points">
			<tr class="fixed">
				<td class="cat" colSpan="4"><nobr>'.$lang['svc_file']['add_special_medals_points'] .'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_address'].': </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 300px" name="m_subject">&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
				echo'
				&nbsp;<hr>&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="replace_title(\''.$lang['svc_file']['for_delete_in'].'\');" type="button" value="'.$lang['svc_file']['for_delete'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="app_title(\''.$lang['svc_file']['wrong_medal_photo'].'\');" type="button" value="'.$lang['svc_file']['no_photo'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="app_title(\''.$lang['svc_file']['wrong_medal_size'].'\');" type="button" value="'.$lang['message']['pm_size'].'">';
			
				echo'
				</td>
			</tr>';
			echo'
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_function']['type'].': </nobr></td>
				<td class="list" colSpan="3"><nobr>
				<select name="m_special_type" style="WIDTH:200px;HEIGHT:24px" onchange="chk_type(this)">
				';
				if($chk_type == "") {
				echo'<option value="0">'.$lang['svc_file']['select_an_type'].'</option>';
				}
				if($chk_type == "" or $chk_type == 1 or $chk_type == 2 or $chk_type == 3) {
				echo'
				<option value="1" '.check_select($chk_type, 1).'>'.$lang['admin']['special_medal'].'</option>
				<option value="2" '.check_select($chk_type, 2).'>'.$lang['admin']['special_points'].'</option>';
				}
				echo'
				</select>
				</nobr></td>
			</tr>';
			if($chk_type == 1) {
			echo'
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['svc_file']['medal_url'].' </nobr></td>
				<td class="list"  colSpan="3">
				<input name="m_url" size="40">
				<nobr></td>
		</tr>';
		$medal_url = icons($unknown);
			$standard = icons($icon_plaques_standard);
			
	
			echo'
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['admin']['sell_medal_photo'].': </nobr></td>
				<td class="list" align="middle" colSpan="3">';
				if ($m <= 0 AND $m == ""){
					echo'
				'.$medal_url.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'
				';
				} else {
				
					$medal_url = '<img onerror="this.src=\''.$unknown.'\';" src="'.mf("SUBJECT", $m).'">
					';
					echo $medal_url;
					echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'';
				}
				echo'
				<nobr></td>
		</tr>';
		
			echo'
			
			<tr class="fixed" id="un_url">';
			/*
				<td class="optionheader"><nobr>صورة الوسام: </nobr></td>
				<td class="list" align="middle" colSpan="3"><nobr>
				</nobr></td>
			</tr>
			<tr class="fixed">
					*/
				echo'
				<td class="optionheader"><nobr>'.$lang['add_cat_forum']['num_days'].': </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" name="m_days">';
				for($x = 0; $x <= 365; ++$x){
					echo'
					<option value="'.$x.'"';
					if ($x == 7){
						echo" selected";
					}
					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['num_days_desc'].'</font>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['points'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" name="m_points">';
				for($x = 1; $x <= 500; ++$x){
					echo'
					<option value="'.$x.'"';
					if ($x == 2){
						echo" selected";
					}
					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['special_medals_point'].'</font>
				</td>
			</tr>';
			}
			if($chk_type == 2) {
			echo'
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['points'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" name="m_points">';
				for($x = 1; $x <= 500; ++$x){
					echo'
					<option value="'.$x.'"';
					if ($x == 2){
						echo" selected";
					}
					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['special_medals_point'].'</font>
				</td>
			</tr>';
			}
			echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_function']['request_status'].': </nobr></td>';
				if(mlv > 2) {
					echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="m_status">'.$lang['svc_file']['moderate_admin'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="2" name="m_status">'.$lang['svc_file']['in_shop'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="m_status" CHECKED>'.$lang['svc_file']['a_true_this'].'</nobr></td>
				';
				} else {
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="m_status" CHECKED>'.$lang['svc_file']['moderate_admin'].'</nobr></td>
				<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="2" name="m_status">'.$lang['svc_file']['in_shop'].'</nobr></td>';
				}
echo'
			</tr>			
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['a_lock'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" CHECKED value="0" name="m_close">'.$lang['svc_file']['open_to_use'].'</nobr></td>
				<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="1" name="m_close">'.$lang['svc_file']['clos_in_use'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="list_center" colSpan="4"><input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</form>
		</table>
		</center><br>';
	}
	if (svc == "titles"){
		if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
		?>
		<script language="javascript">
			function submit_form(){
				if (title_info.subject.value.length < 5){
					confirm(enter_title_name);
					return;
				}
				if (title_info.forum_id.value <= 0){
					confirm(not_selected_forum);
					return;
				}
				title_info.submit();
			}
		</script>
		<?php
		echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
		<form name="title_info" method="post" action="index.php?mode=svc&method=insert&svc=titles">
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['title_name'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 400px" name="subject"></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['all']['forum'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" size="1" name="forum_id">
					<option value="0">'.$lang['svc_file']['select_a_forum_name'].'</option>';
					$all_forums = chk_allowed_forums();
					for($x = 0; $x < count($all_forums); $x++){
						$f_id = $all_forums[$x];
						echo'
						<option value="'.$f_id.'" '.check_select($f, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
					}
				echo'
				</select>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['title_close'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="close" CHECKED>'.$lang['svc_file']['title_a_open'].'</nobr></td>
				<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="1" name="close">'.$lang['svc_file']['title_a_close'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['title_show'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="forum" CHECKED>'.$lang['svc_file']['tile_just_forum'].'</nobr></td>
				<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="1" name="forum">'.$lang['svc_file']['title_all_forums'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['title_status'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="status" CHECKED>'.$lang['svc_file']['pending_mon_admin'].'</nobr></td>';
			if (mlv > 2){
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="2" name="status">'.$lang['svc_file']['title_in_shop'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="status">'.$lang['svc_file']['title_true'].'</nobr></td>';
			}
			else{
				echo'
				<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="2" name="status">'.$lang['svc_file']['title_in_shop'].'</nobr></td>';
			}
			echo'
			</tr>
			<tr class="fixed">
				<td class="list_center" colSpan="4"><input onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</table>
		</center><br>';
	}
	if (svc == "surveys"){
				if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
		?>
		<script language="javascript">
			function submit_form(){
				if (survey_info.subject.value.length < 10){
					confirm(enter_survey_title);
					return;
				}
				if (survey_info.question.value.length < 10){
					confirm(enter_survey_question);
					return;
				}
				if (survey_info.forum_id.value <= 0){
					confirm(not_selected_forum);
					return;
				}
				var regex = /^[0-9]/;
				if (!regex.test(survey_info.min_days.value)){
					confirm(days_is_number);
					return;
				f}
				if (!regex.test(survey_info.min_posts.value)){
					confirm(posts_is_number);
					return;
				}
				survey_info.submit();
			}
		</script>
		<?php
		echo'
		<form name="survey_info" method="post" action="index.php?mode=svc&method=insert&svc=surveys">
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
		
		<input type="hidden" name="refer" value="'.$referer.'">
			<tr class="fixed">
				<td class="optionheader" colSpan="3"><nobr>'.$lang['svc_file']['add_a_survey'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['survey_title'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 600px" name="subject"></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['survey_question'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 600px" name="question"></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['add_cat_forum']['num_days'].': </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" name="days">';
				for($x = 1; $x <= 30; ++$x){
					echo'
					<option value="'.$x.'"';
					if ($x == 5){
						echo" selected";
					}
					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['survey_days_desc'].'</font>
				</td>			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['all']['forum'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" size="1" name="forum_id">
					<option value="0">'.$lang['svc_file']['select_a_forum_name'].'</option>';
					$all_forums = chk_allowed_forums();
					for($x = 0; $x < count($all_forums); $x++){
						$f_id = $all_forums[$x];
						echo'
						<option value="'.$f_id.'" '.check_select($f, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
					}
				echo'
				</select>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['num_days_it'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 40px" value="0" name="min_days">&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['num_days_it_desc'].'</font></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['num_posts_it'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 40px" value="0" name="min_posts">&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['num_post_it_desc'].'</font></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['survey_status'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="status" CHECKED>'.$lang['admin']['open'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="status">'.$lang['admin']['close'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['survey_secret'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="secret" CHECKED>'.$lang['admin']['open'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="secret">'.$lang['svc_function']['secret'].'</nobr></td>
			</tr>

			<tr class="fixed">
				<td class="list_center" colSpan="5"><input onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="JavaScript:history.go(-1);" value="'.$lang['svc_function']['go_back'].'"></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader" colSpan="3"><nobr>'.$lang['svc_file']['options_options'].'</nobr></td>
			</tr>';
		for($x = 1; $x <= 30; ++$x){
			echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_function']['option'].' '.$x.': </nobr></td>
				<td class="list" colSpan="3">
					<input class="insidetitle" style="WIDTH: 600px" name="value[]"><br>
					<input class="insidetitle" style="WIDTH: 450px" name="other[]"><font color="green" size="-1">'.$lang['svc_file']['other_desc'].'</font>
				</td>
			</tr>';
		}
		echo'
		</form>
		</table>
		</center><br>';
	}
}

if ($method == "insert"){
	if (svc == "groups"){
		$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_forum_id']));
		if(allowed($f, 2) == 1 && isset($f) && $f != "" && forums("SUBJECT", $f) != "") {
				if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
			$subject = DBi::$con->real_escape_string(htmlspecialchars($_POST["g_subject"]));
			$url = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_url']));
			$status = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_status']));
			$desc = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_desc']));
			$mod = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_mod']));
			$login = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_login']));
			$points = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_points']));
			if (strlen($subject) < 5){
				$error = $lang['svc_file']['enter_group_name_5'];
			}
			else if ($f <= 0){
				$error = $lang['svc_file']['select_a_forum_from_list'];
			}
			else{
				$error = "";
			}
				if(mlv > 2) {
				$g_mod_array = array('0','1','2');
				} else {
				$g_mod_array = array('0','1');
				}
				$g_login_array = array('0','1','2');
				$g_close_array = array('0','1','2');
				if(!in_array($mod,$g_mod_array)) {
				go_to("index.php");
				}
				if(!in_array($login,$g_login_array)) {
				go_to("index.php");
				}
				if(!in_array($status,$g_close_array)) {
				go_to("index.php");
				}			
			if ($error != ""){
	                echo'<br>
					<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br><b>'.$lang['all']['error'].'<br>'.$error.'..</b></font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
			}
			if ($error == ""){
				$query = "INSERT INTO ".prefix."GROUPS (G_NAME, G_STATUS, G_DESC, G_FORUM, G_IMG, G_POINTS, G_MOD, G_LOGIN, G_ADDED) VALUES (";
				$query .= " '$subject', ";
				$query .= " '$status', ";
				$query .= " '$desc', ";
				$query .= " '$f', ";
				$query .= " '$url',";
				$query .= " '$points',";
				$query .= " '$mod',";
				$query .= " '$login',";
				$query .= " '$DBMemberID'";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_added_group'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL= index.php?mode=svc&method=svc&svc=groups">
                           <a href="index.php?mode=svc&method=svc&svc=groups">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
			}

		}
	}
	if (svc == "special_medals_points"){
				if($Mlevel != 4){
			redirect();
		}
			$subject = DBi::$con->real_escape_string(htmlspecialchars($_POST["m_subject"]));
			$url = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_url']));
			$days = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_days']));
			$points = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_points']));
			$status = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_status']));
			$close = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_close']));
			$special_type = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_special_type']));
			if (strlen($subject) < 5){
				$error = $lang['svc_file']['enter_medal_points_name'];
			}
			else{
				$error = "";
			}
			if ($error != ""){
	                echo'<br>
					<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br><b>'.$lang['all']['error'].'<br>'.$error.'..</b></font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
			}
			$m_special_type_array = array('1','2');
			$m_special_points_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60','61','62','63','64','65','66','67','68','69','70','71','72','73','74','75','76','77','78','79','80','81','82','83','84','85','86','87','88','89','90','91','92','93','94','95','96','97','98','99','100','101','102','103','104','105','106','107','108','109','110','111','112','113','114','115','116','117','118','119','120','121','122','123','124','125','126','127','128','129','130','131','132','133','134','135','136','137','138','139','140','141','142','143','144','145','146','147','148','149','150','151','152','153','154','155','156','157','158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','196','197','198','199','200','201','202','203','204','205','206','207','208','209','210','211','212','213','214','215','216','217','218','219','220','221','222','223','224','225','226','227','228','229','230','231','232','233','234','235','236','237','238','239','240','241','242','243','244','245','246','247','248','249','250','251','252','253','254','255','256','257','258','259','260','261','262','263','264','265','266','267','268','269','270','271','272','273','274','275','276','277','278','279','280','281','282','283','284','285','286','287','288','289','290','291','292','293','294','295','296','297','298','299','300','301','302','303','304','305','306','307','308','309','310','311','312','313','314','315','316','317','318','319','320','321','322','323','324','325','326','327','328','329','330','331','332','333','334','335','336','337','338','339','340','341','342','343','344','345','346','347','348','349','350','351','352','353','354','355','356','357','358','359','360','361','362','363','364','365','366','367','368','369','370','371','372','373','374','375','376','377','378','379','380','381','382','383','384','385','386','387','388','389','390','391','392','393','394','395','396','397','398','399','400','401','402','403','404','405','406','407','408','409','410','411','412','413','414','415','416','417','418','419','420','421','422','423','424','425','426','427','428','429','430','431','432','433','434','435','436','437','438','439','440','441','442','443','444','445','446','447','448','449','450','451','452','453','454','455','456','457','458','459','460','461','462','463','464','465','466','467','468','469','470','471','472','473','474','475','476','477','478','479','480','481','482','483','484','485','486','487','488','489','490','491','492','493','494','495','496','497','498','499','500');
			$m_special_days_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60','61','62','63','64','65','66','67','68','69','70','71','72','73','74','75','76','77','78','79','80','81','82','83','84','85','86','87','88','89','90','91','92','93','94','95','96','97','98','99','100','101','102','103','104','105','106','107','108','109','110','111','112','113','114','115','116','117','118','119','120','121','122','123','124','125','126','127','128','129','130','131','132','133','134','135','136','137','138','139','140','141','142','143','144','145','146','147','148','149','150','151','152','153','154','155','156','157','158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','196','197','198','199','200','201','202','203','204','205','206','207','208','209','210','211','212','213','214','215','216','217','218','219','220','221','222','223','224','225','226','227','228','229','230','231','232','233','234','235','236','237','238','239','240','241','242','243','244','245','246','247','248','249','250','251','252','253','254','255','256','257','258','259','260','261','262','263','264','265','266','267','268','269','270','271','272','273','274','275','276','277','278','279','280','281','282','283','284','285','286','287','288','289','290','291','292','293','294','295','296','297','298','299','300','301','302','303','304','305','306','307','308','309','310','311','312','313','314','315','316','317','318','319','320','321','322','323','324','325','326','327','328','329','330','331','332','333','334','335','336','337','338','339','340','341','342','343','344','345','346','347','348','349','350','351','352','353','354','355','356','357','358','359','360','361','362','363','364','365');
			if(mlv > 2) {
			$m_special_status_array = array('0','1','2');
			} else {
			$m_special_status_array = array('0','2');
			}
			$m_special_close_array = array('0','1');
			
				if(!in_array($special_type,$m_special_type_array)) {
				go_to("index.php");
				}
				if(!in_array($points,$m_special_points_array)) {
				go_to("index.php");
				}
				if($special_type == 1) {
				if(!in_array($days,$m_special_days_array)) {
				go_to("index.php");
				}
				}
				if(!in_array($status,$m_special_status_array)) {
				go_to("index.php");
				}	
				if(!in_array($close,$m_special_close_array)) {
				go_to("index.php");
				}				
			if ($error == ""){
				$query = "INSERT INTO ".prefix."GLOBAL_MEDALS (MEDAL_ID, FORUM_ID, STATUS, SUBJECT, POINTS, DAYS, URL, CLOSE, ADDED, SPECIAL, SPECIAL_TYPE, DATE) VALUES (NULL, ";
				$query .= " '$f', ";
				$query .= " '$status', ";
				$query .= " '$subject', ";
				$query .= " '$points', ";
				$query .= " '$days', ";
				$query .= " '$url', ";
				$query .= " '$close', ";
				$query .= " '$DBMemberID', ";
				$query .= " '1', ";
				$query .= " '$special_type', ";
				$query .= " '".time()."') ";
				DBi::$con->query($query) or die (DBi::$con->error);
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");				
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_added_medal_points'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL= index.php?mode=svc&method=svc&svc=special_medals_points">
                           <a href="index.php?mode=svc&method=svc&svc=special_medals_points">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
			}

		
	}
	
		if (svc == "medals"){
		$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_forum_id']));
				if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
		if (allowed($f, 2) == 1){
			$subject = DBi::$con->real_escape_string(htmlspecialchars($_POST["m_subject"]));
			$url = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_url']));
			$days = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_days']));
			$points = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_points']));
			$status = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_status']));
			$give = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_give']));
			$close = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_close']));
			if (strlen($subject) < 10){
				$error = $lang['svc_file']['enter_medal_name'];
			}
			else if ($f <= 0){
				$error = $lang['svc_file']['select_a_forum_from_list'];
			}
			else{
				$error = "";
			}
					$m_days_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30');
					$m_points_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40');
					if(mlv > 2) {
					$m_status_array = array('0','1','2');
					} else {
					$m_status_array = array('0','2');
					}
					$m_give_array = array('0','1','2');
					$m_close_array = array('0','1');

				if(!in_array($days,$m_days_array)) {
				go_to("index.php");
				}
				if(!in_array($points,$m_points_array)) {
				go_to("index.php");
				}
				if(!in_array($status,$m_status_array)) {
				go_to("index.php");
				}
				if(!in_array($give,$m_give_array)) {
				go_to("index.php");
				}				
				if(!in_array($close,$m_close_array)) {
				go_to("index.php");
				}				
			if ($error != ""){
	                echo'<br>
					<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br><b>'.$lang['all']['error'].'<br>'.$error.'..</b></font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
			}
			if ($error == ""){
				$query = "INSERT INTO ".prefix."GLOBAL_MEDALS (MEDAL_ID, FORUM_ID, STATUS, GIVE, SUBJECT, POINTS, DAYS, URL, CLOSE, ADDED, DATE) VALUES (NULL, ";
				$query .= " '$f', ";
				$query .= " '$status', ";
				$query .= " '$give', ";
				$query .= " '$subject', ";
				$query .= " '$points', ";
				$query .= " '$days', ";
				$query .= " '$url', ";
				$query .= " '$close', ";
				$query .= " '$DBMemberID', ";
				$query .= " '".time()."') ";
				DBi::$con->query($query) or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_added_medal'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL= index.php?mode=svc&method=svc&svc=medals">
                           <a href="index.php?mode=svc&method=svc&svc=medals">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
			}

		} else {
		redirect();	
		}
	}
	if (svc == "titles"){
		$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));
				if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
        $subject = DBi::$con->real_escape_string(htmlspecialchars($_POST["subject"]));
		$close = DBi::$con->real_escape_string(htmlspecialchars($_POST['close']));
		$forum = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum']));
		$status = DBi::$con->real_escape_string(htmlspecialchars($_POST['status']));
		if (strlen($subject) < 5){
			$error = $lang['svc_file']['enter_title_name'];
		}
		else if ($f <= 0){
			$error = $lang['svc_file']['select_a_forum_from_list'];
		}
		else{
			$error = "";
		}
				$t_close_array = array('0','1');
				$t_show_array = array('0','1');
				if(mlv > 2) {
				$t_status_array = array('0','1','2');
				} else {
				$t_status_array = array('0');
				}
				if(!in_array($close,$t_close_array)) {
				go_to("index.php");
				}
				if(!in_array($forum,$t_show_array)) {
				go_to("index.php");
				}
				if(!in_array($status,$t_status_array)) {
				go_to("index.php");
				}			
		if ($error != ""){
			echo'<br>
			<center>
			<table width="99%" border="1">
			   <tr class="normal">
				   <td class="list_center" colSpan="10"><font size="5" color="red"><br><b>'.$lang['all']['error'].'<br>'.$error.'..</b></font><br><br>
				   <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
				   </td>
			   </tr>
			</table>
			</center><xml>';
		}
		if ($error == ""){
			if (allowed($f, 2) == 1){
				$sql = "INSERT INTO ".prefix."GLOBAL_TITLES (TITLE_ID, FORUM_ID, STATUS, CLOSE, FORUM, ADDED, SUBJECT, DATE) VALUES (NULL, ";
				$sql = $sql." '$f', ";
				$sql = $sql." '$status', ";
				$sql = $sql." '$close', ";
				$sql = $sql." '$forum', ";
				$sql = $sql." '$DBMemberID', ";
				$sql = $sql." '$subject', ";
				$sql = $sql." '".time()."') ";
				DBi::$con->query($sql) or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
				echo'<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_added_title'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL= index.php?mode=svc&method=svc&svc=titles">
					   <a href="index.php?mode=svc&method=svc&svc=titles">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			} else {
		redirect();	
		}
		}
	}
	if (svc == "surveys"){
		
		$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));		
				if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
		$subject = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['subject']));		
		$question = DBi::$con->real_escape_string(htmlspecialchars($_POST['question']));		
		$days = DBi::$con->real_escape_string(htmlspecialchars($_POST['days']));		
		$min_days = DBi::$con->real_escape_string(htmlspecialchars($_POST['min_days']));		
		$min_posts = DBi::$con->real_escape_string(htmlspecialchars($_POST['min_posts']));		
		$status = DBi::$con->real_escape_string(htmlspecialchars($_POST['status']));		
		$secret = DBi::$con->real_escape_string(htmlspecialchars($_POST['secret']));		
		$value = $_POST['value'];
		$other = $_POST['other'];		
		$refer = DBi::$con->real_escape_string(htmlspecialchars($_POST['refer']));		
		$start = time();
		$all_days = $days*60*60*24;
		$end = time() + $all_days;
		if (svc_survey_value($value) < 2){
			$error = $lang['svc_file']['enter_two_options'];
		}
		else{
			$error = "";
		}
			$s_days_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30');
			$s_status_array = array('0','1');
			$s_secret_array = array('0','1');
			if(!in_array($days,$s_days_array)) {
				go_to("index.php");
			}	
			if(!in_array($status,$s_status_array)) {
				go_to("index.php");
			}	
			if(!in_array($secret,$s_secret_array)) {
				go_to("index.php");
			}
			if(svc_survey_value($value) > 30) {
				go_to("index.php");
			}
		if ($error != ""){
			echo'<br>
			<center>
			<table width="99%" border="1">
			   <tr class="normal">
				   <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$error.'..</font><br><br>
				   <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
				   </td>
			   </tr>
			</table>
			</center><xml>';
		}
		if ($error == ""){
			if (allowed($f, 2) == 1){
				$sql = "INSERT INTO ".prefix."SURVEYS (SURVEY_ID, FORUM_ID, SUBJECT, QUESTION, STATUS, SECRET, DAYS, MIN_DAYS, MIN_POSTS, ADDED, START, END) VALUES (NULL, ";
				$sql = $sql." '$f', ";
				$sql = $sql." '$subject', ";
				$sql = $sql." '$question', ";
				$sql = $sql." '$status', ";
				$sql = $sql." '$secret', ";
				$sql = $sql." '$days', ";
				$sql = $sql." '$min_days', ";
				$sql = $sql." '$min_posts', ";
				$sql = $sql." '$DBMemberID', ";
				$sql = $sql." '$start', ";
				$sql = $sql." '$end') ";
				DBi::$con->query($sql) or die (DBi::$con->error);
				$surv_id = svc_chk_survey_id($f, $subject, $question);
				$i = 1;
				for ($x = 0;$x < count($value); ++$x){
				if ($value[$x] != ""){
				$sql = "INSERT INTO ".prefix."SURVEY_OPTIONS (SO_ID, SURVEY_ID, OPTION_ID, VALUE, OTHER) VALUES (NULL, ";
				$sql = $sql." '$surv_id', ";
				$sql = $sql." '$i', ";
				$sql = $sql." '".DBi::$con->real_escape_string(HtmlSpecialchars($value[$x]))."', ";
				$sql = $sql." '".DBi::$con->real_escape_string(HtmlSpecialchars($other[$x]))."') ";
				DBi::$con->query($sql) or die (DBi::$con->error);
				$i = $i + 1;
				}
				}
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
				echo'<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_added_survey'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL='.$referer.'">
					   <a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			} else {
		redirect();	
		}
		}
	}
	if (svc == "prv"){
		$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['f']));
				if(isset($f) && $f != "" && !in_array($f,chk_allowed_forums())){
			redirect();
		}
		if (allowed($f, 2) == 1){
			$t = DBi::$con->real_escape_string(htmlspecialchars($_POST['t']));
			$m = DBi::$con->real_escape_string(htmlspecialchars($_POST['m']));

			if (empty($m)){
				$error = $lang['svc_file']['enter_member_id'];
			}
			else if (chk_id("MEMBERS", "MEMBER_ID", $m) != 1){
				$error = $lang['svc_file']['wrong_member_id'];
			}
			else if (chk_add_member_to_topic($t, $m) == 1){
				$error = $lang['svc_file']['member_opend_this_topic'];
			}
			else{
				$error = "";
			}
			if ($error != ""){
				echo'<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5" color="red"><br><b>'.$lang['all']['error'].'<br>'.$error.'..</b></font><br><br>
					   <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center><xml>';
			}
			if ($error == ""){
				$sql = "INSERT INTO ".prefix."TOPIC_MEMBERS (TM_ID, MEMBER_ID, TOPIC_ID, ADDED, DATE) VALUES (NULL, ";
				$sql = $sql." '$m', ";
				$sql = $sql." '$t', ";
				$sql = $sql." '$DBMemberID', ";
				$sql = $sql." '".time()."') ";
				DBi::$con->query($sql) or die (DBi::$con->error);

				$t_subject = topics("SUBJECT", $t);
				$subject = ''.$lang['svc_file']['message_hide_open_topic_part1'].' '.$t_subject;
				$message = ''.$lang['svc_file']['message_hide_open_topic_part2'].'<br><br><a href="index.php?mode=t&t='.$t.'">'.$lang['svc_file']['message_hide_open_topic_part3'].' '.$t.': '.$t_subject.'</a><br><br>'.$lang['svc_file']['message_hide_open_topic_part4'].'</font>';

				$sql = "INSERT INTO ".prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sql .= " '$m', ";
				$sql .= " '$m', ";
				$sql .= " '".abs2($f)."', ";
				$sql .= " '0', ";
				$sql .= " '$subject', ";
				$sql .= " '$message', ";
				$sql .= " '".time()."') ";
				DBi::$con->query($sql) or die (DBi::$con->error);
				
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
				
				header("Location: ".$referer."");

			}
		} else {
		redirect();	
		}
	}
}

if ($method == "in"){
			if (svc == "special_points"){
				if($Mlevel > 1) {
			$points = gm("POINTS", $id);
			$sql = "INSERT INTO ".prefix."MEDALS (MEDAL_ID, GM_ID, MEMBER_ID, FORUM_ID, STATUS, ADDED, DAYS, POINTS, URL, SPECIAL, SPECIAL_TYPE, DATE) VALUES (NULL, ";
			$sql .= " '$id', ";
			$sql .= " '$m', ";
			$sql .= " '0', ";
			if ($Mlevel == 4){
				$sql .= " '1', ";
			}
			else{
				$sql .= " '0', ";
			}
			$sql .= " '$DBMemberID', ";
			$sql .= " '0', ";
			$sql .= " '$points', ";
			$sql .= " NULL, ";
			$sql .= " '1', ";
			$sql .= " '2', ";
			$sql .= " '".time()."') ";
			DBi::$con->query($sql) or die (DBi::$con->error);
			if ($Mlevel == 4){
				$msg_text = $lang['svc_file']['done_add_points_to_member'];
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_SPECIAL_POINTS = '".member_all_special_points($m)."' WHERE MEMBER_ID = '$m' ") or die (DBi::$con->error);
			}
			else{
				$msg_text = $lang['svc_file']['done_add_points_to_member_pending_admin'];
			}
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");			
			}
			
				header("Location: ".index()."?mode=svc&svc=medals");

			
		
	}
		if (svc == "special_medals"){
			if($Mlevel > 1) {
			$url = gm("URL", $id);
			$days = gm("DAYS", $id);
			$points = gm("POINTS", $id);
			$sql = "INSERT INTO ".prefix."MEDALS (MEDAL_ID, GM_ID, MEMBER_ID, FORUM_ID, STATUS, ADDED, DAYS, POINTS, URL, SPECIAL, SPECIAL_TYPE, DATE) VALUES (NULL, ";
			$sql .= " '$id', ";
			$sql .= " '$m', ";
			$sql .= " '0', ";
			if ($Mlevel == 4){
				$sql .= " '1', ";
			}
			else{
				$sql .= " '0', ";
			}
			$sql .= " '$DBMemberID', ";
			$sql .= " '$days', ";
			$sql .= " '$points', ";
			$sql .= " '$url', ";
			$sql .= " '1', ";
			$sql .= " '1', ";
			$sql .= " '".time()."') ";
			DBi::$con->query($sql) or die (DBi::$con->error);
			if ($Mlevel == 4){
				$msg_text = $lang['svc_file']['done_add_medals_to_member'];
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MEDAL = '".chk_member_last_medal($m)."', M_POINTS = '".member_all_points($m)."' WHERE MEMBER_ID = '$m' ") or die (DBi::$con->error);
			}
			else{
				$msg_text = $lang['svc_file']['done_add_medals_to_member_pending_admin'];
			}
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
			}
				header("Location: ".index()."?mode=svc&svc=medals");

		}
	if (svc == "medals"){
		if (allowed($f, 2) == 1){
			$days = gm("DAYS", $id);
			$give = gm("GIVE", $id);
			$points = gm("POINTS", $id);
			$url = gm("URL", $id);
			$sql = "INSERT INTO ".prefix."MEDALS (MEDAL_ID, GM_ID, MEMBER_ID, FORUM_ID, STATUS, ADDED, DAYS, POINTS, URL, DATE) VALUES (NULL, ";
			$sql .= " '$id', ";
			$sql .= " '$m', ";
			$sql .= " '$f', ";
			if(allowed($f, 2) == 1 && $give == 0) {
				$sql .= " '4', ";
			}
			elseif(allowed($f, 2) == 1 && $give == 1) {
				$sql .= " '0', ";
			}	
			elseif(allowed($f, 2) == 1 && $give == 2) {
				$sql .= " '5', ";
			}
			$sql .= " '$DBMemberID', ";
			$sql .= " '$days', ";
			$sql .= " '$points', ";
			$sql .= " '$url', ";
			$sql .= " '".time()."') ";
			DBi::$con->query($sql) or die (DBi::$con->error);
			if (allowed($f, 1) == 1){
				$msg_text = $lang['svc_file']['done_add_medals_to_member'];
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MEDAL = '".chk_member_last_medal($m)."', M_POINTS = '".member_all_points($m)."' WHERE MEMBER_ID = '$m' ") or die (DBi::$con->error);
			}
			else{
				$msg_text = $lang['svc_file']['done_add_medals_to_member_pending_monitor'];
			}
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
		}	
				header("Location: ".index()."?mode=svc&svc=medals");
		
	}
	if (svc == "titles"){
		if (allowed($f, 2) == 1){
			if (chk_add_titles($id, $m) == 1){
				$error = $lang['svc_file']['title_from_here'];
			}
			else{
				$error = "";
			}

			if ($error != ""){
				echo'<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5" color="red"><br><b>'.$lang['all']['error'].'<br>'.$error.'..</b></font><br><br>
					   <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center><xml>';
			}
			if ($error == ""){
				$sql = "INSERT INTO ".prefix."TITLES (TITLE_ID, GT_ID, MEMBER_ID, DATE) VALUES (NULL, ";
				$sql .= " '$id', ";
				$sql .= " '$m', ";
				$sql .= " '".time()."') ";
				DBi::$con->query($sql) or die (DBi::$con->error);

				$sql = "INSERT INTO ".prefix."USED_TITLES (ID, TITLE_ID, MEMBER_ID, STATUS, ADDED, DATE) VALUES (NULL, ";
				$sql .= " '$id', ";
				$sql .= " '$m', ";
				$sql .= " '1', ";
				$sql .= " '$DBMemberID', ";
				$sql .= " '".time()."') ";
				DBi::$con->query($sql) or die (DBi::$con->error);

if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
				
			}
		}
		
				header("Location: ".index()."?mode=member&id=".$m."");
		
	}
}

if ($method == "edit"){
			if (svc == "special_medals_points"){
		if($Mlevel != 4) {
		redirect();
		}
			$subject = gm("SUBJECT", $m);
			$url = gm("URL", $m);
			$close = gm("CLOSE", $m);
			$special_type = gm("SPECIAL_TYPE", $m);
			$points = gm("POINTS", $m);
			$days = gm("DAYS", $m);
		?>
		<script language="javascript">
			var m = "<?php echo $m; ?>";

			function choose_img(url){
				var unknown = "<?php echo $unknown; ?>";
				document.getElementById("click_url").style.display = "block";
				document.getElementById("load_url").style.display = "none";
				document.getElementById("un_url").style.display = "none";
				document.getElementById("img_url").style.display = "block";
				document.medal_info.m_url.value = url;
				div_img.innerHTML = "<img src="+url+" onerror=\"this.src='"+unknown+"';\">";
			}


			function replace_title(new_text){

					document.medal_info.m_subject.value = new_text;
				
			}

			function app_title(new_text){

					document.medal_info.m_subject.value += new_text;
				
			}

			function submit_form(){
				if (medal_info.m_subject.value.length < 5){
					confirm(enter_medal_points_name_5);
					return;
				}
				if (medal_info.m_subject.value.indexOf("[") >= 0){
					confirm(enter_medal_points_name_5);
					return;
				}
				if (medal_info.m_subject.value.indexOf("]") >= 0){
					confirm(enter_medal_points_name_5);
					return;
				}

			
			medal_info.submit();
			}
			


		</script>
		<?php
		if($special_type == 1) {
		$txt = ''.$lang['svc_file']['special_medal'].' '.$subject.' ، '.$lang['svc_file']['a_number'].' '.$m.''	;
		}
		if($special_type == 2) {
		$txt = ''.$lang['svc_file']['special_point'].' '.$subject.' ، '.$lang['svc_file']['a_number'].' '.$m.'';	
		}
		echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
		<form name="medal_info" method="post" action="index.php?mode=svc&method=update&svc=special_medals_points">
		<input type="hidden" name="m" value="'.$m.'">

			<tr class="fixed">
				<td class="cat" colSpan="3"><nobr>'.$lang['svc_file']['an_edit'].' '.$txt.'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_address'].': </nobr></td>
				<td class="list" colSpan="2"><input class="insidetitle" size="30" name="m_subject" value="'.$subject,'">&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
				echo'
				&nbsp;<hr>&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="replace_title(\''.$lang['svc_file']['for_delete_in'].'\');" type="button" value="'.$lang['svc_file']['for_delete'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="app_title(\''.$lang['svc_file']['wrong_medal_photo'].'\');" type="button" value="'.$lang['svc_file']['no_photo'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="app_title(\''.$lang['svc_file']['wrong_medal_size'].'\');" type="button" value="'.$lang['message']['pm_size'].'">';
			
				echo'
				</td>
			</tr>';
			if($special_type == 1) {
				echo'
							<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['svc_file']['medal_url'].' </nobr></td>
				<td class="list" colSpan="2">
				<input name="m_url" value="'.$url.'" size="40">
				<nobr></td>
		</tr>';
		$medal_url = icons($unknown);
			$standard = icons($icon_plaques_standard);
			
	
			echo'
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['admin']['sell_medal_photo'].': </nobr></td>
				<td class="list" align="middle" colSpan="3">';
				if ($m <= 0 AND $m == ""){
					echo'
				'.$medal_url.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'
				';
				} else {
				
					$medal_url = '<img onerror="this.src=\''.$unknown.'\';" src="'.$url.'">
					';
					echo $medal_url;
					echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'';
				}
				echo'
				<nobr></td>
		</tr>';
	
			}

			echo'
			
';			/*
				<td class="optionheader"><nobr>صورة الوسام: </nobr></td>
				<td class="list" align="middle" colSpan="3"><nobr>
				</nobr></td>
			</tr>
			<tr class="fixed">
					*/
			
if(allowed($f, 1) == 1) {
if($special_type == 1) {
	echo'
			<tr class="fixed">
			
				<td class="optionheader"><nobr>'.$lang['add_cat_forum']['num_days'].': </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" name="m_days">';
				for($x = 0; $x <= 365; ++$x){
					echo'
					<option value="'.$x.'"';
						echo check_select($x, $days);

					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['num_days_desc'].'</font>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['points'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" name="m_points">';
				for($x = 1; $x <= 500; ++$x){
					echo'
					<option value="'.$x.'"';
						echo check_select($x, $points);

					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['special_medals_point'].'</font>
				</td>
			</tr>';
			}
			if($special_type == 2) {
			echo'
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['points'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" name="m_points">';
				for($x = 1; $x <= 500; ++$x){
					echo'
					<option value="'.$x.'"';
						echo check_select($x, $points);
					
					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['special_medals_point'].'</font>
				</td>
			</tr>';
			}	
}			
		echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['a_lock'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="m_close" value="'.$close.'" '.check_radio($close, 0).'>'.$lang['svc_file']['open_to_use'].'</nobr></td>
				<td class="list" ><nobr><input class="small" type="radio" value="1" name="m_close" value="'.$close.'" '.check_radio($close, 1).'>'.$lang['svc_file']['clos_in_use'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="list_center" colSpan="3"><input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</form>
		</table>
		</center><br>';
	}
if (svc == "groups"){
		$f = groups("FORUM", $m);
		if (allowed($f, 2) == 1){

					  $g_name = groups("NAME", $m);
					  $g_desc = groups("DESC", $m);
					  $g_img = groups("IMG", $m);
					  $g_status = groups("STATUS", $m);
					  $g_login = groups("LOGIN", $m);
					  $g_points = groups("POINTS", $m);
?>
<script language="javascript">
			var f = "<?php echo $f; ?>";

			function app_title(new_text){
					document.group_info.g_subject.value += new_text;
			}

			function submit_form(){
				if (group_info.g_subject.value.length < 5){
					confirm(enter_group_name_5);
					return;
				}
				if (group_info.g_subject.value.indexOf("[") >= 0){
					confirm(enter_group_name_5);
					return;
				}
				if (group_info.g_subject.value.indexOf("]") >= 0){
					confirm(enter_group_name_5);
					return;
				}
			if (group_info.g_url.value.length < 3){
					confirm(enter_group_img);
					return;
				}
			
			group_info.submit();
			}
			


		</script>
				  <?

				  echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
		<form name="group_info" method="post" action="index.php?mode=svc&svc=groups&method=update">
		<input type="hidden" name="groupid" value="'.$m.'">
			<tr class="fixed">
				<td class="cat" colSpan="4"><nobr>'.$lang['svc_file']['edit_group_options'].' '.$m.'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_title'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 400px" name="g_subject" value="'.$g_name.'">&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
				echo'
				</td>
			</tr>';
			echo'
			
						<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_description'].' </nobr></td>
				<td class="list" align="middle" colSpan="3">
				<textarea name="g_desc" cols="55" rows="5">'.$g_desc.'</textarea>
				<nobr></td>
		</tr>
			';

								echo'
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_img_url'].' </nobr></td>
				<td class="list" colSpan="3">
				<input name="g_url" size="55" value='.$g_img.'>
				<nobr></td>
		</tr>';
							
		
		$group_url = icons($icon_groups_unknown);
			$standard = icons($icon_groups_standard);
			
	
			echo'
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['svc_file']['group_img'].' </nobr></td>
				<td class="list" colSpan="3"><center>';
				if ($m <= 0 AND $m == ""){
					echo'
				'.$group_url.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'
				';
				} else {
				
					$group_url = '<img onerror="this.src=\''.$unknown.'\';" src="'.$g_img.'">
					';
					echo $group_url;
					echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'';
				}
				echo'</center>
				<nobr></td>
		</tr>';
	
	if(allowed($f, 1) == 1) {
	echo'
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['topics']['points'].' </nobr></td>
				<td class="list" colSpan="3">
				<input name="g_points" size="10" value="'.$g_points.'">&nbsp;&nbsp;&nbsp;<font size="2" color="red">'.$lang['svc_file']['group_points_desc'].'</font>
				<nobr></td>
		</tr>
';		
	} else {
	echo'
	<input type="hidden" name = "g_points" value="'.$g_points.'">
	';
	}echo'
	';
			if(allowed($f, 1) == 1) {
				echo'
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['login_group'].' </nobr></td>';
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="g_login" '.check_radio($g_login, 0).'>'.$lang['svc_file']['login_0'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="g_login" '.check_radio($g_login, 1).'>'.$lang['svc_file']['login_1'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="2" name="g_login" '.check_radio($g_login, 2).'>'.$lang['svc_file']['login_2'].'</nobr></td>';
			echo'
			</tr>';
			} else {
			echo'	<input type="hidden" name="g_login" value="'.$g_login.'">
';
			}
			echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['close_group'].' </nobr></td>';
				echo'
				<td class="list"><nobr><input class="small" type="radio" value="0" name="g_status" '.check_radio($g_status, 0).'>'.$lang['svc_file']['an_open_group'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="2" name="g_status" '.check_radio($g_status, 2).'>'.$lang['svc_file']['an_close_group'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="g_status" '.check_radio($g_status, 1).'>'.$lang['svc_file']['an_hidden_group'].'</nobr></td>';
			echo'
			</tr>
			<tr class="fixed">
				<td class="list_center" colSpan="5"><input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</form>
		</table>
		</center><br>';
		} else {
		redirect();	
		}
		
	}
	if (svc == "medals"){
		$f = gm("FORUM_ID", $m);
		if (allowed($f, 2) == 1){
			$medal_folder = $image_folder.'medals/forum'.$f.'/';
			$subject = gm("SUBJECT", $m);
			$url = gm("URL", $m);
			$close = gm("CLOSE", $m);
			$points = gm("POINTS", $m);
			$give = gm("GIVE", $m);
?>
<script language="javascript">
	function load_medal_url(){
		document.getElementById("click_url").style.display = "none";
		document.getElementById("load_url").style.display = "block";
	}

	function choose_img(url){
		var unknown = "<?php echo $unknown; ?>";
		document.getElementById("click_url").style.display = "block";
		document.getElementById("load_url").style.display = "none";
		document.getElementById("un_url").style.display = "none";
		document.getElementById("img_url").style.display = "block";
		document.medal_info.m_url.value = url;
		div_img.innerHTML = "<img src="+url+" onerror=\"this.src='"+unknown+"';\">";
	}

	function replace_title(new_text){
		document.medal_info.m_subject.value = new_text;
	}

	function app_title(new_text){
		document.medal_info.m_subject.value += new_text;
	}

	function submit_form(){
		if (medal_info.m_subject.value.length < 10){
			confirm(enter_medal_name_10);
			return;
		}
		if (medal_info.m_subject.value.indexOf("[") >= 0){
			confirm(enter_medal_name_10);
			return;
		}
		if (medal_info.m_subject.value.indexOf("]") >= 0){
			confirm(enter_medal_name_10);
			return;
		}
			if (medal_info.m_url.value.length < 3){
					confirm(enter_medal_url);
					return;
				}
			
	medal_info.submit();
	}</script>
<?php
		echo'
		<center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td>
				<center>
				<form name="medal_info" method="post" action="index.php?mode=svc&method=update&svc=medals">
				<input type="hidden" name="m" value="'.$m.'">
				<input type="hidden" name="f" value="'.$f.'">
					<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
						<tr class="fixed">
							<td class="cat" colSpan="6"><nobr>'.$lang['svc_file']['add_medal_to_forum'].' '.forums("SUBJECT", $f).'</nobr></td>
						</tr>
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['medal_title'].' </nobr></td>
							<td class="list" colSpan="5"><input class="insidetitle" style="WIDTH: 390px" name="m_subject" value="'.$subject.'">&nbsp;&nbsp;
							<input class="insidetitle" onclick="replace_title(\''.$lang['svc_file']['medal_details'].' '.forums("SUBJECT", $f).'\');" type="button" value="+">&nbsp;&nbsp;
							<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
			if (mlv > 2){
				echo'
				&nbsp;<hr>&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="replace_title(\''.$lang['svc_file']['for_delete_in'].'\');" type="button" value="'.$lang['svc_file']['for_delete'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="replace_title(\''.$lang['svc_file']['no_monasabat_in'].'\');" type="button" value="'.$lang['svc_file']['no_tahany'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="app_title(\''.$lang['svc_file']['wrong_medal_photo'].'\');" type="button" value="'.$lang['svc_file']['no_photo'].'">&nbsp;&nbsp;
				<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="app_title(\''.$lang['svc_file']['wrong_medal_size'].'\');" type="button" value="'.$lang['message']['pm_size'].'">';
			}
							echo'
							</td>
						</tr>
			<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['svc_file']['medal_url'].' </nobr></td>
				<td class="list" align="middle" colSpan="5">
				<input value="'.$url.'" name="m_url" size="55">
				<nobr></td>
		</tr>';
					$standard = icons($icon_plaques_standard);
echo'
					<tr class="fixed" id="click_url">
				<td class="optionheader"><nobr>'.$lang['admin']['sell_medal_photo'].': </nobr></td>
				<td class="list" align="middle" colSpan="5">
				<img onerror="this.src=\''.$unknown.'\';" src="'.$url.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$standard.'
				<nobr></td>
		</tr>
			
				';
				if(allowed($f, 1) == 1) {
							echo'
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['points'].' </nobr></td>
				<td class="list" colSpan="5">
				<select class="insidetitle" name="m_points">';
				for($x = 1; $x <= 40; ++$x){
					echo'
					<option value="'.$x.'"';
						echo check_select($x, $points);
					echo'>'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['points_desc'].'</font>
				</td>
			</tr>';
				}
					echo'
						<tr class="fixed">
							<td class="optionheader"><nobr>'.$lang['svc_file']['give_medal_to_member'].' </nobr></td>
							<td class="list"><nobr><input class="small" type="radio" value="0" name="m_give" '.check_radio($give, 0).'>'.$lang['svc_file']['dont_give_medals'].'</nobr></td>
							<td class="list"><nobr><input class="small" type="radio" value="1" name="m_give" '.check_radio($give, 1).'>'.$lang['svc_file']['have_mon_medals'].'</nobr></td>
							<td class="list" colSpan="3"><nobr><input class="small" type="radio" value="2" name="m_give" '.check_radio($give, 2).'>'.$lang['svc_file']['have_admin_medals'].'</nobr></td>							
						</tr>
						<tr class="fixed">
							<td class="optionheader"><nobr>'.$lang['svc_file']['medal_close'].' </nobr></td>
							<td class="list"><nobr><input class="small" type="radio" value="0" name="m_close" '.check_radio($close, 0).'>'.$lang['svc_file']['medal_true_open'].'</nobr></td>
							<td class="list" colSpan="4"><nobr><input class="small" type="radio" value="1" name="m_close" '.check_radio($close, 1).'>'.$lang['svc_file']['medal_true_clos'].'</nobr></td>
						</tr>						
						<tr class="fixed">
							<td class="list_center" colSpan="6"><input onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
						</tr>
					</table>
				</form>
				</center>
				</td>
			</tr>
		</table>
		</center><br>';
		} else {
		redirect();	
		}
	}
	if (svc == "titles"){
		$f = gt("FORUM_ID", $t);
		if (allowed($f, 2) == 1){
			$subject = gt("SUBJECT", $t);
			$status = gt("STATUS", $t);
			$close = gt("CLOSE", $t);
			$forum = gt("FORUM", $t);
			echo'
			<script language="javascript">
				function submit_form(){
					if (title_info.subject.value.length < 5){
						confirm("'.$lang['svc_file']['enter_title_name'].'");
						return;
					}
					if (title_info.forum_id.value <= 0){
						confirm("'.$lang['svc_file']['select_a_forum_from_list'].'");
						return;
					}
					title_info.submit();
				}</script>
			<center>
			<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
			<form name="title_info" method="post" action="index.php?mode=svc&method=update&svc=titles">
			<input type="hidden" name="t" value="'.$t.'">
			<input type="hidden" name="refer" value="'.referer.'">
				<tr class="fixed">
					<td class="optionheader"><nobr>'.$lang['svc_file']['title_name'].' </nobr></td>
					<td class="list" colSpan="3">';
					if (allowed($f, 1) == 1){
						echo'
						<input class="insidetitle" style="WIDTH: 400px" name="subject" value="'.$subject.'">';
					}
					else{
						echo $subject;
						echo'<input type="hidden" name="subject" value="'.$subject.'">';
					}
					echo'
					</td>
				</tr>';
			if (allowed($f, 1) == 1){
				echo'
				<tr class="fixed">
					<td class="optionheader"><nobr>'.$lang['all']['forum'].' </nobr></td>
					<td class="list" colSpan="3">
					<select class="insidetitle" size="1" name="forum_id">
						<option value="0">'.$lang['svc_file']['select_a_forum_name'].'</option>';
						$all_forums = chk_allowed_forums();
						for($x = 0; $x < count($all_forums); $x++){
							$f_id = $all_forums[$x];
							echo'
							<option value="'.$f_id.'" '.check_select($f, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
						}
					echo'
					</select>
					</td>
				</tr>';
			}
			else{
				echo'
				<input type="hidden" name="forum_id" value="'.$f.'">';
			}
				echo'
				<tr class="fixed">
					<td class="optionheader"><nobr>'.$lang['svc_file']['title_close'].' </nobr></td>
					<td class="list"><nobr><input class="small" type="radio" value="0" name="close" '.check_radio($close, 0).'>'.$lang['svc_file']['title_a_open'].'</nobr></td>
					<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="1" name="close" '.check_radio($close, 1).'>'.$lang['svc_file']['title_a_close'].'</nobr></td>
				</tr>';
			if (allowed($f, 1) == 1){
				echo'
				<tr class="fixed">
					<td class="optionheader"><nobr>'.$lang['svc_file']['title_show'].' </nobr></td>
					<td class="list"><nobr><input class="small" type="radio" value="0" name="forum" '.check_radio($forum, 0).'>'.$lang['svc_file']['tile_just_forum'].'</nobr></td>
					<td class="list" colSpan="2"><nobr><input class="small" type="radio" value="1" name="forum" '.check_radio($forum, 1).'>'.$lang['svc_file']['title_all_forums'].'</nobr></td>
				</tr>
				<tr class="fixed">
					<td class="optionheader"><nobr>'.$lang['svc_file']['title_status'].' </nobr></td>
					<td class="list"><nobr><input class="small" type="radio" value="0" name="status" '.check_radio($status, 0).'>'.$lang['svc_file']['pending_mon_admin'].'</nobr></td>
					<td class="list"><nobr><input class="small" type="radio" value="2" name="status" '.check_radio($status, 2).'>'.$lang['svc_file']['title_in_shop'].'</nobr></td>
					<td class="list"><nobr><input class="small" type="radio" value="1" name="status" '.check_radio($status, 1).'>'.$lang['svc_file']['title_true'].'</nobr></td>
				</tr>';
			}
				echo'
				<tr class="fixed">
					<td class="list_center" colSpan="4"><input onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
				</tr>
			</table>
			</center><br>';
		} else {
		redirect();	
		}
	}
	if (svc == "surveys"){
		$s = DBi::$con->real_escape_string(intval(trim($_GET['s'])));
		$f = surveys("FORUM_ID", $s);
		if (allowed($f, 2) == 1) {
			$subject = surveys("SUBJECT", $s);
			$question = surveys("QUESTION", $s);
			$status = surveys("STATUS", $s);
			$secret = surveys("SECRET", $s);
			$days = surveys("DAYS", $s);
			$min_days = surveys("MIN_DAYS", $s);
			$min_posts = surveys("MIN_POSTS", $s);
			$added = surveys("ADDED", $s);
			$start = surveys("START", $s);
			$end = surveys("END", $s);
		?>
		<script language="javascript">
			function submit_form(){
				if (survey_info.subject.value.length < 10){
					confirm(enter_survey_title);
					return;
				}
				if (survey_info.question.value.length < 10){
					confirm(enter_survey_question);
					return;
				}
				if (survey_info.forum_id.value <= 0){
					confirm(not_selected_forum);
					return;
				}
				var regex = /^[0-9]/;
				if (!regex.test(survey_info.min_days.value)){
					confirm(days_is_number);
					return;
				}
				if (!regex.test(survey_info.min_posts.value)){
					confirm(posts_is_number);
					return;
				}
				survey_info.submit();
			}</script>
		<?php
		echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray" border="0">
		<form name="survey_info" method="post" action="index.php?mode=svc&method=update&svc=surveys&type=data">
		<input type="hidden" name="s" value="'.$s.'">
		<input type="hidden" name="days" value="'.$days.'">
		<input type="hidden" name="refer" value="'.$referer.'">
			<tr class="fixed">
				<td class="optionheader" colSpan="3"><nobr>'.$lang['svc_file']['edit_survery'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['survey_title'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 600px" name="subject" value="'.$subject.'"></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['survey_question'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 600px" name="question" value="'.$question.'"></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['add_cat_forum']['num_days'].': </nobr></td>
				<td class="list" colSpan="3">'.$days.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['survey_days_desc'].'ً</font>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['add_more_days'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" name="days_added">';
				for($x = 0; $x <= 30; ++$x){
					echo'
					<option value="'.$x.'">'.$x.'</option>';
				}
				echo'
				</select>&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['add_more_days_desc'].'</font>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['all']['forum'].' </nobr></td>
				<td class="list" colSpan="3">
				<select class="insidetitle" size="1" name="forum_id">
					<option value="0">'.$lang['svc_file']['select_a_forum_name'].'</option>';
					$all_forums = chk_allowed_forums();
					for($x = 0; $x < count($all_forums); $x++){
						$f_id = $all_forums[$x];
						echo'
						<option value="'.$f_id.'" '.check_select($f, $f_id).'';
						echo'>'.forums("SUBJECT", $f_id).'</option>';
					}
				echo'
				</select>
				</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['num_days_it'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 40px" name="min_days" value="'.$min_days.'">&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['num_days_it_desc'].'</font></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['num_posts_it'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 40px" name="min_posts" value="'.$min_posts.'">&nbsp;&nbsp;&nbsp;<font color="red" size="-1">'.$lang['svc_file']['num_post_it_desc'].'</font></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['survey_status'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="status" '.check_radio($status, "1").'>'.$lang['admin']['open'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="status" '.check_radio($status, "0").'>'.$lang['admin']['close'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['svc_file']['survey_secret'].' </nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="0" name="secret" '.check_radio($secret, "0").'>'.$lang['admin']['open'].'</nobr></td>
				<td class="list"><nobr><input class="small" type="radio" value="1" name="secret" '.check_radio($secret, "1").'>'.$lang['svc_function']['secret'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="list_center" colSpan="5"><input onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="JavaScript:history.go(-1);" value="'.$lang['svc_function']['go_back'].'"></td>
			</tr>			<tr class="fixed">
				<td class="optionheader" colSpan="3"><nobr>'.$lang['svc_file']['options_options'].'</nobr></td>
</tr>';
		for($x = 1; $x <= 30; ++$x){
$OoO = mysqli_fetch_array(DBi::$con->query("SELECT * FROM ".prefix."SURVEY_OPTIONS WHERE SURVEY_ID = '$s' AND OPTION_ID = '$x' "));

		echo'
			<tr class="fixed">
				<td class="optionheader"><nobr><font color="yellow">'.$lang['svc_function']['option'].' '.$x.': </font></nobr></td>
				<td class="list" colSpan="3">
					<input class="insidetitle" style="WIDTH: 600px" name="value[]" value="'.$OoO['VALUE'].'"><br>
					<input class="insidetitle" style="WIDTH: 450px" name="other[]" value="'.$OoO['OTHER'].'"><font color="green" size="-1">'.$lang['svc_file']['other_desc'].'</font>
				</td>
			</tr>
			';
		}
		echo '</form>
		</table>
		</center><br>';
		} else {
		redirect();	
		}
	}
}


if ($method == "update"){
if(svc == "groups"){
			$id = DBi::$con->real_escape_string(htmlspecialchars($_POST['groupid']));
			$g_f = groupForum($id);
			if (allowed($g_f, 2) == 1){
			$subject = DBi::$con->real_escape_string(htmlspecialchars($_POST["g_subject"]));
			$url = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_url']));
			$status = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_status']));
			$desc = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_desc']));
			$points = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_points']));
			$login = DBi::$con->real_escape_string(htmlspecialchars($_POST['g_login']));
			if (strlen($subject) < 5){
				$error = $lang['svc_file']['enter_group_name_5'];
			}
			else if (strlen($url) < 3){
				$error = $lang['svc_file']['enter_group_img'];
			}
			else{
				$error = "";
			}
				$g_login_array = array('0','1','2');
				$g_close_array = array('0','1','2');
				if(!in_array($status,$g_close_array)) {
				go_to("index.php");
				}
				if(!in_array($login,$g_login_array)) {
				go_to("index.php");
				}		
			if ($error != ""){
			echo'
			<br>
					<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br><b>'.$lang['all']['error'].'<br>'.$error.'..</b></font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
			}
			if ($error == ""){
				$query = "UPDATE ".prefix."GROUPS SET";
				$query .= " G_NAME = '$subject', ";
				$query .= " G_STATUS = '$status', ";
				$query .= " G_DESC = '$desc', ";
				$query .= " G_IMG = '$url',";
				$query .= " G_POINTS = '$points',";
				$query .= " G_LOGIN = '$login'";
				$query .= " WHERE G_ID = '".$id."'";
				DBi::$con->query($query) or die (DBi::$con->error);
if(allowed($g_f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
				echo'
				<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_edit_group'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL= index.php?mode=svc&method=svc&svc=groups">
                           <a href="index.php?mode=svc&method=svc&svc=groups">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>
				';
			}
			} else {
		redirect();	
		}
			}
	if (svc == "special_medals_points"){
		if ($Mlevel == 4){
			$m = DBi::$con->real_escape_string(htmlspecialchars($_POST['m']));
			$subject = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_subject']));
			$url = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_url']));
			$close = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_close']));
			$special_type = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_special_type']));
			$points = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_points']));
			$days = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_days']));
			
			$m_special_type_array = array('1','2');
			$m_special_points_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60','61','62','63','64','65','66','67','68','69','70','71','72','73','74','75','76','77','78','79','80','81','82','83','84','85','86','87','88','89','90','91','92','93','94','95','96','97','98','99','100','101','102','103','104','105','106','107','108','109','110','111','112','113','114','115','116','117','118','119','120','121','122','123','124','125','126','127','128','129','130','131','132','133','134','135','136','137','138','139','140','141','142','143','144','145','146','147','148','149','150','151','152','153','154','155','156','157','158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','196','197','198','199','200','201','202','203','204','205','206','207','208','209','210','211','212','213','214','215','216','217','218','219','220','221','222','223','224','225','226','227','228','229','230','231','232','233','234','235','236','237','238','239','240','241','242','243','244','245','246','247','248','249','250','251','252','253','254','255','256','257','258','259','260','261','262','263','264','265','266','267','268','269','270','271','272','273','274','275','276','277','278','279','280','281','282','283','284','285','286','287','288','289','290','291','292','293','294','295','296','297','298','299','300','301','302','303','304','305','306','307','308','309','310','311','312','313','314','315','316','317','318','319','320','321','322','323','324','325','326','327','328','329','330','331','332','333','334','335','336','337','338','339','340','341','342','343','344','345','346','347','348','349','350','351','352','353','354','355','356','357','358','359','360','361','362','363','364','365','366','367','368','369','370','371','372','373','374','375','376','377','378','379','380','381','382','383','384','385','386','387','388','389','390','391','392','393','394','395','396','397','398','399','400','401','402','403','404','405','406','407','408','409','410','411','412','413','414','415','416','417','418','419','420','421','422','423','424','425','426','427','428','429','430','431','432','433','434','435','436','437','438','439','440','441','442','443','444','445','446','447','448','449','450','451','452','453','454','455','456','457','458','459','460','461','462','463','464','465','466','467','468','469','470','471','472','473','474','475','476','477','478','479','480','481','482','483','484','485','486','487','488','489','490','491','492','493','494','495','496','497','498','499','500');
			$m_special_days_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60','61','62','63','64','65','66','67','68','69','70','71','72','73','74','75','76','77','78','79','80','81','82','83','84','85','86','87','88','89','90','91','92','93','94','95','96','97','98','99','100','101','102','103','104','105','106','107','108','109','110','111','112','113','114','115','116','117','118','119','120','121','122','123','124','125','126','127','128','129','130','131','132','133','134','135','136','137','138','139','140','141','142','143','144','145','146','147','148','149','150','151','152','153','154','155','156','157','158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','196','197','198','199','200','201','202','203','204','205','206','207','208','209','210','211','212','213','214','215','216','217','218','219','220','221','222','223','224','225','226','227','228','229','230','231','232','233','234','235','236','237','238','239','240','241','242','243','244','245','246','247','248','249','250','251','252','253','254','255','256','257','258','259','260','261','262','263','264','265','266','267','268','269','270','271','272','273','274','275','276','277','278','279','280','281','282','283','284','285','286','287','288','289','290','291','292','293','294','295','296','297','298','299','300','301','302','303','304','305','306','307','308','309','310','311','312','313','314','315','316','317','318','319','320','321','322','323','324','325','326','327','328','329','330','331','332','333','334','335','336','337','338','339','340','341','342','343','344','345','346','347','348','349','350','351','352','353','354','355','356','357','358','359','360','361','362','363','364','365');
			$m_special_close_array = array('0','1');
			
				if(!in_array($special_type,$m_special_type_array)) {
				go_to("index.php");
				}
				if(!in_array($points,$m_special_points_array)) {
				go_to("index.php");
				}
				if(!in_array($days,$m_special_days_array)) {
				go_to("index.php");
				}	
				if(!in_array($close,$m_special_close_array)) {
				go_to("index.php");
				}			
			if ($error == ""){
				DBi::$con->query("UPDATE ".prefix."GLOBAL_MEDALS SET SUBJECT = '$subject', URL = '$url', CLOSE = '$close', POINTS = '$points', DAYS = '$days' WHERE MEDAL_ID = '$m' ") or die (DBi::$con->error);
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");				
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_edit_spcial_medals_points'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL= index.php?mode=svc&method=svc&svc=special_medals_points">
                           <a href="index.php?mode=svc&method=svc&svc=special_medals_points">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
			}

		}
	}
	if (svc == "medals"){
		$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['f']));
		if (allowed($f, 2) == 1){
			$m = DBi::$con->real_escape_string(htmlspecialchars($_POST['m']));
			$subject = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_subject']));
			$url = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_url']));
			$close = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_close']));
			$points = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_points']));
			$give = DBi::$con->real_escape_string(htmlspecialchars($_POST['m_give']));
			if(allowed($f, 1) == 1) {
			$status = ", STATUS = '1'";
			} else {
			$status = ", STATUS = '0'";	
			}	
					$m_points_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40');
					$m_give_array = array('0','1','2');
					$m_close_array = array('0','1');
				if(allowed($f, 1) == 1) {
				if(!in_array($points,$m_points_array)) {
				go_to("index.php");
				}
				}
				if(!in_array($close,$m_close_array)) {
				go_to("index.php");
				}
				if(!in_array($give,$m_give_array)) {
				go_to("index.php");
				}				
			if ($error == ""){
				DBi::$con->query("UPDATE ".prefix."GLOBAL_MEDALS SET SUBJECT = '$subject', URL = '$url', CLOSE = '$close', GIVE = '$give', POINTS = '$points'".$status." WHERE MEDAL_ID = '$m' ") or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_edit_medals'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL= index.php?mode=svc&method=svc&svc=medals">
                           <a href="index.php?mode=svc&method=svc&svc=medals">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
			}

		} else {
		redirect();	
		}
	}	
	if (svc == "titles"){
		$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));
		if (allowed($f, 2) == 1){
			$t = DBi::$con->real_escape_string(htmlspecialchars($_POST['t']));
			$subject = DBi::$con->real_escape_string(htmlspecialchars($_POST['subject']));
			$close = DBi::$con->real_escape_string(htmlspecialchars($_POST['close']));
			$forum = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum']));
			$status = DBi::$con->real_escape_string(htmlspecialchars($_POST['status']));
			$refer = DBi::$con->real_escape_string(htmlspecialchars($_POST['refer']));
							$t_close_array = array('0','1');
				$t_show_array = array('0','1');
				if(mlv > 2) {
				$t_status_array = array('0','1','2');
				} else {
				$t_status_array = array('0');
				}
				if(!in_array($close,$t_close_array)) {
				go_to("index.php");
				}
				if(!in_array($forum,$t_show_array)) {
				go_to("index.php");
				}
				if(!in_array($status,$t_status_array)) {
				go_to("index.php");
				}	
			if ($error == ""){
				$sql = "UPDATE ".prefix."GLOBAL_TITLES SET ";
				//if (allowed($f, 1) == 1 AND mlv > 2){
					$sql = $sql."CLOSE = '$close', ";
					$sql = $sql."SUBJECT = '$subject', ";
					$sql = $sql."FORUM = '$forum', ";
					$sql = $sql."STATUS = '$status', ";
					$sql = $sql."FORUM_ID = '$f' ";
				//}
				//else{
				//	$sql = $sql."CLOSE = '$close' ";
				//}
				$sql = $sql."WHERE TITLE_ID = '$t' ";
				DBi::$con->query($sql) or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_edit_titles'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$referer.'">
                           <a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
			}

		} else {
		redirect();	
		}
	}
	if (svc == "surveys"){
	if ($type == "data") {		
	$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));		
	if (allowed($f, 2) == 1){			
	$s = DBi::$con->real_escape_string(htmlspecialchars($_POST['s']));			
	$subject = DBi::$con->real_escape_string(HtmlSpecialchars(DBi::$con->real_escape_string($_POST['subject'])));			
	$question = DBi::$con->real_escape_string(HtmlSpecialchars(DBi::$con->real_escape_string($_POST['question'])));			
	$status =  DBi::$con->real_escape_string(HtmlSpecialchars($_POST['status']));			
	$secret =  DBi::$con->real_escape_string(HtmlSpecialchars($_POST['secret']));			
	$days =  DBi::$con->real_escape_string(HtmlSpecialchars($_POST['days']));			
	$days_added =  DBi::$con->real_escape_string(HtmlSpecialchars($_POST['days_added']));			
	$min_days =  DBi::$con->real_escape_string(HtmlSpecialchars($_POST['min_days']));			
	$min_posts =  DBi::$con->real_escape_string(HtmlSpecialchars($_POST['min_posts']));			
	$refer =  DBi::$con->real_escape_string(HtmlSpecialchars($_POST['refer']));			
	$total_days = $days+$days_added;			
	$all_days = $total_days*60*60*24;			
	$start = surveys("START", $s);
			$end = $start + $all_days;
		                  $value = $_POST['value'];
		                  $other = $_POST['other'];
						  

			$s_days_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30');
			$s_status_array = array('0','1');
			$s_secret_array = array('0','1');
			if(!in_array($days,$s_days_array)) {
				go_to("index.php");
			}	
			if(!in_array($status,$s_status_array)) {
				go_to("index.php");
			}	
			if(!in_array($secret,$s_secret_array)) {
				go_to("index.php");
			}
			if(svc_survey_value($value) > 30) {
				go_to("index.php");
			}						  
			if ($error == ""){
				$sql = "UPDATE ".prefix."SURVEYS SET ";
				$sql .= "FORUM_ID = '$f', ";
				$sql .= "SUBJECT = '$subject', ";
				$sql .= "QUESTION = '$question', ";
				$sql .= "STATUS = '$status', ";
				$sql .= "SECRET = '$secret', ";
				$sql .= "DAYS = '$total_days', ";
				$sql .= "MIN_DAYS = '$min_days', ";
				$sql .= "MIN_POSTS = '$min_posts', ";
				$sql .= "END = '$end' ";
				$sql .= "WHERE SURVEY_ID = '$s' ";
				DBi::$con->query($sql) or die (DBi::$con->error);


	$i = 0;
				for ($x = 1;$x < 30; ++$x){
$check = mysqli_fetch_array(DBi::$con->query("SELECT * FROM ".prefix."SURVEY_OPTIONS WHERE OPTION_ID = '$x' AND SURVEY_ID = '$s' "));
if($check){
DBi::$con->query("UPDATE ".prefix."SURVEY_OPTIONS SET VALUE = '$value[$i]',OTHER = '$other[$i]' WHERE SURVEY_ID = '$s' AND OPTION_ID = '$x' ")or die (DBi::$con->error);
}else{
if($value[$i] != ""){
DBi::$con->query("INSERT INTO ".prefix."SURVEY_OPTIONS SET VALUE = '$value[$i]',OTHER = '$other[$i]',OPTION_ID = '$x',SURVEY_ID = '$s' ");
}
}

$i++;
				}

if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_edit_survey'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$referer.'">
                           <a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';

			}

		} else {
		redirect();	
		}
	    }
	}
	if (svc == "edits"){
		if ($type == "t") {
			$t = edits("TOPIC_ID", $id);
			$f = topics("FORUM_ID", $t);
			if (allowed($f, 2) == 1) {
				$old_subject = edits("OLD_SUBJECT", $id);
				$old_message = edits("OLD_MESSAGE", $id);
					$sql = "UPDATE " . $Prefix . "TOPICS SET ";
					$sql .= "T_SUBJECT = '$old_subject', ";
					$sql .= "T_MESSAGE = '$old_message' ";
					$sql .= "WHERE TOPIC_ID = '$t' ";
					DBi::$con->query($sql, $connection) or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}					
				echo'<br>
				<center>
				<table width="99%" border="1">
					<tr class="normal">
						<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_edit_replys'].'</b></font><br><br>
							<meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&svc=edits&t='.$t.'">
							<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
						</td>
					</tr>
				</table>
				</center>';
			} else {
		redirect();	
		}
		}
		if ($type == "r") {
			$r = edits("REPLY_ID", $id);
			$f = replies("FORUM_ID", $r);
			if (allowed($f, 2) == 1) {
				$old_message = edits("OLD_MESSAGE", $id);
					$sql = "UPDATE " . $Prefix . "REPLY SET ";
					$sql .= "R_MESSAGE = '$old_message' ";
					$sql .= "WHERE REPLY_ID = '$r' ";
					DBi::$con->query($sql, $connection) or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}					
				echo'<br>
				<center>
				<table width="99%" border="1">
					<tr class="normal">
						<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_edit_replys'].'</b></font><br><br>
							<meta http-equiv="Refresh" content="1; URL=index.php?mode=svc&svc=edits&r='.$r.'">
							<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
						</td>
					</tr>
				</table>
				</center>';
			} else {
		redirect();	
		}
		}
	}
}

if ($method == "app"){
	if(svc == "special_medals_points") {
		if ($type == "global"){
			if($Mlevel != 4) {
				redirect();
			}
			$app = $_POST['s_m_p_app'];
			$x = 0;
			while($x < count($app)){
				$f = gm("FORUM_ID", $app[$x]);
				if($Mlevel != 4) {
				redirect();
				}
				if ($Mlevel == 4){
					DBi::$con->query("UPDATE ".prefix."GLOBAL_MEDALS SET STATUS = '1' WHERE MEDAL_ID = '$app[$x]' ") or die (DBi::$con->error);
				}
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
			++$x;
			}
			
			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_approve_special_medals_points'].'</b></font><br><br>
						<meta http-equiv="Refresh" content="0; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}
		if ($type == "awarded"){
						if($Mlevel < 2) {
				redirect();
			}
			$m_app = $_POST['s_m_p_app'];
			$status = $_POST['status'];
			if ($status == "app"){
				$num = 1;
				$msg_text = $lang['svc_file']['done_approve_special_medals_points'];
			}
			if ($status == "ref"){
				$num = 2;
				$msg_text = $lang['svc_file']['done_refused_special_medals_points'];
			}
			$x = 0;
			while($x < count($m_app)){
				$m = medals("MEMBER_ID", $m_app[$x]);
				$f = medals("FORUM_ID", $m_app[$x]);
				if(allowed($f, 2) == 1) {
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
				}
				if ($Mlevel == 4){
					DBi::$con->query("UPDATE ".prefix."MEDALS SET STATUS = '$num' WHERE MEDAL_ID = '$m_app[$x]' ") or die (DBi::$con->error);
					if ($num == 1){
						DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MEDAL = '".chk_member_last_medal($m)."', M_POINTS = '".member_all_points($m)."' WHERE MEMBER_ID = '$m' ") or die (DBi::$con->error);
					}
				}
			++$x;
			}
			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_text.'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}		
	}
	if (svc == "groups"){
		if ($type == "global"){
			$app = $_POST['g_app'];
			$x = 0;
			while($x < count($app)){
				$f = groups("FORUM", $app[$x]);
if(allowed($f, 1) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
				if (allowed($f, 1) == 0){
					redirect();
				}
				if (allowed($f, 1) == 1){
					DBi::$con->query("UPDATE ".prefix."GROUPS SET G_MOD = '2' WHERE G_ID = '$app[$x]' ") or die (DBi::$con->error);
			}
			++$x;
			}
			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_approve_groups'].'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}
	}
	if (svc == "medals"){
		if ($type == "global"){
			$app = $_POST['m_app'];
			$x = 0;
			while($x < count($app)){
				$f = gm("FORUM_ID", $app[$x]);
if(allowed($f, 1) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
				if (allowed($f, 1) == 0){
					redirect();
				}				
				if (allowed($f, 1) == 1){
					DBi::$con->query("UPDATE ".prefix."GLOBAL_MEDALS SET STATUS = '1' WHERE MEDAL_ID = '$app[$x]' ") or die (DBi::$con->error);
				}
			++$x;
			}
			
			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_approve_medals'].'</b></font><br><br>
						<meta http-equiv="Refresh" content="0; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}
		
				if ($type == "awarded_mod"){
			if($Mlevel < 2) {
			redirect();	
			}
			$m_app = $_POST['mod_m_app'];
			$status = $_POST['status'];
			if ($status == "app"){
				$num = 1;
				$msg_text = $lang['svc_file']['done_approve_medals'];
			}
			if ($status == "ref"){
				$num = 2;
				$msg_text = $lang['svc_file']['done_refused_medals'];
			}
			$x = 0;
			while($x < count($m_app)){
				$f = medals("FORUM_ID", $m_app[$x]);
				$m = medals("MEMBER_ID", $m_app[$x]);
				$added = medals("ADDED", $m_app[$x]);
				if($Mlevel == 2 && $added == $DBMemberID) {
				redirect();	
				}
				if (allowed($f, 2) == 0){
					redirect();
				}
				if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
				if (allowed($f, 2) == 1 && ($Mlevel == 4 or $Mlevel == 3 or ($Mlevel == 2 && $added != $DBMemberID))){
					DBi::$con->query("UPDATE ".prefix."MEDALS SET STATUS = '$num' WHERE MEDAL_ID = '$m_app[$x]' ") or die (DBi::$con->error);
					if ($num == 1){
						DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MEDAL = '".chk_member_last_medal($m)."', M_POINTS = '".member_all_points($m)."' WHERE MEMBER_ID = '$m' ") or die (DBi::$con->error);
					}
				}
			++$x;
			}
			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_text.'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}
		
		
						if ($type == "awarded_admin"){
			if($Mlevel != 4) {
			redirect();	
			}
			$m_app = $_POST['admin_m_app'];
			$status = $_POST['status'];
			if ($status == "app"){
				$num = 1;
				$msg_text = $lang['svc_file']['done_approve_medals'];
			}
			if ($status == "ref"){
				$num = 2;
				$msg_text = $lang['svc_file']['done_refused_medals'];
			}
			$x = 0;
			while($x < count($m_app)){
				$f = medals("FORUM_ID", $m_app[$x]);
				$m = medals("MEMBER_ID", $m_app[$x]);
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
			if($Mlevel != 4) {
			redirect();	
			}
				if ($Mlevel == 4){
					DBi::$con->query("UPDATE ".prefix."MEDALS SET STATUS = '$num' WHERE MEDAL_ID = '$m_app[$x]' ") or die (DBi::$con->error);
					if ($num == 1){
						DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MEDAL = '".chk_member_last_medal($m)."', M_POINTS = '".member_all_points($m)."' WHERE MEMBER_ID = '$m' ") or die (DBi::$con->error);
					}
				}
			++$x;
			}
			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_text.'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}
		
		
		if ($type == "awarded"){
			if($Mlevel < 2) {
			redirect();	
			}
			$m_app = $_POST['m_app'];
			$status = $_POST['status'];
			if ($status == "app"){
				$num = 1;
				$msg_text = $lang['svc_file']['done_approve_medals'];
			}
			if ($status == "ref"){
				$num = 2;
				$msg_text = $lang['svc_file']['done_refused_medals'];
			}
			$x = 0;
			while($x < count($m_app)){
				$f = medals("FORUM_ID", $m_app[$x]);
				$m = medals("MEMBER_ID", $m_app[$x]);
				if (allowed($f, 2) == 0){
					redirect();
				}
if(allowed($f, 1) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
				if (allowed($f, 1) == 1){
					DBi::$con->query("UPDATE ".prefix."MEDALS SET STATUS = '$num' WHERE MEDAL_ID = '$m_app[$x]' ") or die (DBi::$con->error);
					if ($num == 1){
						DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MEDAL = '".chk_member_last_medal($m)."', M_POINTS = '".member_all_points($m)."' WHERE MEMBER_ID = '$m' ") or die (DBi::$con->error);
					}
				}
			++$x;
			}
			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_text.'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}
	}
	if (svc == "titles"){
		if ($type == "global"){
			$app = $_POST['t_app'];
			$x = 0;
			while($x < count($app)){
				$f = gt("FORUM_ID", $app[$x]);
				if (allowed($f, 1) == 0){
					redirect();
				}
				if($deputy == 1) {
				redirect();	
				}
				if(allowed($f, 1) == 1 && $deputy == 1) {
				redirect();	
				}
if(allowed($f, 1) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}				
				if (allowed($f, 1) == 1 && $deputy == 0){
					DBi::$con->query("UPDATE ".prefix."GLOBAL_TITLES SET STATUS = '1' WHERE TITLE_ID = '$app[$x]' ") or die (DBi::$con->error);
				}
			++$x;
			}
			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_approve_titles'].'</b></font><br><br>
						<meta http-equiv="Refresh" content="1; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}
	}
	if (svc == "mon"){
		if ($type == "details"){
			svc_details_mon($id);
		}
		if ($type == "approve") {

		$monitor_notes = DBi::$con->real_escape_string(htmlspecialchars($_POST["monitor_notes"]));
		$details_type = DBi::$con->real_escape_string(htmlspecialchars($_POST["details_type"]));
		$member_id = moderation("MEMBERID", $id);
		$forum_id = moderation("FORUMID", $id);
		$topic_id = moderation("TOPICID", $id);
		$reply_id = moderation("REPLYID", $id);
		$pm = moderation("PM", $id);
		$ihdaa = moderation("IHDAA", $id);
		$added = moderation("ADDED", $id);
		$type = moderation("TYPE", $id);
		$raison = moderation("RAISON", $id);
		$moderator_notes = moderation("NOTES", $id);
		$pm_mid = "-".$forum_id;
		$date = time();
		
		if ($type == "7" AND $details_type == "") {
		    $error = $lang['svc_file']['dont_choose_details_type_to_hide'];
		}
		if ($reply_id == "0") {
		    $rid = "";
		}
		else {
		    $rid = "&r=".$reply_id;
		}

		switch ($type) {
		     case "2":
		          $txtSubject = $lang['svc_file']['moderation_2_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_2_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_function']['moderation_2'];
		     break;
		     case "3":
		          $txtSubject = "".$lang['svc_file']['moderation_3_subject']." ".forum_name($forum_id);
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_3_message_part1'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['moderation_11_message_part2'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_function']['moderation_3'];
		     break;
		     case "4":
		          $txtSubject = $lang['svc_file']['moderation_4_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_4_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_function']['moderation_4'];
		     break;
		     case "5":
			  $TYPE = $lang['svc_function']['moderation_5'];
		     break;
		     case "6":
		          $txtSubject = $lang['svc_file']['moderation_6_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_6_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_function']['moderation_6'];
		     break;
		     case "7":
		          $txtSubject = $lang['svc_file']['moderation_7_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_7_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_file']['moderation_num_7'];
		     break;
		     case "8":
		          $txtSubject = $lang['svc_file']['moderation_8_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_8_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_function']['moderation_8'];
		     break;
		     case "9":
		          $txtSubject = $lang['svc_file']['moderation_9_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_9_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_function']['moderation_9'];
		     break;
		     case "10":
		          $txtSubject = $lang['svc_file']['moderation_10_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_10_message_part1'].' <br><br>'.$lang['svc_file']['moderation_11_message_part2'].' </font><br><font size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=pm&mail=msg&msg='.$pm.'">'.$lang['svc_function']['show_why_request_msg'].'</a><br></font>';
			  $TYPE = $lang['svc_file']['moderation_num_10'];
		     break;
		   case "11":
		          $txtSubject = "".$lang['svc_file']['moderation_11_subject']." ".forum_name($forum_id);
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_11_message_part1'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['moderation_11_message_part2'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_file']['moderation_num_11'];
		     break;
		   case "12":
		   $txtSubject = $lang['svc_file']['moderation_12_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_12_message_part1'].' </font><br><font size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=what_add&method=forum&type=show_ihdaa&f='.$ihdaa.'">'.$lang['svc_function']['show_why_request_ihdaa'].'</a><br></font>';
			  $TYPE = $lang['svc_file']['moderation_num_12'];
		     break;

		}

		$moderatorPM_subject = "".$lang['svc_file']['accepted_request']." - ".$TYPE." - ".$lang['members']['members'].": ".member_name($member_id);
		$moderatorPM_message = '
		<table cellSpacing="1" cellPadding="1" width="50%">
			<tr>
				<td class="stats_t" colspan="2"><font size="+2" color="yellow">'.$lang['svc_file']['accepted_request'].': '.$TYPE.'</font></td>
			</tr>
			<tr>
				<td class="stats_g" width="50%">'.$lang['members']['members'].'</td>
				<td class="stats_p">'.link_profile(member_name($member_id), $member_id).'</td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_type'].'</td>
				<td class="stats_p"><font color="red">'.$TYPE.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_why'].'</td>
				<td class="stats_p"><font color="red">'.$raison.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mod_note'].'</td>
				<td class="stats_p"><font color="red">'.$moderator_notes.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_note'].'</td>
				<td class="stats_p"><font color="red">'.$monitor_notes.'</font></td>
			</tr>			
		</table>';
		
		
		$change_type = DBi::$con->real_escape_string(htmlspecialchars($_POST['change_type']));		
		if($change_type != 0) {
		$type = $change_type;	
		DBi::$con->query("UPDATE ".prefix."MODERATION SET M_TYPE = '$change_type' WHERE MODERATION_ID = '$id'");	
		}		
if($change_type != 0) {
if($change_type == 1) {
$change_type_name = $lang['svc_function']['moderation_1'];	
}
if($change_type == 2) {
$change_type_name = $lang['svc_function']['moderation_2'];	
}
if($change_type == 3) {
$change_type_name = $lang['svc_function']['moderation_3'];	
}
if($change_type == 4) {
$change_type_name = $lang['svc_function']['moderation_4'];	
}
if($change_type == 5) {
$change_type_name = $lang['svc_function']['moderation_5'];	
}
if($change_type == 7) {
$change_type_name = $lang['svc_function']['moderation_7'];	
}
if($change_type == 8) {
$change_type_name = $lang['svc_function']['moderation_8'];	
}
if($change_type == 9) {
$change_type_name = $lang['svc_function']['moderation_9'];	
}
if($change_type == 10) {
$change_type_name = $lang['svc_function']['moderation_10'];	
}
if($change_type == 11) {
$change_type_name = $lang['svc_function']['moderation_11'];	
}
if($change_type == 12) {
$change_type_name = $lang['svc_function']['moderation_12'];	
}
		$moderatorPM_subject_change = "".$lang['svc_function']['change_request']." - ".$TYPE." - ".$lang['members']['members'].": ".member_name($member_id);
		$moderatorPM_message_change = '
		<table cellSpacing="1" cellPadding="1" width="50%">
			<tr>
				<td class="stats_t" colspan="2"><font size="+2" color="yellow">'.$lang['svc_function']['change_request'].': '.$TYPE.'</font></td>
			</tr>
			<tr>
				<td class="stats_g" width="50%">'.$lang['members']['members'].'</td>
				<td class="stats_p">'.link_profile(member_name($member_id), $member_id).'</td>
			</tr>			
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_type'].'</td>
				<td class="stats_p"><font color="red">'.$TYPE.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_why'].'</td>
				<td class="stats_p"><font color="red">'.$raison.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mod_note'].'</td>
				<td class="stats_p"><font color="red">'.$moderator_notes.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_function']['the_req'].'</td>
				<td class="stats_p"><font color="red">'.$change_type_name.'</font></td>
			</tr>			
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_note'].'</td>
				<td class="stats_p"><font color="red">'.$monitor_notes.'</font></td>
			</tr>	
		</table>';			
}


		
		
		
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MODERATION WHERE M_MEMBERID = '$member_id' AND M_TYPE = '$type' AND M_STATUS = '0' AND M_FORUMID = '$forum_id' AND (M_TOPICID = '$topic_id' OR M_REPLYID = '$reply_id' OR M_PM = '$pm' OR M_IHDAA = '$ihdaa') AND M_TWOREQUESTS = '1'");
		$num = mysqli_num_rows($sql);
		if($num > 0) {
		if($type == 2) {
		$the_notes = $lang['svc_file']['moderation_cancel_2'];
		}		
		if($type == 3) {
		$the_notes = $lang['svc_file']['moderation_cancel_3'];
		}
		if($type == 4) {
		$the_notes = $lang['svc_file']['moderation_cancel_4'];
		}
		if($type == 5) {
		$the_notes = $lang['svc_file']['moderation_cancel_5'];
		}
		if($type == 6) {
		$the_notes = $lang['svc_file']['moderation_cancel_6'];
		}
		if($type == 7) {
		$the_notes = $lang['svc_file']['moderation_cancel_7'];
		}
		if($type == 8) {
		$the_notes = $lang['svc_file']['moderation_cancel_8'];
		}
		if($type == 9) {
		$the_notes = $lang['svc_file']['moderation_cancel_9'];
		}
		if($type == 10) {
		$the_notes = $lang['svc_file']['moderation_cancel_10'];
		}
		if($type == 11) {
		$the_notes = $lang['svc_file']['moderation_cancel_11'];
		}
		if($type == 12) {
		$the_notes = $lang['svc_file']['moderation_cancel_12'];
		}
		$moderatorPM_subject_delete = "".$lang['svc_file']['accepted_request']." ".$lang['svc_file']['two_requests']." - ".$TYPE." - ".$lang['members']['members'].": ".member_name($member_id);
		$moderatorPM_message_delete = '
		<table cellSpacing="1" cellPadding="1" width="50%">
			<tr>
				<td class="stats_t" colspan="2"><font size="+2" color="yellow">'.$lang['svc_file']['accepted_request'].': '.$TYPE.' - ('.$lang['svc_file']['two_requests'].')</font></td>
			</tr>
			<tr>
				<td class="stats_g" width="50%">'.$lang['members']['members'].'</td>
				<td class="stats_p">'.link_profile(member_name($member_id), $member_id).'</td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_note'].'</td>
				<td class="stats_p"><font color="red">'.$the_notes.'</font></td>
			</tr>			
		</table>';			
		}

		if ($error != "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$error.'..</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
		}
		$SubApprove = $_POST['SubApprove'];
		$SubRefused = $_POST['SubRefused'];
		if ($error == "") {
		if($SubRefused != "") {
					$text = $lang['svc_file']['done_refused_request'];
		$moderatorPM_subject_r = "".$lang['svc_function']['refuse_a_confrm_reqmon']." - ".$TYPE." - ".$lang['members']['members'].": ".member_name($member_id);
		$moderatorPM_message_r = '
		<table cellSpacing="1" cellPadding="1" width="50%">
			<tr>
				<td class="stats_t" colspan="2"><font size="+2" color="yellow">'.$lang['svc_function']['refuse_a_confrm_reqmon'].': '.$TYPE.'</font></td>
			</tr>
			<tr>
				<td class="stats_g" width="50%">'.$lang['members']['members'].'</td>
				<td class="stats_p">'.link_profile(member_name($member_id), $member_id).'</td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_type'].'</td>
				<td class="stats_p"><font color="red">'.$TYPE.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_why'].'</td>
				<td class="stats_p"><font color="red">'.$raison.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mod_note'].'</td>
				<td class="stats_p"><font color="red">'.$moderator_notes.'</font></td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_note'].'</td>
				<td class="stats_p"><font color="red">'.$monitor_notes.'</font></td>
			</tr>			
		</table>';
		
		
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MODERATION WHERE M_MEMBERID = '$member_id' AND M_TYPE = '$type' AND M_STATUS = '0' AND M_FORUMID = '$forum_id' AND (M_TOPICID = '$topic_id' OR M_REPLYID = '$reply_id' OR M_PM = '$pm' OR M_IHDAA = '$ihdaa') AND M_TWOREQUESTS = '1'");
		$num = mysqli_num_rows($sql);
		if($num > 0) {
		if($type == 2) {
		$the_notes = $lang['svc_file']['moderation_cancel_2'];
		}		
		if($type == 3) {
		$the_notes = $lang['svc_file']['moderation_cancel_3'];
		}
		if($type == 4) {
		$the_notes = $lang['svc_file']['moderation_cancel_4'];
		}
		if($type == 5) {
		$the_notes = $lang['svc_file']['moderation_cancel_5'];
		}
		if($type == 6) {
		$the_notes = $lang['svc_file']['moderation_cancel_6'];
		}
		if($type == 7) {
		$the_notes = $lang['svc_file']['moderation_cancel_7'];
		}
		if($type == 8) {
		$the_notes = $lang['svc_file']['moderation_cancel_8'];
		}
		if($type == 9) {
		$the_notes = $lang['svc_file']['moderation_cancel_9'];
		}
		if($type == 10) {
		$the_notes = $lang['svc_file']['moderation_cancel_10'];
		}
		if($type == 11) {
		$the_notes = $lang['svc_file']['moderation_cancel_11'];
		}
		if($type == 12) {
		$the_notes = $lang['svc_file']['moderation_cancel_12'];
		}
		$moderatorPM_subject_delete_r = "".$lang['svc_function']['refuse_a_confrm_reqmon']." ".$lang['svc_file']['two_requests']." - ".$TYPE." - ".$lang['members']['members'].": ".member_name($member_id);
		$moderatorPM_message_delete_r = '
		<table cellSpacing="1" cellPadding="1" width="50%">
			<tr>
				<td class="stats_t" colspan="2"><font size="+2" color="yellow">'.$lang['svc_function']['refuse_a_confrm_reqmon'].': '.$TYPE.' - ('.$lang['svc_file']['two_requests'].')</font></td>
			</tr>
			<tr>
				<td class="stats_g" width="50%">'.$lang['members']['members'].'</td>
				<td class="stats_p">'.link_profile(member_name($member_id), $member_id).'</td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_note'].'</td>
				<td class="stats_p"><font color="red">'.$the_notes.'</font></td>
			</tr>			
		</table>';			
		}	
		
		if(allowed($forum_id, 1) == 0 && $forum_id != 0) {
		redirect();	
		}
		if($type == 5 && $deputy == 1) {
		redirect();	
		}
		if(allowed($forum_id, 1) == 1 or $forum_id == 0) {
		if($num > 0) {
		DBi::$con->query("DELETE FROM ".prefix."MODERATION WHERE M_MEMBERID = '$member_id' AND M_TYPE = '$type' AND M_STATUS = '0' AND M_FORUMID = '$forum_id' AND (M_TOPICID = '$topic_id' OR M_REPLYID = '$reply_id' OR M_PM = '$pm' OR M_IHDAA = '$ihdaa') AND M_TWOREQUESTS = '1'");	
	
			// SEND PM TO MODERATOR WHO ADDED THE MODERATION
		send_pm($DBMemberID, $added, $moderatorPM_subject_delete_r, $moderatorPM_message_delete_r, $date);
		}
		// SEND PM TO MODERATOR WHO ADDED THE MODERATION
		send_pm($DBMemberID, $added, $moderatorPM_subject_r, $moderatorPM_message_r, $date);

			DBi::$con->query("UPDATE ".prefix."MODERATION SET M_STATUS = '2', M_REFUSED = '$DBMemberID' WHERE MODERATION_ID = '$id' ") or die (DBi::$con->error);
			 

			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br>'.$text.'</font><br><br>
						<meta http-equiv="Refresh" content="2; URL=index.php?mode=svc&method=svc&svc=mon&show=mon_pending">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}			
		}	
		if($SubApprove != "") {	
				$text = $lang['svc_file']['done_approve_this_request'];

		if(allowed($forum_id, 1) == 0 && $forum_id != 0) {
		redirect();	
		}
		if($type == 5 && $deputy == 1) {
		redirect();	
		}
		if(allowed($forum_id, 1) == 1 or $forum_id == 0) {
		if($num > 0) {
		DBi::$con->query("DELETE FROM ".prefix."MODERATION WHERE M_MEMBERID = '$member_id' AND M_TYPE = '$type' AND M_STATUS = '0' AND M_FORUMID = '$forum_id' AND (M_TOPICID = '$topic_id' OR M_REPLYID = '$reply_id' OR M_PM = '$pm' OR M_IHDAA = '$ihdaa') AND M_TWOREQUESTS = '1'");	
	
			// SEND PM TO MODERATOR WHO ADDED THE MODERATION
		send_pm($DBMemberID, $added, $moderatorPM_subject_delete, $moderatorPM_message_delete, $date);
		}
		if($type == 5) {
		$sql_1 = DBi::$con->query("SELECT * FROM ".prefix."MODERATION WHERE M_MEMBERID = '$member_id' AND (M_TYPE = '3' OR M_TYPE = '4') AND M_STATUS != '4'");
		$num_1 = mysqli_num_rows($sql_1);
		if($num_1 > 0) {
		$moderatorPM_subject_it_cancel = "".$lang['svc_file']['accepted_request']." ".$lang['svc_file']['two_requests']." - ".$TYPE." - ".$lang['members']['members'].": ".member_name($member_id);
		$moderatorPM_message_it_cancel = '
		<table cellSpacing="1" cellPadding="1" width="50%">
			<tr>
				<td class="stats_t" colspan="2"><font size="+2" color="yellow">'.$lang['svc_file']['accepted_request'].': '.$TYPE.' ('.$lang['svc_file']['two_requests'].')</font></td>
			</tr>
			<tr>
				<td class="stats_g" width="50%">'.$lang['members']['members'].'</td>
				<td class="stats_p">'.link_profile(member_name($member_id), $member_id).'</td>
			</tr>
			<tr>
				<td class="stats_g">'.$lang['svc_file']['the_mon_note'].'</td>
				<td class="stats_p"><font color="red">'.$lang['svc_file']['moderation_cancel_5'].'</font></td>
			</tr>			
		</table>';					
		DBi::$con->query("UPDATE ".prefix."MODERATION SET M_STATUS = '4', M_REFUSED = '$DBMemberID' WHERE M_MEMBERID = '$member_id' AND (M_TYPE = '3' OR M_TYPE = '4')");
		// SEND PM TO MODERATOR WHO ADDED THE MODERATION
		send_pm($DBMemberID, $added, $moderatorPM_subject_it_cancel, $moderatorPM_message_it_cancel, $date);	
		}		
		}
		if($change_type == 0) {
		// SEND PM TO MODERATOR WHO ADDED THE MODERATION
		send_pm($DBMemberID, $added, $moderatorPM_subject, $moderatorPM_message, $date);
		}
		if($change_type != 0) {
		// SEND PM TO MODERATOR WHO ADDED THE MODERATION
		send_pm($DBMemberID, $added, $moderatorPM_subject_change, $moderatorPM_message_change, $date);
		}		
		if ($type != 5) {
		// SEND PM TO MEMBER ABOUT THE RAISON OF THE MODERATION
		send_pm($pm_mid, $member_id, $txtSubject, $txtMessage, $date);
		}
	
		if ($type == 5) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_STATUS = '0' ";
			 $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		else if ($type == 7) {

		  if ($details_type == 1) {
			$hide = "M_HIDE_PHOTO = '1' ";
		  }
		  else if ($details_type == 2) {
			$hide = "M_HIDE_SIG = '1' ";
		  }
		  else if ($details_type == 3) {
			$hide = "M_HIDE_DETAILS = '1' ";
		  }

		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= $hide;
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		else if ($type == 8) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_HIDE_POSTS = '1' ";
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		else if ($type == 9) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_HIDE_PM = '1' ";
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}

		else if ($type == 10) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_USE_PM = '1' ";
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		else if ($type == 12) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_IHDAA = '1' ";
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		     $up = "UPDATE " . $Prefix . "MODERATION SET ";
		     $up .= "M_STATUS = '1', ";
			 if($monitor_notes != "") {
		     $up .= "M_MONITOR_NOTES = '$monitor_notes', ";
			 }
		     $up .= "M_EXECUTE = '$added', ";
		     $up .= "M_DATEAPP = '$date' ";
		     $up .= "WHERE MODERATION_ID = '$id' ";
		     DBi::$con->query($up, $connection) or die (DBi::$con->error);
			 
if(allowed($forum_id, 1) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}			 

			echo'<br>
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br>'.$text.'</font><br><br>
						<meta http-equiv="Refresh" content="2; URL='.$referer.'">
						<a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					</td>
				</tr>
			</table>
			</center>';
		}
		}
		} // FOR ERROR
		}
	}
}

if ($method == "trash"){
	if (svc == "titles"){
		$gt_id = titles("GT_ID", $t);
		$m = titles("MEMBER_ID", $t);
		$f = gt("FORUM_ID", $gt_id);
		if (allowed($f, 2) == 1){
			DBi::$con->query("UPDATE ".prefix."TITLES SET STATUS = '0' WHERE TITLE_ID = '$t' ") or die (DBi::$con->error);
			$sql = "INSERT INTO ".prefix."USED_TITLES (ID, TITLE_ID, MEMBER_ID, STATUS, ADDED, DATE) VALUES (NULL, ";
			$sql .= " '$gt_id', ";
			$sql .= " '$m', ";
			$sql .= " '0', ";
			$sql .= " '$DBMemberID', ";
			$sql .= " '".time()."') ";
			DBi::$con->query($sql) or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
			header("Location: ".$referer."");

		} else {
		redirect();	
		}
	}	
	if (svc == "prv"){
		$t = topic_members("TOPIC_ID", $id);
		$f = topics("FORUM_ID", $t);
		if (allowed($f, 2) == 1){
			DBi::$con->query("DELETE FROM ".prefix."TOPIC_MEMBERS WHERE TM_ID = '$id' ") or die (DBi::$con->error);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
			header("Location: ".$referer."");

		} else {
		redirect();	
		}
	}
	if (svc == "mon"){
		$f = moderation("FORUMID", $id);
		if (allowed($f, 2) == 1){
		    if ($type == "delete") {
			DBi::$con->query("DELETE FROM ".prefix."MODERATION WHERE MODERATION_ID = '$id' ") or die (DBi::$con->error);
			$text = $lang['others']['request_deleted'];
		    }
		    else if ($type == "reject") {
			DBi::$con->query("UPDATE ".prefix."MODERATION SET M_STATUS = '2' WHERE MODERATION_ID = '$id' ") or die (DBi::$con->error);
			$text = $lang['svc_file']['done_refused_request'];
		    }
		    else if ($type == "exp") {
			$dateExp = time();
			$text = $lang['svc_file']['done_delete_request_moderation'];
			$member_id = moderation("MEMBERID", $id);
			$forum_id = moderation("FORUMID", $id);
			$type = moderation("TYPE", $id);
			$pm_mid = "-".$forum_id;

			switch ($type) {
			     case "1":
			          $txtSubject = "".$lang['svc_file']['moderation_subject_trash_1']." ".forum_name($forum_id);
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_1'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "2":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_2'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_2'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "3":
			          $txtSubject = "".$lang['svc_file']['moderation_subject_trash_3']." ".forum_name($forum_id);
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_3'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "4":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_4'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_4'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "5":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_5'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_5'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;				 
			     case "6":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_6'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_6'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "7":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_7'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_7'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "8":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_8'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_8'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "9":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_9'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_9'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "10":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_10'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_10'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			$pm_mid = moderation("ADDED", $id);
			     break;
			     case "11":
			          $txtSubject = "".$lang['svc_file']['moderation_subject_trash_11']." ".forum_name($forum_id);
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_11'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "12":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_12'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_12'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;

			}

			// SEND PM TO MEMBER ABOUT CANCEL THE MODERATION
			send_pm($pm_mid, $member_id, $txtSubject, $txtMessage, $date);
			

			if ($type == 5) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_STATUS = '1' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 6) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_ALLOWCHAT = '1' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 7) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_HIDE_PHOTO = '0', ";
			     $update .= "M_HIDE_SIG = '0', ";
			     $update .= "M_HIDE_DETAILS = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 8) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_HIDE_POSTS = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 9) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_HIDE_PM = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 10) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_USE_PM = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 12) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_IHDAA = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			     $up = "UPDATE " . $Prefix . "MODERATION SET ";
			     $up .= "M_STATUS = '3', ";
			     $up .= "M_END = '$DBMemberID', ";
			     $up .= "M_DATEFIN = '$dateExp' ";
			     $up .= "WHERE MODERATION_ID = '$id' ";
			     DBi::$con->query($up, $connection) or die (DBi::$con->error);
		    }
			if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
header("Location: ".$referer."");
		} else {
		redirect();	
		}
	}
}
if ($method == "trash"){
		if (svc == "medals"){
				$id = medals("MEDAL_ID", $m);
				$f = medals("FORUM_ID", $m);
			if(allowed($f, 1) == 0) {
			redirect();	
			}
			if(allowed($f, 1) == 1){
					DBi::$con->query("DELETE FROM ".prefix."MEDALS WHERE MEDAL_ID = '$m' ") or die (DBi::$con->error);
			if(allowed($f, 1) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}			
		echo '
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
	<center>	<table width="50%" border="1">
		<center>
				<td class="fixed" colSpan="10">
				
				<font color="red"><font size="+2">	<center>'.$lang['svc_file']['done_delete_this_medal'].'<center><br></font><br>
				<br>
			<a href="'.$referer.'"><center>'.$lang['all']['click_here_to_go_normal_page'].'<center></a><br><br></td>
			</tr>
		</table>
	</tr>
</table>';
				}
			}
	if (svc == "prv"){
		$t = topic_members("TOPIC_ID", $id);
		$f = topics("FORUM_ID", $t);
		if (allowed($f, 2) == 1){
			DBi::$con->query("DELETE FROM ".prefix."TOPIC_MEMBERS WHERE TM_ID = '$id' ") or die (DBi::$con->error);
		if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}	
			 echo '
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
	<center>	
		</td>
	</tr>
</table>';
		} else {
		redirect();	
		}
	}
	if (svc == "mon"){
		$f = moderation("FORUMID", $id);
		if (allowed($f, 2) == 1){
		    if ($type == "delete") {
			DBi::$con->query("DELETE FROM ".prefix."MODERATION WHERE MODERATION_ID = '$id' ") or die (DBi::$con->error);
			$text = $lang['others']['request_deleted'];
		    }
		    else if ($type == "reject") {
			DBi::$con->query("UPDATE ".prefix."MODERATION SET M_STATUS = '2' WHERE MODERATION_ID = '$id' ") or die (DBi::$con->error);
			$text = $lang['svc_file']['done_refused_request'];
		    }
		    else if ($type == "exp") {
			$dateExp = time();
			$text = $lang['svc_file']['done_delete_request_moderation'];
			$member_id = moderation("MEMBERID", $id);
			$forum_id = moderation("FORUMID", $id);
			$type = moderation("TYPE", $id);
			$pm_mid = "-".$forum_id;

			switch ($type) {
			     case "1":
			          $txtSubject = "".$lang['svc_file']['moderation_subject_trash_1']." ".forum_name($forum_id);
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_1'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "2":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_2'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_2'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "3":
			          $txtSubject = "".$lang['svc_file']['moderation_subject_trash_3']." ".forum_name($forum_id);
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_3'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "4":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_4'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_4'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "5":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_5'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_5'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;				 
			     case "6":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_6'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_6'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "7":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_7'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_7'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "8":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_8'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_8'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "9":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_9'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_9'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "10":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_10'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_10'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			$pm_mid = moderation("ADDED", $id);
			     break;
			     case "11":
			          $txtSubject = "".$lang['svc_file']['moderation_subject_trash_11']." ".forum_name($forum_id);
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_11'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;
			     case "12":
			          $txtSubject = $lang['svc_file']['moderation_subject_trash_12'];
				  $txtMessage = '<font color="blue" size="3">'.$lang['svc_file']['moderation_message_trash_12'].'<br><br>'.$lang['svc_file']['please_dont_try_again'].'</font>';
			     break;

			}

			// SEND PM TO MEMBER ABOUT CANCEL THE MODERATION
			send_pm($pm_mid, $member_id, $txtSubject, $txtMessage, $date);

			if ($type == 5) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_STATUS = '1' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 6) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_ALLOWCHAT = '1' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 7) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_HIDE_PHOTO = '0', ";
			     $update .= "M_HIDE_SIG = '0', ";
			     $update .= "M_HIDE_DETAILS = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 8) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_HIDE_POSTS = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 9) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_HIDE_PM = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 10) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_USE_PM = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			else if ($type == 12) {
			     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
			     $update .= "M_IHDAA = '0' ";
			     $update .= "WHERE MEMBER_ID = '$member_id' ";
			     DBi::$con->query($update, $connection) or die (DBi::$con->error);
			}
			     $up = "UPDATE " . $Prefix . "MODERATION SET ";
			     $up .= "M_STATUS = '3', ";
			     $up .= "M_END = '$DBMemberID', ";
			     $up .= "M_DATEFIN = '$dateExp' ";
			     $up .= "WHERE MODERATION_ID = '$id' ";
			     DBi::$con->query($up, $connection) or die (DBi::$con->error);
		    }
			if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
		 echo '
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
	<center> 
		</td>
	</tr>
</table>';
	
		} else {
		redirect();	
		}
	}
}

// ################################################### IP SECTION ########################################

if (svc == "ip"){
if(mlv < 2){
redirect();
}
if($id == 1 && members("LEVEL", $id) == 4) {
		                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[out][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
if($id == "") {
$theid = $DBMemberID;	
}
if($Mlevel < 3) {
$theid = $DBMemberID;
}
if($id == 1) {
$theid = $DBMemberID;	
}
if($Mlevel > 2 && $id != "" && $id != 1) {
$theid = $id;
}
if((($Mlevel == 4) or ($Mlevel == 3 && $deputy == 0 && $CAN_CHANGE_M == 1)) && $id != "") {
$typeid = "&id=".$theid."";	
}
else{
	$typeid = "&id=".$theid."";	
}
$titl_e = $lang['members']['country'];
$titl_b = $lang['title_page']['last_login_m'];
$colSpan = 3;
if($type == "info"){ 
$titl_e = $lang['svc_function']['type']; 
$titl_c = $lang['svc_file']['soucre']; 
$titl_b = $lang['title_page']['login_try'];
$colSpan = 4;
}

echo'
	<center>
	<table cellSpacing="1" cellPadding="2" width="40%" border="0">
		<tr>
			<td class="optionsbar_menus" width="100%" colspan="'.$colSpan.'">&nbsp;<nobr><font color="red" size="+1">
'.$titl_b.' '.$lang['svc_file']['for_member_number'].' '.$theid.' <br> </font></nobr></td></tr><tr><td class="stats_h">'.$lang['svc_file']['date_and_time'].'</td><td class="stats_h">'.$titl_e.'</td><td class="stats_h">IP</td>';if($type == "info") {echo'<td class="stats_h">'.$lang['svc_file']['soucre'].'</td>';}echo'</tr>';

$sql = DBi::$con->query("select * from ".prefix."IP where m_id = '".$theid."' order by ID desc ");

if(mysqli_num_rows($sql) != 0){
while($row = mysqli_fetch_array($sql)) {
$the_ip = $row['IP'];	
$member_id = $row['DO_ID'];	
if(members("LEVEL", $member_id) > 1 && members("LEVEL", $theid) < members("LEVEL", $member_id)) {
$the_ip = $lang['svc_file']['an_hidden'];
} else {
$the_ip = $row['IP'];	
}
$all_member = link_profile(member_name($member_id), $member_id);
if($type == "info"){
$enter = '<font color="green">'.$lang['svc_file']['normal_login'].'</font>';
if($row['TYPE'] == 1) $enter = '<font color="red">'.$lang['svc_file']['wrong_password'].'</font>';
if($row['TYPE'] == 3) $enter = '<font color="red">'.$lang['svc_function']['request_a_pass'].'</font>';
echo '<tr><td class="stats_g">'.normal_time_files($row['DATE']).'</td><td class="stats_p">'.$enter.'</td><td class="stats_p">
';
if(members("LEVEL", $member_id) > 1 && members("LEVEL", $theid) < members("LEVEL", $member_id)) {
echo'';	
} else {
echo'
<a target="_blank" href="http://api.hostip.info/?ip='.$the_ip.'">
';
}
echo'
'.$the_ip.'</a></td><td class="stats_p">'.$all_member.'</td></tr>';
}else{
echo '<tr><td class="stats_g">'.normal_time_files($row['DATE']).'</td><td class="stats_p">'.$row['COUNTRY_ARABIC'].'</td><td class="stats_p"><a target="_blank" href="http://api.hostip.info/?ip='.$row['IP'].'">'.$row['IP'].'</a></td></tr>';
}
}
echo'<tr><td class="stats_p" colSpan="'.$colSpan.'"><a href="index.php?mode=delete&type=ip'.$typeid.'"><center>'.$lang['svc_function']['delete_ip_list'].'</center></a></td></tr>';
}else{
echo '<tr><td colspan="4" class="stats_p" align="center">'.$lang['svc_file']['no_member_list'].'</td></tr>';
}
echo '</table>';
}


// ################################################### SEARCH SHOW SECTION ########################################

if (svc == "search"){
if(mlv != 4){
redirect();
}
if($id == 1 && members("LEVEL", $id) == 4) {
		                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[out][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
if(empty($id)) $id = m_id;

echo '<center>
	<table class="grid" cellSpacing="1" cellPadding="0"  width="55%">
<tr><td colspan="7" class="optionheader_selected">'.$lang['svc_file']['last_searchs'].' '.member_name($id).' '.$lang['svc_file']['in_last_24'].'</td></tr>
<tr><td class="cat">'.$lang['svc_file']['search_word'].'</td><td class="cat">'.$lang['message']['date'].'</td><td class="cat">'.$lang['svc_file']['search_type'].'</td><td class="cat">'.$lang['medals']['medals_forum'].'</td><td class="cat">'.$lang['svc_file']['in_member_posts'].'</td><td class="cat">'.$lang['svc_file']['in_month'].'</td><td class="cat">'.$lang['svc_file']['in_year'].'</td></tr>';


$Hour = time() - (24 * 3600);

$sql = DBi::$con->query("select * from ".prefix."SEARCH where MEMBER_ID = '$id' AND DATE >= $Hour") or die(DBi::$con->error);

while($r = mysqli_fetch_array($sql)){
if($r['TYPE'] == 0){
$type = $lang['svc_file']['search_in_topics_and_titles'];
}else{
$type = $lang['svc_file']['search_in_replies'];
}
if(forums("SUBJECT",$r['FORUM'])){
$forum = forums("SUBJECT",$r['FORUM']);
}else{
$forum = "--";
}
if($r['IN_USER']){
$m = member_name($r['IN_USER']);
$in_user = link_profile($m,$r['IN_USER']);
}else{
$in_user = "--";
}


if($r['MONTH']){
$month = $r['MONTH'];
}else{
$month = "--";
}

if($r['YEAR']){
$year = $r['YEAR'];
}else{
$year = "--";
}

echo '<tr>
<td class="f1" align="center"><nobr>'.trim(htmlspecialchars($r['QUERY'])).'</nobr></td>
<td class="f2ts" style="color:red"><nobr>'.normal_date($r['DATE']).'</nobr></td>
<td class="f1" align="center"><nobr>'.$type.'</nobr></td>
<td class="f1" align="center"><nobr>'.$forum.'</nobr></td>
<td class="f1" align="center"><nobr>'.$in_user.'</nobr></td>
<td class="f1" align="center">'.$month.'</td>
<td class="f1" align="center">'.$year.'</td>
</tr>';
}
echo'</table>';
}

########## التوزيع الجماعي BY Hidoussi Med Ayoub / ملك المستقبل / أيوب######################################
		if (svc == "list_medals"){
		if (type == ""){
				if (allowed($f, 2) == 0 OR $f == ""){
		error_message($lang['svc_file']['cant_list_medals_it']);
		exit();
		}
				if (allowed($f, 2) == 1){
		
		?>
	<script language="javascript">
		function submitAdd() {
			if (medals_info.medals.value.length == 0){
				confirm(enter_sell_medal_id);
			return;
			}
			if (medals_info.area.value.length == 0){
				confirm(add_one_member_just);
			return;
			}
		medals_info.submit();
		}
	</script>
	<?php
	echo'
<center>
<table width="50.5%">
<form name="medals_info" method="post" action="index.php?mode=svc&svc=list_medals&type=add">
<input name="forum" value="'.$f.'" type="hidden">
	<tr>
		<td class="optionsbar_menus" width="100%"><nobr><font color="red" size="+1">'.$lang['svc_file']['list_medals'].'</font></nobr></td>
	</tr>
     
        <table class="grid" border="0" cellpadding="5" cellspacing="1" dir="rtl" width="50%">
            <tr class="normal">
              <td class="list_small" colspan="5">
<font color="red" size="+1">'.$lang['admin']['sell_medal_id'].':</font>
			  <input name="medals">
            </tr>
			</table>
            <tr>
			 <table bgcolor="gray" class="grid" border="0" cellpadding="5" cellspacing="1" dir="rtl" width="50%">
<tr>
		<td class="cat" colspan="4" align="middle">'.$lang['svc_file']['members_numbers'].''.info_icon(1).'</td>

	'.info_text(1, $lang['svc_file']['members_numbers_desc_m'], $lang['svc_file']['members_numbers']).'
</tr>
			';



echo'
<input name="refer" type="hidden" value="'.referer.'">
  <tr class="fixed">
 <td class="list_small" colspan="4">
<textarea name="area" rows="8" cols="40"></textarea>';
		echo'
		        <tr class="fixed">
              <td class="list_small" colspan="4">
              <input value="'.$lang['svc_file']['giv_this_medal'].'" type="button" onClick="submitAdd();">
			  </td>
			  </form>
			
            </tr></table>';
		} else {
		redirect();	
		}
	
		
		}// انتهاء السماح
		

			if (type == "add"){
		$refer = DBi::$con->real_escape_string(htmlspecialchars(HtmlSpecialchars($_POST['refer'])));
		$f = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST['forum'])));
		$id = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST['medals'])));
		$users = explode("\n",htmlspecialchars($_POST['area']));
		$frm_medals = $f;
		if (allowed($frm_medals, 2) == 0){
		error_message($lang['svc_file']['cant_giv_medals_in_not_forums']);
		exit();
		}
		if (allowed($f, 2) == 1){
		if ($f == ""){
		error_message($lang['svc_file']['cant_list_medals_it']);
		exit();
		}
		if ($id == ""){
		error_message($lang['svc_file']['medal_number_wrong']);
		exit();
		}
		 
		foreach($users AS $userid) 
		if ($userid > 0){
		$members_id = intval($userid);	
		//echo intval($userid)"<br />";
		$check_num = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$members_id' ") or die(database_error(__line__,1));
	if(mysqli_num_rows($check_num) <= 0){
		
		$add_text = $lang['svc_file']['members_number_wrong'];


	}
	elseif(mysqli_num_rows(DBi::$con->query("SELECT * FROM ".$Prefix."GLOBAL_MEDALS WHERE MEDAL_ID = '$id' AND FORUM_ID = '$frm_medals'")) <= 0) {
		$add_text = $lang['svc_file']['medal_number_wrong'];
	}
	else {
			
			$days = gm("DAYS", $id);
			$points = gm("POINTS", $id);
			$url = gm("URL", $id);
			$sql = "INSERT INTO ".prefix."MEDALS (MEDAL_ID, GM_ID, MEMBER_ID, FORUM_ID, STATUS, ADDED, DAYS, POINTS, URL, DATE) VALUES (NULL, ";
			$sql .= " '$id', ";
			$sql .= " '$members_id', ";
			$sql .= " '$f', ";
			if (allowed($f, 1) == 1){
				$sql .= " '1', ";
			}
			else{
				$sql .= " '0', ";
			}
			$sql .= " '$DBMemberID', ";
			$sql .= " '$days', ";
			$sql .= " '$points', ";
			$sql .= " '$url', ";
			$sql .= " '".time()."') ";
			DBi::$con->query($sql) or die(database_error(__line__,1));
			if (allowed($f, 1) == 1){
				$msg_text = $lang['svc_file']['done_add_medals_to_member'];
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MEDAL = '".chk_member_last_medal($m)."', M_POINTS = '".member_all_points($m)."' WHERE MEMBER_ID = '$m' ") or die(database_error(__line__,1));
			}
			else{
				$msg_text = $lang['svc_file']['done_add_medals_to_member_pending_monitor'];
			}
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
			}
		}else {
		error_message($lang['svc_file']['cant_list_medals_it']);
		}
		
		// earch
					echo'<br><center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_text.'</b></font>
					   ';
					   if($add_text == "") {
						  echo'<br><br>'; 
					   }
					   if ($add_text != "" ) { echo'
					   <font color="red" size="5">'.$add_text.'</font><br><br>';
					   }
					   echo'
					      <meta http-equiv="Refresh" content="3; URL='.$referer.'">
	                       <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			
			
			
			
		} else {
		redirect();	
		}
		}
		}
// ################### التوزيع الجماعي BY Hidoussi Med Ayoub / ملك المستقبل / أيوب######################################
		if (svc == "list_titles"){
		if (type == ""){
				if (allowed($f, 2) == 0 OR $f == ""){
		error_message($lang['svc_file']['cant_list_titles_it']);
		exit();
		}
				if (allowed($f, 2) == 1){
		
		?>
	<script language="javascript">
		function submitAdd() {
			if (medals_info.medals.value.length == 0){
				confirm(enter_title_id);
			return;
			}
			if (medals_info.area.value.length == 0){
				confirm(add_one_member_just);
			return;
			}
		medals_info.submit();
		}
	</script>
	<?php
	echo'
<center>
<table width="50.5%">
<form name="medals_info" method="post" action="index.php?mode=svc&svc=list_titles&type=add">
<input name="forum" value="'.$f.'" type="hidden">
	<tr>
		<td class="optionsbar_menus" width="100%"><nobr><font color="red" size="+1">'.$lang['svc_file']['list_titles'].'</font></nobr></td>
	</tr>
     
        <table class="grid" border="0" cellpadding="5" cellspacing="1" dir="rtl" width="50%">
            <tr class="normal">
              <td class="list_small" colspan="5">
<font color="red" size="+1">'.$lang['svc_file']['title_id'].':</font>
			  <input name="medals">
            </tr>
			</table>
            <tr>
			 <table bgcolor="gray" class="grid" border="0" cellpadding="5" cellspacing="1" dir="rtl" width="50%">
<tr>
		<td class="cat" colspan="4" align="middle">'.$lang['svc_file']['members_numbers'].''.info_icon(1).'</td>

	'.info_text(1, $lang['svc_file']['members_numbers_desc_t'], $lang['svc_file']['members_numbers']).'
</tr>
			';



echo'
<input name="refer" type="hidden" value="'.referer.'">
  <tr class="fixed">
 <td class="list_small" colspan="4">
<textarea name="area" rows="8" cols="40"></textarea>';
		echo'
		        <tr class="fixed">
              <td class="list_small" colspan="4">
              <input value="'.$lang['svc_file']['giv_this_title'].'" type="button" onClick="submitAdd();">
			  </td>
			  </form>
			
            </tr></table>';
		} else {
		redirect();	
		}
	
		
		}// انتهاء السماح
		

			if (type == "add"){
		$refer = DBi::$con->real_escape_string(htmlspecialchars(HtmlSpecialchars($_POST['refer'])));
		$f = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST['forum'])));
		$id = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST['medals'])));
		$users = explode("\n",htmlspecialchars($_POST['area']));
		$frm_medals = $f;
		if (allowed($frm_medals, 2) == 0){
		error_message($lang['svc_file']['cant_giv_titles_in_not_forums']);
		exit();
		}
		if (allowed($f, 2) == 1){
		if ($f == ""){
		error_message($lang['svc_file']['cant_list_titles_it']);
		exit();
		}
		if ($id == ""){
		error_message($lang['svc_file']['title_number_wrong']);
		exit();
		}
		 
		foreach($users AS $userid) 
		if ($userid > 0){
		$members_id = intval($userid);	
		//echo intval($userid)."<br />";
		$check_num = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$members_id' ") or die(database_error(__line__,1));
	if(mysqli_num_rows($check_num) <= 0){
		$add_text = $lang['svc_file']['members_number_wrong'];
	}else if (chk_add_titles($id, $members_id) == 1){
	$add_text1 = $lang['svc_file']['members_number_have_this'];
	}
	else {
			
				$sql = "INSERT INTO ".prefix."TITLES (TITLE_ID, GT_ID, MEMBER_ID, DATE) VALUES (NULL, ";
				$sql .= " '$id', ";
				$sql .= " '$members_id', ";
				$sql .= " '".time()."') ";
				DBi::$con->query($sql) or die(database_error(__line__,1));

				$sql = "INSERT INTO ".prefix."USED_TITLES (ID, TITLE_ID, MEMBER_ID, STATUS, ADDED, DATE) VALUES (NULL, ";
				$sql .= " '$id', ";
				$sql .= " '$members_id', ";
				$sql .= " '1', ";
				$sql .= " '$DBMemberID', ";
				$sql .= " '".time()."') ";
				DBi::$con->query($sql) or die(database_error(__line__,1));
			
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}

			}
		}
		
		// earch
					echo'<br><center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_giv_this_title_to_members'].'</b></font>
					   ';
					   if($add_text == "" or $add_text1 == "") {
						  echo'<br><br>'; 
					   }
					   if ($add_text != "" ) { echo'
					   <font color="red" size="3">'.$add_text.'</font><br><br>';
					   }
					    if ($add_text1 != "" ) { echo'
					   <font color="red" size="3">'.$add_text1.'</font><br><br>';
					   }
					   echo'
					      <meta http-equiv="Refresh" content="3; URL='.$referer.'">
	                       <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			
		} else {
		redirect();	
		}
		}
		}		
// ################### التوزيع الجماعي BY Hidoussi Med Ayoub / ملك المستقبل / أيوب######################################
		
		if (svc == "list_topics"){
		if (type == ""){
				if (allowed($f, 2) == 0 OR $f == ""){
		error_message($lang['svc_file']['cant_list_topics_it']);
		exit();
		}
				if (allowed($f, 2) == 1){
		
		?>
	<script language="javascript">
		function submitAdd() {
			if (medals_info.medals.value.length == 0){
				confirm(enter_topic_id);
			return;
			}
			if (medals_info.area.value.length == 0){
				confirm(add_one_member_just);
			return;
			}
		medals_info.submit();
		}
	</script>
	<?php
	echo'
<center>
<table width="50.5%">
<form name="medals_info" method="post" action="index.php?mode=svc&svc=list_topics&type=add">
<input name="forum" value="'.$f.'" type="hidden">
	<tr>
		<td class="optionsbar_menus" width="100%"><nobr><font color="red" size="+1">'.$lang['svc_file']['list_topics'].'</font></nobr></td>
	</tr>
     
        <table class="grid" border="0" cellpadding="5" cellspacing="1" dir="rtl" width="50%">
            <tr class="normal">
              <td class="list_small" colspan="5">
<font color="red" size="+1">'.$lang['svc_file']['topic_number'].'</font>
			  <input name="medals">
            </tr>
			</table>
            <tr>
			 <table bgcolor="gray" class="grid" border="0" cellpadding="5" cellspacing="1" dir="rtl" width="50%">
<tr>
		<td class="cat" colspan="4" align="middle">'.$lang['svc_file']['members_numbers'].''.info_icon(1).'</td>

	'.info_text(1, $lang['svc_file']['members_numbers_desc_tt'], $lang['svc_file']['members_numbers']).'
</tr>
<input name="refer" type="hidden" value="'.referer.'">
  <tr class="fixed">
 <td class="list_small" colspan="4">
<textarea name="area" rows="8" cols="40"></textarea>
		        <tr class="fixed">
              <td class="list_small" colspan="4">
              <input value="'.$lang['svc_file']['open_this_topic'].'" type="button" onClick="submitAdd();">
			  </td>
			  </form>
            </tr></table>';
		} else {
		redirect();	
		}
	
		
		}// انتهاء السماح
		

			if (type == "add"){
		$refer = DBi::$con->real_escape_string(htmlspecialchars(HtmlSpecialchars($_POST['refer'])));
		$frm = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST['forum'])));
		$t = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST['medals'])));
		$users = explode("\n",htmlspecialchars($_POST['area']));
		$f = $f;
		$t_hide = topics("HIDDEN", $t);
		
		if (allowed($f, 2) == 0){
		error_message($lang['svc_file']['cant_giv_topics_in_not_forums']);
		exit();
		}
		if (allowed($f, 2) == 1){
		if ($frm == ""){
		error_message($lang['svc_file']['cant_list_topics_it']);
		exit();
		}
		if ($t == ""){
		error_message($lang['svc_file']['topic_number_wrong']);
		exit();
		}
		if ($t_hide == 0){
		error_message($lang['svc_file']['hide_topic_only']);
		exit();
		}
		foreach($users AS $userid) 
		if ($userid > 0){
		$members_id = intval($userid);	
		//echo intval($userid)."<br />";
		$check_num = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$members_id' ") or die(database_error(__line__,1));
		$check_topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS WHERE TOPIC_ID = '$t' ") or die(database_error(__line__,1));

	if(mysqli_num_rows($check_num) <= 0){
	$add_text = $lang['svc_file']['members_number_wrong'];
	}
	else if(mysqli_num_rows($check_topics) <= 0){
		error_message($lang['svc_file']['topic_number_wrong']);
	}
	else if (chk_add_member_to_topic($t, $members_id) == 1){
	$add_text1 = $lang['svc_file']['members_number_have_this_topic'];
	}
	else {
			
				$sql = "INSERT INTO ".prefix."TOPIC_MEMBERS (TM_ID, MEMBER_ID, TOPIC_ID, ADDED, DATE) VALUES (NULL, ";
				$sql = $sql." '$members_id', ";
				$sql = $sql." '$t', ";
				$sql = $sql." '$DBMemberID', ";
				$sql = $sql." '".time()."') ";
				DBi::$con->query($sql) or die(database_error(__line__,1));
				
				$t_subject = topics("SUBJECT", $t);				$subject = ''.$lang['svc_file']['message_hide_open_topic_part1'].' '.$t_subject;
				$message = ''.$lang['svc_file']['message_hide_open_topic_part2'].'<br><br><a href="index.php?mode=t&t='.$t.'">'.$lang['svc_file']['message_hide_open_topic_part3'].' '.$t.': '.$t_subject.'</a><br><br>'.$lang['svc_file']['message_hide_open_topic_part4'].'</font>';
				
				if (chk_add_member_to_topic($t, $members_id) == 1){
				$sql = "INSERT INTO ".prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sql .= " '$members_id', ";
				$sql .= " '$members_id', ";
				$sql .= " '".abs2($f)."', ";
				$sql .= " '0', ";
				$sql .= " '$subject', ";
				$sql .= " '$message', ";
				$sql .= " '".time()."') ";
				DBi::$con->query($sql) or die(database_error(__line__,1));
			}
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}			
			}
		}
		
		// earch
					echo'<br><center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['svc_file']['done_open_this_topic_to_members'].'</b></font>
					  ';
					  if($add_text == "" or $add_text1 == "") {
						 echo' <br><br>'; 
					  }
					   if ($add_text != "" ) { echo'
					   <font color="red" size="3">'.$add_text.'</font><br><br>';
					   }
					    if ($add_text1 != "" ) { echo'
					   <font color="red" size="3">'.$add_text1.'</font><br><br>';
					   }
					   echo'
					      <meta http-equiv="Refresh" content="3; URL='.$referer.'">
	                       <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			
		} else {
		redirect();	
		}
		}
		}		
		
	
		

				
// ######################################################### Bye Bye !! ##########################################
}// if mlv > 1 {


?>