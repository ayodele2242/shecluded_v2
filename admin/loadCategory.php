<?php
include("../inc/functions.php");
?>

<div class="form-group">
    <label for="vertical-form-2" class="form-label">Course Category</label>
    <select name="cat_id" id="cat_id" class="form-control sm:mr-2 catId" aria-label=".form-select-lg example">
    <option value=""></option>
        <?php
            
            $resp = curl_get("",$global_var->base_url."/course/get-course-categories","get",$global_var->getToken());

            foreach($resp->data->data as $course)
            {
                
            echo "<option value=\"".$course->id."\">".ucwords($course->name)."</option>";
                

            }
            ?>
    </select>
</div>

<div class="form-group">
    <label for="title" class="form-label">Topic</label>

    <select name="topic_id" id="topic_id" class="form-control sm:mr-2 topicId" aria-label=".form-select-lg example">
    <option value=""></option>
    <?php
        
        $resp = curl_get("",$global_var->base_url."/course/get-course-topics","get",$global_var->getToken());
        foreach($resp->data->data as $topic)
        {
            
                echo "<option value=\"".$topic->id."\">".ucwords($topic->title)."</option>";
            

        }
        ?>
    </select>
</div>