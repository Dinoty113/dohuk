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

$self = 'modstat';
$num = intval(trim($_GET['num']));
$method = trim($_GET['method']);
$type = trim($_GET['type']);
$get_u_mlv = intval(trim($_GET['mlv']));
$get_u_dep = intval(trim($_GET['dep']));
$limit = intval(trim($_GET['limit']));
$f = intval(trim($_GET['f']));
	if($get_u_mlv == '' or $get_u_mlv == 0){
		$level_text = $lang['add_cat_forum']['moderators'];
	}elseif($get_u_mlv == 2){
		$level_text = $lang['add_cat_forum']['moderators'];
	}elseif($get_u_mlv == 3 && $get_u_dep == 0){
		$level_text = $lang['add_cat_forum']['monitors'];
	}elseif($get_u_mlv == 3 && $get_u_dep == 1){
		$level_text = $lang['other_things']['deputy_monitor'];
	}	
	elseif($get_u_mlv == 4){
		$level_text = $lang['add_cat_forum']['admins'];
	}
	
if($get_u_mlv == '' or $get_u_mlv == 0) {
$get_u_mlv = 2;	
}	
//-------------------------------------------------------//
if ($Mlevel > 2){
	
include("svc_menu.php");

	
	if($method == "heur"){
		if($num == "" or $num == 24 or $num == 0 or $num >= 24 ){
			$time = time() - (60 * 60 * 24);
			$date = date(" l d  M  Y ",$time);
			$title = $lang['other_things']['in_24'];
		}else{
			$time = time() - (60 * 60 * $num);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$num." ".$lang['other_things']['hour']."";
		}
	}elseif($method == "min"){
		if($num == "" or $num == 60 or $num == 0 or $num >= 60 ){
			$time = time() - (60 * 60 );
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." 1 ".$lang['other_things']['minute']."";
		}else{
			$time = time() - (60 * $num);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$num." ".$lang['other_things']['minute']."";
		}
	}elseif($method == "week"){
		if($num == "" or $num == 0 ){
			$time = time() - (60 * 60 * 24 * 7 );
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$lang['other_things']['week']."";
		}else{
			$time = time() - (60 * 60 * 24 * 7 * $num);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$num." ".$lang['other_things']['week']."";
		}
	}elseif($method == "day"){
		if($num == "" or $num == 30 or $num == 0 or $num >= 30){
			$time = time() - (60 * 60 * 24 * 30);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." 30 ".$lang['other_things']['day']."";
		}elseif($num == 7){
			$time = time() - (60 * 60 * 24 * 7);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$lang['other_things']['week']."";
		}else{
			$num = $num;
			$time = time() - (60 * 60 * 24 * $num);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$num." ".$lang['other_things']['day']."";
		}
	}elseif($method == "month" ){
		if($num == "" or $num == 12 or $num == 0 or $num >= 12){
			$time = time() - (60 * 60 * 24 * 30 * 12);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$lang['other_things']['month']."";
		}else{
			$time = time() - (60 * 60 * 24 * 30 * $num);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$num." ".$lang['other_things']['month']."";
		}
	}elseif($method == "year" ){
		if($num == "" or $num == 12 or $num == 0 ){
			$time = time() - (60 * 60 * 24 * 30 * 12);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$lang['other_things']['year']."";
		}else{
			$time = time() - (60 * 60 * 24 * 30 * $num);
			$date = date(" l d  M  Y ",$time);
			$title = "".$lang['other_things']['in']." ".$num." ".$lang['other_things']['year']."";
		}
	}else{
		$time = time() - (60 * 60 * 24);
		$date = date(" l d  M  Y ",$time);
		$title = "".$lang['other_things']['in']." 24 ".$lang['other_things']['hour']."";
	}

	$thisday = $date ;
	$thisday2 = date(" l d  M  Y ");
	$days_moth_english = array('Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Sunday',
	'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	$days_moth_arab = array($lang['other_new_things']['d_saturday'],$lang['other_new_things']['d_monday'],$lang['other_new_things']['d_tuesday'],$lang['other_new_things']['d_wednesday'],$lang['other_new_things']['d_thursday'],$lang['other_new_things']['d_friday'],$lang['other_new_things']['d_sunday'],
	$lang['other_new_things']['m_january'],$lang['other_new_things']['m_february'],$lang['other_new_things']['m_march'],$lang['other_new_things']['m_april'],$lang['other_new_things']['m_may'],$lang['other_new_things']['m_june'],$lang['other_new_things']['m_july'],$lang['other_new_things']['m_augest'],$lang['other_new_things']['m_september'],$lang['other_new_things']['m_october'],$lang['other_new_things']['m_november'],$lang['other_new_things']['m_december']);
	$thisday = str_replace($days_moth_english,$days_moth_arab,$thisday);
	$thisday2 = str_replace($days_moth_english,$days_moth_arab,$thisday2);
//-------------------------------------------------------//
	if($method == "year" ){
		$method_select = $lang['other_things']['year'];
	}elseif($method == "month"){
		$method_select = $lang['other_things']['month'];
	}elseif($method == "day"){
		$method_select = $lang['other_things']['days'];
	}elseif($method == "heur"){
		$method_select = $lang['other_things']['hour'];
	}elseif($method == "min"){
		$method_select = $lang['other_things']['minute'];
	}elseif($method == "week"){
		$method_select = $lang['other_things']['week'];
	}
	if($limit != '' or $limit != 0){
	$limit_sql = " LIMIT $limit ";
	}else{
	$limit_sql = '';
	}
	if($get_u_mlv == 3 && $get_u_dep == 1) {
	$checked = "selected";	
	$check = "";	
	}
	if($get_u_mlv == 3 && $get_u_dep == 0) {
	$checked = "";	
	$check = check_select($get_u_mlv, 3);	
	}	
	
	
	
			echo'
						<center>
		<table>
		<br>	<tr>
				<td class="stats_menu'.chk_cmd($mode, "stat", "Sel").'"><a class="stats_menu" href="index.php?mode=stat">'.$lang['other_things']['topstat'].'</a></td>
				<td class="stats_menu'.chk_cmd($mode, "modstat", "Sel").'"><a class="stats_menu" href="index.php?mode=modstat">'.$lang['other_things']['online_points_stat'].'</a></td>
			</tr>
		</table>
	<table border="0" width="100%"  height="209" style="border-width: 0px">
	<br><tr>
		<td vAlign="top" style="border-style:none; border-width:medium; ">
		<table height="101" cellSpacing="1" cellPadding="0" width="394" align="center" id="table1">
	<tr>
		<td class="optionsbar_menus" height="30" width="379" colspan="3">
		 <p align="center">
		 <font color="red" size="+1"><b>'.$lang['other_things']['online_points_stat'].'</b></font></td>
	</tr>
	<tr class="fixed">
		<td class="optionheader_selected" height="30" width="195">
		 '.$lang['other_things']['num_result'].'</td>
		<td class="list" colspan="2" align="right" width="184" height="30">
		<b>	<select style="WIDTH: 65; height:22" onchange="window.location = this.value" name="speed_tools" size="1">
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=" '.check_select($limit ,'').'>  '.$lang['profile']['no_selected'].' </option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=1" '.check_select($limit ,1).'>1</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=2" '.check_select($limit ,2).'>2</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=3" '.check_select($limit ,3).'>3</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=4" '.check_select($limit ,4).'>4</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=5" '.check_select($limit ,5).'>5</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=6" '.check_select($limit ,6).'>6</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=7" '.check_select($limit ,7).'>7</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=8" '.check_select($limit ,8).'>8</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=9" '.check_select($limit ,9).'>9</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=10" '.check_select($limit ,10).'>10</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=20" '.check_select($limit ,20).'>20</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=30" '.check_select($limit ,30).'>30</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=40" '.check_select($limit ,40).'>40</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=50" '.check_select($limit ,50).'>50</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=60" '.check_select($limit ,60).'>60</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=70" '.check_select($limit ,70).'>70</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=80" '.check_select($limit ,80).'>80</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=90" '.check_select($limit ,90).'>90</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&limit=100" '.check_select($limit ,100).'>100</option>
		</select></b></td>
	</tr>
	<tr class="fixed">
		<td class="optionheader_selected" height="30" width="195">
		 '.$lang['profile']['the_rank'].'</td>
		<td class="list" colspan="2" align="right" width="184" height="30">
		<b>	<select style="WIDTH: 90; height:22" onchange="window.location = this.value" name="speed_tools" size="1">
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv=2&dep=0" '.check_select($get_u_mlv ,2).'>'.$lang['add_cat_forum']['moderators'].'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv=3&dep=0" '.$check.'>'.$lang['add_cat_forum']['monitors'].'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv=3&dep=1" '.$checked.'>'.$lang['admin']['deputy_monitors'].'</option>';
		if($Mlevel == 4) {
			echo'
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv=4&dep=0" '.check_select($get_u_mlv ,4).'>'.$lang['add_cat_forum']['admins'].'</option>
		';
		}
		echo'</select></b></td>
	</tr>
	<tr class="fixed">
		<td class="optionheader_selected" height="40" width="195">
		'.$lang['other_things']['show_stat'].'</td>
		<td class="list" align="right" width="90" height="40">
		<b>

		<select style="WIDTH: 80; height:22" onchange="window.location = this.value" name="speed_tools8" size="1">
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ," ").'>  '.$lang['profile']['no_selected'].' </option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=1&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,1).'> '.$lang['other_things']['in'].' 1 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=2&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,2).'> '.$lang['other_things']['in'].' 2 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=3&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,3).'> '.$lang['other_things']['in'].' 3 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=4&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,4).'> '.$lang['other_things']['in'].' 4 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=5&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,5).'> '.$lang['other_things']['in'].' 5 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=6&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,6).'> '.$lang['other_things']['in'].' 6 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=7&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,7).'> '.$lang['other_things']['in'].' 7 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=8&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,8).'> '.$lang['other_things']['in'].' 8 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=9&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,9).'> '.$lang['other_things']['in'].' 9 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=10&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,10).'> '.$lang['other_things']['in'].' 10 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=11&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,11).'> '.$lang['other_things']['in'].' 11 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=12&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,12).'> '.$lang['other_things']['in'].' 12 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=13&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,13).'> '.$lang['other_things']['in'].' 13 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=14&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,14).'> '.$lang['other_things']['in'].' 14 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=15&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,15).'> '.$lang['other_things']['in'].' 15 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=16&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,16).'> '.$lang['other_things']['in'].' 16 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=17&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,17).'> '.$lang['other_things']['in'].' 17 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=18&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,18).'> '.$lang['other_things']['in'].' 18 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=19&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,19).'> '.$lang['other_things']['in'].' 19 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=20&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,20).'> '.$lang['other_things']['in'].' 20 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=21&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,21).'> '.$lang['other_things']['in'].' 21 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=22&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,22).'> '.$lang['other_things']['in'].' 22 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=23&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,23).'> '.$lang['other_things']['in'].' 23 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=24&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,24).'> '.$lang['other_things']['in'].' 24 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=25&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,25).'> '.$lang['other_things']['in'].' 25 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=26&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,26).'> '.$lang['other_things']['in'].' 26 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=27&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,27).'> '.$lang['other_things']['in'].' 27 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=28&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,28).'> '.$lang['other_things']['in'].' 28 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=29&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,29).'> '.$lang['other_things']['in'].' 29 '.$method_select.'</option>
		<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num=30&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($num ,30).'> '.$lang['other_things']['in'].' 30 '.$method_select.'</option>
		</select></b></td>
		<td class="list" align="middle" height="40" >
		<p align="right"><b>
		</b><select style="WIDTH: 80; height:19" onchange="window.location = this.value" name="speed_tools7" size="1">
		<option value="index.php?mode='.$self.'&method=&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'"'.check_select($method ," ").'>  '.$lang['profile']['no_selected'].'</option>
		<option value="index.php?mode='.$self.'&method=min&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($method ,"min").'> '.$lang['other_things']['in_minutes'].'</option>
		<option value="index.php?mode='.$self.'&method=heur&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($method ,"heur").'> '.$lang['other_things']['in_hours'].'</option>
		<option value="index.php?mode='.$self.'&method=day&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($method ,"day").'> '.$lang['other_things']['in_days'].'</option>
		<option value="index.php?mode='.$self.'&method=week&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($method ,"week").'> '.$lang['other_things']['in_week'].'</option>
		<option value="index.php?mode='.$self.'&method=month&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($method ,"month").'> '.$lang['other_things']['in_month'].'</option>
		<option value="index.php?mode='.$self.'&method=year&limit='.$limit.'&num='.$num.'&f='.$f.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'" '.check_select($method ,"year").'> '.$lang['other_things']['in_years'].'</option>
		</select></b></td>
	</tr>';
	if($get_u_mlv != 4) {
		echo'
	<tr class="fixed">
		<td class="optionheader_selected" height="32" width="195">
		'.$lang['other_things']['select_forum_stat'].'&nbsp; </td>
		<td class="list" colspan="2" align="middle" height="32">
		<p align="right">
		<select style="WIDTH: 134; height:20" onchange="window.location = this.value" name="speed_tools12" size="1">
	
			<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&f=" '.check_select($f ,0).'> '.$lang['other_things']['all_forums'].'</option>
	';
		$forum = DBi::$con->query("SELECT FORUM_ID,F_SUBJECT FROM ".prefix."FORUM ORDER BY F_ORDER ASC ") or die (DBi::$con->error);
		while($r_forum = mysqli_fetch_array($forum)){
			$forum_id = $r_forum['FORUM_ID'];
			$f_subject = $r_forum['F_SUBJECT'];
			echo'
			<option value="index.php?mode='.$self.'&method='.$method.'&limit='.$limit.'&num='.$num.'&mlv='.$get_u_mlv.'&dep='.$get_u_dep.'&f='.$forum_id.'" '.check_select($f ,"$forum_id").'>'.$f_subject.'</option>';
		}
		echo'
		</select></b></td>
	</tr>
	';
	}
	echo'
