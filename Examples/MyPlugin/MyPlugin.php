<?php
/*
 * MyPlugin.php - demo plugin for Stud.IP
 * Copyright (c) 2011  Elmar Ludwig
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 */

class MyPlugin extends StudipPlugin implements SystemPlugin
{
    public function __construct()
    {
        parent::__construct();

        $username = get_username();
        $css = "#barTopFont:after { content: '[$username]'; }";
        PageLayout::addStyle($css);
    }
}
