window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '2c01659086f9827ec1c1',
    cluster: 'ap1',
    forceTLS: true
  });
var channelComment = window.Echo.channel('posts');
channelComment.listen('.newcomment', (comment) =>{
  $("#comment" + comment.post_id).before(comment.comment);
});

var channelMessage = window.Echo.channel('messages');
	channelMessage.listen('.newmessage',function(data){
    var today = new Date();
    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
    var time = today.getHours() + ":" + today.getMinutes();
    var current =  time+' '+date;
    let id = $('#mes').attr('data-message');
    var message ='';
    if(id == data.fromUser){
    	 message = `<li class = "media sent" >`;
       //23:28: 22-03-2020
    }else if(id == data.toUser){
    	 message = `<li class = "media received">`;
    }
    let content = `<div class = "media-body">
                            <div class="msg-box">
                                <div>
                                        <p>${data.message}</p>
                                        <ul class="chat-msg-info">
                                            <li>
                                               <div class="chat-time">
                                                    <span>${current}</span>
                                               </div>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                     </div>
                 </li>`;
    message+=content;
    $('#text_mess').before(message);

});



