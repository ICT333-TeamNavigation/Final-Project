<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<script type="text/javascript" src="<?php echo base_url('resources/js/d3.v2.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/js/scenario_graph.js');?>"></script>
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
<div><p onClick="persist()">persist</p></div>
<div id="node_details">
    <h3 id="node_type"></h3>
    <span><label for="node_value">Value</label><input id="node_value" type="text" /></span>
    <span id="node_details_save">save</span>
</div>

<div id="svgdiv"></div>

<div id="result"></div>

<script type="text/javascript">
    var current_node;
    $(document).ready(function() {
        $("#node_details").hide();
        $("#node_details_save").click(function(){saveNode(current_node, $("#node_value").val()); });
	$("#svgdiv").html("<svg id='graph' width='100%' style='height: 500px'></svg>");
        
        // create a scenario graph instance
        sg = new scenario_graph();
        
        $('#result').load("index.php/model/force", function(data){
            sg.loadData(ajax_result);
        });
    });
    
    
    
</script>
