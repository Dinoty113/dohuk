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
//include('engine/function.php');
//include('engine/forum_function.php');
$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
$HTTP_HOST = $_SERVER['HTTP_HOST'];
if($method != "sendmsg" && $method != "edit" && $method != "editreply" && $method != "topic" && $method != "reply" && $method != "replymsg" && $method != "sig" && $method != "addads" && $method != "editads"){
	header("Location: ".index()."");
	exit();
}

if($method == "topic" or $method == "edit" or $method == "reply" or $method == "editreply") {
if($c == 0) {
header("Location: ".index()."");	
}
if($f == 0) {
header("Location: ".index()."");
}
if($c == "") {
header("Location: ".index()."");
}
if($f == "") {
header("Location: ".index()."");
}
if(!is_numeric($f) || forums("SUBJECT", $f) == "" || forums("SUBJECT", $f) == false){
header("Location: ".index()."");
}
if(!is_numeric($c) || cat("NAME", $c) == "" || cat("NAME", $c) == false){
	header("Location: ".index()."");
	exit();
}
}
if($method == "reply" or $method == "editreply") {
if($t == 0) {
header("Location: ".index()."");
}
if($t == "") {
header("Location: ".index()."");
}
if(!is_numeric($t) || topics("SUBJECT", $t) == "" || topics("SUBJECT", $t) == false){
header("Location: ".index()."");
}
}
if($method == "editreply") {
if($t == 0) {
header("Location: ".index()."");
}
if($t == "") {
header("Location: ".index()."");
}
if(!is_numeric($t) || topics("SUBJECT", $t) == "" || topics("SUBJECT", $t) == false){
header("Location: ".index()."");
}
if($r == 0) {
redirect();	
}
if($r == "") {
header("Location: ".index()."");
}
if(!is_numeric($r) || replies("AUTHOR", $r) == 0 || replies("AUTHOR", $r) == "" || replies("AUTHOR", $r) == false){
header("Location: ".index()."");
}
}
if($method == "edit") {
if($t == 0) {
header("Location: ".index()."");
}
if($t == "") {
header("Location: ".index()."");
}
if(!is_numeric($t) || topics("SUBJECT", $t) == "" || topics("SUBJECT", $t) == false){
header("Location: ".index()."");
}
}
if($method == "sendmsg") {
if($m == 0) {
header("Location: ".index()."");
}
if($m == "") {
header("Location: ".index()."");
}
if(!is_numeric($m) and (member_name($m) == "" OR forum_name(abs($m)) == "")){
header("Location: ".index()."");
}
}
if($method == "replymsg") {
if($msg == 0) {
header("Location: ".index()."");
}
if($msg == "") {
header("Location: ".index()."");
}
$sql = DBi::$con->query("SELECT * FROM ".prefix."PM WHERE PM_ID = '$msg' ");
$num = mysqli_num_rows($sql);
if($num == 0) {
header("Location: ".index()."");
}	
if(!is_numeric($msg)){
header("Location: ".index()."");
}
}
$Monitor_all = chk_monitor($DBMemberID, $c);
$Moderator_all = chk_moderator($DBMemberID, $f);
$mod_ShowForum = mod_ShowForum($DBMemberID, $f);

$allowed = 1;
if($method == "sendmsg" AND $m >= 0 AND(member_name($m) == "")){
	header("Location: ".index()."");
	exit();
}
if (members("SEX", $DBMemberID) == 1 AND forums("SEX", $f) == 2) {
$allowed = 0;
}
if (members("SEX", $DBMemberID) == 2 AND forums("SEX", $f) == 1) {
$allowed = 0;
}


