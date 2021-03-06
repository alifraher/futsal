<!-- Fungsi Session -->
<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "koneksi.php";
?>
<!-- End -->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xphp">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Sistem Informasi Futsal</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- php5 Shiv and Respond.js for IE8 support of php5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <marquee><strong>Komplek </strong>SPBU No. 14-294-722 Vitka Point (Tiban)
                    &nbsp;&nbsp;
                    <strong>Telp: </strong>0778 - 326623, 326289 
					<strong>Fax: </strong>0778 - 326389 </marquee>
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
	
			<!-- Fungsi Waktu Session -->
				<?php
				$timeout = 10; // Set timeout minutes
				$logout_redirect_url = "../index.php"; // Set logout URL

				$timeout = $timeout * 60; // Converts minutes to seconds
				if (isset($_SESSION['start_time'])) {
					$elapsed_time = time() - $_SESSION['start_time'];
					if ($elapsed_time >= $timeout) {
						session_destroy();
						echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
					}
				}
				$_SESSION['start_time'] = time();
				?>
				<?php } ?>
				<!-- End -->
				
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">

                    <img src="assets/img/logo.png" />
                </a>

            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-settings">
                                <div class="media"> 
                                    <a class="media-left" href="#">	
									<!-- Fungsi Menampilkan Foto Admin -->
                                        <img src="<?php echo $_SESSION['gambar']; ?>" alt="" class="img-rounded" />
										<!-- End -->
                                    </a>
                                    <div class="media-body">
                                        Welcome, <h4 class="media-heading"><?php echo $_SESSION['fullname']; ?></h4>
                                    </div>
                                </div></br>
                                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>

                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
				<div align="right">
				<a class="btn btn-danger" href="dashboard.php"><i class="fa fa-fast-backward "></i> Kembali ke Menu Utama</a></div>
                    <h4 class="page-head-line">Detail Transaksi</h4>
					<div align="right">	
				
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        Berikut Info Lengkap Seputar Admin Vitka Futsal
						</div>
                </div>

            </div>
			
			<!-- Fungsi Menampilkan Data dari Database -->	
				<?php
				$query = mysqli_query($koneksi, "SELECT id_transaksi, tb_transaksi.nama, tb_transaksi.tgl_main, tb_lapangan.nama_lapangan, tb_transaksi.hari_main, 
								tb_transaksi.jam_mulai, tb_transaksi.jam_selesai, tb_transaksi.keterangan, tb_transaksi.gambar
								FROM tb_transaksi, tb_lapangan
								WHERE tb_transaksi.id_lapangan=tb_lapangan.id_lapangan AND id_transaksi='$_GET[kd]'");
				$data  = mysqli_fetch_array($query);
				?>
			<!-- End -->
					
			
			
            <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                   
                  </thead>
				  
                    <!-- Menampilkan Hasil Data Detail Anggota dari Database -->                  
										<tbody>
										  <tr>
                      <td><strong>Nama Booking</strong></td>
                      <td><strong><?php echo $data['nama']; ?></strong></td>
                      <td rowspan="7"><div class="pull-right image">
                            <img src="<?php echo $data['gambar']; ?>" class="img-rounded" height="250" width="250"  alt="User Image" style="border: 2px solid #000;" />
                        </div></td>
                      </tr>
                      <tr>
                      <td width="250"><strong>Tanggal Main</strong></td>
                      <td width="565" colspan="1"><span class="label label-primary"><?php echo $data['tgl_main']; ?><span></td>
                      </tr>
                      <tr>
                      <td><strong>Paket Booking</strong></td>
                      <td colspan="1"><?php echo $data['nama_lapangan']; ?></td>
                      </tr>
                      <tr>
                      <td><strong>Hari Main</strong></td>
                      <td colspan="1"><?php echo $data['hari_main']; ?></td>
                      </tr>
					  <tr>
                      <td><strong>Jam Mulai</strong></td>
                      <td colspan="1"><span class="label label-success"><?php echo $data['jam_mulai']; ?><span></td>
                      </tr>
                      <tr>
                      <td><strong>Jam Selesai</strong></td>
                      <td colspan="1"><span class="label label-danger"><?php echo $data['jam_selesai']; ?><span></td>
                      </tr>
					  <tr>
                      <td><strong>Keterangan</strong></td>
                      <td colspan="1"><strong><?php echo $data['keterangan']; ?></strong></td>
                      </tr>
                      </table>
                      <div class="text-right">
                      <a href="transaksi.php" class="btn btn-sm btn-primary"><i class="fa fa-arrow-circle-left"></i> Kembali </a>
					  <p></p>
					<!-- End -->
                      
                  </tbody>
                </table>
              </div>
			  
			  
            </div>
          </div>


            </div>
           
            </div>
			</div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2017 Vitka Futsal Center | By : <a href="../index.php" target="_blank">SPAN Community</a>
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
