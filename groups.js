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

function textCounter(field, cntfield, maxlimit) {
        if (field.value.length > maxlimit)
            field.value = field.value.substring(0, maxlimit);
        else
            cntfield.value = maxlimit - field.value.length;
    }
function fillBox(box, c) {
                    var orig = "";
                    if (document.getElementById)
                    { var oe = document.getElementById(box); orig = oe.innerHTML; oe.innerHTML = c; }
                    else if (document.layers && document.layers[dest])
                    { orig = document.layers[box].innerHTML; document.layers[box].innerHTML = c; }
                    else if (document.all)
                    { orig = document.all[box].innerHTML; document.all[box].innerHTML = c; }

                    return (orig);
                }
				var smx = new Array(
":)", "e1",
":D", "e2",
":O", "e3",
":P", "e4",
";)", "e5",
":(", "e6",
":S", "e7",
":|", "e8",
"o.O", "e9",
":$", "e10",
":H", "e11",
":@", "e12",
":A", "e13",
":6", "e14",
"8-|", "e15",
":#", "e16",
":-*", "e17",
":^)", "e18",
":o)", "e19",
"|-)", "e20",
":Y", "e21",
//":B", "e22",
":{", "e24",
":8", "e29",
":O", "e31",
//":sn", "e32",
":pi", "e33",
":au", "e34",
":um", "e35",
":co", "e36",
":st", "e37",
":mo", "e38",
"8o|", "e39",
":?", "e40",
"+o(", "e41",
"*-)", "e42",
"8-)", "e43",
":C", "e44",
":N", "e45",
//":D", "e46",
//":Z", "e47",
":}", "e48",
":^", "e49",
":U", "e50",
":G", "e51",
":W", "e52",
//":&", "e54",
":I", "e55",
":S", "e56",
":E", "e57",
":ap", "e58",
":ip", "e59",
":li", "e60"
);
    function openAddWall() {
        var c = "";
        c = "<center><div id=the_wall>";


            c += "<form method=post id=wallcommentform><div class=walltext_counter><span style=\"float:right;\">"+enter_a_comment+"</span>"
            + "<span style=\"float:left;\">"+num_letters+" <input class=walltext_counter disabled=disabled type=text name=walltext_len size=3 maxlength=3 value=200></span><br>"
            + "<textarea name=walltext class=walltext "
            + " onKeyDown=\"textCounter(wallcommentform.walltext,wallcommentform.walltext_len,200)\" onKeyUp=\"textCounter(wallcommentform.walltext,wallcommentform.walltext_len,200)\"></textarea><br><div>"

            var z = 0;

            while (z < smx.length) {
                c += " <img onclick=\"javascript:insertAtCaret(wallcommentform.walltext,' " + smx[z] + " ');\" src=profile/icons/" + smx[z + 1] + ".gif>";
                if (z == 46) c += "<br>";
                z += 2;
            }

            c += "</div></div><br><br>";
            c += "<br><input type=button onclick='javascript:sendWallComment();' value='"+enter_comment+"'>";
            c += "&nbsp;&nbsp;&nbsp;";
            c += "<input type=button onclick='javascript:fillBox(\"wall_comment\",\"\");' value='"+cancel+"'>";
            c += "</form>";
            c += "<hr size=\"1\" noshade style=\"border-color:#CCC;margin-right:7px;margin-left:7px;\" />";
        

        c += "</div></center>";

        fillBox("wall_comment", c);
    }

	

    function sendWallComment() {

        if (wallcommentform.walltext.value.length < 4) {
            confirm(enter_a_comment_3);
            return;
        }
        if (wallcommentform.walltext.value.length > 200) {
            confirm(enter_a_comment_200);
            return;
        }
        wallcommentform.submit();
    }

	function writeCaptcha(){
		
	}
	function insertAtCaret(obj, text) {
        if (document.selection) {
            obj.focus();
            var orig = obj.value.replace(/\r\n/g, "\n");
            var range = document.selection.createRange();

            if (range.parentElement() != obj) {
                return false;
            }

            range.text = text;

            var actual = tmp = obj.value.replace(/\r\n/g, "\n");

            for (var diff = 0; diff < orig.length; diff++) {
                if (orig.charAt(diff) != actual.charAt(diff)) break;
            }

            for (var index = 0, start = 0;
				tmp.match(text)
					&& (tmp = tmp.replace(text, ""))
					&& index <= diff;
				index = start + text.length
			) {
                start = actual.indexOf(text, index);
            }
        } else if (obj.selectionStart) {
            var start = obj.selectionStart;
            var end = obj.selectionEnd;

            obj.value = obj.value.substr(0, start)
				+ text
				+ obj.value.substr(end, obj.value.length);
        }
		
        if (start != null) {
            setCaretTo(obj, start + text.length);
        } else {
            obj.value += text;
        }
    }

    function setCaretTo(obj, pos) {
        if (obj.createTextRange) {
            var range = obj.createTextRange();
            range.move('character', pos);
            range.select();
        } else if (obj.selectionStart) {
            obj.focus();
            obj.setSelectionRange(pos, pos);
        }
    }
function ChangeProfilePage() {
	    document.ProfilePageNum.submit();
	}