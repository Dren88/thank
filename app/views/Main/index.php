<div>
    <a class="btn btn-primary" href="/">Список поблагодаривших</a>
    <a class="btn btn-primary" href="/user_to_id/">Список тех, кому сказали спасибо</a>
</div>
<?php if (!empty($departments)): ?>
    <form action="">
        <select class="form-select" name="department">
            <option value="">Выберите подразделение</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department['id'] ?>" <?if (isset($_GET['department']) &&  $_GET['department'] == $department['id']) echo "selected"?>><?= $department['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="start_date" value="<?= isset($_GET['start_date'])? $_GET['start_date'] : '' ?>"/>
        <input type="date" name="finish_date" value="<?= isset($_GET['finish_date'])? $_GET['finish_date'] :'' ?>"/>
        <input type="submit" class="btn btn-primary" value="Отправить">
    </form>
<?php endif; ?>
<h1><?= $title ?></h1>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <?php if (!empty($thanks)): ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Пользователь</th>
                    <th>Количество благодарностей</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($thanks as $thank): ?>
                    <tr>
                        <td><?= $thank['name'] ?></td>
                        <td><?= $thank['count']?:0 ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p><?= count($thanks) ?> пользователей(я) из: <?= $total; ?></p>
                <?php if ($pagination->countPages > 1): ?>
                    <?= $pagination; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php else: ?>
            <p>Пользователей не найдено...</p>
        <?php endif; ?>
    </div>
</div>