$(document).ready(function(){

    // display attendance Status 
    display_attendance_graph();
    function display_attendance_graph()
    {
      $.ajax({
        url: base_url + 'humanr/attendance_status',
        type: 'GET',
        success: function(data)
        {
  
          var labels = [];
          var lateCounts = [];
          var ontimeCounts = [];
  
          data = JSON.parse(data);
  
          labels = data.labels;
          lateCounts = data.lateCounts;
          ontimeCounts = data.ontimeCounts;
  
  
          var ctx6 = document.getElementById('chartStacked1');
          new Chart(ctx6, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Ontime',
                data: ontimeCounts,
                backgroundColor: '#ff9b44',
                borderWidth: 1,
                fill: true
              }, {
                label: 'Late',
                data: lateCounts,
                backgroundColor:  '#ff1919',
                borderWidth: 1,
                fill: true
              }]
            },
            options: {
              maintainAspectRatio: false,
              legend: {
                display: false,
                labels: {
                  display: false
                }
              },
              scales: {
                yAxes: [{
                  stacked: true,
                  ticks: {
                    beginAtZero: true,
                    fontSize: 11
                  }
                }],
                xAxes: [{
                  barPercentage: 0.5,
                  stacked: true,
                  ticks: {
                    fontSize: 11
                  }
                }]
              }
            }
          });
        }
      })
    }
    
    // employee count per department
    emp_per_dep();


    function emp_per_dep(){
      $.ajax({
        url: base_url + 'humanr/barchart',
        method: "GET",
        success: function(data) {
            var labels = [];
            var counts = [];
  
            data = JSON.parse(data);
  
            for (var i in data.labels) {
                labels.push(data.labels[i]);
                counts.push(data.counts[i]);
            }
  
            var ctx = $("#empPerdept");
  
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Employee Count Per Department',
                        data: counts,
                        backgroundColor: '#ff9b44'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                
                                beginAtZero: true
                            
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
      });
    }
  })