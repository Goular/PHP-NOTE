<?php
/**
 * Session的属性与Cookie的属性几乎一样，因为Session技术依赖于Cookie技术
 */
ini_set('session.cookie_lifetime', '3600');
ini_set('session.cookie_path', '/simple');
session_start();