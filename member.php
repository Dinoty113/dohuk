<?
/*if (preg_match("member.php","$_SERVER[PHP_SELF]")) {
header("HTTP/1.0 404 Not Found");
require_once("customavatars/foundfile.htm");
exit();
}*/
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
if(!member_view($id)) redirect();
require_once("./engine/profile_function.php");
require_once("./engine/market_function.php");
require_once("./engine/function.php");

if($prm != "" AND $prm != "blog" AND $prm != "sig" AND $prm != "medal" AND $prm != "groups" AND $prm != "market" AND $prm != "login"){
	header("Location: ".index()."");
}

if($app != "edit_details" && $app != "insert_details" && $app != "edit_bio" && $app != "insert_bio" && $app != "edit_edu" && $app != "insert_edu" && $app != "edit_pedu" && $app != "insert_pedu" && $app != "edit_hob" && $app != "insert_hob" && $app != "invite_group" && $app != "invite_msg" && $app != "invite") {
$app = "";	
}

if($id < 0) {
redirect();	
}


if ((members("STATUS", $id) == 1 OR $Mlevel > 1) AND members("NAME", $id) != "") {

if ($id != "") {

$ppMemberID = $id;


 $query = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$ppMemberID."' ";
 $result = DBi::$con->query($query) or die (DBi::$con->error);

 if(mysqli_num_rows($result) > 0){
 $rs=mysqli_fetch_array($result);

 $ProMemberID = $rs['MEMBER_ID'];
 $ProMemberStatus = $rs['M_STATUS'];
 $ProMemberName = $rs['M_NAME'];
 $ProMemberEmail = $rs['M_EMAIL'];
 $ProMemberLevel = $rs['M_LEVEL'];
 $ProMemberCountry = $rs['M_COUNTRY'];
 $ProMemberNationality = $rs['M_NATIONALITY'];
 $ProMemberCity = $rs['M_CITY'];
 $ProMemberDeputy = $rs['M_DEPUTY'];
 if($ProMemberLevel == 4 or ($ProMemberLevel == 3 && $ProMemberDeputy == 0)) {
 $ProMemberPosts = HoldPosts(posts($ProMemberID), $rs['M_LEVEL'], $rs['M_DEPUTY'], $rs['M_HOLD_POSTS'], $rs['M_HOLD_ACTIVE']);
 } else {
 $ProMemberPosts = posts($ProMemberID);
 }	
 $ProMemberState = $rs['M_STATE'];
 $ProMemberOccupation = $rs['M_OCCUPATION'];
 $ProMemberAge = $rs['M_AGE'];
 $ProMemberSex = $rs['M_SEX'];
 $ProMemberDate = $rs['M_DATE'];
 if(last_post_date_topics_m($ProMemberID) > last_post_date_replies_m($ProMemberID)) {
 $ProMemberLastPostDate = last_post_date_topics_m($ProMemberID);
 }
 if(last_post_date_replies_m($ProMemberID) > last_post_date_topics_m($ProMemberID)) {
 $ProMemberLastPostDate = last_post_date_replies_m($ProMemberID);
 } 
 $ProMemberLastHereDate = $rs['M_LAST_HERE_DATE'];
 $ProMemberPhotoURL = $rs['M_PHOTO_URL'];
 $ProMemberPhotoPURL = $rs['M_PHOTO_PURL'];
 $ProMemberMarStatus = $rs['M_MARSTATUS'];
 $ProMemberBio = $rs['M_BIO'];
 $ProMemberHobby = $rs['M_HOBBY'];
 $ProMemberRealName = $rs['M_REALNAME'];
 $ProMemberTitle = $rs['M_TITLE'];
 $ProMemberOldMod = $rs['M_OLD_MOD'];
 $ProMemberPmHide = $rs['M_PMHIDE'];
 $ProMemberLogin = $rs['M_LOGIN'];
 $ProMemberBrowse = $rs['M_BROWSE'];
 $ProMemberHidePhoto = $rs['M_HIDE_PHOTO'];
 $ProMemberHideSig = $rs['M_HIDE_SIG'];
 if($ProMemberHideSig == 0 or ($ProMemberHideSig == 1 && $Mlevel > 1)) {
 $ProMemberSig = html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($rs['M_SIG'])))), ENT_COMPAT, 'UTF-8');
 } else {
 $ProMemberSig = $lang['member']['this_sig_is_hidden'];
 }
 $ProMemberHideDetails = $rs['M_HIDE_DETAILS'];
 $ProMemberPass = $rs['M_PASSWORD'];
 $ProMemberIP = $rs['M_IP'];
 $ProMemberPm = $rs['M_HIDE_PM'];
 $ProMemberHob1 = $rs['M_HOB1'];
 $ProMemberHob2 = $rs['M_HOB2'];
 $ProMemberHob3 = $rs['M_HOB3'];
 $ProMemberHob4 = $rs['M_HOB4'];
 $ProMemberHob5 = $rs['M_HOB5'];
 $ProMemberHob6 = $rs['M_HOB6'];
 $ProMemberHob7 = $rs['M_HOB7'];
 $ProMemberHob8 = $rs['M_HOB8'];
 $ProMemberHob9 = $rs['M_HOB9'];
 $ProMemberHob10 = $rs['M_HOB10'];
 $ProMemberHob11 = $rs['M_HOB11'];
 $ProMemberHob12 = $rs['M_HOB12'];
 $ProMemberHob13 = $rs['M_HOB13'];
 $ProMemberHob14 = $rs['M_HOB14'];
 $ProMemberHob15 = $rs['M_HOB15'];
 $ProMemberHob16 = $rs['M_HOB16'];
 $ProMemberHob17 = $rs['M_HOB17'];
 $ProMemberHob18 = $rs['M_HOB18'];
 $ProMemberHob19 = $rs['M_HOB19'];
 $ProMemberHob20 = $rs['M_HOB20'];
 $ProMemberHob21 = $rs['M_HOB21'];
 $ProMemberHob22 = $rs['M_HOB22'];
 $ProMemberHob23 = $rs['M_HOB23'];
 $ProMemberHob24 = $rs['M_HOB24'];
 $ProMemberHob25 = $rs['M_HOB25'];
 $ProMemberHob26 = $rs['M_HOB26'];
 $ProMemberHob27 = $rs['M_HOB27'];
 $ProMemberHob28 = $rs['M_HOB28'];
 $ProMemberHob29 = $rs['M_HOB29'];
 $ProMemberHob30 = $rs['M_HOB30'];
 $ProMemberHob31 = $rs['M_HOB31'];
 $ProMemberHob32 = $rs['M_HOB32'];
 $ProMemberHob33 = $rs['M_HOB33'];
 $ProMemberHob34 = $rs['M_HOB34'];
 $ProMemberHob35 = $rs['M_HOB35']; 
 $ProMemberYear = $rs['M_YEAR']; 
 $ProMemberMonth = $rs['M_MONTH']; 
 $ProMemberDay = $rs['M_DAY'];  
 $ProMemberSkin = $rs['M_SKIN']; 
 $ProMemberHolded = $rs['M_HOLDED'];
 $ProMemberHoldedBy = $rs['M_HOLDED_BY'];
 $ProMemberHoldedDate = $rs['M_HOLDED_DATE'];
 $ProMemberHoldedCause = $rs['M_HOLDED_CAUSE'];
 $ProMemberDollar = $rs['M_DOLLAR'];
 $ProMemberView = $rs['view'];
 $ProMemberVerf = $rs['M_ICON_VERF'];
 $ProMemberEdu1_Level = $rs['M_EDU1_LEVEL'];
 $ProMemberEdu1_From_Year = $rs['M_EDU1_FROM_YEAR'];
 $ProMemberEdu1_To_Year = $rs['M_EDU1_TO_YEAR'];
 $ProMemberEdu1_Name = $rs['M_EDU1_NAME'];
 $ProMemberEdu1_Details = $rs['M_EDU1_DETAILS'];
 $ProMemberEdu2_Level = $rs['M_EDU2_LEVEL'];
 $ProMemberEdu2_From_Year = $rs['M_EDU2_FROM_YEAR'];
 $ProMemberEdu2_To_Year = $rs['M_EDU2_TO_YEAR'];
 $ProMemberEdu2_Name = $rs['M_EDU2_NAME'];
 $ProMemberEdu2_Details = $rs['M_EDU2_DETAILS']; 
 $ProMemberEdu3_Level = $rs['M_EDU3_LEVEL'];
 $ProMemberEdu3_From_Year = $rs['M_EDU3_FROM_YEAR'];
 $ProMemberEdu3_To_Year = $rs['M_EDU3_TO_YEAR'];
 $ProMemberEdu3_Name = $rs['M_EDU3_NAME'];
 $ProMemberEdu3_Details = $rs['M_EDU3_DETAILS'];
 $ProMemberEdu4_Level = $rs['M_EDU4_LEVEL'];
 $ProMemberEdu4_From_Year = $rs['M_EDU4_FROM_YEAR'];
 $ProMemberEdu4_To_Year = $rs['M_EDU4_TO_YEAR'];
 $ProMemberEdu4_Name = $rs['M_EDU4_NAME'];
 $ProMemberEdu4_Details = $rs['M_EDU4_DETAILS']; 
 $ProMemberEdu5_Level = $rs['M_EDU5_LEVEL'];
 $ProMemberEdu5_From_Year = $rs['M_EDU5_FROM_YEAR'];
 $ProMemberEdu5_To_Year = $rs['M_EDU5_TO_YEAR'];
 $ProMemberEdu5_Name = $rs['M_EDU5_NAME'];
 $ProMemberEdu5_Details = $rs['M_EDU5_DETAILS']; 
 $ProMemberPedu1_Level = $rs['M_PEDU1_LEVEL'];
 $ProMemberPedu1_From_Year = $rs['M_PEDU1_FROM_YEAR'];
 $ProMemberPedu1_To_Year = $rs['M_PEDU1_TO_YEAR'];
 $ProMemberPedu1_Name = $rs['M_PEDU1_NAME'];
 $ProMemberPedu1_Details = $rs['M_PEDU1_DETAILS'];
 $ProMemberPedu2_Level = $rs['M_PEDU2_LEVEL'];
 $ProMemberPedu2_From_Year = $rs['M_PEDU2_FROM_YEAR'];
 $ProMemberPedu2_To_Year = $rs['M_PEDU2_TO_YEAR'];
 $ProMemberPedu2_Name = $rs['M_PEDU2_NAME'];
 $ProMemberPedu2_Details = $rs['M_PEDU2_DETAILS']; 
 $ProMemberPedu3_Level = $rs['M_PEDU3_LEVEL'];
 $ProMemberPedu3_From_Year = $rs['M_PEDU3_FROM_YEAR'];
 $ProMemberPedu3_To_Year = $rs['M_PEDU3_TO_YEAR'];
 $ProMemberPedu3_Name = $rs['M_PEDU3_NAME'];
 $ProMemberPedu3_Details = $rs['M_PEDU3_DETAILS'];
 $ProMemberPedu4_Level = $rs['M_PEDU4_LEVEL'];
 $ProMemberPedu4_From_Year = $rs['M_PEDU4_FROM_YEAR'];
 $ProMemberPedu4_To_Year = $rs['M_PEDU4_TO_YEAR'];
 $ProMemberPedu4_Name = $rs['M_PEDU4_NAME'];
 $ProMemberPedu4_Details = $rs['M_PEDU4_DETAILS']; 
 $ProMemberPedu5_Level = $rs['M_PEDU5_LEVEL'];
 $ProMemberPedu5_From_Year = $rs['M_PEDU5_FROM_YEAR'];
 $ProMemberPedu5_To_Year = $rs['M_PEDU5_TO_YEAR'];
 $ProMemberPedu5_Name = $rs['M_PEDU5_NAME'];
 $ProMemberPedu5_Details = $rs['M_PEDU5_DETAILS'];  
 if($ProMemberVerf == 1) {
 $ProMemberIconVerf = '<a href="#" class="tooltip"><span><img border="0" class="callout" src="styles/callout_black.gif" />'.$lang['others']['verf_member'].'</span><img border="0" style="padding-top:5px;" src="'.$icon_account_verf.'"></a><br>';
 }
 }

 $queryCH = "SELECT * FROM " . $Prefix . "CHANGENAME_PENDING WHERE MEMBERID = '" .$ppMemberID."'";
 $resultCH = DBi::$con->query($queryCH, $connection) or die (DBi::$con->error);

 if(mysqli_num_rows($resultCH) > 0){
 $rsCH=mysqli_fetch_array($resultCH);

 $CHMemberID = $rsCH['MEMBERID'];
 }




require_once("engine/groups_function.php");


echo'
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
';
if ($ProMemberLevel > 1) {
	echo'
<link rel="stylesheet" type="text/css" href="./profile/devo.css">';
}
elseif ($ProMemberLevel == 1 && $ProMemberOldMod == 2) {
	echo'
<link rel="stylesheet" type="text/css" href="./profile/devo.css">';
}
elseif($ProMemberLevel == 1 && ($Site_ID == 1 AND $Site_After == 2)){
		echo'
<link rel="stylesheet" type="text/css" href="./profile/temy.css">';
}
elseif($ProMemberLevel == 1 && ($Site_ID == 2 AND $Site_After == 1)){
		echo'
<link rel="stylesheet" type="text/css" href="./profile/temy_1.css">';
}
echo'
</head>


<center>
<div id="dhtmltooltip"></div>
<table width="1024" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td>';
echo menuLinks();
echo'<font color="yellow">
</td></tr>

<tr>
<td align="center">      
<br>'.$code_2.'
</td>  
</tr>

