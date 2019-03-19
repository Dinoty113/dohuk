<?
/*if (@eregi("home.php","$_SERVER[PHP_SELF]")) {
header("HTTP/1.0 404 Not Found");
require_once("customavatars/foundfile.htm");
exit();
}*/
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
$visitors_sql = DBi::$con->query("SELECT * FROM ".$Prefix."ONLINE WHERE O_MEMBER_LEVEL = '0' ") or die (DBi::$con->error);
$visitors_online = $visitors_sql->num_rows;	
$members_sql = DBi::$con->query("SELECT * FROM ".$Prefix."ONLINE WHERE O_MEMBER_LEVEL = '1' ") or die (DBi::$con->error);	
$members_online = $members_sql->num_rows;		
$moderators_sql = DBi::$con->query("SELECT * FROM ".$Prefix."ONLINE WHERE O_MEMBER_LEVEL = '2' ") or die (DBi::$con->error);	
$moderators_online = $moderators_sql->num_rows;	
$monitors_sql = DBi::$con->query("SELECT * FROM ".$Prefix."ONLINE WHERE O_MEMBER_LEVEL = '3' AND O_MEMBER_DEPUTY = '0' ") or die (DBi::$con->error);	
$monitors_online = $monitors_sql->num_rows;
$deputy_monitors_sql = DBi::$con->query("SELECT * FROM ".$Prefix."ONLINE WHERE O_MEMBER_LEVEL = '3' AND O_MEMBER_DEPUTY = '1' ") or die (DBi::$con->error);	
$deputy_monitors_online = $deputy_monitors_sql->num_rows;
require_once("./engine/home_function.php");
ad_1();

if($method != "login") {
	if ($WHAT_ACTIVE == 1) {
include("what_info.php");
echo'<br>';
}
if ($best == 0) {
include("best.php");
}  
}

