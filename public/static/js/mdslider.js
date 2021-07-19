class MDSlider {

    constructor(){
        this.slider_active = 0;
    }

    show() {
        console.log(this.slider_active);
        var items =  document.getElementsByClassName('md-slider-item');
        for (let i = 0; i < items.length; i++) {
            var pos = i * 100;
            items[i].style.left = pos+'%';
            items[i].style.display = 'flex';
        }
    }

}
