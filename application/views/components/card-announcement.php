

<div class="timeline-panel" style = "max-height:400px;overflow-y:scroll">
    <div class="timeline-heading">
    <h3 class="timeline-title fw-600" style = "font-weight:500"><?= $title?></h3>
        <p class="text-muted text-small"><span class ="date"><?=date('F j Y', strtotime($date))?></span>
         by <span class="author"<?= $author?>></span>
        <span class="department">{Department}</span></p>


    </div>
    <div class="timeline-body" >
        <p><?= $content?></p>
    </div>
</div>