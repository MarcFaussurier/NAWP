<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\Server\Models\User;

use Atlas\Table\Table;

/**
 * @method UserRow|null fetchRow($primaryVal)
 * @method UserRow[] fetchRows(array $primaryVals)
 * @method UserTableSelect select(array $whereEquals = [])
 * @method UserRow newRow(array $cols = [])
 * @method UserRow newSelectedRow(array $cols)
 */
class UserTable extends Table
{
    const DRIVER = 'mysql';

    const NAME = 'user';

    const COLUMNS = [
        'row_id' => [
            'name' => 'row_id',
            'type' => 'int',
            'size' => 10,
            'scale' => 0,
            'notnull' => true,
            'default' => null,
            'autoinc' => true,
            'primary' => true,
            'options' => null,
        ],
        'inserted_at' => [
            'name' => 'inserted_at',
            'type' => 'datetime',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'updated_at' => [
            'name' => 'updated_at',
            'type' => 'datetime',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'email' => [
            'name' => 'email',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'birth_day' => [
            'name' => 'birth_day',
            'type' => 'date',
            'size' => null,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'birth_place' => [
            'name' => 'birth_place',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'first_name' => [
            'name' => 'first_name',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'last_name' => [
            'name' => 'last_name',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'hashed_password' => [
            'name' => 'hashed_password',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'rgpd' => [
            'name' => 'rgpd',
            'type' => 'bit',
            'size' => 1,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'newsletter' => [
            'name' => 'newsletter',
            'type' => 'bit',
            'size' => 1,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'role' => [
            'name' => 'role',
            'type' => 'int',
            'size' => 10,
            'scale' => 0,
            'notnull' => false,
            'default' => '0',
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
    ];

    const COLUMN_NAMES = [
        'row_id',
        'inserted_at',
        'updated_at',
        'email',
        'birth_day',
        'birth_place',
        'first_name',
        'last_name',
        'hashed_password',
        'rgpd',
        'newsletter',
        'role',
    ];

    const COLUMN_DEFAULTS = [
        'row_id' => null,
        'inserted_at' => null,
        'updated_at' => null,
        'email' => null,
        'birth_day' => null,
        'birth_place' => null,
        'first_name' => null,
        'last_name' => null,
        'hashed_password' => null,
        'rgpd' => null,
        'newsletter' => null,
        'role' => '0',
    ];

    const PRIMARY_KEY = [
        'row_id',
    ];

    const AUTOINC_COLUMN = 'row_id';

    const AUTOINC_SEQUENCE = null;
}
