<?php

include_once 'controller/control_post.php';
include_once 'controller/control_prodi.php';
include_once 'controller/control_fakultas.php';
include_once 'controller/control_decode_deflate.php';
include_once 'lib/session.php';

$_post = new ControlPost();
$decode_deflate = new Decode_Deflate();

/*Session::init();
$dataSession = Session::get('LoginMadun');
if ($dataSession == false)
{
  header("Location:index.php");
}
*/
//ini komentar
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="asset/images/logo.png">
    <title>Madun - Majalah Dinding UNIKU</title>
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/dashboard.css">
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="asset/bootstrap/js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="asset/bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="asset/bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <!--  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">UNIKU</a> -->
      <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
    <!--  <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <?php
          /*
                  $login_Header= Session::get('LoginMadun');
                  if ($login_Header == false)
                  {
                    header("Location:index.php");
                  } else { */
                    ?>
                    <a class="nav-link" href="?id_session=<? Session::get('madunId')?>">Sign out</a>
                    <?
                    if (isset($_GET['id_session']))
                		{
                			Session::destroy();
                		}
                 // }

            ?>
        </li>
      </ul> -->
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Welcome <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">WELCOME</h1>
          </div>
          <div class="card-header">
            Post
          </div>
          <?php
          $getPost = $_post->getPostDosenStaf();
          if ($getPost)
          {
            while ($result = $getPost->fetch_assoc())
            {
            ?>
        <div class="card text-center">
          <!--<img class="card-img-top" src="<?php echo $result['file_url']; ?>" width="240" height="200" alt="Card image cap" /> -->
          <div class="card-body">
            <h5 class="card-title"><?php echo $result['judul']; ?></h5>
            <p class="card-text"><?php echo $result['keterangan']; ?></p>
             <form method="post">
              <button name="<?php echo $result['id_post']; ?>" id="decode" onclick="myDecode()" class="btn btn-primary">Lihat Lampiran</button>
            </form>
          </div>
          <div class="card text-muted" id="lampiran" style="display: none;">
            Lampiran disini : 
            <a href="<?php echo "uploads/".substr($result['file_url'],8, -3);?>" style="display: true">
              <p><?php echo "uploads/".substr($result['file_url'],8, -3);?>    
              </p>              
            </a>

          </div>
          <div class="card-footer text-muted">
            <?php echo $result['tanggal']; ?>
          </div>
        </div>
<?php
        ob_start();
        $id = $result['id_post']; 
        if (array_key_exists($id, $_POST)) 
        {
          $file_name = $result['file_url'];
          $decode_deflate->decodeDeflate($file_name);
          $file_name_decode = substr($file_name,0, -3);
          header('content-Disposition: attachment; filename = '.$file_name_decode.' ');
          header('content-type:application/octent-strem');
          header('content-length ='.filesize($file_name_decode).'');
          readfile($file_name_decode);
        }
        $file_uncommpresed = "uploads/".substr($result['file_url'],8, -3);
        unlink($file_uncommpresed);
        ob_clean();
?>
     <script type="text/javascript">
      function myDecode()
      {        
        var x = document.getElementById('lampiran');

        if (x.style.display === 'none') 
        {
          x.style.display = 'block';
        } else {
          x.style.display = 'none';
        }
      }
    </script> 
<?php
  }
}
?>
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
