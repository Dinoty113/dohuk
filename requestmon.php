<?php
if (@eregi("requestmon.php","$_SERVER[PHP_SELF]")) {
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

if($type != "" && $type != "insert") {
redirect();	
}

@require_once("./engine/moderation_function.php");
@require_once("./engine/svc_function.php");
$referer = $_SERVER['HTTP_REFERER'];
if($aid == 1 or DBi::$con->real_escape_string(htmlspecialchars($_POST['member_id'])) == 1 or (members("LEVEL", $aid) == 4 && $DBMemberID != 1)){
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
if ($type == "") {
if(members("NAME", $aid) == ""){
	header("Location: ".index()."");
}
if (mlv > 1 AND (members("LEVEL", $aid) == 1 || mlv > 2) AND (check_administrateurs($aid) == 0 || mlv == 4)){
echo'
	<center>
	<table dir="rtl" cellSpacing="1" cellPadding="1">
		<tr>
			<td class="optionsbar_menus" colSpan="15"><font color="red" size="4">'.$lang['request_mon']['mon_date'].'<br>'.member_name($aid).'</font><br><br>';
				$sql = DBi::$con->query("SELECT COUNT(*) FROM ".prefix."MODERATION WHERE M_MEMBERID = '$aid' AND M_STATUS != '2' ") or die (mysql_error());
	$sql = mysqli_result($sql, 0, "COUNT(*)");
	$all_pg = ceil($sql / $max_page);
	if ($all_pg == 0){
	echo'';
	}
	else{
		echo'
		<form>
		<font size="2">'.$lang['forum']['page'].':&nbsp;</font>
		<select style="WIDTH:80px" size="1" onchange="window.location = \'index.php?'.chk_get_self($HTTP_GET_VARS).'pg=\'+this.options[this.selectedIndex].value;">';
		for($i = 1; $i <= $all_pg; $i++){
		echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$all_pg.'</option>';
		}
	echo'
		</select>
		
		</form>';
	}
			echo'
		</td></tr>
		<tr>
			<td class="stats_h"><nobr></nobr></td>
			<td class="stats_h"><nobr>'.$lang['members']['members'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['svc_function']['type'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['active']['forum'].'</nobr></td>
			<td class="stats_h" colspan="2"><nobr>'.$lang['svc_function']['add_request'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['svc_function']['moderation_refused'].'</nobr></td>
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

	$sql = " SELECT * FROM " . $Prefix . "MODERATION ";
	$sql .= " WHERE M_MEMBERID = '$aid' ";
	$sql .= " ORDER BY M_DATE DESC LIMIT ".pg_limit($max_page).", $max_page ";
	$result = @DBi::$con->query($sql, $connection) or die (DBi::$con->error);
	$num = @mysqli_num_rows($result);
	if ($num == 0) {
	echo'
		<tr>
			<td class="stats_h" colspan="14"><nobr><br>'.$lang['request_mon']['no_request_mon'].'<br><br></nobr></td>
		</tr>';
	}
	else {
	$x=0;
	while ($x < $num) {
	$m = @mysqli_result($result, $x, "MODERATION_ID");
	svc_show_mon($m);
	++$x;
	}
	}

	echo'
	</table>
	</center>';
$sql_1 = DBi::$con->query("SELECT * FROM ".prefix."TOPICS WHERE TOPIC_ID = '$t' AND T_AUTHOR = '$aid'");
$num_1 = mysqli_num_rows($sql_1);
$sql_2 = DBi::$con->query("SELECT * FROM ".prefix."REPLY WHERE REPLY_ID = '$r' AND TOPIC_ID = '$t' AND R_AUTHOR = '$aid'");
$num_2 = mysqli_num_rows($sql_2);
$sql_3 = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID = '$pm' AND PM_FROM = '$aid'");
$num_3 = mysqli_num_rows($sql_3);
$sql_4 = DBi::$con->query("SELECT * FROM ".prefix."CEP_FORUM WHERE O_FORUMIDA = '$ihdaa' AND O_FORUM_NAMEA = '$aid'");
$num_4 = mysqli_num_rows($sql_4);	
if($num_1 > 0 or $num_2 > 0 or $num_3 > 0 or $num_4 > 0) {
if(!$r AND !$pm AND !$ihdaa AND !$t) {
	echo'';
} else {	

	if ($r != "") {
	    $text = "".$lang['request_mon']['topic_number']." ".$t."&nbsp;&nbsp;".$lang['request_mon']['reply_number']." ".$r;
	}
	elseif($pm != ""){
	    $text = "".$lang['request_mon']['message_number']." ".$pm;
	}
	elseif($ihdaa != ""){
	    $text = "".$lang['request_mon']['ihdaa_number']." ".$ihdaa;
	}	
	else{
	    $text = "".$lang['request_mon']['topic_number']." ".$t;
	}

		if (allowed($f, 2) == 1 && members("STATUS", $aid) == 1) {
		svc_requestmon_body();
		} else {
		echo'<br><br><b><center><font color="red" size="5">'.$lang['temy_other']['no_member_here'].'</font></center></b>';	
		}

}
} else {

}
} // (mlv > 1 AND (members("LEVEL", $aid) == 1 || mlv > 2) AND (check_administrateurs($aid) == 0 || mlv == 4))
else {
                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['request_mon']['cant_apply_this'].'</font><br><br>
	                       	<meta http-equiv="Refresh" content="2; URL=JavaScript:history.go(-1)">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}
} // ($type == "")

if ($type == "insert") {
	
	$member_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['member_id']));
	$forum_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));
	$pm_mid = "-".$forum_id;
	$topic_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['topic_id']));
	$reply_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['reply_id']));
	$pm = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST['pm'])));
	$ihdaa = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST['ihdaa'])));
	$moderation_type = DBi::$con->real_escape_string(htmlspecialchars($_POST['moderation_type']));
	$moderation_raison = DBi::$con->real_escape_string(htmlspecialchars($_POST['moderation_raison']));
	$moderators_notes = DBi::$con->real_escape_string(htmlspecialchars($_POST['moderators_notes']));
	$m_date = time();


