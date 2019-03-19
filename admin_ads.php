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

if($type != "" && $type != "option" && $type != "edit") {
redirect();	
}

if($ad < 0) {
redirect();	
}
if($ad == 0) {
redirect();	
}
$sql = DBi::$con->query("SELECT * FROM ".prefix."ADS WHERE AD_ID = '$ad'");
$num = mysqli_num_rows($sql);
if($num <= 0) {
redirect();	
}
		$id = ads("ID", $ad);
		$subject = ads("SUBJECT", $ad);
		$Page_Name = $subject;
		$message = ads("MESSAGE", $ad);
		$counts = ads("COUNTS", $ad);
		$date = ads("DATE", $ad);
		$author = ads("AUTHOR", $ad);
		$status = ads("STATUS", $ad);
		$showforum = ads("SHOW_FORUM", $ad);
		$showsocial1 = ads("SHOW_SOCIAL_1", $ad);
		$showsocial2 = ads("SHOW_SOCIAL_2", $ad);
		
function ad_head(){
global $lang;	
	echo'

	<table cellSpacing="1" cellPadding="2" width="99%" align="center" border="0">
		<tr>
			<td class="optionsbar_menus">&nbsp;<nobr><a href="JavaScript:history.go(-1)"><font color="red" size="+1">'.$lang['admin_ads']['go_back'].'</font></a></nobr></td>
			<td class="optionsbar_menus" width="100%">&nbsp;<nobr><font color="red" size="+1">'.$lang['admin_ads']['admin_ads'].'</font></nobr></td>';
			refresh_time();
			go_to_forum();
		echo'
		</tr>
	</table>';
}

function ad_title($subject){
	global $lang, $icon;

		echo'
		<table class="optionsbar" cellSpacing="2" width="99%" align="center" border="0">
			<tr>
				<td vAlign="center">&nbsp;';
				 echo icons("images/icons/icon_complaint_solved.png");
				echo'</td>';
echo'<td class="optionsbar_title" vAlign="center" align="middle" width="100%">&nbsp;'.$subject.'</td>';


echo'</tr></table>';
}

function ad_message($message){
			echo'
			<table style="TABLE-LAYOUT: fixed; width:100%;">
				<tr>
					<td><div id="to_hidd">';
					echo html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($message)))), ENT_COMPAT, 'UTF-8');
					echo'
					</div></td>
				</tr>';
}

function ad_first($ad, $author, $date, $message, $status){
	global
		$lang, $Mlevel, $icon_profile, $icon_edit, $icon_lock, $icon_unlock, $icon_folder_archive,$icon_trash;
		echo'
<table bgcolor="gray" cellSpacing="1" cellPadding="4" align="center" width="99%" border="0">
		<tr>
			<td width="12%" vAlign="top" class="first">';
				echo admin_link($author);
echo '<div id="first_info">';
			echo'
			</td>';

			echo'
			<td vAlign="top" width="100%" class="first" colSpan="3">
			<table cellSpacing="0" cellPadding="0" width="100%">
				<tr>
					<td class="posticon" bgColor="red">
					<table cellSpacing="2" width="100%">
						<tr>
							<td class="posticon"><nobr>'.normal_time($date).'</nobr></td>
							<td class="posticon"><nobr><a href="index.php?mode=member&id='.$author.'">'.icons($icon_profile, $lang['topics']['member_info']).'</a></nobr></td>';
							if($Mlevel == 4) {
							echo'
							<td class="posticon"><nobr><a href="index.php?mode=editor&method=editads&ad='.$ad.'">'.icons($icon_edit, $lang['forum_function']['edit_ad']).'</a></nobr></td>
							'; 
							if($status == 1) {
								echo'
								<td class="posticon"><nobr><a href="index.php?mode=lock&type=ads&ad='.$ad.'">'.icons($icon_lock, $lang['forum_function']['lock_ad']).'</a></nobr></td>
								';
							} else {
								echo'
								<td class="posticon"><nobr><a href="index.php?mode=open&type=ads&ad='.$ad.'">'.icons($icon_unlock, $lang['forum_function']['open_ad']).'</a></nobr></td>
								';
							}
							echo'<td class="posticon"><nobr><a href="index.php?mode=ad&ad='.$ad.'&type=option">'.icons($icon_folder_archive, $lang['forum_function']['edit_ad_options']).'</a></nobr></td>
';
							echo'<td class="posticon"><nobr><a href="index.php?mode=delete&type=ads&ad='.$ad.'">'.icons($icon_trash, $lang['forum_function']['delete_ad']).'</a></nobr></td>
';

							}
	
							echo'
							<td class="posticon" width="90%">&nbsp;</td>';
							$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo '<td class="posticon"><iframe src="//www.facebook.com/plugins/like.php?href='.$url.'&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe></td>
';
							echo'<td class="posticon"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
</td>';



						echo '</tr>
					</table>
					</td>
				</tr>
			</table>';
echo '<div id="msg_first">';
			ad_message($message);
		


echo '</div>';
			echo'
			</table>
			</td>
		</tr>
		';

}

