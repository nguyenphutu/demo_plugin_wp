<?php

function sinetiks_students_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "student";
    $id = $_GET["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array('name' => $name,'email' => $email), //data
                array('ID' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $students = $wpdb->get_results($wpdb->prepare("SELECT id,name,email from $table_name where id=%s", $id));
        foreach ($students as $s) {
            $name = $s->name;
            $email = $s->email;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/access/sinetiks-students/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Students</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Student deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=sinetiks_students_list') ?>">&laquo; Back to students list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Student updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=sinetiks_students_list') ?>">&laquo; Back to students list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Name</th><td><input type="text" name="name" value="<?php echo $name; ?>"/></td></tr>
                    <tr><th>Email</th><td><input type="text" name="email" value="<?php echo $email; ?>"/></td></tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you want delete this student?')">
            </form>
        <?php } ?>

    </div>
    <?php
}