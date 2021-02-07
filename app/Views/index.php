<?php require_once __DIR__ . '/components/header.php'?>
<?php require_once __DIR__ . '/components/title.php'?>
<div class="container mt-5">
    <a href="/tasks/create" class="btn btn-sm btn-success">Добавить</a>

    <?php if(!empty($data['message'])): ?>
        <div class="mt-3 text-success">
            <?=$data['message']; ?>
        </div>
    <? endif; ?>
    <?php if(!empty($data['error'])): ?>
        <div class="mt-3 text-danger">
            <?=$data['error']; ?>
        </div>
    <? endif; ?>

    <table class="table mt-3">
        <tbody>
            <tr>
                <th>
                    Имя пользователя
                    <a href="<?=addGetParam(['sort' => 'user_name', 'sort_type' => 'up']); ?>"><i class="fas fa-sort-up"></i></a>
                    <a href="<?=addGetParam(['sort' => 'user_name', 'sort_type' => 'down']); ?>"><i class="fas fa-sort-down"></i></a>
                </th>
                <th>
                    Email
                    <a href="<?=addGetParam(['sort' => 'user_email', 'sort_type' => 'up']); ?>"><i class="fas fa-sort-up"></i></a>
                    <a href="<?=addGetParam(['sort' => 'user_email', 'sort_type' => 'down']); ?>"><i class="fas fa-sort-down"></i></a>
                </th>
                <th>Задача</th>
                <th>
                    Статус
                    <a href="<?=addGetParam(['sort' => 'status', 'sort_type' => 'up']); ?>"><i class="fas fa-sort-up"></i></a>
                    <a href="<?=addGetParam(['sort' => 'status', 'sort_type' => 'down']); ?>"><i class="fas fa-sort-down"></i></a>
                </th>
                <?php if(!empty($auth)): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
        </tbody>
        <tbody>
            <?php if(!empty($data['tasks'])): ?>
                <?php foreach ($data['tasks'] as $task): ?>
                    <tr>
                        <td><?=e($task['user_name']) ?></td>
                        <td><?=e($task['user_email']) ?></td>
                        <td><?=e($task['content']) ?></td>
                        <td>
                            <?=!empty($task['ready']) ? '<div>Выполнена</div>' : '<div>Ждет выполнения</div>' ?>
                            <?=!empty($task['updated_at']) ? '<div>Отредактировано администратором</div>' : '' ?>
                        </td>
                        <?php if(isAdm($auth)): ?>
                            <td><a href="/tasks/edit/<?=e($task['id']) ?>">Изменить</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

<?php if(!empty($data['paginate']) && $data['paginate']['pages'] > 1): ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $data['paginate']['pages']; $i++): ?>
                <li class="page-item<?=$data['paginate']['page'] == $i ? ' active' : ''?>">
                    <a class="page-link" href="<?=addGetParam(['page' => $i]); ?>"><?=$i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>


</div>
<?php require_once __DIR__ . '/components/footer.php'?>