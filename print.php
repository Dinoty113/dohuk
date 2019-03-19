<?php
if (@eregi("print.php","$_SERVER[PHP_SELF]")) {
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
$f_hide = forums("HIDE", $f);
$f_level = forums("F_LEVEL", $f);
$c = forums("CAT_ID", $f);
$c_hide = cat("HIDE", $c);
$c_level = cat("LEVEL", $c);
$f_login = check_forum_login($f);
$c_login = check_cat_login($c);
$t_hidden = topics("HIDDEN", $t);
$t_author = topics("AUTHOR", $t);
$t_status = topics("STATUS", $t);
$t_unmoderated = topics("UNMODERATED", $t);
$t_holded = topics("HOLDED", $t);
$sql = DBi::$con->query("SELECT * FROM ".prefix."TOPIC_MEMBERS WHERE TOPIC_ID = '$t' AND MEMBER_ID = '$DBMemberID'");
$num = mysqli_num_rows($sql);
if($c_level == 0 or ($c_level > 0 && $c_level <= $Mlevel)) {
} else {
show_error(46, "", 1);
}	
if($c_hide == 0 or ($c_hide == 1 && $c_login == 1)) {
} else {
show_error(46, "", 1);
}	
if($f_level == 0 or ($f_level > 0 && $f_level <= $Mlevel)) {
} else {
show_error(46, "", 1);
}	
if($f_hide == 0 or ($f_hide == 1 && $f_login == 1)) {
} else {
show_error(46, "", 1);
}

if ($t == "") {
 redirect();
}

if($t_status == 2 && (allowed($f, 2) != 1)) {
show_error(46, "", 1);
}
if($t_hidden == 1 && (allowed($f, 2) != 1 && $num == 0 && $t_author != $DBMemberID)) {
show_error(46, "", 1);
}
if($t_unmoderated == 1 && (allowed($f, 2) != 1 && $t_author != $DBMemberID)) {
show_error(46, "", 1);
}
if($t_holded == 1 && (allowed($f, 2) != 1 && $t_author != $DBMemberID)) {
show_error(46, "", 1);
}


$forum_hide = forums("HIDE", topics("FORUM_ID", $t));
$check_forum_login = check_forum_login(topics("FORUM_ID", $t));
if ($forum_hide == 1){
	if ($check_forum_login == 0){
show_error(46, "", 1);
	}
}

$resultTop = @DBi::$con->query("SELECT * FROM ".$Prefix."TOPICS WHERE TOPIC_ID = '$t' ")
or die (DBi::$con->error);

if(@mysqli_num_rows($resultTop) > 0){
$rsTop = @mysqli_fetch_array($resultTop);

$TOP_TopicID = $rsTop['TOPIC_ID'];
$TOP_ForumID = $rsTop['FORUM_ID'];
$TOP_CatID = $rsTop['CAT_ID'];
$TOP_TopicStatus = $rsTop['T_STATUS'];
$TOP_TopicAuthor = $rsTop['T_AUTHOR'];
$TOP_TopicSubject = $rsTop['T_SUBJECT'];
if((members("HIDE_POSTS", $TOP_TopicAuthor)) && allowed($TOP_ForumID, 2) == 0) {
$TOP_TopicMessage = $lang['topic']['topics_hidden_by_admin'];
} else {
$TOP_TopicMessage = html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($rsTop['T_MESSAGE'])))), ENT_COMPAT, 'UTF-8');
}
$TOP_TopicDate = $rsTop['T_DATE'];
$TOP_TopicHidden = $rsTop['T_HIDDEN'];
$TOP_LastEdit_date = $rsTop['T_LASTEDIT_DATE'];
$TOP_LastEdit_make = $rsTop['T_LASTEDIT_MAKE'];
$TOP_Enum = $rsTop['T_ENUM'];
}

$resultMTop = @DBi::$con->query("SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = '$TOP_TopicAuthor' ")
or die (DBi::$con->error);

if(@mysqli_num_rows($resultMTop) > 0){
$rsMTop = @mysqli_fetch_array($resultMTop);

$MTOP_MemberID = $rsMTop['MEMBER_ID'];
$MTOP_MemberName = $rsMTop['M_NAME'];
$MTOP_MemberStatus = $rsMTop['M_STATUS'];
$MTOP_MemberCountry = $rsMTop['M_COUNTRY'];
$MTOP_MemberTitle = $rsMTop['M_TITLE'];
$MTOP_MemberLevel = $rsMTop['M_LEVEL'];
$hld = members("HOLD_POSTS", $MTOP_MemberID);
$activ = members("HOLD_ACTIVE", $MTOP_MemberID);		
if(members("LEVEL", $MTOP_MemberID) == 4 or (members("LEVEL", $MTOP_MemberID) == 3 && members("DEPUTY", $MTOP_MemberID) == 0)) {
		$MTOP_MemberPosts = HoldPosts(posts($MTOP_MemberID), members("LEVEL", $MTOP_MemberID), members("DEPUTY", $MTOP_MemberID), $hld, $activ);
} else {
		$MTOP_MemberPosts = posts($MTOP_MemberID);
}	
$MTOP_MemberDate = $rsMTop['M_DATE'];
$MTOP_MemberPhotoUrl = $rsMTop['M_PHOTO_URL'];
$MTOP_MemberSig = $rsMTop['M_SIG'];
$MTOP_MemberLogin = $rsMTop['M_LOGIN'];
$MTOP_MemberBrowse = $rsMTop['M_BROWSE'];
}