</table><br>
		</td>		
			<table border="0" width="100%"  height="209" style="border-width: 0px">
	<br><tr>
		<td width="587" valign="top" style="border-style:none; border-width:medium; ">';
if ($type == ""){
	if($get_u_mlv == 2) {
	$txt = $lang['admin']['moderator'];
	}
	if($get_u_mlv == 3 && $get_u_dep == 0) {
	$txt = $lang['admin']['monitor'];	
	}
	if($get_u_mlv == 3 && $get_u_dep == 1) {
	$txt = $lang['admin']['deputy_monitor'];	
	}	
	if($get_u_mlv == 4) {
	$txt = $lang['admin']['admin'];	
	}	

	$show_topic_stat .= '<b>
	<table  dir="rtl" cellSpacing="1" cellPadding="0" align="center">
		<tr>
		<td class="stats_info" colSpan="3"><font color="orange">'.$lang['other_things']['it_stat'].' '.$level_text.' '.$lang['other_things']['in_online_points'].':</font><br> ';
	if($f != "" or $f != 0){
		$show_topic_stat .= ''.forums("SUBJECT", $f).'';
		}else{
		$show_topic_stat .=  $lang['other_things']['all_forums'];
		}
		$show_topic_stat .=  '
		
		<br><font color="yellow" size="-1">'.$thisday.' - '.$thisday2.'</font> </td>
	</tr>
	<tr>
		<td class="stats" colSpan="3"><font color="red">'.$lang['other_things']['dont_share_this_stat'].'</font></td>
	</tr>
	<tr>
		<td class="stats_h">'.$txt.'</td>
		<td class="stats_h">'.$lang['other_things']['online'].'</td>
		<td class="stats_h">'.$lang['other_things']['points'].'</td>
	</tr>';
	if($f != "" or $f != 0) {
	$forum = "WHERE FORUM_ID = '$f'";
	$c = forums("CAT_ID", $f);		
	$cat = "WHERE CAT_ID = '$c' AND CAT_MONITOR != 0";
	$catt = "WHERE CAT_ID = '$c' AND CAT_DEPUTY_MONITOR != 0";
	} else {
	$forum = "";	
	$cat = "WHERE CAT_MONITOR != 0";	
	$catt = "WHERE CAT_DEPUTY_MONITOR != 0";	
	}	
	if($get_u_mlv == 2) {
	$sql = DBi::$con->query("SELECT * FROM ".prefix."MODERATOR $forum ");
	}
	if($get_u_mlv == 3 && $get_u_dep == 0) {
	$sql = DBi::$con->query("SELECT * FROM ".prefix."CATEGORY $cat ");
	}
	if($get_u_mlv == 3 && $get_u_dep == 1) {
	$sql = DBi::$con->query("SELECT * FROM ".prefix."CATEGORY $catt ");
	}
	
	if($get_u_mlv == 4) {
	$sql = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_LEVEL = 4");
	}
	$sql_num_topic =  mysqli_num_rows($sql)or die(
	$show_topic_stat.'
	<tr>
		<td class="stats_p"  height="30" colspan="5" align="center"> <font color="#FF0000" > '.$lang['other_things']['no_stats'].' </font></td>
	
	</tr>

	');
$x = 0;
while($x < $sql_num_topic) {
if($get_u_mlv == 2) {	
$member = mysqli_result($sql, $x, "MEMBER_ID");	
}
if($get_u_mlv == 3 && $get_u_dep == 0) {
$member = mysqli_result($sql, $x, "CAT_MONITOR");	
}	
if($get_u_mlv == 3 && $get_u_dep == 1) {
$member = mysqli_result($sql, $x, "CAT_DEPUTY_MONITOR");	
}	
if($get_u_mlv == 4) {
$member = mysqli_result($sql, $x, "MEMBER_ID");	
}	
	$show_topic_stat .= '
		<tr>
		<td class="stats_g"><nobr>
		<a target="_new" href="index.php?mode=member&id='.$member.'">
		<font color="yellow"><center>'.member_color_link($member).'</center></font></a></nobr></td>
		<td class="stats_t"><center>'.members("MOD", $member).'</center></td>
		<td class="stats_p"><center>'.members("ONLINE", $member).'</center></td>
	</tr>	
	';
	++$x;
}

	$show_topic_stat .= '
	</table><br>';
	echo ''.$show_topic_stat;
}
}
?>