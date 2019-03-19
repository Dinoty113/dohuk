<?
if (@eregi("posts.php","$_SERVER[PHP_SELF]")) {
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

if ($Mlevel > 0) {
if ($m == 0 or $m == $DBMemberID) {
if (members("P_POSTS", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][your_posts].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}

$m = $DBMemberID;
$text5 = "";
$text = $lang['other']['posts_title'];
$text2 = $lang['other']['no_posts'];
$text6 = $lang['other']['have_new_posts'];
} else {
if (members("P_POSTS_MEMBERS", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][posts_members].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
$name = members("NAME", $m);
$text5 = $name;
$text = $lang['other']['posts_title_m'];
$text2 = $lang['other']['no_posts_m'];
$text6 = $lang['other']['have_new_posts_m'];

}


echo '<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
				<td width="100%"><font size="4" color="red"><b>'.$text.'</b></font>
				<font size="4" color="black"><b>'.$text5.'</b></font></td>';
				echo'
				<form method="post" action="'.$_SERVER['REQUEST_URI'].'">
					<td class="optionsbar_menus"><nobr>
					'.$lang['function']['order_by'].'<br>
					<select style="WIDTH: 65px" onchange="submit();" size="1" name="f_posts">
					<option value="topic" '.check_select($f_posts, "topic").'>'.$lang['function']['topic'].'</option>
					<option value="reply" '.check_select($f_posts, "reply").'>'.$lang['function']['reply'].'</option>
					</select>&nbsp;&nbsp;</nobr>
				</td>		
				</form>
				<form method="post" action="'.$_SERVER['REQUEST_URI'].'">
				
				<td class="optionsbar_menus"><nobr>'.$lang['other']['browse_option'].'<br />
				<select style="WIDTH: 80px" onchange="submit();" size="1" name="f_p">
				<option value="f_topic" '.check_select($f_p, "f_topic").'>'.$lang['other']['only_topocs'].'</option>
				<option value="f_all" '.check_select($f_p, "f_all").'>'.$lang['other']['all_posts'].'</option>';
				if($Mlevel > 2) {
				echo'	
				<option value="f_reply" '.check_select($f_p, "f_reply").'>'.$lang['other']['only_replies'].'</option>
				';
				}
				echo'
				</select>&nbsp;&nbsp;</nobr></td>
				</form>
					<form method="post" action="'.$_SERVER[REQUEST_URI].'">
					<td class="optionsbar_menus"><nobr>'.$lang['other']['show_posts_from'].'</nobr><br>
						<select size="1" name="f_n" onchange="submit();">
						<option value="all" '.check_select($f_n, "all").'>'.$lang['other']['all_forums_posts'].'</option>';
$cat = @DBi::$con->query("SELECT * FROM ".$Prefix."CATEGORY ORDER BY CAT_ORDER ASC") or die (DBi::$con->error);
  $c_num = @mysqli_num_rows($cat);
  $c_i = 0;
				while ($c_i < $c_num) { 
					$cat_id = mysqli_result($cat, $c_i, "CAT_ID");
$forum = @DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE CAT_ID = ".$cat_id." ORDER BY F_ORDER ASC ") or die (DBi::$con->error);
		$f_num = @mysqli_num_rows($forum);
		$f_i = 0;
		while ($f_i < $f_num) {
			$forum_id = @mysqli_result($forum, $f_i, "FORUM_ID");
			$cat_id = forums("CAT_ID", $forum_id);
			$f_subject = @mysqli_result($forum, $f_i, "F_SUBJECT");
			$f_hide = forums("HIDE", $forum_id);
			$f_level = forums("F_LEVEL", $forum_id);
			$check_forum_login = check_forum_login($forum_id);
			$c_hide = cat("HIDE", $cat_id);
			$c_level = cat("LEVEL", $cat_id);
			$check_cat_login = check_cat_login($cat_id);			

			if ($c_level == 0 OR $c_level > 0 AND $c_level <= $Mlevel){
			if ($c_hide == 0 OR $c_hide == 1 AND $check_cat_login == 1){
			if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
			if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){				
				echo'<option value="'.$forum_id.'" '.check_select($f_n, $forum_id).'>'.$f_subject.'</option>';
			}
			}
			}
			}			

		$f_i++;
		}
		$c_i++;
		}
						echo'
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
						<td class="cat" width="3%">&nbsp;</td>
						<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
						<td class="cat" width="15%">'.$lang['active']['author'].'</td>
						<td class="cat">'.$lang['active']['reply'].'</td>
						<td class="cat">'.$lang['active']['counts'].'</td>
						<td class="cat" width="15%">'.$lang['active']['last_reply'].'</td>
						<td class="cat" width="1%">&nbsp;</td>
						</tr>';
if($Mlevel == 1) {
$the_and = "AND T_ARCHIVED = '0' AND T_HIDDEN = '0' AND T_HOLDED = '0' AND T_UNMODERATED = '0'";	
}						
if($Mlevel > 1) {
$the_and = "AND T_ARCHIVED = '0'";	
}
if($Mlevel == 1) {
$the_and1 = "AND T.T_ARCHIVED = '0' AND T.T_HIDDEN = '0' AND T.T_HOLDED = '0' AND T.T_UNMODERATED = '0'";	
}						
if($Mlevel > 1) {
$the_and1 = "AND T_ARCHIVED = '0'";	
}
if($f_p == "f_topic") {
$f_pp = "SELECT DISTINCT TOPIC_ID, FORUM_ID FROM ".$Prefix."TOPICS WHERE T_AUTHOR = ".$m." AND T_AUTHOR_MOD = '0' ".$the_and." ";
}	
if($f_p == "f_all") {
$f_pp = "SELECT DISTINCT T.TOPIC_ID, T.FORUM_ID FROM ".$Prefix."TOPICS AS T LEFT JOIN ".$Prefix."REPLY AS R ON (T.TOPIC_ID = R.TOPIC_ID) WHERE (T.T_AUTHOR = ".$m." OR R.R_AUTHOR = ".$m.") ".$the_and1."";
}	
if($f_p == "f_reply") {
$f_pp = "SELECT DISTINCT R.TOPIC_ID, R.FORUM_ID FROM ".$Prefix."TOPICS AS T RIGHT JOIN ".$Prefix."REPLY AS R ON (T.TOPIC_ID = R.TOPIC_ID) WHERE R.R_AUTHOR = ".$m." ".$the_and1." ";
}	
if($f_posts == "topic" && $f_p == "f_all") {
$f_postss = "T.T_DATE";
}	
if($f_posts == "reply" && $f_p == "f_all") {
$f_postss = "T.T_LAST_POST_DATE";
}	
if($f_posts == "topic" && $f_p == "f_topic") {
$f_postss = "T_DATE";
}	
if($f_posts == "reply" && $f_p == "f_topic") {
$f_postss = "T_LAST_POST_DATE";
}	
if($f_posts == "reply" && $f_p == "f_reply") {
$f_postss = "T.T_LAST_POST_DATE";
}	
if($f_posts == "topic" && $f_p == "f_reply") {
$f_postss = "T.T_LAST_POST_DATE";
}	
if($f_p == "f_topic") {
$f_nn = "FORUM_ID = ".$f_n."";	
}
if($f_p == "f_reply") {
$f_nn = "R.FORUM_ID = ".$f_m."";	
}
if($f_p == "f_all") {
if($f_posts == "topic") {
	$f_nn = "T.FORUM_ID = ".$f_n."";	
}
if($f_posts == "reply") {
	$f_nn = "R.FORUM_ID = ".$f_n."";	
}
}
if($f_p == "f_topic") {
if($f_posts == "topic") {
	$f_nn = "FORUM_ID = ".$f_n."";	
}
if($f_posts == "reply") {
	$f_nn = "FORUM_ID = ".$f_n."";	
}
}
if($f_p == "f_reply") {
if($f_posts == "topic") {
	$f_nn = "R.FORUM_ID = ".$f_n."";	
}
if($f_posts == "reply") {
	$f_nn = "R.FORUM_ID = ".$f_n."";	
}
}
if ($f_n != "all") {
$query2 = "".$f_pp." AND ".$f_nn." ORDER BY ".$f_postss." DESC";
} else {
$query2 = "".$f_pp." ORDER BY ".$f_postss." DESC";
}
$result2 = @DBi::$con->query($query2) or die(DBi::$con->error);
$num = @mysqli_num_rows($result2);
	if ($num <= 0) {
					echo'
					<tr>
						<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$text2.'<br><br><br></td>
</tr>';	
} else {
$i = 0;
$numt = 0;
while ($i < $num) {
 if ($numt == 50) {
$t = $rs2[TOPIC_ID];
} else {
$rs2 = mysqli_fetch_array($result2);
$tt = $rs2['TOPIC_ID'];
if  ($tt == $t) {
$t = $rs2['TOPIC_ID'];
} else {
$t = $rs2['TOPIC_ID'];
$forum_id = $rs2['FORUM_ID'];
$sql = DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE FORUM_ID = '$forum_id' ") or die(DBi::$con->error);
$rs3 = mysqli_fetch_array($sql);
$f_subject = $rs3['F_SUBJECT']; 
if($Mlevel < 2) {
$sql = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS WHERE T_ARCHIVED = 0 AND T_HIDDEN = 0 AND T_HOLDED = 0 AND T_UNMODERATED = 0 AND TOPIC_ID = '$t'") or die(DBi::$con->error);
} else {
$sql = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS WHERE T_ARCHIVED = 0 AND TOPIC_ID = '$t'") or die(DBi::$con->error);
}	
$nom = mysqli_num_rows($sql);
$rs4 = mysqli_fetch_array($sql);
$t = $rs4['TOPIC_ID'];
$cat_id = topics("CAT_ID", $t);
$forum_id = topics("FORUM_ID", $t);
$f_hide = forums("HIDE", $forum_id);
$f_level = forums("F_LEVEL", $forum_id);
$check_forum_login = check_forum_login($forum_id);
$c_hide = cat("HIDE", $cat_id);
$c_level = cat("LEVEL", $cat_id);
$check_cat_login = check_cat_login($cat_id);
$status = topics("STATUS", $t);
$subject = topics("SUBJECT", $t);
$author = topics("AUTHOR", $t);
$replies = post_num($t);
$counts = topics("COUNTS", $t);
$lp_date = last_post_date($t);
$date = topics("DATE", $t);
$lp_author = last_post_author($t);
$hidden = topics("HIDDEN", $t);
$color = topics("COLOR", $t);
$author_name = members("NAME", $author);
$author_mod = topics("AUTHOR_MOD", $t);					
if($author_mod > 0) {
$author_mod_name = '<a href="index.php?mode=f&f='.$forum_id.'">'.author_mod_style(author_mod_color1($author_mod, $forum_id), author_mod_color2($author_mod, $forum_id), author_mod($author_mod, $forum_id)).'</a>';
} else {
$author_mod_name = member_color_link($author);
}
$lp_id = last_reply_id($t);
$lp_author_mod = replies("AUTHOR_MOD", $lp_id);
if($lp_author_mod > 0) {
$lp_author_name = '<a href="index.php?mode=f&f='.$f.'">'.author_mod_style(author_mod_color1($lp_author_mod, $f), author_mod_color2($lp_author_mod, $f), author_mod($lp_author_mod, $f)).'</a>';
} else {
$lp_author_name = member_color_link($lp_author);	
}
 if ($lp_author == $m && $replies > 0) {
 $class = "lastposter";
} else {
 $class = "normal";
}
if($replies == 0) {
 $class = "lastposter";
}
 if (!$nom == 0) {
	if ($c_level == 0 OR $c_level > 0 AND $c_level <= $Mlevel){ 
    if ($c_hide == 0 OR $c_hide == 1 AND $check_cat_login == 1) {
	if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){ 
    if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1) {	
	if ($hidden == 0 or ($hidden == 1 && allowed($f, 2) == 1) or ($hidden == 1 && $author == $DBMemberID) or ($hidden == 1 && chk_login_topic($t) == 1)) {
            echo'
	<tr class="'.$class.'">
		<td class="list_small"><a href="index.php?mode=f&f='.$forum_id.'">'.$f_subject.'</a></td>
		<td class="list_center"><nobr><a href="index.php?mode=f&f='.$forum_id.'">';
		if ($status == 0 AND $replies < 20) {
			echo icons($folder_new_locked, $lang['forum']['topic_is_locked']);
		}
		elseif ($status == 0 AND $replies >= 20) {
			echo icons($folder_new_locked, $lang['forum']['topic_is_hot_and_locked']);
		}
		elseif ($status == 1 AND $replies < 20) {
			echo icons($folder_new);
		}
		elseif ($status == 1 AND $replies >= 20) {
			echo icons($folder_new_hot, $lang['forum']['topic_is_hot']);
		}
		else {
			echo icons($folder);
		}
		echo'
		</a></nobr></td>
		<td class="list">
		<table cellPadding="0" cellsapcing="0" id="table2">
			<tr>
				<td><a href="index.php?mode=t&t='.$t.'"><font color="'.$color.'">'.$subject.'</font></a>&nbsp;'; echo topic_paging($t); echo'</td>
			</tr>
		</table>
		</td>
		<td class="list_small2" noWrap><font color="green">'.normal_time($date).'</font><br>'.$author_mod_name.'</td>
		<td class="list_small2">'.$replies.'</td>
		<td class="list_small2">'.$counts.'</td>
		<td class="list_small2" noWrap><font color="red">';
	if ($replies > 0){
		echo normal_time($lp_date).'</font><br>'.$lp_author_name;
	}
		echo'
		</td>';
		echo'
		<td class="list_small2">';
		if ($allowed == 1 OR $status == 1){
			echo'<a href="index.php?mode=editor&method=reply&t='.$t.'&f='.$forum_id.'&c='.$cat_id.'">'.icons($icon_reply_topic, $lang['forum']['reply_to_this_topic'], "hspace=\"2\"").'</a>';
		}
		if ($allowed == 1 OR $status == 1 AND $DBMemberID == $author){
			echo'<a href="index.php?mode=editor&method=edit&t='.$t.'&f='.$forum_id.'&c='.$cat_id.'">'.icons($icon_edit, $lang['topics']['edit_topic'], "hspace=\"2\"").'</a>';
		}
		echo'<nobr><a href="index.php?mode=t&t='.$t.'&m='.$m.'">'.icons($icon_group, $lang['topics']['reply_this_member'], "").'</a></nobr>';
		
		echo'
		</td>';
	
	echo'
	</tr>';
	$numt++;
	$t = $rs2['TOPIC_ID'];
	}
	}
	}
	}
	}
	}
	$t = $rs2['TOPIC_ID'];
	$numt++;
	}
	}
	$i++;
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

echo '<table cellspacing="0" cellpadding="0">
  <TR>
    <TD>'.$lang['other']['topics_is_this_color'].' </TD>
    <TD><TABLE cellSpacing="1" border="1">
      <TBODY>
        <TR class="normal">
          <TD>   </TD>
        </TR>
      </TBODY>
    </TABLE></TD>
    <TD>&nbsp;'.$text6.'</TD>
  </TR>
</table>';		
} else {
redirect();	
}
?>