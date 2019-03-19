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

function htmlspecialchars(string, quote_style, charset, double_encode) {
  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === 'undefined' || quote_style === null) {
    quote_style = 2;
  }
  string = string.toString();
  if (double_encode !== false) { // Put this first to avoid double-encoding
    string = string.replace(/&/g, '&amp;');
  }
  string = string.replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');

  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/'/g, '&#039;');
  }
  if (!noquotes) {
    string = string.replace(/"/g, '&quot;');
  }

  return string;
}

var ck = false;
var editor = false;
function setupQuickReplyBlock(memberFormat,Mlevel) {
		var newcontent = "";
        if (ck) return;
		if(Mlevel > 1) {
		var source = ['Source','NewPage'];	
		} else {
		var source = ['NewPage'];	
		}
		var new_message = str_replace("\n","<br />",quickreply.message.value);
		var the_message = htmlspecialchars(new_message);
        var currentcontent = the_message;
        quickreply.format.value = "ck";
        quickreply.ckon.disabled = "disabled";
        quickreply.ckoff.disabled = "";
        editor = CKEDITOR.replace('message', {
            customConfig: '',
            language: 'ar',
            uiColor: '#eeeeee',
            scayt_sLang: 'ar_SA',
            contentsLangDirection: 'rtl',
            enterMode: 2,
            shiftEnterMode: 1,
            resize_dir: 'vertical',
            scayt_autoStartup: false,
            skin: 'office2003',
            extraPlugins: 'tableresize',

            fontSize_sizes:
			'8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px',

            font_names:
			andalus+'/andalus;' +
			arial+'/arial;' +
			arial_unicode+'/arial unicode MS;' +
			arabic_typesetting+'/arabic typesetting;' +
			courier+'/Courier New, Courier, monospace;' +
			microsof+'/microsoft sans serif;' +
			simple+'/simplified arabic;' +
			tahoma+'/Tahoma, Geneva, sans-serif;' +
			times_new_roman+'/Times New Roman, Times, serif;' +
			'Arial/Arial, Helvetica, sans-serif;' +
			'Comic Sans MS/Comic Sans MS, cursive;' +
			'Courier New/Courier New, Courier, monospace;' +
			'Georgia/Georgia, serif;' +
			'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
			'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
			'Verdana/Verdana, Geneva, sans-serif'
		,
            toolbar:
		        [
				source,
			    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
			    ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
			    ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
			    ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
			    ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
			    '/',
			    ['Link', 'Unlink'],
			    ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar'],
			    ['Styles', 'Format', 'Font', 'FontSize'],
			    ['TextColor', 'BGColor'],
			    ['Maximize'],
			    ['BidiLtr', 'BidiRtl']
		        ]
                ,

            smiley_descriptions: ['smile', 'big', 'cool', 'blush', 'tongue', 'evil', 'wink',
                    'clown', 'blackeye', '8ball', 'sad', 'shy', 'shock', 'angry',
                    'dead', 'kisses', 'approve', 'dissapprove', 'sleepy', 'question',
                    'rotating', 'eyebrows', 'hearteyes', 'crying', 'waving', 'waving2',
                    'nono', 'wailing'],

            smiley_path: 'images/smilies/icons/',

            smiley_images: [
                    'icon_smile.gif', 'icon_smile_big.gif', 'icon_smile_cool.gif', 'icon_smile_blush.gif', 'icon_smile_tongue.gif', 'icon_smile_evil.gif', 'icon_smile_wink.gif',
                    'icon_smile_clown.gif', 'icon_smile_blackeye.gif', 'icon_smile_8ball.gif', 'icon_smile_sad.gif', 'icon_smile_shy.gif', 'icon_smile_shock.gif', 'icon_smile_angry.gif',
                    'icon_smile_dead.gif', 'icon_smile_kisses.gif', 'icon_smile_approve.gif', 'icon_smile_dissapprove.gif', 'icon_smile_sleepy.gif', 'icon_smile_question.gif',
                    'icon_smile_rotating.gif', 'icon_smile_eyebrows.gif', 'icon_smile_hearteyes.gif', 'icon_smile_crying.gif', 'icon_smile_waving.gif', 'icon_smile_waving2.gif',
                    'icon_smile_nono.gif', 'icon_smile_wailing.gif', '1.png', '2.png', '3.png', '4.png', '5.png', '6.png', '7.png', '8.png', '9.png', '10.png', '11.png', '12.png', '13.png', '14.png', '15.png', '16.png', '17.png', '18.png', '19.png', '20.png', '21.png'
                    ]

        });

        ck = true;
        if (newcontent != "") currentcontent = newcontent;
        CKEDITOR.instances.message.addCss("body {" + memberFormat + "; direction:rtl;}");
        CKEDITOR.instances.message.setData("<html><body>" + currentcontent + "</body></html>");
}

function NormalQuickReplyBlock()
{	
		if (editor)
			{
			editor.destroy();
			editor = null;
			}

		quickreply.message.value = "";
		quickreply.format.value = "quick";
		quickreply.ckon.disabled = "";
		quickreply.ckoff.disabled = "disabled";
		ck = false;
		
}


function AddSmiles(NewSmile) {
		if(ck == true) {
        CKEDITOR.instances.message.insertHtml(NewSmile);
        CKEDITOR.instances.message.focus();
		} else {
		document.quickreply.message.value+=NewSmile;
        document.quickreply.message.focus();
		}
}