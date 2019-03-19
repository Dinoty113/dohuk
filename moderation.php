<?
if (@eregi("moderation.php","$_SERVER[PHP_SELF]")) {
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

$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
$date = time();

function make_bitly_url($url,$login,$appkey,$format = 'xml',$version = '2.0.1')
{
	//create the URL
	$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
	
	//get the url
	//could also use cURL here
	$response = file_get_contents($bitly);
	
	//parse depending on desired format
	if(strtolower($format) == 'json')
	{
		$json = @json_decode($response,true);
		return $json['results'][$url]['shortUrl'];
	}
	else //xml
	{
		$xml = simplexml_load_string($response);
		return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
	}
}

function all_forum($f){
	global $Prefix;
	$sql = @DBi::$con->query("SELECT * FROM ".$Prefix."FORUM ORDER BY FORUM_ID ASC ") or die(DBi::$con->error);
	$num = @mysqli_num_rows($sql);
	$x = 0;
	while ($x < $num){
		$forum_id = @mysqli_result($sql, $x, "FORUM_ID");
		$f_subject = @mysqli_result($sql, $x, "F_SUBJECT");
		$f_hide = forums("HIDE", $forum_id);
		$check_forum_login = check_forum_login($forum_id);

		if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){
			echo'<option value="'.$forum_id.'" '.check_select($f, $forum_id).'>'.$f_subject.'</option>';
		}

	++$x;
	}
}

function check_array($check){
	for($x = 0; $x < count($check); $x++){
		$all_id .= $check[$x];
		if ($x+1 != count($check)){
			$all_id .= ', ';
		}
	}
return($all_id);
}

if($type != "th" && $type != "rh" && $type != "r" && $type != "t" && $type != "topics_tools" && $type != "replies_tools" && $type != "tools_left") {
redirect();	
}

if ($type == "th") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
	$f = topics("FORUM_ID", $t);
	$t_holded = topics("HOLDED", $t);
	if($t_holded != 1) {
	if (allowed($f, 2) == 1) {
		$query = "UPDATE ".$Prefix."TOPICS SET ";
		$query .= "T_UNMODERATED = '0', T_HOLDED = '1' ";
		$query .= "WHERE TOPIC_ID = '$t' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("t", $t, "hold");
		topic_details($t);
		if(allowed($f, 2) == 1) {
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
		}
						header("Location: ".$HTTP_REFERER."");

	}
	else {
	redirect();
	}
	} else {
	header("Location: ".$HTTP_REFERER."");	
	}
}
if ($type == "rh") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
	$f = replies("FORUM_ID", $r);
	$t = replies("TOPIC_ID", $r);
	$r_holded = replies("HOLDED", $r);
	if($r_holded != 1) {
	if (allowed($f, 2) == 1) {
		$query = "UPDATE ".$Prefix."REPLY SET ";
		$query .= "R_UNMODERATED = '0', R_HOLDED = '1' ";
		$query .= "WHERE REPLY_ID = '$r' ";
		@DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("r", $r, "hold");
		reply_details($r);
		if(allowed($f, 2) == 1) {
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
		}		

						header("Location: ".$HTTP_REFERER."");

	}
	else {
	redirect();
	}
	} else {
	header("Location: ".$HTTP_REFERER."");	
	}
}

if ($type == "t") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$t_unmoderated = topics("UNMODERATED", $t);
$t_holded = topics("HOLDED", $t);
if($t_unmoderated != 0 or $t_holded != 0) {
	$f = topics("FORUM_ID", $t);	
	if (allowed($f, 2) == 1) {
		$query = "UPDATE ".$Prefix."TOPICS SET ";
		$query .= "T_UNMODERATED = '0', T_HOLDED = '0' ";
		$query .= "WHERE TOPIC_ID = '$t' ";
@		DBi::$con->query($query) or die (DBi::$con->error);
		tr_cmd("t", $t, "moderate");
		topic_details($t, 1, 1, 0);
		if(allowed($f, 2) == 1) {
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
		}		
							header("Location: ".$HTTP_REFERER."");

	}
	else {
	redirect();
	}
} else {
header("Location: ".$HTTP_REFERER."");	
}
}

