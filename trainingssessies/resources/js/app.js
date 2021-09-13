require('./bootstrap');

// Make 'Trainingssessies' accessible inside the HTML pages
import Trainingssessies from "./trainingssessies.js";
window.Trainingssessies = Trainingssessies;


$(function(){
    setTimeout(function() {
        $('#sessionMessage').fadeOut('slow');
    }, 3000);
});

$(function(){
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html : true,
    }).on('click', '[data-toggle="tooltip"]', function () {
        // hide tooltip when you click on it
        $(this).tooltip('hide');
    });
});

$(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
