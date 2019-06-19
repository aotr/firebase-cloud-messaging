<?php

include_once('PushNotifications.php');

$fcm = new FCM();

$body = "hare krishna";
$data = ['test'=>'99', 'Test2'=>1947];

$token = [
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    // 'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    // 'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
];
$title = 'Test';
$fcm->notification($token, $body, $data, $title);

// $fcm->topics('testTopics', null, 'hare krishna', $data);
