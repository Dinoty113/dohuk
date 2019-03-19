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

function adsense_1($t){
global $adsense_1, $code_1;
$date = topics("DATE", $t);
if($adsense_1 == 1) {
		echo'

		<tr>
			<td width="12%" vAlign="top" class="normal">';
				echo'
				<table width="100%">
		<tr>
			<td align="center"><font size="5"><a href="http://www.google.com"><font color="blue">G</font><font color="red">o</font><font color="yellow">o</font><font color="blue">g</font><font color="green">l</font><font color="red">e</font></a></font></td>
		</tr>
	</table>
				
			</td>';

			echo'
				<td vAlign="top" width="100%" class="normal" colSpan="3">
			<table cellSpacing="0" cellPadding="0" width="100%">
				<tr>
					<td class="posticon" bgColor="red">
					<table cellSpacing="2" width="100%">
						<tr>
							<td width="8%" class="posticon"><nobr>'.normal_time($date).'</nobr></td>
							<td width="92%" class="posticon"><nobr></nobr></td>
							</tr>
							</table>
							</td>
						</tr></table>
					';


echo'<br><center>';
			echo $code_1;
echo'</center><br>';


			echo'
			
							
							</td>';
							
}
}

function adsense_2 () {
global $adsense_2, $code_2;
if($adsense_2 == 1){
  echo'</tbody></table>  
  <table class="grid" id="table1" border="0" cellpadding="2" cellspacing="1" align="center" width="40"> 
  <tbody><tr>            <td>      
 '.$code_2.'
 </td>  
  </tr></tbody></table><br>';
}
}
function adsense_3 () {
global $adsense_3, $code_3;
if($adsense_3 == 1){
  echo'</tbody></table>  
 <br> <table class="grid" id="table1" border="0" cellpadding="2" cellspacing="1" align="center" width="40"> 
  <tbody><tr>            <td>      
 '.$code_3.'
 </td>  
  </tr></tbody></table><br>';
}
}
?>
