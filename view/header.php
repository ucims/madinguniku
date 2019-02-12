<?php
include_once 'lib/session.php';
Session::init();
?>
<?php
  $loginHeader= Session::get('LoginMadun');
  $nameLog = Session::get('madunUser');
  if ($loginHeader == true)
  {
?>
<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="asset/dashboard.css">
<script src="asset/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="asset/bootstrap/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="asset/bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="asset/bootstrap/js/bootstrap.min.js"></script>
<link rel=”stylesheet” type=”text/css” href="asset/jquery-ui-1.12.1/jquery-ui.css">
<link rel=”stylesheet” type=”text/css” href="asset/css/style.css" >
<link rel=”stylesheet” type=”text/css” href="../asset/css/style.css" >
<script src="asset/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
<script src="asset/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="asset/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<link rel=”stylesheet” type=”text/css” href="asset/jquery-ui-1.12.1/jquery-ui.theme.css">
<link rel="stylesheet" type="text/css" href="asset/DataTables/datatables.css">
<script type="text/javascript" charset="utf8" src="asset/DataTables/datatables.js"></script>
<script>

$(document).ready(function(){
  $('#tgl').datepicker({

  })
});

$(document).ready( function () {
  $('#table_id').DataTable();
} );


function konfirmasi()
{
  tanya = confirm("Anda Yakin Akan Menghapus Data ?");
  if (tanya == true) return true;
  else return false;
};
</script>
<script language="JavaScript">
          function CheckAll()
          {
              var a=new Array();
              a=document.getElementsByName("checklist[]");
              //alert("Length:"+a.length);
              /*var p=0;
              for(i=0;i<a.length;i++){
                  if(a[i].checked){
                      alert(a[i].value);
                      p=1;
                  }
              }*/
              for (i = 0; i < a.length; i++)
                  a[i].checked = true ;
          }

          function UnCheckAll(chk)
          {
              var a=new Array();
              chk=document.getElementsByName("checklist[]");
              for (i = 0; i < chk.length; i++)
                  chk[i].checked = false ;
          }
  </script>
  <script>
      /* When the user clicks on the button,
      toggle between hiding and showing the dropdown content */
      function addButton() {
          document.getElementById("myDropdown").classList.toggle("show");
      }

      function filterFunction() {
          var input, filter, ul, li, a, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          div = document.getElementById("myDropdown");
          a = div.getElementsByTagName("a");
          for (i = 0; i < a.length; i++) {
              if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                  a[i].style.display = "";
              } else {
                  a[i].style.display = "none";
              }
          }
      }
  </script>
  <script>
  $(document).ready( function () {
    $('.dropdown-toggle.').dropdown();
  } );
  </script>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">UNIKU</a>
  
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <?php

              $login_Header= Session::get('LoginMadun');
              $dataLevel = Session::get('madunLevel');

              if ($login_Header == false)
              {
                header("Location:index.php");
              } else {
                ?>
                <a class="nav-link" href="?id_session=<? Session::get('madunId')?>">Sign out</a>
                <?
                if (isset($_GET['id_session']))
            		{
            			Session::destroy();
            		}
              }

        ?>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <span data-feather="file"></span>
              Post
            </a>
          </li>
          <?php 
          if ($dataLevel == 'Administrator') {            
          ?>
          <li class="nav-item">
            <a class="nav-link" href="fakultas.php">
              <span data-feather="bar-chart-2"></span>
              Fakultas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="prodi.php">
              <span data-feather="bar-chart-2"></span>
              Program Studi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <span data-feather="users"></span>
              Users
            </a>
          </li>
          <?php 
          }
          ?>
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Selamat Datang !</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" onclick="myFunction()" href="user_session.php">
              <span data-feather="user"></span>
              <?php $nameLog = Session::get('madunUser');
              echo strtoupper($nameLog); 
               ?>
            </a>
          </li>
        </ul>
      <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" onclick="addButton();" href="#">
              <span data-feather="plus-circle"></span>
              Add
            </a>
            <ul>
            <?php 
            if ($dataLevel == 'Administrator') {            
            ?>
              <li><a href="post_add.php">Post</a></li>
              <li><a href="fakultas_add.php">Fakultas</a></li>
              <li><a href="prodi_add.php">Program Studi</a></li>
              <li><a href="user_add.php">User</a></li>
            </ul>
            <?php 
            } else {
            ?>  
              <li><a href="post_add.php">Post</a></li>
            <?php
            }
            ?>
          </li>
      </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

<?php
}
?>
