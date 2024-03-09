<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
    <div class="profile-widget">
        <div class="profile-img">
            <a href="<?=base_url('user_profile')?>" class="avatar profile_view"><img src="<?= base_url('assets/img/profiles/avatar-02.jpg'); ?> " alt="User Image"></a>
        </div>
        <div class="dropdown profile-action">
            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee"
                data-emp-id = "<?= $emp_id;?>"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
                
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_employee"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
            </div>
        </div>
        <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html"><?= $emp_name;?></a></h4>
        <div class="small text-muted"><?= $emp_role;?></div>
    </div>
</div>