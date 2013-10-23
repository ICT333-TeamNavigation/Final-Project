<script type="text/javascript">

$(document).ready(function(){
    
    $('.scenario_select').click(function(){
        
        // hide all save and delete buttons
        $(".scenario_save").hide();
        $(".scenario_delete").hide();
                
        var id = $(this).attr('id');
        
        // show the save and delete button for this scenario
        $("#" + id + "_save").show();
        $("#" + id + "_delete").show();
        
        $(".scenario_select").removeClass("selected");
        $(this).addClass("selected");
        
               
        var div = id + "_params";
        var jsonstring = $("#"+div).html();
        
        var jsData = jQuery.parseJSON(jsonstring);
        
        console.log(jsData);
        createGraph(jsData, id);
    });
    
    $('.scenario_delete').click(function(){
        // get scenario_id from previous element
        var scenario_id = $(this).prev().prev().attr('id');
        postDeleteScenario(scenario_id);
    });
    
    $('.scenario_save').click(function(){saveScenario();});
});

function postDeleteScenario( scenario_id )
{
    var post_obj = { scenario_id: scenario_id }; 
         
    $('#delete_result').load('index.php/scenario/removeScenario', post_obj,
        function(data, status)
        {               
            if(ajax_result['result'] == "success")
            {
                var msg = new MessageService('success', "Scenario deleted.");
                msg.showMessage();
                
                $("#scenario_list").load("index.php/scenario/loadStudyScenarios");
            } 
            else 
            {
                var msg = new MessageService('error', "Error deleting scenario.");
                msg.showMessage();
            }
        });     
}

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
            
            print "<span class='left_frame'>Name:</span>";
            print "<span id='{$scenario[COL_SCENARIO_ID]}_name' class='right_frame'>{$scenario[COL_NAME]}</span>";
            
            print "<span class='left_frame'>Description:</span>";
            print "<span id='{$scenario[COL_SCENARIO_ID]}_description' class='right_frame'>{$scenario[COL_DESCRIPTION]}</span>";
            print "<br/><br/>"; 
            
            print "<span id='{$scenario[COL_SCENARIO_ID]}' class='left_frame small_button scenario_select'>Select</span>";
            print "<span id='{$scenario[COL_SCENARIO_ID]}_save' class='right_frame small_button scenario_save selected' style='display: none;'>Save</span>";
            print "<span id='{$scenario[COL_SCENARIO_ID]}_delete' class='right_frame small_button scenario_delete selected' style='display: none;'>Delete</span>";
            
            print "<span id='{$scenario[COL_SCENARIO_ID]}_params' class='study_id' style='display: none;'>{$scenario[COL_PARMS_JSON]}</span>";
            
            print "</div>";
            
            
        }
    }
      
?> 
<div id="delete_result" ></div>