if (allowed($f, 2) == 1) {
$allowed = 1;
}
if ($allowed == 1) {

if ($quote != "") {
    $quote = "1";
}
else {
    $quote = "0";
}
if ($method != "edit" AND $method != "editreply" AND $method != "topic" AND $method != "replymsg" AND $method != "sendmsg" AND $method != "reply" AND $method != "sig" AND $method != "addads" AND $method != "editads")
{
	header("Location: ".index()."");
}
if ($method == "edit") {
	$subject = topics("SUBJECT", $t);
                  $fix_er = mysqli_fetch_array(DBi::$con->query("SELECT * FROM " . $Prefix . "TOPICS WHERE TOPIC_ID = '$t' ")) or die(DBi::$con->error); 
	$message = $fix_er['T_MESSAGE'];
	insert_old_topic_data($t, $subject, $message);
}

if ($method == "editreply") {
	$message = replies("MESSAGE", $r);
	if($DBMemberID != replies("AUTHOR", $r) && mlv <= 1){
		header("Location: ".index()."");
		exit();
	}
	insert_old_reply_data($r, $message);
}

if ($method == "addads") {
    $txt = $lang['topic']['add_ads'];
}
if ($method == "editads") {
    $txt = $lang['topic']['edit_ads'];
}
if ($method == "topic") {
    $txt = $lang['editor']['add_topic'];
}
if ($method == "edit") {
    $txt = $lang['editor']['edit_topic'];
}
if ($method == "reply") {
    $txt = $lang['editor']['add_reply'];
}
if ($method == "editreply") {
    $txt = $lang['editor']['edit_reply'];
}

 $cat = DBi::$con->query("SELECT * FROM " . $Prefix . "CATEGORY WHERE CAT_ID = '$c' ") or die (DBi::$con->error);

 if(mysqli_num_rows($cat) > 0){

 $rsc = mysqli_fetch_array($cat);

 $C_CatID = $rsc['CAT_ID'];
 $C_CatStatus = $rsc['CAT_STATUS'];

 }

 $forum = DBi::$con->query("SELECT * FROM " . $Prefix . "FORUM WHERE FORUM_ID = '$f' ") or die (DBi::$con->error);

 if(mysqli_num_rows($forum) > 0){

 $rsf = mysqli_fetch_array($forum);

 $F_CatID = $rsf['CAT_ID'];
 $F_ForumID = $rsf['FORUM_ID'];
 $F_ForumStatus = $rsf['F_STATUS'];
 $F_ForumSubject = $rsf['F_SUBJECT'];
 $F_ForumLogo = $rsf['F_LOGO'];

 }


	$ads = "SELECT * FROM " . $Prefix . "ADS ";
    $ads .= " WHERE AD_ID = '$ad' ";
	$Rads = DBi::$con->query($ads) or die (DBi::$con->error);

 if(mysqli_num_rows($Rads) > 0){

 $rst = mysqli_fetch_array($Rads);

 $AD_ID = $rst['AD_ID'];
 $AD_Subject = $rst['AD_SUBJECT'];
 $AD_Message = $rst['AD_MESSAGE'];
 $AD_Author = $rst['AD_AUTHOR'];
 $AD_Status = $rst['AD_STATUS'];
 $AD_ShowForum = $rst['AD_SHOW_FORUM'];
 $AD_ShowSocial1 = $rst['AD_SHOW_SOCIAL_1'];
 $AD_ShowSocial2 = $rst['AD_SHOW_SOCIAL_2'];
 
 $T_TopicMessage = $AD_Message;
 $T_TopicSubject = $AD_Subject;

 }
 
 
 	$topic = "SELECT * FROM " . $Prefix . "TOPICS ";
    $topic .= " WHERE TOPIC_ID = '$t' ";
	$Rtopic = DBi::$con->query($topic) or die (DBi::$con->error);

 if(mysqli_num_rows($Rtopic) > 0){

 $rst = mysqli_fetch_array($Rtopic);

 $T_TopicID = $rst['TOPIC_ID'];
 $T_TopicSubject = $rst['T_SUBJECT'];
 $T_TopicMessage = $rst['T_MESSAGE'];
 $T_TopicAuthor = $rst['T_AUTHOR'];
 $T_TopicStatus = $rst['T_STATUS'];
 $T_TopicSticky = $rst['T_STICKY'];
 $T_TopicHidden = $rst['T_HIDDEN'];
 $T_TopicHolded = $rst['T_HOLDED'];
 $T_TopicModerate = $rst['T_UNMODERATED'];
 $T_TopicImg = $rst['T_IMG'];
 $T_TopicDesc = $rst['T_DESC'];
 $T_TopicAuthorMod = $rst['T_AUTHOR_MOD'];

 
 

 }else{
	 $T_TopicID = "";
 $T_TopicSubject = "";
 $T_TopicMessage = "";
 $T_TopicAuthor = "";
 $T_TopicStatus = "";
 $T_TopicSticky = "";
 $T_TopicHidden = "";
 $T_TopicHolded = "";
 $T_TopicModerate = "";
 $T_TopicImg = "";
 $T_TopicDesc = "";
 $T_TopicAuthorMod = "";
 }


 	$Tmember = "SELECT * FROM " . $Prefix . "MEMBERS ";
    $Tmember .= " WHERE MEMBER_ID = '$T_TopicAuthor' ";
	$RTmember = DBi::$con->query($Tmember) or die (DBi::$con->error);

 if(mysqli_num_rows($RTmember) > 0){

 $rstm = mysqli_fetch_array($RTmember);

 $T_MemberID = $rstm['MEMBER_ID'];
 $T_MemberName = $rstm['M_NAME'];

 }

 	$Reply = "SELECT * FROM " . $Prefix . "REPLY ";
    $Reply .= " WHERE REPLY_ID = '$r' ";
	$RReplyr = DBi::$con->query($Reply) or die (DBi::$con->error);

 if(mysqli_num_rows($RReplyr) > 0){

 $rsR = mysqli_fetch_array($RReplyr);

 $R_ReplyID = $rsR['REPLY_ID'];
 $R_ReplyMessage = $rsR['R_MESSAGE'];
 $R_ReplyAuthor = $rsR['R_AUTHOR'];
 $R_ReplyModerate = $rsR['R_UNMODERATED'];

 }
 else{
 $R_ReplyID = "";
 $R_ReplyMessage = "";
 $R_ReplyAuthor = "";
 $R_ReplyModerate = "";
 }
if($id == "") {
$id = $DBMemberID;	
}
 if($id != "" && $Mlevel > 2 && $deputy == 0 && $id != 1) {
	$id = $id;
 }
 if($Mlevel < 3) {
	$id = $DBMemberID; 
 }
 if($id == 1) {
	$id = $DBMemberID;	
 }

 $SIG = DBi::$con->query("SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '$id' ") or die (DBi::$con->error);

 if(mysqli_num_rows($SIG) > 0){

 $rsSIG = mysqli_fetch_array($SIG);

 $SIG_MemberID = $rsSIG['MEMBER_ID'];
 $SIG_MemberName = $rsSIG['M_NAME'];
 $SIG_MemberSig = $rsSIG['M_SIG'];

 }

 $ReplyMsg = DBi::$con->query("SELECT * FROM " . $Prefix . "PM WHERE PM_ID = '$msg' ") or die (DBi::$con->error);

 if(mysqli_num_rows($ReplyMsg) > 0){

 $rsRM = mysqli_fetch_array($ReplyMsg);

 $RM_PmID = $rsRM['PM_ID'];
 $RM_To = $rsRM['PM_TO'];
 $RM_From = $rsRM['PM_FROM'];
 $RM_Subject = $rsRM['PM_SUBJECT'];

 }

if ($method == "replymsg") {
  if ($RM_From > 0) {

    $MEMBER_FROM = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$RM_From' ") or die (DBi::$con->error);

    if(mysqli_num_rows($MEMBER_FROM) > 0){

    $rsMF=mysqli_fetch_array($MEMBER_FROM);

    $MF_MemberID = $rsMF['MEMBER_ID'];
    $MF_MemberName = $rsMF['M_NAME'];
    }
  }
  if ($RM_From < 0) {

    $id = abs($RM_From);

    $FORUM_FROM = DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE FORUM_ID = '$id' ") or die (DBi::$con->error);

    if(mysqli_num_rows($FORUM_FROM) > 0){

    $rsFF = mysqli_fetch_array($FORUM_FROM);

    $FF_ForumID = $rsFF['FORUM_ID'];
    $FF_ForumSubject = $rsFF['F_SUBJECT'];

    $MF_MemberID = '-'.$FF_ForumID;
    $MF_MemberName = $lang['editor']['moderate'].' '.$FF_ForumSubject;

    }
  }
}



if ($method == "sendmsg") {
  if ($m > 0) {

    $MEMBER_FROM = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$m' ") or die (DBi::$con->error);

    if(mysqli_num_rows($MEMBER_FROM) > 0){

    $rsMF = mysqli_fetch_array($MEMBER_FROM);

    $MF_MemberID = $rsMF['MEMBER_ID'];
    $MF_MemberName = $rsMF['M_NAME'];
    }
  }
  if ($m < 0) {

    $id = abs($m);

    $FORUM_FROM = DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE FORUM_ID = '$id' ") or die (DBi::$con->error);

    if(mysqli_num_rows($FORUM_FROM) > 0){

    $rsFF = mysqli_fetch_array($FORUM_FROM);

    $FF_ForumID = $rsFF['FORUM_ID'];
    $FF_ForumSubject = $rsFF['F_SUBJECT'];

    $MF_MemberID = '-'.$FF_ForumID;
    $MF_MemberName = $lang['editor']['moderate'].' '.$FF_ForumSubject;

    }
  }

}


if ($Mlevel > 0) {

$sql = @DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '$m' AND USER = '$DBMemberID' AND CAT_ID = '-2' ");
$num = mysqli_num_rows($sql);
if($method == "sendmsg") {
if($MF_MemberID > 0) {
$pm_hide = members("PMHIDE", $MF_MemberID);
if($pm_hide == 0 && $Mlevel < 2) {
show_error(31 , "", 1);
}	
if($num > 0 && $Mlevel < 2) {
show_error(32 , "", 1);
}	
}
}
if($method == "replymsg") {
if($MF_MemberID > 0) {
$pm_hide = members("PMHIDE", $RM_From);
if($pm_hide == 0 && $Mlevel < 2) {
show_error(31 , "", 1);
}
if($num > 0 && $Mlevel < 2) {
show_error(32 , "", 1);
}	
}	
}
if ($method == "addads" or $method == "editads") {
    if ($Mlevel != 4) {
		redirect();
    }
}
	
if ($method == "topic") {
    if ($Mlevel != 4 AND $C_CatStatus == 0) {
show_error(1 , "", 1);
    }
    if ($Mlevel != 4 AND $F_ForumStatus == 0) {
show_error(2 , "", 1);
    }
if (members("TOPICS_ADD", $DBMemberID) == 1) {
show_error(24 , "", 1);
}

if ($mod_ShowForum == 1 ) {
show_error(28 , $f, 1);
    }

	$member_topics_today = member_topics_today($DBMemberID, $f);
	$f_total_topics = forums("TOTAL_TOPICS", $f);
    if (allowed($f, 2) != 1 AND $member_topics_today >= $f_total_topics) {
show_error(13 , $f, 1);
    }
    if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15 , $f, 1);
    }
    if (mon_AllForum($DBMemberID) == 1) {
show_error(16 , $f, 1);
    }
	if (HoldedMembers($DBMemberID) == 1) {
show_error(43 , "", 1);
	}	
    $f_level = forums("F_LEVEL", $f);
    if ($f_level > 0 AND $Mlevel < $f_level){
                                    redirect();
    }
}
if ($method == "edit") {
if (members("TOPICS_EDIT", $DBMemberID) == 1) {
show_error(26 , "", 1);
}

if ($mod_ShowForum == 1 ) {
show_error(28 , $f, 1);
}
	$cstatus = cat("STATUS",forums("CAT_ID", $f));
    if ($Mlevel != 4 AND $cstatus == 0) {
show_error(3 , "", 1);
    }
    if ($Mlevel  != 4  AND $F_ForumStatus == 0) {
show_error(4 , "", 1);
    }
    if (allowed($f, 2) != 1 AND $T_TopicStatus == 0) {
show_error(5 , "", 1);
    }
    if (allowed($f, 2) != 1 AND $T_TopicModerate == 1) {
show_error(35 , "", 1);
    }		
    if (allowed($f, 2) != 1 AND $T_TopicAuthor != $DBMemberID) {
show_error(6 , "", 1);
    }
   if ((allowed($f, 2) != 1 AND $T_TopicHidden == 1 AND chk_load_topic($t) == 0) OR (allowed($f, 2) != 1 AND $T_TopicHidden == 1 AND $T_TopicAuthor != $DBMemberID AND chk_load_topic($t) == 0)){
show_error(37 , "", 1);
    }	
    if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15 , $f, 1);
    }
    if (mon_AllForum($DBMemberID) == 1) {
show_error(16 , $f, 1);
    }
    if (topics("UNMODERATED", $t) == 1) {
show_error(17 , $f, 1);
    }
	if(topics("ARCHIVED", $t) == 1 && $Mlevel != 4) {
show_error(47 , "", 1);
	}
	if ($T_TopicHolded == 1 && allowed($f, 2) != 1) {
show_error(42 , "", 1);
	}

}
if ($method == "reply") {
if (members("POSTS_ADD", $DBMemberID) == 1) {
show_error(25 , "", 1);
}

$mod_ShowForum = mod_ShowForum($DBMemberID, $f);

if ($mod_ShowForum == 1 ) {
show_error(28 , $f, 1);
}


    if ($Mlevel != 4 AND $C_CatStatus == 0) {
show_error(7 , "", 1);
    }
    if ($Mlevel != 4 AND $F_ForumStatus == 0) {
show_error(8 , "", 1);
    }
    if (allowed($f, 2) != 1 AND $T_TopicStatus == 0) {
show_error(9 , "", 1);
    }
   if ((allowed($f, 2) != 1 AND $T_TopicHidden == 1 AND chk_load_topic($t) == 0) OR (allowed($f, 2) != 1 AND $T_TopicHidden == 1 AND $T_TopicAuthor != $DBMemberID AND chk_load_topic($t) == 0)){
show_error(10 , "", 1);
    }
	$member_replies_today = member_replies_today($DBMemberID, $f);
	$f_total_replies = forums("TOTAL_REPLIES", $f);
    if (allowed($f, 2) != 1 AND $member_replies_today >= $f_total_replies) {
show_error(14 , $f, 1);
    }
    if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15 , $f, 1);
    }
    if (mon_AllForum($DBMemberID) == 1) {
show_error(16 , $f, 1);
    }
    if (topics("UNMODERATED", $t) == 1) {
show_error(18 , $f, 1);
    }
    if(topics("ARCHIVED", $t) == 1 && $Mlevel != 4){
show_error(19 , "", 1);
    }

    $f_level = forums("F_LEVEL", $f);
    if ($f_level > 0 AND $Mlevel < $f_level){
                                    redirect();
    }
	if ($T_TopicHolded == 1 && allowed($f, 2) != 1) {
show_error(40 , "", 1);
	}
}
if ($method == "editreply") {
if (members("POSTS_EDIT", $DBMemberID) == 1) {
show_error(27 , "", 1);
}

    if (allowed($f, 2) != 1 AND $T_TopicStatus == 0) {
show_error(33 , "", 1);
    }
    if (allowed($f, 2) != 1 AND $R_ReplyModerate == 1) {
show_error(34 , "", 1);
    }	
    if ($Mlevel != 4 AND $C_CatStatus == 0) {
show_error(11 , "", 1);
    }	
    if ($Mlevel != 4 AND $F_ForumStatus == 0) {
show_error(12 , "", 1);
    }
    if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15 , $f, 1);
    }
    if (mon_AllForum($DBMemberID) == 1) {
show_error(16 , $f, 1);
    }
    if (allowed($f, 2) != 1 AND $R_ReplyAuthor != $DBMemberID) {
show_error(36 , "", 1);
    }
	if(topics("ARCHIVED", $t) == 1 && $Mlevel != 4) {
show_error(47 , "", 1);
	}	
	if ($T_TopicHolded == 1 && allowed($f, 2) != 1) {
show_error(41 , "", 1);
	}	
}
if ($method == "sendmsg") {
	if($m < 0) {
	if(forums("STATUS", abs($m)) == 0 && allowed(abs($m), 2) != 1) {
show_error(44 , "", 1);
	}	
	}
	$member_messages_today = member_messages_today($DBMemberID);
if($Mlevel == 1) {
$total_pm_message_all = $total_pm_message;
}
if($Mlevel > 1) {
$total_pm_message_all = $total_pm_message_m;
}	
    if ($member_messages_today >= $total_pm_message_all && members("LEVEL", $MF_MemberID) < 2 ) {
show_error(38 , "", 1);
    }
	
if(mlv == 1 AND member_name($m) AND $DBMemberPosts < $new_member_min_posts_pm AND members("LEVEL", $m) == 1){
show_error(20 , "", 1);
}
if($user_info['M_USE_PM'] == 1){
show_error(23, "", 1);
}

$n_list = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '$m' AND USER = '$DBMemberID' AND CAT_ID = '-2' "));
if(mlv == 1 AND member_name($m) AND $n_list != 0  AND members("LEVEL", $m) == 1){
show_error(22 , "", 1);
}

}
if ($method == "replymsg") {
	if($m < 0) {
	if(forums("STATUS", abs($m)) == 0 && allowed(abs($m), 2) != 1) {
show_error(44 , "", 1);
	}	
	}	
if($Mlevel == 1) {
$total_pm_message_all = $total_pm_message;
}
if($Mlevel > 1) {
$total_pm_message_all = $total_pm_message_m;
}	
	$member_messages_today = member_messages_today($DBMemberID);
    if ($member_messages_today >= $total_pm_message_all && members("LEVEL", $RM_From) < 2 ) {
show_error(38 , "", 1);
    }	
if($user_info['M_USE_PM'] == 1){
show_error(23, "", 1);
}
$PM_TO = $RM_From;
if($m < 0) {
$forum = abs($m);
$cat = forums("CAT_ID", $forum);
$hide = forums("HIDE", $forum);
$c_hide = cat("CAT_HIDE", $cat);
$check_forum_login = check_forum_login($forum);
$check_cat_login = check_cat_login($cat);
$level = forums("F_LEVEL", $forum);
$c_level = cat("CAT_LEVEL", $cat);
if($c_hide == 1 && $check_cat_login == 0) {
redirect();	
}	
if($c_level > 0 && $Mlevel < $c_level) {
redirect();	
}	
if($hide == 1 && $check_forum_login == 0) {
redirect();	
}	
if($level > 0 && $Mlevel < $level) {
redirect();	
}	
}
}
if ($method == "sendmsg") {
$PM_TO = $MF_MemberID;
if ($pm_from > 0) {
if ($pm_from == $DBMemberID) {
$from_name = $DBUserName;
} else {
redirect();
}
}
if ($pm_from < 0) {
$forum_num = abs($pm_from);
if (allowed($forum_num, 2) == 1) {
$from_name = "".$lang['message']['moderate']." ".forums("SUBJECT", $forum_num)."";
} else {
redirect();
}
}
if ($pm_from == 0) {
$pm_from = $DBMemberID;
$from_name = $DBUserName;
}
if($m < 0) {
$forum = abs($m);
$cat = forums("CAT_ID", $forum);
$hide = forums("HIDE", $forum);
$c_hide = cat("CAT_HIDE", $cat);
$check_forum_login = check_forum_login($forum);
$check_cat_login = check_cat_login($cat);
$level = forums("F_LEVEL", $forum);
$c_level = cat("CAT_LEVEL", $cat);
if($c_hide == 1 && $check_cat_login == 0) {
redirect();	
}	
if($c_level > 0 && $Mlevel < $c_level) {
redirect();	
}	
if($hide == 1 && $check_forum_login == 0) {
redirect();	
}	
if($level > 0 && $Mlevel < $level) {
redirect();	
}	
}
}
if(preg_match('/Navigator(.*)/i',$_SERVER['HTTP_USER_AGENT'])){	 
$browser = "Navigator";
}
elseif(preg_match('/Firefox(.*)/i',$_SERVER['HTTP_USER_AGENT'])){	 
$browser = "Firefox";
}
elseif(preg_match('/MSIE(.*)/i',$_SERVER['HTTP_USER_AGENT'])){	 
$browser = "Internet Explorer";
}
elseif(preg_match('/chrome(.*)/i',$_SERVER['HTTP_USER_AGENT'])){	 
$browser = "Chrome";
}
elseif(preg_match('/MAXTHON(.*)/i',$_SERVER['HTTP_USER_AGENT'])){	 
$browser = "Maxthon";
}
elseif(preg_match('/Opera(.*)/i',$_SERVER['HTTP_USER_AGENT'])){	 
$browser = "Opera";
}
elseif(preg_match('/Safari(.*)/i',$_SERVER['HTTP_USER_AGENT'])){	 
$browser = "Safari";
}
else {
$browser = "Chrome";
}
if(HoldedMembers($DBMemberID) != 1 && members("EDIT_SIG", $DBMemberID) != 1) {
echo'
<table class="topholder" height="100%" cellSpacing="0" cellPadding="0" width="100%" border="0">
	<tr>
		<td>
		<form method="post" action="index.php?mode=post_info" name="save_form" id="editor_form">
		<table dir="'.$lang['global']['dir'].'" class="topholder" cellSpacing="2" width="100%" border="0">
		<input name="method" type="hidden" value="'.$method.'">
		<input name="browser" type="hidden" value="'.$browser.'">
		<input name="quote" type="hidden" value="'.$quote.'">
		<input name="r" type="hidden" value="'.$r.'">
		<input name="t" type="hidden" value="'.$t.'">
		<input name="f" type="hidden" value="'.$f.'">
		<input name="c" type="hidden" value="'.$c.'">
        <input name="m" type="hidden" value="'.$m.'">';
		if($Mlevel > 2) {
		echo'<input name="id" type="hidden" value="'.$id.'">';	
		}
		echo'
		<input name="ad" type="hidden" value="'.$ad.'">
        <input type="hidden" name="txtPageProperties"  value="" ID="txtPageProperties">
        <input name="pm_from" type="hidden" value="'.$pm_from.'">';
		if(isset($PM_TO)){
			echo'
        <input name="pm_to" type="hidden" value="'.$PM_TO.'">
        <input name="msg" type="hidden" value="'.$RM_PmID.'">';}
		
		echo'<input name="refer" type="hidden" value="'.referer.'">
		<input name="postrefer" type="hidden" value="'.referer.'">
        <input name="host" type="hidden" value="'.http_host.'">';
		if($Mlevel == 1) {
		echo'
		<input name="topic_max_size" type="hidden" value="'.$topic_max_size.'">
		<input name="reply_max_size" type="hidden" value="'.$reply_max_size.'">
		<input name="pm_max_size" type="hidden" value="'.$pm_max_size.'">
		<input name="sig_max_size" type="hidden" value="'.$sig_max_size.'">
		';
		}
		if($Mlevel > 1) {
		echo'
		<input name="topic_max_size" type="hidden" value="'.$topic_max_size_m.'">
		<input name="reply_max_size" type="hidden" value="'.$reply_max_size_m.'">
		<input name="pm_max_size" type="hidden" value="'.$pm_max_size_m.'">
		<input name="sig_max_size" type="hidden" value="'.$sig_max_size_m.'">		
		';
		}
echo'
<script src="editorfunc.js" type="text/javascript"></script>

                      <link href="innova/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
					   <link href="innova/bootstrap/bootstrap_extend.css" rel="stylesheet" type="text/css" />
<script src="innova/scripts/common/jquery-1.7.min.js" type="text/javascript"></script>
<script src="innova/scripts/innovaeditor.js" type="text/javascript"></script>
<script src="innova/scripts/innovamanager.js" type="text/javascript"></script>

<script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js" type="text/javascript"></script>
<script src="innova/scripts/common/webfont.js" type="text/javascript"></script>
';
}
if ($method == "addads" OR $method == "editads") {

$Photo =  '<a class="menu">'.icons($yourposts).'</a>';
$Subject = '</font>&nbsp;'.$txt.'&nbsp;&nbsp;&nbsp;';
}
if ($method == "topic" OR $method == "edit" OR $method == "editreply" OR $method == "reply") {

$Photo =  '<a class="menu" href="index.php?mode=f&f='.$F_ForumID.'">'.icons($F_ForumLogo,"","style='HEIGHT:30px;'").'</a>';
$Subject = '<a href="index.php?mode=f&f='.$F_ForumID.'">'.$F_ForumSubject.'</a></font>&nbsp;&nbsp;-&nbsp;'.$txt.'&nbsp;&nbsp;&nbsp;';
}
if ($method == "sig") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43,"",1);
}	
if (members("EDIT_SIG", $DBMemberID) == 1  ) {
		show_error(30,"",1);
}

