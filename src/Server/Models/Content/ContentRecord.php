<?php
declare(strict_types=1);

namespace App\Server\Models\Content;

use Atlas\Mapper\Record;

/**
 * @method ContentRow getRow()
 */
class ContentRecord extends Record
{
    use ContentFields;
}
