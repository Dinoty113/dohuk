<?php
if (@eregi("solve_topics.php","$_SERVER[PHP_SELF]")) {
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

if($Mlevel == 4 && $DBMemberID == 1) {

echo' <center> <b> <table align="center"> ';

echo'<table align="center"><tr><td class="optionsbar_menus"><font size="5"> '.$lang['other']['solve_topics'].' </font></td></tr></table> <br> <br> ';

if($type == "") {

echo' <form method="post" action="index.php?mode=solve_topics&type=insert"><table align="center"><tr><td class="optionsbar_menus"> <font size="3"> '.$lang['other']['solve_topics_desc'].' </font></td></tr></table> <br> <br> ';

echo' <table align="center"><tr><td class="optionsbar_menus"><textarea name="text" rows="10" cols="50"></textarea></td></tr></table> ';	

echo' <br> <br> ';

echo' <input type="submit" value="'.$lang['other']['enter_solve'].'"> ';

echo' </form> ';
	
}

if($type == "insert") {

$topic_id = $_POST['text'];

$topic_id = explode("\n", $text);	

foreach($topic_id as $t_id) {	

$text = addslashes(addslashes(topics("MESSAGE", $t_id)));

@DBi::$con->query("UPDATE ".prefix ."TOPICS SET T_MESSAGE = ('$text') WHERE TOPIC_ID = '$t_id' ") or die(DBi::$con->error);

}
	
echo' <table align="center"><tr><td class="optionsbar_menus"><font size="3">'.$lang['other']['done_solve_topics'].' </font></td></tr></table><br> <br> ';
	
echo' <table align="center"><tr><td class="optionsbar_menus"><a href="index.php?mode=solve_topics"><font size="3">'.$lang['all']['click_here_to_back'].'</font></a></td></tr></table> <br> <br> ';	
	
}

echo' <table align="center"><tr><td class="optionsbar_menus"><font size="2">By Temy - Startimes</font></td></tr></table> ';

echo'</table> </b> </center> ';

} else {
	
redirect();
	
}

?>