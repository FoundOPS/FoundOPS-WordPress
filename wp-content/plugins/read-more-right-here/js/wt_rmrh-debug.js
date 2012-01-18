(function($)
{
	// RMRH_VALUES set by WP and available at page level
	
	var Const =
	{
		ITEM_CLASS_PREFIX : 'rmrh-itemId',
		ITEM_SELECTOR : 'a[class^=rmrh-itemId-]',
		ITEM_REGEX : 'rmrh-itemId-([0-9]+)\\b',
		
		MORE_CLASS : 'rmrh-show-more',
		LESS_CLASS : 'rmrh-show-less',
		
		CLONE_ID_KEY : 'rmrhLinkCloneId',
		
		CONTENT_EXPAND_EVENT : 'RMRHContentExpanded',
		CONTENT_COLLAPSE_EVENT : 'RMRHContentCollapsed',
		CONTENT_LOAD_ERROR : 'RMRHContenLoadError',
		
		/**
		 * Error message displayed when there is a problem retrieving the post content
		 */		
		ERROR_MSG : "Sorry! There was an error retrieving content.<br>Click the link again to be taken to this entry's page.",
		
		/**
		 * CSS stylings applied to the error message 
		 */		
		ERROR_STYLE : {	'color':'#8C0913',
						'font-weight':'bold',
						'backgroundColor':'#ccc',
						'border':'thin solid #8C0913',
						'padding':'15px',
						'text-align':'center'},
						
		/**
		 * GIF "loading" image
		 */
		LOADING_IMAGE : (RMRH_VALUES.loaderImageURL.length > 0)
                        ?   $(new Image()).attr('src', RMRH_VALUES.loaderImageURL).css('margin-left', '10px') 
                        :   false,
							
		/**
		 * Boolean indicating if we will dupliacte the 'more link' to the bottom
		 * 	of the post.
		 */
		DUPLICATE_LINK : (parseInt(RMRH_VALUES.duplicateLink) == 1),
			
		/**
		 * Text used for the 'more link' after content has expanded
		 */
		EXPANDED_TEXT : RMRH_VALUES.expandedText,
		
		/**
		 * Boolean indicating if we should use new text for 'more link'
		 * 	after content has expanded
		 */
		USE_EXPANDED_TEXT : RMRH_VALUES.expandedText.length > 0,
		
		/**
		 * Speed of 'slide down' animation for new post content.
		 */
		ANIMATE_SPEED : parseInt(RMRH_VALUES.animateSpeed)
	};
	
	
	var Funcs =
	{
		/**
		 *	Returns the ID of the post/page we want by parsing the 
		 *	 special class name inserted into the 'more' link
		 *	 by the 'the_content_more_link' Wordpress filter.
		 *	<br>
		 *	@param the anchor element 'more' link
		 *	@return the target post id
		 */		
		getItemId:function(anchorEl)
		{
			var classNames = anchorEl.attr("class"),
				matches = classNames.match(Const.ITEM_REGEX);
			
			return matches.length > 0 ? matches[1] : false;
		},			

		/**
		 * Does the given element contain an 'object' element.
		 */
		hasEmbed:function(el)
		{
			return el.find('object').length > 0;
		},

		redirectIfNeeded:function(moreLinkObj)
		{
			// If IE 7 or 8, and the new content has an 
			//	embedded object (e.g. flash video), we have 
			//	to just re-direct to the single page entry.
			//	The object will NOT display.
			if($.browser.msie)
			{
				var v = parseInt($.browser.version);
				if((v > 6 && v < 9) && Funcs.hasEmbed(moreLinkObj.moreContentEl))
				{
					window.location = moreLinkObj.linkEl.attr('href');
					return;
				}
			}
		},
		

		/**
		 *	The 'more' element's 'click' event handler
		 *	<br>
		 *	@param event data set as part of 
		 *		   <code>setRedirectRequest</code>
		 */	
		ajaxClick:function(e)
		{
			var moreLink = e.data.MoreLink;
			
			// append and display the loading image 
			// after the 'more' anchor element
			moreLink.ShowLoader();
			
			// perform the ajax request
			$.ajax
			({
				type: "POST",
				url: moreLink.url,
				dataType: "html",
				cache: false,
				data: {'wt-rmrh-redirect':'1', 'itemid':moreLink.itemId},
				error: function(request, textStatus, errorThrown)
				{
					data = Const.ERROR_MSG;
					moreLink.eventData.error = errorThrown;
					moreLink.HandleAjaxComplete(data, true);
				},
				success: function(data, textStatus)
				{
					moreLink.HandleAjaxComplete(data, false);
				}	
			});
			
			// keep anchor 'click' event propagating
			return false; 		
		},		

		/**
		 *	Add our ajax request action to the 'click' event
		 *	of the 'more' anchor element.
		 *	<br>
		 *	@param MoreLink object instance
		 */
		setRedirectRequest:function(moreLink)
		{
			moreLink.Process();
		}
	};
	
	var MoreLink = function(moreLinkEl)
	{
		this.linkEl = moreLinkEl;
		this.origContent = moreLinkEl.html();
		
		this.url = moreLinkEl.attr('href');
		this.itemId = Funcs.getItemId(moreLinkEl);	
		this.useImage = (Const.LOADING_IMAGE) ? true : false;
		this.image = (Const.LOADING_IMAGE) ? Const.LOADING_IMAGE.clone() : '';
			
		this.cloneEl = this.CreateClone();
		this.cloneId = this.cloneEl.attr('id');
		
		this.clickHandler = Funcs.ajaxClick;
		this.moreContentEl = false;
		
		this.eventData = 
		{
			itemId:this.itemId,
			linkEl:this.linkEl,
			// updated when content loaded
			moreContentEl:false,
			// update when AJAX call errors
			error:false
		};
		
		
		this.insertClone = function()
		{
			this.linkEl.siblings().last().after(this.cloneEl);
			this.insertClone = $.noop;			
		};
	};
	
	var MoreLinkProto = MoreLink.prototype;
	
	MoreLinkProto.Process = function()
	{
		// If can't do anything with it, just ignore.
		if(!this.CanBeProcessed())
		{
			return;
		}
			
		// Default state; click will toggle it to 'rmrh-show-less'
		this.linkEl.addClass(Const.MORE_CLASS);
		
		// Bind the link click handler
		this.BindClickHandler();
	};
	
	/***
	 * Return boolean true if this more link has not
	 * already been processed and if it has a post id
	 * value.
	 */
	MoreLinkProto.CanBeProcessed = function()
	{
		return !this.HasBeenProcessed() && this.itemId;
	};
	
	/***
	 * If more link has one of RMRH classes then
	 * it's been dealt with already. 
	 */
	MoreLinkProto.HasBeenProcessed = function()
	{
		return 	this.linkEl.hasClass(Const.MORE_CLASS) ||
			 	this.linkEl.hasClass(Const.LESS_CLASS);
	};	
	
	MoreLinkProto.BindClickHandler = function()
	{
		this.linkEl.bind('click',{'MoreLink':this},this.clickHandler);
	};
	
	MoreLinkProto.RemoveClickHandler = function()
	{
		this.linkEl.unbind('click',this.clickHandler);
	};
	
	MoreLinkProto.Click = function()
	{
		this.linkEl.click();
	};

	MoreLinkProto.HandleAjaxComplete = function(result, bError)
	{
		var me = this;
		var newEl = $('<p/>').html(result).hide();
			
		// AJAX request finished, don't want it to run again
		me.RemoveClickHandler();			
		me.LoadMoreContent(newEl);
		
		// if no error, 'more' link slides the content in and
		// out of view; otherwise future clicks behave normally
		// and take user to the single post page
		if(!bError)
		{
			me.linkEl.toggle
			(
				$.proxy(me.ExpandContent,me),
				$.proxy(me.CollapseContent,me)
			);
			
			// trigger a 'click' for the initial content slide down
			me.Click();
		}
		else
		{
			// have an error: set error styles on the new element and show it
			me.LoadError();
		}
	};
	
	MoreLinkProto.ExpandContent = function()
	{
		var me = this;
		me.ShowLoader();
		
		// When 'expanding', want any 'object' elements
		//	to show last.
		me.moreContentEl.slideDown(Const.ANIMATE_SPEED, function()
		{ 
			me.HideLoader();
			me.moreContentEl.find('object').show();
			
			// Want to change the 'more link' text?
			if(Const.USE_EXPANDED_TEXT)
			{
				me.linkEl.html(Const.EXPANDED_TEXT);
			}
			
			// Want 'more link' duplicate at bottom?
			if(Const.DUPLICATE_LINK)
			{
				me.insertClone();		
				me.cloneEl.html(me.linkEl.html()).show();				
				me.ToggleCloneClasses();
			}
			
			me.ToggleClasses();
			
			me.Pub(Const.CONTENT_EXPAND_EVENT);
		});
				
		return false;
	};

	MoreLinkProto.CollapseContent = function()
	{
		var me = this;
		
		me.ShowLoader();
		
		// If created a duplicate link at the bottom,
		//	hide it
		if(Const.DUPLICATE_LINK)
		{
			me.cloneEl.hide();
			me.ToggleCloneClasses();
		}
		
		// When collapsing, want any 'object' elements
		//	to hide first.
		me.moreContentEl.find('object').hide();
		me.moreContentEl.slideUp(Const.ANIMATE_SPEED, function()
		{ 
			me.HideLoader();
			
			// If use special expanded text, replace it
			//	with the original
			if(Const.USE_EXPANDED_TEXT)
			{
				me.RestoreOriginalContent();
			}
			
			me.ToggleClasses();
			
			me.Pub(Const.CONTENT_COLLAPSE_EVENT);
		});	
			
		return false;
	};	
	
	MoreLinkProto.LoadMoreContent = function(moreContentEl)
	{
		// the loading gif is after the more link, so
		// put the new content after that image		
		this.moreContentEl = moreContentEl;
		
		// update event data object
		this.eventData.moreContentEl = moreContentEl;
				
		Funcs.redirectIfNeeded(this);
		
		// All 'object' elements are initially hidden
		moreContentEl.find('object').hide();
		
		if(this.useImage)
		{
            this.image.after(moreContentEl);	
		}
		else
		{
			this.linkEl.after(moreContentEl);
		}
	};
	
	MoreLinkProto.LoadError = function()
	{
		var me = this;
		// have an error: set error styles on the new element and show it
		me.moreContentEl.css(Const.ERROR_STYLE);
		me.moreContentEl.slideDown(Const.ANIMATE_SPEED,function()
		{
			if(me.useImage)
			{
                me.image.fadeOut(Const.ANIMATE_SPEED/2);				
			}
			
			// TODO : This event is not caught by those binding to it. ????
			me.Pub(Const.CONTENT_LOAD_ERROR);
		});
	};
	
	MoreLinkProto.RestoreOriginalContent = function()
	{
		this.linkEl.html(this.origContent);
	};
	
	MoreLinkProto.ShowLoader = function()
	{
		if(this.useImage)
		{
		  this.linkEl.after(this.image.show());
		}
	};
	
	MoreLinkProto.HideLoader = function()
	{
		if(this.useImage)
		{
		  this.image.fadeOut(Const.ANIMATE_SPEED/2);
		}
	};
	
	MoreLinkProto.ToggleClasses = function()
	{
		this.linkEl.toggleClass(Const.MORE_CLASS + ' ' + Const.LESS_CLASS);		
	};
	
	MoreLinkProto.ToggleCloneClasses = function()
	{
		this.cloneEl.toggleClass(Const.MORE_CLASS + ' ' + Const.LESS_CLASS);
	};
	
	MoreLinkProto.CloneClickHandler = function()
	{
		var me = this,
			scrollTo = me.linkEl.offset().top - 200,
			speed = Const.ANIMATE_SPEED/2;
		
		scrollTo = (scrollTo <= 0) ? 0 : scrollTo;

		// If the 'more link' is not still visible, scroll back to it
		//	(checking distance to travel needed, and if less than what
		//	is visible in the window, don't animate)
		if((me.cloneEl.offset().top - scrollTo) > $(window).height())
			$('html,body').animate({scrollTop:(scrollTo)+"px"},speed);
		
		// wait for scroll back to finish, then trigger a 'click' (which
		//	will cause a collapse)
		setTimeout(function(){me.linkEl.trigger('click')},speed);
		
		return false;		
	};
	
	MoreLinkProto.CreateClone = function()
	{
		var fClickHandler = $.proxy(this.CloneClickHandler,this),
			id = 'rmrh-itemId-'+this.itemId+'-clone-'+(new Date()).getTime(),
			result = this.linkEl.clone().attr('id',id).click(fClickHandler);
		return result;	
	};
		
    MoreLinkProto.Pub = function(type)
	{
		this.linkEl.trigger(type,this.eventData);
	}
	
	/*
	 * Exposing a publically available method (within jQuery) 
	 *   to call if re-executing the RMRH plugin is necessary 
	 *   (e.g new posts pulled in dynamically).
	 */
	$.fn.ReadMoreRightHere = function()
	{
		// What are we looking for?
		//	Anchor elements matching with a class matching the pattern 'rmrh-itemId-[id]'.
		//	This class was added by us during the WP 'the_content_more_link' filter.
		//
		var selector = Const.ITEM_SELECTOR;
		
		// Where are we looking?
		//	'this', within a normal call, will be the document. But if RMRH executed using 'call' or
		//	'apply' then it should be something more specific.
		var context = this;
		
		// If any arguments where given, we assume the first argument
		//	is some type of context. Let jQuery handle it.
		if(arguments.length > 0)
			context = $(arguments[0]);		
		
		// Nothing?  Then revert to document scope (if JQ < 1.4 this will not work as we want)
		if($(context).length == 0)
			context = document;
					
		$(selector,context).each(function()
		{
			new MoreLink($(this)).Process();
		});
	};
	
	// When page ready...
	$(function()
	{
		// initial execution of RMRH
		$.fn.ReadMoreRightHere.call(document);		
	});	
	
	
}(jQuery));