<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title"><?= ucwords($type." ".$type_title); ?></h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= base_url(ADMIN.'dashboard'); ?>">Dashboard</a>
                </li>
                <li>
                    <?= ucwords($type_title); ?>
                </li>
                <li class="active">
                    <?= ucwords($type." ".$type_title); ?>
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>