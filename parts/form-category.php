
<div class="form-group">
    <label for="select-thematique">Sélectionner la catégorie</label>
    <div class="row">
        <div class="form-cat-container col-6">
            <?php foreach ($args['terms'] as $tte) : ?>
                <div class="form-cat-element form-cat-parent">
                    <input type="checkbox" name="<?= $tte->slug ?>" class="dot">
                    <label for="<?= $tte->slug ?>" class="form-cat-lab-parent" data="0"><?= $tte->name ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="form-cat-container col-6">
        <?php foreach ($args['terms'] as $tte) : ?>
                <?php if (count($tte->childs) != 0) : ?>
                    <div class="form-cat-right <?= $tte->slug ?> under">
                        
                    <?php foreach ($tte->childs as $child) : ?>
                        <div class="form-cat-element">
                            <input type="checkbox" name="<?= $child->slug ?>" class="dot">
                            <label for="<?= $child->slug ?>" class="form-cat-lab-parent" data="0"><?= $child->name ?></label>
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
           
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // let list = document.querySelectorAll('.form-cat-parent');
        let list = document.querySelectorAll('.form-cat-element');
        
        for(let element of list) {
            element.addEventListener('click', function(ev) {
                
                // display child cat
                if ($(element).hasClass('form-cat-parent')) {
                    let myClass= element.firstElementChild.name;
                    let myTarget= 'div.form-cat-right.' + myClass;
                    $(myTarget).toggle();
                }

                // checkbox toggle state
                let elementCheckbox= element.firstElementChild;
                console.log('elementCheckbox: ', elementCheckbox);
                if ( elementCheckbox.checked === true ) {
                    console.log('checkbox changed to no');
                    elementCheckbox.checked = false;
                } else {
                    console.log('checkbox changed to yes');
                    elementCheckbox.checked = true; 
                }

                // decocher toutes les sous cat qd cat decochée
            }, false);
        }



    });

</script>