if($type == "") {
$Page_Name = $subject;
echo ad_head();
echo ad_title($subject);
echo ad_first($ad, $author, $date, $message, $status);
echo ad_title($subject);
echo ad_head();

		$sql = DBi::$con->query("SELECT * FROM ".prefix."ADS_COUNTS WHERE COUNT_MEMBER = '$DBMemberID' AND COUNT_AD = '$ad'");
		$num = mysqli_num_rows($sql);
		
		if($num == 0 AND $Mlevel > 0) {
			DBi::$con->query ("INSERT INTO ".prefix."ADS_COUNTS (COUNT_MEMBER, COUNT_AD) VALUES ('$DBMemberID', '$ad')") or die(DBi::$con->error);
		 DBi::$con->query("UPDATE ".prefix."ADS SET AD_COUNTS = AD_COUNTS + 1  WHERE AD_ID = '$ad' ") or die (DBi::$con->error);
			
		}	
}
if($type == "option") {
	

	if ($Mlevel == 4) {

		echo'
		<script language="javascript">
			function submit_form(){
				if (ad_info.AdSubject.value.length == 0){
					confirm("'.$lang['admin_ads']['enter_ad_title'].'");
					return;
				}
			ad_info.submit();
			}
		</script>
		<div align="center">
		<form method="POST" name="ad_info" action="index.php?mode=ad&ad='.$ad.'&type=edit">
		<input type="hidden" name="ad" value="'.$ad.'">
		<input type="hidden" name="referer" value="'.$referer.'">		
		<table cellSpacing="1" cellPadding="5" bgColor="gray" border="0">
			<tr class="fixed">
				<td class="optionheader" colspan=""><nobr>'.$lang['admin_ads']['ad_title'].':</nobr></td>
				<td colspan="4" class="list"><input type="text" size="50" name="AdSubject" value="'.$subject.'">&nbsp;&nbsp;</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['admin_ads']['ad_type'].'</nobr></td>
				<nobr>
				<td class="list"><input class="small" type="checkbox" value="1" name="AdShowForum"'.check_radio($showforum, "1").'>'.$lang['admin_ads']['forum_ad'].'</td>
				<td class="list"><input class="small" type="checkbox" value="1" name="AdShowSocial1"'.check_radio($showsocial1, "1").'>'.$lang['admin_ads']['ichraf_ad'].'</td>
				<td class="list" colSpan="2"><input class="small" type="checkbox" value="1" name="AdShowSocial2"'.check_radio($showsocial2, "1").'>'.$lang['admin_ads']['general_ad'].'</td>
				</nobr>
			</tr>
		
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['admin_ads']['ad_status'].'</nobr></td>
				<td class="list"><nobr><input type="radio" class="radio" name="AdStatus" value="1" '.check_radio($status, "1").'>'.$lang['admin']['open'].'</nobr></td>
				<td class="list" colSpan="3"><nobr><input type="radio" class="radio" name="AdStatus" value="0" '.check_radio($status, "0").'>'.$lang['admin']['close'].'</nobr></td>
			</tr>
		
			<tr class="fixed">
				<td class="list_center" colspan="5"><input type="button" onclick="submit_form();" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;<input type="reset" name="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</table>
		</form>
		</div>';
	}

}

if ($type == "edit") {
	
	$t_referer = DBi::$con->real_escape_string(htmlspecialchars($_POST['referer']));
	$status = DBi::$con->real_escape_string(intval($_POST["AdStatus"]));
	$subject = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["AdSubject"]));
	$showforum = DBi::$con->real_escape_string(intval($_POST["AdShowForum"]));
	$showsocial1 = DBi::$con->real_escape_string(intval($_POST["AdShowSocial1"]));	
	$showsocial2 = DBi::$con->real_escape_string(intval($_POST["AdShowSocial2"]));
	if ($Mlevel != 4) {
	redirect();
	}
		$adtype_array = array('0','1');
		$adstatus_array = array('1','0');
		
		if(!in_array($showforum, $adtype_array)) {
		redirect();	
		}
		if(!in_array($showsocial1, $adtype_array)) {
		redirect();	
		}
		if(!in_array($showsocial2, $adtype_array)) {
		redirect();	
		}
		if(!in_array($status, $adstatus_array)) {
		redirect();	
		}		
	if ($Mlevel == 4) {

		$sql = "UPDATE " . $Prefix . "ADS SET ";
		$sql .= "AD_SUBJECT = '$subject', ";
		$sql .= "AD_STATUS = '$status', ";
		$sql .= "AD_SHOW_FORUM = '$showforum', ";
		$sql .= "AD_SHOW_SOCIAL_1 = '$showsocial1', ";
		$sql .= "AD_SHOW_SOCIAL_2 = '$showsocial2' ";
		$sql .= "WHERE AD_ID = '$ad' ";
		@DBi::$con->query($sql, $connection) or die (DBi::$con->error);
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['admin_ads']['ad_options_done'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$t_referer.'">
                           <a href="index.php?mode=ad&ad='.$ad.'">'.$lang['admin_ads']['click_here_to_go_to_ad'].'</a><br><br>
                           <a href="'.$t_referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';

	}
}	


?>