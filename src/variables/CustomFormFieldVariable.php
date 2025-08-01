<?php
namespace dwiki\customformfield\variables;

use dwiki\customformfield\CustomFormField;

class CustomFormFieldVariable
{
    public function render(array $options = []): string
    {
        return CustomFormField::getInstance()->renderField($options);
    }
}