<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="<?php echo base_url('resources/js/jquery/jquery-1.9.1.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/js/jquery/jquery.mobile-1.3.2.min.js');?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('resources/js/jquery/jquery.mobile-1.3.2.min.css'); ?>">
        <script type="text/javascript">
            $(document).ready(function(){
                $( "#node_slider" ).on( 'slidestop', function( event ) { 
                    saveParameter($("#node_slider").val());
                });
                
                $('#close').click(function(){
                    $('#node_details').hide();
                });
            
            });
        </script>
    </head>
    <body>
        <div id="close"></div>
        <h3 id="node_type"></h3>
        <div>
            <input id="node_slider" type="range" name="node_slider" value="60" min="0" max="100" data-highlight="true"/>
        </div>
<!--        <div class="button" id="node_details_save" >save</div>-->
    </body>
</html>