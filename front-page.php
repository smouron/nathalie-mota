<?php
    get_header();
    // echo ('front-page.php');
?>
  <div id="front-page"> 
      <section id="content">    
        <!-- Chargement du hero -->
        <?php get_template_part( 'template-parts/header/hero' ); ?>
        
        <!-- Chargement des filtres -->
        <?php get_template_part( 'template-parts/post/photo-filter' ); ?>
                
        <?php  
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

        $categorie_id  =  get_post_meta( get_the_ID(), 'categorie-acf', true );
        $categorie_name  = my_acf_load_value('name', get_field('categorie-acf'));
        $format_id  =  get_post_meta( get_the_ID(), 'format-acf', true );
        $format_name = my_acf_load_value('name', get_field('format-acf'));
        $custom_args = array(
        'post_type' => 'photo',
        // 'posts_per_page' => 1,
        // 'category_name' => $categorie, 
        'order' => 'DESC', // ASC ou DESC 
        'orderby' => 'date', // 'date' , 'meta_value_num'
        'meta_query'    => array(
            'relation'      => 'AND', 
            array(
                'key'       => 'categorie-acf',
                // 'compare'   => 'LIKE', 
                // 'value'     =>  $categorie_id,
            ),
            array(
                'key'       => 'format-acf',
              //   'compare'   => 'LIKE',
              //   'value'     => $format_id,
            )
            ),
        'nopaging' => false,
            );
            //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
            $query = new WP_Query( $custom_args );
            
            echo $query->found_posts . " articles trouvés"; 
            
            ?>
            <!-- On vérifie si le résultat de la requête contient des articles -->
            <?php if($query->have_posts()) : ?>
            <article class="container-news flexrow">
                <!-- On parcourt chacun des articles résultant de la requête -->
                <?php while($query->have_posts()) : ?>
                    <?php $query->the_post();?> 
                    
                    <?php if(has_post_thumbnail()) : ?>

                    <?php
                        // Récupérer la taxonomie ACF actuelle
                        $term = get_queried_object();                                              
                        $term_id  = my_acf_load_value('ID', $term);
                        // Récupération du nom de la catégorie 
                        $categorie  = my_acf_load_value('name', get_field('categorie-acf')); 
                    ?>

                    <!-- Génération du nombre de photo en fonction de l'option dans WordPress -->
                    <div class="news-info">
                        <h2 class="info-title"><?php the_title(); ?></h2>
                        <p class="info-tax"><?php echo $categorie; ?></p>
                        <!-- <p class="info-tax"><?php the_terms( $post->ID, 'categorie-acf', '' ); ?></p> -->
                        <a href="<?php the_permalink() ?>">
                        <?php the_post_thumbnail(); ?>
                        <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><span class="detail-photo"></span></a>                            
                        <span class="open-lightbox"></span>
                    <?php endif; ?>                  
                    <br><br>
                    </div>
                <?php endwhile; ?>
            </article>
        <div id="pagination">
            <!-- afficher le système de pagination (s’il existe de nombreux articles) -->
            <h3>Articles suivants</h3>
            <?php 
            $currentPage = max( 1, get_query_var( 'paged', 1 ) );        
            $pages = range( 1, max( 1, $query->max_num_pages ) );

            $args = array(
                'format' => '?paged=%#%',
                'current' => $currentPage,
                'total' => $query->max_num_pages,
                "page" => $page,
                "url" => get_pagenum_link( $page )
            ); 

            echo paginate_links(' $args' );
            ?>
        </div>
        <?php else : ?>
        <p>Désolé, aucun article ne correspond à cette requête</p>  
        
        
        <?php endif; 

        // On réinitialise à la requête principale
        wp_reset_query(); ?>

      </section>

      <!-- <aside id="sidebar">
      </aside> -->
  </div>

<?php get_footer(); ?>
