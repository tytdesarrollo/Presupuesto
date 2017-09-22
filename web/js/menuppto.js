jQuery(document).ready(function($){
	var is_menu_modal_animating = false;
	//open menu navigation
	$('.menu-modal-trigger').on('click', function(){
		triggerMenuModalNav(true);
	});
	//close menu navigation
	$('.content-menu-ppto .close-menu-ppto').on('click', function(){
		triggerMenuModalNav(false);
	});
	$('.content-menu-ppto').on('click', function(event){
		if($(event.target).is('.content-menu-ppto')) {
			triggerMenuModalNav(false);
		}
	});

	function triggerMenuModalNav($bool) {
		//check if no nav animation is ongoing
		if( !is_menu_modal_animating) {
			is_menu_modal_animating = true;
			
			//toggle list items animation
			$('.content-menu-ppto').toggleClass('in', $bool).toggleClass('out', !$bool).find('li:last-child').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
				$('.content-menu-ppto').toggleClass('is-visible', $bool);
				if(!$bool) $('.content-menu-ppto').removeClass('out');
				is_menu_modal_animating = false;
			});
			
			//check if CSS animations are supported... 
			if($('.menu-modal-trigger').parents('.no-csstransitions').length > 0 ) {
				$('.content-menu-ppto').toggleClass('is-visible', $bool);
				is_menu_modal_animating = false;
			}
		}
	}
});