<?php
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

if($type != "" && $type != "upload") {
redirect();	
}

require_once("./engine/groups_function.php");
if (allowed($f, 2) == 1){

$max_file_size = 51200;
$medal_folder = $image_folder.'groups/forum'.$f.'/';


if ($type == ""){
	?>
<script language="javascript" src="language/<? print $choose_language; ?>.js"></script>
<script language="javascript">
function trash_file(id){
	if (confirm(confirm_delete_files)){
		document.file_info.file_id.value = id;
		document.file_info.submit();
	}
	else{
		return;
	}
}
function get_file_name(file){
	var x;
	while (file.indexOf("\\") >= 0){
		file = file.slice(file.indexOf("\\")+1);
	}
	return(file);
}

function set_file_name()
{
var up = upload.up.value;
up = get_file_name(up);
upload.file_name.value = up;
  
}
</script>
<?


if (!empty($_POST[file_id])){
	$file_id = $_POST[file_id];
	if (chk_gf_id($file_id) == 1){
		$mf_subject = gf("NAME", $file_id);
		DBi::$con->query("DELETE FROM ".$Prefix."GROUPS_FILES WHERE GF_ID = '$file_id' ") or die (DBi::$con->error);
				unlink($medal_folder.$mf_subject);
		
	}
}

function gf_files($id){
	global $icon_trash, $medal_folder, $lang;
	$f = gf("FORUM", $id);
	$added = gf("ADDED", $id);
	$subject = gf("SUBJECT", $id);
	$date = gf("DATE", $id);
	$name = gf("NAME", $id);
	
	if (file_exists($medal_folder.$name)){
		$file_size = filesize($medal_folder.$name);
	}

	echo'
	<tr class="normal">
		<td class="list_small"><nobr>'.$id.'</nobr></td>
		<td class="list"><a target="_new" href="'.$subject.'">'.$name.'</a></td>
		<td class="list_small"><nobr>'.$file_size.'</nobr></td>
		<td class="list_small"><nobr>'.normal_time($date).'</nobr></td>
		<td class="list_small"><nobr><a href="index.php?mode=svc&method=add&svc=groups&f='.$f.'&m='.$id.'">'.$lang['others']['add_new_group_here'].'</a></nobr></td>
		<td class="list_small"><a href="javascript:trash_file('.$id.')">'.icons($icon_trash, $lang['others']['delete_from_files']).'</a></td>
	</tr>';
}

echo'
<center>
<table width="100%">
	<tr>
		<td class="optionsbar_menus" width="100%"><nobr><font color="red" size="+1">'.$lang['others']['groups_files_forum'].' '.forums("SUBJECT", $f).'</font></nobr></td>
	</tr>
</table>
<br>
<form name="file_info" method="post" action="'.$_SERVER[REQUEST_URI].'">
<input type="hidden" name="file_id">
</form>
<table dir="rtl" cellSpacing="0" cellPadding="0" border="0">
	<tr>
		<td>
		<table bgcolor="gray" class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
			<tr>
				<td>
				<table cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat">'.$lang['members']['numbers'].'</td>
						<td class="cat">'.$lang['others']['file_name'].'</td>
						<td class="cat">'.$lang['others']['file_size'].'</td>
						<td class="cat">'.$lang['others']['file_date'].'</td>
						<td class="cat" colspan="2">'.$lang['members']['options'].'</td>
					</tr>';
					
			$sql = DBi::$con->query("SELECT * FROM ".$Prefix."GROUPS_FILES WHERE FORUM_ID = '$f' ORDER BY GF_ID DESC") or die (DBi::$con->error);
			$num = mysqli_num_rows($sql);
			$x = 0;
			while ($x < $num) {
				$gf_id = mysqli_result($sql, $x, "GF_ID");
				gf_files($gf_id);
				$count = $count + 1;
			++$x;	
			}
			if ($count == 0){
					echo'
					<tr class="normal">
						<td class="list_options" colspan="6"><br>'.$lang['others']['no_files_forum'].'<br><br></td>
					</tr>';	
			}
					echo'
					<tr class="normal">
						<td class="list_options" colspan="6"><font color="red">'.$lang['others']['bigg_size'].'</font> '.$max_file_size.'<br><font color="red">'.$lang['others']['only_ext'].' </font>GIF</td>
					</tr>
					<tr class="normal">
						<td class="list_options" colspan="6"><font color="red">'.$lang['others']['files_description1'].'</font></td>
					</tr>
					<tr class="deleted">
						<td align="middle" colspan="6"><br>
						<form name="upload" method="post" encType="multipart/form-data" action="index.php?mode=gf&type=upload&f='.$f.'">
							<table>
								<tr>
									<td vAlign="bottom">'.$lang['others']['select_file_to_upload'].'<br><input type="file" onchange="set_file_name()" name="up"></td>
									<td>&nbsp;</td>
									<input type="hidden" name="file_name">
									<td>&nbsp;</td>
									<td vAlign="bottom"><input type="submit" value="'.$lang['others']['start_download'].'"></td>
								</tr>
							</table>
						</form>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</center>';
}

if ($type == "upload"){
	if (allowed($f, 2) == 1){
		$file_size = $_FILES['up']['size'];
		$file_type = $_FILES['up']['type'];
		$file_temp = $_FILES['up']['tmp_name'];
		
	 function file_extension($filename){
 return substr(strrchr($filename, '.'), 1);
}

 $sql1 = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_FILES WHERE FORUM_ID = '$f'");
 $num1 = mysqli_num_rows($sql1) + 1;

$file_name = $f.'_'.$num1.'.'.file_extension($_FILES['up']['name']);
		
				$img_url = $medal_folder.$file_name;


		if ($file_size > $max_file_size){
			$error = "".$lang['others']['error_size1']." ".$file_size." ".$lang['others']['error_size2']." ".$max_file_size." ".$lang['others']['error_size3']."";
		}
		if (file_extension($_FILES['up']['name']) != "gif"){
			$error = $lang['others']['no_ext'];
		}
		  if (!file_exists($medal_folder))
   {
      mkdir($image_folder.'groups/forum'.$f);     
   }
		if ($error != ""){
	                echo'<br>
					<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br><b>'.$lang['all']['error'].'<br>'.$error.'..</b></font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
		}
		if ($error == ""){
			move_uploaded_file($file_temp, $medal_folder.$file_name);
			$sql = "INSERT INTO ".$Prefix."GROUPS_FILES (GF_ID, FORUM_ID, ADDED, SUBJECT, DATE, NAME) VALUES (NULL, ";
			$sql .= " '$f', ";
			$sql .= " '$DBMemberID', ";
			$sql .= " '$img_url', ";
			$sql .= " '".time()."', ";
			$sql .= " '$file_name') ";
			DBi::$con->query($sql) or die (DBi::$con->error);
	                echo'
					<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><b>'.$lang['others']['done_upload'].'</b></font><br><br>
	                       <meta http-equiv="refresh" content="1; URL='.$referer.'">
                           <a href="'.$referer.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
		}
	}
}


}
else{
	go_to(index);
}
?>