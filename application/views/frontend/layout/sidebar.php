<div class="col-md-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Category</span>
    </h4>
    <ul class="list-group mb-3">
        <?php foreach ($all_category as $all_category) { ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0"><a href="<?php echo base_url('article/category/' . $all_category->category_slug); ?>"><?php echo $all_category->category_name; ?></a></h6>
                </div>
            </li>
        <?php } ?>
    </ul>

    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Latest article</span>
    </h4>
    <ul class="list-group mb-3">
        <?php foreach ($latepost as $latepost) { ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0"><a href="<?php echo base_url('article/detail/' . $latepost->article_slug); ?>"><?php echo $latepost->title; ?></a></h6>
                </div>
            </li>
        <?php } ?>
    </ul>


</div>