<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php

//print $study_list[0]["description"];

foreach($study_list as $key => $value) {
    print "<p>".$value['description']."</p>";
}

?>