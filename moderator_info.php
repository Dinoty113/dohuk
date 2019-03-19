<?
/*
if (@eregi("moderator_info.php","$_SERVER[PHP_SELF]")) {
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
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}
@require_once("./engine/forum_function.php");

function new_mods_mail($f){
	global $Prefix;
	$f = abs2($f);
	$new_pm = @DBi::$con->query("SELECT count(*) FROM ".$Prefix."PM WHERE PM_MID = '$f' AND PM_OUT = '0' AND PM_READ = '0' AND PM_STATUS = '1' ") or die(DBi::$con->error);
	$count = @mysqli_result($new_pm, 0, "count(*)");
	if ($count > 0) {
		$forum_pm = $count;
	}
	else {
		$forum_pm = "0";
	}
return($forum_pm);
}

function first_moderator_info() {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."MODERATOR WHERE MEMBER_ID = '".m_id."' ") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
		$f = @mysqli_result($sql, $x, "FORUM_ID");
		$subject = forums("SUBJECT", $f);
		$mail = new_mods_mail($f);
        $nofity = nofity_wait($f, "wait");
        $nofity_admin = nofity_wait($f, "admin");
		$href = '<a href="index.php?mode=f&f='.$f.'">'.$subject.'</a>';
		if ($mail > 0 or $nofity > 0 or $nofity_admin > 0) { $tr_class = "normal"; }
		else { $tr_class = "deleted"; }
		echo'
		<tr class="'.$tr_class.'">
			<td class="list_small">'.$href.'</td>
			<td class="list_center"><a href="index.php?mode=pm&mail=new&m='.abs2($f).'">'.$mail.'</a></td>
            <td class="list_center"><a href="index.php?mode=notifylist&f='.$f.'">'.$nofity.'</a></td>
				<td class="list_center"><a href="index.php?mode=notifylist&f='.$f.'&method=admin">'.$nofity_admin.'</a></td>
		</tr>';
		++$x;
		}
}

function first_monitor_info() {
global $deputy;	
	if($deputy == 0) {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."CATEGORY WHERE CAT_MONITOR = '".m_id."' ") or die (DBi::$con->error);
	}
	if($deputy == 1) {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."CATEGORY WHERE CAT_DEPUTY_MONITOR = '".m_id."' ") or die (DBi::$con->error);
	}
	$num = @mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
		$c = @mysqli_result($sql, $x, "CAT_ID");
		$forums = @DBi::$con->query("SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$c' ") or die (DBi::$con->error);
		$rows = @mysqli_num_rows($forums);
			$i = 0;
			while ($i < $rows) {
			$f = @mysqli_result($forums, $i, "FORUM_ID");
			$subject = forums("SUBJECT", $f);
			$mail = new_mods_mail($f);
            $nofity = nofity_wait($f, "wait");
            $nofity_admin = nofity_wait($f, "admin");
			$href = '<a href="index.php?mode=f&f='.$f.'">'.$subject.'</a>';
			if ($mail > 0 or $nofity > 0 or $nofity_admin > 0) { $tr_class = "normal"; }
			else { $tr_class = "deleted"; }
			echo'
			<tr class="'.$tr_class.'">
				<td class="list_small">'.$href.'</td>
				<td class="list_center"><a href="index.php?mode=pm&mail=new&m='.abs2($f).'">'.$mail.'</a></td>
				<td class="list_center"><a href="index.php?mode=notifylist&f='.$f.'">'.$nofity.'</a></td>
				<td class="list_center"><a href="index.php?mode=notifylist&f='.$f.'&method=admin">'.$nofity_admin.'</a></td>
			</tr>';
			++$i;
			}
		++$x;
		}
}

function first_administrator_info() {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."FORUM ") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
		$f = @mysqli_result($sql, $x, "FORUM_ID");
		$subject = forums("SUBJECT", $f);
		$mail = new_mods_mail($f);
        $nofity = nofity_wait($f, "wait");
        $nofity_admin = nofity_wait($f, "admin");
		$href = '<a href="index.php?mode=f&f='.$f.'">'.$subject.'</a>';
		if ($mail > 0 or $nofity > 0 or $nofity_admin > 0) { $tr_class = "normal"; }
		else { $tr_class = "deleted"; }
		echo'
		<tr class="'.$tr_class.'">
			<td class="list_small">'.$href.'</td>
			<td class="list_center"><a href="index.php?mode=pm&mail=new&m='.abs2($f).'">'.$mail.'</a></td>
            <td class="list_center"><a href="index.php?mode=notifylist&f='.$f.'">'.$nofity.'</a></td>
				<td class="list_center"><a href="index.php?mode=notifylist&f='.$f.'&method=admin">'.$nofity_admin.'</a></td>
		</tr>';
		++$x;
		}
}

function second_moderator_info() {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."MODERATOR WHERE MEMBER_ID = '".m_id."' ") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
		$f = @mysqli_result($sql, $x, "FORUM_ID");
		$subject = forums("SUBJECT", $f);
		$href = '<a href="index.php?mode=f&f='.$f.'">'.$subject.'</a>';
		$utopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tunmoderated&pg=1">'.unmoderated_topics($f).'</a>';
		$htopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tholded&pg=1">'.holded_topics($f).'</a>';
		$stopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tsocialpen&pg=1">'.social_topics_pen($f).'</a>';
		$ureplies = '<a href="index.php?mode=f&f='.$f.'&mod_option=runmoderated&pg=1">'.unmoderated_replies($f).'</a>';
		$hreplies = '<a href="index.php?mode=f&f='.$f.'&mod_option=rholded&pg=1">'.holded_replies($f).'</a>';
		if (unmoderated_topics($f) > 0 || holded_topics($f) > 0 || social_topics_pen($f) > 0 || unmoderated_replies($f) > 0 || holded_replies($f) > 0) {
		    $tr_class = "normal";
		}
		else {
		    $tr_class = "deleted";
		}
		echo'
		<tr class="'.$tr_class.'">
			<td class="list_small">'.$href.'</td>
			<td class="list_center">'.$utopics.'</td>
			<td class="list_center">'.$htopics.'</td>
			<td class="list_center">'.$stopics.'</td>
			<td class="list_center">'.$ureplies.'</td>
			<td class="list_center">'.$hreplies.'</td>
		</tr>';
		++$x;
		}
}

function second_monitor_info() {
global $deputy;	
	if($deputy == 0) {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."CATEGORY WHERE CAT_MONITOR = '".m_id."' ") or die (DBi::$con->error);
	}
	if($deputy == 1) {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."CATEGORY WHERE CAT_DEPUTY_MONITOR = '".m_id."' ") or die (DBi::$con->error);
	}
	$num = @mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
		$c = @mysqli_result($sql, $x, "CAT_ID");
		$forums = @DBi::$con->query("SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$c' ") or die (DBi::$con->error);
		$rows = @mysqli_num_rows($forums);
			$i = 0;
			while ($i < $rows) {
			$f = @mysqli_result($forums, $i, "FORUM_ID");
			$subject = forums("SUBJECT", $f);
			$href = '<a href="index.php?mode=f&f='.$f.'">'.$subject.'</a>';
			$utopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tunmoderated&pg=1">'.unmoderated_topics($f).'</a>';
			$htopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tholded&pg=1">'.holded_topics($f).'</a>';
			$stopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tsocialpen&pg=1">'.social_topics_pen($f).'</a>';
			$ureplies = '<a href="index.php?mode=f&f='.$f.'&mod_option=runmoderated&pg=1">'.unmoderated_replies($f).'</a>';
			$hreplies = '<a href="index.php?mode=f&f='.$f.'&mod_option=rholded&pg=1">'.holded_replies($f).'</a>';
		if (unmoderated_topics($f) > 0 || holded_topics($f) > 0 || social_topics_pen($f) > 0 || unmoderated_replies($f) > 0 || holded_replies($f) > 0) {
			    $tr_class = "normal";
			}
			else {
			    $tr_class = "deleted";
			}
			echo'
			<tr class="'.$tr_class.'">
				<td class="list_small">'.$href.'</td>
				<td class="list_center">'.$utopics.'</td>
				<td class="list_center">'.$htopics.'</td>
				<td class="list_center">'.$stopics.'</td>				
				<td class="list_center">'.$ureplies.'</td>
				<td class="list_center">'.$hreplies.'</td>
			</tr>';
			++$i;
			}
		++$x;
		}
}

function second_administrator_info() {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."FORUM ") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
		$f = @mysqli_result($sql, $x, "FORUM_ID");
		$subject = forums("SUBJECT", $f);
		$href = '<a href="index.php?mode=f&f='.$f.'">'.$subject.'</a>';
		$utopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tunmoderated&pg=1">'.unmoderated_topics($f).'</a>';
		$htopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tholded&pg=1">'.holded_topics($f).'</a>';
		$stopics = '<a href="index.php?mode=f&f='.$f.'&mod_option=tsocialpen&pg=1">'.social_topics_pen($f).'</a>';		
		$ureplies = '<a href="index.php?mode=f&f='.$f.'&mod_option=runmoderated&pg=1">'.unmoderated_replies($f).'</a>';
		$hreplies = '<a href="index.php?mode=f&f='.$f.'&mod_option=rholded&pg=1">'.holded_replies($f).'</a>';
		if (unmoderated_topics($f) > 0 || holded_topics($f) > 0 || social_topics_pen($f) > 0 || unmoderated_replies($f) > 0 || holded_replies($f) > 0) {
		    $tr_class = "normal";
		}
		else {
		    $tr_class = "deleted";
		}
		echo'
		<tr class="'.$tr_class.'">
			<td class="list_small">'.$href.'</td>
			<td class="list_center">'.$utopics.'</td>
			<td class="list_center">'.$htopics.'</td>
			<td class="list_center">'.$stopics.'</td>			
			<td class="list_center">'.$ureplies.'</td>
			<td class="list_center">'.$hreplies.'</td>
		</tr>';
		++$x;
		}
}

function your_forums_info() {
global $lang;
	if (mlv == 2) {
		$txt = $lang['moderation']['forums_mod'];
	}
	if (mlv == 3) {
		$txt = $lang['moderation']['forums_mon'];
	}
	if (mlv == 4) {
		$txt = $lang['moderation']['forums_all'];
	}
	echo'
	<center>
	<table cellSpacing="1" cellPadding="2" width="99%" border="0">
		<tr>
			<td class="optionsbar_menus" width="100%">&nbsp;<nobr><font color="red" size="+1">'.$txt.'</font></nobr></td>';
			refresh_time();
			go_to_forum();
		echo'
		</tr>
	</table>
	<br>
	<table bgcolor="gray" class="grid" cellSpacing="1" cellPadding="2" width="60%" border="0">
		<tr>
			<td class="cat">'.$lang['active']['forum'].'</td>
			<td class="cat">'.$lang['moderation']['new_mail_mods'].'</td>
			<td class="cat">'.$lang['moderation']['new_notify_mods'].'</td>
			<td class="cat">'.$lang['moderation']['new_admin_notify'].'</td>
		</tr>';
	if (mlv == 2){
			first_moderator_info();
	}
	if (mlv == 3){
			first_monitor_info();
	}
	if (mlv == 4){
			first_administrator_info();
	}
	echo'
	</table>
	<br><br>
	<table bgcolor="gray" class="grid" cellSpacing="1" cellPadding="2" width="60%" border="0">
		<tr>
			<td class="cat">'.$lang['active']['forum'].'</td>
			<td class="cat">'.$lang['moderation']['topics_need_moderate'].'</td>
			<td class="cat">'.$lang['moderation']['topics_holded'].'</td>
			<td class="cat">'.$lang['moderation']['topics_need_social'].'</td>
			<td class="cat">'.$lang['moderation']['replies_need_moderate'].'</td>
			<td class="cat">'.$lang['moderation']['replies_holded'].'</td>
		</tr>';
	if (mlv == 2) {
			second_moderator_info();
	}
	if (mlv == 3) {
			second_monitor_info();
	}
	if (mlv == 4) {
			second_administrator_info();
	}
	echo'
	</table>
	<br>
	<table cellSpacing="1" cellPadding="2" border="0">
		<tr>
			<td align="center">'.$lang['moderation']['this_color_forum'].'</td>
			<td align="center"><table border="1"><tr class="normal"><td>&nbsp;&nbsp;&nbsp;</td></tr></table></td>
			<td align="center">'.$lang['moderation']['have_unmoderate_topic'].'</td>
		</tr>
		<tr>
			<td align="center" colSpan="6"><br><font color="red">'.$lang['moderation']['moderate_topics_description'].'</font></td>
		</tr>
	</table>
	</center>';
}

if (mlv > 1){
	your_forums_info();
}

?>