<?php
/**
 * @copyright 2023 Nasmak Technologies <info@nasmak.com.au>
 * @copyright based on work by 2023 Fateh Khan <team@nasmak.com.au>
 */
$settings->add(new admin_setting_heading(
            'headerconfig',
            get_string('headerconfig', 'block_multitext'),
            get_string('descconfig', 'block_multitext')
        ));

$settings->add(new admin_setting_configcheckbox(
            'multitext/Allow_HTML',
            get_string('labelallowhtml', 'block_multitext'),
            get_string('descallowhtml', 'block_multitext'),
            '0'
        ));