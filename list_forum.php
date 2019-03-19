<?php
if (@eregi("list_forum.php","$_SERVER[PHP_SELF]")) {
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
if (@allowed($f, 2) == 0 OR $f == "" OR $f < 0){
redirect();
exit();
}

if($type != "first" && $type != "show" && $type != "add" && $type != "my_box" && $type != "insert_box" && $type != "del" && $type != "error" && $type != "erreur" && $type != "max" && $type != "sorry") {
redirect();	
}
if($method != "" && $method != "index" && $method != "mid" && $method != "title" && $method != "hide" && $method != "topic" && $method != "list" && $method != "m") {
redirect();	
}


if(empty($type)) $type = "first";


// ######################################### Some Setup ##########################################
function p_name($id){
$sql = mysqli_fetch_array(DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE ID = '$id' "));
$name = $sql['NAME'];
return $name;
}

if($type == "first") $page_n = $lang['others']['normal_list'];
if($type == "show" AND $id) $page_n = p_name($id);

if($type == "first") $page_id = "-1";
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
$fr = "first";
$bn = "bans";

if($type == "add" AND $c AND $aid){
$c_id = $c;
if($c_id == "-1") $fr = "-1";
}

$s_nav = DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '-$f' AND NAME != '' ORDER BY ID ASC");
/*
while($nav = mysqli_fetch_array($s_nav)){
$list_nav_bit .= $tmp->G_TMP("list_nav_bit");
}
*/
echo'
<script type="text/javascript">
function deleteItem(id){
var cat = "'.$page_id.'";
var f = "'.$f.'";
if(confirm("'.$lang['others']['confirm_delete_from_list'].'")){
window.location = "index.php?mode=list_forum&f="+f+"&type=del&id="+id+"&c="+cat;
}else{
return;
}
}
</script>
<table cellSpacing="2" width="100%" border="0">
		<tr>
<td><a class="menu" href="index.php?'.$_SERVER[QUERY_STRING].'">'.(icons(forums("LOGO",$f),"".$lang['others']['lists'] ." ".forums("SUBJECT",$f))).'</a></td>
<td class="main" vAlign="center" width="100%"><a class="menu" href="index.php?'.$_SERVER[QUERY_STRING].'"><font color="red" 
size="+1">'.$lang['others']['lists'] .' '.forums("SUBJECT",$f).'</font><br><font color="red">'.$page_n.'</font></a></td>

<td class="optionsbar_menus" vAlign="top"><nobr><a href="index.php?mode=list_forum&f='.$f.'&type=my_box">'.$lang['others']['your_special_lists'].'</a></nobr></td>';
			go_to_forum();
			$TOTAL = DBi::$con->query("SELECT count(*) FROM ".$Prefix."LIST_M where M_ID = '-$f' AND CAT_ID = '-1'") or die(database_error(__line__,1));
$counts = mysqli_result($TOTAL , 0, "count(*)");

			echo'
		</tr>
	</table>
<table cellSpacing="2" border="0">
		<tr>
<td class="'.check_box($c_id,$fr).'"><nobr><a href="index.php?mode=list_forum&f='.$f.'&method=index&type=first">'.$lang['others']['normal_list'].' (<font color="red">'.$counts.'</font>)</a></nobr></td>
<td> </td>
';
while($nav = mysqli_fetch_array($s_nav)){
$TOTAL = DBi::$con->query("SELECT count(*) FROM ".$Prefix."LIST_M where M_ID = '-$f' AND CAT_ID = '$nav[ID]'") or die(database_error(__line__,1));
$counts = mysqli_result($TOTAL , 0, "count(*)");

echo'
<td class="'.check_box($id,$nav[ID]).'"><nobr>
<a href="index.php?mode=list_forum&f='.$f.'&method=index&type=show&id='.$nav[ID].'">
'.$nav[NAME].' (<font color="red">'.$counts.'</font>)</a></nobr></td>';
}
echo'
<td class="'.check_box($c_id,"my_box").'"><nobr><a href="index.php?mode=list_forum&f='.$f.'&type=my_box">'.$lang['others']['add_new_list'].'</a></nobr></td>
</tr></table>';





// ############################################### first List #################################################"


	
if($type == "first"){
$sql = DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND CAT_ID = '-1' ");
$T_Page = '<font
 color="red" size="+1">'.$lang['others']['normal_list'].'</font>';
$Desc = "<br>".$lang['others']['list_f_desc']."";
}

if($type == "show" AND $id){
$sql = DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND CAT_ID = '$id' ");
$T_Page = '<font
 color="green" size="+1">'.p_name($id).'</font>';
$Desc = "<br>".$lang['others']['list_f_desc']."";
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

if ($type != "add"){
echo'
<br><table align="center" border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr>
      <td>
      <form name="optionsForm" action="">
        <table align="center" class="grid" border="0" cellpadding="0"cellspacing="0"  width="30%">

            <tr>
              <td>
              <table bgcolor="gray" border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="normal">
                    <td colSpan="4" class="list_small" colspan="5"><font
 color="red" size="+1">'.$T_Page.'</font>'.$Desc.'</td>
                  </tr>';
	}			  
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
<a href="index.php?mode=member&id='.$row[USER].'">
'.icons($icon_profile,$lang['message']['your_pm_with_this_member']).'</a>
</nobr></td>
<td class="f2ts"><nobr>'.m_online($row[USER]).'</nobr></td>
<td class="f2ts"><nobr> 
<a href="index.php?mode=member&id='.$row[USER].'">
'. member_color_link($row[USER]).'</a></nobr></td>
<td class="list_small2"><nobr> 
<a href="javascript:deleteItem('.$row[USER].')">
'.icons($icon_trash,$lang['others']['delete_from_this_list']).'</a> </nobr></td></tr>';
}}

echo'
</table></td></form>
      </td>
    </tr></table>';
	
}
if ($type == "first" OR $type == "show"){

			if ($type == "first"){
			$add="<input type='hidden' name='list' value='-1'>";}else{
			$add="<input type='hidden' name='list' value='$id'>";}
			
			
			
	echo'
			<table align="center" class="grid" bgcolor="gray" cellspacing="1" cellPadding="1" width="30%" border="0">
			<form method="post" action="index.php?mode=list_forum&f='.$f.'&type=add&method=mid">
			'.$add.'
			<center>
				<tr class="normal">
				<td class="list_small"><p align="center">
				<font size="2">'.$lang['others']['add_with_number'].'</font>
				<br>
				<input name="member" size="25" class="option_transparent">
				<input class="option_transparent" type="submit" value="'.$lang['others']['add_member'].'"></td>
				</tr>
			</form>
			<form method="post" action="index.php?mode=list_forum&f='.$f.'&type=add&method=title">
			'.$add.'
			<center>
				<tr class="normal">
				<td class="list_small"><p align="center">
				<font size="2">'.$lang['others']['add_with_title'].'</font>
				<br>
				<input name="title" size="25" class="option_transparent">
					<input class="option_transparent" type="submit" value="'.$lang['others']['add_member'].'"></td>
				</tr>
			</form>
			<form method="post" action="index.php?mode=list_forum&f='.$f.'&type=add&method=topic">
			'.$add.'
			<center>
				<tr class="normal">
				<td class="list_small"><p align="center">
				<font size="2">'.$lang['others']['add_with_replies_topics'].'</font>
				<br>
				<input name="topic" size="25" class="option_transparent">
				<input class="option_transparent" type="submit" value="'.$lang['others']['add_member'].'"></td>
				</tr>
			</form>
			</table>
			</td>
		</tr>';
}
// ############################################### My Box Page #################################################

