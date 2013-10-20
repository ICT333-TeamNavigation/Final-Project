<script type="text/javascript">
   
$(document).ready(function(){
    $('#test').click(function(){
        $('#primary_content').load('index.php/model/force_test');
    });
    
});
</script>

<h2>Study Details</h2>

<?php
   
    if($study_details === false)
    {
        print "Error. Something went wrong fetching the study details.";
        exit(0);
    }
    
    print "<h3 class='left_frame'>Study Name:</h3>"; 
    print "<span class='right_frame'>{$study_details[COL_NAME]}</span>";
    print "<br/> <br/> <br/>";
    
    print "<h3 class='left_frame'>Description:</h3>";
    print "<span class='right_frame'>{$study_details[COL_DESCRIPTION]}</span>";
    print "<br/> <br/> <br/>";
    
    print "<h3 class='left_frame'>Questions:</h3>";
    print "<span class='right_frame'>{$study_details[COL_QUESTIONS]}</span>";
    print "<br/> <br/> <br/>";
    
    print "<h3 class='left_frame'>Creator:</h3>";
    print "<span class='right_frame'>{$study_details[COL_CREATOR]}</span>";
    print "<br/> <br/> <br/>";
    
    print "<h3 class='left_frame'>User:</h3>";
    print "<span class='right_frame'>{$study_details[COL_USERNAME]}</span>";
    print "<br/> <br/> <br/>";
    
    print "<h3 class='left_frame'>Scenarios:</h3>";
    print "<span class='right_frame'>";
    if($study_scenarios === false)
    {
        print "<span class='left_frame'>No scenarios.</span>";
    }
    else 
    {
        foreach($study_scenarios as $scenario)
        {
            print "<span class='left_frame'>".$scenario[COL_NAME] . ":</span>";
            print "<span class='right_frame'>".$scenario[COL_DESCRIPTION]."</span>";
        }
        
    }
    print "</span>";
    print "<br/> <br/> <br/>";
    
    // if this study is not a user study
    if( $_SESSION["username"] != $study_details[COL_USERNAME] )
    {
        print "<span class='left_frame'>";
        print "<div class='button' style='float: left;' >Create User Study</div>"; 
        print "</span>";
        exit(0); // the buttons below will not be displayed
    }    
     
?>

<div class="center_frame">
<div class="button" style="float: left;" >Edit Study</div> 

<div class="button" style="float: left;" >Delete Study</div> 

<div class="button" id="test" style="float: left;" >Show Model</div> 
</div>   
<br/> <br/> <br/> <br/>