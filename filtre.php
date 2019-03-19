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
if($prd != "words" && $prd != "names") {
redirect();	
}
if($in != "" && $in != "insert" && $in != "update" && $in != "sup" && $in != "ok") {
redirect();	
}
if($tp != "up" && $tp != "add" && $tp != "") {
redirect();	
}
if($prd == "words") {
	
$tp = htmlspecialchars(DBi::$con->real_escape_string($_GET['tp']));
$in = htmlspecialchars(DBi::$con->real_escape_string($_GET['in']));
$i = htmlspecialchars(DBi::$con->real_escape_string($_GET['i']));
if (mlv > 1){
	
		if ($in!="insert" and $in!="update" and $in!="sup" and $in!="ok" ){

	include("svc_menu.php");
			
		}
			
	if ($tp=="" and $in<>"insert" and $in<>"update" and $in<>"sup" and $in<>"ok" ){

			echo'
			</tr></table><br/>';
echo'<div align="center">
	<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="3" width="60%">
	<tr class="fixed">
		<td class="optionsbar_menus" colspan="4"><font color="red" size="3">'.$lang['filtre']['title'].'</font></td>
	</tr>
	<tr class="fixed">
	<td class="cat" width="22%">
		<p align="center">'.$lang['filtre']['name'].'</td>
			<td class="cat" width="15%">
		<p align="center">'.$lang['filtre']['replace'].'</td>
	<td class="cat" width="10%">
		<p align="center">'.$lang['svc_function']['request_status'].'</td>
	<td class="cat" width="7%">
		<p align="center"><a href="index.php?mode=filtre&prd=words&tp=add"><img alt="'.$lang['filtre']['add_new_word'].'" border="0" src="images/folders/folder_new.gif"></a></td>
		</tr>';
	$flt = DBi::$con->query("SELECT * FROM ".$Prefix."FILTRE ORDER BY FILTRE_ID ASC") or die (DBi::$con->error); // category mysql
$f_num = mysqli_num_rows($flt);
if ($f_num <= 0) {
echo'
<tr class="fixed">
<td colspan="4" class="frm1" vAlign="center" align="middle">'.$lang['filtre']['no_words'].'</td>
</tr>';
}
else{
while ($f_flt = mysqli_fetch_array($flt)) {
$F_NAME = $f_flt['F_NAME'];
$F_REP = $f_flt['F_REP'];
$F_STAT = $f_flt['F_STAT'];
$FILTRE_ID = $f_flt['FILTRE_ID'];
echo '<tr class="fixed">
		<td class="frm1">
		<p align="center">'.$F_NAME.'</td>
		<td class="list">
		<p align="center">'.$F_REP.'</td>
		<td class="list">
		<p align="center">';
		if ($F_STAT ==1){
		$stat = $lang['admin']['open'];
		$color = "green";
		}
		if ($F_STAT ==0){
		$stat=$lang['filtre']['pending'];
		$color="red";}
		echo'<font color="'.$color.'">'.$stat.'</font>
		</td>
		<td class="list"><p align="center">';
		if ($Mlevel == 4) {
		echo'<a href="index.php?mode=filtre&prd=words&in=sup&i='.$FILTRE_ID.'"><img border="0" src="images/folders/folder_delete.gif"></a>';
		if($F_STAT == "0"){
		echo'
		<a href="index.php?mode=filtre&prd=words&in=ok&i='.$FILTRE_ID.'"><img border="0" src="images/folders/folder_moderate.gif"></a>';}}
		if ($Mlevel == 4) { echo'&nbsp;&nbsp;<a href="index.php?mode=filtre&prd=words&tp=up&i='.$FILTRE_ID.'"><img alt="'.$lang['filtre']['edit_word'].'" border="0" src="images/folders/folder_new_edit.gif"></a>';}
		echo'</td>
	</tr>';}
}
echo'</table></div>';
}
if ($tp=="add"){
echo'<div align="center">
		<form method="POST" action="index.php?mode=filtre&prd=words&in=insert">
	<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<tr><br>
		<td class="optionheader_selected" colspan="2" align="center">
		<p align="center">'.$lang['filtre']['add_new_word_title'].'</td>
	</tr>
	<tr class="fixed">
		<td class="cat" align="center">
		<p align="center">'.$lang['svc_function']['option'].'</td>
	<td class="cat" align="center">
		<p align="center">'.$lang['filtre']['replace_word'].'</td>
		</tr>
	<tr class="fixed">
	<td class="optionheader" align="center">
		'.$lang['filtre']['name'].'</td>
		<td class="frm1" align="center">
			<p align="center"><input type="text" name="F_NAME" size="55"></p>
		</td>
		</tr>
	<tr class="fixed">
		<td class="optionheader" align="center">
		'.$lang['filtre']['replace'].'</td>
	<td class="frm1" align="center">
		<input type="text" name="F_REP" size="55"></td>
		</tr>
	<tr class="fixed">
		<td class="frm1" align="center" colspan="2">
		<p align="center"><input type="submit" value="'.$lang['profile']['insert_info'].'" name="B1">&nbsp;
		<input type="reset" value="'.$lang['profile']['reset_info'].'" name="B2"></td>
	</tr>
</table>
</form>
</div>';}
if ($tp=="up"){
	if($Mlevel == 4) {
	$uflt = DBi::$con->query("SELECT F_NAME,F_REP FROM ".$Prefix."FILTRE WHERE FILTRE_ID='$i' ORDER BY FILTRE_ID ASC") or die (DBi::$con->error);
$uf_num = mysqli_num_rows($uflt);
$t_cm = mysqli_fetch_array($uflt);
if ($uf_num > 0) {
$U_NAME = $t_cm['F_NAME'];
$U_REP = $t_cm['F_REP'];
echo'<div align="center">
		<form method="POST" action="index.php?mode=filtre&prd=words&in=update&i='.$i.'">
	<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<tr><br>
		<td class="optionheader_selected" colspan="2" align="center">
		<p align="center">'.$lang['filtre']['edit_word'].'</td>
	</tr>
	<tr class="fixed">
		<td class="cat" align="center">
		<p align="center">'.$lang['svc_function']['option'].'</td>
	<td class="cat" align="center">
		<p align="center">'.$lang['filtre']['replace_word'].'</td>
		</tr>
	<tr class="fixed">
	<td class="optionheader" align="center">
		'.$lang['filtre']['name'].'</td>
		<td class="frm1" align="center">
			<p align="center"><input value="'.$U_NAME.'" type="text" name="F_NAME" size="55"></p>
		</td>
		</tr>
	<tr class="fixed">
		<td class="optionheader" align="center">
		'.$lang['filtre']['replace'].'</td>
	<td class="frm1" align="center">
		<input type="text" value="'.$U_REP.'" name="F_REP" size="55"></td>
		</tr>
	<tr class="fixed">
		<td class="frm1" align="center" colspan="2">
		<p align="center"><input type="submit" value="'.$lang['profile']['insert_info'].'" name="B1">&nbsp;
		<input type="reset" value="'.$lang['profile']['reset_info'].'" name="B2"></td>
	</tr>
</table>
</form>
</div>';}} else {
redirect();	
}
}
if ($in=="insert"){
$F_NAME = DBi::$con->real_escape_string($_POST['F_NAME']);
$m_REP = DBi::$con->real_escape_string($_POST['F_REP']);
if ($Mlevel == 4) {
$stat = "1";
}
else {
$stat="0";}
if ($F_NAME=="" or $F_REP=""){
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre']['enter_name_replace'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=words">
					   <a href="index.php?mode=filtre&prd=words">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';}else{
DBi::$con->query("INSERT INTO ".$Prefix."FILTRE (F_NAME,F_REP,F_STAT) VALUES ('$F_NAME','$m_REP','$stat')");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre']['done_add_word'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=words">
					   <a href="index.php?mode=filtre&prd=words">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
				}
				}
				
	if ($in=="ok"){
		if($Mlevel == 4) {
$m_STAT = htmlspecialchars(DBi::$con->real_escape_string($_POST['F_STAT']));

DBi::$con->query("UPDATE ".$Prefix."FILTRE SET F_STAT ='1' WHERE FILTRE_ID = '$i'");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
die( '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre']['done_accept_word'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=words">
					   <a href="index.php?mode=filtre&prd=words">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>');} else {
				redirect();	
				}
				}
if ($in=="update"){
	if($Mlevel == 4) {
$F_NAME = DBi::$con->real_escape_string($_POST['F_NAME']);
$m_REP = DBi::$con->real_escape_string($_POST['F_REP']);
if ($F_NAME=="" or $F_REP=""){
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['admin']['not_do_all_options'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=words&in=update&i='.$i.'">
					   <a href="index.php?mode=filtre&prd=words&in=update&i='.$i.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';}
DBi::$con->query("UPDATE ".$Prefix."FILTRE SET F_NAME ='$F_NAME', F_REP ='$m_REP' WHERE FILTRE_ID = '$i'");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre']['done_edit_word'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=words">
					   <a href="index.php?mode=filtre&prd=words">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';} else {
				redirect();	
				}
}
				if ($in=="sup"){
					if($Mlevel == 4) {
DBi::$con->query("delete from ".$Prefix."FILTRE where FILTRE_ID='$i'");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre']['done_delete_word'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=words">
					   <a href="index.php?mode=filtre&prd=words">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';} else {
				redirect();	
				}
				}
				}else{
				 redirect();
				}	
	
}
if($prd == "names") {
	
$tp = htmlspecialchars(DBi::$con->real_escape_string($_GET['tp']));
$in = htmlspecialchars(DBi::$con->real_escape_string($_GET['in']));
$i = htmlspecialchars(DBi::$con->real_escape_string($_GET['i']));
if (mlv == 4){
	
		if ($in!="insert" and $in!="update" and $in!="sup" and $in!="ok" ){

	include("svc_menu.php");
			
		}
			
	if ($tp=="" and $in<>"insert" and $in<>"update" and $in<>"sup" and $in<>"ok" ){

			echo'
			</tr></table><br/>';
echo'<div align="center">
	<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="3" width="60%">
	<tr class="fixed">
		<td class="optionsbar_menus" colspan="4"><font color="red" size="3">'.$lang['filtre_name']['filtre_title'].'</font></td>
	</tr>
	<tr class="fixed">
	<td class="cat" width="22%">
		<p align="center">'.$lang['members_function']['name'].'</td>
	<td class="cat" width="7%">
		<p align="center"><a href="index.php?mode=filtre&prd=names&tp=add"><img alt="'.$lang['filtre_name']['add_new_name'].'" border="0" src="images/folders/folder_new.gif"></a></td>
		</tr>';
	$flt = DBi::$con->query("SELECT * FROM ".$Prefix."FILTRE_NAMES ORDER BY FILTRE_ID ASC") or die (DBi::$con->error); // category mysql
$f_num = mysqli_num_rows($flt);
if ($f_num <= 0) {
echo'
<tr class="fixed">
<td colspan="4" class="frm1" vAlign="center" align="middle">'.$lang['filtre_name']['no_names'].'</td>
</tr>';
}
else{
while ($f_flt = mysqli_fetch_array($flt)) {
$F_NAME = $f_flt['F_NAME'];
$FILTRE_ID = $f_flt['FILTRE_ID'];
echo '<tr class="fixed">
		<td class="frm1">
		<p align="center">'.$F_NAME.'</td>
		<td class="list"><p align="center">';
		if ($Mlevel == 4) {
		echo'<a href="index.php?mode=filtre&prd=names&in=sup&i='.$FILTRE_ID.'"><img border="0" src="images/folders/folder_delete.gif"></a>';}
		if ($Mlevel == 4) { echo'&nbsp;&nbsp;<a href="index.php?mode=filtre&prd=names&tp=up&i='.$FILTRE_ID.'"><img alt="'.$lang['filtre_name']['edit_name'].'" border="0" src="images/folders/folder_new_edit.gif"></a>';}
		echo'</td>
	</tr>';}
}
echo'</table></div>';
}
if ($tp=="add"){
echo'<div align="center">
		<form method="POST" action="index.php?mode=filtre&prd=names&in=insert">
	<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<tr><br>
		<td class="optionheader_selected" colspan="2" align="center">
		<p align="center">'.$lang['filtre_name']['add_new_name'].'</td>
	</tr>
	<tr class="fixed">
		<td class="cat" align="center">
		<p align="center">'.$lang['svc_function']['option'].'</td>
	<td class="cat" align="center">
		<p align="center">'.$lang['filtre']['replace_word'].'</td>
		</tr>
	<tr class="fixed">
	<td class="optionheader" align="center">
		'.$lang['members_function']['name'].'</td>
		<td class="frm1" align="center">
			<p align="center"><input type="text" name="F_NAME" size="55"></p>
		</td>
		</tr>
	<tr class="fixed">
		<td class="frm1" align="center" colspan="2">
		<p align="center"><input type="submit" value="'.$lang['profile']['insert_info'].'" name="B1">&nbsp;
		<input type="reset" value="'.$lang['profile']['reset_info'].'" name="B2"></td>
	</tr>
</table>
</form>
</div>';}
if ($tp=="up"){
	$uflt = DBi::$con->query("SELECT F_NAME FROM ".$Prefix."FILTRE_NAMES WHERE FILTRE_ID='$i' ORDER BY FILTRE_ID ASC") or die (DBi::$con->error);
$uf_num = mysqli_num_rows($uflt);
$t_cm = mysqli_fetch_array($uflt);
if ($uf_num > 0) {
$U_NAME = $t_cm['F_NAME'];
echo'<div align="center">
		<form method="POST" action="index.php?mode=filtre&prd=names&in=update&i='.$i.'">
	<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<tr><br>
		<td class="optionheader_selected" colspan="2" align="center">
		<p align="center">'.$lang['filtre_name']['edit_name'].'</td>
	</tr>
	<tr class="fixed">
		<td class="cat" align="center">
		<p align="center">'.$lang['svc_function']['option'].'</td>
	<td class="cat" align="center">
		<p align="center">'.$lang['filtre']['replace_word'].'</td>
		</tr>
	<tr class="fixed">
	<td class="optionheader" align="center">
		'.$lang['members_function']['name'].'</td>
		<td class="frm1" align="center">
			<p align="center"><input value="'.$U_NAME.'" type="text" name="F_NAME" size="55"></p>
		</td>
		</tr>
	<tr class="fixed">
		<td class="frm1" align="center" colspan="2">
		<p align="center"><input type="submit" value="'.$lang['profile']['insert_info'].'" name="B1">&nbsp;
		<input type="reset" value="'.$lang['profile']['reset_info'].'" name="B2"></td>
	</tr>
</table>
</form>
</div>';}}
if ($in=="insert"){
$F_NAME = htmlspecialchars(DBi::$con->real_escape_string($_POST['F_NAME']));
if ($F_NAME==""){
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre_name']['enter_the_name'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=names">
					   <a href="index.php?mode=filtre&prd=names">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';}else{
DBi::$con->query("INSERT INTO ".$Prefix."FILTRE_NAMES (F_NAME) VALUES ('$F_NAME')");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre_name']['done_add_the_name'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=names">
					   <a href="index.php?mode=filtre&prd=names">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
				}
				}

				
if ($in=="update"){
$F_NAME = htmlspecialchars(DBi::$con->real_escape_string($_POST['F_NAME']));
if ($F_NAME==""){
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['admin']['not_do_all_options'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=names&in=update&i='.$i.'">
					   <a href="index.php?mode=filtre&prd=names&in=update&i='.$i.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';}
DBi::$con->query("UPDATE ".$Prefix."FILTRE_NAMES SET F_NAME ='$F_NAME' WHERE FILTRE_ID = '$i'");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre_name']['done_edit_the_name'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=names">
					   <a href="index.php?mode=filtre&prd=names">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';}
				if ($in=="sup"){
DBi::$con->query("delete from ".$Prefix."FILTRE_NAMES where FILTRE_ID='$i'");
DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
echo '<br>
				<center>
				<table width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['filtre_name']['done_delete_the_name'].'</b></font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=index.php?mode=filtre&prd=names">
					   <a href="index.php?mode=filtre&prd=names">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';}
				}else{
				 redirect();
				}		
	
}

?>