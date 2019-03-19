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

session_start();

require_once("./engine/function.php");
require_once("./engine/engine_requires.php");
require_once("icons.php");
require_once("converts.php");
require_once("./session.php");
require_once("language/".$choose_language.".php");

 if($firewall_admin_active == 1) {
$username=$firewall_admin_user;

$password=$firewall_admin_pass;

if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER']!=$username || $_SERVER['PHP_AUTH_PW']!=$password)
   {
   header("WWW-Authenticate: Basic realm=\"AdminAccess\"");
   header("HTTP/1.0 401 Unauthorized");
die (require_once("./customavatars/foundfile.htm"));
exit();
}
}

 $load_user_name = DBi::$con->real_escape_string(htmlspecialchars($_SESSION['ADFName']));
 $load_user_pass = $_SESSION['ADFPass'];
 $load_user_pass = MD5($load_user_pass);

 $CP = DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE (M_NAME = '$load_user_name' OR M_EMAIL = '$load_user_name') AND M_PASSWORD = '$load_user_pass' AND M_STATUS = 1 AND M_LEVEL = 4 AND M_ADMIN = 1") or die (DBi::$con->error);

 if(mysqli_num_rows($CP) > 0){
 $rsCP = mysqli_fetch_array($CP);

 $CPMemberID = $rsCP['MEMBER_ID'];
 $CPUserName = $rsCP['M_NAME'];
 $CPUserEmail= $rsCP['M_EMAIL'];
 $CPPassword = $rsCP['M_PASSWORD'];
 $CPMemberPosts = $rsCP['M_POSTS'];
 $CPMlevel = $rsCP['M_LEVEL'];
 }
 else {
 $CPMemberID = "0";
 $CPUserName = "0";
 $CPPassword = "0";
 $CPMemberPosts = "0";
 $CPMlevel = "0";
 }

 
 if (($CPUserName == $load_user_name or $CPUserEmail == $load_user_name) && $CPPassword == $load_user_pass) {
   $Adminlogin = 1;

   if ($type == "login") {

                    echo '
                    <html dir="rtl">
					<meta charset=UTF-8>
					<head><title></title>
                    <link href="'.$admin_folder.'/cp_styles/cp_style_green.css" type="text/css" rel="stylesheet">
                    </head>
                    <body background="'.$admin_folder.'/cp_styles/bg.jpg"  leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
                    <br><br><br>
                    <center>
	                <table bordercolor="#ffffff" width="60%" border="1">
	                   <tr class="normal">
	                       <td class="list_center" colSpan="10"><font size="5"><br>'.$lang['others']['true_sign_in'].'</font><br><br>
                           <meta http-equiv="Refresh" content="2; URL='.$admin_folder.'.php">
                           <a href="'.$admin_folder.'.php">'.$lang['others']['click_here_to_go'].'</a><br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center></body></html>';
   }
   if ($type == "auto") {
       print '<meta http-equiv="Refresh" content="0; URL='.$admin_folder.'.php">';
   }

 }
 else {
   $Adminlogin = 0;
   if ($type == "login") {
     go_to("login.php?method=error");
   }
   else {
     go_to("login.php");
   }
 }
 
?>