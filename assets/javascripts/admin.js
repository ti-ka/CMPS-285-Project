$(document).ready(function(){

//Navigation Search Button

    $("body").on("click","#navbar-search-btn",function(){
        if($("#navbar-search").is(':visible')){
            return false
        } else {
            $("#navbar-search").animate({width:'toggle'},350)
            return false
        }
    })
//Filter
    $("body").on("keyup","#navbar-search",function(){
        var count = 0;
        var filter = $("#navbar-search").val().toLowerCase();

        $("tr").each(function(index){
            if(!$(this).children().is("td")){
                return
            }
            var str = $(this).children().text()
            if($(this).children().attr("data-more") != undefined){
                str+= $(this).children().attr("data-more");
            }

            if (str.toLowerCase().indexOf(filter) != -1){
                $(this).show();
                console.log($(this));
                count++;
                return
            } else {
                $(this).hide();
            }

        })

        $("#items div.btn-sales").each(function(index){
            var str = $(this).children().text()

            if($(this).children().attr("data-more") != undefined){
                str+= $(this).children().attr("data-more");
            }

            if (str.toLowerCase().indexOf(filter) != -1){
                $(this).show();
                console.log($(this));
                count++;
                return
            } else {
                $(this).hide();
            }

        })





        $("#results-count").text(count);



    })



//Clicking on the left menu to show/hide
    $("body").on("click", "ul.vertical-nav li a", function(){

        //Hiding other Siblings if open
        $(this).parent().siblings().children('ul').slideUp()

        //Checking if next is a ul
        if($(this).next().is('ul')){
            $(this).next().slideToggle();
        } else {
            //Nth AJAX
        }

        return false
    })

//Any "a" with data-ajax clicked to showPage in AJAX
    $("body").on("click","a[href]",function(){

        if(
            $(this).attr("href") == undefined
            || $(this).attr("href") == ""
            || $(this).attr("href") == "#"
            || $(this).attr("data-ajax") == "false"
        ){
            //Do nothing
        } else {
            loading("#explorer");
            showPage($(this).attr("href"))
            return false
        }
    })




//Click more to see more text
    $("body").on("click","td[data-more]",function(){
        //Switch text and data
        var text = $(this).html()
        var moreText = $(this).attr("data-more")

        $(this).html(moreText)
        $(this).attr("data-more",text)

    })



})






//Function to load AJAX on left or/any menu click
function showPage(url){
    $.ajax({
        url: url,
        cache:false,
        beforeSend: function( xhr ) {
            xhr.overrideMimeType( "text/html; charset=utf-8" );
        }
    })
        .done(function( data ) {
            $("#explorer").html(data)
        })
        .fail(function() {
            showModal("Error!","Loading Page Failed. Please try later.<br/><br/><small>Code ACEx404 on "+ url +"</small>");
            $("#explorer").children("div.spinner").remove();
        });
}

function loading(){
    $("#explorer").append("<div class='spinner'></div>")
}
