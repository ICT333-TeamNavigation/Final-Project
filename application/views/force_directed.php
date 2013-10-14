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

<div><p onClick="persist()">persist</p></div>
    <div id="node_details">
        <h3 id="node_type"></h3>
        <ul id="listviewid" data-role="listview" data-inset="true">
            <li>
                <p>
                    <label for="amount">Value:</label>
                    <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
                 </p>
                <div id="node_slider"></div>
            </li>    
            <li id="node_details_save">
                save
            </li>
        </ul>
    </div>

<div id="svgdiv"></div>

<div id="result"></div>

<script type="text/javascript">
 site_root = '<?php echo base_url(); ?>'
 expanded = new Array();

 
 $('dcoument').ready(function(){
     $("#node_details").hide();
     $("#result").load("index.php/model/force", function(data){
        graph_data = ajax_result;
        sg = new Graph(ajax_result);
        sg.update();
         });
 });
 
    
</script>
