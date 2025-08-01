<?php
namespace dwiki\customformfield\models;

use craft\base\Model;

class Settings extends Model
{
    public array $fields = [];

    public function rules(): array
    {
        return [
            ['fields', 'safe'],
        ];
    }
}