$Photo =  '<a class="menu" href="index.php?mode=profile&type=details">'.icons($details, "", "").'</a>';
$Subject = '<a class="menu" href="index.php?mode=profile&type=details"><font size="+1">'.$lang['editor']['edit_sig'].' : '.members("NAME", $id).'</a></font>';
}
if ($method == "replymsg") {
  if ($PM_TO > 0) {
    $Photo =  '<a class="menu" href="index.php?mode=pm&mail=msg&msg='.$msg.'">'.icons($monitor, "", "").'</a>';
    $Subject = '<a class="menu" href="index.php?mode=pm&mail=msg&msg='.$msg.'"><font size="+1">'.$lang['editor']['pm_to'].'</a></font>&nbsp;<a href="index.php?mode=member&id='.$MF_MemberID.'"><font color="red" size="+1">'.$MF_MemberName.'</font></a>';
    $Subject .= '<br><nobr>'.$lang['editor']['pm_address'].' <input maxLength="100" name="subject" value="'.$RM_Subject.'" style="WIDTH: 400px;font-family: arial; font-size: 15; font-weight: bold; color: black;"></nobr>';
  }
  if ($PM_TO < 0) {

  $MF_MemberID = abs($PM_TO);

    $Photo =  '<a class="menu" href="index.php?mode=pm&mail=msg&msg='.$msg.'">'.icons($monitor, "", "").'</a>';
    $Subject = '<a class="menu" href="index.php?mode=pm&mail=msg&msg='.$msg.'"><font size="+1">'.$lang['editor']['pm_to'].'</a></font>&nbsp;<a href="index.php?mode=f&f='.$MF_MemberID.'"><font color="red" size="+1">'.$MF_MemberName.'</font></a>';
    $Subject .= '<br><nobr>'.$lang['editor']['pm_address'].' <input maxLength="100" name="subject" value="'.$RM_Subject.'" style="WIDTH: 400px;font-family: arial; font-size: 15; font-weight: bold; color: black;"></nobr>';
  }
}

