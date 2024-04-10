

<?php

if(!isset($size)){
   $size = "32px";
}
?>


<div class="card dash-widget" style = "min-height:130px;min-width:180px;">
    <div class="card-body">
       <span class="dash-widget-icon">
      <?php
         if($icon_type == "1"){
            echo "<i class='$icon' aria-hidden='true'></i>";
         }else if($icon_type == "2"){
            echo "<img src='" . base_url('assets/img/icons/' . $img_name) . "' 
            alt='$img_name' style='filter: invert(81%) sepia(35%) saturate(4291%) hue-rotate(327deg) brightness(103%)
             contrast(101%); height:$size'>";

         }
      
      ?>

         
       
      </span>
       <div class="dash-widget-info" >
          <h3 class="value" id="userCount"><?= $count?></h3>
          <span class="metric-title text-ellipsis" style = "white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $label?></span>
       </div>
    </div>
</div>