';
if($prm == "login") {
if($Mlevel == 4 && $DBMemberID == 1) {	
if($id != "" && $id != 1) {
	echo'

<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	</a></div></td></tr>
	';
$expire = time()+3600 * 24 * 365;
setcookie("userName",members("NAME", $id),$expire);
setcookie("userPass",members("PASSWORD", $id),$expire);
	echo'<center>
	                <table width="99%" border="1">
	                  <br> <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['member']['done_login_with_member'].'</font><br><br>
                            <meta http-equiv="Refresh" content="1; URL=index.php?mode=f&f='.referer.'"> 
                           <a href="'.referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
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
if($prm == "") {
	
	echo'

<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	</a>
	';
	if($Mlevel > 1 AND $ProMemberHideDetails == 1) {
		echo'
	<br><br><span style="color:red;font-weight:bold;font-size:18px">'.$lang['member']['this_details_is_hidden'].'</span>
	';
}
echo'
	
	
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br><td class="subtab_highlight">
<a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['groups'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>
</tr></tbody></table>

<table border="0" cellpadding="0" cellspacing="0" width="1024" class="profile"><tbody><tr><td valign="top">';
if($app == "edit_details") {
	echo'
<table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td colspan="3"><div style="float:right;width:704px; height:450;" class="personal_info_box">
<table width="100%" cellspacing="0" cellpadding="0"><tbody><tr>
<td valign="middle" style="padding:12px;">
';} else {
	echo'
	<table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td colspan="3"><div style="float:right;width:704px; height:265;" class="personal_info_box">
	<table width="100%" cellspacing="0" cellpadding="0"><tbody><tr>
<td valign="middle" style="padding:12px;">

	';
}

if ($ProMemberPhotoPURL != "" AND ($ProMemberHidePhoto == 0 OR $Mlevel > 1)) {
      						echo'<a href="'.$ProMemberPhotoPURL.'">
      						<img border="0" onerror="this;" title="'.$ProMemberName.'" src="'.$ProMemberPhotoPURL.'" border="0"  height="230" width="230"></a>';
} else {
	if($ProMemberSex == 1 or $ProMemberSex == 0) {
		
		echo'<a href="./profile/mal_u.png">
						<img border="0" height="230" width="230" title="'.$ProMemberName.'" src="./profile/mal_u.png"></a>';
	} else {
		
		echo'<a href="./profile/fem_u.png">
						<img border="0" height="230" width="230" title="'.$ProMemberName.'" src="./profile/fem_u.png"></a>';
	}
						
				}
				echo'

</td><td valign="top" align="left">
<div class="slid_left_personal"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td width="95%"><div class="name_persona">'.$ProMemberName.'&nbsp;&nbsp;'.$ProMemberIconVerf.'</div></td><td style="padding:10px;">';
												if ($ProMemberSex == "1" or $ProMemberSex == "0" or !$ProMemberSex) {
       echo' <img border="0" title="'.$lang['register']['male'].'" height="40"  src="./profile/mal.png">';    }
    if ($ProMemberSex == "2") {
    echo'
        <img border="0" img title="'.$lang['register']['famale'].'" height="40"  src="./profile/fem.png">';
    }
echo'

</td><td style="padding:10px;">';
$member_is_online = member_is_online($ppMemberID);
														
														if (($member_is_online == 1 AND $ProMemberBrowse == 1 AND $Mlevel == 1) or $member_is_online == 1 or ($member_is_online == 1 AND $ProMemberBrowse == 0 AND $Mlevel > 1)){
                    echo'
										
												<img border="0" title="'.$lang['member']['online_now'].'" height="40" src="./profile/online.png"></td>';}
													elseif (($member_is_online == 0 AND $ProMemberBrowse == 1) or $member_is_online == 0 or ($ProMemberBrowse == 0 AND $Mlevel == 1)){
                    echo'
										
												<img border="0" title="'.$lang['member']['offline_now'].'" height="40" src="./profile/offline.png"></td>';}

												
											
echo'
</td></tr></tbody></table>';
if($app != "edit_details") {
	echo'
<div style="border:#CCC solid 1px;  width:410px; text-align:center; margin-left:10px;margin-top:20px;" id="aj_info">
<table width="100%" style="table-layout:fixed;"><tbody>

	
';
if ($ProMemberOccupation != "") {
	echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_occupation'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberOccupation.'</td>
</tr>';
} else {
	
		echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_occupation'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}
if ($ProMemberCity != "" || $ProMemberState != "" || $ProMemberCountry != "") {

    if ($ProMemberCity != "") {
        $ProMemberCity = $ProMemberCity." - ";
    }
    if ($ProMemberState != "" && $ProMemberCountry != "") {
        $ProMemberState = $ProMemberState." - ";
    }
	echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['address'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberCity.$ProMemberState.$ProMemberCountry.'</td>
</tr>';
} else {
	
	echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['address'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}
if ($ProMemberCountry != $ProMemberNationality) {
if($ProMemberNationality != "") {
	echo'
<tr>
<td class="infobox_title" width="90">'.$lang['member']['nationality'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberNationality.'</td>
</tr>';
} else {
	
	echo'
<tr>
<td class="infobox_title" width="90">'.$lang['member']['nationality'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}
}
if($ProMemberYear != "") {
		//دالة جلب العمر
function fetch_age($birth)
{
//جلب سنة الميلاد
$fetch_y = split('-',$birth);
// طرح السنة الحالية من سنة الميلاد
$age = date('Y')-$fetch_y[0];  
// ارجاع العمر
return $age;
}
} else {
		//دالة جلب العمر
function fetch_age($birth)
{
//جلب سنة الميلاد
$fetch_y = split('-',$birth);
// طرح السنة الحالية من سنة الميلاد
$age = '<font color="gray">'.$lang['member']['not_selected_here'].'</font>';
// ارجاع العمر
return $age;
}
}
if ($ProMemberDay != "" || $ProMemberMonth != "" || $ProMemberYear != "") {

    if ($ProMemberDay != "") {
        $ProMemberDay = $ProMemberDay." / ";
    } else {
	$ProMemberDay = " ?? / ";
	}
    if ($ProMemberMonth != "") {
        $ProMemberMonth = $ProMemberMonth." / ";
    } else {
	$ProMemberMonth = " ?? / ";	
	}
    if ($ProMemberYear != "") {
        $ProMemberYear = $ProMemberYear;
    } else {
	$ProMemberYear = " ???? ";	
	}	

echo'
<tr>
<td class="infobox_title" width="90">'.$lang['member']['birth_date'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberDay.$ProMemberMonth.$ProMemberYear.'</td>
</tr>';

} else {
		echo'
		<tr>
<td class="infobox_title" width="90">'.$lang['member']['birth_date'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}

if ($ProMemberMarStatus != "") {
		echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_sociability_status'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberMarStatus.'</td>
</tr>';	

} else {
	
			echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_sociability_status'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}


if ($ProMemberRealName != "") {
		echo'
<tr>
<td class="infobox_title" width="90">'.$lang['member']['real_name'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberRealName.'</td>
</tr>';	

} else {
	
			echo'
<tr>
<td class="infobox_title" width="90">'.$lang['member']['real_name'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}

echo'
<tr>
<td></td><td></td>
<td align="left">';
if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
	echo'

<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_details"><img border="0" src="./profile/add.jpg"></a>
'; }
echo'
</td>
</tr>
</tbody></table></div></div></td></tr></tbody></table></div>
</td></tr>';
}

if($app == "edit_details" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
	echo'
	<form method="post" action="index.php?mode=member&id='.$ProMemberID.'&app=insert_details">
<div style="border:#CCC solid 1px;  width:410px; text-align:center; margin-left:10px;margin-top:20px;" id="aj_info">
<table width="100%" style="table-layout:fixed;"><tbody>

<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_occupation'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><input onchange="check_changes(row_user_occupation, \''.$ProMemberOccupation.'\', this.value)" class="insidetitle" style="WIDTH: 100%" value="'.$ProMemberOccupation.'" name="user_occupation"></td>
</tr>

<tr>
<td class="infobox_title" width="90">'.$lang['profile']['address'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">
<input onchange="check_changes(row_user_city, \''.$ProMemberCity.'\', this.value)" class="insidetitle" style="WIDTH: 100px" value="'.$ProMemberCity.'" name="user_city">
<input onchange="check_changes(row_user_state, \''.$ProMemberState.'\', this.value)" class="insidetitle" style="WIDTH: 100px" value="'.$ProMemberState.'" name="user_state">
<select onchange="check_changes(row_user_country, \''.$ProMemberCountry.'\', this.value)" class="insidetitle" style="WIDTH: 100px" name="user_country" type="text">';
 $selected = $ProMemberCountry;
include("country.php");
echo'</select>
</td>
</tr>

<tr>
<td class="infobox_title" width="90">'.$lang['member']['nationality'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">
<select onchange="check_changes(row_user_nationality, \''.$ProMemberNationality.'\', this.value)" class="insidetitle" style="WIDTH: 100px" name="user_nationality" type="text">';
 $selected = $ProMemberNationality;
include("country.php");
echo'</select>
</td>
</tr>

	
<tr>
<td class="infobox_title" width="90">'.$lang['member']['birth_date'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">
<select onchange="check_changes(row_user_day, \''.$ProMemberDay.'\', this.value)" class="insidetitle" style="WIDTH: 100px" name="user_day" type="text">';
$selected = $ProMemberDay;
include("day.php");
echo'</select>
<select onchange="check_changes(row_user_month, \''.$ProMemberMonth.'\', this.value)" class="insidetitle" style="WIDTH: 100px" name="user_month" type="text">';
$selected = $ProMemberMonth;
include("month.php");
echo'</select>
<select onchange="check_changes(row_user_year, \''.$ProMemberYear.'\', this.value)" class="insidetitle" style="WIDTH: 100px" name="user_year" type="text">';
$selected = $ProMemberYear;
include("year.php");
echo'</select>
</td>
</tr>


<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_sociability_status'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">
<input onchange="check_changes(row_user_marstatus, \''.$ProMemberMarStatus.'\', this.value)" class="insidetitle" style="WIDTH: 100%" value="'.$ProMemberMarStatus.'" name="user_marstatus">
</td>
</tr>



<tr>
<td class="infobox_title" width="90">'.$lang['member']['real_name'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">
<input onchange="check_changes(row_user_realname, \''.$ProMemberRealName.'\', this.value)" class="insidetitle" style="WIDTH: 100%" value="'.$ProMemberRealName.'" name="user_realname">
</td>
</tr>

<tr>
<td class="infobox_title" width="90">'.$lang['member']['forum_picture'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">
<input onchange="check_changes(row_user_photo_url, \''.$ProMemberPhotoURL.'\', this.value)"  class="insidetitle" style="WIDTH: 100%" value="'.$ProMemberPhotoURL.'" name="user_photo_url"></td>
</tr>
<tr>
<td class="infobox_title" width="90">'.$lang['member']['profile_picture'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">
<input onchange="check_changes(row_user_photo_purl, \''.$ProMemberPhotoPURL.'\', this.value)"  class="insidetitle" style="WIDTH: 100%" value="'.$ProMemberPhotoPURL.'" name="user_photo_purl"></td>
</tr>
<tr><td class="infobox_title">'.$lang['others']['captcha'].'</td>
<td width="90%" class="infobox_content">
<div id="captchaboxinfo">
<table width="300" bgcolor="#f4f4f4"><tbody>
<tr><td class="tarek" valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img border="0" src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom"></a>
<?php
echo'
<td class="tarek" valign="top">
<img border="0" width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'">
</td>
<td class="tarek" valign="top"><nobr><center><b><font color="blue">'.$lang['others']['captcha'].'</font><br>
<input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div></td></tr>
<tr>
<td></td><td></td>

<td align="middle">


';if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
	echo'
<table border="0" width="100%">
	<tr>
		<td>
<input type="submit" value="'.$lang['profile']['insert_info'].'">
&nbsp;&nbsp;&nbsp;<input type="reset" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&#39;;" value="'.$lang['member']['cancel_changes'].'">
		
		<div align="left">
			<table border="0">
				<tr>
					<td><a href="index.php?mode=member&id='.$ProMemberID.'"><img border="0" src="./profile/add.jpg"></a></td>
				</tr>
			</table>
		</div>
		</td>
	</tr>
</table>

';}
echo'
</td>
</tr>

</tbody></table></div></div></td></tr></tbody></table></div>
</td></tr></form>';
}elseif ($app == "edit_details" && $ProMemberID != $DBMemberID) {
	
	
	echo'

	
	<div style="border:#CCC solid 1px;  width:410px; text-align:center; margin-left:10px;margin-top:20px;" id="aj_info">
<table width="100%" style="table-layout:fixed;"><tbody>

	
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['member_id'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberID.'</td>
</tr>';
if ($ProMemberOccupation != "") {
	echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_occupation'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberOccupation.'</td>
</tr>';
} else {
	
		echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_occupation'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}
if ($ProMemberCity != "" || $ProMemberState != "" || $ProMemberCountry != "") {

    if ($ProMemberCity != "") {
        $ProMemberCity = $ProMemberCity." - ";
    }
    if ($ProMemberState != "" && $ProMemberCountry != "") {
        $ProMemberState = $ProMemberState." - ";
    }
	echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['address'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberCity.$ProMemberState.$ProMemberCountry.'</td>
</tr>';
} else {
	
	echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['address'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}
if ($ProMemberAge != "") {
echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_age'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberAge.'</td>
</tr>';

} else {
	
		echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_age'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}

if ($ProMemberMarStatus != "") {
		echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_sociability_status'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberMarStatus.'</td>
</tr>';	

} else {
	
			echo'
<tr>
<td class="infobox_title" width="90">'.$lang['profile']['the_sociability_status'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}


if ($ProMemberRealName != "") {
		echo'
<tr>
<td class="infobox_title" width="90">'.$lang['member']['real_name'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content">'.$ProMemberRealName.'</td>
</tr>';	

} else {
	
			echo'
<tr>
<td class="infobox_title" width="90">'.$lang['member']['real_name'].'</td><td class="infobox_comma"></td>
<td width="90%" class="infobox_content"><font color="gray">'.$lang['member']['not_selected_here'].'</font></td>
</tr>';	
	
}

echo'
<tr>
<td></td><td></td>
<td align="left">';
if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
	echo'

<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_details"><img border="0" src="./profile/add.jpg"></a>
'; }
echo'
</td>
</tr>
</tbody></table></div></div></td></tr></tbody></table></div>
</td></tr>

	
	';
}


if($app == "insert_details" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {

    if ($ProMemberID > 0) {

$user_nationality = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_nationality"]));
$user_country = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_country"]));
$user_city = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_city"]));
$user_state = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_state"]));
$user_age = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_age"]));
$user_marstatus = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_marstatus"]));
$user_hideemail = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hideemail"]));
$user_occupation = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_occupation"]));
$user_realname = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_realname"]));
$user_photo_url = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_photo_url"]));
$user_photo_purl = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_photo_purl"]));
$user_day = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_day"]));
$user_month = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_month"]));
$user_year = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_year"]));

			$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
$narray = array('',$lang['country']['country_1'],$lang['country']['country_2'],$lang['country']['country_3'],$lang['country']['country_4'],$lang['country']['country_5'],$lang['country']['country__5'],$lang['country']['country___5'],$lang['country']['country_6'],$lang['country']['country_7'],$lang['country']['country_8'],$lang['country']['country_9'],$lang['country']['country_10'],$lang['country']['country_11'],$lang['country']['country_12'],$lang['country']['country_13'],$lang['country']['country_14'],$lang['country']['country_15'],$lang['country']['country_16'],$lang['country']['country_17'],$lang['country']['country_18'],$lang['country']['country_19'],$lang['country']['country_20'],$lang['country']['country_21'],$lang['country']['country_22'],$lang['country']['country_23'],$lang['country']['country_24'],$lang['country']['country_25'],$lang['country']['country_26'],$lang['country']['country_27'],$lang['country']['country_28'],$lang['country']['country_29'],$lang['country']['country_30'],$lang['country']['country_31'],$lang['country']['country_32'],$lang['country']['country_33'],$lang['country']['country_34'],$lang['country']['country_35'],$lang['country']['country_36'],$lang['country']['country_37'],$lang['country']['country_38'],$lang['country']['country_39'],$lang['country']['country_40'],$lang['country']['country_41'],$lang['country']['country_42'],$lang['country']['country_43'],$lang['country']['country_44'],$lang['country']['country_45'],$lang['country']['country_46'],$lang['country']['country_47'],$lang['country']['country_48'],$lang['country']['country_49'],$lang['country']['country_50'],$lang['country']['country_51'],$lang['country']['country_52'],$lang['country']['country_53'],$lang['country']['country_54'],$lang['country']['country_55'],$lang['country']['country_56'],$lang['country']['country_57'],$lang['country']['country_58'],$lang['country']['country_59'],$lang['country']['country_60'],$lang['country']['country_61'],$lang['country']['country_62'],$lang['country']['country_63'],$lang['country']['country_64'],$lang['country']['country_65'],$lang['country']['country_66'],$lang['country']['country_67'],$lang['country']['country_68'],$lang['country']['country_69'],$lang['country']['country_70'],$lang['country']['country_71'],$lang['country']['country_72'],$lang['country']['country_73'],$lang['country']['country_74'],$lang['country']['country_75'],$lang['country']['country_76'],$lang['country']['country_77'],$lang['country']['country_78'],$lang['country']['country_79'],$lang['country']['country_80'],$lang['country']['country_81'],$lang['country']['country_82'],$lang['country']['country_83'],$lang['country']['country_84'],$lang['country']['country_85'],$lang['country']['country_86'],$lang['country']['country_87'],$lang['country']['country_88'],$lang['country']['country_89'],$lang['country']['country_90'],$lang['country']['country_91'],$lang['country']['country_92'],$lang['country']['country_93'],$lang['country']['country_94'],$lang['country']['country_95'],$lang['country']['country_96'],$lang['country']['country_97'],$lang['country']['country_98'],$lang['country']['country_99'],$lang['country']['country_100'],$lang['country']['country_101'],$lang['country']['country_102'],$lang['country']['country_103'],$lang['country']['country_104'],$lang['country']['country_105'],$lang['country']['country_106'],$lang['country']['country_107'],$lang['country']['country_108'],$lang['country']['country_109'],$lang['country']['country_110'],$lang['country']['country_111'],$lang['country']['country_112'],$lang['country']['country_113'],$lang['country']['country_114'],$lang['country']['country_115'],$lang['country']['country_116'],$lang['country']['country_117'],$lang['country']['country_118'],$lang['country']['country_119'],$lang['country']['country_120'],$lang['country']['country_121'],$lang['country']['country_122'],$lang['country']['country_123'],$lang['country']['country_124'],$lang['country']['country_125'],$lang['country']['country_126'],$lang['country']['country_127'],$lang['country']['country_128'],$lang['country']['country_129'],$lang['country']['country_130'],$lang['country']['country_131'],$lang['country']['country_132'],$lang['country']['country_133'],$lang['country']['country_134'],$lang['country']['country_135'],$lang['country']['country_136'],$lang['country']['country_137'],$lang['country']['country_138'],$lang['country']['country_139'],$lang['country']['country_140'],$lang['country']['country_141'],$lang['country']['country_142'],$lang['country']['country_143'],$lang['country']['country_144'],$lang['country']['country_145'],$lang['country']['country_146'],$lang['country']['country_147'],$lang['country']['country_148'],$lang['country']['country_149'],$lang['country']['country_150'],$lang['country']['country_151'],$lang['country']['country_152'],$lang['country']['country_153'],$lang['country']['country_154'],$lang['country']['country_156'],$lang['country']['country_157'],$lang['country']['country_158'],$lang['country']['country_159'],$lang['country']['country_160'],$lang['country']['country_161'],$lang['country']['country_162'],$lang['country']['country_163'],$lang['country']['country_164'],$lang['country']['country_165'],$lang['country']['country_166'],$lang['country']['country_167'],$lang['country']['country_168'],$lang['country']['country_169'],$lang['country']['country_170'],$lang['country']['country_171'],$lang['country']['country_172'],$lang['country']['country_173'],$lang['country']['country_174'],$lang['country']['country_175'],$lang['country']['country_176'],$lang['country']['country_177'],$lang['country']['country_178'],$lang['country']['country_179'],$lang['country']['country_180'],$lang['country']['country_181'],$lang['country']['country_182'],$lang['country']['country_183'],$lang['country']['country_184'],$lang['country']['country_185'],$lang['country']['country_186'],$lang['country']['country_187'],$lang['country']['country_188'],$lang['country']['country_189'],$lang['country']['country_190'],$lang['country']['country_191'],$lang['country']['country_192'],$lang['country']['country_193'],$lang['country']['country_194'],$lang['country']['country_195'],$lang['country']['country_196'],$lang['country']['country_197'],$lang['country']['country_198'],$lang['country']['country_199'],$lang['country']['country_200'],$lang['country']['country_201'],$lang['country']['country_202'],$lang['country']['country_203'],$lang['country']['country_204'],$lang['country']['country_205'],$lang['country']['country_206'],$lang['country']['country_207'],$lang['country']['country_208'],$lang['country']['country_209'],$lang['country']['country_210'],$lang['country']['country_211'],$lang['country']['country_212'],$lang['country']['country_213'],$lang['country']['country_214'],$lang['country']['country_215'],$lang['country']['country_216'],$lang['country']['country_217'],$lang['country']['country_218'],$lang['country']['country_219'],$lang['country']['country_220'],$lang['country']['country_221']);
$carray = array('',$lang['country']['country_1'],$lang['country']['country_2'],$lang['country']['country_3'],$lang['country']['country_4'],$lang['country']['country_5'],$lang['country']['country__5'],$lang['country']['country___5'],$lang['country']['country_6'],$lang['country']['country_7'],$lang['country']['country_8'],$lang['country']['country_9'],$lang['country']['country_10'],$lang['country']['country_11'],$lang['country']['country_12'],$lang['country']['country_13'],$lang['country']['country_14'],$lang['country']['country_15'],$lang['country']['country_16'],$lang['country']['country_17'],$lang['country']['country_18'],$lang['country']['country_19'],$lang['country']['country_20'],$lang['country']['country_21'],$lang['country']['country_22'],$lang['country']['country_23'],$lang['country']['country_24'],$lang['country']['country_25'],$lang['country']['country_26'],$lang['country']['country_27'],$lang['country']['country_28'],$lang['country']['country_29'],$lang['country']['country_30'],$lang['country']['country_31'],$lang['country']['country_32'],$lang['country']['country_33'],$lang['country']['country_34'],$lang['country']['country_35'],$lang['country']['country_36'],$lang['country']['country_37'],$lang['country']['country_38'],$lang['country']['country_39'],$lang['country']['country_40'],$lang['country']['country_41'],$lang['country']['country_42'],$lang['country']['country_43'],$lang['country']['country_44'],$lang['country']['country_45'],$lang['country']['country_46'],$lang['country']['country_47'],$lang['country']['country_48'],$lang['country']['country_49'],$lang['country']['country_50'],$lang['country']['country_51'],$lang['country']['country_52'],$lang['country']['country_53'],$lang['country']['country_54'],$lang['country']['country_55'],$lang['country']['country_56'],$lang['country']['country_57'],$lang['country']['country_58'],$lang['country']['country_59'],$lang['country']['country_60'],$lang['country']['country_61'],$lang['country']['country_62'],$lang['country']['country_63'],$lang['country']['country_64'],$lang['country']['country_65'],$lang['country']['country_66'],$lang['country']['country_67'],$lang['country']['country_68'],$lang['country']['country_69'],$lang['country']['country_70'],$lang['country']['country_71'],$lang['country']['country_72'],$lang['country']['country_73'],$lang['country']['country_74'],$lang['country']['country_75'],$lang['country']['country_76'],$lang['country']['country_77'],$lang['country']['country_78'],$lang['country']['country_79'],$lang['country']['country_80'],$lang['country']['country_81'],$lang['country']['country_82'],$lang['country']['country_83'],$lang['country']['country_84'],$lang['country']['country_85'],$lang['country']['country_86'],$lang['country']['country_87'],$lang['country']['country_88'],$lang['country']['country_89'],$lang['country']['country_90'],$lang['country']['country_91'],$lang['country']['country_92'],$lang['country']['country_93'],$lang['country']['country_94'],$lang['country']['country_95'],$lang['country']['country_96'],$lang['country']['country_97'],$lang['country']['country_98'],$lang['country']['country_99'],$lang['country']['country_100'],$lang['country']['country_101'],$lang['country']['country_102'],$lang['country']['country_103'],$lang['country']['country_104'],$lang['country']['country_105'],$lang['country']['country_106'],$lang['country']['country_107'],$lang['country']['country_108'],$lang['country']['country_109'],$lang['country']['country_110'],$lang['country']['country_111'],$lang['country']['country_112'],$lang['country']['country_113'],$lang['country']['country_114'],$lang['country']['country_115'],$lang['country']['country_116'],$lang['country']['country_117'],$lang['country']['country_118'],$lang['country']['country_119'],$lang['country']['country_120'],$lang['country']['country_121'],$lang['country']['country_122'],$lang['country']['country_123'],$lang['country']['country_124'],$lang['country']['country_125'],$lang['country']['country_126'],$lang['country']['country_127'],$lang['country']['country_128'],$lang['country']['country_129'],$lang['country']['country_130'],$lang['country']['country_131'],$lang['country']['country_132'],$lang['country']['country_133'],$lang['country']['country_134'],$lang['country']['country_135'],$lang['country']['country_136'],$lang['country']['country_137'],$lang['country']['country_138'],$lang['country']['country_139'],$lang['country']['country_140'],$lang['country']['country_141'],$lang['country']['country_142'],$lang['country']['country_143'],$lang['country']['country_144'],$lang['country']['country_145'],$lang['country']['country_146'],$lang['country']['country_147'],$lang['country']['country_148'],$lang['country']['country_149'],$lang['country']['country_150'],$lang['country']['country_151'],$lang['country']['country_152'],$lang['country']['country_153'],$lang['country']['country_154'],$lang['country']['country_156'],$lang['country']['country_157'],$lang['country']['country_158'],$lang['country']['country_159'],$lang['country']['country_160'],$lang['country']['country_161'],$lang['country']['country_162'],$lang['country']['country_163'],$lang['country']['country_164'],$lang['country']['country_165'],$lang['country']['country_166'],$lang['country']['country_167'],$lang['country']['country_168'],$lang['country']['country_169'],$lang['country']['country_170'],$lang['country']['country_171'],$lang['country']['country_172'],$lang['country']['country_173'],$lang['country']['country_174'],$lang['country']['country_175'],$lang['country']['country_176'],$lang['country']['country_177'],$lang['country']['country_178'],$lang['country']['country_179'],$lang['country']['country_180'],$lang['country']['country_181'],$lang['country']['country_182'],$lang['country']['country_183'],$lang['country']['country_184'],$lang['country']['country_185'],$lang['country']['country_186'],$lang['country']['country_187'],$lang['country']['country_188'],$lang['country']['country_189'],$lang['country']['country_190'],$lang['country']['country_191'],$lang['country']['country_192'],$lang['country']['country_193'],$lang['country']['country_194'],$lang['country']['country_195'],$lang['country']['country_196'],$lang['country']['country_197'],$lang['country']['country_198'],$lang['country']['country_199'],$lang['country']['country_200'],$lang['country']['country_201'],$lang['country']['country_202'],$lang['country']['country_203'],$lang['country']['country_204'],$lang['country']['country_205'],$lang['country']['country_206'],$lang['country']['country_207'],$lang['country']['country_208'],$lang['country']['country_209'],$lang['country']['country_210'],$lang['country']['country_211'],$lang['country']['country_212'],$lang['country']['country_213'],$lang['country']['country_214'],$lang['country']['country_215'],$lang['country']['country_216'],$lang['country']['country_217'],$lang['country']['country_218'],$lang['country']['country_219'],$lang['country']['country_220'],$lang['country']['country_221']);
$yarray = array('','1916','1917','1918','1919','1920','1921','1922','1923','1924','1925','1926','1927','1928','1929','1930','1931','1932','1933','1934','1935','1936','1937','1938','1939','1940','1941','1942','1943','1944','1945','1946','1947','1948','1949','1950','1951','1952','1953','1954','1955','1956','1957','1958','1959','1960','1961','1962','1963','1964','1965','1966','1967','1968','1969','1970','1971','1972','1973','1974','1975','1976','1977','1978','1979','1980','1981','1982','1983','1984','1985','1986','1987','1988','1989','1990','1991','1992','1993','1994','1995','1996','1997','1998','1999','2000','2001','2002','2003');
$marray = array('','1','2','3','4','5','6','7','8','9','10','11','12');
$darray = array('','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31',);

if(in_array($user_nationality,$narray)){
	$cpass = "";
}
if(!in_array($user_nationality,$narray)){
	$cpass = "no";
}
if(in_array($user_country,$carray)){
	$cpass = "";
}
if(!in_array($user_country,$carray)){
	$cpass = "no";
}
if(in_array($user_year,$yarray)){
	$cpass = "";
}
if(!in_array($user_year,$yarray)){
	$cpass = "no";
}
if(in_array($user_month,$marray)){
	$cpass = "";
}
if(!in_array($user_month,$marray)){
	$cpass = "no";
}
if(in_array($user_day,$darray)){
	$cpass = "";
}
if(!in_array($user_day,$darray)){
	$cpass = "no";
}

if($error != "") {

header("Location: index.php?mode=member&id=".$ProMemberID."");

}	

if ($error == "") {
		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
		$query .= "M_PHOTO_URL = ('$user_photo_url'), ";
		$query .= "M_PHOTO_PURL = ('$user_photo_purl'), ";
        $query .= "M_CITY = ('$user_city'), ";
        $query .= "M_STATE = ('$user_state'), ";
		if($cpass != ""){
		$no = "";
        $query .= "M_AGE = ('$no'), ";
        $query .= "M_NATIONALITY = ('$no'), ";
        $query .= "M_COUNTRY = ('$no'), ";
        $query .= "M_DAY = ('$no'), ";
        $query .= "M_MONTH = ('$no'), ";
        $query .= "M_YEAR = ('$no'), ";		
		} else {
        $query .= "M_AGE = ('$user_age'), ";
        $query .= "M_NATIONALITY = ('$user_nationality'), ";
        $query .= "M_COUNTRY = ('$user_country'), ";
        $query .= "M_DAY = ('$user_day'), ";
        $query .= "M_MONTH = ('$user_month'), ";
        $query .= "M_YEAR = ('$user_year'), ";		
		}
		$query .= "M_MARSTATUS = ('$user_marstatus'), ";
        $query .= "M_REALNAME = ('$user_realname'), ";
        $query .= "M_OCCUPATION = ('$user_occupation') ";

        $query .= "WHERE MEMBER_ID = ".$ProMemberID." ";
		DBi::$con->query($query) or die (DBi::$con->error);


header("Location: index.php?mode=member&id=".$ProMemberID."");

}
}
}


echo'


<tr><td valign="top">
'; if($ProMemberBio != "" && $app != "edit_bio"){
	echo'
	<div class="box_head_wide_ff">
	';if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_bio"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['profiles']['your_biography'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$ProMemberBio.'</td></tr></tbody></table></div></div>
';
} elseif ($ProMemberBio == "" && $app != "edit_bio") {
echo'
<div class="box_head_wide_ff">
'; if (($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
	echo'
&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_bio"><img border="0" src="./profile/add.jpg"></a>&nbsp;
';}
echo'
'.$lang['profiles']['your_biography'].'</div>
<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$lang['member']['no_this'].'</td></tr></tbody></table>
</div>
';	
}
if($app == "edit_bio" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)){
	
		echo'
		<form method="post" action="index.php?mode=member&id='.$ProMemberID.'&app=insert_bio">
	<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	'; }
	echo'
	'.$lang['profiles']['your_biography'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
<textarea class="insidetitle" style="font-size:13px;margin: 0px; width: 320px; height: 197px;" name="user_bio" type="text" rows="1" cols="20">
'.$ProMemberBio.'</textarea><br><br>

<center>
<div id="captchaboxinfo">
<table width="300" bgcolor="#f4f4f4"><tbody>
<tr><td class="tarek" valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img border="0" src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom"></a>
<?php
echo'
<td class="tarek" valign="top">
<img border="0" width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'">
</td>
<td class="tarek" valign="top"><nobr><center><b><font color="blue">'.$lang['others']['captcha'].'</font><br>
<input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div><br>
<input type="submit" value="'.$lang['profile']['insert_info'].'">
&nbsp;&nbsp;&nbsp;<input type="reset" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&#39;;" value="'.$lang['member']['cancel_changes'].'"></center>
</td></tr></tbody></table></div></div></form>
';
	
	
}elseif ($app == "edit_bio" && $ProMemberID != $DBMemberID) {
	
	
echo'
	<div class="box_head_wide_ff">
	';if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_bio"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['profiles']['your_biography'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$ProMemberBio.'</td></tr></tbody></table></div></div>
';
}



if ($app == "insert_bio" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {

    if ($ProMemberID > 0) {

$user_bio = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_bio"]));
	
			$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
	
	if($error != "") {

header("Location: index.php?mode=member&id=".$ProMemberID."");

}

if ($error == "") {
		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
        $query .= "M_BIO = ('$user_bio')  ";
        $query .= "WHERE MEMBER_ID = ".$ProMemberID." ";
		DBi::$con->query($query) or die (DBi::$con->error);


header("Location: index.php?mode=member&id=".$ProMemberID."");

}
}

}
if($ProMemberEdu1_From_Year != "0" && $ProMemberEdu1_To_Year != "0") {
$ProMemberEdu1_Years = '&nbsp;'.$ProMemberEdu1_From_Year.' - '.$ProMemberEdu1_To_Year.'&nbsp;';
}
if($ProMemberEdu2_From_Year != "0" && $ProMemberEdu2_To_Year != "0") {
$ProMemberEdu2_Years = '&nbsp;'.$ProMemberEdu2_From_Year.' - '.$ProMemberEdu2_To_Year.'&nbsp;';
}
if($ProMemberEdu3_From_Year != "0" && $ProMemberEdu3_To_Year != "0") {
$ProMemberEdu3_Years = '&nbsp;'.$ProMemberEdu3_From_Year.' - '.$ProMemberEdu3_To_Year.'&nbsp;';
}
if($ProMemberEdu4_From_Year != "0" && $ProMemberEdu4_To_Year != "0") {
$ProMemberEdu4_Years = '&nbsp;'.$ProMemberEdu4_From_Year.' - '.$ProMemberEdu4_To_Year.'&nbsp;';
}
if($ProMemberEdu5_From_Year != "0" && $ProMemberEdu5_To_Year != "0") {
$ProMemberEdu5_Years = '&nbsp;'.$ProMemberEdu5_From_Year.' - '.$ProMemberEdu5_To_Year.'&nbsp;';
}
if(($ProMemberEdu1_Level != $lang['member']['delete_it'] or $ProMemberEdu2_Level != $lang['member']['delete_it'] or $ProMemberEdu3_Level != $lang['member']['delete_it'] or $ProMemberEdu4_Level != $lang['member']['delete_it'] or $ProMemberEdu5_Level != $lang['member']['delete_it']) && $app != "edit_edu") {
	echo'
	<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_edu"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['member']['the_education'].'</div>
<div class="box_content_wide_ff" style="padding:4px;" id="aj_qualification"><table border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody>';
if($ProMemberEdu1_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu1_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu1_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberEdu1_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberEdu1_Details.'</font></b></td></tr>
';}
if($ProMemberEdu2_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu2_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu2_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberEdu2_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberEdu2_Details.'</font></b></td></tr>
';}
if($ProMemberEdu3_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu3_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu3_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberEdu3_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberEdu3_Details.'</font></b></td></tr>
';}
if($ProMemberEdu4_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu4_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu4_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberEdu4_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberEdu4_Details.'</font></b></td></tr>
';}
if($ProMemberEdu5_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu5_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberEdu5_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberEdu5_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberEdu5_Details.'</font></b></td></tr>
';}
echo'
</tbody></table></div>

';
} elseif(($ProMemberEdu1_Level == $lang['member']['delete_it'] or $ProMemberEdu2_Level == $lang['member']['delete_it'] or $ProMemberEdu3_Level == $lang['member']['delete_it'] or $ProMemberEdu4_Level == $lang['member']['delete_it'] or $ProMemberEdu5_Level == $lang['member']['delete_it']) && $app != "edit_edu")  {
echo'
<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_edu"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
'.$lang['member']['the_education'].'</div>
<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$lang['member']['no_this'].'</td></tr></tbody></table>
</div>
';	
}

if($app == "edit_edu" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)){
	
		echo'
		<form method="post" action="index.php?mode=member&id='.$ProMemberID.'&app=insert_edu">
	<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['member']['the_education'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table width=100% border=0><tr>
<td class="box_content_wide" style="padding:4px;">
<table width=100% border=0><tr><td align=center><b><font color="black">'.$lang['member']['edu_level'].'</font></td><td align=center><b><font color="black">'.$lang['member']['edu_years'].'</font></td><td align=center><b><font color="black">'.$lang['member']['edu_name'].'</font></td></tr>

<tr><td><nobr>
<select name="level1" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu1_From_Year.'" name="from_year1" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu1_To_Year.'" name="to_year1" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu1_Name.'" name="name1">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details1">'.$ProMemberEdu1_Details.'</textarea>
        </td></tr>	
<tr><td><nobr>
<select name="level2" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu2_From_Year.'" name="from_year2" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu2_To_Year.'" name="to_year2" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu2_Name.'" name="name2">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details2">'.$ProMemberEdu2_Details.'</textarea>
        </td></tr>
<tr><td><nobr>
<select name="level3" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu3_From_Year.'" name="from_year3" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu3_To_Year.'" name="to_year3" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu3_Name.'" name="name3">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details3">'.$ProMemberEdu3_Details.'</textarea>
        </td></tr>			
<tr><td><nobr>
<select name="level4" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu4_From_Year.'" name="from_year4" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu4_To_Year.'" name="to_year4" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu4_Name.'" name="name4">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details4">'.$ProMemberEdu4_Details.'</textarea>
        </td></tr>	
<tr><td><nobr>
<select name="level5" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu5_From_Year.'" name="from_year5" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu5_To_Year.'" name="to_year5" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu5_Name.'" name="name5">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details5">'.$ProMemberEdu5_Details.'</textarea>
        </td></tr>			
		
		</table>
<br>

<center>
<div id="captchaboxinfo">
<table width="300" bgcolor="#f4f4f4"><tbody>
<tr><td class="tarek" valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img border="0" src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom"></a>
<?php
echo'
<td class="tarek" valign="top">
<img border="0" width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'">
</td>
<td class="tarek" valign="top"><nobr><center><b><font color="blue">'.$lang['others']['captcha'].'</font><br>
<input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div><br>

<input type="submit" value="'.$lang['profile']['insert_info'].'">
&nbsp;&nbsp;&nbsp;<input type="reset" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&#39;;" value="'.$lang['member']['cancel_changes'].'"></center>
</td></tr></tbody></table></div></div></form>
';
	
	
}elseif ($app == "edit_edu" && $ProMemberID != $DBMemberID) {
	
	
echo'
	<div class="box_head_wide_ff">
	';if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_edu"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['member']['the_education'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">';
if($ProMemberEducation == "") {
	echo $lang['member']['no_this'];
}else {
	echo'
'.$ProMemberEducation.'
';}echo'</td></tr></tbody></table></div></div>
';
}



if ($app == "insert_edu" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {

    if ($ProMemberID > 0) {

$level1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level1"]));
$from_year1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year1"]));
$to_year1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year1"]));
$name1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name1"]));
$details1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details1"]));
$level2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level2"]));
$from_year2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year2"]));
$to_year2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year2"]));
$name2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name2"]));
$details2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details2"]));
$level3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level3"]));
$from_year3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year3"]));
$to_year3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year3"]));
$name3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name3"]));
$details3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details3"]));
$level4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level4"]));
$from_year4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year4"]));
$to_year4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year4"]));
$name4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name4"]));
$details4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details4"]));
$level5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level5"]));
$from_year5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year5"]));
$to_year5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year5"]));
$name5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name5"]));
$details5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details5"]));

	
			$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
	
	if($error != "") {

header("Location: index.php?mode=member&id=".$ProMemberID."");

}

if ($error == "") {
		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
        $query .= "M_EDU1_LEVEL = ('$level1'),  ";
        $query .= "M_EDU1_FROM_YEAR = ('$from_year1'),  ";
        $query .= "M_EDU1_TO_YEAR = ('$to_year1'),  ";
        $query .= "M_EDU1_NAME = ('$name1'),  ";
        $query .= "M_EDU1_DETAILS = ('$details1'),  ";
        $query .= "M_EDU2_LEVEL = ('$level2'),  ";
        $query .= "M_EDU2_FROM_YEAR = ('$from_year2'),  ";
        $query .= "M_EDU2_TO_YEAR = ('$to_year2'),  ";
        $query .= "M_EDU2_NAME = ('$name2'),  ";
        $query .= "M_EDU2_DETAILS = ('$details2'),  ";
        $query .= "M_EDU3_LEVEL = ('$level3'),  ";
        $query .= "M_EDU3_FROM_YEAR = ('$from_year3'),  ";
        $query .= "M_EDU3_TO_YEAR = ('$to_year3'),  ";
        $query .= "M_EDU3_NAME = ('$name3'),  ";
        $query .= "M_EDU3_DETAILS = ('$details3'),  ";
        $query .= "M_EDU4_LEVEL = ('$level4'),  ";
        $query .= "M_EDU4_FROM_YEAR = ('$from_year4'),  ";
        $query .= "M_EDU4_TO_YEAR = ('$to_year4'),  ";
        $query .= "M_EDU4_NAME = ('$name4'),  ";
        $query .= "M_EDU4_DETAILS = ('$details4'),  ";
        $query .= "M_EDU5_LEVEL = ('$level5'),  ";
        $query .= "M_EDU5_FROM_YEAR = ('$from_year5'),  ";
        $query .= "M_EDU5_TO_YEAR = ('$to_year5'),  ";
        $query .= "M_EDU5_NAME = ('$name5'),  ";
        $query .= "M_EDU5_DETAILS = ('$details5')  ";		
        $query .= "WHERE MEMBER_ID = ".$ProMemberID." ";
		DBi::$con->query($query) or die (DBi::$con->error);


header("Location: index.php?mode=member&id=".$ProMemberID."");

}
}

}

if($ProMemberPedu1_From_Year != "0" && $ProMemberPedu1_To_Year != "0") {
$ProMemberPedu1_Years = '&nbsp;'.$ProMemberPedu1_From_Year.' - '.$ProMemberPedu1_To_Year.'&nbsp;';
}
if($ProMemberPedu2_From_Year != "0" && $ProMemberPedu2_To_Year != "0") {
$ProMemberPedu2_Years = '&nbsp;'.$ProMemberPedu2_From_Year.' - '.$ProMemberPedu2_To_Year.'&nbsp;';
}
if($ProMemberPedu3_From_Year != "0" && $ProMemberPedu3_To_Year != "0") {
$ProMemberPedu3_Years = '&nbsp;'.$ProMemberPedu3_From_Year.' - '.$ProMemberPedu3_To_Year.'&nbsp;';
}
if($ProMemberPedu4_From_Year != "0" && $ProMemberPedu4_To_Year != "0") {
$ProMemberPedu4_Years = '&nbsp;'.$ProMemberPedu4_From_Year.' - '.$ProMemberPedu4_To_Year.'&nbsp;';
}
if($ProMemberPedu5_From_Year != "0" && $ProMemberPedu5_To_Year != "0") {
$ProMemberPedu5_Years = '&nbsp;'.$ProMemberPedu5_From_Year.' - '.$ProMemberPedu5_To_Year.'&nbsp;';
}
if(($ProMemberPedu1_Level != $lang['member']['delete_it'] or $ProMemberPedu2_Level != $lang['member']['delete_it'] or $ProMemberPedu3_Level != $lang['member']['delete_it'] or $ProMemberPedu4_Level != $lang['member']['delete_it'] or $ProMemberPedu5_Level != $lang['member']['delete_it']) && $app != "edit_pedu") {
	echo'
	<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_pedu"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['member']['the_peducation'].'</div>
<div class="box_content_wide_ff" style="padding:4px;" id="aj_qualification"><table border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody>';
if($ProMemberPedu1_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu1_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu1_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberPedu1_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberPedu1_Details.'</font></b></td></tr>
';}
if($ProMemberPedu2_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu2_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu2_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberPedu2_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberPedu2_Details.'</font></b></td></tr>
';}
if($ProMemberPedu3_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu3_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu3_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberPedu3_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberPedu3_Details.'</font></b></td></tr>
';}
if($ProMemberPedu4_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu4_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu4_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberPedu4_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberPedu4_Details.'</font></b></td></tr>
';}
if($ProMemberPedu5_Level != $lang['member']['delete_it']) {echo'
<tr><td width="50" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu5_Level.'</font></nobr></td><td width="70" style="font-size:12px;"><nobr><font color="black">'.$ProMemberPedu5_Years.'</font></nobr></td><td width="90%"><b><font color="black">'.$ProMemberPedu5_Name.'</font></b></td></tr><tr><td colspan="2"></td><td width="90%" style="font-size:12px;"><b><font color="black">'.$ProMemberPedu5_Details.'</font></b></td></tr>
';}
echo'
</tbody></table></div>

';
} elseif(($ProMemberPedu1_Level == $lang['member']['delete_it'] or $ProMemberPedu2_Level == $lang['member']['delete_it'] or $ProMemberPedu3_Level == $lang['member']['delete_it'] or $ProMemberPedu4_Level == $lang['member']['delete_it'] or $ProMemberPedu5_Level == $lang['member']['delete_it']) && $app != "edit_pedu")  {
echo'
<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_pedu"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
'.$lang['member']['the_peducation'].'</div>
<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$lang['member']['no_this'].'</td></tr></tbody></table>
</div>
';	
}

if($app == "edit_pedu" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)){
	
		echo'
		<form method="post" action="index.php?mode=member&id='.$ProMemberID.'&app=insert_pedu">
	<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['member']['the_peducation'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table width=100% border=0><tr>
<td class="box_content_wide" style="padding:4px;">
<table width=100% border=0><tr><td align=center><b><font color="black">'.$lang['member']['edu_level'].'</font></td><td align=center><b><font color="black">'.$lang['member']['edu_years'].'</font></td><td align=center><b><font color="black">'.$lang['member']['pedu_name'].'</font></td></tr>

<tr><td><nobr>
<select name="level1" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['pedu_level_1'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['pedu_level_1']).'>'.$lang['member']['pedu_level_1'].'</option>
<option value="'.$lang['member']['pedu_level_2'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['pedu_level_2']).'>'.$lang['member']['pedu_level_2'].'</option>
<option value="'.$lang['member']['pedu_level_3'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['pedu_level_3']).'>'.$lang['member']['pedu_level_3'].'</option>
<option value="'.$lang['member']['pedu_level_4'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['pedu_level_4']).'>'.$lang['member']['pedu_level_4'].'</option>
<option value="'.$lang['member']['pedu_level_5'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['pedu_level_5']).'>'.$lang['member']['pedu_level_5'].'</option>
<option value="'.$lang['member']['pedu_level_6'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['pedu_level_6']).'>'.$lang['member']['pedu_level_6'].'</option>
<option value="'.$lang['member']['pedu_level_7'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['pedu_level_7']).'>'.$lang['member']['pedu_level_7'].'</option>
<option value="'.$lang['member']['pedu_level_8'].'" '.check_select($ProMemberPedu1_Level, $lang['member']['pedu_level_8']).'>'.$lang['member']['pedu_level_8'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu1_From_Year.'" name="from_year1" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu1_To_Year.'" name="to_year1" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu1_Name.'" name="name1">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details1">'.$ProMemberPedu1_Details.'</textarea>
        </td></tr>	
<tr><td><nobr>
<select name="level2" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['pedu_level_1'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['pedu_level_1']).'>'.$lang['member']['pedu_level_1'].'</option>
<option value="'.$lang['member']['pedu_level_2'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['pedu_level_2']).'>'.$lang['member']['pedu_level_2'].'</option>
<option value="'.$lang['member']['pedu_level_3'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['pedu_level_3']).'>'.$lang['member']['pedu_level_3'].'</option>
<option value="'.$lang['member']['pedu_level_4'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['pedu_level_4']).'>'.$lang['member']['pedu_level_4'].'</option>
<option value="'.$lang['member']['pedu_level_5'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['pedu_level_5']).'>'.$lang['member']['pedu_level_5'].'</option>
<option value="'.$lang['member']['pedu_level_6'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['pedu_level_6']).'>'.$lang['member']['pedu_level_6'].'</option>
<option value="'.$lang['member']['pedu_level_7'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['pedu_level_7']).'>'.$lang['member']['pedu_level_7'].'</option>
<option value="'.$lang['member']['pedu_level_8'].'" '.check_select($ProMemberPedu2_Level, $lang['member']['pedu_level_8']).'>'.$lang['member']['pedu_level_8'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu2_From_Year.'" name="from_year2" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu2_To_Year.'" name="to_year2" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu2_Name.'" name="name2">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details2">'.$ProMemberPedu2_Details.'</textarea>
        </td></tr>
<tr><td><nobr>
<select name="level3" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['pedu_level_1'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['pedu_level_1']).'>'.$lang['member']['pedu_level_1'].'</option>
<option value="'.$lang['member']['pedu_level_2'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['pedu_level_2']).'>'.$lang['member']['pedu_level_2'].'</option>
<option value="'.$lang['member']['pedu_level_3'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['pedu_level_3']).'>'.$lang['member']['pedu_level_3'].'</option>
<option value="'.$lang['member']['pedu_level_4'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['pedu_level_4']).'>'.$lang['member']['pedu_level_4'].'</option>
<option value="'.$lang['member']['pedu_level_5'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['pedu_level_5']).'>'.$lang['member']['pedu_level_5'].'</option>
<option value="'.$lang['member']['pedu_level_6'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['pedu_level_6']).'>'.$lang['member']['pedu_level_6'].'</option>
<option value="'.$lang['member']['pedu_level_7'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['pedu_level_7']).'>'.$lang['member']['pedu_level_7'].'</option>
<option value="'.$lang['member']['pedu_level_8'].'" '.check_select($ProMemberPedu3_Level, $lang['member']['pedu_level_8']).'>'.$lang['member']['pedu_level_8'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu3_From_Year.'" name="from_year3" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu3_To_Year.'" name="to_year3" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu3_Name.'" name="name3">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details3">'.$ProMemberPedu3_Details.'</textarea>
        </td></tr>			
<tr><td><nobr>
<select name="level4" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['pedu_level_1'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['pedu_level_1']).'>'.$lang['member']['pedu_level_1'].'</option>
<option value="'.$lang['member']['pedu_level_2'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['pedu_level_2']).'>'.$lang['member']['pedu_level_2'].'</option>
<option value="'.$lang['member']['pedu_level_3'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['pedu_level_3']).'>'.$lang['member']['pedu_level_3'].'</option>
<option value="'.$lang['member']['pedu_level_4'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['pedu_level_4']).'>'.$lang['member']['pedu_level_4'].'</option>
<option value="'.$lang['member']['pedu_level_5'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['pedu_level_5']).'>'.$lang['member']['pedu_level_5'].'</option>
<option value="'.$lang['member']['pedu_level_6'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['pedu_level_6']).'>'.$lang['member']['pedu_level_6'].'</option>
<option value="'.$lang['member']['pedu_level_7'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['pedu_level_7']).'>'.$lang['member']['pedu_level_7'].'</option>
<option value="'.$lang['member']['pedu_level_8'].'" '.check_select($ProMemberPedu4_Level, $lang['member']['pedu_level_8']).'>'.$lang['member']['pedu_level_8'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu4_From_Year.'" name="from_year4" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu4_To_Year.'" name="to_year4" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu4_Name.'" name="name4">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details4">'.$ProMemberPedu4_Details.'</textarea>
        </td></tr>	
<tr><td><nobr>
<select name="level5" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['pedu_level_1'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['pedu_level_1']).'>'.$lang['member']['pedu_level_1'].'</option>
<option value="'.$lang['member']['pedu_level_2'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['pedu_level_2']).'>'.$lang['member']['pedu_level_2'].'</option>
<option value="'.$lang['member']['pedu_level_3'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['pedu_level_3']).'>'.$lang['member']['pedu_level_3'].'</option>
<option value="'.$lang['member']['pedu_level_4'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['pedu_level_4']).'>'.$lang['member']['pedu_level_4'].'</option>
<option value="'.$lang['member']['pedu_level_5'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['pedu_level_5']).'>'.$lang['member']['pedu_level_5'].'</option>
<option value="'.$lang['member']['pedu_level_6'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['pedu_level_6']).'>'.$lang['member']['pedu_level_6'].'</option>
<option value="'.$lang['member']['pedu_level_7'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['pedu_level_7']).'>'.$lang['member']['pedu_level_7'].'</option>
<option value="'.$lang['member']['pedu_level_8'].'" '.check_select($ProMemberPedu5_Level, $lang['member']['pedu_level_8']).'>'.$lang['member']['pedu_level_8'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu5_From_Year.'" name="from_year5" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu5_To_Year.'" name="to_year5" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu5_Name.'" name="name5">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="details5">'.$ProMemberPedu5_Details.'</textarea>
        </td></tr>			
		
		</table>
<br>

<center>
<div id="captchaboxinfo">
<table width="300" bgcolor="#f4f4f4"><tbody>
<tr><td class="tarek" valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img border="0" src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom"></a>
<?php
echo'
<td class="tarek" valign="top">
<img border="0" width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'">
</td>
<td class="tarek" valign="top"><nobr><center><b><font color="blue">'.$lang['others']['captcha'].'</font><br>
<input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div><br>

<input type="submit" value="'.$lang['profile']['insert_info'].'">
&nbsp;&nbsp;&nbsp;<input type="reset" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&#39;;" value="'.$lang['member']['cancel_changes'].'"></center>
</td></tr></tbody></table></div></div></form>
';
	
	
}elseif ($app == "edit_pedu" && $ProMemberID != $DBMemberID) {
	
	
echo'
	<div class="box_head_wide_ff">
	';if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_pedu"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['member']['the_peducation'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">';
if($ProMemberPeducation == "") {
	echo $lang['member']['no_this'];
}else {
	echo'
'.$ProMemberPeducation.'
';}echo'</td></tr></tbody></table></div></div>
';
}



if ($app == "insert_pedu" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {

    if ($ProMemberID > 0) {

$level1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level1"]));
$from_year1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year1"]));
$to_year1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year1"]));
$name1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name1"]));
$details1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details1"]));
$level2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level2"]));
$from_year2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year2"]));
$to_year2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year2"]));
$name2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name2"]));
$details2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details2"]));
$level3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level3"]));
$from_year3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year3"]));
$to_year3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year3"]));
$name3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name3"]));
$details3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details3"]));
$level4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level4"]));
$from_year4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year4"]));
$to_year4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year4"]));
$name4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name4"]));
$details4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details4"]));
$level5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["level5"]));
$from_year5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["from_year5"]));
$to_year5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["to_year5"]));
$name5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["name5"]));
$details5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["details5"]));

	
			$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
	
	if($error != "") {

header("Location: index.php?mode=member&id=".$ProMemberID."");

}

if ($error == "") {
		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
        $query .= "M_PEDU1_LEVEL = ('$level1'),  ";
        $query .= "M_PEDU1_FROM_YEAR = ('$from_year1'),  ";
        $query .= "M_PEDU1_TO_YEAR = ('$to_year1'),  ";
        $query .= "M_PEDU1_NAME = ('$name1'),  ";
        $query .= "M_PEDU1_DETAILS = ('$details1'),  ";
        $query .= "M_PEDU2_LEVEL = ('$level2'),  ";
        $query .= "M_PEDU2_FROM_YEAR = ('$from_year2'),  ";
        $query .= "M_PEDU2_TO_YEAR = ('$to_year2'),  ";
        $query .= "M_PEDU2_NAME = ('$name2'),  ";
        $query .= "M_PEDU2_DETAILS = ('$details2'),  ";
        $query .= "M_PEDU3_LEVEL = ('$level3'),  ";
        $query .= "M_PEDU3_FROM_YEAR = ('$from_year3'),  ";
        $query .= "M_PEDU3_TO_YEAR = ('$to_year3'),  ";
        $query .= "M_PEDU3_NAME = ('$name3'),  ";
        $query .= "M_PEDU3_DETAILS = ('$details3'),  ";
        $query .= "M_PEDU4_LEVEL = ('$level4'),  ";
        $query .= "M_PEDU4_FROM_YEAR = ('$from_year4'),  ";
        $query .= "M_PEDU4_TO_YEAR = ('$to_year4'),  ";
        $query .= "M_PEDU4_NAME = ('$name4'),  ";
        $query .= "M_PEDU4_DETAILS = ('$details4'),  ";
        $query .= "M_PEDU5_LEVEL = ('$level5'),  ";
        $query .= "M_PEDU5_FROM_YEAR = ('$from_year5'),  ";
        $query .= "M_PEDU5_TO_YEAR = ('$to_year5'),  ";
        $query .= "M_PEDU5_NAME = ('$name5'),  ";
        $query .= "M_PEDU5_DETAILS = ('$details5')  ";		
        $query .= "WHERE MEMBER_ID = ".$ProMemberID." ";
		DBi::$con->query($query) or die (DBi::$con->error);


header("Location: index.php?mode=member&id=".$ProMemberID."");

}
}

}
if($ProMemberHobby == 1 && $app != "edit_hob") {
if ($ProMemberHob1 != "") {
        $ProMemberHob_1 = $ProMemberHob1;
    }
    if ($ProMemberHob2 != "") {
		if($ProMemberHob1 != "") {
		$ProMemberHob_2 = " - ";	
		}
        $ProMemberHob_2 .= $ProMemberHob2;
    }
    if ($ProMemberHob3 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "") {
		$ProMemberHob_3 = " - ";	
		}
        $ProMemberHob_3 .= $ProMemberHob3;
    }
    if ($ProMemberHob4 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "") {
		$ProMemberHob_4 = " - ";	
		}
        $ProMemberHob_4 .= $ProMemberHob4;
    }
    if ($ProMemberHob5 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "") {
		$ProMemberHob_5 = " - ";	
		}
        $ProMemberHob_5 .= $ProMemberHob5;
    }
    if ($ProMemberHob6 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "") {
		$ProMemberHob_6 = " - ";	
		}
        $ProMemberHob_6 .= $ProMemberHob6;
    }
    if ($ProMemberHob7 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "") {
		$ProMemberHob_7 = " - ";	
		}
        $ProMemberHob_7 .= $ProMemberHob7;
    }
    if ($ProMemberHob8 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "") {
		$ProMemberHob_8 = " - ";	
		}
        $ProMemberHob_8 .= $ProMemberHob8;
    }
    if ($ProMemberHob9 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "") {
		$ProMemberHob_9 = " - ";	
		}
        $ProMemberHob_9 .= $ProMemberHob9;
    }
    if ($ProMemberHob10 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "") {
		$ProMemberHob_10 = " - ";	
		}
        $ProMemberHob_10 .= $ProMemberHob10;
    }
    if ($ProMemberHob11 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "") {
		$ProMemberHob_11 = " - ";	
		}
        $ProMemberHob_11 .= $ProMemberHob11;
    }
    if ($ProMemberHob12 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "") {
		$ProMemberHob_12 = " - ";	
		}
        $ProMemberHob_12 .= $ProMemberHob12;
    }
    if ($ProMemberHob13 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "") {
		$ProMemberHob_13 = " - ";	
		}
        $ProMemberHob_13 .= $ProMemberHob13;
    }
    if ($ProMemberHob14 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "") {
		$ProMemberHob_14 = " - ";	
		}
        $ProMemberHob_14 .= $ProMemberHob14;
    }
    if ($ProMemberHob15 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "") {
		$ProMemberHob_15 = " - ";	
		}
        $ProMemberHob_15 .= $ProMemberHob15;
    }
    if ($ProMemberHob16 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "") {
		$ProMemberHob_16 = " - ";	
		}
        $ProMemberHob_16 .= $ProMemberHob16;
    }
    if ($ProMemberHob17 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "") {
		$ProMemberHob_17 = " - ";	
		}
        $ProMemberHob_17 .= $ProMemberHob17;
    }
    if ($ProMemberHob18 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "") {
		$ProMemberHob_18 = " - ";	
		}
        $ProMemberHob_18 .= $ProMemberHob18;
    }
    if ($ProMemberHob19 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "") {
		$ProMemberHob_19 = " - ";	
		}
        $ProMemberHob_19 .= $ProMemberHob19;
    }
    if ($ProMemberHob20 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "") {
		$ProMemberHob_20 = " - ";	
		}
        $ProMemberHob_20 .= $ProMemberHob20;
    }
    if ($ProMemberHob21 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "") {
		$ProMemberHob_21 = " - ";	
		}
        $ProMemberHob_21 .= $ProMemberHob21;
    }
    if ($ProMemberHob22 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "") {
		$ProMemberHob_22 = " - ";	
		}
        $ProMemberHob_22 .= $ProMemberHob22;
    }
    if ($ProMemberHob23 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "") {
		$ProMemberHob_23 = " - ";	
		}
        $ProMemberHob_23 .= $ProMemberHob23;
    }
    if ($ProMemberHob24 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "") {
		$ProMemberHob_24 = " - ";	
		}
        $ProMemberHob_24 .= $ProMemberHob24;
    }
    if ($ProMemberHob25 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "") {
		$ProMemberHob_25 = " - ";	
		}
        $ProMemberHob_25 .= $ProMemberHob25;
    }
    if ($ProMemberHob26 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "") {
		$ProMemberHob_26 = " - ";	
		}
        $ProMemberHob_26 .= $ProMemberHob26;
    }
    if ($ProMemberHob27 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "") {
		$ProMemberHob_27 = " - ";	
		}
        $ProMemberHob_27 .= $ProMemberHob27;
    }
    if ($ProMemberHob28 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "" or $ProMemberHob27 != "") {
		$ProMemberHob_28 = " - ";	
		}
        $ProMemberHob_28 .= $ProMemberHob28;
    }
    if ($ProMemberHob29 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "" or $ProMemberHob27 != "" or $ProMemberHob28 != "") {
		$ProMemberHob_29 = " - ";	
		}
        $ProMemberHob_29 .= $ProMemberHob29;
    }
    if ($ProMemberHob30 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "" or $ProMemberHob27 != "" or $ProMemberHob28 != "" or $ProMemberHob29 != "") {
		$ProMemberHob_30 = " - ";	
		}
        $ProMemberHob_30 .= $ProMemberHob30;
    }
    if ($ProMemberHob31 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "" or $ProMemberHob27 != "" or $ProMemberHob28 != "" or $ProMemberHob29 != "" or $ProMemberHob30 != "") {
		$ProMemberHob_31 = " - ";	
		}
        $ProMemberHob_31 .= $ProMemberHob31;
    }
    if ($ProMemberHob32 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "" or $ProMemberHob27 != "" or $ProMemberHob28 != "" or $ProMemberHob29 != "" or $ProMemberHob30 != "" or $ProMemberHob31 != "") {
		$ProMemberHob_32 = " - ";	
		}
        $ProMemberHob_32 .= $ProMemberHob32;
    }
    if ($ProMemberHob33 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "" or $ProMemberHob27 != "" or $ProMemberHob28 != "" or $ProMemberHob29 != "" or $ProMemberHob30 != "" or $ProMemberHob31 != "" or $ProMemberHob32 != "") {
		$ProMemberHob_33 = " - ";	
		}
        $ProMemberHob_33 .= $ProMemberHob33;
    }
    if ($ProMemberHob34 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "" or $ProMemberHob27 != "" or $ProMemberHob28 != "" or $ProMemberHob29 != "" or $ProMemberHob30 != "" or $ProMemberHob31 != "" or $ProMemberHob32 != "" or $ProMemberHob33 != "") {
		$ProMemberHob_34 = " - ";	
		}
        $ProMemberHob_34 .= $ProMemberHob34;
    }	
    if ($ProMemberHob35 != "") {
		if($ProMemberHob1 != "" or $ProMemberHob2 != "" or $ProMemberHob3 != "" or $ProMemberHob4 != "" or $ProMemberHob5 != "" or $ProMemberHob6 != "" or $ProMemberHob7 != "" or $ProMemberHob8 != "" or $ProMemberHob9 != "" or $ProMemberHob10 != "" or $ProMemberHob11 != "" or $ProMemberHob12 != "" or $ProMemberHob13 != "" or $ProMemberHob14 != "" or $ProMemberHob15 != "" or $ProMemberHob16 != "" or $ProMemberHob17 != "" or $ProMemberHob18 != "" or $ProMemberHob19 != "" or $ProMemberHob20 != "" or $ProMemberHob21 != "" or $ProMemberHob22 != "" or $ProMemberHob23 != "" or $ProMemberHob24 != "" or $ProMemberHob25 != "" or $ProMemberHob26 != "" or $ProMemberHob27 != "" or $ProMemberHob28 != "" or $ProMemberHob29 != "" or $ProMemberHob30 != "" or $ProMemberHob31 != "" or $ProMemberHob32 != "" or $ProMemberHob33 != "" or $ProMemberHob34 != "") {
		$ProMemberHob_35 = " - ";	
		}
        $ProMemberHob_35 .= $ProMemberHob35;
    }
	echo'
	<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_hob"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['member']['the_hobbies'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$ProMemberHob_1.$ProMemberHob_2.$ProMemberHob_3.$ProMemberHob_4.$ProMemberHob_5.$ProMemberHob_6.$ProMemberHob_7.$ProMemberHob_8.$ProMemberHob_9.$ProMemberHob_10.$ProMemberHob_11.$ProMemberHob_12.$ProMemberHob_13.$ProMemberHob_14.$ProMemberHob_15.$ProMemberHob_16.$ProMemberHob_17.$ProMemberHob_18.$ProMemberHob_19.$ProMemberHob_20.$ProMemberHob_21.$ProMemberHob_22.$ProMemberHob_23.$ProMemberHob_24.$ProMemberHob_25.$ProMemberHob_26.$ProMemberHob_27.$ProMemberHob_28.$ProMemberHob_29.$ProMemberHob_30.$ProMemberHob_31.$ProMemberHob_32.$ProMemberHob_33.$ProMemberHob_34.$ProMemberHob_35.'</td></tr></tbody></table></div></div>
