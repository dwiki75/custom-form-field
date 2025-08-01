<?php
namespace dwiki\customformfield;

use Craft;
use craft\base\Plugin;
use dwiki\customformfield\models\Settings;
use dwiki\customformfield\services\CustomFormFieldService;

class CustomFormField extends Plugin
{
    public bool $hasCpSettings = true;

    public function init()
    {
        parent::init();

        $this->setComponents([
            'field' => CustomFormFieldService::class,
        ]);

        Craft::$app->view->registerTwigExtension(new class extends \Twig\Extension\AbstractExtension {
            public function getFunctions()
            {
                return [
                    new \Twig\TwigFunction('craft.customFormField.render', function () {
                        return CustomFormField::getInstance()->field->render();
                    }, ['is_safe' => ['html']]),
                ];
            }
        });
    }

    protected function createSettingsModel(): ?\craft\base\Model
    {
        return new Settings();
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('custom-form-field/_settings', [
            'settings' => $this->getSettings()
        ]);
    }
}