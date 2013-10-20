<script type="text/javascript">


$(document).ready(function(){
    $('h3').click(function(){
        var study_id =  $(this).attr('id');
        $('#primary_content').load('index.php/model/force_test',{study_id:study_id});
    });
    
    $('.study.button').click(function(){
        
        // get the study_id which is stored in a div next to the button that was clicked
        var study_id = $(this).next().html();
        
        // get the is_user_study flag which is stored in a div next to the study_id div
        var is_user_study = $(this).next().next().html();
        
        //console.log(is_user_study);
        $('#primary_content').load('index.php/study/viewStudyDetails', { study_id: study_id } );
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
        
        print "<h3 class='left_frame'>Study Name:</h3>";
        print "<h3 class='right_frame'>{$study[COL_NAME]}</h3> <br/>";
        //print "<h3>{$study[COL_NAME]}</h3>";
                
        //print "<span class='left_frame'>Description:</span>";
        //print "<span class='right_frame'>{$study[COL_DESCRIPTION]}</span> <br/>";
        
        print "<span class='left_frame'>Questions this Study Answers:</span>";
        print "<span class='right_frame'>{$study[COL_QUESTIONS]}</span> <br/>";
        
        //print "<span class='left_frame'>Creator:</span>";
        //print "<span class='right_frame'>{$study[COL_CREATOR]}</span> <br/>";
        
        //print "<span class='left_frame'>Date Created:</span>";
        //print "<span class='right_frame'>{$study[COL_DATE_CREATED]}</span> <br/>";
        
        print "<span class='left_frame'>User:</span> <br/>";
        print "<span class='right_frame'>{$study[COL_USERNAME]}</span> <br/> <br/>";
        
        print "<span class='left_frame'>";
        print "<div class='study button' >Select</div>";
        print "<div class='study_id' style='display: none;'>{$study[COL_STUDY_ID]}</div>";
        
        $is_user_study = 0;
        if( $_SESSION["username"] == $study[COL_USERNAME] )
        {
            $is_user_study = 1;
        }
        print "<div class='is_user_study' style='display: none;'>$is_user_study</div>";
        print "</span> <br/>";
        
        print "</div>";
        print "<br/>";
    }
   
    
?> 
