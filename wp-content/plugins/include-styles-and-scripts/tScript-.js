$(document).ready(function(){
	
	var member  = getUrlVars()["id"];
	//Check if the url is a name.
	//If so, go to the user's page.
	
	var url = window.location.host;
	if(url.substr(0,3) != "loc"){
		if (member == 'apohl') {
			window.location = "http://wp.foundops.com/?author=2";
		} else if (member == 'jperl') {
			window.location = "http://wp.foundops.com/?author=3";
		} else if (member == 'zbright') {
			window.location = "http://wp.foundops.com/?author=5";
		} else if (member == 'oshatken') {
			window.location = "http://wp.foundops.com/?author=4";
		}else if (member == 'jmahoney') {
			window.location = "http://wp.foundops.com/?author=8";
		}else if (member == 'cmcpherson') {
			window.location = "http://wp.foundops.com/?author=6";
		}else if (member == 'pbrown') {
			window.location = "http://wp.foundops.com/?author=7";
		}
	} else {
		if (member == 'apohl') {
			window.location = "http://localhost:55206/?author=2";
		} else if (member == 'jperl') {
			window.location = "http://localhost:55206/?author=3";
		} else if (member == 'zbright') {
			window.location = "http://localhost:55206/?author=5";
		} else if (member == 'oshatken') {
			window.location = "http://localhost:55206/?author=4";
		}else if (member == 'jmahoney') {
			window.location = "http://localhost:55206/?author=8";
		}else if (member == 'cmcpherson') {
			window.location = "http://localhost:55206/?author=6";
		}else if (member == 'pbrown') {
			window.location = "http://localhost:55206/?author=7";
		}
	}
});

function getUrlVars()
{
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++)
	{
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}

function findPos(obj) {
	var curtop = 0;
	if (obj.offsetParent) {
		do {
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
		return [curtop];
	}
}

var tick = 0;
var scrollStop;

//jQuery Easing Plugin  
// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	}
}); //end jQuery Easing Plugin

