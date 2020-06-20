$(document).ready(function(){
    
});

$('#replyb').click(function(){
       $(this).next('#replyText').toggle();
});

$('#reply').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        newPerson();
    }
});
function newPerson() {
    $('#wrapper').append('<div class="item"><p>'+$('#reply').val()+'</p></div>');
    $('#reply').val("");
}