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

function str_replace(search, replace, subject, count) {
  var i = 0,
    j = 0,
    temp = '',
    repl = '',
    sl = 0,
    fl = 0,
    f = [].concat(search),
    r = [].concat(replace),
    s = subject,
    ra = Object.prototype.toString.call(r) === '[object Array]',
    sa = Object.prototype.toString.call(s) === '[object Array]';
  s = [].concat(s);
  if (count) {
    this.window[count] = 0;
  }

  for (i = 0, sl = s.length; i < sl; i++) {
    if (s[i] === '') {
      continue;
    }
    for (j = 0, fl = f.length; j < fl; j++) {
      temp = s[i] + '';
      repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
      s[i] = (temp)
        .split(f[j])
        .join(repl);
      if (count && s[i] !== temp) {
        this.window[count] += (temp.length - s[i].length) / f[j].length;
      }
    }
  }
  return sa ? s : s[0];
}

function strip_tags(input, allowed) {
  allowed = (((allowed || '') + '')
    .toLowerCase()
    .match(/<[a-z][a-z0-9]*>/g) || [])
    .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
    commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return input.replace(commentsAndPhpTags, '')
    .replace(tags, function($0, $1) {
      return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}

var force_exit = false;

	function SubmitForm() {
			var editMode = editor_form.method.value;
	    if ((editMode == "topic") || (editMode == "edit")) {
	        if (editor_form.subject.value == "") {
	            alert(ed_need_title)
	            return;
	        }
	    }

	    if ((editMode == "topic") || (editMode == "edit") || (editMode == "editreply") || (editMode == "sig") || (editMode == "sendmsg") || (editMode == "addads") || (editMode == "editads") || (editMode == "signature") || (editMode == "reply") || (editMode == "replymsg")) {
	        if (editor_form.captcha.value.length < 4) {
	            alert(enter_captcha)
	            return;
	        }
	    }
	    edvalue = $('#txtContent').data('liveEdit').getXHTMLBody();
		var edvalue0 = edvalue.trim();
		var edvalue1 = str_replace("&nbsp;","",edvalue);
		var edvalue2 = edvalue1.trim();
		var edvalue3 = strip_tags(edvalue2);
		var edvalue4 = edvalue3.trim();
	    if (edvalue0 == "" || edvalue2 == "" || edvalue4 == "") {
	        alert(ed_need_content)
	        return;
	    }

var editMode = editor_form.method.value;
var topic_max_size = editor_form.topic_max_size.value;
var reply_max_size = editor_form.reply_max_size.value;
var pm_max_size = editor_form.pm_max_size.value;
var sig_max_size = editor_form.sig_max_size.value;

if ((editMode == 'topic') || (editMode == 'edit')) {
	var sizeLimit = topic_max_size;
}
else if ((editMode == 'reply') || (editMode == 'editreply')) {
	var sizeLimit = reply_max_size;
}
else if ((editMode == 'sendmsg') || (editMode == 'replymsg')) {
	var sizeLimit = pm_max_size;
}
else if (editMode == 'sig') {
	var sizeLimit = sig_max_size;
}

	        var c = edvalue.length;

	        if (c >= sizeLimit) {
	            alert(ed_too_big)
	            return;
	        }
	    

	    force_exit = true;
		
		$('#hinp').val(edvalue);
	    // editor_form.format.value = obj1.getPageCSSText()

	    if (confirm(ed_confirm_submit))
	        editor_form.submit()
	}
	

	function checkunload() {
    if (!force_exit) 
    {
        return (checkunload_msg);
    }
    return;
}

window.onbeforeunload = checkunload;

	
	
	function showTextCount()
{
var editMode = editor_form.method.value;
var topic_max_size = editor_form.topic_max_size.value;
var reply_max_size = editor_form.reply_max_size.value;
var pm_max_size = editor_form.pm_max_size.value;
var sig_max_size = editor_form.sig_max_size.value;
	
if ((editMode == 'topic') || (editMode == 'edit')) {
	var sizeLimit = topic_max_size;
}
else if ((editMode == 'reply') || (editMode == 'editreply')) {
	var sizeLimit = reply_max_size;
}
else if ((editMode == 'sendmsg') || (editMode == 'replymsg')) {
	var sizeLimit = pm_max_size;
}
else if (editMode == 'sig') {
	var sizeLimit = sig_max_size;
}

	
    var c = $('#txtContent').data('liveEdit').getXHTML().length;
	var notice = ed_cur_size + ": " + c;
	if (sizeLimit > 0)	notice += "\r\n\r\n" + ed_max_size + ": " + sizeLimit;
	if (c >= sizeLimit)	notice += "\r\n\r\n" + ed_too_big;
	alert(notice);
}

	function StoreText() {
	    if (confirm(confirm_save_content)) {

	        content = $('#txtContent').data('liveEdit').getXHTML();

	        alert(done_save_content);
	    }
	}
	
	function ResetContents()
	{
	if (confirm(ed_confirm_reset)) {
	    $('#txtContent').data('liveEdit').loadHTML(content);
		}
	}
	
	function get(name){
   if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
      return decodeURIComponent(name[1]);
}

function goToSimple(){
	history.back();
}

function loadDefHTML(){
	var inhtml = editor_form.hinp.value;
	$('#txtContent').data('liveEdit').loadHTML(inhtml);
}