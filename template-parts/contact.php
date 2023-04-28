<?php
/**
 * Modal contact
 *
 * @package WordPress
 * @subpackage nathalie-motta
 */

?>

<div class="popup-overlay">
	<div class="popup-contact">
		<div class="popup-header">
			<img class="popup-close" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Contact.png'?>" alt="Page contact">			
		</div>		
		<p class="popup-informations">Vous souhaitez plus d'informations concernant cet événement ?</p>
		<?php
		// On insère le formulaire de demandes de renseignements
		echo do_shortcode('[contact-form-7 id="32" title="Formulaire de contact"]');
		?>
	</div>
</div>