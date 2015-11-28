<?php
    if (strpos($_SERVER['SERVER_NAME'], "localhost") !== false) {
        define(SITE_ROOT, "/baptiste/");
    }
    else {
        define(SITE_ROOT, "/");
    }

    $url = htmlspecialchars($_SERVER['PHP_SELF']);

    $querystring = explode("index.php", $url)[1];
    if (empty($querystring)) {
        $params = "projets";
    }
    else {
        $params = substr($querystring, 1);
    }
    $folder = explode("/", $params)[0];

    $page = "pages/" . $params . ".php";
?>


<!DOCTYPE html>
<html>
<head>
    <title>
        LAMA
    </title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>css/galerie.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>css/photo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>css/projet.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.css"/>
</head>
<body <?php echo "class='" . $folder . "'"; ?>>
    <div class="page">
        <div class="navbar">
            <div class="menu">
                <h1 class="menu-title"><a href="./">L A M A</a></h1>
                <ul>
                    <li><a href="<?php echo SITE_ROOT; ?>projets" <?php if ($folder == "projets") { echo "class='active'"; } ?> >projets</a></li>
                    <li><a href="<?php echo SITE_ROOT; ?>photo"   <?php if ($folder == "photo")   { echo "class='active'"; } ?> >photo</a></li>
                    <li><a href="<?php echo SITE_ROOT; ?>galerie" <?php if ($folder == "galerie") { echo "class='active'"; } ?> >galerie</a></li>
                    <li><a href="#" id="contact-link">contact</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>

        <div class="title">
            <a href="<?php echo SITE_ROOT; ?>">
                <img src="<?php echo SITE_ROOT; ?>img/logo.png" alt="L A M A">
            </a>
        </div>

        <div class="contact" style="display:none;">
            <div class="contact-left">
                <h1>Baptiste Plantin</h1>
                <h1>Graphiste Freelance</h1>
                <h1><span class="green">T</span> 07 81 08 86 40</h1>
                <h1><span class="green">E</span> <a href="mailto:contact@lamadesign.fr">contact@lamadesign.fr</a></h1>
            </div>
            <div class="contact-right">
                <p>
                    Si l’envie de travailler <br> avec moi vous prend, ou simplement si ma vie vous passionne, n'hésitez pas à télécharger mon CV.
                </p>
                <p>
                    <a href="" class="cv">Curri-<br>Culum<br>Vitae</a>
                </p>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php
            if (file_exists($page)) {
                require_once($page);
            }
            else {
                require_once("404.php");
            }
        ?>

    </div>
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.min.js"></script>
<script>
$(document).ready(function () {
    $("#contact-link").on("click", function (event) {
        event.preventDefault();
        $(".contact").toggle(100);
    });

    $('.main-photo').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 500,
        fade: true,
        slide: 'div',
        cssEase: 'linear',
        lazyLoad: 'ondemand',
    });

    $(".photo-thumbnail>a>img").on("click", function (event) {
        event.preventDefault();
        var mainPhotoDiv = $('.main-photo');
        var images = $(this).data("images").split(" ");
        var imgDir = mainPhotoDiv.data("imgdir");

        mainPhotoDiv.unslick();
        mainPhotoDiv.empty();

        $.each(images, function (index, photoSrc) {
            mainPhotoDiv.append("<div><img data-lazy='" + imgDir + photoSrc + "' ></div>");
        });

        mainPhotoDiv.slick({
            dots: true,
            arrows: true,
            infinite: true,
            speed: 500,
            fade: true,
            slide: 'div',
            cssEase: 'linear',
            lazyLoad: 'ondemand',
        });
    });
});
</script>


</html>
