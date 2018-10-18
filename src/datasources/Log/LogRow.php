<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\Datasources\Log;

use Atlas\Table\Row;

/**
 * @property mixed $row_id int(10,0) NOT NULL
 * @property mixed $inserted_at datetime NOT NULL
 * @property mixed $updated_at datetime NOT NULL
 * @property mixed $author int(10,0) NOT NULL
 * @property mixed $model varchar(255) NOT NULL
 * @property mixed $id int(10,0) NOT NULL
 * @property mixed $previous_value varchar(-1) NOT NULL
 * @property mixed $new_value varchar(-1) NOT NULL
 */
class LogRow extends Row
{
    protected $cols = [
        'row_id' => null,
        'inserted_at' => null,
        'updated_at' => null,
        'author' => null,
        'model' => null,
        'id' => null,
        'previous_value' => null,
        'new_value' => null,
    ];
}