$(document).ready(function(){
	if(document.getElementById('authorlist')){
		var list = document.getElementById('authorlist').getElementsByTagName('li');
		for(i = 0; i < list.length; i++) {
			
			if(i%4 == 0 || i == 0){
				list.item(i).id = "hoveredRed";
			} else if(i%4 == 1 || i == 1){
				list.item(i).id = "hoveredGreen";
			}else if(i%4 == 2 || i == 2){
				list.item(i).id = "hoveredOrange";
			}else {
				list.item(i).id = "hoveredBlue";
			}
			
			list.item(i).onmouseover = function(){
					this.className = "hovered";
			}
			list.item(i).onmouseout = function(){
				this.className = "nothovered";
			}
		}
	}
	/* ---------- FEATURES PAGE ---------- */
	if(document.getElementById('crm')){
		$('#nav_crm').click(function(){
			$.scrollTo( '#crm', 1000, { easing: 'easeInOutQuart', offset:{ top:-185, left:-205 }});
			return false;
		});
		$('#nav_dispatcher').click(function(){
			$.scrollTo( '#dispatcher', 1000, { easing: 'easeInOutQuart', offset:{ top:-40, left:-205 }});
			return false;
		});
		$('#nav_templates').click(function(){
			$.scrollTo( '#templates', 1000, { easing: 'easeInOutQuart', offset:{ top:-40, left:-205 }});
			return false;
		});
		$('#nav_employee').click(function(){
			$.scrollTo( '#employee', 1000, { easing: 'easeInOutQuart', offset:{ top:-40, left:-205 }});
			return false;
		});
		$('#nav_vehicle').click(function(){
			$.scrollTo( '#vehicle', 1000, { easing: 'easeInOutQuart', offset:{ top:-40, left:-205 }});
			return false;
		});
		$('#nav_mobile').click(function(){
			$.scrollTo( '#mobile', 1000, { easing: 'easeInOutQuart', offset:{ top:-40, left:-205 }});
			return false;
		});
		$('#nav_integrations').click(function(){
			$.scrollTo( '#integrations', 1000, { easing: 'easeInOutQuart', offset:{ top:-40, left:-205 }});
			return false;
		});
			
		// Scroll Position Actions
		var crm = $("#crm");
		var dispatcher = $("#dispatcher");
		var templates = $("#templates");
		var employee = $("#employee");
		var vehicle = $("#vehicle");
		var mobile = $("#mobile");
		var integrations = $("#integrations");
		scrollStop = setTimeout(updateFeaturesScrollInfo, 100);
	
		$(window).scroll(function(){ 
		  tick++;
		  clearTimeout(scrollStop);
		  scrollStop = setTimeout(updateFeaturesScrollInfo, 100);
		  if (tick > 10)
		  {
			updateFeaturesScrollInfo();
		  }
		});
	  
		//change active link color
		function updateFeaturesScrollInfo()
		{
		  tick = 0;
		  if(isCrm()){
			document.getElementById('nav_crm').className = 'activeonlight';
			document.getElementById('nav_dispatcher').className = 'notactiveonlight';
			document.getElementById('nav_templates').className = 'notactiveonlight';
			document.getElementById('nav_employee').className = 'notactiveonlight';
			document.getElementById('nav_vehicle').className = 'notactiveonlight';
			document.getElementById('nav_mobile').className = 'notactiveonlight';
			document.getElementById('nav_integrations').className = 'notactiveonlight';
		  } else if (isDispatcher()){
			document.getElementById('nav_dispatcher').className = 'activeonlight';
			document.getElementById('nav_crm').className = 'notactiveonlight';
			document.getElementById('nav_templates').className = 'notactiveonlight';
			document.getElementById('nav_employee').className = 'notactiveonlight';
			document.getElementById('nav_vehicle').className = 'notactiveonlight';
			document.getElementById('nav_mobile').className = 'notactiveonlight';
			document.getElementById('nav_integrations').className = 'notactiveonlight';
		  } else if (isTemplates()){
			document.getElementById('nav_templates').className = 'activeonlight';
			document.getElementById('nav_dispatcher').className = 'notactiveonlight';
			document.getElementById('nav_crm').className = 'notactiveonlight';
			document.getElementById('nav_employee').className = 'notactiveonlight';
			document.getElementById('nav_vehicle').className = 'notactiveonlight';
			document.getElementById('nav_mobile').className = 'notactiveonlight';
			document.getElementById('nav_integrations').className = 'notactiveonlight';
		  }  else if (isEmployee()){
			document.getElementById('nav_employee').className = 'activeonlight';
			document.getElementById('nav_dispatcher').className = 'notactiveonlight';
			document.getElementById('nav_templates').className = 'notactiveonlight';
			document.getElementById('nav_crm').className = 'notactiveonlight';
			document.getElementById('nav_vehicle').className = 'notactiveonlight';
			document.getElementById('nav_mobile').className = 'notactiveonlight';
			document.getElementById('nav_integrations').className = 'notactiveonlight';
		  } else if (isVehicle()){
			document.getElementById('nav_vehicle').className = 'activeonlight';
			document.getElementById('nav_dispatcher').className = 'notactiveonlight';
			document.getElementById('nav_templates').className = 'notactiveonlight';
			document.getElementById('nav_employee').className = 'notactiveonlight';
			document.getElementById('nav_crm').className = 'notactiveonlight';
			document.getElementById('nav_mobile').className = 'notactiveonlight';
			document.getElementById('nav_integrations').className = 'notactiveonlight';
		  }else if (isMobile()){
			document.getElementById('nav_mobile').className = 'activeonlight';
			document.getElementById('nav_dispatcher').className = 'notactiveonlight';
			document.getElementById('nav_templates').className = 'notactiveonlight';
			document.getElementById('nav_employee').className = 'notactiveonlight';
			document.getElementById('nav_vehicle').className = 'notactiveonlight';
			document.getElementById('nav_crm').className = 'notactiveonlight';
			document.getElementById('nav_integrations').className = 'notactiveonlight';
		  }else if (isIntegrations()){
			document.getElementById('nav_integrations').className = 'activeonlight';
			document.getElementById('nav_dispatcher').className = 'notactiveonlight';
			document.getElementById('nav_templates').className = 'notactiveonlight';
			document.getElementById('nav_employee').className = 'notactiveonlight';
			document.getElementById('nav_vehicle').className = 'notactiveonlight';
			document.getElementById('nav_mobile').className = 'notactiveonlight';
			document.getElementById('nav_crm').className = 'notactiveonlight';
		  }
		}
		function isCrm() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(crm).offset().top,
			 elemBottom = elemTop + $(crm).height();
		   //Is more than half of the element visible
		   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
		function isDispatcher() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(dispatcher).offset().top,
			 elemBottom = elemTop + $(dispatcher).height();
		   //Is more than half of the element visible
		   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
		function isTemplates() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(templates).offset().top,
			 elemBottom = elemTop + $(templates).height();
		   //Is more than half of the element visible
		   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
		function isEmployee() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(employee).offset().top,
			 elemBottom = elemTop + $(employee).height();
		   //Is more than half of the element visible
		   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
		function isVehicle() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(vehicle).offset().top,
			 elemBottom = elemTop + $(vehicle).height();
		   //Is more than half of the element visible
			return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
		function isMobile() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(mobile).offset().top,
			 elemBottom = elemTop + $(mobile).height();
		   //Is more than half of the element visible
			return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
		function isIntegrations() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(integrations).offset().top,
			 elemBottom = elemTop + $(integrations).height();
		   //Is more than half of the element visible
			return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
	}
	/* ---------- ABOUT US PAGE ---------- */
	if(document.getElementById('authorlist')){
		$('#nav_team').click(function(){
			$.scrollTo( '#team', 1000, { easing: 'easeInOutQuart', offset:{ top:-150, left:-157 }});
			return false;
		});
		$('#nav_advisors').click(function(){
			$.scrollTo( '#advisors', 1000, { easing: 'easeInOutQuart', offset:{ top:-50, left:-157 }});
			return false;
		});
		$('#nav_values').click(function(){
			$.scrollTo( '#values', 1000, { easing: 'easeInOutQuart', offset:{ top:-50, left:-157 }});
			return false;
		});
		$('#nav_jobs').click(function(){
			$.scrollTo( '#jobs', 1000, { easing: 'easeInOutQuart', offset:{ top:-50, left:-157 }});
			return false;
		});
		$('#nav_contact').click(function(){
			$.scrollTo( '#contactUs', 1000, { easing: 'easeInOutQuart', offset:{ top:0, left:-157 }});
			return false;
		});
			
	 // Scroll Position Actions
		var team = $("#team");
		var advisors = $("#advisors");
		var values = $("#values");
		var jobs = $("#jobs");
		var contact = $("#contactUs");
		scrollStop = setTimeout(updateScrollInfo, 100);
	
		$(window).scroll(function(){ 
		  tick++;
		  clearTimeout(scrollStop);
		  scrollStop = setTimeout(updateScrollInfo, 100);
		  if (tick > 10)
		  {
			updateScrollInfo();
		  }
		});
	  
		//change active link color
		function updateScrollInfo()
		{
		  tick = 0;
		  if(isTeam()){
			document.getElementById('nav_team').className = 'activeonlight';
			document.getElementById('nav_values').className = 'notactiveonlight';
			document.getElementById('nav_jobs').className = 'notactiveonlight';
			document.getElementById('nav_contact').className = 'notactiveonlight';
			document.getElementById('nav_advisors').className = 'notactiveonlight';
		  } else if (isAdvisors()){
			  document.getElementById('nav_advisors').className = 'activeondark';
			document.getElementById('nav_values').className = 'notactiveondark';
			document.getElementById('nav_team').className = 'notactiveondark';
			document.getElementById('nav_jobs').className = 'notactiveondark';
			document.getElementById('nav_contact').className = 'notactiveondark';
		  } else if (isValues()){
			document.getElementById('nav_values').className = 'activeonlight';
			document.getElementById('nav_team').className = 'notactiveonlight';
			document.getElementById('nav_jobs').className = 'notactiveonlight';
			document.getElementById('nav_contact').className = 'notactiveonlight';
			document.getElementById('nav_advisors').className = 'notactiveonlight';
		  }  else if (isJobs()){
			document.getElementById('nav_jobs').className = 'activeondark';
			document.getElementById('nav_values').className = 'notactiveondark';
			document.getElementById('nav_team').className = 'notactiveondark';
			document.getElementById('nav_contact').className = 'notactiveondark';
			document.getElementById('nav_advisors').className = 'notactiveondark';
		  } else if (isContact()){
			document.getElementById('nav_contact').className = 'activeonlight';
			document.getElementById('nav_values').className = 'notactiveonlight';
			document.getElementById('nav_jobs').className = 'notactiveonlight';
			document.getElementById('nav_team').className = 'notactiveonlight';
			document.getElementById('nav_advisors').className = 'notactiveonlight';
		  }
		}
	  
		function isTeam() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(team).offset().top,
			 elemBottom = elemTop + $(team).height();
		   //Is more than half of the element visible
		   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
		
		function isAdvisors() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(advisors).offset().top,
			 elemBottom = elemTop + $(advisors).height();
		   //Is more than half of the element visible
		   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
	  
		function isValues() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(values).offset().top,
			 elemBottom = elemTop + $(values).height();
		   //Is more than half of the element visible
		   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
	  
		function isJobs() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(jobs).offset().top,
			 elemBottom = elemTop + $(jobs).height();
		   //Is more than half of the element visible
		   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
	  
		function isContact() {
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height(),
				elemTop = $(contact).offset().top,
			 elemBottom = elemTop + $(contact).height();
		   //Is more than half of the element visible
			return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
		}
	}
});