if ($method == "sendmsg") {
  if ($m > 0) {
   $subject = ''.$lang['editor']['pm_from'].' '.$from_name.' '.$lang['editor']['to'].' '.$MF_MemberName.'';

if($svc == "t"){
		if(!isset($id) || $id == "") { 
	header("Location: ".index().""); 
	exit;
	}
$subject = ''.$lang['others']['message_with_topic'].' '.topics("SUBJECT",$id).'';
$tdate = topics("DATE",$id);
$hidden_pm = members("HIDE_PM", $MF_MemberID);
if($hidden_pm == 1 && mlv < 3){
$T_TopicMessage = reply_quotee($MF_MemberID);
} else {
$T_TopicMessage = reply_quote($id, "", topics("AUTHOR",$id), $tdate, topics("MESSAGE",$id));
}
}

if($svc == "r"){
	if(!isset($id) || $id == "") { 
	header("Location: ".index().""); 
	exit;
	}

$subject = ''.$lang['others']['message_with_reply'].' '.topics("SUBJECT", replies("TOPIC_ID",$id)).'';
$rdate = replies("DATE",$id);
$hidden_pm = members("HIDE_PM", $MF_MemberID);
if($hidden_pm == 1 && mlv < 3){
$T_TopicMessage = reply_quotee($MF_MemberID);
} else {
$T_TopicMessage = reply_quote($id, "&r=".$id."", replies("AUTHOR", $r), $rdate, replies("MESSAGE", $r));
}
}


    $Photo =  '<a href="index.php?mode=member&id='.$MF_MemberID.'">'.icons($messages, "", "").'</a>';
    $Subject = '<a class="menu" href="index.php?mode=member&id='.$MF_MemberID.'"><font size="+1">'.$lang['editor']['pm_to'].'</a></font>&nbsp;<a href="index.php?mode=member&id='.$MF_MemberID.'"><font color="red" size="+1">'.$MF_MemberName.'</font></a>';
    $Subject .= '<br><nobr>'.$lang['editor']['pm_address'].' <input maxLength="100" name="subject" value="'.$subject.'" style="WIDTH: 400px;font-family: arial; font-size: 15; font-weight: bold; color: black;"></nobr>';
  }
  if ($m < 0) {

  $MF_MemberID = abs($m);

    $Photo =  '<a href="index.php?mode=f&f='.$MF_MemberID.'">'.icons($messages, "", "").'</a>';
    $Subject = '<a class="menu" href="index.php?mode=f&f='.$MF_MemberID.'"><font size="+1">'.$lang['editor']['pm_to'].'</a></font>&nbsp;<a href="index.php?mode=f&f='.$MF_MemberID.'"><font color="red" size="+1">'.$MF_MemberName.'</font></a>';
    $Subject .= '<br><nobr>'.$lang['editor']['pm_address'].' <input maxLength="100" name="subject" value="'.$lang['editor']['pm_from'].' '.$DBUserName.' '.$lang['editor']['to'].' '.$MF_MemberName.'" style="WIDTH: 400px;font-family: arial; font-size: 15; font-weight: bold; color: black;"></nobr>';
  }
}

            echo'
            <tr>
             
                <td class="main" vAlign="center" width="100%"><font size="+1">'.$Photo.'&nbsp;'.$Subject;

