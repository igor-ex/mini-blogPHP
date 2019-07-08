
const slider = document.getElementsByClassName('slider-container')[0];
const slideFrames = document.getElementsByClassName('slider-container__entry');
window.addEventListener('load', () => enableSlider(slider, slideFrames));

function enableSlider(slider, slideFrames,
    {frameWidth = null, startDelay = 3000, slideStopDuration = 4000, cssTransitionDuration = 2} = {}) {
    if (slideFrames.length < 2) {
        return;
    }

    
    let stopped = false;

    slider.addEventListener('click', () => {
        stopped = !stopped;
        
        if (!stopped) {
            slide();
        } else {
            clearTimeout(timeoutId);
        }
    });
    
    let current = 0;
    let margin = 0;
    let first = slideFrames[0];
    let last = slideFrames[slideFrames.length-1];
    const cssTransition = `margin-left ${cssTransitionDuration}s`;
    first.style.transition = cssTransition;
    let timeoutId;
    const scheduleSlide = () => timeoutId = setTimeout(slide, slideStopDuration);
    first.addEventListener('transitionend', scheduleSlide);
    slideFrames[1].addEventListener('transitionend', scheduleSlide);
    
    if (frameWidth === null) {
        frameWidth = slider.clientWidth;
    }
    
    setTimeout(slide, startDelay);
    
    function slide() {
        if (stopped){
            return;
        }
    
        if (current === slideFrames.length - 1) {
            move(moveFirstToLast);
        } else if (current === slideFrames.length) {
            move(moveLastToFirst);
        }
        
        decrementMargin();
        current = (current === slideFrames.length) ? 1 : current + 1;
    }
    
    function move(callable){
        first.style.removeProperty('transition');
        callable();
        first = slideFrames[0];
        last = slideFrames[slideFrames.length - 1];
        first.clientWidth; //force rendering
        first.style.transition = cssTransition;
    }
    
    function moveLastToFirst(){
        removeMargin(first);
        slider.insertBefore(last, first);
    }
    
    function moveFirstToLast(){
        first.style.removeProperty('margin-left');
        slider.appendChild(first);
        margin += frameWidth;
        slideFrames[0].style.marginLeft = margin + 'px';
    }
    
    function decrementMargin(){
        margin -= frameWidth;
        first.style.marginLeft = margin + 'px';
    }
    
    function removeMargin(el){
        el.style.removeProperty('margin-left');
        margin = 0;
    }
}

