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

if($type != "true" && $type != "" && $type != "lock" && $type != "hold" && $type != "online" && $type != "points" && $type != "mods" && $type != "mons" && $type != "dmons" && $type != "admin" && $type != "ture" && $type != "search_lock" && $type != "search_hold" && $type != "name" && $type != "posts" && $type != "country" && $type != "lastpost" && $type != "lastvisit" & $type != "register") {
redirect();
}

@require_once("./engine/members_function.php");
if (members("MEMBERS", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][members].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}

if(empty($pg) || $pag <= 0){
	$pag = 1;
}
else{
	$pag = $pg;
}
if ($Mlevel == 4) {
$no_mlv4 = "";
}else{
$no_mlv4 = "AND M_LEVEL != 4";
}

if ($Mlevel > 2) {
$no_mlv3 = "";
}else{
$no_mlv3 = "AND M_LEVEL != 3";
}

if($type == "" && $Mlevel == 0 or $type == "online" && $Mlevel == 0) {
$type = "posts";
}

if ($type == "lock"){
	if ($Mlevel > 1){
		$open_sql = "WHERE M_STATUS = '0'";
	}
	else{
		$open_sql = "WHERE M_STATUS = '1' AND M_LEVEL != 4";
	}
}
if ($type == "hold"){
	if ($Mlevel > 1){
		$open_sql = "WHERE M_HOLDED = '1'";
	}
	else{
		$open_sql = "WHERE M_STATUS = '1' AND M_LEVEL != 4";
	}
}
else{
	$open_sql = "WHERE M_STATUS = '1' AND M_LEVEL != 4";
}
$start = (($pag * $max_page) - $max_page);
$pg_sql = @DBi::$con->query("SELECT COUNT(*) FROM ".$Prefix."MEMBERS ".$open_sql." ") or die (DBi::$con->error);
$total_res = @mysqli_result($pg_sql, 0, "COUNT(*)");
$total_col = ceil($total_res / $max_page);


if ($type == "online") {
          $text = $lang['others']['members_now'];
}
else if ($type == "points") {
          $text = $lang['members']['best_list'];
}
else if ($type == "mods") {
          $text = $lang['members']['mods_list'];
}
else if ($type == "mons") {
		if($Mlevel == 4) {
          $text = $lang['members']['mons_list'];
		} else {
          $text = $lang['members']['members_list'];
		}
}
else if ($type == "dmons") {
		if($Mlevel == 4) {
          $text = $lang['members']['dmons_list'];
		} else {
          $text = $lang['members']['members_list'];
		}}
else if ($type == "admin") {
		if($Mlevel == 4) {
          $text = $lang['members']['admins_list'];
		} else {
          $text = $lang['members']['members_list'];
		}}
else if ($type == "lock") {
          $text = $lang['members']['lock_list'];
}
else if ($type == "hold") {
          $text = $lang['members']['hold_list'];
}

else {
          $text = $lang['members']['members_list'];
}

echo'
<center>
<table cellSpacing="2" cellPadding="1" width="99%" border="0">
	<tr>
		<td class="optionsbar_menus" width="38%"><font color="red" size="+1">'.$text.'</font></td>';
		if($type == "lock") {
		echo'	
		<form method="post" action="index.php?mode=members&type=search_lock">
		';
		} elseif($type == "hold") {
			echo'
		<form method="post" action="index.php?mode=members&type=search_hold">
		';
		} else {
		echo'
		<form method="post" action="index.php?mode=members&type=true">
		';
		}
		echo'
		<td class="optionsbar_menus">'.$lang['members']['search_member'].'<br>
			<input style="width: 100px" name="search_member">
			&nbsp;<input class="submit" type="submit" value="'.$lang['header']['search'].'">
		</td>
		</form>
