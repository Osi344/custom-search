<?php
function test_array($toTest, $myArray)
{
    $bool = false;

    foreach ($myArray as $myElt) {
        if ($myElt === $toTest) {
            $bool = true;
        }
    }
    return $bool;
}
?>

<div id="form-cat" class="form-group col-12">
    <label for="select-thematique">Sélectionner la catégorie</label>
    <?php $current = is_array($_GET['category']) ? $_GET['category'] : array(); ?>

    <div class="row">
        <div class="form-cat-container col-12">
            <div class="row  row-no-gutters">
                <?php foreach ($args['terms'] as $tte) : ?>
                    <div class="form-cat-element form-cat-parent col-12 col-lg-4 col-md-6">
                        <?php
                        echo '<input type="checkbox" name="category[]" '
                            . 'value="' . $tte->slug . '" class="dot"'
                            . checked(in_array($tte->slug, $current), true, false) . '> ';

                        echo '<label for="' . $tte->slug . '" class="form-cat-lab-parent" data="0">' . $tte->name  . '</label>';
                        ?>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="form-cat-container col-12">
            <div class="row row-no-gutters">
                <?php foreach ($args['terms'] as $tte) :

                    // childs => associated elements 
                    if (count($tte->childs) != 0) :

                        $catRight = '<div class="form-cat-right ' . $tte->slug . ' col-12 col-lg-4 col-md-6" style="';
                        if (test_array($tte->slug, $current)) {
                            $catRight .= 'display:block">';
                        } else {
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
                        <?php echo "</div>" ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        function toggleBg(elt) {
            let test = $(elt).css('background-color');
            console.log("element bg color: ", test);
            if ($(elt).css('background-color') == "rgba(0, 0, 0, 0)") {
                $(elt).css('background-color', "rgba(110, 193, 228, 0.5");
            } else {
                $(elt).css('background-color', "rgba(0, 0, 0, 0)");
            }
        }

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

                    toggleBg(element);
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