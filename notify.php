<?
if (@eregi("notify.php","$_SERVER[PHP_SELF]")) {
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

if($method != "" && $method != "send") {
redirect();	
}

if (members("NOTIFY", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][notify].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}


$f = topics("FORUM_ID", $t);
$f_hide = forums("HIDE", $f);
$f_level = forums("F_LEVEL", $f);
$c = forums("CAT_ID", $f);
$c_hide = cat("HIDE", $c);
$c_level = cat("LEVEL", $c);
$f_login = check_forum_login($f);
$c_login = check_cat_login($c);
$t_hidden = topics("HIDDEN", $t);
$t_status = topics("STATUS", $t);
$t_unmoderated = topics("UNMODERATED", $t);
$t_holded = topics("HOLDED", $t);
$sql = DBi::$con->query("SELECT * FROM ".prefix."TOPIC_MEMBERS WHERE TOPIC_ID = '$t' AND MEMBER_ID = '$DBMemberID'");
$num = mysqli_num_rows($sql);
if($c_level == 0 or ($c_level > 0 && $c_level <= $Mlevel)) {
} else {
show_error(45);
}	
if($c_hide == 0 or ($c_hide == 1 && $c_login == 1)) {
} else {
show_error(45);
}	
if($f_level == 0 or ($f_level > 0 && $f_level <= $Mlevel)) {
} else {
show_error(45);
}	
if($f_hide == 0 or ($f_hide == 1 && $f_login == 1)) {
} else {
show_error(45);
}

if($t_status == 2) {
show_error(45);
}
if($t_hidden == 1) {
show_error(45);
}
if($t_unmoderated == 1) {
show_error(45);
}
if($t_holded == 1) {
show_error(45);
}


$queryM = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '$m' ";
$resultM = @DBi::$con->query($queryM, $connection) or die (DBi::$con->error);

if(@mysqli_num_rows($resultM) > 0){
$rsM = @mysqli_fetch_array($resultM);

$PostAuthor_ID = $rsM['MEMBER_ID'];
$PostAuthor_Name = $rsM['M_NAME'];
}
$queryT = "SELECT * FROM " . $Prefix . "TOPICS WHERE TOPIC_ID = '$t' AND T_AUTHOR = '$m' ";
$resultT = @DBi::$con->query($queryT, $connection) or die (DBi::$con->error);

if(@mysqli_num_rows($resultT) > 0){
$rsT = @mysqli_fetch_array($resultT);

$Topic_ID = $rsT['TOPIC_ID'];
$Topic_Subject = $rsT['T_SUBJECT'];
}

if ($method == "" && $Mlevel > 0) {
	
$sql_m = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE MEMBER_ID = '$m'"));
$sql_t = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."TOPICS WHERE TOPIC_ID = '$t' AND T_AUTHOR = '$m'"));

if($sql_m == 0 or $sql_t == 0) {
redirect();	
}	
	
if($m == "") {
redirect();	
}

if($t == "") {
redirect();	
}	

echo'
<center>
<table cellSpacing="0" cellPadding="0" width="100%" border="0">
	<tr>
		<td align="center">'.$lang['notify']['notify_member'].'
		<br><font color="red" size="+2">'.$PostAuthor_Name.'</font>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">'.$lang['notify']['in_topic'].'
		<br><font color="red" size="+2">'.$Topic_Subject.'</font>
	</tr>
</table><br>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="40%">
	<form method="post" action="index.php?mode=notify&method=send">
    <input type="hidden" name="forum_id" value="'.$f.'">
    <input type="hidden" name="topic_id" value="'.$t.'">
    <input type="hidden" name="reply_id" value="'.$r.'">
    <input type="hidden" name="postauthor_id" value="'.$PostAuthor_ID.'">
    <input type="hidden" name="postauthor_name" value="'.$PostAuthor_Name.'">
	<tr>
		<td class="optionheader" colspan="2" align="middle">'.$lang['notify']['insert_notify'].'<br><br>
			<select class="insidetitle" name="type">
				<option value="" '.check_select($selected, "").'>'.$lang['other']['easy_to_mod_notify'].'</option>
				<option value="'.$lang['notify']['pic_no'].'" '.check_select($selected, $lang['notify']['pic_no']).'>'.$lang['notify']['pic_no'].'</option>
				<option value="'.$lang['notify']['talk_no'].'" '.check_select($selected, $lang['notify']['talk_no']).'>'.$lang['notify']['talk_no'].'</option>
				<option value="'.$lang['notify']['talk_it_no'].'" '.check_select($selected, $lang['notify']['talk_it_no']).'>'.$lang['notify']['talk_it_no'].'</option>
				<option value="'.$lang['notify']['other_notes'].'" '.check_select($selected, $lang['notify']['other_notes']).'>'.$lang['notify']['other_here'].'</option>
			</select>
			<br><br><textarea cols="47" rows="10" name="subject"></textarea>
		</td>
	</tr>
	<tr class="fixed">
		<td colSpan="2" align="middle"><input type="submit" value="'.$lang['notify']['send_notify'].'"></td>
	</tr>
</table><br>
<table cellSpacing="0" cellPadding="0" width="100%" border="0">
	<tr>
		<td align="center">
		<font color="red" size="+2">'.$lang['notify']['notify_description'].'</font>
		</td>
	</tr>
</table>
</center>';

}

if ($method == "send" && $Mlevel > 0) {

$f = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));
$t = DBi::$con->real_escape_string(htmlspecialchars($_POST['topic_id']));
$r = DBi::$con->real_escape_string(htmlspecialchars($_POST['reply_id']));
$PostAuthor_ID = DBi::$con->real_escape_string(htmlspecialchars($_POST['postauthor_id']));
$PostAuthor_Name = DBi::$con->real_escape_string(htmlspecialchars($_POST['postauthor_name']));
$Type = DBi::$con->real_escape_string(htmlspecialchars($_POST['type']));
$Subject = DBi::$con->real_escape_string(htmlspecialchars($_POST['subject']));
$notify_date = time();

if ($Type == "") {
    $error = $lang['notify']['no_type'];
}
if ($Subject == "") {
    $error = $lang['notify']['no_note'];
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

 $query = "INSERT INTO " . $Prefix . "NOTIFY (NOTIFY_ID, FORUM_ID, TOPIC_ID, REPLY_ID, AUTHOR_ID, AUTHOR_NAME, POSTAUTHOR_ID, POSTAUTHOR_NAME, TYPE, SUBJECT, DATE) VALUES (NULL, ";
     $query .= " '$f', ";
     $query .= " '$t', ";
     $query .= " '$r', ";
     $query .= " '$DBMemberID', ";
     $query .= " '$DBUserName', ";
     $query .= " '$PostAuthor_ID', ";
     $query .= " '$PostAuthor_Name', ";
     $query .= " '$Type', ";
     $query .= " '$Subject', ";
     $query .= " '$notify_date') ";

     @DBi::$con->query($query) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['notify']['done_notify'].'</font><br><br>
	                       <meta http-equiv="Refresh" content="2; URL=index.php?mode=t&t='.$t.'">
	                       <a href="index.php?mode=t&t='.$t.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

}

@mysqli_close();

?>