<?php
/**
 * The header
 *
 * @package WordPress
 * @subpackage nathalie-mota
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
	<!-- Header -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<meta name="keywords" content="photographe événementiel, photographe event, nathalie mota, photo format hd"/>
	<meta name="description" content="Nathalie Mota - Site d'exercice réalisé durant ma formation de développeur Web avec OpenClassrooms."/>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

	<!-- Récupération sur Fontawesome des icones dont on aura besoin -->
	<script src="https://kit.fontawesome.com/57bf6f7049.js" crossorigin="anonymous"></script>

	<!-- Matomo -->
	<script>
	var _paq = window._paq = window._paq || [];
	/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
	_paq.push(['trackPageView']);
	_paq.push(['enableLinkTracking']);
	(function() {
		var u="//stephane-mouron.fr/matomo/";
		_paq.push(['setTrackerUrl', u+'matomo.php']);
		_paq.push(['setSiteId', '3']);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
	})();
	</script>
	<!-- End Matomo Code -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>	
	<header id="header" class="header flexrow">
		<div class="container-header flexrow">
			<a href="<?php echo home_url( '/' ); ?>" aria-label="Page d'accueil de Nathalie Mota">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_nathalie_mota.png" 
				alt="Logo <?php echo bloginfo('name'); ?>">
			</a>
			<nav id="navigation">
				<?php 
					// Affichage du menu main déclaré dans functions.php
					wp_nav_menu(array('theme_location' => 'main')); 
				?>
				<button id="modal__burger" class="btn-modal" aria-label="Menu pour la version portable">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
				
                <div id="modal__content" class="modal__content">           
					<?php 				
					wp_nav_menu(array('theme_location' => 'main')); 
					?>
                </div>
			</nav>
		</div>
	</header>	

