/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    
function scenario_graph() {
    
    this.w = 960,
    this.h = 500,
    this.maxNodeSize = 50,
    this.root,
    this.root_json;
 
    this.vis = d3.select("svg");
    this.force = d3.layout.force(); 
    console.log(this.vis);


    this.loadData = function(data){
        this.root = data;
        this.root.fixed = true;
        this.root.x = this.w / 2;
        this.root.y = 120;

        // Build the arrow
//        console.log("insert markers");
        var defs = this.vis.insert("svg:defs").selectAll("marker")
            .data(["end"]);

        defs.enter().append("svg:marker")
            .attr("id", "end")
            .attr("viewBox", "0 -5 10 10")
            .attr("refX", 10)
            .attr("refY", 0)
            .attr("markerWidth", 6)
            .attr("markerHeight", 6)
            .attr("orient", "auto")
          .append("svg:path")
            .attr("d", "M0,-5L10,0L0,5");
//       console.log("call update");     
        this.update();
    }
    

 
/**
 *   
 */
this.update = function() {

    var nodes = flatten(this.root),
    links = d3.layout.tree().links(nodes);
    console.log("links:");
    console.log(links);
    
  // Restart the force layout.
    this.force.nodes(nodes)
        .links(links)
        .gravity(0.05)
            .charge(-120)
            .linkDistance(75)
            .friction(0.5)
            .linkStrength(function(l, i) {return 1; })
            .size([this.w, this.h])
            .on("tick", tick)
        .start();
 
    console.log("force started");
    
    var path = this.vis.selectAll("path.link")
        .data(links, function(d) { return d.target.id; });
 
    path.enter().insert("svg:path")
        .attr("class", "link");
//	.attr("marker-end", "url(#end)")
//	.style("stroke", "#ccc");
 
  // Exit any old paths.
  path.exit().remove();
 console.log("point: 0.5");
  // Update the nodes…
  var node = this.vis.selectAll("g.node")
      .data(nodes, function(d) { return d.id; });
   console.log("point: 1");
  // Enter any new nodes.
  var nodeEnter = node.enter().append("svg:g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
      .on("click", click)
      .call(this.force.drag);
 console.log("point: 2");
  // Append a circle
  nodeEnter.append("svg:circle")
      .attr("r", function(d) { return Math.sqrt(d.size) / 10 || 4.5; })
      .style("fill", color);
 
 console.log("point: 3");
  // Add text to the node (as defined by the json file) 
  nodeEnter.append("svg:text")
      .attr("text-anchor", "middle")
      .attr("dx", function(d) { return Math.sqrt(d.size) / 10 || 4.5; })
      .attr("dy", ".35em")
      .text(function(d) { return d.name; });
  
 console.log("point: 4");
  //Add an image to the node (if any)
  nodeEnter.append("svg:image")
	      .attr("xlink:href",  function(d) { return d.logo;})
	      .attr("x", function(d) { return (0);})
	      .attr("y", function(d) { return (0 - (d.logoheight/2)) || -16;})
	      .attr("height", function(d) { return d.logoheight || 16;})
	      .attr("width", function(d) { return d.logowidth || 16;});
 
  // Exit any old nodes.
  node.exit().remove();
 
  // Re-select for update.
  path = this.vis.selectAll("path.link");
  node = this.vis.selectAll("g.node");

// function tick() {
//     path.attr("x1", function(d) { return d.source.x; })
//        .attr("y1", function(d) { return d.source.y; })
//        .attr("x2", function(d) { return d.target.x; })
//        .attr("y2", function(d) { return d.target.y; });
//
//    node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
// }
function tick() {
 
    path.attr("d", function(d) {
 
		 var dx = d.target.x - d.source.x,
	         dy = d.target.y - d.source.y,
	         //dr = Math.sqrt(dx * dx + dy * dy);
                 dr = 0;
	         return 	"M" + d.source.x + "," 
	    			+ d.source.y 
	    			+ "A" + dr + "," 
	    			+ dr + " 0 0,1 " 
	    			+ d.target.x + "," 
	    			+ d.target.y;
	});
    node.attr("transform", nodeTransform);    
  }
}
 
/**
 * Gives the coordinates of the border for keeping the nodes inside a frame
 * http://bl.ocks.org/mbostock/1129492
 */ 
function nodeTransform(d) {
    //d.x =  Math.max(this.maxNodeSize, Math.min(this.w - (d.logowidth/2 || 16), d.x));
    //d.y =  Math.max(this.maxNodeSize, Math.min(h - (d.logoheight/2 || 16), d.y));
    return "translate(" + d.x + "," + d.y + ")";
   }
 
/**
 * Color leaf nodes orange, and packages white or blue.
 */ 
function color(d) {
  return d._children ? "#3182bd" : d.children ? "#c6dbef" : "#fd8d3c";
}
 
/**
 * Toggle children on click.
 */ 
function click(d) {
  if (d.children) {
    d._children = d.children;
    d.children = null;
  } else {
    d.children = d._children;
    d._children = null;
  }
  //alert(d.size);
  //d.size = d.size + 5;
  sg.update();
  this.root_json=createJSON(this.root);
  current_node = d;
    //var node_name = d.name;
    $("#node_type").text(d.name);
    $("#node_value").val(d.size);
    $("#node_details").show();
    
}
 
/**
 * Returns a li=st of all nodes under the root.
 */ 
function flatten(root) {
  var nodes = []; 
  var i = 0;
   
  function recurse(node) {
    if (node.children) 
    	node.children.forEach(recurse);
    if (!node.id) 
    	node.id = ++i;
    nodes.push(node);
  }
 
  recurse(root);
  console.log("Nodes:");
  console.log(nodes);
  return nodes;
}


}

function createJSON(obj){
    return JSON.stringify(obj);
}

function findNode(id){
    
}

function saveNode(node, val) {
    node['size'] = val;
}

function persist() {
    var jsonObj = createJSON(sg.root);
    console.log(jsonObj);
}