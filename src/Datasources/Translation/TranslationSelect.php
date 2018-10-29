<?php
declare(strict_types=1);

namespace App\Datasources\Translation;

use Atlas\Mapper\MapperSelect;

/**
 * @method TranslationRecord|null fetchRecord()
 * @method TranslationRecord[] fetchRecords()
 * @method TranslationRecordSet fetchRecordSet()
 */
class TranslationSelect extends MapperSelect
{
}
