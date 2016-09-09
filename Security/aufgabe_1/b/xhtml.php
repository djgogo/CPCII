<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" >
    <head>
        <title>Benutzer <?php echo $user->getScreenName(); ?></title>
        <script type="text/javascript" src="statistics.js" ></script>
    </head>
    <body>
        <script type="text/javascript">statistics.trackUserView({'screen':'<?php echo $user->getScreenName(); ?>'});</script>
        <p>Name: <em><?php echo $user->getRealName(); ?></em></p>
        <p>Mail: <em><a href="mailto:<?php echo $user->getEmail(); ?>"
                        onclick="statistics.trackUserMail({'screen':'<?php echo $user->getScreenName(); ?>'});"><?php echo $user->getEmail(); ?></a></em></p>
        <hr/>
        <p><a href="/report?user=<?php echo $user->getScreenName(); ?>">Benutzer melden</a></p>
    </body>
</html>
