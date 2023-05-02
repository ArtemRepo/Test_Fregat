
<?= $this->extend('layouts/master');
$this->section('title') ?> Реестр плановых проверок <?= $this->endSection() ?>
<?= $this->section('content'); ?>


    <div class="container">
        <div class="row py-4">
            <div class="col-xl-12 text-end">
                <a href="<?= base_url('posts/new') ?>" class="btn btn-primary">Добавить запись</a>
            </div>


        <div class="row py-2">
            <div class="col-xl-12">
                <?php
                if(session()->getFlashdata('success')):?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                        <?php echo session()->getFlashdata('success') ?>
                    </div>
                <?php elseif(session()->getFlashdata('failed')):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                        <?php echo session()->getFlashdata('failed') ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Реестр</h5>


                    <div class="col-md-6">
                        <form action="posts/download" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="export_file_type" required class="form-control">
                                        <option value="">--Выберите формат для экспорта--</option>
                                        <option value="xlsx">xlsx</option>
                                        <option value="xls">xls</option>
                                        <option value="csv">csv</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="export_btn" class="btn btn-primary">Экспорт в Excel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>

                    <?php
                    if(session()->getFlashdata('message'))
                    {
                    echo session()->getFlashdata('message');
                    }
                    ?>


                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header text-center">
                                <strong>Загрузить CSV File</strong>
                            </div>
                            <div class="card-body">
                                <div class="mt-2">
                                    <?php if (session()->has('message')){ ?>
                                        <div class="alert <?=session()->getFlashdata('alert-class') ?>">
                                            <?=session()->getFlashdata('message') ?>
                                        </div>
                                    <?php } ?>
                                    <?php $validation = \Config\Services::validation(); ?>
                                </div>
                                <form action="<?=site_url('posts/import-csv') ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group mb-3">
                                        <div class="mb-3">
                                            <input type="file" name="file" class="form-control" id="file">
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <input type="submit" name="submit" value="Загрузить" class="btn btn-success" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Проверяемый СМП</th>
                                <th>Контролирующий орган</th>
                                <th>Дата начала проверки</th>
                                <th>Дата окончания проверки</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if (count($posts) > 0):
                                foreach ($posts as $post): ?>
                                    <tr>
                                        <td><?= $post['id'] ?></td>
                                        <td><?= $post['title'] ?></td>
                                        <td><?= $post['description'] ?></td>
                                        <td><?= $post['created_at'] ?></td>
                                        <td><?= $post['updated_at'] ?></td>
                                        <td class="d-flex">
                                            <a href="<?= base_url('posts/'.$post['id']) ?>" class="btn btn-sm btn-info mx-1" title="Открыть"><i class="bi bi-info-square"></i></a>
                                            <a href="<?= base_url('posts/edit/'.$post['id']) ?>" class="btn btn-sm btn-success mx-1" title="Редактировать"><i class="bi bi-pencil-square"></i></a>
                                            <a href="<?= base_url('products/delete/'.$post['id']);?>" class="btn btn-sm btn-danger mx-1" title="Удалить"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr rowspan="1">
                                    <td colspan="4">
                                        <h6 class="text-danger text-center">Не найдено</h6>
                                    </td>
                                </tr>
                            <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

            <!-- DATATABLES  -->
            <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
            <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
                    $('#myTable').dataTable({
                         dom: 'ftip',
                        }
                    );
                } );
            </script>
    </div>
<?= $this->endSection(); ?>

}