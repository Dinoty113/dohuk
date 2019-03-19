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

/////////////// posts ///////////////////
$f_p = "f_all";
if (isset($_POST['f_p'])){ 
$post_f_p = DBi::$con->real_escape_string(htmlspecialchars($_POST['f_p']));
}
if (!empty($post_f_p)){
	$_SESSION['DF_f_p'] = $post_f_p;
	head($_SERVER[REQUEST_URI]);
	} 
if(isset($_SESSION['DF_F_P'])){
$load_f_p = $_SESSION['DF_f_p'];
}
if (!empty($load_f_p)){
	$f_p = $load_f_p;
}
else {
	$f_p = $f_p;
}
$f_posts = "reply";


$i_f_posts = esset_post('f_posts');

$post_f_posts = DBi::$con->real_escape_string(htmlspecialchars($i_f_posts));
if (!empty($post_f_posts)){
	$_SESSION['DF_f_posts'] = $post_f_posts;
	head($_SERVER[REQUEST_URI]);
}
if(isset($_SESSION['DF_f_posts'])){
$df_f_posts = $_SESSION['DF_f_posts'];
}
else{
	$df_f_posts = "";
}
$load_f_posts = $df_f_posts;
if (!empty($load_f_posts)){
	$f_posts = $load_f_posts;
}
else {
	$f_posts = $f_posts;
}
$f_n = "all";
$fn =  esset_post('f_n');

$post_f_n = DBi::$con->real_escape_string(htmlspecialchars($fn));
if (!empty($post_f_n)){
	$_SESSION['DF_f_n'] = $post_f_n;
	head($_SERVER[REQUEST_URI]);
}
$load_f_n = esset_session('DF_f_n');
if (!empty($load_f_n)){
	$f_n = $load_f_n;
}
else {
	$f_n = $f_n;
}
	/////////////// active /////////////////
	
	
if ($active == 'private'){
	$active_type = "prv";
	$post_active_type = DBi::$con->real_escape_string(htmlspecialchars($_POST["active_type"]));
	if (!empty($post_active_type)){
	$_SESSION['DF_active_type'] = $post_active_type;
	head($_SERVER[REQUEST_URI]);
	}
	$load_active_type = $_SESSION['DF_active_type'];
	if (!empty($load_active_type)){
	$active_type = $load_active_type;
	}
}
else if ($active == "monitored"){
	$active_type = "mon";
	$post_active_type = DBi::$con->real_escape_string(htmlspecialchars(esset_post('active_type')));
	if (!empty($post_active_type)){
	$_SESSION['DF_active_type'] = $post_active_type;
	head($_SERVER[REQUEST_URI]);
	}
	$load_active_type = esset_session('DF_active_type');
	if (!empty($load_active_type)){
	$active_type = $load_active_type;
	}
}
else if ($active == ""){
	$active_type = "active";
	$post_active_type = DBi::$con->real_escape_string(htmlspecialchars(esset_post('active_type')));
	if (!empty($post_active_type)){
	$_SESSION['DF_active_type'] = $post_active_type;
	head($_SERVER[REQUEST_URI]);
	}
	$load_active_type = esset_session('DF_active_type');
	if (!empty($load_active_type)){
	$active_type = $load_active_type;
	}
else {
	$active_type = $active_type;
     }
}
//##################  save active type ####################################

//##################  save refresh time ###################################
$refresh_time = 0;
$post_refresh_time = DBi::$con->real_escape_string(htmlspecialchars(esset_post('refresh_time')));
if (!empty($post_refresh_time)){
	$_SESSION['DF_refresh_time'] = $post_refresh_time;
	head($_SERVER[REQUEST_URI]);
}
$load_refresh_time = esset_session('DF_refresh_time');
if (!empty($load_refresh_time)){
	$refresh_time = $load_refresh_time;
}
else {
	$refresh_time = $refresh_time;
}
//##################  save refresh time ###################################

//##################  save order by #######################################
$order_by = "post";
$post_order_by = DBi::$con->real_escape_string(htmlspecialchars(esset_post('order_by')));
if (!empty($post_order_by)){
	$_SESSION['DF_order_by'] = $post_order_by;
	head($_SERVER[REQUEST_URI]);
}
$load_order_by = esset_session('DF_order_by');
if (!empty($load_order_by)){
	$order_by = $load_order_by;
}
else {
	$order_by = $order_by;
}
//##################  save order by #######################################

