<script type="text/javascript">
   
function postCreateUserStudy()
{
    var name = $('#study_name').html();
    name = name.trim();
      
    var description = $('#study_description').html();
    description = description.trim();
        
    var questions = $('#study_questions').html();
    questions = questions.trim();
        
    var creator = $('#study_creator').html();
    creator = creator.trim();
    
    var post_obj = { name:        name, 
                     description: description,
                     questions:   questions,
                     creator:     creator   }; 
         
    $('#primary_content').load('index.php/study/viewCreateStudy', post_obj);     
}

function postDeleteUserStudy()
{
    var study_id = $('#study_id').html();
            
    $('#result_ajax').load('index.php/study/removeStudy', { study_id: study_id },
        function(data, status)
        {               
            if(ajax_result.trim() == "success")
            {
                var msg = new MessageService('success', "Study deleted successfully.");
                msg.showMessage();
                
                $('#edit_user_study').hide();
                $('#delete_user_study').hide();
                $('#load_model_graph').hide();
                $('#delete_result').html("This study has been deleted.");
                //$('#primary_content').load('index.php/home/' );
            } 
            else 
            {
                var msg = new MessageService('error', ajax_result );
                msg.showMessage();
                
                $('#delete_result').html(ajax_result); 
            }
        }
    );    
  
}

function postEditUserStudy()
{
    var study_id = $('#study_id').html();
        
    var name = $('#study_name').html();
    name = name.trim();
      
    var description = $('#study_description').html();
    description = description.trim();
        
    var questions = $('#study_questions').html();
    questions = questions.trim();
        
    var creator = $('#study_creator').html();
    creator = creator.trim();
    
    var post_obj = { study_id:    study_id,
                     name:        name, 
                     description: description,
                     questions:   questions,
                     creator:     creator   }; 
         
    $('#primary_content').load('index.php/study/viewEditStudy', post_obj);  
}
   
   
$(document).ready(function(){

    $('#load_model_graph').click(function(){
        var study_id = $('#study_id').html();
        $('#primary_content').load('index.php/model/force_test',{study_id: study_id});
    });
    
    $('#create_user_study').click(function(){
        postCreateUserStudy();
    });
    
    $('#delete_user_study').click(function(){
        
        var study_name = $("#study_name").html();
                
        var delete_confirmed = confirm("Delete study, " + study_name + "?");
        if(!delete_confirmed)
        {
            return;
        }    
        
        postDeleteUserStudy();
    });
    
    $('#edit_user_study').click(function(){
        postEditUserStudy();
    });
    
    
    $('#testonly').click(function(){
        $.post('index.php/scenario/loadScenario', {scenario_id:1}, function(data){
            console.log(data);
            testdata = data;
        });
    });
    
});
</script>

<h2 id="testonly">Study Details</h2>
<div id="delete_result" class='center_frame' ></div>
<br/> 

<?php
   
    if($study_details === false)
    {
        print "Error. Something went wrong fetching the study details.";
        exit(0);
    }
    
    print "<div id='study_id' style='display: none;'>{$study_details[COL_STUDY_ID]}</div>";
    
    print "<h3 class='left_frame'>Study Name:</h3>"; 
    print "<span id='study_name' class='right_frame'>{$study_details[COL_NAME]}</span>";
    print "<br/> <br/> <br/>";
    
    print "<h3 class='left_frame'>Description:</h3>";
    print "<span id='study_description' class='right_frame'>{$study_details[COL_DESCRIPTION]}</span>";
    print "<br/> <br/> <br/>";
    
    print "<h3 class='left_frame'>Questions:</h3>";
    print "<span id='study_questions' class='right_frame'>{$study_details[COL_QUESTIONS]}</span>";
    print "<br/> <br/> <br/>";
    
    print "<h3 class='left_frame'>Creator:</h3>";
    print "<span id='study_creator' class='right_frame'>{$study_details[COL_CREATOR]}</span>";
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
        
        print "<div id='create_user_study' class='button center_frame'  style='float: left;' >Create User Study</div>"; 
        exit(0); // the buttons below will not be displayed
    }    
     
?>


<div class="center_frame">
    <div id='edit_user_study' class="button" style="float: left;" >Edit Study</div> 
    <div id='delete_user_study' class="button" style="float: left;" >Delete Study</div> 
    <div id='load_model_graph' class="button"  style="float: left;" >Show Model</div>
</div>   

<br/> <br/> <br/> <br/>
<div id="message_service"></div>
<div id="result_ajax"></div>
