<?php
if (@eregi("social.php","$_SERVER[PHP_SELF]")) {
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
require_once("engine/groups_function.php");
require_once("engine/function.php");
require_once("engine/market_function.php");
require_once("engine/svc_function.php");
echo"<script src=\"profile.js\"></script>";
if($prm != "" && $prm != "market" && $prm != "sales" && $prm != "portal" && $prm != "groups" && $prm != "ann" && $prm !="forums" ){
	header("Location: ".index()."");
}

echo'
<center>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8">
';
if($Site_ID == 1 AND $Site_After == 2){
		echo'
<link rel="stylesheet" type="text/css" href="./profile/temy.css">';
}
elseif($Site_ID == 2 AND $Site_After == 1){
		echo'
<link rel="stylesheet" type="text/css" href="./profile/temy_1.css">';
}
echo'</head>
<center>
<div id="dhtmltooltip"></div>
<table width="1024" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td>';
echo menuLinks();
echo'<font color="yellow">
</td></tr>

<tr>
<td align="center">      
<br>'.$code_2.'
</td>  
</tr>
';
if($prm == "") {
 
echo'
<center>

<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" border="0" src="./profile/bullet2.gif">
	
</div></td></tr>



</div>	

			</tr>
			
			</tbody></table>
			</center>
			<br>
<tr><td class="contentarea"><table border="0" cellpadding="0" cellspacing="0" width="1024"><tbody><tr><td valign="top" style="padding-top:10px;"><div class="latest_blog_home_ff"><div class="sub_latest_blog_home_ff">'.$lang['social']['active_blogs'].'</div></div><div class="sub_latest_blog_content_home_ff"><table>
<tbody>';

	 		$sqla = "SELECT * FROM ".prefix."TOPICS WHERE FORUM_ID = '$blog_forum' and T_HIDDEN = '0' and T_UNMODERATED = '0' and T_HOLDED = '0' and T_AUTHOR_MOD = '0' ORDER BY T_DATE DESC LIMIT 10 ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
	  		  if ($x < $numf) {

      while ($x < $numf) {
      $topic_id = mysqli_result($sqlf, $x, "TOPIC_ID");
      $author = mysqli_result($sqlf, $x, "T_AUTHOR");
      $message = mysqli_result($sqlf, $x, "T_MESSAGE");
	  $message = html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($message)))), ENT_COMPAT, 'UTF-8');	  
      $date = mysqli_result($sqlf, $x, "T_DATE");	
      $topic_subject = topics("SUBJECT", $topic_id);
      $forum_subject = forums("SUBJECT", $forum_id);
	  $photo = members("PHOTO_URL", $author);
	  $name = members("NAME", $author);
	  $sex = members("SEX", $author);
	  $hidephoto = members("HIDE_PHOTO", $author);
	  
	  

						echo'
<tr><td width="45" valign="top">';
if ($photo != "" AND ($hidephoto == 0 OR $Mlevel > 1)) {
      						echo'<a href="index.php?mode=member&id='.$author.'">
      						<img border="0" onerror="this;" title="'.$name.'" src="'.$photo.'" border="0" style="width:45px;height:45px;"></a>

							';
} else {
	if($sex == 1 or $sex == 0) {
		
		echo'<a href="./profile/mal_u.png">
      						<img border="0" onerror="this;" title="'.$name.'" src="./profile/mal_u.png" border="0" style="width:45px;height:45px;"></a>
';	} else {
		
		echo'<a href="./profile/fem_u.png">
      						<img border="0" onerror="this;" title="'.$name.'" src="./profile/mal_u.png" border="0" style="width:45px;height:45px;"></a>
';	}
						
				}
echo'

<td width="90%">
<span class="text_my_page"><b><a href="index.php?mode=member&id='.$author.'&prm=blog">'.$topic_subject.'</a></b></span><b><br>
<span style="font-size:12px;color:#999"><b>'.strip_tags(cutstr($message, 200)).'...</b></span><b><br>
<span class="text_s_my_page" style="color:#999;"><b>'.normal_time($date).' - '.$lang['social']['by'].'<span style="margin-right:10px;color:#13565c;"><a href="index.php?mode=member&id='.$author.'">'.$name.'</a></span></b></span><b>
</b></b></b></td></tr>';
	  ++$x;
	  }
	  } else {
		  
		  echo'<tr><td width="90%"><center>'.$lang['member']['no_this_here'].' </center></td></tr>';
	  }

	  
	  echo'
</tbody>

</table></div></td><td>&nbsp;&nbsp;</td><td valign="top" style="padding-top:10px;"><div class="latest_blog_home_ff"><div class="sub_latest_blog_home_ff">'.$lang['social']['active_top_topics'].' '.$forum_title.'</div></div><div class="sub_latest_blog_content_home_ff"><div style="padding-top:2px;">
';
$sqlf = DBi::$con->query("SELECT * FROM ".prefix."TOPICS AS T INNER JOIN ".prefix."FORUM AS F ON (T.FORUM_ID = F.FORUM_ID) WHERE T.T_TOP = '2' AND T.T_ARCHIVED = '0' AND T.T_HIDDEN = '0' and T.T_UNMODERATED = '0' and T.T_HOLDED = '0' and T.T_AUTHOR_MOD = '0' and F.F_LEVEL = '0' AND F.F_HIDE = '0' ORDER BY T.T_DATE DESC LIMIT 15") or die(DBi::$con->error);
	
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
	  		  if ($x < $numf) {

      while ($x < $numf) {
      $topic_id = mysqli_result($sqlf, $x, "TOPIC_ID");
      $forum_id = mysqli_result($sqlf, $x, "FORUM_ID");
      $counts = mysqli_result($sqlf, $x, "T_COUNTS");
      $date = mysqli_result($sqlf, $x, "T_DATE");
      $date = mysqli_result($sqlf, $x, "T_DATE");
      $replies = mysqli_result($sqlf, $x, "T_REPLIES");
      $last_post = mysqli_result($sqlf, $x, "T_LAST_POST_DATE");
      $topic_subject = topics("SUBJECT", $topic_id);
      $forum_subject = forums("SUBJECT", $forum_id);
	  					$status = mysqli_result($sqlf, $x, "T_STATUS");
						echo'
<a href="index.php?mode=f&f='.$forum_id.'">'.$forum_subject.'</a>
<br>';
	if ($status == 0 AND $replies < 20) {echo icons($folder_new_locked, $lang['forum']['topic_is_locked']);}
elseif ($status == 0 AND $replies >= 20) {echo icons($folder_new_locked, $lang['forum']['topic_is_hot_and_locked']);}
elseif ($status == 1 AND $replies < 20) {echo icons($folder_new);}
elseif ($status == 1 AND $replies >= 20) {echo icons($folder_new_hot, $lang['forum']['topic_is_hot']);}
else {echo icons($folder);}
echo'&nbsp;<a href="index.php?mode=t&t='.$topic_id.'">'.$topic_subject.'</a><br>
<span class="text_read_forum">'.normal_time($date).' - <font color="green">'.$lang['social']['read'].' '.$counts.' - '.$lang['social']['replies'].' '.$replies.' - '.$lang['social']['last_reply'].' '.normal_time($last_post).'</font></span><font color="green">
<hr size="1" noshade="" style="border-color:#CCC;margin-right:7px;margin-left:7px;"></font>
';
++$x;
	  }

			  } else {
				  echo'<center>'.$lang['member']['no_this_here'].' </center>';
			  }
			  
echo'
</div></div>
<table>

</table></div></td><td style="width:10px;">&nbsp;</td>';
$chkLoginName=chk_login_name($userName,$userPass);
if($enter=="login_social"&&mlv==0&&!empty($chkLoginName)){
	$the_message = login_error_msg_social($chkLoginName, $userName);
}
if($Mlevel == 0) {
echo'
<td valign="top" style="padding-top:10px;">
<div class="box_head_sidehome_ff">'.$lang['header']['members_login'].'</div>
<div class="box_content_surveyhome_ff" style="padding-top:4px;">
<table height="100%" dir="rtl" cellspacing="0" cellpadding="0">
<form action="index.php?method=login_social" method="post">
<tbody><tr>'.$the_message.'<td style="font-size:12px;" align="left"><font color="red"><b>'.$lang['header']['name'].'</b>
</font></td><td colspan="2" style="padding-right:2px;"><input style="width:220px;" class="small" type="text" name="userName" value="">
</td></tr><tr><td style="font-size:12px;" align="left">
<font color="red"><nobr><b>&nbsp;'.$lang['header']['password'].'</b></nobr></font></td>
<td style="padding-right:2px;"><input style="width:160px;" class="small" type="password" name="userPass" value=""></td>
<td valign="top" align="left">
<input class="small" src="'.$login.'" type="image" value="Login" id="submit1" name="submit1" border="0" hspace="4"></td>
</tr><tr></tr><tr><td colspan="3" style="font-size:12px;" height="4"></td></tr><tr><td style="font-size:12px;align:center;" colspan="3"><nobr><center>
<select name="savePass"><option value="save">'.$lang['header']['save_pass_and_user_name'].'</option>
<option value="temp">'.$lang['header']['temporarily_login'].'</option></select>
<br><a class="menu" href="index.php?mode=forget_pass">'.$lang['header']['forget_password'].'</a></center></nobr></td>
</tr></tbody></table></div>
';	
}	

	 if($Mlevel > 0) {
echo'
<td valign="top" style="padding-top:10px;">
';
	 }
$sql1 = DBi::$con->query("SELECT * FROM ".prefix."ADS WHERE (AD_SHOW_SOCIAL_1 = '1' OR AD_SHOW_SOCIAL_2 = '1') AND AD_STATUS = '1'");
$num1 = mysqli_num_rows($sql1);
if($num1 == 0) {
echo'<div class="box_holder_announcement_ff"></table>';	 
}
	$sqla = "SELECT * FROM ".prefix."ADS WHERE AD_SHOW_SOCIAL_1 = '1' AND AD_STATUS = '1' ORDER BY AD_DATE DESC LIMIT 1 ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;

		  		  if ($x < $numf) {

      while ($x < $numf) {
      $ad_id = mysqli_result($sqlf, $x, "AD_ID");
      $message = mysqli_result($sqlf, $x, "AD_MESSAGE");
	  $message = str_replace("<br>", " ", $message);
	  $message = html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($message)))), ENT_COMPAT, 'UTF-8');	  
      $ad_subject = ads("SUBJECT", $ad_id);

	 
	  echo'
<div class="box_head_sidehome_ff">'.$ad_subject.'</div>
<div class="box_content_sidehome_ff">
<div style="padding-top:2px;">
<span class="span_blog_1">'.strip_tags(cutstr($message, 200)).'...</span>
<hr size="1" noshade="" style="border-color:#CCC;margin-right:7px;margin-left:7px;">
<a href="index.php?mode=social&prm=ann&ann=1"><div class="more_Details">'.$lang['member']['see_all'].' &gt;&gt;</div>
</a></div>
	  ';
	  ++$x;
	  }
} else {
	
		  echo'


	  ';
}
	 $sqla = "SELECT * FROM ".prefix."ADS WHERE AD_SHOW_SOCIAL_2 = '1' AND AD_STATUS = '1' ORDER BY AD_DATE DESC LIMIT 1 ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
		  		  if ($x < $numf) {

      while ($x < $numf) {
      $ad_id = mysqli_result($sqlf, $x, "AD_ID");

	  echo'
</div><div class="box_holder_announcement_ff"><div class="box_head_announcement_ff">'.$lang['social']['last_news'].'</div><div class="box_content_announcement_ff">
<table width="100%"><tbody><tr><td><font style="FONT-FAMILY: verdana; COLOR: #006600; FONT-SIZE: 16px">
<center><font style="COLOR: #9999ff; FONT-SIZE: 24px">
<table>
<tbody>
<tr>
<td valign="top"><img border="0" src="./profile/icon.png"></td>
<td><font style="COLOR: #ffff99; FONT-SIZE: 22px; FONT-FAMILY: tahoma; FONT-WEIGHT: normal;" size="5">'.$lang['social']['news_desc'].'</font></td></tr></tbody></table></font></center>
<p< td=""></p<></font></td></tr></tbody></table><hr size="1" noshade="" style="color:white;margin-right:7px;margin-left:7px;"><a href="index.php?mode=social&prm=ann&ann=2"><div class="more_Details"><font color="white">'.$lang['member']['see_all'].' &gt;&gt;</font></div></a><font color="white">
</font></div></div><font color="white">
</font></td></tr></tbody></table></td></tr><tr><td></td></tr></tbody></table>

';++$x;
	  }
				  } else {
					  echo'
	</table>
					';					
				  }
