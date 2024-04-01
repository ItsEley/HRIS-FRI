<!-- <div class="timeline-panel" style = "max-height:400px;overflow-y:scroll"> -->
<div class="timeline-heading">

    <a class="announcement-open" href="#" data-bs-toggle="modal" data-bs-target="#modal_announcement_detail"
    style = "color:black" data-ann-id = "<?= $id?>">


        <h4 class="timeline-title fw-600 my-hover" style="font-weight:500"><?= $title ?></h4>
     
    </a>

    <p class="text-muted text-small"><span class="date"><?= date('F j Y', strtotime($date)) ?></span>
            by <span class="author" <?= $author ?>></span>
            <span class="department">{Department}</span>
        </p>


</div>

<!-- </div> -->