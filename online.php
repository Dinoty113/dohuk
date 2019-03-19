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

$ip2long = ip2long($_SERVER['REMOTE_ADDR']);
$date = time();
$out_date = time() - 60*10;
$member_browse = members('BROWSE', $DBMemberID);

if (empty($f)){
	if (empty($t)) {
		$f = 0;	
	}
	else{
		$f = topics("FORUM_ID", $t);
	}
}
if($DBMemberID != 0) {

$if_online = DBi::$con->query("SELECT * FROM ".$Prefix."ONLINE WHERE O_MEMBER_ID = '$DBMemberID' ") or die (DBi::$con->error);
if(mysqli_num_rows($if_online) <= 0){

	$in_online = "INSERT INTO ".$Prefix."ONLINE (ONLINE_ID, O_MEMBER_ID, O_FORUM_ID, O_MEMBER_LEVEL, O_MEMBER_DEPUTY, O_MEMBER_BROWSE, O_IP, O_MODE, O_DATE, O_LAST_DATE) VALUES (NULL, ";
	$in_online .= " '$DBMemberID', ";
	$in_online .= " '$f', ";
	$in_online .= " '$Mlevel', ";
	$in_online .= " '$deputy', ";
	$in_online .= " '$member_browse', ";
	$in_online .= " '$ip2long', ";
	$in_online .= " '$mode', ";
	$in_online .= " '$date', ";
	$in_online .= " '$date') ";
	DBi::$con->query($in_online) or die (DBi::$con->error);
}

$up_online = "UPDATE ".$Prefix."ONLINE SET ";
$up_online .= "O_IP = '$ip2long', ";
$up_online .= "O_FORUM_ID = '$f', ";
$up_online .= "O_MEMBER_LEVEL = '$Mlevel', ";
$up_online .= "O_MEMBER_DEPUTY = '$deputy', ";
$up_online .= "O_MEMBER_BROWSE = '$member_browse', ";
$up_online .= "O_MODE = '$mode', ";
$up_online .= "O_LAST_DATE = '$date' ";
$up_online .= "WHERE O_MEMBER_ID = '$DBMemberID' ";
DBi::$con->query($up_online) or die (DBi::$con->error);

}

if($DBMemberID == 0) {

$if_online = DBi::$con->query("SELECT * FROM ".$Prefix."ONLINE WHERE O_IP = '$ip2long' ") or die (DBi::$con->error);
if(mysqli_num_rows($if_online) <= 0){

	$in_online = "INSERT INTO ".$Prefix."ONLINE (ONLINE_ID, O_MEMBER_ID, O_FORUM_ID, O_MEMBER_LEVEL, O_MEMBER_DEPUTY, O_MEMBER_BROWSE, O_IP, O_MODE, O_DATE, O_LAST_DATE) VALUES (NULL, ";
	$in_online .= " '$DBMemberID', ";
	$in_online .= " '$f', ";
	$in_online .= " '$Mlevel', ";
	$in_online .= " '$deputy', ";
	$in_online .= " '$member_browse', ";
	$in_online .= " '$ip2long', ";
	$in_online .= " '$mode', ";
	$in_online .= " '$date', ";
	$in_online .= " '$date') ";
	DBi::$con->query($in_online, $connection) or die (DBi::$con->error);
}

$up_online = "UPDATE ".$Prefix."ONLINE SET ";
$up_online .= "O_MEMBER_ID = '$DBMemberID', ";
$up_online .= "O_FORUM_ID = '$f', ";
$up_online .= "O_MEMBER_LEVEL = '$Mlevel', ";
$up_online .= "O_MEMBER_DEPUTY = '$deputy', ";
$up_online .= "O_MEMBER_BROWSE = '$member_browse', ";
$up_online .= "O_MODE = '$mode', ";
$up_online .= "O_LAST_DATE = '$date' ";
$up_online .= "WHERE O_IP = '$ip2long' ";
DBi::$con->query($up_online) or die (DBi::$con->error);

}

@DBi::$con->query("DELETE FROM ".$Prefix."ONLINE WHERE O_LAST_DATE < '$out_date' ") or die (DBi::$con->error);

function schat_delete_online(){
$time_check = time() - (60 * 5);
@DBi::$con->query("DELETE FROM ".prefix."chat_online WHERE time < $time_check");
}
schat_delete_online();
?>
