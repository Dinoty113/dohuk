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


//ob_start('ob_gzhandler');
if(!isset($_SESSION)) {
session_start();
}
include('engine/sec_dxss.php');
$g = new dXSS();
$g->url = 'index.php';
$g->longitud = 120;
$g->TestGet();
$sql_inject_1 = array(";","'","%"); #Whoth need replace 
$sql_inject_2 = array("", "",""); #To wont replace 
$GET_KEY = array_keys($_GET); #array keys from $_GET 
$REQUEST_KEY = array_keys($_REQUEST); #array keys from $_REQUEST 
$COOKIE_KEY = array_keys($_COOKIE); #array keys from $_COOKIE 
/*begin clear $_GET */ 
for($i=0;$i<count($GET_KEY);$i++) 
{ 
$_GET[$GET_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, addslashes(DBi::$con->real_escape_string(HtmlSpecialChars($_GET[$GET_KEY[$i]])))); 
} 
/*end clear $_GET */ 
/*begin clear $_REQUEST */ 

/*end clear $_REQUEST */ 
/*begin clear $_COOKIE */ 
for($i=0;$i<count($COOKIE_KEY);$i++) 
{ 
$_COOKIE[$COOKIE_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, addslashes(DBi::$con->real_escape_string(HtmlSpecialChars($_COOKIE[$COOKIE_KEY[$i]])))); 
} 
if(isset($_POST['savePass']) && $_POST['savePass']=="save"){
$expire = time()+3600 * 24 * 365;
}
if($method=="login" && DBi::$con->real_escape_string(trim($_POST['userName']))!=""&&trim($_POST['userPass'])!=""){
	setcookie("userName",DBi::$con->real_escape_string(trim($_POST['userName'])),$expire);
	setcookie("userPass",md5(trim($_POST['userPass'])),$expire);
	setcookie("savePass",$_POST['savePass'],$expire);
	head(''.index().'?method=login');
}
if($method=="login_social" && DBi::$con->real_escape_string(trim($_POST['userName']))!=""&&trim($_POST['userPass'])!=""){
	setcookie("userName",DBi::$con->real_escape_string(trim($_POST['userName'])),$expire);
	setcookie("userPass",md5(trim($_POST['userPass'])),$expire);
	setcookie("savePass",$_POST['savePass'],$expire);
	head(''.index().'?mode=social&enter=login_social');
}
if (isset($_COOKIE['userName']) AND isset($_COOKIE['userPass']) AND isset($_COOKIE['savePass'])) {
	$userName=DBi::$con->real_escape_string($_COOKIE['userName']);
$userPass=DBi::$con->real_escape_string($_COOKIE['userPass']);
$savePass=DBi::$con->real_escape_string($_COOKIE['savePass']);
}
if (isset($userName) AND isset($userPass)){
	$sql=DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE (M_NAME = '$userName' OR M_EMAIL = '$userName') AND M_PASSWORD = '$userPass' AND M_STATUS = '1' ") or die (DBi::$con->error);

if(mysqli_num_rows($sql)>0){
	$rs=mysqli_fetch_array($sql);
	$user_info=$rs;
	$DBMemberID=$rs['MEMBER_ID'];
	$DBUserName=$rs['M_NAME'];
	$DBPassword=$rs['M_PASSWORD'];
	$DBMemberIP=$rs['M_IP'];
	$Mlevel=$rs['M_LEVEL'];
	$deputy=$rs['M_DEPUTY'];
	$DBMemberSkin=$rs['M_SKIN'];
	$M_Editor_Type=$rs['M_SP_EDITOR'];
	$DBMemberDate=$rs['M_DATE'];
	$DBMemberCode=$rs['M_CODE'];
	$DBMemberQID = strtoupper(md5($DBMemberID));	
	$font=$rs['M_FONTS_T'];
	$size=$rs['M_SIZE'];
	$size_e = $size - 4;
	$weight=$rs['M_WEIGHT'];
	$align=$rs['M_ALIGN'];
	$color=$rs['M_COLOR'];
	$holded=$rs['M_HOLDED'];
	$hold_active=$rs['M_HOLD_ACTIVE'];
	$hold_posts=$rs['M_HOLD_POSTS'];
if($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0)) {
	$DBMemberPosts = HoldPosts(posts($DBMemberID), $Mlevel, $deputy, $hold_posts, $hold_active);
}
 else {
	$DBMemberPosts = posts($DBMemberID);

} 		

	$Mod_Market=$rs['M_MOD_MARKET'];
	$M_Dollar=$rs['M_DOLLAR'];
	$M_Style_Form_e='FONT-WEIGHT:bold;FONT-FAMILY:'.$font.';FONT-SIZE:'.$size_e.'pt;TEXT-ALIGN:'.$align.';COLOR:'.$color.'';
	$M_Style_Form='FONT-WEIGHT:bold;FONT-FAMILY:'.$font.';FONT-SIZE:'.$size.';TEXT-ALIGN:'.$align.';COLOR:'.$color.'';
	define('M_Style_Form',$M_Style_Form);
	define('M_Style_Form_e',$M_Style_Form_e);
	define('m_id',$DBMemberID);
	define('m_name',$DBUserName);
	define('mlv',$Mlevel);
	define('deputy',$deputy);
	define('m_skin',$DBMemberSkin);
	define('editor_type',$M_Editor_Type);
	define('holded',$holded);
	define('mod_market',$Mod_Market);
	define('m_dollar',$M_Dollar);
	chk_update_login_members();
	if($savePass=="save"){
		$DonT_Save="";
	}
	else{
		$DonT_Save=$lang['others']['temp_login'];
	}
}
else{
	$DBMemberID=0;
	$DBUserName=0;
	$DBPassword=0;
	$Mlevel=0;
	$DBMemberPosts=0;
	$DBMemberDate=0;
	$deputy=0;
	$M_Style_Form='FONT-WEIGHT:bold;FONT-FAMILY:tahoma;FONT-SIZE:10px;TEXT-ALIGN:center;COLOR:black';
	define('m_id', $DBMemberID);
	define('m_name', $DBUserName);
	define('mlv',$Mlevel);
	$DonT_Save="";
}
}
else{
	$DBMemberID=0;
	$DBUserName=0;
	$DBPassword=0;
	$Mlevel=0;
	$DBMemberPosts=0;
	$DBMemberDate=0;
	$deputy=0;
	$M_Style_Form='FONT-WEIGHT:bold;FONT-FAMILY:tahoma;FONT-SIZE:10px;TEXT-ALIGN:center;COLOR:black';
	define('m_id', $DBMemberID);
	define('m_name', $DBUserName);
	define('mlv',$Mlevel);
	$DonT_Save="";
}

require_once("session.php");
require_once("language/".$choose_language.".php");

if (isset($DBMemberID)){
	update_ip(0,$DBMemberID);
}

if(isset($userName) AND isset($userPass)){
	chk_login_ip($userName,$userPass);
}
if($method=="logout"){
	
DBi::$con->query("DELETE FROM ".prefix."ONLINE WHERE O_MEMBER_ID = '$DBMemberID' ") or die (DBi::$con->error);	
if($hash != "" && $hash == $DBMemberQID) {
	setcookie("userName","");
	setcookie("userPass","");
	setcookie("savePass","");
	head(''.referer.'');
} else {
	head(''.referer.'');
}
}
if($method=="logout_social"){
DBi::$con->query("DELETE FROM ".prefix."ONLINE WHERE O_MEMBER_ID = '$DBMemberID' ") or die (DBi::$con->error);	
if($hash != "" && $hash == $DBMemberQID) {
	setcookie("userName","");
	setcookie("userPass","");
	setcookie("savePass","");
	head(''.referer.'');
} else {
	head(''.referer.'');
}
}
if($method=="login"&&mlv>0){
	head(''.index().'');
}




?>