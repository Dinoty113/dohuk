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


$last_topics = ''.$site_name.'/'.index().'?mode=active';	
$active_replies_topics = ''.$site_name.'/'.index().'?mode=active&active=hot';
$active_reads_topics = ''.$site_name.'/'.index().'?mode=active&active=read';
$monitor_topics = ''.$site_name.'/'.index().'?mode=active&active=monitored';
$top_topics = ''.$site_name.'/'.index().'?mode=active&active=top';
$private_topics = ''.$site_name.'/'.index().'?mode=active&active=private';
$friends_topics = ''.$site_name.'/'.index().'?mode=active&active=friends';
$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

require_once("./engine/active_function.php");
if($active != "" AND $active != "friends" AND $active != "private" AND $active != "monitored" AND $active != "top" AND $active != "read" AND $active != "hot"){
	header("Location: ".index()."");
}
if ($active == "") {

if (members("ACTIVE", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][active].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}



$text = $lang['active']['active'];
$text2 = $lang['active']['no_active'];


echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td width="100%"><font size="4" color="red"><b>'.$text.'</b></font></td>';
				echo'
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['active']['option_topic'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
    <option value="'.$last_topics.'" '.check_select($url, $last_topics).'>'.$lang['active']['last_posts_in_all_topics'].'</option>
    <option value="'.$active_replies_topics.'" '.check_select($url, $active_replies_topics).'>'.$lang['active']['active_with_reply'].'</option>
    <option value="'.$active_reads_topics.'" '.check_select($url, $active_reads_topics).'>'.$lang['active']['active_with_counts'].'</option>
    <option value="'.$monitor_topics.'" '.check_select($url, $monitor_topics).'>'.$lang['active']['your_monitor'].'</option>
    <option value="'.$top_topics.'" '.check_select($url, $top_topics).'>'.$lang['active']['top_topics'].'</option>
    <option value="'.$private_topics.'" '.check_select($url, $private_topics).'>'.$lang['active']['hidden_topic_open_to_you'].'</option>
    <option value="'.$friends_topics.'" '.check_select($url, $friends_topics).'>'.$lang['active']['friends_active'].'</option>
	
</select>  
					</td>
					</form>';
				refresh_time();
                go_to_forum();
			echo'
			</tr>
		</table>
		<table bgcolor="gray" class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
			<tr>
				<td>
				<table cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="15%">'.$lang['active']['forum'].'</td>
						<td class="cat">&nbsp;</td>
						<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
						<td class="cat" width="15%">'.$lang['active']['author'].'</td>
						<td class="cat">'.$lang['active']['reply'].'</td>
						<td class="cat">'.$lang['active']['counts'].'</td>
						<td class="cat" width="15%">'.$lang['active']['last_reply'].'</td>';
					if ($Mlevel > 0) {
						echo'<td class="cat" width="1%">&nbsp;</td>';
					}
					echo'
					</tr>';
					
			$sql_open = "WHERE T_UNMODERATED = '0' AND T_HOLDED = '0' AND T_STATUS != '2' AND T_HIDDEN = '0' AND T_REPLIES > '0'";


		$topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS AS T ".$sql_open." ORDER BY T.T_LAST_POST_DATE DESC LIMIT 50") or die (DBi::$con->error);
		$num = mysqli_num_rows($topics);
		if ($num <= 0) {
					echo'
					<tr>
						<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$text2.'<br><br><br></td>
					</tr>';
		}
		else{
			$i = 0;
			while ($i < $num) {
				$topic_id = mysqli_result($topics, $i, "TOPIC_ID");
				$forum_id = topics("FORUM_ID", $topic_id);
				$f_level = forums("F_LEVEL", $forum_id);
				$f_hide = forums("HIDE", $forum_id);
				$check_forum_login = check_forum_login($forum_id);

			if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
				if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
					active($topic_id);
				}
			}
				
			++$i;
			}
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

} // active var == ""

