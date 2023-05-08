<?php
/**
 * Modal contact
 *
 * @package WordPress
 * @subpackage nathalie-motta theme
 */

?>


<?php 
    // Récupérer la taxonomie actuelle
    $term = get_queried_object();
    $term_id  = my_acf_load_value('ID', $term);
    // Récupération du nom de la catégorie et du format
    $categorie  = my_acf_load_value('name', get_field('categorie'));
    $format = my_acf_load_value('name', get_field('format'));

?>

<div class="popup-overlay hidden">
	<div class="popup-contact">
		<div class="popup-close">
			<!-- <img class="popup-close" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/contact.png'?>" alt="Page contact">		 -->
			<div class="popup-title"></div>
			<div class="popup-title"></div>
			Format : <?php echo $format; ?>
		</div>
		<div class="popup-informations">	
			<?php
				// On insère le formulaire de demandes de renseignements
				// get_field('reference')
				$refPhoto = "";
				if (get_field('reference')) {
					$refPhoto = get_field('reference');
				}; 
				echo do_shortcode('[contact-form-7 id="32" title="Formulaire de contact"]');
			?>
		</div>	
	</div>
</div>