if($type == "my_box"){
$max = 15;
$n_box = $max;


echo '
<form action="index.php?mode=list_forum&f='.$f.'&type=insert_box" method="post">
  <table align="center" class="grid" border="0" cellpadding="0" cellspacing="0" dir="rtl" width="300">
  
      <tr>
        <td>
        <table bgcolor="gray" border="0" cellpadding="2"
 cellspacing="1" dir="rtl" width="100%">
            <tr class="normal">
              <td class="list_small" colspan="2"><font
color="red" size="+1">'.$lang['others']['list_forum'].'</font><br>
'.$lang['others']['add_to_list_forum_description'].'</td>
            </tr>
            <tr>
              <td class="optionheader">'.$lang['others']['list_number'].'</td>
              <td class="optionheader"><nobr>&nbsp;'.$lang['others']['list_title'].'</nobr></td>
            </tr>';


$i=1;
while($i <= $n_box){
$sql = DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '-$f' AND EDITFOLDER = '$i' ");
$r = mysqli_fetch_array($sql);
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
              <input value="'.$lang['others']['change_list_forum'].'"
 type="submit"></td>
            </tr>
          <tr class="normal">
            <td class="list_small" colspan="2"><font
 color="red" size="+1">'.$lang['svc_function']['notes_votes'].'</font><br>
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
$n_box = 15;
$max =  15;

$query_c = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '-$f'"));

//if($query_c >= $max){
//go_to("index.php?mode=list_forum&f='.$f.'&type=sorry&msg=5");
//exit();
//}

for($i=1;$i<=$n_box;$i++){
$first = "editfolder".$i."";
$string = DBi::$con->real_escape_string(htmlspecialchars($_POST[$first]));


if($string){

$sql_check = DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '-$f' AND EDITFOLDER = '$i' ");
// Sql
if(mysqli_num_rows($sql_check) == 0){
DBi::$con->query("INSERT INTO ".prefix."LIST SET M_ID = '-$f',EDITFOLDER = '$i',NAME = '$string' ");
}else{
DBi::$con->query("UPDATE ".prefix."LIST SET NAME = '$string' WHERE EDITFOLDER = '$i' AND M_ID = '-$f' ");
}

}else{
$sql_check = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST WHERE M_ID = '-$f' AND EDITFOLDER = '$i' "));
if($sql_check != 0){
//DBi::$con->query("UPDATE ".prefix."LIST SET NAME = '$string' WHERE EDITFOLDER = '$i' AND M_ID = '-$f' ");
DBi::$con->query("DELETE FROM ".prefix."LIST  WHERE EDITFOLDER = '$i' AND M_ID = '-$f' ");

}
}

// Bye Bye
}

go_to("index.php?mode=list_forum&f=$f&type=my_box");
}

// ############################################### Delete Member #################################################

if($type == "del"){

$sql_check = DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND USER = '$id' AND CAT_ID = '$c' ");
$r = mysqli_fetch_array($sql_check);
$n = mysqli_num_rows($sql_check);
if($n == 0){
redirect();
}else{
$ID = $r['ID'];
DBi::$con->query("DELETE FROM ".prefix."LIST_M WHERE ID = '$ID' ") or die(DBi::$con->error);
if ($c < 0){
go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
}else{
go_to("index.php?mode=list_forum&f=$f&method=index&type=show&id=$c");
}
}

}

// ############################################### Add Member #################################################

if($type == "add"){
$member = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["member"])));
$title = DBi::$con->real_escape_string(htmlspecialchars($_POST["title"]));
$list = DBi::$con->real_escape_string(htmlspecialchars($_POST["list"]));
$hide = DBi::$con->real_escape_string(htmlspecialchars($_POST["hide"]));
$topic = DBi::$con->real_escape_string(htmlspecialchars(intval($_POST["topic"])));