/* jQuery.ScrollTo - Easy element scrolling using jQuery. */
;(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);

(function(jQuery){jQuery.fn.extend({elastic:function(){var mimics=['paddingTop','paddingRight','paddingBottom','paddingLeft','fontSize','lineHeight','fontFamily','width','fontWeight'];return this.each(function(){if(this.type!='textarea'){return false}var $textarea=jQuery(this),$twin=jQuery('<div />').css({'position':'absolute','display':'none','word-wrap':'break-word'}),lineHeight=parseInt($textarea.css('line-height'),10)||parseInt($textarea.css('font-size'),'10'),minheight=parseInt($textarea.css('height'),10)||lineHeight*3,maxheight=parseInt($textarea.css('max-height'),10)||Number.MAX_VALUE,goalheight=0,i=0;if(maxheight<0){maxheight=Number.MAX_VALUE}$twin.appendTo($textarea.parent());var i=mimics.length;while(i--){$twin.css(mimics[i].toString(),$textarea.css(mimics[i].toString()))}function setHeightAndOverflow(height,overflow){curratedHeight=Math.floor(parseInt(height,10));if($textarea.height()!=curratedHeight){$textarea.css({'height':curratedHeight+'px','overflow':overflow})}}function update(){var textareaContent=$textarea.val().replace(/&/g,'&amp;').replace(/  /g,'&nbsp;').replace(/<|>/g,'&gt;').replace(/\n/g,'<br />');var twinContent=$twin.html();if(textareaContent+'&nbsp;'!=twinContent){$twin.html(textareaContent+'&nbsp;');if(Math.abs($twin.height()+lineHeight-$textarea.height())>3){var goalheight=$twin.height()+lineHeight;if(goalheight>=maxheight){setHeightAndOverflow(maxheight,'auto')}else if(goalheight<=minheight){setHeightAndOverflow(minheight,'hidden')}else{setHeightAndOverflow(goalheight,'hidden')}}}}$textarea.css({'overflow':'hidden'});$textarea.keyup(function(){update()});$textarea.live('input paste',function(e){setTimeout(update,250)});update()})}})})(jQuery);

jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});