echo'
</center></body></html>

';

}
if ($prm == "ann") {
	
	if($ann == "1") {

		echo'

<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span>
	<img border="0" src="./profile/bullet2.gif">
	<span style="color:#FF0000;font-weight:bold;font-size:18px">'.$lang['social']['ads'].'</span>
	
</div></td></tr>




<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br><td class="subtab_highlight">
<a class="treetab" href="index.php?mode=social&prm=ann&ann=1">'.$lang['social']['forum_ads'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=social&prm=ann&ann=2">'.$lang['social']['general_ads'].'</a></td>
</tr></tbody></table>

</div>	

			</tr>
			
			</tbody></table>
			</center>
			

';
					
			 $sqla = "SELECT * FROM ".prefix."ADS WHERE AD_SHOW_SOCIAL_1 = '1' AND AD_STATUS = '1' ORDER BY AD_DATE DESC LIMIT 1 ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
	  		  if ($x < $numf) {
      while ($x < $numf) {
      $ad_id = mysqli_result($sqlf, $x, "AD_ID");
      $message = mysqli_result($sqlf, $x, "AD_MESSAGE");
	  $message = html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($message)))), ENT_COMPAT, 'UTF-8');	  
      $ad_subject = ads("SUBJECT", $ad_id);
	  
		$sql = DBi::$con->query("SELECT * FROM ".prefix."ADS_COUNTS WHERE COUNT_MEMBER = '$DBMemberID' AND COUNT_AD = '$ad_id'");
		$num = mysqli_num_rows($sql);
		
		if($num == 0 AND $Mlevel > 0) {
			DBi::$con->query ("INSERT INTO ".prefix."ADS_COUNTS (COUNT_MEMBER, COUNT_AD) VALUES ('$DBMemberID', '$ad_id')") or die(DBi::$con->error);
		 DBi::$con->query("UPDATE ".prefix."ADS SET AD_COUNTS = AD_COUNTS + 1  WHERE AD_ID = '$ad_id' ") or die (DBi::$con->error);
			
		}
if($Mlevel == 0){
			DBi::$con->query ("INSERT INTO ".prefix."ADS_COUNTS (COUNT_MEMBER, COUNT_AD) VALUES ('0', '$ad_id')") or die(DBi::$con->error);
		 DBi::$con->query("UPDATE ".prefix."ADS SET AD_COUNTS = AD_COUNTS + 1  WHERE AD_ID = '$ad_id' ") or die (DBi::$con->error);
			
			}		
		echo'
				 <center>
				 <table width="83%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="8%" class="contentarea">
<center><div class="page____head">
					'.$ad_subject.'</div></center>
<center>
<div class="page_contenttt">
	<center>
<center><font color="black">'.$message.'</font></center>
</center></div></center></td>
	</tr>
	</tbody>
	</table>
	</table>


';

++$x;
	  }
	
} else {
	
	echo'
					 <center>
				 <table width="83%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="8%" class="contentarea">
<center><div class="page____head">
					</div></center>
<center>
<div class="page_contenttt">
	<center>
<center><font color="black">'.$lang['member']['no_this_here'].'</font></center>
</center></div></center></td>
	</tr>
	</tbody>
	</table>
	</table>
	';
}
	echo'</body></html>';
	}

	if($ann == "2") {

		
		echo'

<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span>
	<img border="0" src="./profile/bullet2.gif">
	<span style="color:#FF0000;font-weight:bold;font-size:18px">'.$lang['social']['ads'].'</span>
	
</div></td></tr>




<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br><td class="subtab">
<a class="treetab" href="index.php?mode=social&prm=ann&ann=1">'.$lang['social']['forum_ads'].'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=social&prm=ann&ann=2">'.$lang['social']['general_ads'].'</a></td>
</tr></tbody></table>

</div>	

			</tr>
			
			</tbody></table>
			</center>';
					
			 $sqla = "SELECT * FROM ".prefix."ADS WHERE AD_SHOW_SOCIAL_2 = '1' AND AD_STATUS = '1' ORDER BY AD_DATE DESC LIMIT 1 ";
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
	  		  if ($x < $numf) {
      while ($x < $numf) {
      $ad_id = mysqli_result($sqlf, $x, "AD_ID");
      $message = mysqli_result($sqlf, $x, "AD_MESSAGE");
	  $message = html_entity_decode(stripslashes(text_replace(smiles_replace(make_clickable($message)))), ENT_COMPAT, 'UTF-8');	  
	  
	  		$sql = DBi::$con->query("SELECT * FROM ".prefix."ADS_COUNTS WHERE COUNT_MEMBER = '$DBMemberID' AND COUNT_AD = '$ad_id'");
		$num = mysqli_num_rows($sql);
		
		if($num == 0 AND $Mlevel > 0) {
			DBi::$con->query ("INSERT INTO ".prefix."ADS_COUNTS (COUNT_MEMBER, COUNT_AD) VALUES ('$DBMemberID', '$ad_id')") or die(DBi::$con->error);
		 DBi::$con->query("UPDATE ".prefix."ADS SET AD_COUNTS = AD_COUNTS + 1  WHERE AD_ID = '$ad_id' ") or die (DBi::$con->error);
			
		}
if($Mlevel == 0){
			DBi::$con->query ("INSERT INTO ".prefix."ADS_COUNTS (COUNT_MEMBER, COUNT_AD) VALUES ('0', '$ad_id')") or die(DBi::$con->error);
		 DBi::$con->query("UPDATE ".prefix."ADS SET AD_COUNTS = AD_COUNTS + 1  WHERE AD_ID = '$ad_id' ") or die (DBi::$con->error);
			
			}			
		echo'
				 <center>
				 <table width="83%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="8%" class="contentarea">
<center><div class="page____head">
					'.$lang['social']['last_news'].'</div></center>
<center>
<div class="page_contenttt">
	<center>
<center><font color="black">'.$message.'</font></center>
</center></div></center>
</td>
	</tr>
	</tbody>
	</table>
	</table>

';

++$x;
	  }
	
} else {
	
	echo'
					 <center>
				 <table width="83%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="8%" class="contentarea">
<center><div class="page____head">
					</div></center>
<center>
<div class="page_contenttt">
	<center>
<center><font color="black">'.$lang['member']['no_this_here'].'</font></center>
</center></div></center></td>
	</tr>
	</tbody>
	</table>
	</table>
	';
}
	echo'</body></html>';
	}
	
}

if($prm == "forums"){
	
	echo'
		
<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span>
	<img border="0" src="./profile/bullet2.gif">
	<span style="color:#FF0000;font-weight:bold;font-size:18px">'.$lang['social']['forums'].'</span>
	
</div></td></tr>




<tr><td class="contentarea"><br>


</div>	

			</tr>
			
			</tbody></table>
			</center>

<center>
<td class="contentarea"><div class="page_content">
 <table width="100%" border="0" cellspacing="4" cellpadding="0">
 
  <td valign="top" width="240" class="box_forums">
 <div id="ForumCatsBox">


 ';
	$sqla = "SELECT * FROM ".prefix."CATEGORY WHERE SITE_ID = '$Site_ID' OR SITE_ID = '0' ORDER BY CAT_ORDER ASC ";				
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
      while ($x < $numf) {
      $f_cat_id = mysqli_result($sqlf, $x, "CAT_ID");
      $f_cat_level = mysqli_result($sqlf, $x, "CAT_LEVEL");
      $f_cat_hide = mysqli_result($sqlf, $x, "CAT_HIDE");
      $f_cat_name = cat("NAME", $f_cat_id);
	  $check_cat_login = check_cat_login($f_cat_id);
  
  					if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
						
	  echo'
 <a href="index.php?mode=social&prm=forums&c='.$f_cat_id.'"><span style="black:red;font-weight:bold;font-size:16px">
 <img border="0" src="./profile/bullet1.gif"> '.$f_cat_name.'</span></a>
<br> 
 ';
					}
					}
	++$x;
	  }
	  echo'
</div></td>

 	  
	  <td class="box_forums" valign="top">
';
	   if($c == "") {
		   echo'
<div id="ForumDetailBox">

<table cellspacing="2" width="100%">
<tbody>


 ';
 
 

	$sqla = "SELECT * FROM ".prefix."CATEGORY WHERE SITE_ID = '$Site_ID' OR SITE_ID = '0' ORDER BY CAT_ORDER ASC ";				
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
      while ($x < $numf) {
      $f_cat_id = mysqli_result($sqlf, $x, "CAT_ID");
      $f_cat_level = mysqli_result($sqlf, $x, "CAT_LEVEL");
      $f_cat_hide = mysqli_result($sqlf, $x, "CAT_HIDE");
      $f_cat_name = cat("NAME", $f_cat_id);
	  $check_cat_login = check_cat_login($f_cat_id);
  
  					if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
	  
	  echo'
<tr>
<td width="60%" class="forumbox_cat" valign="top" colspan="2">
&nbsp;<b>'.$f_cat_name.'</b>
</td>
<td width="5%" class="forumbox_cat" align="center" colspan="2">'.$lang['msg']['error_13'].'</td>
<td width="5%" class="forumbox_cat" align="center">'.$lang['msg']['error_14'].'</td>
<td width="20%" class="forumbox_cat" align="center"><nobr>'.$lang['home']['last_post'].'</nobr></td>
</tr>
 ';
					}
					}
 
	  $sqlaa = "SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$f_cat_id' ORDER BY F_ORDER ";
	$sqlff = DBi::$con->query("".$sqlaa."") or die (DBi::$con->error);
   $numff = mysqli_num_rows($sqlff);
         $i = 0;
		 while ($i < $numff) {
      $f_id = mysqli_result($sqlff, $i, "FORUM_ID");
      $f_subject = mysqli_result($sqlff, $i, "F_SUBJECT");
      $f_status = mysqli_result($sqlff, $i, "F_STATUS");
      $f_desc = mysqli_result($sqlff, $i, "F_DESCRIPTION");
      $f_topics = mysqli_result($sqlff, $i, "F_TOPICS");
      $f_replies = mysqli_result($sqlff, $i, "F_REPLIES");
      $f_last_post_date = mysqli_result($sqlff, $i, "F_LAST_POST_DATE");
      $f_last_post_author = mysqli_result($sqlff, $i, "F_LAST_POST_AUTHOR");
	  	$author_name = members("NAME", $f_last_post_author);
      $f_logo = mysqli_result($sqlff, $i, "F_LOGO");
      $f_order = mysqli_result($sqlff, $i, "F_ORDER");
      $f_level = mysqli_result($sqlff, $i, "F_LEVEL");
      $f_hide = mysqli_result($sqlff, $i, "F_HIDE");
$check_forum_login = check_forum_login($f_id);
	if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {
					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
           if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
							if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){	  
	  echo'
  
<tr><td width="5%" class="forumbox_logo" width="75"><center><img border="0" height="30" src="'.$f_logo.'"></center></td>
 <td width="55%" class="forumbox_f1">
 <a href="index.php?mode=f&f='.$f_id.'">'.$f_subject.'</a>
 <br> <font size="1">'.$f_desc.'</font></td>
 <td width="2.5%" class="forumbox_f2" valign="middle" align="center">
 <a href="index.php?mode=f&f='.$f_id.'">';
 										if ($f_status == 0) {
											echo icons($folder_locked, $lang['home']['forum_locked'], "");
										}
										else {
											
	
											echo icons($folder, $lang['home']['forum_opened'], "");
										}
 echo'
 </a></td><td width="2.5%" class="forumbox_f2" valign="middle" align="center">'.$f_topics.'</td>
 <td class="forumbox_f2">'.$f_replies.'</td><td width="20%" class="forumbox_f2"><nobr>
 ';if ($author_name != "" AND !empty($f_last_post_date) AND $f_last_post_date != "") {
	 echo'
 <font color="red"><b>'.normal_time($f_last_post_date).'<br>
<a href="index.php?mode=member&id='.$f_last_post_author.'">'.$author_name.'</a></b></font>
 ';}
 echo'</nobr>
 </tr>
 </center>
  
	';
							}
		   }
		 }
	  }
	   
	  ++$i;
	  }
	   ++$x;
	  }
	  echo'</table></table></div></td>';
	  

 
	 }
	if($c != "") {
			
			echo'
				<center>

 <table width="100%" border="0" cellspacing="4" cellpadding="0">
 


<div id="ForumDetailBox">

<table cellspacing="2" width="100%">
<tbody>


 ';
 
       $f_cat_name = cat("NAME", $c);

	$sqla = "SELECT * FROM ".prefix."CATEGORY WHERE CAT_ID = '$c' AND (SITE_ID = '$Site_ID' OR SITE_ID = '0') ORDER BY CAT_ORDER ASC ";				
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
      while ($x < $numf) {
      $f_cat_level = mysqli_result($sqlf, $x, "CAT_LEVEL");
      $f_cat_hide = mysqli_result($sqlf, $x, "CAT_HIDE");
	  $check_cat_login = check_cat_login($c);
  
  					if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
	  
	  echo'
<tr>
<td width="60%" class="forumbox_cat" valign="top" colspan="2">
&nbsp;<b>'.$f_cat_name.'</b>
</td>
<td width="5%" class="forumbox_cat" align="center" colspan="2">'.$lang['msg']['error_13'].'</td>
<td width="5%" class="forumbox_cat" align="center">'.$lang['msg']['error_14'].'</td>
<td width="20%" class="forumbox_cat" align="center"><nobr>'.$lang['members_function']['last_post'].'</nobr></td>
</tr>
 ';
					}
					}
 
 
	  $sqlaa = "SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$c' ORDER BY F_ORDER ";
	$sqlff = DBi::$con->query("".$sqlaa."") or die (DBi::$con->error);
   $numff = mysqli_num_rows($sqlff);
         $i = 0;
		 while ($i < $numff) {
      $f_id = mysqli_result($sqlff, $i, "FORUM_ID");
      $f_subject = mysqli_result($sqlff, $i, "F_SUBJECT");
      $f_status = mysqli_result($sqlff, $i, "F_STATUS");
      $f_desc = mysqli_result($sqlff, $i, "F_DESCRIPTION");
      $f_topics = mysqli_result($sqlff, $i, "F_TOPICS");
      $f_replies = mysqli_result($sqlff, $i, "F_REPLIES");
      $f_last_post_date = mysqli_result($sqlff, $i, "F_LAST_POST_DATE");
      $f_last_post_author = mysqli_result($sqlff, $i, "F_LAST_POST_AUTHOR");
	  	$author_name = members("NAME", $f_last_post_author);
      $f_logo = mysqli_result($sqlff, $i, "F_LOGO");
      $f_order = mysqli_result($sqlff, $i, "F_ORDER");
      $f_level = mysqli_result($sqlff, $i, "F_LEVEL");
      $f_hide = mysqli_result($sqlff, $i, "F_HIDE");
$check_forum_login = check_forum_login($f_id);
	if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
           if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){	  
	  echo'
  
<tr><td width="5%" class="forumbox_logo" width="75"><center><img border="0" height="30" src="'.$f_logo.'"></center></td>
 <td width="55%" class="forumbox_f1">
 <a href="index.php?mode=f&f='.$f_id.'">'.$f_subject.'</a>
 <br> <font size="1">'.$f_desc.'</font></td>
 <td width="2.5%" class="forumbox_f2" valign="middle" align="center">
 <a href="index.php?mode=f&f='.$f_id.'">';
 										if ($f_status == 0) {
											echo icons($folder_locked, $lang['home']['forum_locked'], "");
										}
										else {
											
	
											echo icons($folder, $lang['home']['forum_opened'], "");
										}
 echo'
 </a></td><td width="2.5%" class="forumbox_f2" valign="middle" align="center">'.$f_topics.'</td>
 <td class="forumbox_f2">'.$f_replies.'</td><td width="20%" class="forumbox_f2"><nobr>
 ';if ($author_name != "" AND !empty($f_last_post_date) AND $f_last_post_date != "") {
	 echo'
 <font color="red"><b>'.normal_time($f_last_post_date).'<br>
<a href="index.php?mode=member&id='.$f_last_post_author.'">'.$author_name.'</a></b></font>
 ';}
 echo'</nobr>
 </tr>
 </center>
  
	';
}
		   }
					}
	}
	  ++$i;
	  }
	   ++$x;
	  }
	  echo'</table></table></div></td>';


}
}

