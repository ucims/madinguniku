<!DOCTYPE html>
<html>
<head>
  <title>Edit Prodi</title>
  <meta charset="utf-8">
  <link rel="icon" href="asset/images/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
  <?php
    include_once 'controller/control_prodi.php';
  	include_once 'controller/control_fakultas.php';
    include_once 'view/header.php';

    $dataSession = Session::get('LoginMadun');
    if ($dataSession == false)
    {
    	header("Location:index.php");
    }

    $prodi = new ControlProdi();

    extract($_GET);
    $getProdi =  $prodi->getDataProdi($id_prodi);
    if ($getProdi)
    {
      while ($result = $getProdi->fetch_assoc())
      {
   ?>
  <h2>Edit Prodi</h2>
  <?php
    if (isset($edit))
    {
      echo $edit;
     }
  ?>
  <form method="post" action="" enctype="multipart/form-data">
     <div class="form-group row">
       <label for="inputEmail3" class="col-sm-2 col-form-label">Id Prodi</label>
       <div class="col-sm-10">
         <input type="text" name="id_prodi" required class="form-control" placeholder="Id Prodi" value="<?php echo $result['id_prodi'];?>" readonly>
       </div>
     </div>
     <div class="form-group row">
       <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Prodi</label>
       <div class="col-sm-10">
         <input type="text" name="nama_prodi" class="form-control" placeholder="Nama Fakultas" value="<?php echo $result['nama_prodi'];?>">
       </div>
     </div>
     <div class="form-group row">
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
              if($result1['id_fakultas']==$result['id_fakultas']){
                ?>
                <option value="<?php echo $result1['id_fakultas']?>" selected>
                <?php 
                    echo $result1['id_fakultas'] .' - '.$result1['nama_fakultas'];
                ?>
                </option>
                <?php
                }else{
                ?>
                <option value="<?php echo $result1['id_fakultas']?>">
                <?php 
                  echo $result1['id_fakultas'] .' - '.$result1['nama_fakultas'];
                ?>
                </option>
             <?php
                }         
              }
             }
             ?>
         </select>
       </div>
     </div>

     <div class="form-group row">
       <div class="col-sm-10">
         <button type="submit" name="prodi_edit" class="btn btn-primary">Edit</button>
         <a href="prodi.php" class="btn btn-outline-dark">Back</a>
       </div>
     </div>
   </form>
</div>
</main>
</div>
<?php
      }
    }
    if (isset($_POST['prodi_edit']))
    {
      $id_prodi = $result['id_prodi'];
      $edit = $prodi->editProdi($_POST,$id_prodi);
    }
?>
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
