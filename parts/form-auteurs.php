<div class="form-group">
    <ul class="form-date-ul">
        <li class="list-group-item">
            <label for="select-auteur">Auteur</label>
            <select class="form-control" id="select-auteur" name="auteur">
                <option value="">Choisir</option>
                <?php foreach ($args['terms']  as $auteur) : ?>
                    <option value="<?= $auteur->slug; ?>" <?php if (isset($_GET['auteur']) && ($_GET['auteur'] == $auteur->slug)) : ?> selected <?php endif; ?>>
                        <?= $auteur->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </li>
    </ul>
</div>