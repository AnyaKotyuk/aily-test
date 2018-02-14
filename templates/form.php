<?php if (!empty($error_msg)) { ?>
<div class="alert alert-danger">
    <?php echo $error_msg; ?>
</div>
<?php } ?>
<?php if($error === false){ ?>
    <div class="alert alert-success">
        Your message is saved!
    </div>
<?php } ?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/">
    <div class="container>">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?php FormHelper::textInput('user_name', 'Your name', $data['user_name']); ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?php FormHelper::emailInput('user_email', 'Your email', $data['user_email']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php FormHelper::textInput('homepage', 'Homepage', $data['homepage']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php FormHelper::textarea('message', 'Message', $data['message']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php FormHelper::file('attach', 'Attach txt file or image', $data['file']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php FormHelper::captcha(); ?>
            </div>
            <div class="col-md-6">
                <?php FormHelper::submit('Send'); ?>
            </div>
        </div>
    </div>
</form>
