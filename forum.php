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

if ($Mlevel > 0) {
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

@require_once("./engine/forum_function.php");

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

$the_sex = members("SEX", $DBMemberID);
$f_sex = forums("SEX", $f);
if($Mlevel != 0) {
if(($the_sex == 0 or $the_sex == 1) && $f_sex == 2 && allowed($f, 2) != 1) {
show_error(48);
}
if($the_sex == 2 && $f_sex == 1 && allowed($f, 2) != 1) {
show_error(49);
}
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


	if ($mod_option == "all"){
		$and = "AND T_STATUS < '2'";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "topen" AND $allowed == 1){
		$and = "AND T_STATUS = '1'";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "tunmoderated" AND $allowed == 1){
		$and = "AND T_UNMODERATED = '1' AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "tholded" AND $allowed == 1){
		$and = "AND T_HOLDED = '1' AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "tlocked" AND $allowed == 1){
		$and = "AND T_STATUS = '0' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "runmoderated" AND $allowed == 1){
		forum_replies($f, $cat_id, "unmoderated");
	}
	else if ($mod_option == "rholded" AND $allowed == 1){
		forum_replies($f, $cat_id, "hold");
	}
	else if ($mod_option == "thidden" AND $allowed == 1){
		$and = "AND T_HIDDEN = '1' AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "rhidden" AND $allowed == 1){
		forum_replies($f, $cat_id, "hidden");
	}
	else if ($mod_option == "ttop" AND $allowed == 1){
		$and = "AND T_TOP > '0' AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "tsurvey" AND $allowed == 1){
		$and = "AND T_SURVEYID > '0' AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "tunarchived" AND $allowed == 1){
		$and = "AND T_ARCHIVE_FLAG = '0' AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "tmoved" AND $allowed == 1){
		$and = "AND T_MOVED = '1' AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "tedited" AND $allowed == 1){
		$and = "AND T_LASTEDIT_MAKE > '0' AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "tsocialpen" AND $allowed == 1){
		$and = "AND T_SOCIAL = '1' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}	
	else if ($mod_option == "tsocialapp" AND $allowed == 1){
		$and = "AND T_SOCIAL = '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}	
	else if ($mod_option == "tdeleted" AND ($Mlevel == 4 or $Mlevel == 3 && $deputy == 0)){
		$and = "AND T_STATUS = '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}
	else if ($mod_option == "rdeleted" AND $Mlevel > 2){
		$and = "AND R_STATUS = '2' ";
		forum_replies($f, $cat_id, "delete");
	}	
	else {
		$and = " AND T_STATUS < '2' AND T_ARCHIVED = '0' ";
		forum_topics($f, $cat_id, $auth);
	}


if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_ONLINE = M_ONLINE + $online_mod_points WHERE MEMBER_ID = '$DBMemberID'");		
}

$now_year = date("Y");
$now_month = date("M");
$now_month_number = date("m");
$now_day = date("l");
$now_day_number = date("d");

$sql = DBi::$con->query("SELECT * FROM ".prefix."FORUM_ONLINE WHERE F_ID = '$f' AND F_YEAR = '$now_year' AND F_MONTH = '$now_month' AND F_MONTH_NUMBER = '$now_month_number' AND F_DAY = '$now_day' AND F_DAY_NUMBER = '$now_day_number'");
$num = mysqli_num_rows($sql);
if($num == 0) {
DBi::$con->query("INSERT INTO ".prefix."FORUM_ONLINE (ID, F_ID, F_YEAR, F_MONTH, F_MONTH_NUMBER, F_DAY, F_DAY_NUMBER, F_POINTS) VALUES (NULL, '$f', '$now_year', '$now_month', '$now_month_number', '$now_day', '$now_day_number', '$forum_online')");
} else {
DBi::$con->query("UPDATE ".prefix."FORUM_ONLINE SET F_POINTS = F_POINTS + $forum_online WHERE F_ID = '$f' AND F_YEAR = '$now_year' AND F_MONTH = '$now_month' AND F_MONTH_NUMBER = '$now_month_number' AND F_DAY = '$now_day' AND F_DAY_NUMBER = '$now_day_number'");
}



    } else {
    redirect();
    }
	
?>
