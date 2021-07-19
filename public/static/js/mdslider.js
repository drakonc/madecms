class MDSlider {

    constructor(){
        this.init();
        this.slider_active = 0;
        this.elements = 0;
    }

    init(){
        var md_slider_nav_prew = document.getElementById('md_slider_nav_prew');
        var md_slider_nav_next = document.getElementById('md_slider_nav_next');
        md_slider_nav_prew ? md_slider_nav_prew.addEventListener('click',() => this.navigation('prew')): null;
        md_slider_nav_next ? md_slider_nav_next.addEventListener('click',() => this.navigation('next')): null;
    }

    show() {
        var pos,i;
        var items =  document.getElementsByClassName('md-slider-item');
        this.elements = items.length;
        for (i = 0; i < items.length; i++) {
            pos = i * 100;
            items[i].style.left = pos+'%';
            items[i].style.display = 'flex';
        }

        console.log(`Slider Activo: ${this.slider_active} - Total Slider: ${this.elements}`);
    }

    navigation(action) {
        console.log(action);
    }

}
