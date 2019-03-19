<?
/*if (eregi("header.php",$_SERVER['PHP_SELF'])) {
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
include("head.php");
require_once("session.php");
require_once("online.php");
require_once("Title_Page.php");
/////////////// This Comment To Delete Not Active Members By Email After 7 Days ///////////
delete_not_activ_member();
/////// This Comment To Delete Not Email Active Members By New Email After 1 Days /////////
delete_not_activ_email();
///////////// This Comment To Automatic Delete Requests Mon After Number Of Days //////////
delete_mons();
// This Comment To Add All Forums Monitor To Member Who Have More Than 3 Forum Moderator //
make_mod_forum_mon_all_forum($DBMemberID);
////////////////////////////////////////// End ////////////////////////////////////////////
	echo"<style> #inpURL, #inpTitle {
	        border:1px inset #ddd;
	        font-size:12px;
	        -moz-border-radius:3px; 
	        -webkit-border-radius:3px; 
	        padding-left:7px;
            }
            
        .item {width:200px;min-height:50px;display:-moz-inline-stack;display:inline-block;vertical-align:top;zoom:1; *display: inline; _height: 50px;
            background:#fff;border:#fff 7px solid;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.24);
            -moz-box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.24);
            -webkit-box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.24);
            margin-left:-5px;margin-right:25px;margin-top:10px;margin-bottom:10px;
            border:#fff 1px solid;padding:5px;
            }
        .item2 {width:250px;min-height:20px;display:-moz-inline-stack;display:inline-block;vertical-align:top;zoom:1; *display: inline; _height: 20px;
            cursor:pointer;text-align:center;
            padding-top:10px;
            }
			
        .awesome, .awesome:visited {
	        background: #222 url(/images/alert-overlay.png) repeat-x; 
	        display: inline-block; 
	        padding: 5px 10px 6px; 
	        color: #fff; 
	        text-decoration: none;
	        -moz-border-radius: 5px; 
	        -webkit-border-radius: 5px;
	        -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	        -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	        text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
	        border-bottom: 1px solid rgba(0,0,0,0.25);
	        position: relative;
	        cursor: pointer;
            }
	    .awesome:hover							{ background-color: #111; color: #fff; }
	    .awesome:active							{ top: 1px; }
	    .small.awesome, .small.awesome:visited 			{ font-size: 11px; padding: ; }
	    .awesome, .awesome:visited,
	    .medium.awesome, .medium.awesome:visited 		{ font-size: 13px; font-weight: bold; line-height: 1; text-shadow: 0 -1px 1px rgba(0,0,0,0.25); }
	    .large.awesome, .large.awesome:visited 			{ font-size: 14px; padding: 8px 14px 9px; }
	
	    .green.awesome, .green.awesome:visited		{ background-color: #91bd09; }
	    .green.awesome:hover						{ background-color: #749a02; }
	    .blue.awesome, .blue.awesome:visited		{ background-color: #2daebf; }
	    .blue.awesome:hover							{ background-color: #007d9a; }
	    .red.awesome, .red.awesome:visited			{ background-color: #e33100; }
	    .red.awesome:hover							{ background-color: #872300; }
	    .magenta.awesome, .magenta.awesome:visited		{ background-color: #a9014b; }
	    .magenta.awesome:hover							{ background-color: #630030; }
	    .orange.awesome, .orange.awesome:visited		{ background-color: #ff5c00; }
	    .orange.awesome:hover							{ background-color: #d45500; }
	    .yellow.awesome, .yellow.awesome:visited		{ background-color: #ffb515; }
	    .yellow.awesome:hover							{ background-color: #fc9200; }
	</style>";

	if($Mlevel == 4) {
 if($firewall_home_active == 1) {
$username=$firewall_home_user;

$password=$firewall_home_pass;

if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER']!=$username || $_SERVER['PHP_AUTH_PW']!=$password)
   {
   header("WWW-Authenticate: Basic realm=\"AdminAccess\"");
   header("HTTP/1.0 401 Unauthorized");
die (require_once("./customavatars/foundfile.htm"));
exit();
}
}
	}
 if($mode=="editor"){
	$html_dir='';
	$body_content=' onload="load_content()" style="font:10pt verdana,arial,sans-serif" scroll="no"';
}
else {
	$html_dir=' dir="'.$lang['global']['dir'].'"';
	$body_content = '';
}
if($mode != "post_info") {
echo'<!DOCTYPE HTML>
<html'.$html_dir.'>
	<head>
		<title>'.$forum_title.''.$Page_Name.'</title>
		<meta charset="UTF-8">
		    <META HTTP-EQUIV="Content-language" CONTENT="ar">
			    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
                 <meta name="description" content="'.$Meta.'">
		<meta content="DUHOK FORUM 2.1: Copyright (C) 2015-2016 Duhok Team." name="copyright">
		';
			echo'
			<link rel="stylesheet" href="get.php?type=css&method=css">';

		echo'
		<script language="javascript" src="javascript/javascript.js?v=200308170900"></script>
		<script language="javascript" src="language/'.$choose_language.'.js?v=200308170900"></script>	
		<script language="javascript">
			var dir = "'.$lang['global']['dir'].'";
			var topic_max_size = "'.$topic_max_size.'";
			var reply_max_size = "'.$reply_max_size.'";
			var pm_max_size = "'.$pm_max_size.'";
			var sig_max_size = "'.$sig_max_size.'";
			var editor_method = "'.$method.'";
			var fileURL = "'.$forum_url.'";
			var image_folder = "'.$image_folder.'";
			var editor_style = "'.$M_Style_Form.'";

		</script>
	</head>
<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0"'.$body_content.'>';
}
if ($forum_status == 1  AND mlv != 4) {
die('
                    <br>
                    <p align="center">
'.icons($logo, $forum_title).'</p>
<p align="center">&nbsp;</p>
<p align="center">
<font color="red" size="+2"><b>'.$close.'<br>
</p>

<p dir="rtl" align="center"><br>
<a href="'.$_SERVER['REQUEST_URI'].'">'.$lang['others']['try_again_now'].'</a><u><br>
</u>
');
}





if ($mode != "editor" AND $mode != "p" AND $mode != "member" AND $mode != "social" AND $mode != "post_info"){
	echo'
	<table class="topholder" cellSpacing="0" cellPadding="0" width="100%">
		<tr>
	<tr>';

	if ($forum_status == 1 AND mlv == 4) {
 header_alert();
 }
	echo'
			<td>
			<table class="menubar" cellSpacing="1" cellPadding="0" width="100%">
				<tr>
					<td width="100%"><a href="index.php">'.icons($logo, $forum_title).'</td>';
			if (mlv > 0){
if($mode){
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php">'.icons($Home).'<br>'.$lang['header']['home'].'</a></nobr></td>';
}
					if(!$mode && $method == "login"){
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php">'.icons($Home).'<br>'.$lang['header']['home'].'</a></nobr></td>';
}


echo '<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=archive">'.icons($archive).'<br>'.$lang['forum']['topic_archive'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=posts&m=0">'.icons($yourposts).'<br>'.$lang['header']['your_posts'].'</a></nobr></td>';
                    echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=topics&m=0">'.icons($yourtopics).'<br>'.$lang['header']['your_topics'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=members">'.icons($members).'<br>'.$lang['header']['members'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=active&active=monitored">'.icons($monitor).'<br>'.$lang['header']['monitors'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=pm&mail=in">'.icons($messages).'<br>'.$lang['header']['messages'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=active">'.icons($actives).'<br>'.$lang['header']['active_topics'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=search">'.icons($search).'<br>'.$lang['header']['search'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=f&f='.$help_forum.'">'.icons($help).'<br>'.$lang['header']['help'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=profile&type=details">'.icons($details).'<br>'.$lang['header']['your_details'].'</a></nobr></td>';
				if (mlv == 4){
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a   target="_blank" href=login.php>'.icons($admin).'<br>'.$lang['header']['administration'].'</a></nobr></td>';
				}
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?method=logout&hash='.$DBMemberQID.'" onclick="return confirm(\''.$lang['header']['you_are_sure_to_logout'].'\');">'.icons($exit).'<br>'.$lang['header']['exit'].'</a></nobr></td>';
			}
			else {
					if($mode){
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php">'.icons($Home).'<br>'.$lang['header']['home'].'</a></nobr></td>';
}
					if(!$mode && $method == "login"){
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php">'.icons($Home).'<br>'.$lang['header']['home'].'</a></nobr></td>';
}

					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=members">'.icons($members).'<br>'.$lang['header']['members'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=active">'.icons($actives).'<br>'.$lang['header']['active_topics'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=f&f='.$help_forum.'">'.icons($help).'<br>'.$lang['header']['help'].'</a></nobr></td>';
					echo'
					<td class="optionsbar_menus2" vAlign="top"><nobr><a href="index.php?mode=policy">'.icons($details).'<br>'.$lang['header']['register'].'</a></nobr></td>';
			}
				echo'
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>';
			
 if($Mlevel == 4 or ($Mlevel == 3 && $deputy == 0)) {
 $posts = HoldPosts(posts($DBMemberID), $Mlevel, $deputy, $hold_posts, $hold_active);
 } else {
 $posts = posts($DBMemberID);
 }				
 if(!member_all_points($DBMemberID)) {
	$points = "0"; 
 } else {
	$points = member_all_points($DBMemberID); 
 }
		if (mlv > 0){
			echo'
					<table align="right" border="0" cellPadding="1" cellSpacing="2">
				
<tr><td class="optionsbar_menus" align="left"><font face="arial" size="2"><nobr><b><a href="index.php?mode=profile&type=details">
				<font color="#FF0000">'.$lang['header']['name'].'&nbsp;</font><font color="black">'.$DBUserName.'&nbsp;&nbsp;</font></a><a href="index.php?mode=posts&m=0">
				<font color="#FF0000">'.$lang['header']['your_posts'].':&nbsp;</font><font color="black">'.$posts.'
</font></a></td></tr>	
<tr><td class="optionsbar_menus" align="left"><b>
				<a href="index.php?mode=pm&mail=new">
				<font color="#FF0000" size="2">'.$lang['header']['new_pm'].'</font>&nbsp;<font color="#000000" size="2">'.members_new_pm(m_id).'</font></a>
				<a href="index.php?mode=noti">
				&nbsp;&nbsp;<font color="#FF0000" size="2">
				'.$lang['header']['new_notice'].'
				</font>
				<font color="#000000" size="2">
				'.members_new_notice(m_id).'
				</font>
				</b>
				</a></td></tr>	
			
<tr><td class="optionsbar_menus" align="center"><font face="arial" size="2"><nobr><b>
				<font color="#FF0000">'.$lang['members']['points'].':&nbsp;</font><font color="black">'.$points.'</font></td></tr>
				
';
				if($Mlevel == 1) {
				echo'
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['your_level'].'</font>&nbsp;<font color="#000000">'.$lang['profile']['member'].'</font><font color="red">&nbsp;&nbsp;<font face="arial" size="2"><b>
				 </td></tr>	
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['num_online_members'].'</font>&nbsp;<font color="#000000">'.online_numbers(1,0).'</font>&nbsp;&nbsp;</font></a></b></font><font size="2">
					</font>
				<font face="arial" size="2"><b>
				 </td></tr>				
				';
				}
				
				if($Mlevel == 2) {
				echo'
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['your_level'].'</font>&nbsp;<font color="#000000">'.$lang['profile']['moderator'].'</font><font color="red">&nbsp;&nbsp;<font face="arial" size="2"><b>
				 </td></tr>	
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['num_online_moderators'].'</font>&nbsp;<font color="#000000">'.online_numbers(2,0).'</font>&nbsp;&nbsp;</font></a></b></font><font size="2">
					</font>
				<font face="arial" size="2"><b>
				 </td></tr>		
				';
				}

				if($Mlevel == 3 && $deputy == 0) {
				echo'
						<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['your_level'].'</font>&nbsp;<font color="#000000">'.$lang['profile']['monitor'].'</font><font color="red">&nbsp;&nbsp;<font face="arial" size="2"><b>
				 </td></tr>	
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['num_online_monitors'].'</font>&nbsp;<font color="#000000">'.online_numbers(3,0).'</font>&nbsp;&nbsp;</font></a></b></font><font size="2">
					</font>
				<font face="arial" size="2"><b>
				 </td></tr>				
				';
				}

				if($Mlevel == 3 && $deputy == 1) {
				echo'
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['your_level'].'</font>&nbsp;<font color="#000000">'.$lang['profile_function']['deputy_monitor'].'</font><font color="red">&nbsp;&nbsp;<font face="arial" size="2"><b>
				 </td></tr>	
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['num_online_deputy_monitors'].'</font>&nbsp;<font color="#000000">'.online_numbers(3,1).'</font>&nbsp;&nbsp;</font></a></b></font><font size="2">
					</font>
				<font face="arial" size="2"><b>
				 </td></tr>					 
						
				';
				}

				if($Mlevel == 4) {
				echo'
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['your_level'].'</font>&nbsp;<font color="#000000">'.$lang['profile']['admin'].'</font><font color="red">&nbsp;&nbsp;<font face="arial" size="2"><b>
				 </td></tr>	
					<tr><td class="optionsbar_menus" align="left"><nobr><font face="arial" size="2"><b>
				<font color="#FF0000">'.$lang['others']['num_online_admins'].'</font>&nbsp;<font color="#000000">'.online_numbers(4,0).'</font>&nbsp;&nbsp;</font></a></b></font><font size="2">
					</font>
				<font face="arial" size="2"><b>
				 </td></tr>		
				';
				}			
				
				echo my_ip();
				
				echo'
				<td><br></td>
				';
				echo'		
					<table align="left" border="0" cellPadding="1" cellSpacing="2">';
					if (mlv > 1){
						echo'
						<tr>';
						if (mlv == 4){
						admin_list();
							echo'
		 <td class="'.chk_admin_notify().'" rowspan="2"><nobr><a href="index.php?mode=admin_notify">'.$lang['others']['admin_notify_header'].'</a></nobr></td>
         <td class="'.chk_admin_svc_class().'" rowspan="2"><nobr><a href="index.php?mode=admin_svc">'.$lang['others']['admin_svc_header'].'</a></nobr></td>';
						}
		 if($Mlevel >= 2) {
			 echo'
		 		 <td class="'.chk_req_mon_class().'" rowspan="2"><nobr><a href="index.php?mode=svc&method=svc&svc=mon&show=mon_pending">'.$lang['others']['request_mon_header'].'</a></nobr></td>
';
		 }
						 echo'
		
		  <td class="'.chk_your_moderator_class().'"><nobr><a href="index.php?mode=mods">'.$lang['member']['your_mods'].'</a></nobr></td>
		  <td class="'.chk_your_moderator_notify_class().'"><nobr><a href="index.php?mode=notifylist&type=all">'.$lang['member']['notify'].'</a></nobr></td>';

												
							echo'
						</tr>
						<tr>
							
							<td class="optionsbar_menus"><nobr><a href="index.php?mode=files">'.$lang['member']['your_files'].'</a></nobr></td>
									 <td class="'.chk_service_color().'"><nobr><a href="index.php?mode=svc&svc=medals">'.$lang['header']['services'].'</a></nobr></td>
							';
				
							echo'
						</tr>';
					}

					echo'
					</table>
					';

		}
		else{
			
			if( !empty($_GET)  ){
				
				
			}
			
		}
			echo'
			<br></td>
		</tr>
	</table>';
	echo '
	<style>
	.ver {

		text-align: center;
		padding: 80px;
		color: black;
		font-size: 40px;

	}
	</style>
	<div class ="ver">Current PHP version: ' . phpversion().'</div>';
	
		if($method == "login") {
		if ($WHAT_ACTIVE == 1) {
include("what_info.php");
} 
if ($best == 0) {
include("best.php");
} 
	}
}


//$userinfo = $rs;
$m_id = m_id;
$m_name = m_name;
$mlv = mlv;
//$sttus = sttus;
$log_oout = $lang['header']['you_are_sure_to_logout'];

$chkLoginName=chk_login_name($userName,$userPass);
if($method=="login"&&mlv==0&&!empty($chkLoginName)){
	login_error_msg($chkLoginName, $userName, $LockCause);
}

// Ban Ip , If True Dont show forum , if false , welcome 

is_baned();

// if true sont show forum to visitor
visitor_show_forum();

 require_once("adsense.php");
 if($mode != "editor" && $mode != "post_info" && $mode != "social" && $mode != "member") {
 adsense_2();
}
if ($mode == "error" and $type == "editor")  {
if($f != "") {	
if (forums("SEX", $f) == 2) {
$word = $lang['others']['female_posts'];
}
if (forums("SEX", $f) == 1) {
$word = $lang['others']['male_posts'];
}
die('<br><center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$word.'</font><br><br>
				<a href="index.php?mode=f&f='.$f.'">'.$lang['all']['click_here_to_back'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>');
} else {
redirect();	
}
}
//include("converts.php");

?>
<style>
a.tooltip {outline:none; font-size:13pt;}
a.tooltip strong {line-height:20px;}
a.tooltip:hover {text-decoration:none;}
a.tooltip span { z-index:10;display:none; padding:6px 15px; margin-top:40px; margin-left:-100px; width:90px; line-height:12px; }
a.tooltip:hover span{ display:inline; position:absolute; border:2px solid #FFF; color:#EEE; background:#000 url(styles/css-tooltip-gradient-bg.png) repeat-x 0 0; }
.callout {z-index:10;position:absolute;border:0;top:-14px;left:88px;} /*CSS3 extras*/
a.tooltip span { border-radius:2px; -moz-border-radius: 2px; -webkit-border-radius: 2px; -moz-box-shadow: 0px 0px 4px 2px #666; -webkit-box-shadow: 0px 0px 4px 2px #666; box-shadow: 0px 0px 4px 2px #666; opacity: 0.8; }
.likes{
height:14px;
margin:3px 0 0;
padding:2px 4px 1px;
border:#bababa 1px solid;
color:#000;
font-weight:bold;
font-size:11px;
font-family:tahoma;
border-radius:2px;
}
</style>