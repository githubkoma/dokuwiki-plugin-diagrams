<?php

if (!defined('DOKU_INC')) die();

class action_plugin_drawio extends DokuWiki_Action_Plugin
{

    public function register(Doku_Event_Handler $controller)
    {
        $controller->register_hook('DOKUWIKI_STARTED', 'AFTER', $this, 'handle_started');
        $controller->register_hook('MENU_ITEMS_ASSEMBLY', 'AFTER', $this, 'add_button');
    }

    public function handle_started(Doku_Event $event, $param)
    {
        global $JSINFO;
        $JSINFO['iseditor'] = auth_quickaclcheck('*') >= AUTH_UPLOAD;
        $JSINFO['sectok'] = getSecurityToken();
    }

    public function add_button(Doku_Event $event, $param)
    {
        if ($event->data['view'] != 'page') return;
        array_splice($event->data['items'], -1, 0, [new dokuwiki\plugin\drawio\MenuItem()]);
    }
}