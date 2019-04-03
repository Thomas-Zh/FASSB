jQuery(document).ready(function () {
	//handle the display of projects for different units
	jQuery('#units-sidebar-list>li>a[href^="#"]').on('click', function (e) {
		e.preventDefault();
		if(this.hash!='#ALL'){
			jQuery('.project-block'+'.'+this.hash.substring(1)).removeClass('hidden');//need animaion here
			jQuery('.project-block').not('.'+this.hash.substring(1)).addClass('hidden');//need animation here
			//control the highlight nav bar
			jQuery('.list-title'+'.'+this.hash.substring(1)).removeClass('hidden');//need animaion here
			jQuery('.list-title').not('.'+this.hash.substring(1)).addClass('hidden');//need animation here

		}
		else if(this.hash=='#ALL'){
			jQuery('.project-block').removeClass('hidden');//need animation here
			jQuery('.list-title').removeClass('hidden');//need animation here
		}
		var i=0;
		jQuery('.project-block').removeAttr('count');
		jQuery('.list-title').removeAttr('count');
		jQuery('section.project-block').not('.hidden').each(function(){
 			jQuery(this).attr('count',i); //tags count in all the not hidden classes
 			jQuery(this).removeClass('even');
 			jQuery(this).removeClass('odd');

 			if (i%2==0){
 				jQuery(this).addClass('even');
 			}
 			else if(i%2==1){
 				jQuery(this).addClass('odd');
 			}
 			i++;
 		})
 		var j=0;
 		jQuery('.list-title').not('.hidden').each(function(){
 			jQuery(this).attr('count',j);
 			j++;
 		})

	});
	//jump to the section
	jQuery('.list-title>a[href^="#project-wrap"]').on('click', function (e) {
		e.preventDefault();
		let currentindex=jQuery(this.closest('.list-title')).attr('count');
		jQuery(window).scrollTop(jQuery('section[count*="'+currentindex+'"]').offset().top-100);
		return false;//prevent event bubbling (goes all the way up to top)
	});
	//sticky navigation
	jQuery(window).scroll(function(){
		var testheight=jQuery('section[count=0]').offset().top-jQuery('#site-header-main-inside').outerHeight( true )+jQuery('#units-sidebar-list').outerHeight(true);
		if(jQuery(window).scrollTop()>testheight){
			jQuery('.highlight-nav').addClass('sticky');
		}
		else if(jQuery(window).scrollTop()<=testheight){
			jQuery('.highlight-nav').removeClass('sticky');
		}
	})
	//hightligh nav while scrolling
 	jQuery(window).scroll(function(){
 	    function currentSid(sid){
 	    	//everytime you scroll it will repeat and index will be reset to 1
 			var index=sid;
 			//first index
 			if(jQuery('section[count*="'+(index-1)+'"]').offset().top-jQuery(window).scrollTop()-120>0){ //distance of the top of section to the top of the header MINUS the distance of scrolling MINUS the header > 0
 				index=0;
 				return index;
 			}//other index 
 			else{
 				while(jQuery('section[count*="'+index+'"]').offset().top-jQuery(window).scrollTop()-120<0){ 
 					index++; 
 					if(jQuery('.list-title').not('.hidden').size()-1<index){ //make sure index does not go over max size
 						break;
 					}
 				}
 				return index-1;
 			 }
 		}
 		var cid= currentSid(1);
 		jQuery('.list-title').removeClass('active');
 		jQuery('div[count*="'+cid+'"]').addClass('active'); //* interprets it as a variable
 	})
 });