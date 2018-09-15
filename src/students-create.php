<?php

function sinetiks_students_create() {
    $name = $_POST["name"];
    $email = $_POST["email"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "student";

        $wpdb->insert(
                $table_name, //table
                array('name' => $name, 'email'=>$email), //data
                array('%s', '%s') //data format			
        );
        $message.="Student inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/access/sinetiks-students/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Student</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>                
                <tr>
                    <th class="ss-th-width">Student Name</th>
                    <td><input type="text" name="name" value="<?php echo $name; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Student Email</th>
                    <td><input type="text" name="email" value="<?php echo $email; ?>" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}