<?php
session_start();
session_destroy();
// Przekierowanie do strony głównej:
header('Location: index.html');
?>