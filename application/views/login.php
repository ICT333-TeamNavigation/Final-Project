<script type="text/javascript">
$(document).ready(function(){
    // keypress behaviour
    $("#password").keypress(function( event ) {
        if ( event.which === 13) {
            doLogin();
        }
     });
    // login button behaviour
    $('#login').click(function(){
        doLogin();
    });
    
    // hide login result div
    $('#login_result').hide();
    
});

// login function
function doLogin(){
    var username = $('#username').val();
    var password = $('#password').val();
    $('#login_result').load('index.php/login/authenticate', {username:username, password:password},
        function(data, status){               
            if(ajax_result['result'] == "success"){
                $('#primary_content').load('index.php/home/', function(){$(".icon_home").show();});
            } else {
                var msg = new MessageService('error','incorrect username or password');
                msg.showMessage();
            }
        }
    );
}
</script>

<span class="login">Please Login</span>

<span class="login"><input type="text" id="username"></span>

<span class="login"><input type="password" id="password"></span>

<span class="login"><button id='login'>Login</button></span>

<div id="login_result"></div>

