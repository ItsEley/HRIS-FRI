<style>
    #sidebar-menu .chat-content .message-author {
        color: white !important;

    }

    #sidebar-menu .message-content {
        color: white !important;
        font-size: 0.8rem !important;


    }

    #sidebar-menu .chat-content a {
        padding: 0 !important;
    }

    #sidebar-menu .notification-message {
        background-color: unset !important;
    }
</style>

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
                        <div class="chat-content" id="chat-group-list">
                            <!-- <ul class="chat-group-list" id="chat-group-list"> -->
                            <!-- Group chat items will be dynamically added here -->
                            <!-- </ul> -->
                        </div>
                        <li class="menu-title">Direct Chats <a href="#" data-bs-toggle="modal" data-bs-target="#add_chat_user" class="" id="btn_new_direct_message"><i class="fa-solid fa-plus"></i></a></li>
                        <div class="chat-content" id="conversation-private">
                            <!-- <ul class="conversation-private" > -->
                            <!-- Direct chat items will be dynamically added here -->
                            <!-- </ul> -->
                        </div>

                        <div class="chat-content" id="my-conversations">

                        
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
        console.log("clickkk");


        get_new_people();

        console.log("clickkk");
        setTimeout(function() {


            // Attach click event handler after a delay of 1 second
            $("li.new-message-person").on("click", function() {
                console.log(this);

                set_conversation_window(this)


            });
        }, 1000); // 1000 milliseconds = 1 second
    });



    function set_conversation_window(element) {


        $(".chats.message-container").empty();
        console.log("emp-id : ", $(element))
        current_conversation_id = $(element).data("emp-id");

        conversation_type = $(element).data("type");
        conversation_selected = true;

        $("#dialog-no-message").attr('hidden', 'hidden');
        $("#chat-window").removeAttr('hidden');
        // console.log($('li[data-emp-id="' + current_conversation_id + '"] .message-author')[0].innerText)
        $("#talking_to").text($('li[data-emp-id="' + current_conversation_id + '"] .message-author')[0].innerText);
        $("#talking_to_pfp").attr("src", $('li[data-emp-id="' + current_conversation_id + '"] .img-pfp').attr('src'));

        fetchMessages();

        if (fetch_active == false) {
            console.log("setting fetch to active")
            setInterval(fetchMessages, 5000);
            fetch_active = true;
        }
    }


    $(document).ready(function() {
        //  console.log = function () {};
        // Add event listener to li elements with class notification-message
        $(".notification-message").on("click", function() {
            // Your click event functionality here
            // This function will be called when any element with class notification-message is clicked
            $(this).addClass("active")
            set_conversation_window(this)
        });

        
		if(current_conversation_id == undefined || current_conversation_id == null){
			$("#sidebar-menu .chat-content .notification-message")[0].click();
		}











    })
</script>