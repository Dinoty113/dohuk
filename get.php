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
@require_once("./engine/function.php");
@require_once("./engine/admin_function.php");
@require_once("./engine/engine_requires.php");
@require_once("icons.php");
@require_once("converts.php");
@require_once("./engine/seo.php");
@require_once("head.php");



error_reporting(-1);
ini_set('display_errors', 'On');
if($type !="css"){
	header("Location: ".index()."");
}
if($type == "css"){
	if($method != "css" && $method != "editor"){
		header("Location: ".index()."");
	}
	header("Content-type: text/css", true);
	if($method == "css"){
		      if (isset($DBMemberID) && $DBMemberID != "" && $DBMemberID > 0) {
				$query = "SELECT * FROM " . $Prefix . "MEMBERS WHERE MEMBER_ID = ".$DBMemberID." ";
				$result = DBi::$con->query($query);
				if($result->num_rows > 0){
					$rs=$result->fetch_array();
					$ProMemberID = $rs['MEMBER_ID'];
					$ProMemberOPT = $rs['M_OPT'];
					$ProMemberSkin = $rs['M_SKIN'];
				}
			  }
			 if(!isset($ProMemberOPT) || $ProMemberOPT == ""){
				$ProMemberOPT = "100";
			 }
			if(!isset($ProMemberSkin) || $ProMemberSkin == ""){
				$ProMemberSkin = "17";
			}
 $string = file_get_contents("styles/style_".$ProMemberSkin.".css");
 $firstpat = "/TABLE.grid {/";
 $firstrep = "TABLE.asdajsdnajsdnajd12312snasjdasd {";
 if(strpos($string,"opacity=100")){
 $secpat = "/opacity=100/";
 $secrep = "opacity=".$ProMemberOPT."";
 $thrdpat = "/0.100/";
 $thrdreps = $ProMemberOPT/100;
 $thrdrep = "".$thrdreps."";
 }
 if(strpos($string,"opacity=90")){
 $secpat = "/opacity=90/";
 $secrep = "opacity=".$ProMemberOPT."";
 $thrdpat = "/0.9/";
 $thrdreps = $ProMemberOPT/100;
 $thrdrep = "".$thrdreps."";
 }
 $fthpat = "/url\(/";
 $fthrep = "url(styles/";
 $string = preg_replace($firstpat, $firstrep, $string);
 $string = preg_replace($secpat, $secrep, $string);
 $string = preg_replace($thrdpat, $thrdrep, $string);
 $string = preg_replace($fthpat, $fthrep, $string);
 echo $string;
	}
	if($method == "editor"){
		echo "body {".M_Style_Form_e."; direction:rtl;}";
	}
}

?>