';
}

if($ProMemberHobby == 0 && $app != "edit_hob"){
echo'
<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_hob"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
'.$lang['member']['the_hobbies'].'</div>
<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$lang['member']['no_this'].'</td></tr></tbody></table>
</div>
';	

}
if($app == "edit_hob" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)){
	
		echo'
		<form method="post" action="index.php?mode=member&id='.$ProMemberID.'&app=insert_hob">
	<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
	'.$lang['member']['the_hobbies'].'</div>
	<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">

					<input onchange="check_changes(row_user_hob1, \''.$ProMemberHob1.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_music'].'" name="user_hob1" '.check_radio($ProMemberHob1, $lang['member']['hobby_music']).'>'.$lang['member']['hobby_music'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob2, \''.$ProMemberHob2.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_technology'].'" name="user_hob2" '.check_radio($ProMemberHob2, $lang['member']['hobby_technology']).'>'.$lang['member']['hobby_technology'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob3, \''.$ProMemberHob3.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_internet'].'" name="user_hob3" '.check_radio($ProMemberHob3, $lang['member']['hobby_internet']).'>'.$lang['member']['hobby_internet'].'&nbsp;&nbsp;&nbsp;<br>
					<input onchange="check_changes(row_user_hob4, \''.$ProMemberHob4.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_jokes'].'" name="user_hob4" '.check_radio($ProMemberHob4, $lang['member']['hobby_jokes']).'>'.$lang['member']['hobby_jokes'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob5, \''.$ProMemberHob5.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_games'].'" name="user_hob5" '.check_radio($ProMemberHob5, $lang['member']['hobby_games']).'>'.$lang['member']['hobby_games'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob6, \''.$ProMemberHob6.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_books'].'" name="user_hob6" '.check_radio($ProMemberHob6, $lang['member']['hobby_books']).'>'.$lang['member']['hobby_books'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<input onchange="check_changes(row_user_hob7, \''.$ProMemberHob7.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_caluture'].'" name="user_hob7" '.check_radio($ProMemberHob7, $lang['member']['hobby_caluture']).'>'.$lang['member']['hobby_caluture'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob8, \''.$ProMemberHob8.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_shopping'].'" name="user_hob8" '.check_radio($ProMemberHob8, $lang['member']['hobby_shopping']).'>'.$lang['member']['hobby_shopping'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob9, \''.$ProMemberHob9.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_studying'].'" name="user_hob9" '.check_radio($ProMemberHob9, $lang['member']['hobby_studying']).'>'.$lang['member']['hobby_studying'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<input onchange="check_changes(row_user_hob10, \''.$ProMemberHob10.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_arabic_films'].'" name="user_hob10" '.check_radio($ProMemberHob10, $lang['member']['hobby_arabic_films']).'>'.$lang['member']['hobby_arabic_films'].'&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob11, \''.$ProMemberHob11.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_english_films'].'" name="user_hob11" '.check_radio($ProMemberHob11, $lang['member']['hobby_english_films']).'>'.$lang['member']['hobby_english_films'].'&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob12, \''.$ProMemberHob12.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_football'].'" name="user_hob12" '.check_radio($ProMemberHob12, $lang['member']['hobby_football']).'>'.$lang['member']['hobby_football'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>

					<input onchange="check_changes(row_user_hob13, \''.$ProMemberHob13.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_basketball'].'" name="user_hob13" '.check_radio($ProMemberHob13, $lang['member']['hobby_basketball']).'>'.$lang['member']['hobby_basketball'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob14, \''.$ProMemberHob14.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_handball'].'" name="user_hob14" '.check_radio($ProMemberHob14, $lang['member']['hobby_handball']).'>'.$lang['member']['hobby_handball'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob15, \''.$ProMemberHob15.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_planball'].'" name="user_hob15" '.check_radio($ProMemberHob15, $lang['member']['hobby_planball']).'>'.$lang['member']['hobby_planball'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<input onchange="check_changes(row_user_hob16, \''.$ProMemberHob16.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_tennis'].'" name="user_hob16" '.check_radio($ProMemberHob16, $lang['member']['hobby_tennis']).'>'.$lang['member']['hobby_tennis'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob17, \''.$ProMemberHob17.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_sports'].'" name="user_hob17" '.check_radio($ProMemberHob17, $lang['member']['hobby_sports']).'>'.$lang['member']['hobby_sports'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob18, \''.$ProMemberHob18.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_seya7a'].'" name="user_hob18" '.check_radio($ProMemberHob18, $lang['member']['hobby_seya7a']).'>'.$lang['member']['hobby_seya7a'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<input onchange="check_changes(row_user_hob19, \''.$ProMemberHob19.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_mobiles'].'" name="user_hob19" '.check_radio($ProMemberHob19, $lang['member']['hobby_mobiles']).'>'.$lang['member']['hobby_mobiles'].'
					<input onchange="check_changes(row_user_hob20, \''.$ProMemberHob20.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_tv'].'" name="user_hob20" '.check_radio($ProMemberHob20, $lang['member']['hobby_tv']).'>'.$lang['member']['hobby_tv'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob21, \''.$ProMemberHob21.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_cars'].'" name="user_hob21" '.check_radio($ProMemberHob21, $lang['member']['hobby_cars']).'>'.$lang['member']['hobby_cars'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<input onchange="check_changes(row_user_hob22, \''.$ProMemberHob22.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_draw'] .'" name="user_hob22" '.check_radio($ProMemberHob22, $lang['member']['hobby_draw']).'>'.$lang['member']['hobby_draw'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob23, \''.$ProMemberHob23.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_fnon'].'" name="user_hob23" '.check_radio($ProMemberHob23, $lang['member']['hobby_fnon']).'>'.$lang['member']['hobby_fnon'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob24, \''.$ProMemberHob24.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_radio'].'" name="user_hob24" '.check_radio($ProMemberHob24, $lang['member']['hobby_radio']).'>'.$lang['member']['hobby_radio'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>

					
					<input onchange="check_changes(row_user_hob25, \''.$ProMemberHob25.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_leyaqa'].'" name="user_hob25" '.check_radio($ProMemberHob25, $lang['member']['hobby_leyaqa']).'>'.$lang['member']['hobby_leyaqa'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob26, \''.$ProMemberHob26.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_dekor'].'" name="user_hob26" '.check_radio($ProMemberHob26, $lang['member']['hobby_dekor']).'>'.$lang['member']['hobby_dekor'].'&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob27, \''.$ProMemberHob27.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_travel'].'" name="user_hob27" '.check_radio($ProMemberHob27, $lang['member']['hobby_travel']).'>'.$lang['member']['hobby_travel'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<input onchange="check_changes(row_user_hob28, \''.$ProMemberHob28.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_chat'].'" name="user_hob28" '.check_radio($ProMemberHob28, $lang['member']['hobby_chat']).'>'.$lang['member']['hobby_chat'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob29, \''.$ProMemberHob29.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_eqtesad'].'" name="user_hob29" '.check_radio($ProMemberHob29, $lang['member']['hobby_eqtesad']).'>'.$lang['member']['hobby_eqtesad'].'
					<input onchange="check_changes(row_user_hob30, \''.$ProMemberHob30.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_studyes'].'" name="user_hob30" '.check_radio($ProMemberHob30, $lang['member']['hobby_studyes']).'>'.$lang['member']['hobby_studyes'].'<br>
					<input onchange="check_changes(row_user_hob31, \''.$ProMemberHob31.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_azyaa'].'" name="user_hob31" '.check_radio($ProMemberHob31, $lang['member']['hobby_azyaa']).'>'.$lang['member']['hobby_azyaa'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob32, \''.$ProMemberHob32.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_swimming'].'" name="user_hob32" '.check_radio($ProMemberHob32, $lang['member']['hobby_swimming']).'>'.$lang['member']['hobby_swimming'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob33, \''.$ProMemberHob33.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_poem'].'" name="user_hob33" '.check_radio($ProMemberHob33, $lang['member']['hobby_poem']).'>'.$lang['member']['hobby_poem'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<input onchange="check_changes(row_user_hob34, \''.$ProMemberHob34.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_cook'].'" name="user_hob34" '.check_radio($ProMemberHob34, $lang['member']['hobby_cook']).'>'.$lang['member']['hobby_cook'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_hob35, \''.$ProMemberHob35.'\', this.value)" class="small" type="checkbox" value="'.$lang['member']['hobby_tatrez'].'" name="user_hob35" '.check_radio($ProMemberHob35, $lang['member']['hobby_tatrez']).'>'.$lang['member']['hobby_tatrez'].'&nbsp;&nbsp;&nbsp;<br>
<br><br>
<center>
<div id="captchaboxinfo">
<table width="300" bgcolor="#f4f4f4"><tbody>
<tr><td class="tarek" valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img border="0" src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom"></a>
<?php
echo'
<td class="tarek" valign="top">
<img border="0" width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'">
</td>
<td class="tarek" valign="top"><nobr><center><b><font color="blue">'.$lang['others']['captcha'].'</font><br>
<input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div><br>

<input type="submit" value="'.$lang['profile']['insert_info'].'">
&nbsp;&nbsp;&nbsp;<input type="reset" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&#39;;" value="'.$lang['member']['cancel_changes'].'"></center>
</td></tr></tbody></table></div></div>
';
	
	
}elseif ($app == "edit_hob" && $ProMemberID != $DBMemberID) {
	if($ProMemberHobby == 1) {

if ($ProMemberHob1 != "") {
        $ProMemberHob1 = $ProMemberHob1." - ";
    }
    if ($ProMemberHob2 != "") {
        $ProMemberHob2 = $ProMemberHob2." - ";
    }
    if ($ProMemberHob3 != "") {
        $ProMemberHob3 = $ProMemberHob3." - ";
    }	
    if ($ProMemberHob4 != "") {
        $ProMemberHob4 = $ProMemberHob4." - ";
    }		
    if ($ProMemberHob5 != "") {
        $ProMemberHob5 = $ProMemberHob5." - ";
    }		
    if ($ProMemberHob6 != "") {
        $ProMemberHob6 = $ProMemberHob6." - ";
    }
    if ($ProMemberHob7 != "") {
        $ProMemberHob7 = $ProMemberHob7." - ";
    }
    if ($ProMemberHob8 != "") {
        $ProMemberHob8 = $ProMemberHob8." - ";
    }	
    if ($ProMemberHob9 != "") {
        $ProMemberHob9 = $ProMemberHob9." - ";
    }		
    if ($ProMemberHob10 != "") {
        $ProMemberHob10 = $ProMemberHob10." - ";
    }		
    if ($ProMemberHob11 != "") {
        $ProMemberHob11 = $ProMemberHob11." - ";
    }
    if ($ProMemberHob12 != "") {
        $ProMemberHob12 = $ProMemberHob12." - ";
    }
    if ($ProMemberHob13 != "") {
        $ProMemberHob13 = $ProMemberHob13." - ";
    }	
    if ($ProMemberHob14 != "") {
        $ProMemberHob14 = $ProMemberHob14." - ";
    }		
    if ($ProMemberHob15 != "") {
        $ProMemberHob15 = $ProMemberHob15." - ";
    }		
    if ($ProMemberHob16 != "") {
        $ProMemberHob16 = $ProMemberHob16." - ";
    }
    if ($ProMemberHob17 != "") {
        $ProMemberHob17 = $ProMemberHob17." - ";
    }
    if ($ProMemberHob18 != "") {
        $ProMemberHob18 = $ProMemberHob18." - ";
    }	
    if ($ProMemberHob19 != "") {
        $ProMemberHob19 = $ProMemberHob19." - ";
    }		
    if ($ProMemberHob20 != "") {
        $ProMemberHob20 = $ProMemberHob20." - ";
    }		
    if ($ProMemberHob21 != "" ) {
        $ProMemberHob21 = $ProMemberHob21." - ";
    }
    if ($ProMemberHob22 != "") {
        $ProMemberHob22 = $ProMemberHob22." - ";
    }
    if ($ProMemberHob23 != "") {
        $ProMemberHob23 = $ProMemberHob23." - ";
    }	
    if ($ProMemberHob24 != "") {
        $ProMemberHob24 = $ProMemberHob24." - ";
    }		
    if ($ProMemberHob25 != "") {
        $ProMemberHob25 = $ProMemberHob25." - ";
    }		
    if ($ProMemberHob26 != "") {
        $ProMemberHob26 = $ProMemberHob26." - ";
    }
    if ($ProMemberHob27 != "") {
        $ProMemberHob27 = $ProMemberHob27." - ";
    }
    if ($ProMemberHob28 != "") {
        $ProMemberHob28 = $ProMemberHob28." - ";
    }	
    if ($ProMemberHob29 != "") {
        $ProMemberHob29 = $ProMemberHob29." - ";
    }		
    if ($ProMemberHob30 != "") {
        $ProMemberHob30 = $ProMemberHob30." - ";
    }		
    if ($ProMemberHob31 != "") {
        $ProMemberHob31 = $ProMemberHob31." - ";
    }
    if ($ProMemberHob32 != "") {
        $ProMemberHob32 = $ProMemberHob32." - ";
    }
    if ($ProMemberHob33 != "") {
        $ProMemberHob33 = $ProMemberHob33." - ";
    }	
    if ($ProMemberHob34 != "" && $ProMemberHob35 != "") {
        $ProMemberHob34 = $ProMemberHob34." - ";
    }
	
	
echo'
	<div class="box_head_wide_ff">
	';if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_hob"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
'.$lang['member']['the_hobbies'].'</div>
<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$ProMemberHob1.$ProMemberHob2.$ProMemberHob3.$ProMemberHob4.$ProMemberHob5.$ProMemberHob6.$ProMemberHob7.$ProMemberHob8.$ProMemberHob9.$ProMemberHob10.$ProMemberHob11.$ProMemberHob12.$ProMemberHob13.$ProMemberHob14.$ProMemberHob15.$ProMemberHob16.$ProMemberHob17.$ProMemberHob18.$ProMemberHob19.$ProMemberHob20.$ProMemberHob21.$ProMemberHob22.$ProMemberHob23.$ProMemberHob24.$ProMemberHob25.$ProMemberHob26.$ProMemberHob27.$ProMemberHob28.$ProMemberHob29.$ProMemberHob30.$ProMemberHob31.$ProMemberHob32.$ProMemberHob33.$ProMemberHob34.$ProMemberHob35.'</td></tr></tbody></table>
</div>
';
}
elseif($ProMemberHobby == 0){ 
echo'
<div class="box_head_wide_ff">
	'; if(($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {
		echo'
	&nbsp;<a href="index.php?mode=member&id='.$ProMemberID.'&app=edit_hob"><img border="0" src="./profile/add.jpg"></a>&nbsp;
	';}
	echo'
'.$lang['member']['the_hobbies'].'</div>
<div class="box_content_wide_ff" id="aj_bio">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tbody><tr>
<td class="box_content_wide" style="padding:4px;">
'.$lang['member']['no_this'].'</td></tr></tbody></table>
</div>
';	
}
}


if ($app == "insert_hob" && ($ProMemberID == $DBMemberID or $Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1) && $ProMemberID != 1)) {

    if ($ProMemberID > 0) {

$user_hob1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob1"]));
$user_hob2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob2"]));
$user_hob3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob3"]));
$user_hob4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob4"]));
$user_hob5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob5"]));
$user_hob6 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob6"]));
$user_hob7 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob7"]));
$user_hob8 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob8"]));
$user_hob9 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob9"]));
$user_hob10 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob10"]));
$user_hob11 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob11"]));
$user_hob12 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob12"]));
$user_hob13 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob13"]));
$user_hob14 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob14"]));
$user_hob15 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob15"]));
$user_hob16 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob16"]));
$user_hob17 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob17"]));
$user_hob18 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob18"]));
$user_hob19 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob19"]));
$user_hob20 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob20"]));
$user_hob21 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob21"]));
$user_hob22 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob22"]));
$user_hob23 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob23"]));
$user_hob24 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob24"]));
$user_hob25 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob25"]));
$user_hob26 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob26"]));
$user_hob27 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob27"]));
$user_hob28 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob28"]));
$user_hob29 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob29"]));
$user_hob30 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob30"]));
$user_hob31 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob31"]));
$user_hob32 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob32"]));
$user_hob33 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob33"]));
$user_hob34 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob34"]));
$user_hob35 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hob35"]));

			$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
	
	if($error != "") {

header("Location: index.php?mode=member&id=".$ProMemberID."");

}

if ($error == "") {
		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
		if($user_hob1 != "" or $user_hob2 != "" or $user_hob3 != "" or $user_hob4 != "" or $user_hob5 != "" or $user_hob6 != "" or $user_hob7 != "" or $user_hob8 != "" or $user_hob9 != "" or $user_hob10 != "" or $user_hob11 != "" or $user_hob12 != "" or $user_hob13 != "" or $user_hob14 != "" or $user_hob15 != "" or $user_hob16 != "" or $user_hob17 != "" or $user_hob18 != "" or $user_hob19 != "" or $user_hob20 != "" or $user_hob21 != "" or $user_hob22 != "" or $user_hob23 != "" or $user_hob24 != "" or $user_hob25 != "" or $user_hob26 != "" or $user_hob27 != "" or $user_hob28 != "" or $user_hob29 != "" or $user_hob30 != "" or $user_hob31 != "" or $user_hob32 != "" or $user_hob33 != "" or $user_hob34 != "" or $user_hob35 != ""){
		$query .= "M_HOBBY = ('1'), ";
}elseif($user_hob1 == "" or $user_hob2 == "" or $user_hob3 == "" or $user_hob4 == "" or $user_hob5 == "" or $user_hob6 == "" or $user_hob7 == "" or $user_hob8 == "" or $user_hob9 == "" or $user_hob10 == "" or $user_hob11 == "" or $user_hob12 == "" or $user_hob13 == "" or $user_hob14 == "" or $user_hob15 == "" or $user_hob16 == "" or $user_hob17 == "" or $user_hob18 == "" or $user_hob19 == "" or $user_hob20 == "" or $user_hob21 == "" or $user_hob22 == "" or $user_hob23 == "" or $user_hob24 == "" or $user_hob25 == "" or $user_hob26 == "" or $user_hob27 == "" or $user_hob28 == "" or $user_hob29 == "" or $user_hob30 == "" or $user_hob31 == "" or $user_hob32 == "" or $user_hob33 == "" or $user_hob34 == "" or $user_hob35 == ""){
		$query .= "M_HOBBY = ('0'), ";
}
		$query .= "M_HOB1 = ('$user_hob1'), ";
		$query .= "M_HOB2 = ('$user_hob2'), ";
		$query .= "M_HOB3 = ('$user_hob3'), ";
		$query .= "M_HOB4 = ('$user_hob4'), ";
		$query .= "M_HOB5 = ('$user_hob5'), ";
		$query .= "M_HOB6 = ('$user_hob6'), ";
		$query .= "M_HOB7 = ('$user_hob7'), ";
		$query .= "M_HOB8 = ('$user_hob8'), ";
		$query .= "M_HOB9 = ('$user_hob9'), ";
		$query .= "M_HOB10 = ('$user_hob10'), ";
		$query .= "M_HOB11 = ('$user_hob11'), ";
		$query .= "M_HOB12 = ('$user_hob12'), ";
		$query .= "M_HOB13 = ('$user_hob13'), ";
		$query .= "M_HOB14 = ('$user_hob14'), ";
		$query .= "M_HOB15 = ('$user_hob15'), ";
		$query .= "M_HOB16 = ('$user_hob16'), ";
		$query .= "M_HOB17 = ('$user_hob17'), ";
		$query .= "M_HOB18 = ('$user_hob18'), ";
		$query .= "M_HOB19 = ('$user_hob19'), ";
		$query .= "M_HOB20 = ('$user_hob20'), ";
		$query .= "M_HOB21 = ('$user_hob21'), ";
		$query .= "M_HOB22 = ('$user_hob22'), ";
		$query .= "M_HOB23 = ('$user_hob23'), ";
		$query .= "M_HOB24 = ('$user_hob24'), ";
		$query .= "M_HOB25 = ('$user_hob25'), ";
		$query .= "M_HOB26 = ('$user_hob26'), ";
		$query .= "M_HOB27 = ('$user_hob27'), ";
		$query .= "M_HOB28 = ('$user_hob28'), ";
		$query .= "M_HOB29 = ('$user_hob29'), ";
		$query .= "M_HOB30 = ('$user_hob30'), ";
		$query .= "M_HOB31 = ('$user_hob31'), ";
		$query .= "M_HOB32 = ('$user_hob32'), ";
		$query .= "M_HOB33 = ('$user_hob33'), ";
		$query .= "M_HOB34 = ('$user_hob34'), ";
		$query .= "M_HOB35 = ('$user_hob35') ";
		$query .= "WHERE MEMBER_ID = ".$ProMemberID." ";
		DBi::$con->query($query) or die (DBi::$con->error);


header("Location: index.php?mode=member&id=".$ProMemberID."");

}
}

}



echo'

</td>
<td style="width:10px;">&nbsp;</td><td valign="top">';



if ($ProMemberLevel == 1 AND (profile_member_title($ppMemberID) != "" OR $ProMemberOldMod > 0)) {
                    echo'

<div class="box_head_wide_ff">'.$lang['member']['your_titles_m'].'</div><font color="green">
<div class="box_content_wide_ff">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;">					
<font>'.old_mod($ppMemberID, "-1", "").''.profile_member_title($ppMemberID).''.market_title($ppMemberID).'</font>
</td></tr></tbody></table></div>
</font>
';
}

if ($ProMemberLevel == 2 AND profile_moderator_title($ppMemberID) != "") {
                    echo'

<div class="box_head_wide_ff">'.$lang['member']['your_titles_m'].'</div><font color="green">
<div class="box_content_wide_ff">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;">					
<font>'.profile_moderator_title($ppMemberID).''.market_title($ppMemberID).'</font>
</td></tr></tbody></table></div>
</font>
';
}

if ($ProMemberLevel == 3 AND $ProMemberDeputy == 0 AND profile_monitor_title($ppMemberID) != "") {
                    echo'

<div class="box_head_wide_ff">'.$lang['member']['your_titles_m'].'</div><font color="green">
<div class="box_content_wide_ff">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;">					
<font>'.profile_monitor_title($ppMemberID).''.market_title($ppMemberID).'</font>
</td></tr></tbody></table></div>
</font>
';
}

if ($ProMemberLevel == 3 AND $ProMemberDeputy == 1 AND profile_deputy_monitor_title($ppMemberID) != "") {
                    echo'

<div class="box_head_wide_ff">'.$lang['member']['your_titles_m'].'</div><font color="green">
<div class="box_content_wide_ff">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;">					
<font>'.profile_deputy_monitor_title($ppMemberID).''.market_title($ppMemberID).'</font>
</td></tr></tbody></table></div>
</font>
';
}
                   
if ($ProMemberLevel == 4) {
                    echo'

<div class="box_head_wide_ff">'.$lang['member']['your_titles_m'].'</div><font color="green">
<div class="box_content_wide_ff">
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;">					
<font>'.$lang['member']['admin_site'].'</font>
</td></tr></tbody></table></div>
</font>
					';
}

								echo'


<div class="box_head_wide_ff">'.$lang['member']['last_topics'].'</div>
<div class="box_content_wide_ff" style="padding:4px;">

';
$sql1 = DBi::$con->query("SELECT * FROM ".prefix."TOPICS AS T INNER JOIN ".prefix."FORUM AS F ON (T.FORUM_ID = F.FORUM_ID) WHERE T.T_STATUS != '2' AND T.T_ARCHIVED = '0' AND T.T_HIDDEN = '0' and T.T_UNMODERATED = '0' and T.T_HOLDED = '0' and T.T_AUTHOR_MOD = '0' and T.T_AUTHOR = '".$ProMemberID."' and F.F_LEVEL = '0' AND F.F_HIDE = '0' ORDER BY T.T_DATE DESC LIMIT 4") or die(DBi::$con->error);
$num1 = mysqli_num_rows($sql1);
$x1 = 0;
if($x1 < $num1) {
      while ($x1 < $num1) {
      $topic_id = mysqli_result($sql1, $x1, "TOPIC_ID");
      $forum_id = mysqli_result($sql1, $x1, "FORUM_ID");
      $cat_id = forums("CAT_ID", $forum_id);
      $counts = mysqli_result($sql1, $x1, "T_COUNTS");
      $date = mysqli_result($sql1, $x1, "T_DATE");
      $replies = post_num($topic_id);
      $last_post = last_post_date($topic_id);
      $t_hidden = mysqli_result($sql1, $x1, "T_HIDDEN");
      $t_unmoderated = mysqli_result($sql1, $x1, "T_UNMODERATED");
      $t_holded = mysqli_result($sql1, $x1, "T_HOLDED");
      $f_level = forums("F_LEVEL", $forum_id);
      $c_level = cat("LEVEL", $cat_id);
      $f_hide = forums("HIDE", $forum_id);
      $c_hide = cat("HIDE", $cat_id);
      $topic_subject = topics("SUBJECT", $topic_id);
      $forum_subject = forums("SUBJECT", $forum_id);
	  $status = mysqli_result($sql1, $x1, "T_STATUS");
	  $check_forum_login = check_forum_login($forum_id);	
	  $check_cat_login = check_cat_login($cat_id);		


	
				  echo'
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;">
<div style="padding-top:2px;">
<a href="index.php?mode=f&f='.$forum_id.'">'.$forum_subject.'</a>
<br>';
	if ($status == 0 AND $replies < 20) {echo icons($folder_new_locked, $lang['forum']['topic_is_locked']);}
elseif ($status == 0 AND $replies >= 20) {echo icons($folder_new_locked, $lang['forum']['topic_is_hot_and_locked']);}
elseif ($status == 1 AND $replies < 20) {echo icons($folder_new);}
elseif ($status == 1 AND $replies >= 20) {echo icons($folder_new_hot, $lang['forum']['topic_is_hot']);}
else {echo icons($folder);}
echo'&nbsp;<a href="index.php?mode=t&t='.$topic_id.'">'.$topic_subject.'</a><br>
<span class="text_read_forum"></font></span><font size="-2" color="gray">'.normal_time($date).'</font><font size="2"  color="green"> - '.$lang['social']['read'].' '.$counts.' - '.$lang['social']['replies'].' '.$replies.'';
if($replies > 0) {echo'
- '.$lang['social']['last_reply'].' '.normal_time($last_post).'';
}
echo'
<hr size="1" noshade="" style="border-color:#CCC;margin-right:7px;margin-left:7px;"></font>
</div>

</font></td>
';



  
	  $x1++;
	  } 
	  
	  echo'</tr></tbody></table></div>';

	  
			  } else {
				  echo'
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;"><div class="no_Details">'.$lang['member']['no_details'].'</div></td></tr></tbody></table></div>
</font>
';
	  
			  }
			  
			  
			  
			  echo'
			  
			  
<div class="box_head_wide_ff">'.$lang['member']['blog'].'</div>
<div class="box_content_wide_ff" style="padding:4px;">

';

		 		$sqla = "SELECT * FROM ".prefix."TOPICS WHERE FORUM_ID = '$blog_forum' AND T_ARCHIVED = '0' and T_HIDDEN = '0' and T_UNMODERATED = '0' and T_HOLDED = '0' and T_AUTHOR = '".$ProMemberID."' ORDER BY T_DATE DESC LIMIT 1 ";

	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
	  		  if ($x < $numf) {

      while ($x < $numf) {
      $topic_id = mysqli_result($sqlf, $x, "TOPIC_ID");
      $forum_id = mysqli_result($sqlf, $x, "FORUM_ID");
      $counts = mysqli_result($sqlf, $x, "T_COUNTS");
      $date = mysqli_result($sqlf, $x, "T_DATE");
      $replies = post_num($topic_id);
      $message = mysqli_result($sqlf, $x, "T_MESSAGE");
      $message = str_replace("<br>", " ", $message);
	  $message = html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($message)))), ENT_COMPAT, 'UTF-8');	  
      $last_post = last_post_date($topic_id);
      $t_hidden = mysqli_result($sqlf, $x, "T_HIDDEN");
      $t_unmoderated = mysqli_result($sqlf, $x, "T_UNMODERATED");
      $t_holded = mysqli_result($sqlf, $x, "T_HOLDED");
      $f_level = forums("LEVEL", $forum_id);
      $f_hide = forums("HIDE", $forum_id);
      $topic_subject = topics("SUBJECT", $topic_id);
      $forum_subject = forums("SUBJECT", $forum_id);
	  $status = mysqli_result($sqlf, $x, "T_STATUS");
	  $check_forum_login = check_forum_login($forum_id);	  
	
				  echo'
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;">
<div style="padding-top:2px;">


