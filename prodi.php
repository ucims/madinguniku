<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="asset/images/logo.png">
    <title>Prodi</title>
  </head>

  <body>
    <?php

      include_once 'controller/control_post.php';
      include_once 'controller/control_prodi.php';
      include_once 'controller/control_fakultas.php';
      include_once 'lib/session.php';
      include_once 'view/header.php';

      $prodi = new ControlProdi();

    		$dataSession = Session::get('LoginMadun');
        if ($dataSession == false)
        {
        	header("Location:index.php");
        }

    ?>

          <h2>List Prodi</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm"  id="table_id">
              <thead>
                <tr>
                  <th>ID Prodi</th>
                  <th>Nama Prodi</th>
                  <th>Fakultas</th>
                  <th>Control Content</th>
                </tr>
              </thead>
              <tbody>
              <?php
							$getProdi = $prodi->getAllProdi();
							if ($getProdi)
							{
								while ($result = $getProdi->fetch_assoc())
								{
							?>
                <tr>
                  <td><?php echo $result['id_prodi'] ; ?></td>
                  <td><?php echo $result['nama_prodi']; ?></td>
  								<?php
  								$id_fakultas = $result['id_fakultas'];
  								$fakultas = new ControlFakultas();
  								$getFakultas = $fakultas->getDataFakultas($id_fakultas);
  								if ($getFakultas)
  								{
  									while ($result1 = $getFakultas->fetch_assoc())
  									{
  										?>
  												<td><?php echo $result1['id_fakultas'] .' - '.$result1['nama_fakultas'];?></td>

  										<?php
  									}
  								}
  								?>
                  <td><a href="prodi_delete.php?id_prodi=<?php echo $result['id_prodi'] ; ?>" onclick="return konfirmasi()"  class="ico del">Delete</a>
                  <a href="prodi_edit.php?id_prodi=<?php echo $result['id_prodi'] ; ?>" class="ico edit">Edit</a></td>
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
