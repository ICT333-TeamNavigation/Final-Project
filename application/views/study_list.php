<script type="text/javascript">

$(document).ready(function(){
    $('h3').click(function(){
        var study_id =  $(this).attr('id');
        $('#primary_content').load('index.php/model/force_test',{study_id:study_id});
    });
    
});


</script>

<?php
    print "<h2>Study List</h2>";    

    if($study_list === false)
    {
        print "No results.";
        exit(0);
    }
        
    foreach($study_list as $study)
    {
        print "<div class='study'>";
        
        print "<h3 id='{$study[COL_STUDY_ID]}'>{$study[COL_NAME]}</h3>";
                
        print "<span class='left_frame'>Description:</span>";
        print "<span class='right_frame'>{$study[COL_DESCRIPTION]}</span> <br/>";
        
        print "<span class='left_frame'>Questions this Study Answers:</span>";
        print "<span class='right_frame'>{$study[COL_QUESTIONS]}</span> <br/>";
        
        print "<span class='left_frame'>Creator:</span>";
        print "<span class='right_frame'>{$study[COL_CREATOR]}</span> <br/>";
        
        print "<span class='left_frame'>Date Created:</span>";
        print "<span class='right_frame'>{$study[COL_DATE_CREATED]}</span> <br/>";
        
        print "<span class='left_frame'>User:</span> <br/>";
        print "<span class='right_frame'>{$study[COL_USERNAME]}</span> <br/> <br/>";
        
        print "<span class='left_frame'>";
        print "<div class='button' value='{$study[COL_STUDY_ID]}' >Select</div>";    
        print "</span> <br/>";
        
        print "</div>";
        print "<br/>";
    }
   
    
?> 