&nbsp;<a href="index.php?mode=member&id='.$ppMemberID.'&prm=blog"><font size="3">'.$topic_subject.'</FONT></a><br>
<font color="gray">'.strip_tags(cutstr($message, 1000)).'...</font>
<span class="text_read_forum"></font></span>
<hr size="1" noshade="" style="border-color:#CCC;margin-right:7px;margin-left:7px;"></font>
</div>

</font></td>
';

  
	  $x++;
	  } 
	  
	  echo'</tr></tbody></table></div>';

	  
			  } else {
				  echo'
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_wide" style="padding:4px;"><div class="no_Details">'.$lang['member']['no_details'].'</div></td></tr></tbody></table></div>
</font>
';
	  
			  }


echo'
</td></tr></tbody></table>
</td><td>&nbsp;&nbsp;</td>
<td valign="top">';

if($Mlevel > 0) {

echo'

<div class="box_head_ff">';
if($DBMemberID == $ProMemberID) {
echo $lang['member']['your_tools'];
} elseif ($DBMemberID != $ProMemberID AND ($ProMemberSex == 0 or $ProMemberSex == 1)) {
	echo $lang['member']['social_with_member'];
} elseif ($DBMemberID != $ProMemberID AND $ProMemberSex == 2) {
	echo $lang['member']['social_with_member_f'];
}
echo'
</div><div class="box_content_ff"><table width="100%"><tbody>
<tr>
';if($DBMemberID == $ProMemberID) {
echo'
<td><a href="index.php?mode=pm&mail=m&m='.$ppMemberID.'"><img border="0" src="./profile/users_comments.png" border="0" title="'.$lang['member']['messages_with_your_member'].'"></a></td>
<td><a href="index.php?mode=posts&m='.$ppMemberID.'"><img border="0" src="./profile/pages.png" border="0" title="'.$lang['header']['your_posts'].'"></a></td>
<td><a href="index.php?mode=topics&m='.$ppMemberID.'"><img border="0" src="./profile/note_book.png" border="0" title="'.$lang['header']['your_topics'].'"></a></td>
';
} elseif ($DBMemberID != $ProMemberID AND ($ProMemberSex == 0 or $ProMemberSex == 1)) {
	echo'
<td><a href="index.php?mode=pm&mail=m&m='.$ppMemberID.'"><img border="0" src="./profile/users_comments.png" border="0" title="'.$lang['member']['messages_with_this_member'].'"></a></td>
<td><a href="index.php?mode=posts&m='.$ppMemberID.'"><img border="0" src="./profile/pages.png" border="0" title="'.$lang['member']['member_posts'].'"></a></td>
<td><a href="index.php?mode=topics&m='.$ppMemberID.'"><img border="0" src="./profile/note_book.png" border="0" title="'.$lang['member']['member_topics'].'"></a></td>';
if($ProMemberID != $DBMemberID && $Mlevel >= 2) {
echo'
<td><a href="index.php?mode=member&id='.$ProMemberID.'&app=invite_group"><img border="0" src="images/add_imageee.png" border="0" title="'.$lang['member']['send_invite_group'].'"></a></td>
';	
}
echo'
<td><a href="index.php?mode=list&type=add&c=-1&aid='.$ppMemberID.'"><img border="0" src="./profile/user_accept.png" border="0" title="'.$lang['member']['add_to_your_list'].'"></a></td>
<td><a href="index.php?mode=list&type=add&c=-2&aid='.$ppMemberID.'"><img border="0" src="./profile/delete_user.png" border="0" title="'.$lang['member']['block_this_member'].'"></a></td>
	';
} elseif ($DBMemberID != $ProMemberID AND $ProMemberSex == 2) {
	echo'
<td><a href="index.php?mode=pm&mail=m&m='.$ppMemberID.'"><img border="0" src="./profile/users_comments.png" border="0" title="'.$lang['member']['messages_with_this_member_f'].'"></a></td>
<td><a href="index.php?mode=posts&m='.$ppMemberID.'"><img border="0" src="./profile/pages.png" border="0" title="'.$lang['member']['member_posts_f'].'"></a></td>
<td><a href="index.php?mode=topics&m='.$ppMemberID.'"><img border="0" src="./profile/note_book.png" border="0" title="'.$lang['member']['member_topics_f'].'"></a></td>';
if($ProMemberID != $DBMemberID && $Mlevel >= 2) {
echo'
<td><a href="index.php?mode=member&id='.$ProMemberID.'&app=invite_group"><img border="0" src="images/add_imageee.png" border="0" title="'.$lang['member']['send_invite_group'].'"></a></td>
';	
}
echo'
<td><a href="index.php?mode=list&type=add&c=-1&aid='.$ppMemberID.'"><img border="0" src="./profile/user_accept.png" border="0" title="'.$lang['member']['add_to_your_list_f'].'"></a></td>
<td><a href="index.php?mode=list&type=add&c=-2&aid='.$ppMemberID.'"><img border="0" src="./profile/delete_user.png" border="0" title="'.$lang['member']['block_this_member_f'].'"></a></td>
	';	
}


