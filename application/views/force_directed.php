<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<script type="text/javascript" src="<?php echo base_url('resources/js/d3.v3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/js/Graph.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/js/jquery/jquery-ui-1.10.3.custom.min.js');?>"></script>

<link rel="stylesheet" href="<?php echo base_url('css/start/jquery-ui-1.10.3.custom.min.css');?>" />

<style type="text/css">
.node {
    stroke: #009900;
    stroke-width: 1.5px;
    color: #009900;
}

.node text {
    pointer-events: none;
    font: 15px sans-serif;
    stroke-width: 0px;
}

.link {
    stroke: #999;
    /* stroke-opacity: 2.6; */
}

path.link {
    fill: none;
    stroke-width: 2px;
}

marker#end {
    fill: #999;
}

line {
    stroke: #000;
    stroke-width: 1.5px;
}
</style>

<div id="result" style="display: none;"></div>
<div>
    <div id="scenario_list" >
        <img src="<?php echo base_url('resources/images/ajax-loader.gif');?>" />
    </div>
    <div id="scenario_tab" class="rotate" style="display: none;">Scenarios</div>
    <div id="svgdiv"></div>
</div>
 
<div id="node_details" style="display: none;"></div>



<div id="create_scenario_form" style="background: #fff; display: none">
    <h2>Create New Scenario</h2>
    <form>
        <label for="scenario_name" >Scenario Name: </label>
        <input type="text" id="scenario_name" required="required" > 
        <label for="scenario_description" >Description: </label> 
        <input type="text" id="scenario_description" required="required" >
        <div id='create_scenario' class="button" style="float: left;" >Submit</div>
        <div id='cancel_create_scenario' class="button" style="float: left;" >Cancel</div> 
        <div id="create_scenario_result"></div>
    </form>
</div>

<script type="text/javascript">
 site_root = '<?php echo base_url(); ?>';
 expanded = new Array();

 
 $('document').ready(function(){
     
     $("#node_details").load("index.php/study/node", function(){
     });
     
     $("#scenario_list").load("index.php/scenario/loadStudyScenarios");
     
     $('#create_scenario').click(function(){
        postCreateScenario();
        $('#create_scenario_form').hide();
     });
     
     $('#cancel_create_scenario').click(function(){
        cancelCreateScenario();
     });
     
     $("#scenario_tab").click(function(){
         $("#scenario_list").show("slow");
         $(this).hide();
     });
   
     sg = null;
     graph_data = null;

 });
 
 function createGraph(jsondata, scenario_id){
     sg = null;
     graph_data = null;
     $("#svgdiv").children("svg").remove();
        graph_data = jsondata;
        sg = new Graph(graph_data);
        var selector = "#" + scenario_id;
        sg.scenario_id = scenario_id;
        sg.name = $(selector + "_name").html();
        sg.description = $(selector + "_description").html();
        sg.update();
 }
 
function saveScenario() {
    var json_string = JSON.stringify(graph_data);
 
    $("#result").load("index.php/scenario/saveScenario",
        {
            scenario_id: sg.scenario_id,
            name: sg.name,
            description: sg.description,
            parms_json: json_string
        }, function(data, status) {
            console.log(data);
            if(status === "success") {
                $("#" + sg.scenario_id + "_params").html(json_string);
                var msg = new MessageService("success", "Scenario saved.");
                msg.showMessage();
            }
        }
    );
}

function cancelCreateScenario() {
    $('#scenario_description').val('');
    $('#scenario_name').val('');
    $('#create_scenario_form').hide();
}

function postCreateScenario()
{
    var name = $('#scenario_name').val();
    name = name.trim();
    if( name.length === 0 )
    {
        var msg = new MessageService("error", "Please Enter a Scenario Name. Try again.");
        msg.showMessage();
        return;
    }
      
    var description = $('#scenario_description').val();
    description = description.trim();
    if( description.length === 0 )
    {
        var msg = new MessageService("error", "Please Enter a Scenario Description. Try again.");
        msg.showMessage();
        return;
    }
           
    var post_obj = { name:        name, 
                     description: description }; 
         
    $('#create_scenario_result').load('index.php/scenario/createScenario', post_obj,
        function(data, status)
        {               
            if(ajax_result['result'] === "success")
            {
                var msg = new MessageService('success', "Scenario created.");
                msg.showMessage();
                
                $("#scenario_list").load("index.php/scenario/loadStudyScenarios");
            } 
            else 
            {
                var msg = new MessageService('error', "Error creating scenario.");
                msg.showMessage();
            }
        } );     
}

</script>
