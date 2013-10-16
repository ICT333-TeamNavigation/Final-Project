/* 
 * Class to render user scenario data using a force directed graph
 * 
 */
var current_param;

function Graph(graphData){
    
    
    // properties
    this.orig_data = graphData;
    this.json = jQuery.extend(true, {}, graphData);
    var width = 960,
        height = 500;
 
    

    // TODO: specify the DOM object for the graph
    var svg = d3.select("#svgdiv").append("svg")
        .attr("width", width)
        .attr("height", height);

    var force = d3.layout.force()
        .gravity(.01)
        .distance(100)
        .charge(-100)
        .size([width, height]);


    
    //var myLinks = json.links;
    
    // redraw the graph
    this.update=function() {
//    var xpand = x;
//    this.json = jQuery.extend(true, {}, graphData);
//    this.json = jQuery.extend(true, {}, this.orig_data);
    //this.json.links = jQuery.extend(true, {}, orig_data.links);

    var myLinks = this.json.links;    
    var myNodes = this.json.nodes;
    
    //clear expanded links to parameter nodes in previous updates
    myLinks.splice(this.orig_data.links.length, myLinks.length - this.orig_data.links.length);
    
    for(n=0; n < myNodes.length; n++) {
        var node = myNodes[n];
        myChildren = node.parameters;
        console.log('parent: ' + node.name);
        console.log('children: ' + myChildren);
        // show nodes that have been expanded
        if(myChildren){
            for(i=0; i < myChildren.length; i++) {
              if(expanded.indexOf(node.name) > -1) {
                //if node is not already there!!
                console.log('expanded: ' + node.name);
                if(myNodes.indexOf(myChildren[i]) === -1){
                    x = myNodes.push(myChildren[i]);
                    myChildren[i].parent = n;
                    this.json.links.push({"source":n,"target":x-1});
                } else {
                    this.json.links.push({"source":n,"target":myNodes.indexOf(myChildren[i])});
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
    
    
    // manage links
//        for(l=0; l < myLinks.length; l++) {
//            var link = myLinks[l];
//            if (myNodes.indexOf(link.target) === -1 ){
//                console.log("omit: " + myNodes.indexOf(link.target));
//                console.log(link.target);
//                myLinks.splice(l,1);
//                
//            } else {
//                console.log("keep: " + myNodes.indexOf(link.target));
//            }
//        }
//            console.log("nodes: ");
//            console.log(this.json.nodes);
//            console.log("Links: ");
//            console.log(this.json.links);
        
        force
            .nodes(this.json.nodes)
            .links(this.json.links)
            .start();
    
        $("svg").empty();

        var link = svg.selectAll(".link")
            .data(this.json.links)
          .enter().append("line")
            .attr("class", "link");

        var node = svg.selectAll(".node")
            .data(this.json.nodes)
          .enter().append("g")
            .attr("class", "node")
            .on("click", click)
            .call(force.drag);

        node.append("image")
            .attr("xlink:href", function(d) { return site_root + "resources/images/" + d.type + ".png";} )
            .attr("x", -8)
            .attr("y", -8)
            .attr("width", 24)
            .attr("height", 24);

        node.append("text")
            .attr("dx", 16)
            .attr("dy", ".35em")
            .text(function(d) { return d.name });

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
    current_param.value = val;

    // locate and update the value of the parameter presistance object
    for(var i=0; i<graph_data.nodes.length; i++) {
        var params = graph_data.nodes[i].parameters;
        if(params.length > 0){
            for(var p=0;p<params.length; p++) {
                if(params[p].name == current_param.name) {
                    params[p].value = current_param.value;
               }
           }  
       }
   }
   
   toggleSave("disabled");
} 

function toggleSave(status) {
    if(status === "enabled") {
        $("#node_details_save").removeAttr("disabled");
        $("#node_details_save").removeClass("disabled");
    } else {
        $("#node_details_save").attr("disabled");
        $("#node_details_save").addClass("disabled");
    }
}

function click(d) {

   if(d.type === "parameter") {
      current_param = d;
      toggleSave("disbled");
              
      $(function() {
          $( "#node_slider" ).slider({
             range: "min",
             value: d.value,
             min:  1500,
             max: 3000,
             slide: function( event, ui ) {
               $( "#amount" ).val( ui.value );
               toggleSave("enabled");
             }
           });
          $( "#amount" ).val( $( "#node_slider" ).slider( "value" ) );
       }); 
       
       $("#node_type").text(d.name);
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