<?php
// Gestion des filtres d'affichage
?>

<div class="filter-area flexrow">
    <form class="filterleft flexrow" method="post" action="">
        <div class="select-filter flexcolumn">            
            <span class="myarrow"></span>
            <p>catégories</p>
            <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
            <select class="option-filter" name="categorie">
                <option value="" selected></option>
                <option value="mariage">mariage</option>
                <option value="soiree-rentreprise">soirée entreprise</option>
                <option value="anniversaire">anniversaire</option>
                <option value="evénement">évenement</option>
            </select>
            <!-- <input type="submit" value="catergorie" title="Catégorie" /> -->
        </div>
        <div class="select-filter flexcolumn">          
            <span class="myarrow"></span>
            <p>formats</p>
            <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
            <select class="option-filter" name="format">
                <option value="" selected></option>
                <option value="portrait">portrait</option>
                <option value="paysage">paysage</option>
                <option value="1-1">1/1</option>
                <option value="a4">a4</option>
            </select>
            <!-- <input type="submit" value="format" title="Format" /> -->
        </div>
    </form>
    <form class="filterright flexrow " method="post" action="">
        <div class="select-filter flexcolumn">          
            <span class="myarrow"></span>
            <p>trier par</p>
            <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
            <select class="option-filter" name="date">
                <option value="" selected></option>
                <option value="asc">nouveauté</option>
                <option value="desc">Les plus anciens</option>
            </select>
            <!-- <input type="submit" value="date" title="Date" /> -->
        </div>
    </form>
</div>
