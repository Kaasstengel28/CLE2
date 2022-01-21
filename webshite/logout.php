<?php
//eerst  start hij de sessie en daarna breekt hij hem af.
session_start();
session_destroy();
header('Location: landingpage.html');
exit;
