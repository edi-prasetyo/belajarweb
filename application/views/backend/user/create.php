<div class="col-md-8">
    <div class="card shadow mb-4">
        <div class="card-header">
            Create New User
        </div>
        <div class="card-body">

            <?php
            // Form Open
            echo form_open_multipart(base_url('admin/user/create'));
            ?>

            <div class="row">
                <div class="col-md-3">
                    <label>Nama <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">

                        <input type="text" name="name" class="form-control" placeholder="Nama lengkap" value="<?php echo set_value('name') ?>">
                        <?php echo form_error('name', '<span class="text-danger">', '</span>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Email <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>">
                        <?php echo form_error('email', '<span class="text-danger">', '</span>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Role <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <select name="role" class="form-control">
                            <option></option>
                            <option value="Superadmin">Superadmin</option>
                            <option value="Admin">Admin</option>
                            <option value="Penulis">Penulis</option>
                        </select>
                        <?php echo form_error('role', '<span class="text-danger">', '</span>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Status <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option></option>
                            <option value="1">Active</option>
                            <option value="0">Nonactive</option>
                        </select>
                        <?php echo form_error('status', '<span class="text-danger">', '</span>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Password <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>">
                        <?php echo form_error('password', '<span class="text-danger">', '</span>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Upload Foto <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>
                </div>
                <div class="col-md-3">

                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan User</button>
                    </div>
                </div>

            </div>

            <?php
            //form Close
            echo form_close();
            ?>

        </div>
    </div>
</div>