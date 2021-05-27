<?php
    // Construction  d'elements

    $out = array();
    if (!empty($args['authors_list'])) {
        foreach ($args['authors_list'] as $term) {
            $out[] = sprintf(
                '<a href="%1$s">%2$s</a>',
                esc_url(get_term_link($term->slug, 'auteurs')),
                esc_html($term->name)
            );
        }
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
            <?php //the_post_thumbnail('medium', ['class' => 'addon-image', 'alt' => '', 'style' => 'height:auto']) ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php 
                if ( has_post_thumbnail() ) :
                    the_post_thumbnail('medium', ['class' => 'addon-image', 'alt' => '', 'style' => 'height:auto']);
                else :
                    echo '<img src="https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-300x169.jpg" class="addon-image wp-post-image" alt="" loading="lazy" style="height:auto" srcset="https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-300x169.jpg 300w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-e1608221919938-600x338.jpg 600w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-1024x576.jpg 1024w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-768x432.jpg 768w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-500x281.jpg 500w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-800x450.jpg 800w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-1280x720.jpg 1280w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-1536x864.jpg 1536w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-1320x743.jpg 1320w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-400x225.jpg 400w, https://localhost/my-fmes/wp-content/uploads/2020/11/boussole-strategique-jpeg-1-e1608221919938.jpg 640w" sizes="(max-width: 300px) 100vw, 300px" width="300" height="169">';
                endif; 
                ?>
            </a>
        </div>

        <div class="addon-inside">
            <h4>
                <span class="addon-icon">
                    <i class="fas fa-tags"></i>
                    <?php the_category('&nbsp|&nbsp') ?>
                </span>
            </h4>
            <br>
            <h3 class="addon-title">
                <a href="<?= the_permalink() ?>"><?php the_title() ?></a>
            </h3>
            <br>
            <h4>
                <?php if ($element_auteur != "") :?>
                    <span class="addon-icon">
                        <i class="fas fa-pen-nib"></i>
                        <?= $element_auteur ?>
                    </span>
                <?php endif ?>
                <span class="addon-icon">
                    <i class="far fa-calendar-alt"></i>
                    <?= $element_date ?>
                </span>
            </h4>
        </div>
    </div>
</div>