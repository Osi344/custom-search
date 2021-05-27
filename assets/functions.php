<?php

/**
 ** activation theme
 **/

// add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
// function theme_enqueue_styles() {
// wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
// }


/**
 * Rename product data tabs
 */
// add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
// function woo_rename_tabs( $tabs ) {

// $tabs['description']['title'] = __( 'Lire' );		// Rename the description tab

// return $tabs;

// }


/**
 * Remove "Description" Heading Title @ WooCommerce Single Product Tabs
 */
// add_filter( 'woocommerce_product_description_heading', '__return_null' );

/* Ne pas afficher l'UGS sur vos pages produits */

// add_filter( 'wc_product_sku_enabled', 'wpm_remove_sku' );

// function wpm_remove_sku( $enabled ) {
// if ( !is_admin() && is_product() ) {
// return false;
// }
// return $enabled;
// }

/**
 * Remove Sidebar on Woocommerce pages
 */
// if ( !is_woocommerce() ) {
// get_sidebar();
// }

/**
 * Modification ‘Produits apparentés’ en ‘Articles similaires’
 */

// function wpm_traduction($texte) { 
// $texte = str_ireplace('Produits apparentes', 'Articles similaires', $texte); 
// return $texte; 
// } 

// add_filter('gettext', 'wpm_traduction'); 
// add_filter('ngettext', 'wpm_traduction');

// +++++ fmes2021 +++++

function fmes2021_init()
{

    // Ajout des taxonomies 'supports', 'langues', 'auteurs'

    $supportLabels = [
        'name'          => 'Support',
        'singular_name' => 'Support',
        'plural_name'   => 'Supports',
        'search_items'  => 'Rechercher des supports',
        'all_items'     => 'Tous les supports',
        'edit_item'     => 'Editer le support',
        'update_item'   => 'Mettre à jour le support',
        'add_new_item'  => 'Ajouter un nouveau support',
        'new_item_name' => 'Changer le nom du support',
        'menu_name'     => 'Support',
    ];

    $langueLabels = [
        'name'          => 'Langue',
        'singular_name' => 'Langue',
        'plural_name'   => 'Langues',
        'search_items'  => 'Rechercher des langues',
        'all_items'     => 'Toutes les langues',
        'edit_item'     => 'Editer la langue',
        'update_item'   => 'Mettre à jour la langue',
        'add_new_item'  => 'Ajouter une nouvelle langue',
        'new_item_name' => 'Changer le nom de la langue',
        'menu_name'     => 'Langue',
    ];

    $auteursLabels = [
        'name'          => 'Auteurs',
        'singular_name' => 'Auteur',
        'plural_name'   => 'Auteurs',
        'search_items'  => 'Rechercher des Auteurs',
        'all_items'     => 'Tous les Auteurs',
        'edit_item'     => 'Editer l\'Auteur',
        'update_item'   => 'Mettre à jour l\'Auteur',
        'add_new_item'  => 'Ajouter un nouvel Auteur',
        'new_item_name' => 'Changer le nom de l\'Auteur',
        'menu_name'     => 'Auteurs',
    ];

    register_taxonomy('support', 'post', [
        'labels'        => $supportLabels,
        'show_in_rest'  => 'true',
        'hierarchical'  => 'true',
        'show_admin_column' => 'true'
    ]);

    register_taxonomy('langue', 'post', [
        'labels'        => $langueLabels,
        'show_in_rest'  => 'true',
        'hierarchical'  => 'true',
        'show_admin_column' => 'true'
    ]);

    register_taxonomy('auteurs', 'post', [
        'labels'        => $auteursLabels,
        'show_in_rest'  => 'true',
        'hierarchical'  => 'true',
        'show_admin_column' => 'true'
    ]);
}

add_action('init', 'fmes2021_init');

function fmes2021_registrer_assets()
{
    wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts', 'fmes2021_registrer_assets', 10);

add_action('rest_api_init', function () {

    register_rest_route('osi/', '/post/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => function (WP_REST_Request $request) {
            $postID = (int)$request->get_param('id');
            $post = get_post($postID);
            if ($post === null) {
                return new WP_Error('Rien', 'On a rien à dire', ['status' => 404]);
            }
            // return $post->post_title;
            return $post;
        },
        // 'permission_callback' => function(){
        //     return current_user_can('edit_posts');
        // },
    ]);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('govpress-child-v2', get_stylesheet_uri());
});

// add_action('after_setup_theme', function(){
//     add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link','audio' ) );
// }, 10);

// Enable support for Post Formats.

// +++++ fmes2021 +++++
// +++++ Custom Search +++++

define("CS_DIR", 'custom-search');
require_once(CS_DIR . '\class\term-child.php');

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

function cs_get_terms($cs_tax, $plus)
{
    return get_terms([
        'taxonomy' => $cs_tax,
        'hide_empty' => 'false',
        'parent' => $plus,
        // 'parent' => 0, seulement les termes de 1er rang
    ]);
}

function wporg_recursive_sanitize_text_field( $array ) {
    foreach ( $array as $key => &$value ) {
        if ( is_array( $value ) ) {
            $value = wporg_recursive_sanitize_text_field( $value );
        } else {
            $value = sanitize_text_field( $value );
        }
    }
    return $array;
}

function search_query()
{
    // initialisation pagination
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // initialisation tableau d'arguments de la QUERY

    $fargs = [
        'paged' => $paged,
        'post_type' => 'post',
        'posts_per_page' => 6,
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
        if (!empty($_GET['langue'])) :

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
        if (!empty($_GET['support'])) :

            $fargs['tax_query'][] = [
                'taxonomy' => 'support',
                'field' => 'slug',
                'terms' => array(sanitize_text_field($_GET['support'])),
            ];

        endif;
    }

    // Ajout du contenu AUTEUR aux arguments de la QUERY

    if (isset($_GET['auteur'])) {
        if (!empty($_GET['auteur'])) :

            $fargs['tax_query'][] = [
                'taxonomy' => 'auteurs',
                'field' => 'slug',
                'terms' => array(sanitize_text_field($_GET['auteur'])),
            ];

        endif;
    }

    // Ajout du contenu CATEGORY aux arguments de la QUERY

    if (isset($_GET['category'])) {
        if (!empty($_GET['category'])) :

            $fargs['tax_query'][] = [
                'taxonomy' => 'category',
                'field' => 'slug',
                // 'terms' => $_GET['category'], // deja du type tableau
                // 'terms' => array(sanitize_text_field($_GET['category'])),
                'terms' => wporg_recursive_sanitize_text_field($_GET['category']),
            ];

        endif;
    }

    return new WP_Query($fargs);
}
