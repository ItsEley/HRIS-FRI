<div class="sidebar" id="sidebar" style="overflow-y:scroll;scrollbar-width:none;">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 432px;">
        <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 432px;">
            <div id="sidebar-menu" class="sidebar-menu">

                <nav class="greedy">
                    <ul class="link-item">
                        <?php
                        if (strtolower($_SESSION['role']) == "head" && strtolower($_SESSION['acro']) == 'hr') {
                            $redirect_home = base_url('hr/dashboard');
                        } else {
                            $redirect_home = base_url('employee/dashboard');
                        }
                        ?>
                        <li>
                            <a href="<?= $redirect_home ?>"><i class="la la-home"></i> <span>Back to Home</span></a>
                        </li>
                        <li class="menu-title"><span>Chat Groups</span> <a href="#" data-bs-toggle="modal" data-bs-target="#add_group" class="subdrop"><i class="fa-solid fa-plus"></i></a></li>
                        <div class="chat-content">
                            <ul class="chat-group-list" id="chat-group-list">
                                <!-- Group chat items will be dynamically added here -->
                            </ul>
                        </div>
                        <li class="menu-title">Direct Chats <a href="#" data-bs-toggle="modal" data-bs-target="#add_chat_user" class="" id="btn_new_direct_message"><i class="fa-solid fa-plus"></i></a></li>
                        <div class="direct-chat-content">
                            <ul class="conversation-private" id="conversation-private">
                                <!-- Direct chat items will be dynamically added here -->
                            </ul>
                        </div>
                    </ul>
                </nav>

            </div>
        </div>

    </div>
</div>

<script>
    function get_new_people() {
        $.ajax({
            url: '<?= base_url('datatable_fetchers/get_people_new_message') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data)

            },
            error: function(xhr, status, error) {
                console.error('Error fetching messages:', error);
            }
        });
    }


    $("#btn_new_direct_message").on('click', function() {
        get_new_people();
    })
</script>