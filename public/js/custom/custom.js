// gsap.to(".titleano", {duration: 2, x: 300});

$(document).ready(function(){

    for (let i = 0; i < 3; i++) {
        
$( "#click-start[i]" ).click(function() {
    if ($(".click-end[i]").css("border-style") == ("none")){
        $(".click-end[i]").css("border-style", "solid");
    }else{
        $(".click-end[i]").css("border-style", "none");
    }  
});

    }


});
// $(document).ready(function(){

// //   $("#click-start").click(function(){
// //     $(".click-end").css("border-style", "solid");
// //     }, function(){
// //         $(".click-end").css("border-style", "none");
// //   });

//   $("#click-start").hover(function(){
//     $(".click-end").css("border-style", "solid");
//   }, function(){
//     $(".click-end").css("border-style", "none");
// });

// });
