</div>
</div>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
        </div>
    </div>
</footer>
</div>
</div>
<script src="<?php echo base_url('assets/template/backend/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/backend/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/backend/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/backend/js/sb-admin-2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/backend/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/backend/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/backend/js/demo/datatables-demo.js'); ?>"></script>
<!-- Other Plugin -->
<script src="<?php echo base_url('assets/template/backend/js/ckeditor.js'); ?>"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<script src="<?php echo base_url('assets/template/backend/vendor/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script>
    tinymce.init({
        selector: '.tinymce',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });
</script>
</body>

</html>