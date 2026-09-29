<?php
// Simple redirect for legacy links pointing to homepage.php
// Keeps old links working by forwarding to index.php
header('Location: index.php');
exit;
