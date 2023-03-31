<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!$CI->db->table_exists(db_prefix() . 'access')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "access` (
          `id` int UNSIGNED NOT NULL,
          `key` varchar(191) NOT NULL,
          `name` varchar(191) NOT NULL,
          `description` text,
          `group` varchar(20) NOT NULL DEFAULT 'Unknown',
          `order` int NOT NULL DEFAULT '1'
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'access`
        ADD PRIMARY KEY (`id`),
        ADD KEY `key` (`key`),
        ADD KEY `name` (`name`),
        ADD KEY `group` (`group`)
      ;');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'access`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1');
}
