pushNotification
================

A simple Class to send Push Notifications through Google Cloud Messaging


## How to use

```php
<?php
// Example
require 'intothenexo.pushNotification.php';

// Registration Ids
$registration_ids = array("Valid_ID1", "Invalid_ID2", "Invalid_ID3");

// Message Data
$message_data = array(
    'title'      => "pushNotification Notification Demo",
    'message'    => "Hello!",
    'timeToLive' => 3000
);

// Pass the GCM Project Id
$pushNotification = new \Intothenexo\pushNotification("GCM_Project_Id");

// Sends the Push Notification
$push = $pushNotification->sendGCMNotification(array(
    'registration_ids' => $registration_ids,
    'data'             => $message_data
));

// Response as Object
echo "$push->success messages successfully delivered.<br>";
echo "$push->failure messages failed.<br><br>";

foreach ($push->results as $key => $msg) {
    if (isset($msg->message_id)) echo "Registration Id [$key] OK message_id: $msg->message_id <br>";
    if (isset($msg->error)) echo "Registration Id [$key] Error: $msg->error <br>";
}

// Dump:
// > 1 messages successfully delivered.
// > 2 messages failed.
// >
// > Registration Id [0] OK message_id: 0:1407193585534208%3ec8bd5af9fd7ecd
// > Registration Id [1] Error: InvalidRegistration
// > Registration Id [2] Error: InvalidRegistration

```

## Contact

[@intothenexo](https://twitter.com/intothenexo)
