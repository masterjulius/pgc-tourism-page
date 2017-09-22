(function($){
	$(function(e) {
		jQuery(document).ready(function(e) {
			cag_navbar_menu.initialize();
		});
	});
})(jQuery);

var cag_navbar_menu = {
	initialize: function() {
		this.components();
	},
	components: function() {

		this.addClasses('.cag-main-menu ul li', 'cag-menu-item cag-parent-item');
		this.addClasses('.cag-main-menu ul li a', 'cag-menu-btn waves-effect waves-cag-menu');
		this.hideTag('.cag-main-menu ul li.cag-menu-item a');
		this.showMenuIcon('.cag-main-menu ul li.cag-menu-item a');
		this.buildHtml();
		// For Click Events
		this.toggleMenus('.cag-main-menu ul li a.cag-menu-btn');
		cag_navbar_menu.showTag('.cag-main-menu ul li.cag-menu-item a');
		// Animate Search Box
		this.animate_search();
	},
	addClasses: function(selector, classesToAdd) {
		$(selector).addClass(classesToAdd);
	},
	showMenuIcon: function(selector) {
		$(selector).each(function(e) {
			var title = $(this).attr('title');
			if (title != undefined) $(this).removeAttr('title').prepend('<i class="'+ title +'" />');
		});
	},
	buildHtml: function() {
		// Call Back
		change_tag('ul.cag-menu-content');
		// this.get_page_title();
		// this.push_page_image();

		// Remove Some of the Classes first
		cag_navbar_menu.removeClasses('.cag-menu-content .cag-submenu-items ul li', 'cag-menu-item');
		cag_navbar_menu.removeClasses('.cag-menu-content .cag-submenu-items ul li a', 'cag-menu-btn');

		cag_navbar_menu.addClasses('.cag-menu-content .cag-submenu-items ul li', 'cag-list-item');

		// Fix All Child Items
		for (var i = 0; i < 5; i++) {
			fix_child_nodes('ul[data-dropdown-type="child-node"]');
		}

		// Add data index to each sub list item
		addListIndex('.cag-submenu-items');

		// Now divide all list elements into two columns
		divide_list_columns('.cag-menu-content');

		// And Push The Image to its location
		push_page_image('img[data-navbar-menu-type="child-node"]', '.cag-main-menu', 'cag-menu-content-dropdown-');

		// End of calling all the inner functions

		function change_tag(selector) {
			$(selector).each(function(e) {
				var $this = $(this);
				var href = $this.closest('.main-menu-item').find('.dropdown-button:first').attr('href');
				var parentMenu = $this.closest('.main-menu-item').find('.dropdown-button:first').text();
				
				var contents = $this.html();
				if (parentMenu == "HOME" || parentMenu == "home") parentMenu = "Province of Cagayan";

				// console.log(parentMenu);
				var elem_attributes = { 'id' : $this.attr('id'), 'data-dropdown' : $this.attr('data-dropdown'), 'class' : $this.attr('class') };
				// Set/Replace the html

				// Generate element for the Page Thumbnail
				var page_thumbnail_group = '<div class="cag-menu-tn-wrapper"><figure class="cag-menu-tn-effect"> <img class="page_thumbnail_fig_img" /> <figcaption> <h2 class="page_thumbnail_fig_title"></h2> <p class="page_thumbnail_fig_desc"></p> <a href="" class="page_thumbnail_fig_permalink" target="_blank">View more</a> </figcaption> </figure> </div>';

				var colMerge = '<div class="col s2 m2 l2 cag-submenu-title"> <a href="'+ href +'">' + parentMenu + '</a> </div>';
					colMerge += '<div class="col s5 m5 l5 cag-submenu-items"> <ul>' + contents + '</ul> </div>';
					colMerge += '<div class="col s5 m5 l5 cag-submenu-thumbnail"> ' + page_thumbnail_group + ' </div>';

				var $html = '<div id="'+ elem_attributes["id"] +'" data-dropdown="'+ elem_attributes["data-dropdown"] +'" class="'+ elem_attributes["class"] +'"> <div class="row cag-submenu-container">' + colMerge + '</div> </div>';

				$this.replaceWith( $html );
			});
		}
		function fix_child_nodes(selector) {
			$(selector).each(function(e) {
				var $this = $(this);
				/* Add the now the
				 * class for the
				 * identifier that
				 * it is a child node
				 */
				$this.find('li a').addClass('cag-submenu-subitem');

				var parent = find_parent($this, 'li'),
					contents = $this.html();

				// parent.attr('data-menu-index', index);
				// Remove this element
				$(this).remove();
				// And relocate/transfer its child elements after its the parent variable
				$(parent).after(contents);

			});

			//cag_navbar_menu.removeClasses(selector);
		}

		function addListIndex(selector){
			$(selector).each(function(e){
				var $this = $(this), index = 0;
				var eachList = $this.find('.cag-list-item');
				eachList.each(function(e){
					$(this).attr('data-menu-index', index);
					index++;
				});
			});
		}

		function divide_list_columns(selector) {
			$(selector).each(function(e) {
				var $this = $(this),
					parent = find_parent('.cag-list-item', '.cag-submenu-items');

				$this.each(function(elem) {
					var unorderedListContainer = $(this).find('ul');
					var eachContainerLength = unorderedListContainer.children('.cag-list-item').length;
					
					unorderedListContainer.addClass('ul-column-1').after('<ul class="ul-column-2"></ul>');

					var findColTwo = $(this).find('ul.ul-column-2');
					if (eachContainerLength % 2 == 0) {

						var index = eachContainerLength / 2;

						findColTwo.empty();
						for (var i = index; i < eachContainerLength; i++) {
							findColTwo.append( unorderedListContainer.find('.cag-list-item[data-menu-index="'+ i +'"]') );
						}

					} else {

						if (eachContainerLength > 1) {
							// get for the median
							var index = (eachContainerLength - 1) / 2;
							// console.log(index);


							findColTwo.empty();
							for (var i = index +1; i < eachContainerLength; i++) {
								findColTwo.append( unorderedListContainer.find('.cag-list-item[data-menu-index="'+ i +'"]') );
							}						
							
						}

					}
				});
			});
		}

		function push_page_image(selector, moveTo, prefix) {
			$(selector).each(function(e) {
				var $this = $(this),
					moveTo = $(moveTo);	
				
				var src = $this.attr('src'),
					name = $this.attr('data-page-title'),
					desc = $this.attr('data-page-desc'),
					permalink = $this.attr('data-page-permalink'),
					data_target = $this.attr('data-target');

				// remove the image
				$this.remove();

				if (!prefix) {
					


				} else {
					
					var location = moveTo.find('#' + prefix + data_target);
					location = location.find('.cag-submenu-thumbnail .cag-menu-tn-wrapper');
					var finalSelector = $(location.selector);
					finalSelector.find('.page_thumbnail_fig_img').attr('src', src);
					finalSelector.find('.page_thumbnail_fig_desc').text(desc);
					finalSelector.find('.page_thumbnail_fig_permalink').attr('href', permalink);

					/* Now format the title exactly
					 * for the emphasizing
					 * of the important/special
					 * word(s) we're gonna use
					 */
					var $pageTitle = finalSelector.find('.page_thumbnail_fig_title');
					 
					if (name != undefined) {

						var arraySpecialWords = [ "home", "governor's", "cagayan", "investments", "tourism", "news", "events", "new?", "contact" ];
						var spltStr = name.split(" ");
						for (var i = 0; i < spltStr.length; i++) {
							var str = spltStr[i].toLowerCase();
							if ( jQuery.inArray( str, arraySpecialWords ) > -1 ) {
								$pageTitle.append('<span>' + str.toUpperCase() + '</span> ');
							} else {
								$pageTitle.append( str.toUpperCase() + ' ' );
							}
						}
						
					}
					
				}
				
			});
		}

		// reprented functions
		function find_parent(selector, parentSelector) {
			return $(selector).closest(parentSelector);
		}

		function get_number_of_elems(selector) {
			return $(selector).length;
		}

	},

	removeClasses: function(selector, classes) {
		$(selector).removeClass(classes);
	},

	hideTag: function(selector) {
		$(selector).each(function(e) {
			$(this).css('display', 'none');
		});
	},
	showTag: function(selector) {
		$(selector).each(function(e) {
			$(this).css('display', 'block');
		});
	},

	toggleMenus: function(selector) {

		var clickedMenu;
        var clickedMenuNum;
        var activeMenu;
        var activeMenuNum;

        jQuery('.cag-menu-content').hide();

        ///If clicked outside the button
        jQuery( document ).on('click', $main_container, function() {
           	if ( jQuery( '.cag-menu-btn' ).hasClass( 'cag-menu-active' ) ) { //Check if there are menus that are active
             	jQuery( '.cag-menu-content' ).slideUp(350); //Close the submenus
             	jQuery( '.cag-menu-btn' ).removeClass( 'cag-menu-active active' ); //Remove active class
           	}
        });

		jQuery(document).on('click', selector, function(e) {

			if ( $(this).siblings().size() > 0 ) {
				e.preventDefault();
				//Action when menu is clicked
		        /** Gets the ID of clicked menu **/
		        clickedMenu = $( this ).attr( 'data-activates' );
		        
		        if (typeof clickedMenu !== typeof undefined && clickedMenu !== false) {

		        	/** Gets the menu ID number **/
			        clickedMenuNum = clickedMenu;

			        if ( jQuery( this ).hasClass( 'cag-menu-active' ) ) { //Check if the clicked menu is active

			            jQuery( '#cag-menu-content-' + clickedMenuNum ).slideUp(350); //Close the submenus
			            // $( '#' + clickedMenuNum ).slideUp(350); //Close the submenus
			            jQuery( this ).removeClass( 'cag-menu-active' ); //Remove active class

			        } else { //If the clicked menu is not active

			            if ( jQuery( '#cag-nav ul.cag-main-menu li.cag-menu-item a' ).hasClass( 'cag-menu-active' ) ) { //Check if other menus are active

			              	activeMenu = jQuery( '.cag-menu-active' ).attr( 'data-activates' ); //Get the active menuID
			              	activeMenuNum = activeMenu; //Extract the ID number from the active menu

			              	jQuery( '#cag-menu-content-'+ activeMenuNum ).slideUp(350); //Close the active submenu content using the ID
			              	jQuery( 'a[data-activates="'+ activeMenu + '"]' ).removeClass( 'cag-menu-active' ); //Remove active class

			              	jQuery( '#cag-menu-content-'+ clickedMenuNum ).delay(500).slideDown(500); //After closing other submenu content, Open the clicked menu
			              	jQuery( this ).addClass( 'cag-menu-active' ); //Add active class

			            } else { //If no other menus are active
			              	jQuery( '#cag-menu-content-'+ clickedMenuNum ).slideDown(500); //Imediately open the submenu content
			              	jQuery( this ).addClass( 'cag-menu-active' ); //Add active class
			            }

			        }
		        	
		        }
		    }    

		});
	}, // end toggle menus

	animate_search: function() {
		$( window ).scroll( function() {
	  		if( $( this ).scrollTop() > 58) {
	    		$( '.cag-nav').addClass( 'opaque' );
	    		$( '.cag-search-wrapper input[type="search"].cag-search-input').addClass( 'opaque' );
	  		} else {
	    		$( '.cag-nav' ).removeClass( 'opaque' );
	    		$( '.cag-search-wrapper input[type="search"].cag-search-input' ).removeClass( 'opaque' );
	  		}
		});
	}

}