if ($Mlevel == 4 OR $Monitor_all == 1 OR $Moderator_all == 1) {

if ($method == "edit") {
    if ($T_TopicHidden == 1) {
           echo'<input name="hidden" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['editor']['hide'].'&nbsp;&nbsp;</font>';
    }
    if ($T_TopicHidden == 0) {
           echo'<input name="hidden" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['editor']['hide'].'&nbsp;&nbsp;</font>';
    }
    if ($T_TopicStatus == 0) {
           echo'<input name="lock" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['editor']['lock'].'&nbsp;&nbsp;</font>';
    }
    if ($T_TopicStatus == 1) {
           echo'<input name="lock" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['editor']['lock'].'&nbsp;&nbsp;</font>';
    }
    if ($T_TopicSticky == 1) {
           echo'<input name="sticky" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['editor']['sticky'].'</font>';
    }
    if ($T_TopicSticky == 0) {
           echo'<input name="sticky" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['editor']['sticky'].'</font>';
    }
}
if ($method == "topic") {

           echo'<input name="hidden" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['editor']['hide'].'&nbsp;&nbsp;</font>';
           echo'<input name="lock" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['editor']['lock'].'&nbsp;&nbsp;</font>';
           echo'<input name="sticky" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['editor']['sticky'].'</font>';
}
if ($method == "reply") {
			if($T_TopicHidden == 1) {
           echo'<input name="hidden_r" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['forum']['hide_topic'].'&nbsp;&nbsp;</font>';
			}
			if($T_TopicHidden == 0) {
           echo'<input name="hidden_r" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['forum']['hide_topic'].'&nbsp;&nbsp;</font>';
			}
			if($T_TopicStatus == 1) {
           echo'<input name="lock_r" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['topics']['lock_topic'].'&nbsp;&nbsp;</font>';
			}
			if($T_TopicStatus == 0) {
           echo'<input name="lock_r" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['topics']['lock_topic'].'&nbsp;&nbsp;</font>';
			}
}
}
if($Mlevel == 4) {
if ($method == "addads") {

           echo'<input name="adlock" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['admin']['close'].'&nbsp;&nbsp;</font>';
           echo'<input name="adforum" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['admin_ads']['forum_ad'].'&nbsp;&nbsp;</font>';
           echo'<input name="adsocial1" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['admin_ads']['ichraf_ad'].'&nbsp;&nbsp;';
           echo'<input name="adsocial2" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['admin_ads']['general_ad'].'';
}

if ($method == "editads") {
			if($AD_Status == 1) {
           echo'<input name="adlock" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['admin']['close'].'&nbsp;&nbsp;</font>';
			}
			if($AD_Status == 0) {
           echo'<input name="adlock" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['admin']['close'].'&nbsp;&nbsp;</font>';
			}
			if($AD_ShowForum == 1) {
           echo'<input name="adforum" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['admin_ads']['forum_ad'].'&nbsp;&nbsp;</font>';
			}
			if($AD_ShowForum == 0) {
           echo'<input name="adforum" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['admin_ads']['forum_ad'].'&nbsp;&nbsp;</font>';
			}
			if($AD_ShowSocial1 == 1) {
           echo'<input name="adsocial1" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['admin_ads']['ichraf_ad'].'&nbsp;&nbsp;';
			}
			if($AD_ShowSocial1 == 0) {
           echo'<input name="adsocial1" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['admin_ads']['ichraf_ad'].'&nbsp;&nbsp;';
			}
			if($AD_ShowSocial2 == 1) {
           echo'<input name="adsocial2" class="small" type="checkbox" value="1" checked><font color="black" size="2">&nbsp;'.$lang['admin_ads']['general_ad'].'&nbsp;&nbsp;';
			}			
			if($AD_ShowSocial2 == 0) {
           echo'<input name="adsocial2" class="small" type="checkbox" value="1"><font color="black" size="2">&nbsp;'.$lang['admin_ads']['general_ad'].'&nbsp;&nbsp;';
			}			
}

}
                echo'
                </td>';
				
