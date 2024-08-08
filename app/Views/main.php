<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>" />

<title><?= $title; ?> | General Insurance</title>

<?= $this->include('partials/head.php')?>

    <body class="hold-transition layout-top-nav layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <?= $this->include('partials/navbar.php')?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="container-fluid">
                        <?= $this->renderSection('content') ?>
                    </div>
                </div> 
            </div>
            <?= $this->include('partials/footer.php')?>
        </div>
        <?= $this->include('partials/scripts.php')?>
        <?= $this->renderSection('script') ?>
    </body>
</html>