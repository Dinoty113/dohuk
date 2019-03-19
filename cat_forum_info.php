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



$HTTP_REFERER = $_SERVER['HTTP_REFERER'];

if ($Mlevel == 4) {

$add_subject = DBi::$con->real_escape_string(htmlspecialchars($_POST["add_subject"]));
$MonitorID = DBi::$con->real_escape_string(htmlspecialchars($_POST["mon_memberid"]));
$DeputyMonitorID = DBi::$con->real_escape_string(htmlspecialchars($_POST["deputy_mon_memberid"]));
$ModeratorID = DBi::$con->real_escape_string(htmlspecialchars($_POST["mod_memberid"]));
$forum_logo = DBi::$con->real_escape_string(htmlspecialchars($_POST["forum_logo"]));
$forum_sex = DBi::$con->real_escape_string(htmlspecialchars($_POST["f_sex"]));
$forum_desc = DBi::$con->real_escape_string(htmlspecialchars($_POST["forum_desc"]));
$total_topics = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["total_topics"])));
$total_replies = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["total_replies"])));
$f_hide = DBi::$con->real_escape_string(htmlspecialchars($_POST["f_hide"]));
$hide_mod = DBi::$con->real_escape_string(htmlspecialchars($_POST["hide_mod"]));
$hide_photo = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["hide_photo"])));
$day_archive = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["day_archive"])));
$active_archive = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["active_archive"])));
$hide_sig = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["hide_sig"])));
$hide_medal = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["hide_medal"])));
$cat_hide = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_hide"]));
$hf_member_id = DBi::$con->real_escape_string(htmlspecialchars($_POST["hf_member_id"]));
$method = DBi::$con->real_escape_string(htmlspecialchars($_POST["method"]));
$type = DBi::$con->real_escape_string(htmlspecialchars($_POST["type"]));
$c = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_id"]));
$f = DBi::$con->real_escape_string(htmlspecialchars($_POST["forum_id"]));
$cat_level = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_level"]));
$f_level = DBi::$con->real_escape_string(htmlspecialchars($_POST["f_level"]));
$f_social = DBi::$con->real_escape_string(htmlspecialchars($_POST["f_social"]));
$f_hashtag = DBi::$con->real_escape_string(htmlspecialchars($_POST["f_hashtag"]));
$cat_site = DBi::$con->real_escape_string(htmlspecialchars($_POST["site_id"]));


$cat_index = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_index"]));
$cat_info = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_info"]));
$cat_profile = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_profile"]));


$moderate_days = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["moderate_days"])));
$moderate_posts = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["moderate_posts"])));
$moderate_topic = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["moderate_topic"])));
$moderate_reply  = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["moderate_reply"])));
$show_index  = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["show_index"])));
$show_frm  = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["show_frm"])));
$show_info  = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["show_info"])));
$show_profile = DBi::$con->real_escape_string(htmlspecialchars($_POST["show_profile"]));
$f_dollar_topic = DBi::$con->real_escape_string(htmlspecialchars($_POST["f_dollar_topic"]));
$f_dollar_reply = DBi::$con->real_escape_string(htmlspecialchars($_POST["f_dollar_reply"]));
if($f_dollar_topic == "") {
$f_dollar_topic = "2";	
}
if($f_dollar_reply == "") {
$f_dollar_reply = "1";	
}

if($type != "c" && $type != "f" && $method != "add" && $method != "edit") {
redirect();	
}




if ($forum_desc == "") {
	if ($type == "f") {
	$error = $lang['cat_forum_info']['necessary_to_write_one_line_about_forum'];
 	}
}

if ($ModeratorID != "") {
 $queryMod = "SELECT * FROM " . $Prefix . "MODERATOR WHERE MEMBER_ID = '$ModeratorID' AND FORUM_ID = '$f' ";
 $resultMod = DBi::$con->query($queryMod) or die (DBi::$con->error);

 if(mysqli_num_rows($resultMod) > 0){

 $rsMod=mysqli_fetch_array($resultMod);

 $MODMemberID = $rsMod['MEMBER_ID'];
 }
	if ($MODMemberID == $ModeratorID) {
	$error = $lang['cat_forum_info']['can_not_add_mod_because_this_member_was_mod'];
 	}
}

if ($ModeratorID != "") {
 $queryMem = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '$ModeratorID' ";
 $resultMem = DBi::$con->query($queryMem) or die (DBi::$con->error);

 if(mysqli_num_rows($resultMem) > 0){

 $rsMem=mysqli_fetch_array($resultMem);

 $MEMMemberID = $rsMem['MEMBER_ID'];
 }
	if ($MEMMemberID == "") {
	$error = $lang['cat_forum_info']['the_number_of_inserted_is_false'];
 	}
}

