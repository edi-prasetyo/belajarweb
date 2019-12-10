<div class="col-md-8">
    <img class="img-fluid" src="<?php echo base_url('assets/uploads/images/' . $article->image); ?>">
    <h2><?php echo $article->title; ?></h2>
    <span class="mr-md-5 text-muted"> Posted by : <?php echo $article->name; ?></span>
    <span class="text-muted"> Category : <a href="<?php echo base_url('article/category/' . $article->category_slug); ?>"><?php echo $article->category_name; ?></a></span><br>
    <?php echo $article->content; ?>
</div>