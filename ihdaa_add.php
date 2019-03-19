<?
if (@eregi("ihdaa_add.php","$_SERVER[PHP_SELF]")) {
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

if($type != "" && $type != "add") {
redirect();	
}
    
 if( mlv == 1 AND $DBMemberPosts < $WHAT_LIMIT ){
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
	                       
'.$lang[sorry][no].'
'.$lang[sorry][what].'
'.$lang[sorry][will].'
	                       </font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
exit();
}


    
    if(mlv < 4 AND $WHAT_ACTIVE == 0 ){
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
	                       
'.$lang[ihdaa][close].'

	                       </font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
exit();
}

    if (members("IHDAA", $DBMemberID) == 1 ){
	                echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>
	                       
'.$lang[ihdaa][go_out].'

	                       </font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['profile']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
exit();
}




if (mlv > 0){



$oforum_ida = $f;

if ($type == "") {



echo'
<center>
<table bgcolor="gray" class="grid" border="0" cellspacing="1" cellpadding="4" width="60%">
<form method="post" action="index.php?mode=ihdaa_add&type=add">

	<tr class="fixed">
		<td class="cat" colspan="2"><nobr>'.$lang['other_cat_forum']['add_forum1'].'</nobr></td>
			<tr class="fixed">

		<td class="cat" colspan="2"><nobr>'.$lang['ihdaa']['remember1'].''.$lang['ihdaa']['remember'].' </nobr></td>

			</tr>

	<tr class="fixed">
		<td class="optionheader"><nobr>'.$lang['other_cat_forum']['forum_url1'].'</nobr></td>
		<td class="list">
			<input name="message" maxLength="70" size="60">

	</tr>
	
	<tr class="fixed">
		<td align="middle" colspan="2">
		
		<center>
						<font color="red">'.$lang['others']['insert_true_captcha'].'<br>

					<div id="captchabox">
<table><tbody>
<tr><td valign="bottom">
';
?>
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
<img src="./captcha/images/reload.png" width="18" height="18" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
<?php
echo'
</td>
<td valign="top"><img width="200" height="40" id="siimage"  src="./captcha/securimage_show.php?sid='.md5(uniqid()).'"></td>
<td valign="top"><nobr><center><b><font color="red">'.$lang['others']['captcha'].'<br><input type="text" style="width:60px;font-size:12px;" name="captcha">
</b></center></nobr></td></tr></tbody></table></div>
</center>
<input type="submit" value="'.$lang['other_cat_forum']['ok'].'">&nbsp;&nbsp;&nbsp;<input type="reset" value="'.$lang['other_cat_forum']['reset'].'"></td>
	</tr>
</form>
</table>
</center>';

}

if ($type == "add") {
	
			$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}

$Forum_Urla = htmlspecialchars(DBi::$con->real_escape_string($_POST["message"]));

if($error != ""){
	
	             echo'<br><center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['all']['error'].'<br>'.$error.'..</font><br><br>
	                       <a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center><xml>';
}
if($error == "") {
	$queryF = "INSERT INTO " . $Prefix . "CEP_FORUM (O_FORUMIDA, O_FORUM_NAMEA, O_FORUM_URLA, O_FORUM_IP , O_FORUM_DATE ) VALUES (NULL, '$DBMemberID', '$Forum_Urla' , '$DBMemberIP', '$date')";
@DBi::$con->query($queryF) or die (DBi::$con->error);

                    echo'
	                <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['other_cat_forum']['the_forum_was_added1'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=index.php">
                           <a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}}}

?>