<? if (!empty($log_actions)) : ?>
    <table class="default collapsable">
        <colgroup>
            <col style="width: 150px">
            <col>
        </colgroup>
        <? $counter = 0 ?>
        <? foreach ($log_actions as $desc => $events): ?>
            <? if (count($events)) : ?>
                <tbody class="<?= $counter > 0 ? 'collapsed' : '' ?>">
                    <tr class="header-row">
                        <th colspan="2" class="toggle-indicator">
                            <a class="toggler"><?= htmlReady($desc) ?></a>
                        </th>
                    </tr>
                    <? foreach ($events as $event) : ?>
                        <tr>
                            <td>
                                <?= date('d.m.Y H:i:s', $event->mkdate) ?>
                            </td>
                            <td>
                                <small>
                                    <?= $plugin->cleanUp($event) ?>
                                    <? if ($event->info && $GLOBALS['perm']->have_perm('root')): ?>
                                        <br><?= _('Info') . ' ' . $event->info ?>
                                    <? endif ?>
                                    <? if ($event->dbg_info && $GLOBALS['perm']->have_perm('root')): ?>
                                        <br><?= _('Debug:') . ' ' . $event->dbg_info ?>
                                    <? endif ?>
                                </small>
                            </td>
                        </tr>
                    <? endforeach ?>
                </tbody>
                <? $counter++ ?>
            <? endif ?>
        <? endforeach ?>
    </table>
<? else : ?>
    <?= MessageBox::info(_('Es konnten keine Log-Einträge gefunden werden')) ?>
<? endif ?>
