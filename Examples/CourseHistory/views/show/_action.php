<?=
\Studip\LinkButton::createEdit(
    $plugin->getPluginName(),
    PluginEngine::getLink($plugin, ['cid' => $course_id], 'show/index'),
    ['data-dialog' => 'size=100%'])
?>