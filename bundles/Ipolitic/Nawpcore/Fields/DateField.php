<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 16/11/18
 * Time: 16:03
 */

namespace App\Ipolitic\Nawpcore\Fields;

use App\Ipolitic\Nawpcore\Components\Field;
use App\Ipolitic\Nawpcore\Interfaces\FieldInterface;
use App\Ipolitic\Nawpcore\Views\Date;

/**
 * Class DateField
 * @package App\Ipolitic\Nawpcore\Fields
 */
class DateField extends Field implements FieldInterface
{
    /**
     * @var array
     */
    public $prop = [
        "message"       => "",
        "value"         => "",
        "column"        => "",
        "placeholder"   => "",
        "icon"          => "",
        "range"         => [null, null]
    ];
    /**
     * @return string
     */
    public function checkValidity(): string
    {
        $parsedTime = is_int($this->value) ? $this->value : strtotime($this->value);
        if ($parsedTime === false) {
            return  "Given value was not a valid date.";
        }
        // test if in range
        if ((($this->prop["range"][0] === null) || ($parsedTime >= $this->prop["range"][0])) &&
            (($this->prop["range"][0] === null) || ($parsedTime <= $this->prop["range"][1]))) {
            return   "";
        } else {
            $dateTime1 = new \DateTime();
            $dateTime1->setTimestamp($this->prop["range"][0]);
            $dateTime2 = new \DateTime();
            $dateTime2->setTimestamp($this->prop["range"][1]);
            return   ucfirst($this->column) . " must be in range : [" .
               $dateTime1->format("Y-m-d") . "," .
               $dateTime2->format("Y-m-d") ."].";
        }
    }

    /**
     * @return array
     */
    public function getViews(): array
    {
        return [Date::class => $this->prop];
    }
}
