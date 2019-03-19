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

if($type != "" && $type != "uploading" && $type != "delete") {
redirect();	
}

if ($Mlevel > 1) {
	
function files($name,$id){
	$sql = DBi::$con->query("SELECT * FROM ".prefix."FILES WHERE FILES_ID = '$id' ") or die(DBi::$con->error);
	if(mysqli_num_rows($sql)>0){
		$rs = mysqli_fetch_array($sql);
		$files = Array(
			$rs['FILES_ID'], $rs['FILES_SIZE'], $rs['FILES_URL'], $rs['FILES_DATE'], $rs['MEMBER_ID'], $rs['FILES_NAME']
			);
		if ($name == "ID"){$nom = 0;}
		if ($name == "SIZE"){$nom = 1;}
		if ($name == "URL"){$nom = 2;}
		if ($name == "DATE"){$nom = 3;}
		if ($name == "MEMBER_ID"){$nom = 4;}
		if ($name == "NAME"){$nom = 5;}
		return($files[$nom]);
	}
}

	?>
<script language="javascript">

function get_file_name(file){
	var x;
	while (file.indexOf("\\") >= 0){
		file = file.slice(file.indexOf("\\")+1);
	}
	return(file);
}

function set_file_name()
{
var fichier = MAX_FILE_SIZE.fichier.value;
fichier = get_file_name(fichier);
MAX_FILE_SIZE.new_name.value = fichier;
  
}
</script>
<?


//-------- VARIABLE NAME ---------

$repertoire = 'files/'.$DBMemberID.'/';

$FData = time();

$size_fichier = isset($_FILES['fichier']['size']);

$type_fichier = isset($_FILES['fichier']['type']);


//-------- VARIABLE NAME ---------


if ($type == "") {

echo'<center>
<table dir="rtl" cellSpacing="2" width="99%" border="0" id="table11">
	<tr>
		<td class="optionsbar_menus" Align="middle" vAlign="center" width="100%"><font size="4" color="red">'.$lang['others']['your_files'].'</font></td>
	</tr>
</table>
</center>';

 $query = "SELECT * FROM " . $Prefix . "FILES WHERE MEMBER_ID = '$DBMemberID' ";
 $query .= " ORDER BY FILES_ID ASC";
 $result = DBi::$con->query($query) or die (DBi::$con->error);

 $num = mysqli_num_rows($result);

	echo'	<table class="grid" dir="rtl" cellSpacing="0" cellPadding="0" width="60%" align="center" border="0">
			<br><tr>
				<td>
				<table bgcolor="gray" dir="rtl" cellSpacing="1" cellPadding="2" width="100%" border="0">
		<tr>
                	<td class="cat"><nobr>&nbsp;</nobr></td>
                	<td class="cat"><nobr>'.$lang['others']['file_name'].'</nobr></td>
                	<td class="cat"><nobr>'.$lang['others']['file_size'].'</nobr></td>
                	<td class="cat"><nobr>'.$lang['others']['file_date'].'</nobr></td>
		</tr>';

if ($num == 0) {

echo'		<tr>
			<td class="f1" align="center" colSpan="4"><br><br><font size="3">'.$lang['others']['no_files'].'<br><br>&nbsp;</font></td>
		</tr>';
}

$i=0;
while ($i < $num) {

    $Files_ID = mysqli_result($result, $i, "FILES_ID");
    $Files_Name = mysqli_result($result, $i, "FILES_NAME");
    $Files_Size = mysqli_result($result, $i, "FILES_SIZE");
    $Files_Url = mysqli_result($result, $i, "FILES_URL");
    $Files_Date = mysqli_result($result, $i, "FILES_DATE");

echo'	 <tr class="normal">
		<td class="list_small" width="2%" vAlign="center"><a href="index.php?mode=files&type=delete&id='.$Files_ID.'"  onclick="return confirm(\''.$lang['others']['confirm_delete_files'].'\');">'.icons($icon_trash, $lang['others']['delete_files'], "hspace=\"2\"").'</a></td>
		<td class="list_small" width="28%" vAlign="center"><a target="_blank" href="'.$Files_Url.'"><font size="3">'.$Files_Name.'</font></a></td>
		<td class="list_small" width="10%" dir="ltr"><font size="2">'.$Files_Size.'</font></td>
		<td class="list_small" width="20%"><font size="2">'.normal_time_files($Files_Date).'</font></td>
	</tr>';
    ++$i;
}

 $query = "SELECT SUM(FILES_SIZE) FROM ".$Prefix."FILES WHERE MEMBER_ID = '$DBMemberID' ";
 $result = DBi::$con->query($query) or die (DBi::$con->error);
 $Sum_Size = mysqli_result($result, "FILES_SIZE");

$MemberSize = $Files_Max_Size-$Sum_Size;

echo'		<tr class="fixed">
			<td class="list_small" colSpan="4"><b><font color="red" size="3">'.$lang['others']['the_past_size'].'</font> <font size="3">';
			if ($Sum_Size < $Files_Max_Size) {
			echo $MemberSize;
			}
			else {
			echo '0';
			}
		echo'	</font><br><font color="red" size="3">'.$lang['others']['the_big_size'].'</font> <font size="3">'.$Files_Max_Allowed.'</font></b></td>
		</tr>
		<tr class="fixed">
			<td class="list_small" colSpan="4"><b><font color="red" size="3">'.$lang['others']['files_description1'].'</font></b></td>
		</tr>
		<tr class="deleted">
			<td valign="right" colSpan="4"><br>
<form action="index.php?mode=files&type=uploading" method="post" enctype="multipart/form-data" name="MAX_FILE_SIZE">
<table cellSpacing="4" cellPadding="4" align="center" border="0">
		<tr>
			<td>'.$lang['others']['select_file_to_upload'].'<br><input onchange="set_file_name()" name="fichier" type="file" size="20" /></td>
			<input type="hidden" name="new_name" size="20">
			<td>&nbsp;<br><input type="submit" name="Submit" value="'.$lang['others']['start_download'].'" /></td>
		</tr>
</table>
</form>
			</td>
		</tr></table></table>';

}

if ($type == "uploading") {

 $query1 = "SELECT SUM(FILES_SIZE) FROM ".$Prefix."FILES WHERE MEMBER_ID = '$DBMemberID' ";
 $result1 = DBi::$con->query($query1, $connection) or die (DBi::$con->error);
 $Full_Size = mysqli_result($result1, "FILES_SIZE");


	
	 function file_extension($filename){
 return substr(strrchr($filename, '.'), 1);
}

 $sql1 = DBi::$con->query("SELECT * FROM ".prefix."FILES WHERE MEMBER_ID = '$DBMemberID'");
 $num1 = mysqli_num_rows($sql1) + 1;

$New_Name = $DBMemberID.'_'.$num1.'.'.file_extension($_POST["new_name"]);



if (isset($_FILES['fichier'])) {

   if ($_FILES['fichier']['size'] > $Files_Max_Allowed)
   {
      $erreur = ''.$lang['others']['cant_upload_past_size'].' '.$Files_Max_Allowed.'';
   }

   elseif ($Full_Size > $Files_Max_Size) {
    $erreur = $lang['others']['error_upload'];
   }

   
   elseif (!file_exists($repertoire))
   {
      mkdir("files/".$DBMemberID);     
   }
   elseif (file_extension($_POST["new_name"]) == "php" or file_extension($_POST["new_name"]) == "php4" or file_extension($_POST["new_name"]) == "php5" or file_extension($_POST["new_name"]) == "sql" or file_extension($_POST["new_name"]) == "htm" or file_extension($_POST["new_name"]) == "html" or file_extension($_POST["new_name"]) == "asp" or file_extension($_POST["new_name"]) == "aspx" or file_extension($_POST["new_name"]) == "phtml" or file_extension($_POST["new_name"]) == "shtml" or file_extension($_POST["new_name"]) == "pl" or file_extension($_POST["new_name"]) == "cgi") {
	  $erreur = $lang['others']['no_ext'];
   }
   if(isset($erreur))
   {

echo'<br>
<center>
	<table width="99%" border="1">
		<tr class="normal">
			<td class="list_center" colSpan="10"><br><b><font size="5" color="red">'.$erreur.'</font></b><br><br>
						<a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br>&nbsp;
			</td>
		</tr>
	</table>
</center>';

   }
   else
   {
             
      if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$New_Name))
      {
         $url = ''.$repertoire.''.$New_Name.'';
echo'<br>
<center>
	<table width="99%" border="1">
		<tr class="normal">
			<td class="list_center" colSpan="10"><br><b><font size="3" color="#191970">'.$lang['others']['done_upload'].'</font></b><br><br>
			';
			if(file_extension($_POST["new_name"]) == "png" or file_extension($_POST["new_name"]) == "gif" or file_extension($_POST["new_name"]) == "jpg" or file_extension($_POST["new_name"]) == "jpeg" or file_extension($_POST["new_name"]) == "bmp") {
			echo'
			<img border="0" src="'.$url.'" ><br><br>
			';
			} else {
			echo'
			<a target="_blank" href="'.$url.'">'.icons($icon_file, $name,"width='100' height='100'").'</a><br><br>
			';
			}			
			echo'
			<font size="3" color="#191970"><a target="_blank" href="'.$url.'">'.$url.'</a></font><br><br>
			<a href="index.php?mode=files">'.$lang['all']['click_here_to_go_normal_page'].'</a><br>&nbsp;
			</td>
		</tr>
	</table>
</center>';

$query = "INSERT INTO " . $Prefix . "FILES (FILES_ID, FILES_NAME, MEMBER_ID, FILES_SIZE, FILES_URL, FILES_DATE) VALUES (NULL, '$New_Name', '$DBMemberID', '$size_fichier', '$url', '$FData')";
DBi::$con->query($query, $connection) or die (DBi::$con->error);

      }
      else
      {
         echo'<br>
<center>
	<table width="99%" border="1">
		<tr class="normal">
			<td class="list_center" colSpan="10"><br><b><font size="3" color="red">'.$lang['others']['dont_upload'].'</font></b><br><br>
						<a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br>&nbsp;
			</td>
		</tr>
	</table>
</center>';
      }
			}
		}
	}

if ($type == "delete") {

if(files("MEMBER_ID", $id) == $DBMemberID) {
	
unlink($repertoire.files("NAME", $id));

		$queryD = "DELETE FROM " . $Prefix . "FILES WHERE FILES_ID = '$id' ";
		DBi::$con->query($queryD, $connection) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['others']['done_delete_files'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php?mode=files">
                           <a href="index.php?mode=files">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';

}
}

}
else {
redirect();
}

mysqli_close();
?>