(function ($) {
    Drupal.behaviors.premier_league = {
        attach: function(context) {
    $("td").hover(
        function() {
            console.log("hovering happening")
            $(this).addClass('hover-cell');
        },
        function() {
            $(this).removeClass('hover-cell');
        }
    )
    $("#block-premier-league-league-table").load("node/get/ajax/6");
    }
}
     }(jQuery));