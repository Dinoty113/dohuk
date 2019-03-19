<?php
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

if($method != "" && $method != "find") {
redirect();	
}

if($mlv == 1 AND $DBMemberPosts < $new_member_min_search){
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
	                       
'.$lang[sorry][noo].'
'.$lang[sorry][search].'
'.$lang[sorry][will].'
	                       </font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}
if (members("SEARCH", $DBMemberID) == 1  ) {
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
'.$lang[permission][sorry].'
'.$lang[permission][search].'<br>
'.$lang[permission][contact].'
</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}



function search_count($m,$h){
$Hour = time() - ($h * 3600);
$Sql = DBi::$con->query("SELECT * FROM ".prefix."SEARCH WHERE MEMBER_ID  = '$m' AND DATE >= $Hour");
$Num = mysqli_num_rows($Sql);
return $Num;
}



function search_func(){
	global $lang, $Prefix,$icon_group,$max_search, $max_search_m, $create_forum_date, $Mlevel;
$search_count = search_count(m_id,24);

if(mlv < 2){
	echo'<br><br>
	<center>
	<table cellSpacing="0" cellPadding="0" width="99%" border="0">
		<tr>
			<td>
			<center>
			<form method="post" action="index.php?mode=search&method=find">
			<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0">
				<tr class="fixed">
					<td class="cat" colspan="4"><nobr>'.$lang['search']['search'].'</nobr></td>
				</tr>
				<tr class="fixed">
					<td class="cat"><nobr>'.$lang['search']['enter_text'].'</nobr></td>
					<td class="list" colspan="3"><input type="text" size="50" name="search"></td>
				</tr>
				<tr class="fixed">
					<td class="cat"><nobr>'.$lang['search']['search_status'].'</nobr></td>
					<td class="list"><input class="small" type="radio" name="type" value="subject" CHECKED>&nbsp;'.$lang['search']['topic_title'].'&nbsp;</td>
					<td class="list" colspan="2"><input class="small" type="radio" name="type" value="message">&nbsp;'.$lang['search']['topic_message'].'&nbsp;&nbsp;
				</tr>
				<tr class="fixed">
					<td class="cat"><nobr>'.$lang['search']['search_in'].'</nobr></td>
					<td class="list"><input class="small" type="radio" name="ch_f" value="0" CHECKED>&nbsp;'.$lang['other_things']['all_forums'].'&nbsp;</td>
					<td class="list" colspan="2"><input class="small" type="radio" name="ch_f" value="1">&nbsp;'.$lang['search']['just_forum'].'&nbsp;&nbsp;
					<select name="forum_id">
						<option value="">&nbsp;&nbsp;'.$lang['go_to']['choose_forum'].'</option>';
				$cats = DBi::$con->query("SELECT * FROM ".$Prefix."CATEGORY ORDER BY CAT_ORDER ASC ") or die (DBi::$con->error);
				$num = mysqli_num_rows($cats);
				$i = 0;
				while($i < $num){
					$c = mysqli_result($cats, $i, "CAT_ID");
					$forums = DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE CAT_ID = '$c' ORDER BY F_ORDER ASC ") or die (DBi::$con->error);
					$f_num = mysqli_num_rows($forums);
					$f_i = 0;
					while($f_i < $f_num){
						$f = mysqli_result($forums, $f_i, "FORUM_ID");
						$subject = forums("SUBJECT", $f);
						$hide = forums("HIDE", $f);
						$level = forums("F_LEVEL", $f);
						if($level == 0 or $level > 0 && $level <= $Mlevel) {
						if ($hide == 0 OR check_forum_login($f) == 1){
							echo'<option value="'.$f.'">'.$subject.'</option>';
						}
						}
					++$f_i;
					}
				++$i;
				}		
					echo'
					</select>
					</td>
				</tr>
				<tr class="fixed">
					<td class="list_center" colspan="4">
						<input type="submit" value="'.$lang['header']['search'].'">&nbsp;&nbsp;<input type="reset" value="'.$lang['profile']['reset_info'].'">
					</td>
				</tr>
			</table>
			</form>
			</td>
		</tr>
	</table>
	</center>';
}
if(mlv == 1) {
$max_search_all = $max_search;	
}
if(mlv > 1) {
$max_search_all = $max_search_m;	
}
                 if(mlv > 1){


		echo '
<form name="search" method="post" action="index.php?mode=search&method=find"><center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td>
				<table cellSpacing="2" width="100%" border="0">
					<tr>
						<td class="optionsbar_menus" vAlign="center"><nobr>'.$lang['search']['search_about'].'</nobr></td>
						<td class="optionsbar_menus"><input type="text" size="80" name="search"></td>
						<td class="optionsbar_menus"><input type="button" onclick="submit_search(\''.$search_count.'\',\''.$max_search_all.'\',\''.$Mlevel.'\');" value="'.$lang['header']['search'].'">
</td>
						<td class="optionsbar_menus">
'.$lang['search']['search_at'].' <br>
<select name="type">
<option value="subject_msg">'.$lang['search']['subject_message'].'</option>
<option value="reply">'.$lang['search']['reply'].'</option>
</select></td>';
					
					echo'
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</center>';

echo'
		<center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td>
				<table cellSpacing="2" width="100%" border="0">
					<tr>
						<td class="optionsbar_menus" vAlign="center"><nobr>'.$lang['search']['in_member_posts'].'</nobr></td>
						<td width="32%" class="optionsbar_menus"><input type="text" size="40" name="search_m">&nbsp;&nbsp;'.icons($icon_group,"").'</td>
						<td class="optionsbar_menus"><nobr>'.$lang['search']['select_search'].' </nobr></td>
						<td class="optionsbar_menus">
<select name="month">
<option value="this">'.$lang['search']['this_month'].'</option>
<option value="01">'.$lang['other_new_things']['m_january'].'</option>
<option value="02">'.$lang['other_new_things']['m_february'].'</option>
<option value="03">'.$lang['other_new_things']['m_march'].'</option>
<option value="04">'.$lang['other_new_things']['m_april'].'</option>
<option value="05">'.$lang['other_new_things']['m_may'].'</option>
<option value="06">'.$lang['other_new_things']['m_june'].'</option>
<option value="07">'.$lang['other_new_things']['m_july'].'</option>
<option value="08">'.$lang['other_new_things']['m_augest'].'</option>
<option value="09">'.$lang['other_new_things']['m_september'].'</option>
<option value="10">'.$lang['other_new_things']['m_october'].'</option>
<option value="11">'.$lang['other_new_things']['m_november'].'</option>
<option value="12">'.$lang['other_new_things']['m_december'].'</option>
</select></td>
						<td class="optionsbar_menus">
<select name="years">
<option value="this">'.$lang['search']['this_year'].'</option>';
$now_year = date("Y") + 1;
for($x=$create_forum_date;$x<$now_year;$x++){
echo'<option value="'.$x.'">'.$x.'</option>';
}
echo'
</select></td>

<td class="optionsbar_menus" vAlign="center" width="50%">&nbsp;</td>
<td class="optionsbar_menus" vAlign="center"><nobr>'.$lang['search']['show_topics_from'].' </nobr><br>
<select name="forum_id">
						<option value="all">&nbsp;&nbsp;'.$lang['other']['all_forums_posts'].'</option>';
				$cats = DBi::$con->query("SELECT * FROM ".$Prefix."CATEGORY ORDER BY CAT_ORDER ASC ") or die (DBi::$con->error);
				$num = mysqli_num_rows($cats);
				$i = 0;
				while($i < $num){
					$c = mysqli_result($cats, $i, "CAT_ID");
					$forums = DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE CAT_ID = '$c' ORDER BY F_ORDER ASC ") or die (DBi::$con->error);
					$f_num = mysqli_num_rows($forums);
					$f_i = 0;
					while($f_i < $f_num){
						$f = mysqli_result($forums, $f_i, "FORUM_ID");
						$subject = forums("SUBJECT", $f);
						$hide = forums("HIDE", $f);
						$level = forums("F_LEVEL", $f);
						if($level == 0 or $level > 0 && $level <= $Mlevel) {						
						if ($hide == 0 OR check_forum_login($f) == 1){
							echo'<option value="'.$f.'">'.$subject.'</option>';
						}
						}
					++$f_i;
					}
				++$i;
				}		
					echo'
					</select>
</td>
';
					
					echo'
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</center>
		<br></form>';
if($Mlevel == 4) {
$themax = $lang['other']['unlimited'];	
} else {
$themax = $max_search_all;	
}
echo '	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10">
<br><br>
'.$lang['search']['search_desc'].'<br><br>
<table width="30%" border="1" align="center">
<tr>
<td colspan="2" style="background-color:black;text-align:center;color:white">'.$lang['search']['search_count'].'</td>
</tr>
<tr class="normal">
<td>'.$lang['search']['count_search_now'].'</td>
<td style="color:red">'.$search_count.'</td>
</tr>
<tr class="normal">
<td>'.$lang['search']['all_search'].'</td>
<td style="color:red">'.$themax.'</td>
</tr>
</table><br><br>
	                       </td>
	                   </tr>
	                </table><br><br>';

              }

}

