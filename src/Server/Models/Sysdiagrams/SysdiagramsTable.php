<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\Server\Models\Sysdiagrams;

use Atlas\Table\Table;

/**
 * @method SysdiagramsRow|null fetchRow($primaryVal)
 * @method SysdiagramsRow[] fetchRows(array $primaryVals)
 * @method SysdiagramsTableSelect select(array $whereEquals = [])
 * @method SysdiagramsRow newRow(array $cols = [])
 * @method SysdiagramsRow newSelectedRow(array $cols)
 */
class SysdiagramsTable extends Table
{
    const DRIVER = 'sqlsrv';

    const NAME = 'sysdiagrams';

    const COLUMNS = [
        'name' => array(
  'name' => 'name',
  'type' => 'nvarchar',
  'size' => 128,
  'scale' => null,
  'notnull' => true,
  'default' => null,
  'autoinc' => false,
  'primary' => false,
  'options' => null,
),
        'principal_id' => array(
  'name' => 'principal_id',
  'type' => 'int',
  'size' => 10,
  'scale' => 0,
  'notnull' => true,
  'default' => null,
  'autoinc' => false,
  'primary' => false,
  'options' => null,
),
        'diagram_id' => array(
  'name' => 'diagram_id',
  'type' => 'int',
  'size' => 10,
  'scale' => 0,
  'notnull' => true,
  'default' => null,
  'autoinc' => true,
  'primary' => true,
  'options' => null,
),
        'version' => array(
  'name' => 'version',
  'type' => 'int',
  'size' => 10,
  'scale' => 0,
  'notnull' => false,
  'default' => null,
  'autoinc' => false,
  'primary' => false,
  'options' => null,
),
        'definition' => array(
  'name' => 'definition',
  'type' => 'varbinary',
  'size' => -1,
  'scale' => null,
  'notnull' => false,
  'default' => null,
  'autoinc' => false,
  'primary' => false,
  'options' => null,
),
    ];

    const COLUMN_NAMES = [
        'name',
        'principal_id',
        'diagram_id',
        'version',
        'definition',
    ];

    const COLUMN_DEFAULTS = [
        'name' => null,
        'principal_id' => null,
        'diagram_id' => null,
        'version' => null,
        'definition' => null,
    ];

    const PRIMARY_KEY = [
        'diagram_id',
    ];

    const AUTOINC_COLUMN = 'diagram_id';

    const AUTOINC_SEQUENCE = null;
}
