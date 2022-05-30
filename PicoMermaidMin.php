<?php
/**
 * This file is part of Pico. It's copyrighted by the contributors recorded
7 * in the version control history of the file, available from the following
 * original location:
 *
 * <https://github.com/picocms/Pico/blob/master/plugins/DummyPlugin.php>
 *
 * SPDX-License-Identifier: MIT
 * License-Filename: LICENSE
 */

/**
 * Pico dummy plugin - a template for plugins
 *
 * You're a plugin developer? This template may be helpful :-)
 * Simply remove the events you don't need and add your own logic.
 *
 * @author  Daniel Rudolf
 * @link    http://picocms.org
 * @license http://opensource.org/licenses/MIT The MIT License
 * @version 2.1
 */
class PicoMermaidMin extends AbstractPicoPlugin
{
    /**
     * API version used by this plugin
     *
     * @var int
     */
    const API_VERSION = 3;

    /**
     * This plugin is disabled by default
     *
     * Usually you should remove this class property (or set it to NULL) to
     * leave the decision whether this plugin should be enabled or disabled by
     * default up to Pico. If all the plugin's dependenies are fulfilled (see
     * {@see DummyPlugin::$dependsOn}), Pico enables the plugin by default.
     * Otherwise the plugin is silently disabled.
     *
     * If this plugin should never be disabled *silently* (e.g. when dealing
     * with security-relevant stuff like access control, or similar), set this
     * to TRUE. If Pico can't fulfill all the plugin's dependencies, it will
     * throw an RuntimeException.
     *
     * If this plugin rather does some "crazy stuff" a user should really be
     * aware of before using it, you can set this to FALSE. The user will then
     * have to enable the plugin manually. However, if another plugin depends
     * on this plugin, it might get enabled silently nevertheless.
     *
     * No matter what, the user can always explicitly enable or disable this
     * plugin in Pico's config.
     *
     * @see AbstractPicoPlugin::$enabled
     * @var bool|null
     */
    protected $enabled = true;


    /**
     * This plugin depends on ...
     *
     * If your plugin doesn't depend on any other plugin, remove this class
     * property.
     *
     * @see AbstractPicoPlugin::$dependsOn
     * @var string[]
     */
    protected $dependsOn = array();

    public function onContentParsed(&$content)
    {
        $content .= "\n" . '<script src="' . $this->getConfig('plugins_url') . 'PicoMermaidMin/mermaid.min.js"></script>' . "\n";
        $content .= '<script>mermaid.initialize({ startOnLoad: true });</script>' . "\n";
    }


    /**
     * Triggered after Pico has rendered the page
     *
     * @see DummyPlugin::onPageRendering()
     *
     * @param string &$output contents which will be sent to the user
     */
    public function onPageRendered(&$output)
    {
        $output = preg_replace('~<pre><code class="language-mermaid">(.+?)<\/code><\/pre>~ms','<div class="mermaid">$1</div>',$output);
    }

}