if (members("INDEX", $DBMemberID) == 1 AND mlv > 0 ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][index].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
if($method != "login"){echo'<table dir=ltr border=0 width=100% cellspacing=0 cellpadding=0><tr><tr><td width=200 valign=top style=\"padding-right:2px;padding-top:0px;\"><table dir=rtl bgcolor=#ffffee height=100% width=200>';
if (mlv == 0){echo'<tr><td class=cat_new colspan=2>'.$lang['header']['members_login'].'</td></tr><tr><td><center><table height=100% cellspacing=0 cellpadding=0 border=0>
<form action="index.php?method=login" method="post"><tr><td style="font-size:12px;" align=left>
<font color=red><b>'.$lang['header']['name_email'].'</td><td colspan=2 style="padding-right:2px;">
<INPUT style="width:150px;" class=small type=text name="userName"></td></tr>
<tr><td style="font-size:12px;" align=left><font color=red><nobr><b>'.$lang['header']['password'].'</td>
<td style="padding-right:2px;"><INPUT style="width:100px;" class=small type=password name="userPass"></td>
<td valign=top align=left><INPUT class=small src="'.$login.'" type=image value="Login" id=submit1 name=submit1 border=0 hspace=4>
</td></tr><tr><tr><td colspan=3 style="font-size:12px;" height=4></td></tr><tr><td style="font-size:12px;align:center;" colspan=3>
<nobr><center><select name="savePass"><option value="save">'.$lang['header']['save_pass_and_user_name'].'</option>
<option value="temp">'.$lang['header']['temporarily_login'].'</option></select>
<br><a class=menu href="index.php?mode=forget_pass">'.$lang['header']['forget_password'].'</a></td></tr></form></table></td></tr>';}
echo'<tr><td class=cat_new colspan=2>'.$lang['others']['time_now'].'</td></tr><tr><form method="post" action="index.php?tz=1"><td style="font-size:14px;">
<center>'.gmt_time(time());echo'&nbsp;&nbsp;&nbsp;<select class=timezoneSelect name="timezone" size="1" onchange="submit();">';home_timezone();echo'</select></td></form>
</tr>';
echo'
<tr><td class=cat_new colspan=2>'.$lang['home']['choose_language'].'</td></tr><tr>			<form method="post" action="index.php?ch=lang">
			<td vAlign="center">
			<center><select class="styleSelect" name="lan_name" onchange="submit();">';

        $ch_lang = DBi::$con->query("SELECT * FROM ".$Prefix."LANGUAGE ") or die (DBi::$con->error);
        $lang_num = mysqli_num_rows($ch_lang);
    
        if ($lang_num > 0) {

            $lang_i = 0;
            while ($lang_i < $lang_num) {

                $lang_id = mysqli_result($ch_lang, $lang_i, "L_ID");
                $lang_file_name = mysqli_result($ch_lang, $lang_i, "L_FILE_NAME");
                $lang_name = mysqli_result($ch_lang, $lang_i, "L_NAME");
            
                echo'<option value="'.$lang_file_name.'" '.check_select($choose_language, $lang_file_name).'>'.$lang_name.'</option>';
            
            ++$lang_i;
            }
        }
        else {
            echo'<option value="">'.$lang['home']['choose_language'].'</option>';
        }
            echo'
            </select></center>
            </td>
            </form>
			
</tr>';

echo'
<tr><td class=cat_new colspan=2>'.$lang['home']['choose_style'].'</td></tr><tr><form method="post" action="index.php?step=style">
            <td vAlign="center">
            <center><select class="styleSelect" name="style_name">';
			if($Mlevel > 0) {
				$num = mysqli_num_rows(DBi::$con->query("SELECT * FROM ".prefix."STYLE WHERE S_FILE_NAME = '$DBMemberSkin'"));
				if($num == 0) {
                echo'<option value="'.$DBMemberSkin.'" '.check_select($DBMemberSkin, $choose_style).'>'.$lang['temy_other']['now_skin'].'</option>';
				}
			}
        $ch_style = DBi::$con->query("SELECT * FROM ".$Prefix."STYLE ") or die (DBi::$con->error);
        $style_num = mysqli_num_rows($ch_style);

        if ($style_num > 0) {

            while ($r_style = mysqli_fetch_array($ch_style)) {

                $style_id = $r_style['S_ID'];
                $style_file_name = $r_style['S_FILE_NAME'];
                $style_name = $r_style['S_NAME'];
                echo'<option value="'.$style_file_name.'" '.check_select($choose_style, $style_file_name).'>'.$style_name.'</option>';
            }
        }
        else {
            echo'<option value="">'.$lang['home']['choose_style'].'</option>';
        }
            echo'
            </select>
			<input style="font-family:arial;font-size:12;font-weight:bold;color:black;background-color:#ffffff "" type="submit" value="تغيير"></center>
            </td>
            </form>';
			if ($step == "style"){
 $style_name = $_POST["style_name"];
 $_SESSION['DF_choose_style'] = $style_name;
 if($Mlevel > 0) {
 DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_SKIN = '$style_name' WHERE MEMBER_ID = '$DBMemberID'");
 }
 head('index.php');
}
			echo'
			
</tr>';

echo'
<tr><td class=cat_new colspan=2>'.$lang['others']['members_now'].'</td></tr><tr><td style="font-size:12px;"><center>'.$lang['home']['members'].' <font color=red>'.$members_online.'</font><br>'.$lang['home']['the_moderator'].' <font color=red>'.$moderators_online.'</font>';if (mlv > 2){echo'<br>'.$lang['home']['the_monitor'].' <font color=red>'.$monitors_online.'</font>';echo'<br>'.$lang['members']['deputy_monitor'].': <font color=red>'.$deputy_monitors_online.'</font>';}echo'<br>'.$lang['home']['visitor'].' <font color=red>'.$visitors_online.'</font></table></td><td width=99% valign=top><table dir="rtl" border=0 width=100% cellspacing=1 cellpadding=0 class=maingrid><table dir="rtl" border=0 width=100% cellspacing=1 cellpadding=0 class=maingrid>	<center>	<table class="grid" cellSpacing="1" cellPadding="1" width="100%" border="0" dir=rtl>';		if ($Mlevel == 4){	echo'					<tr>					<td class="cat_new" align="middle" colspan=11>						<a href="index.php?mode=add_cat_forum&method=add&type=c">'.icons($folder_new, $lang['home']['add_new_cat'], "hspace=\"3\"").'</a>						<a href="index.php?mode=order">'.icons($folder_new_order, $lang['home']['order_cat_and_forum'], "hspace=\"3\"").'</a>						<a href="index.php?mode=other_cat_add&method=cat">'.icons($folder_other_cat, $lang['other_cat_forum']['add_cat'], "hspace=\"3\"").'</a>						<a href="index.php?mode=ihdaa_add&method=forum">'.icons($folder_other_forum, $lang['ihdaa']['active'], "hspace=\"3\"").'</a>					</td>				</tr>';	}
			$cat = DBi::$con->query("SELECT * FROM ".$Prefix."CATEGORY WHERE SITE_ID = '$Site_ID' OR SITE_ID = '0' ORDER BY CAT_ORDER ASC") or die (DBi::$con->error); // category mysql
			$c_num = $cat->num_rows;
			if ($c_num <= 0) {
				echo'
				<tr>
					<td class="f1" vAlign="center" align="middle"><br><br>'.$lang['home']['no_cat'].'<br><br><br></td>
				</tr>';
			}
			else{

				while ($r_cat = $cat->fetch_array()) { //category while start
					$cat_id = $r_cat['CAT_ID'];
					$cat_name = $r_cat['CAT_NAME'];
					$cat_status = $r_cat['CAT_STATUS'];
					$cat_monitor = $r_cat['CAT_MONITOR'];
					$cat_deputy_monitor = $r_cat['CAT_DEPUTY_MONITOR'];
					$cat_index = $r_cat['SHOW_INDEX'];
					$cat_hide = cat("HIDE", $cat_id);
					$check_cat_login = check_cat_login($cat_id);
					$cat_level = $r_cat['CAT_LEVEL'];
					if ($cat_level == 0 OR $cat_level > 0 AND $cat_level <= $Mlevel) {

					if ($cat_hide == 0 OR $cat_hide == 1 AND $check_cat_login == 1) {
					
					echo'
					<tr>
											<td class="cat_new" width="5%"><nobr><a href="index.php?mode=c&c='.$cat_id.'">'.icons($folder).'</a></nobr></td>

						<td class="cat_new" width="50%"><nobr>'.$cat_name.'</nobr></td>';
                                            if ($Mlevel == 4) {
                       echo '<td class="cat_new"><nobr><a href="index.php?mode=admin_svc&type=forumsorder">'.icons($icon_arrowup).icons($icon_arrowdown).'</a></nobr></td>';
}
						echo'<td class="cat_new"><nobr>'.$lang['home']['topics'].'</nobr></td>
						<td class="cat_new"><nobr>'.$lang['home']['posts'].'</nobr></td>
						<td class="cat_new"><nobr>'.icons($icon_group).'</nobr></td>
						<td class="cat_new"><nobr>'.$lang['home']['last_post'].'</nobr></td>
						<td class="cat_new"><nobr>'.$lang['home']['monitors'].'</nobr></td>
						<td class="cat_new"><nobr>'.$lang['home']['depury_monitors'].'</nobr></td>
						<td class="cat_new" width="30%"><nobr>'.$lang['home']['moderators'].'</nobr></td>';
						if ($Mlevel == 4) {
							echo'
							<td class="cat_new" vAlign="middle" align="middle"><nobr>
								<a href="index.php?mode=add_cat_forum&method=add&type=f&c='.$cat_id.'">'.icons($folder_new, $lang['home']['add_new_forum'], "hspace=\"3\"").'</a>
								<a href="index.php?mode=add_cat_forum&method=edit&type=c&c='.$cat_id.'">'.icons($folder_new_edit, $lang['home']['edit_cat'], "hspace=\"3\"").'</a>';
							if ($cat_status == 1) {
								echo'
								<a href="index.php?mode=lock&type=c&c='.$cat_id.'"  onclick="return confirm(\''.$lang['home']['you_are_sure_to_lock_this_cat'].'\');">'.icons($folder_new_locked, $lang['home']['lock_cat'], "hspace=\"3\"").'</a>';
							}
							if ($cat_status == 0) {
								echo'
								<a href="index.php?mode=open&type=c&c='.$cat_id.'"  onclick="return confirm(\''.$lang['home']['you_are_sure_to_open_this_cat'].'\');">'.icons($folder_new_unlocked, $lang['home']['open_cat'], "hspace=\"3\"").'</a>';
							}
							echo'<a href="index.php?mode=delete&type=c&c='.$cat_id.'"  onclick="return confirm(\''.$lang['home']['you_are_sure_to_delete_this_cat'].'\');">'.icons($folder_new_delete, $lang['home']['delete_cat'], "hspace=\"3\"").'</a>
							</nobr></td>';
						}
					echo'
					</tr>';
					$forums = DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE CAT_ID = '$cat_id' ORDER BY F_ORDER ASC") or die (DBi::$con->error); // forum mysql
					$f_num = $forums->num_rows;
					if ($f_num <= 0) {
						echo'
						<tr>
							<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$lang['home']['no_forums'].'<br><br><br></td>
						</tr>';
					}
					else{
						while ($r_forum = $forums->fetch_array()) { // forum while start
							$forum_id = $r_forum['FORUM_ID'];
							$f_level = $r_forum['F_LEVEL'];
							$f_hide = forums("HIDE", $forum_id);
							$check_forum_login = check_forum_login($forum_id);

           if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
							if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
								home($forum_id,$r_forum);
							}}
							
						// forum while end
						}
					}
					}}
				 // category while end
				}
			}

			echo'
			</table>
			</td>
		</tr>
	</table>
	</center>';

