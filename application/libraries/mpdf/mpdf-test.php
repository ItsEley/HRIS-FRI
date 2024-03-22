<?php
require_once __DIR__ . '/vendor/autoload.php';

// $mpdf = new \Mpdf\Mpdf();
// $mpdf = new \Mpdf\Mpdf( ['mode' => 'utf-8']);

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    // 'format' => [190, 236],
    'orientation' => 'L'
]);



$html_object = '
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;
}
th {
  background-color: #f2f2f2;
}
.red {
  color: red;
}
.card{
    width: auto;
    margin: 0 auto;
    margin-top: 50px;
    border: 1px solid black;
    padding: 20px;
}
</style>




<div class="card" style="align-items: center;">
    <div class="card-body">
        <h2 class="red" style="text-align: center;">Weekly Attendance Report</h2>

        <table>
            <div class="" style="align-items: center;text-align: center;">
                <span>
                    <i class="far fa-circle" style="margin: 10px;color: blue;"> </i>DAY OFF
                    <i class="fas fa-check"  style="margin: 10px; color: #08A04B;"></i>PRESENT
                    <i class="fas fa-times" style="margin: 10px; color: red;"></i>ABSENT
                </span>
            </div>
       
            <tr>
                <th>NAME</th>
                <th>SUN</th>
                <th>MON</th>
                <th>TUE</th>
                <th>WED</th>
                <th>THU</th>
                <th>FRI</th>
                <th>SAT</th>
            </tr>
            <tr>
                <td class="">MA. THRISHA G. PANALIGAN</td>
                <td><i class="far fa-circle" style="color: blue;">P</i></td> 
                <td><i class="fas fa-check" style="color: #08A04B;">P</i></td>
                <td><i class="fas fa-check" style="color: #08A04B;">A</i></td>
                <td><i class="fas fa-check" style="color: #08A04B;">HD</i></td>
                <td><i class="fas fa-check"style="color: #08A04B;">P</i></td>
                <td><i class="fas fa-check"style="color: #08A04B;">P</i></td>
                <td><i class="fas fa-times"style="color: red;">E</i></td>
            </tr>
         
        </table>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
 </script>';

$mpdf->WriteHTML($html_object);

// Specify the filename and path to save the PDF file locally
$filename = 'hello_worlssd.pdf';

// Save the PDF file to the specified location
$mpdf->Output("C:\\xampp\htdocs\HRIS-FRI\application\libraries\mpdf\output\\".$filename);

echo "PDF file saved as $filename";
