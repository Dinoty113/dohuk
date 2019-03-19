<?
/*if (@eregi("profile.php","$_SERVER[PHP_SELF]")) {
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

if(mlv == 0) {
redirect();
}

if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}

require_once("./engine/profile_function.php");
@require_once("./engine/moderation_function.php");
@require_once("./engine/svc_function.php");
if($type != "requestmon" AND $type != "edit_email" AND $type != "notes" AND $type != "add" AND $type != "details" AND $type != "edit_details" AND $type != "insert_details" AND $type != "ihsaa" AND $type != "edit_pass" AND $type != "insert_pass" AND $type != "edit_user" AND $type != "edit_user_add" AND $type != "medals" AND $type != "send_pass" AND $type != "insert_email" AND $type != "send_email" AND $type != "insert_email_code"){
	header("Location: ".index()."");
}
$ppMemberID = $id;

if ((members("STATUS", $id) == 1 OR $Mlevel > 1) AND members("NAME", $id) != "" OR $type != "") {

if ($type == "notes") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
    if ($DBMemberID > 0) {

 $query = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$DBMemberID."' ";
 $result = DBi::$con->query($query) or die (DBi::$con->error);

 if(mysqli_num_rows($result) > 0){
 $rs=mysqli_fetch_array($result);

 $ProMemberID = $rs['MEMBER_ID'];
 $ProMemberNotes = $rs['M_NOTES'];
 }

echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="2" width="80%">
<form method="post" action="index.php?mode=profile&type=notes&type=add">
	<tr class="fixed">
	<td class="cat" colspan="2"><nobr>'.$lang['profile']['note'].'  </td>
	<tr class="fixed">
	<td class="userdetails_data"  colspan="2">
		<textarea  class="insidetitle" style="WIDTH: 1086; HEIGHT: 300; '.M_Style_Form.'" name="user_notes" type="text" rows="1" cols="20">'.$ProMemberNotes.'</textarea></td>

 	<tr class="fixed">


		<td align="middle" colspan="2">
			
<center>
						<font color="red">'.$lang['others']['insert_true_captcha'].'<br>

					<div id="captchabox">
<table><tbody>
<tr><td valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
<?php
echo'
</td>
<td valign="top"><img width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'"></td>
<td valign="top"><nobr><center><b><font color="red">'.$lang['others']['captcha'].'<br><input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div>
</center>
		<input type="submit" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
	</tr>		
</table></center>
';
 }
 else {
 redirect();
 }
}
if ($type == "add") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
    if ($DBMemberID > 0) {

$user_text = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_notes"]));
	$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));

	require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
	
	if($error != "") {
		
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

		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
        $query .= " M_NOTES = ('$user_text') ";
        $query .= "WHERE MEMBER_ID = '$DBMemberID' ";
		DBi::$con->query($query) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['profile']['your_notes_has_edited'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php?mode=profile&type=details">
                           <a href="index.php?mode=profile&type=details">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


    }
    else {
    redirect();
    }

}




if ($type == "details") {
if (members("DETAILS", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][your_details].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
echo'
<center>
<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0" id="table1">
	<tr class="fixed">
		<td class="list"><img src="'.$details.'"></td>
		<td class="optionheader">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="yellow" size="+2">'.$lang['profile']['your_options_and_details'].'</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>'.$lang['profile']['please_choose_one'].'</td>
	</tr>
	<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=profile&type=edit_pass">'.$lang['profiles']['edit_your_pass'].'</a></td>
	</tr>
	
		<tr class="fixed">

		<td class="list" colSpan="2">
		<a href="index.php?mode=profile&type=edit_email">'.$lang['profiles']['edit_your_email'].'</a></td>
	</tr>
		<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=profile&type=edit_details">'.$lang['profile']['edit_your_details_and_options'].'</a></td>
	</tr>	';



echo'	<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=profile&type=notes">'.$lang['profile']['edit_your_note'].'</a></td>
	</tr>

	<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=editor&method=sig">'.$lang['profile']['edit_your_signature'].'</a></td>
	</tr>
	<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=profile&type=medals">'.$lang['profile']['your_medals_info'].'</a></td>
	</tr>
	<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=list&method=index">'.$lang['profile']['edit_your_lists'].'</a></td>
	<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=active&active=private">'.$lang['profile']['private'].'</a></td>
	</tr>
	<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=changename">'.$lang['profile']['change_username'].'</a></td>
	</tr>';
	if ($Mlevel > 1) {
                echo'
                <tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=svc&svc=ip">'.$lang['profiles']['login_it'].'</a></td>
	</tr>
<tr class="fixed">
		<td class="list" colSpan="2">
		<a href="index.php?mode=svc&svc=ip&type=info">'.$lang['profiles']['trys_login'].'</a></td>
	</tr>';}echo'</table></center>';
	
	}
if ($type == "edit_details") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
if (members("DETAILS_EDIT", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][edit_details].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
    if ($DBMemberID > 0) {

 $query = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = ".$DBMemberID." ";
 $result = DBi::$con->query($query) or die (DBi::$con->error);

 if(mysqli_num_rows($result) > 0){
 $rs=mysqli_fetch_array($result);

 $ProMemberID = $rs['MEMBER_ID'];
 $ProMemberName = $rs['M_NAME'];
 $ProMemberCountry = $rs['M_COUNTRY'];
 $ProMemberCity = $rs['M_CITY'];
 $hld = members("HOLD_POSTS", $ProMemberID);
$activ = members("HOLD_ACTIVE", $ProMemberID);		
if($ProMemberLevel == 4 or ($ProMemberLevel == 3 && members("DEPUTY", $ProMemberID) == 0)) {
		$ProMemberPosts = HoldPosts(posts($ProMemberID), $ProMemberLevel, members("DEPUTY", $ProMemberID), $hld, $activ);
} else {
		$ProMemberPosts = posts($ProMemberID);
}	
 $ProMemberState = $rs['M_STATE'];
 $ProMemberOccupation = $rs['M_OCCUPATION'];
 $ProMemberAge = $rs['M_AGE'];
 $ProMemberSex = $rs['M_SEX'];
 $ProMemberDate = $rs['M_DATE'];
 $ProMemberLastPostDate = $rs['M_LASTPOSTDATE'];
 $ProMemberPhotoURL = $rs['M_PHOTO_URL'];
 $ProMemberPhotoPURL = $rs['M_PHOTO_PURL'];
 $ProMemberMarStatus = $rs['M_MARSTATUS'];
 $ProMemberReceiveEmail = $rs['M_RECEIVE_EMAIL'];
 $ProMemberBio = $rs['M_BIO'];
 $ProMemberHobby = $rs['M_HOBBY'];
 $ProMemberRealName = $rs['M_REALNAME'];
 $ProMemberTitle = $rs['M_TITLE'];
 $ProMemberPmHide = $rs['M_PMHIDE'];
 $ProMemberBrowse = $rs['M_BROWSE'];
 $ProMemberEditor = $rs['M_SP_EDITOR'];
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
 $ProMemberHobby = $rs['M_HOBBY'];
 $ProMemberYear = $rs['M_YEAR']; 
 $ProMemberMonth = $rs['M_MONTH']; 
 $ProMemberDay = $rs['M_DAY'];  
 $ProMemberSkin = $rs['M_SKIN']; 
 $ProMemberID = $rs['MEMBER_ID'];
 $ProMemberColor = $rs['M_COLOR'];
 $ProMemberSize = $rs['M_SIZE'];
 $ProMemberFonts = $rs['M_FONTS_T'];
 $ProMemberAlign = $rs['M_ALIGN'];
 $ProMemberWeight = $rs['M_WEIGHT'];
 $ProMemberOPT = $rs['M_OPT'];
 }

echo'
<script type="text/javascript" src="javascript/colors.js"></script>
<script>
 function submitdetails()
{



detailsinfo.submit();
}
</script>';

echo'<center>
<table cellSpacing="0" cellPadding="0" width="55%" border="0">
<tr><td colspan="1" class="optionsbar_menus"><center><font color="red" size="+2">'.$lang['profile']['edit_your_details'].'</font><br>'.$lang['profile']['please_update_your_details'].'</center></td></tr>

	<tr>
		<td><center>
            <form name="detailsinfo" method="post" action="index.php?mode=profile&type=insert_details">
			<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0">
				<tr class="fixed">
					<td class="optionheader" id="row_user_city"><nobr>'.$lang['profile']['the_city'].'</nobr></td>
					<td class="list"><input onchange="check_changes(row_user_city, \''.$ProMemberCity.'\', this.value)" class="insidetitle" style="WIDTH: 200px" value="'.$ProMemberCity.'" name="user_city"></td>
					<td class="optionheader" id="row_user_state"><nobr>'.$lang['profile']['the_state'].'</nobr></td>
					<td class="list"><input onchange="check_changes(row_user_state, \''.$ProMemberState.'\', this.value)" class="insidetitle" style="WIDTH: 200px" value="'.$ProMemberState.'" name="user_state"></td>				</tr>
				<tr class="fixed">
					<td class="optionheader" id="row_user_country">'.$lang['profile']['the_country'].' </td>
					<td>
					<select onchange="check_changes(row_user_country, \''.$ProMemberCountry.'\', this.value)" class="insidetitle" style="WIDTH: 200px" name="user_country" type="text">';
                    $selected = $ProMemberCountry;
                    include("country.php");
					echo'</select></td>
					<td class="optionheader" id="row_user_occupation"><nobr>'.$lang['profile']['the_occupation'].'</nobr></td>
					<td class="list"><input onchange="check_changes(row_user_occupation, \''.$ProMemberOccupation.'\', this.value)" class="insidetitle" style="WIDTH: 200px" value="'.$ProMemberOccupation.'" name="user_occupation"></td>
				</tr>
				<tr class="fixed">
					<td class="optionheader" id="row_user_marstatus"><nobr>'.$lang['profile']['the_sociability_status'].' </nobr></td>
					<td class="list"><input onchange="check_changes(row_user_marstatus, \''.$ProMemberMarStatus.'\', this.value)" class="insidetitle" style="WIDTH: 200px" value="'.$ProMemberMarStatus.'" name="user_marstatus"></td>

		';
					echo'
					<td class="optionheader" id="row_user_age"><nobr>'.$lang['profile']['the_age'].'</nobr></td>
					<td class="list"><input onchange="check_changes(row_user_age, \''.$ProMemberAge.'\', this.value)" class="insidetitle" style="WIDTH: 200px" value="'.$ProMemberAge.'" name="user_age"></td>

				
				<tr class="fixed">
					<td class="optionheader" id="row_user_gender">'.$lang['profile']['the_sex'].' </td>
					<td class="list" colSpan="3">
					<input onchange="check_changes(row_user_gender, \''.$ProMemberSex.'\', this.value)" class="small" type="radio" value="0" name="user_gender" '.check_radio($ProMemberSex, "0").' disabled="disabled">'.$lang['profile']['no_selected'].'&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_gender, \''.$ProMemberSex.'\', this.value)" class="small" type="radio" value="1" name="user_gender" '.check_radio($ProMemberSex, "1").' disabled="disabled">'.$lang['profile']['male'].'&nbsp;&nbsp;&nbsp;
					<input onchange="check_changes(row_user_gender, \''.$ProMemberSex.'\', this.value)" class="small" type="radio" value="2" name="user_gender" '.check_radio($ProMemberSex, "2").' disabled="disabled">'.$lang['profile']['female'].'
					</td>
				</tr>


				<tr class="fixed">
					<td class="optionheader" id="row_user_hideemail">'.$lang['profile']['the_email'].' </td>
					<td class="list"><input onchange="check_changes(row_user_hideemail, \''.$ProMemberReceiveEmail.'\', this.value)" class="small" type="radio" value="0" name="user_hideemail" '.check_radio($ProMemberReceiveEmail, "0").'>'.$lang['profile']['the_member_not_allowed_to_send_email'].'</td>
					<td class="list" colSpan="2"><input onchange="check_changes(row_user_hideemail, \''.$ProMemberReceiveEmail.'\', this.value)" class="small" type="radio" value="1" name="user_hideemail" '.check_radio($ProMemberReceiveEmail, "1").'>'.$lang['profile']['the_member_allowed_to_send_email'].'</td>
				</tr>
				<tr class="fixed">
					<td class="optionheader" id="row_user_allowmsgs">'.$lang['profile']['private_message'].' </td>
					<td class="list"><input onchange="check_changes(row_user_allowmsgs, \''.$ProMemberPmHide.'\', this.value)" class="small" type="radio" value="0" name="user_pmhide" '.check_radio($ProMemberPmHide, "0").'>'.$lang['profile']['the_member_not_allowed_to_send_pm'].'</td>
					<td class="list" colSpan="2"><input onchange="check_changes(row_user_allowmsgs, \''.$ProMemberPmHide.'\', this.value)" class="small" type="radio" value="1" name="user_pmhide" '.check_radio($ProMemberPmHide, "1").'>'.$lang['profile']['the_member_allowed_to_send_pm'].'</td>
				</tr>
				<tr class="fixed">
					<td class="optionheader" id="row_user_hideactivity">'.$lang['profile']['your_browse'].' </td>
					<td class="list"><input onchange="check_changes(row_user_hideactivity, \''.$ProMemberBrowse.'\', this.value)" class="small" type="radio" value="1" name="user_hideactivity" '.check_radio($ProMemberBrowse, "1").'>'.$lang['profile']['your_browse_show'].'</td>
					<td class="list" colSpan="2"><input onchange="check_changes(row_user_hideactivity, \''.$ProMemberBrowse.'\', this.value)" class="small" type="radio" value="0" name="user_hideactivity" '.check_radio($ProMemberBrowse, "0").'>'.$lang['profile']['your_browse_hide'].'</td>
				</tr>';
			
                echo'
				<tr class="fixed">
					<td class="optionheader" id="row_user_photo_url"><nobr>'.$lang['profile']['your_single_photo'].' </nobr></td>
					<td class="list" dir="ltr" align="right" colSpan="3"><input onchange="check_changes(row_user_photo_url, \''.$ProMemberPhotoURL.'\', this.value)"  class="insidetitle" style="WIDTH: 100%" value="'.$ProMemberPhotoURL.'" name="user_photo_url"></td>
				</tr>				
				<tr class="fixed">
					<td class="optionheader" id="row_user_bio">'.$lang['profile']['your_biography'].' </td>
					<td class="list" colSpan="3"><textarea onchange="check_changes(row_user_bio, \''.$ProMemberBio.'\', this.value)" class="insidetitle" style="WIDTH: 100%; HEIGHT: 70px" name="user_bio" type="text" rows="1" cols="20">'.$ProMemberBio.'</textarea></td>
				</tr>
				
									<tr class="fixed">
					<td class="optionheader" id="row_user_bio"> '.$lang['profiles']['font_default'].' </td>
					<td class="list" colSpan="3">
					<table width="100%">
					<tr><td>
					'.$lang['profiles']['font_name'].' <select   onchange="updateTextPreview();" class="insidetitle" style="WIDTH: 60px" name="user_font" type="text">';


        $selected = $ProMemberFonts ;
		echo'
					<option value="arabic transparent" '.check_select($selected, "arabic transparent").'>'.$lang['fonts']['font_1'].'</option>
                    <option value="arial" '.check_select($selected, "arial").'>'.$lang['fonts']['font_2'].'</option>
                    <option value="akhbar mt" '.check_select($selected, "akhbar mt").'>'.$lang['fonts']['font_3'].'</option>
                    <option value="andalus" '.check_select($selected, "andalus").'>'.$lang['fonts']['font_4'].'</option>
                    <option value="bold italic art" '.check_select($selected, "bold italic art").'>'.$lang['fonts']['font_5'].'</option>
                    <option value="decotype naskh" '.check_select($selected, "decotype naskh").'>'.$lang['fonts']['font_6'].'</option>
                    <option value="diwani letter" '.check_select($selected, "diwani letter").'>'.$lang['fonts']['font_7'].'</option>
                    <option value="diwani outline shaded" '.check_select($selected, "diwani outline shaded").'>'.$lang['fonts']['font_8'].'</option>
                    <option value="diwani simple striped" '.check_select($selected, "diwani simple striped").'>'.$lang['fonts']['font_9'].'</option>
                    <option value="monotype kufi" '.check_select($selected, "monotype kufi").'>'.$lang['fonts']['font_10'].'</option>
                    <option value="kufi extended outline" '.check_select($selected, "kufi extended outline").'>'.$lang['fonts']['font_11'].'</option>
                    <option value="mudir mt" '.check_select($selected, "mudir mt").'>'.$lang['fonts']['font_12'].'</option>
                    <option value="old antic bold" '.check_select($selected, "old antic bold").'>'.$lang['fonts']['font_13'].'</option>
                    <option value="simple indust shaded" '.check_select($selected, "simple indust shaded").'>'.$lang['fonts']['font_14'].'</option>
                    <option value="decotype thuluth" '.check_select($selected, "decotype thuluth").'>'.$lang['fonts']['font_15'].'</option>
                    <option value="arial black" '.check_select($selected, "arial black").'>Arial</option>
                    <option value="arial narrow" '.check_select($selected, "arial narrow").'>Arial Narrow</option>
                    <option value="comic sans ms" '.check_select($selected, "comic sans ms").'>Comic</option>
                    <option value="courier new" '.check_select($selected, "courier new").'>Courier</option>
                    <option value="tahoma" '.check_select($selected, "tahoma").'>Tahoma</option>
                    <option value="Times New Roman" '.check_select($selected, "Times New Roman").'>Times</option>
                    <option value="verdana" '.check_select($selected, "verdana").'>Verdana</option>
					';		echo'</select>
					
					'.$lang['profiles']['font_size'].' <select   onchange=" updateTextPreview();" class="insidetitle" style="WIDTH: 60px" name="user_size" type="text">';
        $selected = $ProMemberSize ;
		echo'
                    <option value="10" '.check_select($selected, "10").'>10</option>
                    <option value="11" '.check_select($selected, "11").'>11</option>
					<option value="12" '.check_select($selected, "12").'>12</option>
					<option value="13" '.check_select($selected, "13").'>13</option>
					<option value="14" '.check_select($selected, "14").'>14</option>
					<option value="16" '.check_select($selected, "16").'>16</option>
					<option value="18" '.check_select($selected, "18").'>18</option>
					<option value="20" '.check_select($selected, "20").'>20</option>
					<option value="22" '.check_select($selected, "22").'>22</option>
					<option value="24" '.check_select($selected, "24").'>24</option>
					<option value="28" '.check_select($selected, "28").'>28</option>
					<option value="32" '.check_select($selected, "32").'>32</option>
					<option value="40" '.check_select($selected, "40").'>40</option>
					<option value="48" '.check_select($selected, "48").'>48</option>
					<option value="60" '.check_select($selected, "60").'>60</option>
					<option value="72" '.check_select($selected, "72").'>72</option>
					<option value="80" '.check_select($selected, "80").'>80</option>
					';		echo'</select>
					
					'.$lang['profiles']['font_align'].' <select   onchange=" updateTextPreview();" class="insidetitle" style="WIDTH: 60px" name="user_align" type="text">';
        $selected = $ProMemberAlign ;
		echo'
		<script>
		function updateTextPreview() {

    var font = detailsinfo.user_font[detailsinfo.user_font.selectedIndex].value;
    var size = detailsinfo.user_size[detailsinfo.user_size.selectedIndex].value;
    var align = detailsinfo.user_align[detailsinfo.user_align.selectedIndex].value;
    var color = currentcolor;

    var alignV = "";

    switch (align) {
        case "center": alignV = "center"; break;
        case "right": alignV = "right"; break;
        case "left": alignV = "left"; break;
    }

    document.getElementById("textPreview").style.fontFamily = font;
    document.getElementById("textPreview").style.fontSize = size;
    document.getElementById("textPreview").style.color = currentcolor;
    document.getElementById("textPreview").style.textAlign = alignV;
}
</script>
';
		echo'
		<option value="right" '.check_select($selected, "right").'>'.$lang['profiles']['right'].'</option>
		<option value="center" '.check_select($selected, "center").'>'.$lang['profiles']['center'].'</option>
		<option value="left" '.check_select($selected, "left").'>'.$lang['profiles']['left'].'</option>';
		$selected = $ProMemberOPT;
		echo'</select>
		<hr>
		
					<script language="javascript" type="text/javascript" >
document.write(color_palette("'.$ProMemberColor.'",1));
</script>
<input  name="g1" id="g1"  value="'.$ProMemberColor.'" style="display:none;" >
					</td>
					<td style="padding-left:20px;padding-right:20px;padding-top:10px:padding-bottom:10px;background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 10px;width:200px;height:100px;">
					<div id=textPreview style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 10px;width:200px;height:100px;">'.$lang['profiles']['font_now_default'].'</div>
					<script>updateTextPreview();</script>
					</td>
					
					</tr>
					</table>
					
					
					</td>
				</tr>
				<tr class="fixed">
<td class="optionheader" id="row_user_skin">
					'.$lang['profiles']['user_skin'].'</span></span></td>
<td class="list" colSpan="3">
'.$lang['profiles']['user_opt'].'
<select onchange="check_changes(row_user_skin, \''.$ProMemberOPT.'\', this.value)" class="insidetitle" type="text" style="width:50;" name="user_opacity">';
$count=21;
for($num=1;$num<$count;$num++) {
	$op=$num*5;
	$val=ceil(50+($num*2.5));
	echo'
<option value="'.$val.'" '.check_select($selected, "$val").'>'.$op.'</option>';
}
echo'
</select>
<font color="gray" size="-1">'.$lang['profiles']['opt_desc'].'</font>
<table border="0" id="table2">
	<tr>
		<td class="optionsbar_menus">
		<p align="center">1<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="0" name="user_skin" '.check_radio($ProMemberSkin, "0").'>
		<img src="images/skins/skin0.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">2<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="1" name="user_skin" '.check_radio($ProMemberSkin, "1").'>		
        <img src="images/skins/skin1.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">3<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="2" name="user_skin" '.check_radio($ProMemberSkin, "2").'>		
		<img src="images/skins/skin2.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">4<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="3" name="user_skin" '.check_radio($ProMemberSkin, "3").'>		
		<img src="images/skins/skin3.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">5<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="4" name="user_skin" '.check_radio($ProMemberSkin, "4").'>		
		<img src="images/skins/skin4.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">6<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="5" name="user_skin" '.check_radio($ProMemberSkin, "5").'>		
		<img src="images/skins/skin5.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">7<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="6" name="user_skin" '.check_radio($ProMemberSkin, "6").'>		
		<img src="images/skins/skin6.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">8<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="7" name="user_skin" '.check_radio($ProMemberSkin, "7").'>		
		<img src="images/skins/skin7.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">9<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="8" name="user_skin" '.check_radio($ProMemberSkin, "8").'>		
		<img src="images/skins/skin8.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">10<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="9" name="user_skin" '.check_radio($ProMemberSkin, "9").'>		
		<img src="images/skins/skin9.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">11<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="10" name="user_skin" '.check_radio($ProMemberSkin, "10").'>		
		<img src="images/skins/skin10.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">12<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="11" name="user_skin" '.check_radio($ProMemberSkin, "11").'>		
		<img src="images/skins/skin11.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">13<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="12" name="user_skin" '.check_radio($ProMemberSkin, "12").'>		
		<img src="images/skins/skin12.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">14<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="13" name="user_skin" '.check_radio($ProMemberSkin, "13").'>		
		<img src="images/skins/skin13.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">15<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="14" name="user_skin" '.check_radio($ProMemberSkin, "14").'>		
		<img src="images/skins/skin14.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">16<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="15" name="user_skin" '.check_radio($ProMemberSkin, "15").'>		
		<img src="images/skins/skin15.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">17<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="16" name="user_skin" '.check_radio($ProMemberSkin, "16").'>		
		<img src="images/skins/skin16.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">18<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="17" name="user_skin" '.check_radio($ProMemberSkin, "17").'>		
		<img src="images/skins/skin17.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">19<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="18" name="user_skin" '.check_radio($ProMemberSkin, "18").'>		
		<img src="images/skins/skin18.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">20<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="19" name="user_skin" '.check_radio($ProMemberSkin, "19").'>		
		<img src="images/skins/skin19.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">21<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="20" name="user_skin" '.check_radio($ProMemberSkin, "20").'>		
		<img src="images/skins/skin20.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">22<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="21" name="user_skin" '.check_radio($ProMemberSkin, "21").'>		
		<img src="images/skins/skin21.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">23<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="22" name="user_skin" '.check_radio($ProMemberSkin, "22").'>		
		<img src="images/skins/skin22.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">24<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="23" name="user_skin" '.check_radio($ProMemberSkin, "23").'>		
		<img src="images/skins/skin23.jpg" width="100" height="100"></td>
		</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">25<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="24" name="user_skin" '.check_radio($ProMemberSkin, "24").'>		
		<img src="images/skins/skin24.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">26<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="25" name="user_skin" '.check_radio($ProMemberSkin, "25").'>		
		<img src="images/skins/skin25.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">27<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="26" name="user_skin" '.check_radio($ProMemberSkin, "26").'>		
		<img src="images/skins/skin26.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">28<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="27" name="user_skin" '.check_radio($ProMemberSkin, "27").'>		
		<img src="images/skins/skin27.jpg" width="100" height="100"></td>
				</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">29<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="28" name="user_skin" '.check_radio($ProMemberSkin, "28").'>		
		<img src="images/skins/skin28.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">30<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="29" name="user_skin" '.check_radio($ProMemberSkin, "29").'>		
		<img src="images/skins/skin29.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">31<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="30" name="user_skin" '.check_radio($ProMemberSkin, "30").'>		
		<img src="images/skins/skin30.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">32<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="31" name="user_skin" '.check_radio($ProMemberSkin, "31").'>		
		<img src="images/skins/skin31.jpg" width="100" height="100"></td>
				</tr>
	<tr>
				<td class="optionsbar_menus">
		<p align="center">33<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="32" name="user_skin" '.check_radio($ProMemberSkin, "32").'>		
		<img src="images/skins/skin32.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">34<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="33" name="user_skin" '.check_radio($ProMemberSkin, "33").'>		
		<img src="images/skins/skin33.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">35<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="34" name="user_skin" '.check_radio($ProMemberSkin, "34").'>		
		<img src="images/skins/skin34.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">36<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="35" name="user_skin" '.check_radio($ProMemberSkin, "35").'>		
		<img src="images/skins/skin35.jpg" width="100" height="100"></td>
						</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">37<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="36" name="user_skin" '.check_radio($ProMemberSkin, "36").'>		
		<img src="images/skins/skin36.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">38<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="37" name="user_skin" '.check_radio($ProMemberSkin, "37").'>		
		<img src="images/skins/skin37.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">39<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="38" name="user_skin" '.check_radio($ProMemberSkin, "38").'>		
		<img src="images/skins/skin38.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">40<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="39" name="user_skin" '.check_radio($ProMemberSkin, "39").'>		
		<img src="images/skins/skin39.jpg" width="100" height="100"></td>
	</tr></table>
					</td>
					</tr>
				<tr class="fixed">
					<td class="list_center" colSpan="4">
					<center>
						<font color="red">'.$lang['others']['insert_true_captcha'].'<br>

					<div id="captchabox">
<table><tbody>
<tr><td valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
<?php
echo'
</td>
<td valign="top"><img width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'"></td>
<td valign="top"><nobr><center><b><font color="red">'.$lang['others']['captcha'].'<br><input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div>
</center>
					<input onclick="submitdetails()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
				</tr>
			</table>
			</form>
		</center></td>
	</tr>
</table>
</center><div style="color:red;text-align:center;font-size:10pt;font-family:arial;font-weight:bold">'.$lang['profiles']['edit_note'].'</div>';

    }
    else {
    redirect();
    }

}



if ($type == "insert_details") {

    if ($DBMemberID > 0) {

$user_size = DBi::$con->real_escape_string($_POST["user_size"]);
$user_align= DBi::$con->real_escape_string($_POST["user_align"]);
$user_font = DBi::$con->real_escape_string($_POST["user_font"]);
$user_colors = DBi::$con->real_escape_string($_POST["g1"]);
$user_weight = DBi::$con->real_escape_string($_POST["user_weight"]);

$user_fonts = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_fonts"]));



$user_occupation = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['user_occupation']));
$user_country = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_country"]));
$user_city = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_city"]));
$user_state = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_state"]));
$user_age = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_age"]));
$user_gender = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_gender"]));
$user_photo_url = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_photo_url"]));
$user_photo_purl = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_photo_purl"]));
$user_marstatus = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_marstatus"]));
$user_hideemail = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hideemail"]));
$user_bio = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_bio"]));
$user_education = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_education"]));
$user_peducation = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_peducation"]));
$user_realname = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_realname"]));
$user_hobby = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hobby"]));
$user_title = DBi::$con->real_escape_string($_POST["user_title"]);
$user_pmhide = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pmhide"]));
$user_browse = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hideactivity"]));
$user_editor = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_editor"]));
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
$user_year = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_year"]));
$user_month = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_month"]));
$user_day = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_day"]));
$user_skin = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_skin"]));
$user_opt =  DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_opacity"]));
	$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));

$carray = array('',$lang['country']['country_1'],$lang['country']['country_2'],$lang['country']['country_3'],$lang['country']['country_4'],$lang['country']['country_5'],$lang['country']['country__5'],$lang['country']['country___5'],$lang['country']['country_6'],$lang['country']['country_7'],$lang['country']['country_8'],$lang['country']['country_9'],$lang['country']['country_10'],$lang['country']['country_11'],$lang['country']['country_12'],$lang['country']['country_13'],$lang['country']['country_14'],$lang['country']['country_15'],$lang['country']['country_16'],$lang['country']['country_17'],$lang['country']['country_18'],$lang['country']['country_19'],$lang['country']['country_20'],$lang['country']['country_21'],$lang['country']['country_22'],$lang['country']['country_23'],$lang['country']['country_24'],$lang['country']['country_25'],$lang['country']['country_26'],$lang['country']['country_27'],$lang['country']['country_28'],$lang['country']['country_29'],$lang['country']['country_30'],$lang['country']['country_31'],$lang['country']['country_32'],$lang['country']['country_33'],$lang['country']['country_34'],$lang['country']['country_35'],$lang['country']['country_36'],$lang['country']['country_37'],$lang['country']['country_38'],$lang['country']['country_39'],$lang['country']['country_40'],$lang['country']['country_41'],$lang['country']['country_42'],$lang['country']['country_43'],$lang['country']['country_44'],$lang['country']['country_45'],$lang['country']['country_46'],$lang['country']['country_47'],$lang['country']['country_48'],$lang['country']['country_49'],$lang['country']['country_50'],$lang['country']['country_51'],$lang['country']['country_52'],$lang['country']['country_53'],$lang['country']['country_54'],$lang['country']['country_55'],$lang['country']['country_56'],$lang['country']['country_57'],$lang['country']['country_58'],$lang['country']['country_59'],$lang['country']['country_60'],$lang['country']['country_61'],$lang['country']['country_62'],$lang['country']['country_63'],$lang['country']['country_64'],$lang['country']['country_65'],$lang['country']['country_66'],$lang['country']['country_67'],$lang['country']['country_68'],$lang['country']['country_69'],$lang['country']['country_70'],$lang['country']['country_71'],$lang['country']['country_72'],$lang['country']['country_73'],$lang['country']['country_74'],$lang['country']['country_75'],$lang['country']['country_76'],$lang['country']['country_77'],$lang['country']['country_78'],$lang['country']['country_79'],$lang['country']['country_80'],$lang['country']['country_81'],$lang['country']['country_82'],$lang['country']['country_83'],$lang['country']['country_84'],$lang['country']['country_85'],$lang['country']['country_86'],$lang['country']['country_87'],$lang['country']['country_88'],$lang['country']['country_89'],$lang['country']['country_90'],$lang['country']['country_91'],$lang['country']['country_92'],$lang['country']['country_93'],$lang['country']['country_94'],$lang['country']['country_95'],$lang['country']['country_96'],$lang['country']['country_97'],$lang['country']['country_98'],$lang['country']['country_99'],$lang['country']['country_100'],$lang['country']['country_101'],$lang['country']['country_102'],$lang['country']['country_103'],$lang['country']['country_104'],$lang['country']['country_105'],$lang['country']['country_106'],$lang['country']['country_107'],$lang['country']['country_108'],$lang['country']['country_109'],$lang['country']['country_110'],$lang['country']['country_111'],$lang['country']['country_112'],$lang['country']['country_113'],$lang['country']['country_114'],$lang['country']['country_115'],$lang['country']['country_116'],$lang['country']['country_117'],$lang['country']['country_118'],$lang['country']['country_119'],$lang['country']['country_120'],$lang['country']['country_121'],$lang['country']['country_122'],$lang['country']['country_123'],$lang['country']['country_124'],$lang['country']['country_125'],$lang['country']['country_126'],$lang['country']['country_127'],$lang['country']['country_128'],$lang['country']['country_129'],$lang['country']['country_130'],$lang['country']['country_131'],$lang['country']['country_132'],$lang['country']['country_133'],$lang['country']['country_134'],$lang['country']['country_135'],$lang['country']['country_136'],$lang['country']['country_137'],$lang['country']['country_138'],$lang['country']['country_139'],$lang['country']['country_140'],$lang['country']['country_141'],$lang['country']['country_142'],$lang['country']['country_143'],$lang['country']['country_144'],$lang['country']['country_145'],$lang['country']['country_146'],$lang['country']['country_147'],$lang['country']['country_148'],$lang['country']['country_149'],$lang['country']['country_150'],$lang['country']['country_151'],$lang['country']['country_152'],$lang['country']['country_153'],$lang['country']['country_154'],$lang['country']['country_156'],$lang['country']['country_157'],$lang['country']['country_158'],$lang['country']['country_159'],$lang['country']['country_160'],$lang['country']['country_161'],$lang['country']['country_162'],$lang['country']['country_163'],$lang['country']['country_164'],$lang['country']['country_165'],$lang['country']['country_166'],$lang['country']['country_167'],$lang['country']['country_168'],$lang['country']['country_169'],$lang['country']['country_170'],$lang['country']['country_171'],$lang['country']['country_172'],$lang['country']['country_173'],$lang['country']['country_174'],$lang['country']['country_175'],$lang['country']['country_176'],$lang['country']['country_177'],$lang['country']['country_178'],$lang['country']['country_179'],$lang['country']['country_180'],$lang['country']['country_181'],$lang['country']['country_182'],$lang['country']['country_183'],$lang['country']['country_184'],$lang['country']['country_185'],$lang['country']['country_186'],$lang['country']['country_187'],$lang['country']['country_188'],$lang['country']['country_189'],$lang['country']['country_190'],$lang['country']['country_191'],$lang['country']['country_192'],$lang['country']['country_193'],$lang['country']['country_194'],$lang['country']['country_195'],$lang['country']['country_196'],$lang['country']['country_197'],$lang['country']['country_198'],$lang['country']['country_199'],$lang['country']['country_200'],$lang['country']['country_201'],$lang['country']['country_202'],$lang['country']['country_203'],$lang['country']['country_204'],$lang['country']['country_205'],$lang['country']['country_206'],$lang['country']['country_207'],$lang['country']['country_208'],$lang['country']['country_209'],$lang['country']['country_210'],$lang['country']['country_211'],$lang['country']['country_212'],$lang['country']['country_213'],$lang['country']['country_214'],$lang['country']['country_215'],$lang['country']['country_216'],$lang['country']['country_217'],$lang['country']['country_218'],$lang['country']['country_219'],$lang['country']['country_220'],$lang['country']['country_221']);
if(in_array($user_country,$carray)){
	$cpass = "";
}
if(!in_array($user_country,$carray)){
	$cpass = "no";
}
if(is_numeric($user_age) && $user_age > 0 && $user_age < 100 ){
	$cpass = "";
}
if($user_age > 100) {
	$cpass = "no";
}

require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
	
	if($error != "") {
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
	 $_SESSION['DF_choose_style'] = $user_skin;
		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
        $query .= "M_CITY = ('$user_city'), ";
        $query .= "M_STATE = ('$user_state'), ";
		if($cpass != ""){
		$no = "";
        $query .= "M_AGE = '$no', ";
        $query .= "M_COUNTRY = '$no', ";
		} else {
        $query .= "M_AGE = '$user_age', ";
        $query .= "M_COUNTRY = '$user_country', ";
		}
        $query .= "M_PHOTO_URL = ('$user_photo_url'), ";
		$query .= "M_MARSTATUS = ('$user_marstatus'), ";
        $query .= "M_RECEIVE_EMAIL = ('$user_hideemail'), ";
        $query .= "M_BIO = ('$user_bio'), ";
        $query .= "M_OCCUPATION = ('$user_occupation'), ";
        $query .= "M_PMHIDE = ('$user_pmhide'), ";
        $query .= "M_BROWSE = ('$user_browse'), ";
		$query .= "M_SKIN = ('$user_skin'), "; 
		$query .= "M_OPT = ('$user_opt'), "; 
		$query .= "M_SIZE = ('$user_size'),  ";
        $query .= "M_ALIGN= ('$user_align'),  ";
        $query .= "M_FONTS_T = ('$user_font'),  ";
        $query .= "M_COLOR = ('$user_colors'),  ";
        $query .= "M_WEIGHT = ('$user_weight')  ";
        $query .= "WHERE MEMBER_ID = ".$DBMemberID." ";
		DBi::$con->query($query) or die (DBi::$con->error);

                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['profile']['your_details_has_edited'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php?mode=profile&type=details">
                           <a href="index.php?mode=profile&type=details">'.$lang['profile']['click_here_to_go_normal_page'].'</a><br>
	                       <br></td>
	                   </tr>
	                </table>
	                </center>';
}

  
    }
    else {
    redirect();
    }

}
if ($type == "ihsaa"){
if ($Mlevel ==  4) {
					 require_once("details.php");

}
}

if ($type == "edit_pass") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
if (members("PASS", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][pass].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}

    if ($DBMemberID > 0) {
 $query = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = ".$DBMemberID." ";
 $result = DBi::$con->query($query) or die (DBi::$con->error);

 if(mysqli_num_rows($result) > 0){
 $rs=mysqli_fetch_array($result);

 $ProMemberID = $rs['MEMBER_ID'];
 $ProMemberName = $rs['M_NAME'];
 $ProMemberPassword = $rs['M_PASSWORD'];

 }


echo'
<script>

 function submitpass()
{


if (passinfo.user_password0.value.length != 0)
{

if (passinfo.user_password1.value.length == 0)
    {
	confirm("'.$lang['register']['necessary_to_insert_password'].'");
	return;
    }

if (passinfo.user_password1.value.length != 0)
{
    if (passinfo.user_password1.value.length < 6)
	{
	confirm("'.$lang['register']['necessary_to_insert_more_five_letter_to_password'].'");
	return;
	}
}

if (passinfo.user_password1.value.length > 24)
	{
	confirm("'.$lang['register']['necessary_to_insert_less_twenty_four_letter_to_password'].'");
	return;
	}

if (passinfo.user_password1.value.length != 0)
{
    if (passinfo.user_password2.value.length < 6)
	{
	confirm("'.$lang['register']['necessary_to_insert_confirm_password'].'");
	return;
	}
}

if (passinfo.user_password1.value  != passinfo.user_password2.value)
	{
	confirm("'.$lang['register']['necessary_to_insert_true_confirm_password'].'");
	return;
	}

if (passinfo.user_password1.value  == passinfo.user_name.value)
	{
	confirm("'.$lang['register']['necessary_to_password_reversal_to_user_name'].'");
	return;
	}

if (passinfo.user_password1.value.toLowerCase()  == passinfo.user_name.value.toLowerCase())
	{
	confirm("'.$lang['register']['necessary_to_password_reversal_to_user_name'].'");
	return;
	}

}
if (passinfo.user_password0.value.length == 0)
	{
	confirm("'.$lang['register']['please_write_the_old_password'].'");
	return;
	}


passinfo.submit();
}
</script>';


echo'
<center>
<table cellSpacing="0" cellPadding="0" border="0">
<tr><td colspan="4" class="optionsbar_menus"><center>
<font color="red" size="+2">'.$lang['profile']['edit_your_details'].'</font><br>'.$lang['profile']['please_update_your_details'].'</center></td></tr>
	<tr>
		<td>
            <form name="passinfo" method="post" action="index.php?mode=profile&type=insert_pass">
            <input value="'.$ProMemberName.'" type="hidden" name="user_name">
            <input value="'.$ProMemberPassword.'" type="hidden" name="user_password">
			<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0">
				<tr class="fixed">
					<td class="optionheader" id="row_user_password0"><nobr>'.$lang['profile']['your_password_to_use_now'].' </nobr></td>
					<td class="list" align="right" colSpan="1"><input onchange="check_changes(row_user_password0, \'\', this.value)" class="insidetitle" style="WIDTH: 200px" type="password" name="user_password0"></td>
				</tr>
				<tr class="fixed">
					<td class="optionheader" id="row_user_password1"><nobr>'.$lang['profile']['the_new_password'].' </nobr></td>
					<td class="list"><input onchange="check_changes(row_user_password1, \'\', this.value)" class="insidetitle" style="WIDTH: 200px" type="password" name="user_password1"></td>
					</tr>
									<tr class="fixed">

					<td class="optionheader" id="row_user_password2"><nobr>'.$lang['profile']['the_confirm_new_password'].' </nobr></td>
					<td class="list"><input onchange="check_changes(row_user_password2, \'\', this.value)" class="insidetitle" style="WIDTH: 200px" type="password" name="user_password2"></td>
				</tr>

				<tr class="fixed">
					<td class="list_center" colSpan="2">
<center>
						<font color="red">'.$lang['others']['insert_true_captcha'].'<br>

					<div id="captchabox">
<table><tbody>
<tr><td valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
<?php
echo'
</td>
<td valign="top"><img width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'"></td>
<td valign="top"><nobr><center><b><font color="red">'.$lang['others']['captcha'].'<br><input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div>
</center>
					<input onclick="submitpass()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
				</tr>
				
			</table>
		</form>
		</center></td>
	</tr>
</table>
</center><div style="color:red;text-align:center;font-size:10pt;font-family:arial;font-weight:bold">'.$lang['profiles']['edit_note'].'</div>';

    }
    else {
    redirect();
    }

}


if ($type == "insert_pass") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
    if ($DBMemberID > 0) {


$user_password = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_password"]));
$user_password0 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_password0"]));
$user_password1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_password1"]));
$user_password2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_password2"]));

$md_password0 = MD5($user_password0);
	$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));

if ($user_password0 != "") {
    if ($user_password != $md_password0) {
        $error = $lang['profile']['the_password_not_identical_to_the_confirm_password'];
    }
}

require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
	
	
if ($error != "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$error.'..</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


if ($error == "") {
		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
  
    if ($user_password0 != "") {
        $user_password1 = MD5($user_password1);
        $query .= "M_PASSWORD = ('$user_password1') ";
    }
        $query .= "WHERE MEMBER_ID = ".$DBMemberID." ";
        DBi::$con->query($query) or die (DBi::$con->error);

         $HTTP_SESSION_VARS['new_pass'] = true;

                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['profile']['your_details_has_edited'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php?mode=profile&type=details">
                           <a href="index.php?mode=profile&type=details">'.$lang['profile']['click_here_to_go_normal_page'].'</a><br><br>
                           <a href="index.php">'.$lang['profile']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


    }
    else {
    redirect();
    }

}

/////////////////////////


if ($type == "edit_email") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
if (members("PASS", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][pass].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}

       if ($DBMemberID > 0) {
		
$queryCH = "SELECT * FROM " . $Prefix . "EMAIL_PED ";
$queryCH .= "WHERE MEMBERID = '$DBMemberID' AND UNDERDEMANDE = '1' ";
$resultCH = @DBi::$con->query($queryCH) or die (DBi::$con->error);

if(mysqli_num_rows($resultCH) > 0){
$rsCH = @mysqli_fetch_array($resultCH);

$ChNewEmail = $rsCH['NEW_EMAIL'];
}
 $query = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = ".$DBMemberID." ";
 $result = DBi::$con->query($query) or die (DBi::$con->error);

 if(mysqli_num_rows($result) > 0){
 $rs=mysqli_fetch_array($result);

 $ProMemberID = $rs['MEMBER_ID'];
 $ProMemberName = $rs['M_NAME'];
 $ProMemberEmail = $rs['M_EMAIL'];
 $ProMemberPassword = $rs['M_PASSWORD'];

 }

if($ChNewEmail != "") {
echo'
<script>

 function submitemail_code()
{


if (emailinfo_code.user_password0.value.length == 0)
	{
	confirm("'.$lang['register']['please_write_the_old_password'].'");
	return;
	}


	
	if (emailinfo_code.user_code.value.length == 0)
	{
	confirm("'.$lang['profiles']['enter_user_code'].'");
	return;
	}


emailinfo_code.submit();
}
</script>';


echo'	
			
<center>
<table cellSpacing="0" cellPadding="0" width="28.8%" border="0">
<tr><td colspan="4" class="optionsbar_menus"><center>
<font color="red" size="+2">'.$lang['profile']['edit_your_details'].'</font><br>'.$lang['profile']['please_update_your_details'].'</center></td></tr>

<tr><td colspan="4" class="optionsbar_menus"><center>
<font color="red" size="+1">'.$lang['profiles']['done_send_user_code'].'</font></center>
</td></tr>
	<tr>
            <form name="emailinfo_code" method="post" action="index.php?mode=profile&type=insert_email_code">
            <input value="'.$ProMemberName.'" type="hidden" name="user_name">
            <input value="'.$ProMemberPassword.'" type="hidden" name="user_password">
            <input value="'.$ProMemberEmail.'" type="hidden" name="user_email">
			<table cellSpacing="1" cellPadding="4" width="29%" bgColor="gray" border="0">
				<tr class="fixed">
					<td class="optionheader" id="row_user_password0"><nobr>'.$lang['profile']['your_password_to_use_now'].' </nobr></td>
					<td class="list" dir="ltr" align="right" colSpan="1"><input onchange="check_changes(row_user_password0, \'\', this.value)" class="insidetitle" style="WIDTH: 100%" type="password" name="user_password0"></td>
				</tr>
								<tr class="fixed">
					<td class="optionheader" id="row_user_code"><nobr>'.$lang['others']['captcha'].' </nobr></td>
					<td class="list" dir="ltr" align="right" colSpan="1"><input onchange="check_changes(row_user_code, \'\', this.value)" class="insidetitle" style="WIDTH: 100%" type="name" name="user_code"></td>
				</tr>

				<tr class="fixed">
					<td class="list_center" colSpan="2">
					<center>
						<font color="red">'.$lang['others']['insert_true_captcha'].'<br>

					<div id="captchabox">
<table><tbody>
<tr><td valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
<?php
echo'
</td>
<td valign="top"><img width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'"></td>
<td valign="top"><nobr><center><b><font color="red">'.$lang['others']['captcha'].'<br><input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div>
</center>
					<input onclick="submitemail_code()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
				</tr>
			</table>
		</form>
		</center></td>
	</tr>
</table>
</center><br><div style="color:red;text-align:center;font-size:10pt;font-family:arial;font-weight:bold">'.$lang['profiles']['edit_note'].'</div>';

} else {	
echo'
<script>

 function submitemail()
{


if (emailinfo.user_password0.value.length == 0)
	{
	confirm("'.$lang['register']['please_write_the_old_password'].'");
	return;
	}


	
	if (emailinfo.user_email0.value.length == 0)
	{
	confirm("'.$lang['register']['please_write_the_old_email'].'");
	return;
	}


if (emailinfo.user_email.value.length == 0)
	{
	confirm("'.$lang['register']['necessary_to_insert_email'].'");
	return;
	}
	
	if (emailinfo.user_email.value.length == 0)
	{
	confirm("'.$lang['register']['necessary_to_insert_email'].'");
	return;
	}


emailinfo.submit();
}
</script>';


echo'



				
<center>
<table cellSpacing="0" cellPadding="0" width="28.8%" border="0">
<tr><td colspan="4" class="optionsbar_menus"><center>
<font color="red" size="+2">'.$lang['profile']['edit_your_details'].'</font><br>'.$lang['profile']['please_update_your_details'].'</center></td></tr>

<tr><td colspan="4" class="optionsbar_menus"><center>
<font color="red" size="+1">'.$lang['profiles']['edit_email_desc'].'</font></center>
</td></tr>
	<tr>
            <form name="emailinfo" method="post" action="index.php?mode=profile&type=insert_email">
            <input value="'.$ProMemberName.'" type="hidden" name="user_name">
            <input value="'.$ProMemberPassword.'" type="hidden" name="user_password">
            <input value="'.$ProMemberEmail.'" type="hidden" name="user_email">
			<table cellSpacing="1" cellPadding="4" width="29%" bgColor="gray" border="0">
				<tr class="fixed">
					<td class="optionheader" id="row_user_password0"><nobr>'.$lang['profile']['your_password_to_use_now'].' </nobr></td>
					<td class="list" dir="ltr" align="right" colSpan="1"><input onchange="check_changes(row_user_password0, \'\', this.value)" class="insidetitle" style="WIDTH: 100%" type="password" name="user_password0"></td>
				</tr>
								<tr class="fixed">
					<td class="optionheader" id="row_user_email0"><nobr>'.$lang['profiles']['now_member_email'].' </nobr></td>
					<td class="list" dir="ltr" align="right" colSpan="1"><input onchange="check_changes(row_user_email0, \'\', this.value)" class="insidetitle" style="WIDTH: 100%" type="name" name="user_email0"></td>
				</tr>
								<tr class="fixed">
					<td class="optionheader" id="row_user_email1"><nobr>'.$lang['profiles']['new_member_email'].' </nobr></td>
					<td class="list" dir="ltr" align="right" colSpan="1"><input onchange="check_changes(row_user_email1, \'\', this.value)" class="insidetitle" style="WIDTH: 100%" type="name" name="user_email1"></td>
				</tr>

				<tr class="fixed">
					<td class="list_center" colSpan="2">
					<center>
						<font color="red">'.$lang['others']['insert_true_captcha'].'<br>

					<div id="captchabox">
<table><tbody>
<tr><td valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
<?php
echo'
</td>
<td valign="top"><img width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'"></td>
<td valign="top"><nobr><center><b><font color="red">'.$lang['others']['captcha'].'<br><input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div>
</center>
					<input onclick="submitemail()" type="button" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
				</tr>
			</table>
		</form>
		</center></td>
	</tr>
</table>
</center><br><div style="color:red;text-align:center;font-size:10pt;font-family:arial;font-weight:bold">'.$lang['profiles']['edit_note'].'</div>';

    }
}
    else {
    redirect();
    }
	
}


if ($type == "insert_email") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
    if ($DBMemberID > 0) {


$user_password = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_password"]));
$user_password0 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_password0"]));
$user_email = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_email"]));
$user_email0 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_email0"]));
$user_email1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_email1"]));
$user_name = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_name"]));

$md_password0 = MD5($user_password0);
	$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));

if ($user_password0 != "") {
    if ($user_password != $md_password0) {
        $error = $lang['profile']['the_password_not_identical_to_the_confirm_password'];
    }
}


if ($user_email0 != "") {
    if ($user_email != $user_email0) {
        $error = $lang['profile']['the_email_not_identical_to_the_confirm_email'];
    }
}

require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
	

	$sql2 = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_EMAIL = '$user_email1' ") or die (DBi::$con->error);
	if(mysqli_num_rows($sql2) > 0){
		$rs = mysqli_fetch_array($sql2);
		$m_email = $rs['M_EMAIL'];
	}
	
	if ($m_email == $user_email1) {
		$error = $lang['register']['this_email_was_used'];
	}	

	
	 function temy ($temy) {
    $chars = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $string = array_rand($chars, $temy);
    foreach($string as $s)
    {
        $ret .= $chars[$s];
    }
	return $ret;
 }

$code = temy(11);

$sql = DBi::$con->query("SELECT * FROM ".prefix."EMAIL_PED WHERE CODE = '$code' ");
if( $rows = mysqli_fetch_array($sql))
{

 $code = temy(11);
}

if ($error != "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$error.'..</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


if ($error == "") {
$message     = '<p align="right">'.$lang['members']['members'].': '.$user_name.'<br><br>'.$lang['e-emails']['change_email_message_1'].' '.$code.'<br><br>'.$lang['e-emails']['change_email_message_2'].' '.$forum_title.'</p>';
$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['change_email_subject'].'';
$headers  = 'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
$headers .= "From: ".$admin_email."";
mail($user_email1, $title, $message, $headers);
DBi::$con->query ("INSERT INTO " . $Prefix . "EMAIL_PED (CHEMAIL_ID, MEMBERID, NEW_EMAIL, LAST_EMAIL, UNDERDEMANDE, CH_DATE, CODE) VALUES (NULL, '$DBMemberID', '$user_email1', '$user_email0', '1', '".time()."', $code)") or die(DBi::$con->error);



                    echo'
	               
									<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="+2"><center><br>'.$lang['profiles']['done_go_to_email'].'</center></font><br>
 <meta http-equiv="Refresh" content="2; URL=index.php?mode=profile&type=details">
                           <a href="index.php?mode=profile&type=details"><center>'.$lang['profile']['click_here_to_go_normal_page'].'</center></a><br>
                           <a href="index.php"><center>'.$lang['profile']['click_here_to_go_home'].'</center></a><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


    }
    else {
    redirect();
    }

}


if ($type == "send_email") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
    if ($DBMemberID > 0) {
		
	$sql2 = DBi::$con->query("SELECT * FROM ".prefix."EMAIL_PED WHERE CH_DONE = '0' AND UNDERDEMANDE = '1' ") or die (DBi::$con->error);
	if(mysqli_num_rows($sql2) > 0){
		$rs = mysqli_fetch_array($sql2);
		$m_email = $rs['NEW_EMAIL'];
		$m_username = member_name($rs['MEMBERID']);
		$m_code = $rs['CODE'];
	}

$message     = '<p align="right">'.$lang['members']['members'].': '.$m_username.'<br><br>'.$lang['e-emails']['change_email_message_1'].' '.$m_code.'<br><br>'.$lang['e-emails']['change_email_message_2'].' '.$forum_title.'</p>';
$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['change_email_subject'].'';
$headers  = "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-type: text/html; charset=utf8\r\n"; 
$headers .= "From: ".$admin_email."";
mail($m_email, $title, $message, $headers);


                    echo'
	               
									<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="+2"><center><br>'.$lang['profiles']['done_try_email'].'</center></font><br>
 <meta http-equiv="Refresh" content="2; URL=index.php?mode=profile&type=details">
                           <a href="index.php?mode=profile&type=details"><center>'.$lang['profile']['click_here_to_go_normal_page'].'</center></a><br>
                           <a href="index.php"><center>'.$lang['profile']['click_here_to_go_home'].'</center></a><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';



    }
    else {
    redirect();
    }

}

if ($type == "insert_email_code") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
    if ($DBMemberID > 0) {

$queryCH = "SELECT * FROM " . $Prefix . "EMAIL_PED ";
$queryCH .= "WHERE MEMBERID = '$DBMemberID' AND UNDERDEMANDE = '1' ";
$resultCH = @DBi::$con->query($queryCH) or die (DBi::$con->error);

if(mysqli_num_rows($resultCH) > 0){
$rsCH = @mysqli_fetch_array($resultCH);

$eid = $rsCH['CHEMAIL_ID'];
$email = $rsCH['NEW_EMAIL'];
$user_code = $rsCH['CODE'];
}


$user_password = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_password"]));
$user_password0 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_password0"]));
$user_cur_code = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_code"]));
$user_name = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_name"]));

$md_password0 = MD5($user_password0);

if ($user_password0 != "") {
    if ($user_password != $md_password0) {
        $error = $lang['profile']['the_password_not_identical_to_the_confirm_password'];
    }
}


if ($user_cur_code != $user_code) {
        $error = $lang['profiles']['error_user_code'];
}

if ($error != "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$error.'..</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


if ($error == "") {
		$null = "";
		$sql = DBi::$con->query("DELETE FROM ".prefix."EMAIL_PED WHERE MEMBERID = '$DBMemberID' ");
		
		$sql = "UPDATE ".prefix."MEMBERS SET ";
		$sql .= "M_EMAIL = '$email' ";
		$sql .= "WHERE MEMBER_ID = '$DBMemberID' ";
		DBi::$con->query($sql) or die (DBi::$con->error);
		



                    echo'
	               
									<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="+2"><center><br>'.$lang['profiles']['done_change_email'].'</center></font><br>
 <meta http-equiv="Refresh" content="2; URL=index.php?mode=profile&type=details">
                           <a href="index.php?mode=profile&type=details"><center>'.$lang['profile']['click_here_to_go_normal_page'].'</center></a><br>
                           <a href="index.php"><center>'.$lang['profile']['click_here_to_go_home'].'</center></a><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


    }
    else {
    redirect();
    }

}
/////////////////////////


if($type == "send_pass") {
if($Mlevel > 2) {	
if($id != "") {

 $FP = @DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '".$id."' ") or die (DBi::$con->error);
 $fp_r = @mysqli_fetch_array($FP);
 $email = $fp_r['M_EMAIL'];
 $name = $fp_r['M_NAME'];
 $code = $fp_r['M_CODE'];
	if(getenv(HTTP_X_FORWARDED_FOR)){
		$ip=getenv(HTTP_X_FORWARDED_FOR);
	}
	elseif(getenv(HTTP_CLIENT_IP)){
		$ip=getenv(HTTP_CLIENT_IP);
	}
	else{
		$ip=getenv(REMOTE_ADDR); 
	} 
 $date = time();
 if($id == 1) {
$done_normal = $lang[out][member_is_admin];
} else {
$done_normal = $lang['others']['done_send_pass'];	
}

		$country=modo_ip($ip);
if($country == "TN"){$txt = $lang['country']['country_106'];}
		 if($country == "AZ"){$txt = $lang['country']['country_2'];}
if($country == "ET"){$txt = $lang['country']['country_1'];}
		 if($country == "AM"){$txt = $lang['country']['country_3'];}
if($country == "ER"){$txt = $lang['country']['country_4'];}
		 if($country == "ES"){$txt = $lang['country']['country_5'];}
if($country == "UZ"){$txt = $lang['country']['country___5'];}
		 if($country == "AU"){$txt = $lang['country']['country__5'];}
if($country == "EE"){$txt = $lang['country']['country_6'];}
		 if($country == "SS"){$txt = $lang['country']['country_7'];}
if($country == "AF"){$txt = $lang['country']['country_8'];}
		 if($country == "AL"){$txt = $lang['country']['country_9'];}
if($country == "DE"){$txt = $lang['country']['country_10'];}
		 if($country == "DD"){$txt = $lang['country']['country_11'];}
if($country == "AG"){$txt = $lang['country']['country_12'];}
		 if($country == "EN"){$txt = $lang['country']['country_13'];}
if($country == "AI"){$txt = $lang['country']['country_14'];}
		 if($country == "AD"){$txt = $lang['country']['country_15'];}
if($country == "ID"){$txt = $lang['country']['country_16'];}
		 if($country == "AO"){$txt = $lang['country']['country_17'];}
if($country == "UY"){$txt = $lang['country']['country_18'];}
		 if($country == "UG"){$txt = $lang['country']['country_19'];}
if($country == "UA"){$txt = $lang['country']['country_20'];}
		 if($country == "IR"){$txt = $lang['country']['country_21'];}
if($country == "IE"){$txt = $lang['country']['country_22'];}
		 if($country == "ND"){$txt = $lang['country']['country_23'];}
if($country == "IS"){$txt = $lang['country']['country_24'];}
		 if($country == "IT"){$txt = $lang['country']['country_25'];}
if($country == "ZS"){$txt = $lang['country']['country_26'];}
		 if($country == "AR"){$txt = $lang['country']['country_27'];}
if($country == "JO"){$txt = $lang['country']['country_28'];}
		 if($country == "EC"){$txt = $lang['country']['country_29'];}
if($country == "AE"){$txt = $lang['country']['country_30'];}
		 if($country == "BH"){$txt = $lang['country']['country_31'];}
if($country == "BR"){$txt = $lang['country']['country_32'];}
		 if($country == "PT"){$txt = $lang['country']['country_33'];}
if($country == "BS"){$txt = $lang['country']['country_34'];}
		 if($country == "BA"){$txt = $lang['country']['country_35'];}
if($country == "CZ"){$txt = $lang['country']['country_36'];}
		 if($country == "GA"){$txt = $lang['country']['country_37'];}
if($country == "DZ"){$txt = $lang['country']['country_38'];}
		 if($country == "DK"){$txt = $lang['country']['country_39'];}
if($country == "DO"){$txt = $lang['country']['country_40'];}
		 if($country == "AS"){$txt = $lang['country']['country_41'];}
if($country == "SA"){$txt = $lang['country']['country_42'];}
         if($country == "SV"){$txt = $lang['country']['country_43'];}
if($country == "SN"){$txt = $lang['country']['country_44'];}
         if($country == "SD"){$txt = $lang['country']['country_45'];}
if($country == "SE"){$txt = $lang['country']['country_46'];}
         if($country == "SC"){$txt = $lang['country']['country_47'];}
if($country == "SO"){$txt = $lang['country']['country_48'];}
         if($country == "CN"){$txt = $lang['country']['country_49'];}
if($country == "IQ"){$txt = $lang['country']['country_50'];}
         if($country == "PH"){$txt = $lang['country']['country_51'];}
if($country == "CM"){$txt = $lang['country']['country_52'];}
         if($country == "CG"){$txt = $lang['country']['country_53'];}
if($country == "KW"){$txt = $lang['country']['country_54'];}
         if($country == "HU"){$txt = $lang['country']['country_55'];}
if($country == "MA"){$txt = $lang['country']['country_56'];}
         if($country == "MX"){$txt = $lang['country']['country_57'];}
if($country == "MU"){$txt = $lang['country']['country_58'];}
         if($country == "NO"){$txt = $lang['country']['country_59'];}
if($country == "AT"){$txt = $lang['country']['country_60'];}
         if($country == "NP"){$txt = $lang['country']['country_61'];}
if($country == "IN"){$txt = $lang['country']['country_63'];}
         if($country == "NE"){$txt = $lang['country']['country_62'];}
if($country == "HN"){$txt = $lang['country']['country_64'];}
         if($country == "US"){$txt = $lang['country']['country_65'];}
if($country == "JP"){$txt = $lang['country']['country_66'];}
         if($country == "YE"){$txt = $lang['country']['country_67'];}
if($country == "GR"){$txt = $lang['country']['country_68'];}
         if($country == "AQ"){$txt = $lang['country']['country_69'];}
if($country == "PG"){$txt = $lang['country']['country_70'];}
         if($country == "PY"){$txt = $lang['country']['country_71'];}
if($country == "PK"){$txt = $lang['country']['country_72'];}
         if($country == "PW"){$txt = $lang['country']['country_73'];}
if($country == "BB"){$txt = $lang['country']['country_74'];}
		 if($country == "BM"){$txt = $lang['country']['country_75'];}
if($country == "GB"){$txt = $lang['country']['country_77'];}
         if($country == "BE"){$txt = $lang['country']['country_78'];}
if($country == "BG"){$txt = $lang['country']['country_79'];}
         if($country == "BZ"){$txt = $lang['country']['country_80'];}
if($country == "BD"){$txt = $lang['country']['country_81'];}
         if($country == "PA"){$txt = $lang['country']['country_82'];}
if($country == "BJ"){$txt = $lang['country']['country_83'];}
         if($country == "IL"){$txt = $lang['country']['country_165'];}
if($country == "BT"){$txt = $lang['country']['country_84'];}
if($country == "BW"){$txt = $lang['country']['country_85'];}
         if($country == "BF"){$txt = $lang['country']['country_87'];}
if($country == "PR"){$txt = $lang['country']['country_86'];}
         if($country == "BI"){$txt = $lang['country']['country_88'];}
if($country == "PL"){$txt = $lang['country']['country_89'];}
         if($country == "BO"){$txt = $lang['country']['country_90'];}
if($country == "PF"){$txt = $lang['country']['country_91'];}
         if($country == "PE"){$txt = $lang['country']['country_92'];}
if($country == "TJ"){$txt = $lang['country']['country_93'];}
         if($country == "TH"){$txt = $lang['country']['country_94'];}
if($country == "TW"){$txt = $lang['country']['country_95'];}
         if($country == "TM"){$txt = $lang['country']['country_96'];}
if($country == "TR"){$txt = $lang['country']['country_97'];}
         if($country == "TT"){$txt = $lang['country']['country_98'];}
if($country == "TD"){$txt = $lang['country']['country_99'];}
         if($country == "CE"){$txt = $lang['country']['country_100'];}
if($country == "CL"){$txt = $lang['country']['country_101'];}
         if($country == "TZ"){$txt = $lang['country']['country_102'];}
if($country == "TG"){$txt = $lang['country']['country_103'];}
         if($country == "TV"){$txt = $lang['country']['country_104'];}
if($country == "TO"){$txt = $lang['country']['country_105'];}
         if($country == "TP"){$txt = $lang['country']['country_107'];}
if($country == "GM"){$txt = $lang['country']['country_108'];}
         if($country == "GI"){$txt = $lang['country']['country_110'];}
if($country == "JM"){$txt = $lang['country']['country_109'];}
         if($country == "GD"){$txt = $lang['country']['country_111'];}
if($country == "AN"){$txt = $lang['country']['country_112'];}
         if($country == "RE"){$txt = $lang['country']['country_113'];}
if($country == "SB"){$txt = $lang['country']['country_114'];}
         if($country == "FK"){$txt = $lang['country']['country_115'];}
if($country == "FK"){$txt = $lang['country']['country_116'];}
         if($country == "KY"){$txt = $lang['country']['country_117'];}
if($country == "CC"){$txt = $lang['country']['country_118'];}
         if($country == "MH"){$txt = $lang['country']['country_119'];}
if($country == "MV"){$txt = $lang['country']['country_120'];}
         if($country == "GL"){$txt = $lang['country']['country_121'];}
if($country == "FO"){$txt = $lang['country']['country_122'];}
         if($country == "FJ"){$txt = $lang['country']['country_123'];}
if($country == "CK"){$txt = $lang['country']['country_124'];}
         if($country == "BV"){$txt = $lang['country']['country_125'];}
if($country == "CF"){$txt = $lang['country']['country_126'];}
         if($country == "CD"){$txt = $lang['country']['country_127'];}
if($country == "ZA"){$txt = $lang['country']['country_128'];}
         if($country == "GT"){$txt = $lang['country']['country_129'];}
if($country == "GP"){$txt = $lang['country']['country_130'];}
         if($country == "GU"){$txt = $lang['country']['country_131'];}
if($country == "GE"){$txt = $lang['country']['country_132'];}
         if($country == "DJ"){$txt = $lang['country']['country_133'];}
if($country == "GW"){$txt = $lang['country']['country_134'];}
         if($country == "DM"){$txt = $lang['country']['country_135'];}
if($country == "RW"){$txt = $lang['country']['country_136'];}
         if($country == "RU"){$txt = $lang['country']['country_137'];}
if($country == "BY"){$txt = $lang['country']['country_138'];}
         if($country == "RO"){$txt = $lang['country']['country_139'];}
if($country == "ZM"){$txt = $lang['country']['country_140'];}
         if($country == "ZW"){$txt = $lang['country']['country_141'];}
if($country == "CI"){$txt = $lang['country']['country_142'];}
         if($country == "WS"){$txt = $lang['country']['country_143'];}
if($country == "SM"){$txt = $lang['country']['country_144'];}
         if($country == "LC"){$txt = $lang['country']['country_145'];}
if($country == "LK"){$txt = $lang['country']['country_146'];}
         if($country == "SK"){$txt = $lang['country']['country_147'];}
if($country == "SI"){$txt = $lang['country']['country_148'];}
         if($country == "SG"){$txt = $lang['country']['country_149'];}
if($country == "SZ"){$txt = $lang['country']['country_150'];}
         if($country == "SY"){$txt = $lang['country']['country_151'];}
if($country == "SR"){$txt = $lang['country']['country_152'];}
         if($country == "CH"){$txt = $lang['country']['country_153'];}
if($country == "SL"){$txt = $lang['country']['country_154'];}
         if($country == "SX"){$txt = $lang['country']['country_156'];}
if($country == "OM"){$txt = $lang['country']['country_157'];}
         if($country == "GH"){$txt = $lang['country']['country_158'];}
if($country == "GY"){$txt = $lang['country']['country_159'];}
         if($country == "GF"){$txt = $lang['country']['country_160'];}
if($country == "GN"){$txt = $lang['country']['country_161'];}
         if($country == "GQ"){$txt = $lang['country']['country_162'];}
if($country == "VU"){$txt = $lang['country']['country_163'];}
         if($country == "FR"){$txt = $lang['country']['country_164'];}
if($country == "PS"){$txt = $lang['country']['country_165'];}
         if($country == "VE"){$txt = $lang['country']['country_166'];}
if($country == "FI"){$txt = $lang['country']['country_167'];}
         if($country == "VN"){$txt = $lang['country']['country_168'];}
if($country == "CY"){$txt = $lang['country']['country_169'];}
         if($country == "QA"){$txt = $lang['country']['country_170'];}
if($country == "CV"){$txt = $lang['country']['country_171'];}
         if($country == "KZ"){$txt = $lang['country']['country_172'];}
if($country == "NC"){$txt = $lang['country']['country_173'];}
         if($country == "HR"){$txt = $lang['country']['country_174'];}
if($country == "KH"){$txt = $lang['country']['country_175'];}
         if($country == "CA"){$txt = $lang['country']['country_176'];}
if($country == "CU"){$txt = $lang['country']['country_177'];}
         if($country == "KR"){$txt = $lang['country']['country_178'];}
if($country == "KP"){$txt = $lang['country']['country_179'];}
         if($country == "CR"){$txt = $lang['country']['country_180'];}
if($country == "CO"){$txt = $lang['country']['country_181'];}
         if($country == "KG"){$txt = $lang['country']['country_182'];}
if($country == "EG"){$txt = $lang['country']['country_202'];}
         if($country == "LB"){$txt = $lang['country']['country_187'];}
if($country == "KI"){$txt = $lang['country']['country_183'];}
         if($country == "KE"){$txt = $lang['country']['country_184'];}
if($country == "LV"){$txt = $lang['country']['country_185'];}
         if($country == "LA"){$txt = $lang['country']['country_186'];}
if($country == "LU"){$txt = $lang['country']['country_188'];}
         if($country == "LY"){$txt = $lang['country']['country_189'];}
if($country == "LR"){$txt = $lang['country']['country_190'];}
         if($country == "LT"){$txt = $lang['country']['country_191'];}
if($country == "LS"){$txt = $lang['country']['country_192'];}
         if($country == "LI"){$txt = $lang['country']['country_193'];}
if($country == "MQ"){$txt = $lang['country']['country_194'];}
         if($country == "MO"){$txt = $lang['country']['country_195'];}
if($country == "MW"){$txt = $lang['country']['country_196'];}
         if($country == "MT"){$txt = $lang['country']['country_197'];}
if($country == "ML"){$txt = $lang['country']['country_198'];}
         if($country == "MY"){$txt = $lang['country']['country_199'];}
if($country == "FM"){$txt = $lang['country']['country_200'];}
         if($country == "MG"){$txt = $lang['country']['country_201'];}
if($country == "MK"){$txt = $lang['country']['country_203'];}
         if($country == "MR"){$txt = $lang['country']['country_204'];}
if($country == "MZ"){$txt = $lang['country']['country_205'];}
         if($country == "MD"){$txt = $lang['country']['country_206'];}
if($country == "MC"){$txt = $lang['country']['country_207'];}
         if($country == "MS"){$txt = $lang['country']['country_208'];}
if($country == "MN"){$txt = $lang['country']['country_209'];}
         if($country == "MM"){$txt = $lang['country']['country_210'];}
if($country == "NA"){$txt = $lang['country']['country_211'];}
         if($country == "NR"){$txt = $lang['country']['country_212'];}
if($country == "NU"){$txt = $lang['country']['country_213'];}
         if($country == "NG"){$txt = $lang['country']['country_214'];}
if($country == "NI"){$txt = $lang['country']['country_215'];}
         if($country == "NZ"){$txt = $lang['country']['country_216'];}
if($country == "HT"){$txt = $lang['country']['country_217'];}
         if($country == "NL"){$txt = $lang['country']['country_218'];}
if($country == "HK"){$txt = $lang['country']['country_219'];}
         if($country == "WA"){$txt = $lang['country']['country_220'];}
if($country == "YU"){$txt = $lang['country']['country_221'];}
         if($country == "IL"){$txt = $lang['country']['country_165'];}
if($country == "BN"){$txt = $lang['country']['country_76'];}		
         if($country == "XX"){$txt = $lang['other_things']['not_selected_is'];}
DBi::$con->query("INSERT INTO ".prefix."IP SET DO_ID = '$DBMemberID', M_ID = '$id', IP = '$ip',DATE = '$date',COUNTRY = '$country', COUNTRY_ARABIC = '$txt' ,TYPE = '3' ") or die(DBi::$con->error);
 
$url_final   = Get_deric() . 'index.php?mode=activ_mem&type=password&activ_num='.$code.'&user='.(int)$id;

$message     = '<p align="right">'.$lang['members']['members'].' '.$name .'<br><br>'.$lang['e-emails']['forget_pass_message_1'].'<br><br><a href="'.$url_final.'">'.$url_final.'</a><br><br>'.$lang['e-emails']['forget_pass_message_2'].'</p>';

$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['forget_pass_subject'].'';
$headers  = "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-type: text/html; charset=utf8\r\n"; 
$headers .= "From: ".$admin_email."";
mail($email, $title, $message, $headers);

	                echo'
                    <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font color="red"><b><font size="+2" color="red"><br>'.$done_normal.'</font></b></font><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
	
}
} else {
redirect();	
}	
}

if ($type == "edit_user") {
 if ($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_CHANGE_M == 1)) {

 $query = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$ppMemberID."' ";
 $result = DBi::$con->query($query) or die (DBi::$con->error);

 if(mysqli_num_rows($result) > 0){
 $rs=mysqli_fetch_array($result);

 $ProMemberID = $rs['MEMBER_ID'];
 $ProMemberName = $rs['M_NAME'];
 $ProMemberLevel = $rs['M_LEVEL'];
 $ProMemberEmail = $rs['M_EMAIL'];
 $ProMemberReceiveEmail = $rs['M_RECEIVE_EMAIL'];
 $ProMemberIP = $rs['M_IP'];
 $ProMemberLastIP = $rs['M_LAST_IP'];
 $ProMemberCountry = $rs['M_COUNTRY'];
 $ProMemberCity = $rs['M_CITY'];
 $hld = members("HOLD_POSTS", $ProMemberID);
$activ = members("HOLD_ACTIVE", $ProMemberID);		
if($ProMemberLevel == 4 or ($ProMemberLevel == 3 && members("DEPUTY", $ProMemberID) == 0)) {
		$ProMemberPosts = HoldPosts(posts($ProMemberID), $ProMemberLevel, members("DEPUTY", $ProMemberID), $hld, $activ);
} else {
		$ProMemberPosts = posts($ProMemberID);
}	
 $ProMemberHoldActive = $rs['M_HOLD_ACTIVE'];
 $ProMemberHoldPosts = $rs['M_HOLD_POSTS'];
 $ProMemberState = $rs['M_STATE'];
 $ProMemberOccupation = $rs['M_OCCUPATION'];
 $ProMemberAge = $rs['M_AGE'];
 $ProMemberSex = $rs['M_SEX'];
 $ProMemberPhotoURL = $rs['M_PHOTO_URL'];
 $ProMemberPhotoPURL = $rs['M_PHOTO_PURL'];
 $ProMemberMarStatus = $rs['M_MARSTATUS'];
 $ProMemberBio = $rs['M_BIO'];
 $ProMemberHobby = $rs['M_HOBBY'];
 $ProMemberRealName = $rs['M_REALNAME'];
 $ProMemberTitle = $rs['M_TITLE'];
 $ProMemberOldMod = $rs['M_OLD_MOD'];
 $ProMemberLastApp = $rs['M_LAST_APP'];
 $ProMemberSig = $rs['M_SIG'];
 $ProMemberPmHide = $rs['M_PMHIDE'];
 $ProMemberLogin = $rs['M_ADMIN'];
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
 $ProMemberHobby = $rs['M_HOBBY']; 
 $ProMemberYear = $rs['M_YEAR']; 
 $ProMemberMonth = $rs['M_MONTH']; 
 $ProMemberDay = $rs['M_DAY'];  
 $ProMemberSkin = $rs['M_SKIN'];  
 $ProMemberModMarket = $rs['M_MOD_MARKET']; 
 $ProMemberOPT = $rs['M_OPT']; 
 $ProMemberDeputy = $rs['M_DEPUTY'];  
 $ProMemberVerf = $rs['M_ICON_VERF'];
 $ProMemberNotes = $rs['M_NOTES'];
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
 if($ProMemberLevel == 3 && $ProMemberDeputy == 1) {
 $check_deputy_monitor = "checked";
 $check_monitor = "";
 }
 if($ProMemberLevel == 3 && $ProMemberDeputy == 0) {
 $check_deputy_monitor = "";
 $check_monitor = check_radio($ProMemberLevel, "3");
 }

 }
if($ProMemberID == 1 && $ProMemberLevel == 4 or DBi::$con->real_escape_string(htmlspecialchars($_POST["user_id"])) == 1){
		                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[out][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
echo '
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table class="optionsbar" cellSpacing="2" width="100%" border="0">
			<tr>
				<td vAlign="center"></td>
				<td class="optionsbar_title" vAlign="center" width="100%">'.$lang['profile']['edit_member_details'].' '.$ProMemberName.'</td>';
            go_to_forum();
            echo'
            </tr>
		</table>
		</td>
	</tr>
</table>
</center>
<br>';


echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="60%">
<form method="post" action="index.php?mode=profile&type=edit_user_add">
<input type="hidden" name="user_id" value="'.$ppMemberID.'">';
if($Mlevel == 4) {
echo'	
<input type="hidden" name="user_old_level" value="'.$ProMemberLevel.'">
<input type="hidden" name="user_deputy" value="'.$ProMemberDeputy.'">
<input type="hidden" name="user_old_mod" value="'.$ProMemberOldMod.'">
';
}
echo'

	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['member_name'].'</nobr></td>
		<td class="list"><input type="text" name="user_name" size="40" value="'.$ProMemberName.'"></td>
	</tr>
	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['member_password'].'</nobr></td>
		<td class="list"><input type="password" name="user_password" size="40"></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_email'].'</nobr></td>
		<td class="list"><input type="text" dir="ltr" name="user_email" size="40" value="'.$ProMemberEmail.'"></td>
	</tr>';
if ($ppMemberID > 1 && $Mlevel == 4) {
echo'	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_rank'].'</nobr></td>
		<td class="list">
        <input class="radio" type="radio" value="1" name="user_level" '.check_radio($ProMemberLevel, "1").'>'.$lang['profile']['member'].'&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="radio" type="radio" value="2" name="user_level" '.check_radio($ProMemberLevel, "2").'>'.$lang['profile']['moderator'].'&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="radio" type="radio" value="3" name="user_level" '.$check_monitor.'>'.$lang['profile']['monitor'].'&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="radio" type="radio" value="5" name="user_level" '.$check_deputy_monitor.'>'.$lang['profile_function']['deputy_monitor'].'&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="radio" type="radio" value="4" name="user_level" '.check_radio($ProMemberLevel, "4").'>'.$lang['profile']['admin'].'
        </td>
	</tr>';
}
if ($DBMemberID == 1 AND $ppMemberID > 1 AND $ProMemberLevel == 4 && $Mlevel == 4) {
echo'	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['login_admin'].'</nobr></td>
		<td class="list">
        <input class="radio" type="radio" value="1" name="user_login" '.check_radio($ProMemberLogin , "1").'>'.$lang['profile']['login_admin_yes'].'&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="radio" type="radio" value="0" name="user_login" '.check_radio($ProMemberLogin , "0").'>'.$lang['profile']['login_admin_no'].'&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
	</tr>';
}
echo'	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_sex'].'</nobr></td>
		<td class="list">
        <input class="radio" type="radio" value="0" name="user_sex" '.check_radio($ProMemberSex, "0").'>'.$lang['profile']['no_selected'].'&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="radio" type="radio" value="1" name="user_sex" '.check_radio($ProMemberSex, "1").'>'.$lang['profile']['male'].'&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="radio" type="radio" value="2" name="user_sex" '.check_radio($ProMemberSex, "2").'>'.$lang['profile']['female'].'
        </td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['private_message'].'</nobr></td>
		<td class="list">
        <input class="radio" type="radio" value="1" name="user_pmhide" '.check_radio($ProMemberPmHide, "1").'>'.$lang['profile']['the_member_allowed_to_send_pm'].'&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <input class="radio" type="radio" value="0" name="user_pmhide" '.check_radio($ProMemberPmHide, "0").'>'.$lang['profile']['the_member_not_allowed_to_send_pm'].'
        </td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_email'].'</nobr></td>
		<td class="list">
        <input class="radio" type="radio" value="1" name="user_receive_email" '.check_radio($ProMemberReceiveEmail, "1").'>'.$lang['profile']['the_member_allowed_to_send_email'].'&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <input class="radio" type="radio" value="0" name="user_receive_email" '.check_radio($ProMemberReceiveEmail, "0").'>'.$lang['profile']['the_member_not_allowed_to_send_email'].'
        </td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['ip_address'].'</nobr></td>
		<td class="list">'.$ProMemberIP.'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['last_ip_address'].'</nobr></td>
		<td class="list">'.$ProMemberLastIP.'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['number_posts'].'</nobr></td>
		<td class="list">'.$ProMemberPosts.'</td>
	</tr>';
	if($ProMemberLevel == 4 or ($ProMemberLevel == 3 && $ProMemberDeputy == 0) && $Mlevel == 4) {
	echo'
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profiles']['hold_posts'].'</nobr></td>
		<td class="list">
		<input class="radio" type="radio" value="1" name="user_hold_active" '.check_radio($ProMemberHoldActive, "1").'>'.$lang['add_cat_forum']['yes'].'&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="radio" type="radio" value="0" name="user_hold_active" '.check_radio($ProMemberHoldActive, "0").'>'.$lang['add_cat_forum']['no'].'&nbsp;&nbsp;&nbsp;&nbsp;
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profiles']['hold_num'].'</nobr></td>
		<td class="list">
			<input type="text" name="user_hold_posts" size="10" value="'.$ProMemberHoldPosts.'"></td>;
	</tr>	
	';

	}	
	if($Mlevel == 4) {
	echo'
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profiles']['mod_market'].'</nobr></td>
		<td class="list">
		<input class="radio" type="radio" value="1" name="user_mod_market" '.check_radio($ProMemberModMarket, "1").'>'.$lang['add_cat_forum']['yes'].'&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="radio" type="radio" value="0" name="user_mod_market" '.check_radio($ProMemberModMarket, "0").'>'.$lang['add_cat_forum']['no'].'&nbsp;&nbsp;&nbsp;&nbsp;
	</tr>	
	';
	}
	echo'
		 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_age'].'</nobr></td>
		<td class="list"><input type="text" dir="rtl" name="user_age" style="WIDTH:200px" value="'.$ProMemberAge.'"></td>
	</tr>	
  	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_country'].'</nobr></td>
		<td class="list">
		<select class="insidetitle" style="WIDTH: 200px" name="user_country" type="text">';
        $selected = $ProMemberCountry;
        include("country.php");
		echo'</select>
        </td>
    </tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_title'].'</nobr></td>
		<td class="list"><input type="text" name="user_title" size="40" value="'.$ProMemberTitle.'"></td>
	</tr>
		 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['member']['real_name'].'</nobr></td>
		<td class="list"><input type="text" dir="ltr" name="user_realname" size="40" value="'.$ProMemberRealName.'"></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['member']['forum_picture'].'</nobr></td>
		<td class="list"><input type="text" dir="ltr" name="user_photo_url" size="40" value="'.$ProMemberPhotoURL.'"></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['member']['profile_picture'].'</nobr></td>
		<td class="list"><input type="text" dir="ltr" name="user_photo_purl" size="40" value="'.$ProMemberPhotoPURL.'"></td>
	</tr>	
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_city'].'</nobr></td>
		<td class="list"><input type="text" name="user_city" size="40" value="'.$ProMemberCity.'"></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_state'].'</nobr></td>
		<td class="list"><input type="text" name="user_state" size="40" value="'.$ProMemberState.'"></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_sociability_status'].'</nobr></td>
		<td class="list"><input type="text" name="user_mar_status" size="40" value="'.$ProMemberMarStatus.'"></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_occupation'].'</nobr></td>
		<td class="list"><input type="text" name="user_occupation" size="40" value="'.$ProMemberOccupation.'"></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_biography'].'</nobr></td>
		<td class="list"><textarea cols="50" rows="5" name="user_bio">'.$ProMemberBio.'</textarea></td>
	</tr>
<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['member']['the_education'].':</nobr></td>
		<td class="list">
		<table width=100% border=0><tr><td align=center><b><font color="black">'.$lang['member']['edu_level'].'</font></td><td align=center><b><font color="black">'.$lang['member']['edu_years'].'</font></td><td><b><font color="black">'.$lang['member']['edu_name'].'</font></td></tr>

<tr><td><nobr>
<select name="user_edu_level1" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu1_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu1_From_Year.'" name="user_edu_from_year1" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu1_To_Year.'" name="user_edu_to_year1" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu1_Name.'" name="user_edu_name1">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_edu_details1">'.$ProMemberEdu1_Details.'</textarea>
        </td></tr>	
<tr><td><nobr>
<select name="user_edu_level2" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu2_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu2_From_Year.'" name="user_edu_from_year2" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu2_To_Year.'" name="user_edu_to_year2" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu2_Name.'" name="user_edu_name2">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_edu_details2">'.$ProMemberEdu2_Details.'</textarea>
        </td></tr>
<tr><td><nobr>
<select name="user_edu_level3" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu3_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu3_From_Year.'" name="user_edu_from_year3" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu3_To_Year.'" name="user_edu_to_year3" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu3_Name.'" name="name3">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_edu_details3">'.$ProMemberEdu3_Details.'</textarea>
        </td></tr>			
<tr><td><nobr>
<select name="user_edu_level4" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu4_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu4_From_Year.'" name="user_edu_from_year4" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu4_To_Year.'" name="user_edu_to_year4" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu4_Name.'" name="user_edu_name4">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_edu_details4">'.$ProMemberEdu4_Details.'</textarea>
        </td></tr>	
<tr><td><nobr>
<select name="user_edu_level5" style="font-size:11px;width:60px;">
<option value="'.$lang['member']['delete_it'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['delete_it']).'>'.$lang['member']['delete_it'].'</option>
<option value="'.$lang['member']['edu_level_1'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_1']).'>'.$lang['member']['edu_level_1'].'</option>
<option value="'.$lang['member']['edu_level_2'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_2']).'>'.$lang['member']['edu_level_2'].'</option>
<option value="'.$lang['member']['edu_level_3'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_3']).'>'.$lang['member']['edu_level_3'].'</option>
<option value="'.$lang['member']['edu_level_4'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_4']).'>'.$lang['member']['edu_level_4'].'</option>
<option value="'.$lang['member']['edu_level_5'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_5']).'>'.$lang['member']['edu_level_5'].'</option>
<option value="'.$lang['member']['edu_level_6'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_6']).'>'.$lang['member']['edu_level_6'].'</option>
<option value="'.$lang['member']['edu_level_7'].'" '.check_select($ProMemberEdu5_Level, $lang['member']['edu_level_7']).'>'.$lang['member']['edu_level_7'].'</option>
</select>
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberEdu5_From_Year.'" name="user_edu_from_year5" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberEdu5_To_Year.'" name="user_edu_to_year5" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberEdu5_Name.'" name="user_edu_name5">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_edu_details5">'.$ProMemberEdu5_Details.'</textarea>
        </td></tr>			
		
		</table>
		</td>
	</tr>
		 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['member']['the_peducation'].':</nobr></td>
		<td class="list">
		<table width=100% border=0><tr><td align=center><b><font color="black">'.$lang['member']['edu_level'].'</font></td><td align=center><b><font color="black">'.$lang['member']['edu_years'].'</font></td><td><b><font color="black">'.$lang['member']['pedu_name'].'</font></td></tr>

<tr><td><nobr>
<select name="user_pedu_level1" style="font-size:11px;width:60px;">
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
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu1_From_Year.'" name="user_pedu_from_year1" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu1_To_Year.'" name="user_pedu_to_year1" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu1_Name.'" name="user_pedu_name1">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_pedu_details1">'.$ProMemberPedu1_Details.'</textarea>
        </td></tr>	
<tr><td><nobr>
<select name="user_pedu_level2" style="font-size:11px;width:60px;">
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
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu2_From_Year.'" name="user_pedu_from_year2" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu2_To_Year.'" name="user_pedu_to_year2" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu2_Name.'" name="user_pedu_name2">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_pedu_details2">'.$ProMemberPedu2_Details.'</textarea>
        </td></tr>
<tr><td><nobr>
<select name="user_pedu_level3" style="font-size:11px;width:60px;">
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
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu3_From_Year.'" name="user_pedu_from_year3" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu3_To_Year.'" name="user_pedu_to_year3" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu3_Name.'" name="user_pedu_name3">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_pedu_details3">'.$ProMemberPedu3_Details.'</textarea>
        </td></tr>			
<tr><td><nobr>
<select name="user_pedu_level4" style="font-size:11px;width:60px;">
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
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu4_From_Year.'" name="user_pedu_from_year4" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu4_To_Year.'" name="user_pedu_to_year4" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu4_Name.'" name="user_pedu_name4">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_pedu_details4">'.$ProMemberPedu4_Details.'</textarea>
        </td></tr>	
<tr><td><nobr>
<select name="user_pedu_level5" style="font-size:11px;width:60px;">
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
</td><td><nobr><input style="font-size:11px;width:30px;" value="'.$ProMemberPedu5_From_Year.'" name="user_pedu_from_year5" type="text"> - 
       <input style="font-size:11px;width:30px;" value="'.$ProMemberPedu5_To_Year.'" name="user_pedu_to_year5" type="text">
        </td><td><b>
        <input type=text style="font-size:11px;width:170px;" value="'.$ProMemberPedu5_Name.'" name="user_pedu_name5">
        </td></tr>
        <tr><td colspan="2" align="left"><b><font size="2" color="black">'.$lang['member']['edu_details'].'</font></td><td colspan="2" width="90%"><b>
        <textarea style="font-size:11px;width:170px;height:50px;" name="user_pedu_details5">'.$ProMemberPedu5_Details.'</textarea>
        </td></tr>			
		
		</table>
		</td>
	</tr>
<tr class="fixed">
					<td class="optionheader"><nobr>'.$lang['profiles']['the_hobbies'].':</nobr></td>

					<td class="list">
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
					</td>
				</tr>
				<tr class="fixed">
<td class="optionheader">
					'.$lang['profiles']['user_skin'].'</span></span></td>
<td class="list">
'.$lang['profiles']['user_opt'].'
<select onchange="check_changes(row_user_skin, \''.$ProMemberOPT.'\', this.value)" class="insidetitle" type="text" style="width:50;" name="user_opacity">';
$count=21;
$selected = $ProMemberOPT;
for($num=1;$num<$count;$num++) {
	$op=$num*5;
	$val=ceil(50+($num*2.5));
	echo'
<option value="'.$val.'" '.check_select($selected, "$val").'>'.$op.'</option>';
}
echo'
</select>
<font color="gray" size="-1">'.$lang['profiles']['opt_desc'].'</font>
<table border="0" id="table2">
	<tr>
				<td class="optionsbar_menus">
		<p align="center">1<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="0" name="user_skin" '.check_radio($ProMemberSkin, "0").'>
		<img src="images/skins/skin0.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">2<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="1" name="user_skin" '.check_radio($ProMemberSkin, "1").'>		
        <img src="images/skins/skin1.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">3<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="2" name="user_skin" '.check_radio($ProMemberSkin, "2").'>		
		<img src="images/skins/skin2.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">4<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="3" name="user_skin" '.check_radio($ProMemberSkin, "3").'>		
		<img src="images/skins/skin3.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">5<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="4" name="user_skin" '.check_radio($ProMemberSkin, "4").'>		
		<img src="images/skins/skin4.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">6<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="5" name="user_skin" '.check_radio($ProMemberSkin, "5").'>		
		<img src="images/skins/skin5.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">7<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="6" name="user_skin" '.check_radio($ProMemberSkin, "6").'>		
		<img src="images/skins/skin6.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">8<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="7" name="user_skin" '.check_radio($ProMemberSkin, "7").'>		
		<img src="images/skins/skin7.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">9<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="8" name="user_skin" '.check_radio($ProMemberSkin, "8").'>		
		<img src="images/skins/skin8.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">10<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="9" name="user_skin" '.check_radio($ProMemberSkin, "9").'>		
		<img src="images/skins/skin9.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">11<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="10" name="user_skin" '.check_radio($ProMemberSkin, "10").'>		
		<img src="images/skins/skin10.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">12<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="11" name="user_skin" '.check_radio($ProMemberSkin, "11").'>		
		<img src="images/skins/skin11.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">13<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="12" name="user_skin" '.check_radio($ProMemberSkin, "12").'>		
		<img src="images/skins/skin12.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">14<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="13" name="user_skin" '.check_radio($ProMemberSkin, "13").'>		
		<img src="images/skins/skin13.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">15<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="14" name="user_skin" '.check_radio($ProMemberSkin, "14").'>		
		<img src="images/skins/skin14.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">16<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="15" name="user_skin" '.check_radio($ProMemberSkin, "15").'>		
		<img src="images/skins/skin15.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">17<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="16" name="user_skin" '.check_radio($ProMemberSkin, "16").'>		
		<img src="images/skins/skin16.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">18<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="17" name="user_skin" '.check_radio($ProMemberSkin, "17").'>		
		<img src="images/skins/skin17.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">19<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="18" name="user_skin" '.check_radio($ProMemberSkin, "18").'>		
		<img src="images/skins/skin18.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">20<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="19" name="user_skin" '.check_radio($ProMemberSkin, "19").'>		
		<img src="images/skins/skin19.jpg" width="100" height="100"></td>
	</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">21<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="20" name="user_skin" '.check_radio($ProMemberSkin, "20").'>		
		<img src="images/skins/skin20.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">22<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="21" name="user_skin" '.check_radio($ProMemberSkin, "21").'>		
		<img src="images/skins/skin21.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">23<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="22" name="user_skin" '.check_radio($ProMemberSkin, "22").'>		
		<img src="images/skins/skin22.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">24<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="23" name="user_skin" '.check_radio($ProMemberSkin, "23").'>		
		<img src="images/skins/skin23.jpg" width="100" height="100"></td>
		</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">25<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="24" name="user_skin" '.check_radio($ProMemberSkin, "24").'>		
		<img src="images/skins/skin24.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">26<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="25" name="user_skin" '.check_radio($ProMemberSkin, "25").'>		
		<img src="images/skins/skin25.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">27<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="26" name="user_skin" '.check_radio($ProMemberSkin, "26").'>		
		<img src="images/skins/skin26.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">28<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="27" name="user_skin" '.check_radio($ProMemberSkin, "27").'>		
		<img src="images/skins/skin27.jpg" width="100" height="100"></td>
				</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">29<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="28" name="user_skin" '.check_radio($ProMemberSkin, "28").'>		
		<img src="images/skins/skin28.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">30<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="29" name="user_skin" '.check_radio($ProMemberSkin, "29").'>		
		<img src="images/skins/skin29.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">31<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="30" name="user_skin" '.check_radio($ProMemberSkin, "30").'>		
		<img src="images/skins/skin30.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">32<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="31" name="user_skin" '.check_radio($ProMemberSkin, "31").'>		
		<img src="images/skins/skin31.jpg" width="100" height="100"></td>
				</tr>
	<tr>
				<td class="optionsbar_menus">
		<p align="center">33<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="32" name="user_skin" '.check_radio($ProMemberSkin, "32").'>		
		<img src="images/skins/skin32.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">34<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="33" name="user_skin" '.check_radio($ProMemberSkin, "33").'>		
		<img src="images/skins/skin33.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">35<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="34" name="user_skin" '.check_radio($ProMemberSkin, "34").'>		
		<img src="images/skins/skin34.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">36<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="35" name="user_skin" '.check_radio($ProMemberSkin, "35").'>		
		<img src="images/skins/skin35.jpg" width="100" height="100"></td>
						</tr>
	<tr>
		<td class="optionsbar_menus">
		<p align="center">37<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="36" name="user_skin" '.check_radio($ProMemberSkin, "36").'>		
		<img src="images/skins/skin36.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">38<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="37" name="user_skin" '.check_radio($ProMemberSkin, "37").'>		
		<img src="images/skins/skin37.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">39<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="38" name="user_skin" '.check_radio($ProMemberSkin, "38").'>		
		<img src="images/skins/skin38.jpg" width="100" height="100"></td>
		<td class="optionsbar_menus">
		<p align="center">40<br>
<input onchange="check_changes(row_user_skin, \''.$ProMemberSkin.'\', this.value)" class="small" type="radio" value="39" name="user_skin" '.check_radio($ProMemberSkin, "39").'>		
		<img src="images/skins/skin39.jpg" width="100" height="100"></td>
	</tr></table>
					</td>
					</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['profile']['the_signature'].'</nobr></td>
		<td class="list"><textarea cols="50" rows="5" name="user_sig">'.$ProMemberSig.'</textarea></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['others']['the_notes'].'</nobr></td>
		<td class="list"><textarea cols="50" rows="5" name="user_notes">'.$ProMemberNotes.'</textarea></td>
	</tr>	
	
 	<tr class="fixed">
		<td align="middle" colspan="2">
			
<center>
						<font color="red">'.$lang['others']['insert_true_captcha'].'<br>

					<div id="captchabox">
<table><tbody>
<tr><td valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
<?php
echo'
</td>
<td valign="top"><img width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'"></td>
<td valign="top"><nobr><center><b><font color="red">'.$lang['others']['captcha'].'<br><input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div>
</center>
		<input type="submit" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
	</tr>
</form>
</table>
</center>';
 }
 else {
 redirect();
 }
}

if ($type == "edit_user_add") {

 if ($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0 && $CAN_CHANGE_M == 1)) {

$ppMemberID = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_id"]));
$user_name = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_name"]));
if (DBi::$con->real_escape_string($_POST["user_password"]) != "") {
$user_password = md5(DBi::$con->real_escape_string($_POST["user_password"]));
}
$user_email = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_email"]));
if ($ppMemberID > 1 && $Mlevel == 4) {
$user_level = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_level"]));
$user_login = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_login"]));

}
if($Mlevel == 4) {
$ProMemberLevel = DBi::$con->real_escape_string(htmlspecialchars($_POST["user_old_level"]));
$ProMemberDeputy = DBi::$con->real_escape_string(htmlspecialchars($_POST["user_deputy"]));
$ProMemberOldMod = DBi::$con->real_escape_string(htmlspecialchars($_POST["user_old_mod"]));
$user_deputy = 0;
if($user_level == 5) {
$user_level = 3;
$user_deputy = 1;	
}
}
$user_opacity = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_opacity"]));
$user_sex = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_sex"]));
$user_receive_email = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_receive_email"]));
$user_age = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_age"]));
$user_photo_url = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_photo_url"]));
$user_photo_purl = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_photo_purl"]));
$user_country = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_country"]));
$user_state = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_state"]));
$user_sity = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_sity"]));
$user_mar_status = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_mar_status"]));
$user_occupation = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_occupation"]));
$user_bio = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_bio"]));
$user_education = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_education"]));
$user_peducation = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_peducation"]));
$user_hobby = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_hobby"]));
$user_realname = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_realname"]));
$user_title = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_title"]));
$user_sig = DBi::$con->real_escape_string($_POST["user_sig"]);
$user_notes = DBi::$con->real_escape_string($_POST["user_notes"]);
$user_pmhide = DBi::$con->real_escape_string($_POST["user_pmhide"]);
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
$user_day = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_day"]));
$user_month = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_month"]));
$user_year = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_year"]));
$user_skin = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_skin"]));
$user_edu_level1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_level1"]));
$user_edu_from_year1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_from_year1"]));
$user_edu_to_year1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_to_year1"]));
$user_edu_name1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_name1"]));
$user_edu_details1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_details1"]));
$user_edu_level2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_level2"]));
$user_edu_from_year2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_from_year2"]));
$user_edu_to_year2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_to_year2"]));
$user_edu_name2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_name2"]));
$user_edu_details2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_details2"]));
$user_edu_level3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_level3"]));
$user_edu_from_year3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_from_year3"]));
$user_edu_to_year3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_to_year3"]));
$user_edu_name3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_name3"]));
$user_edu_details3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_details3"]));
$user_edu_level4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_level4"]));
$user_edu_from_year4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_from_year4"]));
$user_edu_to_year4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_to_year4"]));
$user_edu_name4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_name4"]));
$user_edu_details4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_details4"]));
$user_edu_level5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_level5"]));
$user_edu_from_year5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_from_year5"]));
$user_edu_to_year5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_to_year5"]));
$user_edu_name5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_name5"]));
$user_edu_details5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_edu_details5"]));
$user_pedu_level1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_level1"]));
$user_pedu_from_year1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_from_year1"]));
$user_pedu_to_year1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_to_year1"]));
$user_pedu_name1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_name1"]));
$user_pedu_details1 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_details1"]));
$user_pedu_level2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_level2"]));
$user_pedu_from_year2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_from_year2"]));
$user_pedu_to_year2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_to_year2"]));
$user_pedu_name2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_name2"]));
$user_pedu_details2 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_details2"]));
$user_pedu_level3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_level3"]));
$user_pedu_from_year3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_from_year3"]));
$user_pedu_to_year3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_to_year3"]));
$user_pedu_name3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_name3"]));
$user_pedu_details3 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_details3"]));
$user_pedu_level4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_level4"]));
$user_pedu_from_year4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_from_year4"]));
$user_pedu_to_year4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_to_year4"]));
$user_pedu_name4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_name4"]));
$user_pedu_details4 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_details4"]));
$user_pedu_level5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_level5"]));
$user_pedu_from_year5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_from_year5"]));
$user_pedu_to_year5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_to_year5"]));
$user_pedu_name5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_name5"]));
$user_pedu_details5 = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pedu_details5"]));
	$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
	if($Mlevel == 4) {
	$user_hold_active = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['user_hold_active']));
	$user_hold_posts = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['user_hold_posts']));
	$user_mod_market = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['user_mod_market']));
	}
$carray = array('',$lang['country']['country_1'],$lang['country']['country_2'],$lang['country']['country_3'],$lang['country']['country_4'],$lang['country']['country_5'],$lang['country']['country__5'],$lang['country']['country___5'],$lang['country']['country_6'],$lang['country']['country_7'],$lang['country']['country_8'],$lang['country']['country_9'],$lang['country']['country_10'],$lang['country']['country_11'],$lang['country']['country_12'],$lang['country']['country_13'],$lang['country']['country_14'],$lang['country']['country_15'],$lang['country']['country_16'],$lang['country']['country_17'],$lang['country']['country_18'],$lang['country']['country_19'],$lang['country']['country_20'],$lang['country']['country_21'],$lang['country']['country_22'],$lang['country']['country_23'],$lang['country']['country_24'],$lang['country']['country_25'],$lang['country']['country_26'],$lang['country']['country_27'],$lang['country']['country_28'],$lang['country']['country_29'],$lang['country']['country_30'],$lang['country']['country_31'],$lang['country']['country_32'],$lang['country']['country_33'],$lang['country']['country_34'],$lang['country']['country_35'],$lang['country']['country_36'],$lang['country']['country_37'],$lang['country']['country_38'],$lang['country']['country_39'],$lang['country']['country_40'],$lang['country']['country_41'],$lang['country']['country_42'],$lang['country']['country_43'],$lang['country']['country_44'],$lang['country']['country_45'],$lang['country']['country_46'],$lang['country']['country_47'],$lang['country']['country_48'],$lang['country']['country_49'],$lang['country']['country_50'],$lang['country']['country_51'],$lang['country']['country_52'],$lang['country']['country_53'],$lang['country']['country_54'],$lang['country']['country_55'],$lang['country']['country_56'],$lang['country']['country_57'],$lang['country']['country_58'],$lang['country']['country_59'],$lang['country']['country_60'],$lang['country']['country_61'],$lang['country']['country_62'],$lang['country']['country_63'],$lang['country']['country_64'],$lang['country']['country_65'],$lang['country']['country_66'],$lang['country']['country_67'],$lang['country']['country_68'],$lang['country']['country_69'],$lang['country']['country_70'],$lang['country']['country_71'],$lang['country']['country_72'],$lang['country']['country_73'],$lang['country']['country_74'],$lang['country']['country_75'],$lang['country']['country_76'],$lang['country']['country_77'],$lang['country']['country_78'],$lang['country']['country_79'],$lang['country']['country_80'],$lang['country']['country_81'],$lang['country']['country_82'],$lang['country']['country_83'],$lang['country']['country_84'],$lang['country']['country_85'],$lang['country']['country_86'],$lang['country']['country_87'],$lang['country']['country_88'],$lang['country']['country_89'],$lang['country']['country_90'],$lang['country']['country_91'],$lang['country']['country_92'],$lang['country']['country_93'],$lang['country']['country_94'],$lang['country']['country_95'],$lang['country']['country_96'],$lang['country']['country_97'],$lang['country']['country_98'],$lang['country']['country_99'],$lang['country']['country_100'],$lang['country']['country_101'],$lang['country']['country_102'],$lang['country']['country_103'],$lang['country']['country_104'],$lang['country']['country_105'],$lang['country']['country_106'],$lang['country']['country_107'],$lang['country']['country_108'],$lang['country']['country_109'],$lang['country']['country_110'],$lang['country']['country_111'],$lang['country']['country_112'],$lang['country']['country_113'],$lang['country']['country_114'],$lang['country']['country_115'],$lang['country']['country_116'],$lang['country']['country_117'],$lang['country']['country_118'],$lang['country']['country_119'],$lang['country']['country_120'],$lang['country']['country_121'],$lang['country']['country_122'],$lang['country']['country_123'],$lang['country']['country_124'],$lang['country']['country_125'],$lang['country']['country_126'],$lang['country']['country_127'],$lang['country']['country_128'],$lang['country']['country_129'],$lang['country']['country_130'],$lang['country']['country_131'],$lang['country']['country_132'],$lang['country']['country_133'],$lang['country']['country_134'],$lang['country']['country_135'],$lang['country']['country_136'],$lang['country']['country_137'],$lang['country']['country_138'],$lang['country']['country_139'],$lang['country']['country_140'],$lang['country']['country_141'],$lang['country']['country_142'],$lang['country']['country_143'],$lang['country']['country_144'],$lang['country']['country_145'],$lang['country']['country_146'],$lang['country']['country_147'],$lang['country']['country_148'],$lang['country']['country_149'],$lang['country']['country_150'],$lang['country']['country_151'],$lang['country']['country_152'],$lang['country']['country_153'],$lang['country']['country_154'],$lang['country']['country_156'],$lang['country']['country_157'],$lang['country']['country_158'],$lang['country']['country_159'],$lang['country']['country_160'],$lang['country']['country_161'],$lang['country']['country_162'],$lang['country']['country_163'],$lang['country']['country_164'],$lang['country']['country_165'],$lang['country']['country_166'],$lang['country']['country_167'],$lang['country']['country_168'],$lang['country']['country_169'],$lang['country']['country_170'],$lang['country']['country_171'],$lang['country']['country_172'],$lang['country']['country_173'],$lang['country']['country_174'],$lang['country']['country_175'],$lang['country']['country_176'],$lang['country']['country_177'],$lang['country']['country_178'],$lang['country']['country_179'],$lang['country']['country_180'],$lang['country']['country_181'],$lang['country']['country_182'],$lang['country']['country_183'],$lang['country']['country_184'],$lang['country']['country_185'],$lang['country']['country_186'],$lang['country']['country_187'],$lang['country']['country_188'],$lang['country']['country_189'],$lang['country']['country_190'],$lang['country']['country_191'],$lang['country']['country_192'],$lang['country']['country_193'],$lang['country']['country_194'],$lang['country']['country_195'],$lang['country']['country_196'],$lang['country']['country_197'],$lang['country']['country_198'],$lang['country']['country_199'],$lang['country']['country_200'],$lang['country']['country_201'],$lang['country']['country_202'],$lang['country']['country_203'],$lang['country']['country_204'],$lang['country']['country_205'],$lang['country']['country_206'],$lang['country']['country_207'],$lang['country']['country_208'],$lang['country']['country_209'],$lang['country']['country_210'],$lang['country']['country_211'],$lang['country']['country_212'],$lang['country']['country_213'],$lang['country']['country_214'],$lang['country']['country_215'],$lang['country']['country_216'],$lang['country']['country_217'],$lang['country']['country_218'],$lang['country']['country_219'],$lang['country']['country_220'],$lang['country']['country_221']);
if(in_array($user_country,$carray)){
	$cpass = "";
}
if(!in_array($user_country,$carray)){
	$cpass = "no";
}
if(is_numeric($user_age) && $user_age > 0 && $user_age < 100 ){
	$cpass = "";
}
if($user_age > 100) {
	$cpass = "no";
}
if($Mlevel == 4) {
if ($ProMemberLevel == 3 AND $ProMemberDeputy == 0 AND $user_level == 1) {
$user_old_mod = 2;
}

if ($ProMemberLevel == 3 AND $ProMemberDeputy == 1 AND $user_level == 1) {
$user_old_mod = 3;
}

if ($ProMemberLevel == 2 AND $user_level == 1) {
$user_old_mod = 1;
}

if ($user_level == 2 OR $user_level == 3 AND $ProMemberOldMod == 1 OR $ProMemberOldMod == 2 OR $ProMemberOldMod == 3) {
$user_old_mod = 0;
}
 }
if ($user_name == "") {
    $error = $lang['register_js']['necessary_to_insert_user_name'];
}
if ($user_email == "") {
    $error = $lang['register_js']['necessary_to_insert_email'];
}
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}

if ($error != "") {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$error.'..</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

if ($error == "") {
	$_SESSION['DF_choose_style'] = $user_skin;
		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
        $query .= "M_NAME = '$user_name', ";
        if ($user_password != "") {
        $query .= "M_PASSWORD = '$user_password', ";
        }
        $query .= "M_EMAIL = '$user_email', ";
		if($Mlevel == 4) {
if ($ppMemberID > 1) {
        $query .= "M_LEVEL = '$user_level', ";
}
if ($ppMemberID > 1) {
        $query .= "M_ADMIN= '$user_login', ";
}
		
        $query .= "M_DEPUTY = '$user_deputy', ";
		}
        $query .= "M_SEX = '$user_sex', ";
        $query .= "M_RECEIVE_EMAIL = '$user_receive_email', ";
		if($cpass != ""){
		$no = "";
        $query .= "M_AGE = '$no', ";
        $query .= "M_COUNTRY = '$no', ";
		} else {
        $query .= "M_AGE = '$user_age', ";
        $query .= "M_COUNTRY = '$user_country', ";
		}
        $query .= "M_OPT = '$user_opacity', ";
        $query .= "M_PHOTO_URL = '$user_photo_url', ";
        $query .= "M_PHOTO_PURL = '$user_photo_purl', ";
        $query .= "M_STATE = '$user_state', ";
        $query .= "M_CITY = '$user_city', ";
        $query .= "M_MARSTATUS = '$user_mar_status', ";
        $query .= "M_OCCUPATION = '$user_occupation', ";
        $query .= "M_SIG = '$user_sig', ";
        $query .= "M_NOTES = '$user_notes', ";
        $query .= "M_BIO = '$user_bio', ";
        $query .= "M_HOBBY = '$user_hobby', ";
        $query .= "M_REALNAME = '$user_realname', ";
        $query .= "M_PMHIDE = '$user_pmhide', ";
if($user_hob1 != "" or $user_hob2 != "" or $user_hob3 != "" or $user_hob4 != "" or $user_hob5 != "" or $user_hob6 != "" or $user_hob7 != "" or $user_hob8 != "" or $user_hob9 != "" or $user_hob10 != "" or $user_hob11 != "" or $user_hob12 != "" or $user_hob13 != "" or $user_hob14 != "" or $user_hob15 != "" or $user_hob16 != "" or $user_hob17 != "" or $user_hob18 != "" or $user_hob19 != "" or $user_hob20 != "" or $user_hob21 != "" or $user_hob22 != "" or $user_hob23 != "" or $user_hob24 != "" or $user_hob25 != "" or $user_hob26 != "" or $user_hob27 != "" or $user_hob28 != "" or $user_hob29 != "" or $user_hob30 != "" or $user_hob31 != "" or $user_hob32 != "" or $user_hob33 != "" or $user_hob34 != "" or $user_hob35 != ""){
		$query .= "M_HOBBY = ('1'), ";
}elseif($user_hob1 == "" or $user_hob2 == "" or $user_hob3 == "" or $user_hob4 == "" or $user_hob5 == "" or $user_hob6 == "" or $user_hob7 == "" or $user_hob8 == "" or $user_hob9 == "" or $user_hob10 == "" or $user_hob11 == "" or $user_hob12 == "" or $user_hob13 == "" or $user_hob14 == "" or $user_hob15 == "" or $user_hob16 == "" or $user_hob17 == "" or $user_hob18 == "" or $user_hob19 == "" or $user_hob20 == "" or $user_hob21 == "" or $user_hob22 == "" or $user_hob23 == "" or $user_hob24 == "" or $user_hob25 == "" or $user_hob26 == "" or $user_hob27 == "" or $user_hob28 == "" or $user_hob29 == "" or $user_hob30 == "" or $user_hob31 == "" or $user_hob32 == "" or $user_hob33 == "" or $user_hob34 == "" or $user_hob35 == ""){
		$query .= "M_HOBBY = ('0'), ";
}
		$query .= "M_HOB1 = '$user_hob1', ";
		$query .= "M_HOB2 = '$user_hob2', ";
		$query .= "M_HOB3 = '$user_hob3', ";
		$query .= "M_HOB4 = '$user_hob4', ";
		$query .= "M_HOB5 = '$user_hob5', ";
		$query .= "M_HOB6 = '$user_hob6', ";
		$query .= "M_HOB7 = '$user_hob7', ";
		$query .= "M_HOB8 = '$user_hob8', ";
		$query .= "M_HOB9 = '$user_hob9', ";
		$query .= "M_HOB10 = '$user_hob10', ";
		$query .= "M_HOB11 = '$user_hob11', ";
		$query .= "M_HOB12 = '$user_hob12', ";
		$query .= "M_HOB13 = '$user_hob13', ";
		$query .= "M_HOB14 = '$user_hob14', ";
		$query .= "M_HOB15 = '$user_hob15', ";
		$query .= "M_HOB16 = '$user_hob16', ";
		$query .= "M_HOB17 = '$user_hob17', ";
		$query .= "M_HOB18 = '$user_hob18', ";
		$query .= "M_HOB19 = '$user_hob19', ";
		$query .= "M_HOB20 = '$user_hob20', ";
		$query .= "M_HOB21 = '$user_hob21', ";
		$query .= "M_HOB22 = '$user_hob22', ";
		$query .= "M_HOB23 = '$user_hob23', ";
		$query .= "M_HOB24 = '$user_hob24', ";
		$query .= "M_HOB25 = '$user_hob25', ";
		$query .= "M_HOB26 = '$user_hob26', ";
		$query .= "M_HOB27 = '$user_hob27', ";
		$query .= "M_HOB28 = '$user_hob28', ";
		$query .= "M_HOB29 = '$user_hob29', ";
		$query .= "M_HOB30 = '$user_hob30', ";
		$query .= "M_HOB31 = '$user_hob31', ";
		$query .= "M_HOB32 = '$user_hob32', ";
		$query .= "M_HOB33 = '$user_hob33', ";
		$query .= "M_HOB34 = '$user_hob34', ";
		$query .= "M_HOB35 = '$user_hob35', ";
        $query .= "M_EDU1_LEVEL = '$user_edu_level1',  ";
        $query .= "M_EDU1_FROM_YEAR = '$user_edu_from_year1',  ";
        $query .= "M_EDU1_TO_YEAR = '$user_edu_to_year1',  ";
        $query .= "M_EDU1_NAME = '$user_edu_name1',  ";
        $query .= "M_EDU1_DETAILS = '$user_edu_details1',  ";
        $query .= "M_EDU2_LEVEL = '$user_edu_level2',  ";
        $query .= "M_EDU2_FROM_YEAR = '$user_edu_from_year2',  ";
        $query .= "M_EDU2_TO_YEAR = '$user_edu_to_year2',  ";
        $query .= "M_EDU2_NAME = '$user_edu_name2',  ";
        $query .= "M_EDU2_DETAILS = '$user_edu_details2',  ";
        $query .= "M_EDU3_LEVEL = '$user_edu_level3',  ";
        $query .= "M_EDU3_FROM_YEAR = '$user_edu_from_year3',  ";
        $query .= "M_EDU3_TO_YEAR = '$user_edu_to_year3',  ";
        $query .= "M_EDU3_NAME = '$user_edu_name3',  ";
        $query .= "M_EDU3_DETAILS = '$user_edu_details3',  ";
        $query .= "M_EDU4_LEVEL = '$user_edu_level4',  ";
        $query .= "M_EDU4_FROM_YEAR = '$user_edu_from_year4',  ";
        $query .= "M_EDU4_TO_YEAR = '$user_edu_to_year4',  ";
        $query .= "M_EDU4_NAME = '$user_edu_name4',  ";
        $query .= "M_EDU4_DETAILS = '$user_edu_details4',  ";
        $query .= "M_EDU5_LEVEL = '$user_edu_level5',  ";
        $query .= "M_EDU5_FROM_YEAR = '$user_edu_from_year5',  ";
        $query .= "M_EDU5_TO_YEAR = '$user_edu_to_year5',  ";
        $query .= "M_EDU5_NAME = '$user_edu_name5',  ";
        $query .= "M_EDU5_DETAILS = '$user_edu_details5',  ";	
        $query .= "M_PEDU1_LEVEL = '$user_pedu_level1',  ";
        $query .= "M_PEDU1_FROM_YEAR = '$user_pedu_from_year1',  ";
        $query .= "M_PEDU1_TO_YEAR = '$user_pedu_to_year1',  ";
        $query .= "M_PEDU1_NAME = '$user_pedu_name1',  ";
        $query .= "M_PEDU1_DETAILS = '$user_pedu_details1',  ";
        $query .= "M_PEDU2_LEVEL = '$user_pedu_level2',  ";
        $query .= "M_PEDU2_FROM_YEAR = '$user_pedu_from_year2',  ";
        $query .= "M_PEDU2_TO_YEAR = '$user_pedu_to_year2',  ";
        $query .= "M_PEDU2_NAME = '$user_pedu_name2',  ";
        $query .= "M_PEDU2_DETAILS = '$user_pedu_details2',  ";
        $query .= "M_PEDU3_LEVEL = '$user_pedu_level3',  ";
        $query .= "M_PEDU3_FROM_YEAR = '$user_pedu_from_year3',  ";
        $query .= "M_PEDU3_TO_YEAR = '$user_pedu_to_year3',  ";
        $query .= "M_PEDU3_NAME = '$user_pedu_name3',  ";
        $query .= "M_PEDU3_DETAILS = '$user_pedu_details3',  ";
        $query .= "M_PEDU4_LEVEL = '$user_pedu_level4',  ";
        $query .= "M_PEDU4_FROM_YEAR = '$user_pedu_from_year4',  ";
        $query .= "M_PEDU4_TO_YEAR = '$user_pedu_to_year4',  ";
        $query .= "M_PEDU4_NAME = '$user_pedu_name4',  ";
        $query .= "M_PEDU4_DETAILS = '$user_pedu_details4',  ";
        $query .= "M_PEDU5_LEVEL = '$user_pedu_level5',  ";
        $query .= "M_PEDU5_FROM_YEAR = '$user_pedu_from_year5',  ";
        $query .= "M_PEDU5_TO_YEAR = '$user_pedu_to_year5',  ";
        $query .= "M_PEDU5_NAME = '$user_pedu_name5',  ";
        $query .= "M_PEDU5_DETAILS = '$user_pedu_details5',  ";					
		$query .= "M_DAY = '$user_day', ";
		$query .= "M_MONTH = '$user_month', ";
        if ($user_level == 1) {
        $query .= "M_TITLE = '', ";
        }
        else {
        $query .= "M_TITLE = '$user_title', ";
        }
		if($user_level > 2 && $Mlevel == 4) {
        $query .= "M_HOLD_ACTIVE = '$user_hold_active', ";
        $query .= "M_HOLD_POSTS = '$user_hold_posts', ";
		if($user_hold_active == 1) {
        $query .= "M_POSTS = '$user_hold_posts', ";
		}
		}	
		if($Mlevel == 4) {
        $query .= "M_OLD_MOD = '$user_old_mod', ";
		}
		$query .= "M_SKIN = '$user_skin', ";
		if($user_level > 1) {
		$query .= "M_ICON_VERF = '1', ";	
		} else {
		$query .= "M_ICON_VERF = '0', ";	
		}
		if($Mlevel == 4) {
		$query .= "M_MOD_MARKET = '$user_mod_market', ";	
		}		
		$query .= "M_YEAR = '$user_year' ";		
        $query .= "WHERE MEMBER_ID = '$ppMemberID' ";
        
        DBi::$con->query($query) or die (DBi::$con->error);
        
                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['profile']['your_details_has_edited'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php?mode=member&id='.$ppMemberID.'">
                           <a href="index.php?mode=member&id='.$ppMemberID.'">'.$lang['profile']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


    }
    else {
    redirect();
    }

}

}	// (members("STATUS", $id) == 1 OR $Mlevel > 1 OR members("NAME", $id) != "")
else {
echo'
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1256">
	<link rel="stylesheet" type="text/css" href="./profile/temy.css">
	<script src="profile.js"></script>
</head>
<center>
<div id="dhtmltooltip"></div>
<table width="1024" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td>';
echo menuLinks();
echo'<font color="yellow">
</td></tr>


</body></html>';
}

if ($type == "medals"){
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
if (members("MEDALS", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][medals].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();

}
	if ($Mlevel > 0){
		echo'
		<script language="javascript">
			function choose_medal(id){
				document.m_info.mem_id.value = id;
				document.m_info.submit();
			}
			function remove_medal(){
				document.m_info.mem_id.value = "remove";
				document.m_info.submit();
			}
		</script>
		<form name="m_info" method="post" action="index.php?mode=profile&type=medals">
		<input type="hidden" name="mem_id">
		</form>
		<center>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td class="optionsbar_menus" width="99%">&nbsp;<nobr><font color="red" size="+1">'.$lang['user_svc']['member_svc'].'</font></nobr></td>';
				echo multi_page("MEDALS WHERE MEMBER_ID = '$DBMemberID' AND STATUS = '1' ", $max_page);
				go_to_forum();
			echo'
			</tr>
		</table><br>';
		$mem_id = $_POST[mem_id];
		if (!empty($mem_id)){
			if ($mem_id == "remove"){
				DBi::$con->query("UPDATE ".$Prefix."MEMBERS SET M_MEDAL = '0' WHERE MEMBER_ID = '$DBMemberID' ") or die (DBi::$con->error);
				echo'<p align="center"><font size="+1" color="red">'.$lang['profiles']['done_delete_medal'].'</font></p>';
			}
			else{
				DBi::$con->query("UPDATE ".$Prefix."MEMBERS SET M_MEDAL = '$mem_id' WHERE MEMBER_ID = '$DBMemberID' ") or die (DBi::$con->error);
				echo'<p align="center"><font size="+1" color="red">'.$lang['profiles']['done_change_medal'].'</font></p>';
			}
		}
		echo'
		<table cellSpacing="1" cellPadding="2">
			<tr>
				<td class="optionsbar_menus" colSpan="10"><font color="red" size="+1">'.$lang['profiles']['your_medals_new'].'</font></td>
			</tr>
			<tr>
				<td class="stats_h"><nobr>'.$lang['message']['date'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_show_to'].'</nobr></td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_gived'].'</nobr></td>
				<td class="stats_h">'.$lang['profiles']['show_pic'].'</td>
				<td class="stats_h"><nobr>'.$lang['medals']['medals_forum'].'</nobr></td>';
			if (mlv > 1){
				echo'
				<td class="stats_h"><nobr>'.$lang['profiles']['giv_medals'].'</nobr></td>';
			}
				echo'
				<td class="stats_h"><nobr>'.$lang['members']['options'].'</nobr></td>
			</tr>';
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MEDALS WHERE MEMBER_ID = '$DBMemberID' AND STATUS = '1' AND SPECIAL_TYPE = '0' OR SPECIAL_TYPE = '1' ORDER BY DATE DESC LIMIT ".pg_limit($max_page).", $max_page") or die (DBi::$con->error);
		$num = mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num){
			$m = mysqli_result($sql, $x, "MEDAL_ID");
			$gm_id = medals("GM_ID", $m);
			$subject = gm("SUBJECT", $gm_id);
			$date = medals("DATE", $m);
			$days = medals("DAYS", $m);
			$url = medals("URL", $m);
			$f = medals("FORUM_ID", $m);
			$added = medals("ADDED", $m);
			$add_days = $days*60*60*24;
			$add_days = $add_days + $date;
			echo'
			<tr>
				<td class="stats_p" align="middle"><font color="red">'.normal_date($date).'</font></td>
				<td class="stats_p" align="middle"><font color="black">'.days_added($days, $date).'</font></td>
				<td class="stats_g"><font size="-1">'.$subject.'</font></td>
				<td class="stats_p" align="middle"><a target="plaquepreview" href="'.$url.'">'.icons($icon_camera).'</a></td>
				<td class="stats_p"><font color="red">'.forums("SUBJECT", $f).'</font></td>';
			if ($Mlevel > 1){
				echo'
				<td class="stats_g"><nobr><a href="index.php?mode=member&id='.$added.'"><font color="#ffffff">'.members("NAME", $added).'</font></a></nobr></td>';
			}
				echo'
				<td class="stats_h" align="middle">';
				if ($add_days > time()){
					echo'
					<a href="javascript:choose_medal('.$m.')">'.icons($icon_profile, $lang['profiles']['use_this_medal'], " hspace=\"3\"").'</a>';
				}
				echo'
				</td>
			</tr>';
			$count = $count + 1;
		++$x;
		}
		if ($count == 0){
			echo'
			<tr>
				<td class="stats_h" colSpan="10" align="center"><br><font size="3">'.$lang['profiles']['no_medals_you'].'</font><br><br></td>
			</tr>';
		}
		else{
			echo'
			<tr>
				<td class="optionsbar_menus" colSpan="10"><font size="3"><a href="javascript:remove_medal()">'.$lang['profiles']['delete_your_medals_now'].' </a></font></td>
			</tr>';
		}
		echo'
		</table>
		</center><br>';
	}
	else {
		redirect();
	}
}
if($type == "requestmon") {
if($id == 1 or (members("LEVEL", $id) == 4 && $DBMemberID != 1)){	
			                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[out][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}	
if($prd == "") {	
if($Mlevel > 2 && $deputy == 0) {

echo'
	<script language="javascript">
		function submit_form(){
			if (moderation_info.moderation_raison.value.length <= 3){
				confirm("'.$lang['svc_function']['enter_why_to_member'].'");
				return;
			}
			if (moderation_info.moderators_notes.value.length <= 3){
				confirm("'.$lang['svc_function']['enter_mod_why'].'");
				return;
			}
			if (moderation_info.forum_id.value == 0){
				confirm("'.$lang['svc_function']['enter_forum_id'].'");
				return;
			}	
			if (moderation_info.moderation_type.value == 7 && moderation_info.details_type.value.length == 0){
				confirm("'.$lang['svc_file']['dont_choose_details_type_to_hide'].'");
				return;
			}				
		moderation_info.submit();
		}
			function chk_type(type){
				type = type.options[type.selectedIndex].value;
				forum = document.getElementById("forum_id").value;
				member_id = document.getElementById("member_id").value;
				if (type > 0){
					document.location = "index.php?mode=profile&id="+member_id+"&type=requestmon&step="+type+"&f="+forum;
				}
				else{
					return;
				}
			}	
			function chk_forum(type){
				type = type.options[type.selectedIndex].value;
				step = document.getElementById("moderation_type").value;
				member_id = document.getElementById("member_id").value;				
				if (type > 0){
					document.location = "index.php?mode=profile&id="+member_id+"&type=requestmon&step="+step+"&f="+type;
				}
				else{
					return;
				}
			}				
	</script>';

	echo'
	<br>
	<center>
	<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4">
	<form name="moderation_info" method="post" action="index.php?mode=profile&id='.$id.'&type=requestmon&prd=insert">
	<input type="hidden" name="member_id" id="member_id" value="'.$id.'">
		<tr class="fixed">
			<td class="optionheader_selected" colspan="2"><nobr>'.$lang['svc_function']['request_mon'].'</nobr></td>
		</tr>
 		<tr class="fixed">
			<td class="optionheader" width="100"><nobr>'.$lang['members']['members'].':</nobr></td>
			<td class="list">&nbsp;&nbsp;'.member_name($id).'</td>
		</tr>
		
		<tr class="fixed">
			<td class="optionheader"><nobr>'.$lang['svc_function']['choose_type'].'</nobr></td>
			<td class="list">
			<select class="insidetitle" style="WIDTH: 450px" id="moderation_type" name="moderation_type" onchange="chk_type(this)">
                <option value="10" '.check_select($step, 10).'>'.$lang['svc_function']['block_messages'].'</option>
                ';
				if($Mlevel == 4) {
				echo'<option value="12" '.check_select($step, 12).'>'.$lang['svc_function']['block_ihdaa'].'</option>';	
				}
				echo'
			    <option value="1" '.check_select($step, 1).'>'.$lang['svc_function']['request_on_forum'].'</option>
			    <option value="2" '.check_select($step, 2).'>'.$lang['svc_function']['request_all_forum'].'</option>
			    <option value="3" '.check_select($step, 3).'>'.$lang['svc_function']['block_on_forum'].'</option>
			    <option value="4" '.check_select($step, 4).'>'.$lang['svc_function']['block_all_forum'].'</option>
			    <option value="5" '.check_select($step, 5).'>'.$lang['svc_function']['request_lock'].'</option>
			    <option value="7" '.check_select($step, 7).'>'.$lang['svc_function']['hide_details'].'</option>
			    <option value="8" '.check_select($step, 8).'>'.$lang['svc_function']['hide_posts'].'</option>
			    <option value="9" '.check_select($step, 9).'>'.$lang['svc_function']['hide_messages'].'</option>
			    <option value="11" '.check_select($step, 11).'>'.$lang['svc_function']['block_show_forum'].'</option>
			</select>
        		</td>
		</tr>
 		<tr class="fixed">
			<td class="optionheader"><nobr>'.$lang['all']['forum'].'</nobr></td>
			<td class="list">
			<select class="forumSelect" style="HEIGHT: 20px; WIDTH:150px; FONT-SIZE:10pt" size="1" id="forum_id" name="forum_id" onchange="chk_forum(this)">
		<option value="0" '.check_select($f, 0).'>'.$lang['svc_file']['select_a_forum_name'].'</option>	';
					$all_forums = chk_allowed_forums();
					for($x = 0; $x < count($all_forums); $x++){
						$f_id = $all_forums[$x];
						echo'
						<option value="'.$f_id.'" '.check_select($f, $f_id).'>'.forums("SUBJECT", $f_id).'</option>';
					}	
      echo'</select></td>
		</tr>';
		if($step == 7) {
		echo'
 		<tr class="fixed">
			<td class="optionheader"><nobr>'.$lang['svc_function']['type_details'].':</nobr></td>
			<td class="list"><input class="small" type="radio" value="1" name="details_type">'.$lang['svc_function']['photo'].'&nbsp;&nbsp;&nbsp;
					<input class="small" type="radio" value="2" name="details_type">'.$lang['svc_function']['sig'].'&nbsp;&nbsp;&nbsp;
					<input class="small" type="radio" value="3" name="details_type">'.$lang['svc_function']['all'].'</td>
		</tr>';	
		}		
	echo'
 		<tr class="fixed">
			<td class="optionheader"><nobr>'.$lang['svc_function']['request_why'].'</nobr></td>
			<td class="list"><textarea cols="50" rows="5" name="moderation_raison"></textarea></td>
		</tr>		
 		<tr class="fixed">
			<td class="optionheader"><nobr>'.$lang['svc_function']['mod_why'].'</nobr></td>
			<td class="list"><textarea cols="50" rows="5" name="moderators_notes"></textarea></td>
		</tr>
 		<tr class="fixed">
			<td class="optionheader"><nobr>'.$lang['svc_function']['mon_notes'].':</nobr></td>
			<td class="list"><textarea cols="50" rows="5" name="monitor_notes"></textarea></td>
		</tr>		
 		<tr class="fixed">
			<td align="middle" colspan="2"><input onclick="submit_form()" type="button"  value="'.$lang['svc_function']['add_request'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['cancel'].'"></td>
		</tr>
	</form>
	</table>
	</center>';
} else {
redirect();	
}
}
if ($prd == "insert") {
	$member_id = $id;
	$forum_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));
	$pm_mid = "-".$forum_id;
	$moderation_type = DBi::$con->real_escape_string(htmlspecialchars($_POST['moderation_type']));
	$moderation_raison = DBi::$con->real_escape_string(htmlspecialchars($_POST['moderation_raison']));
	$moderators_notes = DBi::$con->real_escape_string(htmlspecialchars($_POST['moderators_notes']));
	$monitor_notes = DBi::$con->real_escape_string(htmlspecialchars($_POST['monitor_notes']));
	$details_type = DBi::$con->real_escape_string(htmlspecialchars($_POST['details_type']));
	$m_date = time();
	$m_dateApp = time();

		switch ($moderation_type) {
	     case "1":
				$txtSubject = "".$lang['request_mon']['request_mon_message_part1']." ".forum_name($forum_id);
			$txtMessage = '<font color="red" size="3">'.$lang['request_mon']['request_mon_message_part2'].' '.forum_name($forum_id).'<br><br>'.$lang['request_mon']['request_mon_message_part3'].' </font><br><font size="3">'.$moderation_raison.'</front><font color="black" size="3"><br><br>'.$lang['request_mon']['request_mon_message_part4'].'<br></front>';
		  $TYPE = $lang['svc_function']['moderation_1'];
			break;			
		     case "2":
		          $txtSubject = $lang['svc_file']['moderation_2_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_2_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_function']['moderation_2'];
		     break;
		     case "3":
		          $txtSubject = "".$lang['svc_file']['moderation_3_subject']." ".forum_name($forum_id);
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_3_message_part1'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['moderation_11_message_part2'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_function']['moderation_3'];
		     break;
		     case "4":
		          $txtSubject = $lang['svc_file']['moderation_4_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_4_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_function']['moderation_4'];
		     break;
		     case "5":
			  $TYPE = $lang['svc_function']['moderation_5'];
		     break;
		     case "6":
		          $txtSubject = $lang['svc_file']['moderation_6_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_6_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_function']['moderation_6'];
		     break;
		     case "7":
		          $txtSubject = $lang['svc_file']['moderation_7_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_7_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_file']['moderation_num_7'];
		     break;
		     case "8":
		          $txtSubject = $lang['svc_file']['moderation_8_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_8_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br><a href="index.php?mode=t&t='.$topic_id.$rid.'">'.$lang['svc_function']['show_why_request'].'</a><br></font>';
			  $TYPE = $lang['svc_function']['moderation_8'];
		     break;
		     case "9":
		          $txtSubject = $lang['svc_file']['moderation_9_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_9_message_part1'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_function']['moderation_9'];
		     break;
		     case "10":
		          $txtSubject = $lang['svc_file']['moderation_10_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_10_message_part1'].' <br><br>'.$lang['request_mon']['request_mon_message_part3'].' </font><br><font size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_file']['moderation_num_10'];
		     break;
		   case "11":
		          $txtSubject = "".$lang['svc_file']['moderation_11_subject']." ".forum_name($forum_id);
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_11_message_part1'].' '.forum_name($forum_id).'<br><br>'.$lang['svc_file']['moderation_11_message_part2'].' </font><br><font color="green" size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_file']['moderation_num_11'];
		     break;
		   case "12":
		   $txtSubject = $lang['svc_file']['moderation_12_subject'];
			  $txtMessage = '<font color="red" size="3">'.$lang['svc_file']['moderation_12_message_part1'].' </font><br><font size="3">'.$raison.'</font><font color="black" size="3"><br><br>'.$lang['svc_file']['requests_mon_notes'].'<br></font>';
			  $TYPE = $lang['svc_file']['moderation_num_12'];
		     break;

		}


	if($moderation_type != 5) {
	
		// SEND PM TO MEMBER ABOUT THE RAISON OF THE MODERATION
		send_pm($pm_mid, $member_id, $txtSubject, $txtMessage, $m_date);
		
	}

		
		$sql = DBi::$con->query("SELECT * FROM ".prefix."MODERATION WHERE M_MEMBERID = '$member_id' AND M_TYPE = '$moderation_type' AND M_STATUS = '0' AND M_FORUMID = '$forum_id' AND M_TOPICID = '0' AND M_REPLYID = '0' AND M_PM = '0' AND M_IHDAA = '0'");
		$num = mysqli_num_rows($sql);
		if($num > 0) {
		$two_requests = "1";	
		}
		$query = "INSERT INTO " . $Prefix . "MODERATION (MODERATION_ID, M_MEMBERID, M_STATUS, M_FORUMID, M_TOPICID, M_REPLYID, M_PM , M_IHDAA , M_ADDED, M_EXECUTE, M_MODERATOR_NOTES, M_TYPE, M_RAISON, M_DATE, M_TWOREQUESTS, M_DATEAPP, M_MONITOR_NOTES) VALUES (NULL, ";
		$query .= " '$member_id', ";
		$query .= " '1', ";
		$query .= " '$forum_id', ";
		$query .= " '0', ";
		$query .= " '0', ";
		$query .= " '0', ";
		$query .= " '0', ";
		$query .= " '$DBMemberID', ";
		$query .= " '$DBMemberID', ";
		$query .= " '$moderators_notes', ";
		$query .= " '$moderation_type', ";
		$query .= " '$moderation_raison', ";
		$query .= " '$m_date', ";
		$query .= " '$two_requests', ";
		$query .= " '$m_dateApp', ";
		$query .= " '$monitor_notes') ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		
		if ($moderation_type == 5) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_STATUS = '0' ";
			 $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		else if ($moderation_type == 7) {

		  if ($details_type == 1) {
			$hide = "M_HIDE_PHOTO = '1' ";
		  }
		  else if ($details_type == 2) {
			$hide = "M_HIDE_SIG = '1' ";
		  }
		  else if ($details_type == 3) {
			$hide = "M_HIDE_DETAILS = '1' ";
		  }

		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= $hide;
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		else if ($moderation_type == 8) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_HIDE_POSTS = '1' ";
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		else if ($moderation_type == 9) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_HIDE_PM = '1' ";
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}

		else if ($moderation_type == 10) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_USE_PM = '1' ";
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
		else if ($moderation_type == 12) {
		     $update = "UPDATE " . $Prefix . "MEMBERS SET ";
		     $update .= "M_IHDAA = '1' ";
		     $update .= "WHERE MEMBER_ID = '$member_id' ";
		     DBi::$con->query($update, $connection) or die (DBi::$con->error);
		}
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['others']['done_requestmon_profile'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL=index.php?mode=member&id='.$id.'">
                           <a href="index.php?mode=member&id='.$id.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';	

	
}
}
?>