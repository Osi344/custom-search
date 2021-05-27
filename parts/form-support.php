<div class="form-group">
    <ul class="form-date-ul">
        <li class="list-group-item">
            <label for="select-support">Support</label>
            <select class="form-control" id="select-support" name="support">
                <option value="">Choisir</option>
                <?php foreach ($args['terms'] as $support) : ?>
                    <option value="<?= $support->slug; ?>" <?php if (isset($_GET['support']) && ($_GET['support'] == $support->slug)) : ?> selected <?php endif; ?>>
                        <?= $support->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </li>
    </ul>
</div>