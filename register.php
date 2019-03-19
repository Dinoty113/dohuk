<?
if (@eregi("register.php","$_SERVER[PHP_SELF]")) {
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

if($type != "" && $type != "insert") {
redirect();	
}

	function temy ($temy) {
    $chars = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $string = array_rand($chars, $temy);
    foreach($string as $s)
    {
        $ret .= $chars[$s];
    }
	return $ret;
 }

$code = temy(11);

$sql = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_CODE = '$code' ");
if( $rows = mysqli_fetch_array($sql))
{

 $code = temy(11);
}

if ($Mlevel > 0) {
redirect();
}  
if ($register_waitting == 2){
		echo'<br><center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['other']['no_register'].'</font><br><br>
				<a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_back'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center><xml>';
}
else{


if ($type == "") {
	echo'
	<script language="javascript" src="./javascript/register.js"></script>
	<center>
	<table cellSpacing="0" cellPadding="0" width="50%" border="0" id="table1">
		<tr>
			<td>
			<center><font color="red" size="+2">'.$lang['register']['register_new_member'].'</font><br>&nbsp;
			<form name="userinfo" method="post" action="index.php?mode=register_member&type=insert">
			<input type="hidden" value="'.$http_host.'" name="host">
			<input type="hidden" value="1" name="forum_title">
			<input type="hidden" value="1" name="site_address">
			<table cellSpacing="1" cellPadding="4" bgColor="gray" border="0" id="table2">
				<tr class="fixed">
					<td class="optionheader_selected" id="row_user_name"><nobr>'.$lang['register']['user_name'].' </nobr></td>
					<td class="list" colSpan="3"><input maxLength="24" class="insidetitle" style="WIDTH: 300px" name="user_name"></td>
				</tr>
				<tr class="fixed">
					<td><font color="red" size="-1">'.$lang['register']['rules_write_user_name_one'].'<br>&nbsp;</font></td>
					<td colSpan="3"><font color="red" size="-1">'.$lang['register']['rules_write_user_name_tow'].'<br>&nbsp;</font></td>
				</tr>
				<tr class="fixed">
					<td class="optionheader_selected" id="row_user_password1"><nobr>'.$lang['register']['the_password'].' </nobr></td>
					<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 300px" type="password" name="user_password1"></td>
				</tr>
				<tr class="fixed">
					<td class="optionheader_selected" id="row_user_password2"><nobr>'.$lang['register']['the_confirm_password'].' </nobr></td>
					<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 300px" type="password" name="user_password2"></td>
				</tr>
				<tr class="fixed">
					<td><font color="red" size="-1">'.$lang['register']['rules_write_password_one'].'<br>&nbsp;</font></td>
					<td colSpan="3"><font color="red" size="-1">'.$lang['register']['rules_write_password_tow'].'<br>&nbsp;</font></td>
				</tr>
				<tr class="fixed">
					<td class="optionheader_selected" id="row_user_email"><nobr>'.$lang['register']['the_email'].' </nobr></td>
					<td class="list" colSpan="3"><input class="insidetitle" dir="ltr" style="WIDTH: 300px" name="user_email"></td>
				</tr>
				<tr class="fixed">
					<td><font color="red" size="-1">'.$lang['register']['rules_write_email_one'].'<br>&nbsp;</font></td>
					<td colSpan="3"><font color="red" size="-1">'.$lang['register']['rules_write_email_tow'].'<br>&nbsp;</font></td>
				</tr>
					<tr class="fixed">
					<td class="optionheader" id="row_user_city"><nobr>'.$lang['register']['the_city'].'</nobr></td>
					<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 150px" name="user_city"></td>
				</tr>
					<tr class="fixed">
					<td class="optionheader" id="row_user_state"><nobr>'.$lang['register']['the_state'].'</nobr></td>
					<td class="list" colSpan="3"><input class="insidetitle" style="WIDTH: 150px" name="user_state"></td>
				</tr>


				<tr class="fixed">
					<td class="optionheader" id="row_user_country"><nobr>'.$lang['register']['the_country'].'</nobr></td>
					<td class="list" colSpan="3">
					<select class="insidetitle" style="WIDTH: 200px" name="user_country" type="text">';
					include("country.php");
					echo'
					</select>
					</td>
				</tr>
				<tr class="fixed">
					<td class="optionheader" id="row_user_occupation"><nobr>'.$lang['register']['the_occupation'].' </nobr></td>
					<td class="list" colSpan="3">
					<input class="insidetitle" style="WIDTH: 150px" name="user_occupation"></td>
					
				</tr>
				<tr class="fixed">

					<td class="optionheader" id="row_user_day"><nobr>'.$lang['register']['the_age'].'</nobr></td>
					<td class="list" colSpan="3">
					<input class="insidetitle" style="WIDTH: 150px" name="user_age"></td>

					</td>
				</tr>
				
				<tr class="fixed">
					<td class="optionheader" id="row_user_sex"><nobr>'.$lang['register']['the_sex'].'</nobr></td>
					<td class="list" colSpan="3">&nbsp;&nbsp;&nbsp;<input class="small" type="radio" value="1" name="user_sex">'.$lang['register']['male'].'&nbsp;&nbsp;&nbsp;<input class="small" type="radio" value="2" name="user_sex">'.$lang['register']['famale'].'</td>
				</tr>

				<tr class="fixed">
					<td class="list_center" colSpan="4">
					<center>
						<font color="red">'.$lang['other']['insert_true_captcha_r'].'<br>

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
					<input onclick="submitForm()" type="button" value="'.$lang['register']['send_data'].'"></td>
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
	$user_name = htmlspecialchars(DBi::$con->real_escape_string($_POST['user_name']));
	$user_email = htmlspecialchars(DBi::$con->real_escape_string($_POST['user_email']));
	$user_pass = md5($_POST['user_password1']);
	$user_city = htmlspecialchars(DBi::$con->real_escape_string($_POST['user_city']));
	$user_state = htmlspecialchars(DBi::$con->real_escape_string($_POST['user_state']));
	$user_country = htmlspecialchars(DBi::$con->real_escape_string($_POST['user_country']));
	$user_occupation = htmlspecialchars(DBi::$con->real_escape_string($_POST['user_occupation']));
	$user_age = htmlspecialchars(DBi::$con->real_escape_string( $_POST['user_age']));
	$user_day = htmlspecialchars(DBi::$con->real_escape_string( $_POST['user_day']));
	$user_month = htmlspecialchars(DBi::$con->real_escape_string( $_POST['user_month']));
	$user_year = htmlspecialchars(DBi::$con->real_escape_string( $_POST['user_year']));
	$user_sex = DBi::$con->real_escape_string($_POST['user_sex']);
	$ip = $_SERVER['REMOTE_ADDR'];
    $da3wa = DBi::$con->real_escape_string( $_POST['da3wa']);
	$host = DBi::$con->real_escape_string($_POST['host']);
		$captcha = DBi::$con->real_escape_string(HtmlSpecialchars($_POST['captcha']));
$carray = array('',$lang['country']['country_1'],$lang['country']['country_2'],$lang['country']['country_3'],$lang['country']['country_4'],$lang['country']['country_5'],$lang['country']['country__5'],$lang['country']['country___5'],$lang['country']['country_6'],$lang['country']['country_7'],$lang['country']['country_8'],$lang['country']['country_9'],$lang['country']['country_10'],$lang['country']['country_11'],$lang['country']['country_12'],$lang['country']['country_13'],$lang['country']['country_14'],$lang['country']['country_15'],$lang['country']['country_16'],$lang['country']['country_17'],$lang['country']['country_18'],$lang['country']['country_19'],$lang['country']['country_20'],$lang['country']['country_21'],$lang['country']['country_22'],$lang['country']['country_23'],$lang['country']['country_24'],$lang['country']['country_25'],$lang['country']['country_26'],$lang['country']['country_27'],$lang['country']['country_28'],$lang['country']['country_29'],$lang['country']['country_30'],$lang['country']['country_31'],$lang['country']['country_32'],$lang['country']['country_33'],$lang['country']['country_34'],$lang['country']['country_35'],$lang['country']['country_36'],$lang['country']['country_37'],$lang['country']['country_38'],$lang['country']['country_39'],$lang['country']['country_40'],$lang['country']['country_41'],$lang['country']['country_42'],$lang['country']['country_43'],$lang['country']['country_44'],$lang['country']['country_45'],$lang['country']['country_46'],$lang['country']['country_47'],$lang['country']['country_48'],$lang['country']['country_49'],$lang['country']['country_50'],$lang['country']['country_51'],$lang['country']['country_52'],$lang['country']['country_53'],$lang['country']['country_54'],$lang['country']['country_55'],$lang['country']['country_56'],$lang['country']['country_57'],$lang['country']['country_58'],$lang['country']['country_59'],$lang['country']['country_60'],$lang['country']['country_61'],$lang['country']['country_62'],$lang['country']['country_63'],$lang['country']['country_64'],$lang['country']['country_65'],$lang['country']['country_66'],$lang['country']['country_67'],$lang['country']['country_68'],$lang['country']['country_69'],$lang['country']['country_70'],$lang['country']['country_71'],$lang['country']['country_72'],$lang['country']['country_73'],$lang['country']['country_74'],$lang['country']['country_75'],$lang['country']['country_76'],$lang['country']['country_77'],$lang['country']['country_78'],$lang['country']['country_79'],$lang['country']['country_80'],$lang['country']['country_81'],$lang['country']['country_82'],$lang['country']['country_83'],$lang['country']['country_84'],$lang['country']['country_85'],$lang['country']['country_86'],$lang['country']['country_87'],$lang['country']['country_88'],$lang['country']['country_89'],$lang['country']['country_90'],$lang['country']['country_91'],$lang['country']['country_92'],$lang['country']['country_93'],$lang['country']['country_94'],$lang['country']['country_95'],$lang['country']['country_96'],$lang['country']['country_97'],$lang['country']['country_98'],$lang['country']['country_99'],$lang['country']['country_100'],$lang['country']['country_101'],$lang['country']['country_102'],$lang['country']['country_103'],$lang['country']['country_104'],$lang['country']['country_105'],$lang['country']['country_106'],$lang['country']['country_107'],$lang['country']['country_108'],$lang['country']['country_109'],$lang['country']['country_110'],$lang['country']['country_111'],$lang['country']['country_112'],$lang['country']['country_113'],$lang['country']['country_114'],$lang['country']['country_115'],$lang['country']['country_116'],$lang['country']['country_117'],$lang['country']['country_118'],$lang['country']['country_119'],$lang['country']['country_120'],$lang['country']['country_121'],$lang['country']['country_122'],$lang['country']['country_123'],$lang['country']['country_124'],$lang['country']['country_125'],$lang['country']['country_126'],$lang['country']['country_127'],$lang['country']['country_128'],$lang['country']['country_129'],$lang['country']['country_130'],$lang['country']['country_131'],$lang['country']['country_132'],$lang['country']['country_133'],$lang['country']['country_134'],$lang['country']['country_135'],$lang['country']['country_136'],$lang['country']['country_137'],$lang['country']['country_138'],$lang['country']['country_139'],$lang['country']['country_140'],$lang['country']['country_141'],$lang['country']['country_142'],$lang['country']['country_143'],$lang['country']['country_144'],$lang['country']['country_145'],$lang['country']['country_146'],$lang['country']['country_147'],$lang['country']['country_148'],$lang['country']['country_149'],$lang['country']['country_150'],$lang['country']['country_151'],$lang['country']['country_152'],$lang['country']['country_153'],$lang['country']['country_154'],$lang['country']['country_156'],$lang['country']['country_157'],$lang['country']['country_158'],$lang['country']['country_159'],$lang['country']['country_160'],$lang['country']['country_161'],$lang['country']['country_162'],$lang['country']['country_163'],$lang['country']['country_164'],$lang['country']['country_165'],$lang['country']['country_166'],$lang['country']['country_167'],$lang['country']['country_168'],$lang['country']['country_169'],$lang['country']['country_170'],$lang['country']['country_171'],$lang['country']['country_172'],$lang['country']['country_173'],$lang['country']['country_174'],$lang['country']['country_175'],$lang['country']['country_176'],$lang['country']['country_177'],$lang['country']['country_178'],$lang['country']['country_179'],$lang['country']['country_180'],$lang['country']['country_181'],$lang['country']['country_182'],$lang['country']['country_183'],$lang['country']['country_184'],$lang['country']['country_185'],$lang['country']['country_186'],$lang['country']['country_187'],$lang['country']['country_188'],$lang['country']['country_189'],$lang['country']['country_190'],$lang['country']['country_191'],$lang['country']['country_192'],$lang['country']['country_193'],$lang['country']['country_194'],$lang['country']['country_195'],$lang['country']['country_196'],$lang['country']['country_197'],$lang['country']['country_198'],$lang['country']['country_199'],$lang['country']['country_200'],$lang['country']['country_201'],$lang['country']['country_202'],$lang['country']['country_203'],$lang['country']['country_204'],$lang['country']['country_205'],$lang['country']['country_206'],$lang['country']['country_207'],$lang['country']['country_208'],$lang['country']['country_209'],$lang['country']['country_210'],$lang['country']['country_211'],$lang['country']['country_212'],$lang['country']['country_213'],$lang['country']['country_214'],$lang['country']['country_215'],$lang['country']['country_216'],$lang['country']['country_217'],$lang['country']['country_218'],$lang['country']['country_219'],$lang['country']['country_220'],$lang['country']['country_221']);
if(in_array($user_country,$carray)){
	$cpass = "";
}
if(!in_array($user_country,$carray)){
	$cpass = "no";
}
if(is_numeric($user_age) && $user_age > 0 && $user_age < 100 ){
	$cpass = "";
}
if($user_age > 100) {
	$cpass = "no";
}	

	$sql = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_NAME = '$user_name' ") or die (DBi::$con->error);

	if(mysqli_num_rows($sql) > 0){
		$rs = mysqli_fetch_array($sql);
		$m_name = $rs['M_NAME'];
	}



	$sql2 = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_EMAIL = '$user_email' ") or die (DBi::$con->error);
	if(mysqli_num_rows($sql2) > 0){
		$rs = mysqli_fetch_array($sql2);
		$m_email = $rs['M_EMAIL'];
	}

	$sql3 = DBi::$con->query("SELECT * FROM ".prefix."FILTRE_NAMES WHERE F_NAME = '$user_name' ") or die (DBi::$con->error);
	if(mysqli_num_rows($sql3) > 0){
		$rs = mysqli_fetch_array($sql3);
		$m_name_filter = $rs['F_NAME'];
	}
	
	if ($user_name == "$m_name") {
		$error = $lang['register']['this_name_was_used'];
	}
	if ($m_email == $user_email) {
		$error = $lang['register']['this_email_was_used'];
	}
	if ($user_name == $m_name_filter) {
		$error = $lang['register']['this_name_was_bad'];
	}
	if ($http_host != $host) {
		$error = $lang['register']['not_allowed_to_use_this_away'];
	}
	if ($user_sex == "") {
		$error = $lang['register']['select_your_sex'];
	}	

	require_once './captcha/securimage.php';
    $securimage = new Securimage();	
	if ($securimage->check($captcha) == false) {
		$error = $lang['others']['wrong_captcha'];
	}

	if ($error != "") {
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
	if ($error == "") {
		$sql = "INSERT INTO ".prefix."MEMBERS (MEMBER_ID, M_STATUS, M_NAME, M_PASSWORD, M_EMAIL, M_CITY, M_STATE, M_IP, M_COUNTRY, M_AGE, M_OCCUPATION, M_SEX, M_DATE, M_LAST_POST_DATE, M_LAST_HERE_DATE, M_CODE) VALUES (NULL, ";
		if($register_waitting == 1)
		$sql .= "'2', ";
		elseif($register_waitting == 0) {
		$sql .= "'1', ";
		}
		elseif($register_waitting == 3) {
		$sql .= "'4', ";
		}		
		$sql .= "'$user_name', ";
		$sql .= "'$user_pass', ";
		$sql .= "'$user_email', ";
		$sql .= "'$user_city', ";
		$sql .= "'$user_state', ";
		$sql .= "'$ip', ";
		if($cpass != "") {
		$no = "";	
		$sql .= "'$no', ";
		$sql .= "'$no', ";		
		} else {
		$sql .= "'$user_country', ";
		$sql .= "'$user_age', ";
		}
		$sql .= "'$user_occupation', ";
		$sql .= "'$user_sex', ";
		$sql .= "'".time()."', ";
		$sql .= "'".time()."', ";
		$sql .= "'".time()."', ";
		$sql .= "'$code')";
		DBi::$con->query($sql) or die (DBi::$con->error);
		if ($register_waitting == 1){
			$msg_text = $lang['other']['done_admin_register'];
		}
		if ($register_waitting == 0){
			$msg_text = $lang['register']['the_member_was_registered'];
		}
		if($register_waitting == 3) {
					 
$id = SelectID($user_name);
$url_final   = Get_deric() . 'index.php?mode=activ_mem&activ_num='.$code.'&user='.(int)$id;
$message     = '<p align="right">'.$lang['e-emails']['activ_by_email_message_1'].' '.$user_name.'<br><br>'.$lang['e-emails']['activ_by_email_message_2'].' '.$forum_title.'<br><br>'.$lang['e-emails']['activ_by_email_message_3'].'<br><br><a href="'.$url_final.'">'.$url_final.'</a><br><br>'.$lang['e-emails']['activ_by_email_message_4'].' '.$code.'<br><br>'.$lang['e-emails']['activ_by_email_message_5'].' '.$forum_title.'</p>';
$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['activ_by_email_subject'].'';
$headers  = "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-type: text/html; charset=utf8\r\n"; 
$headers .= "From: ".$admin_email."";


     $msg_text = $lang['other']['done_email_register']; 
		 
		  mail($user_email, $title, $message, $headers);

  }
  				if($register_waitting == 3) {
				echo'
				<center><b><font>'.$msg_text.'</font></b></center>
								<meta http-equiv="Refresh" content="3; URL=index.php">
				';
				} else {
		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5"><br>'.$msg_text.'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
				}
	}
}
}
?>