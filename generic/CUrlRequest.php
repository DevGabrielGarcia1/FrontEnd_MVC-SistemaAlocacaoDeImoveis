<?php
namespace generic;

class CUrlRequest {

    const GET = "GET";
    const POST = "POST";

    private $url;
    private $token;
    
    private $httpCode;

    /**
     * @string $url     Request URL
     * @string $token   token
     */
    public function __construct($url, $token = null) 
    {
        $this->url = $url;
        $this->token = $token;
    }

    /**
     * @array $params   Paramters Get/Post
     * @string $metod      Metod Get or Post, Default Post
     */
    public function __invoke($params, $metod = CUrlRequest::POST)
    {
        $cUrl = curl_init($this->url);

        if ($this->token != null)
            curl_setopt($cUrl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$this->token));

        curl_setopt_array($cUrl, [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $metod,
            CURLOPT_POSTFIELDS => json_encode($params)
        ]);

        $response = curl_exec($cUrl);

        $this->httpCode = curl_getinfo($cUrl, CURLINFO_HTTP_CODE);

        $data = json_decode($response, true, 512);

        curl_close($cUrl);

        return $data;
    }

    public function getHttpCode(){
        return $this->httpCode;
    }

}

?>