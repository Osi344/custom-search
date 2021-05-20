<style>
    @font-face {
        font-family: addon-saira;
        src: url(./font/Saira.ttf);
    }

    @font-face {
        font-family: addon-lato;
        src: url(./font/Lato.ttf);
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

    .addon-inside{
        width: 800px; /* proportionnel au nb col bootstrap */
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
        display: inline-flex;
        align-items: center;
        
    }
    #content a {
        font-family: addon-saira !important;
        color: var(--color-sub) !important;
        /* color:  #7A7A7A !important; */
    }

    #content h3 a {
        font-family: addon-lato !important;
        color: var(--color-title) !important;
        /* color:  #54595F !important; */
    }

    i {
        color: var(--color-first);
        margin-right: 14px;
    }
</style>

<div class="col-12">
    <!-- <pre> -->
        <?php 
        // print_r($post_auteur); 
        ?>
    <!-- </pre> -->
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
                    <?= $args['post-auteur'] ?>
                </span>
                <span class="addon-icon">
                    <i class="far fa-calendar-alt"></i>
                    <?php the_date('j F Y') ?>
                </span>
            </h4>
            <!-- <h6 class="addon-author"><?php the_author() ?> - </h6> -->

        </div>
    </div>
</div>