<script type="text/javascript">

function postSearch()
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
    $('#user_studies').load('index.php/search/loadUserStudies');
    
    $("#search_str").keypress(function( event ) {
            if ( event.which === 13) {
                postSearch();
            }
     });
     
    $("#submit").click(function(){
        postSearch();
    });
    
    $("#create_study").click(function(){
        $('#primary_content').load('index.php/study/viewCreateStudy');
    });
    
    //load users studies
    $("#user_studies").load("index.php/search/loadUserStudies");
}    
);  
</script>


<div id="search" class="left_frame">
    <h2>Search Studies</h2>
    <label for="search_str" >Enter a Study Question: </label> <br/>
    <input type="text" size="40" length="200" id="search_str" required="required" /> <br/> <br/>
    <div class="button" id="submit" >Submit</div> 
    <br/> <br/> <br/>
</div>

<div class="right_frame" >
    <div class="button" id="create_study" style="float: right;" >Create New Study</div> 
</div>

<div id="user_studies" class="center_frame" ></div>
</div>

<br/> <br/> <br/>
<br/> <br/> <br/>






