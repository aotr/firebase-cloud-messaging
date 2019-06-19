<?php



class FCM  
{
    
    const CONTENT_JSON = 'application/json';
    const CONTENT_TEXT = 'application/x-www-form-urlencoded;charset=UTF-8';
    const ERROR = 'error';
    const SUCCESS = 'success';
    const FAILURE = 'failure';
    const CANONICAL_IDS = 'canonical_ids';
    const REGISTRATION_ID = 'registration_id';
    const REGISTRATION_IDS = 'registration_ids';
    const RESULTS = 'results';
    const UNAVAILABLE = 'Unavailable';
    const INVALID = 'InvalidRegistration';
    const NOT_REGISTERED = 'NotRegistered';
    const EXCEEDED = 'TopicsMessageRateExceeded';
    private $header;
    private $content_type;
    private $message;
    private $response;
    private $token;
    private $time_to_live;
    private $collapse_key;
    private $config;

    function __construct() {
        $this->content_type = (empty ($content_type)) ? self::CONTENT_JSON : $content_type ;
        $this->config = include('config.php');
        $this->headers();
    }

    private function headers() {
        $this->headers = [
            'Content-Type:' . $this->content_type,
            'Authorization:key=' . $this->config['FIREBASE_API_KEY']
        ];
    }
    public function topics($to, $condition, $body=null, $data=null, $title=null) {
        if ($to != null) {
            $this->message['to'] = '/topics/' . $to;
        } elseif ($condition != null) {
            $this->message['condition'] = $condition;
        }
        $this->message($body, $data, $title);
    }
    public function notification($token, $body, $data=null, $title=null) {
        $this->token = $token;
        $this->message[self::REGISTRATION_IDS] = $this->token;

        $this->message($body, $data, $title);
    }


    private function message($body, $data, $title) {
        if ($body != null) {
            $this->message['notification'] = ['title' => $title ? $title : $this->config['APP_NAME'], 'body' => $body];
        }
        if ($data != null) {
            $this->message['data'] = $data;
        }
        if ($this->time_to_live != null) {
            $this->message['time_to_live'] = 60*60*24*5;//$this->time_to_live;
        }
        if ($this->collapse_key != null) {
            $this->message['collapse_key'] = $this->collapse_key;
        }
        $this->send();
    }

    private function response() {


        if ((isset($this->response[self::FAILURE]) && $this->response[self::FAILURE] > 0) || 
            (isset($this->response[self::CANONICAL_IDS]) && $this->response[self::CANONICAL_IDS] > 0)) {
            foreach ($this->response[self::RESULTS] as $key => $result) {
                if (isset($result[self::ERROR])) {
                    switch ($result[self::ERROR]) {
                        case self::UNAVAILABLE:
                            // do something

                            break;
                        case self::INVALID:
                            // do something

                            break;
                        case self::NOT_REGISTERED:
                            // do something
                            
                            break;
                        case self::EXCEEDED:
                            // do something

                            break;
                    }
                } elseif (isset($result[self::REGISTRATION_ID])) {
                   
                    unset($this->token[$key]);
                } else {
                    unset($this->token[$key]);
                }
            }
            $this->send(); // resending     
        }
    }
    private function send() {
        if ($this->message != null) {
            $ch = curl_init();
           
            curl_setopt_array($ch, [
                CURLOPT_URL             => $this->config['FIREBASE_URL'],
                CURLOPT_HTTPHEADER      => $this->headers,
                CURLOPT_POST            => true,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_SSL_VERIFYPEER  => false,
                CURLOPT_POSTFIELDS      => json_encode($this->message)
            ]);
            
            $this->response = json_decode(curl_exec($ch),true);
            curl_close($ch);
            $this->response();
        }
    }
    
}


