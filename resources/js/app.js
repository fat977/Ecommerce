import './bootstrap';
$(document).ready(function(){

    $(document).on('click','#send_message',function (e){
        e.preventDefault();

        let message = $('#message').val();
        if(message == ''){
            alert('Please enter message')
            return false;
        }
        $.ajax({
            method:'post',
            url:'/send-notification',
            data:{message:message},
            success:function(res){
                $('#notification_count').val()
                $('#notification_count').text( parseInt($('#notification_count').text()) + 1 );
                $('#message').val('');
            }
        });

    });
});

window.Echo.channel('chat')
    .listen('.OrderNotification',(e)=>{
        $('#message').val('');
    });
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
