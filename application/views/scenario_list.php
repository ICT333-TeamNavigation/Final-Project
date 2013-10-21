<script type="text/javascript">


$(document).ready(function(){
    $('h3').click(function(){
        var id = $(this).attr('id');
        var div = id + "_params";
        var jsonstring = $("#"+div).html();
        var jsData = jQuery.parseJSON(jsonstring);
        
        console.log(jsData);
        createGraph(jsData);
    });

});

</script>


<?php
    print "<h2>Scenario List</h2>";    

    if($study_scenarios === false)
    {
        print "No results.";
        exit(0);
    }
        
    foreach($study_scenarios as $scenario)
    {
        print "<div class='study scenario_list'>";
        
        print "<h3 id='{$scenario[COL_SCENARIO_ID]}' class='left_frame'>{$scenario[COL_NAME]}</h3> <br/>";
 
        print "<span class='left_frame'>{$scenario[COL_DESCRIPTION]}</span> <br/>";
        print "<div id='{$scenario[COL_SCENARIO_ID]}_params' class='study_id' style='display: none;'>{$scenario[COL_PARMS_JSON]}</div>";
        print "<div style='display: none;'>{$scenario[COL_SCENARIO_ID]}</div>";
        
        print "</div>";
        print "<br/>";
    }
   
    
?> 