function search_head(){
	global $lang, $img, $search;
			echo'
			<table cellSpacing="2" width="100%" border="0">
				<tr>
					<td>'.icons($search).'</td>
					<td width="100%" vAlign="center"><a href="index.php?mode=active"><font size="3" color="red"><b>&nbsp;&nbsp;'.$lang['search']['search'].'</b></font></a></td>';
					refresh_time();
					go_to_forum();
				echo'
				</tr>
			</table>';
}

function search_topics($t){
	global $Mlevel, $DBMemberID, $lang, $icon_reply_topic, $folder_new_locked, $folder_new, $folder_new_hot, $folder;
	
$f = topics("FORUM_ID", $t);
$status = topics("STATUS", $t);
$subject = topics("SUBJECT", $t);
$author = topics("AUTHOR", $t);
$author_name = members("NAME", $author);
$replies = post_num($t);
$views = topics("COUNTS", $t);
$lp_date = last_post_date($t);
$date = topics("DATE", $t);
$lp_author = last_post_author($t);
$hide = topics("HIDE", $t);
$f_subject = forums("SUBJECT", $f);
$author_mod = topics("AUTHOR_MOD", $t);		
if($author_mod > 0) {
$author_mod_name = '<a href="index.php?mode=f&f='.$f.'">'.author_mod_style(author_mod_color1($author_mod, $f), author_mod_color2($author_mod, $f), author_mod($author_mod, $f)).'</a>';
} else {
$author_mod_name = link_profile($author_name, $author);
}			
$allowed = allowed($f, 2);
$lp_id = last_reply_id($t);
$lp_author_mod = replies("AUTHOR_MOD", $lp_id);
if($lp_author_mod > 0) {
$lp_author_name = '<a href="index.php?mode=f&f='.$f.'">'.author_mod_style(author_mod_color1($lp_author_mod, $f), author_mod_color2($lp_author_mod, $f), author_mod($lp_author_mod, $f)).'</a>';
} else {
$lp_author_name = link_profile(members("NAME", $lp_author), $lp_author);	
}

						echo'
						<tr class="normal">
							<td class="list_small"><a href="index.php?mode=f&f='.$f.'"><b>'.$f_subject.'</b></a></td>
							<td class="list_center"><nobr><a href="index.php?mode=f&f='.$f.'">';
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
							<table cellPadding="0" cellsapcing="0">
								<tr>
									<td><a href="index.php?mode=t&t='.$t.'"><b>'.$subject.'</b></a>&nbsp;'; echo topic_paging($t); echo'</td>
								</tr>
							</table>
							</td>
							<td class="list_small2" noWrap><font  color="green">'.normal_time($date).'</font><br><b>'.$author_mod_name.'</b></td>
							<td class="list_small2">'.$replies.'</td>
							<td class="list_small2">'.$views.'</td>
							<td class="list_small2" noWrap><font color="red">';
						if ($replies > 0){
							echo normal_time($lp_date).'</font><br><b>'.$lp_author_name.'<b>';
						}
							echo'
							</td>';
						if ($Mlevel > 0){
							echo'
							<td class="list_small2">';
							if ($allowed == 1 OR $status == 1){
								echo'<a href="index.php?mode=editor&method=reply&t='.$t.'">'.icons($icon_reply_topic, $lang['forum']['reply_to_this_topic'], "hspace=\"2\"").'</a>';
							}
							echo'
							</td>';
						}	
						echo'
						</tr>';
}