if ($type == "r") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
	$f = replies("FORUM_ID", $r);
	$t = replies("TOPIC_ID", $r);
	$r_unmoderated = replies("UNMODERATED", $r);
	$r_holded = replies("HOLDED", $r);
	if($r_unmoderated != 0 or $r_holded != 0) {
	if (allowed($f, 2) == 1) {
		$query = "UPDATE ".$Prefix."REPLY SET ";
		$query .= "R_UNMODERATED = '0', R_HOLDED = '0' ";
		$query .= "WHERE REPLY_ID = '$r' ";
@		DBi::$con->query($query) or die (DBi::$con->error);
				tr_cmd("r", $r, "moderate");
		reply_details($r, 1, 1, 0);	
		if(allowed($f, 2) == 1) {
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
		}		
						header("Location: ".$HTTP_REFERER."");

	}
	else {
	redirect();
	}
	} else {
	header("Location: ".$HTTP_REFERER."");	
	}
}

if ($type == "topics_tools") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$x = 0;
$topic_id = $_POST[topic_id];
$social = topics("SOCIAL", $topic_id[$x]);
$subSocial = $_POST[subSocial];
$subApprove = $_POST[subApprove];
$subHold = $_POST[subHold];
$subDelete = $_POST[subDelete];
$author = topics("AUTHOR", $topic_id[$x]);
$author_level = members("LEVEL", $author);
$author_deputy = members("DEPUTY", $author);
$author_hold_posts = members("HOLD_POSTS", $author);
$author_hold_active = members("HOLD_ACTIVE", $author);
    if (allowed($f, 2) == 1) {
		if ($subSocial != "" && $social == 1) {
			$update = "T_SOCIAL = ('2') ";
			$text = $lang['moderation']['topic_social'];
		}	
		if ($subSocialRefuse != "" && $social == 1) {
			$update = "T_SOCIAL = ('0') ";
			$text = $lang['moderation']['topic_social_refused'];
		}			
		if ($subApprove != "") {
			$update = "T_UNMODERATED = ('0'), T_HOLDED = ('0'), T_STATUS = ('1') ";
			$text = $lang['moderation']['topics_moderate'];
		}		
		if ($subHold != "") {
			$update = "T_HOLDED = ('1'), T_UNMODERATED = ('0'), T_STATUS = ('1') ";
			$text = $lang['moderation']['topics_hold'];
		}
		if ($subHidden != "") {
			$update = "T_HIDDEN = ('0'), T_HOLDED = ('0'), T_UNMODERATED = ('0'), T_STATUS = ('1') ";
			$text = $lang['moderation']['topics_show'];
		}
		if ($subDelete != "") {
			$update = "T_STATUS = ('2'), T_UNMODERATED = ('0'), T_HOLDED = ('0') ";
			$text = $lang['moderation']['topics_delete'];
		}
			$x = 0;
			while($x < count($topic_id)){
				$query = "UPDATE ".$Prefix."TOPICS SET ";
				$query .= $update;
				$query .= "WHERE TOPIC_ID = '$topic_id[$x]' ";
				@DBi::$con->query($query) or die (DBi::$con->error);
			    if ($subHidden != "") {
				hideTopic_info($DBMemberID, $topic_id[$x], "OPEN");
			    }
		if ($subApprove != "") {
			tr_cmd("t", $topic_id[$x], "moderate");	
			topic_details($topic_id[$x], 1, 1, 0);
		}		
		if ($subHold != "") {
			tr_cmd("t", $topic_id[$x], "hold");
			topic_details($topic_id[$x]);
		}
		if ($subHidden != "") {
			tr_cmd("t", $topic_id[$x], "unhide");
			topic_details($topic_id[$x]);
		}
		if ($subDelete != "") {
			tr_cmd("t", $topic_id[$x], "delete");
			topic_details($topic_id[$x]);
		}
		$f = topics("FORUM_ID", $topic_id[$x]);
		if ($subSocial != "") {
		$subject = topics("SUBJECT", $topic_id[$x]);
		require_once 'twitteroauth.php';
		define("CONSUMER_KEY", $consumer_key);
		define("CONSUMER_SECRET", $consumer_secret);
		define("OAUTH_TOKEN", $oauth_token);
		define("OAUTH_SECRET", $oauth_secret);
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_SECRET);
		$content = $connection->get('account/verify_credentials');
		
		$short_link = make_bitly_url(''.$site_name.'/'.index().'?mode=t&t='.$topic_id[$x].'',$login_key,$app_key,'json');
		$social_subject = $subject.'.. #'.$forum_hashtag.' #'.forums("HASHTAG", $f).' '.forum_name($f).' '.$short_link;
		$connection->post('statuses/update', array('status' => $social_subject));	
		}
		if(allowed($f, 2) == 1) {
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
		}		
			++$x;
			}
						header("Location: ".$HTTP_REFERER."");

    }
    else {
    redirect();
    }
}

