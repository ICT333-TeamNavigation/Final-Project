<?php
    print "<h2>$title</h2>";    

    if($study_list === false)
    {
        print "No results.";
        exit(0);
    }
              
    foreach($study_list as $study)
    {
        print "<div class='study'>";
        
        print "<h3>{$study[COL_NAME]}</h3>";
        print "<span class='left'>Description:</span>";
        print "<span class='right'>{$study[COL_DESCRIPTION]}</span> <br/>";
        
        print "<span class='left'>Questions this Study Answers:</span>";
        print "<span class='right'>{$study[COL_QUESTIONS]}</span> <br/>";
        
        print "<span class='left'>Creator:</span>";
        print "<span class='right'>{$study[COL_CREATOR]}</span> <br/>";
        
        print "<span class='left'>Date Created:</span>";
        print "<span class='right'>{$study[COL_DATE_CREATED]}</span> <br/>";
        
        print "<span class='left'>User:</span>";
        print "<span class='right'>{$study[COL_USERNAME]}</span> <br/>";
                
        print "</div>";
        print "<br/>";
    }    
    
?> 



  
    

