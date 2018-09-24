(function(d){
    'use strict';

    function turnon_slide (number){
        let list = d.getElementsByClassName('js-slider__list');
        let slides = list[0].getElementsByTagName ('li');
        let count = slides.length;
        let nom = 0;
        for (let i in slides){
            if(slides.hasOwnProperty(i)){
                if(slides[i].classList.contains('active')){
                    slides[ i ].classList.remove( 'active' );
                    nom = parseInt(i);
				}
            }
        }
        let result = nom + parseInt(number);
        if(result < 0 ){
            result = count - 1;
            slides[result].classList.add('active');
        }
        if(result > (count -1) ){
            result = 0;
            slides[result].classList.add('active');
        }
        console.log(result);
        slides[result].classList.add('active');
    }
    let listen = d.getElementsByClassName('js-slider__nav');

    for (let i in listen){
    	if(listen.hasOwnProperty(i)){
    		listen[i].addEventListener('click', function(event){
                let shift = event.target.getAttribute('data-shift');
                turnon_slide(shift);
            });
		}
	}

}(document));