if ($type == "replies_tools") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$reply_id = $_POST[reply_id];
$subApprove = $_POST[subApprove];
$subHold = $_POST[subHold];
$subDelete = $_POST[subDelete];
$subDeleteDone = $_POST[subDeleteDone];
$subUnDelete = $_POST[subUnDelete];
$x = 0;
    if (allowed($f, 2) == 1) {
		if ($subApprove != "") {
			$update = "R_UNMODERATED = ('0'), R_HOLDED = ('0'), R_STATUS = ('1') ";
			$text = $lang['moderation']['replies_moderate'];
		}
		if ($subHold != "") {
			$update = "R_HOLDED = ('1'), R_UNMODERATED = ('0'), R_STATUS = ('1') ";
			$text = $lang['moderation']['replies_hold'];
		}
		if ($subHidden != "") {
			$update = "R_HIDDEN = ('0'), R_HOLDED = ('0'), R_UNMODERATED = ('0'), R_STATUS = ('1') ";
			$text = $lang['moderation']['replies_show'];
		}
		if ($subDelete != "") {
			$update = "R_STATUS = ('2'), R_UNMODERATED = ('0'), R_HOLDED = ('0') ";
			$text = $lang['moderation']['replies_delete'];
		}
		if ($subUnDelete != "") {
			$update = "R_STATUS = ('1')";
			$text = $lang['forum_function']['done_un_delete_this_reples'];
		}						
			$x = 0;
			while($x < count($reply_id)){
				if($subDeleteDone != "" && $Mlevel == 4) {
				$query = "DELETE FROM ".$Prefix."REPLY ";
				} else {	
				$query = "UPDATE ".$Prefix."REPLY SET ";
				$query .= $update;
				}
				$query .= "WHERE REPLY_ID = '$reply_id[$x]' ";
@				DBi::$con->query($query) or die (DBi::$con->error);
			    if ($subHidden != "") {
				hideReply_info($DBMemberID, $reply_id[$x], "OPEN");
			    }
		if ($subApprove != "") {
			tr_cmd("r", $reply_id[$x], "moderate");
			reply_details($reply_id[$x], 1, 1, 0);
		}
		if ($subHold != "") {
			tr_cmd("r", $reply_id[$x], "hold");
			reply_details($reply_id[$x]);
		}
		if ($subHidden != "") {
			tr_cmd("r", $reply_id[$x], "unhide");		
			reply_details($reply_id[$x]);
		}
		if ($subDelete != "") {
			tr_cmd("r", $reply_id[$x], "delete");
			reply_details($reply_id[$x]);
		}
		if ($subUnDelete != "") {
			tr_cmd("r", $reply_id[$x], "undelete");	
			reply_details($reply_id[$x]);
		}			
		$f = replies("FORUM_ID", $reply_id[$x]);
		if(allowed($f, 2) == 1) {
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
		}		
			++$x;
			}
						header("Location: ".$HTTP_REFERER."");

    }
    else {
    redirect();
    }
}

