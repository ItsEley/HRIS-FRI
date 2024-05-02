<!-- used in chat.php -->


<!-- Add Chat User Modal -->
<div id="add_chat_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Direct Chat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group m-b-30">
                    <input placeholder="Search to start a chat" class="form-control search-input" type="text">
                    <button class="btn btn-primary">Search</button>
                </div>
                <div>
                    <h5>Recent Conversations</h5>
                    <ul class="chat-user-list" id = "chat-user-list">
                        
                        
                        
                    </ul>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add Chat User Modal -->

<script>

function getNewPeople() {
    console.log("Fetching new people...");

    $.ajax({
        url: base_url + "datatable_fetchers/get_people_new_message",
        type: "GET",
        dataType: "json", // Specify JSON data type
        success: function(response) {
            if (response.success) {
                // console.log(response);

                // Clear previous users
                $("#chat-user-list").empty();

                if (response.people && response.people.length > 0) {
                    // Iterate through the retrieved people
                    response.people.forEach(function(person) {
                        console.log(person);

                        // Construct HTML for each person
                        var html =  "<li>" +
                                    "<a href='#'>" +
                                    "<div class='chat-block d-flex'>"+
                                            "<span class='avatar align-self-center flex-shrink-0'> " +
                                                    // "<img src='" + + "' alt='User Image'>"+
                                                "</span>"+
                                                "<div class='media-body align-self-center text-nowrap flex-grow-1'>"+
                                                    "<div class='user-name'>" + person.emp_name + "</div>"+
                                                    "<span class='designation'>Team Leader</span>"+
                                                "</div>"+
                                                "<div class='text-nowrap align-self-center'>"+
                                                    "<div class='online-date'>1 day ago</div>"+
                                                "</div>"+
                                            "</div>"+
                                        "</a>"+
                                    "</li>";

                        // Append the HTML to the chat user list
                        $("#chat-user-list").append(html);
                    });

                } else {
                    // Display a message if no new people are found
                    $("#chat-user-list").append("<li>No new people found</li>");
                }
            } else {
                console.error("Error fetching new people:", response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
        },
    });
}


</script>
