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

$http_host = $_SERVER['HTTP_HOST'];
if(isset($_SERVER['HTTP_REFERER'])){
$referer = $_SERVER['HTTP_REFERER'];
}
else{
	$referer = "";
}
//////////////////////////////////////////////////////////////////
if (isset($_GET['mode'])){ 
$mode = DBi::$con->real_escape_string(trim($_GET['mode']));
define('mode', $mode);
}
else{
	$mode= "";
}
///////////////////////////////////////////////////////
if (isset($_GET['step'])){ 
$step = DBi::$con->real_escape_string(trim($_GET['step']));
define('step', $step);
}
else{
	$step ="";
}
////////////////////////////////////////////////////////////////////
if (isset($_GET['enter'])){ 
$enter = DBi::$con->real_escape_string(trim($_GET['enter']));
define('enter', $enter);
}
else{
	$enter = "";
}
////////////////////////////////////////////////////////////////////////
if (isset($_GET['type'])){ 
$type = DBi::$con->real_escape_string(trim($_GET['type']));
define('type', $type);
}
else{
	$type = "";
}
////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['prd'])){
$prd = DBi::$con->real_escape_string(trim($_GET['prd']));
define('prd', $prd);
}
else{
	$prd= "";
}
/////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['prm'])){
$prm = DBi::$con->real_escape_string(trim($_GET['prm']));
define('prm', $prm);
}
else{
	$prm = "";
}
////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['market'])){
$market = DBi::$con->real_escape_string(trim($_GET['market']));
define('market', $market);
}
else{
	$market = "";
}
/////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['ann'])){
$ann = DBi::$con->real_escape_string(trim($_GET['ann']));
define('ann', $ann);
}
else{
	$ann = "";
}
///////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['hash'])){
$hash = DBi::$con->real_escape_string(trim($_GET['hash']));

}
else{
	$hash = "";
}
////////////////////////////////////////
if (isset($_GET['method'])){
$method = DBi::$con->real_escape_string(trim($_GET['method']));
define('method', $method);
}
else{
	$method = "";
}
///////////////////////////////////////////////
if (isset($_GET['group'])){
$group = DBi::$con->real_escape_string(trim($_GET['group']));
define('group', $group);
}
else{
	$group = "";
}
/////////////////////////////////////////
if (isset($_GET['mail'])){
$mail = DBi::$con->real_escape_string(trim($_GET['mail']));
define('mail', $mail);
}
else{
	$mail = "";
}
///////////////////////////////////////////////
if (isset($_GET['msg'])){
$msg = DBi::$con->real_escape_string(trim($_GET['msg']));
define('msg', $msg);
}
else{
	$msg = "";
}
///////////////////////////////////////////////
if (isset($_GET['svc'])){
$svc = DBi::$con->real_escape_string(trim($_GET['svc']));
define('svc', $svc);
}
else{
	$svc = "";
}
///////////////////////////////////////////////
if (isset($_GET['sel'])){
$sel = DBi::$con->real_escape_string(trim($_GET['sel']));

}
else{
	$sel = "";
}
///////////////////////////////////////////////
if (isset($_GET['show'])){
$show = DBi::$con->real_escape_string(trim($_GET['show']));
}
else{
	$show= "";
}
///////////////////////////////////////////////
if (isset($_GET['app'])){
$app = DBi::$con->real_escape_string(trim($_GET['app']));
define('app', $app);
}
else{
	$app = "";
}
///////////////////////////////////////////////
if (isset($_GET['days'])){
$days = DBi::$con->real_escape_string(trim($_GET['days']));
define('days', $days);

}
else{
	$days = "";
}
///////////////////////////////////////////////
if (isset($_GET['scope'])){
$scope = DBi::$con->real_escape_string(trim($_GET['scope']));
define('scope', $scope);
}
else{
	$scope = "";
}
///////////////////////////////////////////////
if (isset($_GET['sg'])){
$sg = DBi::$con->real_escape_string(trim($_GET['sg']));

}
else{
	$sg = "";
}
///////////////////////////////////////////////
if (isset($_GET['ch'])){
$ch = DBi::$con->real_escape_string(trim($_GET['ch']));
}
else{
	$ch = "";
}
///////////////////////////////////////////////
if (isset($_GET['tz'])){
$tz = DBi::$con->real_escape_string(trim($_GET['tz']));
}
else{
	$tz = "";
}
///////////////////////////////////////////
if (isset($_GET['ad'])){
$ad = DBi::$con->real_escape_string(trim($_GET['ad']));
define('ad', $ad);
}
else{
	$ad = "";
}
/////////////////////////////////////////////////////////
if (isset($_GET['c'])){
$c = DBi::$con->real_escape_string(trim($_GET['c']));
define('c', $c);
}
else{
	$c = "";
}
////////////////////////////////////////////////////////
if (isset($_GET['f'])){
$f = DBi::$con->real_escape_string(trim($_GET['f']));
define('f', $f);
}
else{
	$f = "";
}
///////////////////////////////////////////////////
if (isset($_GET['t'])){
$t = DBi::$con->real_escape_string(trim($_GET['t']));
define('t', $t);
}
else{
	$t ="";
}
///////////////////////////////////////////////////////
if (isset($_GET['r'])){
$r = DBi::$con->real_escape_string(trim($_GET['r']));
define('r', $r);
}
else{
	$r = "";
}
////////////////////////////////////////////////
if (isset($_GET['m'])){
$m = DBi::$con->real_escape_string(trim($_GET['m']));
define('m', $m);
}
else{
	$m = "";
}
////////////////////////////////////////////////
if (isset($_GET['err'])){
$err = DBi::$con->real_escape_string(trim($_GET['err']));
define('err', $err);
}
else{
	$err = "";
}
///////////////////////////////////////////////
if (isset($_GET['id'])){
$id = DBi::$con->real_escape_string(trim($_GET['id']));
define('id', $id);
}
else{
	$id = "";
}
//////////////////////////////////////////////////
if (isset($_GET['pm'])){
$pm = DBi::$con->real_escape_string(trim($_GET['pm']));
}
else{
	$pm = "";
}
///////////////////////////////////////////////
if (isset($_GET['n'])){
$n = DBi::$con->real_escape_string(trim($_GET['n']));
define('n', $n);
}
else{
	$n = "";
}
///////////////////////////////////////////////
if (isset($_GET['pg'])){
$pg = DBi::$con->real_escape_string((int)trim($_GET['pg']));
define('pg', $pg);
}
else{
	$pg = "";
}
////////////////////////////////////////////////
if (isset($_GET['active'])){
$active = DBi::$con->real_escape_string(trim($_GET['active']));
}
else{
$active = "";
}
/////////////////////////////////////////////////
if (isset($_GET['aid'])){
$aid = DBi::$con->real_escape_string(trim($_GET['aid']));
}
else{
	$aid = "";
}
///////////////////////////////////////////////
if (isset($_GET['mod_option'])){
$mod_option = DBi::$con->real_escape_string(trim($_GET['mod_option']));
}
else{
	$mod_option = "";
}
///////////////////////////////////////////////
if (isset($_GET['quote'])){
$quote = DBi::$con->real_escape_string(trim($_GET['quote']));
}
else{
$quote = "";	
}
////////////////////////////////////////////////
if (isset($_GET['author'])){
$author = DBi::$con->real_escape_string(trim($_GET['author']));
}
else{
	$author = "";
}
///////////////////////////////////////////////
if (isset($_GET['tdate'])){
$tdate = DBi::$con->real_escape_string(trim($_GET['tdate']));
}
else{
	$tdate = "";
}
///////////////////////////////////////////////

if (isset($_GET['rdate'])){
$rdate = DBi::$con->real_escape_string(trim($_GET['rdate']));
}
else{
	$rdate = "";
}
///////////////////////////////////////////////

if (isset($_GET['src'])){
$src = DBi::$con->real_escape_string(trim($_GET['src']));
}
else{
	$src = "";
}
///////////////////////////////////////////////
if (isset($_GET['from'])){
$pm_from = DBi::$con->real_escape_string(trim($_GET['from']));
}
else{
	$pm_from = "";
}
///////////////////////////////////////////////
if (isset($_GET['auth'])){
$auth = DBi::$con->real_escape_string(trim($_GET['auth']));
}
else{
	$auth = "";
}
//////////////////////////////////////////////////////////
if (isset($_GET['vote'])){
$vote = DBi::$con->real_escape_string(trim($_GET['vote']));
}
else{
	$vote = "";
}
///////////////////////////////////////////////
define('http_host', $http_host);
define('referer', $referer);



?>