<script type="text/javascript">
   
$(document).ready(function(){
    $('#test').click(function(){
        $('#primary_content').load('index.php/model/force_test');
    });
    
});
</script>



<div class="left_frame">
<?php
   
    if($study_details === false)
    {
        print "Error. Something went wrong fetching the study details.";
        exit(0);
    }
      
    print "<h2>Study Details</h2>";
    
    print "<h3>Name:</h3> "; 
    print $study_details[COL_NAME];
    
    print "<h3>Description:</h3>";
    print $study_details[COL_DESCRIPTION];
    
    print "<h3>Questions:</h3>";
    print $study_details[COL_QUESTIONS];
    
    print "<h3>Creator:</h3>";
    print $study_details[COL_CREATOR];
    
    print "<h3>Scenarios:</h3>";
    if($study_scenarios === false)
    {
        print "No scenarios.";
    }
    else 
    {
        foreach($study_scenarios as $scenario)
        {
            print $scenario[COL_NAME] . ": ";
            print $scenario[COL_DESCRIPTION];
        }    
    }

?>
<div>
   
<br/> <br/> <br/>
<div class="left_frame">
<div class="button" >Edit Study</div> <br/>
</div>
<div class="button" >Delete Study</div> <br/>
<div class="button" id="test" >Show Model Graph</div> <br/>
</div>
   