if($ProMemberLevel == 4 AND $ProMemberID != $DBMemberID) {
	echo'
<td><a href="index.php?mode=sendpm&msg=1&m='.$ppMemberID.'"><img border="0" src="./profile/mail_send.png" border="0" title="'.$lang['member']['send_pm_to_admin'].'"></a></td>';
} elseif ($ProMemberID == $DBMemberID) {
echo'
<td><a href="index.php?mode=editor&method=sendmsg&m='.$ppMemberID.'"><img border="0" src="./profile/mail_send.png" border="0" title="'.$lang['member']['send_pm_to_you'].'"></a></td>';	
} elseif ($ProMemberLevel != 4 AND $ProMemberID != $DBMemberID AND ($ProMemberSex == 0 or $ProMemberSex == 1)) {
echo'
<td><a href="index.php?mode=editor&method=sendmsg&m='.$ppMemberID.'"><img border="0" src="./profile/mail_send.png" border="0" title="'.$lang['member']['send_pm_to_member'].'"></a></td>';
} elseif ($ProMemberLevel != 4 AND $ProMemberID != $DBMemberID AND $ProMemberSex == 2) {
echo'
<td><a href="index.php?mode=editor&method=sendmsg&m='.$ppMemberID.'"><img border="0" src="./profile/mail_send.png" border="0" title="'.$lang['member']['send_pm_to_member_f'].'"></a></td>';
}
if($Mlevel > 1) {
	if ($DBMemberID == $ProMemberID ) {
	echo'
<td><a href="index.php?mode=email_to_m&id='.$ppMemberID.'"><img border="0" height="30" src="./profile/email.png" border="0" title="'.$lang['member']['send_email_to_you'].'"></a></td>';	
}
	elseif ($DBMemberID != $ProMemberID AND ($ProMemberSex == 0 or $ProMemberSex == 1)) {
	echo'
<td><a href="index.php?mode=email_to_m&id='.$ppMemberID.'"><img border="0" height="30" src="./profile/email.png" border="0" title="'.$lang['member']['send_email_to_member'].'"></a></td>';	
}	elseif ($DBMemberID != $ProMemberID AND $ProMemberSex == 2) {
	echo'
<td><a href="index.php?mode=email_to_m&id='.$ppMemberID.'"><img border="0" height="30" src="./profile/email.png" border="0" title="'.$lang['member']['send_email_to_member_f'].'"></a></td>';	
}
}
echo'
</tr></tbody></table></div>';
}
if($app == "invite_group" && $ProMemberID != $DBMemberID) {
if($group == "") {	
if($ProMemberSex == 0 OR $ProMemberSex == 1) {
echo'
<div class="box_head_ff">'.$lang['member']['select_groups_to_invite_member'].'</div>
';
} elseif($ProMemberSex == 2) {
echo'
<div class="box_head_ff">'.$lang['member']['select_groups_to_invite_member_f'].'</div>
';
}
echo'
<div class="box_content_ff"><table width="100%">
<tr>

';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS WHERE G_MOD = '2' AND G_FORUM IN (".chk_allowed_forums_all_id().") ") or die (DBi::$con->error);			
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$g_id = mysqli_result($sql, $x, "G_ID");
				$g_name = groups("NAME", $g_id);
				$g_forum = groups("FORUM", $g_id);
				$g_forum_name = forums("SUBJECT", $g_forum);
				$g_status = groups("STATUS", $g_id);
				$g_points = groups("POINTS", $g_id);
			$sqll = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_GROUP = '$g_id' AND M_ID = '$ProMemberID' AND M_STATUS = '1' ") or die (DBi::$con->error);			
			$numm = mysqli_num_rows($sqll);				
				
				if($numm == 0) {
					
				echo'
				<center><font color="black"><u>'.$lang['member']['group_forum'].' '.$g_forum_name.'</u></font></center>
				
				<center><a href="index.php?mode=member&id='.$ProMemberID.'&app=invite_msg&group='.$g_id.'">'.$g_name.'</a></center>
				<br>
				';
				}
				
				
				++$x;
			}



echo'
</tr></table></div>
<div id="modal"></div>';
}
}


if($app == "invite_msg" && $group != "" && $ProMemberID != $DBMemberID) {	
if($group != "") {	
$g_name = groups("NAME", $group);
$g_forum = groups("FORUM", $group);
$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS WHERE G_ID = '$group'");
$num = mysqli_num_rows($sql);
if($num == 0) {
redirect();	
}
if($ProMemberSex == 0 OR $ProMemberSex == 1) {
echo'
<div class="box_head_ff">'.$lang['member']['select_groups_to_invite_member'].'</div>
';
} elseif($ProMemberSex == 2) {
echo'
<div class="box_head_ff">'.$lang['member']['select_groups_to_invite_member_f'].'</div>
';
}
if(allowed($g_forum, 2) == 1) {
echo'
<div class="box_content_ff"><table width="100%">
<tr>';

			$sqll = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_GROUP = '$group' AND M_ID = '$ProMemberID' AND M_STATUS = '1' ") or die (DBi::$con->error);							
			$numm = mysqli_num_rows($sqll);				
				
				if($numm == 0) {
echo'
<center><font color="red">'.$g_name.'</font></center>

<br>
<center><font color="red">'.$lang['member']['add_text_group'].'</font></center>


<form method="post" action="index.php?mode=member&id='.$ProMemberID.'&app=invite">
 <input value="'.$group.'" type="hidden" name="invite_group">
<center><textarea class="insidetitle" style="font-size:14px;margin: 0px; width: 270px; height: 197px;" name="invite_msg" type="text" rows="1" cols="20">
</textarea><br>
<input type="submit" value="'.$lang['member']['send_pm_group'].'">
&nbsp;&nbsp;&nbsp;<input type="reset" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&#39;;" value="'.$lang['member']['canecl_pm_group'].'">
</center></form>';
} else {
echo'
<br>
<center><font color="red">'.$lang['member']['cant_send_pm_group'].'</font></center>
<br>
';	
}
echo'
</tr></table></div>
<div id="modal"></div>';
} else {
redirect();	
}
}
}
if($app == "invite") {	
$invite_msg = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["invite_msg"]));
$group = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["invite_group"]));
$points = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["invite_points"]));
$g_name = groups("NAME", $group);
$g_forum = groups("FORUM", $group);
$g_forum_name = forums("SUBJECT", $g_forum);
$points = groups("POINTS", $group);
$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS WHERE G_ID = '$group'");
$num = mysqli_num_rows($sql);
if($num == 0) {
redirect();	
}
if(allowed($g_forum, 2) == 1) {
	

if($ProMemberSex == 0 OR $ProMemberSex == 1) {
echo'
<div class="box_head_ff">'.$lang['member']['select_groups_to_invite_member'].'</div>
';
} elseif($ProMemberSex == 2) {
echo'
<div class="box_head_ff">'.$lang['member']['select_groups_to_invite_member_f'].'</div>
';
}
		  echo'  
		 <div class="box_content_ff"><table width="100%">
<tr>';

$sql_invite = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_GROUP = '$group' AND M_ID = '$ProMemberID' AND M_STATUS = '4'");
$num_invite = mysqli_num_rows($sql_invite);

			$sqlll = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_GROUP = '$group' AND M_ID = '$ProMemberID' AND M_STATUS = '3' ") or die (DBi::$con->error);			
			$nummm = mysqli_num_rows($sqlll);

if($num_invite == 0 && $nummm == 0 && $points <= member_all_points($ProMemberID)) {
	$date = time();


$subject = ''.$lang['member']['group_subject_message'].' '.$g_name.'';
$message = ''.$lang['member']['group_message_part1'].' '.$g_forum_name.''.$lang['member']['group_message_part2'].' '.$g_name.'<br><br><font color="red">'.$invite_msg.'</font><br><br>'.$lang['member']['group_message_part3'].'<br><a href="index.php?mode=social&prm=groups&prd=group&id='.$group.'&app=invite&m='.$ProMemberID.'">'.$g_name.'</a>';

	$storePm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$storePm .= " '$ProMemberID', ";
	$storePm .= " '$ProMemberID', ";
	$storePm .= " '-$g_forum', ";
	$storePm .= " '$subject', ";
	$storePm .= " '$message', ";
	$storePm .= " '$date') ";
	DBi::$con->query($storePm) or die (DBi::$con->error);
	$query = "INSERT INTO ".prefix."GROUPS_MEMBERS (M_ID, M_GROUP, M_STATUS, M_FORUM, M_DATE, M_INVITE) VALUES (";
	$query .= " '$ProMemberID', ";
	$query .= " '$group', ";
	$query .= " '4', ";
	$query .= " '$g_forum', ";
	$query .= " '$date', ";
	$query .= " '1' ";
	$query .= " ) ";
	DBi::$con->query($query) or die (DBi::$con->error);


echo'			

<br><center><font color="red">'.$lang['member']['done_send_invite'].'</font></center><br>

';
}


if($nummm != 0) {
echo'			

<br><center><font color="red">'.$lang['member']['cant_send_to_block'].'</font></center>
<br>
';	
}
if($num_invite != 0) {
	echo'			

<br><center><font color="red">'.$lang['member']['cant_send_to_approve'].'</font></center>
<br>
';
}
if($points > member_all_points($ProMemberID)) {
echo'			

<br><center><font color="red">'.$lang['member']['cant_send_to_points'].'</font></center>
<br>

';	
}	
echo'
</tr></table></div>
<div id="modal"></div>
		 
<meta http-equiv="Refresh" content="2; URL=index.php?mode=member&id='.$ProMemberID.'">
 ';
} else {
redirect();	
}

}


