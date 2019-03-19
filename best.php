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

$Name = link_profile(member_name($best_mem), $best_mem);
$Name2 = link_profile(member_name($best_mod), $best_mod);
$best_topic = @DBi::$con->query("SELECT * FROM ".prefix."TOPICS WHERE T_HIDDEN = 0 AND T_UNMODERATED = 0 AND TOPIC_ID = '$best_topic'  ");


 $query = "SELECT * FROM " . $Prefix . "FORUM WHERE FORUM_ID = '$best_frm'  ";
 $result = @DBi::$con->query($query) or die (DBi::$con->error);

 if(@mysqli_num_rows($result) > 0){
 $rs = @mysqli_fetch_array($result);


 $subject = $rs['SUBJECT'];
 $logos = $rs['F_LOGO'];
 }


$f_name = forums("SUBJECT", $best_frm);
$f_logo = forums("LOGO", $best_frm);


$title = $best_t;
$title1 = $best_mem_t;
$title2 = $best_mod_t;
$title3 = $best_frm_t;
$title4 = $best_topic_t;


?>





<p align="center">





</p>
<table bgcolor="gray"  align="center" class="grid" cellSpacing="1" cellPadding="1" width="90%" border="0">
	<tr>
		<td class="cat">
		<p align="center"><? echo $title ?></td>
	</tr>
	<table bgcolor="gray" align="center" class="grid" cellSpacing="1" cellPadding="0" width="90%" border="0">
	<tr>
		<td class="fixed" align="center"><? echo $Name ?></a></td>
		</td>
		<td class="fixed" align="center"><? echo $Name2 ?></a></td>
		<td class="fixed" align="center">		<? while($r_3 = @mysqli_fetch_array($best_topic)){ echo ' <a href="index.php?mode=t&t='.$r_3[TOPIC_ID].'" title="'.$r_3[T_SUBJECT].'">'.$r_3[T_SUBJECT].'
 '; } ?>
		<td class="fixed" align="center">

		<? 
  if ($best_frm != "") {
  		echo'


<a   alt="'.$f_name.'"  href="index.php?mode=f&f='.$best_frm.'">'.icons($f_logo).' <br>
<font size="3"><a href="index.php?mode=f&f='.$best_frm.'">'.$f_name.' </a></font></td>';
}
else{
echo'
<a href="index.php?mode=f&f='.$best_frm.'"><br>
<font size="3"><a href="index.php?mode=f&f='.$best_frm.'"></a></font></td>';
}
?>

		</td>
	</tr>
	<tr>
		<td class="cat">
		<p align="center"><? echo $title1 ?></td>
		<td class="cat">
		<p align="center"><? echo $title2 ?></td>
		<td class="cat">
		<p align="center"><? echo $title4 ?></td>
		<td class="cat">
		<p align="center"><? echo $title3 ?></td>

	</tr>
</table>
<p align="center">