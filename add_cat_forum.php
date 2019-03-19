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

if($type != "c" && $type != "f" && $type != "liste") {
redirect();
}
if($method != "edit" && $method != "add") {
redirect();	
}

if ($Mlevel == 4) {

if ($type == "c") {

	if ($method == "edit") {
 $query = "SELECT * FROM " . $Prefix . "CATEGORY WHERE CAT_ID = '" . $c . "' ";
 $result = DBi::$con->query($query) or die (DBi::$con->error);

$cat_hide = cat("HIDE", $c);
 if(mysqli_num_rows($result) > 0){

 $rs=mysqli_fetch_array($result);

 $Subject = $rs['CAT_NAME'];
 $MonitorID = $rs['CAT_MONITOR'];
 $DeputyMonitorID = $rs['CAT_DEPUTY_MONITOR'];
 $cat_level =  $rs['CAT_LEVEL'];
 $site_id =  $rs['SITE_ID'];
 $cat_index =  $rs['SHOW_INDEX'];
 $cat_info =  $rs['SHOW_INFO'];
 $cat_profile =  $rs['SHOW_PROFILE'];

 }
 
 $title = $lang['add_cat_forum']['edit_cat'];
 $title2 = $lang['add_cat_forum']['cat_address'];
 $info = info_icon(1);
	}
	else {
 $title = $lang['add_cat_forum']['add_new_cat'];
 $title2 = $lang['add_cat_forum']['cat_address'];
 $info = info_icon(1);
 		$cat_index  = 0;
		$cat_info  = 0;
		$cat_profile  = 0;

	}	
}

if ($type == "f") {

if ($c == "" or $c == 0) {
$cat_check = forums("CAT_ID", $f);
} else {
$cat_check = $c;
}

	if ($method == "edit") {
		$Subject = forums("SUBJECT", $f);
		$F_Desc = forums("DESCRIPTION", $f);
		$F_Logo = forums("LOGO", $f);
        $F_sex = forums("SEX", $f);
		$F_total_topics = forums("TOTAL_TOPICS", $f);
		$F_total_replies = forums("TOTAL_REPLIES", $f);
		$f_hide = forums("HIDE", $f);
		$hide_mod = forums("HIDE_MOD", $f);
		$hide_photo = forums("HIDE_PHOTO", $f);
		$hide_sig = forums("HIDE_SIG", $f);
		$title = $lang['add_cat_forum']['edit_forum'];
		$title2 = $lang['add_cat_forum']['forum_address'];
		$day_archive = forums("DAY_ARCHIVE", $f);
		$active_archive = forums("CAN_ARCHIVE", $f);
        $f_level = forums("F_LEVEL", $f);


		$moderate_topic  = forums("MODERATE_TOPIC", $f);
		$moderate_reply  = forums("MODERATE_REPLY", $f);
		$moderate_posts = forums("MODERATE_POSTS", $f);
		$moderate_days = forums("MODERATE_DAYS", $f);

		$hide_medal = forums("HIDE_MEDAL", $f);
		$show_index = forums("SHOW_INDEX", $f);
		$show_frm = forums("SHOW_FRM", $f);
		$show_info = forums("SHOW_INFO", $f);  
		$show_profile = forums("SHOW_PROFILE", $f);  
		$f_hashtag = forums("HASHTAG", $f);  
		$f_social = forums("SOCIAL", $f);  		
		$f_dollar_topic = forums("DOLLAR_TOPIC", $f);  		
		$f_dollar_reply = forums("DOLLAR_REPLY", $f);  		



		$info = info_icon(2);
	}
	else {
		$F_total_topics = 5;
		$F_total_replies = 200;
		$f_hide = 0;
		$hide_photo = 0;
		$hide_sig = 0;
		$hide_medal = 0;
		$title = $lang['add_cat_forum']['add_new_forum'];
		$title2 = $lang['add_cat_forum']['forum_address'];
		$day_archive = 30;
		$active_archive = 0;

		$moderate_topic  = 1;
		$moderate_reply  = 1;
		$moderate_posts  = 35;
		$moderate_days = 15;

		$show_index  = 0;
		$show_frm  = 0;
		$show_info  = 0;
		$show_profile = 0 ;
		$f_social = 0 ;
		$info = info_icon(2);
	}
}


echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="50%">
	<form method="post" action="index.php?mode=cat_forum_info">
	<input type="hidden" name="method" value="'.$method.'">
    <input type="hidden" name="type" value="'.$type.'">
    <input type="hidden" name="cat_id" value="'.$c.'">
    <input type="hidden" name="forum_id" value="'.$f.'">
	
	<tr>
		<td class="cat" colspan="2" align="middle">'.$title.'</td>
	</tr>
	<tr class="fixed">
		<td class="optionheader" id="row_title2" ><nobr>'.$title2.'</nobr></td>
		<td class="middle"><input  onchange="check_changes(row_title2, \''.$Subject.'\', this.value)"  type="text" name="add_subject" size="50" value="'.$Subject.'">'.$info.'</td>
	</tr>';
    echo info_text(1,$lang['info']['write_subject_of_cat'],$title2);
    echo info_text(2,$lang['info']['write_subject_of_forum'],$title2);
if ($type == "c") {

if ($MonitorID == 0 OR $MonitorID == "") {
$Name = $lang['add_cat_forum']['non_monitor'];
}
else {
$Name = link_profile(member_name($MonitorID), $MonitorID);
}
if ($DeputyMonitorID == 0 OR $DeputyMonitorID == "") {
$DName = $lang['add_cat_forum']['non_deputy_monitor'];
}
else {
$DName = link_profile(member_name($DeputyMonitorID), $DeputyMonitorID);
}

    echo'
<tr class="fixed">
		<td class="optionheader" id="row_site_id" ><nobr>'.$lang['add_cat_forum']['site'].'</nobr></td>
		<td class="list"><select onchange="check_changes(row_site_id, \''.$site_id.'\', this.value)"  class="insidetitle" name="site_id" size="1">
			<option value="1" '.check_select($site_id, "1").'>'.$lang['add_cat_forum']['site1'].'</option>
			<option value="2" '.check_select($site_id, "2").'>'.$lang['add_cat_forum']['site2'].'</option>
			<option value="0" '.check_select($site_id, "0").'>'.$lang['add_cat_forum']['site3'].'</option>
	</select></td>
	</tr>
<tr class="fixed">
		<td class="optionheader" id="row_cat_level"><nobr>'.$lang['add_cat_forum']['group'].'</nobr></td>
		<td class="list"><select  onchange="check_changes(row_cat_level, \''.$cat_level.'\', this.value)"  class="insidetitle" name="cat_level" size="1">
			<option value="0" '.check_select($cat_level, "0").'>'.$lang['add_cat_forum']['all'].'</option>
			<option value="1" '.check_select($cat_level, "1").'>'.$lang['add_cat_forum']['members'].'</option>
			<option value="2" '.check_select($cat_level, "2").'>'.$lang['add_cat_forum']['moderators'].'</option>
			<option value="3" '.check_select($cat_level, "3").'>'.$lang['add_cat_forum']['monitors'].'</option>
			<option value="4" '.check_select($cat_level, "4").'>'.$lang['add_cat_forum']['admins'].'</option>
	</select>
		'.info_icon(6).'</td>
	</tr>
'.info_text(6, $lang['add_cat_forum']['select_group_to_show_category_to'], $lang['add_cat_forum']['group']).'
	<tr class="fixed">
		<td class="optionheader" id="row_MonitorID"><nobr>'.$lang['add_cat_forum']['add_mon_to_this_cat'].'</nobr></td>
		<td class="list"><input onchange="check_changes(row_MonitorID, \''.$MonitorID.'\', this.value)" type="text" name="mon_memberid" size="1" value="'.$MonitorID.'">&nbsp;'.$lang['add_cat_forum']['note_just_insert_nuber_of_member'].'</td>
	</tr>
	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['mon_name'].'</nobr></td>
		<td class="list">'.$Name.'</td>
	</tr>	
	<tr class="fixed">
		<td class="optionheader" id="row_DeputyMonitorID"><nobr>'.$lang['add_cat_forum']['add_deputy_mon_to_this_cat'].'</nobr></td>
		<td class="list"><input onchange="check_changes(row_DeputyMonitorID, \''.$DeputyMonitorID.'\', this.value)" type="text" name="deputy_mon_memberid" size="1" value="'.$DeputyMonitorID.'">&nbsp;'.$lang['other']['deputy_monitor_add'].'</td>
	</tr>	
	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['deputy_mon_name'].'</nobr></td>
		<td class="list">'.$DName.'</td>
	</tr>
		<tr class="fixed">

			<td class="optionheader"><nobr>'.$lang['add_cat_forum']['show_mon_on_home'].'</nobr></td>
		<td class="list">
		<input class="small" type="radio" name="cat_index" value="0" '.check_radio($cat_index, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input class="small" type="radio" name="cat_index" value="1" '.check_radio($cat_index, "1").'>'.$lang['add_cat_forum']['no'].'
			</td>
	</tr>
		<tr class="fixed">

			<td class="optionheader"><nobr>'.$lang['add_cat_forum']['show_mon_on_about_forum_page'].'</nobr></td>
		<td class="list">
		<input class="small" type="radio" name="cat_info" value="0" '.check_radio($cat_info, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input class="small" type="radio" name="cat_info" value="1" '.check_radio($cat_info, "1").'>'.$lang['add_cat_forum']['no'].'
			</td>
	</tr>
		<tr class="fixed">

			<td class="optionheader"><nobr>'.$lang['add_cat_forum']['show_category_name_in_mon_profile'].'</nobr></td>
		<td class="list">
		<input class="small" type="radio" name="cat_profile" value="0" '.check_radio($cat_profile, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input class="small" type="radio" name="cat_profile" value="1" '.check_radio($cat_profile, "1").'>'.$lang['add_cat_forum']['no'].'
			</td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['hide_category_options'].'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader" id="row_cat_hide" ><nobr>'.$lang['add_cat_forum']['hide_category'].'</nobr></td>
		<td class="list">
		<select   onchange="check_changes(row_cat_hide, \''.$cat_hide.'\', this.value)" class="insidetitle" name="cat_hide" size="1">
			<option value="0" '.check_select($cat_hide, "0").'>'.$lang['add_cat_forum']['no'].'</option>
			<option value="1" '.check_select($cat_hide, "1").'>'.$lang['add_cat_forum']['yes'].'</option>
	</select>
		'.info_icon(5).'
		</td>
	</tr>
	'.info_text(5, $lang['add_cat_forum']['if_category_hide_it_show_to_member_who_show_forum_in_this_category'], $lang['add_cat_forum']['hide_category']).'

	<tr class="fixed">
		<td colspan="2" align="middle"><input type="submit" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
	</tr></table>
 ';
}

if ($type == "f") {
echo'

	<tr class="fixed">
		<td class="optionheader" id="row_cat_choose" ><nobr>'.$lang['add_cat_forum']['category'].'</nobr></td>
		<td class="list">
			<select  onchange="check_changes(row_cat_choose, \''.$cat_choose.'\', this.value)"  class="insidetitle" name="cat_choose" size="1">';
		$cat = DBi::$con->query("SELECT * FROM ".$Prefix."CATEGORY ORDER BY CAT_ORDER ASC") or die     (DBi::$con->error);
		$c_num = mysqli_num_rows($cat);
		$c_i = 0;
		while ($c_i < $c_num) {
		$cat_id = mysqli_result($cat, $c_i, "CAT_ID");
    	$cat_subject = mysqli_result($cat, $c_i, "CAT_NAME");
		echo '<option value="'.$cat_id.'" '.check_select($cat_check, $cat_id).'>'.$cat_subject.'</option>';
			$c_i++;
			}
	echo'</select>
	'.info_icon(10).'
	</tr>
	'.info_text(10,$lang['add_cat_forum']['category_description'],$lang['add_cat_forum']['category']).'
	<tr class="fixed">
		<td class="optionheader" id="row_forum_logo" ><nobr>'.$lang['add_cat_forum']['forum_logo'].'</nobr></td>
		<td class="middle"><input onchange="check_changes(row_forum_logo, \''.$forum_logo.'\', this.value)" dir="ltr" type="text" name="forum_logo" size="50" value="'.$F_Logo.'">'.info_icon(4).'</td>
	</tr>
    '.info_text(4,$lang['info']['info_insert_forum_logo'],$lang['add_cat_forum']['forum_logo']).'



<tr class="fixed">
		<td class="optionheader" id="row_f_level" ><nobr>'.$lang['add_cat_forum']['group'].'</nobr></td>
		<td class="list"><select onchange="check_changes(row_f_level, \''.$f_level.'\', this.value)" class="insidetitle" name="f_level" size="1">
			<option value="0" '.check_select($f_level, "0").'>'.$lang['add_cat_forum']['all'].'</option>
			<option value="1" '.check_select($f_level, "1").'>'.$lang['add_cat_forum']['members'].'</option>
			<option value="2" '.check_select($f_level, "2").'>'.$lang['add_cat_forum']['moderators'].'</option>
			<option value="3" '.check_select($f_level, "3").'>'.$lang['add_cat_forum']['monitors'].'</option>
			<option value="4" '.check_select($f_level, "4").'>'.$lang['add_cat_forum']['admins'].'</option>
	</select>
		'.info_icon(110).'</td>
	</tr>
'.info_text(110, $lang['add_cat_forum']['select_group_description'], $lang['add_cat_forum']['group']).'
<tr class="fixed">
		<td class="optionheader" id="row_F_sex"><nobr>'.$lang['add_cat_forum']['sex_forum'].'</nobr></td>
		<td class="list">
		<select onchange="check_changes(row_F_sex, \''.$F_sex.'\', this.value)" class="insidetitle" name="f_sex" size="1">
			<option value="0" '.check_select($F_sex, "0").'>'.$lang['add_cat_forum']['all'].'</option>
			<option value="1" '.check_select($F_sex, "1").'>'.$lang['add_cat_forum']['male'].'</option>
            <option value="2" '.check_select($F_sex, "2").'>'.$lang['add_cat_forum']['female'].'</option>
		</select>
		'.info_icon(30).'
		</td>
	</tr>
	'.info_text(30, $lang['add_cat_forum']['sex_forum_description'], $lang['add_cat_forum']['sex_forum_d']);

	echo '<tr class="fixed">
		<td class="optionheader" id="row_forum_desc" ><nobr>'.$lang['add_cat_forum']['about_forum'].'</nobr></td>
		<td><textarea onchange="check_changes(row_forum_desc, \''.$forum_desc.'\', this.value)" cols="50" rows="10" name="forum_desc">'.$F_Desc.'</textarea></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['topic_reply_options'].'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader" id="row_total_topics" ><nobr>'.$lang['add_cat_forum']['num_topics'].'</nobr></td>
		<td class="list"><input  onchange="check_changes(row_total_topics, \''.$total_topics.'\', this.value)"  type="text" name="total_topics" value="'.$F_total_topics.'" size="1">'.info_icon(6).'</td>
	</tr>
	'.info_text(6, $lang['add_cat_forum']['num_topics_description'], $lang['add_cat_forum']['num_topics']).'
 	<tr class="fixed"> 
		<td class="optionheader" id="row_total_replies" ><nobr>'.$lang['add_cat_forum']['num_replies'].'</nobr></td>
		<td class="list"><input  onchange="check_changes(row_total_replies, \''.$total_replies.'\', this.value)" type="text" name="total_replies" value="'.$F_total_replies.'" size="1">'.info_icon(7).'</td>
	</tr>
	'.info_text(7, $lang['add_cat_forum']['num_replies_description'], $lang['add_cat_forum']['num_replies']);


echo '<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['archive_options'].'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader" id="row_day_archive" ><nobr>'.$lang['add_cat_forum']['num_days'].'</nobr></td>
		<td class="list"><input  onchange="check_changes(row_day_archive, \''.$day_archive.'\', this.value)" type="text" name="day_archive" value="'.$day_archive.'" size="1">'.info_icon(102).'</td>
	</tr>
	'.info_text(102, $lang['add_cat_forum']['num_days_description'], $lang['add_cat_forum']['num_days']).'
 	<tr class="fixed"> 
		<td class="optionheader" id="row_active_archive"><nobr>'.$lang['add_cat_forum']['active_archive'].'</nobr></td>
		<td class="list">
		<input  onchange="check_changes(row_active_archive, \''.$active_archive.'\', this.value)" class="small" type="radio" name="active_archive" value="0" '.check_radio($active_archive, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input  onchange="check_changes(row_active_archive, \''.$active_archive.'\', this.value)" class="small" type="radio" name="active_archive" value="1" '.check_radio($active_archive, "1").'>'.$lang['add_cat_forum']['no'].'
		</td>
	</tr>';


//################### MODERATE TOOLS BY ملك المستقبل /  AYOUB ######################

echo '<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['monitor_options'].''.info_icon(1111).'</td>
</td>
	</tr>
	'.info_text(1111, $lang['add_cat_forum']['monitor_options_description'], $lang['add_cat_forum']['monitor_options']).'
	</tr>

	</tr>
 	<tr class="fixed">
		<td class="optionheader" id="row_moderate_posts" ><nobr>'.$lang['add_cat_forum']['num_topics_replies'].'</nobr></td>
		<td class="list"><input  onchange="check_changes(row_moderate_posts, \''.$moderate_posts.'\', this.value)"  type="text" name="moderate_posts" value="'.$moderate_posts.'" size="1"></td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader" id="row_moderate_days" ><nobr>'.$lang['add_cat_forum']['num_days'].'</nobr></td>
		<td class="list"><input  onchange="check_changes(row_moderate_days, \''.$moderate_days.'\', this.value)"  type="text" name="moderate_days" value="'.$moderate_days.'" size="1"></td>
	</tr>	
	 	<tr class="fixed"> 
		<td class="optionheader" id="row_moderate_topic"><nobr>'.$lang['add_cat_forum']['monitor_topics'].'</nobr></td>
		<td class="list">
		<input  onchange="check_changes(row_moderate_topic, \''.$moderate_topic.'\', this.value)" class="small" type="radio" name="moderate_topic" value="0" '.check_radio($moderate_topic, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input  onchange="check_changes(row_moderate_topic, \''.$moderate_topic.'\', this.value)" class="small" type="radio" name="moderate_topic" value="1" '.check_radio($moderate_topic, "1").'>'.$lang['add_cat_forum']['no'].'
		</td>
		</tr>
 	<tr class="fixed"> 
		<td class="optionheader" id="row_moderate_reply"><nobr>'.$lang['add_cat_forum']['monitor_replies'].'</nobr></td>
		<td class="list">
		<input  onchange="check_changes(row_moderate_reply, \''.$moderate_reply.'\', this.value)" class="small" type="radio" name="moderate_reply" value="0" '.check_radio($moderate_reply, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input  onchange="check_changes(row_moderate_reply, \''.$moderate_reply.'\', this.value)" class="small" type="radio" name="moderate_reply" value="1" '.check_radio($moderate_reply, "1").'>'.$lang['add_cat_forum']['no'].'
		</td>
		 
';

//################### MEMBERS DETAILS ######################


echo'
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['show_photos_sig_options'].'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"  id="row_hide_photo" ><nobr>'.$lang['add_cat_forum']['show_photos'].'</nobr></td>
		<td class="list">
		<input onchange="check_changes(row_hide_photo, \''.$hide_photo.'\', this.value)"  class="small" type="radio" name="hide_photo" value="0" '.check_radio($hide_photo, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input onchange="check_changes(row_hide_photo, \''.$hide_photo.'\', this.value)"  class="small" type="radio" name="hide_photo" value="1" '.check_radio($hide_photo, "1").'>'.$lang['add_cat_forum']['no'].'
		</td>
	</tr>
	<tr class="fixed">
		<td class="optionheader"  id="row_hide_sig" ><nobr>'.$lang['add_cat_forum']['show_sig'].'</nobr></td>
		<td class="list">
		<input onchange="check_changes(row_hide_sig, \''.$hide_sig.'\', this.value)"  class="small" type="radio" name="hide_sig" value="0" '.check_radio($hide_sig, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input onchange="check_changes(row_hide_sig, \''.$hide_sig.'\', this.value)"  class="small" type="radio" name="hide_sig" value="1" '.check_radio($hide_sig, "1").'>'.$lang['add_cat_forum']['no'].'
		</td>
	</tr>
	<tr class="fixed">
		<td class="optionheader"  id="row_hide_medal"><nobr>'.$lang['add_cat_forum']['show_medal'].'</nobr></td>
		<td class="list">
		<input onchange="check_changes(row_hide_medal, \''.$hide_medal.'\', this.value)"  class="small" type="radio" name="hide_medal" value="0" '.check_radio($hide_medal, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input onchange="check_changes(row_hide_medal, \''.$hide_medal.'\', this.value)"  class="small" type="radio" name="hide_medal" value="1" '.check_radio($hide_medal, "1").'>'.$lang['add_cat_forum']['no'].'
		</td>
	</tr>	';
	echo'
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['moderators_options'].'</td>
	</tr>
	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['show_mod_at_home'].'</nobr></td>
		<td class="list">
		<input class="small" type="radio" name="show_index" value="0" '.check_radio($show_index, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input class="small" type="radio" name="show_index" value="1" '.check_radio($show_index, "1").'>'.$lang['add_cat_forum']['no'].'
			</tr>
	</tr>
	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['show_mod_on_forum'].'</nobr></td>
		<td class="list">
		<input class="small" type="radio" name="show_frm" value="0" '.check_radio($show_frm, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input class="small" type="radio" name="show_frm" value="1" '.check_radio($show_frm, "1").'>'.$lang['add_cat_forum']['no'].'
			</tr>
	</tr>

	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['show_forum_title_at_profile'].'</nobr></td>
		<td class="list">
		<input class="small" type="radio" name="show_profile" value="0" '.check_radio($show_profile , "0").'>'.$lang['add_cat_forum']['yes'].'
		<input class="small" type="radio" name="show_profile" value="1" '.check_radio($show_profile , "1").'>'.$lang['add_cat_forum']['no'].'
			</tr>
	</tr>
	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['show_mod_on_about_forum_page'].'</nobr></td>
		<td class="list">
		<input class="small" type="radio" name="show_info" value="0" '.check_radio($show_info, "0").'>'.$lang['add_cat_forum']['yes'].'
		<input class="small" type="radio" name="show_info" value="1" '.check_radio($show_info, "1").'>'.$lang['add_cat_forum']['no'].'
 	<tr class="fixed">
		<td class="optionheader" id="row_mod_memberid" ><nobr>'.$lang['add_cat_forum']['add_mod_to_this_forum'].'</nobr></td>
		<td class="list"><input onchange="check_changes(row_mod_memberid, \''.$mod_memberid.'\', this.value)" type="text" name="mod_memberid" size="1">'.info_icon(9).'</td>
	</tr>
	'.info_text(9, $lang['add_cat_forum']['add_mod_description'], $lang['add_cat_forum']['add_mod_to_this_forum']).'
  	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['forum_modetaror_list'].'</nobr></td>
		<td class="list">';

        echo'<center>
        <table width="50%" cellSpacing="1" cellPadding="2" border="0">
            <tr>
                <td class="stats_h" align="middle">'.$lang['add_cat_forum']['number_mod'].'</td>
                <td class="stats_h" align="middle">'.$lang['add_cat_forum']['number_id'].'</td>
                <td class="stats_h" align="middle">'.$lang['add_cat_forum']['mod_name'].'</td>
                <td class="stats_h" align="middle">'.$lang['add_cat_forum']['options'].'</td>
            </tr>';


 	$query = "SELECT * FROM " . $Prefix . "MODERATOR ";
    $query .= " WHERE FORUM_ID = '$f' ";
	$query .= " ORDER BY MOD_ID ASC";
	$result = DBi::$con->query($query) or die (DBi::$con->error);

	$num = mysqli_num_rows($result);


	if ($num <= 0) {
            echo'
            <tr>
                <td class="stats_p" align="middle" colspan="4"><br><font color="black">'.$lang['add_cat_forum']['non_moderator'].'</font><br><br></td>
            </tr>';
    }

$i=0;
while ($i < $num) {

    $ModModerator_ID = mysqli_result($result, $i, "MOD_ID");
    $ModForum_ID = mysqli_result($result, $i, "FORUM_ID");
    $ModMember_ID = mysqli_result($result, $i, "MEMBER_ID");
            
            echo'
            <tr>
                <td class="stats_h" align="middle"><font color="yellow" size="-1">'.$ModModerator_ID.'</td>
                <td class="stats_g" align="middle"><font color="blue" size="-1">'.$ModMember_ID.'</td>
                <td class="stats_p" align="middle"><nobr>'.link_profile(member_name($ModMember_ID), $ModMember_ID).'</nobr></td>
                <td class="stats_h" align="middle"><a href="index.php?mode=delete&type=del_mod&m='.$ModModerator_ID.'&f='.$f.'"  onclick="return confirm(\''.$lang['add_cat_forum']['you_are_sure_to_delete_this_mod'].'\');">'.icons($icon_trash, $lang['add_cat_forum']['delete_mod'], "").'</a></td>
            </tr>';
            
            
    ++$i;
}
            
//################### MEMBERS DETAILS ######################
if ($type == "liste") {

	echo'
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['moderators_options'].'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader" ><nobr>'.$lang['add_cat_forum']['add_mod_to_this_forum'].'</nobr></td>
		<td class="list"><input type="text" name="mod_memberid" size="1">'.info_icon(9).'</td>
	</tr>
	'.info_text(9, $lang['add_cat_forum']['add_mod_description'], $lang['add_cat_forum']['add_mod_to_this_forum']).'
  	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['forum_modetaror_list'].'</nobr></td>
		<td class="list">';

        echo'<center>
        <table width="50%" cellSpacing="1" cellPadding="2" border="0">
            <tr>
                <td class="stats_h" align="middle">'.$lang['add_cat_forum']['number_mod'].'</td>
                <td class="stats_h" align="middle">'.$lang['add_cat_forum']['number_id'].'</td>
                <td class="stats_h" align="middle">'.$lang['add_cat_forum']['mod_name'].'</td>
                <td class="stats_h" align="middle">'.$lang['add_cat_forum']['options'].'</td>
            </tr>';
}
            
        echo'
        </table>
        </center>';


        echo'</td>
	</tr>';
 
	echo'
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['hide_forum_options'].'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader" id="row_f_hide" ><nobr>'.$lang['add_cat_forum']['hide_forum'].'</nobr></td>
		<td class="list">
		<select onchange="check_changes(row_f_hide, \''.$f_hide.'\', this.value)"   class="insidetitle" name="f_hide" size="1">
		<option  value="0" '.check_select($f_hide, "0").'>'.$lang['add_cat_forum']['no'].'</option>
		<option  value="1" '.check_select($f_hide, "1").'>'.$lang['add_cat_forum']['yes'].'</option>
		</select>
		'.info_icon(5).'
		</td>
	</tr>
	'.info_text(5, $lang['add_cat_forum']['hide_forum_description'], $lang['add_cat_forum']['hide_forum']);

	echo'
 	<tr class="fixed">
		<td class="optionheader" id="row_hide_mod" ><nobr>'.$lang['add_cat_forum']['hide_mod'].'</nobr></td>
		<td class="list">
		<select onchange="check_changes(row_hide_mod, \''.$hide_mod.'\', this.value)" class="insidetitle" name="hide_mod" size="1">
			<option value="0" '.check_select($hide_mod, "0").'>'.$lang['add_cat_forum']['no'].'</option>
			<option value="1" '.check_select($hide_mod, "1").'>'.$lang['add_cat_forum']['yes'].'</option>
		</select>
		'.info_icon(20).'
		</td>
	</tr>
	'.info_text(20, $lang['add_cat_forum']['hide_mod_description'], $lang['add_cat_forum']['hide_mod']);
if ($f_hide == 1){
	echo'
 	<tr class="fixed">
		<td class="optionheader" id="row_hf_member_id"><nobr>'.$lang['add_cat_forum']['add_member_to_this_hide_forum'].'</nobr></td>
		<td class="list"><input  onchange="check_changes(row_hf_member_id, \''.$hf_member_id.'\', this.value)"  type="text" name="hf_member_id" size="1">'.info_icon(8).'</td>
	</tr>
	'.info_text(8, $lang['add_cat_forum']['add_member_to_hide_forum_description'], $lang['add_cat_forum']['add_member_to_this_hide_forum']).'
  	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['members_can_show_hide_forum_list'].'</nobr></td>
		<td class="list">
		<center>
		<table width="40%" cellSpacing="1" cellPadding="2" border="0">
			<tr>
				<td class="stats_h" align="middle">'.$lang['add_cat_forum']['member_number'].'</td>
				<td class="stats_h" align="middle">'.$lang['add_cat_forum']['member_name'].'</td>
				<td class="stats_h" align="middle">'.$lang['add_cat_forum']['options'].'</td>
			</tr>';
	$forum_hide = DBi::$con->query("SELECT * FROM ".$Prefix."HIDE_FORUM WHERE HF_FORUM_ID = '$f' ") or die (DBi::$con->error);
	$hf_num = mysqli_num_rows($forum_hide);
	if ($hf_num <= 0) {
			echo'
			<tr>
				<td class="stats_p" align="middle" colspan="3"><br><font color="black">'.$lang['add_cat_forum']['no_member_allow_to_show_hide_forum'].'</font><br><br></td>
			</tr>';
	}
	$hf_i = 0;
	while ($hf_i < $hf_num) {
		$hf_id = mysqli_result($forum_hide, $hf_i, "HF_ID");
		$hf_member_id = mysqli_result($forum_hide, $hf_i, "HF_MEMBER_ID");
            echo'
            <tr>
                <td class="stats_h" align="middle"><font color="yellow" size="-1">'.$hf_member_id.'</td>
                <td class="stats_p" align="middle"><nobr>'.link_profile(members("NAME", $hf_member_id), $hf_member_id).'</nobr></td>
                <td class="stats_h" align="middle"><a href="index.php?mode=delete&type=del_mem&m='.$hf_id.'&f='.$f.'"  onclick="return confirm(\''.$lang['add_cat_forum']['confirm_delete_member_from_list'].'\');">'.icons($icon_trash, $lang['add_cat_forum']['delete_member_from_list']).'</a></td>
            </tr>';
	++$hf_i;
	} 
		echo'
        </table>
		</center>
		</td>
	</tr>';
}

echo'
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['stat_forum'].'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['members'].'</nobr></td>
		<td class="list">
<input type="button" value="'.$lang['add_cat_forum']['stat'].'" onclick="window.location=\'index.php?mode=admin_svc&type=m_stat&method=member&f='.$f.'\'">
		</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['add_cat_forum']['moderators'].'</nobr></td>
		<td class="list">
<input type="button" value="'.$lang['add_cat_forum']['stat'].'" onclick="window.location=\'index.php?mode=admin_svc&type=m_stat&method=modo&f='.$f.'\'">
		</td></tr>';
		
//################### Social Options ######################
	echo'
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['add_cat_forum']['social_options'].'</td>
	</tr>
 	<tr class="fixed">
		<td class="optionheader"  id="row_f_social" ><nobr>'.$lang['add_cat_forum']['active'].'</nobr></td>
		<td class="list">
		<input onchange="check_changes(row_f_social, \''.$f_social.'\', this.value)"  class="small" type="radio" name="f_social" value="1" '.check_radio($f_social, "1").'>'.$lang['add_cat_forum']['yes'].'
		<input onchange="check_changes(row_f_social, \''.$f_social.'\', this.value)"  class="small" type="radio" name="f_social" value="0" '.check_radio($f_social, "0").'>'.$lang['add_cat_forum']['no'].'
		</td>
	</tr>
	<tr class="fixed">
		<td class="optionheader"  id="row_f_hashtag" ><nobr>'.$lang['add_cat_forum']['hashtag'].'</nobr></td>
		<td class="list">
		<font size="4">#</font><input  onchange="check_changes(row_f_hashtag, \''.$f_hashtag.'\', this.value)"  type="text" name="f_hashtag" value="'.$f_hashtag.'" size="10">
	</td>
	</tr>';
	
	echo'
	<tr>
		<td class="cat" colspan="2" align="middle">'.$lang['admin']['market_options'].'</td>
	</tr>
	<tr class="fixed">
		<td class="optionheader"  id="row_f_dollar_topic" ><nobr>'.$lang['admin']['dollar_topic'].'</nobr></td>
		<td class="list">
		<input  onchange="check_changes(row_f_dollar_topic, \''.$f_dollar_topic.'\', this.value)"  type="text" name="f_dollar_topic" value="'.$f_dollar_topic.'" size="10">
	</td>
	</tr>
		<tr class="fixed">
		<td class="optionheader"  id="row_f_dollar_reply" ><nobr>'.$lang['admin']['dollar_reply'].'</nobr></td>
		<td class="list">
		<input  onchange="check_changes(row_f_dollar_reply, \''.$f_dollar_reply.'\', this.value)"  type="text" name="f_dollar_reply" value="'.$f_dollar_reply.'" size="10">
	</td>
	</tr>';	

	echo'
	
	
	<tr class="fixed">
		<td colspan="2" align="middle"><input type="submit" value="'.$lang['profile']['insert_info'].'">&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'"></td>
	</tr>
	</table>
    </form>
</center><br>';

}


}
else {
redirect();
}
@mysqli_close();
?>