<!DOCTYPE html>
<html>
<head>
  <title>Add User</title>
  <meta charset="utf-8">
  <link rel="icon" href="asset/images/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
  <?php
    include_once 'controller/control_prodi.php';
    include_once 'controller/control_user.php';
  	include_once 'controller/control_fakultas.php';
    include_once 'view/header.php';

    $dataSession = Session::get('LoginMadun');
    if ($dataSession == false)
    {
    	header("Location:index.php");
    }

    $user = new ControlUser();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_add']))
    {
      $add = $user->addUser($_POST);
    }
   ?>
  <h2>Add User</h2>
  <?php
    if (isset($add)) {
      echo $add;
    }
  ?>
  <form method="post" action="user_add.php" enctype="multipart/form-data">
     <div class="form-group row">
       <label for="inputEmail3" class="col-sm-2 col-form-label">Id User</label>
       <div class="col-sm-10">
         <input type="text" name="id_user" required class="form-control" placeholder="Id User">
       </div>
     </div>
     <div class="form-group row">
       <label for="inputPassword3" class="col-sm-2 col-form-label">Username</label>
       <div class="col-sm-10">
         <input type="text" name="username" class="form-control" placeholder="Username" >
       </div>
     </div>
     <div class="form-group row">
       <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
       <div class="col-sm-10">
         <input type="text" name="nama" class="form-control" placeholder="Nama " >
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
     </div>-->
     <div class="form-group row">
       <label for="inputPassword3" class="col-sm-2 col-form-label">Program Studi</label>
       <div class="col-sm-10">
         <select class="custom-select mr-sm-2" name="id_prodi" id="inlineFormCustomSelect">
           <option selected>-Pilih Prodi-</option>
           <?php
           $prodi = new ControlProdi();
           $getProdi = $prodi->getAllProdi();
           if ($getProdi)
           {
             while ($resultProdi = $getProdi->fetch_assoc())
           {
           ?>
             <option value="<?php echo $resultProdi['id_prodi']?>">
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
           <option value="Administrator">Administrator</option>
           <option value="Tata Usaha">Tata Usaha</option>
         </select>
       </div>
     </div>
     <div class="form-group row">
       <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
       <div class="col-sm-10">
         <input type="text" name="password" class="form-control" placeholder="Password" >
       </div>
     </div>
     <div class="form-group row">
       <div class="col-sm-10">
         <button type="submit" name="user_add" class="btn btn-primary">Save</button>
         <a href="user.php" class="btn btn-outline-dark">Back</a>
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