if ($active == "friends") {

if (members("ACTIVE", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][active].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}



$text = $lang['active']['friends_active'];
$text2 = $lang['active']['no_friends_active_topics'];


echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td width="100%"><font size="4" color="red"><b>'.$text.'</b></font></td>';
				echo'
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['active']['option_topic'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
    <option value="'.$last_topics.'" '.check_select($url, $last_topics).'>'.$lang['active']['last_posts_in_all_topics'].'</option>
    <option value="'.$active_replies_topics.'" '.check_select($url, $active_replies_topics).'>'.$lang['active']['active_with_reply'].'</option>
    <option value="'.$active_reads_topics.'" '.check_select($url, $active_reads_topics).'>'.$lang['active']['active_with_counts'].'</option>
    <option value="'.$monitor_topics.'" '.check_select($url, $monitor_topics).'>'.$lang['active']['your_monitor'].'</option>
    <option value="'.$top_topics.'" '.check_select($url, $top_topics).'>'.$lang['active']['top_topics'].'</option>
    <option value="'.$private_topics.'" '.check_select($url, $private_topics).'>'.$lang['active']['hidden_topic_open_to_you'].'</option>
    <option value="'.$friends_topics.'" '.check_select($url, $friends_topics).'>'.$lang['active']['friends_active'].'</option>
</select>  
					</td>
					</form>';
				refresh_time();
                go_to_forum();
			echo'
			</tr>
		</table>
		<table bgcolor="gray" class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
			<tr>
				<td>
				<table cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="15%">'.$lang['active']['forum'].'</td>
						<td class="cat">&nbsp;</td>
						<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
						<td class="cat" width="15%">'.$lang['active']['author'].'</td>
						<td class="cat">'.$lang['active']['reply'].'</td>
						<td class="cat">'.$lang['active']['counts'].'</td>
						<td class="cat" width="15%">'.$lang['active']['last_reply'].'</td>';
					if ($Mlevel > 0) {
						echo'<td class="cat" width="1%">&nbsp;</td>';
					}
					echo'
					</tr>';
					
			$sql_open = "AND T.T_UNMODERATED = '0' AND T.T_HOLDED = '0' AND T.T_STATUS != '2' AND T.T_HIDDEN = '0' AND T.T_REPLIES > '0'";


		$topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS AS T INNER JOIN ".$Prefix."LIST_M AS L ON (T.T_AUTHOR = L.USER) WHERE L.M_ID = '$DBMemberID' AND L.CAT_ID = '-1' ".$sql_open." ORDER BY T.T_LAST_POST_DATE DESC LIMIT 50") or die (DBi::$con->error);
		$num = mysqli_num_rows($topics);
		if ($num <= 0) {
					echo'
					<tr>
						<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$text2.'<br><br><br></td>
					</tr>';
		}
		else{
			$i = 0;
			while ($i < $num) {
				$topic_id = mysqli_result($topics, $i, "TOPIC_ID");
				$forum_id = topics("FORUM_ID", $topic_id);
				$f_level = forums("F_LEVEL", $forum_id);
				$f_hide = forums("HIDE", $forum_id);
				$check_forum_login = check_forum_login($forum_id);

			if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
				if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
					active($topic_id);
				}
			}
				
			++$i;
			}
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

} // active var == "friends"

if ($active == "hot") {


$text = $lang['active']['active'];
$text2 = $lang['active']['no_active'];

echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td width="100%"><font size="4" color="red"><b>'.$text.'</b></font></td>';
				echo'
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['active']['option_topic'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
    <option value="'.$last_topics.'" '.check_select($url, $last_topics).'>'.$lang['active']['last_posts_in_all_topics'].'</option>
    <option value="'.$active_replies_topics.'" '.check_select($url, $active_replies_topics).'>'.$lang['active']['active_with_reply'].'</option>
    <option value="'.$active_reads_topics.'" '.check_select($url, $active_reads_topics).'>'.$lang['active']['active_with_counts'].'</option>
    <option value="'.$monitor_topics.'" '.check_select($url, $monitor_topics).'>'.$lang['active']['your_monitor'].'</option>
    <option value="'.$top_topics.'" '.check_select($url, $top_topics).'>'.$lang['active']['top_topics'].'</option>
    <option value="'.$private_topics.'" '.check_select($url, $private_topics).'>'.$lang['active']['hidden_topic_open_to_you'].'</option>
    <option value="'.$friends_topics.'" '.check_select($url, $friends_topics).'>'.$lang['active']['friends_active'].'</option>
	
</select> 
					</td>
					</form>';
				refresh_time();
                go_to_forum();
			echo'
			</tr>
		</table>
		<table bgcolor="gray" class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
			<tr>
				<td>
				<table cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="15%">'.$lang['active']['forum'].'</td>
						<td class="cat">&nbsp;</td>
						<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
						<td class="cat" width="15%">'.$lang['active']['author'].'</td>
						<td class="cat">'.$lang['active']['reply'].'</td>
						<td class="cat">'.$lang['active']['counts'].'</td>
						<td class="cat" width="15%">'.$lang['active']['last_reply'].'</td>';
					if ($Mlevel > 0) {
						echo'<td class="cat" width="1%">&nbsp;</td>';
					}
					echo'
					</tr>';

		$sql_open = "WHERE T_UNMODERATED = '0' AND T_HOLDED = '0' AND T_STATUS != '2' AND T_HIDDEN = '0' AND T_REPLIES > '19'";

		$topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS AS T ".$sql_open." ORDER BY T.T_LAST_POST_DATE DESC LIMIT 50") or die (DBi::$con->error);
		$num = mysqli_num_rows($topics);
		if ($num <= 0) {
					echo'
					<tr>
						<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$text2.'<br><br><br></td>
					</tr>';
		}
		else{
			$i = 0;
			while ($i < $num) {
				$topic_id = mysqli_result($topics, $i, "TOPIC_ID");
				$forum_id = topics("FORUM_ID", $topic_id);
				$f_hide = forums("HIDE", $forum_id);
				$check_forum_login = check_forum_login($forum_id);
				
				$f_level = forums("F_LEVEL", $forum_id);
			if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){				
				if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
					active($topic_id);
				}
			}
				
			++$i;
			}
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

} // active var == "hot"