<script type="text/javascript" src="./javascript/menu.js"></script>
';

		type();
		members_order();

		if ($type == "true") {
	$open_sql = "WHERE M_NAME LIKE '%$search_member%' AND M_STATUS = '1'  $no_mlv3 $no_mlv4 ";
}
elseif($type == "lock") {
	if ($Mlevel > 1){
		$open_sql = "WHERE M_STATUS = '0'";
	}
	else{
		$open_sql = "WHERE M_STATUS = '1'";
	}
}
elseif($type == "search_lock") {
	if ($Mlevel > 1){
		$open_sql = "WHERE M_NAME LIKE '%$search_member%' AND M_STATUS = '0'";
	}
	else{
		$open_sql = "WHERE M_NAME LIKE '%$search_member%' AND M_STATUS = '1'";
	}
}
elseif($type == "hold") {
	if ($Mlevel > 1){
		$open_sql = "WHERE M_HOLDED = '1'";
	}
	else{
		$open_sql = "WHERE M_STATUS = '1'";
	}
}
elseif($type == "search_hold") {
	if ($Mlevel > 1){
		$open_sql = "WHERE M_NAME LIKE '%$search_member%' AND M_HOLDED = '1'";
	}
	else{
		$open_sql = "WHERE M_NAME LIKE '%$search_member%' AND M_HOLDED = '1'";
	}
}
elseif($type == "points") {

	$open_sql = "WHERE M_STATUS = '1' AND M_POINTS > 0 ORDER BY M_POINTS DESC ";

}

elseif($type == "posts") {

	$open_sql = "WHERE M_STATUS = '1'  $no_mlv4  $no_mlv3 ORDER BY M_POSTS ".$desc_asc." ";

}

elseif($type == "name") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 ORDER BY M_NAME ".$desc_asc." ";

}

elseif($type == "country") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 ORDER BY M_COUNTRY ".$desc_asc." ";

}

elseif($type == "lastpost") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4 $no_mlv3  ORDER BY M_LAST_POST_DATE ".$desc_asc." ";

}

elseif($type == "lastvisit") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 ORDER BY M_LAST_HERE_DATE ".$desc_asc." ";

}

elseif($type == "register") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 ORDER BY M_DATE ".$desc_asc." ";

}

elseif($type == "mods") {
	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 AND M_LEVEL = '2' ORDER BY M_NAME ".$desc_asc." ";

}
elseif($type == "mons") {
	$open_sql = "WHERE M_STATUS = '1' $no_mlv4 AND M_LEVEL = '3' AND M_DEPUTY = '0' ORDER BY M_NAME ".$desc_asc." ";

}
elseif($type == "dmons") {
	$open_sql = "WHERE M_STATUS = '1' $no_mlv4 AND M_LEVEL = '3' AND M_DEPUTY = '1' ORDER BY M_NAME ".$desc_asc." ";

}
elseif($type == "admin") {
	$open_sql = "WHERE M_STATUS = '1' AND M_LEVEL = '4' ORDER BY M_NAME ".$desc_asc." ";

}
echo multi_page("MEMBERS ".$open_sql."", $max_page);	
		
  go_to_forum();
echo'
	</tr>
</table>';


