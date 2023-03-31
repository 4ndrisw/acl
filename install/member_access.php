<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!$CI->db->table_exists(db_prefix() . 'member_access')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "member_access` (
		  `id` int UNSIGNED NOT NULL,
		  `member_id` int UNSIGNED NOT NULL,
		  `access_id` int UNSIGNED NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'member_access`
        ADD PRIMARY KEY (`id`),
        ADD KEY `member_id` (`member_id`),
        ADD KEY `access_id` (`access_id`)
      ;');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'member_access`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1');
}
