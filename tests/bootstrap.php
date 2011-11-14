<?php

require_once dirname(dirname(__FILE__)) . '/SimplePieAutoloader.php';
// Ensure SimplePie is loaded
class_exists('SimplePie') or die("Couldn't load SimplePie");