<?php

use Discord\WebSockets\Event;
/*
 *
 * Class for discord.php commands
 *
 * Built with <3 by Moravak
 *
 * */
class Commands
{
    private $commands = [];
    private $prefix;
    
    /*
     *
     * Constructor of class. All methods are non-static, s you need to create the instance
     *
     * @param Discord $discord Your discord instance
     * @param string $prefix Your command prefix
     *
     * */
    function __construct($discord, $prefix)
    {
        $this->discord = $discord;
        $this->prefix = $prefix;
    }

    /*
     *
     * Registers command, must be before executing
     *
     * @param string $name Name of the command
     * @param callback $action Your command action. This action must have arguments $ctx and args
     *
     * ctx is for context of the command
     * args is for arguments that user sent with command
     *
     * */
    function command($name, $action)
    {
        $this->commands[$name] = $action;    
    }
    
    /*
     *
     * Executes command, must be in on ready.
     *
     * */
    function execute()
    {
        $this->discord->on(Event::MESSAGE_CREATE, function($message, $discord) {
            if (str_starts_with($message->content, $this->prefix))
            {
                $ctx = explode(" ", substr($message->content, strlen($this->prefix)));
                $command = $ctx[0];
                if (isset($this->commands[$command]))
                {
                    $args = array_slice($ctx, 1);
                    $this->commands[$command]($message, $args);
                }
            }
        });
    }
}
?>
