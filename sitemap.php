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
header('Content-Type: text/xml'); 
@require_once("./engine/function.php");
@require_once("./engine/engine_requires.php");
@require_once("./engine/seo.php");

$domain = Get_deric();
function Gen_Sitemap($url,$date,$freq,$priority){ 
    $xml  = "\t<url>\n"; 
    $xml .= "\t\t<loc>".$url."</loc>\n"; 
    if($date){ 
      $dateTime = date('Y-m-d H:i:s',$date); 
        if (is_numeric(substr($dateTime,11,1))){ 
            $isoTS = substr($dateTime,0,10) .'T'.substr($dateTime,11,8).'+00:00'; 
        }else {$isoTS = substr($dateTime,0,10);} 
      $xml .= "\t\t<lastmod>".$isoTS."</lastmod>\n"; 
      } 
    if($freq){$xml .= "\t\t<changefreq>".$freq."</changefreq>\n";} 
    if($priority){$xml .= "\t\t<priority>".$priority."</priority>\n";} 
    $xml .= "\t</url>\n"; 
    return $xml; 
} 
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><?xml-stylesheet type=\"text/xsl\" href=\"$domain"."sitemap.xsl\"?><urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n"; 
$xml .= Gen_Sitemap($site_name,time(),'daily','1.0');
$c_sql = DBi::$con->query("SELECT * FROM ".prefix."CATEGORY WHERE CAT_HIDE = '0' AND CAT_LEVEL = '0'");
while($rs_c_sql = mysqli_fetch_array($c_sql)) {
$cat = $rs_c_sql['CAT_ID'];	
			$f_sql = DBi::$con->query("SELECT * FROM ".prefix."FORUM WHERE CAT_ID = '$cat' AND F_HIDE = '0' AND F_LEVEL = '0' ORDER BY F_ORDER ASC ");
			while($rs_f_sql = mysqli_fetch_array($f_sql)){ 
 $forum = $rs_f_sql['FORUM_ID']; 
    $xml .= Gen_Sitemap($domain.''.index().'?mode=f&amp;f='.$forum,NULL,'monthly','0.5'); 
$t_sql = DBi::$con->query("SELECT * FROM ".prefix."TOPICS WHERE FORUM_ID = '$forum' AND T_HIDDEN = '0' AND T_UNMODERATED = '0' AND T_HOLDED = '0' AND T_STATUS != '2' ORDER BY T_DATE DESC");
    while($rs_t_sql = mysqli_fetch_array($t_sql)){ 
 $topic = $rs_t_sql['TOPIC_ID'];;	
    $xml .= Gen_Sitemap($domain.''.index().'?mode=t&amp;t='.$topic,time(),'monthly','0.9'); 
    } 
} 
}
$xml .= "</urlset>"; 
echo $xml; 

?>