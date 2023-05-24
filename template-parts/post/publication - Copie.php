<?php
/**
 * Modal publication
 *
 * @package WordPress
 * @subpackage nathalie-motta theme
 */
?>
            
        <?php  
        // Récupération des paramètres de filtre dans l'url
        if (isset($_GET["categorie"])) {
            $categorie_id = $_GET["categorie"];
        } else {
            $categorie_id = "";
        }; 
        if (isset($_GET["format"])) {
            $format_id = $_GET["format"];
        } else {
            $format_id = "";
        };  
        if (isset($_GET["date"])) {
            $order = $_GET["date"];
        } else {
            $order = "";
        }; 

        if ($order === "") {
            $orderby = "title";
            $order = "ASC";
        } else {            
            $orderby = "date";
        }

        // Initialisation du filtre d'affichage des posts
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

        $categorie_name  = my_acf_load_value('name', get_field('categorie-acf'));
        $format_name = my_acf_load_value('name', get_field('format-acf'));
        $custom_args = array(
        'post_type' => 'photo',
        // 'posts_per_page' => 8,
        'posts_per_page' => get_option( 'posts_per_page'), // Valeur par défaut
        'order' => $order, // ASC ou DESC 
        'orderby' => $orderby, // 'date' , 'title', 'meta_value_num'
        'paged' => $paged,
        'meta_query'    => array(
            'relation'      => 'AND', 
            array(
                'key'       => 'categorie-acf',
                'compare'   => 'LIKE', // BETWEEN LIKE < > != >= <=
                'value'     =>  $categorie_id,
            ),
            array(
                'key'       => 'format-acf',
                'compare'   => 'LIKE',
                'value'     => $format_id,
            )
            ),
        // 'nopaging' => false,
            );
            //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
            $query = new WP_Query( $custom_args );
            
            $nb_article = $query->found_posts;
            echo $nb_article . " articles trouvés"; 
                        
            $qt = 0;
            ?>
            <!-- On vérifie si le résultat de la requête contient des articles -->
            <?php if($query->have_posts()) : ?>
                <article class="publication-list container-news flexrow">
                    <!-- On parcourt chacun des articles résultant de la requête -->
                    <?php while($query->have_posts()) : $query->the_post(); ?>
                            <!-- Génération du nombre de photo en fonction de l'option dans WordPress -->
                            <div class="news-info brightness">
                                <h2 class="info-title"><?php the_title(); ?></h2>
                                <h3 class="info-tax"><?php echo $categorie_name; ?></h3>
                                <a href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail(); ?>
                                <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><span class="detail-photo"></span></a>                            
                                <span class="openLightbox"></span>
                            </div>      
                            <div class="lightbox hidden">                
                                    <?php the_post_thumbnail('large'); ?>
                            </div>                   
                            <?php 
                            // get_template_part('template-parts/post/publication');
                            $qt += 1;
                        endwhile; 
                    ?>
                </article>

                <div id="pagination">
                    <!-- afficher le système de pagination (s’il existe de nombreux articles) -->
                    <!-- <h3>Articles suivants</h3> -->
                    <!-- Load more -->
                    <a href="#!" class="btn btn__primary" id="load-more">          
                        <?php 
                            echo($nb_article);
                            echo(" / ");
                            echo($qt);
                        ?>
                    </a> 
                </div>
            <?php else : ?>
                <p>Désolé. Aucun article ne correspond à cette requête.</p>          
            
            <?php endif; ?>
        <?php
        // On réinitialise à la requête principale
        // wp_reset_query(); 
        wp_reset_postdata();       
        ?>
        
        <!-- <button
            class="js-load-comments"
            data-postid="<?php echo get_the_ID(); ?>"
            data-nonce="<?php echo wp_create_nonce('capitaine_load_comments'); ?>"
            data-action="capitaine_load_comments"
            data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>"
        >Charger les commentaires</button> -->
