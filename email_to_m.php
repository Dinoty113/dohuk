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

if(mlv < 2) redirect();
if(!$id) redirect();
if(!member_name($id)) redirect();


$r_email = members("RECEIVE_EMAIL", $id);
$send_email = nl2br(htmlspecialchars($_POST['send_email']));

if($r_email == 0 && $Mlevel < 2) {
	echo'<br>
	<center>
	<table width="99%" border="1">
		<tr class="normal">
			<td class="list_center" colSpan="10"><br><br><font color="red" size="5">'.$lang['others']['cant_send_email'].'</font><br><br><br>
			</td>
		</tr>
	</table>
	</center>';
} else {

if(!$send_email){
echo '
<table border="0" cellpadding="0" cellspacing="0"dir="rtl" width="99%">
  <tbody>
    <tr>
      <td>
      <center>'.$lang['others']['send_m'].' <br>
      <font color="red" size="+2">'.member_name($id).'</font>
      <form name="form" action="index.php?mode=email_to_m&id='.$id.'"
 method="post">
        <table bgcolor="gray" border="0"
 cellpadding="4" cellspacing="1">
          <tbody>
            <tr class="fixed">
              <td class="optionheader">'.$lang['admin']['pm_message'].' : <br>
              <textarea name="send_email" rows="7" cols="50"></textarea>
</td>
</tr>  <tr class="fixed">
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
 <input value="'.$lang['admin']['submit_send_pm'].'" type="submit"></td>
            </tr>
          </tbody>
        </table>
      </form>
      </center>
      </td>
    </tr>
  </tbody>
  <table class="footerbar" cellpadding="0"
 cellspacing="1" dir="rtl" width="100%">
    <tbody>
      <tr>
      </tr>
    </tbody>
  </table>';
}

if($send_email){
		$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}
$m = $id;	
$email = members("EMAIL", $id);

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
if($error == "") {
 $pf_to = $email;
 $pf_sub = ''.$lang['e-emails']['email_to_m_subject'].' '.member_name($m).' ';
 $pf_msg = '<p align="right">'.$send_email.'<br><br></p>';
 $pf_from = $rs['M_EMAIL'];
 $headers  = "MIME-Version: 1.0 \r\n"; 
 $headers .= "Content-type: text/html; charset=utf8\r\n";  
 $headers .= "From: ".$admin_email."";
 mail($pf_to, $pf_sub, $pf_msg, $headers);
 
	echo'<br>
	<center>
	<table width="99%" border="1">
		<tr class="normal">
			<td class="list_center" colSpan="10"><br><br><font size="5">'.$lang['others']['done_send_m'].' '.member_name($m).' .</font><br><br><br>
			</td>
		</tr>
	</table>
	</center>';

}
}
}
?>