<?php defined('BASEPATH') or exit('No direct script members allowed');

if (!$CI->db->table_exists(db_prefix() . 'members')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "members` (
          `id` int UNSIGNED NOT NULL,
          `name` varchar(191) NOT NULL,
          `description` text
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'members`
        ADD PRIMARY KEY (`id`),
        ADD UNIQUE KEY `name` (`name`)
      ;');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'members`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1');
}
