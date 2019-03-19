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
include("./session.php");
include("language/".$choose_language.".php");

?>
<html dir="rtl">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="DUHOK FORUM 2.1: Copyright (C) 2015-2016 Duhok Team." name="copyright">
<link href="<? print $admin_folder; ?>/cp_styles/cp_style_green.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="./javascript/jquery.min.js"></script>
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
<table class="header" cellspacing="3" cellpadding="0" height="100%" width="100%" border="0">
  <tr>
    <td class="list" width="100%"><? print $lang['admin']['admin_panel'].' - '.$forum_title; ?></td>
    <td class="optionsbar_menus"><nobr><a href="index.php" target="_blank"><? print $lang['admin']['home']; ?></a></nobr></td>
    <td class="optionsbar_menus"><nobr><a onclick="return confirm('<? print $lang['header']['you_are_sure_to_logout']; ?>');" target="_top" href="login.php?method=logout"><? print $lang['others']['sign_out']; ?></a></nobr></td>
  </tr>
</table>
</body>
</html>
