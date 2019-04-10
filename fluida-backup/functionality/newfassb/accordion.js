jQuery(document).ready(function () {

    var acc = jQuery(".accordion");
    var toggle_button = jQuery(".closeall");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
        panel.style.maxHeight = null;//collapse when click on the second time
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px"; //open the dropdown when click it
        }
     }
    }
     

    toggle_button.click(function() {
        for (i=0; i< acc.length; i++){
            var title = acc[i];
            var content = title.nextElementSibling;
            //if at least one of them is opened
            if (content.style.maxHeight) { 
                collapseAll();
                jQuery(acc).removeClass("active");
                return 0;
            //expand when all of them are closed
            } 
        }
            expandAll();
            jQuery(acc).addClass("active");
            return 0;
            
        });
   

    function collapseAll(){
        for (i = 0; i < acc.length; i++) {
            var title = acc[i];
            var content = title.nextElementSibling;
            if(content.style.maxHeight){ 
                content.style.maxHeight = null;   
            } 
        }
    }


    function expandAll(){
        for(i = 0; i < acc.length; i++) {
            var title = acc[i];
            var content = title.nextElementSibling;
            content.style.maxHeight = content.scrollHeight + "px";
            
        }

    }
     
    })
