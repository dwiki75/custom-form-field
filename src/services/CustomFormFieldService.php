<?php
namespace dwiki\customformfield\services;

use Craft;
use craft\base\Component;

class CustomFormFieldService extends Component
{
    public function render(): string
    {
        $settings = \dwiki\customformfield\CustomFormField::getInstance()->getSettings();

        return Craft::$app->view->renderTemplate('custom-form-field/_field', [
            'settings' => $settings
        ]);
    }
}