if ($hf_member_id != "") {
	$hf_check_mem = DBi::$con->query("SELECT * FROM ".$Prefix."HIDE_FORUM WHERE HF_MEMBER_ID = '$hf_member_id' AND HF_FORUM_ID = '$f' ") or die (DBi::$con->error);
	if(mysqli_num_rows($hf_check_mem) > 0){
		$error = $lang['others']['allow_show_hide_forum'];
	}
	
	$hf_check_num = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$hf_member_id' ") or die (DBi::$con->error);
	if(mysqli_num_rows($hf_check_num) <= 0){
		$error = $lang['cat_forum_info']['the_number_of_inserted_is_false'];
	}
}

if ($ModeratorID != "") {
  if (doubleval($ModeratorID) == 0) {
	if ($type == "f") {
	$error = $lang['cat_forum_info']['necessary_to_insert_just_number'];
 	}
  }
}

if ($forum_logo == "") {
	if ($type == "f") {
	$error = $lang['cat_forum_info']['necessary_to_insert_logo_of_forum'];
 	}
}

if ($add_subject == "") {
	if ($type == "c") {
	$error = $lang['cat_forum_info']['necessary_to_insert_title_of_cat'];
	}
	if ($type == "f") {
	$error = $lang['cat_forum_info']['necessary_to_insert_title_of_forum'];
 	}
}


if ($type == "") {
redirect();
}

