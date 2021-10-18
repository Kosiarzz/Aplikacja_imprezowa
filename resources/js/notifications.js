
function GetNotShownNotify()
{
    $.ajax({
        cache: false,
        url: base_url + '/getNotShownNotify',
        type: "GET",
        success: function(response){

        },
        beforeSend: function(){

        }
    });
}