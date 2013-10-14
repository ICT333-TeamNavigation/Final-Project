<script type="text/javascript">
$(document).ready(function(){
    $( "#searchbox" ).keypress(function( event ) {
            if ( event.which === 13) {
                $('#primary_content').load('index.php/search/');
            }
     });
});  
</script>

<!--<div class="two_col" style="height: 30px; ">-->
    <h2>Home</h2>
<!--</div>-->

<div class="searchbox">
    <label for="searchbox" style="height: 30px;">Search</label>
    <input type="text" length="50" id="searchbox" style="vertical-align: text-bottom;"></input>
</div>

<div>Create new study</div>


<div id="left_frame" class="two_col">
    <h3>Favourites</h3>
    
<ul>
    <li class="study">study 1: foo </li>
    <li class="study">study 2: bar </li>  
    <li class="study">study 3: zee </li> 
</ul>

</div>

<div id="right_frame" class="two_col">
    <h3>News Feed</h3>
</div>
