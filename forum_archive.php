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


$sqlCheck = DBi::$con->query("

SELECT * FROM ".$Prefix."FORUM WHERE

FORUM_ID = '".f."' LIMIT 1

") or die (DBi::$con->error);

// if the rows is not in object then redirect of the index page

if (mysqli_num_rows($sqlCheck) <= 0)

	 redirect();


if ($f == "") {
 redirect();
}
if(!is_numeric($f) || forums("SUBJECT", $f) == "" || forums("SUBJECT", $f) == false){
	header("Location: ".index()."");
	exit();
}

$f_hide = forums("HIDE", $f);
$f_level = forums("F_LEVEL", $f);
$c = forums("CAT_ID", $f);
$c_hide = cat("HIDE", $c);
$c_level = cat("LEVEL", $c);
$f_login = check_forum_login($f);
$c_login = check_cat_login($c);

if($c_level == 0 or ($c_level > 0 && $c_level <= $Mlevel)) {
} else {
redirect();
}	
if($c_hide == 0 or ($c_hide == 1 && $c_login == 1)) {
} else {
redirect();
}	
if($f_level == 0 or ($f_level > 0 && $f_level <= $Mlevel)) {
} else {
redirect();
}	
if($f_hide == 0 or ($f_hide == 1 && $f_login == 1)) {
} else {
redirect();
}

$allowed = 1;

if (mlv > 0) {
if ($auth == "0") {
$auth = $DBMemberID;
}
if (members("LEVEL", $auth) > "2" AND $Mlevel > "1") {
$allowed = 1;
}
if (members("LEVEL", $auth) > "2" AND $show_admin_topics == "1") {
$allowed = 1;
}
if (members("LEVEL", $auth) > "2" AND $show_admin_topics == "0" AND $Mlevel < "2") {
$allowed = 0;
}
if($auth != "") {
$num_members = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE MEMBER_ID = '$auth'"));
if($num_members == 0) {
$auth = $DBMemberID;
}
}
}

if ($allowed == 1) {

@require_once("./engine/forum_archive_function.php");

// ############ ARCHIVE #############

if(forums("CAN_ARCHIVE", $f) == 0){
$nbr_day = forums("DAY_ARCHIVE", $f);
$time_close = time() - (60 * 60 * 24 * $nbr_day);
@DBi::$con->query("UPDATE ".prefix ."TOPICS SET T_ARCHIVED = ('1') WHERE T_DATE < $time_close AND T_ARCHIVE_FLAG = 1  AND T_STICKY = 0 AND T_LINKFORUM = 0 AND FORUM_ID = $f ") or die(DBi::$con->error);
}

// ############ Close Thread after Some Reply #############

if($total_post_close_topic){
@DBi::$con->query("UPDATE ".prefix ."TOPICS SET T_STATUS = ('0') WHERE T_REPLIES >= $total_post_close_topic  AND FORUM_ID = $f ") or die(DBi::$con->error);
}


$cat_id = forums("CAT_ID", $f);
$f_subject = forums("SUBJECT", $f);
$f_logo = forums("LOGO", $f);

$allowed = allowed($f, 2);

forum_head($f, $cat_id);
link_forum($f);
if($mod_option == "all") {
forum_ads();
}

	if ($order_by == "post"){
		$order_by_date = "T_LAST_POST_DATE DESC, T_DATE DESC";
	}
	else if ($order_by == "topic"){
		$order_by_date = "T_DATE DESC, T_LAST_POST_DATE DESC";
	}
	else{
		$order_by_date = "T_LAST_POST_DATE DESC, T_DATE DESC";
	}

forum_archive($f, $cat_id, $auth);


if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_ONLINE = M_ONLINE + $online_mod_points WHERE MEMBER_ID = '$DBMemberID'");		
}

    } else {
    redirect();
    }

?>
