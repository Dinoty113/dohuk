<?
if (@eregi("open.php","$_SERVER[PHP_SELF]")) {
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

if($type != "hold" && $type != "m" && $type != "c" && $type != "f" && $type != "ads" && $type != "tt" && $type != "ar" && $type != "uar" && $type != "h" && $type != "rr" && $type != "t" && $type != "s" && $type != "pm" && $type != "hr") {
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
if(members("HOLDED", $m) == 0) {
echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang['others']['unhold_membere'].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
	}
    if ($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_HOLDED_M == 1)) {
		$query = "UPDATE " . $Prefix . "MEMBERS SET M_HOLDED = ('0'), M_HOLDED_BY = (''), M_HOLDED_DATE = ('') WHERE MEMBER_ID = '$m' ";
		@DBi::$con->query($query) or die (DBi::$con->error);


			if($Mlevel > 2) {
			DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
			}
			
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['others']['done_unholded'].'</font><br><br>
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
if(members("STATUS", $m) == 1) {
echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[lock][member_is_opened].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
	}
    if ($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_OPEN_M == 1)) {
		$query = "UPDATE " . $Prefix . "MEMBERS SET M_STATUS = ('1') WHERE MEMBER_ID = '$m' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		
				$sql_lock = DBi::$con->query("SELECT * FROM ".prefix."MODERATION WHERE M_STATUS = '1' AND M_MEMBERID = '$m' AND M_FORUMID = '0' AND M_TOPICID = '0' AND M_REPLYID = '0' AND M_PM = '0' AND M_IHDAA = '0' AND M_TYPE = '5'");
				$sql_num_lock = mysqli_num_rows($sql_lock);
				$x_lock = 0;
				if($sql_num_lock > 0) {
				while($x_lock < $sql_num_lock) {
				$moderation_id = mysqli_result($sql_lock, $x_lock, "MODERATION_ID");	
				 $up = "UPDATE " . $Prefix . "MODERATION SET ";
			     $up .= "M_STATUS = '3', ";
			     $up .= "M_END = '$DBMemberID', ";
			     $up .= "M_DATEFIN = '".time()."' ";
			     $up .= "WHERE MODERATION_ID = '$moderation_id' ";
			     DBi::$con->query($up, $connection) or die (DBi::$con->error);
				 ++$x_lock;
				}
				}

			if($Mlevel > 2) {
			DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
			}		

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['open']['the_member_is_opened'].'</font><br><br>
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
		$query = "UPDATE " . $Prefix . "CATEGORY SET CAT_STATUS = ('1') WHERE CAT_ID = '$c' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		$query2 = "UPDATE " . $Prefix . "FORUM SET F_STATUS = ('1') WHERE CAT_ID = '$c' ";
		@DBi::$con->query($query2) or die (DBi::$con->error);	
		$query3 = "UPDATE " . $Prefix . "TOPICS SET T_STATUS = ('1') WHERE CAT_ID = '$c' ";
		@DBi::$con->query($query3) or die (DBi::$con->error);	
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['open']['the_cat_is_opened'].'</font><br><br>
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
		$query = "UPDATE " . $Prefix . "FORUM SET F_STATUS = ('1') WHERE FORUM_ID = '$f' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		$query3 = "UPDATE " . $Prefix . "TOPICS SET T_STATUS = ('1') WHERE FORUM_ID = '$f' ";
		@DBi::$con->query($query3) or die (DBi::$con->error);		
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");


	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['open']['the_forum_is_opened'].'</font><br><br>
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
		$query = "UPDATE " . $Prefix . "ADS SET AD_STATUS = ('1') WHERE AD_ID = '$ad' ";
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
if($t_status != 1) {
    if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_STATUS = ('1') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("t", $t, "unlock");					
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
elseif ($type == "tt") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$t_status = topics("STATUS", $t);
$f = topics("FORUM_ID", $t);
if($t_status != 1) {
if(topics("ARCHIVED", $t) == 0 OR (topics("ARCHIVED", $t) == 1 && $Mlevel == 4)) {
    if ($Mlevel == 4 OR $Monitor == 1) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_STATUS = ('1') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("t", $t, "undelete");							
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}

					header("Location: ".$HTTP_REFERER."");

				
    }
    else {
    redirect();
    }
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
if($t_sticky != 0) {
    if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_STICKY = ('0') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("t", $t, "unsticky");					
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
	$f = topics("FORUM_ID", $t);
$t_hidden = topics("HIDDEN", $t);
if($t_hidden != 0) {	
    if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_HIDDEN = ('0') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		hideTopic_info($DBMemberID, $t, "OPEN");
		tr_cmd("t", $t, "unhide");							
		DBi::$con->query("UPDATE ".prefix."REPLY SET R_T_HIDDEN = '0' WHERE TOPIC_ID = '$t'");
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
elseif ($type == "ar") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$t_archived = topics("ARCHIVED", $t);
if($t_archived != 1) {
    if ($Mlevel == 4) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_ARCHIVED= ('1') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		hideTopic_info($DBMemberID, $t, "OPEN");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");


					header("Location: ".$HTTP_REFERER."");

						
    }
    else {
    redirect();
    }
} else {
					header("Location: ".$HTTP_REFERER."");	
}	
}
elseif ($type == "uar") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$t_archived = topics("ARCHIVED", $t);
if($t_archived != 0) {
    if ($Mlevel == 4) {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_ARCHIVED= ('0') WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		hideTopic_info($DBMemberID, $t, "OPEN");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

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
if($r_hidden != 0) {	
    if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
		$query = "UPDATE " . $Prefix . "REPLY SET R_HIDDEN = '0' WHERE REPLY_ID = '$r' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		hideReply_info($DBMemberID, $r, "OPEN");
		tr_cmd("r", $r, "unhide");					
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
elseif ($type == "rr") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$r_status = replies("STATUS", $r);
$f = replies("FORUM_ID", $r);
if($r_status != 1) {
if(topics("ARCHIVED", $t) == 0 OR (topics("ARCHIVED", $t) == 1 && $Mlevel == 4)) {
    if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
		$query = "UPDATE " . $Prefix . "REPLY SET R_STATUS = '1' WHERE REPLY_ID = '$r' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("r", $r, "undelete");							
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}

					header("Location: ".$HTTP_REFERER."");

					
    }
    else {
    redirect();
    }
}
else {
redirect();	
}
} else {
					header("Location: ".$HTTP_REFERER."");	
}
}
elseif ($type == "pm") {

 $PM = @DBi::$con->query("SELECT * FROM ".$Prefix."PM WHERE PM_ID = '$msg' ") or die (DBi::$con->error);

 if(@mysqli_num_rows($PM) > 0){

 $rs_PM = @mysqli_fetch_array($PM);

 $PM_PmID = $rs_PM['PM_ID'];
 $PM_MID = $rs_PM['PM_MID'];
 }
	    if (($PM_MID == $DBMemberID or in_array(abs($PM_MID), chk_allowed_forums())) or ($Mlevel == 3 AND $deputy == 0 AND $CAN_SHOW_PM == 1)) {

        $query = "UPDATE " . $Prefix . "PM SET ";
        $query .= "PM_STATUS = 1 ";
        $query .= "WHERE PM_ID = '$msg' ";

        @DBi::$con->query($query) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['open']['the_pm_is_moved'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
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

@mysqli_close();
?>
