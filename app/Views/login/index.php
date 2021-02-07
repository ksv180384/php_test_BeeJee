<?php require_once __DIR__ . '/../components/header.php'?>

    <div class="d-flex justify-content-center align-items-center vh-100">

        <form action="" method="post">

            <?php if(!empty($data['error'])): ?>
                <div class="row text-danger">
                    <?=$data['error']; ?>
                </div>
            <? endif; ?>

            <div class="row">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text"
                           name="login"
                           class="form-control"
                           id="login"
                           placeholder="Логин"
                           value="<?=!empty($data['old']) ? $data['old']['login'] : '' ?>"
                    >
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-primary">Вход</button>
            </div>

        </form>

    </div>

<?php require_once __DIR__ . '/../components/footer.php'?>