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

if ($Mlevel == 4){
@require_once("./engine/forum_function.php");


function nofity_administrator_info() {
	$sql = @DBi::$con->query("SELECT * FROM ".prefix."FORUM ") or die (DBi::$con->error);
	$num = @mysqli_num_rows($sql);
		$x = 0;
		while ($x < $num) {
		$f = @mysqli_result($sql, $x, "FORUM_ID");
		$subject = forums("SUBJECT", $f);
        $nofity_admin = nofity_wait($f, "admin");
		$href = '<a href="index.php?mode=f&f='.$f.'">'.$subject.'</a>';
		if ($nofity_admin > 0) { $tr_class = "fixed"; }
		else { $tr_class = "normal"; }
		echo'
		<tr class="'.$tr_class.'">
			<td class="list_small">'.$href.'</td>
				<td class="list_center"><a href="index.php?mode=notifylist&f='.$f.'&method=admin">'.$nofity_admin.'</a></td>
		</tr>';
		++$x;
		}
}


function nofity_forums_info() {
global $lang;	
	if (mlv == 4) {
		$txt = $lang['admin_notify']['txt'];
	}
	echo'
	<center>
	<table cellSpacing="1" cellPadding="2" width="99%" border="0">
		<tr>
			<td class="optionsbar_menus" width="100%">&nbsp;<nobr><font color="red" size="+1">'.$txt.'</font></nobr></td>';
			refresh_time();
			go_to_forum();
		echo'
		</tr>
	</table>
	<br>
	<table bgcolor="gray" class="grid" cellSpacing="1" cellPadding="2" width="60%" border="0">
		<tr>
			<td class="cat">'.$lang['active']['forum'].'</td>
			<td class="cat">'.$lang['member']['notify'].'</td>
		</tr>';
	if (mlv == 4){
			nofity_administrator_info();
	}
	echo'
	</table>
	<br>
	<table cellSpacing="1" cellPadding="2" border="0">
		<tr>
			<td align="center">'.$lang['admin_notify']['this_forum'].'</td>
			<td align="center"><table border="1"><tr class="fixed"><td>&nbsp;&nbsp;&nbsp;</td></tr></table></td>
			<td align="center">'.$lang['admin_notify']['have_notify'].'</td>
		</tr>
		<tr>
			</font></td>
		</tr>
	</table>
	</center>';
}

if (mlv == 4){
	nofity_forums_info();
}
}
else{
	go_to("index.php");
}
?>