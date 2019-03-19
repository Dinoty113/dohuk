<?php
if (@eregi("list.php","$_SERVER[PHP_SELF]")) {
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

if(mlv == 0){
redirect();
exit();
}
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
if($method != "index" AND $method != "" && $method != "list" && $method != "m"){
	header("Location: ".index()."");
	exit();
}
if (members("LIST", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][your_lists].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}

if($m == "") {
$theid = $DBMemberID;
$them = "";	
	$title_list = $lang['others']['your_lists'];
}
 if($m != "" && $Mlevel > 2 && $deputy == 0 && $m != 1) {
	$theid = $m;
	$them = "&m=".$m."";
	$title_list = "".$lang['others']['a_member_list']." ".member_name($m)."";	
 }
 if($Mlevel < 3) {
	$theid = $DBMemberID; 
	$them = "";
	$title_list = $lang['others']['your_lists'];
 }
 
 if($m == 1) {
	$theid = $DBMemberID; 
	$them = "";
	$title_list = $lang['others']['your_lists'];
	}
 
if(empty($type)) $type = "friends";


// ######################################### Some Setup ##########################################
function p_name($id){
$sql = @mysqli_fetch_array(DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE ID = '$id' "));
$name = $sql['NAME'];
return $name;
}
if($type != "friends" AND $type != "bans" AND $type != "show" AND $type != "max" AND $type != "" AND  $type != "insert_box" AND $type != "error" AND $type != "del" AND $type != "add" AND $type != "my_box")
{
	redirect ();
	exit();
}
if($type == "friends") $page_n = $lang['others']['friends_list'];
if($type == "bans") $page_n = $lang['others']['blocked_list'];
if($type == "show" AND $id) $page_n = p_name($id);

if($type == "friends") $page_id = "-1";
if($type == "bans") $page_id = "-2";
if($type == "show" AND $id) $page_id = $id;

// ########################################## Box Nav ################################################

function check_box($v1,$v2){
if($v1 == $v2){
$snow = "extras2";
}else{
$snow = "extras";
}
return $snow;
}

$c_id = $type;
$fr = "friends";
$bn = "bans";

if($type == "add" AND $c AND $aid){
$c_id = $c;
if($c_id == "-1") $fr = "-1";
if($c_id == "-2") $bn = "-2";
}


$s_nav = DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '".$theid."' AND NAME != '' ORDER BY ID ASC");
/*
while($nav = mysqli_fetch_array($s_nav)){
$list_nav_bit .= $tmp->G_TMP("list_nav_bit");
}
*/
echo'

<script type="text/javascript">
function deleteItem(id){
var cat = "'.$page_id.'";
if(confirm("'.$lang['others']['confirm_delete_from_list'].'")){
window.location = "index.php?mode=list&type=del&id="+id+"&c="+cat+"'.$them.'";
}else{
return;
}
}
</script>
<table cellSpacing="2" width="100%" border="0">
		<tr>
<td><a class="menu" href="index.php?'.$_SERVER[QUERY_STRING].''.$them.'">'.(icons($members,$title_list)).'</a></td>
<td class="main" vAlign="center" width="100%"><a class="menu" href="index.php?'.$_SERVER[QUERY_STRING].''.$them.'"><font color="red" 
size="+1">'.$title_list.'</font><br><font color="red">'.$page_n.'</font></a></td>

<td class="optionsbar_menus" vAlign="top"><nobr><a href="index.php?mode=list&type=my_box'.$them.'">'.$lang['others']['your_special_lists'].'</a></nobr></td>';
			go_to_forum();
			echo'
		</tr>
	</table>
<table cellSpacing="2" border="0">
		<tr>
<td class="'.check_box($c_id,$fr).'"><nobr><a href="index.php?mode=list&method=index&type=friends'.$them.'">'.$lang['others']['friends_list'].'</a></nobr></td>
<td class="'.check_box($c_id,$bn).'"><nobr><a href="index.php?mode=list&method=index&type=bans'.$them.'">'.$lang['others']['blocked_list'].'</a></nobr></td>
<td> </td>
';
while($nav = mysqli_fetch_array($s_nav)){
echo'
<td class="'.check_box($id,$nav[ID]).'"><nobr>
<a href="index.php?mode=list&method=index&type=show&id='.$nav[ID].''.$them.'">
'.$nav[NAME].'</a></nobr></td>';
}
echo'
<td class="'.check_box($c_id,"my_box").'"><nobr><a href="index.php?mode=list&type=my_box'.$them.'">'.$lang['others']['add_new_list'].'</a></nobr></td></tr></table>';





// ############################################### Friends List #################################################"


if($type == "friends"){
$sql = @DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '".$theid."' AND CAT_ID = '-1' ");
$T_Page = '<font
 color="red" size="+1">'.$lang['others']['friends_list'].'</font>';
$Desc = "<br>".$lang['others']['freinds_description']."";
}
if($type == "bans"){
$sql = @DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '".$theid."' AND CAT_ID = '-2' ");
$T_Page = '<font
 color="red" size="+1">'.$lang['others']['blocked_list'].'</font>';
$Desc = "<br>".$lang['others']['blocked_description']."";
}
if($type == "show" AND $id){
$sql = @DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '".$theid."' AND CAT_ID = '$id' ");
$T_Page = '<font
 color="green" size="+1">'.p_name($id).'</font>';
$Desc = "<br>".$lang['others']['freinds_description']."";
}

if($method == "index"){
if($type == "show" AND !p_name($id)) redirect();
$m_list = $sql; 
$num = @mysqli_num_rows($sql);
function m_online($r_id){
global $Mlevel,$icon_online;
$online = member_is_online($r_id);
$browse = members("BROWSE",$r_id);

if ($online == 1 AND $browse == 1 OR $online == 1  AND $Mlevel > 1){
$is_online = icons($icon_online);
}else{
$is_online = "&nbsp;";
}
return $is_online;
}


echo'
<br><table align="center" border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr>
      <td>
      <form name="optionsForm" action="">
        <table align="center" bgcolor="gray" class="grid" border="0" cellpadding="0"cellspacing="0"  width="300">

            <tr>
              <td>
              <table border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="normal">
                    <td colSpan="4" class="list_small"><font
 color="red" size="+1">'.$T_Page.'</font>'.$Desc.'</td>
                  </tr>';
if ($num == 0){
echo'
<tr class="fixed"><td colSpan="4" class="list_center"><br>'.$lang['others']['no_members_in_list'].'<br><br></td> </tr>';
}
else if ($num != 0){
while($row = mysqli_fetch_array($m_list)){

echo'
<tr class="normal"></td><td class="list_small2" valign="middle"><nobr> 
<a href="index.php?mode=editor&method=sendmsg&m='.$row[USER].'">
'.icons($icon_private_message,$lang['topics']['send_message_to_this_member']).'</a>  
<a href="index.php?mode=pm&mail=m&m='.$row[USER].'">
'.icons($icon_profile,$lang['message']['your_pm_with_this_member']).'</a>
</nobr></td>
<td class="f2ts"><nobr>'.m_online($row[USER]).'</nobr></td>
<td class="f2ts"><nobr> 
'.link_profile(member_name($row[USER]), $row[USER]).'</nobr></td>
<td class="list_small2"><nobr> 
<a href="javascript:deleteItem('.$row[USER].')">
'.icons($icon_trash,$lang['others']['delete_from_this_list']).'</a> </nobr></td></tr>';
}}

echo'
</table></td></tr></table></form>
      </td>
    </tr></table>';
}


// ############################################### My Box Page #################################################

if($type == "my_box"){
$n_box = 10;

if(mlv == 1){
$max = $max_list_cat_members;
$n_box = $max;
}elseif(mlv == 2){
$max = $max_list_cat_moderators;
$n_box = $max;
}

echo '
<form action="index.php?mode=list&type=insert_box'.$them.'" method="post">
  <table align="center" bgcolor="gray" class="grid" border="0" cellpadding="0" cellspacing="0" dir="rtl" width="300">
  
      <tr>
        <td>
        <table border="0" cellpadding="2"
 cellspacing="1" dir="rtl" width="100%">
            <tr class="normal">
              <td class="list_small" colspan="2"><font
color="red" size="+1">'.$title_list.'</font><br>'.$lang['others']['how_to_add_new_lists'].'</td>
            </tr>
            <tr>
              <td class="optionheader">'.$lang['others']['list_number'].'</td>
              <td class="optionheader"><nobr>&nbsp;'.$lang['others']['list_title'].'</nobr></td>
            </tr>';


$i=1;
while($i <= $n_box){
$sql = @DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '".$theid."' AND EDITFOLDER = '$i' ");
$r = @mysqli_fetch_array($sql);
           echo ' <tr class="fixed">
              <td class="optionheader">'.$i.'</td>
              <td class="list_small"><input
 value="'.$r['NAME'].'" name="editfolder'.$i.'"></td>
            </tr>';
$i++;
}
echo '
            <tr class="fixed">
              <td class="list_small" colspan="2"><br>
              <input value="'.$lang['others']['change_your_lists'].'" type="submit"></td>
            </tr>
          <tr class="normal">
            <td class="list_small" colspan="2"><font color="red" size="+1">'.$lang['svc_function']['notes_votes'].'</font><br>
'.$lang['others']['how_to_delete_list'].'</td>
          </tr>
        </table>
        </td>
      </tr>
  </table>
</form>';

}


// ############################################### My Box Page #################################################

if($type == "insert_box"){
$n_box = 10;

if(mlv == 1){
$max = $max_list_cat_members;
$n_box = $max;
}elseif(mlv == 2){
$max = $max_list_cat_moderators;
$n_box = $max;
}

$query_c = @mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '".$theid."'"));

if($query_c > $max AND (mlv == 1 OR mlv == 2)){
go_to("index.php?mode=list&type=max&method=list$them");

exit();
}

for($i=1;$i<=$n_box;$i++){
$first = "editfolder".$i."";
$string = DBi::$con->real_escape_string(htmlspecialchars($_POST[$first]));


if($string){

$sql_check = @DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '".$theid."' AND EDITFOLDER = '$i' ");
// Sql
if(@mysqli_num_rows($sql_check) == 0){
@DBi::$con->query("INSERT INTO ".prefix."LIST SET M_ID = '".$theid."',EDITFOLDER = '$i',NAME = '$string' ");
}else{
@DBi::$con->query("UPDATE ".prefix."LIST SET NAME = '$string' WHERE EDITFOLDER = '$i' AND M_ID = '".$theid."' ");
}

}else{
$sql_check = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '".$theid."' AND EDITFOLDER = '$i' "));
if($sql_check != 0){
@DBi::$con->query("UPDATE ".prefix."LIST SET NAME = '$string' WHERE EDITFOLDER = '$i' AND M_ID = '".$theid."' ");
}
}


}

go_to("index.php?mode=list&type=my_box$them");
}

// ############################################### Delete Member #################################################


if($type == "del"){

$sql_check = @DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '".$theid."' AND USER = '$id' AND CAT_ID = '$c' ");
$r = @mysqli_fetch_array($sql_check);
$CAT_ID = $r['CAT_ID'];
$sql1_check = @DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE ID = '".$CAT_ID."'");
$r1 = @mysqli_fetch_array($sql1_check);
$CA_ID = $r1['ID'];
$n = @mysqli_num_rows($sql_check);
if($n == 0){
redirect();
}else{	
$ID = $r['ID'];
if($c == "-1") {
$thecat = "&type=friends";	
}
if($c == "-2") {
$thecat = "&type=bans";	
}
if($c != "-1" && $c != "-2") {
$thecat = "&type=show&id=".$CA_ID."";	
}
@DBi::$con->query("DELETE FROM ".prefix."LIST_M WHERE ID = '$ID' ") or die(DBi::$con->error);
go_to("index.php?mode=list&method=index$them$thecat");
}

}

// ############################################### Add Member #################################################

if($type == "add"){
if(!$aid OR !member_name($aid)) redirect();

echo '<form name="optionsForm" action="'.$_SERVER[REQUEST_URI].'" method="post">
  <table align="center" class="grid" border="0" cellpadding="0" cellspacing="0" dir="rtl" width="300">
      <tr>
        <td>
        <table bgcolor="gray" border="0" cellpadding="2" cellspacing="1" dir="rtl" width="100%">
            <tr class="normal">
              <td class="list_small" colspan="2"><font
 color="red" size="+1">'.$lang['others']['add_member_to_your_list'].'</font><br>
              </td>
            </tr>
            <tr class="fixed">
              <td class="cat"><nobr>'.$lang['others']['name_member'].'</nobr></td>
              <td class="list_small"><font size="+1">'.member_name($aid).'</font></td>
            </tr>
            <tr class="fixed">
              <td class="cat"><nobr>'.$lang['others']['name_list'].'</nobr></td>
              <td class="list_small">
              <select style="width: 200px;" size="1"
 name="list">
              <option value="-1" '.check_select($c,"-1").'>'.$lang['others']['friends_list'].'</option>
              <option value="-2" '.check_select($c,"-2").'>'.$lang['others']['blocked_list'].'</option>';
$nav = @DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '".$theid."' AND NAME != '' ORDER BY ID ASC");
while($row = mysqli_fetch_array($nav)){
$cat_id = $row['ID'];
$cat_n = $row['NAME'];
echo '<option value="'.$cat_id.'" '.check_select($c,"$cat_id").'>'.$cat_n.'</option>';
}
              
             echo ' </select>
              </td>
            </tr>
            <tr class="fixed">
              <td class="list_small" colspan="2"><br>
<input type="hidden" name="user" value="'.$aid.'">
<input value="'.$lang['others']['add_member_to_this_list'].'" type="submit" name="sub"></td>
            </tr>
        </table>
        </td>
      </tr>
  </table>
</form>';
$the_sub = DBi::$con->real_escape_string(htmlspecialchars($_POST['sub']));
if($the_sub){
$user = DBi::$con->real_escape_string(htmlspecialchars(intval(trim($_POST['user']))));
$cat = DBi::$con->real_escape_string(htmlspecialchars($_POST['list']));

$s = @mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '".$theid."' AND USER = '$user' AND CAT_ID = '$cat' "));
if($s != 0){
go_to("index.php?mode=list&type=error$them");

exit();
}

if(mlv == 1){
$max = $max_list_m_members;
}elseif(mlv == 2){
$max = $max_list_m_moderators;
}


$query_c = @mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '".$theid."' AND CAT_ID = '$cat' "));

if($query_c > $max AND (mlv == 1 OR mlv == 2)){
go_to("index.php?mode=list&type=max&method=m$them");

exit();
}
if($cat == "-1") {
$the_cat = "friends";	
}
else if($cat == "-2") {
$the_cat = "bans";	
}
else {
$the_cat = "show&id=".$cat."";	
}

if($user == $DBMemberID && ($m == "" or $m != "" && $Mlevel < 3)) {
go_to("index.php?mode=list&method=index&type=$the_cat$them");
}

@DBi::$con->query("INSERT INTO ".prefix."LIST_M SET M_ID = '".$theid."', USER = '$user', CAT_ID = '$cat' ");
go_to("index.php?mode=list&method=index&type=$the_cat$them");
}

}



// ############################################### Error Add Member #################################################

if($type == "error"){

echo ' <br><table align="center" border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr>
      <td>
      <form name="optionsForm" action="index.php?mode=list'.$them.'">
        <table align="center" bgcolor="gray" class="grid" border="0" cellpadding="0"cellspacing="0"  width="300">

            <tr>
              <td>
              <table border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="normal">
                    <td class="list_small" colspan="5"><font
 color="green" size="+1">'.$lang['all']['error'].'</font><br>
'.$lang['others']['cant_add_member'].'
</td>
                  </tr>';

             echo ' </table></td></tr></table></form>
      </td>
    </tr></table>';

}


if($type == "max"){
if(method == "list"){
$msg= $lang['others']['max_lists'];
}
if(method == "m"){
$msg= $lang['others']['max_members_in_list'];
}
echo ' <br><table align="center" border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr>
      <td>
        <table align="center" bgcolor="gray" class="grid" border="0" cellpadding="0"cellspacing="0"  width="300">

            <tr>
              <td>
              <table border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="normal">
                    <td class="list_small" colspan="5"><font
 color="green" size="+1">'.$lang['all']['error'].'</font><br>
'.$msg.'
</td>
                  </tr>';

             echo ' </table></td></tr></table></form>
      </td>
    </tr></table>';

}

?>
