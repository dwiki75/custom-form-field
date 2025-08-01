<?php
namespace dwiki\customformfield;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;
use dwiki\customformfield\variables\CustomFormFieldVariable;

class CustomFormField extends Plugin
{
    public static $plugin;

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Twig változó regisztrálása
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('customFormField', CustomFormFieldVariable::class);
            }
        );

        Craft::info('CustomFormField plugin loaded', __METHOD__);
    }

    public function renderField(array $options = []): string
    {
        $type = $options['type'] ?? 'text';
        $placeholder = $options['placeholder'] ?? 'Írj ide valamit...';
        $class = $options['class'] ?? 'w-full p-2 bg-gray-100 rounded-md';

        return "<input type='{$type}' placeholder='{$placeholder}' class='{$class}'>";
    }
}
