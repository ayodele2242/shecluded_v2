<?php include("../inc/functions.php"); ?>
<label for="title" class="form-label">Topic</label>                   
<select name="cat_id" class="form-select form-control form-select-lg sm:mt-2 sm:mr-2 catId" aria-label=".form-select-lg example">
<option value=""></option>
    <?php
    
    $resp = curl_get("",$global_var->base_url."/course/get-course-topics","get",$global_var->getToken());
    foreach($resp->data->data as $topic)
    {
        
            echo "<option value=\"".$topic->id."\">".ucwords($topic->title)."</option>";
        

    }
    ?>
</select>