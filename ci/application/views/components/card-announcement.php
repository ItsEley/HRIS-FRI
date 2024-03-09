

<div class="timeline-panel">
    <div class="timeline-heading">
        <h3 class="timeline-title"><?= $title?></h3>
        <p class="text-muted text-small"><span class ="date"><?=date('F d Y',strtotime($date))?></span>
         by <span class="author"<?= $author?>></span>
        <span class="department"><?= $department?></span></p>

    </div>
    <div class="timeline-body">
        <p><?= $content?></p>
    </div>
</div>