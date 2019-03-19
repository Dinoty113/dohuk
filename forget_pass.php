<?
if ($Mlevel > 0) {
redirect();
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

if($type != "" && $type != "insert") {
redirect();	
}
	

if ($type == "") {
echo'
<center>
<table cellSpacing="0" cellPadding="0" width="99%" border="0">
	<tr>
		<td>
		<center>
		<br>&nbsp;<form method="post" action="index.php?mode=forget_pass&type=insert">
			<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0">
				<tr class="fixed">
					    <td class="optionheader" id="row_subject">'.$lang['others']['forget_pass_desc'].' <br>
					<input class="insidetitle" style="WIDTH: 250px" type="text" name="member_name"><br>
					<font size="-1">'.$lang['others']['forget_pass_desc1'].'</font></td>
				</tr>
				<tr class="fixed">
					<td class="list_center">
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
					<input type="submit" value="'.$lang['others']['request_pass'].'"></td>
				</tr>
			</table>
		</form>
		</center>
		</td>
	</tr>
</table>
</center>';

}
if ($type == "insert") {
	$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
	
	require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}

 $member_name = DBi::$con->real_escape_string(htmlspecialchars($_POST["member_name"]));

 $FP = @DBi::$con->query("SELECT * FROM ".$Prefix."MEMBERS WHERE M_NAME = '".$member_name."' ") or die (DBi::$con->error);
 $fp_n = @mysqli_num_rows($FP);
 $fp_r = @mysqli_fetch_array($FP);
 $email = $fp_r['M_EMAIL'];
 $id = $fp_r['MEMBER_ID'];
 $name = $fp_r['M_NAME'];
 $code = $fp_r['M_CODE'];
 if($error != "") {
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
 if($fp_n > 0){
 if($error == "") {
if($id == 1) {
$done_normal = $lang['others']['error_request_pass'];
} else {
$done_normal = $lang['others']['done_request_pass'];	
}
$url_final   = Get_deric() . 'index.php?mode=activ_mem&type=password&activ_num='.$code;

$message     = '<p align="right">'.$lang['members']['members'].' '.$name .'<br><br>'.$lang['e-emails']['forget_pass_message_1'].'<br><br><a href="'.$url_final.'">'.$url_final.'</a><br><br>'.$lang['e-emails']['forget_pass_message_2'].'</p>';

$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['forget_pass_subject'].'';
$headers  = "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-type: text/html; charset=utf8\r\n"; 
$headers .= "From: ".$admin_email."";
mail($email, $title, $message, $headers);


	                echo'
                    <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font color="red"><b><font size="+2" color="red"><br>'.$done_normal.'</font></b></font><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';

 }
  }
 else {

	                echo'
                    <center>
	                <table width="99%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font color="red"><b><font size="+2" color="red"><br>'.$lang['others']['error_request_pass'].'</font></b></font><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
 }
}
?>