<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Charles</title>


    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url('resources/css/ict333.css');?>" />
    <script type="text/javascript" src="<?php echo base_url('resources/js/jquery/jquery-1.9.1.min.js');?>"></script>
<!--    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
    <script src="<?php echo base_url('resources/js/jquery/jquery.mobile-1.3.2.min.js'); ?>"></script>
    <style type="text/css" src="<?php echo base_url('resources/js/jquery/jquery.mobile-1.3.2.min.css'); ?>"></style>
    <script type="text/javascript" src="<?php echo base_url('resources/js/MessageService.js');?>"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#primary_content').load('index.php/login');
            $(".icon_home").hide();
            $('#message_service').hide();
            $(".icon_home").click(function(){
                $('#primary_content').load('index.php/home');
            });
        });
    </script>
</head>
<body>

    <div id="container_content">
        <div id="message_service"></div>
        <div id="primary_header"><h1>ICT333</h1><img src="<?php echo base_url('resources/images/icon_home.png');?>" class="icon_home" /></div>

        <div id="primary_content"></div>

        <div id="primary_footer"><p>Page rendered in {elapsed_time} seconds</p></div>
    </div>

</body>
</html>