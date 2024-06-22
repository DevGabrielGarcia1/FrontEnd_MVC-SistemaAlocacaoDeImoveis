<?php
namespace generic;

class CUrlRequest {

    const GET = "GET";
    const POST = "POST";

    private $url;
    private $token;

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
            curl_setopt($cUrl, CURLOPT_HTTPHEADER, "Authorization: Bearer ".$this->token);

        curl_setopt_array($cUrl, [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $metod,
            CURLOPT_POSTFIELDS => json_encode($params)
        ]);

        $response = curl_exec($cUrl);

        $data = json_decode($response, true, 512);

        curl_close($cUrl);

        return $data;
    }

}

?>