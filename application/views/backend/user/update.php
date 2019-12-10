<div class="col-md-8">
    <div class="card shadow mb-4">
        <div class="card-header">
            <?php echo $title; ?>
        </div>
        <div class="card-body">
            <?php
            // Form Open
            echo form_open_multipart(base_url('admin/user/update/' . $user->id));
            ?>
            <div class="row">
                <div class="col-md-3">
                    <label>Nama User</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Nama lengkap" value="<?php echo $user->name; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Email</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $user->email; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Role</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <select name="role" class="form-control">
                            <option value="Superadmin">Superadmin</option>
                            <option value="Admin" <?php if ($user->role == "Admin") {
                                                        echo "selected";
                                                    } ?>>Admin</option>
                            <option value="Penulis" <?php if ($user->role == "Penulis") {
                                                        echo "selected";
                                                    } ?>>Penulis</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Status</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0" <?php if ($user->status == 0) {
                                                    echo "selected";
                                                } ?>>Nonactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Upload Foto</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="file" name="avatar"><br>
                        <img class="img-fluid" src="<?php echo base_url('assets/uploads/avatars/' . $user->avatar); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Update User</button>
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