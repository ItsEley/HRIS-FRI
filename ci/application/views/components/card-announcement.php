

<div class="timeline-panel">
    <div class="timeline-heading">
        <div class="row">
            <div class="col">

            
        <h3 class="timeline-title"><?= $title?></h3>
        <p class="text-muted text-small"><span class ="date"><?=date('F d Y',strtotime($date))?></span>
         by <span class="author"<?= $author?>></span>
        <span class="department">{Department}</span></p>
            </div>
            <div class="col text-end">

            <div class="btn-group">
									<button type="button" class="bg-transparent border border-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class = "fa fa-ellipsis-h"></span></button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#">Edit</a>
										<a class="dropdown-item" href="#">Delete</a>
										<!-- <div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Separated link</a> -->
									</div>
								</div>
            </div>
        </div>


    </div>
    <div class="timeline-body">
        <p><?= $content?></p>
    </div>
</div>