if ($error != "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$error.'..</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

if ($error == "") {

	if ($type == "c") {
        if ($method == "add") {
		$query = "INSERT INTO " . $Prefix . "CATEGORY (CAT_ID, CAT_NAME, CAT_MONITOR, CAT_DEPUTY_MONITOR, CAT_HIDE, CAT_LEVEL, SITE_ID , SHOW_INDEX , SHOW_INFO , SHOW_PROFILE ) VALUES (NULL, '$add_subject', '$MonitorID', '$DeputyMonitorID', '$cat_hide', '$cat_level', '$cat_site', '$cat_index', '$cat_info', '$cat_profile')";
		DBi::$con->query($query) or die (DBi::$con->error);
        $text = $lang['cat_forum_info']['the_cat_was_added'];
        }
        
        if ($method == "edit") {
		$c_level = cat("LEVEL", $c);
		$c_hide = cat("HIDE", $c);
		if($cat_hide != $c_hide) {
		DBi::$con->query("UPDATE " . $Prefix . "FORUM SET F_HIDE = '$cat_hide' WHERE CAT_ID = '$c'");
		}
		if($cat_level != $c_level) {
		DBi::$con->query("UPDATE " . $Prefix . "FORUM SET F_LEVEL = '$cat_level' WHERE CAT_ID = '$c'");
		}	
		$query = "UPDATE " . $Prefix . "CATEGORY SET CAT_NAME = '$add_subject', CAT_MONITOR = '$MonitorID', CAT_DEPUTY_MONITOR = '$DeputyMonitorID', CAT_HIDE = '$cat_hide', CAT_LEVEL = '$cat_level', SHOW_INDEX = '$cat_index', SHOW_INFO = '$cat_info', SHOW_PROFILE = '$cat_profile', SITE_ID = '$cat_site' WHERE CAT_ID = '$c' ";

		DBi::$con->query($query) or die (DBi::$con->error);		
        $text = $lang['cat_forum_info']['the_cat_was_update'];
        }
	}

	if ($type == "f") {
	$c = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_choose"]));
        if ($method == "add") {
		$query = "INSERT INTO " . $Prefix . "FORUM ( CAT_ID, F_SUBJECT, F_DESCRIPTION, F_LOGO, F_SEX, F_LAST_POST_AUTHOR, F_TOTAL_TOPICS, F_TOTAL_REPLIES,
		F_HIDE, F_HIDE_MOD, F_HIDE_PHOTO, F_HIDE_SIG, F_HIDE_MEDAL, CAN_ARCHIVE, MODERATE_TOPIC,  MODERATE_REPLY,  SHOW_INDEX ,SHOW_FRM ,SHOW_INFO , SHOW_PROFILE ,
		DAY_ARCHIVE, F_LEVEL, F_HASHTAG, F_SOCIAL, MODERATE_POSTS, MODERATE_DAYS, F_DOLLAR_TOPIC, F_DOLLAR_REPLY ) VALUES 
		('$c', '$add_subject', '$forum_desc', '$forum_logo', '$forum_sex', '1', '$total_topics', '$total_replies', '$f_hide', '$hide_mod', '$hide_photo',
		'$hide_sig','$hide_medal','$active_archive'
		,'$moderate_topic','$moderate_reply','$show_index','$show_frm','$show_info','$show_profile'
		,'$day_archive','$f_level','$f_hashtag','$f_social','$moderate_posts','$moderate_days','$f_dollar_topic','$f_dollar_topic')";
		DBi::$con->query($query) or die (DBi::$con->error);
		  
        $add_mod = DBi::$con->query("SELECT * FROM " . $Prefix . "FORUM ORDER BY FORUM_ID DESC") or die (DBi::$con->error);
        if(mysqli_num_rows($add_mod) > 0){
        $rs = mysqli_fetch_array($add_mod);
        }
		$the_forum_id = $rs['FORUM_ID'];
		$author_mod = $lang['topics']['moderator_team'];
		$color1 = "#ffe0e0";
		$color2 = "red";
	$req = "INSERT INTO ".prefix."AUTHOR_MOD (REQ_ID, REQ_STATUS, REQ_USERID, REQ_FRMID, REQ_AUTHOR, REQ_COLOR1, REQ_COLOR2) VALUES (NULL, '1', ";
	$req .= "'$DBMemberID', ";	
	$req .= "'$the_forum_id', ";
	$req .= "'$author_mod',";		
	$req .= "'$color1',";		
	$req .= "'$color2')";		
	DBi::$con->query($req) or die (DBi::$con->error);

		
        if ($ModeratorID != "") {
        $query = "INSERT INTO " . $Prefix . "MODERATOR (MOD_ID, FORUM_ID, MEMBER_ID) VALUES (NULL, '$the_forum_id', '$ModeratorID')";
		DBi::$con->query($query) or die (DBi::$con->error);
        }
        
		$text = $lang['cat_forum_info']['the_forum_was_added'];
        }
        if ($method == "edit") {
		$query = "UPDATE " . $Prefix . "FORUM SET CAT_ID = ('$c'), F_SUBJECT = ('$add_subject'), F_DESCRIPTION = ('$forum_desc'), F_LOGO = ('$forum_logo'), F_SEX = ('$forum_sex'), F_TOTAL_TOPICS = ('$total_topics'), F_TOTAL_REPLIES = ('$total_replies'), F_HIDE = ('$f_hide'), F_HIDE_MOD = ('$hide_mod'), F_HIDE_PHOTO = ('$hide_photo'), F_HIDE_SIG = ('$hide_sig'), F_HIDE_MEDAL = ('$hide_medal'), CAN_ARCHIVE  = ('$active_archive'),
		 MODERATE_TOPIC  = ('$moderate_topic'), MODERATE_REPLY = ('$moderate_reply'),	SHOW_INDEX  = ('$show_index'),SHOW_FRM  = ('$show_frm'),SHOW_INFO  = ('$show_info'),SHOW_PROFILE  = ('$show_profile'), DAY_ARCHIVE = ('$day_archive'), F_LEVEL = ('$f_level'), F_HASHTAG = ('$f_hashtag'), F_SOCIAL = ('$f_social'), MODERATE_POSTS = ('$moderate_posts'), MODERATE_DAYS = ('$moderate_days'), F_DOLLAR_TOPIC = ('$f_dollar_topic'), F_DOLLAR_REPLY = ('$f_dollar_reply') WHERE FORUM_ID = '$f' ";
		DBi::$con->query($query) or die (DBi::$con->error);

        $query = "UPDATE " . $Prefix . "HIDE_FORUM SET HF_CAT_ID = ('$c') WHERE HF_FORUM_ID = '$f'";
		DBi::$con->query($query) or die (DBi::$con->error);




        $query = "UPDATE " . $Prefix . "REPLY SET CAT_ID = ('$c') WHERE FORUM_ID = '$f'";
		DBi::$con->query($query) or die (DBi::$con->error);

        $query = "UPDATE " . $Prefix . "TOPICS SET CAT_ID = ('$c') WHERE FORUM_ID = '$f'";
		DBi::$con->query($query) or die (DBi::$con->error);// <i></i>
  
        if ($ModeratorID != "") {
        $query = "INSERT INTO " . $Prefix . "MODERATOR (MOD_ID, FORUM_ID, MEMBER_ID) VALUES (NULL, '$f', '$ModeratorID')";
		DBi::$con->query($query) or die (DBi::$con->error);
        }
		
        if ($hf_member_id != "") {
			DBi::$con->query("INSERT INTO ".$Prefix."HIDE_FORUM (HF_ID, HF_MEMBER_ID, HF_FORUM_ID, HF_CAT_ID) VALUES (NULL, '$hf_member_id', '$f', '$to_hide_cat')") or die (DBi::$con->error);
        }
  
        $text = $lang['cat_forum_info']['the_forum_was_update'];
        }
  
	}

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$text.'..</font><br><br>';
                           if ($method == "edit") {
                           echo'<meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">';
                           }
                           else {
                           echo'<meta http-equiv="Refresh" content="1; URL=index.php">';
                           }
	                       echo'<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>';
                           if ($method == "edit") {
                           echo'<a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>';
                           }
                           echo'
	                       </td>
	                   </tr>
	                </table>
	                </center>';
	
}


}
else {
redirect();
}


mysqli_close();
?>
