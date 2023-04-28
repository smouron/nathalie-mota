<?php
/**
 * The main template file.
 *
 *
 * @package nathalie-motta theme
 */

get_header();

echo ('page-17.php');
?>

  <div id="wrap">
      <section id="content">
        <!-- Vérification s'il y a au moins 1 article -->
        <div id="loop">
                <article>
                    <h1><?php the_title(); ?></h1>
                        <!-- is_page() permet de déterminer si la page est en cours est une page -->
                        <?php if(!is_page()) : ?> dans <?php the_category(', '); ?><?php endif; ?>
                    </p>
                    <!-- is_singular() permet de déterminer si la page en cours est un post/article -->
                    <?php if(is_singular()) : ?>
                        <?php the_content(); ?>
                    <?php else : ?>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>">Lire la suite</a>
                    <?php endif; ?>
                </article>
        </div>
        <div id="pagination">
            <!-- afficher le système de pagination (s’il existe de nombreux articles) -->
            <?php echo paginate_links(); ?>
        </div>
      </section>

      <aside id="sidebar">
      </aside>
  </div>

<?php get_footer(); ?>

</body>
</html>