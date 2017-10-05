<?php
/**
 * Add/Edit People
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
require 'config.inc.php';
if (!empty($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $response = $client->fetch($baseApiUrl . '/api/v1/people/'. $id.'?access_token=' . $access_token);
    $result = $response['result']['person'];
} else if (!empty($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $response = $client->fetch($baseApiUrl . '/api/v1/people/'. $id.'?access_token=' . $access_token, '', 'DELETE');
    if ($response) {
        header("Location: peoples.php");
        exit();
    }
} else {
    if (!empty($_POST)) {
        $body['person'] = $_POST;
        $header = array('Content-Type' => 'application/json', 'Accept' => 'application/json');
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $response = $client->fetch($baseApiUrl . '/api/v1/people/'. $id.'?access_token=' . $access_token, json_encode($body), 'PUT', $header);
        } else {
            $response = $client->fetch($baseApiUrl . '/api/v1/people?access_token=' . $access_token, json_encode($body), 'POST', $header);
        }
        if ($response) {
            header("Location: peoples.php");
            exit();
        }
    }
}
require 'header.php';
?>
<div class="container">   
  <h2> <?php
            if (!empty($_GET['id'])) {
                echo "Update People";
            } else { 
                echo "Add People"; 
            }
        ?>
    </h2>
    <hr>
    <form action="people.php" method="post">
        <div class="form-horizontal">
            <label for="name">First name:</label></td>
            <input class="form-control" type="text" name="first_name" value="<?php if(!empty($result['first_name'])) echo $result['first_name'];?>">
        </div>
        <div class="form-group">
            <label for="headline">Last name:</label></td>
            <input class="form-control" type="text" name="last_name" value="<?php if(!empty($result['last_name'])) echo $result['last_name'];?>">
        </div>
        <div class="form-group">
            <label for="venue">Email:</label></td>
            <input class="form-control" type="text" name="email" value="<?php if(!empty($result['email'])) echo $result['email'];?>">
        </div>
        <div class="form-group">
            <label for="start_time">Phone :</label></td>
            <input class="form-control" type="text" name="phone" value="<?php if(!empty($result['phone'])) echo $result['phone'];?>">
        </div>
        <div class="form-group">
            <label for="name">Address 1:</label></td>
            <input class="form-control" type="text" name="home_address[address1]" value="<?php if(!empty($result['home_address']['address1'])) echo $result['primary_address']['address1'];?>">
        </div>
        <div class="form-group">
            <label for="name">City:</label></td>
            <input class="form-control" type="text" name="home_address[city]" value="<?php if(!empty($result['home_address']['city'])) echo $result['primary_address']['city'];?>">
        </div>
        <div class="form-group">
            <label for="name">State:</label></td>
            <input class="form-control" type="text" name="home_address[state]" value="<?php if(!empty($result['home_address']['state'])) echo $result['primary_address']['state'];?>">
        </div>
        <div class="form-group">
            <label for="name">Zip:</label></td>
            <input class="form-control" type="text" name="home_address[zip]" value="<?php if(!empty($result['home_address']['zip'])) echo $result['primary_address']['zip'];?>">
        </div>
        <?php if (!empty($_GET['id'])): ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">
        <?php
            if (!empty($_GET['id'])) {
                echo "Update People";
            } else { 
                echo "Add People"; 
            }
        ?>
        </button>
    </form>
<?php require 'footer.php'; ?>