<?php

/**
 * Root index.php forwarder for cPanel Shared Hosting
 * (Allows https://textapp.nexteck.uk/ to work immediately even if cPanel Document Root
 * points to the project root instead of /public)
 */

require __DIR__ . '/public/index.php';
