
<?php
// initialisation
$child_array= array();
?>
<div class="form-group">
    <label for="select-thematique">Sélectionner la catégorie</label>
    <div class="form-cat-container">
        <?php foreach ($args['terms'] as $tte) : ?>
            <div class="form-cat-element">
                <input type="checkbox" name="<?= $tte->slug ?>" class="dot">
                <!-- <span class="dot" data="0"></span> -->
                <label for="<?= $tte->slug ?>" class="form-cat-lab-parent" data="0"><?= $tte->name ?></label>
                <?php 
                    if (count($tte->childs) != 0) : 
                        // 1er niveau cat parente
                        // $child_array[]= $tte->slug;
                        $child_array[$tte->slug]= array();
                ?>
                    <div>
                        <?php foreach ($tte->childs as $child) : 
                            $child_array[$tte->slug][]= $child->name;
                        ?>
                            <!-- <input type="checkbox" name="<?php //echo $child->name ?>" class="dot">
                            <span class="dot"></span>
                            <label for="<?php // echo $child->name ?>" class="lab-child"><?php //echo $child->name ?></label> -->
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- </div> -->
        <?php endforeach; ?>
    </div>
    <pre>
        <?php print_r($child_array); ?>
    </pre>
</div>

<!-- 1 faire un tableau d'éléments lors de la première boucle
     0 test en sortie de boucle si présence
     0 remplir la div de droite des sous cat
     0 activer tout ca avec du js -->