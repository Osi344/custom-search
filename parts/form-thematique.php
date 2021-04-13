<div class="form-group">
    <label for="select-thematique">Thématique</label>
    <div class="osi-grid-container">
        <?php foreach ($args['terms'] as $tte) : ?>
            <!-- <div class="osi-group col-2"> -->
            <div class="<?php
                $class = '';
                switch ($tte->slug):
                    case 'actualites':
                        $class = 'grid-L0';
                        break;
                    case 'medias':
                        $class = 'grid-L1';
                        break;
                    case 'recherches':
                        $class = 'grid-L2';
                        break;
                    case 'formations':
                        $class = 'grid-M0';
                        break;
                    case 'prospectives':
                        $class = 'grid-R0';
                        break;
                endswitch;
                $class .= ' osi-checkbutton';
                echo $class;
                ?>">
                <?php
                    echo '<input type="checkbox" name="thematique[]" '
                    // echo '<input type="checkbox" name="thematique" '
                    . 'value="' . $tte->slug . '" class="dot"'
                    . checked( in_array( $tte->slug , get_query_var( 'thematique' ) ), true, false ) . '> ';
                    echo '<label>' . $tte->name  . '</label>';

                ?>

                <?php if (count($tte->childs) != 0) : ?>
                    <div class="osi-grid-child">
                        <?php foreach ($tte->childs as $child) : ?>
                            <?php
                                echo '<input type="checkbox" name="thematique[]" '
                                // echo '<input type="checkbox" name="thematique" '
                            .   'value="' . $child->slug . '" class="dot"'
                            .   checked( in_array( $child->slug , get_query_var( 'thematique' ) ), true, false ) . '> ';
                                echo '<label>' . $child->name  . '</label>';
                            ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- </div> -->
        <?php endforeach; ?>
    </div>
</div>
