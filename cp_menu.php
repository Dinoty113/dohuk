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
include("session.php");
include("language/".$choose_language.".php");

?>
<html dir="rtl">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="DUHOK FORUM 2.1: Copyright (C) 2015-2016 Duhok Team." name="copyright">
<link href="<? print $admin_folder; ?>/cp_styles/cp_style_green.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
	function set_cp_title()
	{
		parent.document.title = ("DuHok Forum 2.1 - "+parent.document.title);
	}
</script>
</head>
<body bgcolor="#DDF6FF" onload="set_cp_title();" leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">


<table cellspacing="0" cellpadding="0" width="100%" border="0">
  <tr>
    <td height="80" valign="top"><img title="<? print $lang['admin']['admin_panel']; ?>" alt="" hspace=0 src="<? print $admin_folder; ?>/images/cp_logo.gif" vspace=0 border=0></td>
  </tr>
  <tr>
    <td valign="top" align="middle" height="50"><font face="tahoma" color="black" size="2">DuHok Forum <? print $forum_version; ?><br><font style="FONT-WEIGHT: normal; FONT-SIZE: 11px">Programming By Dilovan<br>Developing By DuHok Forum Team</font></font></td>
  </tr>
</table>

<table  cellspacing="0" cellpadding="0" width="100%" border="0">
  <tr>
    <td>
    <div class="menu">
    <script src="<? print $admin_folder; ?>/javascript.js" type="text/javascript"></script>

    <script type="text/javascript">
    	function open_close_group(group, doOpen)
	{
		var curdiv = fetch_object("group_" + group);
		var curbtn = fetch_object("button_" + group);

		if (doOpen)
		{
			curdiv.style.display = "";
			curbtn.src = "<? print $admin_folder; ?>/images/cp_collapse.gif";
			curbtn.title = "<? print $lang['others']['close_menu']; ?>";
		}
		else
		{
			curdiv.style.display = "none";
			curbtn.src = "<? print $admin_folder; ?>/images/cp_expand.gif";
			curbtn.title = "<? print $lang['others']['open_menu']; ?>";
		}

	}
    </script>
    
      <a name="GroupDuhokForum_0"></a>
      <table class="navtitle" ondblclick="toggle_group('DuhokForum_0'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['others']['forum_options']; ?></strong></font></td>
          <td align="left">
    	  <a oncontextmenu="toggle_group('DuhokForum_0'); save_group_prefs('DuhokForum_0'); return false" onclick="toggle_group('DuhokForum_0'); return false;" href="index.php?id=DuhokForum_0#GroupDuhokForum_0" target="_self">
	      <img id="button_DuhokForum_0" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_0" style="DISPLAY: none">
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=option');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=option');"><? print $lang['others']['general_options']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=option&method=other');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=option&method=other');"><? print $lang['others']['other_options']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=option&method=editor');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=option&method=editor');"><? print $lang['others']['editor_options']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=option&method=files');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=option&method=files');"><? print $lang['others']['files_options']; ?></a>
        </div>		
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=option&method=site');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=option&method=site');"><? print $lang['others']['site_options']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=option&method=ip');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=option&method=ip');"><? print $lang['others']['ip_options']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=option&method=list_m');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=option&method=list_m');"><? print $lang['others']['list_options']; ?></a>
        </div>	
      </div>
	  
	        <a name="GroupDuhokForum_Market"></a>
      <table class="navtitle" ondblclick="toggle_group('DuhokForum_Market'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['others']['market_options']; ?></strong></font></td>
          <td align="left">
    	  <a oncontextmenu="toggle_group('DuhokForum_Market'); save_group_prefs('DuhokForum_Market'); return false" onclick="toggle_group('DuhokForum_Market'); return false;" href="index.php?id=DuhokForum_0#GroupDuhokForum_0" target="_self">
	      <img id="button_DuhokForum_Market" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_Market" style="DISPLAY: none">
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=market&method=market');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=market&method=market');"><? print $lang['others']['market_options']; ?></a>
        </div>	
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=market&method=market&type=list');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=market&method=market&type=list');"><? print $lang['others']['sell_list']; ?></a>
        </div>	
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=market&method=market&type=list_forum');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=market&method=market&type=list_forum');"><? print $lang['others']['forum_sell_list']; ?></a>
        </div>		
      </div>

                  <a name="GroupDuhokForum_close"></a>
      </font></b>
      <table class="navtitle" ondblclick="toggle_group('DuhokForum_close'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['others']['open_close_forum']; ?></strong></font></td>

          <td align="left">
    	  <b><font face="Tahoma" style="font-size: 9pt">
    	  <a oncontextmenu="toggle_group('DuhokForum_close'); save_group_prefs('DuhokForum_close'); return false" onclick="toggle_group('DuhokForum_close'); return false;" href="../j/index.php?id=DuhokForum_close#GroupDuhokForum_close" target="_self">
	      <img id="button_DuhokForum_close" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </font></b>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_close" style="DISPLAY: none">
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=close&method=close');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=close&method=close');"><? print $lang['others']['forum_status']; ?></a>
        </font></b>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=close&method=msg');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=close&method=msg');"><? print $lang['others']['close_msg']; ?></a>
        </div>
      </div>
	  
            <a name="GroupDuhokForum_001"></a>
      </font></b>
      <table class="navtitle" ondblclick="toggle_group('DuhokForum_001'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['temy_other']['lang_option']; ?></strong></font></td>
          <td align="left">
    	  <a oncontextmenu="toggle_group('DuhokForum_001'); save_group_prefs('DuhokForum_001'); return false" onclick="toggle_group('DuhokForum_001'); return false;" href="index.php?id=DuhokForum_001#GroupDuhokForum_001" target="_self">
	      <img id="button_DuhokForum_001" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </font></b>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_001" style="DISPLAY: none">
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=lang');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=lang');"><? print $lang['temy_other']['lang_option']; ?></a>
        </font></b>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=lang&method=lang');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=lang&method=lang');"><? print $lang['temy_other']['default_lang']; ?></a>
        </div>
      </div>	  
	  
                  <a name="GroupDuhokForum_style"></a>
      </font></b>
      <table class="navtitle" ondblclick="toggle_group('DuhokForum_style'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['temy_other']['styles_option']; ?></strong></font></td>

          <td align="left">
    	  <b><font face="Tahoma" style="font-size: 9pt">
    	  <a oncontextmenu="toggle_group('DuhokForum_style'); save_group_prefs('DuhokForum_style'); return false" onclick="toggle_group('DuhokForum_style'); return false;" href="../j/index.php?id=DuhokForum_style#GroupDuhokForum_style" target="_self">
	      <img id="button_DuhokForum_style" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </font></b>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_style" style="DISPLAY: none">
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=style');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=style');"><? print $lang['temy_other']['styles_option']; ?></a>
        </font></b>
        </div>
      </div>	  
      

      <a name="GroupDuhokForum_4"></a>
      <table  class="navtitle" ondblclick="toggle_group('DuhokForum_4'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['others']['groups']; ?></strong></font></td>
          <td align="left">
    	  <a oncontextmenu="toggle_group('DuhokForum_4'); save_group_prefs('DuhokForum_4'); return false" onclick="toggle_group('DuhokForum_4'); return false;" href="index.php?id=DuhokForum_4#GroupDuhokForum_4" target="_self">
	      <img id="button_DuhokForum_4" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_4" style="DISPLAY: none">
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=permission&method=mon');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=permission&method=mon');"><? print $lang['others']['mon']; ?></a>
        </font></b>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=permission&method=mod');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=permission&method=mod');"><? print $lang['others']['mod']; ?></a>
        </font></b>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=permission&method=new');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=permission&method=new');"><? print $lang['others']['new']; ?></a>
        </font></b>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=permission&method=visitor');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=permission&method=visitor');"><? print $lang['others']['visitor']; ?></a>
        </div>
      </div>

      <a name="GroupDuhokForum_2"></a>
      <table class="navtitle" ondblclick="toggle_group('DuhokForum_2'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['others']['titles']; ?></strong></font></td>
          <td align="left">
    	  <a oncontextmenu="toggle_group('DuhokForum_2'); save_group_prefs('DuhokForum_2'); return false" onclick="toggle_group('DuhokForum_2'); return false;" href="index.php?id=DuhokForum_2#GroupDuhokForum_2" target="_self">
	      <img id="button_DuhokForum_2" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_2" style="DISPLAY: none">
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=ranks&type=stars');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=ranks&type=stars');"><? print $lang['others']['default']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=ranks&type=colors');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=ranks&type=colors');"><? print $lang['others']['stars']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=ranks&type=group');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=ranks&type=group');"><? print $lang['others']['group']; ?></a>
        </div>
      </div>
     