include("other_cat_info.php");

/////////////////
echo'
<table class="grid" width="100%" cellSpacing="1" cellPadding="4" border="0">
';
if($another_forum == 1) {
echo'	
<tr>
<td class="cat_new" vAlign="top" colSpan="1">&nbsp;<b><a href="'.$site_name2.'"><font color="white">'.$forum_title2.'</font>
</tr>
<tr>';

	echo'
<td class="f11">';


$sql_cat = DBi::$con->query("SELECT * FROM ".prefix."CATEGORY WHERE SITE_ID = '$Site_After' OR SITE_ID = '0' ORDER BY CAT_ORDER ASC");
$num_cat = mysqli_num_rows($sql_cat);
$x_cat = 0;
while ($x_cat < $num_cat) {
$cat_id = mysqli_result($sql_cat, $x_cat, "CAT_ID");	
$cat_level = mysqli_result($sql_cat, $x_cat, "CAT_LEVEL");	
$cat_hide = mysqli_result($sql_cat, $x_cat, "CAT_HIDE");
$check_cat_login = check_cat_login($cat_id);

$sql_forum = DBi::$con->query("SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$cat_id' ORDER BY F_ORDER ASC");
$num_forum = mysqli_num_rows($sql_forum);
$x_forum = 0;
while ($x_forum < $num_forum) {
$f_id = mysqli_result($sql_forum, $x_forum, "FORUM_ID");	
$f_subject = mysqli_result($sql_forum, $x_forum, "F_SUBJECT");	
$f_level = mysqli_result($sql_forum, $x_forum, "F_LEVEL");	
$f_hide = mysqli_result($sql_forum, $x_forum, "F_HIDE");
$check_forum_login = check_forum_login($f_id);

if ($cat_level == 0 OR $cat_level > 0 AND $cat_level <= $Mlevel) {
if ($cat_hide == 0 OR $cat_hide == 1 AND $check_cat_login == 1) {
if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){echo'
<a class="menu" style="font-size:9pt" href="'.$site_name2.'/index.php?mode=f&f='.$f_id.'">'.$f_subject.'</a>&nbsp;&nbsp;<font color="red">*</font>
';
}
}
}
}
++$x_forum;
}
++$x_cat;
}
echo'
</td>
</tr>
';
}
echo'
</table>
';
////////////////
}

?>

