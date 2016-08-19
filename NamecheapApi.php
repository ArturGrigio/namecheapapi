<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use GuzzleHttp\Client as Guzzle;
    
    use App\Http\Requests;
    
    class NamecheapApi extends Controller
    {
        protected $client;
        protected $base_uri;
        protected $user;
        protected $apiKey;
        protected $ip;
        
        public function __construct() {
            $this->apiKey = env('NAMECHEAP_API_KEY');
            $this->user = env('NAMECHEAP_USER');
            $this->ip = env('SERVER_IP');
            $this->base_uri = "https://api.namecheap.com/xml.response?";
            $this->client = new Guzzle([$this->base_uri]);
        }
        
        public function search($domain) {
            $response = $this->client->request('GET',
                                               "ApiUser=".$this->user.
                                               "&ApiKey=".$this->apiKey.
                                               "UserName=".$this->user.
                                               "Command="."namecheap.domains.check".
                                               "ClientIp=".$this->ip.
                                               "DomainList=".$domain
                                               );
            return $response->getStatusCode() == 200 ? true : false;
        }
        
        public function buy($domain) {
            
        }
        
        private function setDefault() {
            
        }
        
        private function setHosts($domain) {
            
        }
    }