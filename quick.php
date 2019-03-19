<?php
if (@eregi("quick.php","$_SERVER[PHP_SELF]")) {
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

if($type != "" && $type != "add") {
redirect();	
}

if (members("THE_ID", $m) == 1 && members("LEVEL", $m) == 4 or DBi::$con->real_escape_string(htmlspecialchars($_POST["user_id"])) == 1) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[out][member_is_admin].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}

$ppMemberID = $m;
if ($type == "") {

    if ($Mlevel == 4  ) {

 $query = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '" .$ppMemberID."' ";
 $result = @DBi::$con->query($query) or die (DBi::$con->error);

 if(@mysqli_num_rows($result) > 0){
 $rs = @mysqli_fetch_array($result);

 $ProMemberID = $rs['MEMBER_ID'];
 $ProMemberPosts = $rs['M_HIDE_POSTS'];
 $ProMemberPm = $rs['M_HIDE_PM'];
 }
 
$Name = link_profile(member_name($m), $m);


echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
<form method="post" action="index.php?mode=quick&m='.$m.'&type=add">
<input type="hidden" name="user_id" value="'.$ppMemberID.'">

	<tr class="fixed">
	<td class="cat" colspan="3"><nobr>'.$lang[quick][title].'   '.$Name.'  </td>

	</tr>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang['svc_file']['moderat_8'].'</nobr></td>
		<td class="list">
    <input class="radio" type="radio" value="1" name="user_posts" '.check_radio($ProMemberPosts , "1").'>'.$lang[lock][yes].'&nbsp;&nbsp;&nbsp;&nbsp;
       <td class="list">
       <input class="radio" type="radio" value="0" name="user_posts" '.check_radio($ProMemberPosts , "0").'>'.$lang[lock][no].'&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
	<tr class="fixed">
		<td class="cat"><nobr>'.$lang[lock][pm].'</nobr></td>
		<td class="list">
    <input class="radio" type="radio" value="1" name="user_pm" '.check_radio($ProMemberPm , "1").'>'.$lang[lock][yes].'&nbsp;&nbsp;&nbsp;&nbsp;
       <td class="list">
       <input class="radio" type="radio" value="0" name="user_pm" '.check_radio($ProMemberPm , "0").'>'.$lang[lock][no].'&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
 	<tr class="fixed">
		<td align="middle" colspan="3"><input type="submit" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
	</tr>		</table>

';
 }
 else {
 redirect();
 }
}

if ($type == "add") {

    if ($Mlevel == 4  ) {


$ppMemberID = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_id"]));
$user_posts = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_posts"]));
$user_pm = DBi::$con->real_escape_string(HtmlSpecialchars($_POST["user_pm"]));



if ($error == "") {

		$query = "UPDATE " . $Prefix . "MEMBERS SET ";
        $query .= " M_HIDE_POSTS = ('$user_posts'), ";
        $query .= " M_HIDE_PM = ('$user_pm') ";


        $query .= "WHERE MEMBER_ID = '$ppMemberID' ";
		@DBi::$con->query($query) or die (DBi::$con->error);

	                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang[quick][add].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php?mode=member&id='.$m.'">
                           <a href="index.php?mode=member&id='.$m.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}


    }
    else {
    redirect();
    }

}
?>