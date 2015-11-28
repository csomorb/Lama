<?php
    if ($_SERVER['SERVER_NAME'] === "localhost" && $_SERVER['SystemRoot'] === "C:\Windows") {
        define("SITE_ROOT", "/lamagraphic.fr-master/htdocs/");
    }
    else {
        define("SITE_ROOT", "/");
    }

    $querystring = htmlspecialchars($_SERVER['QUERY_STRING']);

    if (empty($querystring)) {
        $params = "projets";
    }
    else {
        $params = $querystring;
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
    <meta description="Lama est une agence graphique de taille humaine, précisément 1m77, fondée par Baptiste Plantin.">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.css"/>
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' >
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>essai/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>css/galerie.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>css/photo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>essai/css/projet.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>css/journal.css">
    <link rel="icon" type="image/png"  href="/img/favicon.png" />
</head>
<body <?php echo "class='" . $folder . "'"; ?>>
    <div class="page">
        <div class="navbar">
            <div class="menu">
		<img src="<?php echo SITE_ROOT; ?>img/etoile.png" <?php if ($folder == "projets") echo 'class="affiche_etoile_projet"'; else echo 'class="hide_etoile"';?>>
		<img src="<?php echo SITE_ROOT; ?>img/etoile.png" <?php if ($folder == "photo") echo 'class="affiche_etoile_photo"'; else echo 'class="hide_etoile"';?>>
		<img src="<?php echo SITE_ROOT; ?>img/etoile.png" <?php if ($folder == "galerie") echo 'class="affiche_etoile_galerie"'; else echo 'class="hide_etoile"';?>>
		<img src="<?php echo SITE_ROOT; ?>img/etoile.png" <?php if ($folder == "journal") echo 'class="affiche_etoile_journal"'; else echo 'class="hide_etoile"';?>>
                <ul>
                    <li><a href="<?php echo SITE_ROOT; ?>projets" <?php if ($folder == "projets") { echo "class='active'"; } ?> >PROJETS</a></li>
                    <li><a href="<?php echo SITE_ROOT; ?>photo"   <?php if ($folder == "photo")   { echo "class='active'"; } ?> >PHOTO</a></li>
                    <li><a href="<?php echo SITE_ROOT; ?>journal" <?php if ($folder == "journal") { echo "class='active'"; } ?> >JOURNAL</a></li>
		    <li><a href="<?php echo SITE_ROOT; ?>galerie" <?php if ($folder == "galerie") { echo "class='active'"; } ?> >GALERIE</a></li>
                    <li><a href="#" id="contact-link">CONTACTS</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>

		<section  class="titre">
			<a href="./"><img src="<?php echo SITE_ROOT; ?>img/lama_vertical.png" alt="logo_lama" id="logo_lama"/></a>
			<div class="title">
				<span > <span class="gras"> Lama est<br>une agence<br>de design<br>graphique</span> de taille humaine, précisément 1m77, fondée par Baptiste Plantin </span>
			</div>
		</section>

        <div class="contact" style="display:none;">
            <div class="contact-left">
                <h1>Baptiste Plantin</h1>
                <h1>Graphiste Freelance</h1>
                <h1>07 81 08 86 40</h1>
                <h1><a href="mailto:contact@lamagence.fr">contact@lamagence.fr</a></h1>
            </div>
            <div class="contact-right">
                <p>
                    Si l’envie de travailler <br> avec moi vous prend, ou simplement si ma vie vous passionne, n'hésitez pas à télécharger mon CV.
                </p>
                <p>
                    <div class="blue-circle"><div></div></div>
                    <a href="<?php echo SITE_ROOT; ?>files/CV.pdf" class="cv">Curri-<br>Culum<br>Vitae</a>
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
<a href="" class="retour_site"> 
<img src="<?php echo SITE_ROOT; ?>img/haut.png"/>
</a>	
	</body>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.min.js"></script>
<script data-cfasync='false'>
$(document).ready(function () {
    $("#contact-link").on("click", function (event) {
        $(".contact").toggle(100);
    });

    $(".photo-thumbnail>a>img").on("click", function (event) {
        var mainPhotoDiv = $('.main-photo');
        var images = $(this).data("images").split(" ");
        var imgDir = mainPhotoDiv.data("imgdir");

        mainPhotoDiv.unslick();
        mainPhotoDiv.empty();

        $.each(images, function (index, photoSrc) {
            if (photoSrc.trim() !== "") {
                mainPhotoDiv.append("<div><img data-lazy='" + imgDir + photoSrc + "' ></div>");
            }
        });

        mainPhotoDiv.slick({
            dots: false,
            arrows: true,
            infinite: false,
            speed: 500,
            fade: true,
            slide: 'div',
            cssEase: 'linear',
            lazyLoad: 'ondemand',
            prevArrow: '<img src="<?php echo SITE_ROOT; ?>img/prev.png" class="slick-prev prev-arrow">',
            nextArrow: '<img src="<?php echo SITE_ROOT; ?>img/next.png" class="slick-next next-arrow">',
        });
    });

    if ($(".projets").length > 0) {
        var textKeys = ["title", "date", "short_decription", "medium", "subtitle",
                        "long_description", "notes"];
        var imgDir = $(".main-photos").data("imgdir");

        $.getJSON("<?php echo SITE_ROOT; ?>pages/projects.json").success(function (data) {
            $(".projets").data("data", data);
            displayNavigation(data);
            displayProject(data, 0, true);
            loadAllImages(data);
        }).error(function (data, error) {
            console.log("Something went wrong:", error);
        });

        $("#project-next_image").on("click", function (event) {
            event.preventDefault();
            displayProject($(".projets").data("data"), nextProjectId());
        });

		$("#project-suivant-fleche").on("click", function (event) {
            event.preventDefault();
            displayProject($(".projets").data("data"), nextProjectId());
        });
		
		$("#project-suivant-fleche").on("mouseover", function (event) {
            $(this).animate({left: "990px"}, 50);
        });
		
        $("#project-next_image").on("mouseover", function (event) {
            $(this).animate({left: "990px"}, 50);
        });

        $("#project-next_image").on("mouseout", function (event) {
            $(this).animate({left: "1000px"}, 50);
        });
    }

    function displayNavigation(data) {
        var projectId;
        var template =
        '<div class="project-navigation-item">' +
        '    <a class="project-navigation-item-inside" href="#" data-projectid="{projectId}">' +
        '        <div class="blue-circle"><div></div></div>' +
        '        <h3>{title}</h3>' +
        '        <p class="date">{date}</p>' +
        '        <p class="description">{short_description}</p>' +
        '        <p class="medium">{medium}</p>' +
        '    </a>' +
        '</div>';

        $("#project-navigation").empty();
        $('#project-navigation').unslick();

        for (projectId in data) {
            project = data[projectId];
            html = template
                .replace("{projectId}", projectId)
                .replace("{title}", project["title"])
                .replace("{date}", project["date"])
                .replace("{short_description}", project["short_description"])
                .replace("{medium}", project["medium"]);
            $("#project-navigation").append(html);
        }

        $('#project-navigation').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 5,
            touchMove: false,
            slidesToScroll: 3,
            slide: 'div.project-navigation-item',
            prevArrow: '<img src="<?php echo SITE_ROOT; ?>img/prev.png" class="slick-prev prev-arrow">',
            nextArrow: '<img src="<?php echo SITE_ROOT; ?>img/next.png" class="slick-next next-arrow">',
        });

        $(".project-navigation-item-inside").on("click", function (event) {
            event.preventDefault();
            displayProject(data, $(this).data("projectid"));
        })
    }

    function displayProject(data, projectId, firstLoading) {
        var i, key, imgId, imgSrc, project, asideKey;
        project = data[projectId];

        moveToNextPageIfNecessary(projectId);

        $("#project-id").data("id", projectId);

        $(".project-navigation-selected").removeClass("project-navigation-selected");
        $($(".project-navigation-item")[projectId]).addClass("project-navigation-selected");

        for (i in textKeys) {
            key = textKeys[i];
            $("#project-" + key).html(project[key]);
        }

        $("#project-aside").empty();
        for (asideKey in project["aside"]) {
            $("#project-aside").append("<h4>" + asideKey + "</h4>");
            $("#project-aside").append("<p>" + project["aside"][asideKey] + "</p>");
        }

        if (firstLoading) {
            $("#project-main_image").attr("src", imgDir + project["main_image"]);
            nextProject = data[nextProjectId()];
            $("#project-next_image").attr("src", imgDir + nextProject["main_image"]);
        }
        else {
            transitionImages(data, project);
        }

        $("#project-images").empty();
        for (imgId in project["images"]) {
            imgSrc = imgDir + project["images"][imgId];
            $("#project-images").append("<img src='" + imgSrc + "'' class='project-image'>");
        }
    }

    function transitionImages(data, project, nextProject) {
        var mainImageDiv = $("#project-main_image");
        var nextImageDiv = $("#project-next_image");
        var fakeImageDiv = $("#project-fake_image");

        var currentImageSrc = mainImageDiv.attr("src");
        var nextProject = data[nextProjectId()];

        fakeImageDiv.attr("src", imgDir + project["main_image"]);
        fakeImageDiv.show();
        nextImageDiv.attr("src", imgDir + nextProject["main_image"]);

        nextImageDiv.css({left: "3000px"});

         mainImageDiv.animate({opacity: "0"}, 150);
        fakeImageDiv.animate({left: "0px"}, 300, function onAnimationFinished() {
            fakeImageDiv.hide();
            fakeImageDiv.css("left", "1000px");
        });
        nextImageDiv.animate({left: "1000px"}, 300, function onAnimationFinished() {
            mainImageDiv.attr("src", imgDir + project["main_image"]);
            mainImageDiv.css({opacity: "100"});
        });
	}

    function moveToNextPageIfNecessary(projectId) {
        var slider, slidesPerPage;
        slider = $("#project-navigation");
        slidesPerPage = slider.slickGetOption("slidesToShow");

        if (projectId % slidesPerPage === 0) {
            $("#project-navigation").slickGoTo(projectId);
        }
    }

    function nextProjectId() {
        var currentId = $("#project-id").data("id");
        var numProjects = $(".projets").data("data").length;
        return (currentId + 1) % numProjects;
    }

    function loadAllImages(data) {
        for (projectId in data) {
            console.log(data[projectId]["title"]);
            $("body").append(
                $("<img>").hide().attr({src: imgDir + data[projectId]["main_image"]})
            );
        }
    }
});
</script>


</html>
