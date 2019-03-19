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

if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
if ($DBMemberID > 0) {
if (members("CHANGE_NAME", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][change_name].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}

if($mlv == 1 AND $DBMemberPosts < $new_member_change_name){
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
	                       
'.$lang[sorry][noo].'
'.$lang[sorry][change].'
'.$lang[sorry][will].'
	                       </font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
if($type != "" AND $type != "true" AND $type != "false"){
	header("Location: ".index()."");
	exit();
}
if ($type == "") {

$queryM = "SELECT * FROM " . $Prefix . "MEMBERS ";
$queryM .= "WHERE MEMBER_ID = '$DBMemberID' ";
$resultM = @DBi::$con->query($queryM) or die (DBi::$con->error);

if(mysqli_num_rows($resultM) > 0){
$rsM = @mysqli_fetch_array($resultM);

$ChCount = $rsM['M_CHANGENAME'];
}

$queryCH = "SELECT * FROM " . $Prefix . "CHANGENAME_PENDING ";
$queryCH .= "WHERE MEMBERID = '$DBMemberID' AND UNDERDEMANDE = '1' ";
$resultCH = @DBi::$con->query($queryCH) or die (DBi::$con->error);

if(mysqli_num_rows($resultCH) > 0){
$rsCH = @mysqli_fetch_array($resultCH);

$ChName_ID = $rsCH['CHNAME_ID'];
$ChNewName = $rsCH['NEW_NAME'];
}

$max = "SELECT MAX(CH_DATE) FROM ".$Prefix."CHANGENAME_PENDING WHERE MEMBERID = '$DBMemberID' ";
$rmax = @DBi::$con->query($max) or die (DBi::$con->error);
$ChDate = @mysqli_result($rmax, "CH_DATE");

if ($ChCount == $change_name_max) {
echo'
<center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td align="center"><font color="red" size="+1">'.$lang['others']['cant_change_name'].' '.$change_name_max.' '.$lang['others']['times'].'<br><br></font></td>
			</tr>
		</table>
</center>';
}

elseif ($ChNewName != "") {

echo '		
<center>
<table cellpadding="1" border="0">
	<tr>
		<td><font color=red size=+2>'.$lang['others']['change_name_request'].'</font><br><br></td>
	</tr>
<table cellpadding="10" border="1">
		<form action="index.php?mode=changename&type=false" method="post">
		<input type="hidden" name="changename_id" value="'.$ChName_ID.'">
		<tr class="fixed">
		<td align="center"><br><font color="black" size="3">
		'.$lang['others']['request_name_pending'].'
		</font><br><br>
		<font color="red">'.$ChNewName.'</font><br><br>
		<input type="submit" value="'.$lang['others']['click_here_to_cancel'].'">
		<br><br>
		</td>
	</tr>
</table>
</form>';

}

elseif (member_total_days($ChDate) <= $changename_dayslimit) {
echo'
<center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td align="center"><font color="red" size="+1">'.$lang['others']['cant_change_name_days'].'  '.$changename_dayslimit.' '.$lang['others']['days'].'<br><br></font>'.$lang['others']['try_again'].'<br></td>
			</tr>
		</table>
</center>';
}

else {

echo'
<script language="javascript" src="./javascript/change_name.js"></script>
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0" id="table1">
	<tr>
		<td><center><font color="red" size="+2">'.$lang['changename']['demande_change_username'].'</font><br>
			<form name="userinfo" method="post" action="index.php?mode=changename&type=true">
	<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0" id="table2">
				<tr class="fixed">
					<td class="optionheader_selected" id="row_user_name"><nobr>'.$lang['changename']['new_username'].'</nobr></td>
					<td class="list" colSpan="1"><input class="insidetitle" style="WIDTH: 300px" name="user_name" value="'.$DBUserName.'">'.$info.'</td>
				</tr>
				<tr class="fixed">
					<td><font color="red" size="-1">'.$lang['register']['rules_write_user_name_one'].'<br>&nbsp;</font></td>
					<td><font color="red" size="-1">'.$lang['register']['rules_write_user_name_tow'].'<br>&nbsp;</font></td>
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
					<input onclick="submitForm()" type="button" value="'.$lang['changename']['send_demande'].'"></td>
				</tr>
			</form>
	</table>
		</td>
	</tr>
	<tr>
		<td align="center"><br>
		'.$lang['changename']['count'].'
		<font color="red">'.$ChCount.'</font><br>
		'.$lang['changename']['change_username_max'].'</font>
		<font color="red">'.$change_name_max.'</font>';
	if ($ChCount + 1 >= $change_name_max) {
		echo' <br><br>'.$lang['others']['last_time_change'].'';
	}
	echo'	</td>
	</tr>
</table>
</center>';

}
}

if ($type == "true") {

$user_name = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_name"]));

$CH_Date = time();
	$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));

 $query2 = "SELECT * FROM " . $Prefix . "MEMBERS WHERE M_NAME = '" . $user_name . "' ";
 $result2 = @DBi::$con->query($query2) or die (DBi::$con->error);

 if(@mysqli_num_rows($result2) > 0){
 $rs2 = @mysqli_fetch_array($result2);

 $UserName = $rs2['M_NAME'];
 }
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$text = '<font color="red" size="+1">'.$lang['others']['wrong_captcha'].'</font>';
	}
elseif ($user_name == $DBUserName) {
$text = '<font color="red" size="+1">'.$lang['others']['insert_new_name'].'</font>';
}
elseif ($user_name == $UserName) {
$text = '<font color="red" size="+1">'.$lang['others']['registering_name'].'</font>';
}

else {

$query1 = "INSERT INTO " . $Prefix . "CHANGENAME_PENDING (CHNAME_ID, MEMBERID, NEW_NAME, LAST_NAME, UNDERDEMANDE, CH_DATE) VALUES (NULL, '$DBMemberID', '$user_name', '$DBUserName', '1', '$CH_Date')";
@DBi::$con->query($query1) or die (DBi::$con->error);

$text = ''.$lang['others']['done_change_name_request'].'<br>';
}

	echo '	<center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td align="center">
				'.$text.'</td>
			</tr>
		</table>
		</center>';

}

if ($type == "false") {

$ChName_ID = DBi::$con->real_escape_string($_POST["changename_id"]);

     	$query3 = "UPDATE " . $Prefix . "CHANGENAME_PENDING SET UNDERDEMANDE = ('0') ";
     	$query3 .= "WHERE CHNAME_ID = '$ChName_ID' AND MEMBERID = '$DBMemberID' ";

     	@DBi::$con->query($query3) or die (DBi::$con->error);

	$query4 = "DELETE FROM " . $Prefix . "CHANGENAME_PENDING WHERE CHNAME_ID = '$ChName_ID' ";
	@DBi::$con->query($query4) or die (DBi::$con->error);

	echo '	<center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td align="center"><font color="red" size="+1">'.$lang['others']['done_canecl_change_name'].'</td>
			</tr>
		</table>
		</center>';

}

} else {
redirect();	
}

@mysqli_close();

?>