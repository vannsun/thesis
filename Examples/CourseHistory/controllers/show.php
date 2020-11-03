<?php

/**
 * @author David Siegfried <david.siegfried@uni-vechta.de>
 * @license GPL2 or any later version
 */
class ShowController extends StudipController
{
    public function __construct($dispatcher)
    {
        parent::__construct($dispatcher);
        $this->plugin = $dispatcher->plugin;
        $this->course = $this->plugin->course;
    }
    
    public function before_filter(&$action, &$args)
    {
        parent::before_filter($action, $args);
        
        PageLayout::setTitle(htmlReady($this->course->getFullname()) . ' - ' . $this->plugin->getPluginName());
        if (Navigation::hasItem('/course/main/coursehistory')) {
            Navigation::activateItem('/course/main/coursehistory');
        }
    }
    
    /**
     * Index
     */
    public function index_action()
    {
        $this->log_actions = $this->getLogEvents();
    }
    
    /**
     * Returns all log-events for given course
     */
    protected function getLogEvents()
    {
        $query = "SELECT la.`description`, le.`event_id`
                  FROM  `log_events` le
                  JOIN `log_actions` la ON la.`action_id` = le.`action_id`
                  WHERE ? IN (le.`affected_range_id`, le.`coaffected_range_id`, le.`user_id`)
                  ORDER BY le.`mkdate` DESC";
        
        $stmt = DBManager::get()->prepare($query);
        $stmt->execute([$this->course->id]);
        $results = array_map('LogEvent::findMany', $stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC));
        
        array_walk($results, function (&$a) {
            $a = SimpleCollection::createFromArray($a);
            $a->orderBy('mkdate DESC');
        });
        return $results;
    }
}