if ($type == "tools_left") {
if(HoldedMembers($DBMemberID) == 1) {
show_error(43);
}	
$check = $_POST['topic_id'];
    if (allowed($f, 2) == 1) {
	if($method != "move" && $method != "done_move") {	
		if ($method == "moderate") {
			$update = "T_UNMODERATED = ('0'), T_HOLDED = ('0'), T_STATUS = ('1')";
		}	
		if ($method == "hold") {
			$update = "T_HOLDED = ('1'), T_UNMODERATED = ('0'), T_STATUS = ('1') ";
		}	
		if ($method == "hidden") {
			$update = "T_HIDDEN = ('1')";
			$r_t_hidden = 1;
		}
		if ($method == "unhidden") {
			$update = "T_HIDDEN = ('0')";
			$r_t_hidden = 0;
		}
		if ($method == "lock") {
			$update = "T_STATUS = ('0')";
		}
		if ($method == "unlock") {
			$update = "T_STATUS = ('1')";
		}
		if ($method == "del") {
			$update = "T_STATUS = ('2')";		
		}
		if ($method == "sticky") {
			$update = "T_STICKY = ('1')";		
		}
		if ($method == "unsticky") {
			$update = "T_STICKY = ('0')";		
		}
		if ($method == "untop") {
			$update = "T_TOP = ('0')";		
		}
		if ($method == "topstar") {
			$update = "T_TOP = ('1')";		
		}
		if ($method == "topmedal") {
			$update = "T_TOP = ('2')";		
		}
		if ($method == "unlinkforum") {
			$update = "T_LINKFORUM = ('0')";		
		}
		if ($method == "linkforumnormal") {
			$update = "T_LINKFORUM = ('1')";		
		}
		if ($method == "linkforumimportant") {
			$update = "T_LINKFORUM = ('2')";		
		}
		if ($method == "canarchive") {
			$update = "T_ARCHIVE_FLAG = ('1')";		
		}
		if ($method == "cantarchive") {
			$update = "T_ARCHIVE_FLAG = ('0')";		
		}	
		if($method == "authormod") {
			$update = "T_AUTHOR_MOD = ('1')";		
		}
		if($method == "authornormal") {
			$update = "T_AUTHOR_MOD = ('0')";		
		}
			$x = 0;
			while($x < count($check)){
				if($method != "twitter") {
				$query = "UPDATE ".$Prefix."TOPICS SET ";
				$query .= $update;
				$query .= "WHERE TOPIC_ID= '$check[$x]' ";
				@DBi::$con->query($query) or die (DBi::$con->error);
				}
				$topic_social = topics("SOCIAL", $check[$x]);
				if ($method == "twitter") {
				if($topic_social == 2) {	
				$update_social = "T_SOCIAL = ('$topic_social')";
				} else {				
				$update_social = "T_SOCIAL = ('1')";	
				}
				}
				if($method == "twitter") {
				$query = "UPDATE ".$Prefix."TOPICS SET ";
				$query .= $update_social;
				$query .= "WHERE TOPIC_ID= '$check[$x]' ";
				@DBi::$con->query($query) or die (DBi::$con->error);
				}		
				if($method == "hidden" or $method == "unhidden") {
				$query = "UPDATE ".$Prefix."REPLY SET ";
				$query .= "R_T_HIDDEN = ('$r_t_hidden')";
				$query .= "WHERE TOPIC_ID= '$check[$x]' ";
				@DBi::$con->query($query) or die (DBi::$con->error);
				}						
			    if ($method == "unhidden") {
				hideReply_info($DBMemberID, $check[$x], "OPEN");
			    }
			    if ($method == "hidden") {
				hideReply_info($DBMemberID, $check[$x], "HIDE");
			    }
			$t_unmoderated = topics("UNMODERATED", $check[$x]);
			$t_holded = topics("HOLDED", $check[$x]);
			$t_hidden = topics("HIDDEN", $check[$x]);
			$t_status = topics("STATUS", $check[$x]);
			$t_sticky = topics("STICKY", $check[$x]);
		if ($method == "moderate" && ($t_unmoderated != 0 or $t_holded != 0)) {
			tr_cmd("t", $check[$x], "moderate");	
			topic_details($check[$x], 1, 1, 0);			
		}	
		if ($method == "hold" && $t_holded != 0) {
			tr_cmd("t", $check[$x], "hold");		
			topic_details($check[$x]);				
		}
		if ($method == "hidden" && $t_hidden != 1) {
			tr_cmd("t", $check[$x], "hide");		
			topic_details($check[$x]);
			}
		if ($method == "unhidden" && $t_hidden != 0) {
			tr_cmd("t", $check[$x], "unhide");		
			topic_details($check[$x]);
			}
		if ($method == "lock" && $t_status != 0) {
			tr_cmd("t", $check[$x], "lock");		
			}
		if ($method == "unlock" && $t_status != 1) {
			tr_cmd("t", $check[$x], "unlock");		
			}
		if ($method == "del" && $t_status != 2) {
			tr_cmd("t", $check[$x], "delete");		
			topic_details($check[$x]);
			}
		if ($method == "sticky" && $t_sticky != 1) {
			tr_cmd("t", $check[$x], "sticky");		
		}
		if ($method == "unsticky" && $t_sticky != 0) {
			tr_cmd("t", $check[$x], "unsticky");		
		}			
		$f = topics("FORUM_ID", $check[$x]);
		if(allowed($f, 2) == 1) {
		DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
		}				
			++$x;
			}
			header("Location: ".$HTTP_REFERER."");
	}
	if($method == "move") {
	echo'
	<center>
	<form method="POST" name="topic_info" action="index.php?mode=moderate&type=tools_left&f='.$f.'&c='.$c.'&method=done_move">';
	$tarek = check_array($check);
	echo'
	<input name="temy" type="hidden" value="'.$tarek.'">
		<table cellSpacing="1" cellPadding="5" bgColor="gray" border="0">
		<tr class="fixed">
				<td class="cat" colspan="4">'.$lang['forum_function']['move_this_topics_to'].'</td>
				</tr>
		<tr class="fixed">
				<td class="optionheader" colspan="4">'.$lang['forum_function']['topics_will_move'].'</td>
				</tr>				
			<tr class="fixed">
				<td colspan="4" class="list" align="center"><nobr>
				';
				$i = 0;
				while($i < count($check)) {
				echo'<a href="index.php?mode=t&t='.$check[$i].'">'.topics("SUBJECT", $check[$i]).'</a><br>';
				++$i;
				}
				echo'
				</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="optionheader" colspan="1">'.$lang['all']['forum'].'</td>
				<td colspan="3" class="list"><nobr>
				<select class="insidetitle" style="WIDTH: 310px" name="TopicForum">';
				all_forum($f);
				echo'
				</select>
				</nobr></td>
			</tr>			
		<tr class="fixed">
				<td class="list_center" colspan="4"><input type="submit" value="'.$lang['forum_function']['move_this_topics'].'">&nbsp;&nbsp;<input type="button" onclick="location.href=&#39;index.php?mode=f&amp;f='.$f.'&#39;;" value="'.$lang['profile']['reset_info'].'"></td>
			</tr>	
				</table>
				</form>
				</center>
	';
	}
	if($method == "done_move") {
	$temy = DBi::$con->real_escape_string(htmlspecialchars($_POST['temy']));	
	$tarook = explode(", ",$temy);
	$TopicForum = DBi::$con->real_escape_string(intval($_POST['TopicForum']));
	$TopicCat = forums("CAT_ID", $TopicForum);
	if($TopicForum != $f) {
	$i = 0;
	while($i < count($tarook)) {
	$date = topics("DATE", $tarook[$i]);
	$author = topics("AUTHOR", $tarook[$i]);
	$query = "UPDATE ".$Prefix."TOPICS SET ";
	$query .= "CAT_ID = '$TopicCat', FORUM_ID = '$TopicForum'";
	$query .= "WHERE TOPIC_ID = '$tarook[$i]' ";
	@DBi::$con->query($query) or die (DBi::$con->error);
	$query2 = "UPDATE ".$Prefix."REPLY SET ";
	$query2 .= "CAT_ID = '$TopicCat', FORUM_ID = '$TopicForum'";
	$query2 .= "WHERE TOPIC_ID = '$tarook[$i]' ";
	@DBi::$con->query($query2) or die (DBi::$con->error);	
	if(f_last_post_date_topics($TopicForum) > f_last_post_date_replies($TopicForum)) {
	$f_last_post_date = f_last_post_date_topics($TopicForum); 
	$f_last_post_author = f_last_post_author_topics($TopicForum);		
	}
	if(f_last_post_date_replies($TopicForum) > f_last_post_date_topics($TopicForum)) {
	$f_last_post_date = f_last_post_date_replies($TopicForum); 
	$f_last_post_author = f_last_post_author_replies($TopicForum);
	}	
	if(f_last_post_date_replies($TopicForum) == f_last_post_date_topics($TopicForum)) {
	$f_last_post_date = $date;
	$f_last_post_author = 0;
	}	
	if(f_last_post_date_topics($f) > f_last_post_date_replies($f)) {
	$f_last_post_date1 = f_last_post_date_topics($f); 
	$f_last_post_author1 = f_last_post_author_topics($f);		
	}
	if(f_last_post_date_replies($f) > f_last_post_date_topics($f)) {
	$f_last_post_date1 = f_last_post_date_replies($f); 
	$f_last_post_author1 = f_last_post_author_replies($f);
	}	
	if(f_last_post_date_replies($f) == f_last_post_date_topics($f)) {
	$f_last_post_date1 = $date;
	$f_last_post_author1 = 0;
	}	
	$forum = "UPDATE ".prefix."FORUM SET ";
	$forum .= "F_TOPICS = '".topics_num($TopicForum)."', ";
	$forum .= "F_REPLIES = '".replies_num($TopicForum)."', ";
	$forum .= "F_LAST_POST_DATE = '".$f_last_post_date."', ";
	$forum .= "F_LAST_POST_AUTHOR = '".$f_last_post_author."' ";
	$forum .= "WHERE FORUM_ID = '$TopicForum' ";
	@DBi::$con->query($forum) or die (DBi::$con->error);
	$forum1 = "UPDATE ".prefix."FORUM SET ";
	$forum1 .= "F_TOPICS = '".topics_num($f)."', ";
	$forum1 .= "F_REPLIES = '".replies_num($f)."', ";
	$forum1 .= "F_LAST_POST_DATE = '".$f_last_post_date1."', ";
	$forum1 .= "F_LAST_POST_AUTHOR = '".$f_last_post_author1."' ";
	$forum1 .= "WHERE FORUM_ID = '$f' ";
	@DBi::$con->query($forum1) or die (DBi::$con->error);	
	$mdate = time();
	$subject = ' '.$lang['topic_option']['move_a_topic_to_you'].' '.topics("SUBJECT", $tarook[$i]).'';
	$message = ''.$lang['topic_option']['move_message_part1'].'<br><a href="index.php?mode=t&t='.$tarook[$i].'">'.topics("SUBJECT", $tarook[$i]).'</a><br>'.$lang['topic_option']['move_message_part2'].' '.forums("SUBJECT", $f).'<br>'.$lang['topic_option']['move_message_part3'].' '.link_profile(member_name($DBMemberID), $DBMemberID).'';
	$storePm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$storePm .= " '-$TopicForum', ";
	$storePm .= " '-$TopicForum', ";
	$storePm .= " '-$f', ";
	$storePm .= " '$subject', ";
	$storePm .= " '$message', ";
	$storePm .= " '$mdate') ";
	@DBi::$con->query($storePm, $connection) or die (DBi::$con->error);		
	$subject = ' '.$lang['topic_option']['move_a_topic_to_you'].' '.topics("SUBJECT", $tarook[$i]).'';
	$message = ''.$lang['topic_option']['move_message_part1'].' : '.forums("SUBJECT", $TopicForum).'<br><a href="index.php?mode=t&t='.$tarook[$i].'">'.topics("SUBJECT", $tarook[$i]).'</a><br>'.$lang['topic_option']['move_message_part2'].' '.forums("SUBJECT", $f).'<br>'.$lang['topic_option']['move_message_part3'].' '.link_profile(member_name($DBMemberID), $DBMemberID).'';
	$storePm1 = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
	$storePm1 .= " '$author', ";
	$storePm1 .= " '$author', ";
	$storePm1 .= " '-$f', ";
	$storePm1 .= " '$subject', ";
	$storePm1 .= " '$message', ";
	$storePm1 .= " '$mdate') ";
	@DBi::$con->query($storePm1, $connection) or die (DBi::$con->error);
	tr_cmd("t", $tarook[$x], "move");	
	if(allowed($f, 2) == 1) {
	DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MOD = M_MOD + $mod_points WHERE MEMBER_ID = '$DBMemberID'");
	}	
	++$i;
	}
	}
		                echo'<center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['forum_function']['done_move_this_topics'].'</font><br><br>
                           <meta http-equiv="Refresh" content="1; URL=index.php?mode=f&f='.$TopicForum.'">
                           <a href="index.php?mode=f&f='.$TopicForum.'">'.$lang['all']['click_here_to_go_normal_page'].'</a><br><br>
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

@mysqli_close();
?>