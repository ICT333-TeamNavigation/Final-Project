/* 
 * Class to render user scenario data using a force directed graph
 * 
 */
var current_param;

function Graph(graphData){
    
    this.scenario_id;
    this.name;
    this.description;
    this.myLinks = new Array();
    // properties
    this.orig_data = graphData;
    this.json = jQuery.extend(true, {}, graphData);
    var width = 850,
        height = 500;

    // TODO: specify the DOM object for the graph
    var svg = d3.select("#svgdiv").append("svg")
        .attr("width", width)
        .attr("height", height);

    var force = d3.layout.force()
        .gravity(0.00001)
        .distance(100)
        .charge(-100)
        .size([width, height]);


    
    //var myLinks = json.links;
    
    // redraw the graph
    this.update=function() {
//        var myLinks = this.json.links;
        var myLinks = this.myLinks;
        var myNodes = this.json.nodes;
                

        //clear expanded links to parameter nodes in previous updates
//        myLinks.splice(this.orig_data.links.length, myLinks.length - this.orig_data.links.length);
        myLinks.length = 0;

        for(var n=0; n < myNodes.length; n++) {
            var node = myNodes[n];
            var myChildren = null;
            console.log('parent: ' + node.name);
            console.log('children: ' + myChildren);
            
            //populate links between nodes
            if(node.links) {
            for(var l=0; l < node.links.length; l++) {
                var linkedNode = node.links[l];
                var targetNode = myNodes[linkedNode - 1];
                var addLink = true;
                for(var e=0; e < myLinks.length; e++){
                    if((myLinks[e].source === node && myLinks[e].target === targetNode) ||
                        (myLinks[e].source === targetNode && myLinks[e].target === node)) {
                            addLink = false;
                        }
                }
                if(addLink){
                    myLinks.push({"source": node , "target": targetNode});
                }
                
            }
            }
            
            // show nodes that have been expanded
            if(node.parameters){
                myChildren = node.parameters;
                console.log("number of nodes to add: " + myChildren.length);
                for(i=0; i < myChildren.length; i++) {
                  if(expanded.indexOf(node.name) > -1) {
                    //if node is not already there!!
                    console.log('expanded: ' + node.name);
                    if(myNodes.indexOf(myChildren[i]) === -1){
                        var x = myNodes.push(myChildren[i]);
                        var addedNode = myNodes[x-1];
//                        myChildren[i].parent = n;
                          console.log("adding child node @ " + x);
                          console.log(myNodes[x-1]);
                        myLinks.push({"source": node, "target": addedNode});
                    } else {
                        myLinks.push({"source": node, "target":myNodes[myNodes.indexOf(myChildren[i])]});
                    }    
                  } else {
                        var childIndex = myNodes.indexOf(myChildren[i]);
                        if(childIndex > -1) {
                            myNodes.splice(childIndex,1);
                        }
                  }
                }
            }
        }
        console.log("nodes and links");
        console.log(myNodes);
        for(a=0; a<myLinks.length; a++){
            console.log("Link: " + a);
            console.log(myLinks[a].source);
            console.log(myLinks[a].target);

        }

            force
                .nodes(this.json.nodes)
                .links(myLinks)
                .start();

            $("svg").empty();

            var link = svg.selectAll(".link")
                .data(myLinks)
              .enter().append("line")
                .attr("class", "link");

            var node = svg.selectAll(".node")
                .data(this.json.nodes)
              .enter().append("g")
                .attr("class", "node")
                .on("click", click)
                .call(force.drag);

            node.append("image")
                .attr("xlink:href", function(d) {
                    if(d.picture === undefined){
                        return site_root + "resources/images/param.png";
                    }else{
                        return site_root + "resources/images/" + d.picture;
                    }
                    
                } )
                .attr("x", -8)
                .attr("y", -8)
                .attr("width", 30)
                .attr("height", 30);

            node.append("text")
                .attr("dx", 24)
                .attr("dy", ".35em")
                .text(function(d) { if(d.name === undefined){return d.parm_name;} else {return d.name;}});

            force.on("tick", function() {
              link.attr("x1", function(d) { return d.source.x; })
                  .attr("y1", function(d) { return d.source.y; })
                  .attr("x2", function(d) { return d.target.x; })
                  .attr("y2", function(d) { return d.target.y; });

              node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
            });
    };

}

function saveParameter(val){
  console.log("saving parameter");
    // update the value of the parameter graph object
    current_param.current_value = val;
    
    //activate save scenario button
    $('#'+ sg.scenario_id +'_save').show();

    // locate and update the value of the parameter presistance object
    for(var i=0; i<graph_data.nodes.length; i++) {
        var params = graph_data.nodes[i].parameters;
        if(params.length > 0){
            for(var p=0;p<params.length; p++) {
                if(params[p].parm_name === current_param.parm_name &&
                        params[p].node_id === current_param.node_id
                        ) {
                    params[p].current_value = current_param.current_value;
               }
           }  
       }
   }
   

} 


function click(d) {

   if(d.name === undefined) {
       current_param = d;
       $("#node_slider").attr('max', d.max_value);
       $("#node_slider").attr('min', d.min_value);
       $("#node_slider").val(d.current_value);
       
       $("#node_type").text(d.parm_name);
       $("#node_details").show();
    } else {
        current_param = null;
        $("#node_details").hide();
        if(expanded.indexOf(d.name) >= 0) {
            expanded.splice(expanded.indexOf(d.name), 1);
        }else {
           expanded.push(d.name);
        }
        sg.update();
    }
};