if ($method == "topic" OR $method == "edit" OR $method == "editreply" OR $method == "reply") {
                echo'
                <td class="menu" align="middle"><nobr><a target="_new" href="index.php?mode=rules">'.$lang['editor']['click_here_to_read_reply_rules'].'</a></nobr></td>';
}
					echo'
				<td class="menu" align="middle"><nobr><font color="red">'.$lang['others']['enter_a_true_captcha'].'</font></nobr></td>';

echo'
<td rowspan="2" class="menu">
<center>
<div id="captchabox">
<table border="1" cellspacing="0" cellpadding="0">
<tbody><tr>
<td class="tarek" valign="top"><img width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'">
<nobr><center>&nbsp;';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
<?php
echo'
<b><font color="blue">'.$lang['others']['captcha'].' </font>
<input type="text" style="WIDTH:60px;" name="captcha">&nbsp;&nbsp;&nbsp;&nbsp;
</b></center></nobr></td></tr></tbody></table></div></center></td>	
';

if(allowed($f, 2) != 1) {
if ($method == "topic" OR $method == "edit") {
	$member_topics_today = member_topics_today($DBMemberID, $f);
	$f_total_topics = forums("TOTAL_TOPICS", $f);	
				$limit_topics = $f_total_topics - $member_topics_today;
				echo'
				<td class="menu" align="middle"><nobr><font color="red">'.$lang['others']['limit_topics'].'</font>&nbsp;'.$limit_topics.'</nobr></td>';
}
if ($method == "editreply" OR $method == "reply") {
	$member_replies_today = member_replies_today($DBMemberID, $f);
	$f_total_replies = forums("TOTAL_REPLIES", $f);	
				$limit_replies = $f_total_replies - $member_replies_today;
				echo'
				<td class="menu" valign="center" align="middle"><nobr><font color="red">'.$lang['others']['linit_replies'].'</font>&nbsp;'.$limit_replies.'</nobr></td>';
}
}
			echo'

            </tr>';
