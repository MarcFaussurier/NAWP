<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\Datasources\User;

use Atlas\Table\Row;

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
class UserRow extends Row
{
    protected $cols = [
        'row_id' => null,
        'inserted_at' => null,
        'updated_at' => null,
        'email' => null,
        'first_name' => null,
        'last_name' => null,
        'hashed_password' => null,
        'rgpd' => '0',
        'newsletter' => '0',
        'role' => null,
    ];
}
