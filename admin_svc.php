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

if($type != "" && $type != "forumsorder" && $type != "ads" && $type != "approve" && $type != "set_approve" && $type != "approve_email" && $type != "set_approve_email" && $type != "hold" && $type != "set_hold" && $type != "change_name" && $type != "set_change_name") {
redirect();	
}

function title_tr($title){
	echo'
	<tr class="fixed">
		<td class="cat" colspan="2"><nobr>'.$title.'</nobr></td>
	</tr>';
}

function value_tr($title, $value){
	echo'
	<tr class="fixed">
		<td class="list" width="1%"><nobr><b>&nbsp;'.$title.'&nbsp;&nbsp;</b></nobr></td>
		<td class="list">(&nbsp;<font color="red">'.$value.'</font>&nbsp;)</td>
	</tr>';
}

function admin_body(){
	global $site_name, $lang, $_SERVER, $show_alexa_traffic; 
	echo'
	<center>
	<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="50%">';

		title_tr($lang['admin_svc']['names_members_stat']);
		value_tr('<a href="index.php?mode=admin_svc&type=change_name">'.$lang['admin_svc']['pending_names'].'</a>', changename_count (1));
		value_tr('<a href="index.php?mode=admin_svc&type=approve">'.$lang['admin_svc']['pending_users'].'</a>', num_user_wait());
		value_tr('<a href="index.php?mode=admin_svc&type=approve_email">'.$lang['admin_svc']['pending_users_email'].'</a>', num_user_wait_email());
		value_tr('<a href="index.php?mode=admin_svc&type=hold">'.$lang['admin_svc']['refused_users'].'</a>', num_user_not_agree());
		value_tr('<a href="index.php?mode=members&type=lock">'.$lang['body']['lock_users'].'</a>', users_number(0, 0));
		
		title_tr($lang['body']['users_num']);
		value_tr($lang['body']['users'], users_number(1, 1));
		value_tr($lang['body']['mods'], users_number(2, 1));
		value_tr($lang['body']['mons'], users_number(3, 1));
		value_tr($lang['body']['admins'], users_number(4, 1));
		
		title_tr($lang['body']['onlines']);
		value_tr($lang['body']['visitors'], online_numbers(0,""));
		value_tr($lang['body']['users'], online_numbers(1,""));
		value_tr($lang['body']['mods'], online_numbers(2,""));
		value_tr($lang['body']['mons'], online_numbers(3,""));
		value_tr($lang['body']['admins'],online_numbers(4, ""));
		
		title_tr($lang['body']['topics_num']);
		value_tr($lang['body']['all_topics_in_24_h'], topics_numbers_for_24_h(1));
		value_tr($lang['body']['all_topics_in_30_d'], topics_numbers_for_24_h(30));
		value_tr($lang['body']['middle_topics_in_day'], topics_numbers_middle());
		value_tr($lang['body']['all_topics'], topics_numbers());
		
		title_tr($lang['body']['replies_num']);
		value_tr($lang['body']['all_replies_in_24_h'], replies_numbers_for_24_h(1));
		value_tr($lang['body']['all_replies_in_30_d'], replies_numbers_for_24_h(30));
		value_tr($lang['body']['middle_replies_in_day'], replies_numbers_middle());
		value_tr($lang['body']['all_replies'], replies_numbers());
		
		
		
				title_tr($lang['body']['pm_num']);
		value_tr($lang['body']['all_pm_in_24_h'], msg_numbers_for_24_h(1));
		value_tr($lang['body']['all_pm_in_30_d'], msg_numbers_for_24_h(30));
		value_tr($lang['body']['middle_pm_in_day'], msg_numbers_middle());
		value_tr($lang['body']['all_pm'], msg_numbers());



	if ($show_alexa_traffic == 1){
		title_tr($lang['admin_svc']['alexa_stat']);
		echo'
		<tr class="fixed">
			<td class="list_center" colspan="2"><nobr><script type="text/javascript" language="javascript" src="http://xslt.alexa.com/site_stats/js/t/a?amzn_id=555777-20&url='.$site_name.'"></script></nobr></td>
		</tr>';
	}
		echo'
		
	</table>
	</center><br><br>';
}

