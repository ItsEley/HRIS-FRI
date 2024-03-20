<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance system mockup</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
      .news-banner {
    background-color: #ffcc00;
    padding: 10px;
    text-align: center;
    white-space: nowrap; /* Prevent text wrapping */
    overflow: hidden; /* Hide overflowing content */
    position: relative;
}

.news-text {
    font-weight: bold;
    display: inline-block;
    animation: marquee 20s linear infinite; /* Adjust animation duration as needed */
}

@keyframes marquee {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}

    </style>
  </head>
  <body>
    <div class="container container-fluid p-5">

    <div class="row">
      <h2>ATTENDANCE SYSTEM MOCKUP USING EMPLOYEE NUMBER</h2>
    </div>

    <div class="row px-5 w-75">
        <div class="row">
            <div class="col" id="dateLabel">Date</div>
            <div class="col" id="dateValue"></div>
        </div>
        <div class="row">
            <div class="col" id="timeLabel">Time</div>
            <div class="col" id="timeValue"></div>
        </div>
    </div>
    
    <form action="#" method="post" id="form_att_log">
      <div class="row px-5 w-75">
        <div class="col">Employee Number:</div>
        <div class="col">
          <input type="number" id="emp_num" name = "emp_num" max="999" min="0" />
        </div>
        <div class="col">
          <button type="submit" id="btn_submit_form">Enter</button>
        </div>
      </div>
    </form>

    <div class="row" id = "result"></div>


    <div class="news-banner" hidden>
    <span class="news-text">MISSION : To enrich the lives of Filipino families 
      through products and services that promote better health, create wealth and 
    foster meaningful relationships | VISION: driven by our dedication to nation
  building, our vision is to enrich and the lives of filipino families while surpassing
stakeholders return expectations </span>
</div>

</div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
   
    
        document
          .getElementById("form_att_log")
          .addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission behavior

            // Add your submission logic here
            console.log("Form submitted!");
            // Serialize the form data
            var formData = $(this).serialize();
            console.log("formdata : ",formData);

            var btn_submit = document.getElementById("btn_submit_form");
            var inp_emp_id = document.getElementById("emp_num");

            btn_submit.disabled = true;
            inp_emp_id.disabled = true;



               // Enable the button after 1 second (1000 milliseconds)
    setTimeout(() => {
      btn_submit.disabled = false;
      inp_emp_id.disabled = false;

    }, 1500);

            // Send an AJAX request

            $.ajax({
              type: "POST",
              url: "attendance_log.php", // Replace with your server-side script URL
              data: formData,
              success: function (response) {
                // Update the result element with the response
                $("#result").html(response);
                console.log("response : ",response);
              },
              error: function (xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
              },
            });
          });

  

      // Function to update date and time
function updateDateTime() {
    var date = new Date();

    // Update date
    var dateLabelElement = document.getElementById("dateLabel");
    var dateValueElement = document.getElementById("dateValue");
    dateLabelElement.textContent = "Date";
    dateValueElement.textContent = date.toDateString();

    // Update time
    var timeLabelElement = document.getElementById("timeLabel");
    var timeValueElement = document.getElementById("timeValue");
    timeLabelElement.textContent = "Time";
    timeValueElement.textContent = date.toLocaleTimeString();
}

// Call updateDateTime function initially
updateDateTime();

// Update date and time every second
setInterval(updateDateTime, 1000);



    });
    </script>
  </body>
</html>
