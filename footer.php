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

if($seo == 0) {
$xml = "sitemap.php";	
}
if($seo == 1) {
$xml = "sitemap.xml";	
}
if($seo == 0) {
$html = "sitemap_html.php";	
}
if($seo == 1) {
$html = "sitemap.html";	
}
if($seo == 0) {
$txt = "urllist.php";	
}
if($seo == 1) {
$txt = "urllist.txt";	
}

				error_reporting(0);
$the_time = microtime();
$the_time = explode(" ",$the_time);
$the_time = $the_time[1] + $the_time[0];
$dèbut_time = $the_time;
$the_time = microtime();
$the_time = explode(" ",$the_time);
$the_time = $the_time[3] + $the_time[1];
$fin_time = $the_time;
$save_time = ($fin_time - $dèbut_time);

 require_once("adsense.php");
 if(mode != "editor" AND mode != "post_info" AND mode != "p") {
 adsense_3();


$this_code = code_run_forum($forum_title, $site_name, $copy_right);
if(mode == "member") {
if (members("LEVEL", $id) > 1) {
	echo'
<link rel="stylesheet" type="text/css" href="./profile/devo.css">';
}
elseif (members("LEVEL", $id) == 1 && members("OLD_MOD", $id) == 2) {
	echo'
<link rel="stylesheet" type="text/css" href="./profile/devo.css">';
}
elseif(members("LEVEL", $id) == 1 && ($Site_ID == 1 AND $Site_After == 2)){
		echo'
<link rel="stylesheet" type="text/css" href="./profile/temy.css">';
}
elseif(members("LEVEL", $id) == 1 && ($Site_ID == 2 AND $Site_After == 1)){
		echo'
<link rel="stylesheet" type="text/css" href="./profile/temy_1.css">';
}
}
if(mode == "social") {
if($Site_ID == 1 AND $Site_After == 2){
		echo'
<link rel="stylesheet" type="text/css" href="./profile/temy.css">';
}
elseif($Site_ID == 2 AND $Site_After == 1){
		echo'
<link rel="stylesheet" type="text/css" href="./profile/temy_1.css">';
}
}
if(mode == "member" or mode == "social") {
$class = "page_head";
} else {
$class = "cat";
}
 if($show_hkma_sitemap == 1) {
echo'
<br>
<center>
<table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr class="normal">

			<td class="'.$class.'" align="center"><nobr><font size="3" color="#FFFFFF">~ '.$lang['other_new"things']['hkma_day'].' ~ <SCRIPT language="JavaScript">
<!-- Begin 
var ALAA = 36; 
now = new Date(); 
var rd = now.getSeconds(); 
var ra = rd % ALAA; 
var re = ++ra; 
var sori = ""; 
if (re == 1) { 

sori = "'.$lang['footer']['sori_1'].'";
} 
if (re == 2) { 

sori = "'.$lang['footer']['sori_2'].'";
} 
if (re == 3) { 

sori = "'.$lang['footer']['sori_3'].'";
} 
if (re == 4) { 

sori = "'.$lang['footer']['sori_4'].'";
} 
if (re == 5) { 

sori = "'.$lang['footer']['sori_5'].'";
} 
if (re == 6) { 

sori = "'.$lang['footer']['sori_6'].'";
} 
if (re == 7) { 

sori = "'.$lang['footer']['sori_7'].'";
} 
if (re == 8) { 

sori = "'.$lang['footer']['sori_8'].'"; 
} 
if (re == 9) { 

sori = "'.$lang['footer']['sori_9'].'";
} 
if (re == 10) { 

sori = "'.$lang['footer']['sori_10'].'";
} 
if (re == 11) { 

sori = "'.$lang['footer']['sori_11'].'";
} 
if (re == 12) { 

sori = "'.$lang['footer']['sori_12'].'";
}
if (re == 13) { 

sori = "'.$lang['footer']['sori_13'].'";
}
if (re == 14) { 

sori = "'.$lang['footer']['sori_14'].'";
}
if (re == 15) { 

sori = "'.$lang['footer']['sori_15'].'";
}
if (re == 16) { 

sori = "'.$lang['footer']['sori_16'].'";
}
if (re == 17) { 

sori = "'.$lang['footer']['sori_17'].'";
}
if (re == 18) { 

sori = "'.$lang['footer']['sori_18'].'";
}
if (re == 19) { 

sori = "'.$lang['footer']['sori_19'].'";
}
if (re == 20) { 

sori = "'.$lang['footer']['sori_20'].'";
}
if (re == 21) { 

sori = "'.$lang['footer']['sori_21'].'"; 
}
if (re == 22) { 

sori = "'.$lang['footer']['sori_22'].'";
}
if (re == 23) { 

sori = "'.$lang['footer']['sori_23'].'";
}
if (re == 24) { 

sori = "'.$lang['footer']['sori_24'].'";
}
if (re == 25) { 

sori = "'.$lang['footer']['sori_25'].'";
}
if (re == 26) { 

sori = "'.$lang['footer']['sori_26'].'";
}
if (re == 27) { 

sori = "'.$lang['footer']['sori_27'].'";
}
if (re == 28) { 

sori = "'.$lang['footer']['sori_28'].'";
}
if (re == 29) { 

sori = "'.$lang['footer']['sori_29'].'"; 
}
if (re == 30) { 

sori = "'.$lang['footer']['sori_30'].'";
}
if (re == 31) { 

sori = "'.$lang['footer']['sori_31'].'"; 
}
if (re == 32) { 

sori = "'.$lang['footer']['sori_32'].'"; 
}
if (re == 33) { 

sori = "'.$lang['footer']['sori_33'].'";
} 
if (re == 34) { 

sori = "'.$lang['footer']['sori_34'].'";
}
if (re == 35) { 

sori = "'.$lang['footer']['sori_35'].'";
}
if (re == 36) { 

sori = "'.$lang['footer']['sori_36'].'";
}

var ALAA=""+sori+""; 
document.write(ALAA); 
// End --> 
                </SCRIPT> ~  ~ '.sprintf( "%.2f",-$save_time).' '.$lang['other_new_things']['second'].' ~ <br> ~ <a href="'.$xml.'"><font color="white">XML Sitemap</font></a> ~ <a href="'.$html.'"><font color="white">HTML Sitemap</font></a> ~ <a href="'.$txt.'"><font color="white">URL List</font></a> ~
				';


echo'
</body>
</html>

</font></nobr></td>

		</tr>

</table>
</center>

  
  
';

 }
print $this_code;

}



?>
