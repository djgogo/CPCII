<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" >
    <head>
        <title>Benutzer <?php echo $userView->getScreenName(); ?></title>
        <script type="text/javascript" src="statistics.js" ></script>
    </head>
    <body>
        <script type="text/javascript">statistics.trackUserView({'screen':'<?php echo $userView->getScreenName(); ?>'});</script>
        <p>Name: <em><?php echo $userView->getRealName(); ?></em></p>
        <p>Mail: <em><a href="mailto:<?php echo $userView->getEmail(); ?>" onclick="statistics.trackUserMail({'screen':'<?php echo $userView->getScreenName(); ?>'});"><?php echo $userView->getEmail(); ?></a></em></p>
        <hr/>
        <p><a href="/report?user=<?php echo $userView->getScreenName(); ?>">Benutzer melden</a></p>
    </body>
</html>