function update_search($query,$type,$in_user,$forum,$month,$year){

             if ($type == "subject_msg"){
               $type = 0;
              }else{
               $type = 1;
              }
              $date = time();
              $mlv = mlv;
              $m_id = m_id;
          DBi::$con->query("insert into ".prefix."SEARCH SET QUERY = '$query', DATE = '$date', TYPE = '$type', MEMBER_ID = '$m_id', IN_USER = '$in_user', FORUM = '$forum', M_LEVEL = '$mlv', MONTH = '$month', YEAR = '$year' ") or die(DBi::$con->error);
 
}


function search_body(){
	global $Mlevel, $DBMemberID, $lang, $_POST, $Prefix;


			echo'
			<table class="grid" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
				<tr>
					<td>
					<table bgcolor="gray" cellSpacing="1" cellPadding="2" width="100%" border="0">
						<tr>
							<td class="cat" width="15%">'.$lang['active']['forum'].'</td>
							<td class="cat">&nbsp;</td>
							<td class="cat" width="45%">'.$lang['active']['topics'].'</td>
							<td class="cat" width="15%">'.$lang['forum']['author'].'</td>
							<td class="cat">'.$lang['forum']['posts'].'</td>
							<td class="cat">'.$lang['forum']['reads'].'</td>
							<td class="cat" width="15%">'.$lang['forum']['last_post'].'</td>
							<td class="cat" width="1%">'.$lang['forum']['options'].'</td>
						</tr>';
			                  $search = DBi::$con->real_escape_string(htmlspecialchars($_POST[search]));
				$ch_f = DBi::$con->real_escape_string(htmlspecialchars($_POST['ch_f']));
				$forum_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));
				$type = DBi::$con->real_escape_string(htmlspecialchars($_POST['type']));
				$search_m = DBi::$con->real_escape_string(htmlspecialchars($_POST['search_m']));
				$month = DBi::$con->real_escape_string(htmlspecialchars($_POST['month']));
				$years = DBi::$con->real_escape_string(htmlspecialchars($_POST['years']));
			if ($search == "" AND $search_m != ""){
                                                       $search = " ";
                                                       }

			if ($search != ""){
				if ($ch_f == 1 AND $forum_id > 0){
					$open_sql = "AND FORUM_ID = '$forum_id' ";
				}
				if ($type == "subject"){
					$search_in = "SUBJECT";
				}
				if ($type == "message"){
					$search_in = "MESSAGE";
				}


                                                                       if(mlv < 2){
				$topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS WHERE T_".$search_in." LIKE '%$search%' ".$open_sql." LIMIT 50") or die (DBi::$con->error);
                                                                      }

                                                          if(mlv > 1){
				if ($forum_id != "all"){
					$open_sql = "AND FORUM_ID = '$forum_id' ";
				}

				if ($search_m != ""){
					$m_sql = mysqli_fetch_array(DBi::$con->query("select MEMBER_ID from ".prefix."MEMBERS                                                            WHERE M_NAME = '$search_m' "));

                                                                                          $m_id = $m_sql['MEMBER_ID'];

                                                                       if ($type == "subject_msg"){
					$open_sql .= "AND T_AUTHOR = '$m_id' ";
                                                                       }
                                                                       if ($type == "reply"){
					$open_sql .= "AND R_AUTHOR = '$m_id' ";
                                                                        }
			}

// ######### YEARS ############

                  if($years != "this"){

                         if ($type == "subject_msg"){
                    $open_sql .= "AND YEAR(FROM_UNIXTIME(T_DATE)) = '$years'  ";
                          }
                          if ($type == "reply"){
                      $open_sql .= "AND  YEAR(FROM_UNIXTIME(R_DATE)) = '$years'  ";
                           }
                }

// ######### MONTH ############

                  if($month != "this"){

                        if ($type == "subject_msg"){
                      $open_sql .= "AND MONTH(FROM_UNIXTIME(T_DATE)) = '$month'  ";
                         }
                       if ($type == "reply"){
                    $open_sql .= "AND  MONTH(FROM_UNIXTIME(R_DATE)) = '$month'  ";
                       }

             }

				if ($type == "subject_msg"){
					$search_in = "T_SUBJECT LIKE '%$search%' ".$open_sql." OR T_MESSAGE LIKE '%$search%' ".$open_sql." ORDER BY T_LAST_POST_DATE DESC ";
                                                                                        $topics = DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS WHERE ".$search_in."  LIMIT 50") or die (DBi::$con->error);

				}
				if ($type == "reply"){

$topics = DBi::$con->query("SELECT DISTINCT TOPIC_ID from ".$Prefix."REPLY WHERE R_MESSAGE LIKE '%$search%' ".$open_sql." ORDER BY 	R_DATE DESC LIMIT 50") or die (DBi::$con->error);
				}

update_search($search,$type,$m_id,$forum_id,$month,$years);				
}

				$num = mysqli_num_rows($topics);
				if ($num <= 0) {
						echo'
						<tr>
							<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$lang['search']['no_search_topics'].'<br><br><br></td>
						</tr>';
				}
				else{
					$i = 0;
					while ($i < $num) {
						$t = mysqli_result($topics, $i, "TOPIC_ID");
						$t_hide = topics("HIDE", $t);
						$t_author = topics("AUTHOR", $t);
						$f = topics("FORUM_ID", $t);
						$f_hide = forums("HIDE", $f);
						$check_forum_login = check_forum_login($f);
						$level = forums("F_LEVEL", $f);
						$t_unmoderated = topics("UNMODERATED", $t);
						$t_holded = topics("HOLDED", $t);
						$t_status = topics("STATUS", $t);
						if($level == 0 or $level > 0 && $level <= $Mlevel) {						
						if (($f_hide == 0 AND $t_hide == 0) OR ($f_hide == 1 AND $t_hide == 0 AND $check_forum_login == 1) OR ($f_hide == 0 AND $t_hide == 1 AND allowed($f, 2) == 1) OR ($f_hide == 0 AND $t_hide == 1 AND $DBMemberID == $t_author) OR ($f_hide == 1 AND $t_hide == 1 AND $DBMemberID == $t_author AND $check_forum_login == 1) OR ($f_hide == 1 AND $t_hide == 1 AND allowed($f, 2) == 1 AND $check_forum_login == 1)){
						if($t_unmoderated == 0 && $t_holded == 0 && $t_status != 2) {	
							search_topics($t);
						}
						}
						}
					++$i;
					}
				}
					echo'
					</table>
					</td>
				</tr>';
			}
			else{
						echo'
						<tr>
							<td class="f1" vAlign="center" align="middle" colspan="20"><br><br>'.$lang['search']['no_search_message'].'<br><br><br></td>
						</tr>';
			}
			echo'
			</table>';
}


