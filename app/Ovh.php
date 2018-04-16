<?php
namespace LaravelAcl;
require __DIR__ . '/../vendor/autoload.php';
use \Ovh\Api;
define('endpoint', 'ovh-eu');
define('applicationKey', '54pSsl0d1D9PG53M');
define('applicationSecret', 'TbvSTDVyESAeGsk4VHQE3r9Lv4Dy7fpg');
define('consumer_key', '1SDPLfaM3MXfzqsoH9f8BW4HpuLOhuLP');

class Ovh{

  public static function checkSms($number, $message){
    $conn = new Api(applicationKey,
    applicationSecret,
    endpoint,
    consumer_key);
    $smsServices = $conn->get('/sms/');
    foreach ($smsServices as $smsService) {
      print_r($smsService);
    }
    $content = (object) array(
      "charset"=> "UTF-8",
      "class"=> "phoneDisplay",
      "coding"=> "7bit",
      "message"=> $message,
      "noStopClause"=> false,
      "priority"=> "high",
      "receivers"=> [ $number ],
      "senderForResponse"=> true,
      "validityPeriod"=> 2880
    );
    $resultPostJob = $conn->post('/sms/'. $smsServices[0] . '/jobs/', $content);
    $smsJobs = $conn->get('/sms/'. $smsServices[0] . '/jobs/');
    return true;
  }
}

?>
