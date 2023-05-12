<?php 
   // [post_type] => post
   // [post_type] => photo
   // On place les critères de la requête dans un Array
   $term = get_queried_object();
   $publication = get_queried_object_id();

   // Récupération du n° de la catégorie pour filtrage
   $categorie_id  =  get_post_meta( get_the_ID(), 'categorie-acf', true );
   // $categorie_name  = my_acf_load_value('name', get_field('categorie-acf'));
     
   // echo($post_type_photo);
   $custom_args = array(
      'post_type' => 'photo',
      'posts_per_page' => 2,
      'orderby'   => 'rand',
      // 'category' => 'Catégorie',
      // 'category_name' => $categorie, 
      'meta_key' => 'categorie-acf',
      'meta_value' => $categorie_id,
      'compare'   => 'LIKE', // NOT LIKE
      'post__not_in' => array($publication),
   );
   
   //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
   $query = new WP_Query( $custom_args );

   // Affichage du nombre d'articles trouvés avec le filtre
   //   echo $query->found_posts . " articles trouvés"; 
  
?>
 <!-- On vérifie si le résultat de la requête contient des articles -->
  <?php if($query->have_posts()) : ?>
   <div class="container-common flexrow">
<!-- On parcourt chacun des articles résultant de la requête -->
       <?php while($query->have_posts()) : ?>
           <?php $query->the_post();?> 
           
           <div class="news">
               <?php if(has_post_thumbnail()) : ?>
                  <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"><?php the_post_thumbnail('desktop-home'); ?><span class="detail-photo"></span></a>
                  <?php endif; ?>
            </div>
       <?php endwhile; ?>
   </div>
<?php else : ?>
   <p>Désolé, aucun article ne correspond à cette requête</p>  
<?php endif; 
   // On réinitialise à la requête principale
  wp_reset_query();

?>


