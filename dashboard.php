<?php

  include_once 'controller/control_post.php';
  include_once 'controller/control_prodi.php';
  include_once 'controller/control_fakultas.php';
  include_once 'lib/session.php';

  $_post = new ControlPost();

  Session::init();
  $dataSession = Session::get('LoginMadun');
  $dataLevel = Session::get('madunLevel');
  $dataProdi = Session::get('madunProdi');
 
  if ($dataSession == false)
  {
    header("Location:index.php");
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="asset/images/logo.png">
    <title>Majalah Dinding FKOM UNIKU</title>
  </head>

  <body>
  <?php include_once 'view/header.php';?>

          <h2>List Post</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm"  id="table_id">
              <thead>
                <tr>
                  <th>ID Post</th>
                  <th>Judul</th>
                  <th>Tanggal</th>
                  <th>Fakultas</th>
                  <th>Program Studi</th>
                  <th>Level</th>
                  <th>File</th>
                  <th>Keterangan</th>
                  <th>Control Content</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($dataLevel == 'Tata Usaha') {
                  $getPost = $_post->getPostByProdi($dataProdi);
                } elseif ($dataLevel == 'Administrator') {
                  $getPost = $_post->getAllPost();
                } else {
                  header('Location:index.php');
                }

                if ($getPost)
                {
                  while ($result = $getPost->fetch_assoc())
                  {
                  ?>
                <tr>
                  <td><a href="post_detail.php?id_post=<?php echo $result['id_post']; ?>"><?php echo $result['id_post']; ?></a></td>
                  <td><?php echo substr($result['judul'],0,10); ?></td>
                  <td><?php echo $result['tanggal']; ?></td>
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
                      }?>
                      <?php
        								$id_prodi = $result['id_prodi'];
        								$prodi = new ControlProdi();
        								$getProdi = $prodi->getDataProdi($id_prodi);
        								if ($getProdi)
        								{
        									while ($result1 = $getProdi->fetch_assoc())
        									{
        										?>
        												<td><?php echo $result1['id_prodi'] .' - '.$result1['nama_prodi'];?></td>

        										<?php
        									}
        								}
        								?>
                  <td><?php echo $result['level']; ?></td>
                  <td><?php echo $result['file_url']; ?></td>
                  <td><?php echo substr($result['keterangan'],0,10); ?></td>
                  <td><a href="post_delete.php?id_post=<?php echo $result['id_post']; ?>" onclick="return konfirmasi()"  class="ico del">Delete</a>
                  <a href="post_edit.php?id_post=<?php echo $result['id_post']; ?>" class="ico edit">Edit</a></td>
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
