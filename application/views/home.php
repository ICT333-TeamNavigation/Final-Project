<script type="text/javascript">

function doSearch()
{
    var search_str = $('#search_str').val();
    search_str = search_str.trim();
    if( search_str.length === 0 )
    {
        var msg = new MessageService("error", "Please Enter a Study Question. Try again.");
        msg.showMessage();
        return;
    }    
    $('#primary_content').load('index.php/search/searchStudies', {search_str:search_str} );
}

$(document).ready(function(){
    
    // load user studies from search controller
    $('#user-studies').load('index.php/search/loadUserStudies');
    
    $("#search_str").keypress(function( event ) {
            if ( event.which === 13) {
                doSearch();
            }
     });
     
    $("#submit").click(function(){
        doSearch();
    });
    
    $("#create_study").click(function(){
        $('#primary_content').load('index.php/study/viewCreateStudy');
    });
}    
);  
</script>


<div id="search" class="two_col">
    <h2>Search Studies</h2>
    <label for="search_str" >Enter a Study Question: </label> <br/>
    <input type="text" size="40" length="200" id="search_str" required="required" /> <br/> <br/>
    <div class="button" id="submit" >Submit</div> 
    <br/> <br/> <br/>
</div>

<div id="right_frame" >
    
    <div class="button" id="create_study" >Create New Study</div> 
</div>


<div id="user-studies" class="two_col">
</div>
<br/> <br/> <br/>
<br/> <br/> <br/>






