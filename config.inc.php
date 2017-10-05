<?php
/**
 * Core configurations
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sample
 * @subpackage Core
 * @author     Aruna Velayutham <velayutham.aruna@gmail.com>
 * @copyright  2017 Datanet Systems Corp
 * @license    http://dnscorp.com/ Datanet Systems Corp Licence
 * @link       http://dnscorp.com/
 */
require 'lib/Client.php';
$clientId = 'b739f502b992b3b0e5dad5dd1afd2411ecc8713a4b24eb034aecd995bd61bbae';
$clientSecret = 'd25628f6223e50af858a510307a25d45e3edbe26d8654d63e2ba144f3eaf4ab3';
$client = new OAuth2\Client($clientId, $clientSecret);
$access_token = '230e23cb290e66272280e4a7be581b1d469935c488793c5d44db1c9ff91138d2';
$nation_slug = 'studysandbox';
$baseApiUrl = 'https://' . $nation_slug . '.nationbuilder.com';