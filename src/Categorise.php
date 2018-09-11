<?php
/**
 * Categorise plugin for Craft CMS 3.x
 *
 * Field type to select categories from across multiple category sources
 *
 * @link      http://ournameismud.co.uk/
 * @copyright Copyright (c) 2018 @cole007
 */

namespace ournameismud\categorise;

use ournameismud\categorise\fields\Categories as CategoriesField;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class Categorise
 *
 * @author    @cole007
 * @package   Categorise
 * @since     0.0.1
 *
 */
class Categorise extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Categorise
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '0.0.1';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = CategoriesField::class;
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'categorise',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
