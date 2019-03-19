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
if (file_exists("install.php")) {
header("Location: install.php");
}
date_default_timezone_set(UTC);
error_reporting(-1);
ini_set('display_errors', 'On');
require_once("./engine/function.php");
require_once("./engine/admin_function.php");
require_once("./engine/engine_requires.php");
require_once("icons.php");
require_once("converts.php");
require_once("./engine/seo.php");

require_once("header.php");
require_once("session.php");



	
switch ($mode) {
     case "":
          require_once("home.php");
     break;
	 case "noti":
          require_once("notification.php");
     break;
     case "f":
          require_once("forum.php");
     break;
     case "fa":
          require_once("forum_archive.php");
     break;	 
     case "c":
          require_once("cat.php");
     break;
     case "ad":
          require_once("admin_ads.php");
     break;	 
     case "add_ichraf":
          require_once("add_ichraf.php");
     break;
     case "register_member":
          require_once("register.php");
     break;	 
     case "members":
          require_once("members.php");
     break;
     case "profile":
          require_once("profile.php");
     break;
     case "member":
          require_once("member.php");
     break;	 
     case "add_cat_forum":
          require_once("add_cat_forum.php");
     break;
     case "lock":
          require_once("lock.php");
     break;
     case "cat_forum_info":
          require_once("cat_forum_info.php");
     break;
     case "open":
          require_once("open.php");
     break;
     case "delete":
          require_once("delete.php");
     break;
     case "order":
          require_once("order.php");
     break;
     case "editor":
if(preg_match('/MSIE(.*)/i',$_SERVER['HTTP_USER_AGENT'])){	 
          require_once("editor_new.php");		  
} else {
          require_once("editor.php");		  
}		  
     break;
     case "post_info":
          require_once("post_info.php");
     break;
     case "admin":
          require_once("admin/index.php");
     break;
     case "t":
          require_once("topic.php");
     break;
     case "like":
          require_once("like.php");
     break;	 
     case "forget_pass":
          require_once("forget_pass.php");
     break;
     case "pm":
          require_once("message.php");
     break; 
     case "sendmsg":
          require_once("send_message.php");
     break;
     case "mail":
          require_once("forum_mail.php");
     break;
     case "svc":
          require_once("svc.php");
     break;
     case "user_svc":
          require_once("user_svc.php");
     break;
     case "rules":
          require_once("rules.php");
     break;
     case "option":
          require_once("topic_option.php");
     break;
     case "r_option":
          require_once("reply_option.php");
     break;	 
     case "changename":
          require_once("change_name.php");
     break;
     case "sendpm":
          require_once("pm_to_admin.php");
     break;
     case "active":
          require_once("active.php");
     break;
     case "finfo":
          require_once("forum_info.php");
     break;
     case "other_cat_add":
          require_once("other_cat_add.php");
     break;
     case "other_cat_info":
          require_once("other_cat_info.php");
     break;
     case "files":
          require_once("files.php");
     break;
     case "topicmonitor":
          require_once("topicmonitor.php");
     break;
     case "search":
          require_once("search.php");
     break;	 
     case "stat":
          require_once("topstat.php");
     break;	 
     case "modstat":
          require_once("modstat.php");
     break;	 
     case "forumstat":
          require_once("forumstat.php");
     break;	 
     case "p":
          require_once("print.php");
     break;
     case "posts":
          require_once("posts.php");
     break;
     case "mf":
          require_once("medal_files.php");
     break;
     case "gf":
          require_once("groups_files.php");
     break;	 
     case "admin_svc":
          require_once("admin_svc.php");
     break;
     case "requestmon":
          require_once("requestmon.php");
     break;
     case "moderate":
          require_once("moderation.php");
     break;
     case "mods":
          require_once("moderator_info.php");
     break;
     case "policy":
          require_once("policy.php");
     break;
     case "topics":
          require_once("topics.php");
     break;
     case "notify":
          require_once("notify.php");
     break;
     case "notifylist":
          require_once("notifylist.php");
     break;
     case "archive":
          require_once("archive.php");
     break;
     case "tellfriend":
          require_once("tellfriend.php");
     break;
     case "list":
          require_once("list.php");
     break;
     case "list_forum":
          require_once("list_forum.php");
     break;	 
     case "email_to_m":
          require_once("email_to_m.php");
     break;
     case "show":
          require_once("mem_forum.php");
     break;
     case "solve_topics":
          require_once("solve_topics.php");
     break;	 
     case "details":
          require_once("details.php");
     break;
     case "admin_notify":
          require_once("admin_notify.php");
     break;
     case "ip":
          require_once("ip.php");
     break;
     case "permission":
          require_once("permission.php");
     break; 
     case "what_add":
          require_once("what_add.php");
     break;
     case "what_info":
          require_once("what_info.php");
     break;
     case "ihdaa_add":
          require_once("ihdaa_add.php");
     break;
     case "filtre":
          require_once("filtre.php");
     break;
     case "quick":
          require_once("quick.php");
     break;
     case "social":
          require_once("social.php");
     break;	 
case "activ_mem": 
require_once("activ_by_email.php");
 break;	 
	default;
	echo' <meta http-equiv="refresh" content="0;URL=index.php">';
	break;
}


require_once("footer.php");
ob();


?>
