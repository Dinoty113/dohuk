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

@include_once("check.php");
@include_once("./session.php");
@include_once("language/".$choose_language.".php");
?>
<html dir="rtl">
<head>
<title> <? echo $lang['admin']['admin_panel'];  ?></title>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<meta content="DUHOK FORUM 2.1: Copyright (C) 2015-2016 Duhok Team." name=copyright>
<meta http-equiv="Page-Enter" content="blendTrans(Duration=0)">
<meta http-equiv="Page-Exit" content="blendTrans(Duration=0)">
<script type=text/javascript>
	if (self.parent.frames.length != 0)
	{
		self.parent.location.replace(document.location.href);
	}
</script>
</head>
<frameset border=0 frameSpacing=0 frameBorder=0 cols=*,195>
<frameset border=0 frameSpacing=0 rows=30,* frameBorder=0>
<frame border=no name=head marginWidth=10 marginHeight=0 src="cp_header.php" frameBorder=0 noResize scrolling=no>
<frame border=no name=main marginWidth=10 marginHeight=10 src="cp_home.php" frameBorder=0 scrolling=yes></frameset>
<frame border=no name=nav marginWidth=0 marginHeight=0 src="cp_menu.php" frameBorder=0 scrolling=yes></frameset>
</html>

