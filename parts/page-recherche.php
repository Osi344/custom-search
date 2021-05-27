<?php

/*
Template Name: fmes2021-recherche
*/

// doubles f en préxixe de certaines varaiables / variables réservées
// $fargs

define("CS_DIR", 'custom-search');
require_once(CS_DIR . '\class\term-child.php');

function cs_get_terms($cs_tax, $plus)
{
    return get_terms([
        'taxonomy' => $cs_tax,
        'hide_empty' => 'false',
        'parent' => $plus,
        // 'parent' => 0, seulement les termes de 1er rang
    ]);
}

// variable de test des arguments de la requete

$is_searched = count($_GET);

// Recuperation des termes de chaque taxonomie

$supports = cs_get_terms('support', 0);
$langues = cs_get_terms('langue', 0);
$auteurs = cs_get_terms('auteurs', 0);
$terms_parent = cs_get_terms('category', 0);



function test_get_childs ($all,$tax){

    $result= [];
    foreach ($all as $tp) :

    endforeach;
}

function get_childs($all,$tax){

    // $result= [];
    foreach ($all as $tp) :

        if ($tp->parent == 0) :
            $result[$tp->term_id] = new TermChild($tp);
            $cs_childs_ids = get_term_children($tp->term_id, $tax);
    

            if (count($cs_childs_ids)) :

                $count= 0;
                foreach ($cs_childs_ids as $cs_child_id) :
                    $cs_childs= get_term_by('term_id', $cs_child_id, $tax);

                    // test si l'objet parent existe et limite au 2nd degré de catégorie
                    if ($result[$cs_childs->parent]) {
                        $result[$cs_childs->parent]->addChild($cs_childs);
                    }
 
                endforeach;
            endif;
        endif;
    endforeach;
    return $result;
}

$fmes2021_terms = get_childs($terms_parent, 'category');
?>
<!-- <pre> -->
    <?php //print_r($fmes2021_terms) ?>
<!-- </pre> -->
<?php


// Recuperation des post_formats
$formats = array(
    // [
    //     'name' => 'Article',
    //     'slug'=> '' 
    // ],
    [
        'name' => 'Podcast',
        'slug' => 'audio'
    ],
    [
        'name' => 'Video',
        'slug' => 'video'
    ],
);

?>

<!-- convention name == celui de la taxonomie -->

<?php get_header() ?>

<div class="container m-2">


    <?php //testing($thematiques); 
    ?>

    <form action="<?= esc_url(home_url('/fmes2021-page-recherche/')); ?>">

        <div class="form-group">
            <label for="champ-recherche">Votre recherche</label>
            <input type="search" class="form-control" id="champ-recherche" name="champ-recherche" value="<?= isset($_GET['champ-recherche']) ? $_GET['champ-recherche'] : '' ?>" placeholder="champ de recherche">
        </div>

        <div class="osi-group">
            <!-- name == date  !!! format splité ou tableau-->
            <?php get_template_part(CS_DIR . '/parts/form', 'date', []); ?>

            <!-- name == langue -->
            <?php get_template_part(CS_DIR . '/parts/form', 'langue', ['terms' => $langues]); ?>

            <!-- name == support -->
            <?php get_template_part(CS_DIR . '/parts/form', 'support', ['terms' => $supports]); ?>

            <!-- name == auteur -->
            <?php get_template_part(CS_DIR . '/parts/form', 'auteurs', ['terms' => $auteurs]); ?>
        </div>

        <!-- name == format -->
        <?php //get_template_part(CS_DIR .'/parts/form-format','format', ['terms'=> $formats]); 
        ?>

        <?php get_template_part(CS_DIR . '/parts/form', 'category', ['terms' =>  $fmes2021_terms]); ?>

        <a href="<?= home_url('/fmes2021-page-recherche') ?>">Réinitialiser la recherche</a>
        <br>

        <div class="form-group">
            <input type="submit" class="btn btn-lg btn-block fa search-submit" value="&#xf002;" />
        </div>

    </form>
</div>


<?php

// initialisation tableau d'arguments de la QUERY

$fargs = [
    'post_type' => 'post',
    'posts_per_page' => 0,
    'tax_query' => [
        // 'relation' => 'AND'
    ],
    'meta_query' => [
        'relation' => 'AND'
    ]
];

// Ajout du contenu CHAMP-RECHERCHE aux arguments de la QUERY

if (isset($_GET['champ-recherche'])) {
    if (!empty($_GET['champ-recherche'])) {
        $fargs['s'] = sanitize_text_field($_GET['champ-recherche']);
    }
}


// Ajout du contenu DATE aux arguments de la QUERY

$fargs['date_query'] = [
    'year' => isset($_GET['year']) ? $_GET['year'] : '',
    'month' => isset($_GET['month']) ? $_GET['month'] : '',
    'day' => isset($_GET['day']) ? $_GET['day'] : '',
];



// Ajout du contenu LANGUE aux arguments de la QUERY

if (isset($_GET['langue'])) {
    if (!empty($_GET['langue'])) : ?>

    <?php
        $fargs['tax_query'][] = [
            'taxonomy' => 'langue',
            'field' => 'slug',
            'terms' => array(sanitize_text_field($_GET['langue'])),
        ];

    endif;
}

// Ajout du contenu LANGUE aux arguments de la QUERY

if (isset($_GET['format'])) :
    if (!empty($_GET['format'])) :

        $fargs[] = [
            'post_format' => sanitize_text_field($_GET['format']),
        ];

    endif;
endif;

// Ajout du contenu SUPPORT aux arguments de la QUERY

if (isset($_GET['support'])) {
    if (!empty($_GET['support'])) : ?>

    <?php
        $fargs['tax_query'][] = [
            'taxonomy' => 'support',
            'field' => 'slug',
            'terms' => array(sanitize_text_field($_GET['support'])),
        ];

    endif;
}

// Ajout du contenu AUTEUR aux arguments de la QUERY

if (isset($_GET['auteur'])) {
    if (!empty($_GET['auteur'])) : ?>

    <?php
        $fargs['tax_query'][] = [
            'taxonomy' => 'auteurs',
            'field' => 'slug',
            'terms' => array(sanitize_text_field($_GET['auteur'])),
        ];

    endif;
}
?>

<?php
// Ajout du contenu THEMATIQUE aux arguments de la QUERY

// if (isset($_GET['thematique'])) {
//     if (!empty($_GET['thematique'])) :
  
//         $fargs['tax_query'][] = [
//             'taxonomy' => 'thematique',
//             'field' => 'slug',
//             'terms' => $_GET['thematique'], // deja du type tableau
//         ];

//     endif;
// }
?>

<?php
// Ajout du contenu CATEGORY aux arguments de la QUERY

if (isset($_GET['category'])) {
    if (!empty($_GET['category'])) :
    
        $fargs['tax_query'][] = [
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $_GET['category'], // deja du type tableau
        ];

    endif;
}
?>

<?php

// test de la query

if ($is_searched) {
    $query = new WP_Query($fargs);
}

if ($is_searched) :
    // $format = has_post_format($format, $post_id);

    // test des posts resultats
?>
    <!-- <pre> -->
    <?php 
        //print_r($query); 
    ?>
    <!-- </pre> -->
    <?php

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
        // fonction pagination
    <?php else :
    ?>
        <div class="clearfix mb-3"></div>
        <div class="alert alert-secondary">Il n'y a pas de résultat</div>
<?php
    endif;
endif;


?>