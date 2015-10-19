<?php
defined('C5_EXECUTE') or die("Access Denied.");

$subject = t("%s - Login from a new computer", $sitename);

/**
 * HTML BODY START
 */
ob_start();
?>
    <h2><?php echo t('Login Notification'); ?></h2>
    <?php echo t('Dear %s,', $uName); ?><br />
    <br />
    <?php echo t('Your account on %s as been logged in on a new computer.', $sitename); ?><br />
    <br />
    <?php echo t('Date and Time: %s', $date_time);?><br />
    <?php echo t('User Agent: %s', $user_agent);?><br />
    <?php echo t('IP Address: %s', $ip_address);?><br />
    <br />
    <?php echo t('If the information above looks familiar, you can disregard this email.'); ?><br />
    <br />
    <?php echo t('If you have not signed in to %s recently and believe someone may have accessed your account,
     login to %s and change your password as soon as possible.', $sitename, $sitename); ?><br />

<?php
$bodyHTML = ob_get_clean();
/**
 * HTML BODY END
 *
 * ======================
 *
 * PLAIN TEXT BODY START
 */
ob_start();

    echo t('Login Notification');

    echo t('Dear %s,', $uName);

    echo t('Your account on %s as been logged in on a new computer.', $sitename);

    echo t('Date and Time: %s', $date_time);
    echo t('User Agent: %s', $user_agent);
    echo t('IP Address: %s', $ip_address);

    echo t('If the information above looks familiar, you can disregard this email.');

    echo t('If you have not signed in to %s recently and believe someone may have accessed your account,
         login to %s and change your password as soon as possible.', $sitename, $sitename);

$body = ob_get_clean();
ob_end_clean();
/**
 * PLAIN TEXT BODY END
 */