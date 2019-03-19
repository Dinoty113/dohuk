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

if ($Mlevel == 4) {

	  
	if($id == 1 && members("LEVEL", $id) == 4) {
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
	 
														
$ppMemberID = $id;
$Name = link_profile(member_name($id), $id);



    $TOTAL_OUT = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."PM WHERE PM_MID = '$ppMemberID' AND PM_OUT = '1'") or die (DBi::$con->error);
    $TotalPM_OUT = @mysqli_result($TOTAL_OUT , 0, "count(*)");



    $TOTAL_TOP = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."TOPICS WHERE T_AUTHOR = '$ppMemberID' ") or die (DBi::$con->error);
    $TotalTOP = @mysqli_result($TOTAL_TOP , 0, "count(*)");

    $TOTAL_TOPH = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."TOPICS WHERE T_AUTHOR = '$ppMemberID' AND T_HIDDEN = 1  ") or die (DBi::$con->error);
    $TotalTOPH = @mysqli_result($TOTAL_TOPH , 0, "count(*)");

    $TOTAL_TOPUN = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."TOPICS WHERE T_AUTHOR = '$ppMemberID' AND T_HOLDED= 1  ") or die (DBi::$con->error);
    $TotalTOPUN = @mysqli_result($TOTAL_TOPUN , 0, "count(*)");

    $TOTAL_TOP2 = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."TOPICS WHERE T_AUTHOR = '$ppMemberID' AND T_TOP > 0  ") or die (DBi::$con->error);
    $TotalTOP2 = @mysqli_result($TOTAL_TOP2 , 0, "count(*)");



    $TOTAL_RP = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."REPLY WHERE R_AUTHOR = '$ppMemberID' ") or die (DBi::$con->error);
    $TotalRP = @mysqli_result($TOTAL_RP , 0, "count(*)");

    $TOTAL_RPH = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."REPLY WHERE R_AUTHOR = '$ppMemberID' AND R_HIDDEN = 1  ") or die (DBi::$con->error);
    $TotalRPH = @mysqli_result($TOTAL_RPH , 0, "count(*)");


    $TOTAL_RUN = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."REPLY WHERE R_AUTHOR = '$ppMemberID' AND R_HOLDED = 1  ") or die (DBi::$con->error);
    $TotalRPUN = @mysqli_result($TOTAL_RUN , 0, "count(*)");

    $TOTAL_N = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."NOTIFY WHERE AUTHOR_ID = '$ppMemberID'  ") or die (DBi::$con->error);
    $TotalN = @mysqli_result($TOTAL_N , 0, "count(*)");




echo '
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr  align="center">
		<td>
		<table class="optionsbar" cellSpacing="2" width="100%" border="0">
			<tr>
				<td vAlign="center"></td>
				<td class="optionsbar_title" vAlign="center" width="100%"><img hspace="7" border="0" src="'.$icon_profile.'">'.$lang['others']['member_stat'].' :  '.$Name.'</td>
';
refresh_time();
            go_to_forum();
echo'
				<div align="center">

				<table bgcolor="gray"  class="grid" cellSpacing="1" cellPadding="1" width="100%" border="0" >
				 	</td>
					</tr>


 	<td class="fixed" align="middle" colSpan="2"><b><font size="3">'.$lang['profile']['member_details_g'].'</font></b></td>
                    <tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_pm_out'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalPM_OUT.'</font></td>
                    <tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_notify'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalN.'</font></td>
					</tr>
					
<td class="fixed" align="middle" colSpan="2"><b><font size="3">'.$lang['profile']['member_details_top'].'</font></b></td>
					</tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_topic'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalTOP.'</font></td>
                    <tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_topic_hide'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalTOPH.'</font></td>
                    <tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_topic_un'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalTOPUN.'</font></td>
                    <tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_topic_2'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalTOP2.'</font></td>
                    <tr>


<td class="fixed" align="middle" colSpan="2"><b><font size="3">'.$lang['profile']['member_details_rp'].'</font></b></td>
					</tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_all_rp'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalRP.'</font></td>
                    <tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_rp_hide'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalRPH.'</font></td>
                    <tr>
<td class="userdetails_title" vAlign="top" noWrap align="left"><b><font size="3">'.$lang['profile']['member_details_rp_un'].'</font></b></td>
<td class="userdetails_data" width="100%"><font size="3">'.$TotalRPUN.'</font></td>
						';
}
	else {
		redirect();
	}
?>