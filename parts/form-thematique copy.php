<div class="form-group">
    <label for="select-thematique">Sélectionner la thematique</label>
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
                        ?>" data="0">
                <input type="checkbox" name="<?= $tte->slug ?>" class="dot">
                <span class="dot" data="0"></span>
                <label for="<?= $tte->slug ?>" class="lab-parent" data="0"><?= $tte->name ?></label>
                <?php if (count($tte->childs) != 0) : ?>
                    <div>
                        <?php foreach ($tte->childs as $child) : ?>
                            <input type="checkbox" name="<?= $child->name ?>" class="dot">
                            <span class="dot"></span>
                            <label for="<?= $child->name ?>" class="lab-child"><?= $child->name ?></label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- </div> -->
        <?php endforeach; ?>
    </div>
</div>
