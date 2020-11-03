<?php
/**
 * ThesisTopics.class.php
 *
 * Plugin for managing and searching Thesis Topics.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * @author      Vannessa Canon Pasquel <cinddy.vannessa.canon.pasquel@uol.de>
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL version 2
 * @category    Thesis Topics
 */

class ThesisTopics extends StudIPPlugin implements StandardPlugin
{
    public function __construct() {
        parent::__construct();

        StudipAutoloader::addAutoloadPath(__DIR__ . '/models');

        // Localization
        bindtextdomain('thesis_topics', realpath(__DIR__.'/locale'));

        if (Navigation::hasItem('/browse')) {
            $navigation = new Navigation(dgettext('thesis_topics', 'Meine Abschlussarbeiten'),
                PluginEngine::getURL($this, [], 'my__topics'));
            Navigation::addItem('/browse/thesis_topics', $navigation);
        }
    }

    /**
     * Plugin name to show in navigation.
     */
    public function getDisplayName()
    {
        return dgettext('thesis_topics', 'Abschlussarbeiten');
    }

    public function getVersion()
    {
        $metadata = $this->getMetadata();
        return $metadata['version'];
    }


    public function getTabNavigation($course_id)
    {
        if ($GLOBALS['user']->id == 'nobody') {
            return [];
        }

        $navigation = new Navigation($this->getDisplayName());
        $navigation->setURL(PluginEngine::getLink($this, array(), 'filterWrapper'));
        $navigation->setImage(Icon::create('doctoral-cap'));
        return compact('navigation');
    }

    public function getInfoTemplate($course_id)
    {

    }

    public function getIconNavigation($course_id, $last_visit, $user_id)
    {

    }
}
