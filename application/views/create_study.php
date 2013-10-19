<script type="text/javascript">

function postCreateStudy()
{
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
    
    var post_obj = { name:        name, 
                     description: description,
                     questions:   questions,
                     creator:     creator   }; 
         
     
    $('#primary_content').load('index.php/study/createStudy', post_obj);
}    
    
    
    
$(document).ready(function(){
    $('#create_study_submit').click(function(){
        
        var success_msg = new MessageService("success", "Please wait while your study is created.");
        success_msg.showMessage();    
        
        postCreateStudy();
    });
    
});
</script>




<h2>Create New Study</h2>

<p> To create a new Study, please fill out the form below and click submit. </p>

<label class="left_frame" for="name" >Study Name: </label>
<input class="right_frame" type="text" id="name" required="required" style="width: 347px; height: 20px;" /> 
<br/> <br/> <br/>

<label class="left_frame" for="description" >Description: </label>
<textarea class="right_frame" id="description" required="required" style="width: 345px; height: 50px;"/> 
<br/> <br/> <br/>

<label class="left_frame" for="questions" >Questions: </label>
<textarea class="right_frame" id="questions" required="required" style="width: 345px; height: 50px;"/> 
<br/> <br/> <br/>

<label class="left_frame" for="creator" >Creator: </label>
<input class="right_frame" type="text" id="creator" required="required" style="width: 347px; height: 20px;" /> 
<br/> <br/> <br/>


<div class="left_frame">
<div class="button" id="create_study_submit" >Submit</div>
<div>
<br/> <br/> <br/>