<a name="GroupDuhokForum_7"></a>
      <table class="navtitle" ondblclick="toggle_group('DuhokForum_7'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['others']['add_options']; ?></strong></font></td>
          <td align="left">
    	  <a oncontextmenu="toggle_group('DuhokForum_7'); save_group_prefs('DuhokForum_7'); return false" onclick="toggle_group('DuhokForum_7'); return false;" href="index.php?id=DuhokForum_7#GroupDuhokForum_7" target="_self">
	      <img id="button_DuhokForum_7" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_7" style="DISPLAY: none">
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=pm');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=pm');"><? print $lang['others']['sendmsg']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=special');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=special');"><? print $lang['others']['ihdaa']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=best');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=best');"><? print $lang['others']['best']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=msg');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=msg');"><? print $lang['others']['welcome']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=ads');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=ads');"><? print $lang['others']['ads']; ?></a>
        </div>
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=adsense');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=adsense');"><? print $lang['others']['adsense']; ?></a>
        </div>	
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=haking');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=haking');"><? print $lang['admin']['haking_members']; ?></a>
        </div>			
        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=firewall');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=firewall');"><? print $lang['others']['firewall']; ?></a>
        </div>		
              </div>


<a name="GroupDuhokForum_3"></a>
      <table class="navtitle" ondblclick="toggle_group('DuhokForum_3'); return false;" cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr>
          <td><font color="#ffffff"><strong><? print $lang['others']['repair']; ?></strong></font></td>
          <td align="left">
    	  <a oncontextmenu="toggle_group('DuhokForum_3'); save_group_prefs('DuhokForum_3'); return false" onclick="toggle_group('DuhokForum_3'); return false;" href="index.php?id=DuhokForum_3#GroupDuhokForum_3" target="_self">
	      <img id="button_DuhokForum_3" title="<? print $lang['others']['open_menu']; ?>" alt="" src="<? print $admin_folder; ?>/images/cp_expand.gif" border="0"></a>
	      </td>
        </tr>
      </table>
      <div class="navgroup" id="group_DuhokForum_3" style="DISPLAY: none">

        <div class="navlink-normal" onmouseover="this.className='navlink-hover';" onclick="nav_goto('cp_home.php?mode=phpinfo');" onmouseout="this.className='navlink-normal'">
        <a class="menu" href="javascript:nav_goto('cp_home.php?mode=phpinfo');"><? print $lang['others']['phpinfo']; ?></a>
        </div>
      </div>


    </div>
    </td>
  </tr>
</table>

</body>
</html>
