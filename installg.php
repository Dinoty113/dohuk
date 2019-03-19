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

@require("./engine/engine_requires_connection.php");
@require("./engine/function.php");
@require("./install/arabic.php");
@require("converts.php");
$step = $_GET["step"];
$editstep = $_GET["editstep"];
echo'
<html dir="'.$lang['global']['dir'].'">
<head>
<meta http-equiv="Content-Language" content="'.$lang['global']['lang_code'].'">
<meta http-equiv="Content-Type" content="UTF-8">
<title>'.$lang['install']['setup'].'</title>
<link rel="stylesheet" href="install/style_green.css">
<SCRIPT language="JavaScript" type="text/javascript">

var necessary_to_insert_site_name = ("'.$lang['install']['necessary_to_insert_site_name'].'");
var necessary_to_insert_site_name2 = ("'.$lang['install']['necessary_to_insert_site_name2'].'");
var necessary_to_insert_site_address = ("'.$lang['install']['necessary_to_insert_site_address'].'");
var necessary_to_insert_site_address2 = ("'.$lang['install']['necessary_to_insert_site_address2'].'");
var necessary_to_insert_user_name = ("'.$lang['install']['necessary_to_insert_user_name'].'");
var necessary_to_insert_more_three_letter = ("'.$lang['install']['necessary_to_insert_more_three_letter'].'");
var necessary_to_insert_less_thirty_letter = ("'.$lang['install']['necessary_to_insert_less_thirty_letter'].'");
var not_allowed_to_use_just_numbers = ("'.$lang['install']['not_allowed_to_use_just_numbers'].'");
var necessary_to_insert_password = ("'.$lang['install']['necessary_to_insert_password'].'");
var necessary_to_insert_confirm_password = ("'.$lang['install']['necessary_to_insert_confirm_password'].'");
var necessary_to_insert_true_confirm_password = ("'.$lang['install']['necessary_to_insert_true_confirm_password'].'");
var necessary_to_insert_email = ("'.$lang['install']['necessary_to_insert_email'].'");
var necessary_to_insert_true_email = ("'.$lang['install']['necessary_to_insert_true_email'].'");

function submitForm()
{

if (userinfo.forum_title.value.length == 0)
	{
	confirm(necessary_to_insert_site_name);
	return;
	}
	
if (userinfo.forum_title2.value.length == 0)
	{
	confirm(necessary_to_insert_site_name2);
	return;
	}

if (userinfo.site_address.value.length == 0)
	{
	confirm(necessary_to_insert_site_address);
	return;
	}
if (userinfo.site_address2.value.length == 0)
	{
	confirm(necessary_to_insert_site_address2);
	return;
	}	

if (userinfo.user_name.value.length == 0)
	{
	confirm(necessary_to_insert_user_name);
	return;
	}

if (userinfo.user_name.value.length < 3)
	{
	confirm(necessary_to_insert_more_three_letter);
	return;
	}

if (userinfo.user_name.value.length > 30)
	{
	confirm(necessary_to_insert_less_thirty_letter);
	return;
	}

if (parseInt(userinfo.user_name.value) == userinfo.user_name.value)
	{
	confirm(not_allowed_to_use_just_numbers);
	return;
	}

if (userinfo.user_password1.value.length == 0)
	{
	confirm(necessary_to_insert_password);
	return;
	}

if (userinfo.user_password2.value.length == 0)
	{
	confirm(necessary_to_insert_confirm_password);
	return;
	}

if (userinfo.user_password1.value != userinfo.user_password2.value)
	{
	confirm(necessary_to_insert_true_confirm_password);
	return;
	}

if (userinfo.user_email.value.length == 0)
	{
	confirm(necessary_to_insert_email);
	return;
	}

if (!/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/.test(userinfo.user_email.value))
	{
	confirm(necessary_to_insert_true_email);
	return;
	}

userinfo.submit();
}


</SCRIPT>
</head>

<body>


<center>
<table border="0" width="42%" cellspacing="4" cellpadding="3" bgcolor="#C0C0C0">
	<tr>
			<td align="center" bgcolor="#CC3300"><br><font size="6" color="#FFFFFF">DuHok Forum 2.1</font><br><br><font color="#FFFFFF"><b>Programming By Dilovan<br>Developing By DuHok Forum Team</b>
			</font><br><br><font color="#FFFFFF"></td>
	</tr>
</table>
</center>

<br>';


if ($step == "") {
                    echo'
	                <center>
	                <table width="60%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['install']['welcome'].' DuHok Forum 2.1</font><br><br>
	                       <a href="install.php?step=0">'.$lang['install']['click_here'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';


}

// Advenced Install; Programmed By Mr MoHanD; begin
if ($step == "0") {
                    ?>
					<form method="post" action="install.php?step=1&editstep=1">
	                <center>
	                <table width="60%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br><? echo $lang['install']['database_settings']; ?></font><br><br>
								<table align=center>
									<tr>
	                       <td><? echo $lang['install']['the_host']; ?></td><td><input type="text" name="dbhost">
						   <img src="images/icons/icon_question.gif" onclick="alert('Write Database Host\n\r eg: localhost');" ></img></td>
									</tr>
									<tr>
	                       <td><? echo $lang['install']['database_user']; ?></td><td><input type="text" name="dbuser">
						   <img src="images/icons/icon_question.gif" onclick="alert('Write Database User\n\r eg: root');" ></img></td>
									</tr>
									<tr>
	                       <td><? echo $lang['install']['database_pass']; ?></td><td><input type="password" name="dbpass">
						   <img src="images/icons/icon_question.gif" onclick="alert('Write Database Pass\n\r eg: pass');" ></img></td>
									</tr>
									<tr>
	                       <td><? echo $lang['install']['database_name']; ?></td><td><input type="text" name="dbname">
						   <img src="images/icons/icon_question.gif" onclick="alert('Write Database Name\n\r eg: df');" ></img></td>
									</tr>
									<tr>
	                       <td><? echo $lang['install']['database_prefix']; ?></td><td><input type="text" name="dbprefix" value="DuHokForum_">
						   <img src="images/icons/icon_question.gif" onclick="alert('Write Database Prefix\n\r eg: DuHokForum_');" ></img></td>
									</tr>
									<tr>
	                       <td align="center" colspan="2"><input type="submit" value="<? echo $lang['install']['connect']; ?>"></td>
									</tr>
									
								</table>
						   <br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>
					</form><?
}


