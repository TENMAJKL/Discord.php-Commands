# Discord.php commands

Simple class for creating commands more efficiently and easily in discord.php.

# Example

```php

<?php
use Discord\Discord;
use Discord\WebSockets\Event;
include "commands.php";

include __DIR__.'/vendor/autoload.php';

$client = new Discord([
    "token" => "token"

]);

//here you make instance of the commands class and set command prefix
$commands = new Commands($client, "$ ");

//here is example command
$commands->command("hi", function($ctx, $args) {
    $ctx->channel->sendMessage("hi");
});

$client->on("ready", function(Discord $client) {
        global $commands;
        //here every command that is registered calls when user calls the command
        $commands->execute();
});

$client->run()

?>

```

