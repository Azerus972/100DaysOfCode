/*Main script JavaScript*/

console.log('JS Connected');

window.onscroll = function() {scrollFunction();};

/*fonction de retour Haut*/

function scrollFunction() {
    if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {

        document.getElementById("retourHaut").style.right = "2%";
        document.getElementById("retourHaut").style.opacity = "1";
        document.getElementById("retourHaut").style.transform = "scale(1)";

    } else {

        document.getElementById("retourHaut").style.right = "-1%";
        document.getElementById("retourHaut").style.opacity = "0";
        document.getElementById("retourHaut").style.transform = "scale(0.75)";
    }
}

$(document).ready(function(){

   	$('.top').click(function(){

    	$('html,body').animate({scrollTop: 0},1000);

   	});
});