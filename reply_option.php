<?
if (@eregi("reply_option.php","$_SERVER[PHP_SELF]")) {
header("HTTP/1.0 404 Not Found");
require_once("customavatars/foundfile.htm");
exit();
}

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

if($type != "" && $type != "edit") {
redirect();	
}

if ($type == "") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
	$f = replies("FORUM_ID", $r);
	$c = forums("CAT_ID", $f);
	$t = replies("TOPIC_ID", $r);
	$r_status = replies("STATUS", $r);
	$r_hidden = replies("HIDDEN", $r);
	$r_author = replies("AUTHOR", $r);
	$r_holded = replies("HOLDED", $r);
	$r_author_mod = replies("AUTHOR_MOD", $r);	

	if (allowed($f, 2) == 1) {

echo'     
		<div align="center">
		<form method="POST" name="reply_info" action="index.php?mode=r_option&type=edit">
		<input type="hidden" name="r" value="'.$r.'">
		<input type="hidden" name="t" value="'.$t.'">
		<input type="hidden" name="referer" value="'.$referer.'">
		<table cellSpacing="1" width="30%" cellPadding="5" bgColor="gray" border="0">
		<tr class="fixed">
				<td class="optionheader" colspan="3">'.$lang['topics']['change_reply_option'].'</td>
				</tr>
			<tr class="fixed">
				<td class="optionheader" colspan="1"><nobr>'.$lang['function']['topic'].':</nobr></td>
				<td colspan="2" class="list"><a href="index.php?mode=t&t='.$t.'">'.topics("SUBJECT", $t).'</a>&nbsp;&nbsp;</td>
			</tr>
			<tr class="fixed">
				<td class="optionheader" colspan="1"><nobr>'.$lang['medals']['medals_forum'].':</nobr></td>
				<td colspan="2" class="list"><a href="index.php?mode=f&f='.$f.'">'.forums("SUBJECT", $f).'</a>&nbsp;&nbsp;</td>
			</tr>			
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['r_stauts'].':</nobr></td>
				<td class="list"><nobr><input type="radio" class="radio" name="ReplyStatus" value="1" '.check_radio($r_status, "1").'>'.$lang['topics']['r_a_normal'].'</nobr></td>
				<td class="list"><nobr><input type="radio" class="radio" name="ReplyStatus" value="2" '.check_radio($r_status, "2").'>'.$lang['topics']['r_a_delete'].'</nobr></td>
			</tr>			
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['r_hidden'].':</nobr></td>
				<td class="list"><nobr><input type="radio" class="radio" name="ReplyHidden" value="0" '.check_radio($r_hidden, "0").'>'.$lang['forum']['topic_unhide'].'</nobr></td>
				<td class="list"><nobr><input type="radio" class="radio" name="ReplyHidden" value="1" '.check_radio($r_hidden, "1").'>'.$lang['topics']['r_a_hidden'].'</nobr></td>
			</tr>	
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['r_holded'].':</nobr></td>
				<td class="list"><nobr><input type="radio" class="radio" name="ReplyHolded" value="0" '.check_radio($r_holded, "0").'>'.$lang['topics']['not_hold'].'</nobr></td>
				<td class="list"><nobr><input type="radio" class="radio" name="ReplyHolded" value="1" '.check_radio($r_holded, "1").'>'.$lang['topics']['r_a_hold'].'</nobr></td>
			</tr>				
			';
			if($Mlevel == 4) {
			echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['r_author_number'].'</nobr></td>
				<td class="list" colSpan="2"><nobr><input class="insidetitle" size="5" name="ReplyAuthor" value="'.$r_author.'">&nbsp;&nbsp;'.link_profile(member_name($r_author), $r_author).'</nobr></td>
			</tr>
			';
			}
			echo'
			<tr class="fixed">
				<td class="optionheader"><nobr>'.$lang['topics']['r_author'].':</nobr></td>
				<td class="list" colSpan="2"><nobr>
				<select class="insidetitle" style="WIDTH: 310px" name="ReplyAuthorMod">
				<option value="0" '.check_select($r_author_mod, "0").'>'.$lang['topics']['r_real_author'].'</option>';
					$sql = @DBi::$con->query("SELECT * FROM ".$Prefix."AUTHOR_MOD WHERE REQ_FRMID = '$f' ORDER BY REQ_ID ASC ") or die(DBi::$con->error);
					$num = @mysqli_num_rows($sql);
					$x = 0;
					while ($x < $num){
						$s = @mysqli_result($sql, $x, "REQ_ID");
						$subject = @mysqli_result($sql, $x, "REQ_AUTHOR");
						echo'<option value="'.$s.'"';
						if ($s == $r_author_mod) { echo' selected'; }
						echo'>'.$subject.'</option>';
					++$x;
					}
				echo'
				</select>
				</nobr></td>
			</tr>				
			<tr class="fixed">
				<td class="list_center" colspan="3"><input type="submit" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;<input type="reset" name="reset" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>
		</table>
		</form>
		</div>';
	} else {
	redirect();	
	}
}

if ($type == "edit") {
	if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
	$r = DBi::$con->real_escape_string(intval($_POST['r']));
	$t = DBi::$con->real_escape_string(intval($_POST['t']));
	$f = replies("FORUM_ID", $r);
	$r_referer = DBi::$con->real_escape_string(htmlspecialchars($_POST['referer']));
	$r_status = DBi::$con->real_escape_string(intval($_POST["ReplyStatus"]));
	$r_hidden = DBi::$con->real_escape_string(intval($_POST["ReplyHidden"]));
	$r_author = DBi::$con->real_escape_string(intval($_POST["ReplyAuthor"]));
	$r_holded = DBi::$con->real_escape_string(intval($_POST['ReplyHolded']));
	$r_author_mod = DBi::$con->real_escape_string(intval($_POST['ReplyAuthorMod']));
	
$author_mod_array = array('0','1');
$status_array = array('1','2');
$hide_array = array('0','1');
$hold_array = array('0','1');

	if (allowed($f, 2) == 1) {

		$sql = "UPDATE " . $Prefix . "REPLY SET ";
		if($Mlevel == 4) {
		$sql .= "R_AUTHOR = '$r_author', ";
		}
		$sql .= "R_STATUS = '$r_status', ";		
		$sql .= "R_HOLDED = '$r_holded', ";		
		$sql .= "R_AUTHOR_MOD = '$r_author_mod', ";		
		$sql .= "R_HIDDEN = '$r_hidden' ";		
		$sql .= "WHERE REPLY_ID = '$r' ";
		@DBi::$con->query($sql, $connection) or die (DBi::$con->error);
		
if(allowed($f, 2) == 1) {
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
}	

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['all']['info_was_edited'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="1; URL='.$r_referer.'">
                           <a href="index.php?mode=t&t='.$t.'&r='.$r.'">'.$lang['topics']['click_here_to_go_to_reply'].'</a><br><br>
                           <a href="index.php?mode=t&t='.$t.'">'.$lang['all']['click_here_to_go_topic'].'</a><br><br>
	                       <a href="index.php?mode=f&f='.$f.'">'.$lang['all']['click_here_to_go_forum'].'</a><br><br>
                           <a href="'.$r_referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';

	} else {
	redirect();	
	}
}

?>