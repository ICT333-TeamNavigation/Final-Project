<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Charles</title>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" media="all" href="<?php echo base_url('resources/css/ict333.css');?>" />
    <link rel="stylesheet" media="screen and (min-width: 801px)" href="<?php echo base_url('resources/css/desktop.css');?>" />
    <link rel="stylesheet" media="screen and (max-width: 800px) and (orientation: landscape)" href="<?php echo base_url('resources/css/tablet.css');?>" />
    <script type="text/javascript" src="<?php echo base_url('resources/js/jquery/jquery-1.9.1.min.js');?>"></script>
<!--    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
    <script src="<?php echo base_url('resources/js/jquery/jquery.mobile-1.3.2.min.js'); ?>"></script>
    <style type="text/css" src="<?php echo base_url('resources/js/jquery/jquery.mobile-1.3.2.min.css'); ?>"></style>
    <script type="text/javascript" src="<?php echo base_url('resources/js/MessageService.js');?>"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#primary_content').load('index.php/login');
            
            $('#message_service').hide();
            $(".logo").click(function(){
                $('#primary_content').load('index.php/home');
            });
            
            $("#home").click(function(){
                $('#primary_content').load('index.php/home');
            });
        });
    </script>
    
</head>
<body>
    <div class="bodybg">
    <div id="container_content">
        <div id="message_service"></div>
        <div id="primary_header">
            <div class="logo"><img src="<?php echo base_url('resources/images/logo.png');?>" /></div>
            
            <h2 id="home" style="text-align: right;" >Home</h2>
        </div>
        <div id="primary_content"></div>
    </div>
    </div>
    
    <div id="primary_footer">
        <p>Site created as part of Murdoch University ICT333 Project</p>
        <p>Page rendered in {elapsed_time} seconds</p>
    </div>

</body>
</html>
