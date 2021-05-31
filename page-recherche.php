<?php

/*
Template Name: fmes2021-page-recherche
*/

// doubles f en préxixe de certaines varaiables / variables réservées
// $fargs


// variable de test des arguments de la requete

$is_searched = count($_GET);

// Recuperation des termes de chaque taxonomie

$supports = cs_get_terms('support', 0);
$langues = cs_get_terms('langue', 0);
$auteurs = cs_get_terms('auteurs', 0);
$terms_parent = cs_get_terms('category', 0);

// function sanitize... functions.php

$fmes2021_terms = get_childs($terms_parent, 'category');

// test de la query

if ($is_searched) {
    $query = search_query();
}
?>

<!-- convention name == celui de la taxonomie -->

<?php get_header() ?>

<div id="page-recherche"class="container">

    <form id="form-recherhe" action="<?= esc_url(home_url('/fmes2021-page-recherche/')); ?>" class="row">

        <div class="form-group col-12 col-md-6">
            <label for="champ-recherche">Votre recherche</label>
            <input type="search" class="form-control" id="champ-recherche" name="champ-recherche" value="<?= isset($_GET['champ-recherche']) ? $_GET['champ-recherche'] : '' ?>" placeholder="champ de recherche">
        </div>

        <!-- name == date -->
        <?php get_template_part(CS_DIR . '/parts/form', 'date', []); ?>

        <div class="form-recherche-group col-12">

            <div class="form-group">
                <ul class="form-date-ul row">

                    <!-- name == langue -->
                    <?php get_template_part(CS_DIR . '/parts/form', 'langue', ['terms' => $langues]); ?>

                    <!-- name == support -->
                    <?php get_template_part(CS_DIR . '/parts/form', 'support', ['terms' => $supports]); ?>

                    <!-- name == auteur -->
                    <?php get_template_part(CS_DIR . '/parts/form', 'auteurs', ['terms' => $auteurs]); ?>
                </ul>
            </div>
        </div>

        <?php get_template_part(CS_DIR . '/parts/form', 'category', ['terms' =>  $fmes2021_terms]); ?>


        <div class="form-group col-12">
            <a href="<?= home_url('/fmes2021-page-recherche') ?>">Réinitialiser la recherche</a>
            <br>
            <input type="submit" class="btn btn-lg btn-block fa search-submit" value="&#xf002;" />
        </div>

    </form>
</div>

<?php

if ($is_searched) :
    // $format = has_post_format($format, $post_id);

    // test des posts resultats

    if ($query->have_posts()) : ?>

        <div class="row">

            <!-- la boucle -->

            <?php while ($query->have_posts()) : $query->the_post(); ?>
                
                <!-- custom card as elementor fme2021-carte-paysage- -->
                <?php 
                    $authors_list= get_the_terms($post->ID, 'auteurs'); 
                ?>
                
                <?php
                    get_template_part(CS_DIR . '/parts/card', 'search-result', ['authors_list' => $authors_list]); 
                ?>

            <?php endwhile;

            wp_reset_postdata(); ?>
        </div>
        <div class="pagination">
            <?php 
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $query->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'list',
                    'end_size'     => 0,
                    'mid_size'     => 1,
                    'prev_next'    => true,
                    'prev_text'    => sprintf( '<i class="fas fa-circle-left"></i> %1$s', __( 'Précédent', 'text-domain' ) ),
                    'next_text'    => sprintf( '%1$s <i class="fas fa-circle-right">', __( 'Suivant', 'text-domain' ) ),
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );
            ?>
        </div>

    <?php else : ?>
        <div class="clearfix mb-3"></div>
        <div class="alert alert-secondary">Il n'y a pas de résultat</div>
    <?php endif;
endif; ?>