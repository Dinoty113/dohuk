<?
/*if (@eregi("notifylist.php","$_SERVER[PHP_SELF]")) {
header("HTTP/1.0 404 Not Found");
require_once("customavatars/foundfile.htm");
exit();
}*/

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
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
if($type != "" && $type != "all" & $type != "reply" && $type != "send_reply") {
redirect();	
}
if($type == "all") {
if($id != "") {
$new = ''.$site_name.'/'.index().'?mode=notifylist&id='.$id.'type=all';	
$lock = ''.$site_name.'/'.index().'?mode=notifylist&id='.$id.'&type=all&method=lock';
$admin = ''.$site_name.'/'.index().'?mode=notifylist&id='.$id.'&type=all&method=admin';
} else {
$new = ''.$site_name.'/'.index().'?mode=notifylist&type=all';	
$lock = ''.$site_name.'/'.index().'?mode=notifylist&type=all&method=lock';
$admin = ''.$site_name.'/'.index().'?mode=notifylist&type=all&method=admin';
}	
} else {	
$new = ''.$site_name.'/'.index().'?mode=notifylist&f='.$f.'';	
$lock = ''.$site_name.'/'.index().'?mode=notifylist&f='.$f.'&method=lock';
$admin = ''.$site_name.'/'.index().'?mode=notifylist&f='.$f.'&method=admin';
}
$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


$Monitor = chk_monitor($DBMemberID, cat_id($f));
$Moderator = chk_moderator($DBMemberID, $f);

if ($method == "admin") {
$status = "AND STATUS = '2'";
}
if ($method == "lock") {
$status = "AND STATUS = '0'";
}
if ($method == "") {
$status = "AND STATUS = '1'";
}