if ($method == "sig") {
$T_TopicMessage = $SIG_MemberSig;
}
if ($method == "reply" OR $method == "editreply") {
 if($T_TopicAuthorMod > 0) {
 $author_mod_name = '<a href="index.php?mode=f&f='.$f.'"><font color="'.author_mod_color2($T_TopicAuthorMod, $f).'">'.author_mod($T_TopicAuthorMod, $f).'</font></a>';	 
 } else {
 $author_mod_name = $T_MemberName;
 }	
            echo'
            <tr>
                <td class="main" colSpan="2"><font size="3"><a href="index.php?mode=t&t='.$T_TopicID.'">'.$lang['editor']['the_topic'].' '.$T_TopicSubject.'</a></font> - '.$lang['editor']['the_author'].' '.$author_mod_name.'</td>
            </tr>';

	if ($quote == 0) {
        $T_TopicMessage = $R_ReplyMessage;
	}
		if($quote == 1 && $type == ""){
		header("Location: ".index()."");
		exit();
	}
	
	if ($quote == 1 && $type == "r") {
		$rdate = replies("DATE",$r);
		$author = replies("AUTHOR",$r);
				$rt = replies("TOPIC_ID",$r);
		$rsubject = topics("SUBJECT",$rt);
		$hidden_posts = members("HIDE_POSTS", $author);
if($hidden_posts == 1 && mlv < 3){
    $T_TopicMessage = reply_quotee($author);
}else{
$T_TopicMessage = reply_quote($rt, "&r=".$r."", $author, $rdate, $R_ReplyMessage);
}
	}
	if ($quote == 1 && $type == "t") {
		$tdate = topics("DATE",$t);
		$author = topics("AUTHOR",$t);
				$tsubject = topics("SUBJECT",$t);
		$hidden_topics = members("HIDE_POSTS", $author);
if($hidden_topics == 1 && mlv < 3){
    $T_TopicMessage = reply_quotee($author);
}else{
$T_TopicMessage = reply_quote($t, "", $author, $tdate, $T_TopicMessage);
}
	}
//$T_TopicMessage = $R_ReplyMessage;
}
if ($method == "topic" OR $method == "edit") {

            echo'
            <tr>
                <td colSpan="2">
'.$lang['editor']['topic_address'].' <input maxLength="100" name="subject" value="'.$T_TopicSubject.'" style="WIDTH: 200px;font-family: arial; font-size: 15; font-weight: bold; color: black;">
&nbsp;'.$lang['others']['topic_desc'].' <input name="desc" maxLength="250" value="'.$T_TopicDesc.'" style="WIDTH: 200px;font-family: arial; font-size: 15; font-weight: bold; color: black;">				
&nbsp;&nbsp;'.$lang['others']['minimize_pic'].' <input name="img" value="'.$T_TopicImg.'" style="WIDTH: 190px;font-family: arial; font-size: 15; font-weight: bold; color: black;">				
				</td>
            </tr>
';
}

