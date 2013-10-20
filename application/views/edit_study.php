<script type="text/javascript">

function postEditStudy()
{
    var study_id = $('#study_id').html();
        
    var name = $('#name').val();
    name = name.trim();
    if( name.length === 0 )
    {
        var msg = new MessageService("error", "Please Enter a Study Name. Try again.");
        msg.showMessage();
        return;
    }
    
    var description = $('#description').val();
    description = description.trim();
    if( description.length === 0 )
    {
        var msg = new MessageService("error", "Please Enter a Study Description. Try again.");
        msg.showMessage();
        return;
    }
    
    var questions = $('#questions').val();
    questions = questions.trim();
    if( questions.length === 0 )
    {
        var msg = new MessageService("error", "Please Enter some Study Questions. Try again.");
        msg.showMessage();
        return;
    }  
    
    var creator = $('#creator').val();
    creator = creator.trim();
    if( creator.length === 0 )
    {
        var msg = new MessageService("error", "Please Enter a Study Creator. Try again.");
        msg.showMessage();
        return;
    }  
    
    var post_obj = { study_id:    study_id,
                     name:        name, 
                     description: description,
                     questions:   questions,
                     creator:     creator   }; 
         
     
    $('#primary_content').load('index.php/study/saveStudy', post_obj);
}    
    
    
    
$(document).ready(function(){
    $('#edit_study_submit').click(function(){
        
        var success_msg = new MessageService("success", "Please wait while the Study Details are updated.");
        success_msg.showMessage();    
        
        postEditStudy();
    });
    
});
</script>




<h2>Edit Study Details</h2>

<p> To edit the Study Details, please fill out the form below and click submit. </p>

<div id='study_id' style='display: none;'><?php print $study_id; ?></div>

<h3><label class="left_frame" for="name" >Study Name: </label></h3>
<input class="right_frame" type="text" id="name" value="<?php if(isset($name)) print $name; ?>" 
       required="required" style="width: 347px; height: 20px;" /> 
<br/> <br/> <br/>

<h3><label class="left_frame" for="description" >Description: </label></h3>
<textarea class="right_frame" id="description" required="required"
          style="width: 345px; height: 50px;"><?php if(isset($description)) print $description; ?></textarea> 
<br/> <br/> <br/>

<h3><label class="left_frame" for="questions" >Questions: </label></h3>
<textarea class="right_frame" id="questions" required="required" 
          style="width: 345px; height: 50px;"><?php if(isset($questions)) print $questions; ?></textarea> 
<br/> <br/> <br/>

<h3><label class="left_frame" for="creator" >Creator: </label></h3>
<input class="right_frame" type="text" id="creator" value="<?php if(isset($creator)) print $creator; ?>"
       required="required" style="width: 347px; height: 20px;" /> 
<br/> <br/> <br/>


<div class="left_frame">
<div class="button" id="edit_study_submit" >Submit</div>
<div>
<br/> <br/> <br/>