if($type == "all") {
if ($Mlevel > 1) {

echo'
<center>
<table bgcolor="gray" cellSpacing="0" cellPadding="0" width="99%" height="8%" border="0">
	<tr>
		<td width=100% class=optionsbar_menus><font color=red size=+1>'.$lang['notify']['member_notify'].'</font></td>
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['notify']['notify_type'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
   <option value="'.$new.'" '.check_select($url, $new).'>'.$lang['notify']['new_notify'].'</option>
    <option value="'.$lock.'" '.check_select($url, $lock).'>'.$lang['notify']['closed_notify'].'</option>
    <option value="'.$admin.'" '.check_select($url, $admin).'>'.$lang['notify']['admin_notify'].'</option>
</select>  
					</td>
					</form>';
				refresh_time();
                go_to_forum();
echo'
	</tr>
</table><br>

<table bgcolor="gray" class="grid" dir="rtl" cellSpacing="0" cellPadding="0" width="99%" align="center" border="0">
			<tr>
				<td>
				<table dir="rtl" cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="45%">'.$lang['notify']['forum_topic'].'</td>
						<td class="cat">'.$lang['notify']['notify_to'].'</td>
						<td class="cat"">'.$lang['notify']['notify_author'].'</td>
						<td class="cat">'.$lang['notify']['last_note'].'</td>
						<td class="cat">'.$lang['notify']['the_replies'].'</td>
						<td class="cat">'.$lang['notify']['to_admin'].'</td>';
if($id != "") {
 $query = "SELECT * FROM " . $Prefix . "NOTIFY AS N WHERE FORUM_ID IN (".chk_allowed_forums_all_id().") AND AUTHOR_ID = '$id' ".$status."";
} else {
$query = "SELECT * FROM " . $Prefix . "NOTIFY AS N WHERE FORUM_ID IN (".chk_allowed_forums_all_id().") ".$status."";
}	
 $query .= " ORDER BY DATE DESC";
 $result = @DBi::$con->query($query) or die (DBi::$con->error);

 $num = @mysqli_num_rows($result);

	if ($num <= 0) {


                      echo'
                      <tr>
                          <td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$lang['notify']['no_notify'].'<br><br><br></td>
                      </tr>';
	}
	
	$i=0;
	while ($i < $num) {

    $Notify_ID = @mysqli_result($result, $i, "NOTIFY_ID");
    $Notify['Status'] = @mysqli_result($result, $i, "STATUS");
    $Notify['ForumID'] = @mysqli_result($result, $i, "FORUM_ID");
    $Notify['TopicID'] = @mysqli_result($result, $i, "TOPIC_ID");
    $Notify['ReplyID'] = @mysqli_result($result, $i, "REPLY_ID");
    $Notify['AuthorID'] = @mysqli_result($result, $i, "AUTHOR_ID");
    $Notify['AuthorName'] = @mysqli_result($result, $i, "AUTHOR_NAME");
    $Notify['PostAuthorID'] = @mysqli_result($result, $i, "POSTAUTHOR_ID");
    $Notify['PostAuthorName'] = @mysqli_result($result, $i, "POSTAUTHOR_NAME");
    $Notify['Date'] = @mysqli_result($result, $i, "DATE");
    $Notify['Type'] = @mysqli_result($result, $i, "TYPE");
    $Notify['Subject'] = @mysqli_result($result, $i, "SUBJECT");
    $Notify['r_ID'] = @mysqli_result($result, $i, "R_ID");
    $Notify['r_msg'] = @mysqli_result($result, $i, "R_MSG");
    $Notify['r_date'] = @mysqli_result($result, $i, "R_DATE");
    $Notify['Note_by'] = @mysqli_result($result, $i, "NOTE_BY");
    $Notify['Notes'] = @mysqli_result($result, $i, "NOTES");
    $Notify['Note_Date'] = @mysqli_result($result, $i, "NOTE_DATE");
    $Notify['Tr_by'] = @mysqli_result($result, $i, "TRANSFER_BY");
    $Notify['Tr_Date'] = @mysqli_result($result, $i, "TRANSFER_DATE");
    $Notify['Done'] = @mysqli_result($result, $i, "N_DONE");

 $queryT = "SELECT * FROM " . $Prefix . "TOPICS WHERE TOPIC_ID = '" .$Notify['TopicID']. "' ";
 $resultT = @DBi::$con->query($queryT, $connection) or die (DBi::$con->error);

 if(@mysqli_num_rows($resultT) > 0){
 $rsT = @mysqli_fetch_array($resultT);

 $Topic_ID = $rsT['TOPIC_ID'];
 $Topic_Subject = $rsT['T_SUBJECT'];
 $Topic_Archive = $rsT['T_ARCHIVED'];
 }

 $AuthorID .= "WHERE MEMBER_ID = '" .$Notify['AuthorID']. "' OR MEMBER_ID = '" .$Notify['PostAuthorID']. "' OR MEMBER_ID = '" .$Notify['r_ID']. "' OR MEMBER_ID = '" .$Notify['Note_by']. "' OR MEMBER_ID = '" .$Notify['Tr_by']. "' ";

 $PostAuthorID = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['PostAuthorID']. "' ";
 $resultPoAuID = @DBi::$con->query($PostAuthorID, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultPoAuID) > 0){
 $rsPoAuID = @mysqli_fetch_array($resultPoAuID);

 $PoAuIDMemID = $rsPoAuID['MEMBER_ID'];
 $PoAuIDMemName = $rsPoAuID['M_NAME'];
 }

 $AuthorID = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['AuthorID']. "' ";
 $resultAuID = @DBi::$con->query($AuthorID, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultAuID) > 0){
 $rsAuID = @mysqli_fetch_array($resultAuID);

 $AuIDMemID = $rsAuID['MEMBER_ID'];
 $AuIDMemName = $rsAuID['M_NAME'];
 }

 $r_ID = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['r_ID']. "' ";
 $resultr_ID = DBi::$con->query($r_ID, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultr_ID) > 0){
 $rsr_ID = @mysqli_fetch_array($resultr_ID);

 $r_IDMemID = $rsr_ID['MEMBER_ID'];
 $r_IDMemName = $rsr_ID['M_NAME'];
 }

 $Note_by = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['Note_by']. "' ";
 $resultNo = @DBi::$con->query($Note_by, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultNo) > 0){
 $rsNo = @mysqli_fetch_array($resultNo);

 $NoMemID = $rsNo['MEMBER_ID'];
 $NoMemName = $rsNo['M_NAME'];
 }

 $Tr_by = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['Tr_by']. "' ";
 $resultTr = @DBi::$con->query($Tr_by, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultTr) > 0){
 $rsTr = @mysqli_fetch_array($resultTr);

 $TrMemID = $rsTr['MEMBER_ID'];
 $TrMemName = $rsTr['M_NAME'];
 }

