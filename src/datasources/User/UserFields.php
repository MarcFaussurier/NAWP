<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\Datasources\User;

/**
 * @property mixed $row_id int(10,0) NOT NULL
 * @property mixed $inserted_at datetime NOT NULL
 * @property mixed $updated_at datetime NOT NULL
 * @property mixed $email varchar(255) NOT NULL
 * @property mixed $first_name varchar(255)
 * @property mixed $last_name varchar(255)
 * @property mixed $hashed_password varchar(500)
 * @property mixed $rgpd bit NOT NULL
 * @property mixed $newsletter bit NOT NULL
 * @property mixed $role tinyint(3,0) NOT NULL
 */
trait UserFields
{
}