if ($active == "read") {


$text = $lang['active']['active'];
$text2 = $lang['active']['no_active'];

echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td width="100%"><font size="4" color="red"><b>'.$text.'</b></font></td>';
				echo'
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['active']['option_topic'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
    <option value="'.$last_topics.'" '.check_select($url, $last_topics).'>'.$lang['active']['last_posts_in_all_topics'].'</option>
    <option value="'.$active_replies_topics.'" '.check_select($url, $active_replies_topics).'>'.$lang['active']['active_with_reply'].'</option>
    <option value="'.$active_reads_topics.'" '.check_select($url, $active_reads_topics).'>'.$lang['active']['active_with_counts'].'</option>
    <option value="'.$monitor_topics.'" '.check_select($url, $monitor_topics).'>'.$lang['active']['your_monitor'].'</option>
    <option value="'.$top_topics.'" '.check_select($url, $top_topics).'>'.$lang['active']['top_topics'].'</option>
    <option value="'.$private_topics.'" '.check_select($url, $private_topics).'>'.$lang['active']['hidden_topic_open_to_you'].'</option>
    <option value="'.$friends_topics.'" '.check_select($url, $friends_topics).'>'.$lang['active']['friends_active'].'</option>
	
</select>
					</td>
					</form>';
				refresh_time();
                go_to_forum();
			echo'
			</tr>
		</table>
		<table bgcolor="gray" class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
			<tr>
				<td>
				<table cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="15%">'.$lang['active']['forum'].'</td>
						<td class="cat">&nbsp;</td>
						<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
						<td class="cat" width="15%">'.$lang['active']['author'].'</td>
						<td class="cat">'.$lang['active']['reply'].'</td>
						<td class="cat">'.$lang['active']['counts'].'</td>
						<td class="cat" width="15%">'.$lang['active']['last_reply'].'</td>';
					if ($Mlevel > 0) {
						echo'<td class="cat" width="1%">&nbsp;</td>';
					}
					echo'
					</tr>';

			$sql_open = "WHERE T_UNMODERATED = '0' AND T_HOLDED = '0' AND T_STATUS != '2' AND T_HIDDEN = '0' AND T_COUNTS > '99'";

		$topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS AS T ".$sql_open." ORDER BY T.T_LAST_POST_DATE DESC LIMIT 50") or die (DBi::$con->error);
		$num = mysqli_num_rows($topics);
		if ($num <= 0) {
					echo'
					<tr>
						<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$text2.'<br><br><br></td>
					</tr>';
		}
		else{
			$i = 0;
			while ($i < $num) {
				$topic_id = mysqli_result($topics, $i, "TOPIC_ID");
				$forum_id = topics("FORUM_ID", $topic_id);
				$f_hide = forums("HIDE", $forum_id);
				$check_forum_login = check_forum_login($forum_id);
				$f_level = forums("F_LEVEL", $forum_id);
				
			if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){				
				if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
					active($topic_id);
				}
			}
			++$i;
			}
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

} // active var == "read"


