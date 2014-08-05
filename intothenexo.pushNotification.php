<?php
/**
 * pushNotification
 *
 * A simple Class to send Push Notifications through Google Cloud Messaging.
 *
 * @author      Daniel Castro <intothenexo@outlook.com>
 * @copyright   2014 Daniel Castro
 * @link        https://github.com/intothenexo/pushnotification/
 * @version     1.0.0
 * @license     MIT
 *
 */
namespace Intothenexo;

class pushNotification
{
    /** GCM Project Id */
    private $api_key;

    /** GCM API URI */
    private $gcm_api_uri = "https://android.googleapis.com/gcm/send";

    /** HTTP Headers*/
    private $headers;

    /** Registration Ids */
    private $registration_ids;

    /** Exception messages */
    private $msg = array(
        'You must provide the GCM Project Id.',
        'You must provide an array of Registered Ids.',
        'You must provide an array with the Message Data.'
    );

    /**
     * Constructor
     * @param string    $api_key         GDC Project Id
     * @param array     $registrationIds Registration Ids
     */
    public function __construct($api_key)
    {
        if (! $api_key) throw new \Exception($this->msg[0]);

        $this->api_key = $api_key;
    }

    /**
     * GCM HTTP Headers
     * @return array HTTP Headers
     */
    private function getGCMHeaders()
    {
        return array("Content-Type:" . "application/json", "Authorization:" . "key=" . $this->api_key);
    }

    /**
     * Sends a GCM Push Notification
     * @param  array    $data   Data to send
     * @return object           GCM Response
     */
    public function sendGCMNotification($data)
    {
        if (! is_array($data['registration_ids'])) throw new \Exception($this->msg[1]);
        if (! is_array($data['data'])) throw new \Exception($this->msg[2]);

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $this->getGCMHeaders() );
        curl_setopt( $ch, CURLOPT_URL, $this->gcm_api_uri );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data) );

        $r = curl_exec($ch);
        curl_close($ch);

        return json_decode($r);
    }
}
