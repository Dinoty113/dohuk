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
@require_once("./engine/function.php");
@require_once("./engine/engine_requires.php");
@require_once("./engine/seo.php");
@require_once("./language/".$choose_language.".php");

$domain = Get_deric();
$xml = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" dir="'.$lang['global']['dir'].'" xml:lang="ar" lang="ar">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta http-equiv="Content-Language" content="en" />
			<meta name="description" content="" />
			<link rel="shortcut icon" href="favicon.ico" />
         	<title>HTML Sitemap</title>
			</head>
             <body>
             <ol>
           <li><a title="'.$forum_title.'" target="_blank" href="'.$domain.'">'.$forum_title.'</a><br />
            <font color="#008000" size="-1">'.$site_name.'</font><br />
            '.$Meta.'<hr></hr></li>';
$c_sql = DBi::$con->query("SELECT * FROM ".prefix."CATEGORY WHERE CAT_HIDE = '0' AND CAT_LEVEL = '0'");
while($rs_c_sql = mysqli_fetch_array($c_sql)) {
$cat = $rs_c_sql['CAT_ID'];	
			$f_sql = DBi::$con->query("SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$cat' AND F_HIDE = '0' AND F_LEVEL = '0' ORDER BY F_ORDER ASC ");
  while($rs_f_sql = mysqli_fetch_array($f_sql)){ 
 $forum = $rs_f_sql['FORUM_ID']; 
    $xml .= '<li>
           <a title="" target="_blank" href="">'.forums("SUBJECT", $forum).'</a><br />
			<font color="#008000" size="-1">'.$domain.''.index().'?mode=f&f='.$forum.'</font><br />
			<hr></hr></li>'; 
$t_sql = DBi::$con->query("SELECT * FROM ".prefix."TOPICS WHERE FORUM_ID = '$forum' AND T_HIDDEN = '0' AND T_UNMODERATED = '0' AND T_HOLDED = '0' AND T_STATUS != '2' ORDER BY T_DATE DESC");
    while($rs_t_sql = mysqli_fetch_array($t_sql)){ 
 $topic = $rs_t_sql['TOPIC_ID'];;	
    $xml .= '<li>
           <a title="" target="_blank" href="">'.topics("SUBJECT", $topic).'</a><br />
			<font color="#008000" size="-1">'.$domain.''.index().'?mode=t&t='.$topic.'</font><br />
			<hr></hr></li>';
    } 
} 
}

$xml .= '
			
		
		</ol>

		</body>
		</html>';
		
		echo $xml;
?>
