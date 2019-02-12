<!DOCTYPE html>
<html>
<head>
	<title>Fakultas</title>
  <meta charset="utf-8">
	<link rel="icon" href="asset/images/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
  <?php
  		include_once 'controller/control_fakultas.php';
      include_once 'view/header.php';

  		$fakultas = new ControlFakultas();

  		$dataSession = Session::get('LoginMadun');
      if ($dataSession == false)
      {
      	header("Location:index.php");
      }

  ?>

  <h2>List Fakultas</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm"  id="table_id">
      <thead>
        <tr>
          <th>ID Fakultas</th>
          <th>Nama Fakultas</th>
          <th>Control Content</th>
        </tr>
      </thead>
      <tbody>
        <?php
					$getFakultas = $fakultas->getAllFakultas();
						if ($getFakultas)
						{
							while ($result = $getFakultas->fetch_assoc())
						{

				?>
        <tr>
          <td><?php echo $result['id_fakultas'] ; ?></td>
          <td><?php echo $result['nama_fakultas']; ?></td>
          <td><a href="fakultas_delete.php?id_fakultas=<?php echo $result['id_fakultas'] ?>" onclick="return konfirmasi()" class="ico del">Delete</a>
										<a href="fakultas_edit.php?id_fakultas=<?php echo $result['id_fakultas'] ?>" class="ico edit">Edit</a>
              </td>
        </tr>
        <?php
          }
        }
       ?>
      </tbody>
    </table>
  </div>
</main>
</div>
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
