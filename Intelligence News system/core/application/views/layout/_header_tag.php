<?php if(isset($title) and $title) { ?>
    <title><?= (isset($school_data['name_th']) and $school_data['name_th']) ? $school_data['name_th'].':' : ''; ?><?= $title; ?></title>
    <meta property="og:title" content="<?= (isset($school_data['name_th']) and $school_data['name_th']) ? $school_data['name_th'].':' : ''; ?><?= $title; ?>" />
<?php } else if(isset($school_data['meta_title']) and $school_data['meta_title']) { ?>
    <title><?= $school_data['meta_title']; ?></title>
    <meta property="og:title" content="<?= $school_data['meta_title']; ?>" />
<?php } else { ?>
    <title>โรงเรียน</title>
    <meta property='og:title' content='โรงเรียน' />
<?php } ?>
    
<?php if(isset($description) and $description) { ?>
    <meta name="description" content="<?= $description; ?>" />
    <meta property="og:description" content="<?= $description; ?>" />
<?php } else if(isset($school_data['meta_desc']) and $school_data['meta_desc']) { ?>
    <meta name="description" content="<?= $school_data['meta_desc']; ?>" />
    <meta property="og:description" content="<?= $school_data['meta_desc']; ?>" />
<?php } else { ?>
    <meta name="description" content="โรงเรียน" />
    <meta property="og:description" content="โรงเรียน" />
<?php } ?>
    
<?php if(isset($school_data['keyword']) and $school_data['keyword']) { ?>
    <meta name="keywords" content="<?= $school_data['keyword']; ?>" />
<?php } ?>
    
<?php if(isset($url) and $url) { ?>
    <meta property='og:url' content='<?= $url; ?>' />
<?php } else { ?>
    <meta property='og:url' content='<?= current_url(); ?>' />
<?php } ?>
    
<?php if(isset($image) and $image) { ?>
    <meta property='og:image' content='<?= $image; ?>' />
<?php } ?>
    
    <meta property='og:site_name' content='<?= site_url(); ?>' />