<!DOCTYPE html>
<html>
<head>
  <title>Add Fakultas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
  <?php
  include_once 'controller/control_fakultas.php';
  include_once 'view/header.php';
  ?>
<h2>Add Fakultas</h2>
<?php


		$dataSession = Session::get('LoginMadun');
    if ($dataSession == false)
    {
    	header("Location:index.php");
    }

    $fakultas = new ControlFakultas();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fakultas_add']))
    {
      $add = $fakultas->addFakultas($_POST);
    }

   ?>
<?php
  if (isset($add))
  {
    echo $add;
   }
?>
  <form method="post" action="fakultas_add.php" enctype="multipart/form-data">
     <div class="form-group row">
       <label for="inputEmail3" class="col-sm-2 col-form-label">Id Fakultas</label>
       <div class="col-sm-10">
         <input type="text" name="id_fakultas" required class="form-control" placeholder="Id Fakultas">
       </div>
     </div>
     <div class="form-group row">
       <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Fakultas</label>
       <div class="col-sm-10">
         <input type="text" name="nama_fakultas" class="form-control" placeholder="Nama Fakultas" >
       </div>
     </div>

     <div class="form-group row">
       <div class="col-sm-10">
         <button type="submit" name="fakultas_add" class="btn btn-primary">Save</button>
         <a href="fakultas.php" class="btn btn-outline-dark">Back</a>
       </div>
     </div>
   </form>
</div>
</main>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../../../assets/js/vendor/popper.min.js"></script>
<script src="../../../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
type: 'line',
data: {
labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
datasets: [{
  data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
  lineTension: 0,
  backgroundColor: 'transparent',
  borderColor: '#007bff',
  borderWidth: 4,
  pointBackgroundColor: '#007bff'
}]
},
options: {
scales: {
  yAxes: [{
    ticks: {
      beginAtZero: false
    }
  }]
},
legend: {
  display: false,
}
}
});
</script>
</body>
</html>