if($method == ""){go_to("index.php?mode=list_forum&f=$f&type=sorry&msg=0");}
if($method == "mid"){
$query_c = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND CAT_ID = '$list' "));
// هنا خطـ
//if($query_c >= $max){
//go_to('index.php?mode=list_forum&f=$f&method=index&type=first');
//exit();
//}
$check_num = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$member' AND M_STATUS = '1' AND M_HOLDED = '0' ") or die(database_error(__line__,1));
$s=mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND USER = '$member' AND CAT_ID = '$list' "));
if(mysqli_num_rows($check_num) <= 0){
go_to("index.php?mode=list_forum&f=$f&type=sorry&msg=1");
}
elseif($s != 0){
go_to($referer);
}


else {
DBi::$con->query("INSERT INTO ".prefix."LIST_M SET M_ID = '-$f', USER = '$member', CAT_ID = '$list' ");
}	
if ($list < 0){
go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
}else{
go_to("index.php?mode=list_forum&f=$f&method=index&type=show&id=$list");
} 		
}



if($method == "title"){
$frm = gt("FORUM_ID", $title);
 //if (allowed($frm, 2) == 0){go_to("index.php?mode=list_forum&f=$f&type=sorry&msg=3");}
 //if (allowed($frm, 2) == 1){
$sql = DBi::$con->query("SELECT * FROM ".prefix."USED_TITLES WHERE TITLE_ID = '$title' ") or die(DBi::$con->error);
$run = mysqli_num_rows($sql);
		for($i=0; $i<$run; ++$i){
		$query_c = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".$Prefix."LIST_M WHERE M_ID = '-$f' AND CAT_ID = '$list' "));
//هنا اصلا ح مشكل الاوصاف
		//if($query_c >= $max){
//go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
//exit();
//}
		    $user = mysqli_result($sql, $i, "MEMBER_ID");
			$s=mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND USER = '$user' AND CAT_ID = '$list' "));
			$check_num = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$user' AND M_STATUS = '1' ") or die(database_error(__line__,1));
			if($s == 0 && mysqli_num_rows($check_num) > 0){
		 DBi::$con->query("INSERT INTO ".prefix."LIST_M SET M_ID = '-$f', USER = '$user', CAT_ID = '$list' ");
		}	
		}
		 if ($list < 0){
go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
}else{
go_to("index.php?mode=list_forum&f=$f&method=index&type=show&id=$list");
} 		
}
//}

