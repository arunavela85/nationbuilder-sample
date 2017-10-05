<?php
/**
 * Peoples List
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
$response = $client->fetch($baseApiUrl . '/api/v1/people?limit=100&access_token=' . $access_token);
$result = $response['result']['results'];
require 'header.php';
?>
<div class="container">   
  <h2>Peoples</h2>
  <hr>
  <table class="table table-striped">
    <tr>
      <td colspan="8">&nbsp;</td>
      <td colspan="2"><a href="people.php?action=new">Add People</a></td>
    </tr>
    <tr>
      <td>#</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Email</td>
      <td>Phone</td>
      <td>Address1</td>
      <td>City</td>
      <td>State</td>
      <td>Zip</td>
      <td></td>
    </tr>
    <?php $i=1; foreach($result as $res): ?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $res['first_name'];?></td>
        <td><?php echo $res['last_name'];?></td>
        <td><?php echo $res['email'];?></td>
        <td><?php echo $res['phone'];?></td>
        <td><?php echo $res['primary_address']['address1'];?></td>
        <td><?php echo $res['primary_address']['city'];?></td>
        <td><?php echo $res['primary_address']['state'];?></td>
        <td><?php echo $res['primary_address']['zip'];?></td>
        <td><a href="people.php?action=edit&id=<?php echo $res['id'];?>">Edit | <a onclick='javascript:confirmationDelete($(this));return false;' href="people.php?action=delete&id=<?php echo $res['id'];?>">Delete</a>
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