<div class="col-md-8">
    <hr class="featurette-divider">
    <?php foreach ($article as $article) { ?>
        <div class="row featurette">
            <div class="col-md-5 order-md-1">
                <img class="img-fluid" src="<?php echo base_url('assets/uploads/images/' . $article->image); ?>">
            </div>
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading"><?php echo strip_tags(character_limiter($article->title, 50)); ?></h2>
                <?php echo strip_tags(character_limiter($article->content, 100)); ?>
                <a href="<?php echo base_url('article/detail/' . $article->article_slug); ?>"> Read More</a>
            </div>
        </div>
        <hr class="featurette-divider">
    <?php } ?>

    <div class="pagination col-md-12 text-center">
        <?php if (isset($paginasi)) {
            echo $paginasi;
        } ?>
    </div>
</div>