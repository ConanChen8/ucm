<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-04-14 02:55:25 
  * IP Address: 1
  */


if(!module_config::can_i('view','Settings')){
    redirect_browser(_BASE_HREF);
}

$settings = array(
         array(
            'key'=>'email_smtp',
            'default'=>'0',
             'type'=>'checkbox',
             'description'=>'Use SMTP when sending emails from this system',
         ),
         array(
            'key'=>'email_smtp_hostname',
            'default'=>'',
             'type'=>'text',
             'description'=>'SMTP hostname (eg: mail.yoursite.com)',
         ),
         array(
            'key'=>'email_smtp_auth',
            'default'=>'',
             'type'=>'select',
             'options' => array(
                 '' => _l('Nothing (default)'),
                 'ssl' => _l('SSL'),
                 'tls' => _l('TLS (use for Google SMTP)'),
             ),
             'description'=>'SMTP Security',
             'help'=>'If the Nothing (default) option does not work, try using SSL or TLS.',
         ),
         array(
            'key'=>'email_smtp_authentication',
            'default'=>'0',
             'type'=>'checkbox',
             'description'=>'Use SMTP authentication',
         ),
         array(
            'key'=>'email_smtp_username',
            'default'=>'',
             'type'=>'text',
             'description'=>'SMTP Username',
         ),
         array(
            'key'=>'email_smtp_password',
            'default'=>'',
             'type'=>'text',
             'description'=>'SMTP Password',
         ),
        array(
            'key'=>'email_limit_amount',
            'default'=>'0',
            'type'=>'text',
            'description' => 'Limit number of emails',
            'help'=>'How many emails you can send per day, hour or minute. Set to 0 for unlimited emails.',
        ),
         array(
            'key'=>'email_limit_period',
            'default'=>'day',
             'type'=>'select',
             'options' => array(
                 'day' => _l('Per Day'),
                 'hour' => _l('Per Hour'),
                 'minute' => _l('Per Minute'),
             ),
             'description'=>'Limit per',
             'help'=>'How many emails you can send per day, hour or minute',
         ),
);

$demo_email = module_config::c('admin_email_address');
if(isset($_REQUEST['email'])){
    $demo_email = $_REQUEST['email'];
}
if(isset($_REQUEST['_email'])){
    // send a test email and report any errors.
    $email = module_email::new_email();
    $email->set_subject('Test Email from '.module_config::c('admin_system_name'));
    $email->set_to_manual($demo_email);
    $email->set_html('This is a test email from the "'.module_config::c('admin_system_name').'" setup wizard.');
    if(!$email->send()){
        ?>
        <div class="warning">
            Failed to send test email. Error message: <?php echo $email->error_text;?>
        </div>
        <?php
    }else{
        ?>
        <strong>Test email sent successfully.</strong>
        <?php
    }
}

hook_handle_callback('layout_column_half',1);
    print_heading('Send a test email');
    ?>
    <form action="" method="post">
        <input type="hidden" name="_email" value="true">
        <p>Please enter your email address:</p>
        <p><input type="text" name="email" value="<?php echo htmlspecialchars($demo_email);?>" size="40"></p>
        <p>If sending an email does not work, please change your SMTP details on the right and try again.</p>
        <input type="submit" name="send" value="Click here to send a test email" class="submit_button btn btn-success">
        <p><em>(the subject of this email will be "Test Email from <?php echo module_config::c('admin_system_name');?>")</em></p>
    </form>
<?php hook_handle_callback('layout_column_half',2); ?>

    <?php
    print_heading('Email Settings (SMTP)');
    module_config::print_settings_form(
         $settings
    );
    ?>

<?php hook_handle_callback('layout_column_half','end'); ?>