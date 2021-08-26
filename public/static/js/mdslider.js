class MDSlider {

    constructor(){
        this.init();
        this.slider_active = 0;
        this.items =  document.getElementsByClassName('md-slider-item');
        this.elements = this.items.length - 1;
        this.automatic();
    }

    init(){
        var md_slider_nav_prew = document.getElementById('md_slider_nav_prew');
        var md_slider_nav_next = document.getElementById('md_slider_nav_next');
        md_slider_nav_prew ? md_slider_nav_prew.addEventListener('click',() => this.navigation('prew')): null;
        md_slider_nav_next ? md_slider_nav_next.addEventListener('click',() => this.navigation('next')): null;
    }

    show() {
        var pos,i;
        for (i = 0; i < this.items.length; i++) {
            pos = i * 100;
            this.items[i].style.left = pos+'%';
            this.items[i].style.display = 'flex';
        }
    }

    navigation(action) {
        if(action == "prew"){
            if(this.slider_active > "0"){
                this.slider_active = this.slider_active - 1;
                var i,pos;
                for (i = 0; i < this.items.length; i++) {
                    pos = parseInt(this.items[i].style.left) + 100;
                    this.items[i].style.left = pos+'%';
                }
            }
        }

        if(action == "next"){
            if(this.slider_active < this.elements){
                this.slider_active = this.slider_active + 1;
                var i,pos;
                for (i = 0; i < this.items.length; i++) {
                    pos = parseInt(this.items[i].style.left) - 100;
                    this.items[i].style.left = pos+'%';
                }
            }
        }
    }

    automatic(){
        setInterval(() => {
            if(this.slider_active < this.elements){
               this.navigation("next");
            }else{
                this.show();
                this.slider_active = 0;
            }
        },10000);
    }

}
