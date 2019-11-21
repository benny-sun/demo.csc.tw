// JavaScript Document

'use strict';

$(document).ready(function(e) {
	var front_slider = null;
	
	
	//pace - page loader
	Pace.options = {
		ajax: false,
		elements: false
	};

	$(window).load(function(e) {
		//start front slider
		if(front_slider != null)
			front_slider.api.resume();
		
		//remove page loader screen
		$('#page-loader').addClass('loaded');
		Pace.stop();
	});	
	
	//input focus/blur functionality
	var input_containers = $('.input-container');
	for(var i=0, len=input_containers.length; i<len; i++) {
		inputContainerCheck(input_containers.eq(i).find('input, textarea'), input_containers.eq(i));
	}
	
	function inputContainerCheck(input, container) {
		input.on('focus blur', function(e) {
			container.toggleClass('focus');
		});
	}
	
	
	//bar graphs
	var graph_anim_duration = 300;
	var graph_bar = $('.graph-bar');
	var current_graph_bar;
	for(var i=0, len=graph_bar.length; i<len; i++) {
		var current_graph_bar = graph_bar.eq(i);
		if(current_graph_bar.hasClass('onscroll-animate'))
			continue;
		setGraphBar(current_graph_bar);
	}
	
	function setGraphBar(graph_el) {
		graph_el.find('.graph-line-value').css('width', graph_el.data('percentage') + '%');
	}
	
	
	//donut graphs
	var graph_donut = $('.graph-donut');
	for(var i=0, len=graph_donut.length; i<len; i++) {
		var current_graph_donut = graph_donut.eq(i);
		if(current_graph_donut.hasClass('onscroll-animate'))
			continue;
		setGraphDonut(current_graph_donut);
	}
	
	function setGraphDonut(graph_el) {
		var percentage = graph_el.data('percentage') / 100;
		if(percentage < 0.5) {
			graph_el.find('.graph-left .graph-inner').hide();
			graph_el.find('.graph-right .graph-inner').css('transform', 'rotate(' + (180 + 360 * percentage) + 'deg)');
		}
		else {
			graph_el.find('.graph-right .graph-inner').css('transform', 'rotate(360deg)');
			graph_el.find('.graph-left .graph-inner').css('transform', 'rotate(' + (360 * percentage) + 'deg)');
		}
	}	
	
	
	// on-scroll animations
	var on_scroll_anims = $('.onscroll-animate');
	for (var i=0, len=on_scroll_anims.length; i<len; i++) {
		var element = on_scroll_anims.eq(i);
		element.one('inview', function (event, visible) {
			var el = $(this);
			var anim = (el.data("animation") !== undefined) ? el.data("animation") : "fadeIn";
			var delay = (el.data("delay") !== undefined ) ? el.data("delay") : 200;

			var timer = setTimeout(function() {
				el.addClass(anim);
				clearTimeout(timer);
			}, delay);
			
			//for graphs
			if(el.hasClass('graph-bar')) {
				var graph_timer = setTimeout(function() {
					setGraphBar(el);
					clearTimeout(graph_timer);
				}, delay + 700);
			}
			else if(el.hasClass('graph-donut')) {
				var graph_timer = setTimeout(function() {
					setGraphDonut(el);
					clearTimeout(graph_timer);
				}, delay);
			}
		});
	}
	
	
	//one page menu and highlight current menu item
	var one_page_nav = $('#one-page-nav');
	if(one_page_nav.length == 1) {
		one_page_nav.on('click', 'li', function(){
			$(this).addClass('active').siblings().removeClass('active');
		});
	}
	
	
	//main menu scrollbar
	var main_menu_scroll_el = $("#menu");
	main_menu_scroll_el.niceScroll({
		cursoropacitymin: 0.6,
		cursorborder: "1px solid rgba(255,255,255,0.5)"
	});
	
	
	//main menu submenus
	var main_navigation_submenus = $('.main-navigation .has-submenu, .main-navigation .menu-item-has-children');
	for(var i=0, len=main_navigation_submenus.length; i<len; i++) {
		addSubmenuTriggers(main_navigation_submenus.eq(i));
	}
	
	function addSubmenuTriggers(menu_el) {
		var submenu = menu_el.children('ul');
		menu_el.on('mouseenter', function(e) {
			submenu.stop().slideDown(function() {
				main_menu_scroll_el.getNiceScroll().resize();
			});
		})
		.on('mouseleave', function(e) {
			submenu.stop().slideUp(function() {
				main_menu_scroll_el.getNiceScroll().resize();
			});
		});
	}
	
	
	//menu show/hide button functionality
	var menu = $('#menu');
	var menu_trigger = $('#menu-trigger');
	menu_trigger.on('click', function(e) {
		var menu_opened = false;
		if(menu.hasClass('active'))
			menu_opened = true;
		menu.toggleClass('active');
		menu_trigger.toggleClass('active');
		main_menu_scroll_el.getNiceScroll().resize();
		if(Modernizr.csstransitions) {
			if(menu_opened)
				main_menu_scroll_el.getNiceScroll().hide();
			menu.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
				main_menu_scroll_el.getNiceScroll().resize();
				if(menu_opened)
					main_menu_scroll_el.getNiceScroll().show();
			});
		}
	});
	
	
	//popup windows
	var page_screen_cover = $('#page-screen-cover');
	var popup_windows = $('.popup-window-container');
	
	$('.popup-window-trigger').on('click', function(e) {
		e.preventDefault();
		var popup = $($(this).data('popup'));
		openPopup(popup);
	});
	
	$('.popup-window-next, .popup-window-prev').on('click', function(e) {
		e.preventDefault();
		var parent_popup = $(this).parents('.popup-window-container');
		var new_popup;
		if($(this).hasClass('popup-window-next'))
			new_popup = parent_popup.next('.popup-window-container');
		else
			new_popup = parent_popup.prev('.popup-window-container');
		if(new_popup.length == 1) {
			closePopups(false);
			if(!Modernizr.csstransitions) {
				openPopup(new_popup);
			}
			else {
				parent_popup.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
					openPopup(new_popup);
				});
			}
		}
	});
	
	$('.popup-window-closing-area, .popup-window-close, .popup-window-close-trigger, #page-screen-cover').on('click', function(e) {
		e.preventDefault();
		closePopups();
	});
	
	function openPopup(popup_window) {
		if(popup_window.height() + $(window).scrollTop() > $(document).height()) {
			$.scrollTo(0, 300, {axis:'y'});
			popup_window.css('top', 0);
		}
		else
			popup_window.css('top', $(window).scrollTop());
		popup_window.addClass('active');
		page_screen_cover.addClass('active');
	}
	
	function closePopups(clear_screen) {
		popup_windows.removeClass('active');
		if(clear_screen == false)
			return;
		page_screen_cover.removeClass('active');
	}
	
	
	//portfolio layout6, layout7, layout8 hover
	function portfolioLayoutImg(img_el) {
        var hidden_part = img_el.find('.portfolio-img-detail-hidden');
		img_el.on('mouseenter', function() {
			hidden_part.stop().slideDown();
		})
		.on('mouseleave', function() {
			hidden_part.stop().slideUp();
		});
	}

	var portfolio_layouts_imgs = $('.portfolio-layout6 .portfolio-img, .portfolio-layout7 .portfolio-img, .portfolio-layout8 .portfolio-img');
	for(var i=0, len=portfolio_layouts_imgs.length; i<len; i++) {
		portfolioLayoutImg(portfolio_layouts_imgs.eq(i));
    }
	
	
	//tooltips
	$('[data-toggle="tooltip"]').tooltip();

	//lazy loading target and effect
	$("img.lazy").lazyload({
		effect : "fadeIn"
	});

	//避免表單重複發送
	jQuery.fn.preventDoubleSubmission = function() {
		$(this).on('submit',function(e){
			var $form = $(this);
			if ($form.data('submitted') === true) {
				e.preventDefault();
			} else {
				$form.data('submitted', true);
				$('button').prop('disabled', true);
				var spinner = '<i class="fa fa-circle-o-notch fa-spin fa-x fa-fw"></i>';
				$('button').html(spinner + '請稍候..');
			}
		});
		return this;
	};
	$('form').preventDoubleSubmission();
	
});



