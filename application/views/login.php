<script type="text/javascript">
    
// used to skip the login page
//$('#primary_content').load('index.php/home/', function(){$(".icon_home").show();});
     
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
            if(ajax_result['result'] == "success")
            {
                $('#primary_content').load('index.php/home/', function(){$(".icon_home").show();});
            } else {
                var msg = new MessageService('error', ajax_result['message']);
                msg.showMessage();
            }
        }
    );
}
</script>

<div class="login">
    <h2>Please Login</h2>
    <label for="username" >Username: </label>
    <input type="text" id="username" required="required" > 
    <label for="password" >Password: </label> 
    <input type="password" id="password" required="required" >
    <br/> <br/>
    <div class="button" id="login" >Submit</div>
</div>

<div id="message_service"></div>
<div id="login_result"></div>

