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

include("check.php");
?>
<html dir="rtl">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="DUHOK FORUM 2.1: Copyright (C) 2015-2016 Duhok Team." name="copyright">
<link href="<? print $admin_folder; ?>/cp_styles/cp_style_green.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="./javascript/jquery.min.js"></script>
</head>
<body background="<? print $admin_folder; ?>/cp_styles/bg.jpg" leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
<br>
<?
switch ($mode) {
     case "":
          include ("./$admin_folder/body.php");
     break;
     case "option":
          include ("./$admin_folder/option.php");
     break;
     case "market":
          include ("./$admin_folder/market.php");
     break;	 
     case "ranks":
          include ("./$admin_folder/ranks.php");
     break;
     case "permission":
          include ("./$admin_folder/permission.php");
     break;
     case "backup":
          include ("./$admin_folder/backup.php");
     break;
     case "logo":
          include ("./$admin_folder/logo.php");
     break;
     case "pm":
          include ("./$admin_folder/pm.php");
               break;
     case "best":
          include ("./$admin_folder/best.php");
          break;
     case "close":
          include ("./$admin_folder/close.php");
           break;
    case "special":
          include ("./$admin_folder/ihdaa.php");
    break;
    case "ads":
          include ("./$admin_folder/ads.php");
      break;
    case "msg":
          include ("./$admin_folder/msg.php");
  break;
    case "firewall":
          include ("./$admin_folder/firewall.php");
  break;
    case "adsense":
          include ("./$admin_folder/adsense.php");
  break; 
     case "haking":
          include ("./$admin_folder/haking.php");
  break;  
     case "style":
          include ("./$admin_folder/style.php");
  break;  
     case "lang":
          include ("./$admin_folder/lang.php");
  break;    
     case "update":
          include ("./$admin_folder/update.php");
  break;     
     case "phpinfo":
          print '<table width="100%" border="0" cellpadding="0" cellspacing="0" dir="ltr"><tr><td dir="ltr">';
          phpinfo();
          print '</td></tr></table>';
     break;
}
?>
</body>
</html>
