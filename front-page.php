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
        // Récupérer la taxonomie actuelle
        $term = get_queried_object();
        $term_id  = my_acf_load_value('ID', $term);
        $count = 0;

        // $categorie_id  =  get_post_meta( get_the_ID(), 'categorie-acf', true );
        // $format_id  =  get_post_meta( get_the_ID(), 'format-acf', true );
        // $categorie_name  = my_acf_load_value('name', get_field('categorie-acf'));
        // $format_name = my_acf_load_value('name', get_field('format-acf'));
        $custom_args = array(
        'post_type' => 'photo',
        // 'posts_per_page' => 8,
        'posts_per_page' => get_option( 'posts_per_page'), // Valeur par défaut
        'order' => $order, // ASC ou DESC 
        'orderby' =>  $orderby, // 'date' , 'meta_value_num'
        'paged' => 1,
        'meta_query'    => array(
            'relation'      => 'AND', 
            array(
                'key'       => 'categorie-acf',
                'compare'   => 'LIKE', 
                'value'     =>  $categorie_id,
            ),
            array(
                'key'       => 'format-acf',
                'compare'   => 'LIKE',
                'value'     => $format_id,
            )
            ),
            'nopaging' => false,
            );            
            //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
            $query = new WP_Query( $custom_args ); 
            
            // Création du filtre pour la ligh pour créer un tableau 
            // avec la liste de toutes les photos correspondant aux filtres
            $custom_args2 = array_replace($custom_args, array( 'posts_per_page' => -1, 'nopaging' => true,));

            $total_posts = get_posts( $custom_args2 );
            $nb_total_posts = count($total_posts);
            
            // echo $query->found_posts . " articles trouvés"; 
            $max_pages = $query->max_num_pages;
                        
            ?>
            <!-- On vérifie si le résultat de la requête contient des articles -->
            <?php if($query->have_posts()) : ?>
                <article class="publication-list container-news flexrow">
                    <!-- On parcourt chacun des articles résultant de la requête -->
                    <?php while($query->have_posts()) : $query->the_post(); 
                            $count++;                
                            get_template_part('template-parts/post/publication');
                        endwhile; 
                    ?>
                </article>
            <?php else : ?>
                <p>Désolé. Aucun article ne correspond à cette requête.</p>          
            
            <?php endif; ?>
        
        <?php
        // On réinitialise à la requête principale
        // wp_reset_query(); 
        wp_reset_postdata();       
        ?>
        
        <div id="pagination">
            <!-- afficher le système de pagination (s’il existe de nombreux articles) -->
            <!-- <h3>Articles suivants</h3> -->
            <?php if ($max_pages > 1): ?>
                <!-- Variables qui vont pourvoir être récupérées par JavaScript -->
                <form>
                    <input type="hidden" name="total_posts" id="total_posts" value="<?php print_r( $total_posts); ?>">
                    <input type="hidden" name="nb_total_posts" id="nb_total_posts" value="<?php  echo $nb_total_posts; ?>">
                    <input type="hidden" name="categorie_id" id="categorie_id" value="<?php echo $categorie_id; ?>">
                    <input type="hidden" name="format_id" id="format_id" value="<?php echo $format_id; ?>">
                    <input type="hidden" name="orderby" id="orderby" value="<?php echo $orderby; ?>">
                    <input type="hidden" name="order" id="order" value="<?php echo $order; ?>">
                    <input type="hidden" name="max_pages" id="max_pages" value="<?php echo $max_pages; ?>">
                    <button class="btn_load-more" id="load-more">Charger plus</button>
                </form>
                
                <!-- <a href="#" class="btn_load-more" id="load-more">Charger plus</a> -->
                <span class="camera"></span>
            <?php endif ?>
        </div>

      </section>
      

  </div>
<?php get_footer(); ?>

<?php 
    // print_r($my_posts); 
    // echo('<br><br>') 
    // print_r($my_posts[1]); 
    // echo('<br><br>') 
    // print_r($my_posts[1]->post_title); 
    // echo('<br><br>') 
    // echo(count($my_posts). " / ". $count)
    // echo('<br><br>')
 ?>