if($Mlevel > 1) {
	echo'
<div class="box_head_ff">'.$lang['member']['moderations_tools'].'</div>
<div class="box_content_ff"><table width="100%">
';
if($ProMemberID == $DBMemberID) {
	echo'
	<tr>
	<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&method=award&svc=medals&m='.$ppMemberID.'">'.$lang['member']['do_medal_to_you'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&method=award&svc=titles&m='.$ppMemberID.'">'.$lang['member']['do_title_to_you'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=medals&app=all&scope=all&days=all&m='.$ppMemberID.'">'.$lang['member']['details_your_medals'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=special_medals_points&app=all&scope=all&days=all&m='.$ppMemberID.'">'.$lang['member']['details_your_special_medals_points'].'</a></nobr></td>
				<td></td><td></td>

	</tr>
	<tr>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=titles&m='.$ppMemberID.'">'.$lang['member']['your_titles'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=requestmon&aid='.$ppMemberID.'">'.$lang['member']['requestmon_details'].'</a></nobr></td>	
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=notifylist&type=all&id='.$ppMemberID.'">'.$lang['member']['your_notify'].'</a></nobr></td>	
</tr>
	';		
}

elseif($ProMemberID != $DBMemberID AND ($ProMemberSex == 0 or $ProMemberSex == 1)) {
		echo'
		<tr>
	<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&method=award&svc=medals&m='.$ppMemberID.'">'.$lang['member']['do_medal_to_member'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&method=award&svc=titles&m='.$ppMemberID.'">'.$lang['member']['do_title_to_member'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=medals&app=all&scope=all&days=all&m='.$ppMemberID.'">'.$lang['member']['details_member_medals'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=special_medals_points&app=all&scope=all&days=all&m='.$ppMemberID.'">'.$lang['member']['details_member_special_medals_points'].'</a></nobr></td>
				<td></td><td></td>

	</tr>
	<tr>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=titles&m='.$ppMemberID.'">'.$lang['member']['member_titles'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=requestmon&aid='.$ppMemberID.'">'.$lang['member']['requestmon_details'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=notifylist&type=all&id='.$ppMemberID.'">'.$lang['member']['member_notify'].'</a></nobr></td>					
					';
				if(($Mlevel > 2 && $deputy == 0) AND $ProMemberLevel != 4 AND $ProMemberLevel != $Mlevel AND $ProMemberID != $DBMemberID) {
				echo'
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=add_ichraf&svc=add_mods&id='.$ppMemberID.'">'.$lang['member']['add_ichraf_member'].'</a></nobr></td>
				';
				}
				echo'
	</tr>
	';
	
}
elseif($ProMemberID != $DBMemberID AND $ProMemberSex == 2) {
		echo'
		<tr>
	<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&method=award&svc=medals&m='.$ppMemberID.'">'.$lang['member']['do_medal_to_member_f'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&method=award&svc=titles&m='.$ppMemberID.'">'.$lang['member']['do_title_to_member_f'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=medals&app=all&scope=all&days=all&m='.$ppMemberID.'">'.$lang['member']['details_member_medals_f'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=special_medals_points&app=all&scope=all&days=all&m='.$ppMemberID.'">'.$lang['member']['details_member_special_medals_points_f'].'</a></nobr></td>
				<td></td><td></td>

	</tr>
	<tr>				
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=svc&svc=titles&m='.$ppMemberID.'">'.$lang['member']['member_titles_f'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=requestmon&aid='.$ppMemberID.'">'.$lang['member']['requestmon_details'].'</a></nobr></td>
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=notifylist&type=all&id='.$ppMemberID.'">'.$lang['member']['member_notify_f'].'</a></nobr></td>	
							';
				if(($Mlevel > 2 && $deputy == 0) AND $ProMemberLevel != 4 AND $ProMemberLevel != $Mlevel AND $ProMemberID != $DBMemberID) {
				echo'
				<td class="optionsbar_menus"><nobr><a href="index.php?mode=add_ichraf&svc=add_mods&id='.$ppMemberID.'">'.$lang['member']['add_ichraf_member_f'].'</a></nobr></td>
				';
				}
				echo'	
	</tr>
	';
	
}

echo'
				<td></td><td></td>



</tr></table></div>
<div id="modal"></div>';
}

if(($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && ($CAN_SHOW_PM == 1 OR $CAN_CLOSE_M == 1 OR $CAN_OPEN_M == 1 OR $CAN_HOLDED_M == 1 OR $CAN_CHANGE_M == 1))) && $ProMemberID != 1) {
	echo'
<div class="box_head_ff">'.$lang['member']['admin_tools'].'</div>
<div class="box_content_ff"><table width="100%"><tbody>';
if(($Mlevel == 4 or ($Mlevel == 3 AND $deputy == 0 AND $CAN_SHOW_PM == 1)) && $ProMemberID != 1) {
		echo'
	<td class="optionsbar_menus"><a href="index.php?mode=pm&mail=show&id='.$ppMemberID.'"><nobr>'.$lang['member']['mon_pm'].'</nobr></a></td>
	';
	
}
if (($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_CLOSE_M == 1)) && $ProMemberID != 1 && $ProMemberStatus == 1){
echo'
<td class="optionsbar_menus"><a onclick="return confirm(\''.$lang['members']['you_are_sure_to_lock_this_member'].'\');" href="index.php?mode=lock&type=m&m='.$ppMemberID.'"><nobr>'.$lang['member']['lock_member'].'</nobr></a></td>';
}
if (($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_OPEN_M == 1)) && $ProMemberID != 1 && $ProMemberStatus == 0){
echo'
<td class="optionsbar_menus"><a onclick="return confirm(\''.$lang['members']['you_are_sure_to_open_this_member'].'\');" href="index.php?mode=open&type=m&m='.$ppMemberID.'" ><nobr>'.$lang['member']['open_member'].'</nobr></a></td>';
}
if (($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_HOLDED_M == 1)) && $ProMemberID != 1 && $ProMemberHolded == 0){
echo'<td class="optionsbar_menus"><a onclick="return confirm(\''.$lang['members_function']['holded_confirm'].'\');" href="index.php?mode=lock&type=hold&m='.$ppMemberID.'"><nobr>'.$lang['member']['hold_this_member'].'</nobr></a></td>';
}
if (($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_HOLDED_M == 1)) && $ProMemberID != 1 && $ProMemberHolded == 1){
echo'<td class="optionsbar_menus"><a onclick="return confirm(\''.$lang['members_function']['unholded_confirm'].'\');" href="index.php?mode=open&type=hold&m='.$ppMemberID.'"><nobr>'.$lang['member']['unhold_this_member'].'</nobr></a></td>';
}

if(($Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1)) && $ProMemberID != 1) {
if($ProMemberSex == 0 or $ProMemberSex == 1) {
				echo'<td class="optionsbar_menus"><a href="index.php?mode=profile&type=edit_user&id='.$ppMemberID.'"><nobr>'.$lang['member']['edit_member'].'</nobr></a></td>';

		} elseif($ProMemberSex == 2) {
				echo'<td class="optionsbar_menus"><a href="index.php?mode=profile&type=edit_user&id='.$ppMemberID.'"><nobr>'.$lang['member']['edit_member_f'].'</nobr></a></td>';

	}


		echo'
	<td class="optionsbar_menus"><a href="index.php?mode=profile&type=send_pass&id='.$ppMemberID.'"><nobr>'.$lang['others']['send_passowrd'].'</nobr></a></td>
	';	
	
}

echo'<td></td><td></td></tr><tr>';


if(($Mlevel == 4 or ($Mlevel == 3 && $CAN_CHANGE_M == 1)) && $ProMemberID != 1) {
		echo'
	<td class="optionsbar_menus"><a href="index.php?mode=editor&method=sig&id='.$ppMemberID.'"><nobr>'.$lang['others']['change_sig'].'</nobr></a></td>
	';
		echo'
	<td class="optionsbar_menus"><a href="index.php?mode=list&method=index&m='.$ppMemberID.'"><nobr>'.$lang['others']['member_list'].'</nobr></a></td>
	';		
	
	echo'
	<td class="optionsbar_menus"><a href="index.php?mode=svc&svc=ip&id='.$ppMemberID.'"><nobr>'.$lang['member']['list_login'].'</nobr></a></td>
	<td class="optionsbar_menus"><a href="index.php?mode=svc&svc=ip&type=info&id='.$ppMemberID.'"><nobr>'.$lang['member']['trys_login'].'</nobr></a></td>
	';
echo'<td class="optionsbar_menus"><a href="index.php?mode=ip&ip='.$ProMemberIP.'"><nobr>'.$lang['member']['this_ip'].'</nobr></a></td>';
}
echo'<td></td><td></td></tr><tr>';
if ($Mlevel > 2 && $deputy == 0 && $ProMemberID != 1) {
echo'<td class="optionsbar_menus"><a href="index.php?mode=profile&id='.$ppMemberID.'&type=requestmon"><nobr>'.$lang['member']['apply_req'].'</nobr></a></td>';
}
if($Mlevel == 4 && $ProMemberID != 1) {
echo'
<td class="optionsbar_menus"> <a href="index.php?mode=delete&type=m&m='.$ppMemberID.'" onclick="return confirm(\''.$lang['members']['you_are_sure_to_delete_this_member'].'\');">'.$lang['member']['delete_member'].'</a>';}

if ($Mlevel == 4 && $ProMemberID != 1) {
echo'<td class="optionsbar_menus"><a href="index.php?mode=quick&m='.$ppMemberID.'"><nobr>'.$lang['member']['speed_tools'].'</nobr></a></td>';
}



if($Mlevel == 4 && $ProMemberID != 1) {
echo'<td class="optionsbar_menus"><a href="index.php?mode=svc&method=svc&svc=search&id='.$ppMemberID.'"><nobr>'.$lang['member']['search_list'].'</nobr></a></td>';
}
if($Mlevel == 4 && $ProMemberID != 1){ 
	if($ProMemberID == $DBMemberID) {
		echo'<td class="optionsbar_menus"><a href="index.php?mode=details&id='.$ppMemberID.'"><nobr>'.$lang['member']['stat_member'].'</nobr></a></td>';
	} elseif($ProMemberID != $DBMemberID AND ($ProMemberSex == 0 or $ProMemberSex == 1)) {
				echo'<td class="optionsbar_menus"><a href="index.php?mode=details&id='.$ppMemberID.'"><nobr>'.$lang['member']['stat_this_member'].'</nobr></a></td>';

		} elseif($ProMemberID != $DBMemberID AND $ProMemberSex == 2) {
				echo'<td class="optionsbar_menus"><a href="index.php?mode=details&id='.$ppMemberID.'"><nobr>'.$lang['member']['stat_this_member_f'].'</nobr></a></td>';

	}


echo'</tr><tr>';
if ($ProMemberID != 1) {
echo'<td class="optionsbar_menus"><a href="index.php?mode=permission&id='.$ppMemberID.'"><nobr>'.$lang['member']['change_permission'].'</nobr></a></td>';
}
if ($Mlevel == 4 && $ProMemberID != 1 && $DBMemberID == 1) {
echo'<td class="optionsbar_menus"><a href="index.php?mode=member&prm=login&id='.$ppMemberID.'"><nobr>'.$lang['member']['login_with_this_member'].'</nobr></a></td>';
}
}
echo'
<td></td><td></td>
</tr>
<tr>';






echo'<td></td><td></td></tr>

</tbody></table>
</div>
<div id="modal"></div>
';
}

echo'


<div id="modal"></div>



<div style="background-image:url(./profile/points.png);width:300px;height:66px;vertical-align:middle;
                   text-align:center;font-weight:bold;font-size:32px;padding-top:34px;
                   padding-bottom:0px;margin-bottom:10px;"><font color="black">'.$lang['topics']['points'].' 
				   ';if (member_all_points($ppMemberID) == 0){echo'0';}else{echo'
				   '.member_all_points($ppMemberID).'';}echo'</font></div>';
				   if(member_all_special_points($ppMemberID) != 0) {
					 echo'
					 <div style="background-image:url(./profile/points.png);width:300px;height:66px;vertical-align:middle;
                   text-align:center;font-weight:bold;font-size:32px;padding-top:34px;
                   padding-bottom:0px;margin-bottom:10px;"><font color="black">'.$lang['member']['special_points'].'
				   ';if (member_all_special_points($ppMemberID) == 0){echo'0';}else{echo'
				   '.member_all_special_points($ppMemberID).'';}echo'</font></div>
					 ';
				   }
				   echo'
<div class="box_head_ff">'.$lang['member']['statics'].'</div>
<div class="box_content_ff">
<table><tbody>';
if($Mlevel == 4) {
echo'
<tr>
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['member']['views'].'</font></td>
<td width="100%"><font color="black">'.$ProMemberView.'</font></td></tr>
';
}
if($Mlevel > 1) {
if($ProMemberStatus == 0) {
$sql = DBi::$con->query("SELECT * FROM ".prefix."MODERATION WHERE M_MEMBERID = '$ProMemberID' AND M_TYPE = '5' AND M_STATUS = '1'");
$num = mysqli_num_rows($sql);
if($num > 0) {
$rs = mysqli_fetch_array($sql);
$the_closer = link_profile(member_name($rs['M_ADDED']), $rs['M_ADDED']);
$the_raison = $rs['M_RAISON'];
$the_date = normal_time($rs['M_DATE']);
}	
echo'
<tr>
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['member']['member_status'].'</font></td>
<td width="100%"><font color="red">'.$lang[lock][close].'</font></td></tr>
<tr>
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang[lock][closer].'</font></td>
<td width="100%"><font color="black">'.$the_closer.'</font></td></tr>
<tr>
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang[lock][date].':</font></td>
<td width="100%"><font color="black">'.$the_date.'</font></td></tr>';
}	
if($ProMemberHolded == 1) {
	echo'
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['member']['member_status'].'</font></td>
<td width="100%"><font color="red">'.$lang['member']['this_is_holded'].'</font></td></tr>
<tr>
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['member']['holded_by'].'</font></td>
<td width="100%"><font color="black">'.link_profile(member_name($ProMemberHoldedBy), $ProMemberHoldedBy).'</font></td></tr>
<tr>
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['member']['holded_date'].'</font></td>
<td width="100%"><font color="black">'.normal_time($ProMemberHoldedDate).'</font></td></tr>';
}
echo'
<tr>
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['profile']['member_id'].'</font></td>
<td width="100%"><font color="black">'.$ppMemberID.'</font></td></tr>
';
}
echo'
<tr>
<td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['profile']['number_posts'].'</font></td>
<td width="100%"><font color="black">'.$ProMemberPosts.'</font></td></tr>';
if($active_market == 1) {
echo'	
<tr><td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['member']['dollar'].'</font></td>
<td width="100%"><font color="black">'.$ProMemberDollar.' '.$dollar_cur.'</font></td></tr>
';
}
echo'
<tr><td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['profile']['rejister_date'].'</font></td>
<td width="100%"><font color="black">'.normal_time($ProMemberDate).'</font></td></tr>';
if($ProMemberLevel < 3 or ($ProMemberLevel > 2 && $Mlevel >= $ProMemberLevel)) {
			if ($Mlevel > 1) {
				if (!empty($ProMemberLastHereDate)){
					echo'
<tr><td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['profile']['last_visit'].'</font></td>
<td width="100%"><font color="black">'.normal_time($ProMemberLastHereDate).'</font></td></tr>';
				}
			}
						else{
				if (!empty($ProMemberLastHereDate) AND $ProMemberBrowse == 1){
					echo'
<tr><td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['profile']['last_visit'].'</font></td>
<td width="100%"><font color="black">'.normal_time($ProMemberLastHereDate).'</font></td></tr>';
					
				}
						}
				if (!empty($ProMemberLastPostDate)){						
						echo'
						<tr><td align="left" nowrap="" valign="top"><font color="305C67">'.$lang['profile']['last_post'].'</font></td>
<td width="100%"><font color="black">'.normal_time($ProMemberLastPostDate).'</font></td></tr>';
}
}
echo'
</tbody></table></div>
';
if ($CHMemberID != "") {
	if($ProMemberID == $DBMemberID) {
	echo'
<div class="box_head_ff">'.$lang['profile']['member_last_name'].'</div>
	';
	}
		elseif($ProMemberID != $DBMemberID AND ($ProMemberSex == 0 or $ProMemberSex == 1)) {
	echo'
<div class="box_head_ff">'.$lang['profile']['member_last_name'].'</div>
	';
	}
			elseif($ProMemberID != $DBMemberID AND $ProMemberSex == 2) {
	echo'
<div class="box_head_ff">'.$lang['member']['member_last_name_f'].'</div>
	';
	}
	echo'
<div class="box_content_ff">
<table><tbody>';

	
	$query = "SELECT * FROM " . $Prefix . "CHANGENAME_PENDING WHERE MEMBERID = '" .$ppMemberID."' AND UNDERDEMANDE = '0' ";
 $query .= " ORDER BY CH_DATE DESC";
 $result = DBi::$con->query($query) or die (DBi::$con->error);
 $num = mysqli_num_rows($result);
 $i=0;
 while ($i < $num) {
    $CH_NameID = mysqli_result($result, $i, "CHNAME_ID");
    $CH_OriginalName = mysqli_result($result, $i, "LAST_NAME");
    $CH_Date = mysqli_result($result, $i, "CH_DATE");
		echo'
<tr><td align="left" nowrap="" valign="top"><font color="305C67">'.normal_date($CH_Date).':</font></td>
<td width="100%"><font color="black">'.$CH_OriginalName.'</font></td></tr>';
	
	++$i;
}

	echo'
</tbody></table></div>';
}

	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."MEDALS WHERE MEMBER_ID = '$ppMemberID' AND STATUS = '1' AND SPECIAL_TYPE != '2' ORDER BY DATE DESC LIMIT 2 ") or die(DBi::$con->error);
	$sqlall = DBi::$con->query("SELECT * FROM ".$Prefix."MEDALS WHERE MEMBER_ID = '$ppMemberID' AND STATUS = '1' AND SPECIAL_TYPE != '2' ORDER BY DATE DESC  ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$numall = mysqli_num_rows($sqlall);
	
	if ($num > 0){
				if($ProMemberSex == 0 or $ProMemberSex == 1) {
	echo'
<div class="box_head_ff">'.$lang['member']['your_medals'].'<span class="sub_text_background">&nbsp;'.$numall.'</span></div>
	';
	}
			elseif($ProMemberSex == 2) {
	echo'
<div class="box_head_ff">'.$lang['member']['your_medals_f'].'<span class="sub_text_background">&nbsp;'.$numall.'</span></div>
	';
	}
echo'
<div class="box_content_ff"><div style="padding-top:10px;">';
		$count = 0;
		$x = 0;
		while($x < $num){
			$m = mysqli_result($sql, $x, "MEDAL_ID");
			$gm_id = medals("GM_ID", $m);
			$url = medals("URL", $m);
			$f = medals("FORUM_ID", $m);
			$subject = gm("SUBJECT", $gm_id);
			$date = medals("DATE", $m);
			echo'
<div style="float:right">
'.icons($url).'</div>
<div class="div_medals">
<span style="color:#F03;">'.forums("SUBJECT", $f).'<br>'.$subject.'<br></span>
<span class="span_medals">'.normal_date($date).'<br>
</span>';
$three_medals = $three_medals + 1;
			if ($three_medals == 1){
				echo'
				
				</div>
<div>';
					$three_medals = 0;
			}
			$count += 1;
		++$x;
	
		echo'

<div style="clear:both"></div></div>
';
}
echo'<hr size="1" noshade="" style="border-color:#CCC;margin-right:7px;margin-left:7px;">
<div class="more_Details"><a href="index.php?mode=member&id='.$ppMemberID.'&prm=medal">'.$lang['member']['see_all'].' &gt;</a></div>
</div></div></div>';
} else {
	
	echo'<div style="clear:both"></div>';
				if($ProMemberSex == 0 or $ProMemberSex == 1) {
	echo'
<div class="box_head_ff">'.$lang['member']['your_medals'].'<span class="sub_text_background">&nbsp;'.$numall.'</span></div>
	';
	}
			elseif($ProMemberSex == 2) {
	echo'
<div class="box_head_ff">'.$lang['member']['your_medals_f'].'<span class="sub_text_background">&nbsp;'.$numall.'</span></div>
	';
	}		
echo'	
<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_ff" style="padding:4px;"><div class="no_Details">'.$lang['member']['no_details'].'</div></td></tr></tbody></table></div>
</font>
';
	
}
	$sql1all = DBi::$con->query("SELECT * FROM ".$Prefix."GROUPS_MEMBERS AS G INNER JOIN ".$Prefix."FORUM AS F ON (G.M_FORUM = F.FORUM_ID) WHERE G.M_ID = '$ppMemberID' AND G.M_STATUS = '1' AND F.F_LEVEL = '0' AND F.F_HIDE = '0' LIMIT 4 ") or die(DBi::$con->error);
	$sqlnum = mysqli_num_rows($sql1all);
	if($sqlnum > 0){
			echo'
			<div class="box_head_ff">';
			if($ProMemberSex == 0 or $ProMemberSex == 1) {
			echo $lang['member']['your_groups'];
			}
			if($ProMemberSex == 2) {
			echo $lang['member']['your_groups_f'];
			}
			echo'
			<span class="sub_text_background">'.$sqlnum.'</span></div>';
			echo'
			<div class="box_content_ff"><div style="padding-top:10px;"><center>
			<table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="270"><tbody><tr></tr>';
			while($row=mysqli_fetch_array($sql1all)){
				$g_id = $row["M_GROUP"];
				$g_frm = groups("FORUM",$g_id);
				$g_frmname = forums("SUBJECT",$g_frm);
				$g_name = groups("NAME",$g_id);
				$g_img = groups("IMG",$g_id);
				echo'
				<tr><td class="box_plaques" valign="top">
				<div style="float:right">
				<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'">
				<img border="0" src="'.$g_img.'" onerror="this.src=\''.$icon_folder.'\';" border="0" height="64" width="86"></a>&nbsp;
				</div>
				<div class="div_groups"><font style="font-size:18px;">
				<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'">'.$g_name.'</a></font><br>
				<a href="index.php?mode=f&f='.$g_frm.'">'.$g_frmname.'</a></div>
				</td></tr>
				';
			}
			echo'</tbody></table>';
			echo'<div class="more_Details"><a href="index.php?mode=member&id='.$ppMemberID.'&prm=groups&prd=cur">'.$lang['member']['see_all_groups'].' &gt;&gt;</a></div></div></div>';
	}
	else{
		echo'<div style="clear:both"></div>';
		echo'
		<div class="box_head_ff">';
			if($ProMemberSex == 0 or $ProMemberSex == 1) {
			echo $lang['member']['your_groups'];
			}
			if($ProMemberSex == 2) {
			echo $lang['member']['your_groups_f'];
			}
			echo'
		<span class="sub_text_background">&nbsp;0</span></div>';	
		echo'	
		<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_ff" style="padding:4px;"><div class="no_Details">'.$lang['member']['no_details'].'</div></td></tr></tbody></table></div>
		</font>';
	}
echo'
<div class="box_head_ff" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&amp;prm=sig&#39;;">'.$lang['member']['your_sig'].'</div>';
if($ProMemberSig != "") {
	echo'

<div class="box_content_ff" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&amp;prm=sig&#39;;">
<div class="sigwrap" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&amp;prm=sig&#39;;">
<div class="sigblock" onmouseover="this.style.cursor=&#39;hand&#39;;" onclick="location.href=&#39;index.php?mode=member&amp;id='.$ProMemberID.'&amp;prm=sig&#39;;">
<p><span color="#0000ff">'.$ProMemberSig.'</span></p>
</div></div></div>';
} else {
	echo'
			<table cellpadding="0" cellspacing="0" style="table-layout:fixed;"><tbody><tr><td class="box_content_ff" style="padding:4px;"><div class="no_Details">'.$lang['other']['unknown'].'</div></td></tr></tbody></table></div>
</font>
	';
}
echo'
</td></tr></tbody></table></td></tr><tr><td></td></tr></tbody></table>


</body></html>
';
	
}
if($prm == "sig") {
	
	echo'

<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	</a></div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br><td class="subtab">
<a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['groups'].'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>';

echo'
';
if($ProMemberID == $DBMemberID or $Mlevel > 2) {
if($ProMemberID == $DBMemberID) {
$theid = "";	
}	
else if($ProMemberID != $DBMemberID && $Mlevel > 2) {
$theid = "&id=".$ProMemberID."";	
}
	echo'<td><a href="index.php?mode=editor&method=sig'.$theid.'"><img border="0" src="./profile/page_process.png"></a></td>
';
}
echo'
</tr>
</tbody>
</table>

</div>	


			</tr>
			
			</tbody></table>
			';
			if($ProMemberSig != "") {
				echo'
				 <center>
				 <table width="88.8%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="8%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['sig'].'</div></center>
<center>
<div class="page_contenttt">
	<center>
<center>'.$ProMemberSig.'</center>
</center></div></center>';
			} else {
				echo'
				 <center>
				 <table width="88.8%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="8%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['sig'].'</div></center>
<center>
<div class="page_contenttt">
	<center>'.$lang['member']['no_this_here'].'</center></div></center>';
			}
			echo'
</body></html>

</font>
</td>
</tr>
</tbody>
</table>
';
	
}