if ($type == "true") {

$search_member = trim(DBi::$con->real_escape_string(HtmlSpecialchars($_POST[search_member])));
if($search_member == "") {
header("Location: ".index()."?mode=members");	
} else {
	$open_sql = "WHERE M_NAME LIKE '%$search_member%' AND M_STATUS = '1'  $no_mlv3 $no_mlv4 ";
	$no_member = $lang['members']['no_members'];
	member_func();
}
}
elseif ($type == "search_lock") {
$search_member = trim(DBi::$con->real_escape_string(HtmlSpecialchars($_POST[search_member])));
if($search_member == "") {
header("Location: ".index()."?mode=members&type=search_lock");	
} else {	
$search_member = trim(DBi::$con->real_escape_string(HtmlSpecialchars($_POST[search_member])));
	$open_sql = "WHERE M_NAME LIKE '%$search_member%' AND M_STATUS = '0'  $no_mlv3 $no_mlv4 ";
	$no_member = $lang['members']['no_members'];
	member_func();
}
}
elseif ($type == "search_hold") {
$search_member = trim(DBi::$con->real_escape_string(HtmlSpecialchars($_POST[search_member])));
$search_member = trim(DBi::$con->real_escape_string(HtmlSpecialchars($_POST[search_member])));
if($search_member == "") {
header("Location: ".index()."?mode=members&type=search_hold");	
} else {
	$open_sql = "WHERE M_NAME LIKE '%$search_member%' AND M_HOLDED = '1'  $no_mlv3 $no_mlv4 ";
	$no_member = $lang['members']['no_members'];
	member_func();
}
}
elseif($type == "lock") {
	if ($Mlevel > 1){
		$open_sql = "WHERE M_STATUS = '0'";
	}
	else{
		$open_sql = "WHERE M_STATUS = '1'";
	}
	$no_member = $lang['members']['no_lock_members'];
	member_func();
}
elseif($type == "hold") {
	if ($Mlevel > 1){
		$open_sql = "WHERE M_HOLDED = '1'";
	}
	else{
		$open_sql = "WHERE M_STATUS = '1'";
	}
	$no_member = $lang['members']['no_hold_members'];
	member_func();
}
elseif($type == "" OR $type == "online") {

	echo'
	<center><br>
	<table cellSpacing="1" cellPadding="2" border="1" width="65%">';
	if (mlv == 4) {
		echo'
		<tr>
			<td class="cat" colspan="5">'.$lang['members']['admins'].'</td>
		</tr>
		<tr>';
		mods_online(4,0);
		echo'
		</tr>';
}
if(mlv > 0) {
echo'
		<tr>
			<td class="cat" colspan="5">'.$lang['members']['monitors'].'</td>
		</tr>
		<tr>';
		mods_online(3,0);
		echo'
		</tr>

		<tr>
			<td class="cat" colspan="5">'.$lang['members']['deputy_monitor'].'</td>
		</tr>
		<tr>';
		mods_online(3,1);
		echo'
		</tr>';

}

echo'		
	
		
		<tr>
			<td class="cat" colspan="5">'.$lang['members']['moderators'].'</td>
		</tr>
		<tr>';
		mods_online(2,0);
		echo'
		</tr>

		<tr>
			<td class="cat" colspan="5">'.$lang['members']['a_members'].'</td>
		</tr>
		<tr>';
		mods_online(1,0);
		echo'
		</tr>
	</table>
	</center>';
	

}



elseif($type == "points") {

echo'
<table cellSpacing="1" cellPadding="2">
	<tr>
		<td align="center"><img onerror="this.src=\''.$icon_blank.'\';" src="'.$winner_ribbon.'" border="0"></td>
	</tr>
</table>
<table cellSpacing="1" cellPadding="2" border="1" width="410">';
	mods_list();
echo'
</table>';

}

elseif($type == "posts") {

	$open_sql = "WHERE M_STATUS = '1'  $no_mlv4  $no_mlv3 ORDER BY M_POSTS ".$desc_asc." ";
	member_func();

}

elseif($type == "name") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 ORDER BY M_NAME ".$desc_asc." ";
	member_func();

}

elseif($type == "country") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 ORDER BY M_COUNTRY ".$desc_asc." ";
	member_func();

}

elseif($type == "lastpost") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4 $no_mlv3  ORDER BY M_LAST_POST_DATE ".$desc_asc." ";
	member_func();

}

elseif($type == "lastvisit") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 ORDER BY M_LAST_HERE_DATE ".$desc_asc." ";
	member_func();

}

elseif($type == "register") {

	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 ORDER BY M_DATE ".$desc_asc." ";
	member_func();

}

elseif($type == "mods") {
	$open_sql = "WHERE M_STATUS = '1' $no_mlv4  $no_mlv3 AND M_LEVEL = '2' ORDER BY M_NAME ".$desc_asc." ";
	member_func();

}
elseif($type == "mons") {
if($Mlevel == 4) {	
	$open_sql = "WHERE M_STATUS = '1' $no_mlv4 AND M_LEVEL = '3' AND M_DEPUTY = '0' ORDER BY M_NAME ".$desc_asc." ";
	member_func();
} else {

}

}
elseif($type == "dmons") {
if($Mlevel == 4) {	
	$open_sql = "WHERE M_STATUS = '1' $no_mlv4 AND M_LEVEL = '3' AND M_DEPUTY = '1' ORDER BY M_NAME ".$desc_asc." ";
	member_func();
} else {

}
}
elseif($type == "admin") {
if($Mlevel == 4) {		
	$open_sql = "WHERE M_STATUS = '1' AND M_LEVEL = '4' ORDER BY M_NAME ".$desc_asc." ";
	member_func();
} else {

}
}




echo'
</table>
</center>';

?>