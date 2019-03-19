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

if(svc != "add_mods" && svc != "mods_add" && svc != "accept_mods" && $type != "" && $type != "refused" && $type != "accept" && $type != "go" && $type != "submit" && $type != "list" && $type != "topic") {
redirect();
}


if ($Mlevel > 2 && $deputy == 0){
	if($Mlevel != 3) {
		echo'
		<center>
		<table  cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td>
				<table cellSpacing="2" width="100%" border="0">
					<tr>
						<td class="optionsbar_menus" vAlign="center" width="100%"><nobr><font color="red" size="+1"><b>'.$lang['admin_svc']['admin_svc'].'</b></font></nobr></td>
						<td class="'.chk_add_ichraf().'" vAlign="top"><nobr><a href="index.php?mode=add_ichraf&svc=accept_mods">'.$lang['svc_menu']['add_ichraf'].'</a></nobr></td>				
                        <td class="optionsbar_menus"><a href="index.php?mode=admin_svc&type=forumsorder"><nobr>'.$lang['admin_svc']['forum_order'].'</nobr></a></td>
						<td class="optionsbar_menus"><a href="index.php?mode=admin_svc&type=ads"><nobr>'.$lang['admin_svc']['admin_ads'].'</nobr></a></td>
						<td class="'.chk_num_user_wait().'"><a href="index.php?mode=admin_svc&type=approve"><nobr>'.$lang['admin_svc']['pending_member'].'</nobr></a></td>
						<td class="'.chk_num_user_wait_email().'"><a href="index.php?mode=admin_svc&type=approve_email"><nobr>'.$lang['admin_svc']['pending_member_email'].'</nobr></a></td>
						<td class="optionsbar_menus"><a href="index.php?mode=admin_svc&type=hold"><nobr>'.$lang['admin_svc']['refuse_member'].'</nobr></a></td>
						<td class="'.chk_changename_count().'"><a href="index.php?mode=admin_svc&type=change_name"><nobr>'.$lang['admin_svc']['pending_name'].'</nobr></a></td>
						<td class="optionsbar_menus"><a href="index.php?mode=members&type=lock"><nobr>'.$lang['admin_svc']['lock_member'].'</nobr></a></td>
			<td class="optionsbar_menus" vAlign="top"><nobr><a href="index.php?mode=members&type=hold">'.$lang['admin_svc']['hold_member'].'</a></nobr></td>
						';
					if ($type == "approve" OR $type == "hold" OR $type == "approve_email"){
						paging();
					}
					
						refresh_time();
					
					go_to_forum();
					echo'
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</center>
		<br>';
	}

		echo'
		</tr>
	</table>
	</center><br>';
echo '<script language="javascript">
	var check_flag = "false";
	function check(checked, alert_msg) {
		if (check_flag == "false") {
			var count = 0;
			for (i = 0; i < checked.length; i++) {
				checked[i].checked = true;
				if (checked[i].type == "checkbox"){
					count += 1;
				}
			}
			check_flag = "true";
			alert(alert_msg+": "+count);
			return "'.$lang['other']['no_select_all'].'";
		}
		else {
			for (i = 0; i < checked.length; i++){
				checked[i].checked = false;
			}
			check_flag = "false";
			return "'.$lang['editor']['ed_tip_select_all'].'";
		}
	}
</script>';
if (svc == "add_mods" && $Mlevel > 2) {
if ($id == $DBMemberID) {
error_message($lang['add_ichraf']['dont_can_add_yourself']);
exit();
}
if (members("LEVEL", $id) >= 4) {
error_message($lang['add_ichraf']['dont_can_add_this_level']);
exit();
}
$id = $_GET['id'];
if ($id == "") {
error_message($lang['add_ichraf']['dont_can_add_ichraf']);
exit();
}
$check_num = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE MEMBER_ID = '$id' AND M_STATUS = '1' AND M_HOLDED = '0'") 
or die(DBi::$con->error);
if(mysqli_num_rows($check_num) <= 0){
error_message($lang['add_ichraf']['dont_can_add_ichraf_this_member']);
exit();
}


echo'
<center>
<form method="post" action="index.php?mode=add_ichraf&svc=mods_add">
<input value="'.$id.'" type="hidden" name="user_id">
<table cellSpacing="1" cellPadding="0"  width="40%" >
			<tr>
				<td class="optionsbar_menus" colSpan="15"><font color="red" size="+1">'.$lang['add_ichraf']['add_ichraf_this_member'].' '.link_profile(member_name($id), $id).' '.$lang['add_ichraf']['to_ichraf'].'</font></td>
			</tr>';
		echo'
		<center>
<table bgcolor="gray" cellSpacing="1" class="grid" cellPadding="0"  width="40%" >

			<tr class="fixed"><td width="40%" class="cat"><nobr><font ="red" size="+1">'.$lang['add_ichraf']['forum_name'].'</font></nobr></td>
				<td class="list"><nobr></nobr>';


		echo'<select class="insidetitle" name="frm_id" size="1">';
		$where = "WHERE FORUM_ID IN (".chk_allowed_forums_all_id().")";
		$sql = DBi::$con->query("SELECT * FROM ".prefix."FORUM ".$where." ORDER BY FORUM_ID ASC") or die   (DBi::$con->error);
		$s_num = mysqli_num_rows($sql);
		$s_i = 0;
		while ($s_i < $s_num) {
		$f_id = mysqli_result($sql, $s_i, "FORUM_ID");
    	$subject = mysqli_result($sql, $s_i, "F_SUBJECT");
		echo '<option value="'.$f_id.'" >'.$subject.'</option>';
			$s_i++;
			}
	echo'</select>
		<tr class="fixed">
			<td colspan="2" align="middle"><input type="submit" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;
			<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
</td>
	</tr></form>
		</table>
		</center>';
}


if (svc == "mods_add" && $Mlevel > 2) {
$frm_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['frm_id']));
$user_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['user_id']));
$date = time();
if (members("LEVEL", $user_id) >= 4) {
error_message($lang['add_ichraf']['dont_can_add_this_level']);
}
if ($user_id == "" or $forum_id = "") {
error_message($lang['add_ichraf']['dont_can_add_ichraf']);
}

	$sql = DBi::$con->query("SELECT * FROM ".prefix."ADD_MODS WHERE MEMBER_ID = '$user_id' and STATUS != '0' ") or die (DBi::$con->error);
	if(mysqli_num_rows($sql) > 0){
		$go = "0";
	}else{$go = "0";}
	
	$sql = DBi::$con->query("SELECT * FROM ".prefix."MODERATOR WHERE MEMBER_ID = '$user_id' and FORUM_ID = '$frm_id' ") or die (DBi::$con->error);
	if(mysqli_num_rows($sql) > 0){
		$erreur = "1";
	}else{$erreur = "0";}
	
	
