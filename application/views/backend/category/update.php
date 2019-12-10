<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <?php echo $title; ?>
        </div>
        <div class="card-body">
            <?php
            echo validation_errors('<div class="alert alert-warning">', '</div>');
            echo form_open(base_url('admin/category/update/' . $category->id));
            ?>
            <div class="row">
                <div class="col-md-3"><label>Nama Kategori</label></div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" class="form-control" name="category_name" value="<?php echo $category->category_name ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Update Category">
                    </div>
                    <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>