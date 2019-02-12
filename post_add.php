<!DOCTYPE html >
<html>
<head>
  <title>Add Post</title>
</head>
<body>
  <?php

  include_once 'controller/control_prodi.php';
  include_once 'controller/control_post.php';
  include_once 'controller/control_fakultas.php';
  include_once 'view/header.php';
  $dataSession = Session::get('LoginMadun');
  $dataProdi = Session::get('madunProdi');
  if ($dataSession == false)
  {
  	header("Location:index.php");
  }

  $madunpost = new ControlPost();

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_add']))
  {
    $add = $madunpost->addPost($_POST);
  }

   ?>
   <h2>Add Post</h2>
   <?php
     if (isset($add)) 
     {
        echo $add;
     }
   ?>
     <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" name="id_post" required value="1" hidden/>
            <input type="text" name="judul" class="form-control" placeholder="Judul">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal</label>
          <div class="col-sm-10">
            <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" id="tgl">
          </div>
        </div>
        <input type="text" name="id_fakultas" value="1" hidden="true">
        <!--<div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Fakultas</label>
          <div class="col-sm-10">
            <select class="custom-select mr-sm-2" name="id_fakultas" id="inlineFormCustomSelect">
              <option selected>-Pilih Fakultas-</option>
              <?php
								$fakultas = new ControlFakultas();
								$getFakultas = $fakultas->getAllFakultas();
								if ($getFakultas)
								{
										while ($result1 = $getFakultas->fetch_assoc())
								{
								?>
								<option value="<?php echo $result1['id_fakultas']?>">
								<?php echo $result1['id_fakultas'] .' - '.$result1['nama_fakultas'];?>
								</option>
								<?php
								      }
								}
										 ?>
            </select>
          </div>
        </div> -->
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Program Studi</label>
          <div class="col-sm-10">
            <select class="custom-select mr-sm-2" name="id_prodi" id="inlineFormCustomSelect">
              <?php
							$prodi = new ControlProdi();

              if ($dataProdi == '0') 
              {
                $getProdi = $prodi->getAllProdi();   
              } else {
                $getProdi = $prodi->getDataProdi($dataProdi);                
              }

							if ($getProdi)
							{
								while ($resultProdi = $getProdi->fetch_assoc())
							{
							?>
								<option value="<?php echo $resultProdi['id_prodi']?>" selected>
									<?php echo $resultProdi['id_prodi'] .' - '.$resultProdi['nama_prodi'];?>
									</option>
							<?php
							     }
							}
							?>

            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Level</label>
          <div class="col-sm-10">
            <select class="custom-select mr-sm-2" name="level" id="inlineFormCustomSelect">
              <option selected>-Pilih Level-</option>
              <option value="Dosen / Staf">Dosen / Staf</option>
              <option value="Mahasiswa">Mahasiswa</option>
              <option value="Umum">Umum</option>              
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">File</label>
          <div class="col-sm-10">
            <div class="form-group">
              <input type="file" name="file_url[]" class="form-control-file" multiple="true" ondragover="" id="exampleFormControlFile1">
            </div>
          </div>
        </div>
        <!--<div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Sifat</label>
          <div class="col-sm-10">
            <select class="custom-select mr-sm-2" name="sifat" id="inlineFormCustomSelect">
              <option selected>-Pilih sifat-</option>
              <option value="Penting">Penting</option>
              <option value="Biasa">Biasa</option>
            </select>
          </div>
        </div> -->
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Keterangan</label>
          <div class="col-sm-10">
            <div class="form-group">
                <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </div>
        </div>


        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" name="post_add" class="btn btn-primary">Save</button>
            <a href="dashboard.php" class="btn btn-outline-dark">Back</a>
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