if ($Notify['Status'] == 0) {
	$cl = "deleted";
}
elseif ($Notify['Status'] == 1) {
	$cl = "normal";
}
elseif ($Notify['Status'] == 2) {
	$cl = "fixed";
}

echo '
		<tr class="'.$cl.'">
			<td class=list nowrap><a href="index.php?mode=notifylist&f='.$Notify['ForumID'].'&type=reply&n='.$Notify_ID.'"><font size=-1>'.forum_name($Notify['ForumID']).':<br>
			';
			if($Topic_Archive == 1) {
			echo'<font color="red"'.$lang['notify']['archive_notify'].' </font>';
			}
			echo'
			'.$Topic_Subject.'
			
			</a></td>
			<td class=list_small2 nowrap>'.link_profile($PoAuIDMemName, $PoAuIDMemID, $Prefix).'<br>'.$Notify['Type'].'</td>
			<td class=list_small2 nowrap><font color=green>'.normal_time($Notify['Date']).'</font><br>'.link_profile($AuIDMemName, $AuIDMemID, $Prefix).'</td>
			<td class=list_small2 nowrap><font color=green>';if($NoMemName){echo normal_time($Notify['Note_Date']);}echo'</font><br>'.link_profile($NoMemName, $NoMemID, $Prefix).'</td>
			<td class=list_small2 nowrap><font color=green>';if($r_IDMemName){echo normal_time($Notify['r_date']);}echo'</font><br>'.link_profile($r_IDMemName, $r_IDMemID, $Prefix).'</td>
			<td class=list_small2 nowrap><font color=green>';if($TrMemName){echo normal_time($Notify['Tr_Date']);}echo'</font><br>'.link_profile($TrMemName, $TrMemID, $Prefix).'</td>
		</tr>';

	    ++$i;
	}
echo '</td></tr></table>
</td></tr></table></center>';

echo'		<table bgcolor="#FFFFFF" width="35%">
		<td>
		<tr>
			<td><table border=1 cellspacing=1><tr class="normal">
			<td>&nbsp;&nbsp;&nbsp;</td></tr></table></td><td>'.$lang['notify']['no_reply_notify'].'</td>
			<td><table border=1 cellspacing=1><tr class="fixed">
			<td>&nbsp;&nbsp;&nbsp;</td></tr></table></td><td>'.$lang['notify']['it_admin_notify'].'</td>
			<td><table border=1 cellspacing=1><tr class="deleted">
			<td>&nbsp;&nbsp;&nbsp;</td></tr></table></td><td>'.$lang['notify']['reply_notify'].'</td>
		</tr>
		</td>
		</table>';
}
    else {
    redirect();
    }
}



