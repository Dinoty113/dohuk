<?

error_reporting(0);

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



session_start();

@require_once("./engine/function.php");
@require_once("./engine/engine_requires.php");
@require_once("./session.php");
@require_once("./language/".$choose_language.".php");
@require_once("icons.php");
@require_once("converts.php");

if($method != "" && $method != "login" && $method != "logout" && $method != "error") {
redirect();	
}

if ($method == "logout") {
 session_unset($_SESSION['ADFName']);
 session_unset($_SESSION['ADFPass']);
 head('login.php');
}

$auto_user = $_SESSION['ADFName'];
$auto_pass = $_SESSION['ADFPass'];
if ($auto_user != "" AND $auto_pass != ""){
 // head('check.php?type=auto');
}

$user_name = DBi::$con->real_escape_string(htmlspecialchars($_POST["user_name"]));
$user_pass = DBi::$con->real_escape_string(htmlspecialchars($_POST["user_pass"]));

if ($method == "login") {
 $_SESSION['ADFName'] = $user_name;
 $_SESSION['ADFPass'] = $user_pass;
 head('check.php?type=login');
}

echo'
<html dir="rtl">
<head>
<title>'.$forum_title.' - '.$lang['others']['login_admin_panel'].'</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta content="DUHOK FORUM 2.1: Copyright (C) 2015-2016 Dilovan." name="copyright">

<link href="'.$admin_folder.'/cp_styles/cp_style_green.css" type="text/css" rel="stylesheet">

<script type="text/javascript" src="./javascript/jquery.min.js"></script>

</head>
<body background="'.$admin_folder.'/cp_styles/bg.jpg" leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
<br><br><br><br>';


if ($method == "logout"){
                    echo'<center>
	                <table bordercolor="#ffffff" width="60%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['others']['done_sign_in_now'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL=login.php">
                           <a href="login.php">'.$lang['others']['click_here_to_go'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
}
if ($method == "error"){
	                echo'<center>
	                <table bordercolor="#ffffff" width="60%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['others']['wrong_pass_permission'].'</font><br><br>
                           <a href="login.php">'.$lang['others']['try_again_now'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>';
$ip=getenv(REMOTE_ADDR);						
DBi::$con->query("INSERT INTO ".prefix."HAKING (ID, IP, MEMBER, TYPE) VALUES (NULL, '$ip', '1', '5')");		

}
$load_user_name = $_SESSION['DFName'];
if ($method == ""){
?>
<form method="post" action="login.php?method=login">
<center>
<table class="grid" cellspacing="1" cellpadding="2" border="0" width="45%">
	<tr>
		<td class="cat" colspan="2" height="25"><? print $lang['others']['login_admin_panel']; ?></td>
	</tr>
	<tr>
		<td background="<? print $admin_folder; ?>/cp_styles/bg.jpg" colspan="2" height="65">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td><img border="0" src="<? print $admin_folder; ?>/images/cp_logo.gif"></td>
                <td align="middle"><font face="tahoma" color="black" size="2">DuHok Forum <? print $forum_version; ?><br><font style="FONT-WEIGHT: normal; FONT-SIZE: 11px">Programming By Dilovan<br>Developing By DuHok Forum Team</font></font></td>
            </tr>
        </table>
        </td>
	</tr>
	<tr>
		<td class="cat" width="30%"><? print $lang['header']['name_email']; ?></td>
		<td class="userdetails_data" width="70%">&nbsp;<input style="WIDTH: 300px" type="text" name="user_name" value="<? print $load_user_name; ?>" class="only_alpha_num">


</td>
	</tr>
	<tr>
		<td class="cat" width="30%"><? print $lang['header']['password']; ?></td>
		<td class="userdetails_data" width="70%">&nbsp;<input style="WIDTH: 300px" type="password" name="user_pass"></td>
	</tr>
	<tr>
		<td class="userdetails_data" colspan="2"><div align="center"><input type="submit" value="<? print $lang['others']['login_in']; ?>">&nbsp;&nbsp;<input type="reset" value="<? print $lang['add_cat_forum']['reset']; ?>"></div></td>
	</tr>
</table>
</center>
</form>

<?
}
?>
</body>
</html>