<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    <a href="<?php echo base_url('admin/article/create'); ?>" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-newspaper"></i>
        </span>
        <span class="text">Tambah Article</span>
    </a>
</div>
<?php

if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('message');
    echo '</div>';
}

?>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($article as $article) { ?>


                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $article->title; ?></td>
                            <td><?php echo $article->category_name; ?></td>
                            <td><?php echo $article->name; ?></td>
                            <td>
                                <?php if ($article->article_status == 'Publish') { ?>
                                    <span class="badge badge-info p-2">Publish</span>
                                <?php } else { ?>
                                    <span class="badge badge-secondary p-2">Draft</span>
                                <?php } ?>

                            </td>
                            <td>
                                <a href="<?php echo base_url('admin/article/update/' . $article->id); ?> " class="btn btn-success btn-sm"><i class="fas fa-user-edit"></i> Edit</a>
                                <?php
                                    include('delete.php');
                                    ?>
                                <a href='#' class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>