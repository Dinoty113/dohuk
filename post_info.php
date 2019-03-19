<?
/*if (@eregi("post_info.php","$_SERVER[PHP_SELF]")) {
header("HTTP/1.0 404 Not Found");
require_once("customavatars/foundfile.htm");
exit();
}
error_reporting(0);
ini_set('display_errors', 'On');*/
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
include('engine/forum_function.php');
if($Mlevel > 0) {
$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
$method = DBi::$con->real_escape_string(HtmlSpecialchars(esset_post('method')));
$quote = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('quote'))));
$r = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('r'))));
$t = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('t'))));
$f = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('f'))));
$ad = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('ad'))));
$c = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('c'))));
$m = DBi::$con->real_escape_string(htmlspecialchars(esset_post('m')));
if($Mlevel > 2) {
$id = DBi::$con->real_escape_string(htmlspecialchars(esset_post('id')));
}
$m_forum_id = DBi::$con->real_escape_string(esset_post('m_forum_id'));
$m_forum_id_all = abs($m_forum_id);
$host = DBi::$con->real_escape_string(HtmlSpecialchars(esset_post('host')));
$type = DBi::$con->real_escape_string(HtmlSpecialchars(esset_post('type')));
$pm_from = DBi::$con->real_escape_string(HtmlSpecialchars(esset_post('pm_from')));
$pm_to = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('pm_to'))));
$msg = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('msg'))));
$refer = DBi::$con->real_escape_string(htmlSpecialchars(esset_post('refer')));
$hidden = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('hidden'))));
$lock = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('lock'))));
$sticky = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('sticky'))));
$hidden_r = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('hidden_r'))));
$lock_r = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('lock_r'))));
$subject = DBi::$con->real_escape_string(HtmlSpecialchars(esset_post('subject')));
$img = DBi::$con->real_escape_string(HtmlSpecialchars(esset_post('img')));
$desc = DBi::$con->real_escape_string(HtmlSpecialchars(esset_post('desc')));
$message = stripslashes(htmlSpecialchars(esset_post('hinp')));
$captcha = DBi::$con->real_escape_string(HtmlSpecialchars(esset_post('captcha')));
$adlock = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('adlock'))));
$adforum = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('adforum'))));
$adsocial1 = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('adsocial1'))));
$adsocial2 = DBi::$con->real_escape_string(HtmlSpecialchars(intval(esset_post('adsocial2'))));
$postrefer = DBi::$con->real_escape_string(htmlSpecialchars(esset_post('postrefer')));
$format = DBi::$con->real_escape_string(htmlSpecialchars(esset_post('format')));
if($pm_from > 0 && $pm_from != $DBMemberID) {
$pm_from = $DBMemberID;	
}

if($pm_from < 0 && !in_array(abs($pm_from), chk_allowed_forums())) {
redirect();	
}
if($pm_to < 0) {
$forum = abs($pm_to);
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
		
if(trim($img) == "") {
$img_src = "".$site_name."/profile/portal_none.png";	
} else {
$img_src = $img;
}
if(trim($desc) == "") {
$desc_name = $subject;
} else {
$desc_name = $desc;
}	


if(!isset($method) || $method == ""){
	header("Location: ".index()."");
	exit();
}
if (isset($c) && $c != "" && $f == ""){
	header("Location: ".index()."");
	exit();
}
if($method == "topic" && $f == "") {
    header("Location: ".index()."");
	exit();
}
if($method == "reply" && $t == ""){
	header("Location: ".index()."");
	exit();
}
if($type == "q_reply" && $t == ""){
	header("Location: ".index()."");
	exit();
}
if($method == "edit" && $t == ""){
	header("Location: ".index()."");
	exit();
}
if($method == "editads" && $ad == ""){
	header("Location: ".index()."");
	exit();
}
if($method == "editreply" && $r == ""){
	header("Location: ".index()."");
	exit();
}
if($method == "sig" && !isset($DBMemberID)){
	header("Location: ".index()."");
	exit();
}
if($method == "reply" && $f == ""){
				$f = topics("FORUM_ID",$t);
}
if($method == "reply" && $f == 0){
				$f = topics("FORUM_ID",$t);
}
if($method == "reply" && $c == ""){
				$c = forums("CAT_ID",$f);
}
if($method == "reply" && $c == 0){
				$c = forums("CAT_ID",$f);
}

if (isset($r) && $r != "" && $q == ""){
//	$q = -$r;
}
if (isset($q) && $q != "" && $r == ""){
	$r = abs2($q);
}
if (isset($f) && $f != "" && $c == 0){
	$c = forums("CAT_ID", $f);
}
if($method == "replymsg" && $pm_to == ""){
    header("Location: ".index()."");
	exit();
}

if($method == "sendmsg" && $pm_to == ""){
    header("Location: ".index()."");
	exit();
}
if($method == "sendmsg" && $pm_from == ""){
    header("Location: ".index()."");
	exit();
}

if($format == "quick") {
$_POST['message'] = htmlSpecialchars($_POST['message']);	
}

if (!isset($message) || $message == "" || empty($message) ){
	$message = stripslashes(htmlSpecialchars($_POST['message']));
}
$moderate_topic  = forums("MODERATE_TOPIC", $f);
$moderate_reply  = forums("MODERATE_REPLY", $f);
    

	 
if (M_Style_Form){
if ($type == "q_reply"){
if ($format == "quick") {	
$message_fix = nl2br(stripslashes(htmlSpecialchars($_POST['message'])));
} else {
$message_fix = stripslashes(htmlSpecialchars($_POST['message']));
}
$message = '<div style="'.M_Style_Form.'">'.$message_fix.'</div>';
}else{
$message_fix = stripslashes(htmlSpecialchars($_POST['hinp']));
$message = '<div style="'.M_Style_Form.'">'.$message_fix.'</div>';
}

}

else{
if ($type == "q_reply"){
if ($format == "quick") {	
$message = nl2br(stripslashes(htmlSpecialchars($_POST['message'])));
} else {
$message = stripslashes(htmlSpecialchars($_POST['message']));
}
}else{
$message_fix = stripslashes(htmlSpecialchars($_POST['hinp']));
$message = '<div style="'.M_Style_Form.'">'.$message_fix.'</div>';
}
}
$message = addslashes($message);
$message = addslashes($message);
$ReplyAndLock = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['ReplyAndLock']));
$ReplyAndUnLock = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['ReplyAndUnLock']));
$date = time();


