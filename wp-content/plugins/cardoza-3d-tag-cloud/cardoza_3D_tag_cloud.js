jQuery(document).ready(function(){

//Setup variables
var element = jQuery('#list a'); // all the list elements
var offset = 0;             // angle offset for animation
var stepping = 0.03;        // how fast the list rotates
var list = jQuery('#list');      // the list wrapper
var $list = jQuery(list);

$list.mousemove(function(e){
    stepping = 0;  
});
$list.mouseout(function(e){
	stepping=0.03;
});

/* Disperse elements evenly around the circle */
for (var i = element.length - 1; i >= 0; i--){
    element[i].elemAngle = i * Math.PI * 2 / element.length;
}

// call render function over and over
setInterval(render, 20);


// Handles how and where each element will be rendered.
function render(){
   
    //Steps through each element...
    for (var i = element.length - 1; i >= 0; i--){
       
        // offset adds degrees to where the element
        // is currently on the circle
        var angle = element[i].elemAngle + offset;
       
        // Trig to figure out the size and where the
        // text should go
        x = 80 + Math.sin(angle) * 30;
        y = 45 + Math.cos(angle) * 40;
        size = Math.round(40 - Math.sin(angle) * 40);
       
        // Centers the text, instead of being left aligned.
        var elementCenter = jQuery(element[i]).width() / 2;
       
        // Figure out the x value of the element.
        var leftValue = (($list.width()/2) * x / 100 - elementCenter) + "px"
       
       
        // Apply the values to the text
        jQuery(element[i]).css("opacity",size/100);
        jQuery(element[i]).css("zIndex" ,size);
        jQuery(element[i]).css("left" ,leftValue);
        jQuery(element[i]).css("top", y + "%");
    }
   
    // Rotate the circle
    offset += stepping;
}
   
   
});