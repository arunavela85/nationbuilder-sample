<?php
/**
 * Add/Edit Event
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
    $response = $client->fetch($baseApiUrl . '/api/v1/sites/' . $nation_slug . '/pages/events/'. $id.'?access_token=' . $access_token);
    $result = $response['result']['event'];
} else if (!empty($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $response = $client->fetch($baseApiUrl . '/api/v1/sites/' . $nation_slug . '/pages/events/'. $id.'?access_token=' . $access_token, '', 'DELETE');
    if ($response) {
        header("Location: events.php");
        exit();
    }
} else {
    if (!empty($_POST)) {
        $body['event'] = $_POST;
        echo json_encode($body);
        $header = array('Content-Type' => 'application/json', 'Accept' => 'application/json');
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $response = $client->fetch($baseApiUrl . '/api/v1/sites/' . $nation_slug . '/pages/events/'. $id.'?access_token=' . $access_token, json_encode($body), 'PUT', $header);
        } else {
            $response = $client->fetch($baseApiUrl . '/api/v1/sites/' . $nation_slug . '/pages/events?access_token=' . $access_token, json_encode($body), 'POST', $header);
        }
        if ($response) {
            header("Location: events.php");
            exit();
        }
    }
}
require 'header.php';
?>
<div class="container">   
  <h2> <?php
            if (!empty($_GET['id'])) {
                echo "Update Event";
            } else { 
                echo "Create Event"; 
            }
        ?>
    </h2>
    <hr>
    <form action="event.php" method="post">
        <div class="form-horizontal">
            <label for="name">Event name:</label></td>
            <input class="form-control" type="text" name="name" value="<?php if(!empty($result['name'])) echo $result['name'];?>">
        </div>
        <div class="form-group">
            <label for="headline">Headline:</label></td>
            <input class="form-control" type="text" name="headline" value="<?php if(!empty($result['headline'])) echo $result['headline'];?>">
        </div>
        <div class="form-group">
            <label for="venue">Venue:</label></td>
            <input class="form-control" type="text" name="venue[name]" value="<?php if(!empty($result['venue']['name'])) echo $result['venue']['name'];?>">
        </div>
        <div class="form-group">
            <label for="start_time">Start time :</label></td>
            <input id="datepicker1" class="form-control" type="text" name="start_time" value="<?php if(!empty($result['start_time'])) echo $result['start_time'];?>"> 
            <script type="text/javascript">
                $(function() {
                    $('*[name=start_time]').appendDtpicker();
                });
            </script>
        </div>
        <div class="form-group">
            <label for="end_time">End time:</label></td>
            <input id="datepicker2" class="form-control" type="text" name="end_time" value="<?php if(!empty($result['end_time'])) echo $result['end_time'];?>">
            <script type="text/javascript">
                $(function(){
                    $('*[name=end_time]').appendDtpicker();
                });
            </script>
        </div>
        <div class="form-group">
            <label for="name">Contact Name:</label></td>
            <input  class="form-control" type="text" name="contact[name]" value="<?php if(!empty($result['contact']['name'])) echo $result['contact']['name'];?>">
        </div>
        <div class="form-group">
            <label for="name">Contact Phone:</label></td>
            <input  class="form-control" type="text" name="contact[phone]" value="<?php if(!empty($result['contact']['name'])) echo $result['contact']['phone'];?>">
        </div>
        <div class="form-group">
            <label for="name">Contact email:</label></td>
            <input  class="form-control" type="text" name="contact[email]" value="<?php if(!empty($result['contact']['name'])) echo $result['contact']['email'];?>">
        </div>
        <input type="hidden" name="status" value="published" />
        <?php if (!empty($_GET['id'])): ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">
            <?php
                if (!empty($_GET['id'])) {
                    echo "Update Event";
                } else { 
                    echo "Create Event"; 
                }
            ?>
        </button>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        $('#datepicker1').dtpicker();
        $('#datepicker2').dtpicker();
    });
</script>
<?php require 'footer.php'; ?>