if($type == "") {
if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {

echo'
<center>
<table bgcolor="gray" cellSpacing="0" cellPadding="0" width="99%" height="8%" border="0">
	<tr>
		<td width=100% class=optionsbar_menus><font color=red size=+1>'.$lang['notify']['member_notify'].'</font></td>
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['notify']['notify_type'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
   <option value="'.$new.'" '.check_select($url, $new).'>'.$lang['notify']['new_notify'].'</option>
    <option value="'.$lock.'" '.check_select($url, $lock).'>'.$lang['notify']['closed_notify'].'</option>
    <option value="'.$admin.'" '.check_select($url, $admin).'>'.$lang['notify']['admin_notify'].'</option>
</select>  
					</td>
					</form>';
				refresh_time();
				go_to_forum();
echo'
	</tr>
</table><br>

<table bgcolor="gray" bgcolor="gray" class="grid" dir="rtl" cellSpacing="0" cellPadding="0" width="99%" align="center" border="0">
			<tr>
				<td>
				<table dir="rtl" cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="45%">'.$lang['notify']['forum_topic'].'</td>
						<td class="cat">'.$lang['notify']['notify_to'].'</td>
						<td class="cat"">'.$lang['notify']['notify_author'].'</td>
						<td class="cat">'.$lang['notify']['last_note'].'</td>
						<td class="cat">'.$lang['notify']['the_replies'].'</td>
						<td class="cat">'.$lang['notify']['to_admin'].'</td>';

 $query = "SELECT * FROM " . $Prefix . "NOTIFY AS N WHERE FORUM_ID = '" .$f."' ".$status."";
 $query .= " ORDER BY DATE DESC";
 $result = @DBi::$con->query($query) or die (DBi::$con->error);

 $num = @mysqli_num_rows($result);

	if ($num <= 0) {


                      echo'
                      <tr>
                          <td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$lang['notify']['no_notify_forum'].'<br><br><br></td>
                      </tr>';
	}
	
	$i=0;
	while ($i < $num) {

    $Notify_ID = @mysqli_result($result, $i, "NOTIFY_ID");
    $Notify['Status'] = @mysqli_result($result, $i, "STATUS");
    $Notify['ForumID'] = @mysqli_result($result, $i, "FORUM_ID");
    $Notify['TopicID'] = @mysqli_result($result, $i, "TOPIC_ID");
    $Notify['ReplyID'] = @mysqli_result($result, $i, "REPLY_ID");
    $Notify['AuthorID'] = @mysqli_result($result, $i, "AUTHOR_ID");
    $Notify['AuthorName'] = @mysqli_result($result, $i, "AUTHOR_NAME");
    $Notify['PostAuthorID'] = @mysqli_result($result, $i, "POSTAUTHOR_ID");
    $Notify['PostAuthorName'] = @mysqli_result($result, $i, "POSTAUTHOR_NAME");
    $Notify['Date'] = @mysqli_result($result, $i, "DATE");
    $Notify['Type'] = @mysqli_result($result, $i, "TYPE");
    $Notify['Subject'] = @mysqli_result($result, $i, "SUBJECT");
    $Notify['r_ID'] = @mysqli_result($result, $i, "R_ID");
    $Notify['r_msg'] = @mysqli_result($result, $i, "R_MSG");
    $Notify['r_date'] = @mysqli_result($result, $i, "R_DATE");
    $Notify['Note_by'] = @mysqli_result($result, $i, "NOTE_BY");
    $Notify['Notes'] = @mysqli_result($result, $i, "NOTES");
    $Notify['Note_Date'] = @mysqli_result($result, $i, "NOTE_DATE");
    $Notify['Tr_by'] = @mysqli_result($result, $i, "TRANSFER_BY");
    $Notify['Tr_Date'] = @mysqli_result($result, $i, "TRANSFER_DATE");
    $Notify['Done'] = @mysqli_result($result, $i, "N_DONE");

 $queryT = "SELECT * FROM " . $Prefix . "TOPICS WHERE TOPIC_ID = '" .$Notify['TopicID']. "' ";
 $resultT = @DBi::$con->query($queryT, $connection) or die (DBi::$con->error);

 if(@mysqli_num_rows($resultT) > 0){
 $rsT = @mysqli_fetch_array($resultT);

 $Topic_ID = $rsT['TOPIC_ID'];
 $Topic_Subject = $rsT['T_SUBJECT'];
  $Topic_Archive = $rsT['T_ARCHIVED'];
 }

 $AuthorID .= "WHERE MEMBER_ID = '" .$Notify['AuthorID']. "' OR MEMBER_ID = '" .$Notify['PostAuthorID']. "' OR MEMBER_ID = '" .$Notify['r_ID']. "' OR MEMBER_ID = '" .$Notify['Note_by']. "' OR MEMBER_ID = '" .$Notify['Tr_by']. "' ";

 $PostAuthorID = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['PostAuthorID']. "' ";
 $resultPoAuID = @DBi::$con->query($PostAuthorID, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultPoAuID) > 0){
 $rsPoAuID = @mysqli_fetch_array($resultPoAuID);

 $PoAuIDMemID = $rsPoAuID['MEMBER_ID'];
 $PoAuIDMemName = $rsPoAuID['M_NAME'];
 }

 $AuthorID = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['AuthorID']. "' ";
 $resultAuID = @DBi::$con->query($AuthorID, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultAuID) > 0){
 $rsAuID = @mysqli_fetch_array($resultAuID);

 $AuIDMemID = $rsAuID['MEMBER_ID'];
 $AuIDMemName = $rsAuID['M_NAME'];
 }

 $r_ID = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['r_ID']. "' ";
 $resultr_ID = DBi::$con->query($r_ID, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultr_ID) > 0){
 $rsr_ID = @mysqli_fetch_array($resultr_ID);

 $r_IDMemID = $rsr_ID['MEMBER_ID'];
 $r_IDMemName = $rsr_ID['M_NAME'];
 }

 $Note_by = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['Note_by']. "' ";
 $resultNo = @DBi::$con->query($Note_by, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultNo) > 0){
 $rsNo = @mysqli_fetch_array($resultNo);

 $NoMemID = $rsNo['MEMBER_ID'];
 $NoMemName = $rsNo['M_NAME'];
 }

 $Tr_by = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$Notify['Tr_by']. "' ";
 $resultTr = @DBi::$con->query($Tr_by, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultTr) > 0){
 $rsTr = @mysqli_fetch_array($resultTr);

 $TrMemID = $rsTr['MEMBER_ID'];
 $TrMemName = $rsTr['M_NAME'];
 }