//placeholder fallback for old browsers
if ( !("placeholder" in document.createElement("input")) ) {
    $("input[placeholder], textarea[placeholder]").each(function() {
	    var val = $(this).attr("placeholder");
        if ( this.value == "" ) {
    	    this.value = val;
        }
        $(this).focus(function() {
        	if ( this.value == val ) {
            	this.value = "";
            }
       	}).blur(function() {
        	if ( $.trim(this.value) == "" ) {
            	this.value = val;
            }
        })
  	});
 
    // Clear default placeholder values on form submit
    $('form').submit(function() {
    	$(this).find("input[placeholder], textarea[placeholder]").each(function() {
        	if ( this.value == $(this).attr("placeholder") ) {
            	this.value = "";
            }
        });
    });
}







function isSet(variable) {
	if(variable == "" || typeof(variable) == 'undefined')
		return false;
	return true;
}

function clearForm(form_el) {
	form_el.find('input[type=text]').val('');
	form_el.find('input[type=checkbox]').prop('checked', false);
	form_el.find('textarea').val('');
}

function showLoader(form_el) {
	form_el.find('.ajax-loader').fadeIn('fast');
}

function hideLoader(form_el) {
	form_el.find('.ajax-loader').fadeOut('fast');
}

function showReturnMessage(form_el) {
	form_el.find('.return-msg').addClass('show-return-msg');
}

$('.return-msg').on('click', function(e) {
	$(this).removeClass('show-return-msg');
});
