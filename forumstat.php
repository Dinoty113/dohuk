<?php
if (@eregi("modstat.php","$_SERVER[PHP_SELF]")) {
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
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
function forum_stat($forum, $year, $month, $month_number){
	$sql = DBi::$con->query("SELECT SUM(F_POINTS) FROM ".prefix."FORUM_ONLINE WHERE F_ID = '$forum' AND F_YEAR = '$year' AND F_MONTH = '$month' AND F_MONTH_NUMBER = '$month_number' ") or die(DBi::$con->error);
	$num = mysqli_result($sql, 0, "SUM(F_POINTS)");
	return($num);
}

//-------------------------------------------------------//
if ($Mlevel > 1){
	
if($f == "" or $f == 0) {
redirect();	
}
if(allowed($f, 2) == 1) {
if($type == "") {
$type = "lastmonth";
}	
	if($type != "" && $type != "lastmonth" && $type != "activedays" && $type != "week" && $type != "month" && $type != "year") {
	redirect();	
	}
include("svc_menu.php");

echo'
						<center>
		<table>
		<br>	<tr>
				<td class="stats_menu'.chk_cmd($type, "lastmonth", "Sel").'"><a class="stats_menu" href="index.php?mode=forumstat&type=lastmonth&f='.$f.'">'.$lang['forumstat']['lastmonth'].'</a></td>
				<td class="stats_menu'.chk_cmd($type, "activedays", "Sel").'"><a class="stats_menu" href="index.php?mode=forumstat&type=activedays&f='.$f.'">'.$lang['forumstat']['activedays'].'</a></td>
				<td class="stats_menu'.chk_cmd($type, "week", "Sel").'"><a class="stats_menu" href="index.php?mode=forumstat&type=week&f='.$f.'">'.$lang['forumstat']['week'].'</a></td>
				<td class="stats_menu'.chk_cmd($type, "month", "Sel").'"><a class="stats_menu" href="index.php?mode=forumstat&type=month&f='.$f.'">'.$lang['forumstat']['month'].'</a></td>
				<td class="stats_menu'.chk_cmd($type, "year", "Sel").'"><a class="stats_menu" href="index.php?mode=forumstat&type=year&f='.$f.'">'.$lang['forumstat']['year'].'</a></td>
			</tr>
		</table>
';


if($type == "week") {
	

			$time = time() - (60 * 60 * 24 * 7);
			$date = date(" d  M  Y ",$time);

						$thedate = date("d",$time);
							$this_date = date("d");
							$this_month = date("m");
							$this_year = date("Y");
							$month_without_zero = array('01','02','03','04','05','06','07','08','09','10','11','12');
							$month_without_zero_true = array('1','2','3','4','5','6','7','8','9','10','11','12');
							$this_month = str_replace($month_without_zero,$month_without_zero_true,$this_month);

	$thisday = $date ;
	$thisday2 = date(" l d  M  Y ");
	$days_moth_english = array('Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Sunday',
	'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	$days_moth_arab = array($lang['other_new_things']['d_saturday'],$lang['other_new_things']['d_monday'],$lang['other_new_things']['d_tuesday'],$lang['other_new_things']['d_wednesday'],$lang['other_new_things']['d_thursday'],$lang['other_new_things']['d_friday'],$lang['other_new_things']['d_sunday'],
	$lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
	$thisday = str_replace($days_moth_english,$days_moth_arab,$thisday);
	$thisday2 = str_replace($days_moth_english,$days_moth_arab,$thisday2);
//-------------------------------------------------------//

	
	
	
		echo'
			<table border="0" width="100%"  height="209" style="border-width: 0px">
	<br><tr>
		<td width="587" valign="top" style="border-style:none; border-width:medium; ">';
	$show_topic_stat .= '<b>
	<table  dir="rtl" cellSpacing="1" cellPadding="0" align="center">
		<tr>
		<td class="stats_info" colSpan="3"><font color="white">'.$lang['forumstat']['forum_online'].'</font><br> ';
		$show_topic_stat .= '<font color="yellow">'.forums("SUBJECT", $f).'</font>';
		$show_topic_stat .=  '
		
		<br><font color="white" size="-1">'.$thisday.' - '.$thisday2.'</font> </td>
	</tr>
	<tr>
		<td class="stats" colSpan="3"><font color="red">'.$lang['other_things']['dont_share_this_stat'].'</font></td>
	</tr>
	<tr>
		<td class="stats_h" colSpan="2">'.$lang['function']['to_day'].'</td>
		<td class="stats_h">'.$lang['forumstat']['percent'].'</td>
	</tr>';
$sql = DBi::$con->query("SELECT SUM(F_POINTS) FROM ".prefix."FORUM_ONLINE WHERE F_YEAR = '$this_year' AND F_MONTH_NUMBER = '$this_month' AND F_DAY_NUMBER <= $this_date AND F_DAY_NUMBER >= $thedate") or die(DBi::$con->error);
$num = ceil(mysqli_result($sql, 0, "SUM(F_POINTS)"));
$sqll = DBi::$con->query("SELECT * FROM ".prefix."FORUM_ONLINE WHERE F_ID = '$f' AND F_YEAR = '$this_year' AND F_MONTH_NUMBER = '$this_month' AND F_DAY_NUMBER <= $this_date AND F_DAY_NUMBER >= $thedate ORDER BY ID DESC LIMIT 7");
$numm = mysqli_num_rows($sqll) or die (
	$show_topic_stat.'
	<tr>
		<td class="stats_p"  height="30" colspan="5" align="center"> <font color="#FF0000" > '.$lang['other_things']['no_stats'].' </font></td>
	
	</tr>

	');
$xx = 0;

while($xx < $numm) {
			$time = time() - (60 * 60 * 24 * 7);
			$date = date(" l d  M  Y ",$time);
$day = mysqli_result($sqll, $xx, "F_DAY");
$day_number = mysqli_result($sqll, $xx, "F_DAY_NUMBER");
$month = mysqli_result($sqll, $xx, "F_MONTH");
$month_number = mysqli_result($sqll, $xx, "F_MONTH_NUMBER");
$year = mysqli_result($sqll, $xx, "F_YEAR");
$points = mysqli_result($sqll, $xx, "F_POINTS");
$days_moth_english = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$days_moth_arab = array($lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
$thisday2 = str_replace($days_moth_english,$days_moth_arab,$month);
$days_english = array('Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Sunday');
$days_arab = array($lang['other_new_things']['d_saturday'],$lang['other_new_things']['d_monday'],$lang['other_new_things']['d_tuesday'],$lang['other_new_things']['d_wednesday'],$lang['other_new_things']['d_thursday'],$lang['other_new_things']['d_friday'],$lang['other_new_things']['d_sunday']);
$thisday = str_replace($days_english,$days_arab,$day);

	$pers = ceil(($points * 100) / $num);
	if($pers >= 100) {
	$pers = 100;
	$width = 99;
	}
	if($pers < 100) {
	$width = $pers;
	}
	if($day_number == $this_date) {
	$img = $icon_pers_now;	
	} else {
	$img = $icon_pers_before;	
	}
	$show_topic_stat .= '
		<tr>
		<td class="stats_p"><nobr><font color="red"><center>'.$thisday.'</center></font></nobr></td>
		<td class="stats_g"><center>'.$day_number.' '.$thisday2.' '.$year.'</center></td>
		<td class="stats_graph"><center><img src="'.$img.'" width="'.$width.'%" title = "'.$pers.'%" style="height:10px"></center></td>
	</tr>	
	';

++$xx;
}



	$show_topic_stat .= '
	<tr>
<td colSpan="3" class="stats">'.$lang['forumstat']['stats_from'].' '.$create_forum_day."&nbsp;".$create_forum_month."&nbsp;".$create_forum_date.'
</td>
</tr></table><br></tr></table>';
	echo ''.$show_topic_stat;
	
}

if($type == "month") {
	
			$time = time() - (60 * 60 * 24 * 30);
			$date = date(" d  M  Y ",$time);
					$thedate = date("d",$time);
							$this_date = date("d");
							$this_month = date("m");
							$this_year = date("Y");							
							$month_without_zero = array('01','02','03','04','05','06','07','08','09','10','11','12');
							$month_without_zero_true = array('1','2','3','4','5','6','7','8','9','10','11','12');
							$this_month = str_replace($month_without_zero,$month_without_zero_true,$this_month);

	$thisday = $date ;
	$thisday2 = date(" d  M  Y ");
	$days_moth_english = array(
	'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	$days_moth_arab = array($lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
	$thisday = str_replace($days_moth_english,$days_moth_arab,$thisday);
	$thisday2 = str_replace($days_moth_english,$days_moth_arab,$thisday2);
//-------------------------------------------------------//

	
	
	
		echo'
			<table border="0" width="100%"  height="209" style="border-width: 0px">
	<br><tr>
		<td width="587" valign="top" style="border-style:none; border-width:medium; ">';
	$show_topic_stat .= '<b>
	<table  dir="rtl" cellSpacing="1" cellPadding="0" align="center">
		<tr>
		<td class="stats_info" colSpan="3"><font color="white">'.$lang['forumstat']['forum_online'].'</font><br> ';
		$show_topic_stat .= '<font color="yellow">'.forums("SUBJECT", $f).'</font>';
		$show_topic_stat .=  '
		
		<br><font color="white" size="-1">'.$thisday.' - '.$thisday2.'</font> </td>
	</tr>
	<tr>
		<td class="stats" colSpan="3"><font color="red">'.$lang['other_things']['dont_share_this_stat'].'</font></td>
	</tr>
	<tr>
		<td class="stats_h" colSpan="2">'.$lang['function']['to_day'].'</td>
		<td class="stats_h">'.$lang['forumstat']['percent'].'</td>
	</tr>';
$sql = DBi::$con->query("SELECT SUM(F_POINTS) FROM ".prefix."FORUM_ONLINE WHERE F_YEAR = '$this_year' AND F_MONTH_NUMBER = '$this_month'") or die(DBi::$con->error);
$num = ceil(mysqli_result($sql, 0, "SUM(F_POINTS)"));
$sqll = DBi::$con->query("SELECT * FROM ".prefix."FORUM_ONLINE WHERE F_ID = '$f' AND F_YEAR = '$this_year' AND F_MONTH_NUMBER = '$this_month' ORDER BY ID DESC LIMIT 30");
$numm = mysqli_num_rows($sqll) or die (
	$show_topic_stat.'
	<tr>
		<td class="stats_p"  height="30" colspan="5" align="center"> <font color="#FF0000" > '.$lang['other_things']['no_stats'].' </font></td>
	
	</tr>

	');
$xx = 0;

while($xx < $numm) {
			$time = time() - (60 * 60 * 24 * 30);
			$date = date(" l d  M  Y ",$time);
$day = mysqli_result($sqll, $xx, "F_DAY");
$day_number = mysqli_result($sqll, $xx, "F_DAY_NUMBER");
$month = mysqli_result($sqll, $xx, "F_MONTH");
$month_number = mysqli_result($sqll, $xx, "F_MONTH_NUMBER");
$year = mysqli_result($sqll, $xx, "F_YEAR");
$points = mysqli_result($sqll, $xx, "F_POINTS");
$days_moth_english = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$days_moth_arab = array($lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
$thisday2 = str_replace($days_moth_english,$days_moth_arab,$month);
$days_english = array('Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Sunday');
$days_arab = array($lang['other_new_things']['d_saturday'],$lang['other_new_things']['d_monday'],$lang['other_new_things']['d_tuesday'],$lang['other_new_things']['d_wednesday'],$lang['other_new_things']['d_thursday'],$lang['other_new_things']['d_friday'],$lang['other_new_things']['d_sunday']);
$thisday = str_replace($days_english,$days_arab,$day);

	$pers = ceil(($points * 100) / $num);
	if($pers >= 100) {
	$pers = 100;
	$width = 99;
	}
	if($pers < 100) {
	$width = $pers;
	}
	if($day_number == $this_date) {
	$img = $icon_pers_now;	
	} else {
	$img = $icon_pers_before;	
	}
	$show_topic_stat .= '
		<tr>
		<td class="stats_p"><nobr><font color="red"><center>'.$thisday.'</center></font></nobr></td>
		<td class="stats_g"><center>'.$day_number.' '.$thisday2.' '.$year.'</center></td>
		<td class="stats_graph"><center><img src="'.$img.'" width="'.$width.'%" title = "'.$pers.'%" style="height:10px"></center></td>
	</tr>	
	';

++$xx;
}



	$show_topic_stat .= '
	<tr>
<td colSpan="3" class="stats">'.$lang['forumstat']['stats_from'].' '.$create_forum_day."&nbsp;".$create_forum_month."&nbsp;".$create_forum_date.'
</td>
</tr></table><br></tr></table>';
	echo ''.$show_topic_stat;
	
}

if($type == "year") {
	
			$time = time() - (60 * 60 * 24 * 365);
			$date = date(" d  M  Y ",$time);
					$thedate = date("d",$time);
							$this_date = date("d");
							$this_month = date("m");
							$this_year = date("Y");							
							$month_without_zero = array('01','02','03','04','05','06','07','08','09','10','11','12');
							$month_without_zero_true = array('1','2','3','4','5','6','7','8','9','10','11','12');
							$this_month = str_replace($month_without_zero,$month_without_zero_true,$this_month);

	$thisday = $date ;
	$thisday2 = date(" d  M  Y ");
	$days_moth_english = array(
	'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	$days_moth_arab = array($lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
	$thisday = str_replace($days_moth_english,$days_moth_arab,$thisday);
	$thisday2 = str_replace($days_moth_english,$days_moth_arab,$thisday2);
//-------------------------------------------------------//

	
	
	
		echo'
			<table border="0" width="100%"  height="209" style="border-width: 0px">
	<br><tr>
		<td width="587" valign="top" style="border-style:none; border-width:medium; ">';
	$show_topic_stat .= '<b>
	<table  dir="rtl" cellSpacing="1" cellPadding="0" align="center">
		<tr>
		<td class="stats_info" colSpan="3"><font color="white">'.$lang['forumstat']['forum_online'].'</font><br> ';
		$show_topic_stat .= '<font color="yellow">'.forums("SUBJECT", $f).'</font>';
		$show_topic_stat .=  '
		
		<br><font color="white" size="-1">'.$thisday.' - '.$thisday2.'</font> </td>
	</tr>
	<tr>
		<td class="stats" colSpan="3"><font color="red">'.$lang['other_things']['dont_share_this_stat'].'</font></td>
	</tr>
	<tr>
		<td class="stats_h" colSpan="2">'.$lang['function']['to_day'].'</td>
		<td class="stats_h">'.$lang['forumstat']['percent'].'</td>
	</tr>';
$sql = DBi::$con->query("SELECT SUM(F_POINTS) FROM ".prefix."FORUM_ONLINE WHERE F_YEAR = '$this_year'") or die(DBi::$con->error);
$num = ceil(mysqli_result($sql, 0, "SUM(F_POINTS)"));
$sqll = DBi::$con->query("SELECT * FROM ".prefix."FORUM_ONLINE WHERE F_ID = '$f' AND F_YEAR = '$this_year' ORDER BY ID DESC LIMIT 365");
$numm = mysqli_num_rows($sqll) or die (
	$show_topic_stat.'
	<tr>
		<td class="stats_p"  height="30" colspan="5" align="center"> <font color="#FF0000" > '.$lang['other_things']['no_stats'].' </font></td>
	
	</tr>

	');
	$xx = 0;

while($xx < $numm) {
			$time = time() - (60 * 60 * 24 * 365);
			$date = date(" l d  M  Y ",$time);
$day = mysqli_result($sqll, $xx, "F_DAY");
$day_number = mysqli_result($sqll, $xx, "F_DAY_NUMBER");
$month = mysqli_result($sqll, $xx, "F_MONTH");
$month_number = mysqli_result($sqll, $xx, "F_MONTH_NUMBER");
$year = mysqli_result($sqll, $xx, "F_YEAR");
$points = mysqli_result($sqll, $xx, "F_POINTS");
$days_moth_english = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$days_moth_arab = array($lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
$thisday2 = str_replace($days_moth_english,$days_moth_arab,$month);
$days_english = array('Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Sunday');
$days_arab = array($lang['other_new_things']['d_saturday'],$lang['other_new_things']['d_monday'],$lang['other_new_things']['d_tuesday'],$lang['other_new_things']['d_wednesday'],$lang['other_new_things']['d_thursday'],$lang['other_new_things']['d_friday'],$lang['other_new_things']['d_sunday']);
$thisday = str_replace($days_english,$days_arab,$day);

	$pers = ceil(($points * 100) / $num);
	if($pers >= 100) {
	$pers = 100;
	$width = 99;
	}
	if($pers < 100) {
	$width = $pers;
	}
	if($day_number == $this_date) {
	$img = $icon_pers_now;	
	} else {
	$img = $icon_pers_before;	
	}
	$show_topic_stat .= '
		<tr>
		<td class="stats_p"><nobr><font color="red"><center>'.$thisday.'</center></font></nobr></td>
		<td class="stats_g"><center>'.$day_number.' '.$thisday2.' '.$year.'</center></td>
		<td class="stats_graph"><center><img src="'.$img.'" width="'.$width.'%" title = "'.$pers.'%" style="height:10px"></center></td>
	</tr>	
	';

++$xx;
}



	$show_topic_stat .= '
	<tr>
<td colSpan="3" class="stats">'.$lang['forumstat']['stats_from'].' '.$create_forum_day."&nbsp;".$create_forum_month."&nbsp;".$create_forum_date.'
</td>
</tr></table><br></tr></table>';
	echo ''.$show_topic_stat;
	
}

if($type == "activedays") {
	

	$this_date = date("d");

	
	
		echo'
			<table border="0" width="100%"  height="209" style="border-width: 0px">
	<br><tr>
		<td width="587" valign="top" style="border-style:none; border-width:medium; ">';
	$show_topic_stat .= '<b>
	<table  dir="rtl" cellSpacing="1" cellPadding="0" align="center">
		<tr>
		<td class="stats_info" colSpan="3"><font color="white">'.$lang['forumstat']['forum_online'].'</font><br> ';
		$show_topic_stat .= '<font color="yellow">'.forums("SUBJECT", $f).'</font>';
		$show_topic_stat .=  '
		
		<br><font color="white" size="-1">'.$lang['forumstat']['activedays'].'</font> </td>
	</tr>
	<tr>
		<td class="stats" colSpan="3"><font color="red">'.$lang['other_things']['dont_share_this_stat'].'</font></td>
	</tr>
	<tr>
		<td class="stats_h" colSpan="2">'.$lang['function']['to_day'].'</td>
		<td class="stats_h">'.$lang['forumstat']['percent'].'</td>
	</tr>';
$sql = DBi::$con->query("SELECT SUM(F_POINTS) FROM ".prefix."FORUM_ONLINE WHERE F_POINTS >= 50") or die(DBi::$con->error);
$num = ceil(mysqli_result($sql, 0, "SUM(F_POINTS)"));
$sqll = DBi::$con->query("SELECT * FROM ".prefix."FORUM_ONLINE WHERE F_ID = '$f' AND F_POINTS >= 50 ORDER BY ID DESC");
$numm = mysqli_num_rows($sqll) or die (
	$show_topic_stat.'
	<tr>
		<td class="stats_p"  height="30" colspan="5" align="center"> <font color="#FF0000" > '.$lang['other_things']['no_stats'].' </font></td>
	
	</tr>

	');
$xx = 0;

while($xx < $numm) {
$day = mysqli_result($sqll, $xx, "F_DAY");
$day_number = mysqli_result($sqll, $xx, "F_DAY_NUMBER");
$month = mysqli_result($sqll, $xx, "F_MONTH");
$month_number = mysqli_result($sqll, $xx, "F_MONTH_NUMBER");
$year = mysqli_result($sqll, $xx, "F_YEAR");
$points = mysqli_result($sqll, $xx, "F_POINTS");
$days_moth_english = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$days_moth_arab = array($lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
$thisday2 = str_replace($days_moth_english,$days_moth_arab,$month);
$days_english = array('Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Sunday');
$days_arab = array($lang['other_new_things']['d_saturday'],$lang['other_new_things']['d_monday'],$lang['other_new_things']['d_tuesday'],$lang['other_new_things']['d_wednesday'],$lang['other_new_things']['d_thursday'],$lang['other_new_things']['d_friday'],$lang['other_new_things']['d_sunday']);
$thisday = str_replace($days_english,$days_arab,$day);

	$pers = ceil(($points * 100) / $num);
	if($pers >= 100) {
	$pers = 100;
	$width = 99;
	}
	if($pers < 100) {
	$width = $pers;
	}
	if($day_number == $this_date) {
	$img = $icon_pers_now;	
	} else {
	$img = $icon_pers_before;	
	}
	$show_topic_stat .= '
		<tr>
		<td class="stats_p"><nobr><font color="red"><center>'.$thisday.'</center></font></nobr></td>
		<td class="stats_g"><center>'.$day_number.' '.$thisday2.' '.$year.'</center></td>
		<td class="stats_graph"><center><img src="'.$img.'" width="'.$width.'%" title = "'.$pers.'%" style="height:10px"></center></td>
	</tr>	
	';

++$xx;
}



	$show_topic_stat .= '
	<tr>
<td colSpan="3" class="stats">'.$lang['forumstat']['stats_from'].' '.$create_forum_day."&nbsp;".$create_forum_month."&nbsp;".$create_forum_date.'
</td>
</tr></table><br></tr></table>';
	echo ''.$show_topic_stat;
	
}

if($type == "lastmonth") {

$this_month = date("m");
	
		echo'
			<table border="0" width="100%"  height="209" style="border-width: 0px">
	<br><tr>
		<td width="587" valign="top" style="border-style:none; border-width:medium; ">';
	$show_topic_stat .= '<b>
	<table  dir="rtl" cellSpacing="1" cellPadding="0" align="center">
		<tr>
		<td class="stats_info" colSpan="3"><font color="white">'.$lang['forumstat']['forum_online'].'</font><br> ';
		$show_topic_stat .= '<font color="yellow">'.forums("SUBJECT", $f).'</font>';
		$show_topic_stat .=  '
		
		<br><font color="white" size="-1">'.$lang['forumstat']['lastmonth'].'</font> </td>
	</tr>
	<tr>
		<td class="stats" colSpan="3"><font color="red">'.$lang['other_things']['dont_share_this_stat'].'</font></td>
	</tr>
	<tr>
		<td class="stats_h">'.$lang['function']['to_day'].'</td>
		<td class="stats_h">'.$lang['forumstat']['percent'].'</td>
	</tr>';
$sqlll = DBi::$con->query("SELECT DISTINCT F_MONTH_NUMBER FROM ".prefix."FORUM_ONLINE");
while($rs = mysqli_fetch_array($sqlll)) {
$month = $rs['F_MONTH_NUMBER'];
}
$sql = DBi::$con->query("SELECT SUM(F_POINTS) FROM ".prefix."FORUM_ONLINE WHERE F_MONTH_NUMBER = '$month'") or die(DBi::$con->error);
$num = ceil(mysqli_result($sql, 0, "SUM(F_POINTS)"));
$sqll = DBi::$con->query("SELECT DISTINCT F_ID, F_MONTH_NUMBER, F_MONTH, F_YEAR FROM ".prefix."FORUM_ONLINE WHERE F_ID = '$f' ORDER BY ID DESC");
$numm = mysqli_num_rows($sqll) or die (
	$show_topic_stat.'
	<tr>
		<td class="stats_p"  height="30" colspan="5" align="center"> <font color="#FF0000" > '.$lang['other_things']['no_stats'].' </font></td>
	
	</tr>

	');
while($rs = mysqli_fetch_array($sqll)) {
$month = $rs['F_MONTH'];
$month_number = $rs['F_MONTH_NUMBER'];
$year = $rs['F_YEAR'];
$forum = $rs['F_ID'];
$points = forum_stat($forum, $year, $month, $month_number);
$days_moth_english = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$days_moth_arab = array($lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
$thisday2 = str_replace($days_moth_english,$days_moth_arab,$month);

	$pers = ceil(($points * 100) / $num);
	if($pers >= 100) {
	$pers = 100;
	$width = 99;
	}
	if($pers < 100) {
	$width = $pers;
	}
	if($month_number == $this_month) {
	$img = $icon_pers_now;	
	} else {
	$img = $icon_pers_before;	
	}
	$show_topic_stat .= '
		<tr>
		<td class="stats_g"><center>'.$thisday2.' '.$year.'</center></td>
		<td class="stats_graph"><center><img src="'.$img.'" width="'.$width.'%" title = "'.$pers.'%" style="height:10px"></center></td>
	</tr>	
	';

}



	$show_topic_stat .= '
	<tr>
<td colSpan="3" class="stats">'.$lang['forumstat']['stats_from'].' '.$create_forum_day."&nbsp;".$create_forum_month."&nbsp;".$create_forum_date.'
</td>
</tr></table><br></tr></table>';
	echo ''.$show_topic_stat;
	
}

} else {
redirect();	
}

} else {
redirect();	
}

?>