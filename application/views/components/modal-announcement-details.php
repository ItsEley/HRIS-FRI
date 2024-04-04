
<!-- modal -->
<div id="modal_announcement_detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Title : <span id = "modal_ann_title"></span> Announcement Title</h4>
            <p id = "modal_ann_date"></p>
            <p id = "modal_ann_author"></p>
            <p id = "modal_ann_departments"></p>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>

         <div class="modal-body p-4" id = "modal_ann_content">

         

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
         </div>
      </div>

   </div>
</div>
<!-- modal end -->


<script>

$(document).on("click", ".announcement-open", function(e) {
    e.preventDefault();

    var ann_id = $(this).data("ann-id"); // Use data() instead of attr() for data attributes
    console.log('Employee ID:', ann_id);

    // Use shorthand $.ajax method for cleaner code
    $.ajax({
        url: base_url + 'datatablec/get_announcement_details',
        type: 'POST',
        data: {'announcement_id': ann_id },
        dataType: 'json', // Specify JSON data type for automatic parsing
        success: function(response) {
            // console.log('Response:', response);

            if (response.status === "success") {
                var announcement_details = response.data;
                console.error('Success:', response); // Log error message

               $("#modal_ann_title").html(response.data.title);
               $("#modal_ann_content").html(response.data.content);
        

            } else {
                console.error('Error:', response); // Log error message
                // Handle error if necessary

                $("#modal_ann_title").html("Announcement");
               $("#modal_ann_content").html("An error has occured. Fetching announcement details has failed.");
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            // Handle AJAX error if necessary
        }
    });
});

</script>