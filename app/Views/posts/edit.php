<?= $this->extend('layouts/master');
$this->section('title') ?> Create Post <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
    <?php $validation = \Config\Services::validation(); ?>

    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('posts') ?>" class="btn btn-primary">В реестр</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('posts/'.$post['id']) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT"/>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Редактировать запись</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Проверяемый СМП</label>
                            <input type="text" class="form-control <?php if($validation->getError('title')): ?>is-invalid<?php endif ?>" name="title" placeholder="Post Title" value="<?php if($post['title']): echo $post['title']; else: set_value('title'); endif ?>"/>
                            <?php if ($validation->getError('title')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('title') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Контролирующий орган</label>
                            <textarea class="form-control <?php if($validation->getError('description')): ?>is-invalid<?php endif ?>" name="description" placeholder="Description"><?php if($post['description']): echo $post['description']; else: set_value('description'); endif ?></textarea>
                            <?php if ($validation->getError('description')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('description') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    <div class="form-group">
                        <label class="form-label">Дата начала проверки</label>
                        <input type="date" class="form-control <?php if($validation->getError('created_at')): ?>is-invalid<?php endif ?>" name="created_at" placeholder="Введите дату начала"<?php echo set_value('created_at'); ?> "/>
                        <?php if ($validation->getError('created_at')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('created_at') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Дата окончания проверки</label>
                        <input type="date" class="form-control <?php if($validation->getError('updated_at')): ?>is-invalid<?php endif ?>" name="updated_at" placeholder="Введите дату окончания"<?php echo set_value('updated_at'); ?> "/>
                        <?php if ($validation->getError('updated_at')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('updated_at') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Редактировать</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
