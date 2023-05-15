<?php
// Gestion des filtres d'affichage
?>

<div class="filter-area">
    <!-- <i class="fa-solid fa-caret-down"></i> -->
    <!-- <i class="fa-solid fa-caret-up"></i> -->
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
    <form class="flexrow" method="post" action="">
        <div class="filterleft flexrow">
            <div class="select-filter flexcolumn">            
                <span class="myarrow"></i></span>
                <p>catégories</p>
                <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
                <select class="option-filter" name="categorie">
                    <option value="" selected></option>
                    <!-- Récupération de la liste des catégories -->
                    <?php
                        $categorie_acf = get_terms('categorie-acf', array('hide_empty' => false)); 
                        foreach ( $categorie_acf as $terms) : 
                    ?>
                    <option value="<?php echo $terms->slug; ?>"><?php echo $terms->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <input type="submit" value="catergorie" title="Catégorie" /> -->
            </div>
            <div class="select-filter flexcolumn">          
                <span class="myarrow"></span>
                <p>formats</p>
                <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
                <select class="option-filter" name="format">
                    <option value="" selected></option>
                    <!-- Récupération de la liste des formats -->
                    <?php
                        $format_acf = get_terms('format-acf', array('hide_empty' => false)); 
                        foreach ( $format_acf as $terms) : 
                    ?>
                    <option value="<?php echo $terms->slug; ?>"><?php echo $terms->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <input type="submit" value="format" title="Format" /> -->
            </div>
        </div>
        <div class="filterright flexrow">
            <div class="select-filter flexcolumn">          
                <span class="myarrow"></span>
                <p>trier par</p>
                <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
                <select class="option-filter" name="order">
                    <option value="" selected></option>
                    <option value="asc">nouveauté</option>
                    <option value="desc">Les plus anciens</option>
                </select>
                <!-- <input type="submit" value="order" title="Date" /> -->
            </div>
        </div>
    </form>
</div>
