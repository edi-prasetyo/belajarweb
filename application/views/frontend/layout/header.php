<?php $category = $this->category_model->get_all(); ?>
<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Carousel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <?php foreach ($category as $category) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('article/category/' . $category->category_slug); ?>"><?php echo $category->category_name; ?></a>
                        </li>
                    <?php }; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-secondary" href="<?php echo base_url('auth'); ?>">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main role="main">
    <div class="container py-5">
        <div class="row">