$resultFTop = @DBi::$con->query("SELECT * FROM " . $Prefix . "FORUM WHERE FORUM_ID = '$TOP_ForumID' ") or die (DBi::$con->error);

if(@mysqli_num_rows($resultFTop) > 0){
$rsFTop = @mysqli_fetch_array($resultFTop);

$FTOP_ForumID = $rsFTop['FORUM_ID'];
$FTOP_ForumSubject = $rsFTop['F_SUBJECT'];
$FTOP_ForumLogo = $rsFTop['F_LOGO'];
}

echo'
<font color="red"><b><font color="black" size="-1"><center>
<table dir="rtl" cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><a href="index.php">'.icons($logo, $forum_title, "").'&nbsp;</td>
		<td width="100%">&nbsp;</td>
		<td vAlign="top">'.$site_name.'</td>
	</tr>
</table>
<table cellSpacing="0" width="100%" border="0">
	<tr>
		<td align="middle" width="100%"><font size="5">&nbsp;'.$TOP_TopicSubject.'</font></td>
		<td>&nbsp;</td>
	</tr>
</table>
<table dir="rtl" cellSpacing="0" cellPadding="0" width="98%" align="center" border="0">
	<tr>
		<td>
		<table dir="rtl" cellSpacing="1" cellPadding="4" width="100%" border="1">
			<tr>
				<td vAlign="top" width="100%" bgColor="black" height="29">
					<a class="menu" href="index.php?mode=f&f='.$FTOP_ForumID.'">
					<font color="#FFFFFF" size="+1">
					<span style="text-decoration: none">'.$FTOP_ForumSubject.'</span></font></a><td bgColor="black" height="29"><font color="#FFFFFF"><nobr>'.normal_time($TOP_TopicDate).'</nobr></font></td>
			</tr>
			<tr>
				<td vAlign="top" bgColor="#ffffff" colSpan="2">
				<table style="table-layout: fixed" width="100%">
					<tr>
						<td><center>
						'; echo text_replace(smiles_replace(make_clickable($TOP_TopicMessage))); if 
						($load_show_sig == 1 AND !empty($MTOP_MemberSig)) { echo 
						'<br><br>
                                      <FIELDSET style="width: 100%; text-align: center">
                                      <legend>&nbsp;<font color="black">'.$lang['topics']['the_signature'].'</font></legend>
                                      '.text_replace(smiles_replace(make_clickable($MTOP_MemberSig))).'
                                      </FIELDSET>
                                      '; } else { echo ''; } echo'
                                </center></td>
					</tr>
				</table>
				</td>
			</tr>
			</table>
<?
					<tr>
							';
							if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
							  if ($TOP_TopicStatus == 1) {							  }
							}
							if ($Mlevel == 4 OR $Monitor == 1 OR $Moderator == 1) {
							  if ($TOP_TopicStatus == 0) {
							  }
							}
							echo'
							</td>
						</form>
					</tr>	
				</table>
				</td>
			</tr>
		</table>
		<table class="" cellSpacing="2" width="100%" border="0">
			<tr>
				<td vAlign="center">&nbsp;';
				if ($TOP_TopicStatus == 1) {
				}
				if ($TOP_TopicStatus == 0) {
				}
				echo'</td>
			</tr>
		</table>
		<table cellSpacing="2" width="100%" border="0">
			<tr>
			<td class="" vAlign="center" width="100%"><a class="footerbar" href="index.php?mode=f&f='.$FTOP_ForumID.'"><font color="red" size="+1"></font></a></td>';
if ($DBMemberID > 0) {
		echo'	<td class="" vAlign="top"><nobr><a href="index.php?mode=editor&method=reply&t='.$TOP_TopicID.'&f='.$TOP_ForumID.'&c='.$TOP_CatID.'"><br></a></nobr></td>
            		<td class="" vAlign="top"><nobr><a href="index.php?mode=editor&method=topic&f='.$TOP_ForumID.'&c='.$TOP_CatID.'"><br></a></nobr></td>';
}
       echo'<form><nobr><br>
              </select></nobr>
            </td></form>';
		if ($pg_sql > 0){;
		}
            ;
            echo'
		</table>
		</td>
</table>
</center>';

?>