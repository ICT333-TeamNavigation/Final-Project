<script type="text/javascript">
$(document).ready(function(){
    // login behaviour
    $('#login').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        $('#login_result').load('index.php/login/auth', {username:username, password:password},
            function(data, status){               
                if(ajax_result['result'] == "success"){
                    $('#primary_content').load('index.php/home/');
                } else {
                    var msg = new MessageService('error','incorrect username or password');
                    msg.showMessage();
                }
            }
        );
    });
    
    // hide login result div
    $('#login_result').hide();
    
});
</script>

<span>Please Login</span>

<span class="login"><input type="text" id="username"></span>

<span class="login"><input type="password" id="password"></span>

<span class="login"><button id='login'>Login</button></span>

<div id="login_result"></div>