if($prm == "groups"){
	if($prd != "active" && $prd != "all" && $prd != "latest" && $prd != "forum" && $prd != "group"){
		header("Location: ".index()."");
	}


	
	echo'
<center>

<html>
		

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';

	echo'
		<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span>
		<img border="0" src="./profile/bullet2.gif">
		<span style="color:#FF0000;font-weight:bold;font-size:18px">'.$lang['member']['groups'].'</span>
		';
		if($prd == "active"){
			echo'<img border="0" src="./profile/bullet1.gif"> <a href="index.php?mode=social&prm=groups&prd=active"><span style="color:#797979;font-weight:bold;font-size:18px">'.$lang['member']['active_groups'].'</span></a>';
		}
		if($prd == "latest"){
			echo'<img border="0" src="./profile/bullet1.gif"> <a href="index.php?mode=social&prm=groups&prd=latest"><span style="color:#797979;font-weight:bold;font-size:18px">'.$lang['member']['latest_groups'].'</span></a>';
		}
		if($prd == "all"){
			echo'<img border="0" src="./profile/bullet1.gif"> <span style="color:#797979;font-weight:bold;font-size:18px">'.$lang['social']['all_groups_forums'].'</span>';
		}
		if($prd == "forum"){
			echo'<img border="0" src="./profile/bullet1.gif"> <span style="color:#797979;font-size:18px;font-weight:bold;"> '.$lang['member']['group_forum'].' <a href="index.php?mode=f&f='.$f.'">'.forums("SUBJECT",$f).'</a></span>';
		}
		if($prd == "group"){
			echo'<span style="color:red;font-weight:bold;font-size:18px"><img border="0" src="./profile/bullet2.gif"> '.groupName($id).'</span>';
		}
		echo'
		</div><br></td></tr>
		<tr><td class="contentarea">';
		if($prd == "active"){
			echo '<div class="page_head" style="width:1036px;">'.$lang['title_page']['active_group'].'</div>';
			echo '<div class="page_content"><table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr>';
	$temy = 15;
	$sqlaa13 = "SELECT * FROM ".prefix."GROUPS WHERE G_MOD = '2' AND G_STATUS != '1' LIMIT ".pg_limit($temy).", $temy ";
	$sqlff13 = DBi::$con->query("".$sqlaa13."") or die (DBi::$con->error);				   
   $numf = mysqli_num_rows($sqlff13);
      $x = 0;
      while ($x < $numf) {
      $g_id = mysqli_result($sqlff13, $x, "G_ID");
      $g_subject = mysqli_result($sqlff13, $x, "G_NAME");
      $g_img = mysqli_result($sqlff13, $x, "G_IMG");
      $g_desc = mysqli_result($sqlff13, $x, "G_DESC");
      $g_status = mysqli_result($sqlff13, $x, "G_STATUS");
      $f = mysqli_result($sqlff13, $x, "G_FORUM");
      $g_login = mysqli_result($sqlff13, $x, "G_LOGIN");
      $g_points = mysqli_result($sqlff13, $x, "G_POINTS");
	  $g_c = forums("CAT_ID", $f);
	  $f_cat_level = cat("LEVEL", $g_c);
      $f_cat_hide = cat("HIDE", $g_c);
	  $check_cat_login = check_cat_login($g_c);
      $f_level = forums("F_LEVEL", $f);
      $f_hide = forums("HIDE", $f);
	  $check_forum_login = check_forum_login($f);
	  if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {
  	  if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
      if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
	  if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){	
			echo'
			
			<td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'">
<img border="0" src="'.$g_img.'" onerror="this.src=\''.$icon_blank.'\';" height="64" width="86">
</a>
</div>
<div class="div_medals"><font style="font-size:18px;"><a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'">'.$g_subject.'</a></font><br>
<a href="index.php?mode=f&f='.$f.'">'.forums("SUBJECT",$f).'</a><br></div>
<div style="float:left">';
if(groupJoined($DBMemberID,$g_id) == 1){
	echo'<img border="0" src="images/image.png" title="'.$lang['member']['you_are_member'].'">';
}
elseif(groupBanned($DBMemberID,$g_id) == 1){
echo'
<img border="0" src="images/not_points.png" title="'.$lang['social']['cant_join_group'].'">';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && $g_status == 2 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/image_lock.png" title="'.$lang['social']['the_group_locked'].'">';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 1  && $g_status == 0 && groupPending($DBMemberID,$g_id) == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=3"><img border="0" src="images/add_imagee.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 1  && $g_status == 0 && groupPending($DBMemberID,$g_id) == 1 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=4"><img border="0" src="images/image_waitt.png" title="'.$lang['social']['pending_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 0  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=1"><img border="0" src="images/image_accept.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 2  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/image_invite.png" title="'.$lang['member']['invite_a_group'].'>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) < $g_points  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/not_points.png" title="'.$lang['member']['points_a_group'].'">';
}
echo'<div class="group_count_small">'.countGroup($g_id).'</div></div></td>';
$three_groups = $three_groups + 1;
			if ($three_groups == 3){
				echo'
				
				</tr>
				<tr>
';
					$three_groups = 0;
			}
			$count += 1;
	  }
		}
}
}
		 ++$x;
		 }
	$temy = 15;	 
	$sql = DBi::$con->query("SELECT count(*) FROM ".prefix."GROUPS WHERE G_MOD = '2' AND G_STATUS != '1'") or die (DBi::$con->error);
	$count = mysqli_result($sql, 0, "count(*)");		
	$cols = floor($count/$temy);
	$pg_next = $pg + 1;
	$pg_prev = $pg - 1;
		 echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=social&prm=groups&prd=active&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($count <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=social&prm=groups&prd=active&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=social&prm=groups&prd=active&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table>
	';


			/*
			<td class="box_plaques" valign="top">
<div style="float:right"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=152"><img border="0" src="icon.aspx?u=241~fnideq" onerror="this.src=''.$icon_folder.'';" border="0" height="64" width="86"></a></div>
<div class="div_medals"><font style="font-size:18px;"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=152">رابطة محبّي الرسول صلّى الله عليه وسلّم</a></font><br>
<a href="f.aspx?f=241">الكتب والبرامج الإسلامية</a><br></div>
<div style="float:left"><img border="0" src="icons/q/48/image.png" alt="'.$lang['member']['you_are_member'].'"><div class="group_count_small">7191</div></div></td><td class="box_plaques" valign="top">
<div style="float:right"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=264"><img border="0" src="icon.aspx?u=119~billalstarr" onerror="this.src=''.$icon_folder.'';" border="0" height="64" width="86"></a></div>
			*/
			echo '</tr></tbody></table></tr>';
			
			
			echo'</tbody></div>';
			
		}
		if($prd == "latest") {
					echo '<div class="page_head" style="width:1036px;">'.$lang['title_page']['latest_group'].'</div>';
			echo '<div class="page_content"><table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr>';
	$temy = 15;
	$sqlaa13 = "SELECT * FROM ".prefix."GROUPS WHERE G_MOD = '2' AND G_STATUS != '1' ORDER BY G_ID DESC LIMIT ".pg_limit($temy).", $temy ";
	$sqlff13 = DBi::$con->query("".$sqlaa13."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlff13);
      $x = 0;
      while ($x < $numf) {
      $g_id = mysqli_result($sqlff13, $x, "G_ID");
      $g_subject = mysqli_result($sqlff13, $x, "G_NAME");
      $g_img = mysqli_result($sqlff13, $x, "G_IMG");
      $g_desc = mysqli_result($sqlff13, $x, "G_DESC");
      $g_status = mysqli_result($sqlff13, $x, "G_STATUS");				   
      $f = mysqli_result($sqlff13, $x, "G_FORUM");	
      $g_login = mysqli_result($sqlff13, $x, "G_LOGIN");	
      $g_points = mysqli_result($sqlff13, $x, "G_POINTS");	
	  $g_c = forums("CAT_ID", $f);
	  $f_cat_level = cat("LEVEL", $g_c);
      $f_cat_hide = cat("HIDE", $g_c);
	  $check_cat_login = check_cat_login($g_c);
      $f_level = forums("F_LEVEL", $f);
      $f_hide = forums("HIDE", $f);
	  $check_forum_login = check_forum_login($f);
	  if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {
  	  if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
      if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
	  if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){		  
			echo'
			
			<td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'">
<img border="0" src="'.$g_img.'" onerror="this.src=\''.$icon_blank.'\';" height="64" width="86">
</a>
</div>
<div class="div_medals"><font style="font-size:18px;"><a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'">'.$g_subject.'</a></font><br>
<a href="index.php?mode=f&f='.$f.'">'.forums("SUBJECT",$f).'</a><br></div>
<div style="float:left">';
if(groupJoined($DBMemberID,$g_id) == 1){
	echo'<img border="0" src="images/image.png" title="'.$lang['member']['you_are_member'].'">';
}
elseif(groupBanned($DBMemberID,$g_id) == 1){
echo'
<img border="0" src="images/not_points.png" title="'.$lang['social']['cant_join_group'].'">';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && $g_status == 2 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/image_lock.png" title="'.$lang['social']['the_group_locked'].'">';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 1  && $g_status == 0 && groupPending($DBMemberID,$g_id) == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=3"><img border="0" src="images/add_imagee.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 1  && $g_status == 0 && groupPending($DBMemberID,$g_id) == 1 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=4"><img border="0" src="images/image_waitt.png" title="'.$lang['social']['pending_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 0  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=1"><img border="0" src="images/image_accept.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 2  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/image_invite.png" title="'.$lang['member']['invite_a_group'].'">';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) < $g_points  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/not_points.png" title="'.$lang['member']['points_a_group'].'">';
}
echo'<div class="group_count_small">'.countGroup($g_id).'</div></div></td>';
$three_groups = $three_groups + 1;
			if ($three_groups == 3){
				echo'
				
				</tr>
				<tr>
';
					$three_groups = 0;
			}
			$count += 1;
	  }
	  }
	  }
	  }
		 ++$x;
		 }
		 	$temy = 15;	 
	$sql = DBi::$con->query("SELECT count(*) FROM ".prefix."GROUPS WHERE G_MOD = '2' AND G_STATUS != '1' ORDER BY G_ID DESC") or die (DBi::$con->error);
	$count = mysqli_result($sql, 0, "count(*)");		
	$cols = floor($count/$temy);
	$pg_next = $pg + 1;
	$pg_prev = $pg - 1;
		 echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=social&prm=groups&prd=latest&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($count <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=social&prm=groups&prd=latest&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=social&prm=groups&prd=latest&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table>
	';
			/*
			<td class="box_plaques" valign="top">
<div style="float:right"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=152"><img border="0" src="icon.aspx?u=241~fnideq" onerror="this.src=''.$icon_folder.'';" border="0" height="64" width="86"></a></div>
<div class="div_medals"><font style="font-size:18px;"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=152">رابطة محبّي الرسول صلّى الله عليه وسلّم</a></font><br>
<a href="f.aspx?f=241">الكتب والبرامج الإسلامية</a><br></div>
<div style="float:left"><img border="0" src="icons/q/48/image.png" alt="'.$lang['member']['you_are_member'].'"><div class="group_count_small">7191</div></div></td><td class="box_plaques" valign="top">
<div style="float:right"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=264"><img border="0" src="icon.aspx?u=119~billalstarr" onerror="this.src=''.$icon_folder.'';" border="0" height="64" width="86"></a></div>
			*/
			echo '</tr></tbody></table></tr>';
			
			
			echo'</tbody></div>';
		}
		if($prd == "all"){


	echo'





<tr><td class="contentarea">


</div>	

			</tr>
			
			</tbody></table>
			</center>

<center>
<td class="contentarea"><div class="page_content">
 <table width="100%" border="0" cellspacing="4" cellpadding="0">
 
  <td valign="top" width="240" class="box_forums">
 <div id="ForumCatsBox">


 ';
	$sqla = "SELECT * FROM ".prefix."CATEGORY WHERE SITE_ID = '$Site_ID' OR SITE_ID = '0' ORDER BY CAT_ORDER ASC ";				
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
      while ($x < $numf) {
      $f_cat_id = mysqli_result($sqlf, $x, "CAT_ID");
      $f_cat_level = mysqli_result($sqlf, $x, "CAT_LEVEL");
      $f_cat_hide = mysqli_result($sqlf, $x, "CAT_HIDE");
      $f_cat_name = cat("NAME", $f_cat_id);
	  $check_cat_login = check_cat_login($f_cat_id);
  
  					if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
						
	  echo'
 <a href="index.php?mode=social&prm=groups&prd=all&c='.$f_cat_id.'"><span style="black:red;font-weight:bold;font-size:16px">
 <img border="0" border="0" src="./profile/bullet1.gif"> '.$f_cat_name.'</span></a>
<br> 
 ';
					}
					}
	++$x;
	  }
	  echo'
