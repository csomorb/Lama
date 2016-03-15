<div class="container">
<img src="/img/windows.png" id="display_carre"/>
<img src="/img/liste.png" id="display_normal"/>
<div class="project-navigation2" id="project-navigation2">
</div>
<div class="project-navigation" id="project-navigation">
</div>
<div id="deb">
	<div class="main-photos" data-imgDir="<?php echo SITE_ROOT; ?>img/projets/">
		<img src="" class="main-photo" id="project-main_image">
		<img src="" class="fake-photo" id="project-fake_image">
		<img src="" class="next-photo" id="project-next_image">
	</div>
	<div class="projet-suivant">
		<p>PROJET<br>SUIVANT</p>
		<img src="<?php echo SITE_ROOT; ?>img/fleche_longue.png">
	</div>
	<div id="project-id" data-id=""></div>
	<div class="project-description">
		<div><div></div></div>
		<h2 id="project-title">&nbsp;</h2>
		<div class="col-1-left" id="project-aside">
		</div>
		<div class="col-3-right">
			<p id="project-long_description" class="">&nbsp;</p>
			<p class="notes" id="project-notes">&nbsp;</p>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="project-images" id="project-images">
	</div>
</div>
</div>
<script>
window.onscroll = function() {
    var scroll = (document.documentElement.scrollTop ||
        document.body.scrollTop);
    if(scroll>1100)
        document.getElementById('project-aside').style.top = scroll+10+'px';
    else if(scroll<1100 || scroll == 1100)
    document.getElementById('project-aside').style.top = '1100px';
    }
</script>