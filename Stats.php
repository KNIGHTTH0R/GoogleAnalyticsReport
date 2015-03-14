<?php

require_once '/google-api-php-client-master/autoload.php';

class Stats
{
    private $id = null;
    private $dimension = null;
    private $metrics = null;
    private $mail = null;
    private $apicode = null;
    private $auth = null;
    private $appname = null;
    private $maxresult = null;
    private $pathkey = null; //key.p12
    private $datestart = null;
    private $dateend = null;

    public function __construct()
    {
    }

    public function fetch()
    {

        // step auth
        $key = file_get_contents($this->pathkey);

        $client = new Google_Client();
        $client->setApplicationName($this->appname);
        $client->setAssertionCredentials(
          new Google_Auth_AssertionCredentials(
            $this->mail,
            array('https://www.googleapis.com/auth/analytics.readonly'),
            $key
        ));
        $client->setClientId($this->apicode);// API console
        //$client->setAccessType('offline_access');

        $options['dimensions'] = $this->dimension;
        $options['max-results'] = $this->maxresult;

        $service = new Google_Service_Analytics($client);
        $data = $service->data_ga->get($this->id, $this->datestart, $this->dateend, $this->metrics, $options);
        $res = array(
                'items' => isset($data['rows']) ? $data['rows'] : array(),
                'columnHeaders' => $data['columnHeaders'],
                'totalResults'  => $data['totalResults'],
            );

        return $res;
    }

    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
    }

    public function getDimension()
    {
        return $this->dimension;
    }

    public function setMetrics($metrics)
    {
        $this->metrics = $metrics;
    }

    public function getMetrics()
    {
        return $this->metrics;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setAppName($appName)
    {
        $this->appname = $appName;
    }

    public function getAppName()
    {
        return $this->appname;
    }

    public function setApiCode($apicode)
    {
        $this->apicode = $apicode;
    }

    public function getApiCode()
    {
        return $this->apicode;
    }

    public function setMaxResult($maxresult)
    {
        $this->maxresult = $maxresult;
    }

    public function getMaxResult()
    {
        return $this->maxresult;
    }

    public function setDateStart($datestart)
    {
        if (DateTime::createFromFormat("Y-m-d", $datestart) == false) {
            die('Date format for date start is incorrect, expected format Y-m-d');
        }
        $this->datestart = $datestart;
    }

    public function getDateStart()
    {
        return $this->datestart;
    }

    public function setDateEnd($dateend)
    {
        if (DateTime::createFromFormat("Y-m-d", $dateend) == false) {
            die('Date format for date end is incorrect, expected format Y-m-d');
        }

        $this->dateend = $dateend;
    }

    public function getDateEnd()
    {
        return $this->dateend;
    }

    public function setPathKey($pathkey)
    {
        $this->pathkey = $pathkey;
    }

    public function getPathKey()
    {
        return $this->pathkey;
    }
}
