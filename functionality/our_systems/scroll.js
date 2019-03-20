jQuery(document).ready(function () {
	jQuery('a[href^="#systems"]').on('click', function (e) {
		e.preventDefault();
		jQuery(window).scrollTop(jQuery(this.hash).offset().top-120);
	});
	jQuery(window).scroll(function(){
		var testheight=jQuery('.systems-page').offset().top-jQuery('#site-header-main-inside').outerHeight( true );
		if(jQuery(window).scrollTop()>testheight){
			jQuery('.highlight-nav').addClass('sticky');
		}
		else if(jQuery(window).scrollTop()<=testheight){
			jQuery('.highlight-nav').removeClass('sticky');
		}
	})
 	jQuery(window).scroll(function(){
 	    function currentSid(sid){
 			var count=sid;
 			//first count
 			if(jQuery('#systems-wrap-'+(count-1)).offset().top-jQuery(window).scrollTop()-120>0){
 				count=0;
 				return count;
 			}//other counts
 			else{
 				while(jQuery('#systems-wrap-'+count).offset().top-jQuery(window).scrollTop()-140<0){
 					count++;
 					if(jQuery('.list-title').size()-1<count){
 						break;
 					}
 				}
 				return count-1;
 			}
 		}
 		var cid= currentSid(1);
 		jQuery('.list-title').removeClass('active');
 		jQuery('.list-title'+'#'+cid).addClass('active');
 	})
 });