<style>
    
    @font-face {
        font-family: addon-lato;
        src: url(https://localhost/my-fmes/wp-content/themes/govpress-child-v2/font/Lato.ttf); 
    }
    @font-face {
        font-family: addon-saira;
        src: url(https://localhost/my-fmes/wp-content/themes/govpress-child-v2/font/Saira-Light.ttf);
}
    
    :root {
        --color-first: #6ec1e4;
        --color-title: #54595f;
        --color-sub: #7a7a7a;
        --color-reflexion: #00479B;
        --color-formation: #FABB11;
        --color-appui: #D13246;
        --color-institut: #14B2BA;
    }

    ul {
        list-style: none;
    }

    div.addon-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        height: 170px;
        margin: 10px 10px;
        padding: 10px 10px !important;
        border: 1px solid var(--color-title) !important;
        border-radius: 10px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);
    }

    .addon-image {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 150px;
        max-height: 150px;
    }

    .addon-inside {
        width: 800px;
        /* proportionnel au nb col bootstrap */
        margin: 10px 10px 10px 20px !important;
        padding: 10px 10px 10px 30px;
        border-left: 2px solid var(--color-first);
    }

    h3.addon-title {
        font-family: addon-lato;
        font-size: 18px !important;
    }

    h3.addon-title a {
        color: var(--color-title) !important;
    }

    .addon-icon {
        font-family: addon-saira !important;
        display: inline-flex;
        align-items: center;
        margin-right: 20px;
    }

    #content a {
        color: var(--color-sub) !important;
    }

    #content h3 a {
        color: var(--color-title) !important;
    }

    i {
        color: var(--color-first);
        margin-right: 14px;
    }
</style>

<?php
    // Construction  d'elements

    $out = array();
    if (!empty($args['authors_list'])) {
        // $out[]= "<ul>";
        foreach ($args['authors_list'] as $term) {
            $out[] = sprintf(
                '<a href="%1$s">%2$s</a>',
                esc_url(get_term_link($term->slug, 'auteurs')),
                esc_html($term->name)
            );
        }
        // $out[] = "</ul>\n";
    }
    $element_auteur= implode( ',', $out );

    $element_date = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url(site_url().'/'.get_the_date( 'Y/m/d')),
        esc_html(get_the_date('j F Y'))
    );
?>

<div class="col-12">
    
    <div class="addon-container">

        <div class="">
            <?php the_post_thumbnail('medium', ['class' => 'addon-image', 'alt' => '', 'style' => 'height:auto']) ?>
        </div>

        <div class="addon-inside">
            <h4>
                <span class="addon-icon">
                    <i class="fas fa-tags"></i>
                    <?php the_category(", ") ?>
                </span>
            </h4>
            <br>
            <h3 class="addon-title">
                <a href="<?= the_permalink() ?>"><?php the_title() ?></a>
            </h3>
            <br>
            <h4>
                <span class="addon-icon">
                    <i class="fas fa-pen-nib"></i>
                    <?= $element_auteur ?>
                </span>
                <span class="addon-icon">
                    <i class="far fa-calendar-alt"></i>
                    <?= $element_date ?>
                </span>
            </h4>
        </div>
    </div>
</div>