if ($step == "1" && $editstep == "1") {

$dbhost = htmlspecialchars(trim($_POST[dbhost]));
$dbuser = htmlspecialchars(trim($_POST[dbuser]));
$dbpass = htmlspecialchars(trim($_POST[dbpass]));
$dbname = htmlspecialchars(trim($_POST[dbname]));
$Prefix = htmlspecialchars(trim($_POST[dbprefix]));

// echo "$dbhost @ $dbuser : $dbpass; dbname: $dbname @ $dbprefix <br><br>";

// if(!empty($dbhost) OR !empty($dbuser) OR !empty($dbpass) OR !empty($dbname) OR !empty($Prefix)){
if($dbhost != "" && $dbuser != "" && $dbpass != "" && $dbname != "" && $Prefix != ""){
		$connection_file = './engine/engine_requires_connection.php';
		$tmp_file = './engine/engine_requires_connection.php.tmp';

		$reading = fopen($connection_file, 'r');
		$writing = fopen($tmp_file, 'w');
		$replaced = false;

		while (!feof($reading)) {
		  $line = fgets($reading);
		  if (stristr($line,'$dbhost =')) {
			$line = '$dbhost = "'.$dbhost.'";'."\n";
			$replaced = true;
		  }
		  if (stristr($line,'$dbuser =')) {
			$line = '$dbuser = "'.$dbuser.'";'."\n";
			$replaced = true;
		  }
		  if (stristr($line,'$dbpass =')) {
			$line = '$dbpass = "'.$dbpass.'";'."\n";
			$replaced = true;
		  }
		  if (stristr($line,'$dbname =')) {
			$line = '$dbname = "'.$dbname.'";'."\n";
			$replaced = true;
		  }
		  if (stristr($line,'$Prefix =')) {
			$line = '$Prefix = "'.$Prefix.'";'."\n";
			$replaced = true;
		  }
		  fputs($writing, $line);
		}
		fclose($reading); fclose($writing);
		if ($replaced) 
		{
DBi::$con = new mysqli($dbhost, $dbuser, $dbpass) or die ('
							<center>
							<table width="60%" border="1">
							   <tr class="normal">
								   <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['install']['unknown_error'].'</font><br><br>
								   '.$lang['install']['db_error'].'<br><br>
								   <a href="install.php?step=0">'.$lang['install']['click_here_to_go_back'].'</a><br><br>
								   </td>
							   </tr>
							</table>
							</center>');
DBi::$con->select_db($dbname) or die ('
							<center>
							<table width="60%" border="1">
							   <tr class="normal">
								   <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['install']['unknown_error'].'</font><br><br>
								   '.$lang['install']['db_error'].'<br><br>
								   <a href="install.php?step=0">'.$lang['install']['click_here_to_go_back'].'</a><br><br>
								   </td>
							   </tr>
							</table>
							</center>');
			echo '
							<center>
							<table width="60%" border="1">
							   <tr class="normal">
								   <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['install']['done_edit_connection'].'</font><br><br>
								   <a href="install.php?step=1&editstep=0">'.$lang['install']['next'].'</a><br><br>
								   </td>
							   </tr>
							</table>
							</center>';
							
		  @file_put_contents($connection_file, file_get_contents($tmp_file)) or die ('
							<center>
							<table width="60%" border="1">
							   <tr class="normal">
								   <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['install']['unknown_error'].'</font><br><br>
								   '.$lang['install']['error_desc'].'<br><br>
								   <a href="install.php?step=0">'.$lang['install']['click_here_to_go_back'].'</a><br><br>
								   </td>
							   </tr>
							</table>
							</center>');
		  unlink($tmp_file);
		}
}else{
	echo '
							<center>
							<table width="60%" border="1">
							   <tr class="normal">
								   <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['install']['unknown_error'].'</font><br><br>
									'.$lang['install']['new_error_desc'].'<br><br>
								   <a href="install.php?step=0">'.$lang['install']['click_here_to_go_back'].'</a><br><br>
								   </td>
							   </tr>
							</table>
							</center>';
}


// Advenced Install; Programmed By Mr MoHanD; end

}

if ($step == "1" && $editstep == "0") {

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."AUTHOR_MOD") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."AUTHOR_MOD (
  REQ_ID int(11) NOT NULL auto_increment,
  REQ_STATUS int(11) default '2',
  REQ_USERID int(11) default NULL,
  REQ_FRMID int(11) default '0',
  REQ_AUTHOR varchar(255) default NULL,
  REQ_COLOR1 varchar(255) default NULL,
  REQ_COLOR2 varchar(255) default NULL,
  
  PRIMARY KEY (REQ_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."ADD_MODS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."ADD_MODS (
  ID int(11) NOT NULL auto_increment,
  FORUM_ID int(11) default NULL,
  MEMBER_ID int(11) default NULL,
  BY_ID int(11) default NULL,
  STATUS int(11) default NULL,
  DATE INT(11) UNSIGNED default NULL,
  TOPIC INT(11) NOT NULL DEFAULT '0',
  
  PRIMARY KEY (ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."ADMIN_MARKET") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."ADMIN_MARKET (
  ID int(11) NOT NULL auto_increment,
  NAME varchar(255) default NULL,
  DESCRIPTION text,
  IMG varchar(500) default NULL,
  AUTHOR int(11) default '0',
  DATE int(10) unsigned default NULL,
  CUSTOMER int(11) NOT NULL default '0',
  CUSTOMER_NUMBER int(11) NOT NULL default '0',
  STATUS  int(11) NOT NULL default '1' ,
  DOLLAR  int(11) NOT NULL default '1' ,
  TYPE  int(11) NOT NULL ,
  MEDAL  varchar(255) default NULL ,
  MEDAL_ID  int(11) NOT NULL default '0' ,
  MEDAL_DAYS  int(11) NOT NULL default '0' ,
  POINTS  int(11) NOT NULL default '0' ,
  SPECIAL_POINTS_ID  int(11) NOT NULL default '0' ,
  SPECIAL_POINTS  int(11) NOT NULL default '0' ,

  PRIMARY KEY (ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."ADMIN_MARKET_BUYERS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."ADMIN_MARKET_BUYERS (
  ID int(11) NOT NULL auto_increment,
  SALE_ID int(11) default NULL,
  MEMBER_ID int(11) default NULL,

  PRIMARY KEY (ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."ADS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."ADS (
  AD_ID int(11) NOT NULL auto_increment,
  AD_SUBJECT varchar(255) default NULL,
  AD_MESSAGE text,
  AD_AUTHOR int(11) default '0',
  AD_DATE int(10) unsigned default NULL,
  AD_COUNTS int(11) NOT NULL default '0',
  AD_STATUS int(11) NOT NULL default '1',
  AD_SHOW_FORUM int(11) NOT NULL default '0',
  AD_SHOW_SOCIAL_1 int(11) NOT NULL default '0',
  AD_SHOW_SOCIAL_2 int(11) NOT NULL default '0',

  PRIMARY KEY (AD_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."ADS_COUNTS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."ADS_COUNTS (
  ID int(11) NOT NULL auto_increment,
  COUNT_MEMBER int(11) default NULL,
  COUNT_AD int(11) default NULL,
  
  PRIMARY KEY (ID))

") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."CATEGORY") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."CATEGORY (
  CAT_ID int(10) NOT NULL auto_increment,
  CAT_STATUS int(10) default '1',
  CAT_NAME varchar(100) NULL,
  CAT_ORDER int(10) default '1',
  CAT_MONITOR int(10) default NULL,
  CAT_DEPUTY_MONITOR int(10) default NULL,
  CAT_HIDE INT(10) NOT NULL DEFAULT '0',
  CAT_LEVEL INT(10) NOT NULL DEFAULT '0',
  SITE_ID INT(10) NOT NULL DEFAULT '1',
  SHOW_INDEX  int(11) NOT NULL ,
  SHOW_INFO  int(11) NOT NULL ,
  SHOW_PROFILE  int(11) NOT NULL ,

  PRIMARY KEY (CAT_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."CEP_CAT") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."CEP_CAT (
  O_CATIDA int(11) unsigned NOT NULL auto_increment,
  O_CAT_NAMEA varchar(40) default NULL,
  O_CAT_URLA varchar(40) default NULL,
  PRIMARY KEY (O_CATIDA))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."CEP_FORUM") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."CEP_FORUM (
  O_FORUMIDA int(11) unsigned NOT NULL auto_increment,
  O_FORUM_NAMEA varchar(255) NOT NULL default 'NOT NULL',
  O_FORUM_URLA varchar(255) default NULL,
  O_FORUM_IP varchar(40) default NULL,
  O_FORUM_DATE int(10) unsigned default NULL,

  PRIMARY KEY (O_FORUMIDA))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."LANGUAGE") or die(DBi::$con->error);
DBi::$con->query("
  CREATE TABLE ".prefix."LANGUAGE (
  L_ID int(10) unsigned NOT NULL auto_increment,
  L_FILE_NAME varchar( 100 ) NULL default NULL,
  L_NAME varchar( 100 ) NULL default NULL,
  PRIMARY KEY (L_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."CHANGENAME_PENDING") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."CHANGENAME_PENDING (
  CHNAME_ID int(10) unsigned NOT NULL auto_increment,
  MEMBERID int(11) default '0',
  NEW_NAME varchar(40) default NULL,
  LAST_NAME varchar(40) default NULL,
  CH_DONE int(11) default '0',
  CH_CANCELLED int(11) default '0',
  UNDERDEMANDE int(11) default '0',
  CH_LASTDEMANDE int(11) default '0',
  CH_DATE int(10) unsigned default NULL,
  PRIMARY KEY  (CHNAME_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."CONFIG") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."CONFIG (
  ID int(10) unsigned NOT NULL auto_increment,
  VARIABLE varchar(255) default NULL,
  VALUE varchar(2000) default NULL,
  PRIMARY KEY (ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."COUNTS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."COUNTS (
  ID int(10) unsigned NOT NULL auto_increment,
  COUNT_MEMBER int(10) default NULL,
  COUNT_TOPIC int(10) default NULL,
  PRIMARY KEY  (ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."EMAIL_PED") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."EMAIL_PED (
  CHEMAIL_ID int(10) NOT NULL auto_increment,
  MEMBERID int(11) default '0',
  NEW_EMAIL varchar(100) default NULL,
  LAST_EMAIL varchar(100) default NULL,
  CH_DONE int(11) default '0',
  UNDERDEMANDE int(11) default '0',
  CH_DATE int(10) unsigned default NULL,
  CODE varchar(255) default NULL,
  PRIMARY KEY (CHEMAIL_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."FILES") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."FILES (
  FILES_ID int(10) NOT NULL auto_increment,
  MEMBER_ID varchar(100) default NULL,
  FILES_SIZE varchar(100) default NULL,
  FILES_DATE int(10) unsigned default NULL,
  FILES_URL varchar(100) default NULL,
  FILES_NAME varchar(100) default NULL,
  PRIMARY KEY (FILES_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."FORUM_ONLINE") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."FORUM_ONLINE (
  ID int(10) NOT NULL auto_increment,
  F_ID int(11) default NULL,
  F_YEAR int(11) unsigned NOT NULL default '0',
  F_MONTH varchar(100) default NULL,
  F_MONTH_NUMBER int(11) unsigned NOT NULL default '0',
  F_DAY varchar(100) default NULL,
  F_DAY_NUMBER int(11) unsigned NOT NULL default '0',
  F_POINTS varchar(255) NOT NULL default '0',
  PRIMARY KEY (ID))
") or die(DBi::$con->error);


DBi::$con->query("DROP TABLE IF EXISTS ".prefix."fblike") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."fblike (
  id int(11) NOT NULL auto_increment,
  title varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  status varchar(11) NOT NULL,
  url varchar(256) NOT NULL,
  time int(5) NOT NULL,
  mssg varchar(256) character set utf8 collate utf8_unicode_ci NOT NULL,
  ads int(11) NOT NULL,
  PRIMARY KEY (id))
") or die(DBi::$con->error);


DBi::$con->query("DROP TABLE IF EXISTS ".prefix."FILTRE") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."FILTRE (
  FILTRE_ID int(11) NOT NULL auto_increment,
  F_NAME text NOT NULL,
  F_REP text NOT NULL,
  F_STAT int(11) NOT NULL,
  PRIMARY KEY (FILTRE_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."FILTRE_NAMES") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."FILTRE_NAMES (
  FILTRE_ID int(11) NOT NULL auto_increment,
  F_NAME text NOT NULL,
  PRIMARY KEY (FILTRE_ID))
") or die(DBi::$con->error);	

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."TOPICS_CMD") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."TOPICS_CMD (
  CMD_ID int(11) NOT NULL auto_increment,
  CMD_DO int(11) default NULL,
  CMD_DATE int(11) unsigned default NULL,
  CMD_TOPIC int(11) default NULL,
  CMD_TYPE varchar(255) default NULL,
  PRIMARY KEY (CMD_ID),
  KEY CMD_DO (CMD_DO),
  KEY CMD_TOPIC (CMD_TOPIC))
") or die(DBi::$con->error);	

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."REPLIES_CMD") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."REPLIES_CMD (
  CMD_ID int(11) NOT NULL auto_increment,
  CMD_DO int(11) default NULL,
  CMD_DATE int(11) unsigned default NULL,
  CMD_REPLY int(11) default NULL,
  CMD_TYPE varchar(255) default NULL,
  PRIMARY KEY (CMD_ID),
  KEY CMD_DO (CMD_DO),
  KEY CMD_REPLY (CMD_REPLY))
") or die(DBi::$con->error);	

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."FORUM") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."FORUM (
  CAT_ID int(10) default NULL,
  FORUM_ID int(10) unsigned NOT NULL auto_increment,
  F_STATUS int(10) default '1',
  F_SUBJECT varchar(100) default NULL,
  F_DESCRIPTION text,
  F_TOPICS int(10) default '0',
  F_REPLIES int(10) default '0',
  F_LAST_POST_DATE int(10) unsigned default NULL,
  F_LAST_POST_AUTHOR int(10) default NULL,
  F_ORDER int(10) default '1',
  F_LOGO varchar(255) default NULL,
  F_SEX INT(10) NULL DEFAULT '0',
  F_TOTAL_TOPICS int(11) default '5',
  F_TOTAL_REPLIES int(11) default '200',
  F_HIDE int(11) default '0',
  F_HIDE_MOD INT(10) NULL DEFAULT '0',
  F_HIDE_PHOTO int(11) default '0',
  F_HIDE_SIG int(11) default '0',
  DAY_ARCHIVE int(11) NOT NULL default '30', 
  CAN_ARCHIVE int(11) NOT NULL, 
  F_LEVEL INT(10) NOT NULL DEFAULT '0',
  SHOW_PROFILE  int(11) NOT NULL ,
  MODERATE_TOPIC  int(11) NOT NULL ,
  MODERATE_REPLY  int(11) NOT NULL ,
  SHOW_INDEX  int(11) NOT NULL ,
  SHOW_FRM  int(11) NOT NULL ,
  SHOW_INFO  int(11) NOT NULL ,
  SHOW_MONS  int(11) NOT NULL ,
  F_SOCIAL int(11) NOT NULL default '0',
  F_HASHTAG varchar(255) default NULL,
  MODERATE_POSTS int(11) NOT NULL default '35',
  MODERATE_DAYS  int(11) NOT NULL default '15' ,
  F_HIDE_MEDAL int(11) NOT NULL default '0',
  F_DOLLAR_TOPIC varchar(255) default '2',
  F_DOLLAR_REPLY varchar(255) default '1',

  PRIMARY KEY (FORUM_ID),
  KEY CAT_ID (CAT_ID),
  KEY F_TOPICS (F_TOPICS),
  KEY F_REPLIES (F_REPLIES),
  KEY F_LAST_POST_DATE (F_LAST_POST_DATE),
  KEY F_LAST_POST_AUTHOR (F_LAST_POST_AUTHOR))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."FORUM_ORDER") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."FORUM_ORDER (
  FO_ID int(11) NOT NULL auto_increment,
  FORUM_ID int(11) default NULL,
  FO_POINTS int(11) default NULL,
  FO_OLD_POINTS int(11) default NULL,
  FO_ORDER int(11) default '0',
  FO_OLD_ORDER int(11) default NULL,
  PRIMARY KEY  (FO_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."FAVOURITE_TOPICS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."FAVOURITE_TOPICS (
  FAVT_ID int(11) NOT NULL auto_increment,
  F_MEMBERID int(11) default '0',
  F_CATID int(11) default '0',
  F_FORUMID int(11) default '0',
  F_TOPICID int(11) default '0',
  PRIMARY KEY (FAVT_ID),
  KEY F_CATID (F_CATID),
  KEY F_FORUMID (F_FORUMID),
  KEY F_TOPICID (F_TOPICID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."GROUPS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."GROUPS (
  G_ID int(11) NOT NULL auto_increment,
  G_NAME text NOT NULL,
  G_STATUS int(11) NOT NULL default '0',
  G_DESC text NOT NULL,
  G_FORUM int(11) NOT NULL,
  G_IMG text NOT NULL,
  G_DATE timestamp NOT NULL default CURRENT_TIMESTAMP,
  G_POINTS varchar(255) NOT NULL default '0',
  G_LOGIN int(10) NOT NULL default '1',
  G_MOD int(10) NOT NULL default '0',
  G_ADDED varchar(255) NOT NULL,
  PRIMARY KEY (G_ID),
  KEY G_FORUM (G_FORUM))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."GROUPS_CHAT") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."GROUPS_CHAT (
  C_ID int(11) NOT NULL auto_increment,
  C_TXT text NOT NULL,
  C_MEMBER int(11) NOT NULL,
  C_GROUP int(11) NOT NULL,
  C_TIME timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY (C_ID),
  KEY C_MEMBER (C_MEMBER),
  KEY C_GROUP (C_GROUP))
") or die(DBi::$con->error);
  
DBi::$con->query("DROP TABLE IF EXISTS ".prefix."GROUPS_MEMBERS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."GROUPS_MEMBERS (
  ID int(11) NOT NULL auto_increment,
  M_ID int(11) NOT NULL,
  M_GROUP int(11) NOT NULL,
  M_STATUS int(10) NOT NULL,
  M_FORUM int(10) NOT NULL,
  M_DATE varchar(255) NOT NULL,
  M_INVITE int(10) NOT NULL,
  PRIMARY KEY (ID),
  KEY M_GROUP (M_GROUP),
  KEY M_FORUM (M_FORUM))
") or die(DBi::$con->error); 

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."GROUPS_TRANS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."GROUPS_TRANS (
  ID int(11) NOT NULL auto_increment,
  T_GROUP int(11) NOT NULL,
  T_TXT text NOT NULL,
  T_MEM int(11) NOT NULL,
  T_TIME timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY (ID),
  KEY T_GROUP (T_GROUP))
") or die(DBi::$con->error); 

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."GROUPS_FILES") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."GROUPS_FILES (
  GF_ID int(10) unsigned NOT NULL auto_increment,
  FORUM_ID int(11) default NULL,
  ADDED int(11) default NULL,
  SUBJECT varchar(255) default NULL,
  DATE int(10) unsigned default NULL,
  NAME varchar(255) default NULL,
  PRIMARY KEY  (GF_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."HIDE_FORUM") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."HIDE_FORUM (
  HF_ID int(10) unsigned NOT NULL auto_increment,
  HF_MEMBER_ID int(11) default NULL,
  HF_FORUM_ID int(11) default NULL,
  HF_CAT_ID INT(11) default NULL,
  PRIMARY KEY (HF_ID))
") or die(DBi::$con->error);
 
DBi::$con->query("DROP TABLE IF EXISTS ".prefix."MEMBERS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."MEMBERS (
  MEMBER_ID int(10) unsigned NOT NULL auto_increment,
  M_STATUS int(10) default '1',
  M_NAME varchar(255) default NULL,
  M_PASSWORD varchar(100) default NULL,
  M_EMAIL varchar(100) default NULL,
  M_COUNTRY varchar(50) default NULL,
  M_LEVEL int(10) default '1',
  M_POSTS int(10) default '0',
  M_POINTS int(11) default '0',
  M_DATE int(10) unsigned default NULL,
  M_LAST_HERE_DATE int(10) unsigned default NULL,
  M_LAST_POST_DATE int(10) unsigned default NULL,
  M_RECEIVE_EMAIL int(10) default '1',
  M_LAST_IP varchar(25) default NULL,
  M_IP varchar(15) default NULL,
  M_OCCUPATION varchar(255) default NULL,
  M_SEX varchar(50) default NULL,
  M_AGE varchar(10) default NULL,
  M_BIO text,
  M_REALNAME varchar(255) default NULL,
  M_HOBBY int(11) default '0',  
  M_SIG text,
  M_MARSTATUS varchar(100) default NULL,
  M_CITY varchar(100) default NULL,
  M_STATE varchar(100) default NULL,
  M_PHOTO_URL varchar(255) default NULL,
  M_TITLE varchar(255) default NULL,
  M_OLD_MOD INT(10) NULL DEFAULT '0',
  M_MEDAL int(11) default '0',
  M_LOGIN int(10) default '0',
  M_PMHIDE int(11) default '1',
  M_CHANGENAME int(11) default '0',
  M_BROWSE int(11) default '1',
  M_HIDE_SIG int(11) default '0',
  M_HIDE_PHOTO int(11) default '0',
  M_HIDE_DETAILS int(11) default '0',
  M_HIDE_POSTS int(11) default '0',
  M_HIDE_PM int(11) default '0',
  M_USE_PM int(11) default '0',
  M_SP_EDITOR int(11) default '1',
  view  int(11) NOT NULL ,
  M_ADMIN  int(11) default '1',
  P_INDEX  int(11) default '0',
  P_ARCHIVE int(11) default '0' ,
  P_MEMBERS  int(11) default '0',
  P_POSTS  int(11) default '0',
 P_POSTS_MEMBERS  int(11) default '0' ,
 P_TOPICS  int(11) default '0',
 P_TOPICS_MEMBERS  int(11) default '0',
 P_ACTIVE  int(11) default '0',
 P_MONITORED  int(11) default '0' ,
 P_SEARCH  int(11) default '0' ,
 P_DETAILS  int(11) default '0' ,
 P_PASS  int(11) default '0' ,
 P_DETAILS_EDIT  int(11) default '0' ,
 P_MEDALS  int(11) default '0' ,
 P_CHANGE_NAME  int(11) default '0' ,
 P_LIST  int(11) default '0' ,
 P_SIG  int(11) default '0' ,
 P_FORUM  int(11) default '0' ,
 P_FORUM_ARCHIVE  int(11) default '0' ,
 P_TOPICS_SHOW  int(11) default '0' ,
 P_POSTS_SHOW  int(11) default '0' ,
 P_ADD_TOPICS  int(11) default '0' ,
 P_ADD_POSTS  int(11) default '0' ,
 P_QUICK_POSTS  int(11) default '0' ,
 P_EDIT_TOPICS  int(11) default '0' ,
 P_EDIT_POSTS  int(11) default '0' ,
 P_SEND_TOPICS  int(11) default '0' ,
 P_NOTIFY  int(11) default '0' ,
 M_NOTES text,
 M_SIZE  int(11) default '18' ,
 M_ALIGN  varchar(15) default 'center' ,
 M_FONTS_T varchar(15) default NULL ,
 M_COLOR  varchar(15) default 'blue'  ,
 M_WEIGHT varchar(15) default 'normal'   ,
 M_IHDAA  int(11) default '0' ,
 M_HOB1 varchar(255) default NULL,
 M_HOB2 varchar(255) default NULL,
 M_HOB3 varchar(255) default NULL,
 M_HOB4 varchar(255) default NULL,
 M_HOB5 varchar(255) default NULL,
 M_HOB6 varchar(255) default NULL,
 M_HOB7 varchar(255) default NULL,
 M_HOB8 varchar(255) default NULL,
 M_HOB9 varchar(255) default NULL,
 M_HOB10 varchar(255) default NULL,
 M_HOB11 varchar(255) default NULL,
 M_HOB12 varchar(255) default NULL,
 M_HOB13 varchar(255) default NULL,
 M_HOB14 varchar(255) default NULL,
 M_HOB15 varchar(255) default NULL,
 M_HOB16 varchar(255) default NULL,
 M_HOB17 varchar(255) default NULL,
 M_HOB18 varchar(255) default NULL,
 M_HOB19 varchar(255) default NULL,
 M_HOB20 varchar(255) default NULL,
 M_HOB21 varchar(255) default NULL,
 M_HOB22 varchar(255) default NULL,
 M_HOB23 varchar(255) default NULL,
 M_HOB24 varchar(255) default NULL,
 M_HOB25 varchar(255) default NULL,
 M_HOB26 varchar(255) default NULL,
 M_HOB27 varchar(255) default NULL,
 M_HOB28 varchar(255) default NULL,
 M_HOB29 varchar(255) default NULL,
 M_HOB30 varchar(255) default NULL,
 M_HOB31 varchar(255) default NULL,
 M_HOB32 varchar(255) default NULL,
 M_HOB33 varchar(255) default NULL,
 M_HOB34 varchar(255) default NULL,
 M_HOB35 varchar(255) default NULL,
 M_PHOTO_PURL varchar(255) NOT NULL,
 M_DAY varchar(255) default NULL,
 M_MONTH varchar(255) default NULL,
 M_YEAR varchar(255) default NULL,
 M_SKIN varchar(255) NOT NULL default '17',
 M_OPT int(11) NOT NULL default '80',
 M_CODE varchar(255) default NULL,
 M_NATIONALITY varchar(50) default NULL,
 M_HOLD_POSTS varchar(255) NOT NULL default '0',
 M_HOLD_ACTIVE int(10) NOT NULL default '0',
 M_HOLDED int(10) NOT NULL default '0',
 M_HOLDED_BY varchar(255) default NULL,
 M_HOLDED_DATE varchar(255) default NULL,
 M_DOLLAR varchar(255) NOT NULL default '0',
 M_MOD_MARKET int(11) default '0',
 M_SPECIAL_POINTS int(11) NOT NULL default '0',
 M_DEPUTY int(11) default '0',
 M_MOD varchar(255) default '0',
 M_ONLINE varchar(255) default '0',
 M_ICON_VERF int(11) default '0',
 M_PEDU1_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_PEDU1_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU1_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU1_NAME VARCHAR (255) DEFAULT NULL,
 M_PEDU1_DETAILS TEXT,
 M_PEDU2_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_PEDU2_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU2_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU2_NAME VARCHAR (255) DEFAULT NULL,
 M_PEDU2_DETAILS TEXT,
 M_PEDU3_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_PEDU3_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU3_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU3_NAME VARCHAR (255) DEFAULT NULL,
 M_PEDU3_DETAILS TEXT,
 M_PEDU4_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_PEDU4_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU4_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU4_NAME VARCHAR (255) DEFAULT NULL,
 M_PEDU4_DETAILS TEXT,
 M_PEDU5_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_PEDU5_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU5_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_PEDU5_NAME VARCHAR (255) DEFAULT NULL,
 M_PEDU5_DETAILS TEXT,
 M_EDU1_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_EDU1_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU1_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU1_NAME VARCHAR (255) DEFAULT NULL,
 M_EDU1_DETAILS TEXT,
 M_EDU2_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_EDU2_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU2_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU2_NAME VARCHAR (255) DEFAULT NULL,
 M_EDU2_DETAILS TEXT,
 M_EDU3_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_EDU3_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU3_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU3_NAME VARCHAR (255) DEFAULT NULL,
 M_EDU3_DETAILS TEXT,
 M_EDU4_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_EDU4_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU4_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU4_NAME VARCHAR (255) DEFAULT NULL,
 M_EDU4_DETAILS TEXT,
 M_EDU5_LEVEL VARCHAR (255) NOT NULL DEFAULT '* حذف *',
 M_EDU5_FROM_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU5_TO_YEAR INT (11) NOT NULL DEFAULT '0',
 M_EDU5_NAME VARCHAR (255) DEFAULT NULL,
 M_EDU5_DETAILS TEXT, 
 
  PRIMARY KEY (MEMBER_ID),
  KEY M_LAST_POST_DATE (M_LAST_POST_DATE),
  KEY M_LAST_HERE_DATE (M_LAST_HERE_DATE))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."MEMBERS_MARKET") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."MEMBERS_MARKET (
  ID int(11) NOT NULL auto_increment,
  NAME varchar(255) default NULL,
  DESCRIPTION text,
  IMG varchar(500) default NULL,
  AUTHOR int(11) default '0',
  DATE int(10) unsigned default NULL,
  CUSTOMER int(11) NOT NULL default '0',
  STATUS int(11) NOT NULL default '1',
  BUY_DATE int(10) unsigned default NULL,
  DOLLAR int(11) NOT NULL default '1',
  BUY_TEXT text,
  MOD_S int(11) NOT NULL default '0',
  PRIMARY KEY (ID),
  KEY AUTHOR (AUTHOR),
  KEY CUSTOMER (CUSTOMER))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."MODERATOR") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."MODERATOR (
  MOD_ID int(10) unsigned NOT NULL auto_increment,
  FORUM_ID int(11) default '0',
  MEMBER_ID int(11) default '0',
  PRIMARY KEY (MOD_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."ONLINE") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."ONLINE (
  ONLINE_ID int(10) unsigned NOT NULL auto_increment,
  O_MEMBER_ID int(11) default NULL,
  O_FORUM_ID int(11) default NULL,
  O_MEMBER_LEVEL int(11) default '0',
  O_MEMBER_DEPUTY int(11) default '0',
  O_MEMBER_BROWSE int(11) default '1',
  O_IP varchar(30) default NULL,
  O_MODE varchar(100) default NULL,
  O_DATE int(10) unsigned default NULL,
  O_LAST_DATE int(10) unsigned default NULL,
  PRIMARY KEY (ONLINE_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."SOCIAL") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."SOCIAL (
  REQ_ID int(11) NOT NULL auto_increment,
  REQ_STATUS int(11) default '2',
  REQ_USERID int(11) default NULL,
  REQ_FRMID int(11) default '0',
  REQ_HASHTAG varchar(255) default NULL,
  REQ_SOCIAL int(11) NOT NULL default '0',
  PRIMARY KEY (REQ_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."OTHERS_CAT") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."OTHERS_CAT (
  O_CATID int(11) unsigned NOT NULL auto_increment,
  O_CAT_NAME varchar(40) default NULL,
  O_CAT_URL varchar(40) default NULL,
  PRIMARY KEY (O_CATID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."OTHERS_FORUM") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."OTHERS_FORUM (
  O_FORUMID int(11) unsigned NOT NULL auto_increment,
  O_FORUM_NAME varchar(40) default NULL,
  O_FORUM_URL varchar(40) default NULL,
  PRIMARY KEY (O_FORUMID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."PM") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."PM (
  PM_ID int(10) unsigned NOT NULL auto_increment,
  PM_MID int(11) default '0',
  PM_STATUS int(11) default '1',
  PM_TO int(11) default '0',
  PM_FROM int(11) default '0',
  PM_READ int(11) default '0',
  PM_OUT int(11) default '0',
  PM_REPLY int(11) default '0',
  PM_SUBJECT varchar(500) default NULL,
  PM_MESSAGE text,
  PM_DATE int(10) unsigned default NULL,
  PRIMARY KEY (PM_ID),
  KEY PM_MID (PM_MID),
  KEY PM_TO (PM_TO),
  KEY PM_FROM (PM_FROM))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."REPLY") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."REPLY (
  CAT_ID int(11) default '0',
  FORUM_ID int(11) default '0',
  TOPIC_ID int(11) default '0',
  REPLY_ID int(10) unsigned NOT NULL auto_increment,
  R_STATUS int(11) default '1',
  R_QUOTE int(11) default '0',
  R_AUTHOR int(11) default '0',
  R_MESSAGE text,
  R_DATE int(10) unsigned default NULL,
  R_HIDDEN int(11) default '0',
  R_UNMODERATED int(11) default '0',
  R_HOLDED int(11) default '0',
  R_LASTEDIT_DATE int(11) unsigned default NULL,
  R_LASTEDIT_MAKE varchar(40) default NULL,
  R_ENUM int(10) default '0',
  R_T_HIDDEN int(10) default '0',
  R_AUTHOR_MOD int(11) default '0',
  PRIMARY KEY (REPLY_ID),
  KEY CAT_ID (CAT_ID),
  KEY FORUM_ID (FORUM_ID),
  KEY TOPIC_ID (TOPIC_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."TOPICS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."TOPICS (
  CAT_ID int(11) default '0',
  FORUM_ID int(11) default '0',
  TOPIC_ID int(10) unsigned NOT NULL auto_increment,
  T_STATUS int(11) default '1',
  T_SUBJECT varchar(500) default NULL,
  T_MESSAGE text,
  T_REPLIES int(11) default '0',
  T_COUNTS int(11) default '0',
  T_AUTHOR int(11) default '0',
  T_DATE int(10) unsigned default NULL,
  T_LAST_POST_AUTHOR int(10) default '1',
  T_LAST_POST_DATE int(10) unsigned default NULL,
  T_ARCHIVE_FLAG int(11) default '1',
  T_STICKY int(11) default '0',
  T_HIDDEN int(11) default '0',
  T_UNMODERATED int(11) default '0',
  T_HOLDED int(11) default '0',
  T_MOVED int(11) default '0',
  T_TOP int(11) default '0',
  T_LINKFORUM int(11) default '0',
  T_LASTEDIT_DATE int(11) unsigned default NULL,
  T_LASTEDIT_MAKE varchar(40) default NULL,
  T_ENUM int(10) default '0',
  T_SURVEYID int(11) default '0',
  T_ARCHIVED int(11) NOT NULL, 
  T_SOCIAL int(11) NOT NULL default '0',
  T_IMG varchar(255) default NULL,
  T_DESC varchar(255) default NULL,
  T_COLOR varchar(255) default NULL,
  T_AUTHOR_MOD int(11) NOT NULL default '0',
  T_ICON int(11) NOT NULL default '0',
  PRIMARY KEY (TOPIC_ID),
  KEY CAT_ID (CAT_ID),
  KEY FORUM_ID (FORUM_ID),
  KEY T_LAST_POST_DATE (T_LAST_POST_DATE),
  KEY T_LAST_POST_AUTHOR (T_LAST_POST_AUTHOR))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."GLOBAL_MEDALS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."GLOBAL_MEDALS (
  MEDAL_ID int(10) unsigned NOT NULL auto_increment,
  FORUM_ID int(11) default NULL,
  STATUS int(11) default '0',
  SUBJECT varchar(255) default NULL,
  DAYS int(11) default '0',
  POINTS int(11) default '0',
  URL varchar(255) default NULL,
  CLOSE int(11) default '0',
  ADDED int(11) default NULL,
  DATE int(10) unsigned default NULL,
  SPECIAL int(10) NOT NULL default '0',
  SPECIAL_TYPE int(10) NOT NULL default '0',
  GIVE int(10) NOT NULL default '1',
  PRIMARY KEY  (MEDAL_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."GLOBAL_TITLES") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."GLOBAL_TITLES (
  TITLE_ID int(10) unsigned NOT NULL auto_increment,
  FORUM_ID int(11) default NULL,
  STATUS int(11) default '1',
  CLOSE int(11) default '0',
  FORUM int(11) default '0',
  ADDED int(11) default NULL,
  SUBJECT varchar(255) default NULL,
  DATE int(10) unsigned default NULL,
  PRIMARY KEY  (TITLE_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."MEDAL_FILES") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."MEDAL_FILES (
  MF_ID int(10) unsigned NOT NULL auto_increment,
  FORUM_ID int(11) default NULL,
  ADDED int(11) default NULL,
  SUBJECT varchar(255) default NULL,
  DATE int(10) unsigned default NULL,
  NAME varchar(255) default NULL,
  PRIMARY KEY  (MF_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."MEDALS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."MEDALS (
  MEDAL_ID int(10) unsigned NOT NULL auto_increment,
  GM_ID int(11) default NULL,
  FORUM_ID int(11) default NULL,
  MEMBER_ID int(11) default NULL,
  STATUS int(11) default '1',
  ADDED int(11) default NULL,
  DAYS int(11) default '0',
  POINTS int(11) default '0',
  URL varchar(255) default NULL,
  DATE int(10) unsigned default NULL,
  SPECIAL int(10) NOT NULL default '0',
  SPECIAL_TYPE int(10) NOT NULL default '0',
  PRIMARY KEY  (MEDAL_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."SURVEY_OPTIONS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."SURVEY_OPTIONS (
  SO_ID int(10) unsigned NOT NULL auto_increment,
  SURVEY_ID int(11) default NULL,
  OPTION_ID int(11) default '0',
  VALUE varchar(255) default NULL,
  OTHER varchar(255) default NULL,
  PRIMARY KEY  (SO_ID),
  KEY SURVEY_ID (SURVEY_ID),
  KEY OPTION_ID (OPTION_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."SURVEYS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."SURVEYS (
  SURVEY_ID int(10) unsigned NOT NULL auto_increment,
  FORUM_ID int(11) default NULL,
  SUBJECT varchar(255) default NULL,
  QUESTION varchar(255) default NULL,
  STATUS int(11) default '1',
  SECRET int(11) default '0',
  DAYS int(11) default '0',
  MIN_DAYS int(11) default '0',
  MIN_POSTS int(11) default '0',
  ADDED int(11) default NULL,
  START int(10) unsigned default NULL,
  END int(10) unsigned default NULL,
  PRIMARY KEY  (SURVEY_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."TITLES") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."TITLES (
  TITLE_ID int(10) unsigned NOT NULL auto_increment,
  GT_ID int(11) default NULL,
  MEMBER_ID int(11) default NULL,
  STATUS int(11) default '1',
  DATE int(10) unsigned default NULL,
  PRIMARY KEY  (TITLE_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."TOPIC_MEMBERS") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."TOPIC_MEMBERS (
  TM_ID int(10) unsigned NOT NULL auto_increment,
  MEMBER_ID int(11) default NULL,
  TOPIC_ID int(11) default NULL,
  ADDED int(11) default NULL,
  DATE int(10) unsigned default NULL,
  PRIMARY KEY  (TM_ID),
  KEY MEMBER_ID (MEMBER_ID),
  KEY TOPIC_ID (TOPIC_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."USED_TITLES") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."USED_TITLES (
  ID int(10) unsigned NOT NULL auto_increment,
  TITLE_ID int(11) NOT NULL,
  MEMBER_ID int(11) default NULL,
  STATUS int(11) default NULL,
  ADDED int(11) default NULL,
  DATE int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY TITLE_ID (TITLE_ID),
  KEY MEMBER_ID (MEMBER_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."VOTES") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."VOTES (
  VOTE_ID int(10) unsigned NOT NULL auto_increment,
  SURVEY_ID int(11) default NULL,
  OPTION_ID int(11) default NULL,
  FORUM_ID int(11) default NULL,
  TOPIC_ID int(11) default NULL,
  MEMBER_ID int(11) default NULL,
  DATE int(10) unsigned default NULL,
  PRIMARY KEY  (VOTE_ID),
  KEY SURVEY_ID (SURVEY_ID),
  KEY OPTION_ID (OPTION_ID),
  KEY TOPIC_ID (TOPIC_ID),
  KEY MEMBER_ID (MEMBER_ID),
  KEY FORUM_ID (FORUM_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."NOTIFY") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".prefix."NOTIFY (
  NOTIFY_ID int(10) unsigned NOT NULL auto_increment,
  STATUS int(11) default '1',
  FORUM_ID int(11) default '0',
  TOPIC_ID int(11) default '0',
  REPLY_ID int(11) default '0',
  AUTHOR_ID int(11) default '0',
  AUTHOR_NAME varchar(40) default NULL,
  POSTAUTHOR_ID int(11) default '0',
  POSTAUTHOR_NAME varchar(40) default NULL,
  DATE int(10) unsigned default NULL,
  TYPE varchar(100) default NULL,
  SUBJECT varchar(100) default NULL,
  R_ID int(11) default '0',
  R_MSG varchar(100) default NULL,
  R_DATE int(10) unsigned default NULL,
  NOTE_BY int(11) default '0',
  NOTES varchar(100) default NULL,
  NOTE_DATE int(10) unsigned default NULL,
  TRANSFER_BY int(11) default '0',
  TRANSFER_DATE int(10) unsigned default NULL,
  N_DONE int(11) default '0',
  PRIMARY KEY  (NOTIFY_ID),
  KEY FORUM_ID (FORUM_ID),
  KEY TOPIC_ID (TOPIC_ID),
  KEY REPLY_ID (REPLY_ID),
  KEY AUTHOR_ID (AUTHOR_ID),
  KEY POSTAUTHOR_ID (POSTAUTHOR_ID))
") or die(DBi::$con->error);

//----------------------------- CREATE MODERATION TABLE ----------------------------

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."MODERATION") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."MODERATION (
  MODERATION_ID int(11) NOT NULL auto_increment,
  M_STATUS int(11) default '0',
  M_MEMBERID int(11) default '0',
  M_FORUMID int(11) default '0',
  M_TOPICID int(11) default '0',
  M_REPLYID int(11) default '0',
  M_PM int(11) default '0',
  M_IHDAA int(11) default '0',
  M_ADDED int(11) default '0',
  M_EXECUTE int(11) default '0',
  M_END int(11) default '0',
  M_MODERATOR_NOTES varchar(100) default NULL,
  M_MONITOR_NOTES varchar(100) default NULL,
  M_TYPE int(11) default '0',
  M_RAISON varchar(100) default NULL,
  M_DATE int(10) unsigned default NULL,
  M_DATEAPP int(10) unsigned default NULL,
  M_DATEFIN int(10) unsigned default NULL,
  M_TWOREQUESTS int(11) default '0',
  M_REFUSED int(11) default '0',
  PRIMARY KEY  (MODERATION_ID))
") or die(DBi::$con->error);

//------------------------ CREATE EDITS_INFO TABLE -----------------------

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."EDITS_INFO") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."EDITS_INFO (
  EDIT_ID int(11) NOT NULL auto_increment,
  MEMBER_ID int(11) default '0',
  TOPIC_ID int(11) default '0',
  REPLY_ID int(11) default '0',
  OLD_SUBJECT varchar(100) default NULL,
  OLD_MESSAGE text,
  NEW_SUBJECT varchar(100) default NULL,
  NEW_MESSAGE text,
  DATE int(10) unsigned default NULL,
  PRIMARY KEY  (EDIT_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."TOPICS_LIKES") or die(DBi::$con->error);
DBi::$con->query("CREATE TABLE ".$Prefix."TOPICS_LIKES (
  `ID` int(11) NOT NULL auto_increment,
  `TOPIC_ID` int(11) NOT NULL,
  `MEMBER_ID` int(11) NOT NULL,
  `DATE` int(11) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY TOPIC_ID (TOPIC_ID),
  KEY MEMBER_ID (MEMBER_ID)
) ") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".prefix."STYLE") or die(DBi::$con->error);
DBi::$con->query("
  CREATE TABLE ".prefix."STYLE (
  S_ID int(10) unsigned NOT NULL auto_increment,
  S_FILE_NAME varchar( 100 ) NULL default NULL,
  S_NAME varchar( 100 ) NULL default NULL,
  PRIMARY KEY (S_ID))
") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."REPLIES_LIKES") or die(DBi::$con->error);
DBi::$con->query("CREATE TABLE ".$Prefix."REPLIES_LIKES (
  `ID` int(11) NOT NULL auto_increment,
  `REPLY_ID` int(11) NOT NULL,
  `MEMBER_ID` int(11) NOT NULL,
  `DATE` int(11) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY REPLY_ID (REPLY_ID),
  KEY MEMBER_ID (MEMBER_ID)
) ") or die(DBi::$con->error);

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."HAKING") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."HAKING (
  ID int(11) NOT NULL auto_increment,
  IP varchar(255) NOT NULL,
  MEMBER int(11) NOT NULL,
  TYPE int(11) NOT NULL,
  PRIMARY KEY  (ID))
") or die(DBi::$con->error);

//------------------------ CREATE LIST TABLE -----------------------

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."LIST") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."LIST (
  ID int(11) NOT NULL auto_increment,
  `NAME` varchar(100) NOT NULL,
  M_ID int(11) NOT NULL,
  EDITFOLDER int(11) NOT NULL,
  PRIMARY KEY  (ID))
") or die(DBi::$con->error);

//------------------------ CREATE LIST MEMBER TABLE -----------------------

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."LIST_M") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."LIST_M (
  ID int(11) NOT NULL auto_increment,
  M_ID int(11) NOT NULL,
  CAT_ID int(11) NOT NULL,
  `USER` int(11) NOT NULL,
  PRIMARY KEY  (ID))