</div></td>

 	  
	  <td class="box_forums" valign="top">
';
	   if($c == "") {
		   echo'
<div id="ForumDetailBox">

<table cellspacing="2" width="100%">
<tbody>


 ';
 
 

	$sqla = "SELECT * FROM ".prefix."CATEGORY WHERE SITE_ID = '$Site_ID' OR SITE_ID = '0' ORDER BY CAT_ORDER ASC ";				
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
      while ($x < $numf) {
      $f_cat_id = mysqli_result($sqlf, $x, "CAT_ID");
      $f_cat_level = mysqli_result($sqlf, $x, "CAT_LEVEL");
      $f_cat_hide = mysqli_result($sqlf, $x, "CAT_HIDE");
      $f_cat_name = cat("NAME", $f_cat_id);
	  $check_cat_login = check_cat_login($f_cat_id);
  
  					if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
	  
	  echo'
<tr>
<td width="60%" class="forumbox_cat" valign="top" colspan="2">
&nbsp;<b>'.$f_cat_name.'</b>
</td>
<td width="10%" class="forumbox_cat" align="center">'.$lang['social']['num_group'].'</td>
</tr>
 ';
					}
					}
 
	  $sqlaa = "SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$f_cat_id' ORDER BY F_ORDER ";
	$sqlff = DBi::$con->query("".$sqlaa."") or die (DBi::$con->error);
   $numff = mysqli_num_rows($sqlff);
         $i = 0;
		 while ($i < $numff) {
      $f_id = mysqli_result($sqlff, $i, "FORUM_ID");
      $f_subject = mysqli_result($sqlff, $i, "F_SUBJECT");
      $f_status = mysqli_result($sqlff, $i, "F_STATUS");
      $f_desc = mysqli_result($sqlff, $i, "F_DESCRIPTION");
      $f_topics = mysqli_result($sqlff, $i, "F_TOPICS");
      $f_replies = mysqli_result($sqlff, $i, "F_REPLIES");
      $f_last_post_date = mysqli_result($sqlff, $i, "F_LAST_POST_DATE");
      $f_last_post_author = mysqli_result($sqlff, $i, "F_LAST_POST_AUTHOR");
	  	$author_name = members("NAME", $f_last_post_author);
      $f_logo = mysqli_result($sqlff, $i, "F_LOGO");
      $f_order = mysqli_result($sqlff, $i, "F_ORDER");
      $f_level = mysqli_result($sqlff, $i, "F_LEVEL");
      $f_hide = mysqli_result($sqlff, $i, "F_HIDE");
$check_forum_login = check_forum_login($f_id);

  					if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
           if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
							if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){	  
	  echo'
  
<tr><td width="5%" class="forumbox_logo" width="75"><center><img border="0" height="30" src="'.$f_logo.'"></center></td>
 <td width="55%" class="forumbox_f1">
 <a href="index.php?mode=social&prm=groups&prd=forum&f='.$f_id.'">'.$f_subject.'</a>
 <br> <font size="1">'.$f_desc.'</font></td>
 <td width="10%" class="forumbox_f2" valign="middle" align="center">
 ';
 $sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS WHERE G_FORUM = '$f_id'");
 $num = mysqli_num_rows($sql);
 echo $num;
 echo'</td>
';
 echo'</nobr>
 </tr>
 </center>
  
	';
							}
		   }
					}
					}
	  ++$i;
	  }
	   ++$x;
	  }
	  echo'</table></table></div></td>';
	  

 
	 }
	if($c != "") {
		   echo'
<div id="ForumDetailBox">

<table cellspacing="2" width="100%">
<tbody>


 ';
 
 

	$sqla = "SELECT * FROM ".prefix."CATEGORY WHERE CAT_ID = '$c' AND (SITE_ID = '$Site_ID' OR SITE_ID = '0') ORDER BY CAT_ORDER ASC ";				
	$sqlf = DBi::$con->query("".$sqla."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlf);
      $x = 0;
      while ($x < $numf) {
      $f_cat_id = mysqli_result($sqlf, $x, "CAT_ID");
      $f_cat_level = mysqli_result($sqlf, $x, "CAT_LEVEL");
      $f_cat_hide = mysqli_result($sqlf, $x, "CAT_HIDE");
      $f_cat_name = cat("NAME", $f_cat_id);
	  $check_cat_login = check_cat_login($f_cat_id);
  
  					if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
	  
	  echo'
<tr>
<td width="60%" class="forumbox_cat" valign="top" colspan="2">
&nbsp;<b>'.$f_cat_name.'</b>
</td>
<td width="10%" class="forumbox_cat" align="center">'.$lang['social']['num_group'].'</td>
</tr>
 ';
					}
					}
 
	  $sqlaa = "SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$f_cat_id' ORDER BY F_ORDER ";
	$sqlff = DBi::$con->query("".$sqlaa."") or die (DBi::$con->error);
   $numff = mysqli_num_rows($sqlff);
         $i = 0;
		 while ($i < $numff) {
      $f_id = mysqli_result($sqlff, $i, "FORUM_ID");
      $f_subject = mysqli_result($sqlff, $i, "F_SUBJECT");
      $f_status = mysqli_result($sqlff, $i, "F_STATUS");
      $f_desc = mysqli_result($sqlff, $i, "F_DESCRIPTION");
      $f_topics = mysqli_result($sqlff, $i, "F_TOPICS");
      $f_replies = mysqli_result($sqlff, $i, "F_REPLIES");
      $f_last_post_date = mysqli_result($sqlff, $i, "F_LAST_POST_DATE");
      $f_last_post_author = mysqli_result($sqlff, $i, "F_LAST_POST_AUTHOR");
	  	$author_name = members("NAME", $f_last_post_author);
      $f_logo = mysqli_result($sqlff, $i, "F_LOGO");
      $f_order = mysqli_result($sqlff, $i, "F_ORDER");
      $f_level = mysqli_result($sqlff, $i, "F_LEVEL");
      $f_hide = mysqli_result($sqlff, $i, "F_HIDE");
$check_forum_login = check_forum_login($f_id);

  					if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {

					if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
           if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
							if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){	  
	  echo'
  
<tr><td width="5%" class="forumbox_logo" width="75"><center><img border="0" height="30" src="'.$f_logo.'"></center></td>
 <td width="55%" class="forumbox_f1">
 <a href="index.php?mode=social&prm=groups&prd=forum&f='.$f_id.'">'.$f_subject.'</a>
 <br> <font size="1">'.$f_desc.'</font></td>
 <td width="10%" class="forumbox_f2" valign="middle" align="center">
 ';
 $sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS WHERE G_FORUM = '$f_id'");
 $num = mysqli_num_rows($sql);
 echo $num;
 echo'</td>
';
 echo'</nobr>
 </tr>
 </center>
  
	';
							}
		   }
					}
					}
	  ++$i;
	  }
	   ++$x;
	  }
	  echo'</table></table></div></td>';
	  

}


}
		if($prd == "forum"){
			if(!isset($f) || $f == "" || forums("SUBJECT",$f) == ""){
				redirect();
			}					echo '<div class="page_head" style="width:1036px;">'.$lang['social']['groups_to_forum'].' '.forums("SUBJECT",$f).'</div>';
			echo '<div class="page_content"><table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr>';
	$temy = 15;
	$sqlaa13 = "SELECT * FROM ".prefix."GROUPS WHERE G_FORUM = '$f' AND G_MOD = '2' AND G_STATUS != '1' ORDER BY G_ID DESC LIMIT ".pg_limit($temy).", $temy";
	$sqlff13 = DBi::$con->query("".$sqlaa13."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlff13);
      $x = 0;
      while ($x < $numf) {
      $g_id = mysqli_result($sqlff13, $x, "G_ID");
      $g_subject = mysqli_result($sqlff13, $x, "G_NAME");
      $g_img = mysqli_result($sqlff13, $x, "G_IMG");
      $g_desc = mysqli_result($sqlff13, $x, "G_DESC");
      $g_status = mysqli_result($sqlff13, $x, "G_STATUS");				   
      $f = mysqli_result($sqlff13, $x, "G_FORUM");	
      $g_login = mysqli_result($sqlff13, $x, "G_LOGIN");	
      $g_points = mysqli_result($sqlff13, $x, "G_POINTS");
	  $g_c = forums("CAT_ID", $f);
	  $f_cat_level = cat("LEVEL", $g_c);
      $f_cat_hide = cat("HIDE", $g_c);
	  $check_cat_login = check_cat_login($g_c);
      $f_level = forums("F_LEVEL", $f);
      $f_hide = forums("HIDE", $f);
	  $check_forum_login = check_forum_login($f);
	  if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {
  	  if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
      if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
	  if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){		  
			echo'
			
			<td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'">
<img border="0" src="'.$g_img.'" onerror="this.src=\''.$icon_blank.'\';" border="0" height="64" width="86">
</a>
</div>
<div class="div_medals"><font style="font-size:18px;"><a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'">'.$g_subject.'</a></font><br>
<a href="index.php?mode=f&f='.$f.'">'.forums("SUBJECT",$f).'</a><br></div>
<div style="float:left">';
if(groupJoined($DBMemberID,$g_id) == 1){
	echo'<img border="0" src="images/image.png" title="'.$lang['member']['you_are_member'].'">';
}
elseif(groupBanned($DBMemberID,$g_id) == 1){
echo'
<img border="0" src="images/not_points.png" title="'.$lang['social']['cant_join_group'].'">';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && $g_status == 2 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/image_lock.png" title="'.$lang['social']['the_group_locked'].'">';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 1  && $g_status == 0 && groupPending($DBMemberID,$g_id) == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=3"><img border="0" src="images/add_imagee.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 1  && $g_status == 0 && groupPending($DBMemberID,$g_id) == 1 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=4"><img border="0" src="images/image_waitt.png" title="'.$lang['social']['pending_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 0  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$g_id.'&request=1"><img border="0" src="images/image_accept.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) >= $g_points && $g_login == 2  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/image_invite.png" title="'.$lang['member']['invite_a_group'].'">';
}
elseif(groupJoined($DBMemberID,$g_id) == 0 && member_all_points($DBMemberID) < $g_points  && $g_status == 0 && groupBanned($DBMemberID,$g_id) == 0){
	echo'
<img border="0" src="images/not_points.png" title="'.$lang['member']['points_a_group'].'">';
}
echo'<div class="group_count_small">'.countGroup($g_id).'</div></div></td>';
$three_groups = $three_groups + 1;
			if ($three_groups == 3){
				echo'
				
				</tr>
				<tr>
';
					$three_groups = 0;
			}
			$count += 1;
	  }
	  }
	  }
	  }
		 ++$x;
		 }
		 	$temy = 15;	 
	$sql = DBi::$con->query("SELECT count(*) FROM ".prefix."GROUPS WHERE G_MOD = '2' AND G_STATUS != '1'") or die (DBi::$con->error);
	$count = mysqli_result($sql, 0, "count(*)");		
	$cols = floor($count/$temy);
	$pg_next = $pg + 1;
	$pg_prev = $pg - 1;
		 echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=social&prm=groups&prd=forum&f='.$f.'&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($count <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=social&prm=groups&prd=forum&f='.$f.'&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=social&prm=groups&prd=forum&f='.$f.'&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table>
	';
			/*
			<td class="box_plaques" valign="top">
<div style="float:right"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=152"><img border="0" src="icon.aspx?u=241~fnideq" onerror="this.src=''.$icon_folder.'';" border="0" height="64" width="86"></a></div>
<div class="div_medals"><font style="font-size:18px;"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=152">رابطة محبّي الرسول صلّى الله عليه وسلّم</a></font><br>
<a href="f.aspx?f=241">الكتب والبرامج الإسلامية</a><br></div>
<div style="float:left"><img border="0" src="icons/q/48/image.png" alt="'.$lang['member']['you_are_member'].'"><div class="group_count_small">7191</div></div></td><td class="box_plaques" valign="top">
<div style="float:right"><a href="f.aspx?social=0&amp;prm=groups&amp;prd=active&amp;group=264"><img border="0" src="icon.aspx?u=119~billalstarr" onerror="this.src=''.$icon_folder.'';" border="0" height="64" width="86"></a></div>
			*/
			echo '</tr></tbody></table></tr>';
			
			
			echo'</tbody></div>';
		}
		if($prd == "group"){
			if($method != "" && $method != "mem"){
				redirect();
			}
			if(!isset($id) || $id == "" || groupName($id) == ""){
				redirect();
			}
			$commtxt = DBi::$con->real_escape_string(htmlspecialchars($_POST["walltext"]));
			if($method == "" && isset($commtxt) && $commtxt != "" && groupJoined($DBMemberID,$id) == 1){
								$query = "INSERT INTO ".prefix."GROUPS_CHAT (C_TXT, C_MEMBER, C_GROUP) VALUES (";
				$query .= " '$commtxt', ";
				$query .= " '$DBMemberID', ";
				$query .= " '$id'";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
			}
			$request = DBi::$con->real_escape_string(htmlspecialchars($_GET["request"]));
			$leave_group = $lang['social']['leave_group'];
			$enter_group = $lang['social']['enter_group'];
			if(isset($request) && $request != "" && $request == 0 && groupJoined($DBMemberID,$id) == 1){
				DBi::$con->query("UPDATE ".prefix."GROUPS_MEMBERS SET M_STATUS = '6' WHERE M_GROUP = '$id' AND M_ID = '$DBMemberID' ");
				$query = "INSERT INTO ".prefix."GROUPS_TRANS (T_GROUP, T_TXT, T_MEM) VALUES (";
				$query .= " '$id', ";
				$query .= " '$leave_group', ";
				$query .= " '$DBMemberID'";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
				header("Location: ".index()."?mode=social&prm=groups&prd=group&id=".$id."");
			}
			if($request == 1 && groupJoined($DBMemberID,$id) == 0 && groupBanned($DBMemberID,$id) == 0 && groupLogin($id) == 0){
				$group_forum = groupForum($id);
				$date = time();
				$query = "INSERT INTO ".prefix."GROUPS_MEMBERS (M_ID, M_GROUP, M_STATUS, M_FORUM, M_DATE) VALUES (";
				$query .= " '$DBMemberID', ";
				$query .= " '$id', ";
				$query .= " '1', ";
				$query .= " '$group_forum', ";
				$query .= " '$date' ";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
				$query = "INSERT INTO ".prefix."GROUPS_TRANS (T_GROUP, T_TXT, T_MEM) VALUES (";
				$query .= " '$id', ";
				$query .= " '$enter_group', ";
				$query .= " '$DBMemberID'";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
				header("Location: ".index()."?mode=social&prm=groups&prd=group&id=".$id."");
			}
			if($request == 3 && groupJoined($DBMemberID,$id) == 0 && groupBanned($DBMemberID,$id) == 0 && groupPending($DBMemberID,$id) == 0 && groupLogin($id) == 1){
				$group_forum = groupForum($id);
				$date = time();
				$query = "INSERT INTO ".prefix."GROUPS_MEMBERS (M_ID, M_GROUP, M_STATUS, M_FORUM, M_DATE) VALUES (";
				$query .= " '$DBMemberID', ";
				$query .= " '$id', ";
				$query .= " '0', ";
				$query .= " '$group_forum', ";
				$query .= " '$date' ";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
				header("Location: ".index()."?mode=social&prm=groups&prd=group&id=".$id."");

			}
			if($request == 5 && groupJoined($DBMemberID,$id) == 0 && groupBanned($DBMemberID,$id) == 0){
				$group_forum = groupForum($id);
				$date = time();
				$query = "INSERT INTO ".prefix."GROUPS_MEMBERS (M_ID, M_GROUP, M_STATUS, M_FORUM, M_DATE, M_INVITE) VALUES (";
				$query .= " '$DBMemberID', ";
				$query .= " '$id', ";
				$query .= " '1', ";
				$query .= " '$group_forum', ";
				$query .= " '$date', ";
				$query .= " '0' ";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
				$query = "INSERT INTO ".prefix."GROUPS_TRANS (T_GROUP, T_TXT, T_MEM) VALUES (";
				$query .= " '$id', ";
				$query .= " '$enter_group', ";
				$query .= " '$DBMemberID'";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
				header("Location: ".index()."?mode=social&prm=groups&prd=group&id=".$id."");
			}
			if($request == 4 && groupPending($DBMemberID,$id) == 1 && groupBanned($DBMemberID,$id) == 0 && groupPending($DBMemberID,$id) == 1 && groupLogin($id) == 1){
				$group_forum = groupForum($id);
				$date = time();
				$query = "DELETE FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$DBMemberID' AND M_GROUP = '$id'";
				DBi::$con->query($query) or die (DBi::$con->error);
				header("Location: ".index()."?mode=social&prm=groups&prd=group&id=".$id."");
			}	

			if($request == 6 && groupJoined($DBMemberID,$id) == 0 && groupBanned($DBMemberID,$id) == 0){
				$group_forum = groupForum($id);
				$date = time();
				$query = "INSERT INTO ".prefix."GROUPS_MEMBERS (M_ID, M_GROUP, M_STATUS, M_FORUM, M_DATE, M_INVITE) VALUES (";
				$query .= " '$DBMemberID', ";
				$query .= " '$id', ";
				$query .= " '5', ";
				$query .= " '$group_forum', ";
				$query .= " '$date', ";
				$query .= " '0' ";
				$query .= " ) ";
				DBi::$con->query($query) or die (DBi::$con->error);
				header("Location: ".index()."?mode=social&prm=groups&prd=group&id=".$id."");
			}				
		

			
			$delcomment = DBi::$con->real_escape_string(htmlspecialchars($_GET["delcomment"]));
			if(isset($delcomment) && $delcomment != ""){
				$g_f = groupForum($id);
				if(!in_array($g_f,chk_allowed_forums())){
				DBi::$con->query("DELETE FROM ".prefix."GROUPS_CHAT WHERE C_MEMBER = '$DBMemberID' AND C_ID = '$delcomment' ");
				}
				else{
					DBi::$con->query("DELETE FROM ".prefix."GROUPS_CHAT WHERE C_ID = '$delcomment' ");
				}
			}
			echo'<script src="groups.js"></script>';
	$sqlaa13 = "SELECT * FROM ".prefix."GROUPS WHERE G_ID = '$id' AND G_MOD = '2' LIMIT 1";
	$sqlff13 = DBi::$con->query("".$sqlaa13."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlff13);
      $x = 0;
      while ($x < $numf) {
      $gname = mysqli_result($sqlff13, $x, "G_NAME");
      $gurl = mysqli_result($sqlff13, $x, "G_IMG");
      $gfrm = mysqli_result($sqlff13, $x, "G_FORUM");
      $gforum = forums("SUBJECT",$gfrm);
      $gdesc = mysqli_result($sqlff13, $x, "G_DESC");	
      $glogin = mysqli_result($sqlff13, $x, "G_LOGIN");	
      $gpoints = mysqli_result($sqlff13, $x, "G_POINTS");	
      $gstatus = mysqli_result($sqlff13, $x, "G_STATUS");
	  $g_c = forums("CAT_ID", $gfrm);
	  $f_cat_level = cat("LEVEL", $g_c);
      $f_cat_hide = cat("HIDE", $g_c);
	  $check_cat_login = check_cat_login($g_c);
      $f_level = forums("F_LEVEL", $gfrm);
      $f_hide = forums("HIDE", $gfrm);
	  $check_forum_login = check_forum_login($gfrm);	  
	  if ($f_cat_level == 0 OR $f_cat_level > 0 AND $f_cat_level <= $Mlevel) {
  	  if ($f_cat_hide == 0 OR $f_cat_hide == 1 AND $check_cat_login == 1) {
      if ($f_level == 0 OR $f_level > 0 AND $f_level <= $Mlevel){
	  if ($f_hide == 0 OR $f_hide == 1 AND $check_forum_login == 1){	  
			echo'
			</center>
			<div class="page_head" style="width:1036px;">'.$lang['social']['group_details'].' </div>
			
			<div class="page_content">
			<table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr><td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'">
<img border="0" src="'.$gurl.'" onerror="this.src=\''.$icon_blank.'\';" border="0" height="64" width="86">
</a>
</div>
<div class="div_medals">
<font style="font-size:18px;">
<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'">'.$gname.'</a></font><br>
<a href="index.php?mode=f&f='.$gfrm.'">'.$gforum.'</a><br></div>
<div class="group_desc">'.$gdesc.'</div>
<div class="group_count"><font style="font-size:12px;color:white;">'.$lang['add_cat_forum']['members'].':</font><br>'.countGroup($id).'</div>';
if($app != "invite") {
	echo'
<div style="float:left">';
if(groupJoined($DBMemberID,$id) == 1){
	echo'<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&request=0"><img border="0" src="images/image.png" title="'.$lang['member']['you_are_member'].'"></a>';
}
elseif(groupBanned($DBMemberID,$id) == 1){
echo'
<img border="0" src="images/not_points.png" title="'.$lang['social']['cant_join_group'].'">';
}
elseif(groupJoined($DBMemberID,$id) == 0 && $gstatus == 2 && groupBanned($DBMemberID,$id) == 0){
	echo'
<img border="0" src="images/image_lock.png" title="'.$lang['social']['the_group_locked'].'">';
}
elseif(groupJoined($DBMemberID,$id) == 0 && member_all_points($DBMemberID) >= $gpoints && $glogin == 1  && $gstatus == 0 && groupPending($DBMemberID,$id) == 0 && groupBanned($DBMemberID,$id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&request=3"><img border="0" src="images/add_imagee.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$id) == 0 && member_all_points($DBMemberID) >= $gpoints && $glogin == 1  && $gstatus == 0 && groupPending($DBMemberID,$id) == 1 && groupBanned($DBMemberID,$id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&request=4"><img border="0" src="images/image_waitt.png" title="'.$lang['social']['pending_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$id) == 0 && member_all_points($DBMemberID) >= $gpoints && $glogin == 0  && $gstatus == 0 && groupBanned($DBMemberID,$id) == 0 && groupPending($DBMemberID,$id) == 0){
	echo'
<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&request=1"><img border="0" src="images/image_accept.png" title="'.$lang['member']['request_a_group'].'"></a>';
}
elseif(groupJoined($DBMemberID,$id) == 0 && member_all_points($DBMemberID) >= $gpoints && $glogin == 2  && $gstatus == 0 && groupBanned($DBMemberID,$id) == 0){
	echo'
<img border="0" src="images/image_invite.png" title="'.$lang['member']['invite_a_group'].'">';
}
elseif(groupJoined($DBMemberID,$id) == 0 && member_all_points($DBMemberID) < $gpoints  && $gstatus == 0 && groupBanned($DBMemberID,$id) == 0){
	echo'
<img border="0" src="images/not_points.png" title="'.$lang['member']['points_a_group'].'">';
}
echo'</div>';
}
$sql = DBi::$con->query("SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_ID = '$DBMemberID' AND M_INVITE = '1'");
$num = mysqli_num_rows($sql);
$x = 0;
while($x < $num) {
$group_id = mysqli_result($sql, $x, "M_GROUP");	
if($app == "invite" && groupJoined($DBMemberID,$id) == 0 && groupBanned($DBMemberID,$id) == 0 && $m == $DBMemberID && $group_id == $id) {
echo'
<table border="0" width="100%">
<tr>
<td width="100%">
<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&request=5"><img border="0" src="images/image_acceptt.png" title="'.$lang['social']['accept_invite'].'"></a>
&nbsp;&nbsp;
<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&request=6"><img border="0" src="images/delete_image.png" title="'.$lang['social']['refuse_invite'].'"></a>
</td>		
<td width="0%"><img border="0" src="images/image_wait.png" title="'.$lang['social']['request_invite_pending'].'"></td>
</tr>
</table>
';
}
++$x;
}	

if($app == "invite" && $m != $DBMemberID) {
	header("Location: ".index()."?mode=social&prm=groups&prd=group&id=".$id."");
}


echo'</td></tr></tbody></table>
</div>
			';
			
			?>


			<?php
			if($method == ""){
							echo'<table cellspacing="0">
			<tbody><tr>
			<td class="subtab_highlight">
			<a class="treetab" href="index.php?mode=social&prm=groups&prd=group&id='.$id.'">'.$lang['social']['comments_list'].'</a></td>
			<td class="subtab">
			<a class="treetab" href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&method=mem">'.$lang['social']['members_in_group'].'</a>
			</td>';

			echo'</tr></tbody></table>';
				echo'
				<div class="page_content"><table width="100%"><tbody><tr><td class="content_wall" valign="top" width="600">
				<table border="0" cellpadding="0" cellspacing="0"><tbody><tr>
				<td class="head_wall" width="100%">'.$lang['social']['comments_list'].'</td>';
				if(groupJoined($DBMemberID,$id) == 1){
					echo'
				<td class="head_wall" align="left">
				';
				if(mon_OneForum($DBMemberID, $gforum) != 1 && mon_AllForum($DBMemberID) != 1 && mod_OneForum($DBMemberID, $gforum) != 1 && mod_OneForum($DBMemberID, $gforum) != 1 && mod_ShowForum($DBMemberID, $gforum) != 1) {
				echo'
				<a href="javascript:openAddWall();"><img border="0" src="images/add_comment.png" alt="'.$lang['social']['add_comment'].'"></a></td>';				
				} else {
				echo'
				<img border="0" src="images/add_comment.png" alt="'.$lang['social']['cant_add_comment_in_group'].'"></td>';
				}
				}
echo'
				<td class="head_wall" align="center">
				<table border="0" cellpadding="0" cellspacing="0"><tbody><tr>
				
				</body>
</html> 
			</tr>
				</tbody>
				</table></td>
				<td class="head_wall" align="left">
				<img border="0" src="images/business_male_female_users_comments.png">
				</td></tr></tbody></table>
<div class="box_content_wall_ff">
<div id="wall_comment"></div>';
	$sqlaa13 = "SELECT * FROM ".prefix."GROUPS_CHAT WHERE C_GROUP = '$id' ORDER BY C_ID DESC ";
	$sqlff13 = DBi::$con->query("".$sqlaa13."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlff13);
      $x = 0;
      while ($x < $numf) {
      $c_mid = mysqli_result($sqlff13, $x, "C_MEMBER");
      $c_midname = members("NAME", $c_mid);
      $c_time = mysqli_result($sqlff13, $x, "C_TIME");
      $c_txt = mysqli_result($sqlff13, $x, "C_TXT");
      $c_id = mysqli_result($sqlff13, $x, "C_ID");
		echo'
<div style="padding-top:2px;">
<a onmouseover="membertip('.$c_mid.',true)" onmouseout="hideddrivetip()" href="index.php?mode=member&id='.$c_mid.'">'.$c_midname.'</a>&nbsp;-&nbsp;
<span class="text_read_forum">'.normal_time(strtotime($c_time)).'</span>
';
if($c_mid == $DBMemberID || in_array(groupForum($id),chk_allowed_forums())){
	echo'<a href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&delcomment='.$c_id.'"><img border="0" src="images/delete_comment.png" alt="'.$lang['social']['delete'].'"></a>';
}
echo'
<br>
'.smx_replace($c_txt).'
<hr style="border-color:#CCC;margin-right:7px;margin-left:7px;" noshade="" size="1">
</div>';
++$x;
	}
echo'
</div>
</td>
<td class="content_activity" valign="top" width="400">
<table border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="head_activity" width="100%">'.$lang['social']['comments_list_a'].'</td>
<td class="head_wall" align="left"><img border="0" src="images/portfolio.png"></td></tr></tbody></table>
<div class="box_content_wall_ff">
</div>';
	$sqlaa13 = "SELECT * FROM ".prefix."GROUPS_TRANS WHERE T_GROUP = '$id' ORDER BY ID DESC LIMIT 45  ";
	$sqlff13 = DBi::$con->query("".$sqlaa13."") or die (DBi::$con->error);
   $numf = mysqli_num_rows($sqlff13);
      $x = 0;
      while ($x < $numf) {
      $t_time = mysqli_result($sqlff13, $x, "T_TIME");
      $t_mem = mysqli_result($sqlff13, $x, "T_MEM");
      $t_memname = members("NAME",$t_mem);
      $t_txt = mysqli_result($sqlff13, $x, "T_TXT");
echo'
<div style="padding-top:2px;">
<span class="text_read_forum">'.normal_time(strtotime($t_time)).'</span>';
if($t_txt == $lang['social']['enter_group']){
	echo'
&nbsp;<img border="0" src="images/green_arrow_down.png">';
}
else{
		echo'
&nbsp;<img border="0" src="images/orange_arrow_up.png">';
}
echo'
&nbsp;<a onmouseover="membertip('.$t_mem.',true)" onmouseout="hideddrivetip()" href="index.php?mode=member&id='.$t_mem.'">'.$t_memname.'</a>
&nbsp;<font color="gray">'.$t_txt.'</font></div>';

	++$x;
	}
echo'
</td></tr></tbody></table></div></table>
				';
			}
			if($method == "mem"){
							echo'<table cellspacing="0">
			<tbody><tr>
			<td class="subtab">
			<a class="treetab" href="index.php?mode=social&prm=groups&prd=group&id='.$id.'">'.$lang['social']['comments_list'].'</a></td>
			<td class="subtab_highlight">
			<a class="treetab" href="index.php?mode=social&prm=groups&prd=group&id='.$id.'&method=mem">'.$lang['social']['members_in_group'].'</a>
			</td></tr></tbody></table>';
				if(!isset($pg) || $pg == ""){
					$pg = 1;
				}
				echo'<form name="ProfilePageNum"><div class="page_content"><table width="100%">
				<tbody><tr><td valign="top"><table width="100%">
				<tbody><tr>
				<input name="group" value="'.$id.'" type="hidden">';
if($pg > 0) {
$pg1 = ($pg-1)*24;
$pg2 = $pg*24;
} else {
$pg1 = 0;
$pg2 = 24;	
}
	$sqlaa13 = "SELECT * FROM ".prefix."GROUPS_MEMBERS WHERE M_GROUP = '$id' AND M_STATUS = '1' LIMIT $pg1,$pg2";
	$sqlff13 = DBi::$con->query("".$sqlaa13."") or die (DBi::$con->error);
	$sqlfa = mysqli_num_rows($sqlff13);
	$sqlfaa = floor($sqlfa/24);
	if($sqlfa > 24){
		echo'<td align="center" width="100%"><select class="submit" name="prp" size="1" onchange="ChangeProfilePage()">';
	for($x = 1; $x <= $sqlfaa; $x++){
		echo'
		<option value="'.$x.' '.check_select($pg, $x).'">'.$lang['forum']['page'].' '.$x.' '.$lang['forum']['from'].' '.$sqlfa.'</option>';
	}
	$pgg = $pg+1;
				echo'</select>
				</td>';
	}
				if($sqlfa > 24){
				echo'<td align="left"><span class="next_page">
				<a href="index.php?mode=social&prm=groups&prd=group&id=2&method=mem&pg='.$pgg.'">
				<nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
				}
				echo'</tr></tbody></table>
				<table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr>';
	$i=0;
		  $xx = 0;
      while ($xx < $sqlfa) {
		  $i++;
      $memid = mysqli_result($sqlff13, $xx, "M_ID");
      $memname = members("NAME",$memid);
      $memimg = members("PHOTO_URL",$memid);	
      $memsex = members("SEX",$memid);
	if($memsex == 0 or $memsex = 1) {
	$theimg = "mal_u";
	}
	if($memsex == 2) {
	$theimg = "fem_u";	
	}
	echo'
	<td class="box_plaques" align="center" valign="top">
	<a onmouseover="membertip('.$memid.',false)" onmouseout="hideddrivetip()" href="index.php?mode=member&id='.$memid.'">
	<img border="0" src="'.$memimg.'" onerror="this.src=\'profile/'.$theimg.'.png\';" border="0" height="64" width="86">
	<br>'.$memname.'</a></td>';
	
	if($i == 4 || $i == 8 || $i == 14 || $i == 18 || $i == 24){
		echo "</tr> <tr>";
	}
	++$xx;
	}
echo'</tbody></table></td></tr></tbody></table></div></td>
	</tr>
	</tbody>
	</table>
	</table>';
			}
	  } else {
		 go_to("index.php?mode=social"); 
	  }
	  } else {
		 go_to("index.php?mode=social"); 
	  }
	  } else {
		 go_to("index.php?mode=social"); 
	  }
	  } else {
		 go_to("index.php?mode=social"); 
	  }
			++$x;
	}
	
		}
		}
		
if($active_market == 1) {
	
if($prm == "market") {
	
if($market == "") {	
	
	$temy = 15;
	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."ADMIN_MARKET ORDER BY STATUS DESC LIMIT ".pg_limit($temy).", $temy ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$sqll = DBi::$con->query("SELECT COUNT(*) FROM ".prefix."ADMIN_MARKET ") or die(DBi::$con->error);
	$sqlll = mysqli_result($sqll, 0, "COUNT(*)");
	$cols = floor($sqlll / $temy);
	$pg_prev = $pg - 1;
	$pg_next = $pg + 1;

	
	
echo'
<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet2.gif">
	<span style="color:#ff0000;font-weight:bold;font-size:18px"> '.$lang['member']['market'].'</span>
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br>

<td class="subtab_highlight"><a class="treetab" href="index.php?mode=social&prm=market">'.$lang['member']['market'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=social&prm=sales">'.$lang['member']['your_sales'].'</a></td>


</tr>
</tbody>
</table>

			</tr></tbody></table>';
			
			if ($num > 0){
echo'

<center> <table width="74%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="70%" class="contentarea">
<center><div class="page____head">
					'.$lang['member']['market'].'</div></center>

<table width="88.5%" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td class="contentarea"><div class="page_contenttt">

<table width="100%" border="0" cellpadding="0" cellspacing="4" style="border-color:white;"><tbody><tr>
';
		$count = 0;
		$x = 0;
		while($x < $num){
			$id = mysqli_result($sql, $x, "ID");
			$name = admin_market("NAME", $id);
			$description = admin_market("DESCRIPTION", $id);
			$desc = strip_tags(cutstr($description, 40));
			$img = admin_market("IMG", $id);
			$author = admin_market("AUTHOR", $id);
			$date = admin_market("DATE", $id);
			$customer = admin_market("CUSTOMER", $id);
			$customer_number = admin_market("CUSTOMER_NUMBER", $id);
			$status = admin_market("STATUS", $id);
			$buy_date = admin_market("BUY_DATE", $id);
			$dollar = admin_market("DOLLAR", $id);
			$type = admin_market("TYPE", $id);	
			$medal_id = admin_market("MEDAL_ID", $id);				
			$medal = gm("URL", $medal_id);	
			$medal_days = gm("DAYS", $medal_id);	
			$points = gm("POINTS", $medal_id);	
			$special_points_id = admin_market("SPECIAL_POINTS_ID", $id);
			$special_points = gm("POINTS", $special_points_id);				
			$count_buyers = DBi::$con->query("SELECT * FROM ".prefix."ADMIN_MARKET_BUYERS WHERE SALE_ID = '$id'");
			$num_count_buyers = mysqli_num_rows($count_buyers);
			

			
			
echo'
						<td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=social&prm=market&market='.$id.'">
<img border="0" src="'.$img.'" onerror="this.src=\''.$icon_blank.'\';" border="0" height="64" width="86">
</a>
</div>
<div class="div_medals"><font style="font-size:18px;"><a href="index.php?mode=social&prm=market&market='.$id.'">'.$name.'</a></font><br>
'.$desc.'<br><span class="span_medals"> '.normal_time($date).'</span><br>'.$lang['member']['sell_dollar'].' <font color="red">'.$dollar.'</font> '.$dollar_cur.'</div>
<div style="float:left">';
	if($M_Dollar >= $dollar && ($num_count_buyers < $customer_number)) {
	echo'<a href="index.php?mode=social&prm=market&market='.$id.'&request=1"><img border="0" src="images/buy.png" title="'.$lang['member']['buy_sell'].'"></a>';
	}
	if($M_Dollar < $dollar && ($num_count_buyers < $customer_number)) {
	echo'<img border="0" src="images/no_buy.png" title="'.$lang['member']['cant_buy_sell'].'">';
	}
	if(($num_count_buyers == $customer_number && $customer != 0) AND $status == 0) {
	echo'<img border="0" src="images/done_buy.png" title="'.$lang['social']['done_bought_this_sell'].'">';
	}
echo'</div></td>';

$three = $three + 1;
			if ($three == 3){
				echo'
				
				</tr>
				<tr>
';
					$three = 0;
			}
			$count += 1;
		++$x;
	}
echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($sqlll <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=member&id='.$ProMemberID.'&prm=market&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table></td>
	</tr>
	</tbody>
	</table>
	</table>
	';


	

	} else {
		echo'
		 <center> <table width="83.2%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="86%" class="contentarea">
<center><div class="page____head">
					'.$lang['member']['market'].'</div></center>
<center>

<div class="page_contenttt">
	<center>
<center>'.$lang['member']['no_this_here'].'</center>
</center></div></center>
</td></tr></tbody></table></div>

</font>
		';
	}
	

	
	
	
	echo'
</center></html>
';
	
}

 
 
 if($market != "") {
	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."ADMIN_MARKET WHERE ID = '$market' ORDER BY DATE DESC LIMIT 1") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	
	
echo'
<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet2.gif">
	<span style="color:#ff0000;font-weight:bold;font-size:18px"> '.$lang['member']['market'].'</span>
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br>

<td class="subtab_highlight"><a class="treetab" href="index.php?mode=social&prm=market">'.$lang['member']['market'].'</a></td>
<td class="subtab"><a class="treetab" href="index.php?mode=social&prm=sales">'.$lang['member']['your_sales'].'</a></td>


</tr>
</tbody>
</table>

			</tr></tbody></table>';
			
		$x = 0;
		while($x < $num){
			$id = mysqli_result($sql, $x, "ID");
			$name = admin_market("NAME", $id);
			$description = admin_market("DESCRIPTION", $id);
			$desc = strip_tags(cutstr($description, 40));
			$img = admin_market("IMG", $id);
			$author = admin_market("AUTHOR", $id);
			$date = admin_market("DATE", $id);
			$customer = admin_market("CUSTOMER", $id);
			$customer_number = admin_market("CUSTOMER_NUMBER", $id);
			$status = admin_market("STATUS", $id);
			$buy_date = admin_market("BUY_DATE", $id);
			$dollar = admin_market("DOLLAR", $id);
			$type = admin_market("TYPE", $id);	
			$medal_id = admin_market("MEDAL_ID", $id);				
			$medal = gm("URL", $medal_id);	
			$medal_days = gm("DAYS", $medal_id);	
			$points = gm("POINTS", $medal_id);	
			$special_points_id = admin_market("SPECIAL_POINTS_ID", $id);
			$special_points = gm("POINTS", $special_points_id);				
			$num_customer = $customer_number - $customer;			
			$count_buyers = DBi::$con->query("SELECT * FROM ".prefix."ADMIN_MARKET_BUYERS WHERE SALE_ID = '$id'");
			$num_count_buyers = mysqli_num_rows($count_buyers);
			
			$request = DBi::$con->real_escape_string(htmlspecialchars($_GET["request"]));
			if($type == 1) {
			$medal_photo = '<img border="0" src="'.$medal.'">';
			$buy_text = "".$medal_photo." + ".$points." ".$lang['social']['desc_sell_forum']." ".$medal_days." ".$lang['admin']['block_1']."";
			}
			if($type == 2) {
			$buy_text = "".$special_points." ".$lang['social']['sell_special_points']."";
			}
			if($request == 1 && ($num_count_buyers < $customer_number) && $status == 1 && $M_Dollar >= $dollar){
				$date = time();
				DBi::$con->query("UPDATE ".prefix."ADMIN_MARKET SET CUSTOMER = CUSTOMER + 1 WHERE ID = '$id' ");
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_DOLLAR = M_DOLLAR - $dollar WHERE MEMBER_ID = '$DBMemberID' ");
				$InsertSale = "INSERT INTO ".$Prefix."ADMIN_MARKET_BUYERS (ID, SALE_ID, MEMBER_ID) VALUES (NULL, ";
				$InsertSale .= " '$id', ";
				$InsertSale .= " '$DBMemberID') ";
				@DBi::$con->query($InsertSale, $connection) or die (DBi::$con->error);
				$subject = ''.$lang['member']['sale_sell'].' '.$name.'';
				$message = ''.$lang['members']['members'].': '.link_profile(member_name($DBMemberID), $DBMemberID).'<br><br>'.$lang['member']['sell_message_part1'].' '.$name.' '.$lang['social']['from_forum_sell'].'<br><br>'.$lang['admin']['sell_sell'].':<br><br>'.$buy_text.'<br><br>'.$lang['social']['sell_forum_market_desc'].'';
				$sendPm = "INSERT INTO ".$Prefix."PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
				$sendPm .= " '1', ";
				$sendPm .= " '$DBMemberID', ";
				$sendPm .= " '1', ";
				$sendPm .= " '0', ";
				$sendPm .= " '$subject', ";
				$sendPm .= " '$message', ";
				$sendPm .= " '$date') ";
				@DBi::$con->query($sendPm, $connection) or die (DBi::$con->error);
				/// أوسمة عامة ///
				if($type == 1) {
				$sql = "INSERT INTO ".prefix."MEDALS (MEDAL_ID, GM_ID, MEMBER_ID, FORUM_ID, STATUS, ADDED, DAYS, POINTS, URL, SPECIAL, SPECIAL_TYPE, DATE) VALUES (NULL, ";
				$sql .= " '$medal_id', ";
				$sql .= " '$DBMemberID', ";
				$sql .= " '0', ";
				$sql .= " '1', ";
				$sql .= " '1', ";
				$sql .= " '$medal_days', ";
				$sql .= " '$points', ";
				$sql .= " '$medal', ";
				$sql .= " '1', ";
				$sql .= " '1', ";
				$sql .= " '".time()."') ";
				DBi::$con->query($sql) or die (DBi::$con->error);
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_MEDAL = '".chk_member_last_medal($DBMemberID)."', M_POINTS = '".member_all_points($DBMemberID)."' WHERE MEMBER_ID = '$DBMemberID' ") or die (DBi::$con->error);				
				}
				/// نقاط تميز خاصة ///
				if($type == 2) {
				$sql = "INSERT INTO ".prefix."MEDALS (MEDAL_ID, GM_ID, MEMBER_ID, FORUM_ID, STATUS, ADDED, DAYS, POINTS, URL, SPECIAL, SPECIAL_TYPE, DATE) VALUES (NULL, ";
				$sql .= " '$special_points_id', ";
				$sql .= " '$DBMemberID', ";
				$sql .= " '0', ";
				$sql .= " '1', ";
				$sql .= " '1', ";
				$sql .= " '0', ";
				$sql .= " '$special_points', ";
				$sql .= " NULL, ";
				$sql .= " '1', ";
				$sql .= " '2', ";
				$sql .= " '".time()."') ";
				DBi::$con->query($sql) or die (DBi::$con->error);
				DBi::$con->query("UPDATE ".prefix."MEMBERS SET M_SPECIAL_POINTS = '".member_all_special_points($DBMemberID)."' WHERE MEMBER_ID = '$DBMemberID' ") or die (DBi::$con->error);				
				}
				$count = DBi::$con->query("SELECT * FROM ".prefix."ADMIN_MARKET_BUYERS WHERE SALE_ID = '$id'");
				$num_count = mysqli_num_rows($count);				
				if($num_count == $customer_number) {
				DBi::$con->query("UPDATE ".prefix."ADMIN_MARKET SET STATUS = '0' WHERE ID = '$id' ");
				
				}				
				echo'<meta http-equiv="Refresh" content="0; URL=index.php?mode=social&prm=market&market='.$id.'">';
			} 
			

	echo'
	
	
				<div class="page____head">'.$lang['member']['sell_about'].' '.$name.'</div>
			
			<div class="page_contenttt">
			<table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr><td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=social&prm=market&market='.$id.'">
<img border="0" src="'.$img.'" onerror="this.src=\''.$icon_blank.'\';" border="0" height="100" width="100">
</a>
</div>
<div class="div_medals">
<font style="font-size:18px;">
<a href="index.php?mode=social&prm=market&market='.$id.'">'.$name.'</a></font><br>
</div>
<div class="group_desc">'.$desc.'</div>
';
echo'
<div style="float:left">';
	if($M_Dollar >= $dollar && ($num_count_buyers < $customer_number)) {
	echo'<a href="index.php?mode=social&prm=market&market='.$id.'&request=1"><img border="0" src="images/buy.png" title="'.$lang['member']['buy_sell'].'"></a>';
	}
	if($M_Dollar < $dollar && ($num_count_buyers < $customer_number)) {
	echo'<img border="0" src="images/no_buy.png" title="'.$lang['member']['cant_buy_sell'].'">';
	}
	if(($num_count_buyers == $customer_number && $customer != 0) AND $status == 0) {
	echo'<img border="0" src="images/done_buy.png" title="'.$lang['social']['done_bought_this_sell'].'">';
	}
echo'</div>';

++$x;
		}

echo'</td></tr></tbody></table>

<table style="border-color:white;" border="0" cellpadding="0" cellspacing="4" width="100%"><tbody><tr><td class="box_plaques" valign="top">
<div style="float:right">
</a>
</div>

<div class="sell_desc">
<font color="black" size="4">'.$lang['admin']['sell_name'].':</font> <font color="blue" size="4">'.$name.'</font><br><br>
<font color="black" size="4">'.$lang['admin']['sell_description'].':</font> <font color="blue" size="4">'.$description.'</font><br><br>
<font color="black" size="4">'.$lang['admin']['sell_photo'].':</font> <font color="blue" size="4"><img border="0" src="'.$img.'"></font><br><br>
<font color="black" size="4">'.$lang['admin']['sell_date'].':</font> <font color="blue" size="4">'.normal_time($date).'</font><br><br>';
if($status == 1) {
	echo'
<font color="black" size="4">'.$lang['admin']['sell_status'].':</font> <font color="green" size="4">'.$lang['admin']['for_sale'].'</font><br><br>
';
}
if($status == 0) {
	echo'
<font color="black" size="4">'.$lang['admin']['sell_status'].':</font> <font color="red" size="4">'.$lang['admin']['sold'].'</font><br><br>
';}
echo'<font color="black" size="4">'.$lang['admin']['sell_dollar'].':</font> <font color="red" size="4">'.$dollar.' '.$dollar_cur.'</font><br><br>';
echo'<font color="black" size="4">'.$lang['social']['member_number_customer'].': '.$customer_number.'</font><br><br>';

if($M_Dollar >= $dollar && ($num_count_buyers < $customer_number or $customer == 0)) {
echo'<font color="red" size="4">'.$lang['member']['sell_description'].'</font><br><br>';
echo'<font color="black" size="4">'.$lang['social']['this_back'].' '.$num_customer.' '.$lang['social']['members_can_sell'].'</font><br><br>';
}
if(($num_count_buyers == $customer_number && $customer != 0) AND $status == 0) {
echo'<font color="red" size="4">'.$lang['social']['done_bought_this_sell'].'</font><br><br>';
}
if($M_Dollar < $dollar && ($num_count_buyers < $customer_number or $customer == 0)) {
echo'<font color="red" size="4">'.$lang['member']['cant_buy_sell'].'</font><br><br>';
}
			if($type == 1) {
			$medal_photo = '<img border="0" src="'.$medal.'">';
			$buy_text = "".$medal_photo." + ".$points." ".$lang['social']['desc_sell_forum']." ".$medal_days." ".$lang['admin']['block_1']."";
			}
			if($type == 2) {
			$buy_text = "".$special_points." ".$lang['social']['sell_special_points']."";
			}
echo'<font color="black" size="4">'.$lang['admin']['sell_sell'].': '.$buy_text.'</font>
</div>
</td></tr></tbody></table>

</div>
			';
		

	
	
	
	echo'
</center></html>
';	
 }
 }

 

if($prm == "sales") {

$temy = 15;
	$sql = DBi::$con->query("SELECT * FROM ".$Prefix."ADMIN_MARKET_BUYERS WHERE MEMBER_ID = '$DBMemberID' ORDER BY SALE_ID DESC LIMIT ".pg_limit($temy).", $temy ") or die(DBi::$con->error);
	$num = mysqli_num_rows($sql);
	$sqll = DBi::$con->query("SELECT COUNT(*) FROM ".prefix."ADMIN_MARKET_BUYERS WHERE MEMBER_ID = '$DBMemberID' ") or die(DBi::$con->error);
	$sqlll = mysqli_result($sqll, 0, "COUNT(*)");
	$cols = floor($sqlll / $temy);
	$pg_prev = $pg - 1;
	$pg_next = $pg + 1;

	
	
echo'
<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet2.gif">
	<span style="color:#ff0000;font-weight:bold;font-size:18px"> '.$lang['member']['market'].'</span>
</div></td></tr>

<tr><td class="contentarea">
<table cellspacing="0"><tbody><tr><br>

<td class="subtab"><a class="treetab" href="index.php?mode=social&prm=market">'.$lang['member']['market'].'</a></td>
<td class="subtab_highlight"><a class="treetab" href="index.php?mode=social&prm=sales">'.$lang['member']['your_sales'].'</a></td>


</tr>
</tbody>
</table>

			</tr></tbody></table>';
			
			if ($num > 0){
echo'

<center> <table width="74%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="70%" class="contentarea">
<center><div class="page____head">
					'.$lang['member']['your_sales'].'</div></center>

<table width="88.5%" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td class="contentarea"><div class="page_contenttt">

<table width="100%" border="0" cellpadding="0" cellspacing="4" style="border-color:white;"><tbody><tr>
';
		$count = 0;
		$x = 0;
		while($x < $num){
			$id = mysqli_result($sql, $x, "SALE_ID");
			$name = admin_market("NAME", $id);
			$description = admin_market("DESCRIPTION", $id);
			$desc = strip_tags(cutstr($description, 40));
			$img = admin_market("IMG", $id);
			$author = admin_market("AUTHOR", $id);
			$date = admin_market("DATE", $id);
			$customer = admin_market("CUSTOMER", $id);
			$status = admin_market("STATUS", $id);
			$buy_date = admin_market("BUY_DATE", $id);
			$dollar = admin_market("DOLLAR", $id);
			$buy_text = admin_market("BUY_TEXT", $id);	

			
			
echo'
						<td class="box_plaques" valign="top">
<div style="float:right">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">
<img border="0" src="'.$img.'" onerror="this.src=\''.$icon_blank.'\';" border="0" height="64" width="86">
</a>
</div>
<div class="div_medals"><font style="font-size:18px;"><a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&market='.$id.'">'.$name.'</a></font><br>
'.$desc.'<br><span class="span_medals"> '.normal_time($date).'</span><br>'.$lang['member']['sell_dollar'].' <font color="red">'.$dollar.'</font> '.$dollar_cur.'</div>
<div style="float:left">';
	echo'<img border="0" src="images/done_buy.png" title="'.$lang['member']['this_sell_bought_to_you'].'">';
	
echo'</div></td>';

$three = $three + 1;
			if ($three == 3){
				echo'
				
				</tr>
				<tr>
';
					$three = 0;
			}
			$count += 1;
		++$x;
	}
echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($sqlll <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=member&id='.$ProMemberID.'&prm=market&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=member&id='.$ProMemberID.'&prm=market&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table></td>
	</tr>
	</tbody>
	</table>
	</table>
	';


	

	} else {
		echo'
		 <center> <table width="83.2%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="86%" class="contentarea">
<center><div class="page____head">
					'.$lang['member']['your_sales'].'</div></center>
<center>

<div class="page_contenttt">
	<center>
<center>'.$lang['member']['no_this_here'].'</center>
</center></div></center>
</td></tr></tbody></table></div>

</font>
		';
	}
	

	
	
	
	echo'
</center></html>
';

}

}

if($active_portal == 1) {
	
if($prm == "portal") {
	
	
	
	$temy = 15;
	$sql = DBi::$con->query("SELECT * FROM ".prefix."TOPICS AS T INNER JOIN ".prefix."FORUM AS F ON (T.FORUM_ID = F.FORUM_ID) WHERE T.T_STATUS != '2' AND T.T_ARCHIVED = '0' AND T.T_HIDDEN = '0' and T.T_UNMODERATED = '0' and T.T_HOLDED = '0' and ((T.T_TOP = '1' OR T.T_TOP = '2') OR (T.T_SOCIAL = '2')) and F.F_LEVEL = '0' AND F.F_HIDE = '0' ORDER BY T.T_DATE DESC LIMIT ".pg_limit($temy).", $temy ") or die(DBi::$con->error);	
	$num = mysqli_num_rows($sql);
	$sqll = DBi::$con->query("SELECT COUNT(*) FROM ".prefix."TOPICS AS T INNER JOIN ".prefix."FORUM AS F ON (T.FORUM_ID = F.FORUM_ID) WHERE T.T_STATUS != '2' AND T.T_ARCHIVED = '0' AND T.T_HIDDEN = '0' and T.T_UNMODERATED = '0' and T.T_HOLDED = '0' and ((T.T_TOP = '1' OR T.T_TOP = '2') OR (T.T_SOCIAL = '2')) and F.F_LEVEL = '0' AND F.F_HIDE = '0' ORDER BY T.T_DATE LIMIT ".pg_limit($temy).", $temy ") or die(DBi::$con->error);	
	$sqlll = mysqli_result($sqll, 0, "COUNT(*)");
	$cols = floor($sqlll / $temy);
	$pg_prev = $pg - 1;
	$pg_next = $pg + 1;

	
echo'
<html>

<tr><td class="breadcrumbsarea">
<div id="breadcrums">';
echo'
	<br><span style="color:#0f4754;font-weight:bold;font-size:20px">'.$lang['admin']['home'].'</span> <img border="0" src="./profile/bullet2.gif">
	<span style="color:#ff0000;font-weight:bold;font-size:18px"> '.$lang['member']['portal'].'</span>
</div></td></tr>

<tr><td class="contentarea">
<br>

			</tr></tbody></table>';
			
			if ($num > 0){
echo'

<center> <table width="74%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="70%" class="contentarea">
<center><div class="page_head_portal">
					'.$lang['member']['portal'].'</div></center>

<table width="88.5%" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td class="contentarea"><div class="page_content_portal">

<table width="100%" border="0" cellpadding="0" cellspacing="4" style="border-color:white;"><tbody><tr>
';
		$count = 0;
		$x = 0;
      while ($x < $num) {
      $topic_id = mysqli_result($sql, $x, "TOPIC_ID");
      $name = mysqli_result($sql, $x, "T_SUBJECT");
      $message = mysqli_result($sql, $x, "T_MESSAGE");
	  $message = str_replace("<br>", "&nbsp;", $message);
      $forum_id = mysqli_result($sql, $x, "FORUM_ID");
	  $forum_name = forums("SUBJECT", $forum_id);
      $date = mysqli_result($sql, $x, "T_DATE");
      $img = mysqli_result($sql, $x, "T_IMG");
      $desc = mysqli_result($sql, $x, "T_DESC");
      $counts = mysqli_result($sql, $x, "T_COUNTS");
	  $f_level = forums("F_LEVEL", $forum_id);
	  $f_hide = forums("HIDE", $forum_id);
	  $check_forum_login = check_forum_login($forum_id);
	  $cat_id = forums("CAT_ID", $forum_id);
	  $c_level = cat("LEVEL", $cat_id);
	  $c_hide = cat("HIDE", $cat_id);
	  $check_cat_login = check_cat_login($cat_id);
	
	if($img == "") {
	$img_src = "profile/portal_none.png";	
	} else {
	$img_src = $img;
	}
	if($desc == "") {
	$desc_name = $name;
	} else {
	$desc_name = $desc;
	}
	$img_error = "profile/portal_none.png";

			
echo'
<div id="topic">
<a href="index.php?mode=t&t='.$topic_id.'&type=redirect"><h1>'.$name.'</h1></a>
<a href="index.php?mode=t&t='.$topic_id.'&type=redirect" target="_blank"><div class="img"><img border="0" border="0" width="250" height="200" src="'.$img_src.'" onerror="this.src=\''.$img_error.'\';"></div></a>
<p>'.$desc_name.'</p>
<div class="url"><a href="index.php?mode=t&t='.$topic_id.'&type=redirect" title="'.$name.'"><b>'.$forum_name.'</b> - '.$lang['social']['downloaded'].' '.$counts.' '.$lang['social']['times'].'</a></div>
</div>
</center>';


$three = $three + 1;
			if ($three == 3){
				echo'
				
				</tr>
				<tr>
';
					$three = 0;
			}
			$count += 1;
		++$x;
	}
echo'
						<table border="0" width="100%">
							<tr>';
					if($pg != 0 AND $pg != 1) {
						echo'
								<td><span align="left" class="prev_page">
<a href="index.php?mode=social&prm=portal&pg='.$pg_prev.'"><nobr>&lt; '.$lang['member']['back_page'].'</nobr></a>
</span></td>';
} else {
	echo'
<td width="46.2%"></td>		
	';
}
if ($sqlll <= $temy) {
echo'
<td></td>';
} else {
echo'<td width="5%">
		
		<select style="WIDTH: 100px" size="1" onchange="window.location = \'index.php?mode=social&prm=portal&pg=\'+this.options[this.selectedIndex].value;">
		';
		for($i = 1; $i <= $cols; $i++){
			echo'
			<option value="'.$i.'" '.check_select($pg, $i).'>'.$i.' '.$lang['forum']['from'].' '.$cols.'</option>';
		}
		echo'
		</select>
		

</td>';
}
	if($pg == "" or $pg == 1) {
		$pg = 0;
	}
	if($pg != $cols) {
echo'
			<td><span class="next_page">
<a href="index.php?mode=social&prm=portal&pg='.$pg_next.'"><nobr>'.$lang['member']['next_page'].' &gt;</nobr></a></span></td>';
	} else {
		echo'
<td width="43.6%"></td>		
		
		';
	}
	echo'
					</tr>
				</table></td>
	</tr>
	</tbody>
	</table>
	</table>
	';
					} else {
		echo'
		 <center> <table width="83.2%" border="0" cellspacing="0" cellpadding="0" ><tbody>
<tr><td width="86%" class="contentarea">
<center><div class="page____head">
					'.$lang['member']['portal'].'</div></center>
<center>

<div class="page_contenttt">
	<center>
<center>'.$lang['member']['no_this_here'].'</center>
</center></div></center>
</td></tr></tbody></table></div>

</font>
		';
	}

		


}


}


?>