//##################  save reply num page #################################
$reply_num_page = 30;
$post_reply_num_page = DBi::$con->real_escape_string(htmlspecialchars(esset_post('reply_num_page')));
if (!empty($post_reply_num_page)){
	$_SESSION['DF_reply_num_page'] = $post_reply_num_page;
	head($_SERVER[REQUEST_URI]);
}
$load_reply_num_page = esset_session('DF_reply_num_page');
if (!empty($load_reply_num_page)){
	$reply_num_page = $load_reply_num_page;
}
else {
	$reply_num_page = $reply_num_page;
}
//##################  save reply num page #################################

//################## save sig #############################################
$show_sig = "hide";
$post_show_sig = DBi::$con->real_escape_string(htmlspecialchars(esset_post('show_sig')));
if (!empty($post_show_sig)){
	$_SESSION['DF_show_sig'] = $post_show_sig;
	head($_SERVER[REQUEST_URI]);
}
$load_show_sig = esset_session('DF_show_sig');
if (!empty($load_show_sig)){
	$show_sig = $load_show_sig;
}
else {
	$show_sig = $show_sig;
}
//################## save sig #############################################

//################## save style ###########################################
if (!empty($ch) && $ch == "style"){
 $style_name = DBi::$con->real_escape_string(htmlspecialchars(esset_post('style_name')));
 $_SESSION['DF_choose_style'] = $style_name;
 head(''.index().'');
}
$load_choose_style = esset_session('DF_choose_style');

if (!empty($load_choose_style)){
$choose_style = $load_choose_style;
}
else {
$choose_style = $default_style;
}
//################## save style ###########################################

//##################  save lang ###########################################
if (!empty($ch) && $ch == "lang"){
 $lan_name = DBi::$con->real_escape_string(htmlspecialchars(esset_post('lan_name')));
 $_SESSION['DF_choose_language'] = $lan_name;
 head(''.index().'');
}
$load_choose_language = esset_session('DF_choose_language');

if (!empty($load_choose_language)){
$choose_language = $load_choose_language;
}
else {
$choose_language = $default_language;
}

//##################  save lang ###########################################

//##################  save order option ###################################
$order_option = "online";
$post_order_option = DBi::$con->real_escape_string(htmlspecialchars(esset_post('order_option')));
if (!empty($post_order_option)){
	$_SESSION['DF_order_option'] = $post_order_option;
	head($_SERVER[REQUEST_URI]);
}
$load_order_option = esset_session('DF_order_option');
if (!empty($load_order_option)){
	$order_option = $load_order_option;
}
else {
	$order_option = $order_option;
}
//##################  save order option ###################################

//##################  save desc asc #######################################
$desc_asc = "desc";
$post_desc_asc = DBi::$con->real_escape_string(htmlspecialchars(esset_post('desc_asc')));
if (!empty($post_desc_asc)){
	$_SESSION['DF_desc_asc'] = $post_desc_asc;
	head($_SERVER[REQUEST_URI]);
}
$load_desc_asc = esset_session('DF_desc_asc');
if (!empty($load_desc_asc)){
	$desc_asc = $load_desc_asc;
}
else {
	$desc_asc = $desc_asc;
}
//##################  save desc asc #######################################


//##################  save timezone #######################################
$timezone = DBi::$con->real_escape_string(htmlspecialchars(esset_post('timezone')));
if ($tz != "") {
	$_SESSION['DF_timezone'] = $timezone;
	head("index.php");
}
$load_timezone =esset_session('DF_timezone');
if ($load_timezone == "") {
	$load_timezone = $site_timezone;
}
$chk_timezone = $load_timezone * 3600;
//##################  save timezone #######################################

//################## save style ###########################################
$load_choose_style = esset_session('DF_choose_style');

if (!empty($load_choose_style)){
$choose_style = $load_choose_style;
}
else {
$choose_style = $default_style;
}
//################## save style ###########################################

//##################  save lang ###########################################
if (!empty($ch) && $ch == "lang"){
 $lan_name = $_POST["lan_name"];
 $_SESSION['DF_choose_language'] = $lan_name;
 head('index.php');
}
$load_choose_language = esset_session('DF_choose_language');

if (!empty($load_choose_language)){
$choose_language = $load_choose_language;
}
else {
$choose_language = $default_language;
}

//##################  save lang ###########################################

?>