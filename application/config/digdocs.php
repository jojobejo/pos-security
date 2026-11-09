<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['digdocs_storage'] = getenv('DIGDOCS_STORAGE_DIR') ?: dirname(FCPATH, 2) . '/var/pos-security-digdocs';