if($topic_id != "" && $reply_id == "") {	
$sql_1 = DBi::$con->query("SELECT * FROM ".prefix."TOPICS WHERE TOPIC_ID = '$topic_id' AND T_AUTHOR = '$member_id'");
$num_1 = mysqli_num_rows($sql_1);
if($num_1 == 0) {
redirect();	
}
}

if($topic_id != "" && $reply_id != "") {	
$sql_5 = DBi::$con->query("SELECT * FROM ".prefix."TOPICS WHERE TOPIC_ID = '$topic_id'");
$num_5 = mysqli_num_rows($sql_5);
if($num_5 == 0) {
redirect();	
}
}


if($reply_id != "") {
$sql_2 = DBi::$con->query("SELECT * FROM ".prefix."REPLY WHERE REPLY_ID = '$reply_id' AND TOPIC_ID = '$topic_id' AND R_AUTHOR = '$member_id'");
$num_2 = mysqli_num_rows($sql_2);
if($num_2 == 0) {
redirect();	
}
}
if($pm != "0") {
$sql_3 = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID = '$pm' AND PM_FROM = '$member_id'");
$num_3 = mysqli_num_rows($sql_3);
if($num_3 == 0) {
redirect();	
}
}
if($ihdaa != "0") {
$sql_4 = DBi::$con->query("SELECT * FROM ".prefix."CEP_FORUM WHERE O_FORUMIDA = '$ihdaa' AND O_FORUM_NAMEA = '$member_id'");
$num_4 = mysqli_num_rows($sql_4);
if($num_4 == 0) {
redirect();	
}
}	

	if ($moderation_type == 1) {
	    $m_dateApp = time();
	}
	else {
	    $m_dateApp = "0";
	}

	if ($reply_id == "") {
	    $reply_id = 0;
	    $rid = "";
	}
	else {
	    $rid = "&r=".$reply_id;
	}

	switch ($moderation_type) {
	     case "1":
	          $txtSubject = "".$lang['request_mon']['request_mon_message_part1']." ".forum_name($forum_id);
		  $txtMessage = '<font color="red" size="3">'.$lang['request_mon']['request_mon_message_part2'].' '.forum_name($forum_id).'<br><br>'.$lang['request_mon']['request_mon_message_part3'].' </font><br><font size="3">'.$moderation_raison.'</front><font color="black" size="3"><br><br>'.$lang['request_mon']['request_mon_message_part4'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['request_mon']['show_this_post'].'</a><br></front>';
		  $STATUS = "1";
	     break;
	}

	if ($error == "") {

		if ($moderation_type == "1") {

		// SEND PM TO MEMBER ABOUT THE RAISON OF THE MODERATION
		send_pm($pm_mid, $member_id, $txtSubject, $txtMessage, $m_date);

		}
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MODERATION WHERE M_MEMBERID = '$member_id' AND M_TYPE = '$moderation_type' AND M_STATUS = '0' AND M_FORUMID = '$forum_id' AND (M_TOPICID = '$topic_id' OR M_REPLYID = '$reply_id' OR M_PM = '$pm' OR M_IHDAA = '$ihdaa')");
		$num = mysqli_num_rows($sql);
		if($num > 0) {
		$two_requests = "1";	
		}
		$query = "INSERT INTO " . $Prefix . "MODERATION (MODERATION_ID, M_MEMBERID, M_STATUS, M_FORUMID, M_TOPICID, M_REPLYID, M_PM , M_IHDAA , M_ADDED, M_EXECUTE, M_MODERATOR_NOTES, M_TYPE, M_RAISON, M_DATE, M_TWOREQUESTS, M_DATEAPP) VALUES (NULL, ";
		$query .= " '$member_id', ";
		$query .= " '$STATUS', ";
		$query .= " '$forum_id', ";
		$query .= " '$topic_id', ";
		$query .= " '$reply_id', ";
		$query .= " '$pm', ";
		$query .= " '$ihdaa', ";
		$query .= " '$DBMemberID', ";
		$query .= " '$DBMemberID', ";
		$query .= " '$moderators_notes', ";
		$query .= " '$moderation_type', ";
		$query .= " '$moderation_raison', ";
		$query .= " '$m_date', ";
		$query .= " '$two_requests', ";
		$query .= " '$m_dateApp') ";
		@DBi::$con->query($query) or die (DBi::$con->error);

				header("Location: ".$referer."");

	}
}

?>