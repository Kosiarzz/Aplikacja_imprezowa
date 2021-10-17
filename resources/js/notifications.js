
function GetNotShownNotify()
{
    $.ajax({
        cache: false,
        url: base_url + '/getNotShownNotify',
        type: "GET",
        data: {id: idOfNotification},
        success: function(response){

        },
        beforeSend: function(){

        }
    });
}