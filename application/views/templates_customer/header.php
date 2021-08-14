<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/assets_customer/img/logoo.jpg" type="image/x-icon" />

    <title>PO. Siswantoro - Rental Mobil</title>

    <!--=== Bootstrap CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Vegas Min CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/plugins/vegas.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/style.css" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="<?php echo base_url() ?>assets/assets_customer/css/responsive.css" rel="stylesheet">

      <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<CLIENT-KEY>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loader-active">

    <!--== Preloader Area Start ==-->
    <div class="preloader">
        <div class="preloader-spinner">
            <div class="loader-content">
                <img src="<?php echo base_url() ?>assets/assets_customer/img/preloader.gif" alt="JSOFT">
            </div>
        </div>
    </div>
    <!--== Preloader Area End ==-->

    <!--== Header Area Start ==-->
    <header id="header-area" class="fixed-top">
        <!--== Header Top Start ==-->
        <div id="header-top" class="d-none d-xl-block">
            <div class="container">
                
            </div>
        </div>
    </div>
    <!--== Header Top End ==-->

    <!--== Header Bottom Start ==-->
    <div id="header-bottom" style="background-color: #2b2b2a">
        <div class="container">
            <div class="row">
                <!--== Logo Start ==-->
                <div class="col-lg-3">
                    <a href="#" class="logo">
                        <img src="<?php echo base_url() ?>assets/assets_customer/img/logo2.png" alt="JSOFT">
                    </a>
                </div>
                <!--== Logo End ==-->

                <!--== Main Menu Start ==-->
                <div class="col-lg-9 d-none d-xl-block">
                    <nav class="mainmenu alignright">
                        <ul style="margin-left: 5">
                            <li class="<?php if($this->uri->segment(2)=='dashboard'){echo "active";} ?>"><a href="<?php echo base_url('customer/dashboard') ?>"><i class="fa fa-home"></i>Beranda</a></li>


                            <li class="<?php if($this->uri->segment(2)=='data_mobil'){echo "active";} ?>"><a href="<?php echo base_url('customer/data_mobil') ?>">Mobil</a></li>
                          <!--   <li class="<?php if($this->uri->segment(2)=='paket_tour'){echo "active";} ?>" ><a href="<?php echo base_url('customer/paket_tour') ?>">Paket Tour</a></li> -->
                            <li class="<?php if($this->uri->segment(2)=='transaksi'){echo "active";} ?>"><a href="<?php echo base_url('customer/transaksi') ?>">Transaksi</a></li>
                            <li class="<?php if($this->uri->segment(2)=='register'){echo "active";} ?>"><a href="<?php echo base_url('register') ?>">Daftar</a></li>

                            <?php if($this->session->userdata('nama')) { ?>
                                <li><a href="<?php echo base_url('auth/logout') ?>">Hai, <?php echo $this->session->userdata('nama')?>|<span style="color: red"> Logout <i style="color: red" class="fa fa-sign-out"></i></span></a></li>
                            <?php }else{ ?>                              
                              <li><a href="<?php echo base_url('auth/index') ?>">Login</a></li>  
                              
                          <?php }  ?>
                          
                      </ul>
                  </nav>
              </div>
              <!--== Main Menu End ==-->
          </div>
      </div>
  </div>
  <!--== Header Bottom End ==-->
</header>