if ($method == "topic" OR $method == "reply" && $Mlevel == 1){ 
$last_date = time() - 4; 
if($rs['M_LAST_POST_DATE'] >= $last_date){ 
show_error(21 , "", 1);
exit();
} 
} 
if($Mlevel == 4) {
if($adlock == 1) {
$adlock = 0;	
} else {
$adlock = 1;	
}
} else {
$adlock = 1;	
}
$Monitor_all = chk_monitor($DBMemberID, $c);
$Moderator_all = chk_moderator($DBMemberID, $f);
if ($Mlevel == 4 OR $Monitor_all == 1 OR $Moderator_all == 1) {
if ($lock == 1) {
    $lock = 0;
} else {
    $lock = 1;
}

if ($sticky == 1) {
    $sticky = 1;
} else {
    $sticky = 0;
}

if ($hidden == 1) {
    $hidden = 1;
} else {
    $hidden = 0;
}
} else {
$lock = 1;
$sticky = 0;
$hidden = 0;	
}
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false && $type != "q_reply") {
		if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])){	 
		include("post_editor_new.php");
		} else {
		include("post_editor.php");
		}
	} else {
post_header();
$sql = @DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '$m' AND USER = '$DBMemberID' AND CAT_ID = '-2' ");
$num = mysqli_num_rows($sql);
if($method == "sendmsg") {
	if($m < 0) {
	if(forums("STATUS", abs($m)) == 0 && allowed(abs($m), 2) != 1) {
show_error(44);
	}	
	}	
if($m > 0) {
$pm_hide = members("PMHIDE", $m);
if($pm_hide == 0 && $Mlevel < 2) {
show_error(31);
}	
if($num > 0 && $Mlevel < 2) {
show_error(32);
}	
}
$member_messages_today = member_messages_today($m);
if($Mlevel == 1) {
$total_pm_message_all = $total_pm_message;
}
if($Mlevel > 1) {
$total_pm_message_all = $total_pm_message_m;
}	
    if ($member_messages_today >= $total_pm_message_all && members("LEVEL", $m) < 2 ) {
show_error(38);
    }
if($Mlevel == 1 AND member_name($m) AND $DBMemberPosts < $new_member_min_posts_pm AND members("LEVEL", $m) == 1){
show_error(20);
}
if($user_info['M_USE_PM'] == 1){
show_error(23);
}
}
if($method == "replymsg") {
	if($m < 0) {
	if(forums("STATUS", abs($m)) == 0 && allowed(abs($m), 2) != 1) {
show_error(44);
	}	
	}	
if($m > 0) {	
$pm_hide = members("PMHIDE", $pm_from);
if($pm_hide == 0 && $Mlevel < 2) {
show_error(31);
}
if($num > 0 && $Mlevel < 2) {
show_error(32);
}	
}
if($Mlevel == 1) {
$total_pm_message_all = $total_pm_message;
}
if($Mlevel > 1) {
$total_pm_message_all = $total_pm_message_m;
}	
	$member_messages_today = member_messages_today($pm_from);
    if ($member_messages_today >= $total_pm_message_all && members("LEVEL", $pm_from) < 2 ) {
show_error(38);
    }	
if($user_info['M_USE_PM'] == 1){
show_error(23);
}
}
if($method == "sig") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
}
if ($method == "addads" or $method == "editads") {
    if ($Mlevel != 4) {
		redirect();
    }
}
$c_status = cat("STATUS", $c);
$f_status = forums("STATUS", $f);
$mod_ShowForum = mod_ShowForum($DBMemberID, $f);
$c_hide = cat("HIDE", $c);
$f_hide = forums("HIDE", $f);
$c_level = cat("LEVEL", $c);
$f_level = forums("F_LEVEL", $f);
$check_forum_login = check_forum_login($f);
$check_cat_login = check_cat_login($c);
$your_sex = members("SEX", $DBMemberID);
if ($method == "topic") {
if (forums("SEX", $f) == 2 && $your_sex != 2 && allowed($f, 2) != 1) {
echo'	
<br><center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['others']['female_posts'].'</font><br><br>
				<a href="'.$_SERVER['HTTP_REFERER'].'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>
		';
		exit();
}
if (forums("SEX", $f) == 1 && $your_sex != 1 && allowed($f, 2) != 1) {
	echo'
<br><center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['others']['female_posts'].'</font><br><br>
				<a href="'.$_SERVER['HTTP_REFERER'].'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>
		';
		exit();
}
	if($c_hide == 1 && $check_cat_login == 0) {
show_error(39);
	}
	if($f_hide == 1 && $check_forum_login == 0) {
show_error(39);
	}	
	if($c_level > 0 && $c_level > $Mlevel) {
show_error(39);
	}
	if($f_level > 0 && $f_level > $Mlevel) {
show_error(39);
	}	
    if ($Mlevel != 4 AND $c_status == 0) {
show_error(1);
    }
    if ($Mlevel != 4 AND $f_status == 0) {
show_error(2);
    }
if (members("TOPICS_ADD", $DBMemberID) == 1) {
show_error(24);
}

if ($mod_ShowForum == 1) {
show_error(28, $f);
    }

	$member_topics_today = member_topics_today($DBMemberID, $f);
	$f_total_topics = forums("TOTAL_TOPICS", $f);
    if (allowed($f, 2) != 1 AND $member_topics_today >= $f_total_topics) {
show_error(13, $f);
    }
    if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15, $f);
    }
    if (mon_AllForum($DBMemberID) == 1) {
show_error(16, $f);
    }
	if (HoldedMembers($DBMemberID) == 1) {
show_error(43);
	}	
    $f_level = forums("F_LEVEL", $f);
    if ($f_level > 0 AND $Mlevel < $f_level){
     redirect();
    }
}
$t_status = topics("STATUS", $t);
$t_moderate = topics("UNMODERATED", $t);
$t_author = topics("AUTHOR", $t);
$t_hidden = topics("HIDDEN", $t);
$t_holded = topics("HOLDED", $t);
if ($method == "edit") {
if (forums("SEX", $f) == 2 && $your_sex != 2 && allowed($f, 2) != 1) {
show_error(48);
}
if (forums("SEX", $f) == 1 && $your_sex != 1 && allowed($f, 2) != 1) {
show_error(49);
}	
	if($c_hide == 1 && $check_cat_login == 0) {
show_error(39);
	}
	if($f_hide == 1 && $check_forum_login == 0) {
show_error(39);
	}	
	if($c_level > 0 && $c_level > $Mlevel) {
show_error(39);
	}
	if($f_level > 0 && $f_level > $Mlevel) {
show_error(39);
	}		
if (members("TOPICS_EDIT", $DBMemberID) == 1) {
show_error(26);
}

if ($mod_ShowForum == 1) {
show_error(28, $f);
}
    if ($Mlevel != 4 AND $c_status == 0) {
show_error(3);
    }
    if ($Mlevel  != 4  AND $f_status == 0) {
show_error(4);
    }
    if (allowed($f, 2) != 1 AND $t_status == 0) {
show_error(5);
    }
    if (allowed($f, 2) != 1 AND $t_moderate == 1) {
show_error(35);
    }		
    if (allowed($f, 2) != 1 AND $t_author != $DBMemberID) {
show_error(6);
    }
   if ((allowed($f, 2) != 1 AND $t_hidden == 1 AND chk_load_topic($t) == 0) OR (allowed($f, 2) != 1 AND $t_hidden == 1 AND $t_author != $DBMemberID AND chk_load_topic($t) == 0)){
show_error(37);
    }	
    if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15, $f);
    }
    if (mon_AllForum($DBMemberID) == 1) {
show_error(16, $f);
    }
	if (HoldedMembers($DBMemberID) == 1) {
show_error(43);
	}	
    if (topics("UNMODERATED", $t) == 1) {
show_error(17, $f);
    }
	if(topics("ARCHIVED", $t) == 1 && $Mlevel != 4) {
show_error(47);
	}	
	if ($t_holded == 1 && allowed($f, 2) != 1) {
show_error(42);
	}
}
if ($method == "reply") {
if (forums("SEX", $f) == 2 && $your_sex != 2 && allowed($f, 2) != 1) {
show_error(48);
}
if (forums("SEX", $f) == 1 && $your_sex != 1 && allowed($f, 2) != 1) {
show_error(49);
}
	if($c_hide == 1 && $check_cat_login == 0) {
show_error(39);
	}
	if($f_hide == 1 && $check_forum_login == 0) {
show_error(39);
	}	
	if($c_level > 0 && $c_level > $Mlevel) {
show_error(39);
	}
	if($f_level > 0 && $f_level > $Mlevel) {
show_error(39);
	}		
if (members("POSTS_ADD", $DBMemberID) == 1) {
show_error(25);
}
if ($mod_ShowForum == 1) {
show_error(28, $f);
}


    if ($Mlevel != 4 AND $c_status == 0) {
show_error(7);
    }
    if ($Mlevel != 4 AND $f_status == 0) {
show_error(8);
    }
    if (allowed($f, 2) != 1 AND $t_status == 0) {
show_error(9);
    }
   if ((allowed($f, 2) != 1 AND $t_hidden == 1 AND chk_load_topic($t) == 0) OR (allowed($f, 2) != 1 AND $t_hidden == 1 AND $t_author != $DBMemberID AND chk_load_topic($t) == 0)){
show_error(10);
    }
	$member_replies_today = member_replies_today($DBMemberID, $f);
	$f_total_replies = forums("TOTAL_REPLIES", $f);
    if (allowed($f, 2) != 1 AND $member_replies_today >= $f_total_replies) {
show_error(14, $f);
    }
    if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15, $f);
    }
    if (mon_AllForum($DBMemberID) == 1) {
show_error(16, $f);
    }
	if (HoldedMembers($DBMemberID) == 1) {
show_error(43);
	}	
    if (topics("UNMODERATED", $t) == 1) {
show_error(18, $f);
    }
    if(topics("ARCHIVED", $t) == 1 && $Mlevel != 4){
show_error(19);
    }

    $f_level = forums("F_LEVEL", $f);
    if ($f_level > 0 AND $Mlevel < $f_level){
     redirect();
    }
	if ($t_holded == 1 && allowed($f, 2) != 1) {
show_error(40);
	}	
}
$r_moderate = replies("UNMODERATED", $r);
$r_author = replies("AUTHOR", $r);
if ($method == "editreply") {
if (forums("SEX", $f) == 2 && $your_sex != 2 && allowed($f, 2) != 1) {
show_error(48);
}
if (forums("SEX", $f) == 1 && $your_sex != 1 && allowed($f, 2) != 1) {
show_error(49);
}
	if($c_hide == 1 && $check_cat_login == 0) {
show_error(39);
	}
	if($f_hide == 1 && $check_forum_login == 0) {
show_error(39);
	}	
	if($c_level > 0 && $c_level > $Mlevel) {
show_error(39);
	}
	if($f_level > 0 && $f_level > $Mlevel) {
show_error(39);
	}		
if (members("POSTS_EDIT", $DBMemberID) == 1) {
show_error(27);
}
    if (allowed($f, 2) != 1 AND $t_status == 0) {
show_error(33);
    }
    if (allowed($f, 2) != 1 AND $r_moderate == 1) {
show_error(34);
    }	
    if ($Mlevel != 4 AND $c_status == 0) {
show_error(11);
    }	
    if ($Mlevel != 4 AND $f_status == 0) {
show_error(12);
    }
    if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15, $f);
    }
    if (mon_AllForum($DBMemberID) == 1) {
show_error(16, $f);
    }
	if (HoldedMembers($DBMemberID) == 1) {
show_error(43);
	}	
    if (allowed($f, 2) != 1 AND $r_author != $DBMemberID) {
show_error(36);
    }
	if(topics("ARCHIVED", $t) == 1 && $Mlevel != 4) {
show_error(47);
	}	
	if ($t_holded == 1 && allowed($f, 2) != 1) {
show_error(41);
	}	
}

	
if ($method == "ads" OR $method == "editads") {
    if ($message == "") {
    $error = $lang['other']['enter_ad_message'];
    }
    if ($subject == "") {
    $error = $lang['other']['enter_ad_subject'];
    }
    if (trim($subject) == "") {
    $error = $lang['other']['enter_ad_subject'];
    }	
}
if ($method == "topic" OR $method == "edit") {
    if ($message == "") {
    $error = $lang['post_info']['necessary_to_write_topic'];
    }
    if ($subject == "") {
    $error = $lang['post_info']['necessary_to_write_title_topic'];
    }
    if (trim($subject) == "") {
    $error = $lang['post_info']['necessary_to_write_title_topic'];
    }	
}

