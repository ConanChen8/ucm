

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

$fieldset_data = array(
);

$fieldset_data['heading'] = array(
    'type'=>'h3',
    'title'=>$options['title'],
    'help'=>'This will show a history of emails sent from the system.'
);
ob_start();

 ?>
<div class="content_box_wheader">
    <?php $pagination = process_pagination($emails); ?>

    <table class="tableclass tableclass_rows emails" width="100%" id="emails" style="<?php if(!count($emails))echo ' display:none; '; ?>">
        <thead>
            <tr>
                <th><?php _e('Date');?></th>
                <th><?php _e('Subject');?></th>
                <th><?php _e('To');?></th>
                <th><?php _e('User');?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($pagination['rows'] as $n){
                ?>
                <tr>
                    <td><?php echo print_date($n['sent_time']);?></td>
                    <td><?php echo htmlspecialchars($n['subject']);?></td>
                    <td><?php $headers = unserialize($n['headers']);
                        if(isset($headers['to']) && is_array($headers['to'])){
                            foreach($headers['to'] as $to){
                                echo $to['email'].' ';
                            }
                        }
                        ?></td>
                    <td><?php echo module_user::link_open($n['create_user_id'],true);?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div style="min-height: 10px;">
        <?php
        echo $pagination['page_numbers']>1 ? $pagination['links'] : '';
        ?>
    </div>
</div>
<?php $fieldset_data['elements_before'] = ob_get_clean();
            echo module_form::generate_fieldset($fieldset_data);