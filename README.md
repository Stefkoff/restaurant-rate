Site for rating restaurants.

It's in Counstruction.

<h1>Requerments</h1>
1. XAMPP
2. PHP IDE
3. Composer

<h1>Instalation</h1>
1. Git clone
2. Open root folder -> restaurant-rate <- with command line and run "yii migrate"
3. Git clone -> https://github.com/Stefkoff/rest-socket
4. Follow the instructions from rest-socket resposibory
5. Create new php file "params-devel.php" under config folder and add the following code:

<code>
<?php
return [
  'socketIpAddress' => 'ip address'
];
</code>

<b>Note</b>
<em>"ip address" is the ip address of the socket server, where it is running. For example: if you run the socket server on the same machine as this server, you type "localhost". I its somewhere in the local area network: e.g. "192.168.0.2"</em>

Using Yii2 frawemork
