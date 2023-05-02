<?= $this->extend('layouts/master');
$this->section('title') ?> Show Post <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('posts') ?>" class="btn btn-primary">В реестр</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Просмотр записи</h5>
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Проверяемый СМП</label>
                        <input type="text" class="form-control" disabled placeholder="Post Title" value="<?php echo trim($post['title']);?>"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Контролирующий орган</label>
                        <textarea class="form-control" disabled name="description" placeholder="Description"><?php echo trim($post['description']);?></textarea>
                    </div>
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Дата начала проверки</label>
                        <input type="text" class="form-control" disabled placeholder="Post Title" value="<?php echo trim($post['created_at']);?>"/>
                    </div>
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Дата начала проверки</label>
                        <input type="text" class="form-control" disabled placeholder="Post Title" value="<?php echo trim($post['updated_at']);?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
