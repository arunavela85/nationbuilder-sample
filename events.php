<?php
/**
 * Events List
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
$response = $client->fetch($baseApiUrl . '/api/v1/sites/' . $nation_slug . '/pages/events?access_token=' . $access_token);
$result = $response['result']['results'];
require 'header.php';
?>
<div class="container">   
  <h2>Events</h2>
  <hr>
  <table class="table table-striped">
    <tr>
      <td colspan="7">&nbsp;</td>
      <td colspan="2"><a href="event.php?action=new">Create Event</a></td>
    </tr>
    <tr>
      <td>#</td>
      <td>Title</td>
      <td>Headline</td>
      <td>Venue</td>
      <td>Start Time</td>
      <td>End Time</td>
      <td>Contact Person</td>
      <td>Contact Phone</td>
      <td></td>
    </tr>
    <?php $i=1; foreach($result as $res): ?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $res['title'];?></td>
        <td><?php echo $res['headline'];?></td>
        <td><?php echo $res['venue']['name'];?></td>
        <td><?php echo date("F j, Y, g:i a",strtotime($res['start_time'])); ;?></td>
        <td><?php echo date("F j, Y, g:i a",strtotime($res['end_time'])); ;?></td>
        <td><?php echo $res['contact']['name'];?></td>
        <td><?php echo $res['contact']['phone'];?></td>
        <td><a href="event.php?action=edit&id=<?php echo $res['id'];?>">Edit | <a onclick='javascript:confirmationDelete($(this));return false;' href="event.php?action=delete&id=<?php echo $res['id'];?>">Delete</a>
      </tr>
    <?php $i++; endforeach; ?>
  </table>
</div>
<script>
  function confirmationDelete(anchor) {
    var conf = confirm('Are you sure want to delete this record?');
    if (conf) {
      window.location=anchor.attr("href");
    }
  }
</script>
<?php require 'footer.php'; ?>