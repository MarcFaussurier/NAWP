<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 17/11/18
 * Time: 14:01
 */

namespace App\Ipolitic\Nawpcore\Fields;

use App\Ipolitic\Nawpcore\Components\Field;
use App\Ipolitic\Nawpcore\Interfaces\FieldInterface;

class WysiwygField extends Field implements FieldInterface
{
    public function checkValidity(): string
    {
        // TODO: Implement checkValidity() method.
        return "";
    }

    public function getViews(): array
    {
        // TODO: Implement render() method.
        return [];
    }
}
