
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
            <title>Force-Directed Graph</title>
            <script type="text/javascript" src="<?php echo base_url('resources/js/d3.v2.js');?>"></script>
            <style type="text/css">
                circle.node {
                    cursor: pointer;
                    stroke: #3182bd;
                    stroke-width: 1.5px;
                }
                
                line.link {
                    fill: none;
                    stroke: #9ecae1;
                    stroke-width: 1.5px;
                }
                
                </style>

        <div id="node_details"><h3 id="node_type"></h3></div>
        <div id="chart"></div>
        <div id="result"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#node_details").hide();
            });
            
            var w = 960,
            h = 500,
            node,
            link,
            root;
            
            var force = d3.layout.force()
            .linkDistance(50)
            .charge(-120)
            .on("tick", tick)
            .size([w, h]);
            
            var vis = d3.select("#chart").append("svg:svg")
            .attr("width", w)
            .attr("height", h);
            
            // Get data from scenario..
            $('#result').load("index.php/model/force", function(data){
                root = ajax_result;
                update();
            });
            
            function update() {
                var nodes = flatten(root),
                links = d3.layout.tree().links(nodes);
                
                // Restart the force layout.
                force
                .nodes(nodes)
                .links(links)
                .start();
                
                // Update the links…
                link = vis.selectAll("line.link")
                .data(links, function(d) { return d.target.id; });
                
                // Enter any new links.
                link.enter().insert("svg:line", ".node")
                .attr("class", "link")
                .attr("x1", function(d) { return d.source.x; })
                .attr("y1", function(d) { return d.source.y; })
                .attr("x2", function(d) { return d.target.x; })
                .attr("y2", function(d) { return d.target.y; });
                
                // Exit any old links.
                link.exit().remove();
                
                // Update the nodes…
                node = vis.selectAll("circle.node")
                .data(nodes, function(d) { return d.id; })
                .style("fill", color);
        
                
                // Enter any new nodes.
                node.enter().append("svg:circle")
                .attr("class", "node")
                .attr("cx", function(d) { return d.x; })
                .attr("cy", function(d) { return d.y; })
                .attr("r", function(d) { return Math.sqrt(d.size) / 8 || 6; })
                .style("fill", color)
                .on("click", click)
                .on("mouseover", mouseover)
                .call(force.drag);
        
        
                // Exit any old nodes.
                node.exit().remove();
            }
            
            function tick() {
                link.attr("x1", function(d) { return d.source.x; })
                .attr("y1", function(d) { return d.source.y; })
                .attr("x2", function(d) { return d.target.x; })
                .attr("y2", function(d) { return d.target.y; });
                
                node.attr("cx", function(d) { return d.x; })
                .attr("cy", function(d) { return d.y; });
            }
            
            // Color leaf nodes orange, and packages white or blue.
            function color(d) {
                return d._children ? "#3182bd" : d.children ? "#c6dbef" : "#fd8d3c";
            }
            
            // Toggle children on click.
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
            
            function collapse(d){
                d._children = d.children;
                d.children = null;
            }
            
            function mouseover(d) {
                var node_name = d.name;
                $("#node_type").text(node_name);
                $("#node_details").show(); 
            }
            
            // Returns a list of all nodes under the root.
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
            
            </script>
