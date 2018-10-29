<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\Datasources\ContentsCategory;

use Atlas\Table\Table;

/**
 * @method ContentsCategoryRow|null fetchRow($primaryVal)
 * @method ContentsCategoryRow[] fetchRows(array $primaryVals)
 * @method ContentsCategoryTableSelect select(array $whereEquals = [])
 * @method ContentsCategoryRow newRow(array $cols = [])
 * @method ContentsCategoryRow newSelectedRow(array $cols)
 */
class ContentsCategoryTable extends Table
{
    const DRIVER = 'sqlsrv';

    const NAME = 'contents_categories';

    const COLUMNS = [
        'row_id' => array(
  'name' => 'row_id',
  'type' => 'int',
  'size' => 10,
  'scale' => 0,
  'notnull' => true,
  'default' => null,
  'autoinc' => true,
  'primary' => true,
  'options' => null,
),
        'inserted_at' => array(
  'name' => 'inserted_at',
  'type' => 'datetime',
  'size' => null,
  'scale' => null,
  'notnull' => true,
  'default' => null,
  'autoinc' => false,
  'primary' => false,
  'options' => null,
),
        'updated_at' => array(
  'name' => 'updated_at',
  'type' => 'datetime',
  'size' => null,
  'scale' => null,
  'notnull' => true,
  'default' => null,
  'autoinc' => false,
  'primary' => false,
  'options' => null,
),
        'content' => array(
  'name' => 'content',
  'type' => 'int',
  'size' => 10,
  'scale' => 0,
  'notnull' => true,
  'default' => null,
  'autoinc' => false,
  'primary' => false,
  'options' => null,
),
        'categorie' => array(
  'name' => 'categorie',
  'type' => 'int',
  'size' => 10,
  'scale' => 0,
  'notnull' => true,
  'default' => null,
  'autoinc' => false,
  'primary' => false,
  'options' => null,
),
    ];

    const COLUMN_NAMES = [
        'row_id',
        'inserted_at',
        'updated_at',
        'content',
        'categorie',
    ];

    const COLUMN_DEFAULTS = [
        'row_id' => null,
        'inserted_at' => null,
        'updated_at' => null,
        'content' => null,
        'categorie' => null,
    ];

    const PRIMARY_KEY = [
        'row_id',
    ];

    const AUTOINC_COLUMN = 'row_id';

    const AUTOINC_SEQUENCE = null;
}
