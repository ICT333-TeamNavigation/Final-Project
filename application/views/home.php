<script type="text/javascript">
$(document).ready(function(){
    $( "#searchbox" ).keypress(function( event ) {
            if ( event.which === 13) {
                $('#primary_content').load('index.php/search/');
            }
     });
});  
</script>

<div class="two_col" style="height: 30px; "><h2>Home</h2></div>
<div class="two_col" style="height: 30px; ">
    <label for="searchbox" style="height: 30px;">Search</label>
    <input type="text" length="50" id="searchbox" style="vertical-align: text-bottom;"></input>
</div>


<div id="left_frame" class="two_col">
    <h3>Favourites</h3>
</div>

<div id="right_frame" class="two_col">
    <h3>News Feed</h3>
</div>
