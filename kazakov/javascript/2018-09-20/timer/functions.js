(function(d){
	'use strict';

	function active_slide (){
		let list = d.getElementsByClassName('js-slider__list');
		let slides = list[0].getElementsByTagName ('li');
		let count = slides.length;
		for (let i in slides){
			if(slides.hasOwnProperty(i)){
				if(slides[i].classList.contains('active')){
                    slides[i].classList.remove('active');
                    if((parseInt(i)+1) === count){
                    	let i = 0;
                        slides[parseInt(i)].classList.add('active');
                        break;
					}else{
                        slides[parseInt(i)+1].classList.add('active');
						break;
                    }
				}
			}
		}
	}
	setInterval(function(){active_slide();}, 2000);
}(document));