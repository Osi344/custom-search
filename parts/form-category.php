<?php
function test_array($toTest,$myArray){
    $bool= false;

    foreach($myArray as $myElt) {
        if ($myElt === $toTest){
            $bool= true;
        }
    }
    return $bool;
}
?>

<div class="form-group">
    <label for="select-thematique">Sélectionner la catégorie</label>
    <?php $current = is_array($_GET['category']) ? $_GET['category'] : array(); ?>

    <div class="row">
        <div class="form-cat-container col-6">
            <?php foreach ($args['terms'] as $tte) : ?>
                <div class="form-cat-element form-cat-parent">
                    <?php
                    echo '<input type="checkbox" name="category[]" '
                        . 'value="' . $tte->slug . '" class="dot"'
                        . checked(in_array($tte->slug, $current), true, false) . '> ';

                    echo '<label for="' . $tte->slug . '" class="form-cat-lab-parent" data="0">' . $tte->name  . '</label>';
                    ?>

                </div>
            <?php endforeach; ?>
        </div>
        <div class="form-cat-container col-6">
                    
            <?php foreach ($args['terms'] as $tte) :

                // childs => associated elements 
                if (count($tte->childs) != 0) :

                    // for-cat-right element visible or not
                    $catRight = '<div class="form-cat-right ' . $tte->slug . '" style="';
                    if (test_array($tte->slug, $current)) {
                        $catRight .= 'display:block">';
                    }
                    else {
                        $catRight .= 'display:none">';
                    }
                    echo $catRight;

                    foreach ($tte->childs as $child) : ?>
                        <div class="form-cat-element">

                            <?php
                            echo '<input type="checkbox" name="category[]" '
                                . 'value="' . $child->slug . '" class="dot"'
                                . checked(in_array($child->slug, $current), true, false) . '> ';
                            echo '<label for="' . $child->slug . '" class="form-cat-lab-parent" data="0">' . $child->name  . '</label>';
                            ?>

                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // let list = document.querySelectorAll('.form-cat-parent');
        let list = document.querySelectorAll('.form-cat-element');

        for (let element of list) {

            console.log('element: ', element);

            element.addEventListener('click', function(ev) {

                // display child cat
                if ($(element).hasClass('form-cat-parent')) {
                    let myClass = element.firstElementChild.value;
                    let myTarget = 'div.form-cat-right.' + myClass;
                    $(myTarget).toggle();
                }

                // checkbox toggle state
                let elementCheckbox = element.firstElementChild;
                if (elementCheckbox.checked === true) {
                    elementCheckbox.checked = false;
                } else {
                    elementCheckbox.checked = true;
                }

                // decocher toutes les sous cat qd cat decochée
            }, false);
        }



    });
</script>