if ($active == "top") {


$text = $lang['active']['top_topics'];
$text2 = $lang['active']['no_top_topics'];

echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td width="100%"><font size="4" color="red"><b>'.$text.'</b></font></td>';
				echo'
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['active']['option_topic'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
    <option value="'.$last_topics.'" '.check_select($url, $last_topics).'>'.$lang['active']['last_posts_in_all_topics'].'</option>
    <option value="'.$active_replies_topics.'" '.check_select($url, $active_replies_topics).'>'.$lang['active']['active_with_reply'].'</option>
    <option value="'.$active_reads_topics.'" '.check_select($url, $active_reads_topics).'>'.$lang['active']['active_with_counts'].'</option>
    <option value="'.$monitor_topics.'" '.check_select($url, $monitor_topics).'>'.$lang['active']['your_monitor'].'</option>
    <option value="'.$top_topics.'" '.check_select($url, $top_topics).'>'.$lang['active']['top_topics'].'</option>
    <option value="'.$private_topics.'" '.check_select($url, $private_topics).'>'.$lang['active']['hidden_topic_open_to_you'].'</option>
    <option value="'.$friends_topics.'" '.check_select($url, $friends_topics).'>'.$lang['active']['friends_active'].'</option>
	
</select>  
					</td>
					</form>';
				refresh_time();
                go_to_forum();
			echo'
			</tr>
		</table>
		<table bgcolor="gray" class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
			<tr>
				<td>
				<table cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="15%">'.$lang['active']['forum'].'</td>
						<td class="cat">&nbsp;</td>
						<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
						<td class="cat" width="15%">'.$lang['active']['author'].'</td>
						<td class="cat">'.$lang['active']['reply'].'</td>
						<td class="cat">'.$lang['active']['counts'].'</td>
						<td class="cat" width="15%">'.$lang['active']['last_reply'].'</td>';
					if ($Mlevel > 0) {
						echo'<td class="cat" width="1%">&nbsp;</td>';
					}
					echo'
					</tr>';

			$sql_open = "WHERE T_UNMODERATED = '0' AND T_HOLDED = '0' AND T_STATUS != '2' AND T_HIDDEN = '0' AND T_TOP = '2'";

		$topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS AS T ".$sql_open." ORDER BY T.T_LAST_POST_DATE DESC LIMIT 50") or die (DBi::$con->error);
		$num = mysqli_num_rows($topics);
		if ($num <= 0) {
					echo'
					<tr>
						<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$text2.'<br><br><br></td>
					</tr>';
		}
		else{
			$i = 0;
			while ($i < $num) {
				$topic_id = mysqli_result($topics, $i, "TOPIC_ID");
				$forum_id = topics("FORUM_ID", $topic_id);
				$f_hide = forums("HIDE", $forum_id);
				$check_forum_login = check_forum_login($forum_id);
				$f_level = forums("F_LEVEL", $forum_id);
				
			if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){				
				if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
					active($topic_id);
				}
			}
			++$i;
			}
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

} // active var == "read"


if ($active == "private") {

	if(mlv == 0) {
		redirect();
	}
$text = $lang['active']['hidden_topic_open_to_you'];
$text2 = $lang['active']['no_hidden_topic_open_to_you'];


echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td width="100%"><font size="4" color="red"><b>'.$text.'</b></font></td>';
				echo'
						<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['active']['option_topic'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
    <option value="'.$last_topics.'" '.check_select($url, $last_topics).'>'.$lang['active']['last_posts_in_all_topics'].'</option>
    <option value="'.$active_replies_topics.'" '.check_select($url, $active_replies_topics).'>'.$lang['active']['active_with_reply'].'</option>
    <option value="'.$active_reads_topics.'" '.check_select($url, $active_reads_topics).'>'.$lang['active']['active_with_counts'].'</option>
    <option value="'.$monitor_topics.'" '.check_select($url, $monitor_topics).'>'.$lang['active']['your_monitor'].'</option>
    <option value="'.$top_topics.'" '.check_select($url, $top_topics).'>'.$lang['active']['top_topics'].'</option>
    <option value="'.$private_topics.'" '.check_select($url, $private_topics).'>'.$lang['active']['hidden_topic_open_to_you'].'</option>
    <option value="'.$friends_topics.'" '.check_select($url, $friends_topics).'>'.$lang['active']['friends_active'].'</option>
	
</select> 
					</td>
					</form>';
				refresh_time();
                go_to_forum();
			echo'
			</tr>
		</table>
		<table bgcolor="gray" class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
			<tr>
				<td>
				<table cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="15%">'.$lang['active']['forum'].'</td>
						<td class="cat">&nbsp;</td>
						<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
						<td class="cat" width="15%">'.$lang['active']['author'].'</td>
						<td class="cat">'.$lang['active']['reply'].'</td>
						<td class="cat">'.$lang['active']['counts'].'</td>
						<td class="cat" width="15%">'.$lang['active']['last_reply'].'</td>';
					if ($Mlevel > 0) {
						echo'<td class="cat" width="1%">&nbsp;</td>';
					}
					echo'
					</tr>';
			$sql_open = "INNER JOIN ".$Prefix."TOPIC_MEMBERS AS P WHERE T.TOPIC_ID = P.TOPIC_ID AND T.T_HIDDEN = '1' AND T.T_UNMODERATED = '0' AND T.T_HOLDED = '0' AND T.T_STATUS != '2' AND P.MEMBER_ID = '$DBMemberID'";


		$topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS AS T ".$sql_open." ORDER BY T.T_LAST_POST_DATE DESC LIMIT 50") or die (DBi::$con->error);
		$num = mysqli_num_rows($topics);
		if ($num <= 0) {
					echo'
					<tr class="fixed">
						<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$text2.'<br><br><br></td>
					</tr>';
		}					
			$i = 0;
			while ($i < $num) {
				$topic_id = mysqli_result($topics, $i, "TOPIC_ID");
				$forum_id = topics("FORUM_ID", $topic_id);
				$f_hide = forums("HIDE", $forum_id);
				$check_forum_login = check_forum_login($forum_id);
				$f_level = forums("F_LEVEL", $forum_id);
				
			if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
				if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
					active_private($topic_id);
				}
			}
	
				
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

} // active var == "private"
if ($active == "monitored") {
	
	if(mlv == 0) {
		redirect();
	}
	
					if (members("MONITORED", $DBMemberID) == 1  ) {
	                echo'
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][monitored].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                </center>';
exit();
}


