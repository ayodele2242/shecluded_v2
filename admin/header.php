<?php 
include('../inc/admins.php');
require_once '../inc/cookie.php';
$current_page = getCurrentPage();

?>
<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Shecluded">
    <title>
    <?php 
			    echo 'Shecluded - '. (isset($current_page)) ? ucwords(str_replace('_', ' ', $current_page)) : ''; 
		    ?>
    </title>
    <link rel="apple-touch-icon" href="../assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/pickers/pickadate/pickadate.css">


    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/extensions/shepherd.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/core/menu/menu_types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/plugins/pickers/daterange/daterange.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/pages/page-users.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/plugins/forms/switch.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
    <link rel="stylesheet" href="../assets/css/placeholder.css">
  

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
