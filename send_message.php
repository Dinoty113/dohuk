<?
if (@eregi("send_message.php","$_SERVER[PHP_SELF]")) {
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

if($method != "" && $method != "search" && $method != "mod") {
redirect();	
}
if(mlv == 0) {
redirect();	
}
?>
<script language="javascript">
    function send_msg(id){
	    window.location = "index.php?mode=editor&method=sendmsg&m="+id;
    }
</script>
<?

echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<form method="post" action="index.php?mode=sendmsg&method=search">
			<table width="100%">
				<tr>
					<td class="optionsbar_menus" width="100%"><nobr><font size="+1">'.$lang['send_message']['send_private_message'].'</font></nobr></td>
					<td class="optionsbar_menus"><nobr><font color="red" size="+1">'.$lang['send_message']['member_name'].' </font></nobr></td>
					<td class="optionsbar_menus"><nobr><input style="width: 200px" name="search_member" class="only_alpha_num"></nobr></td>
					<td class="optionsbar_menus"><nobr>&nbsp;<input type="submit" value="'.$lang['send_message']['search_member'].'"></nobr></td>
				</tr>
			</table>
<script type="text/javascript" src="./javascript/menu.js"></script>
		</form>
		<table width="100%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10">';
    
    
if ($method == "") {
                echo'
                <br><br>'.$lang['send_message']['insert_letter_to_up_field_and_click_here'].'<br><br>
				<a href="index.php?mode=sendmsg&method=mod">'.$lang['send_message']['or_click_here_to_send_pm_to_moderate'].'</a><br><br>&nbsp;';
}


if ($method == "search") {

$search_member = HtmlSpecialchars(DBi::$con->real_escape_string($_POST['search_member']));

if ($search_member == "") {
   echo'<br><br>'.$lang['send_message']['non_name'].'<br><br>';
}
else {

  $S_M = @DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE M_NAME LIKE '%$search_member%' AND M_STATUS = '1' AND M_HOLDED = '0' AND M_LEVEL = '1' ") or die (DBi::$con->error);
  $S_Mnum = @mysqli_num_rows($S_M);

  if ($S_Mnum == 0) {
        echo'<br><br>'.$lang['send_message']['this_name_non'].'<br><br>';
  }
  else {
                echo'
				<br><font color="red"><u>'.$lang['send_message']['please_choose_one_name'].'</u><br><br>&nbsp;
                <table cellPadding="6" border="1">
                  <tr>';

    $i=0;
    while ($i < $S_Mnum) {

        $SM_MemberID = @mysqli_result($S_M, $i, "MEMBER_ID");
        $SM_MemberName = @mysqli_result($S_M, $i, "M_NAME");


       echo '<td align="center"><nobr><a href="javascript:send_msg('.$SM_MemberID.');">'.$SM_MemberName.'</a></nobr></td>';
            if ($i % 2) {
               echo '</tr><tr>';
            }
    $i++;
    }
               echo'
                  </tr>
                </table><br><br>';
  }
}
}
if ($method == "mod") {


  $Forum = @DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE F_STATUS = '1' ") or die (DBi::$con->error);
  $F_num = @mysqli_num_rows($Forum);

  if ($F_num == 0) {
        echo'<br><br>'.$lang['send_message']['non_forum'].'<br><br>';
  }
  else {
                echo'
				<br><font color="red"><u>'.$lang['send_message']['please_choose_one_name'].'</u><br><br>&nbsp;
                <table cellPadding="6" border="1" width="30%"><tr><td align="center"><font color="red">'.$lang['send_message']['forum_list'].'</font></td></tr></table><br>
                <table cellPadding="6" border="1"><tr>';

    $i=0;
    while ($i < $F_num) {

        $F_ForumID = @mysqli_result($Forum, $i, "FORUM_ID");
        $F_ForumSubject = @mysqli_result($Forum, $i, "F_SUBJECT");
        $F_ForumLevel = @mysqli_result($Forum, $i, "F_LEVEL");
        $F_ForumHide = @mysqli_result($Forum, $i, "F_HIDE");
$check_forum_login = check_forum_login($F_ForumID);
$F_CatID = @mysqli_result($Forum, $i, "CAT_ID");
$C_CatLevel = cat("LEVEL", $F_CatID);
$C_CatHide = cat("HIDE", $F_CatID);
$check_cat_login = check_cat_login($F_CatID);

  		if ($C_CatLevel == 0 OR $C_CatLevel > 0 AND $C_CatLevel <= $Mlevel) {
		if ($C_CatHide == 0 OR $C_CatHide == 1 AND $check_cat_login == 1) {
           if ($F_ForumLevel == 0 OR $F_ForumLevel > 0 AND $F_ForumLevel <= $Mlevel){
			if ($F_ForumHide == 0 OR $F_ForumHide == 1 AND $check_forum_login == 1){	
       echo '<td align="center"><nobr><a href="javascript:send_msg(-'.$F_ForumID.');">'.$F_ForumSubject.'</a></nobr></td>';
}
}           
		}
		}
		   if ($i % 2) {
               echo '</tr><tr>';
            
		   }
    $i++;
    }
               echo'
                </tr></table><br><br>';
  }
  
  $Mod = @DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE M_LEVEL = '2' AND M_STATUS = '1' ") or die (DBi::$con->error);
  $M_num = @mysqli_num_rows($Mod);

  if ($M_num == 0) {
        echo'<br><br>'.$lang['send_message']['non_moderator'].'<br><br>';
  }
  else {
                echo'
                <table cellPadding="6" border="1" width="30%"><tr><td align="center"><font color="red">'.$lang['send_message']['moderator_list'].'</font></td></tr></table><br>
                <table cellPadding="6" border="1">
                  <tr>';

    $ii=0;
    while ($ii < $M_num) {

        $M_MemberID = mysqli_result($Mod, $ii, "MEMBER_ID");
        $M_MemberName = mysqli_result($Mod, $ii, "M_NAME");


       echo '<td align="center"><nobr><a href="javascript:send_msg('.$M_MemberID.');">'.$M_MemberName.'</a></nobr></td>';
            if ($ii % 2) {
               echo '</tr><tr>';
            }
    $ii++;
    }
               echo'
                  </tr>
                </table><br><br>';
  }


}

    $Yesterday = time()-(60*1440);
    
    $TOTAL_MSG = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."PM WHERE PM_MID = '$DBMemberID' AND PM_OUT = '1' AND PM_DATE > '$Yesterday' ") or die (DBi::$con->error);
    $TotalMsg = @mysqli_result($TOTAL_MSG, 0, "count(*)");
if($Mlevel == 1) {
$total_pm_message_all = $total_pm_message;	
}
if($Mlevel > 1) {
$total_pm_message_all = $total_pm_message_m;	
}	
    if($Mlevel == 4) {
$themax = $lang['other']['unlimited'];	
} else {
$themax = $total_pm_message_all;	
}
                echo'
				<table width="100%">
				<table border="1" align="center">
				
					<tr>
						<td bgColor="black" colSpan="2"><font color="white" size="3">&nbsp;'.$lang['send_message']['pm_who_send_in_24_hour'].'&nbsp;</font></td>
					</tr>
					<tr>
						<td><font size="3">'.$lang['send_message']['number_of_pm'].'</font></td>
						<td><font color="red" size="3">'.$TotalMsg.'</font></td>
					</tr>
					<tr>
						<td><font size="3">'.$lang['send_message']['total_pm'].'</font></td>
						<td><font color="red" size="3">'.$themax.'</font></td>
					</tr>
				</table><br><br><br>&nbsp;</table>';

                echo'
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</center>';

?>