if($method == "hide"){
$frm =topics("FORUM_ID", $hide);
$t_hide = topics("HIDDEN", $hide);
if (allowed($frm, 2) == 0){go_to("index.php?mode=list_forum&f=$f&type=sorry&msg=2");}
 if (allowed($frm, 2) == 1){
  if ($t_hide == 0){
 error_message($lang['others']['cant_add_hide_topic']);
 }
 
$sql = DBi::$con->query("SELECT * FROM ".prefix."TOPIC_MEMBERS  WHERE TOPIC_ID = '$hide' ") or die(DBi::$con->error);
$run = mysqli_num_rows($sql);
		for($i=0; $i<$run; ++$i){
		$query_c = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND CAT_ID = '$list' "));
if($query_c >= $max){
go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
exit();
}
		    $user = mysqli_result($sql, $i, "MEMBER_ID");
			$s=mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND USER = '$user' AND CAT_ID = '$list' "));
			$check_num = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$user' AND M_STATUS = '1' ") or die(database_error(__line__,1));
			if($s == 0 && mysqli_num_rows($check_num) > 0){
		 DBi::$con->query("INSERT INTO ".prefix."LIST_M SET M_ID = '-$f', USER = '$user', CAT_ID = '$list' ");
		}	
		}
		 if ($list < 0){
go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
}else{
go_to("index.php?mode=list_forum&f=$f&method=index&type=show&id=$list");
} 		
}
}


