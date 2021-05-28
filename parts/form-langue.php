<!-- <div class="form-group">
    <ul class="form-date-ul"> -->
        <li class="list-group-item col-4">
            <label for="select-langue">Langue</label>
            <select class="form-control" id="select-langue" name="langue">
                <option value="">--</option>
                <?php foreach ($args['terms']  as $langue) : ?>
                    <option value="<?= $langue->slug; ?>" <?php if ((!isset($_GET['langue']) && ($langue->name == 'Français')) ||  (isset($_GET['langue']) && ($_GET['langue'] == $langue->slug))) : ?> selected <?php endif; ?>>
                        <?= $langue->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </li>
    <!-- </ul>
</div> -->