if ($Notify['Status'] == 0) {
	$cl = "deleted";
}
elseif ($Notify['Status'] == 1) {
	$cl = "normal";
}
elseif ($Notify['Status'] == 2) {
	$cl = "fixed";
}

echo '
		<tr class="'.$cl.'">
			<td class=list nowrap><a href="index.php?mode=notifylist&f='.$Notify['ForumID'].'&type=reply&n='.$Notify_ID.'"><font size=-1>'.forum_name($Notify['ForumID']).':<br>
			
			';
			if($Topic_Archive == 1) {
			echo'<font color="red">'.$lang['notify']['archive_notify'].' </font>';
			}
			echo'
			'.$Topic_Subject.'
			
			</a></td>
			<td class=list_small2 nowrap>'.link_profile($PoAuIDMemName, $PoAuIDMemID, $Prefix).'<br>'.$Notify['Type'].'</td>
			<td class=list_small2 nowrap><font color=green>'.normal_time($Notify['Date']).'</font><br>'.link_profile($AuIDMemName, $AuIDMemID, $Prefix).'</td>
			<td class=list_small2 nowrap><font color=green>';if($NoMemName){echo normal_time($Notify['Note_Date']);}echo'</font><br>'.link_profile($NoMemName, $NoMemID, $Prefix).'</td>
			<td class=list_small2 nowrap><font color=green>';if($r_IDMemName){echo normal_time($Notify['r_date']);}echo'</font><br>'.link_profile($r_IDMemName, $r_IDMemID, $Prefix).'</td>
			<td class=list_small2 nowrap><font color=green>';if($TrMemName){echo normal_time($Notify['Tr_Date']);}echo'</font><br>'.link_profile($TrMemName, $TrMemID, $Prefix).'</td>
		</tr>';

	    ++$i;
	}
echo '</td></tr></table>
</td></tr></table></center>';

echo'		<table bgcolor="#FFFFFF" width="35%">
		<td>
		<tr>
			<td><table border=1 cellspacing=1><tr class="normal">
			<td>&nbsp;&nbsp;&nbsp;</td></tr></table></td><td>'.$lang['notify']['no_reply_notify'].'</td>
			<td><table border=1 cellspacing=1><tr class="fixed">
			<td>&nbsp;&nbsp;&nbsp;</td></tr></table></td><td>'.$lang['notify']['it_admin_notify'].'</td>
			<td><table border=1 cellspacing=1><tr class="deleted">
			<td>&nbsp;&nbsp;&nbsp;</td></tr></table></td><td>'.$lang['notify']['reply_notify'].'</td>
		</tr>
		</td>
		</table>';
}
    else {
    redirect();
    }
}

