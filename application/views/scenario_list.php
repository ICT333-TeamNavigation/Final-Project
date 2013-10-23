<script type="text/javascript">

$(document).ready(function(){
    var id;
    $('h3').click(function(){
        id = $(this).attr('id');
        var div = id + "_params";
        var jsonstring = $("#"+div).html();
        var jsData = jQuery.parseJSON(jsonstring);

        console.log(jsData);
        createGraph(jsData, id);
    });
    
    $('.scenario_save').click(function(){saveScenario();});
});

</script>


<?php

    print "<h2>Scenario List</h2>";    

    if($study_scenarios === false)
    {
        print "No results.";
    }
    else
    {    
        foreach($study_scenarios as $scenario)
        {
            print "<div class='study scenario_list'>";
        
            print "<span id='{$scenario[COL_SCENARIO_ID]}' class='left_frame small_button'>{$scenario[COL_NAME]}</span> <br/>";
 
            print "<span id='{$scenario[COL_SCENARIO_ID]}_description' class='left_frame'>{$scenario[COL_DESCRIPTION]}</span> <br/>";
            print "<div id='{$scenario[COL_SCENARIO_ID]}_params' class='study_id' style='display: none;'>{$scenario[COL_PARMS_JSON]}</div>";
            print "<div style='display: none;'>{$scenario[COL_SCENARIO_ID]}</div>";
            print "<div id='{$scenario[COL_SCENARIO_ID]}_save' class='button scenario_save' style='display: none;'>Save</div>";
            print "</div>";
            print "<br/>";
        }
    }
      
?> 

<div class="center_frame">
    <div id='create_scenario' class="button" style="float: left;" >Create Scenario</div> 
    
</div>   