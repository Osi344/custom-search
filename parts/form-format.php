<div class="form-group">
    <label for="select-format">Format</label>
    <select class="form-control" id="select-format" name="format">
        <option value="">Article</option>
        <?php foreach ($args['terms']  as $format) : ?>

            <option value="<?= $format['slug']; ?>" <?php if (isset($_GET['format']) && ($_GET['format'] == $format['slug'])) : ?> selected <?php endif; ?>>
                <?= $format['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>