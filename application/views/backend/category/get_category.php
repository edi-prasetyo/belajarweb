<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    <?php include "create.php"; ?>
</div>
<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Category</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($category as $category) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $category->category_name; ?></td>
                            <td>
                                <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/category/update/' . $category->id) ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php
                                    include('delete.php');
                                    ?>
                            </td>
                        </tr>
                    <?php $i++;
                    }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>