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

	if($type != "" && $type != "activ" && $type != "send_activ" && $type != "password" && $type != "password_set") {
	redirect();	
	
	}

			     function SelectCode($id){

         $CheckSQL =  DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE MEMBER_ID = '".$id."' "  ) or die ( );
            if (mysqli_num_rows($CheckSQL) > 0){
		     $ResourceObject =  mysqli_fetch_object($CheckSQL);
             $mCode = $ResourceObject->M_CODE;
		    }
		     else return false;
		     return $mCode ;
  
    }
	
				     function SelectEmail($id)
    {
         $CheckSQL =  DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE MEMBER_ID = '".$id."' "  ) or die ( );
            if (mysqli_num_rows($CheckSQL) > 0)
	        {
		     $ResourceObject =  mysqli_fetch_object($CheckSQL);
             $mEmail = $ResourceObject->M_EMAIL;
		    } else return false;
		 return $mEmail ;
  
    }


	if($type == "") {	
		
	$the_activ_num = DBi::$con->real_escape_string(trim($_GET['activ_num']));
	$the_user = DBi::$con->real_escape_string(trim($_GET['user']));
     if(isset($the_activ_num) && isset($the_user) && (int) $the_user > 0 )
     {
         $userName = $the_activ_num;

         $sql=DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE MEMBER_ID = '".(int)$the_user."' AND M_STATUS = 4 ") or die (DBi::$con->error); 

          if(mysqli_num_rows($sql)>0)
          { 
            $rs=mysqli_fetch_array($sql); 
            $user_name=$rs['M_NAME'];
            $code=$rs['M_CODE'];
             if($userName == $code)
             { 


               $updat = "UPDATE ".prefix."MEMBERS SET M_STATUS = '2' WHERE MEMBER_ID = '".(int)$the_user."'"; DBi::$con->query($updat) or die                       (DBi::$con->error);

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['your_email_is_active'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
		
            }else

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['there_is_unkown_error'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
            }else

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['there_is_unkown_error'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
            }else

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['there_is_unkown_error'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';   

	} 
	elseif($type == "activ") {
		
         $userName = DBi::$con->real_escape_string(htmlspecialchars($_POST['activ_number']));
		$id = DBi::$con->real_escape_string(htmlspecialchars($_POST['mid']));
         $sql=DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE MEMBER_ID = '".(int)$id."' AND M_STATUS = 4 ") or die (DBi::$con->error); 

          if(mysqli_num_rows($sql)>0)
          { 
            $rs=mysqli_fetch_array($sql); 
            $user_name=$rs['M_NAME'];
            $code=$rs['M_CODE'];
             if($userName == $code)
             { 

               $updat = "UPDATE ".prefix."MEMBERS SET M_STATUS = '2' WHERE MEMBER_ID = '".(int)$id."'"; DBi::$con->query($updat) or die                       (DBi::$con->error);

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['your_email_is_actived'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
		
            }else

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['your_activ_number_is_wrong'].'</font><br><br>
				<a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
		  }
	}

		elseif($type == "send_activ") {
		
		if($id != "") {
		 $code = SelectCode($id);
		 $email = SelectEmail($id);
		 $url_final   = Get_deric() . 'index.php?mode=activ_mem&activ_num='.$code.'&user='.(int)$id;
$message     = '<p align="right">'.$lang['e-emails']['activ_by_email_message_1'].' '.member_name($id).'<br><br>'.$lang['e-emails']['activ_by_email_message_2'].' '.$forum_title.'<br><br>'.$lang['e-emails']['activ_by_email_message_3'].'<br><br><a href="'.$url_final.'">'.$url_final.'</a><br><br>'.$lang['e-emails']['activ_by_email_message_4'].' '.$code.'<br><br>'.$lang['e-emails']['activ_by_email_message_5'].' '.$forum_title.'</p>';
$title       = ''.$lang['e-emails']['tellfriend_subject_1'].' '.$forum_title.' : '.$lang['e-emails']['activ_by_email_subject'].'';		 
 $headers  = "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-type: text/html; charset=utf8\r\n"; 
 $headers .= "From: ".$admin_email."";

		 
		  mail($email, $title, $message, $headers);

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['activ_email_is_sending'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
		
            }else

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['there_is_unkown_error'].'</font><br><br>
				<a href="JavaScript:history.go(-1)">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
		  }
		
	



elseif($type == "password") {
   	$the_activ_num = DBi::$con->real_escape_string(trim($_GET['activ_num']));
     if($the_activ_num != "") {

         $sql=DBi::$con->query("SELECT * FROM ".prefix."MEMBERS WHERE M_CODE = '".$the_activ_num."' ") or die (DBi::$con->error); 

          if(mysqli_num_rows($sql)>0)
          { 
            $rs=mysqli_fetch_array($sql); 
            $the_user=$rs['MEMBER_ID'];
            $user_name=$rs['M_NAME'];
            $user_email=$rs['M_EMAIL'];
            $code=$rs['M_CODE'];
           
echo'
<br>
	<center>
	<table width="99%" border="1">
		<tr class="normal">
			<td class="list_center" colSpan="10">
				<font size="5" color="red"><br><b>
				<center>'.$lang['activ_password']['your_email_is_activ'].'<br><br>
		<center>'.$lang['activ_password']['insert_your_new_password_here'].'
		<br><br>
		<center>';
		?>
		<script>
	var easypass = new Array (
"123456","123456789","123123","000000","111111","12345678","112233","666666","654321",
"1234567","123321","555555","121212","999999","222222","101010","102030","123654",
"987654","987654321","0123456","0123456789");


function submitForm()
{
if (pass.pass1.value.length == 0)
	{
	confirm(enter_your_pass);
	return;
	}

if (pass.pass1.value.length < 6)
	{
	confirm(enter_your_pass_4);
	return;
	}

if (pass.pass2.value.length == 0)
	{
	confirm(enter_your_confirm_pass);
	return;
	}

if (pass.pass1.value  != pass.pass2.value)
	{
	confirm(enter_your_pass_and_confirm);
	return;
	}

if (pass.pass1.value  == pass.user_name.value)
	{
	confirm(your_pass_no_your_name);
	return;
	}
	
if (pass.pass1.value.toLowerCase()  == pass.user_name.value.toLowerCase())
	{
	confirm(your_pass_no_your_name);
	return;
	}	

if (pass.pass1.value.toLowerCase()  == pass.user_email.value.toLowerCase())
	{
	confirm(your_pass_no_your_email);
	return;
	}
	
var x;

for (x = 0; x < easypass.length; x++)
{
if (pass.pass1.value == easypass[x])
	{
	confirm(easy_pass);
	return;
	}

}
pass.submit();
}
		</script>
		<?php
		echo'
<form name="pass" method="post" action="index.php?mode=activ_mem&type=password_set">
 <input value="'.$the_user.'" type="hidden" name="mid">
 <input value="'.$code.'" type="hidden" name="code">
 <input value="'.$user_name.'" type="hidden" name="user_name">
 <input value="'.$user_email.'" type="hidden" name="user_email">
<center>
'.$lang['activ_password']['your_password'].'
<input class="insidetitle" name="pass1" type="password" style="WIDTH: 200px;" rows="1" cols="20">
<br><br>
'.$lang['activ_password']['your_password_again'].'
<input class="insidetitle" name="pass2" type="password" style="WIDTH: 200px;" rows="1" cols="20">
<br><br>
<input onclick="submitForm()" type="button" value="'.$lang['profile']['insert_info'].'">
</center></form>

				</b></font>
			</td>
		</tr>
	</table>
	</center><xml>
';

		
            }else

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['there_is_unkown_error'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
            }else

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_email']['there_is_unkown_error'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';   

	}	elseif($type == "password_set") {
		$id = DBi::$con->real_escape_string(htmlspecialchars($_POST['mid']));
         $code = DBi::$con->real_escape_string(htmlspecialchars($_POST['code']));
         $email = DBi::$con->real_escape_string(htmlspecialchars($_POST['user_email']));
		 $name = DBi::$con->real_escape_string(htmlspecialchars($_POST['user_name']));
         $passowrd = DBi::$con->real_escape_string(htmlspecialchars($_POST['pass1']));
         $pass = md5($passowrd);
         $updat = "UPDATE ".prefix."MEMBERS SET M_PASSWORD = '$pass' WHERE M_CODE = '$code' AND M_NAME = '$name' AND M_EMAIL = '$email' AND MEMBER_ID = '".(int)$id."'"; DBi::$con->query($updat) or die                       (DBi::$con->error);

		echo'<center>
		<table width="99%" border="1">
			<tr class="normal">
				<td class="list_center" colSpan="10"><font size="5" color="red"><br>'.$lang['activ_password']['your_password_is_change'].'</font><br><br>
				<meta http-equiv="Refresh" content="3; URL=index.php">
				<a href="index.php">'.$lang['all']['click_here_to_go_home'].'</a><br><br>
				</td>
			</tr>
		</table>
		</center>';
		
	}
	
?>