if($prm == "blog") {
	echo'
	
	<html>';
	
		 		$sqla = "SELECT * FROM ".prefix."TOPICS WHERE FORUM_ID = '$blog_forum' AND T_ARCHIVED = '0' and T_HIDDEN = '0' and T_UNMODERATED = '0' and T_HOLDED = '0' and T_AUTHOR = '".$ProMemberID."' ORDER BY T_DATE DESC LIMIT 1 ";
	
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
	  		  if ($x < $numf) {

      while ($x < $numf) {
      $topic_id = mysqli_result($sqlf, $x, "TOPIC_ID");
      $forum_id = mysqli_result($sqlf, $x, "FORUM_ID");
      $counts = mysqli_result($sqlf, $x, "T_COUNTS");
      $date = mysqli_result($sqlf, $x, "T_DATE");
      $replies = post_num($topic_id);
      $message = mysqli_result($sqlf, $x, "T_MESSAGE");
	  $message = html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($message)))), ENT_COMPAT, 'UTF-8');
      $last_post = last_post_date($topic_id);
      $t_hidden = mysqli_result($sqlf, $x, "T_HIDDEN");
      $t_unmoderated = mysqli_result($sqlf, $x, "T_UNMODERATED");
      $t_holded = mysqli_result($sqlf, $x, "T_HOLDED");
      $f_level = forums("LEVEL", $forum_id);
      $f_hide = forums("HIDE", $forum_id);
      $topic_subject = topics("SUBJECT", $topic_id);
      $forum_subject = forums("SUBJECT", $forum_id);
	  $status = mysqli_result($sqlf, $x, "T_STATUS");
	  $cat_id = forums("CAT_ID", $forum_id);


	
				  echo'

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	
	</a>
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br><td class="subtab">
<a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['groups'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=f&f='.$blog_forum.'&auth='.$ProMemberID.'">'.$lang['member']['about_blog'].'</a></td>';

echo'
';
if($ProMemberID == $DBMemberID) {
	echo'<td><a href="index.php?mode=editor&method=edit&t='.$topic_id.'&f='.$forum_id.'&c='.$cat_id.'"><img border="0" src="./profile/page_process.png"></a></td>
';
}
echo'
</tr>
</tbody>
</table>				
				
	
	
			</tr></tbody></table>
				 <center> <table width="88.8%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="85%" class="contentarea">
<center><div class="page_headddd">
					'.$topic_subject.'</div></center>
<center>

<div class="page_contenttt">
	<center>';

	echo'
<center>'.$message.'</center>
</center></div></center>


';

		$sql = DBi::$con->query("SELECT * FROM ".prefix."COUNTS WHERE COUNT_MEMBER = '$DBMemberID' AND COUNT_TOPIC = '$topic_id'");
		$num = mysqli_num_rows($sql);
		
		if($num == 0 AND $Mlevel > 0) {
			DBi::$con->query ("INSERT INTO ".prefix."COUNTS (COUNT_MEMBER, COUNT_TOPIC) VALUES ('$DBMemberID', '$topic_id')") or die(DBi::$con->error);
		 DBi::$con->query("UPDATE ".prefix."TOPICS SET T_COUNTS = T_COUNTS + 1  WHERE TOPIC_ID = '$topic_id' ") or die (DBi::$con->error);
		}
	  if($Mlevel == 0) {
			DBi::$con->query ("INSERT INTO ".prefix."COUNTS (COUNT_MEMBER, COUNT_TOPIC) VALUES ('0', '$topic_id')") or die(DBi::$con->error);
		 DBi::$con->query("UPDATE ".prefix."TOPICS SET T_COUNTS = T_COUNTS + 1  WHERE TOPIC_ID = '$topic_id' ") or die (DBi::$con->error);
		 }
  
	  $x++;
	  } 
	  

	  
			  } else {
				  echo'
				  
				 			
<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	
	</a>
</div></td></tr>
<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br><td class="subtab">
<a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups">'.$lang['member']['groups'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=f&f='.$blog_forum.'&auth='.$ProMemberID.'">'.$lang['member']['about_blog'].'</a></td>';

echo'
';
$blog_forum_cat = forums("CAT_ID", $blog_forum);
if($ProMemberID == $DBMemberID) {
	echo'<td><a href="index.php?mode=editor&method=topic&f='.$blog_forum.'&c='.$blog_forum_cat.'"><img border="0" src="./profile/add_page.png"></a></td>
';
}
echo'
</tr>
</tbody>
</table>				
				
</tr></tbody></table>

				 <center> <table width="88.8%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="86%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['blog'].'</div></center>
<center>

<div class="page_contenttt">
	<center>
<center>'.$lang['member']['no_this_here'].'</center>
</center></div></center>
</td></tr></tbody></table></div>

</font>
';
	  
			  }
			  echo'
			  </td></tr><tr><td></td></tr></tbody></table>

</body></html>
	';
}

if($prm == "groups") {
	echo'
	
	<html>';
$temy = 15;
	$sqlla = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID'";
	$sqllf = DBi::$con->query("".$sqlla."") or die (DBi::$con->error);	
    $nummf = mysqli_num_rows($sqllf);
	$sql0a = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '0' ";
	$sql0f = DBi::$con->query("".$sql0a."") or die (DBi::$con->error);	
    $num0f = mysqli_num_rows($sql0f);	
	$sql1a = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '1' ";
	$sql1f = DBi::$con->query("".$sql1a."") or die (DBi::$con->error);	
    $num1f = mysqli_num_rows($sql1f);	
	$sql2a = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '2' ";
	$sql2f = DBi::$con->query("".$sql2a."") or die (DBi::$con->error);	
    $num2f = mysqli_num_rows($sql2f);
	$sql3a = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '3' ";
	$sql3f = DBi::$con->query("".$sql3a."") or die (DBi::$con->error);	
    $num3f = mysqli_num_rows($sql3f);
	$sql4a = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '4' ";
	$sql4f = DBi::$con->query("".$sql4a."") or die (DBi::$con->error);	
    $num4f = mysqli_num_rows($sql4f);
	$sql5a = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '5' ";
	$sql5f = DBi::$con->query("".$sql5a."") or die (DBi::$con->error);	
    $num5f = mysqli_num_rows($sql5f);
	$sql6a = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '6' ";
	$sql6f = DBi::$con->query("".$sql6a."") or die (DBi::$con->error);	
    $num6f = mysqli_num_rows($sql6f);	
	$x = 0;
	
      
	  		 

	
				  echo'


<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	
	</a>
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br>';
if($nummf != 0 && $ProMemberID == $DBMemberID) {
	if($prd == "cur") {
echo'
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['your_now_groups'].' '.$num1f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=pending">'.$lang['member']['request_group'].' '.$num0f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=invite">'.$lang['member']['invite_to_group'].' '.$num4f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused_invite">'.$lang['member']['cant_invite_group'].' '.$num5f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=back_cur">'.$lang['member']['back_in_group'].' '.$num6f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=block">'.$lang['member']['blocked_to_group'].' '.$num3f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused">'.$lang['member']['refused_request_group'].' '.$num2f.'</a></td>
';
	}
	if($prd == "pending") {
echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['your_now_groups'].' '.$num1f.'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=pending">'.$lang['member']['request_group'].' '.$num0f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=invite">'.$lang['member']['invite_to_group'].' '.$num4f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused_invite">'.$lang['member']['cant_invite_group'].' '.$num5f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=back_cur">'.$lang['member']['back_in_group'].' '.$num6f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=block">'.$lang['member']['blocked_to_group'].' '.$num3f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused">'.$lang['member']['refused_request_group'].' '.$num2f.'</a></td>
';	}
	if($prd == "invite") {
echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['your_now_groups'].' '.$num1f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=pending">'.$lang['member']['request_group'].' '.$num0f.'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=invite">'.$lang['member']['invite_to_group'].' '.$num4f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused_invite">'.$lang['member']['cant_invite_group'].' '.$num5f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=back_cur">'.$lang['member']['back_in_group'].' '.$num6f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=block">'.$lang['member']['blocked_to_group'].' '.$num3f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused">'.$lang['member']['refused_request_group'].' '.$num2f.'</a></td>
';	}
	if($prd == "refused_invite") {
echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['your_now_groups'].' '.$num1f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=pending">'.$lang['member']['request_group'].' '.$num0f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=invite">'.$lang['member']['invite_to_group'].' '.$num4f.'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused_invite">'.$lang['member']['cant_invite_group'].' '.$num5f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=back_cur">'.$lang['member']['back_in_group'].' '.$num6f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=block">'.$lang['member']['blocked_to_group'].' '.$num3f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused">'.$lang['member']['refused_request_group'].' '.$num2f.'</a></td>
';	}
	if($prd == "back_cur") {
echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['your_now_groups'].' '.$num1f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=pending">'.$lang['member']['request_group'].' '.$num0f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=invite">'.$lang['member']['invite_to_group'].' '.$num4f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused_invite">'.$lang['member']['cant_invite_group'].' '.$num5f.'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=back_cur">'.$lang['member']['back_in_group'].' '.$num6f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=block">'.$lang['member']['blocked_to_group'].' '.$num3f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused">'.$lang['member']['refused_request_group'].' '.$num2f.'</a></td>
';	}
	if($prd == "block") {
echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['your_now_groups'].' '.$num1f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=pending">'.$lang['member']['request_group'].' '.$num0f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=invite">'.$lang['member']['invite_to_group'].' '.$num4f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused_invite">'.$lang['member']['cant_invite_group'].' '.$num5f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=back_cur">'.$lang['member']['back_in_group'].' '.$num6f.'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=block">'.$lang['member']['blocked_to_group'].' '.$num3f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused">'.$lang['member']['refused_request_group'].' '.$num2f.'</a></td>
';	}
	if($prd == "refused") {
echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['your_now_groups'].' '.$num1f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=pending">'.$lang['member']['request_group'].' '.$num0f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=invite">'.$lang['member']['invite_to_group'].' '.$num4f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused_invite">'.$lang['member']['cant_invite_group'].' '.$num5f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=back_cur">'.$lang['member']['back_in_group'].' '.$num6f.'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=block">'.$lang['member']['blocked_to_group'].' '.$num3f.'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=refused">'.$lang['member']['refused_request_group'].' '.$num2f.'</a></td>
';	}
} elseif ($nummf == 0 or $nummf != 0 or $ProMemberID != $DBMemberID) {
echo'
<td class="subtab">
<a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['groups'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>';
}	

echo'
</tr>
</tbody>
</table>				
				
	
	
			</tr></tbody></table>



		
		<tr><td width="8%" class="contentarea">
		<center><div class="page_headddd">'.$lang['member']['groups'].'</div></center>
		<div class="page_contenttt"><table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr>

		';
		$temy = 15;
			if($prd == "cur") {
	$sqla = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '1' LIMIT ".pg_limit($temy).", $temy ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);	
    $numf = mysqli_num_rows($sqlf);	
	$status = 1;
	}
	if($prd == "pending") {
	$sqla = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '0' LIMIT ".pg_limit($temy).", $temy ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);	
    $numf = mysqli_num_rows($sqlf);
	$status = 0;
	}
	if($prd == "invite") {
	$sqla = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '4' LIMIT ".pg_limit($temy).", $temy ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);	
    $numf = mysqli_num_rows($sqlf);
	$status = 4;
	}
	if($prd == "refused_invite") {
	$sqla = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '5' LIMIT ".pg_limit($temy).", $temy ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);	
    $numf = mysqli_num_rows($sqlf);
	$status = 5;
	}
	if($prd == "back_cur") {
	$sqla = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '6' LIMIT ".pg_limit($temy).", $temy ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);	
    $numf = mysqli_num_rows($sqlf);
	$status = 6;
	}
	if($prd == "block") {
	$sqla = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '3' LIMIT ".pg_limit($temy).", $temy ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);	
    $numf = mysqli_num_rows($sqlf);
	$status = 3;
	}
	if($prd == "refused") {
	$sqla = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ppMemberID' and M_STATUS = '2' LIMIT ".pg_limit($temy).", $temy ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);	
    $numf = mysqli_num_rows($sqlf);
	$status = 2;
	}	
	$x = 0;
	 if($x < $numf) {
	  while($x < $numf) {
	 
      $m_group = mysqli_result($sqlf, $x, "M_GROUP");
	  $m_group_name = groups("NAME", $m_group);
	  $m_group_img = groups("IMG", $m_group);
	  $m_group_status = groups("STATUS", $m_group);
	  $m_group_login = groups("LOGIN", $m_group);
	  $m_group_points = groups("POINTS", $m_group);
	  $m_group_forum = groups("FORUM", $m_group);
	  $m_group_forum_name = forums("SUBJECT", $m_group_forum);
	  $g_c = forums("CAT_ID", $m_group_forum);
	  $f_cat_level = cat("LEVEL", $g_c);
      $f_cat_hide = cat("HIDE", $g_c);
	  $check_cat_login = check_cat_login($g_c);
      $f_level = forums("F_LEVEL", $m_group_forum);
      $f_hide = forums("HIDE", $m_group_forum);
	  $check_forum_login = check_forum_login($m_group_forum);
	  if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {
  	  if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
      if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
	  if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){	  
			echo'
			<td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=social&prm=groups&prd=group&id='.$m_group.'">
<img border="0" src="'.$m_group_img.'" onerror="this.src=\''.$icon_folder.'\';" border="0" height="64" width="86">
</a>
</div>
<div class="div_medals"><font style="font-size:18px;"><a href="index.php?mode=social&prm=groups&prd=group&id='.$m_group.'">'.$m_group_name.'</a></font><br>
<a href="index.php?mode=f&f='.$m_group_forum.'">'.forums("SUBJECT",$m_group_forum).'</a><br></div>
<div style="float:left">';
if(groupJoined($DBMemberID,$m_group) == 1){
	echo'<img border="0" src="images/image.png" title="'.$lang['member']['you_are_member'].'">';
}
elseif(groupJoined($DBMemberID,$m_group) == 0 && $m_group_status == 2){
	echo'
<img border="0" src="images/image_lock.png" title="'.$lang['member']['group_locked'].'">';
}
elseif(groupJoined($DBMemberID,$m_group) == 0 && member_all_points($DBMemberID) >= $m_group_points && $m_group_login == 1  && $m_group_status == 0 && groupPending($DBMemberID,$m_group) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$m_group.'&request=3"><img border="0" src="images/add_imagee.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$m_group) == 0 && member_all_points($DBMemberID) >= $m_group_points && $m_group_login == 1  && $m_group_status == 0 && groupPending($DBMemberID,$m_group) == 1){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&request=4"><img border="0" src="images/image_waitt.png" title="'.$lang['member']['pending_request'].'"></a>';
}
elseif(groupJoined($DBMemberID,$m_group) == 0 && member_all_points($DBMemberID) >= $m_group_points && $m_group_login == 0  && $m_group_status == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$m_group.'&request=1"><img border="0" src="images/image_accept.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$m_group) == 0 && member_all_points($DBMemberID) >= $m_group_points && $m_group_login == 2  && $m_group_status == 0){
	echo'
<img border="0" src="images/image_invite.png" title="'.$lang['member']['invite_a_group'].'">';
}
elseif(groupJoined($DBMemberID,$m_group) == 0 && member_all_points($DBMemberID) < $m_group_points  && $m_group_status == 0){
	echo'
<img border="0" src="images/not_points.png" title="'.$lang['member']['points_a_group'].'">';
}
echo'<div class="group_count_small">'.countGroup($m_group).'</div></div></td>';
$three_groups = $three_groups + 1;
			if ($three_groups == 3){
				echo'
				
				</tr>
				<tr>
';
					$three_groups = 0;
			}
			$count += 1;
	  }
	  }
	  }
	  }
		 ++$x;
		 }
		 	echo'
<table width="100%"><tbody><tr>
';
	if($prd == "cur") {
	$status = 1;
	}
	if($prd == "pending") {
	$status = 0;
	}
	if($prd == "invite") {
	$status = 4;
	}
	if($prd == "refused_invite") {
	$status = 5;
	}
	if($prd == "back_cur") {
	$status = 6;
	}
	if($prd == "block") {
	$status = 3;
	}
	if($prd == "refused") {
	$status = 2;
	}
	$temy = 15;
	$sql = DBi::$con->query("SELECT count(*) FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$ProMemberID' AND M_STATUS = '$status'") or die (DBi::$con->error);
	$count = mysqli_result($sql, 0, "count(*)");		
	$cols = floor($count/$temy);
	$pg_next = $pg + 1;
	$pg_prev = $pg - 1;
	
	echo'
	
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd='.$prd.'&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($count <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd='.$prd.'&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd='.$prd.'&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table>
	';
echo'
</tr></tbody></table>
	';
	   	  } else {
		 echo''.$lang['member']['no_details'].''; 
	  }
			/*
			<td class="box_plaques" valign="top">
<div style="float:right"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=152"><img border="0" src="icon.aspx?u=241~fnideq" onerror="this.src=''.$icon_folder.'';" border="0" height="64" width="86"></a></div>
<div class="div_medals"><font style="font-size:18px;"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=152">رابطة محبّي الرسول صلّى الله عليه وسلّم</a></font><br>
<a href="f.aspx?f=241">الكتب والبرامج الإسلامية</a><br></div>
<div style="float:left"><img border="0" src="icons/q/48/image.png" alt="أنت عضو في المجموعة هذه حاليا"><div class="group_count_small">7191</div></div></td><td class="box_plaques" valign="top">
<div style="float:right"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=264"><img border="0" src="icon.aspx?u=119~billalstarr" onerror="this.src=''.$icon_folder.'';" border="0" height="64" width="86"></a></div>
			*/
			echo '</tr></tbody></table></tr>';
			
			
			echo'</tbody></div>';



  
	  $x++;
	  }

