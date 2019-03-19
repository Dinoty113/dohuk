<?php
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

if(($t && ($t == "" or $t == 0)) or ($r && ($r == "" or $r == 0))) {
redirect();	
}

$date = time();


				if(type == "insert"){
				if($Mlevel > 0){
				$hidden = topics("HIDDEN", $t);
				$holded = topics("HOLDED", $t);
				$status = topics("STATUS", $t);
				$unmoderated = topics("UNMODERATED", $t);
				$chk_login_topic = chk_login_topic($t);
				$f = topics("FORUM_ID", $t);
				$level = forums("F_LEVEL", $f);
				$hide = forums("HIDE", $f);
				$check_forum_login = check_forum_login($f);
				if($level == 0 or $level > 0 && $Mlevel >= $level) {
				if($hide == 0 or $hide == 1 && $check_forum_login == 1) {	
				if(($hidden == 0 or $hidden == 1 && $chk_login_topic == 1 or $t_hidden == 1 && allowed($f, 2) == 1) && ($holded == 0 or $holded == 1 && allowed($f, 2) == 1) && ($status != 2 or $status == 2 && allowed($f, 2) == 1) && ($unmoderated == 0 or $unmoderated == 1 && allowed($f, 2) == 1)) {
						$alike = DBi::$con->query("SELECT MEMBER_ID FROM ".prefix."TOPICS_LIKES WHERE TOPIC_ID = '$t'");
						$row = mysqli_fetch_object($alike);
						$nid = $row->MEMBER_ID;
	
			if($nid == $DBMemberID){
						
						header("Location: ".referer."");
									}else{
						$query = "INSERT INTO " . $Prefix . "TOPICS_LIKES (TOPIC_ID, MEMBER_ID, DATE) values ($t, $DBMemberID, $date)";
						DBi::$con->query($query, $connection) or die (DBi::$con->error);		

												header("Location: ".referer."");

										}
				} else {
				header("Location: ".referer."");	
				}	
				} else {
				header("Location: ".referer."");	
				}	
				} else {
				header("Location: ".referer."");	
				}					
				} else{
				header("Location: ".referer."");
				}

									}


				elseif ($type == "dislike") {
				if ($Mlevel > 0) {
				$hidden = topics("HIDDEN", $t);
				$holded = topics("HOLDED", $t);
				$status = topics("STATUS", $t);
				$unmoderated = topics("UNMODERATED", $t);
				$chk_login_topic = chk_login_topic($t);
				$f = topics("FORUM_ID", $t);
				$level = forums("F_LEVEL", $f);
				$hide = forums("HIDE", $f);
				$check_forum_login = check_forum_login($f);					
				if($level == 0 or $level > 0 && $Mlevel >= $level) {
				if($hide == 0 or $hide == 1 && $check_forum_login == 1) {	
				if(($hidden == 0 or $hidden == 1 && $chk_login_topic == 1 or $t_hidden == 1 && allowed($f, 2) == 1) && ($holded == 0 or $holded == 1 && allowed($f, 2) == 1) && ($status != 2 or $status == 2 && allowed($f, 2) == 1) && ($unmoderated == 0 or $unmoderated == 1 && allowed($f, 2) == 1)) {					
							$query = "DELETE FROM " . $Prefix . "TOPICS_LIKES WHERE TOPIC_ID = '$t' AND MEMBER_ID = '$DBMemberID' ";
							DBi::$con->query($query, $connection) or die (DBi::$con->error);

													header("Location: ".referer."");


    
				} else {
				header("Location: ".referer."");	
				}	
				} else {
				header("Location: ".referer."");	
				}	
				} else {
				header("Location: ".referer."");	
				}					
				} else{
				header("Location: ".referer."");
				}
											}
											
				elseif($type == "tlike"){
				$hidden = topics("HIDDEN", $t);
				$holded = topics("HOLDED", $t);
				$status = topics("STATUS", $t);
				$unmoderated = topics("UNMODERATED", $t);
				$chk_login_topic = chk_login_topic($t);
				$f = topics("FORUM_ID", $t);
				$level = forums("F_LEVEL", $f);
				$hide = forums("HIDE", $f);
				$check_forum_login = check_forum_login($f);					
				if($level == 0 or $level > 0 && $Mlevel >= $level) {
				if($hide == 0 or $hide == 1 && $check_forum_login == 1) {	
				if(($hidden == 0 or $hidden == 1 && $chk_login_topic == 1 or $t_hidden == 1 && allowed($f, 2) == 1) && ($holded == 0 or $holded == 1 && allowed($f, 2) == 1) && ($status != 2 or $status == 2 && allowed($f, 2) == 1) && ($unmoderated == 0 or $unmoderated == 1 && allowed($f, 2) == 1)) {										
							$member_like = DBi::$con->query("SELECT * FROM ".prefix."TOPICS WHERE TOPIC_ID = '$t'   ");
							while($rs = mysqli_fetch_array($member_like)){
								echo'
						<table bgcolor="gray" class="grid" cellspacing="1" cellpadding="0" align="center">
							<tr>
					<td class="cat" colspan="2"><font color="white">'.$lang['topics']['topics_likes'].' : </font><a href="index.php?mode=t&t='.$rs[TOPIC_ID].'" title="'.$rs[T_SUBJECT].'"><font color="white">'.$rs[T_SUBJECT].'</font></a></td>
							</tr>';
														       			  }
							$Slike = DBi::$con->query("SELECT * FROM ".prefix."TOPICS_LIKES WHERE TOPIC_ID = '$t' ");
						if(mysqli_num_rows($Slike) == 0) {
						echo'
							<tr>
					
					<td class="f1" align="center">'.$lang['topics']['no_likes'].'</td>
									</tr>
						';
						}	
				if(mysqli_num_rows($Slike)>0){
				while($Flike = mysqli_fetch_array($Slike)){
								echo'
									<tr>
					<td class="f1" align="center">'.link_profile(member_name($Flike['MEMBER_ID']), $Flike['MEMBER_ID']).'
					</td>
					<td class="f1" align="center">'.date_and_time($Flike['DATE']).'</td>
									</tr>';
														 } }
											echo'</table>';
														} else {
				header("Location: ".referer."");	
				}	
				} else {
				header("Location: ".referer."");	
				}					
				} else{
				header("Location: ".referer."");
				}	
										}
										
				if(type == "r_insert"){
					$t = replies("TOPIC_ID", $r);
				if(mlv > 0){
				$hidden = replies("HIDDEN", $r);
				$holded = replies("HOLDED", $r);
				$status = replies("STATUS", $r);
				$unmoderated = replies("UNMODERATED", $r);
				$f = replies("FORUM_ID", $r);
				$level = forums("F_LEVEL", $f);
				$hide = forums("HIDE", $f);
				$check_forum_login = check_forum_login($f);
				if($level == 0 or $level > 0 && $Mlevel >= $level) {
				if($hide == 0 or $hide == 1 && $check_forum_login == 1) {	
				if(($hidden == 0 or $t_hidden == 1 && allowed($f, 2) == 1) && ($holded == 0 or $holded == 1 && allowed($f, 2) == 1) && ($status != 2 or $status == 2 && allowed($f, 2) == 1) && ($unmoderated == 0 or $unmoderated == 1 && allowed($f, 2) == 1)) {					
						$alike = DBi::$con->query("SELECT MEMBER_ID FROM ".prefix."REPLIES_LIKES WHERE REPLY_ID = '$r'");
						$row = mysqli_fetch_object($alike);
						$nid = $row->MEMBER_ID;
	
			if($nid == $DBMemberID){
						
						header("Location: ".referer."");
									}else{
						$query = "INSERT INTO " . $Prefix . "REPLIES_LIKES (REPLY_ID, MEMBER_ID, DATE) values ($r, $DBMemberID, $date)";
						DBi::$con->query($query, $connection) or die (DBi::$con->error);		

												header("Location: ".referer."");

										}
				} else {
				header("Location: ".referer."");	
				}
				} else {
				header("Location: ".referer."");	
				}
				} else {
				header("Location: ".referer."");	
				}				
							}
									else{
						header("Location: ".referer."");

										}

									}


				elseif ($type == "r_dislike") {
										$t = replies("TOPIC_ID", $r);
				$hidden = replies("HIDDEN", $r);
				$holded = replies("HOLDED", $r);
				$status = replies("STATUS", $r);
				$unmoderated = replies("UNMODERATED", $r);
				$f = replies("FORUM_ID", $r);
				$level = forums("F_LEVEL", $f);
				$hide = forums("HIDE", $f);
				$check_forum_login = check_forum_login($f);
				if($level == 0 or $level > 0 && $Mlevel >= $level) {
				if($hide == 0 or $hide == 1 && $check_forum_login == 1) {	
				if(($hidden == 0 or $t_hidden == 1 && allowed($f, 2) == 1) && ($holded == 0 or $holded == 1 && allowed($f, 2) == 1) && ($status != 2 or $status == 2 && allowed($f, 2) == 1) && ($unmoderated == 0 or $unmoderated == 1 && allowed($f, 2) == 1)) {	
				if ($Mlevel > 0) {
							$query = "DELETE FROM " . $Prefix . "REPLIES_LIKES WHERE REPLY_ID = '$r' AND MEMBER_ID = '$DBMemberID' ";
							DBi::$con->query($query, $connection) or die (DBi::$con->error);

													header("Location: ".referer."");


    
				} else {
				header("Location: ".referer."");	
				}
				} else {
				header("Location: ".referer."");	
				}
				} else {
				header("Location: ".referer."");	
				}
				} else {
				header("Location: ".referer."");	
				}				
								
											}
											
				elseif($type == "rlike"){
				$hidden = replies("HIDDEN", $r);
				$holded = replies("HOLDED", $r);
				$status = replies("STATUS", $r);
				$unmoderated = replies("UNMODERATED", $r);
				$f = replies("FORUM_ID", $r);
				$level = forums("F_LEVEL", $f);
				$hide = forums("HIDE", $f);
				$check_forum_login = check_forum_login($f);
				if($level == 0 or $level > 0 && $Mlevel >= $level) {
				if($hide == 0 or $hide == 1 && $check_forum_login == 1) {	
				if(($hidden == 0 or $t_hidden == 1 && allowed($f, 2) == 1) && ($holded == 0 or $holded == 1 && allowed($f, 2) == 1) && ($status != 2 or $status == 2 && allowed($f, 2) == 1) && ($unmoderated == 0 or $unmoderated == 1 && allowed($f, 2) == 1)) {						
										$t = replies("TOPIC_ID", $r);

							$member_like = DBi::$con->query("SELECT * FROM ".prefix."REPLY WHERE REPLY_ID = '$r'   ");
							while($rs = mysqli_fetch_array($member_like)){
								echo'
						<table bgcolor="gray" class="grid" cellspacing="1" cellpadding="0" align="center">
							<tr>
					<td class="cat" colspan="2"><font color="white">'.$lang['topics']['reply_likes'].' : </font><a href="index.php?mode=t&t='.$rs[TOPIC_ID].'&r='.$rs[REPLY_ID].'" title="'.$rs[REPLY_ID].'"><font color="white">'.$rs[REPLY_ID].'</font></a></td>
							</tr>';
														       			  }
							$Slike = DBi::$con->query("SELECT * FROM ".prefix."REPLIES_LIKES WHERE REPLY_ID = '$r' ");
						if(mysqli_num_rows($Slike) == 0) {
						echo'
							<tr>
					
					<td class="f1" align="center">'.$lang['topics']['no_likes_r'].'</td>
									</tr>
						';
						}	
				if(mysqli_num_rows($Slike)>0){
				while($Flike = mysqli_fetch_array($Slike)){
								echo'
									<tr>
					<td class="f1" align="center">'.link_profile(member_name($Flike['MEMBER_ID']), $Flike['MEMBER_ID']).'
					</td>
					<td class="f1" align="center">'.date_and_time($Flike['DATE']).'</td>
									</tr>';
														 } }
											echo'</table>';
									
				} else {
				header("Location: ".referer."");	
				}
				} else {
				header("Location: ".referer."");	
				}
				} else {
				header("Location: ".referer."");	
				}									
										}										

										?>
