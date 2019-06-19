A simple php class that allows you to send Firebase Cloud Messaging /fcm notifications from your php

Firebase Cloud Messaging (FCM) is a cross-platform messaging solution that lets you reliably deliver messages at no cost.


### Table of Contents
**[Server Requirements](#initialization)**
**[Initialization](#initialization)**  
**[Notifications](#notification)**  
**[Topics](#topics)**  


### Server Requirements
you will need to make sure your server meets the following requirements:
PHP >= 5.3
cURL PHP Extension 
JSON PHP Extension
### Installation
To use this class, simply import PushNotifications.php into your project, and require it then make sure that assign value in Config Array keys in : FIREBASE_API_KEY, APP_NAME, FIREBASE_URL.

```php
require_once ('PushNotifications.php');
```

### Initialization
Simple initialization: make sure the following assign value in Config Array keys in : FIREBASE_API_KEY, APP_NAME, FIREBASE_URL.


```php
$fcm = new FCM();

```

### Notifications

Send notifications to one registration token

```php
$token = ['ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6XQipX-uMO1Jqq6efttxu8V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1'];
$body = "Hare Krishna";
$data = ['test'=>'99', 'Test2'=>1947];

$fcm->notification($token, $body, $data);
```

or Send notifications with a different title than the APP_NAME constant value
```php
$token = ['ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1'];
$body = "Hare Krishna";
$title = APP_NAME . ' version 1.0'

$fcm->notification($token, $body, null, $title);
```

or Send notifications with a list of tokens (multiple devices)
```php
// 8 android devices
$token = [
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
    'ciAXznOu4xx:APA91bF7TctN8-PJgGxSqJQQjaQM0BZE6PXipX-uMO1Jqq6efttxu9V9JVNrDFwOaPUl22M0BTOTDsBHhOShKGv9nEDv1kKMoU6qiEqwDvTk4oPeXXc1qy9n9VeaIoR4vN1wQzj7bqu1', 
];

$body = "Hare Krishna";
$data = ['test'=>'99', 'Test2'=>1947];

$fcm->notification($token, $body, $data);
```

### Topics

Send notifications to devices subscribed to a certain topic
```php
// null indicates no condition for the topic
$data = ['test'=>'99', 'Test2'=>1947];
$fcm->topics('testTopics', null, 'Hare Krishna', $data);
```

or Send filtered topic notifications with conditions
```php
// null indicates no condition for the topic
$data = ['test'=>'99', 'Test2'=>1947];
$condition = "'testTopics' in topics && ('testTopics1' in topics || 'testTopics2' in topics)";
$body = 'Hare Krishna';
$fcm->topics(null, $condition, $body, $data);
```

### Where To Look For Further Info
- [Send messages using the legacy app server protocols](https://firebase.google.com/docs/cloud-messaging/send-message#send_messages_using_the_legacy_app_server_protocols)
- [Offical Guides / Doc ](https://firebase.google.com/docs/cloud-messaging/)