if($method == "topic"){
$frm =topics("FORUM_ID", $topic);
$author = topics("AUTHOR", $topic);
if (allowed($frm, 2) == 0){go_to("index.php?mode=list_forum&f=$f&type=sorry&msg=2");}
 if (allowed($frm, 2) == 1){
 $query_c = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND CAT_ID = '$list' "));
//if($query_c > $max){
//go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
//exit();
//}
			$ss=mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND USER = '$author' AND CAT_ID = '$list' "));
			$check_nums = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$author' AND M_STATUS = '1' ") or die(database_error(__line__,1));
			if($ss == 0 && mysqli_num_rows($check_nums) > 0){
		 DBi::$con->query("INSERT INTO ".prefix."LIST_M SET M_ID = '-$f', USER = '$author', CAT_ID = '$list' ");
		}	
		
		
$sql = DBi::$con->query("SELECT * FROM ".prefix."REPLY  WHERE TOPIC_ID = '$topic' ") or die(DBi::$con->error);
$run = mysqli_num_rows($sql);
		for($i=0; $i<$run; ++$i){
		$query_c = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND CAT_ID = '$list' "));
//if($query_c >= $max){
//go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
//exit();
//}
		    $user = mysqli_result($sql, $i, "R_AUTHOR");
			$s=mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."LIST_M WHERE M_ID = '-$f' AND USER = '$user' AND CAT_ID = '$list' "));
			$check_num = DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE MEMBER_ID = '$user' AND M_STATUS = '1' ") or die(database_error(__line__,1));
			if($s == 0 && mysqli_num_rows($check_num) > 0){
		 DBi::$con->query("INSERT INTO ".prefix."LIST_M SET M_ID = '-$f', USER = '$user', CAT_ID = '$list' ");
		}	
		}
		 if ($list < 0){
go_to("index.php?mode=list_forum&f=$f&method=index&type=first");
}else{
go_to("index.php?mode=list_forum&f=$f&method=index&type=show&id=$list");
} 		
//}//
}

}



// ############################################### Error Add Member #################################################

if($type == "error"){

echo ' <br><table align="center" border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr>
      <td>
      <form name="optionsForm" action="index.php?mode=list_forum&f='.$f.'&">
        <table align="center" class="grid" border="0" cellpadding="0"cellspacing="0"  width="300">

            <tr>
              <td>
              <table border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="normal">
                    <td class="list_small" colspan="5"><font color="green" size="+1">'.$lang['all']['error'].'</font><br>
'.$lang['others']['cant_add_member'].'
</td>
                  </tr>';

             echo ' </table></td></tr></table></form>
      </td>
    </tr></table>';

}


// ############################################### Error Add Member #################################################

if($type == "erreur"){

echo ' <br><table align="center" border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr>
      <td>
      <form name="optionsForm" action="index.php?mode=list_forum&f='.$f.'&">
        <table align="center" class="grid" border="0" cellpadding="0"cellspacing="0"  width="300">

            <tr>
              <td>
              <table border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="normal">
                    <td class="list_small" colspan="5"><font color="green" size="+1">'.$lang['all']['error'].'</font><br>
'.$lang['others']['cant_add_wrong_member'].'
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
        <table align="center" class="grid" border="0" cellpadding="0"cellspacing="0"  width="300">

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

// ############################################### Sorry Section #################################################

if($type == "sorry"){
if($msg == "" && $msg == 0 && $msg != 1 && $msg != 2 && $msg != 3 or $msg > 3 or $msg < 0){$txt = $lang['others']['wrong_this_url']; }
elseif($msg == 0){$txt = $lang['others']['cant_add_member_way']; }
elseif($msg == 1){$txt = $lang['others']['cant_add_member_status']; }
elseif($msg == 2){$txt = $lang['others']['cant_add_member_topic']; }
elseif($msg == 3){$txt = $lang['others']['cant_dd_member_title']; }
echo ' <br><table border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr>
      <td>
        <table align="center" class="grid" border="0" cellpadding="0"cellspacing="0"  width="300">

            <tr>
              <td>
              <table border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="normal">
                    <td class="list_small" colspan="5"><font
 color="green" size="+1">'.$lang['all']['error'].'</font><br>
'.$txt.'
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
        <table align="center" class="grid" border="0" cellpadding="0"cellspacing="0"  width="300">

            <tr>
              <td>
              <table border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="normal">
                    <td class="list_small" colspan="5"><font
 color="green" size="+1">خطأ</font><br>
'.$msg.'
</td>
                  </tr>';

             echo ' </table></td></tr></table></form>
      </td>
    </tr></table>';

}
}





?>

