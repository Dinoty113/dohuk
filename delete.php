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
// # Email: admin@dahuk.info                                                   # //
// # Site: http://www.startimes.com/f.aspx?mode=f&f=211                        # //
// ############################################################################# //
/////////////////////////////////////////////////////////////////////////////////*/


function get_pm_mid($name, $id){
	$sql = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID = '$id' ") or die(DBi::$con->error);
	if(mysqli_num_rows($sql)>0){
		$rs = mysqli_fetch_array($sql);
		$pm_mid = Array(
			$rs['PM_MID']
		);
	}
	if ($name == "PM_MID"){$nom = 0;}
	return($pm_mid[$nom]);
}

$HTTP_REFERER = $_SERVER['HTTP_REFERER'];

$Monitor = chk_monitor($DBMemberID, $c);
$date = time();

	 if($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0)) {
 $posts = HoldPosts(posts($DBMemberID), $Mlevel, $deputy, $hold_posts, $hold_active);
 } else {
 $posts = posts($DBMemberID);
 }

 if($type != "c" && $type != "f" && $type != "m" && $type != "t_social" && $type != "del_mod" && $type != "del_mem" && $type != "ads" && $type != "t" && $type != "monitored" && $type != "r" && $type != "pm" && $type != "surveys" && $type != "ip" && $type != "titles" && $type != "groups" && $type != "special_medals_points" && $type != "medals" && $type != "plaques" && $type != "delete_mon") {
redirect();	
}
if($type == "delete_mon") {
if($id != "") {
if($Mlevel > 2) {
$status = moderation("STATUS", $id);
$f = moderation("FORUMID", $id);
if($status == 1) {
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font color="red" size="5"><br>'.$lang['others']['cant_delete_mon_is_now'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';		
} else {	
DBi::$con->query("DELETE FROM ".prefix."MODERATION WHERE MODERATION_ID = '$id'");
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}	
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['others']['done_delete_the_requestmon'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';	
}	
}
}	
}
elseif($type == "plaques") {
if($id != "") {
$f = medals("FORUM_ID", $id);
if(allowed($f, 2) == 1) {
DBi::$con->query("DELETE FROM ".prefix."MEDALS WHERE MEDAL_ID = '$id'");	
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_function']['done_delete_a_special_medals_points'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';	
} else {
redirect();	
}	
}	
}
elseif($type == "medals") {
if($id != "") {
$f = gm("FORUM_ID", $id);
if(allowed($f, 2) == 1) {
DBi::$con->query("DELETE FROM ".prefix."GLOBAL_MEDALS WHERE MEDAL_ID = '$id' AND SPECIAL = '0'");
DBi::$con->query("DELETE FROM ".prefix."MEDALS WHERE MEDAL_ID = '$id' AND SPECIAL = '0'");
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_function']['done_delete_a_medal'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
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
elseif($type == "special_medals_points") {
if($id != "") {
if($Mlevel == 4) {
DBi::$con->query("DELETE FROM ".prefix."GLOBAL_MEDALS WHERE MEDAL_ID = '$id' AND SPECIAL = '1'");
DBi::$con->query("DELETE FROM ".prefix."MEDALS WHERE MEDAL_ID = '$id' AND SPECIAL = '1'");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_function']['done_delete_a_special_medals_points'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
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
elseif($type == "groups") {
if($id != "") {
$f = groups("FORUM", $id);
if(allowed($f, 2) == 1) {
DBi::$con->query("DELETE FROM ".prefix."GROUPS WHERE G_ID = '$id'");
DBi::$con->query("DELETE FROM ".prefix."GROUPS_CHAT WHERE C_GROUP = '$id'");
DBi::$con->query("DELETE FROM ".prefix."GROUPS_MEMBERS WHERE M_GROUP = '$id'");
DBi::$con->query("DELETE FROM ".prefix."GROUPS_TRANS WHERE T_GROUP = '$id'");
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_function']['done_delete_a_group'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
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
elseif($type == "titles") {
if($id != "") {	
$f = gt("FORUM_ID", $id);
if(allowed($f, 2) == 1) {
DBi::$con->query("DELETE FROM ".prefix."GLOBAL_TITLES WHERE TITLE_ID = '$id'");
DBi::$con->query("DELETE FROM ".prefix."TITLES WHERE TITLE_ID = '$id'");
DBi::$con->query("DELETE FROM ".prefix."USED_TITLES WHERE TITLE_ID = '$id'");
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_function']['done_delete_a_title'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
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
elseif($type == "ip") {
if($id == "") {
$theid = $DBMemberID;	
}
if($Mlevel < 3) {
$theid = $DBMemberID;
}
if($Mlevel > 2 && $id != "") {
$theid = $id;	
}	
DBi::$con->query("DELETE FROM ".prefix."IP WHERE M_ID = '$theid'");
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_function']['done_delete_ip_list'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';		
}
elseif($type == "surveys") {
if($id != "") {
$f = surveys("FORUM_ID", $id);
if(allowed($f, 2) == 1) {
DBi::$con->query("DELETE FROM ".prefix."SURVEYS WHERE SURVEY_ID = '$id'");	
DBi::$con->query("DELETE FROM ".prefix."SURVEY_OPTIONS WHERE SURVEY_ID = '$id'");	
DBi::$con->query("DELETE FROM ".prefix."VOTES WHERE SURVEY_ID = '$id'");	
DBi::$con->query("UPDATE ".prefix."TOPICS SET T_SURVEYID = '0' WHERE T_SURVEYID = '$id'");
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['svc_function']['done_delete_survey'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
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
elseif ($type == "c") {
    if ($Mlevel == 4) {
		$query = "DELETE FROM " . $Prefix . "CATEGORY WHERE CAT_ID = '$c' ";
		@DBi::$con->query($query, $connection) or die (DBi::$con->error);
		$query2 = "DELETE FROM " . $Prefix . "FORUM WHERE CAT_ID = '$c' ";
		@DBi::$con->query($query2, $connection) or die (DBi::$con->error);
		@DBi::$con->query("DELETE FROM ".prefix."TOPICS WHERE CAT_ID = '$c'");
		@DBi::$con->query("DELETE FROM ".prefix."REPLY WHERE CAT_ID = '$c'");
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

  
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_cat_is_deleted'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL=index.php">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
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
		$query = "DELETE FROM " . $Prefix . "FORUM WHERE FORUM_ID = '$f' ";
		@DBi::$con->query($query, $connection) or die (DBi::$con->error);
		@DBi::$con->query("DELETE FROM ".prefix."TOPICS WHERE FORUM_ID = '$f'");
		@DBi::$con->query("DELETE FROM ".prefix."REPLY WHERE FORUM_ID = '$f'");		
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");


	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_forum_is_deleted'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL=index.php">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    else {
    redirect();
    }
}
elseif ($type == "m") {
    if ($Mlevel == 4) {
if($m == 1){
redirect();
exit();
}
if (members("THE_ID", $m) == 1 ) {
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

		$query = "DELETE FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '$m' ";
		@DBi::$con->query($query, $connection) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_member_is_deleted'].'</font><br><br>
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
elseif ($type == "del_mod") {
    if ($Mlevel == 4) {
		$query = "DELETE FROM " . $Prefix . "MODERATOR WHERE MOD_ID = '$m' ";
		DBi::$con->query($query, $connection) or die (DBi::$con->error);
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

  
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_mod_is_deleted'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="index.php?mode=add_cat_forum&method=edit&type=f&f='.$f.'">'.$lang['all']['click_here_to_go_moderator_list'].'</a><br><br>
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
elseif ($type == "del_mem") {
    if ($Mlevel == 4) {
		@DBi::$con->query("DELETE FROM ".$Prefix."HIDE_FORUM WHERE HF_ID = '$m' ") or die (DBi::$con->error);
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['others']['member_hide_deleted'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="index.php?mode=add_cat_forum&method=edit&type=f&f='.$f.'">'.$lang['others']['go_to_list_hide'].'</a><br><br>
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
		@DBi::$con->query("DELETE FROM ".$Prefix."ADS WHERE AD_ID = '$ad' ") or die (DBi::$con->error);
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['other']['done_delete_ad'].'</font><br><br>
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
elseif ($type == "t") {
	$f = topics("FORUM_ID", $t);
	$t_status = topics("STATUS", $t);
	if($t_status != 2 or $t_status == 2 && $Mlevel == 4) {
	if(topics("ARCHIVED", $t) == 0 OR (topics("ARCHIVED", $t) == 1 && $Mlevel == 4)) {
    if (allowed($f, 2) == 1) {
	if ($Mlevel == 4) {
		$query = "DELETE FROM ".prefix."TOPICS WHERE TOPIC_ID = '$t'";
		DBi::$con->query("DELETE FROM " . $Prefix . "REPLY WHERE TOPIC_ID = '$t'");
	}
	else {
		$query = "UPDATE " . $Prefix . "TOPICS SET T_STATUS = '2' WHERE TOPIC_ID = '$t' ";
		tr_cmd("t", $t, "delete");

	}
		@DBi::$con->query($query, $connection) or die (DBi::$con->error);

 		topic_details($t);
	

if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_topic_is_deleted'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL=index.php?mode=f&f='.$f.'">
                           <a href="index.php?mode=f&f='.$f.'">'.$lang['all']['click_here_to_go_forum'].'</a><br><br>
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
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
	} else {
				header("Location: ".$HTTP_REFERER."");	
	}
}
elseif ($type == "monitored") {
    if ($Mlevel > 0) {
		$query = "DELETE FROM " . $Prefix . "FAVOURITE_TOPICS WHERE F_TOPICID = '$t' AND F_MEMBERID = '$DBMemberID' ";
		@DBi::$con->query($query, $connection) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font color="red" size="5"><br>'.$lang['others']['monitor_deleted'].'</font><br><br>
                           <a href="index.php?mode=active&active=monitored">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    else {
    redirect();
    }
}
elseif ($type == "r") {
	$hidden = replies("HIDDEN", $r);
	$f = replies("FORUM_ID", $r);
	$t = replies("TOPIC_ID", $r);
	$author = replies("AUTHOR", $r);
	$r_status = replies("STATUS", $r);
	if($r_status != 2 or $r_status == 2 && $Mlevel == 4) {
	if(topics("ARCHIVED", $t) == 0 OR (topics("ARCHIVED", $t) == 1 && $Mlevel == 4)) {
    if (allowed($f, 2) == 1 OR $hidden != 1 AND $DBMemberID == $author) {
	if ($Mlevel == 4) {
		$query = "DELETE FROM " . $Prefix . "REPLY WHERE REPLY_ID = '$r' ";
	}
	else {
		$query = "UPDATE " . $Prefix . "REPLY SET R_STATUS = '2' WHERE REPLY_ID = '$r' ";
		tr_cmd("r", $r, "delete");

	}
		@DBi::$con->query($query, $connection) or die (DBi::$con->error);
		reply_details($r);
	
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_reply_is_deleted'].'</font><br><br>
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
	} else {
						header("Location: ".$HTTP_REFERER."");	
	}
}
elseif ($type == "pm") {

 $remove = $_POST['remove'];
 
 $delete = $_POST['delete'];
 
 $PM = @DBi::$con->query("SELECT * FROM ".$Prefix."PM WHERE PM_ID = '$msg' ") or die (DBi::$con->error);

 if(@mysqli_num_rows($PM) > 0){

 $rs_PM = @mysqli_fetch_array($PM);

 $PM_PmID = $rs_PM['PM_ID'];
 $PM_MID = $rs_PM['PM_MID'];
 }
 
 if($PM_MID > 0) {
	$them = $DBMemberID; 
 }
 if($PM_MID < 0 && in_array(abs($PM_MID), chk_allowed_forums())) {
	$them = $PM_MID; 
 }

	    if (($PM_MID == $DBMemberID or ($PM_MID < 0 && in_array(abs($PM_MID), chk_allowed_forums()))) or ($Mlevel == 4 or $Mlevel == 3 AND $deputy == 0 AND $CAN_SHOW_PM == 1)) {

			
        if ($method == "") {
 if($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_SHOW_PM == 1)) {
 $the_pm_from = "";
 } else {
 $the_pm_from = "AND PM_MID = '$them'";	 
 }			
$sql = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID = '$msg' ".$the_pm_from."");
 $num = mysqli_num_rows($sql);
 if($num == 0) {
	redirect(); 
 }	
        $query = "UPDATE " . $Prefix . "PM SET ";
        $query .= "PM_STATUS = 0 ";
        $query .= "WHERE PM_ID = '$msg' ";

        @DBi::$con->query($query, $connection) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_pm_is_moved'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
					
		}
		}
     
    if ($Mlevel == 4 or $Mlevel > 0 or ($Mlevel == 3 AND $deputy == 0 AND $CAN_SHOW_PM == 1)) {
        if ($method == "remove") {
             if ($remove == "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$lang['delete']['you_are_non_selected_any_pm'].'</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
            }
            else {
				$i = 0;
	$them_pm_mid = get_pm_mid("PM_MID", $remove[$i]);			
	 if($them_pm_mid > 0) {
	$them = $DBMemberID; 
 }
 if($them_pm_mid < 0 && in_array(abs($them_pm_mid), chk_allowed_forums())) {
	$them = $them_pm_mid; 
 }
			
 if($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_SHOW_PM == 1)) {				
 $the_pm_from = "";
 } else {
 $the_pm_from = "AND PM_MID = '$them'";	 
 }
             $i = 0;
            while($i < count($remove)) {
 $sql = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID IN (".$remove[$i].") ".$the_pm_from."");
  $num = mysqli_num_rows($sql);
 if($num == 0) {
	redirect();
 }
 
 ++$i;
     }

            $i_pm = 0;
            while($i_pm  < count($remove)) {
 $sql = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID IN (".$remove[$i_pm].") ".$the_pm_from."");
  $num = mysqli_num_rows($sql);
  if($num > 0) {
                @DBi::$con->query("UPDATE ".$Prefix."PM SET PM_STATUS = '0' WHERE PM_ID = ".$remove[$i_pm]." ") or die (DBi::$con->error);
  } else {
	redirect();
  }
                $i_pm++;

            }

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_pm_is_moved'].'</font><br><br>
                           <meta http-equiv="Refresh" content="10; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
            }
        }
        if ($method == "delete") {
             if ($delete == "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$lang['delete']['you_are_non_selected_any_pm'].'</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
            }
            else {
				$i = 0;
	$them_pm_mid = get_pm_mid("PM_MID", $delete[$i]);				
 if($them_pm_mid > 0) {
	$them = $DBMemberID; 
 }
 if($them_pm_mid < 0 && in_array(abs($them_pm_mid), chk_allowed_forums())) {
	$them = $them_pm_mid; 
 }			
 if($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_SHOW_PM == 1)) {				
 $the_pm_from = "";
 } else {
 $the_pm_from = "AND PM_MID = '$them'";	 
 }
             $i = 0;
            while($i < count($delete)) {
 $sql = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID IN (".$delete[$i].") ".$the_pm_from."");
  $num = mysqli_num_rows($sql);
 if($num == 0) {
	redirect();
 }
 
 ++$i;
     }
            $i_pm = 0;
            while($i_pm  < count($delete)) {
 $sql = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID IN (".$delete[$i_pm].") ".$the_pm_from."");
  $num = mysqli_num_rows($sql);
  if($num > 0) {
                @DBi::$con->query("DELETE FROM ".$Prefix."PM WHERE PM_ID = ".$delete[$i_pm]." ") or die (DBi::$con->error);
  } else {
	 redirect(); 
  }			
                $i_pm++;

            }

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_pm_is_normal_deleted'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">
                           <a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
            }
        }
    }
    else{
    redirect();
    }
}
else {
redirect();
}


@mysqli_close();
?>