if ($go == "0" and $erreur == "0") {
DBi::$con->query("INSERT INTO ".prefix."ADD_MODS (ID, FORUM_ID , MEMBER_ID ,  BY_ID , STATUS , DATE ) VALUES (NULL, '$frm_id' , '$user_id' ,'".m_id."', '4' ,'$date' ) ") or die(DBi::$con->error);
  echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['add_ichraf']['done_add_and_will_admin'].'</font><br><br>';
                           echo'<meta http-equiv="Refresh" content="3; URL=index.php">';
	                       echo'<a href="index.php">'.$lang['profile']['click_here_to_go_normal_page'].'</a><br><br>';
   
                           echo'
	                       </td>
	                   </tr>
	                </table>
	                </center>';

}}
if ($erreur == "1") {
error_message($lang['add_ichraf']['this_member_is_mod_in_this_forum']);
}
if ($go == "1") {
error_message($lang['add_ichraf']['this_member_is_in_mod_list']);
}

if (svc == "accept_mods" && $Mlevel == 4) {

if (type == ""){
$this_status = "4";
$txt = $lang['add_ichraf']['pending_ichraf'];
}elseif (type == "refused"){
$this_status = "3";
$txt = $lang['add_ichraf']['refused_ichraf'];
}elseif (type == "accept"){
$this_status = "2";
$txt = $lang['add_ichraf']['accept_ichraf'];
}elseif (type == "go"){
$this_status = "1";
$txt = $lang['add_ichraf']['mod_list'];
}

function chk_add_ichraf_cmd_p(){
	if(add_mods_pending() > 0) {
	$value = "stats_menuCmd";	
	} else {
	$value = "stats_menu".chk_cmd(type, "", "Sel")."";	
	}
return($value);
}

function chk_add_ichraf_cmd_d(){
	if(add_mods_done() > 0) {
	$value = "stats_menuCmd";	
	} else {
	$value = "stats_menu".chk_cmd(type, "accept", "Sel")."";	
	}
return($value);
}


function mods_head(){
global $lang;
echo' <center>
		<table>
			<tr>
				<td class="'.chk_add_ichraf_cmd_p().'"><a class="stats_menu" href="index.php?mode=add_ichraf&svc=accept_mods">'.$lang['add_ichraf']['pending_ichraf'].'</a></td>
				<td class="stats_menu'.chk_cmd(type, "refused", "Sel").'"><a class="stats_menu" href="index.php?mode=add_ichraf&svc=accept_mods&type=refused">'.$lang['add_ichraf']['refused_ichraf'].'</a></td>
				<td class="'.chk_add_ichraf_cmd_d().'"><a class="stats_menu" href="index.php?mode=add_ichraf&svc=accept_mods&type=accept">'.$lang['add_ichraf']['accept_ichraf'].'</a></td>
				<td class="stats_menu'.chk_cmd(type, "go", "Sel").'"><a class="stats_menu" href="index.php?mode=add_ichraf&svc=accept_mods&type=go">'.$lang['add_ichraf']['accepted_ichraf'].'</a></td>
				<td></td><td></td><td></td><td></td>
				<td class="stats_menu"><a class="stats_menu" href="index.php?mode=add_ichraf&svc=accept_mods&type=list">'.$lang['add_ichraf']['mod_list'].'</a></td>
			</tr>
		</table>';
}

function mods_list(){
global $lang;
echo' 	<center>

	<table cellSpacing="1" cellPadding="5">
		<tr>
			<td width="25%" class="optionsbar_menus" colSpan="20"><font color="red" size="+1"><b>'.$lang['add_ichraf']['mod_list'].'</b></font></td>
		</tr></table><br>
		';
			$sql = DBi::$con->query("SELECT * FROM ".prefix."ADD_MODS WHERE STATUS = '1 ' ORDER BY FORUM_ID ASC ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$i = 0;
	while ($i < $num) {
		$u = mysqli_result($sql, $i, "ID");
		$id = mysqli_result($sql, $i, "MEMBER_ID");
		$frm = mysqli_result($sql, $i, "FORUM_ID");
		$forum = forums("SUBJECT", $frm);
		echo'
<table width="40%" border="1" bgColor="white">
		<tr>
		<td  width="40%" >'.link_profile(member_name($id), $id).'</td>
		<td>'.$forum.'</td>	
		
';
		$x = $x + 1;
	++$i;
	}
	echo'
	
	</table>';
/*
		<table width="40%" border="1" bgColor="cyan">
		<tr>
		<td  width="40%" >'.link_profile(member_name($id), $id).'</td>
		<td>'.$forum.'</td>	
else{
		echo'
		<tr>
			<td class="stats_p" align="middle" colSpan="20"><font color="black"><br>'.$lang['add_ichraf']['no_ichraf'].'<br><br></font></td>
		</tr>';
	}	*/
	//echo"<br>";
}
function accept_mods(){
	global $lang, $user_id, $ulv, $max_page, $img , $this_status , $txt;
	echo'
	<script language="javascript">
		function chk_app_user(obj){
			if (obj.name == "approve"){
				var go_to = confirm("'.$lang['add_ichraf']['confirm_accept'].'");
				if (go_to){
					obj.form.method.value = "approve";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "hold"){
				var go_to = confirm("'.$lang['add_ichraf']['confirm_refused'].'");
				if (go_to){
					obj.form.method.value = "hold";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "delete"){
				var go_to = confirm("'.$lang['add_ichraf']['confirm_delete'].'");
				if (go_to){
					obj.form.method.value = "delete";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "go"){
				var go_to = confirm("'.$lang['add_ichraf']['confirm_set'].'");
				if (go_to){
					obj.form.method.value = "go";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "finish"){
				var go_to = confirm("'.$lang['add_ichraf']['confirm_delete_from_mod_list'].'");
				if (go_to){
					obj.form.method.value = "finish";
					obj.form.submit();
				}
				else{
					return;
				}
			}
		}
	</script>
	<center>
	<table cellSpacing="1" cellPadding="5">
	<form name="app_user" method="post" action="index.php?mode=add_ichraf&svc=accept_mods&type=sumbit">
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="20"><font color="red" size="+1"><b>'.$txt.'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h">&nbsp;</td>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['profile']['member_name'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['active']['forum'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['add_ichraf']['morashe7'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['add_ichraf']['tarshe7_date'].'</nobr></td>
		</tr>';
	$sql = DBi::$con->query("SELECT * FROM ".prefix."ADD_MODS WHERE STATUS = '$this_status ' ORDER BY ID ASC ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$i = 0;
	while ($i < $num) {
		$u = mysqli_result($sql, $i, "ID");
		$id = mysqli_result($sql, $i, "MEMBER_ID");
		$frm = mysqli_result($sql, $i, "FORUM_ID");
		$forum = forums("SUBJECT", $frm);
		$date = mysqli_result($sql, $i, "DATE");
		$by_who  = mysqli_result($sql, $i, "BY_ID");

		echo'
		<tr>
			<td class="stats_p"><nobr>&nbsp;
			<input class="small" type="hidden" name="frm[]" value="'.$frm.'">
			<input class="small" type="hidden" name="members[]" value="'.$id.'">
			<input class="small" type="checkbox" name="app[]" value="'.$u.'">
			</nobr></td>
			<td class="stats_h">'.$id.'</td>
			<td class="stats_g" align="center"><font color="#ffffff"><b>'.link_profile(member_name($id),$id).'</b></font></td>
			<td class="stats_p"><font color="#000000"><a href="index.php?mode=f&f='.$frm.'">'.$forum .'</font></td>
			<td class="stats_p" align="center"><font color="#000000">'.link_profile(member_name($by_who),$by_who).'</font></td>
			<td class="stats_p"><font color="red">'.normal_time($date).'</font></td>
		</tr>';
		$x = $x + 1;
	++$i;
	}
	if ($x > 0){
		echo'
		<tr>
			<td height="30" colspan="20">&nbsp;</td>
		</tr>
		<tr>
			<td class="optionsbar_menus" colspan="20">
				<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['add_ichraf']['num_members'].'\')">';
			if (type == "" or type == "refused"){echo'<input name="approve" type="button" onclick="chk_app_user(this)" value="'.$lang['add_ichraf']['accpet_mod'].'">&nbsp;';	}
			if (type == "" or type == "accept"){echo'	<input name="hold" type="button" onclick="chk_app_user(this)" value="'.$lang['add_ichraf']['refused_mod'].'">&nbsp;';	}
			if (type == "accept"){echo'	<input name="go" type="button" onclick="chk_app_user(this)" value="'.$lang['add_ichraf']['set_mod'].'">&nbsp;';	}
			if (type == "go"){echo'	<input name="finish" type="button" onclick="chk_app_user(this)" value="'.$lang['add_ichraf']['delete_from_mod_list'].'">&nbsp;';	}
			if (type != "go"){echo'<input name="delete" type="button" onclick="chk_app_user(this)" value="'.$lang['add_ichraf']['delete_mod_selected'].'">';}
			echo'</td>
		</tr>';
	}
	else{
		echo'
		<tr>
			<td class="stats_p" align="middle" colSpan="20"><font color="black"><br>'.$lang['add_ichraf']['no_add_ichraf'].'<br><br></font></td>
		</tr>';
	}
	echo'
	</form>
	</table>
	<center>';
}


function sumbit_mods(){
	global $lang, $_POST, $referer, $forum_title, $forum_title2, $admin_user_name, $lang;
	$method = $_POST['method'];
	$app = $_POST['app'];
	$frm = $_POST['frm'];
	$members = $_POST['members'];
	if ($app == ""){
		$error = $lang['add_ichraf']['dont_select_member'];
	}
	if ($error != ""){
		error_message($error);
	}
	if ($error == ""){
		if ($method == "approve"){
			$i = 0;
			while($i  < count($app)){
if(members("SEX", $members[$i]) == 0 or members("SEX", $members[$i]) == 1) {
$txt = $lang['add_ichraf']['add_male'];	
}
if(members("SEX", $members[$i]) == 2) {
$txt = $lang['add_ichraf']['add_female'];	
}				
$t_subject = ''.forums("SUBJECT", $frm[$i]).'';
$subject = ''.$lang['add_ichraf']['invite_to_ichraf_on_forum'].' '.$t_subject;
$message = '<center><font color="black" size="3">'.$txt.' : '.link_profile(member_name($members[$i]), $members[$i]).' :<br>'.$lang['add_ichraf']['message_part1'].'<a href="index.php?mode=f&f='.$frm[$i].'">'.forums("SUBJECT", $frm[$i]).'</a>.<br>'.$lang['add_ichraf']['message_part2'].''.$admin_user_name.'<br>'.$lang['add_ichraf']['message_part3'].' '.$forum_title.' '.$lang['add_ichraf']['message_part4'].' '.$forum_title2.'<br>'.$lang['add_ichraf']['message_part5'].'</font></center>';

    $sqle = "INSERT INTO ".prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
    $sqle .= " '$members[$i]', ";
    $sqle .= " '$members[$i]', ";
    $sqle .= " '1', ";
    $sqle .= " '0', ";
    $sqle .= " '$subject', ";
    $sqle .= " '$message', ";
    $sqle .= " '".time()."') ";
    DBi::$con->query($sqle) or die (DBi::$con->error);			
				DBi::$con->query("UPDATE ".prefix."ADD_MODS SET STATUS = '2' WHERE ID = '$app[$i]' ") or die(DBi::$con->error);
			$i++;
			}
			$msg_txt = $lang['add_ichraf']['done_accept_mod'];			
		}
		if ($method == "hold"){
			$i = 0;
			while($i  < count($app)){	
			DBi::$con->query("UPDATE ".prefix."ADD_MODS SET STATUS = '3' WHERE ID = '$app[$i]' ") or die(DBi::$con->error);
			$i++;
			}
			$msg_txt = $lang['add_ichraf']['done_refused_mod'];
		}
		if ($method == "delete"){
			$i = 0;
			while($i  < count($app)){
				DBi::$con->query("DELETE FROM ".prefix."ADD_MODS WHERE ID = '$app[$i]' ") or die(DBi::$con->error);
			$i++;
			}
			$msg_txt = $lang['add_ichraf']['done_delete_mod'];
		}
		if ($method == "finish"){
			$i = 0;
			while($i  < count($app)){	
			$user_level = members("LEVEL", $members[$i]);
			if ($user_level > 2){ $level = $user_level; $old = 0;}else{ $level = '1'; $old = 1;	}
			DBi::$con->query("UPDATE ".prefix."ADD_MODS SET STATUS = '0' WHERE ID = '$app[$i]' ") or die(DBi::$con->error);
			DBi::$con->query("DELETE FROM ".prefix."MODERATOR WHERE MEMBER_ID = '$members[$i]' ") or die(DBi::$con->error);
			DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_LEVEL = '$level', M_ICON_VERF = '0', M_OLD_MOD = '$old' WHERE MEMBER_ID = '$members[$i]' ") or die(DBi::$con->error);	
			$i++;
			}
			$msg_txt = $lang['add_ichraf']['done_delete_from_mod_list'];
		}
		if ($method == "go"){
			$i = 0;
			while($i  < count($app)){
			$user_level = members("LEVEL", $members[$i]);
			if ($user_level > 2){ $level = $user_level; }else{ $level = '2';}
			DBi::$con->query("UPDATE ".prefix."ADD_MODS SET STATUS = '1', TOPIC = '1' WHERE ID = '$app[$i]' ") or die(DBi::$con->error);
			DBi::$con->query("INSERT INTO ".prefix."MODERATOR (MOD_ID, FORUM_ID, MEMBER_ID) VALUES (NULL, '$frm[$i]', '$members[$i]')") or die(DBi::$con->error);
	/////////////
	
	$query7 = "UPDATE ".prefix."MEMBERS SET ";
	$query7 .= "M_LEVEL = '$level', ";	
	$query7 .= "M_ICON_VERF = '1' ";	
	$query7 .= "WHERE MEMBER_ID = '$members[$i]' ";     
	DBi::$con->query($query7) or die (DBi::$con->error);
	

$old = 0;	
	$query9 = "UPDATE ".prefix."MEMBERS SET ";
	$query9 .= "M_OLD_MOD = '$old' ";	
	$query9 .= "WHERE MEMBER_ID = '$members[$i]' ";     
	DBi::$con->query($query9) or die (DBi::$con->error);	
///////////

			$i++;
			}		
			topic();
			$msg_txt = $lang['add_ichraf']['done_set_mod'];
		}		
		echo'
		<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5"><br><b>'.$msg_txt.'</b></font><br><br>
					<meta http-equiv="refresh" content="1; URL='.$referer.'">
					<a href="'.$referer.'">'.$lang['profile']['click_here_to_go_normal_page'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';		
	}

	

}

function topic () {
global $referer, $lang;
$sql = DBi::$con->query("SELECT * FROM ".prefix."ADD_MODS WHERE STATUS = '1' AND TOPIC = '1'");
$num = mysqli_num_rows($sql);

$ads = "INSERT INTO " . prefix . "ADS (AD_ID, AD_SUBJECT, AD_MESSAGE, AD_DATE, AD_STATUS, AD_SHOW_FORUM, AD_SHOW_SOCIAL_1, AD_SHOW_SOCIAL_2, AD_AUTHOR) VALUES (NULL, ";
$ads .= " '".$lang['add_ichraf']['topic_part1']." ".$num." ".$lang['add_ichraf']['topic_part2']."', ";
$ads .= " '
<DIV style=\"TEXT-ALIGN: center; FONT-FAMILY: arial; COLOR: #000000; FONT-SIZE: 16px; FONT-WEIGHT: 700\">
<FONT color=#000000>".$lang['add_ichraf']['topic_part3']." ".$num." ".$lang['add_ichraf']['topic_part4']."
<BR><BR>
<CENTER>
<TABLE border=1 bgColor=white>
";
$sql = DBi::$con->query("SELECT * FROM ".prefix."ADD_MODS WHERE STATUS = '1' AND TOPIC = '1'");
$num = mysqli_num_rows($sql);
$x = 0;
while($x < $num) {
$member_id = mysqli_result($sql, $x, "MEMBER_ID");
$member_name = link_profile(member_name($member_id), $member_id);
$forum_id = mysqli_result($sql, $x, "FORUM_ID");
$forum_name = forums("SUBJECT", $forum_id);
$forum_url = '<a href="index.php?mode=f&f='.$forum_id.'">'.$forum_name.'</a>';
$ads .= "
<TR><TD><CENTER>".$member_name."</CENTER></TD>
<TD><CENTER>".$forum_url."</CENTER></TD></TR>";
++$x;
}
$ads .= "
</TABLE></CENTER>
<BR><BR>
".$lang['add_ichraf']['topic_part5']."
<BR><BR>
".$lang['add_ichraf']['topic_part6']."</FONT></DIV>',";
$ads .= " '".time()."', ";
$ads .= " '1', ";
$ads .= " '1', ";
$ads .= " '1', ";
$ads .= " '0', ";
$ads .= " '1') ";
@DBi::$con->query($ads, $connection) or die (DBi::$con->error);		


DBi::$con->query("UPDATE ".prefix."ADD_MODS SET TOPIC = '0' WHERE STATUS = '1' AND TOPIC = '1'") or die (DBi::$con->error);	

		echo'';	
		
}	
mods_head();
if (type == ""){
accept_mods();
}elseif (type == "sumbit"){
sumbit_mods();
}elseif (type == "refused"){
accept_mods();
}elseif (type == "accept"){
accept_mods();
}elseif (type == "go"){
accept_mods();
}elseif (type == "list"){
mods_list();
}elseif (type == "topic"){
topic();
}


}
}
else{
	go_to("index.php");
}
?>