$("#edit_row_btn").click(function () {
    //open modal
    $("#dragable_modal").modal({
      backdrop: false,
      show: true,
    });
    // reset modal if it isn't visible
    if (!$(".modal.in").length) {
      $(".modal-dialog").css({
        top: 20,
        left: 100,
      });
    }
  
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });
  });

  // No of Daily users
var xValues = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
var yValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 100, max:1000}}],
    }
  }
});



// No of Products given daily 
var xValues = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
var yValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("myChart2", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 100, max:1000}}],
    }
  }
});


// No of daily visitors 
var xValues = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
var yValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("myChart3", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 100, max:1000}}],
    }
  }
});


  