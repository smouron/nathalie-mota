<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

echo ('archive.php')
?>

<div id="wrap">
      <section id="content">
        <h1>Nathalie Motta</h1>

        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <article class="post">
                <h2><?php the_title(); ?></h2>
        
                <?php the_post_thumbnail(); ?>
                
                <p class="post__meta">
                    Publié le <?php the_time( get_option( 'date_format' ) ); ?> 
                    par <?php the_author(); ?> • <?php comments_number(); ?>
                </p>
                
                <?php the_excerpt(); ?>
                
                <p>
                    <a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
                </p>
            </article>
      </section>
  </div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
