

<div class="timeline-panel" style = "max-height:400px;overflow:hidden">
    <div class="timeline-heading">
        <div class="row">
            <div class="col">

            
        <h3 class="timeline-title fw-600" style = "font-weight:500"><?= $title?></h3>
        <p class="text-muted text-small"><span class ="date"><?=date('F d Y',strtotime($date))?></span>
         by <span class="author"<?= $author?>></span>
        <span class="department">{Department}</span></p>
            </div>
            <div class="col text-end">

  
            </div>
        </div>


    </div>
    <div class="timeline-body" style="padding-left:20px">
        <p><?= $content?></p>
    </div>
</div>