") or die(DBi::$con->error);

//------------------------ CREATE IP_INFO TABLE -----------------------

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."IP") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."IP (
  ID int(11) NOT NULL auto_increment,
  IP mediumtext NOT NULL,
  `DATE` int(11) NOT NULL,
  COUNTRY mediumtext NOT NULL,
  `TYPE` int(11) NOT NULL,
  M_ID int(11) NOT NULL,
  COUNTRY_ARABIC varchar(255) default NULL,
  DO_ID INT (11) NOT NULL,
  PRIMARY KEY  (ID),
  KEY DO_ID (DO_ID),
  KEY M_ID (M_ID))
") or die(DBi::$con->error);

//------------------------ CREATE HIDE_INFO TABLE ------------------------

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."HIDE_INFO") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."HIDE_INFO (
  HIDE_ID int(11) NOT NULL auto_increment,
  STATUS int(11) default '0',
  MEMBER_ID int(11) default '0',
  TOPIC_ID int(11) default '0',
  REPLY_ID int(11) default '0',
  DATE int(10) unsigned default NULL,
  PRIMARY KEY  (HIDE_ID))
") or die(DBi::$con->error);



//------------------------ CREATE ".prefix."BAN_IP TABLE ------------------------

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."IP_BAN") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."IP_BAN (
  ID int(11) NOT NULL auto_increment,
  IP varchar(100) NOT NULL,
  DATE int(11) NOT NULL,
  WHY varchar(250) NOT NULL,
  DATE_UNBAN int(11) NOT NULL,
  HWO int(11) NOT NULL,
  PRIMARY KEY  (ID))
