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
        
var offsetxpoint = -60 //Customize x offset of tooltip
var offsetypoint = 20 //Customize y offset of tooltip
var ie = document.all
var ns6 = document.getElementById && !document.all
var enabletip = false
var tipobj = null;

function ietruebody() {
    return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body
}

function ddrivetip(thetext, thecolor, thewidth) {
    if (ns6 || ie) {
        if (typeof thewidth != "undefined") tipobj.style.width = thewidth + "px"
        if (typeof thecolor != "undefined" && thecolor != "") tipobj.style.backgroundColor = thecolor
        tipobj.innerHTML = thetext
        enabletip = true
        return false
    }
}

function membertip(m,showphoto) {
    if (ns6 || ie) {

        if (findMemberInfo(m)) {
            var c = "";
            if (showphoto && (find_defphoto.length > 0)) c += "<img src=\"" + find_photo + "\" border=0 width=86 height=64 onError=\"this.src='" + find_defphoto + "';\"/><br>";
            if (find_posts >= 0) c += ("<font size=-1><small>" + topic_posts + " " + find_posts + "</small><br>");
            if (find_awards > 0) c += ("<font size=-1 color=red><small>???? ??????: " + find_awards + "</small></font><br>");
            var title = find_title;
            if (title.length == 0) {
                if (find_gender == 2) {
                    if (find_level == 2) title = title_modF;
                    else if (find_level == 3) title = title_admin;
                    else if (find_level > 5) title = leveltitlesF[5];
                }
                else {
                    if (find_level == 2) title = title_mod;
                    else if (find_level == 3) title = title_admin;
                    else if (find_level > 5) title = leveltitles[5];
                }
            }

            if (title.length > 0) c += "<font size=-1><small>" + title + "</small></font><br>";
            if (find_country.length > 0) c += "<font size=-1><small>" + find_country + "</small></font><br>";
            if (find_days > 0) c += "<nobr><font size=-1><small>??? ?????? ??? ????????: " + find_days + "</small></font><br>";

            if ((find_isonline > 0) && (m != memberID))
                c += "<table><tr><td class=optionsbar_menus2 valign=middle><img src=" + fileURL + "icon.aspx?i=online alt='???? ????'>&nbsp;"
		    + "<br><font size=-2>???? ????</font></td></tr></table>";

            tipobj.style.width = "160px"
            //tipobj.style.backgroundColor = "yellow"
            tipobj.innerHTML = c;
            enabletip = true
            return false
        }
    }
}
        function positiontip(e) {
        if (enabletip) {
        var curX = (ns6) ? e.pageX : event.clientX  - ietruebody().scrollLeft;
        var curY = (ns6) ? e.pageY : event.clientY + ietruebody().scrollTop;
        //Find out how close the mouse is to the corner of the window
        var rightedge = ie && !window.opera ? ietruebody().clientWidth - event.clientX - offsetxpoint : window.innerWidth - e.clientX - offsetxpoint - 20
        var bottomedge = ie && !window.opera ? ietruebody().clientHeight - event.clientY - offsetypoint : window.innerHeight - e.clientY - offsetypoint - 20

        var leftedge = (offsetxpoint < 0) ? offsetxpoint * (-1) : -1000


        //if the horizontal distance isn't enough to accomodate the width of the context menu
        //   if (leftedge < tipobj.offsetWidth)
        //move the horizontal position of the menu to the left by it's width
        tipobj.style.left = ie ? ietruebody().scrollLeft + event.clientX - tipobj.offsetWidth + "px" : window.pageXOffset + e.clientX - tipobj.offsetWidth + "px"
        //    else 
        if (curX < leftedge)
        tipobj.style.left = "5px"
        else
        //position the horizontal position of the menu where the mouse is positioned
        tipobj.style.left = curX + offsetxpoint + "px"

        //same concept with the vertical position
        if (bottomedge < tipobj.offsetHeight)
        tipobj.style.top = ie ? ietruebody().scrollTop + event.clientY - tipobj.offsetHeight - offsetypoint + "px" : window.pageYOffset + e.clientY - tipobj.offsetHeight - offsetypoint + "px"
        else
        tipobj.style.top = curY + offsetypoint + "px"

        // fillBox("memberinfo_box", "X:" + curX + " O: " + offsetxpoint + "<br>" + "Ev X:" + event.clientX + " Sc L: " + ietruebody().scrollLeft
        // + "<br>LeftEdge: " + leftedge + " RightEdge: " + rightedge);

        tipobj.style.visibility = "visible"
        }
        }

        function hideddrivetip() {
        if (ns6 || ie) {
        enabletip = false
        tipobj.style.visibility = "hidden"
        // tipobj.style.left = "-1000px"
        //tipobj.style.backgroundColor = ''
        //tipobj.style.width = ''
        }
        }

        document.onmousemove = positiontip

		
		
		
		
		
		
		
		
		
		
		
		
		// Menu tabs code................
        var tabdropdown = {
        disappeardelay: 200, //set delay in miliseconds before menu disappears onmouseout
        disablemenuclick: false, //when user clicks on a menu item with a drop down menu, disable menu item's link?
        enableiframeshim: 1, //1 or 0, for true or false

        //No need to edit beyond here////////////////////////
        dropmenuobj: null, ie: document.all, firefox: document.getElementById && !document.all, previousmenuitem: null,
        currentpageurl: window.location.href.replace("http://" + window.location.hostname, "").replace(/^\//, ""), 
        
        getposOffset: function (what, offsettype) {
        var totaloffset = (offsettype == "left") ? what.offsetLeft : what.offsetTop;
        var parentEl = what.offsetParent;
        while (parentEl != null) {
        totaloffset = (offsettype == "left") ? totaloffset + parentEl.offsetLeft : totaloffset + parentEl.offsetTop;
        parentEl = parentEl.offsetParent;
        }
        return totaloffset;
        },

        showhide: function (obj, e, obj2) { //obj refers to drop down menu, obj2 refers to tab menu item mouse is currently over
        if (this.ie || this.firefox)
        this.dropmenuobj.style.left = this.dropmenuobj.style.top = "-500px"
        if (e.type == "click" && obj.visibility == hidden || e.type == "mouseover") {
        if (obj2.parentNode.className.indexOf("default") == -1) //if tab isn't a default selected one
        obj2.parentNode.className = "selected"
        obj.visibility = "visible"
        }
        else if (e.type == "click")
        obj.visibility = "hidden"
        },

        iecompattest: function () {
        return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body
        },

        clearbrowseredge: function (obj, whichedge) {
        var edgeoffset = 0
        if (whichedge == "rightedge") {
        var windowedge = this.ie && !window.opera ? this.standardbody.scrollLeft + this.standardbody.clientWidth - 15 : window.pageXOffset + window.innerWidth - 15
        this.dropmenuobj.contentmeasure = this.dropmenuobj.offsetWidth
        if (windowedge - this.dropmenuobj.x < this.dropmenuobj.contentmeasure)  //move menu to the left?
        edgeoffset = this.dropmenuobj.contentmeasure - obj.offsetWidth
        }
        else {
        var topedge = this.ie && !window.opera ? this.standardbody.scrollTop : window.pageYOffset
        var windowedge = this.ie && !window.opera ? this.standardbody.scrollTop + this.standardbody.clientHeight - 15 : window.pageYOffset + window.innerHeight - 18
        this.dropmenuobj.contentmeasure = this.dropmenuobj.offsetHeight
        if (windowedge - this.dropmenuobj.y < this.dropmenuobj.contentmeasure) { //move up?
        edgeoffset = this.dropmenuobj.contentmeasure + obj.offsetHeight
        if ((this.dropmenuobj.y - topedge) < this.dropmenuobj.contentmeasure) //up no good either?
        edgeoffset = this.dropmenuobj.y + obj.offsetHeight - topedge
        }
        this.dropmenuobj.firstlink.style.borderTopWidth = (edgeoffset == 0) ? 0 : "1px" //Add 1px top border to menu if dropping up
        }
        return edgeoffset
        },

        dropit: function (obj, e, dropmenuID) {
        if (this.dropmenuobj != null) { //hide previous menu
        this.dropmenuobj.style.visibility = "hidden" //hide menu
        if (this.previousmenuitem != null && this.previousmenuitem != obj) {
        if (this.previousmenuitem.parentNode.className.indexOf("default") == -1) //If the tab isn't a default selected one
        this.previousmenuitem.parentNode.className = ""
        }
        }
        this.clearhidemenu()
        if (this.ie || this.firefox) {
        obj.onmouseout = function () { tabdropdown.delayhidemenu(obj) }
        obj.onclick = function () { return !tabdropdown.disablemenuclick } //disable main menu item link onclick?
        this.dropmenuobj = document.getElementById(dropmenuID)
        this.dropmenuobj.onmouseover = function () { tabdropdown.clearhidemenu() }
        this.dropmenuobj.onmouseout = function (e) { tabdropdown.dynamichide(e, obj) }
        this.dropmenuobj.onclick = function () { tabdropdown.delayhidemenu(obj) }
        this.showhide(this.dropmenuobj.style, e, obj)
        this.dropmenuobj.x = this.getposOffset(obj, "left")
        this.dropmenuobj.y = this.getposOffset(obj, "top")
        this.dropmenuobj.style.left = this.dropmenuobj.x - this.clearbrowseredge(obj, "rightedge") + "px"
        this.dropmenuobj.style.top = this.dropmenuobj.y - this.clearbrowseredge(obj, "bottomedge") + obj.offsetHeight + 1 + "px"
        this.previousmenuitem = obj //remember main menu item mouse moved out from (and into current menu item)
        this.positionshim() //call iframe shim function
        }
        },

        contains_firefox: function (a, b) {
        while (b.parentNode)
        if ((b = b.parentNode) == a)
        return true;
        return false;
        },

        dynamichide: function (e, obj2) { //obj2 refers to tab menu item mouse is currently over
        var evtobj = window.event ? window.event : e
        if (this.ie && !this.dropmenuobj.contains(evtobj.toElement))
        this.delayhidemenu(obj2)
        else if (this.firefox && e.currentTarget != evtobj.relatedTarget && !this.contains_firefox(evtobj.currentTarget, evtobj.relatedTarget))
        this.delayhidemenu(obj2)
        },

        delayhidemenu: function (obj2) {
        this.delayhide = setTimeout(function () { tabdropdown.dropmenuobj.style.visibility = 'hidden'; if (obj2.parentNode.className.indexOf('default') == -1) obj2.parentNode.className = '' }, this.disappeardelay) //hide menu
        },

        clearhidemenu: function () {
        if (this.delayhide != "undefined")
        clearTimeout(this.delayhide)
        },

        positionshim: function () { //display iframe shim function
        if (this.enableiframeshim && typeof this.shimobject != "undefined") {
        if (this.dropmenuobj.style.visibility == "visible") {
        this.shimobject.style.width = this.dropmenuobj.offsetWidth + "px"
        this.shimobject.style.height = this.dropmenuobj.offsetHeight + "px"
        this.shimobject.style.left = this.dropmenuobj.style.left
        this.shimobject.style.top = this.dropmenuobj.style.top
        }
        this.shimobject.style.display = (this.dropmenuobj.style.visibility == "visible") ? "block" : "none"
        }
        },

        hideshim: function () {
        if (this.enableiframeshim && typeof this.shimobject != "undefined")
        this.shimobject.style.display = 'none'
        },

        isSelected: function (menuurl) {
        var menuurl = menuurl.replace("http://" + menuurl.hostname, "").replace(/^\//, "")
        return (tabdropdown.currentpageurl == menuurl)
        },

        init: function (menuid, dselected) {
        this.standardbody = (document.compatMode == "CSS1Compat") ? document.documentElement : document.body //create reference to common "body" across doctypes
        var menuitems = document.getElementById(menuid).getElementsByTagName("a")
        for (var i = 0; i < menuitems.length; i++) {
        if (menuitems[i].getAttribute("rel")) {
        var relvalue = menuitems[i].getAttribute("rel")
        document.getElementById(relvalue).firstlink = document.getElementById(relvalue).getElementsByTagName("a")[0]
        menuitems[i].onmouseover = function (e) {
        var event = typeof e != "undefined" ? e : window.event
        tabdropdown.dropit(this, event, this.getAttribute("rel"))
        }
        }
        if (dselected == "auto" && typeof setalready == "undefined" && this.isSelected(menuitems[i].href)) {
        menuitems[i].parentNode.className += " selected default"
        var setalready = true
        }
        else if (parseInt(dselected) == i)
        menuitems[i].parentNode.className += " selected default"
        }
        }

        }
		   
