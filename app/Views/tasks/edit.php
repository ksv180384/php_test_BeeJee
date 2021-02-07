<?php require_once __DIR__ . '/../components/header.php'?>
<?php require_once __DIR__ . '/../components/title.php'?>
<div class="container mt-5">
    <?php if(!empty($data['error'])): ?>
        <div class="text-danger">
            <?=$data['error']; ?>
        </div>
    <? endif; ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="task">Описание задачи</label>
            <textarea class="form-control"
                      id="task"
                      name="content"
                      rows="5"
            ><?=!empty($data['task']['content']) ? e($data['task']['content']) : '' ?></textarea>
        </div>
        <div class="form-group form-check">
            <input type="checkbox"
                   class="form-check-input"
                   id="ready"
                   name="ready"
                   <?=!empty($data['task']['ready']) ? 'checked' : ''?>
            >
            <label class="form-check-label" for="ready">Выполнена</label>
        </div>
        <input type="hidden" id="id" name="id" value="<?=e($data['task']['id']) ?>">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
<?php require_once __DIR__ . '/../components/footer.php'?>