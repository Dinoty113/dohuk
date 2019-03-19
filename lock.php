<?
if (@eregi("lock.php","$_SERVER[PHP_SELF]")) {
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

$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
$Monitor = chk_monitor($DBMemberID, $c);
$Moderator = chk_moderator($DBMemberID, $f);
$date = time();

if($type != "hold" && $type != "m" && $type != "c" && $type != "f" && $type != "ads" && $type != "t" && $type != "s" && $type != "h" && $type != "hr" && $type != "check") {
redirect();	
}

if ($type == "hold") {
if($Mlevel == 4 or $Mlevel == 3 && $deputy == 0) {	
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
if($m == "" or $m == 0) {
redirect();	
}
if($m == 1 or members("LEVEL", $m) == 4 && $DBMemberID != 1) {
echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[lock][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
	}
if(members("LEVEL", $m) == 4 && $Mlevel == 3 && $deputy == 0 && $CAN_HOLDED_M == 1) {
echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[lock][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();	
}		
if(members("HOLDED", $m) == 1) {
echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang['others']['is_holded'].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
	}
    if ($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_HOLDED_M == 1)) {
		$query = "UPDATE " . $Prefix . "MEMBERS SET M_HOLDED = ('1'), M_HOLDED_BY = ('$DBMemberID'), M_HOLDED_DATE = ('$date') WHERE MEMBER_ID = '$m' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		

			if($Mlevel > 2) {
			DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
			}		

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['others']['done_holded'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    else {
    redirect();
    }
} else {
redirect();	
}	
}
 
elseif ($type == "m") {
if($Mlevel == 4 or $Mlevel == 3 && $deputy == 0) {		
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
if($m == "" or $m == 0) {
redirect();	
}	
if($m == 1 or members("LEVEL", $m) == 4 && $DBMemberID != 1) {
echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[lock][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
	}
if(members("LEVEL", $m) == 4 && $Mlevel == 3 && $deputy == 0 && $CAN_OPEN_M == 1) {
echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[lock][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();	
}	
if(members("STATUS", $m) == 0) {
echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[lock][member_is_locked].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
	}
    if ($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_CLOSE_M == 1)) {
		$query = "UPDATE " . $Prefix . "MEMBERS SET M_STATUS = ('0') WHERE MEMBER_ID = '$m' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MODERATION WHERE M_MEMBERID = '$m' AND M_TYPE = '5' AND M_STATUS = '0' AND M_FORUMID = '0' AND (M_TOPICID = '0' OR M_REPLYID = '0' OR M_PM = '0' OR M_IHDAA = '0')");
		$num = mysqli_num_rows($sql);
		if($num > 0) {
		$two_requests = "1";	
		}
		$the_raison = $lang['others']['done_lock_from_me'];
		$query2 = "INSERT INTO " . $Prefix . "MODERATION (MODERATION_ID, M_MEMBERID, M_STATUS, M_FORUMID, M_TOPICID, M_REPLYID, M_PM , M_IHDAA , M_ADDED, M_EXECUTE, M_MODERATOR_NOTES, M_MONITOR_NOTES, M_TYPE, M_RAISON, M_DATE, M_TWOREQUESTS, M_DATEAPP) VALUES (NULL, ";
		$query2 .= " '$m', ";
		$query2 .= " '1', ";
		$query2 .= " '0', ";
		$query2 .= " '0', ";
		$query2 .= " '0', ";
		$query2 .= " '0', ";
		$query2 .= " '0', ";
		$query2 .= " '$DBMemberID', ";
		$query2 .= " '$DBMemberID', ";
		$query2 .= " '$the_raison', ";
		$query2 .= " '$the_raison', ";		
		$query2 .= " '5', ";
		$query2 .= " '$the_raison', ";
		$query2 .= " '".time()."', ";
		$query2 .= " '$two_requests', ";
		$query2 .= " '".time()."') ";
		@DBi::$con->query($query2) or die (DBi::$con->error);
		

			if($Mlevel > 2) {
			DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
			}		

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['lock']['the_member_is_locked'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    else {
    redirect();
    }
} else {
redirect();	
}		
}

elseif ($type == "c") {
    if ($Mlevel == 4) {
		$query = "UPDATE " . $Prefix . "CATEGORY SET CAT_STATUS = ('0') WHERE CAT_ID = '$c' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		$query2 = "UPDATE " . $Prefix . "FORUM SET F_STATUS = ('0') WHERE CAT_ID = '$c' ";
		@DBi::$con->query($query2) or die (DBi::$con->error);	
		$query3 = "UPDATE " . $Prefix . "TOPICS SET T_STATUS = ('0') WHERE CAT_ID = '$c' ";
		@DBi::$con->query($query3) or die (DBi::$con->error);			
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");


	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['lock']['the_cat_is_locked'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    else {
    redirect();
    }
}
elseif ($type == "f") {
    if ($Mlevel == 4) {
		$query = "UPDATE " . $Prefix . "FORUM SET F_STATUS = ('0') WHERE FORUM_ID = '$f' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		$query3 = "UPDATE " . $Prefix . "TOPICS SET T_STATUS = ('0') WHERE FORUM_ID = '$f' ";
		@DBi::$con->query($query3) or die (DBi::$con->error);			
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");


	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['lock']['the_forum_is_locked'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    else {
    redirect();
    }
}
elseif ($type == "ads") {
    if ($Mlevel == 4) {
		$query = "UPDATE " . $Prefix . "ADS SET AD_STATUS = ('0') WHERE AD_ID = '$ad' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

  
						header("Location: ".$HTTP_REFERER."");

    }
    else {
    redirect();
    }
}

elseif ($type == "t") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$t_status = topics("STATUS", $t);
$f = topics("FORUM_ID", $t);
	if($t_status != 0) {
    if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_STATUS = ('0') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("t", $t, "lock");
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
  
					header("Location: ".$HTTP_REFERER."");

					
					
    }
    else {
    redirect();
    }
	} else {
					header("Location: ".$HTTP_REFERER."");
	}
}
elseif ($type == "s") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$t_sticky = topics("STICKY", $t);
$f = topics("FORUM_ID", $t);
if($t_sticky != 1) {
    if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_STICKY = ('1') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("t", $t, "sticky");
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}

					header("Location: ".$HTTP_REFERER."");

	
    }
    else {
    redirect();
    }
} else {
					header("Location: ".$HTTP_REFERER."");
}
}
elseif ($type == "h") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
	$t_hidden = topics("HIDDEN", $t);
	$f = topics("FORUM_ID", $t);	
	if($t_hidden != 1) {
    if ($Mlevel > 1) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_HIDDEN = ('1') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		hideTopic_info($DBMemberID, $t, "HIDE");
		tr_cmd("t", $t, "hide");
		topic_details($t);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
					header("Location: ".$HTTP_REFERER."");

					
    }
    else {
    redirect();
    }
	} else {
					header("Location: ".$HTTP_REFERER."");
	}
}
elseif ($type == "hr") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
	$f = replies("FORUM_ID", $r);
	$t = replies("TOPIC_ID", $r);
	$r_hidden = replies("HIDDEN", $r);
	if($r_hidden != 1) {
    if ($Mlevel > 1) {
		$query = "UPDATE " . $Prefix . "REPLY SET R_HIDDEN = '1' WHERE REPLY_ID = '$r' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		hideReply_info($DBMemberID, $r, "HIDE");
		tr_cmd("r", $r, "hide");	
		reply_details($r);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}

					header("Location: ".$HTTP_REFERER."");

					
    }
    else {
    redirect();
    }
	} else {
					header("Location: ".$HTTP_REFERER."");
	}
}

elseif ($type == "check") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$ps = $_POST['check'];
$f = $_POST['hidden_f'];
$t = $_POST['hidden_t'];
$c = $_POST['hidden_c'];

$Monitor = chk_monitor($DBMemberID, $c);
$Moderator = chk_moderator($DBMemberID, $f);

if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {

if($_POST['typehiddel'] == "hidden"){
$msg = $lang['others']['done_hide_this_replies'];
foreach ($ps as $value){
$query = "UPDATE " . $Prefix . "REPLY SET R_HIDDEN = '1' WHERE REPLY_ID = '$value' ";
@DBi::$con->query($query) or die (DBi::$con->error);
hideReply_info($DBMemberID, $r, "HIDE");
tr_cmd("r", $value, "hide");
reply_details($value);
$f = replies("FORUM_ID", $value);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
}
}

if($_POST['typehiddel'] == "delete"){
$msg = $lang['others']['done_delete_this_replies'];
foreach ($ps as $value){
$query = "UPDATE " . $Prefix . "REPLY SET R_STATUS = '2' WHERE REPLY_ID = '$value' ";
@DBi::$con->query($query) or die (DBi::$con->error);
tr_cmd("r", $value, "delete");
reply_details($value);
$f = replies("FORUM_ID", $r);
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
}
}

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$msg.'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="index.php?mode=t&t='.$t.'">'.$lang['all']['click_here_to_go_topic'].'</a><br><br>
                           <a href="index.php?mode=f&f='.$f.'">'.$lang['all']['click_here_to_go_forum'].'</a><br><br>
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
					
					
    }
    else {
    redirect();
    }
}
else {
redirect();
}

mysqli_close();
?>