if ($method == "reply" OR $method == "editreply") {
    if ($message == "") {
    $error = $lang['post_info']['necessary_to_write_reply'];
    }
}
if($method == "sendmsg" OR $method == "replymsg") {
	$member_messages_today = member_messages_today($DBMemberID);
if($Mlevel == 1) {
$total_pm_message_all = $total_pm_message;
}
if($Mlevel > 1) {
$total_pm_message_all = $total_pm_message_m;
}		
    if ($member_messages_today >= $total_pm_message_all && $pm_to == abs($pm_to) && members("LEVEL", $pm_to) < 2 ) {
	$error = ''.$lang['msg']['error_38_1'].' '.$total_pm_message_all.' '.$lang['msg']['error_38_2'].'';
    }
$status = members("STATUS", $pm_to);	
   if ($status == "0") {
    $error = $lang['other']['cant_send_to_lock_member'];
    }	
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
	                </center><xml>';
}

if ($error == "") {
	if($method == "addads") {
		
	$ads = "INSERT INTO " . $Prefix . "ADS (AD_ID, AD_SUBJECT, AD_MESSAGE, AD_DATE, AD_STATUS, AD_SHOW_FORUM, AD_SHOW_SOCIAL_1, AD_SHOW_SOCIAL_2, AD_AUTHOR) VALUES (NULL, ";
	$ads .= " '$subject', ";
	$ads .= " '$message', ";
	$ads .= " '$date', ";
	$ads .= " '$adlock', ";
	$ads .= " '$adforum', ";
	$ads .= " '$adsocial1', ";
	$ads .= " '$adsocial2', ";
	$ads .= " '$DBMemberID') ";
		@DBi::$con->query($ads, $connection) or die (DBi::$con->error);		

		
		
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['forum_function']['done_add_ad'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$postrefer.'">
                           <a href="'.$postrefer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    if ($method == "editads") {

	$ads = "UPDATE " . $Prefix . "ADS SET ";
	$ads .= "AD_SUBJECT = '$subject', ";
	$ads .= "AD_MESSAGE = '$message', ";
	$ads .= "AD_STATUS = '$adlock', ";
	$ads .= "AD_SHOW_FORUM = '$adforum', ";
	$ads .= "AD_SHOW_SOCIAL_1 = '$adsocial1', ";
	$ads .= "AD_SHOW_SOCIAL_2 = '$adsocial2' ";
	$ads .= "WHERE AD_ID = '$ad' ";
		@DBi::$con->query($ads, $connection) or die (DBi::$con->error);


	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['forum_function']['done_edit_ad'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$postrefer.'">
                           <a href="index.php?mode=ad&ad='.$ad.'">'.$lang['admin_ads']['click_here_to_go_to_ad'].'</a><br><br>
						    <a href="'.$postrefer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
	
    if ($method == "topic") {

		if(forums("MODERATE_POSTS", $f) == 0) {
		$chk_member_posts_t = chk_new_member_posts($DBMemberID);
		} else {
		$chk_member_posts_t = chk_new_member_posts_f_t($f, $DBMemberID);
		}
		$mod_OneForum = mod_OneForum($DBMemberID, $f);
		$mod_AllForum = mod_AllForum($DBMemberID);
		$m_date = members("DATE", $DBMemberID);
		$f_days = forums("MODERATE_DAYS", $f);
		if (($mod_OneForum == 1 OR $mod_AllForum == 1 OR $chk_member_posts_t == 0 OR member_total_days($m_date) < $f_days) AND $moderate_topic == 0 AND allowed($f, 2) != 1) {
		$topic_added_msg = $lang['post_info']['the_topic_is_added_but_it_require_moderation'];
		$t_unmoderated = "1";
		}
		else{
		$topic_added_msg = $lang['post_info']['the_topic_is_added'];
		$t_unmoderated = "0";
		}
	$topics = "INSERT INTO " . $Prefix . "TOPICS (TOPIC_ID, FORUM_ID, CAT_ID, T_SUBJECT, T_MESSAGE, T_DATE, T_AUTHOR, T_STATUS, T_STICKY, T_HIDDEN, T_UNMODERATED, T_LAST_POST_DATE, T_IMG, T_DESC) VALUES (NULL, ";
	$topics .= " '$f', ";
	$topics .= " '$c', ";
	$topics .= " '$subject', ";
	$topics .= " '$message', ";
	$topics .= " '$date', ";
	$topics .= " '$DBMemberID', ";
	$topics .= " '$lock', ";
	$topics .= " '$sticky', ";
	$topics .= " '$hidden', ";
	$topics .= " '$t_unmoderated', ";
	$topics .= " '$date', ";
	$topics .= " '$img', ";
	$topics .= " '$desc') ";
		@DBi::$con->query($topics, $connection) or die (DBi::$con->error);  
     if(f_last_post_date_topics($f) > f_last_post_date_replies($f)) {
		$f_last_post_date = f_last_post_date_topics($f); 
		$f_last_post_author = f_last_post_author_topics($f);		
	 }
     if(f_last_post_date_replies($f) > f_last_post_date_topics($f)) {
		$f_last_post_date = f_last_post_date_replies($f); 
		$f_last_post_author = f_last_post_author_replies($f);
	 }	
     if(f_last_post_date_replies($f) == f_last_post_date_topics($f)) {
		$f_last_post_date = $date;
		$f_last_post_author = 0;
	 }		 
	$forum = "UPDATE " . $Prefix . "FORUM SET "; 
	$forum .= "F_TOPICS = '".topics_num($f)."', ";
	$forum .= "F_LAST_POST_DATE = '".$f_last_post_date."', ";
	$forum .= "F_LAST_POST_AUTHOR = '".$f_last_post_author."' ";
	$forum .= "WHERE FORUM_ID = '$f' ";
		@DBi::$con->query($forum, $connection) or die (DBi::$con->error);
if($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0)) {
	$posts = HoldPosts(posts($DBMemberID), $Mlevel, $deputy, $hold_posts, $hold_active);
} else {
	$posts = posts($DBMemberID);
}    
     if(last_post_date_topics_m($DBMemberID) > last_post_date_replies_m($DBMemberID)) {
		$last_post_date_m = last_post_date_topics_m($DBMemberID); 
	 }
     if(last_post_date_replies_m($DBMemberID) > last_post_date_topics_m($DBMemberID)) {
		$last_post_date_m = last_post_date_replies_m($DBMemberID); 
	 }
     if(last_post_date_replies_m($DBMemberID) == last_post_date_topics_m($DBMemberID)) {
		$last_post_date_m = $date;
	 }	 
	 $dollar_topic = forums("DOLLAR_TOPIC", $f);
	$members = "UPDATE " . $Prefix . "MEMBERS SET ";
	$members .= "M_POSTS = '".$posts."', ";
	$members .= "M_DOLLAR = M_DOLLAR + $dollar_topic, ";
	$members .= "M_LAST_POST_DATE = '".$last_post_date_m."' ";	
	$members .= "WHERE MEMBER_ID = '$DBMemberID' ";
		@DBi::$con->query($members, $connection) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$topic_added_msg.'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$postrefer.'">
	                       <a href="index.php?mode=f&f='.$f.'">'.$lang['all']['click_here_to_go_forum'].'</a><br><br>
                           <a href="'.$postrefer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    if ($method == "edit") {


	$topics = "UPDATE " . $Prefix . "TOPICS SET ";
	$topics .= "T_SUBJECT = '$subject', ";
	$topics .= "T_MESSAGE = '$message', ";
	if(allowed($f, 2) == 1) {
	$topics .= "T_STATUS = '$lock', ";
	$topics .= "T_STICKY = '$sticky', ";
	$topics .= "T_HIDDEN = '$hidden', ";
	}
	$topics .= "T_LASTEDIT_MAKE = '$DBMemberID', ";
	$topics .= "T_LASTEDIT_DATE = '$date', ";
	$topics .= "T_IMG = '$img', ";
	$topics .= "T_DESC = '$desc', ";
	$topics .= "T_ENUM = T_ENUM + 1 ";
	$topics .= "WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($topics, $connection) or die (DBi::$con->error);

	// TOPIC EDITS
	insert_new_topic_data($t, $subject, $message);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['post_info']['the_topic_is_update'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$postrefer.'">
                           <a href="index.php?mode=t&t='.$t.'">'.$lang['all']['click_here_to_go_topic'].'</a><br><br>
	                       <a href="index.php?mode=f&f='.$f.'">'.$lang['all']['click_here_to_go_forum'].'</a><br><br>
                           <a href="'.$postrefer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    if ($method == "reply") {


	if (mon_OneForum($DBMemberID, $f) == 1) {
show_error(15, $f);
		$error = 1;
	}
	else if (mon_AllForum($DBMemberID) == 1) {
show_error(16, $f);
		$error = 1;
	}
	else if (HoldedMembers($DBMemberID) == 1) {
show_error(43);
		$error = 1;
	}	
	else if (topics("UNMODERATED", $t) == 1) {
show_error(18, $f);
		$error = 1;
	}

	if ($error != 1) {
		if(forums("MODERATE_POSTS", $f) == 0) {
		$chk_member_posts_r = chk_new_member_posts($DBMemberID);
		} else {
		$chk_member_posts_r = chk_new_member_posts_f_r($f, $DBMemberID);
		}
		$mod_OneForum = mod_OneForum($DBMemberID, $f);
		$mod_AllForum = mod_AllForum($DBMemberID);
		$m_date = members("DATE", $DBMemberID);
		$f_days = forums("MODERATE_DAYS", $f);
		if (($mod_OneForum == 1 OR $mod_AllForum == 1 OR $chk_member_posts_r == 0 OR member_total_days($m_date) < $f_days) AND $moderate_reply  == 0 AND allowed($f, 2) != 1) {
		$reply_added_msg = $lang['post_info']['the_reply_is_added_but_it_require_moderation'];
		$r_unmoderated = "1";
		}
		else{
		$reply_added_msg = $lang['post_info']['the_reply_is_added'];
		$r_unmoderated = "0";
		}

		$member_replies_today = member_replies_today($DBMemberID, $f);
		$f_total_replies = forums("TOTAL_REPLIES", $f);
		if ($Mlevel == 1 AND $member_replies_today >= $f_total_replies OR $Mlevel == 2 AND $Moderator_all == 0 AND $member_replies_today >= $f_total_replies) {
show_error(15, $f);
		}
		else{
			$reply = "INSERT INTO " . $Prefix . "REPLY (REPLY_ID, TOPIC_ID, FORUM_ID, CAT_ID, R_MESSAGE, R_QUOTE, R_UNMODERATED, R_DATE, R_AUTHOR, R_T_HIDDEN) VALUES (NULL, ";
			$reply .= " '$t', ";
			$reply .= " '$f', ";
			$reply .= " '$c', ";
			$reply .= " '$message', ";
			$reply .= " '$quote', ";
			$reply .= " '$r_unmoderated', ";
			$reply .= " '$date', ";
			$reply .= " '$DBMemberID', ";
			if(topics("HIDDEN", $t) == 1) {
			$reply .= " '1') ";
			} else {
			$reply .= " '0') ";
			}
				@DBi::$con->query($reply, $connection) or die (DBi::$con->error);
     if(f_last_post_date_topics($f) > f_last_post_date_replies($f)) {
		$f_last_post_date = f_last_post_date_topics($f); 
		$f_last_post_author = f_last_post_author_topics($f);		
	 }
     if(f_last_post_date_replies($f) > f_last_post_date_topics($f)) {
		$f_last_post_date = f_last_post_date_replies($f); 
		$f_last_post_author = f_last_post_author_replies($f);
	 }	
     if(f_last_post_date_replies($f) == f_last_post_date_topics($f)) {
		$f_last_post_date = f_last_post_date_replies($f); 
		$f_last_post_author = f_last_post_author_replies($f);
	 }
	$forum = "UPDATE " . $Prefix . "FORUM SET ";
	$forum .= "F_REPLIES = '".replies_num($f)."', ";
	$forum .= "F_LAST_POST_DATE = '".$f_last_post_date."', ";
	$forum .= "F_LAST_POST_AUTHOR = '".$f_last_post_author."' ";
	$forum .= "WHERE FORUM_ID = '$f' ";
		@DBi::$con->query($forum, $connection) or die (DBi::$con->error);

			$topics = "UPDATE " . $Prefix . "TOPICS SET ";
			if ($ReplyAndLock != "") {
				$topics .= "T_STATUS = '0', ";
			}
			if ($ReplyAndUnLock != "") {
				$topics .= "T_STATUS = '1', ";
			}
			if($type != "q_reply" && allowed($f, 2) == 1) {
			if ($hidden_r != "0") {
				$topics .= "T_HIDDEN = '1', ";
			} else {
				$topics .= "T_HIDDEN = '0', ";
			}
			if ($lock_r != "0") {
				$topics .= "T_STATUS = '0', ";
			} else {
				$topics .= "T_STATUS = '1', ";
			}
			}
			$topics .= "T_REPLIES = '".post_num($t)."', ";
			$topics .= "T_LAST_POST_DATE = '".last_post_date($t)."', ";
			$topics .= "T_LAST_POST_AUTHOR = '".last_post_author($t)."' ";
			$topics .= "WHERE TOPIC_ID = '$t' ";
				@DBi::$con->query($topics, $connection) or die (DBi::$con->error);
if($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0)) {
	$posts = HoldPosts(posts($DBMemberID), $Mlevel, $deputy, $hold_posts, $hold_active);
} else {
	$posts = posts($DBMemberID);
}    
     if(last_post_date_topics_m($DBMemberID) > last_post_date_replies_m($DBMemberID)) {
		$last_post_date = last_post_date_topics_m($DBMemberID); 
	 }
     if(last_post_date_replies_m($DBMemberID) > last_post_date_topics_m($DBMemberID)) {
		$last_post_date = last_post_date_replies_m($DBMemberID); 
	 }
     if(last_post_date_replies_m($DBMemberID) == last_post_date_topics_m($DBMemberID)) {
		$last_post_date = last_post_date_replies_m($DBMemberID); 
	 }
	 $dollar_reply = forums("DOLLAR_REPLY", $f);
			$members = "UPDATE " . $Prefix . "MEMBERS SET ";
			$members .= "M_POSTS = '".$posts."', ";
			$members .= "M_DOLLAR = M_DOLLAR + $dollar_reply, ";			
			$members .= "M_LAST_POST_DATE = '".$last_post_date."' ";
			$members .= "WHERE MEMBER_ID = '$DBMemberID' ";
				@DBi::$con->query($members, $connection) or die (DBi::$con->error);

                                                      // ############ Close Thread after Some Reply #############

                                                      if($total_post_close_topic){
                                                      @DBi::$con->query("UPDATE ".prefix ."TOPICS SET T_STATUS = ('0') WHERE T_REPLIES >=                                                                                               $total_post_close_topic  AND FORUM_ID = '$f' ");
                                                      }


			echo'
			<center>
			<table width="99%" border="1">
				<tr class="normal">
					<td class="list_center" colSpan="10"><font size="5"><br>'.$reply_added_msg.'</font><br><br>
					<a href="index.php?mode=t&t='.$t.'">'.$lang['all']['click_here_to_go_topic'].'</a><br><br>
					<a href="index.php?mode=f&f='.$f.'">'.$lang['all']['click_here_to_go_forum'].'</a><br><br>';
				if ($type == "q_reply"){
					echo'
					<meta http-equiv="Refresh" content="1; URL='.referer.'">
					<a href="'.referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>';
				}
				else{
					echo'
					<a href="'.$postrefer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>';
				}
					echo'
					</td>
				</tr>
			</table>
			</center>';
		}
	}
    }
    if ($method == "editreply") {


	$reply = "UPDATE " . $Prefix . "REPLY SET ";
	$reply .= "R_MESSAGE = '$message', ";
	$reply .= "R_LASTEDIT_MAKE = '$DBMemberID', ";
	$reply .= "R_LASTEDIT_DATE = '$date', ";
	$reply .= "R_ENUM = R_ENUM + 1 ";
	$reply .= "WHERE REPLY_ID = '$r' ";
		@DBi::$con->query($reply, $connection) or die (DBi::$con->error);

	// REPLY EDITS
	insert_new_reply_data($r, $message);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['post_info']['the_reply_is_update'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$postrefer.'">
                           <a href="index.php?mode=t&t='.$t.'">'.$lang['all']['click_here_to_go_topic'].'</a><br><br>
	                       <a href="index.php?mode=f&f='.$f.'">'.$lang['all']['click_here_to_go_forum'].'</a><br><br>
                           <a href="'.$postrefer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    if ($method == "sig") {
 if(!$id) {
	$id = $DBMemberID; 
 }
 if($id && $Mlevel > 2 && $deputy == 0) {
	$id = $id;
 }
 if($Mlevel < 3) {
	$id = $DBMemberID; 
 }
	$members = "UPDATE ".$Prefix."MEMBERS SET ";
	$members .= "M_SIG = '$message' ";
	$members .= "WHERE MEMBER_ID = '$id' ";
		@DBi::$con->query($members, $connection) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['post_info']['the_sig_is_update'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL=index.php?mode=profile&type=details">
                           <a href="index.php?mode=member&id='.$DBMemberID.'">'.$lang['all']['click_here_to_go_yours_details'].'</a><br><br>
	                       <a href="index.php?mode=profile&type=details">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    
    if ($method == "replymsg") {
	$moderator_id = $DBMemberID;	
     if ($m != "") {
       $DBMemberID = $m;
     }

if($user_info['M_USE_PM'] == 1){
show_error(23);
}
	$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_REPLY, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$sendPm .= " '$DBMemberID', ";
	$sendPm .= " '$pm_to', ";
	$sendPm .= " '$DBMemberID', ";
	$sendPm .= " '1', ";
	if ($msg != "") {
	$sendPm .= " '1', ";
	}
	else {
	$sendPm .= " '0', ";
	}
	$sendPm .= " '$subject', ";
	$sendPm .= " '$message', ";
	$sendPm .= " '$date') ";
		@DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);

	$storePm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_REPLY, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$storePm .= " '$pm_to', ";
	$storePm .= " '$pm_to', ";
	$storePm .= " '$DBMemberID', ";
	$storePm .= " '1', ";
	$storePm .= " '$subject', ";
	$storePm .= " '$message', ";
	$storePm .= " '$date') ";
		@DBi::$con->query($storePm, $connection) or die (DBi::$con->error);
     
	if ($msg != "") {
	$pmReply = "UPDATE ".$Prefix."PM SET ";
	$pmReply .= "PM_REPLY = '2' ";
	$pmReply .= "WHERE PM_ID = '$msg' ";
		@DBi::$con->query($pmReply, $connection) or die (DBi::$con->error);
	}
		if(allowed($m_forum_id_all, 2) == 1) {
			DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$moderator_id'");
		}
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['post_info']['the_pm_is_replied'].'</font><br><br>';
	                    if ($type == "q_reply") {
                           $go_to_normal_page = '<meta http-equiv="Refresh" content="1; URL='.$HTTP_REFERER.'">';
                           $go_to_normal_page .= '<a href="'.$HTTP_REFERER.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>';
	                    }
						if ($type == "") {
                           $go_to_normal_page = '<meta http-equiv="Refresh" content="1; URL='.$postrefer.'">';
                           $go_to_normal_page .= '<a href="'.$postrefer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>';
						}   
	                       echo'
                           '.$go_to_normal_page.'
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
    if ($method == "sendmsg") {
	$moderator_id = $DBMemberID;	
		
if($user_info['M_USE_PM'] == 1){
show_error(23);
}
	$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$sendPm .= " '$pm_from', ";
	$sendPm .= " '$pm_to', ";
	$sendPm .= " '$pm_from', ";
	$sendPm .= " '1', ";
	$sendPm .= " '$subject', ";
	$sendPm .= " '$message', ";
	$sendPm .= " '$date') ";
		@DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);

	$storePm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$storePm .= " '$pm_to', ";
	$storePm .= " '$pm_to', ";
	$storePm .= " '$pm_from', ";
	$storePm .= " '$subject', ";
	$storePm .= " '$message', ";
	$storePm .= " '$date') ";
		@DBi::$con->query($storePm, $connection) or die (DBi::$con->error);
		
	if(allowed($m_forum_id_all, 2) == 1) {
			DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$moderator_id'");
	}		
     
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['post_info']['the_pm_is_send'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$postrefer.'">
	                       <a href="'.$postrefer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
}

post_footer();

	}
} else {
redirect();	
}
?>