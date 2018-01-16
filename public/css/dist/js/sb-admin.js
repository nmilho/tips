/*!
 * Start Bootstrap - SB Admin 2 v3.3.7+1 (http://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */
$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});


$(document).ready(function() {
    $('#radarBooks').DataTable( {
        "dom": '<"top left"l><"top right"f>rt<"bottom-top"i><"bottom"p><"clear">',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
    $('#dbBooks').DataTable( {
        "dom": '<"top left"l><"top right"f>rt<"bottom-top"i><"bottom"p><"clear">',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );

    $('#radarSports').DataTable( {
        "dom": '<"top left"l><"top right"f>rt<"bottom-top"i><"bottom"p><"clear">',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
    $('#dbSports').DataTable( {
        "dom": '<"top left"l><"top right"f>rt<"bottom-top"i><"bottom"p><"clear">',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );

    $('#radarCategories').DataTable( {
        "dom": '<"top left"l><"top right"f>rt<"bottom-top"i><"bottom"p><"clear">',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
    $('#dbCategories').DataTable( {
        "dom": '<"top left"l><"top right"f>rt<"bottom-top"i><"bottom"p><"clear">',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );

    $('#radarTournaments').DataTable( {
        "dom": '<"top left"l><"top right"f>rt<"bottom-top"i><"bottom"p><"clear">',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
    $('#dbTournaments').DataTable( {
        "dom": '<"top left"l><"top right"f>rt<"bottom-top"i><"bottom"p><"clear">',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
} );


//Filleng Models modal data
//Books
function fillBookModalData (details){
    $('#fid').val(details[0]);
    $('#fname').val(details[1]);
}

//Sports
function fillSportModalData (details){
    $('#fid').val(details[0]);
    $('#fname').val(details[1]);
}

//Categories
function fillCategoryModalData (details){
    $('#fid').val(details[0]);
    $('#fname').val(details[1]);
    $('#fcountry').val(details[2]);
    $('#fsportid').val(details[3]);
    $('#foutrights').val(details[4]);
}

//Tournaments
function fillTournamentModalData (details){
    $('#fid').val(details[0]);
    $('#fname').val(details[1]);
    $('#fsport').val(details[2]);
    $('#fcategory').val(details[3]);
    $('#fseason').val(details[4]);
    $('#fseasonname').val(details[5]);
    $('#fseasonstart').val(details[6]);
    $('#fseasonend').val(details[7]);
    $('#fseasonyear').val(details[8]);
}

//*****END Filleng Models modal data

