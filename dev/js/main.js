//todo окультурить этлот код!

$(function() {
/*    var spinner = $('#spinner').spinner(*/
    var spinner = $('#spinner1').spinner(
        {
            min: 0,
            max: 10,
            spin: function(event, ui) {
                $(this).change();
            }
        }
    );
    var spinner = $('#spinner2').spinner(
        {
            min: 0,
            max: 10,
            spin: function(event, ui) {
                $(this).change();
            }
        }
    );
    value = 0;

    $( "#setvalue2" ).click(
        function() {
            var value = spinner.spinner( "value" );
            value = value + 1;
            spinner.spinner( "value", value  );
        }
    );

    $( "#setvalue3" ).click(
        function() {
            var value = spinner.spinner( "value" );
            value = value - 1;
            spinner.spinner( "value", value );
        }
    );

    $( "button" ).button();
});