") or die(DBi::$con->error);

//------------------------ CREATE ".prefix."SEARCH TABLE ------------------------

DBi::$con->query("DROP TABLE IF EXISTS ".$Prefix."SEARCH") or die(DBi::$con->error);
DBi::$con->query("
CREATE TABLE ".$Prefix."SEARCH (
  ID int(11) NOT NULL auto_increment,
  QUERY varchar(250) NOT NULL,
  DATE int(11) NOT NULL,
  TYPE int(11) NOT NULL,
  MEMBER_ID int(11) NOT NULL,
  IN_USER varchar(250) NOT NULL,
  FORUM int(11) NOT NULL,
  M_LEVEL int(11) NOT NULL,
  MONTH int(11) NOT NULL,
  YEAR int(11) NOT NULL,
  PRIMARY KEY  (ID))
") or die(DBi::$con->error);

                    echo'
	                <center>
	                <table width="60%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['install']['setup_tables_was_god'].'</font><br><br>
	                       <a href="install.php?step=2">'.$lang['install']['next'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';

}

if ($step == "2") {
echo'
<center>
<form name="userinfo" method="POST" action="install.php?step=3">
<input type="hidden" name="user_age">
<table dir="rtl" class="grid" border="0" width="60%" cellspacing="1" cellpadding="4" bgcolor="#C0C0C0">
	<tr>
		<td class="cat" colspan="2" align="center">'.$lang['install']['site_info'].'</td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['site_name'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="text" name="forum_title" size="40" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['site_name2'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="text" name="forum_title2" size="40" style="font-weight: 700"></td>
	</tr>	
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['site_address'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="text" name="site_address" dir="ltr" size="40" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['site_address2'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="text" name="site_address2" dir="ltr" size="40" style="font-weight: 700"></td>
	</tr>	
	<tr>
		<td class="cat" colspan="2" align="center">'.$lang['install']['admin_info'].'</td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['user_name'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="text" name="user_name" size="40" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['password'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="Password" name="user_password1" size="40" maxLength="30" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['confirm_password'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="Password" name="user_password2" size="40" maxLength="30" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['email'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="text" name="user_email" dir="ltr" size="40" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center">'.$lang['install']['firewall'].'</td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['firewall_home_user'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="text" name="firewall_home_user" size="40" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['firewall_home_pass'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="Password" name="firewall_home_pass" size="40" maxLength="30" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['firewall_admin_user'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="text" name="firewall_admin_user" size="40" maxLength="30" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td class="userdetails_data" bgcolor="#FFFFCC">&nbsp;'.$lang['install']['firewall_admin_pass'].'</td>
		<td class="userdetails_data" bgcolor="#FFFFCC"><input type="Password" name="firewall_admin_pass" size="40" style="font-weight: 700"></td>
	</tr>	
	<tr>
		<td class="userdetails_data" colspan="2" align="middle" bgcolor="darkgreen"><input onclick="submitForm()" type="button" value="'.$lang['install']['next'].'"></td>
	</tr>
</table>
</form>
</center>
';
}

if ($step == "3") {

$ForumTitle = $_POST["forum_title"];
$ForumTitle2 = $_POST["forum_title2"];
$SiteAddress = $_POST["site_address"];
$SiteAddress2 = $_POST["site_address2"];
$UserName = $_POST["user_name"];
$Password = $_POST["user_password1"];
$Email = $_POST["user_email"];
$IP = $_SERVER["REMOTE_ADDR"];
$DIR = $_SERVER["SCRIPT_NAME"];
$date = time();
$Firewall_Home_User = $_POST["firewall_home_user"];
$Firewall_Home_Pass = $_POST["firewall_home_pass"];
$Firewall_Admin_User = $_POST["firewall_admin_user"];
$Firewall_Admin_Pass = $_POST["firewall_admin_pass"];
$now_year = date("Y");
$now_day = date("d");
$now_month = date("M");

insert_mysql("FORUM_TITLE", $ForumTitle);
insert_mysql("FORUM_TITLE2", $ForumTitle2);
insert_mysql("SITE_ADDRESS", $SiteAddress);
insert_mysql("SITE_ADDRESS2", $SiteAddress2);
insert_mysql("COPY_RIGHT", "DuHok Forum Team 2016");
insert_mysql("IMAGE_FOLDER", "images/");
insert_mysql("ADMIN_FOLDER", "admin");
insert_mysql("PAGE_NUMBER", "40");
insert_mysql("ADMIN_EMAIL", $Email);
insert_mysql("AUTHOR_SCRIPT", "DuHok Forum Team 2016");
insert_mysql("FORUM_VERSION", "2.1");
insert_mysql("FORUM_META", "This is a discussion forum powered by DuHok Forum 2.1");
insert_mysql("FORUM_KEY", "Duhok,Forum,PHP,Mysql,Startimes,Devo,Temy,DevMedoo,2016,2.1");
insert_mysql("FORUM_BANWORDS", "script,SCRIPT,meta,META");
insert_mysql("FORUM_SEO", "1");
insert_mysql("NEW_MEMBER_MIN_POSTS_PM", "50");
insert_mysql("TOTAL_PM_MSG", "50");
insert_mysql("TOTAL_PM_MSG_M", "500");
insert_mysql("TOTAL_POST_CLOSE_TOPIC", "500");
insert_mysql("MOD_ADD_TITLES", "0");
insert_mysql("TITLE_0", $lang['install']['title_member_one']);
insert_mysql("TITLE_1", $lang['install']['title_member_two']);
insert_mysql("TITLE_2", $lang['install']['title_member_three']);
insert_mysql("TITLE_3", $lang['install']['title_member_four']);
insert_mysql("TITLE_4", $lang['install']['title_member_five']);
insert_mysql("TITLE_5", $lang['install']['title_member_six']);
insert_mysql("TITLE_6", $lang['install']['title_member_six']);
insert_mysql("TITLE_7", $lang['install']['title_member_six']);
insert_mysql("TITLE_8", $lang['install']['title_member_six']);
insert_mysql("TITLE_9", $lang['install']['title_member_six']);
insert_mysql("TITLE_10", $lang['install']['title_member_six']);
insert_mysql("TITLE_11", $lang['install']['title_moderator']);
insert_mysql("TITLE_12", $lang['install']['title_monitor']);
insert_mysql("TITLE_13", $lang['install']['title_admin']);
insert_mysql("TITLE_14", $lang['install']['title_deputy_monitor']);
insert_mysql("TITLE_0_FEMALE", $lang['install']['title_member_one_female']);
insert_mysql("TITLE_1_FEMALE", $lang['install']['title_member_two_female']);
insert_mysql("TITLE_2_FEMALE", $lang['install']['title_member_three_female']);
insert_mysql("TITLE_3_FEMALE", $lang['install']['title_member_four_female']);
insert_mysql("TITLE_4_FEMALE", $lang['install']['title_member_five_female']);
insert_mysql("TITLE_5_FEMALE", $lang['install']['title_member_six_female']);
insert_mysql("TITLE_6_FEMALE", $lang['install']['title_member_six_female']);
insert_mysql("TITLE_7_FEMALE", $lang['install']['title_member_six_female']);
insert_mysql("TITLE_8_FEMALE", $lang['install']['title_member_six_female']);
insert_mysql("TITLE_9_FEMALE", $lang['install']['title_member_six_female']);
insert_mysql("TITLE_10_FEMALE", $lang['install']['title_member_six_female']);
insert_mysql("TITLE_11_FEMALE", $lang['install']['title_moderator_female']);
insert_mysql("TITLE_12_FEMALE", $lang['install']['title_monitor_female']);
insert_mysql("TITLE_13_FEMALE", $lang['install']['title_admin_female']);
insert_mysql("TITLE_14_FEMALE", $lang['install']['title_deputy_monitor_female']);
insert_mysql("MLV_STARS_COLOR_0", "");
insert_mysql("MLV_STARS_COLOR_1", "green");
insert_mysql("MLV_STARS_COLOR_2", "red");
insert_mysql("MLV_STARS_COLOR_3", "gold");
insert_mysql("MLV_STARS_COLOR_4", "blue");
insert_mysql("MLV_STARS_COLOR_5", "orange");
insert_mysql("STARS_NUMBER_0", "0");
insert_mysql("STARS_NUMBER_1", "30");
insert_mysql("STARS_NUMBER_2", "100");
insert_mysql("STARS_NUMBER_3", "500");
insert_mysql("STARS_NUMBER_4", "1000");
insert_mysql("STARS_NUMBER_5", "2000");
insert_mysql("STARS_NUMBER_6", "3000");
insert_mysql("STARS_NUMBER_7", "4000");
insert_mysql("STARS_NUMBER_8", "5000");
insert_mysql("STARS_NUMBER_9", "6000");
insert_mysql("STARS_NUMBER_10", "7000");

insert_mysql("TOPIC_MAX_SIZE", "512000");
insert_mysql("REPLY_MAX_SIZE", "512000");
insert_mysql("PM_MAX_SIZE", "102400");
insert_mysql("SIG_MAX_SIZE", "51200");
insert_mysql("TOPIC_MAX_SIZE_M", "5120000");
insert_mysql("REPLY_MAX_SIZE_M", "5120000");
insert_mysql("PM_MAX_SIZE_M", "1024000");
insert_mysql("SIG_MAX_SIZE_M", "512000");
insert_mysql("DEFAULT_LANGUAGE", "arabic");
insert_mysql("FORUM_URL", "");

insert_mysql("COLOR_0", "#999999");
insert_mysql("COLOR_1", "");
insert_mysql("COLOR_2", "#cc0033");
insert_mysql("COLOR_3", "#cc8811");
insert_mysql("COLOR_4", "blue");
insert_mysql("COLOR_5", "#FA7245");

insert_mysql("CAN_SHOW_PM",0);
insert_mysql("CAN_CLOSE_M",0);
insert_mysql("CAN_OPEN_M",0);
insert_mysql("CAN_HOLDED_M",0);

insert_mysql("CAN_SHOW_FORUM",0);
insert_mysql("CAN_SHOW_TOPIC",0);
insert_mysql("CAN_SHOW_PROFILE",0);

insert_mysql("FTP_ACTIVE",0);
insert_mysql("FTP_SERVER","");
insert_mysql("FTP_USER","");
insert_mysql("FTP_PASS","");


insert_mysql("SHOW_ADMIN_INFO", 0);
insert_mysql("SHOW_ADMIN_TOPICS", 0);
insert_mysql("MOD_ADD_MEDALS", 0);
insert_mysql("CHANGE_NAME_MAX", 4);
insert_mysql("CHANGENAME_DAYSLIMIT", 30);
insert_mysql("SHOW_MODERATORS", 1);
insert_mysql("FILES_MAX_SIZE", 1024000);
insert_mysql("FILES_MAX_ALLOWED", 102400);
insert_mysql("HELP_FORUM", 0);
insert_mysql("BLOG_FORUM", 0);
insert_mysql("SITE_TIMEZONE", "3");
insert_mysql("FORUM_STATUS", "0");
insert_mysql("MAX_SEARCH", 100);
insert_mysql("MAX_SEARCH_M", 500);

insert_mysql("SHOW_ALEXA_TRAFFIC", 1);
insert_mysql("REGISTER_WAITTING", 3);
insert_mysql("SHOW_MEDALS_IN_POSTS", 1);
insert_mysql("NEW_MEMBER_MIN_POSTS", 0);

insert_mysql("MAX_LIST_CAT_MEMBERS", 5);
insert_mysql("MAX_LIST_M_MEMBERS", 10);
insert_mysql("MAX_LIST_CAT_MODERATORS", 10);
insert_mysql("MAX_LIST_M_MODERATORS", 60);

insert_mysql("EDITOR_FULL_HTML", "false");
insert_mysql("EDITOR_WIDTH", "100%");
insert_mysql("EDITOR_HEIGHT", "100%");
insert_mysql("EDITOR_ICON_SAVE", "false");
insert_mysql("EDITOR_ICON_PRINT", "false");
insert_mysql("EDITOR_ICON_ZOOM", "false");
insert_mysql("EDITOR_ICON_STYLE", "false");
insert_mysql("EDITOR_ICON_PARAGRAPH", "false");
insert_mysql("EDITOR_ICON_FONT_NAME", "true");
insert_mysql("EDITOR_ICON_SIZE", "true");
insert_mysql("EDITOR_ICON_TEXT", "false");
insert_mysql("EDITOR_ICON_SELECT_ALL", "false");
insert_mysql("EDITOR_ICON_CUT", "true");
insert_mysql("EDITOR_ICON_COPY", "true");
insert_mysql("EDITOR_ICON_PASTE", "true");
insert_mysql("EDITOR_ICON_UNDO", "true");
insert_mysql("EDITOR_ICON_REDO", "true");
insert_mysql("EDITOR_ICON_BOLD", "true");
insert_mysql("EDITOR_ICON_ITALIC", "true");
insert_mysql("EDITOR_ICON_UNDER_LINE", "true");
insert_mysql("EDITOR_ICON_STRIKE", "true");
insert_mysql("EDITOR_ICON_SUPER_SCRIPT", "false");
insert_mysql("EDITOR_ICON_SUB_SCRIPT", "false");
insert_mysql("EDITOR_ICON_SYMBOL", "true");
insert_mysql("EDITOR_ICON_LEFT", "true");
insert_mysql("EDITOR_ICON_CENTER", "true");
insert_mysql("EDITOR_ICON_RIGHT", "true");
insert_mysql("EDITOR_ICON_FULL", "true");
insert_mysql("EDITOR_ICON_NUBERING", "true");
insert_mysql("EDITOR_ICON_BULLETS", "true");
insert_mysql("EDITOR_ICON_INDENT", "true");
insert_mysql("EDITOR_ICON_OUTDENT", "true");
insert_mysql("EDITOR_ICON_IMAGE", "true");
insert_mysql("EDITOR_ICON_COLOR", "true");
insert_mysql("EDITOR_ICON_BGCOLOR", "true");
insert_mysql("EDITOR_ICON_EX_LINK", "true");
insert_mysql("EDITOR_ICON_IN_LINK", "false");
insert_mysql("EDITOR_ICON_ASSET", "false");
insert_mysql("EDITOR_ICON_TABLE", "true");
insert_mysql("EDITOR_ICON_SHOW_BORDER", "false");
insert_mysql("EDITOR_ICON_ABSOLUTE", "false");
insert_mysql("EDITOR_ICON_CLEAN", "false");
insert_mysql("EDITOR_ICON_LINE", "true");
insert_mysql("EDITOR_ICON_PROPERTIES", "false");
insert_mysql("EDITOR_ICON_WORD", "true");
insert_mysql("logos","images/logos/logo.png");
insert_mysql("BEST", 1);
insert_mysql("BEST_MEM", 1);
insert_mysql("BEST_TOPIC", 1);
insert_mysql("BEST_MOD", 1);
insert_mysql("BEST_FRM", 1);
insert_mysql("BEST_T", "لوحة الشرف");
insert_mysql("BEST_MEM_T", "العضو المميز لهذا الشهر");
insert_mysql("BEST_TOPIC_T", "الموضوع المميز لهذا الشهر");
insert_mysql("BEST_MOD_T", "المشرف المميز لهذا الشهر");
insert_mysql("BEST_FRM_T", "المنتدى المميز لهذا الشهر");
insert_mysql("close", "الموقع تحت الصيانة حاليا .. الرجاء المحاولة بعد عدة دقائق");
insert_mysql("note", "بسم الله الرحمن الرحيم");
insert_mysql("NEW_MEMBER_MIN_SEARCH", "35");
insert_mysql("NEW_MEMBER_SHOW_TOPIC", "35");
insert_mysql("NEW_MEMBER_CHANGE_NAME", "35");
insert_mysql("ad", "0");
insert_mysql("ad1", "df.duhoktimes.com");
insert_mysql("ad2", "دهوك فوروم");
insert_mysql("ad3", "images/logos/logo.gif");
insert_mysql("ad4", "157");
insert_mysql("ad5", "75");
insert_mysql("ad6", "center");
insert_mysql("pb", "0");
insert_mysql("pb1", "www.kooora.com");
insert_mysql("pb2", "كووورة");
insert_mysql("pb3", "images/logos/logo.gif");
insert_mysql("pb4", "157");
insert_mysql("pb5", "75");
insert_mysql("pb6", "center");
insert_mysql("pub", "0");
insert_mysql("pub1", "www.yahoo.com");
insert_mysql("pub2", "جووجل");
insert_mysql("pub3", "images/logos/logo.gif");
insert_mysql("pub4", "157");
insert_mysql("pub5", "75");
insert_mysql("pub6", "center");
insert_mysql("pubs", "0");
insert_mysql("pubs1", "www.yahoo.com");
insert_mysql("pubs2", "ياهوو");
insert_mysql("pubs3", "images/logos/logo.gif");
insert_mysql("pubs4", "157");
insert_mysql("pubs5", "75");
insert_mysql("pubs6", "center");
insert_mysql("FORUM_MSG", "أنت غير مسجل في");
insert_mysql("FORUM_MSG1", "للتسجيل الرجاء اضغط");
insert_mysql("FORUM_MSG2", "هنـا");
insert_mysql("MSG", 1);
insert_mysql("WHAT_ACTIVE", 0);
insert_mysql("WHAT_TITLE", "الإهدائات");
insert_mysql("WHAT_SIZE", 10);
insert_mysql("WHAT_ADMIN_SHOW", 1);
insert_mysql("WHAT_LIMIT", 10);
insert_mysql("WHAT_FASEL", "|+|");
insert_mysql("WHAT_COLOR", "blue");
insert_mysql("WHAT_ALL", 1);
insert_mysql("WHAT_DIRECTION","right");
insert_mysql("TWITTER", "http://www.twitter.com");
insert_mysql("CONSUMER_KEY", "");
insert_mysql("CONSUMER_SECRET", "");
insert_mysql("OAUTH_TOKEN", "");
insert_mysql("OAUTH_SECRET", "");
insert_mysql("LOGIN_KEY", "");
insert_mysql("APP_KEY", "");
insert_mysql("FORUM_HASHTAG", "");
insert_mysql("ANOTHER_FORUM", "1");
insert_mysql("DOLLAR_CUR", "EGP");
insert_mysql("ADMIN_USER_NAME", "");
insert_mysql("ACTIVE_MARKET", "1");
insert_mysql("ACTIVE_PORTAL", "1");
insert_mysql("FIREWALL_HOME_USER", $Firewall_Home_User);
insert_mysql("FIREWALL_HOME_PASS", $Firewall_Home_Pass);
insert_mysql("FIREWALL_ADMIN_USER", $Firewall_Admin_User);
insert_mysql("FIREWALL_ADMIN_PASS", $Firewall_Admin_Pass);
insert_mysql("FIREWALL_HOME_ACTIVE", 1);
insert_mysql("FIREWALL_ADMIN_ACTIVE", 1);
insert_mysql("MOD_POINTS", 10);
insert_mysql("ONLINE_MOD_POINTS", 10);
insert_mysql("adsense_1", 0);
insert_mysql("adsense_2", 0);
insert_mysql("adsense_3", 0);
insert_mysql("code_1", "");
insert_mysql("code_2", "");
insert_mysql("code_3", "");
insert_mysql("FORUM_ONLINE", "0.01");
insert_mysql("CREATE_FORUM_DATE", $now_year);
insert_mysql("CREATE_FORUM_DAY", $now_day);
insert_mysql("CREATE_FORUM_MONTH", $now_month);
insert_mysql("SHOW_HKMA_SITEMAP", "1");
insert_mysql("TIME_ACTIVE","1");
insert_mysql("TIME_STATUS","1");
insert_mysql("TIME_SECOND","10800");
insert_mysql("CAN_CHANGE_M","1");
insert_mysql("DUHOK_FORUM_VERSION", "DuHok Forum 2.1 Beta 7 Update 19");
$Password = MD5($Password);
 $query2 = "INSERT INTO " . $Prefix . "MEMBERS (MEMBER_ID, M_NAME, M_PASSWORD, M_LEVEL, M_EMAIL, M_POSTS, M_DATE, M_LAST_HERE_DATE, M_LAST_POST_DATE, M_IP, M_LAST_IP, M_ADMIN, M_HOLD_ACTIVE, M_HOLD_POSTS, M_OPT, M_ICON_VERF) VALUES (NULL, '$UserName', '$Password', '4', '$Email', '1', '$date', '$date', '$date', '$IP', '$IP',1,1,100000,100,1)";
	DBi::$con->query($query2) or die (DBi::$con->error);
 $query3 = "INSERT INTO " . $Prefix . "CATEGORY (CAT_ID, CAT_NAME, SITE_ID) VALUES (NULL, '".$lang['install']['test_cat']."', 0)";
	DBi::$con->query($query3) or die (DBi::$con->error);
 
 $query3 = "INSERT INTO " . $Prefix . "FORUM (FORUM_ID, CAT_ID, F_SUBJECT, F_DESCRIPTION, F_LOGO, F_TOPICS, F_REPLIES, F_LAST_POST_DATE, F_LAST_POST_AUTHOR, F_DOLLAR_TOPIC, F_DOLLAR_REPLY) VALUES (NULL, ";
 $query3 .= " '1', ";
 $query3 .= " '".$lang['install']['test_forum']."', ";
 $query3 .= " '".$lang['install']['test_forum_subject']." DUHOK FORUM', ";
 $query3 .= " 'images/forum-logo/logo-1.gif', "; 
 $query3 .= " '1', ";
 $query3 .= " '1', ";
 $query3 .= " '$date', ";
 $query3 .= " '1', ";
 $query3 .= " '2', ";
 $query3 .= " '1') ";
 
 DBi::$con->query($query3) or die (DBi::$con->error);
 
         $add_mod = DBi::$con->query("SELECT * FROM " . $Prefix . "FORUM ORDER BY FORUM_ID DESC") or die (DBi::$con->error);
        if(mysqli_num_rows($add_mod) > 0){
        $rs = mysqli_fetch_array($add_mod);
        }
		$the_forum_id = $rs['FORUM_ID'];
		$author_mod = $lang['install']['moderator_team'];
		$color1 = "#ffe0e0";
		$color2 = "red";
	$req = "INSERT INTO ".prefix."AUTHOR_MOD (REQ_ID, REQ_STATUS, REQ_USERID, REQ_FRMID, REQ_AUTHOR, REQ_COLOR1, REQ_COLOR2) VALUES (NULL, '1', ";
	$req .= "'$DBMemberID', ";	
	$req .= "'$the_forum_id', ";
	$req .= "'$author_mod',";		
	$req .= "'$color1',";		
	$req .= "'$color2')";		
	DBi::$con->query($req) or die (DBi::$con->error);

 
 	$query4 = "INSERT INTO " . $Prefix . "ADS (AD_ID, AD_SUBJECT, AD_MESSAGE, AD_DATE, AD_STATUS, AD_SHOW_FORUM, AD_SHOW_SOCIAL_1, AD_SHOW_SOCIAL_2, AD_AUTHOR) VALUES (NULL, ";
	$query4 .= " '".$lang['install']['test_topic_subject']."', ";
	$query4 .= " '".$lang['install']['test_topic_message1'].$lang['install']['test_topic_message2'].$lang['install']['test_topic_message3'].$lang['install']['test_topic_message4'].$lang['install']['test_topic_message5'].$lang['install']['test_topic_message6'].$lang['install']['test_topic_message7'].$lang['install']['test_topic_message8'].$lang['install']['test_topic_message9']."', ";
	$query4 .= " '$date', ";
	$query4 .= " '1', ";
	$query4 .= " '1', ";
	$query4 .= " '1', ";
	$query4 .= " '1', ";
	$query4 .= " '1') ";
	@DBi::$con->query($query4) or die (DBi::$con->error);	

 DBi::$con->query("INSERT INTO ".$Prefix."LANGUAGE (L_ID, L_FILE_NAME, L_NAME) VALUES (NULL, 'arabic', '".$lang['global']['lang_name']."') ") or die (DBi::$con->error);
 $_SESSION['DF_choose_language'] = "arabic";

	


                    echo'
	                <center>
	                <table width="60%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['install']['setup_forum_was_god_but_delete_install_file'].'</font><br><br>
	                       <a href="index.php">'.$lang['install']['click_here_to_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
					@unlink("install.php");
}

@mysqli_close();

?>

</body>

</html>