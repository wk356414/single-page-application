
function pageLoad(url) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function(response){
            $('#content').html(response);
        },
        error: function(){
            alert("Error loading the page.");
        }
    });
}
