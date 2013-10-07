<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Force-Directed Graph</title>
<script type="text/javascript" src="<?php echo base_url('resources/js/d3.v2.js');?>"></script>
<style>

.link {
  stroke: #ccc;
}

.node text {
  pointer-events: none;
  font: 10px sans-serif;
}

</style>
<script>

var width = 960,
    height = 500,
    root;

var svg = d3.select("#chart").append("svg")
    .attr("width", width)
    .attr("height", height);

var force = d3.layout.force()
    .linkDistance(50)
    .charge(-120)
    .size([width, height]);

// Get data from scenario..
$('#result').load("index.php/model/force", function(data){
    root = ajax_result;
    update();
});

function update() {
    var nodes = flatten(root),
    links = d3.layout.tree().links(nodes);
    
  force
      .nodes(nodes)
      .links(links)
      .start();

  var link = svg.selectAll(".link")
      .data(links, function(d) { return d.target.id; })
      .enter().append("line")
      .attr("class", "link");

  var node = svg.selectAll(".node")
      .data(nodes, function(d) { return d.id; })
      .enter().append("g")
      .attr("class", "node")
      .on("click", click)
      .call(force.drag);

  node.append("image")
      .attr("xlink:href", "https://github.com/favicon.ico")
      .attr("x", -8)
      .attr("y", -8)
      .attr("width", 16)
      .attr("height", 16);

  node.append("text")
      .attr("dx", 12)
      .attr("dy", ".35em")
      .text(function(d) { return d.name; });

  force.on("tick", function() {
    link.attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
    
    
  });
}

function flatten(root) {
    var nodes = [], i = 0;

    function recurse(node) {
        if (node.children) node.children.forEach(recurse);
        if (!node.id) node.id = ++i;
        nodes.push(node);
    }

    recurse(root);
    return nodes;
}

function click(d) {
    if (d.children) {
        d._children = d.children;
        d.children = null;
        //alert("this");
    } else {
        d.children = d._children;
        d._children = null;
        //alert("that");
    }             

    update();
}


            
</script>
<div id="node_details"><h3 id="node_type"></h3></div>
<div id="chart"></div>
<div id="result"></div>