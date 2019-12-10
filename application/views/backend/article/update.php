<?php echo form_open_multipart(base_url('admin/article/update/' . $article->id)); ?>
<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header">
                <?php echo $title; ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Title <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="<?php echo $article->title; ?>">
                            <?php echo form_error('title', '<span class="text-danger">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Category <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option></option>
                                <?php foreach ($category as $category) { ?>
                                    <option value="<?php echo $category->id; ?>" <?php if ($article->category_id == $category->id) {
                                                                                            echo "selected";
                                                                                        } ?>>
                                        <?php echo $category->category_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('category_id', '<span class="text-danger">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Konten <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <textarea class="form-control" name="content" id="editor" value="<?php echo $article->content; ?>"><?php echo $article->content; ?></textarea>
                            <?php echo form_error('content', '<span class="text-danger">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Keywords <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="keywords" value="<?php echo $article->keywords; ?>">
                            <?php echo form_error('keywords', '<span class="text-danger">', '</span>'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                Options
            </div>
            <div class="card-body">
                <label>Status <span class="text-danger">*</span></label>
                <div class="form-group">
                    <select name="article_status" class="form-control">
                        <option value="Publish" <?php if ($article->article_status == "Publish") {
                                                    echo "selected";
                                                } ?>>Publish</option>
                        <option value="Draft">Draft</option>
                    </select>
                    <?php echo form_error('article_status', '<span class="text-danger">', '</span>'); ?>
                </div>
                <label>Chane Image <span class="text-danger">*</span></label>
                <div class="form-group">
                    <input type="file" name="image"><br>
                    <img class="img img-fluid" src="<?php echo base_url('assets/uploads/images/' . $article->image); ?>">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Publish</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>