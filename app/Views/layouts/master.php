<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=$this->asset('img/favicon.png')?>" type="image/png">
    <title>ListAshop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=$this->asset('css/bootstrap.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('vendors/linericon/style.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('vendors/owl-carousel/owl.carousel.min.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('vendors/lightbox/simpleLightbox.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('vendors/nice-select/css/nice-select.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('vendors/animate-css/animate.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('vendors/jquery-ui/jquery-ui.css')?>">
    <!-- main css -->
    <link rel="stylesheet" href="<?=$this->asset('css/style.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('css/responsive.css')?>">
    <?=@$css?>
</head>
<body>
    <?=@$layouts['header']?>
    <?=@$layouts['content']?>
    <?=@$layouts['footer']?>
</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?=$this->asset('js/jquery-3.2.1.min.js')?>"></script>
<script src="<?=$this->asset('js/popper.js')?>"></script>
<script src="<?=$this->asset('js/bootstrap.min.js')?>"></script>
<script src="<?=$this->asset('js/stellar.js')?>"></script>
<script src="<?=$this->asset('vendors/lightbox/simpleLightbox.min.js')?>"></script>
<script src="<?=$this->asset('vendors/nice-select/js/jquery.nice-select.min.js')?>"></script>
<script src="<?=$this->asset('vendors/isotope/imagesloaded.pkgd.min.js')?>"></script>
<script src="<?=$this->asset('vendors/isotope/isotope-min.js')?>"></script>
<script src="<?=$this->asset('vendors/owl-carousel/owl.carousel.min.js')?>"></script>
<script src="<?=$this->asset('js/jquery.ajaxchimp.min.js')?>"></script>
<script src="<?=$this->asset('vendors/counter-up/jquery.waypoints.min.js')?>"></script>
<!--    <script src="vendors/flipclock/timer.js"></script>-->
<script src="<?=$this->asset('vendors/counter-up/jquery.counterup.js')?>"></script>
<script src="<?=$this->asset('js/mail-script.js')?>"></script>
<script src="<?=$this->asset('js/jquery-ui.js')?>"></script>
<script src="<?=$this->asset('js/jquery.validate.min.js')?>"></script>
<script src="<?=$this->asset('js/theme.js')?>"></script>
<?=@$js?>
</html>