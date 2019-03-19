<?
if (@eregi("other_cat_add.php","$_SERVER[PHP_SELF]")) {
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

if($method != "forum" && $method != "cat") {
redirect();	
}
if($type != "delete" && $type != "insert" && $type != "edit" && $type != "options" && $type != "add" && $type != "") {
redirect();	
}


if(!isset($_GET['pg']))
{
$pag = 1;
}
else
{
$pag = $_GET['pg'];
}

$start = (($pag * $max_page) - $max_page);
$total_res = @mysqli_result(DBi::$con->query("SELECT COUNT(O_FORUMID) FROM " . $Prefix . "OTHERS_FORUM "),0);
$total_col = ceil($total_res / $max_page);

if ($pg == "p") {

$pg = DBi::$con->real_escape_string(htmlspecialchars($_POST["numpg"]));


 echo'<script language="JavaScript" type="text/javascript">
 window.location = "index.php?mode=other_cat_add&method=forum&type=options&pg='.$pg.'";
 </script>';

}

function paging($total_col, $pag) {
global $lang;
		echo '
        <form method="post" action="index.php?mode=other_cat_add&method=forum&type=options&pg=p">
        <td class="optionsbar_menus">

		<b>'.$lang['forum']['page'].':</b>
        <select name="numpg" size="1" onchange="submit();">';

        for($i = 1; $i <= $total_col; $i++) {
            if(($pag) == $i) {
		        echo '<option selected value="'.$i.'">'.$i.' '.$lang['function']['from'].' '.$total_col.'</option>';
            }
            else {
		        echo '<option value="'.$i.'">'.$i.' '.$lang['function']['from'].' '.$total_col.'</option>';
            }
        }

		echo '
        </select>

		</td>
		</form>';

}
//---------------------------------------------- PAGING -----------------------------------------

if($Mlevel == 4) {

if ($method == "cat") {

if ($type == "") {

echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="60%">
<form method="post" action="index.php?mode=other_cat_add&method=cat&type=add">

	<tr class="fixed">
		<td class="cat" colspan="2">'.$lang['other_cat_forum']['add_cat'].'<nobr></nobr></td>
	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['other_cat_forum']['cat_name'].'</nobr></td>
		<td class="list"><input type="text" name="add_cat_name" size="40"></td>
	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['other_cat_forum']['cat_url'].'</nobr></td>
		<td class="list"><input type="text" name="add_cat_url" size="40"></td>
	</tr>

 	<tr class="fixed">
		<td align="middle" colspan="2"><input type="submit" value="'.$lang['other_cat_forum']['ok'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['other_cat_forum']['reset'].'"></td>
	</tr>
</form>
</table>
</center>';

}

if ($type == "add") {

$queryCA = "SELECT * FROM " . $Prefix . "OTHERS_CAT ";
$resultCA = @DBi::$con->query($queryCA, $connection) or die (DBi::$con->error);

if(@mysqli_num_rows($resultCA) > 0){
$rsCA = @mysqli_fetch_array($resultCA);

$CCat_Name = $rsCA['O_CAT_NAME'];
}

	if ($CCat_Name != "") {
                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['other_cat_forum']['error'].'</font><br><br>
                           <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
	}
	else {

$Cat_Name = DBi::$con->real_escape_string(htmlspecialchars($_POST["add_cat_name"]));
$Cat_Url = DBi::$con->real_escape_string(htmlspecialchars($_POST["add_cat_url"]));

	$queryC = "INSERT INTO " . $Prefix . "OTHERS_CAT (O_CATID, O_CAT_NAME, O_CAT_URL) VALUES (NULL, '$Cat_Name', '$Cat_Url')";
	@DBi::$con->query($queryC, $connection) or die (DBi::$con->error);

                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['other_cat_forum']['the_cat_was_added'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
	}

}

if ($type == "edit") {

$query = "SELECT * FROM " . $Prefix . "OTHERS_CAT ";
$result = @DBi::$con->query($query) or die (DBi::$con->error);

if(@mysqli_num_rows($result) > 0){
$rs = @mysqli_fetch_array($result);

$OCat_Name = $rs['O_CAT_NAME'];
$OCat_Url = $rs['O_CAT_URL'];
}

echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="60%">
<form method="post" action="index.php?mode=other_cat_add&method=cat&type=insert">

	<tr class="fixed">
		<td class="cat" colspan="2">'.$lang['other_cat_forum']['add_cat'].'<nobr></nobr></td>
	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['other_cat_forum']['cat_name'].'</nobr></td>
		<td class="list"><input type="text" name="cat_name" value="'.$OCat_Name.'" size="40"></td>
	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['other_cat_forum']['cat_url'].'</nobr></td>
		<td class="list"><input type="text" name="cat_url" value="'.$OCat_Url.'" size="40"></td>
	</tr>

 	<tr class="fixed">
		<td align="middle" colspan="2"><input type="submit" value="'.$lang['other_cat_forum']['ok'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['other_cat_forum']['reset'].'"></td>
	</tr>
</form>
</table>
</center>';

}

if ($type == "insert") {

$ECat_Name = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_name"]));
$ECat_Url = DBi::$con->real_escape_string(htmlspecialchars($_POST["cat_url"]));

	$queryCE = "UPDATE " . $Prefix . "OTHERS_CAT SET O_CAT_NAME = ('$ECat_Name'), O_CAT_URL = ('$ECat_Url') ";
	@DBi::$con->query($queryCE, $connection) or die (DBi::$con->error);

                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['all']['info_was_edited'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

if ($type == "delete") {

		$queryCD = "DELETE FROM " . $Prefix . "OTHERS_CAT ";
		@DBi::$con->query($queryCD, $connection) or die (DBi::$con->error);
  
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_cat_is_deleted'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL=index.php">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

}

if ($method == "forum") {

$oforum_id = $f;

if ($type == "") {

echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="60%">
<form method="post" action="index.php?mode=other_cat_add&method=forum&type=add">

	<tr class="fixed">
		<td class="cat" colspan="2"><nobr>'.$lang['other_cat_forum']['add_forum'].'</nobr></td>
	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['other_cat_forum']['forum_name'].'</nobr></td>
		<td class="list"><input type="text" name="forum_name" size="40"></td>
	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['other_cat_forum']['forum_url'].'</nobr></td>
		<td class="list"><input type="text" name="forum_url" size="40"></td>
	</tr>

 	<tr class="fixed">
		<td align="middle" colspan="2"><input type="submit" value="'.$lang['other_cat_forum']['ok'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['other_cat_forum']['reset'].'"></td>
	</tr>
</form>
</table>
</center>';

}

if ($type == "add") {

$Forum_Name = DBi::$con->real_escape_string(htmlspecialchars($_POST["forum_name"]));
$Forum_Url = DBi::$con->real_escape_string(htmlspecialchars($_POST["forum_url"]));

	$queryF = "INSERT INTO " . $Prefix . "OTHERS_FORUM (O_FORUMID, O_FORUM_NAME, O_FORUM_URL) VALUES (NULL, '$Forum_Name', '$Forum_Url')";
	@DBi::$con->query($queryF, $connection) or die (DBi::$con->error);

                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['other_cat_forum']['the_forum_was_added'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

if ($type == "options") {

echo'
<center>
<table class="optionsbar" dir="rtl" cellSpacing="2" width="99%" border="0" id="table11">
	<tr>
		<td class="optionsbar_title" Align="middle" vAlign="center" width="100%">'.$lang['other_things']['cat_forums_options'].'</td>';
if ($total_res){
  paging($total_col, $pag);
}
  go_to_forum();
  echo '
    </tr>
</table>
</center><br>';

	echo'	<table bgcolor="gray" class="grid" dir="rtl" cellSpacing="0" cellPadding="0" width="30%" align="center" border="0">
			<tr>
				<td>
				<table dir="rtl" cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" colSpan="1" width="1%">'.$lang['members']['numbers'].'</td>
						<td class="cat" width="10%">'.$lang['admin']['forum_title'].'</td>
						<td class="cat" width="6%">'.$lang['members']['options'].'</td>
					</tr>';

	$queryDF = "SELECT * FROM " . $Prefix . "OTHERS_FORUM ORDER BY O_FORUMID ASC LIMIT $start, $max_page ";
	$resultDF = @DBi::$con->query($queryDF, $connection) or die (DBi::$con->error);

	$num = @mysqli_num_rows($resultDF);


	if ($num <= 0) {
                      echo'
                      <tr>
                          <td class="f1" vAlign="center" align="middle" colspan="10"><br><br>'.$lang['home']['no_cat'].'<br><br><br></td>
                      </tr>';
	}


$i=0;
while ($i < $num) {

    $OForum_ID = @mysqli_result($resultDF, $i, "O_FORUMID");
    $OForum_Name = @mysqli_result($resultDF, $i, "O_FORUM_NAME");
    $OForum_Url = @mysqli_result($resultDF, $i, "O_FORUM_URL");

echo'
	<tr class="'.normal.'">
		<td class="list_small" noWrap>'.$OForum_ID.'</a></td>
		<td class="list_small">'.$OForum_Name.'</td>
		<td class="list_small">';
echo'<a href="index.php?mode=other_cat_add&method=forum&type=edit&f='.$OForum_ID.'"><img hspace="2" alt="'.$lang['forum']['edit_topic'].'" src="'.$icon_edit.'" border="0"></a>';
echo'<a href="index.php?mode=other_cat_add&method=forum&type=delete&f='.$OForum_ID.'"><img hspace="2" alt="'.$lang['forum']['edit_topic'].'" src="'.$icon_trash.'" border="0"></a>';
	echo'	</td>';

    ++$i;
}
echo'
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</center>';
}

if ($type == "edit") {

$queryEF = "SELECT * FROM " . $Prefix . "OTHERS_FORUM WHERE O_FORUMID = '$oforum_id' ";
$resultEF = @DBi::$con->query($queryEF, $connection) or die (DBi::$con->error);

if(@mysqli_num_rows($resultEF) > 0){
$rsEF = @mysqli_fetch_array($resultEF);

$OForum_Name = $rsEF['O_FORUM_NAME'];
$OFORUM_Url = $rsEF['O_FORUM_URL'];
}

echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="60%">
<form method="post" action="index.php?mode=other_cat_add&method=forum&type=insert">
<input type="hidden" name="e_forum_id" value="'.$oforum_id.'">

	<tr class="fixed">
		<td class="cat" colspan="2">'.$lang['other_things']['edit_cat_forums'].'<nobr></nobr></td>
	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['other_cat_forum']['cat_name'].'</nobr></td>
		<td class="list"><input type="text" name="e_forum_name" value="'.$OForum_Name.'" size="40"></td>
	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['other_cat_forum']['cat_url'].'</nobr></td>
		<td class="list"><input type="text" name="e_forum_url" value="'.$OFORUM_Url.'" size="40"></td>
	</tr>

 	<tr class="fixed">
		<td align="middle" colspan="2"><input type="submit" value="'.$lang['other_cat_forum']['ok'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['other_cat_forum']['reset'].'"></td>
	</tr>
</form>
</table>
</center>';

}

if ($type == "insert") {

$oforum_id = DBi::$con->real_escape_string(htmlspecialchars($_POST["e_forum_id"]));
$EForum_Name = DBi::$con->real_escape_string(htmlspecialchars($_POST["e_forum_name"]));
$EForum_Url = DBi::$con->real_escape_string(htmlspecialchars($_POST["e_forum_url"]));

	$queryCE = "UPDATE " . $Prefix . "OTHERS_FORUM SET O_FORUM_NAME = ('$EForum_Name'), O_FORUM_URL = ('$EForum_Url') WHERE O_FORUMID = '$oforum_id' ";
	@DBi::$con->query($queryCE, $connection) or die (DBi::$con->error);

                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['all']['info_was_edited'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL=index.php?mode=other_cat_add&method=forum&type=options">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

if ($type == "delete") {

		$queryFD = "DELETE FROM " . $Prefix . "OTHERS_FORUM WHERE O_FORUMID = '$oforum_id' ";
		@DBi::$con->query($queryFD, $connection) or die (DBi::$con->error);
  
	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['delete']['the_cat_is_deleted'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL=index.php?mode=other_cat_add&method=forum&type=options">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}

}

}

@mysqli_close();

?>