function admin_approve(){
	global $lang, $user_id, $ulv, $max_page, $img;
	echo'
	<script language="javascript">
		function chk_app_user(obj){
			if (obj.name == "approve"){
				var go_to = confirm("'.$lang['admin_svc']['confirm_approve'].'");
				if (go_to){
					obj.form.method.value = "approve";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "hold"){
				var go_to = confirm("'.$lang['admin_svc']['confirm_refused'].'");
				if (go_to){
					obj.form.method.value = "hold";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "delete"){
				var go_to = confirm("'.$lang['admin_svc']['confirm_delete_members'].'");
				if (go_to){
					obj.form.method.value = "delete";
					obj.form.submit();
				}
				else{
					return;
				}
			}
		}
	</script>
	<form name="app_user" method="post" action="index.php?mode=admin_svc&type=set_approve">
	<center>
	<table cellSpacing="1" cellPadding="5">
	
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="20"><font color="red" size="+1"><b>'.$lang['admin_svc']['pending_users'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h">&nbsp;</td>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['profile']['member_name'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin_svc']['user_email'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['profile']['ip_address'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['members_function']['country'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['members_function']['register_date'].'</nobr></td>
		</tr>';
	$limit = pg_limit($max_page);
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_STATUS = '2' ORDER BY M_DATE DESC LIMIT $limit, $max_page") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
	$i = 0;
	while ($i < $num) {
		$u = @mysqli_result($sql, $i, "MEMBER_ID");
		$name = members("NAME", $u);
		$email = members("EMAIL", $u);
		$ip = members("IP", $u);
		$country = members("COUNTRY", $u);
		$date = members("DATE", $u);
		$name = members("NAME", $u);
		if ($country == ""){
			$cont = '-';
		}
		else{
			$cont = $country;
		}
		echo'
		<tr>
			<td class="stats_p"><nobr>&nbsp;<input class="small" type="checkbox" name="app[]" value="'.$u.'"></nobr></td>
			<td class="stats_h">'.$u.'</td>
			<td class="stats_g" align="center"><font color="#ffffff"><b>'.$name.'</b></font></td>
			<td class="stats_p"><font color="#000000">'.$email.'</font></td>
			<td class="stats_h"><a href="http://www.ipchecking.com/?ip='.$ip.'" title="'.$lang['admin_svc']['about_this_ip'].'"><font color="#ffffff">'.$ip.'</font></a></td>
			<td class="stats_p" align="center"><font color="#000000">'.$cont.'</font></td>
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
				<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['add_ichraf']['num_members'].'\')">&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="approve" type="button" onclick="chk_app_user(this)" value="'.$lang['admin_svc']['approve_this'].'">&nbsp;
				<input name="hold" type="button" onclick="chk_app_user(this)" value="'.$lang['admin_svc']['refused_this'].'">&nbsp;
				<input name="delete" type="button" onclick="chk_app_user(this)" value="'.$lang['admin_svc']['delete_this'].'">
			</td>
		</tr>';
	}
	else{
		echo'
		<tr>
			<td class="stats_p" align="middle" colSpan="20"><font color="black"><br>'.$lang['admin_svc']['no_approve_members'].'<br><br></font></td>
		</tr>';
	}
	echo'
	</form>
	</table>
	<center>';
}

function admin_approve_set(){
	global $lang, $_POST, $referer, $forum_title, $admin_email;
	$method = $_POST['method'];
	$app = $_POST['app'];
	
	if ($app == ""){
		$error = $lang['admin_svc']['no_selected_users'];
	}
	if ($error != ""){
		error_message($error);
	}
	if ($error == ""){
		if ($method == "approve"){
			$i = 0;
			while($i  < count($app)){
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_STATUS = '1' WHERE MEMBER_ID = '$app[$i]' ") or die (DBi::$con->error);
		 $code = members("CODE", $app[$i]);
		 $email = members("EMAIL", $app[$i]);
$message     = '<p align="right">'.$lang['members']['members'].' : '.member_name($app[$i]).'<br><br>'.$lang['e-emails']['approve_member_message_1'].' '.$forum_title.'<br><br>'.$lang['e-emails']['approve_member_message_2'].' '.$forum_title.'</p>';
$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['approve_member_subject'].'';		 
 $headers  = "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-type: text/html; charset=utf8\r\n"; 
 $headers .= "From: ".$admin_email."";
		  mail($email, $title, $message, $headers);				
			$i++;
			}
			$msg_txt = $lang['admin_svc']['done_approve_users'];
		}
		if ($method == "hold"){
			$i = 0;
			while($i  < count($app)){
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_STATUS = '3' WHERE MEMBER_ID = '$app[$i]' ") or die (DBi::$con->error);
		 $code = members("CODE", $app[$i]);
		 $email = members("EMAIL", $app[$i]);
$message     = '<p align="right">'.$lang['members']['members'].' : '.member_name($app[$i]).'<br><br>'.$lang['e-emails']['approve_member_message_1'].' '.$forum_title.'<br><br>'.$lang['e-emails']['refused_member_message'].' '.$forum_title.'</p>';
$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['refused_member_subject'].'';		 
 $headers  = "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-type: text/html; charset=utf8\r\n"; 
 $headers .= "From: ".$admin_email."";
		  mail($email, $title, $message, $headers);						
			$i++;
			}
			$msg_txt = $lang['admin_svc']['done_refused_users'];
		}
		if ($method == "delete"){
			$i = 0;
			while($i  < count($app)){
				DBi::$con->query("DELETE FROM ".prefix."MEMBERS WHERE MEMBER_ID = '$app[$i]' ") or die (DBi::$con->error);
			$i++;
			}
			$msg_txt = $lang['admin_svc']['done_delete_users'];
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


  function admin_ads(){
	global $lang, $icon_trash, $icon_edit, $icon_lock, $icon_unlock, $folder_new, $icon_folder_archive;
echo'
	<center>
	<table cellSpacing="1" cellPadding="5">
	
		<tr>
			<td class="optionsbar_menus" colSpan="20"><font color="red" size="+1"><b>'.$lang['forum_function']['admin_ads'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin_ads']['ad_title'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin_svc']['ad_author'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['message']['date'].'</nobr></td>
			<td class="stats_h"><nobr><a href="index.php?mode=editor&method=addads">'.icons($folder_new, $lang['admin_svc']['add_new_ad']).'</a></nobr></td>
		</tr>';
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."ADS ORDER BY AD_DATE DESC") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
	$i = 0;
	while ($i < $num) {
		$id = @mysqli_result($sql, $i, "AD_ID");
		$subject = ads("SUBJECT", $id);
		$author = ads("AUTHOR", $id);
		$author_name = link_profile(member_name($author), $author);
		$date = ads("DATE", $id);
		$status = ads("STATUS", $id);
		if($status == 0) {
		$lock_unlock = '<a href="index.php?mode=open&type=ads&ad='.$id.'">'.icons($icon_unlock, $lang['forum_function']['open_ad']).'</a>';	
		} else {
		$lock_unlock = '<a href="index.php?mode=lock&type=ads&ad='.$id.'">'.icons($icon_lock, $lang['forum_function']['lock_ad']).'</a>';	
		}	
		echo'
		<tr>
			<td class="stats_h" align="center">'.$id.'</td>
			<td class="stats_g" align="center"><font color="#ffffff"><b><a href="index.php?mode=ad&ad='.$id.'">'.$subject.'</a></b></font></td>
			<td class="stats_p" align="center"><font color="#000000">'.$author_name.'</font></td>
			<td class="stats_g align="center"><font color="#000000"><b>'.normal_time($date).'</b></font></td>
			<td class="stats_p" align="center"><a href="index.php?mode=editor&method=editads&ad='.$id.'">'.icons($icon_edit, $lang['forum_function']['edit_ad']).'</a>&nbsp;'.$lock_unlock.'&nbsp;<a href="index.php?mode=ad&ad='.$id.'&type=option">'.icons($icon_folder_archive, $lang['forum_function']['edit_ad_options']).'</a>&nbsp;<a href="index.php?mode=delete&type=ads&ad='.$id.'">'.icons($icon_trash).'</a></td>
		</tr>';
	++$i;
	}

	if($num == 0) {
		echo'
		<tr>
			<td class="stats_p" align="middle" colSpan="20"><font color="black"><br>'.$lang['admin_svc']['no_admin_ads'].'<br><br></font></td>
		</tr>';
	}
	echo'
	
	</table>
	';
}

//////////////////////
function admin_approve_email(){
	global $lang, $user_id, $ulv, $max_page, $img;
	echo'
	<script language="javascript">
		function chk_app_user(obj){
			if (obj.name == "approve"){
				var go_to = confirm("'.$lang['admin_svc']['confirm_approve_email'].'");
				if (go_to){
					obj.form.method.value = "approve";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "hold"){
				var go_to = confirm("'.$lang['admin_svc']['confirm_refused'].'");
				if (go_to){
					obj.form.method.value = "hold";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "delete"){
				var go_to = confirm("'.$lang['admin_svc']['confirm_delete_members'].'");
				if (go_to){
					obj.form.method.value = "delete";
					obj.form.submit();
				}
				else{
					return;
				}
			}
		}
	</script>
	<form name="app_user" method="post" action="index.php?mode=admin_svc&type=set_approve_email">
	<center>
	<table cellSpacing="1" cellPadding="5">
	
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="20"><font color="red" size="+1"><b>'.$lang['admin_svc']['pending_users_email'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h">&nbsp;</td>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['profile']['member_name'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin_svc']['user_email'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['profile']['ip_address'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['members_function']['country'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['members_function']['register_date'].'</nobr></td>
		</tr>';
	$limit = pg_limit($max_page);
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_STATUS = '4' ORDER BY M_DATE DESC LIMIT $limit, $max_page") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
	$i = 0;
	while ($i < $num) {
		$u = @mysqli_result($sql, $i, "MEMBER_ID");
		$name = members("NAME", $u);
		$email = members("EMAIL", $u);
		$ip = members("IP", $u);
		$country = members("COUNTRY", $u);
		$date = members("DATE", $u);
		$name = members("NAME", $u);
		if ($country == ""){
			$cont = '-';
		}
		else{
			$cont = $country;
		}
		echo'
		<tr>
			<td class="stats_p"><nobr>&nbsp;<input class="small" type="checkbox" name="app[]" value="'.$u.'"></nobr></td>
			<td class="stats_h">'.$u.'</td>
			<td class="stats_g" align="center"><font color="#ffffff"><b>'.$name.'</b></font></td>
			<td class="stats_p"><font color="#000000">'.$email.'</font></td>
			<td class="stats_h"><a href="http://www.ipchecking.com/?ip='.$ip.'" title="'.$lang['admin_svc']['about_this_ip'].'"><font color="#ffffff">'.$ip.'</font></a></td>
			<td class="stats_p" align="center"><font color="#000000">'.$cont.'</font></td>
			<td class="stats_p"><font color="red">'.date_and_time($date, 1).'</font></td>
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
				<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['add_ichraf']['num_members'].'\')">&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="approve" type="button" onclick="chk_app_user(this)" value="'.$lang['admin_svc']['approve_this'].'">&nbsp;
				<input name="hold" type="button" onclick="chk_app_user(this)" value="'.$lang['admin_svc']['refused_this'].'">&nbsp;
				<input name="delete" type="button" onclick="chk_app_user(this)" value="'.$lang['admin_svc']['delete_this'].'">
			</td>
		</tr>';
	}
	else{
		echo'
		<tr>
			<td class="stats_p" align="middle" colSpan="20"><font color="black"><br>'.$lang['admin_svc']['no_approve_email_members'].'<br><br></font></td>
		</tr>';
	}
	echo'
	</form>
	</table>
	<center>';
}

function admin_approve_email_set(){
	global $lang, $_POST, $referer;
	$method = $_POST['method'];
	$app = $_POST['app'];
	
	if ($app == ""){
		$error = $lang['admin_svc']['no_selected_users'];
	}
	if ($error != ""){
		error_message($error);
	}
	if ($error == ""){
		if ($method == "approve"){
			$i = 0;
			while($i  < count($app)){
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_STATUS = '2' WHERE MEMBER_ID = '$app[$i]' ") or die (DBi::$con->error);
			$i++;
			}
			$msg_txt = $lang['admin_svc']['done_approve_email_users'];
		}
		if ($method == "hold"){
			$i = 0;
			while($i  < count($app)){
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_STATUS = '3' WHERE MEMBER_ID = '$app[$i]' ") or die (DBi::$con->error);
			$i++;
			}
			$msg_txt = $lang['admin_svc']['done_refused_users'];
		}
		if ($method == "delete"){
			$i = 0;
			while($i  < count($app)){
				DBi::$con->query("DELETE FROM ".prefix."MEMBERS WHERE MEMBER_ID = '$app[$i]' ") or die (DBi::$con->error);
			$i++;
			}
			$msg_txt = $lang['admin_svc']['done_delete_users'];
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
//////////////////////

function admin_hold(){
	global $lang, $user_id, $ulv, $max_page, $img;
	echo'
	<script language="javascript">
		function chk_app_user(obj){
			if (obj.name == "approve"){
				var go_to = confirm("'.$lang['admin_svc']['confirm_approve'].'");
				if (go_to){
					obj.form.method.value = "approve";
					obj.form.submit();
				}
				else{
					return;
				}
			}
			if (obj.name == "delete"){
				var go_to = confirm("'.$lang['admin_svc']['confirm_delete_members'].'");
				if (go_to){
					obj.form.method.value = "delete";
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
	<form name="app_user" method="post" action="index.php?mode=admin_svc&type=set_approve">
	<input type="hidden" name="method">
		<tr>
			<td class="optionsbar_menus" colSpan="20"><font color="red" size="+1"><b>'.$lang['admin_svc']['refused_users'].'</b></font></td>
		</tr>
		<tr>
			<td class="stats_h">&nbsp;</td>
			<td class="stats_h"><nobr>'.$lang['members']['numbers'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['profile']['member_name'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['admin_svc']['user_email'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['profile']['ip_address'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['members_function']['country'].'</nobr></td>
			<td class="stats_h"><nobr>'.$lang['members_function']['register_date'].'</nobr></td>
		</tr>';
	$limit = pg_limit($max_page);
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_STATUS = '3' ORDER BY M_DATE DESC LIMIT $limit, $max_page") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
	$i = 0;
	while ($i < $num) {
		$u = @mysqli_result($sql, $i, "MEMBER_ID");
		$name = members("NAME", $u);
		$email = members("EMAIL", $u);
		$ip = members("IP", $u);
		$country = members("COUNTRY", $u);
		$date = members("DATE", $u);
		$name = members("NAME", $u);
		if ($country == ""){
			$cont = '-';
		}
		else{
			$cont = $country;
		}
		echo'
		<tr>
			<td class="stats_p"><nobr>&nbsp;<input class="small" type="checkbox" name="app[]" value="'.$u.'"></nobr></td>
			<td class="stats_h">'.$u.'</td>
			<td class="stats_g" align="center"><font color="#ffffff"><b>'.$name.'</b></font></td>
			<td class="stats_p"><font color="#000000">'.$email.'</font></td>
			<td class="stats_h"><a href="http://www.ipchecking.com/?ip='.$ip.'" title="'.$lang['admin_svc']['about_this_ip'].'"><font color="#ffffff">'.$ip.'</font></a></td>
			<td class="stats_p" align="center"><font color="#000000">'.$cont.'</font></td>
			<td class="stats_p"><font color="red">'.date_and_time($date, 1).'</font></td>
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
				<input type="button" value="'.$lang['editor']['ed_tip_select_all'].'" onclick="this.value=check(this.form.elements, \''.$lang['add_ichraf']['num_members'].'\')">&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="approve" type="button" onclick="chk_app_user(this)" value="'.$lang['admin_svc']['approve_this'].'">&nbsp;
				<input name="delete" type="button" onclick="chk_app_user(this)" value="'.$lang['admin_svc']['delete_this'].'">
			</td>
		</tr>';
	}
	else{
		echo'
		<tr>
			<td class="stats_p" align="middle" colSpan="20"><font color="black"><br>'.$lang['admin_svc']['no_refused_members'].'<br><br></font></td>
		</tr>';
	}
	echo'
	</form>
	</table>
	<center>';
}

function admin_hold_set(){
	global $lang, $_POST, $referer;
	$method = $_POST['method'];
	$app = $_POST['app'];
	
	if ($app == ""){
		$error = $lang['admin_svc']['no_selected_users'];
	}
	if ($error != ""){
		error_message($error);
	}
	if ($error == ""){
		if ($method == "approve"){
			$i = 0;
			while($i  < count($app)){
				@DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_STATUS = '1' WHERE MEMBER_ID = '$app[$i]' ") or die (DBi::$con->error);
		 $code = members("CODE", $app[$i]);
		 $email = members("EMAIL", $app[$i]);
$message     = '<p align="right">'.$lang['members']['members'].' : '.member_name($app[$i]).'<br><br>'.$lang['e-emails']['approve_member_message_1'].' '.$forum_title.'<br><br>'.$lang['e-emails']['approve_member_message_2'].' '.$forum_title.'</p>';
$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['approve_member_subject'].'';		 
 $headers  = "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-type: text/html; charset=utf8\r\n"; 
 $headers .= "From: ".$admin_email."";
		  mail($email, $title, $message, $headers);					
			$i++;
			}
			$msg_txt = $lang['admin_svc']['done_approve_users'];
		}
		if ($method == "delete"){
			$i = 0;
			while($i  < count($app)){
				@DBi::$con->query("DELETE FROM ".prefix."MEMBERS WHERE MEMBER_ID = '$app[$i]' ") or die (DBi::$con->error);
			$i++;
			}
			$msg_txt = $lang['admin_svc']['done_delete_users'];
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

function admin_change_name(){
global $lang;	
		echo'
		<center>
		<table cellSpacing="1" cellPadding="3" width="60%" border="0">
			<tr>
				<td class="stats_h">'.$lang['members']['numbers'].'</td>
				<td class="stats_h">'.$lang['message']['date'].'</td>
				<td class="stats_h">'.$lang['message']['from'].'</td>
				<td class="stats_h">'.$lang['editor']['to'].'</td>
				<td class="stats_h">'.$lang['add_cat_forum']['options'].'</td>
			</tr>';
		$sql = @DBi::$con->query("SELECT * FROM ".prefix."CHANGENAME_PENDING WHERE CH_DONE = '0' AND UNDERDEMANDE = '1' ORDER BY CH_DATE ASC ") or die (DBi::$con->error);
		$num = @mysqli_num_rows($sql);
		if ($num == 0) {
			echo'
			<tr>
				<td class="stats_p" align="middle" colSpan="11"><font color="black" size="3"><br>'.$lang['svc_file']['no_this_requests'].'<br><br></font></td>
			</tr>';
		}
		$i=0;
		while ($i < $num) {
			$ch = @mysqli_result($sql, $i, "CHNAME_ID");
			$m = @mysqli_result($sql, $i, "MEMBERID");
			$new_name = @mysqli_result($sql, $i, "NEW_NAME");
			$last_name = @mysqli_result($sql, $i, "LAST_NAME");
			$date = @mysqli_result($sql, $i, "CH_DATE");
			echo '
			<tr class="normal">
				<td class="stats_h">'.$ch.'</td>
				<td class="stats_g">'.date_and_time($date, 1).'</td>
				<td class="stats_p">'.$last_name.'</td>
				<td class="stats_p">'.$new_name.'</td>
				<td class="stats_g" align="center">
					<a href="index.php?mode=admin_svc&type=set_change_name&app=accept&m='.$m.'&id='.$ch.'">'.$lang['admin_svc']['ok'].'</a>&nbsp;-
					<a href="index.php?mode=admin_svc&type=set_change_name&app=refuse&m='.$m.'&id='.$ch.'">'.$lang['admin_svc']['no_ok'].'</a>
				</td>
			</tr>';
		++$i;
		}
		echo'
		</table>
		</center>';
}



function admin_change_name_set(){
	global $id, $m, $app, $lang, $referer;
	$sql = DBi::$con->query("SELECT * FROM ".prefix."CHANGENAME_PENDING WHERE CHNAME_ID = '$id' AND MEMBERID = '$m'");
	$num = mysqli_num_rows($sql);
	if($num == 0) {
	redirect();	
	}	
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."CHANGENAME_PENDING WHERE CHNAME_ID = '$id' ") or die (DBi::$con->error);
	if(@mysqli_num_rows($sql) > 0){
		$rs = @mysqli_fetch_array($sql);
		$new_name = $rs['NEW_NAME'];
	}
	if ($app == "accept") {
		$sql = "UPDATE ".prefix."CHANGENAME_PENDING SET ";
		$sql .= "CH_DONE = '1', ";
		$sql .= "UNDERDEMANDE = '0', ";
		$sql .= "CH_DATE = '".time()."' ";
		$sql .= "WHERE CHNAME_ID = '$id' ";
		@DBi::$con->query($sql) or die (DBi::$con->error);
		
		$sql = "UPDATE ".prefix."MEMBERS SET ";
		$sql .= "M_NAME = '$new_name', ";
		$sql .= "M_CHANGENAME = M_CHANGENAME + 1 ";
		$sql .= "WHERE MEMBER_ID = '$m' ";
		@DBi::$con->query($sql) or die (DBi::$con->error);

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5"><br>'.$lang['admin_svc']['done_change_name'].'</font><br><br>
					<meta http-equiv="Refresh" content="1; URL=index.php?mode=admin_svc&type=change_name">
					<a href="index.php?mode=admin_svc&type=change_name">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
	}
	if ($app == "refuse") {
		@DBi::$con->query("DELETE FROM ".prefix."CHANGENAME_PENDING WHERE CHNAME_ID = '$id' ") or die (DBi::$con->error);
		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
			<td class="list_center" colSpan="10"><font size="5"><br>'.$lang['admin_svc']['done_refused_request'].'</font><br><br>
				<meta http-equiv="Refresh" content="1; URL=index.php?mode=admin_svc&type=change_name">
				<a href="index.php?mode=admin_svc&type=change_name">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
			</td>
			</tr>
		</table>
		</center>';
	}
}

function paging() {
	global $lang, $pg, $max_page, $type;
	if ($type == "approve"){
		$num = 2;
	}
	if ($type == "hold"){
		$num = 3;
	}

	$users = @DBi::$con->query("SELECT COUNT(*) FROM ".prefix."MEMBERS WHERE M_STATUS = '$num' ") or die (DBi::$con->error);
	$users = @mysqli_result($users, 0, "COUNT(*)");
	$all_pg = ceil($users / $max_page);
	if ($all_pg == 0){
		$all_pg = 1;
	}
	echo'
	<script language="javascript" type="text/javascript">
		function app_paging(){
			var pg = paging.id.value;
			window.location = "index.php?mode=admin_svc&type='.$type.'&pg="+pg;
		}
	</script>
	<form name="paging">
	<td class="optionsbar_menus">'.$lang['forum']['page'].'&nbsp;:
	<select name="id" size="1" onchange="app_paging()">';
	for($i = 1; $i <= $all_pg; $i++){
		echo'
		<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.'&nbsp;'.$lang['forum']['from'].'&nbsp;'.$all_pg.'</option>';
	}
	echo'
	</select>
	</td>
	</form>';
}

function admin_func(){
	global $choose_language, $lang, $id, $type, $forum_title, $icon_arrowup, $icon_arrowdown;
	
	echo'
	<script language="javascript" src="language/'.$choose_language.'.js"></script>	
	<script language="javascript">
		var check_flag = "false";
		function check(checked, alert_msg){
			if (check_flag == "false"){
				var count = 0;
				for (i = 0; i < checked.length; i++){
					checked[i].checked = true;
					if (checked[i].type == "checkbox"){
						count += 1;
					}
				}
				check_flag = "true";
				alert(alert_msg+": "+count);
				return (delete_select_all);
			}
			else {
				for (i = 0; i < checked.length; i++){
					checked[i].checked = false;
				}
				check_flag = "false";
				return (select_all);
			}
		}
	</script>';
	
	if ($type != "set_change_email" AND $type != "set_details" AND $type != "set_lock" AND $type != "set_open" AND $type != "set_approve" AND $type != "set_approve_email" AND $type != "set_hold" AND $type != "set_change_name"){
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
	if ($type == ""){
		admin_body();
	}


    if ($type == "forumsorder"){

	if (method == "") {
     echo '<center>
		<table>
			<tr>
				<td class="stats_menu"><a class="stats_menu" href="index.php?mode=admin_svc&type=forumsorder&method=do_order">'.$lang['admin_svc']['do_order'].'</a></td>
			</tr>
		</table>
        </center><br>';
        echo '<center>
        <table cellspacing="1" cellpadding="2">
        <tr>
					<td bgColor="green" Align="center" colSpan="10"><font color="white">'.$lang['admin_svc']['orders'].' '.$forum_title.'</font><br><font color="yellow">'.$lang['admin_svc']['past_month'].'</font></td>
				</tr>
                <tr>
					<td class="stats_h" colspan="2">'.$lang['admin_svc']['the_order'].'</td>
                    <td class="stats_h">'.$lang['active']['forum'].'</td>
                    <td class="stats_h" colspan="3">'.$lang['admin_svc']['points'].'</td>
                </tr>';
    $forum_order = @DBi::$con->query("SELECT * FROM ".prefix."FORUM_ORDER ORDER BY FO_ORDER") or die(DBi::$con->error);
$forum_order_num = @mysqli_num_rows($forum_order);
$x = 0;
 while ($x < $forum_order_num) {
$order = @mysqli_result($forum_order, $x, "FO_ORDER");
$old_order = @mysqli_result($forum_order, $x, "FO_OLD_ORDER");
$points = @mysqli_result($forum_order, $x, "FO_POINTS");
$old_points = @mysqli_result($forum_order, $x, "FO_OLD_POINTS");
$forum_id = @mysqli_result($forum_order, $x, "FORUM_ID");
$forum_name = forums("SUBJECT", $forum_id);
$num_order = $order - $old_order;
$num_points = $points - $old_points;
$dif_points =  $num_points/$old_points * 100;
 if ($num_order == 0) {
$order_word = "  ";
$color_orde = "";
}
if ($num_order > 0) {
$order_word = "".$num_order."".icons($icon_arrowdown)."";
$color_order = "red";
}
if ($num_order < 0) {
$num_order = abs($num_order);
$order_word = "".$num_order."".icons($icon_arrowup)."";
$color_order = "green";
}
if ($num_points == 0) {
$points_word = "   ";
$color_points = "";
}
if ($num_points > 0) {
$points_word = "".$num_points."".icons($icon_arrowup)."";
$color_points = "green";
}
if ($num_points < 0) {
$num_points = abs($num_points);
$points_word = "".$num_points."".icons($icon_arrowdown)."";
$color_points = "red";
}
if ($dif_points == 0) {
$dif_word = "   ";
$color_dif = "";
}
if ($dif_points > 0) {
$dif_word = "".ceil($dif_points)."%".icons($icon_arrowup)."";
$color_dif = "green";
}
if ($dif_points < 0) {
$dif_points = abs($dif_points);
$dif_word = "".ceil($dif_points)."%".icons($icon_arrowdown)."";
$color_dif = "red";
}
echo '<tr>
<font style="FONT-SIZE: 16px; COLOR: #006600; FONT-FAMILY: verdana" color="black" size="-1">
<td class="stats_h"><font color="yellow">'.$order.'</font></td>
<td class="stats_p"><font color="'.$color_order.'">'.$order_word.'</font></td>
<td class="stats_g">'.$forum_name.'</td>
<td class="stats_p"><font color="blue">'.$points.'</font></td>
<td class="stats_p"><font color="'.$color_points.'">'.$points_word.'</font></td>
<td class="stats_p"><font color="'.$color_dif.'">'.$dif_word.'</font></td>
</font>
</tr>';
$x++;
 }
 echo '</table>
        </center>';
    }
    if (method == "do_order") {
    forums_order();
    echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>
                           '.$lang['admin_svc']['done_order'].'</font><br><br><a href="index.php?mode=admin_svc&type=forumsorder">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
    }
	}

    if ($type == "m_stat"){
$f = trim(intval($_GET['f']));
$svc = trim($_GET['svc']);
if(empty($svc)) $svc = "t";

echo '<div align="left"><table>
			<tr>
	<td class="stats_menu'.chk_cmd(method, "member", "Sel").'"><a class="stats_menu" href="index.php?mode=admin_svc&type=m_stat&method=member&f='.$f.'&svc='.$svc.'">'.$lang['admin_svc']['member_stat'].'</a></td>
				<td class="stats_menu'.chk_cmd(method, "modo", "Sel").'"><a class="stats_menu" href="index.php?mode=admin_svc&type=m_stat&method=modo&f='.$f.'&svc='.$svc.'">'.$lang['admin_svc']['mod_stat'].'</a></td>

				<td class="stats_menu'.chk_cmd($svc, "t", "Sel").'"><a class="stats_menu" href="index.php?mode=admin_svc&type=m_stat&method='.method.'&f='.$f.'&svc=t">'.$lang['admin_svc']['by_topics'].'</a></td>
				<td class="stats_menu'.chk_cmd($svc, "p", "Sel").'"><a class="stats_menu" href="index.php?mode=admin_svc&type=m_stat&method='.method.'&f='.$f.'&svc=p">'.$lang['admin_svc']['by_posts'].'</a></td>
			</tr>
		</table></div>';

if(method == "member"){
if($svc == "t"){
$sql =  @DBi::$con->query("SELECT COUNT(post.TOPIC_ID) AS count, member.M_NAME,member.MEMBER_ID FROM ".prefix."MEMBERS AS member LEFT JOIN ".prefix."TOPICS  AS post ON (post.T_AUTHOR = member.MEMBER_ID)  WHERE post.FORUM_ID = '$f' AND member.M_LEVEL = 1 GROUP BY post.T_AUTHOR ORDER BY count DESC LIMIT 10")or die (DBi::$con->error);
}
if($svc == "p"){
$sql =  @DBi::$con->query("SELECT COUNT(post.REPLY_ID) AS count, member.M_NAME,member.MEMBER_ID FROM ".prefix."MEMBERS AS member LEFT JOIN ".prefix."REPLY  AS post ON (post.R_AUTHOR = member.MEMBER_ID)  WHERE post.FORUM_ID = '$f' AND member.M_LEVEL = 1 GROUP BY post.R_AUTHOR ORDER BY count DESC LIMIT 10")or die (DBi::$con->error);
}

echo '<table align="center" class="grid" cellSpacing="1" cellPadding="0" width="30%" border="0">
				<tr><td class="cat" width="10%">&nbsp;</td><td class="cat" width="40%">'.$lang['admin_svc']['name'].'</td><td class="cat" width="20%">'.$lang['profile']['number_posts'].'</td></tr>';

if(@mysqli_num_rows($sql) == 0){
echo '<tr><td class="f1" colspan="3" align="center">'.$lang['admin_svc']['no_result'].'</td></tr>';
}

$i=1;					
while($r = @mysqli_fetch_array($sql)){
echo '<tr><td class="f2ts">'.$i.'</td><td class="f1"><a href="index.php?mode=member&id='.$r[MEMBER_ID].'">'.$r[M_NAME].'</a></td><td class="f1">'.$r[count].'</td></tr>';
$i++;
}
echo'</tr></table>';
}
if(method == "modo"){
if($svc == "t"){
$sql =  @DBi::$con->query("SELECT COUNT(post.TOPIC_ID) AS count, member.M_NAME,member.MEMBER_ID FROM ".prefix."MEMBERS AS member LEFT JOIN ".prefix."TOPICS  AS post ON (post.T_AUTHOR = member.MEMBER_ID) LEFT JOIN ".prefix."MODERATOR  AS modo ON (post.T_AUTHOR = modo.MEMBER_ID)  WHERE post.FORUM_ID = '$f' AND modo.FORUM_ID = '$f' AND member.M_LEVEL = 2  GROUP BY post.T_AUTHOR ORDER BY count DESC LIMIT 10")or die (DBi::$con->error);
}
if($svc == "p"){
$sql =  @DBi::$con->query("SELECT COUNT(post.REPLY_ID) AS count, member.M_NAME,member.MEMBER_ID FROM ".prefix."MEMBERS AS member LEFT JOIN ".prefix."REPLY  AS post ON (post.R_AUTHOR = member.MEMBER_ID) LEFT JOIN ".prefix."MODERATOR  AS modo ON (post.R_AUTHOR = modo.MEMBER_ID)  WHERE post.FORUM_ID = '$f' AND modo.FORUM_ID = '$f' AND member.M_LEVEL = 2  GROUP BY post.R_AUTHOR ORDER BY count DESC LIMIT 10")or die (DBi::$con->error);
}
echo '<table align="center" class="grid" cellSpacing="1" cellPadding="0" width="30%" border="0">
				<tr><td class="cat" width="10%">&nbsp;</td><td class="cat" width="40%">'.$lang['admin_svc']['name'].'</td><td class="cat" width="20%">'.$lang['profile']['number_posts'].'</td></tr>';

if(@mysqli_num_rows($sql) == 0){
echo '<tr><td class="f1" colspan="3" align="center">'.$lang['admin_svc']['no_result'].'</td></tr>';
}

$i=1;					
while($r = @mysqli_fetch_array($sql)){
echo '<tr><td class="f2ts">'.$i.'</td><td class="f1"><a href="index.php?mode=member&id='.$r[MEMBER_ID].'">'.$r[M_NAME].'</a></td><td class="f1">'.$r[count].'</td></tr>';
$i++;
}
echo'</tr></table>';
}

}



	if ($type == "ads"){
		admin_ads();
	}
	if ($type == "approve"){
		admin_approve();
	}	
	if ($type == "set_approve"){
		admin_approve_set();
	}
	if ($type == "approve_email"){
		admin_approve_email();
	}
	if ($type == "set_approve_email"){
		admin_approve_email_set();
	}	
	if ($type == "hold"){
		admin_hold();
	}
	if ($type == "set_hold"){
		admin_hold_set();
	}
	if ($type == "change_name"){
		admin_change_name();
	}
	if ($type == "set_change_name"){
		admin_change_name_set();
	}
	
}


if ($Mlevel == 4){
	admin_func();
}
else{
	go_to("index.php");
}
?>