if($prm == "medal") {
	$temy = 15;
	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."MEDALS WHERE MEMBER_ID = '$ppMemberID' AND STATUS = '1' AND SPECIAL_TYPE != '2' ORDER BY DATE DESC LIMIT ".pg_limit($temy).", $temy ") or die(DBi::$con->error);
	$sqlall = DBi::$con->query("SELECT * FROM ".$Prefix."MEDALS WHERE MEMBER_ID = '$ppMemberID' AND STATUS = '1' AND SPECIAL_TYPE != '2' ORDER BY DATE DESC LIMIT ".pg_limit($temy).", $temy ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$numall = mysqli_num_rows($sqlall);
	$sqll = DBi::$con->query("SELECT COUNT(*) FROM ".prefix."MEDALS WHERE MEMBER_ID = '$ppMemberID' AND STATUS = '1' ") or die(DBi::$con->error);
	$sqlll = mysqli_result($sqll, 0, "COUNT(*)");
	$cols = floor($sqlll / $temy);
	$pg_prev = $pg - 1;
	$pg_next = $pg + 1;
	
	
	
				  echo'

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	
	</a>
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br><td class="subtab">
<a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['groups'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>
';

echo'
</tr>
</tbody>
</table>				
				
	';
			
			if ($num > 0){
echo'

<center> <table width="74%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="70%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['medals'].'</div></center>

<table width="88.5%" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td class="contentarea"><div class="page_contenttt">

<table width="100%" border="0" cellpadding="0" cellspacing="4" style="border-color:white;"><tbody><tr>
';
		$count = 0;
		$x = 0;
		while($x < $num){
			$m = mysqli_result($sql, $x, "MEDAL_ID");
			$gm_id = medals("GM_ID", $m);
			$url = medals("URL", $m);
			$f = medals("FORUM_ID", $m);
			$subject = gm("SUBJECT", $gm_id);
			$date = medals("DATE", $m);
			echo'
			
<td valign="top" class="box_plaques">
<div style="float:right">'.icons($url).'</div>
<div class="div_medals">'.forums("SUBJECT", $f).'<br>'.$subject.'
	<br>
<span class="span_medals">'.normal_date($date).'</span>
</div>
</td>';
$three_medals = $three_medals + 1;
			if ($three_medals == 3){
				echo'
				
				</tr>
				<tr>
';
					$three_medals = 0;
			}
			$count += 1;
		++$x;
	}
echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=medal&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($sqlll <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=member&id='.$ProMemberID.'&prm=medal&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=medal&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table></td>
	</tr>
	</tbody>
	</table>
	</table></td>
	</tr>
	</tbody>
	</table>
	</table>
	';


	

	} else {
		echo'
		 <center> <table width="83.2%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="86%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['medals'].'</div></center>
<center>

<div class="page_contenttt">
	<center>
<center>'.$lang['member']['no_this_here'].'</center>
</center></div></center>
</td></tr></tbody></table></div>

</font>
</td>
</tr>
</tbody>
</table>
		';
	}
	

	
	
	
	echo'
</center></html>
';
	
}

if($active_market == 1) {
	
if($prm == "market") {
if($prd == "") {
	
if($market == "") {	
	
	$temy = 15;
	if($Mod_Market == 1 OR $Mlevel == 4) {
	$mod_s_sql = "";
	} else {
	$mod_s_sql = "AND MOD_S = '1'";
	}
	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS_MARKET WHERE AUTHOR = '$ppMemberID' $mod_s_sql ORDER BY DATE DESC LIMIT ".pg_limit($temy).", $temy ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$sqll = DBi::$con->query("SELECT COUNT(*) FROM ".prefix."MEMBERS_MARKET WHERE AUTHOR = '$ppMemberID' $mod_s_sql ") or die(DBi::$con->error);
	$sqlll = mysqli_result($sqll, 0, "COUNT(*)");
	$cols = floor($sqlll / $temy);
	$pg_prev = $pg - 1;
	$pg_next = $pg + 1;

	
	
echo'
<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	
	</a>
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br>';
if($ProMemberID != $DBMemberID) {
	echo'
<td class="subtab">	
<a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['groups'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>
';
if($ProMemberID == $DBMemberID) {
	echo'<td><a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&prd=add"><img border="0" src="./profile/add_page.png"></a></td>
';
}
} else {
echo'
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market&prd=sales">'.$lang['member']['your_sales'].'</a></td>
';
if($ProMemberID == $DBMemberID) {
	echo'<td><a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&prd=add"><img border="0" src="./profile/add_page.png"></a></td>
';
}
}	
echo'
</tr>
</tbody>
</table>

			</tr></tbody></table>';
			
			if ($num > 0){
echo'

<center> <table width="74%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="70%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['market_m'].'</div></center>

<table width="88.5%" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td class="contentarea"><div class="page_contenttt">

<table width="100%" border="0" cellpadding="0" cellspacing="4" style="border-color:white;"><tbody><tr>
';
		$count = 0;
		$x = 0;
		while($x < $num){
			$id = mysqli_result($sql, $x, "ID");
			$name = market("NAME", $id);
			$description = market("DESCRIPTION", $id);
			$desc = strip_tags(cutstr($description, 40));
			$img = market("IMG", $id);
			$author = market("AUTHOR", $id);
			$date = market("DATE", $id);
			$customer = market("CUSTOMER", $id);
			$status = market("STATUS", $id);
			$buy_date = market("BUY_DATE", $id);
			$dollar = market("DOLLAR", $id);
			$buy_text = market("BUY_TEXT", $id);	

			$request = DBi::$con->real_escape_string(htmlspecialchars($_GET["request"]));
			if($request == 1 && $customer == 0 && $buy_date == "" && $status == 1 && $M_Dollar >= $dollar && $author != $DBMemberID){
				$date = time();
				DBi::$con->query("UPDATE ".prefix."MEMBERS_MARKET SET CUSTOMER = '$DBMemberID', BUY_DATE = '$date', STATUS = '0' WHERE ID = '$id' ");
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_DOLLAR = M_DOLLAR - $dollar WHERE MEMBER_ID = '$DBMemberID' ");
				$subject = ''.$lang['member']['sale_sell'].' '.$name.'';
				$message = ''.$lang['members']['members'].': '.link_profile(member_name($DBMemberID), $DBMemberID).'<br><br>'.$lang['member']['sell_message_part1'].' '.$name.' '.$lang['member']['sell_message_part2'].' '.link_profile(member_name($author), $author).' '.$lang['member']['sell_message_part3'].' '.normal_time(time()).'<br><br>'.$lang['member']['sell_message_part4'].'<br><br>'.$buy_text.'<br><br>'.$lang['member']['sell_message_part5'].'';
				$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sendPm .= " '1', ";
				$sendPm .= " '$DBMemberID', ";
				$sendPm .= " '1', ";
				$sendPm .= " '0', ";
				$sendPm .= " '$subject', ";
				$sendPm .= " '$message', ";
				$sendPm .= " '$date') ";
				@DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);
				$sql = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS_MARKET WHERE ID = '$id'");
				$num = mysqli_num_rows($sql);
				$x = 0;
				while($x < $num) {
				$customer_sale = mysqli_result($sql, $x, "CUSTOMER");	
				$subject = ''.$lang['member']['sale_sell'].' '.$name.'';
				$message = ''.$lang['members']['members'].'; '.link_profile(member_name($customer_sale), $customer_sale).'<br><br>'.$lang['member']['sell_to_message_part1'].' '.$name.' '.$lang['member']['sell_message_part3'].' '.normal_time(time()).'<br><br>'.$lang['member']['sell_to_message_part2'].'';
				$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sendPm .= " '1', ";
				$sendPm .= " '$author', ";
				$sendPm .= " '1', ";
				$sendPm .= " '0', ";
				$sendPm .= " '$subject', ";
				$sendPm .= " '$message', ";
				$sendPm .= " '$date') ";
				@DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);
				++$x;
				}		

				header("Location: index.php?mode=member&id=".$ProMemberID."&prm=market&market=".$id."");

			} 
			
			
echo'
						<td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">
<img border="0" src="'.$img.'" onerror="this.src=\''.$icon_blank.'\';" border="0" height="64" width="86">
</a>
</div>
<div class="div_medals"><font style="font-size:18px;"><a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">'.$name.'</a></font><br>
'.$desc.'<br><span class="span_medals"> '.normal_time($date).'</span><br>'.$lang['member']['sell_dollar'].' <font color="red">'.$dollar.'</font> '.$dollar_cur.'</div>
<div style="float:left">';
	if($M_Dollar >= $dollar && $customer == 0) {
	echo'<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'&request=1"><img border="0" src="images/buy.png" title="'.$lang['member']['buy_sell'].'"></a>';
	}
	if($M_Dollar < $dollar && $customer == 0) {
	echo'<img border="0" src="images/no_buy.png" title="'.$lang['member']['cant_buy_sell'].'">';
	}
	if($customer != 0) {
	echo'<img border="0" src="images/done_buy.png" title="'.$lang['member']['the_sell_bought_to'].' '.member_name($customer).'">';
	}
echo'</div></td>';

$three = $three + 1;
			if ($three == 3){
				echo'
				
				</tr>
				<tr>
';
					$three = 0;
			}
			$count += 1;
		++$x;
	}
echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($sqlll <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=member&id='.$ProMemberID.'&prm=market&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table>
	</td>
	</tr>
	</tbody>
	</table>	</td>
	</tr>
	</tbody>
	</table>
	';


	

	} else {
		echo'
		 <center> <table width="83.2%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="86%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['market_m'].'</div></center>
<center>

<div class="page_contenttt">
	<center>
<center>'.$lang['member']['no_this_here'].'</center>
</center></div></center>
</td></tr></tbody></table></div>

</font>
	</td>
	</tr>
	</tbody>
	</table>
		';
	}
	

	
	
	
	echo'
</center></html>
';
	
}

 
 
 if($market != "") {
	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS_MARKET WHERE ID = '$market' AND AUTHOR = '$ppMemberID' ORDER BY DATE DESC LIMIT 1") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	
	if($num == 0) {
	header("Location: ".index()."?mode=member&id=".$author."&prm=market");	
	}
	
	
	
echo'
<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	
	</a>
</div></td></tr>
<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br><td class="subtab">
<a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['groups'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>';
if($ProMemberID == $DBMemberID) {
	echo'<td><a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&prd=edit&market='.$market.'"><img border="0" src="./profile/page_process.png"></a></td>
';
}
echo'
</tr>
</tbody>
</table>

			</tr></tbody></table>';
			
		$x = 0;
		while($x < $num){
			$id = mysqli_result($sql, $x, "ID");
			$name = market("NAME", $id);
			$description = market("DESCRIPTION", $id);
			$desc = strip_tags(cutstr($description, 200));
			$mod_s = market("MOD_S", $id);
			$img = market("IMG", $id);
			$author = market("AUTHOR", $id);
			$date = market("DATE", $id);
			$customer = market("CUSTOMER", $id);
			$status = market("STATUS", $id);
			$buy_date = market("BUY_DATE", $id);
			$dollar = market("DOLLAR", $id);			
			$buy_text = market("BUY_TEXT", $id);	

if($mod_s == 1 or ($mod_s == 0 && ($Mlevel == 4 or $Mod_Market == 1))) {	
			
			$request = DBi::$con->real_escape_string(htmlspecialchars($_GET["request"]));
			if($request == 1 && $customer == 0 && $buy_date == "" && $status == 1 && $M_Dollar >= $dollar && $author != $DBMemberID){
				$date = time();
				DBi::$con->query("UPDATE ".prefix."MEMBERS_MARKET SET CUSTOMER = '$DBMemberID', BUY_DATE = '$date', STATUS = '0' WHERE ID = '$id' ");
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_DOLLAR = M_DOLLAR - $dollar WHERE MEMBER_ID = '$DBMemberID' ");
				$subject = ''.$lang['member']['sale_sell'].' '.$name.'';
				$message = ''.$lang['members']['members'].': '.link_profile(member_name($DBMemberID), $DBMemberID).'<br><br>'.$lang['member']['sell_message_part1'].' '.$name.' '.$lang['member']['sell_message_part2'].' '.link_profile(member_name($author), $author).' '.$lang['member']['sell_message_part3'].' '.normal_time(time()).'<br><br>'.$lang['member']['sell_message_part4'].'<br><br>'.$buy_text.'<br><br>'.$lang['member']['sell_message_part5'].'';
				$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sendPm .= " '1', ";
				$sendPm .= " '$DBMemberID', ";
				$sendPm .= " '1', ";
				$sendPm .= " '0', ";
				$sendPm .= " '$subject', ";
				$sendPm .= " '$message', ";
				$sendPm .= " '$date') ";
				@DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);
				$sql = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS_MARKET WHERE ID = '$id'");
				$num = mysqli_num_rows($sql);
				$x = 0;
				while($x < $num) {
				$customer_sale = mysqli_result($sql, $x, "CUSTOMER");	
				$subject = ''.$lang['member']['sale_sell'].' '.$name.'';
				$message = ''.$lang['members']['members'].'; '.link_profile(member_name($customer_sale), $customer_sale).'<br><br>'.$lang['member']['sell_to_message_part1'].' '.$name.' '.$lang['member']['sell_message_part3'].' '.normal_time(time()).'<br><br>'.$lang['member']['sell_to_message_part2'].'';
				$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sendPm .= " '1', ";
				$sendPm .= " '$author', ";
				$sendPm .= " '1', ";
				$sendPm .= " '0', ";
				$sendPm .= " '$subject', ";
				$sendPm .= " '$message', ";
				$sendPm .= " '$date') ";
				@DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);
				++$x;
				}		
				header("Location: index.php?mode=member&id=".$ProMemberID."&prm=market&market=".$id."");
			} 
			
			if($mod_s == 0) {
			$statusmod = " <font color='yellow'>".$lang['other']['pending']."</font>";	
			}
	echo'
	
	
				<div class="page_headddd">'.$lang['member']['sell_about'].' '.$name.''.$statusmod.'</div>
			
			<div class="page_contenttt">
			<table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr><td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">
<img border="0" src="'.$img.'" onerror="this.src=\''.$icon_blank.'\';" border="0" height="100" width="100">
</a>
</div>
<div class="div_medals">
<font style="font-size:18px;">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">'.$name.'</a></font><br>
</div>
<div class="group_desc">'.$desc.'</div>
';
echo'
<div style="float:left">';
	if($M_Dollar >= $dollar && $customer == 0) {
	echo'<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'&request=1"><img border="0" src="images/buy.png" title="'.$lang['member']['buy_sell'].'"></a>';
	}
	if($M_Dollar < $dollar && $customer == 0) {
	echo'<img border="0" src="images/no_buy.png" title="'.$lang['member']['cant_buy_sell'].'">';
	}
	if($customer != 0) {
	echo'<img border="0" src="images/done_buy.png" title="'.$lang['member']['the_sell_bought_to'].' '.member_name($customer).'">';
	}
echo'</div>';


echo'</td></tr></tbody></table>

<table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr><td class="box_plaques" valign="top">
<div style="float:right">
</a>
</div>

<div class="sell_desc">
<font color="black" size="4">'.$lang['member']['sell_name'].'</font> <font color="blue" size="4">'.$name.'</font><br><br>
<font color="black" size="4">'.$lang['member']['sell_desc'].'</font> <font color="blue" size="4">'.$description.'</font><br><br>
<font color="black" size="4">'.$lang['member']['sell_photo'].'</font> <font color="blue" size="4"><img border="0" src="'.$img.'"></font><br><br>
<font color="black" size="4">'.$lang['member']['sell_author'].'</font> <font color="blue" size="4">'.link_profile(member_name($author), $author).'</font><br><br>
<font color="black" size="4">'.$lang['member']['sell_date'].'</font> <font color="blue" size="4">'.normal_time($date).'</font><br><br>';
if($status == 1) {
	echo'
<font color="black" size="4">'.$lang['member']['sell_status'].'</font> <font color="green" size="4">'.$lang['member']['not_sold_m'].'</font><br><br>
';
}
if($status == 0) {
	echo'
<font color="black" size="4">'.$lang['member']['sell_status'].'</font> <font color="red" size="4">'.$lang['member']['sold_m'].'</font><br><br>
';}
if($customer == 0) {
echo'<font color="black" size="4">'.$lang['member']['sell_buyer'].'</font> <font color="blue" size="4">'.$lang['member']['no_author'].'</font><br><br>';
} else {
echo'<font color="black" size="4">'.$lang['member']['sell_buyer'].'</font> <font color="blue" size="4">'.link_profile(member_name($customer), $customer).'</font><br><br>';
echo'<font color="black" size="4">'.$lang['member']['sell_buy_date'].'</font> <font color="blue" size="4">'.normal_time($buy_date).'</font><br><br>';
}	
echo'<font color="black" size="4">'.$lang['member']['sell_dollar'].'</font> <font color="red" size="4">'.$dollar.' '.$dollar_cur.'</font><br><br>';
if($M_Dollar >= $dollar && $customer == 0) {
echo'<font color="red" size="4">'.$lang['member']['sell_description'].'</font><br><br>';
}
if($M_Dollar < $dollar && $customer == 0) {
echo'<font color="red" size="4">'.$lang['member']['cant_sell'].'</font><br><br>';
}
if($customer == $DBMemberID) {
echo'<font color="black" size="4">'.$lang['member']['sell_message_part4'].'</font><br><br><font color="red" size="4">'.$buy_text.'</font><br><br>';
}	
echo'<br><br>
<font color="black" size="4">'.$lang['member']['sell_description_m'].'</font>
</div>
</td></tr></tbody></table>

</div>
			';
				
		
} else {
header("Location: ".index()."?mode=member&id=".$author."&prm=market");	
}	

++$x;
		}
	
	
	
	echo'
</center></html>
';	
 }
 }

 if($prd == "add") {
	 
	 			echo '
			<center>

<html>

                  <table width="1024" border="0" cellspacing="0" cellpadding="0"><tbody>';
				  ?>
				  		<script language="javascript">
						
									function replace_title(new_text){

					document.sell_info.name.value = new_text;
				
			}
			function submit_form(){
				if (sell_info.name.value.length < 5){
					confirm(enter_sell_name);
					return;
				}
				if (sell_info.description.value.length < 5){
					confirm(enter_sell_desc);
					return;
				}	
				if (sell_info.img.value.length < 5){
					confirm(enter_sell_photo);
					return;
				}
				if (sell_info.dollar.value.length == 0){
					confirm(enter_sell_dollar);
					return;
				}	
				if (sell_info.buy_text.value.length < 5){
					confirm(enter_sell);
					return;
				}					

			
			sell_info.submit();
			}
			


		</script>
				  <?
				  
				  echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray">
		<form name="sell_info" method="post" action="index.php?mode=member&id='.$ProMemberID.'&prm=market&prd=insert">
			<br><tr class="fixed">
				<td class="cat" colSpan="4"><nobr>'.$lang['admin']['sell_add'].'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_name'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 400px" name="name">&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
				echo'
				</td>
			</tr>
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_desc'].' </nobr></td>
				<td class="list" colSpan="3">
				<textarea name="description" cols="55" rows="5"></textarea>
				<nobr></td>
		</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['admin']['sell_link_photo'].': </nobr></td>
				<td class="list"  colSpan="3">
				<input name="img" size="55">
				<nobr></td>
		</tr>				
			
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_author'].' </nobr></td>
				<td class="list"  colSpan="3">
				'.link_profile(member_name($ProMemberID), $ProMemberID).'
				<nobr></td>
		</tr>
		
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_status'].' </nobr></td>
				<td class="list"  colSpan="3">
				<font color="green">'.$lang['admin']['for_sale'].'</font>
				<nobr></td>
		</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_dollar'].' </nobr></td>
				<td class="list" colSpan="3">
				<input name="dollar" size="10" value="0">&nbsp;<font color="black" size="3">'.$dollar_cur.'</font>&nbsp;&nbsp;&nbsp;<font size="2" color="red">'.$lang['admin']['sell_dollar_description'].'</font>
				<nobr></td>
		</tr>		
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_message_part4'].' </nobr></td>
				<td class="list" colSpan="3">
				<textarea name="buy_text" cols="55" rows="5"></textarea>
				<nobr></td>
		</tr>		
			
			<tr class="fixed">
				<td class="list_center" colSpan="5"><input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</form>
		</table>
		</center><br>';
	 
 } 
 
 
  if($prd == "edit") {
	 
	if($market != "") {
	 
	 
	 			echo '
			<center>

<html>

                  <table width="1024" border="0" cellspacing="0" cellpadding="0"><tbody>';
				  ?>
				  		<script language="javascript">
									function replace_title(new_text){

					document.sell_info.name.value = new_text;
				
			}
			function submit_form(){
				if (sell_info.name.value.length < 5){
					confirm(enter_sell_name);
					return;
				}
				if (sell_info.description.value.length < 5){
					confirm(enter_sell_desc);
					return;
				}	
				if (sell_info.img.value.length < 5){
					confirm(enter_sell_photo);
					return;
				}
				if (sell_info.dollar.value.length == 0){
					confirm(enter_sell_dollar);
					return;
				}	
				if (sell_info.buy_text.value.length < 5){
					confirm(enter_sell);
					return;
				}					

			
			sell_info.submit();
			}
			


		</script>
				  <?
				  
	$sql = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS_MARKET WHERE ID = '$market'");
	$num = mysqli_num_rows($sql);
	$x = 0;
	while($x < $num) {

			$id = mysqli_result($sql, $x, "ID");
			$name = market("NAME", $id);
			$description = market("DESCRIPTION", $id);
			$img = market("IMG", $id);
			$author = market("AUTHOR", $id);
			$date = market("DATE", $id);
			$customer = market("CUSTOMER", $id);
			$status = market("STATUS", $id);
			$buy_date = market("BUY_DATE", $id);
			$dollar = market("DOLLAR", $id);			
			$buy_text = market("BUY_TEXT", $id);		  
				  
				 if($DBMemberID == $author or $Mlevel == 4) { 
				  echo'
		<center>
		<table cellSpacing="1" cellPadding="4" width="400" bgColor="gray">
		<form name="sell_info" method="post" action="index.php?mode=member&id='.$ProMemberID.'&prm=market&prd=update">
		<input type="hidden" name="id" value="'.$id.'">
		<br><tr class="fixed">
				<td class="cat" colSpan="4"><nobr>'.$lang['admin']['edit_sell'].': '.$name.'</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_name'].' </nobr></td>
				<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 400px" name="name" value="'.$name.'">&nbsp;&nbsp;
				<input class="insidetitle" onclick="replace_title(\'\');" type="button" value="X">';
				echo'
				</td>
			</tr>
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_desc'].' </nobr></td>
				<td class="list" colSpan="3">
				<textarea name="description" cols="55" rows="5">'.$description.'</textarea>
				<nobr></td>
		</tr>

			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['admin']['sell_link_photo'].': </nobr></td>
				<td class="list"  colSpan="3">
				<input name="img" value="'.$img.'" size="55">
				<nobr></td>
		</tr>

			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_photo'].' </nobr></td>
				<td class="list"  colSpan="3">
				<img border="0" src="'.$img.'">
				<nobr></td>
		</tr>		
			
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_author'].' </nobr></td>
				<td class="list"  colSpan="3">
				'.link_profile(member_name($ProMemberID), $ProMemberID).'
				<nobr></td>
		</tr>
		';
		if($status == 1) {
				$sell_status = '<font color="green">'.$lang['admin']['for_sale'].'</font>';
		}
		if($status == 0) {
				$sell_status = '<font color="red">'.$lang['admin']['sold'].'</font>';
		}	
		echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_status'].' </nobr></td>
				<td class="list" colSpan="3">
				'.$sell_status.'
				<nobr></td>
		</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_dollar'].' </nobr></td>
				<td class="list" colSpan="3">
				<input name="dollar" value="'.$dollar.'" size="10" value="0">&nbsp;<font color="black" size="3">'.$dollar_cur.'</font>&nbsp;&nbsp;&nbsp;<font size="2" color="red">'.$lang['admin']['sell_dollar_description'].'</font>
				<nobr></td>
		</tr>		
						<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['member']['sell_message_part4'].' </nobr></td>
				<td class="list" colSpan="3">
				<textarea name="buy_text" cols="55" rows="5">'.$buy_text.'</textarea>
				<nobr></td>
		</tr>		
			
			<tr class="fixed">
				<td class="list_center" colSpan="5"><input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" onclick="submit_form()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="youcha" onmouseover="this.className=\'youcha youchahove\';" onmouseout="this.className=\'youcha\';" type="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</form>
		</table>
		</center><br>';
		
	}
		
		++$x;
	}
	 
 }

  }
  
 if($prd == "insert") {
	 
	 
			$name = DBi::$con->real_escape_string(htmlspecialchars($_POST["name"]));
			$description = DBi::$con->real_escape_string(htmlspecialchars($_POST['description']));
			$img = DBi::$con->real_escape_string(htmlspecialchars($_POST['img']));
			$author = $DBMemberID;
			$dollar = DBi::$con->real_escape_string(htmlspecialchars($_POST['dollar']));
			$buy_text = DBi::$con->real_escape_string(htmlspecialchars($_POST['buy_text']));
			$date = time();
			if($Mlevel == 4 or $Mod_Market == 1) {
			$mod_s = 1;	
			}	
			
	echo'
	<center>
	<html>
';


				$query = "INSERT INTO ".prefix."MEMBERS_MARKET (ID, NAME, DESCRIPTION, IMG, AUTHOR, DOLLAR, BUY_TEXT, DATE, MOD_S) VALUES (NULL,";
				$query .= " '$name', ";
				$query .= " '$description', ";
				$query .= " '$img', ";
				$query .= " '$author', ";
				$query .= " '$dollar',";
				$query .= " '$buy_text',";
				$query .= " '$date',";
				$query .= " '$mod_s'";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
				

echo'


					<center>
	                <table width="99%" border="1">
	                  <br> <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['admin']['sell_added'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="3; URL= index.php?mode=member&id='.$ProMemberID.'&prm=market">
                           <a href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>
					
					
	';
} 


if($prd == "update") {
			$id = DBi::$con->real_escape_string(htmlspecialchars($_POST['id']));
			$name = DBi::$con->real_escape_string(htmlspecialchars($_POST["name"]));
			$description = DBi::$con->real_escape_string(htmlspecialchars($_POST['description']));
			$img = DBi::$con->real_escape_string(htmlspecialchars($_POST['img']));
			$dollar = DBi::$con->real_escape_string(htmlspecialchars($_POST['dollar']));
			$buy_text = DBi::$con->real_escape_string(htmlspecialchars($_POST['buy_text']));
			$customer = market("CUSTOMER", $id);
			$author = market("AUTHOR", $id);
	echo'
	<center>
	<html>
';


				DBi::$con->query("UPDATE ".prefix."MEMBERS_MARKET SET NAME = '$name', DESCRIPTION = '$description', IMG = '$img', DOLLAR = '$dollar', BUY_TEXT = '$buy_text' WHERE ID = '$id'");
							if($customer != 0) {				
				$subject = ''.$lang['member']['sell_edit_message_part1'].' '.$name.'';
				$message = ''.$lang['members']['members'].': '.link_profile(member_name($customer), $customer).'<br><br>'.$lang['member']['sell_edit_message_part2'].' '.$name.' '.$lang['member']['sell_edit_message_part3'].' '.link_profile(member_name($author), $author).'<br><br>'.$lang['member']['sell_edit_message_part4'].'<br><br>'.$buy_text.'<br><br>'.$lang['member']['sell_edit_message_part5'].'';
				$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sendPm .= " '1', ";
				$sendPm .= " '$customer', ";
				$sendPm .= " '1', ";
				$sendPm .= " '0', ";
				$sendPm .= " '$subject', ";
				$sendPm .= " '$message', ";
				$sendPm .= " '$date') ";
				@DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);				
							}
echo'


					<center>
	                <table width="99%" border="1">
	                  <br> <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['admin']['sell_edit'].'</b></font><br><br>
	                       <meta http-equiv="Refresh" content="3; URL= index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">
                           <a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>
					
					
	';
} 

if($prd == "sales") {
$temy = 15;
	if($Mod_Market == 1 OR $Mlevel == 4) {
	$mod_s_sql = "";
	} else {
	$mod_s_sql = "AND MOD_S = '1'";
	}
	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS_MARKET WHERE CUSTOMER = '$ppMemberID' $mod_s_sql ORDER BY DATE DESC LIMIT ".pg_limit($temy).", $temy ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$sqll = DBi::$con->query("SELECT COUNT(*) FROM ".prefix."MEMBERS_MARKET WHERE CUSTOMER = '$ppMemberID' $mod_s_sql ") or die(DBi::$con->error);
	$sqlll = mysqli_result($sqll, 0, "COUNT(*)");
	$cols = floor($sqlll / $temy);
	$pg_prev = $pg - 1;
	$pg_next = $pg + 1;

	
	
echo'
<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet1.gif">
	<a href="index.php?mode=member&id='.$ProMemberID.'">
	
	';if($ProMemberID != $DBMemberID) {
		echo'
	<span style="color:#474747;font-weight:bold;font-size:18px"> '.$lang['member']['profile_member'].'</span> <span style="color:#797979;font-size:18px;font-weight:bold;">'.$ProMemberName.'</span>
	';
	} else {
		echo'
			<span style="color:#474747;font-weight:bold;font-size:18px">'.$lang['member']['your_profile'].'</span>

		';
	}
	echo'
	
	</a>
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br>';
if($ProMemberID != $DBMemberID) {
	echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'">'.$lang['member']['total_details'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=medal">'.$lang['member']['medals'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=groups&prd=cur">'.$lang['member']['groups'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=sig">'.$lang['member']['sig'].'</a></td>
';if($active_market == 1) {echo'<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>';}echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=blog">'.$lang['member']['blog'].'</a></td>
';
if($ProMemberID == $DBMemberID) {
	echo'<td><a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&prd=add"><img border="0" src="./profile/add_page.png"></a></td>
';
}
} else {
echo'
<td class="subtab"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market">'.$lang['member']['market_m'].'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=member&id='.$ProMemberID.'&prm=market&prd=sales">'.$lang['member']['your_sales'].'</a></td>
';
}	
echo'
</tr>
</tbody>
</table>

			</tr></tbody></table>';
			
			if ($num > 0){
echo'

<center> <table width="74%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="70%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['your_sales'].'</div></center>

<table width="88.5%" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td class="contentarea"><div class="page_contenttt">

<table width="100%" border="0" cellpadding="0" cellspacing="4" style="border-color:white;"><tbody><tr>
';
		$count = 0;
		$x = 0;
		while($x < $num){
			$id = mysqli_result($sql, $x, "ID");
			$name = market("NAME", $id);
			$description = market("DESCRIPTION", $id);
			$desc = strip_tags(cutstr($description, 40));
			$img = market("IMG", $id);
			$author = market("AUTHOR", $id);
			$date = market("DATE", $id);
			$customer = market("CUSTOMER", $id);
			$status = market("STATUS", $id);
			$buy_date = market("BUY_DATE", $id);
			$dollar = market("DOLLAR", $id);
			$buy_text = market("BUY_TEXT", $id);	

			
			
echo'
						<td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">
<img border="0" src="'.$img.'" onerror="this.src=\''.$icon_blank.'\';" border="0" height="64" width="86">
</a>
</div>
<div class="div_medals"><font style="font-size:18px;"><a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">'.$name.'</a></font><br>
'.$desc.'<br><span class="span_medals"> '.normal_time($date).'</span><br>'.$lang['member']['sell_dollar'].' <font color="red">'.$dollar.'</font> '.$dollar_cur.'</div>
<div style="float:left">';
	echo'<img border="0" src="images/done_buy.png" title="'.$lang['member']['this_sell_bought_to_you'].'">';
	
echo'</div></td>';

$three = $three + 1;
			if ($three == 3){
				echo'
				
				</tr>
				<tr>
';
					$three = 0;
			}
			$count += 1;
		++$x;
	}
echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($sqlll <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=member&id='.$ProMemberID.'&prm=market&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table>	</td>
	</tr>
	</tbody>
	</table>	</td>
	</tr>
	</tbody>
	</table>
	';


	

	} else {
		echo'
		 <center> <table width="83.2%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="86%" class="contentarea">
<center><div class="page_headddd">
					'.$lang['member']['your_sales'].'</div></center>
<center>

<div class="page_contenttt">
	<center>
<center>'.$lang['member']['no_this_here'].'</center>
</center></div></center>
</td></tr></tbody></table></div>

</font>
		';
	}
	

	
	
	
	echo'
</center></html>
';

}
 
 }
 
 
}


}

}	// (members("STATUS", $id) == 1 OR $Mlevel > 1 OR members("NAME", $id) != "")
else {
echo'
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./profile/temy.css">
	<script src="profile.js"></script>
</head>
<center>
<div id="dhtmltooltip"></div>
<table width="1024" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td>';
echo menuLinks();
echo'</table><font color="yellow">
</td></tr>


</body></html>';
}
?>
<style>
TD.tarek{background-image:url(captcha/backgrounds/captcha.png);border-width:1px;}
INPUT {font-family:arial;font-size:14;font-weight:bold;color:black;background-color:#ffffff }
SELECT {font-family:arial;font-size:12;font-weight:bold;color:black;background-color:#ffffff }
SELECT.insidetitle {font-family:arial;font-size:15;font-weight:bold;color:black;background-color:#ffffff; }
</style>