$text = $lang['active']['your_monitor'];
$text2 = $lang['active']['monitor_description'];



echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td width="100%"><font size="4" color="red"><b>'.$text.'</b></font></td>';
				echo'
					<form method="post">
					<td class="optionsbar_menus"><nobr>'.$lang['active']['option_topic'].'</nobr><br>
<select onchange="location = this.options[this.selectedIndex].value;" class="men"> 
    <option value="'.$last_topics.'" '.check_select($url, $last_topics).'>'.$lang['active']['last_posts_in_all_topics'].'</option>
    <option value="'.$active_replies_topics.'" '.check_select($url, $active_replies_topics).'>'.$lang['active']['active_with_reply'].'</option>
    <option value="'.$active_reads_topics.'" '.check_select($url, $active_reads_topics).'>'.$lang['active']['active_with_counts'].'</option>
    <option value="'.$monitor_topics.'" '.check_select($url, $monitor_topics).'>'.$lang['active']['your_monitor'].'</option>
    <option value="'.$top_topics.'" '.check_select($url, $top_topics).'>'.$lang['active']['top_topics'].'</option>
    <option value="'.$private_topics.'" '.check_select($url, $private_topics).'>'.$lang['active']['hidden_topic_open_to_you'].'</option>
    <option value="'.$friends_topics.'" '.check_select($url, $friends_topics).'>'.$lang['active']['friends_active'].'</option>
	
</select>
					</td>
					</form>';
				refresh_time();
                go_to_forum();
			echo'
			</tr>
		</table>
		<table bgcolor="gray" class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
			<tr>
				<td>
				<table cellSpacing="1" cellPadding="2" width="100%" border="0">
					<tr>
						<td class="cat" width="15%">'.$lang['active']['forum'].'</td>
						<td class="cat">&nbsp;</td>
						<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
						<td class="cat" width="15%">'.$lang['active']['author'].'</td>
						<td class="cat">'.$lang['active']['reply'].'</td>
						<td class="cat">'.$lang['active']['counts'].'</td>
						<td class="cat" width="15%">'.$lang['active']['last_reply'].'</td>';
					if ($Mlevel > 0) {
						echo'<td class="cat" width="1%">&nbsp;</td>';
					}
					echo'
					</tr>';
					

		$sql_open = "INNER JOIN ".$Prefix."FAVOURITE_TOPICS AS F WHERE T.TOPIC_ID = F.F_TOPICID AND F.F_MEMBERID = '$DBMemberID'";

		$topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS AS T ".$sql_open." ORDER BY T.T_LAST_POST_DATE DESC LIMIT 50") or die (DBi::$con->error);
		$num = mysqli_num_rows($topics);
		if ($num <= 0) {
					echo'
					<tr>
						<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$text2.'<br><br><br></td>
					</tr>';
		}
		else{
			$i = 0;
			while ($i < $num) {
				$topic_id = mysqli_result($topics, $i, "TOPIC_ID");
				$forum_id = topics("FORUM_ID", $topic_id);
				$f_hide = forums("HIDE", $forum_id);
				$check_forum_login = check_forum_login($forum_id);
				$f_level = forums("F_LEVEL", $forum_id);
				
			if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
				if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
					active_monitored($topic_id);
				}
			}
				
			++$i;
			}
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

} // active var == "monitored"



?>