if ($method == "addads" OR $method == "editads") {

            echo'
            <tr>
                <td colSpan="2">'.$lang['admin_ads']['ad_title'].': <input maxLength="100" name="subject" value="'.$T_TopicSubject.'" style="WIDTH: 400px;font-family: arial; font-size: 15; font-weight: bold; color: black;"></td>
            </tr>';
}



echo'


        </table>
        </td>
    </tr>
	
	<tr>
		<td>
		    <table style="display: block; border-left: 1px solid #d9d9d9; border-right: 1px solid #e0e0e0; border-top: 1px solid #d9d9d9; background: #f2f2f6" cellSpacing="0" cellPadding="1" width="100%" border="0" valign="center">
			<tr>
                <td width="100%"></td>
			</tr>
		</table>
		</td>
	</tr>
	
    <tr>
		<td height="100%">
		<table height="100%" cellSpacing="0" cellPadding="0" width="100%">
			<tr>
				<td>
				<table height="100%" cellSpacing="0" cellPadding="0" width="100%" border="0">
					<tr>
                        <td vAlign="top">

					   <textarea id="txtContent" class="txtContent" name="txtContent">'.stripslashes($T_TopicMessage).'</textarea>
					   <script type="text/javascript">

    $(document).ready(function () {


        $("#txtContent").liveEdit({
			    css: ["get.php?type=css&method=editor","webawesome.css"],
		  arrCustomButtons: [
		  ["SubmitData", "SubmitForm()", "'.$lang['editor']['insert_text'].'", "btnSave.gif"],
		  ["ResetData", "ResetContents()", "'.$lang['editor']['back_normal_text'].'", "btnAbsolute.gif"],
		  ["CancelData", "goToSimple()", "'.$lang['editor']['cancel'].'", "btnContentBlock.gif"],
		  ["CountText", "showTextCount()", "'.$lang['editor']['ed_cur_size'].'", "btnCustom1.gif"],
		  ["StoreText", "StoreText()", "'.$lang['other']['save_text_temp'].'", "btnBookmark.gif"],
		  ["EmoData","modalDialog(\'innova/scripts/common/websmilies.htm\',140,360)","'.$lang['editor']['icons'].'","btnCustomObject.gif"],
		  ["LinkText","modalDialog(\'innova/scripts/common/weblink.htm\',605,450)","'.$lang['other']['link_url'].'","btnHyperlink.gif"],
		  ["YoutubeDialog","modalDialog(\'innova/scripts/common/webyoutube.htm\',605,450)","'.$lang['other']['youtube'].'","btnYoutubeVideo.gif"]		  
		  ],
            groups: [
                ["group1", "", ["SubmitData", "ResetData", "CancelData", "SearchDialog", ]],
                ["group2", "", ["Cut", "Copy", "Paste", "StoreText"]],
                ["group3", "", ["Bold", "Italic", "Underline", "Strikethrough", "FontDialog", "FontSize", "ForeColor", "TextDialog", "RemoveFormat"]],
                ["group4", "", ["Bullets", "Numbering", "CharsDialog", "JustifyLeft", "JustifyCenter", "JustifyRight", "LTR", "RTL"]],
                ["group5", "", ["LinkText", "ImageDialog", "YoutubeDialog", "TableDialog", "EmoData", "Line"]],
                ["group6", "", ["Undo", "Redo", "FullScreen",
			';
			if($Mlevel == 1) {
				echo'
				"CountText"
				';
			}
			if($Mlevel > 1 ) {
			echo'
			"CountText", "SourceDialog"
			';
			}	
			echo'
                ]]
					';
					echo'
				] /* Toolbar configuration */
        });
		
        $("#txtContent").data("liveEdit").startedit(); /* Run the Editor */
    });
</script>

                        </td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

';

echo '        
<textarea rows="30" cols="100" id="hinp" name="hinp" class="hinp" style="display:none">'.stripslashes($T_TopicMessage).'</textarea></form>';

}
else {
show_error(29, "", 1);
}
} else {
if (forums("SEX", $f) == 2) {
show_error(48, "", 1);
}
if (forums("SEX", $f) == 1) {
show_error(49, "", 1);
}
}

mysqli_close();
?>
<style>
TD.tarek{background-image:url(captcha/backgrounds/captcha.png);border-width:1px;}
</style>