if ($type == "reply") {
if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {

 $queryR = "SELECT * FROM " . $Prefix . "NOTIFY WHERE NOTIFY_ID = '" .$n. "' ";
 $resultR = @DBi::$con->query($queryR, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultR) > 0){
 $rsR = @mysqli_fetch_array($resultR);

 $Notify_ID = $rsR['NOTIFY_ID'];
 $N_ForumID = $rsR['FORUM_ID'];
 $N_TopicID = $rsR['TOPIC_ID'];
 $N_TopicArchive = topics("ARCHIVED", $N_TopicID);
 $N_ReplyID = $rsR['REPLY_ID'];
 $N_AuthorID = $rsR['AUTHOR_ID'];
 $N_AuthorName = $rsR['AUTHOR_NAME'];
 $N_PostAuthorID = $rsR['POSTAUTHOR_ID'];
 $N_PostAuthorName = $rsR['POSTAUTHOR_NAME'];
 $N_Date = $rsR['DATE'];
 $N_Type = $rsR['TYPE'];
 $N_Subject = $rsR['SUBJECT'];
 $N_r_ID = $rsR['R_ID'];
 $N_r_msg = $rsR['R_MSG'];
 $N_r_date = $rsR['R_DATE'];
 $N_Note_by = $rsR['NOTE_BY'];
 $N_Notes = $rsR['NOTES'];
 $N_Note_Date = $rsR['NOTE_DATE'];
 }

 $reply_ID = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$N_r_ID. "' ";
 $resultreply_ID = @DBi::$con->query($reply_ID, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultreply_ID) > 0){
 $rsreply_ID = @mysqli_fetch_array($resultreply_ID);

 $replyMemID = $rsreply_ID['MEMBER_ID'];
 $replyMemName = $rsreply_ID['M_NAME'];
 }

 $note_by = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$N_Note_by. "' ";
 $resultnote_by = @DBi::$con->query($note_by, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultnote_by) > 0){
 $rsnote_by = @mysqli_fetch_array($resultnote_by);

 $NoteMemID = $rsnote_by['MEMBER_ID'];
 $NoteIDMemName = $rsnote_by['M_NAME'];
 }

echo '
<table bgcolor="gray" class="grid" dir="rtl" cellSpacing="0" cellPadding="0" width="60%" align="center" border="0">
	<tr>
		<td>
		<table dir="rtl" cellSpacing="1" cellPadding="1" width="100%" border="0">
			<tr>
				<td class="cat" colspan="2">'.$lang['notify']['notify_number'].' '.$Notify_ID.'</td>
			</tr>
			<tr class="fixed">
				<td class="list_small2" width="20%">'.$lang['notify']['forum_topic'].'</td>
				<td class="list_small">
				<table cellspacing="0" cellpadding="0" align="right">
				<tr>
				<td>&nbsp;';
				if($N_TopicArchive == 1) {
				echo'<font color="red">'.$lang['notify']['archive_notify'].'</font>
				'.forum_name($N_ForumID).'
				';
				} else {
				echo'
				'.forum_name($N_ForumID).'
				';
				}
				echo'
				:<br><a href="index.php?mode=t&t='.$N_TopicID.'';
				if ($N_ReplyID > 0) {
				echo '&r='.$N_ReplyID.'';
				}
			echo'	">&nbsp;'.topics("SUBJECT", $N_TopicID).'</a></td></tr>
				</table></td>
			</tr>
			<tr class="fixed">
				<td class="list_small2" width="20%">'.$lang['notify']['notify_to'].'</td>
				<td class="list_small">
				<table cellspacing="0" cellpadding="0" align="right">
				<tr>
				<td>&nbsp;'.link_profile($N_PostAuthorName, $N_PostAuthorID, $Prefix).'<br><font color="darkblue">&nbsp;'.$N_Type.'</font></td></tr>
				</table></td>
			</tr>
			<tr class="fixed">
				<td class="list_small2" width="20%">'.$lang['notify']['notify_author'].'</td>
				<td class="list_small">
				<table cellspacing="0" cellpadding="0" align="right">
				<tr>
				<td>&nbsp;'.normal_time($N_Date).'<br>&nbsp;'.link_profile($N_AuthorName, $N_AuthorID, $Prefix).'</td></tr>
				</table></td>
			</tr>
			<tr class="fixed">
				<td class="list_small2" width="20%">'.$lang['notify']['notify_message'].'</td>
				<td class="list_small">
				<table cellspacing="0" cellpadding="0" align="right">
				<tr>
				<td><font color="red">&nbsp;'.$N_Subject.'</font></td></tr>
				</table></td>
			</tr>';
		if ($replyMemName != "") {
		echo'	<tr class="fixed">
				<td class=list_small2>'.$lang['notify']['the_replies'].'</td>
				<td class=list nowrap><font color="darkgreen">&nbsp;'.normal_time($N_r_date).'</font><br>&nbsp;'.link_profile($replyMemName, $replyMemID, $Prefix).'</td>
			</tr>
			<tr class = "fixed">
				<td class=list_small2>'.$lang['notify']['reply_message'].'</td>
				<td class=list>'.$N_r_msg.'</td>
			</tr>';
		}
		if ($N_Notes != "") {
		echo'	<tr class="fixed">
				<td class=list_small2>'.$lang['notify']['notes'].'</td>
				<td class=list><font size=-1 color=red>'.$N_Notes.'</td>
			</tr>';
		}
	echo'	
		<table border=0 cellpadding=4 cellspacing=1 width="100%" bgcolor="gray">
		<form method="POST" action="index.php?mode=notifylist&f='.$N_ForumID.'&type=send_reply" name="NotifyReply">
		<input type="hidden" name="notify_id" value="'.$Notify_ID.'">
		<input type="hidden" name="author_id" value="'.$N_AuthorID.'">
		<input type="hidden" name="forum_id" value="'.$N_ForumID.'">
		<input type="hidden" name="subject" value="'.$N_Subject.'">
			<tr class=fixed>
				<td class=optionheader colspan="4">
				'.$lang['notify']['reply_message_to_member'].'<br>
				<textarea class=insidetitle type=text style="width:500;height:150" name=notifyreply>'.$N_r_msg.'</textarea><br>
				'.$lang['notify']['reply_notes_mod'].'<br>
				<textarea class=insidetitle type=text style="width:500;height:150" name=notifynotes>'.$N_Notes.'</textarea><br>
				</td>
			</tr>
			<tr class=fixed>
				<td colSpan="4" class=list_center>
				<input name="store_notes" type=submit value="'.$lang['notify']['enter_notes'].'">
				&nbsp;&nbsp;&nbsp;<input name="send_admin" type=submit value="'.$lang['notify']['send_to_admin'].'">
				&nbsp;&nbsp;&nbsp;<input name="close_notify" type=submit value="'.$lang['notify']['close_notify'].'">
				&nbsp;&nbsp;&nbsp;<input name="send_reply" type=submit value="'.$lang['notify']['send_reply'].'">
				</td>
			</tr>
		</form>
		</table>
		</td>
	</tr>
