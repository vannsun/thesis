<?php

/**
 * @author David Siegfried <david.siegfried@uni-vechta.de>
 * @license GPL2 or any later version
 */
class Coursehistory extends StudIPPlugin implements SystemPlugin, AdminCourseAction
{
    public function __construct()
    {
        parent::__construct();
        $this->course = Course::findCurrent();
        if ($GLOBALS['perm']->have_perm('admin') && $this->course) {
            if (Navigation::hasItem('/course/main')) {
                $navigation = new Navigation($this->getPluginName());
                $navigation->setURL(PluginEngine::getURL($this, [], 'show'));
                Navigation::addItem('/course/main/coursehistory', $navigation);
            }
        }
    }
    
    /**
     * Returns the plugin name
     * @return string
     */
    public function getPluginName()
    {
        return _('Änderungsverlauf');
    }
    
    /**
     * Get adminaction url
     * @return bool
     */
    public function getAdminActionURL()
    {
        return false;
    }
    
    /**
     * Dont use multimode
     * @return bool
     */
    public function useMultimode()
    {
        return false;
    }
    
    /**
     * Get template for admin-courses overview
     * @param $course_id
     * @param null $values
     * @return string
     */
    public function getAdminCourseActionTemplate($course_id, $values = null)
    {
        $factory  = new Flexi_TemplateFactory(__DIR__ . '/views');
        $template = $factory->open('show/_action.php');
        $template->set_attribute('course_id', $course_id);
        $template->set_attribute('plugin', $this);
        return $template;
    }
    
    /**
     * Run action
     * @param $unconsumed_path
     */
    public function perform($unconsumed_path)
    {
        $dispatcher = new Trails_Dispatcher(
            $this->getPluginPath(),
            rtrim(PluginEngine::getLink($this, [], null), '/'),
            'show'
        );
        
        $dispatcher->plugin = $this;
        $dispatcher->dispatch($unconsumed_path);
    }
    
    /**
     * Helper function to cleanup output
     * @param $event
     * @return mixed
     */
    public function cleanUp(&$event)
    {
        $info = preg_replace('/chdate:\s+(\d+)\s+=&gt;\s+(\d+)/', '', $event->formatEvent());
        $info = str_replace('admission_turnout', _('max. Teilnehmerzahl'), $info);
        $info = str_replace('=&gt;', '&rarr;', $info);
        return $info;
    }
}
