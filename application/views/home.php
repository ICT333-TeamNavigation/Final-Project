<script type="text/javascript">

function doSearch()
{
    var search_str = $('#search_str').val();
    $('#search-result').load('index.php/search/searchStudies', {search_str:search_str} );
    //$('#primary_content-result').load('index.php/search/searchStudies', {search_str:search_str} );
}

$(document).ready(function(){
    $("#search_str").keypress(function( event ) {
            if ( event.which === 13) {
                doSearch();
            }
     });
     
    $("#submit").click(function(){
        doSearch();
    });
    
    //load users studies
    
    $("#user_studies").load("index.php/study/loadUserStudies");
}    
);  
</script>


<div id="left_frame" class="two_col">
    <h2>User Studies</h2>
    <div id="user_studies">
        <ul>
            <li class="study">study 1: foo </li>
            <li class="study">study 2: bar </li>  
            <li class="study">study 3: zee </li> 
        </ul>

        <br/> <br/> <br/>


    </div>
</div>


<div id="right_frame" class="two_col">
    <h2>Create New Study</h2>
    <button id="new_study">Create New Study</button>     
</div>


<div id="search">
    <h2>Search Studies</h2>
    <label for="search_str" >Enter a Study Question: </label>
    <input type="text" length="200" id="search_str" required="required" />
    <button id="submit">Submit</button> 
    
    <br/> <br/> <br/>
    <h2>Search Results</h2>
    <div id="search-result">
    
    </div>
</div>

