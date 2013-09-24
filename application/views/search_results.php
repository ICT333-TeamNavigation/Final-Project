<script type="text/javascript">
$(document).ready(function(){
    $(".study").click(function(){
        $('#primary_content').load('index.php/study/');
    });
    
    $(".model").click(function(){
        $('#primary_content').load('index.php/model/');
    });    
    
});
</script>

<h2>Search Results</h2>

<h3>Studies</h3>
<ul>
    <li class="study">study 1: foo </li>
    <li class="study">study 2: bar </li>  
    <li class="study">study 3: zee </li> 
</ul>
<h3>Models</h3>
<ul>
    <li class="model">Model 1: foo </li>
    <li class="model">Model 2: bar </li>  
</ul>