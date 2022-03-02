<?php
include("../inc/functions.php");
?>

 <label for="vertical-form-2" class="form-label">Course</label>
<select name="cat_id" id="cat_id" class="form-control catId">
    <option value=""></option>
    <?php
        
        $resp = curl_get("",$global_var->base_url."/course/get-all-courses","get",$global_var->getToken());

        foreach($resp->data->courses as $course)
        {
            
        echo "<option value=\"".$course->id."\">".ucwords($course->title)."</option>";
            

        }
        ?>
</select>