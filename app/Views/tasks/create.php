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
                <label for="task">Им япользователя</label>
                <input class="form-control"
                       id="user_name"
                       name="user_name"
                       type="text"
                       value="<?=!empty($data['old']['user_name']) ? e($data['old']['user_name']) : '' ?>"
                />
            </div>
            <div class="form-group">
                <label for="task">Email</label>
                <input class="form-control"
                       id="user_email"
                       name="user_email"
                       type="text"
                       value="<?=!empty($data['old']['user_email']) ? e($data['old']['user_email']) : '' ?>"
                />
            </div>
            <div class="form-group">
                <label for="task">Описание задачи</label>
                <textarea class="form-control"
                          id="task"
                          name="content"
                          rows="5"
                ><?=!empty($data['old']['content']) ? e($data['old']['content']) : '' ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
<?php require_once __DIR__ . '/../components/footer.php'?>