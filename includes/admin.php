<?php
    if($_POST['lab_contactform_hidden'] == 'Y') {
        //Form data sent
        $lab_email = $_POST['lab_contactform_email'];
        update_option('lab_contactform_email', $lab_email);
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.', 'labcf' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
	$lab_email = get_option('lab_contactform_email');
    }
?>

<div class="wrap">
    <?php    echo "<h1>" . __( 'Lab Contact Form', 'labcf' ) . "</h1>"; ?>
	<?php    echo "<h2>" . __( 'Settings :', 'labcf' ) . "</h2>"; ?>
    <form name="lab_contactform_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="lab_contactform_hidden" value="Y">
        <?php    echo "<h3>" . __( 'Enter your email address.', 'labcf' ) . "</h3>"; ?>
        <?php echo "<p>" . __( 'The messages from the contact form will be sent to this e-mail' , 'labcf') . "</p>"; ?>
        <p><?php _e("E-mail: " , 'labcf' ); ?><input class="form-control" type="email" name="lab_contactform_email" value="<?php echo $lab_email; ?>" size="42"></p>
         
     
        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'labcf' ) ?>" />
        </p>
    </form>
	<?php echo "<p>" . __( 'To use the contact from simply insert this shortcode in your post or page:', 'labcf' ) . "<br />
	 <strong>[lab_contactform]</strong> <br /> </p>"; ?>
</div>