</table>';
echo'
<center>
<table bgcolor="gray" cellSpacing="0" cellPadding="0" width="59.9%"  height="8%" border="0">
	<tr>
		<td width=100% class=optionsbar_menus><a class="menu" href="index.php?mode=notifylist&f='.$N_ForumID.'"><font size=+1>'.$lang['notify']['go_to_notify_forum'].' '.forum_name($N_ForumID).'</font></td>
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['notify']['notify_type'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
   <option value="'.$new.'" '.check_select($url, $new).'>'.$lang['notify']['new_notify'].'</option>
    <option value="'.$lock.'" '.check_select($url, $lock).'>'.$lang['notify']['closed_notify'].'</option>
    <option value="'.$admin.'" '.check_select($url, $admin).'>'.$lang['notify']['admin_notify'].'</option>
</select>  
					</td>
					</form>';
				refresh_time();
				go_to_forum();
echo'
	</tr>
</table>';
}
    else {
    redirect();
    }
}

if ($type == "send_reply") {
if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {

$Notify_ID = DBi::$con->real_escape_string(htmlspecialchars($_POST['notify_id']));
$Author_ID = DBi::$con->real_escape_string(htmlspecialchars($_POST['author_id']));
$store_notes = DBi::$con->real_escape_string(htmlspecialchars($_POST['store_notes']));
$send_admin = DBi::$con->real_escape_string(htmlspecialchars($_POST['send_admin']));
$close_notify = DBi::$con->real_escape_string(htmlspecialchars($_POST['close_notify']));
$send_reply = DBi::$con->real_escape_string(htmlspecialchars($_POST['send_reply']));
$Forum_ID = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));
$N_Subject = DBi::$con->real_escape_string(htmlspecialchars($_POST['subject']));
$NotifyReply = DBi::$con->real_escape_string(htmlspecialchars($_POST['notifyreply']));
$NotifyNotes = DBi::$con->real_escape_string(htmlspecialchars($_POST['notifynotes']));
$notify_date = time();
$moderator_forum = forum_name($Forum_ID);
$pm_mid = '-'.$Forum_ID;
$pm_subject = ''.$lang['notify']['reply_your_notify'].' '.$moderator_forum.'';
$pm_message = '
		'.$lang['notify']['notify_message_part1'].' '.$moderator_forum.':<br>
		<font color="red">____________________________________________________________________</font><br><br>
		'.$N_Subject.'<br>
		<font color="red">____________________________________________________________________</font><br><br>
		'.$lang['notify']['notify_message_part2'].'<br>
		<font color="red">____________________________________________________________________</font><br><br>
		'.$NotifyReply.'';

