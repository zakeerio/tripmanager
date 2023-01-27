$(document).ready(function(){
    // Sidebar Menu
    $("#burger-menu > .open-menu").click(function(){
        $("#sidebar").addClass("active-menu");
    });

    $("#burger-menu > .close-menu").click(function(){
        $("#sidebar").removeClass("active-menu");
    });


    //Filter
    $(".btn-filter .teck-btn.filterbutton > a").click(function(){
        // $(".teck-dropdown").removeClass('active');
        $(this).siblings(".teck-dropdown").toggleClass('active');
    //    $(".btn-filter .teck-btn > .teck-dropdown").toggleClass("active");
    });


    // $(".btn-filter .teck-btn > a").click(function(){
    //     $(".btn-filter .teck-btn > .teck-dropdown").toggleClass("active");
    //  });
});
