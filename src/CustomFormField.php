<?php
namespace dwiki\customformfield;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;
use dwiki\customformfield\models\Settings;
use dwiki\customformfield\variables\CustomFormFieldVariable;

class CustomFormField extends Plugin
{
    public static $plugin;
    public bool $hasCpSettings = true;

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Twig változó regisztrálás
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                $variable = $event->sender;
                $variable->set('customFormField', CustomFormFieldVariable::class);
            }
        );

        Craft::info('CustomFormField plugin loaded', __METHOD__);
    }

    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate(
            'custom-form-field/settings',
            ['settings' => $this->getSettings()]
        );
    }

    public function renderFields(): string
    {
        $settings = $this->getSettings();
        $html = '';

        if (!empty($settings->fields) && is_array($settings->fields)) {
            foreach ($settings->fields as $field) {
                $type = $field['type'] ?? 'text';
                $placeholder = $field['placeholder'] ?? '';
                $class = $field['class'] ?? 'w-full p-2 bg-gray-100 rounded-md';

                if ($type === 'select') {
                    $html .= "<select class='{$class}'>";
                    if (!empty($field['options'])) {
                        $options = explode("\n", $field['options']);
                        foreach ($options as $opt) {
                            $opt = trim($opt);
                            if ($opt) {
                                $html .= "<option value='{$opt}'>{$opt}</option>";
                            }
                        }
                    }
                    $html .= "</select>";
                } else {
                    $html .= "<input type='{$type}' placeholder='{$placeholder}' class='{$class}'>";
                }
            }
        }

        return $html;
    }
}
