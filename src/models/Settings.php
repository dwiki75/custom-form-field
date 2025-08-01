<?php
namespace dwiki\customformfield\models;

use craft\base\Model;

class Settings extends Model
{
    public string $label = 'Név';
    public string $placeholder = 'Add meg a neved';
    public string $type = 'text';
    public bool $required = true;

    public function rules(): array
    {
        return [
            [['label', 'placeholder', 'type'], 'string'],
            [['required'], 'boolean'],
        ];
    }
}