function search_find_func(){
	global $lang, $Prefix,$icon_group,$max_search, $max_search_m, $create_forum_date;
$search_count = search_count(m_id,24);

			                  $search = DBi::$con->real_escape_string(htmlspecialchars($_POST[search]));
				$forum_id = DBi::$con->real_escape_string(htmlspecialchars($_POST['forum_id']));
				$type = DBi::$con->real_escape_string(htmlspecialchars($_POST['type']));
				$search_m = DBi::$con->real_escape_string(htmlspecialchars($_POST['search_m']));
				$month = DBi::$con->real_escape_string(htmlspecialchars($_POST['month']));
				$years = DBi::$con->real_escape_string(htmlspecialchars($_POST['years']));
if(mlv == 1) {
$max_search_all = $max_search;	
}
if(mlv > 1) {
$max_search_all = $max_search_m;	
}
                 if(mlv > 1){


		echo '
<form name="search" method="post" action="index.php?mode=search&method=find"><center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td>
				<table cellSpacing="2" width="100%" border="0">
					<tr>
						<td class="optionsbar_menus" vAlign="center"><nobr>'.$lang['search']['search_about'].'</nobr></td>
						<td class="optionsbar_menus"><input type="text" size="80" name="search" value="'.$search.'"></td>
						<td class="optionsbar_menus"><input type="button" onclick="submit_search(\''.$search_count.'\',\''.$max_search_all.'\',\''.$Mlevel.'\');" value="'.$lang['header']['search'].'">
</td>

						<td class="optionsbar_menus">
'.$lang['search']['search_at'].' <br>
<select name="type">
<option value="subject_msg" '.check_select($type, "subject_msg").'>'.$lang['search']['subject_message'].'</option>
<option value="reply" '.check_select($type, "reply").'>'.$lang['search']['reply'].'</option>
</select></td>';
					
					echo'
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</center>';

echo'
		<center>
		<table cellSpacing="0" cellPadding="0" width="99%" border="0">
			<tr>
				<td>
				<table cellSpacing="2" width="100%" border="0">
					<tr>
						<td class="optionsbar_menus" vAlign="center"><nobr>'.$lang['search']['in_member_posts'].'</nobr></td>
						<td width="32%" class="optionsbar_menus"><input type="text" size="40" name="search_m" value="'.$search_m.'">&nbsp;&nbsp;'.icons($icon_group,"").'</td>
						<td class="optionsbar_menus"><nobr>'.$lang['search']['select_search'].' </nobr></td>
						<td class="optionsbar_menus">
<select name="month">
<option value="this" '.check_select($month, "this").'>'.$lang['search']['this_month'].'</option>
<option value="01" '.check_select($month, "01").'>'.$lang['other_new_things']['m_january'].'</option>
<option value="02" '.check_select($month, "02").'>'.$lang['other_new_things']['m_february'].'</option>
<option value="03" '.check_select($month, "03").'>'.$lang['other_new_things']['m_march'].'</option>
<option value="04" '.check_select($month, "04").'>'.$lang['other_new_things']['m_april'].'</option>
<option value="05" '.check_select($month, "05").'>'.$lang['other_new_things']['m_may'].'</option>
<option value="06" '.check_select($month, "06").'>'.$lang['other_new_things']['m_june'].'</option>
<option value="07" '.check_select($month, "07").'>'.$lang['other_new_things']['m_july'].'</option>
<option value="08" '.check_select($month, "08").'>'.$lang['other_new_things']['m_augest'].'</option>
<option value="09" '.check_select($month, "09").'>'.$lang['other_new_things']['m_september'].'</option>
<option value="10" '.check_select($month, "10").'>'.$lang['other_new_things']['m_october'].'</option>
<option value="11" '.check_select($month, "11").'>'.$lang['other_new_things']['m_november'].'</option>
<option value="12" '.check_select($month, "12").'>'.$lang['other_new_things']['m_december'].'</option>
</select></td>
						<td class="optionsbar_menus">
<select name="years">
<option value="this">'.$lang['search']['this_year'].'</option>';
$now_year = date("Y") + 1;
for($x=$create_forum_date;$x<$now_year;$x++){
echo'<option value="'.$x.'">'.$x.'</option>';
}
echo'
</select></td>

<td class="optionsbar_menus" vAlign="center" width="50%">&nbsp;</td>
<td class="optionsbar_menus" vAlign="center"><nobr>'.$lang['search']['show_topics_from'].' </nobr><br>
<select name="forum_id">
						<option value="all"'.check_select($forum_id, "all").'>&nbsp;&nbsp;'.$lang['other']['all_forums_posts'].'</option>';
				$cats = DBi::$con->query("SELECT * FROM ".$Prefix."CATEGORY ORDER BY CAT_ORDER ASC ") or die (DBi::$con->error);
				$num = mysqli_num_rows($cats);
				$i = 0;
				while($i < $num){
					$c = mysqli_result($cats, $i, "CAT_ID");
					$forums = DBi::$con->query("SELECT * FROM ".$Prefix."FORUM WHERE CAT_ID = '$c' ORDER BY F_ORDER ASC ") or die (DBi::$con->error);
					$f_num = mysqli_num_rows($forums);
					$f_i = 0;
					while($f_i < $f_num){
						$f = mysqli_result($forums, $f_i, "FORUM_ID");
						$subject = forums("SUBJECT", $f);
						$hide = forums("HIDE", $f);
						if ($hide == 0 OR check_forum_login($f) == 1){
							echo'<option value="'.$f.'"'.check_select($forum_id, $f).'>'.$subject.'</option>';
						}
					++$f_i;
					}
				++$i;
				}		
					echo'
					</select>
</td>
';
					
					echo'
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</center>
		</form>';

              }

}


function search_find(){
	global $lang;
	echo'
	<center>
	<table cellSpacing="0" cellPadding="0" width="99%" border="0">
		<tr>
			<td>';
			search_find_func();
			search_body();
			echo'
			</td>
		</tr>
	</table>
	</center>';
}

if ($Mlevel > 0){
	if ($method == ""){
		search_func();
	}
	if ($method == "find"){
		search_find();
	}
}
else{
	go_to("index.php");
}
?>
