<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\Datasources\Content;

use Atlas\Table\Row;

/**
 * @property mixed $row_id int(10,0) NOT NULL
 * @property mixed $inserted_at datetime NOT NULL
 * @property mixed $updated_at datetime NOT NULL
 * @property mixed $title varchar(255) NOT NULL
 * @property mixed $content varchar(-1) NOT NULL
 * @property mixed $author int(10,0) NOT NULL
 * @property mixed $draft bit NOT NULL
 * @property mixed $parent int(10,0)
 */
class ContentRow extends Row
{
    protected $cols = [
        'row_id' => null,
        'inserted_at' => null,
        'updated_at' => null,
        'title' => null,
        'content' => null,
        'author' => null,
        'draft' => '1',
        'parent' => null,
    ];
}