if ($send_reply != "") {
if ($NotifyReply == "") {
    $error = $lang['notify']['no_reply_enter'];
}
}
if ($store_notes != "") {
if ($NotifyNotes == "") {
    $error = $lang['notify']['no_notes_enter'];
}
}

if ($error != "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$error.'..</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

if ($error == "") {
     
	$query = "UPDATE " . $Prefix . "NOTIFY SET ";
    if ($send_reply != "") {
	$query .= "R_ID = '$DBMemberID', ";
	$query .= "R_MSG = '$NotifyReply', ";
	$query .= "R_DATE = '$notify_date', ";
	$query .= "N_DONE = '1', ";
	$query .= "STATUS = '0', ";
	$query .= "NOTE_BY = '$DBMemberID', ";
	if($NotifyNotes == "") {
	$query .= "NOTES = '$NotifyReply', ";
	} else {
	$query .= "NOTES = '$NotifyNotes', ";
	}	
	$query .= "NOTE_DATE = '$notify_date' ";	
    }
    if ($store_notes != "") {
	$query .= "NOTE_BY = '$DBMemberID', ";
	$query .= "NOTES = '$NotifyNotes', ";
	$query .= "NOTE_DATE = '$notify_date' ";
    }
    if ($send_admin) {
	$query .= "TRANSFER_BY = '$DBMemberID', ";
	$query .= "TRANSFER_DATE = '$notify_date', ";
	$query .= "STATUS = '2' ";
    }
    if ($close_notify) {
	$query .= "STATUS = '0' ";
    }
	$query .= "WHERE NOTIFY_ID = '$Notify_ID' ";

	@DBi::$con->query($query) or die (DBi::$con->error);

if ($send_reply) {

     $query1 = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
     $query1 .= " '$pm_mid', ";
     $query1 .= " '$Author_ID', ";
     $query1 .= " '$pm_mid', ";
     $query1 .= " '1', ";
     $query1 .= " '$pm_subject', ";
     $query1 .= " '$pm_message', ";
     $query1 .= " '$notify_date') ";

     @DBi::$con->query($query1, $connection) or die (DBi::$con->error);

     $query2 = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
     $query2 .= " '$Author_ID', ";
     $query2 .= " '$Author_ID', ";
     $query2 .= " '$pm_mid', ";
     $query2 .= " '$pm_subject', ";
     $query2 .= " '$pm_message', ";
     $query2 .= " '$notify_date') ";

     @DBi::$con->query($query2, $connection) or die (DBi::$con->error);

}

if ($send_reply) {
$text = $lang['notify']['done_send_reply'];
}
if ($store_notes) {
$text = $lang['notify']['done_add_notes'];
}
if ($send_admin) {
$text = $lang['notify']['done_send_admin'];
}
if ($close_notify) {
$text = $lang['notify']['done_close_notify'];
}

			if(allowed($Forum_ID, 2) == 1) {
			DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
			}
			
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5">'.$text.'</font><br><br>
	                       <meta http-equiv="Refresh" content="2; URL=index.php?mode=notifylist&f='.$Forum_ID.'&type=reply&n='.$Notify_ID.'">
	                       <a href="index.php?mode=notifylist&f='.$Forum_ID.'&type=reply&n='.$Notify_ID.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
					
					
					
}

}
    else {
    redirect();
    }
}

@mysqli_close();

?>