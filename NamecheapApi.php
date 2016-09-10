<?php

namespace App;

class NamecheapApi
{
    protected $client;
    protected $base_uri;
    protected $user;
    protected $apiKey;
    protected $ip;

    public function __construct($ip = null) {
        $live = env('NAMECHEAP_LIVE');
        $this->apiKey = $live ? env('NAMECHEAP_API_KEY') : env('NAMECHEAP_SANDBOX_API_KEY');
        $this->user = env('NAMECHEAP_USER');
        $this->ip = env('SERVER_IP', $ip);
        $this->base_uri = $live ? "https://api.namecheap.com/xml.response?" : "https://api.sandbox.namecheap.com/xml.response?";
    }

    public function search($domain) {
        $response = file_get_contents($this->base_uri.
            "ApiUser=".$this->user.
            "&ApiKey=".$this->apiKey.
            "&UserName=".$this->user.
            "&Command="."namecheap.domains.check".
            "&ClientIp=".$this->ip.
            "&DomainList=".$domain);
        return $this->makeTheRequest($response);
    }

    public function buy($domain, $address) {
        $response = file_get_contents($this->base_uri.
            "ApiUser=".$this->user.
            "&ApiKey=".$this->apiKey.
            "&UserName=".$this->user.
            "&Command="."namecheap.domains.create".
            "&ClientIp=".$this->ip.
            "&DomainName=".$domain.
            "&Years=1".
            "&AuxBillingFirstName=".$address['fName'].
            "&AuxBillingLastName=".$address['lName'].
            "&AuxBillingAddress1=".urlencode($address['address']).
            "&AuxBillingStateProvince=".$address['state'].
            "&AuxBillingPostalCode=".$address['zip'].
            "&AuxBillingCountry=US".
            "&AuxBillingPhone=".$address['phone'].
            "&AuxBillingEmailAddress=".$address['email'].
            "&AuxBillingCity=".$address['city'].
            "&TechFirstName=".$address['fName'].
            "&TechLastName=Zen".
            "&TechAddress1=".urlencode($address['address']).
            "&TechStateProvince=".$address['state'].
            "&TechPostalCode=".$address['zip'].
            "&TechCountry=US".
            "&TechPhone=".$address['phone'].
            "&TechEmailAddress=".$address['email'].
            "&TechCity=".$address['city'].
            "&AdminFirstName=".$address['fName'].
            "&AdminLastName=".$address['lName'].
            "&AdminAddress1=".urlencode($address['address']).
            "&AdminStateProvince=".$address['state'].
            "&AdminPostalCode=".$address['zip'].
            "&AdminCountry=US".
            "&AdminPhone=".$address['phone'].
            "&AdminEmailAddress=".$address['email'].
            "&AdminCity=".$address['city'].
            "&RegistrantFirstName=".$address['fName'].
            "&RegistrantLastName=".$address['lName'].
            "&RegistrantAddress1=".urlencode($address['address']).
            "&RegistrantStateProvince=".$address['state'].
            "&RegistrantPostalCode=".$address['zip'].
            "&RegistrantCountry=US".
            "&RegistrantPhone=".$address['phone'].
            "&RegistrantEmailAddress=".$address['email'].
            "&RegistrantCity=".$address['city']
        );
        return $this->makeTheRequest($response);
    }

    public function setDefault($sld, $tld) {
        $response = file_get_contents($this->base_uri.
            "ApiUser=".$this->user.
            "&ApiKey=".$this->apiKey.
            "&UserName=".$this->user.
            "&Command="."namecheap.domains.dns.setDefault".
            "&ClientIp=".$this->ip.
            "&SLD=".$sld.
            "&TLD=".$tld
        );
        return $this->makeTheRequest($response);
    }

    public function setHosts($sld, $tld, $records) {
        $recordString = "";
        foreach ($records as $record) {
            $recordString .=
                "&HostName1=".$record['name'].
                "&RecordType1=".$record['type'].
                "&Address1=".$this->ip.
                "&TTL1=1200";
        }
        $response = file_get_contents($this->base_uri.
            "ApiUser=".$this->user.
            "&ApiKey=".$this->apiKey.
            "&UserName=".$this->user.
            "&Command="."namecheap.domains.dns.setHosts".
            "&ClientIp=".$this->ip.
            "&SLD=".$sld.
            "&TLD=".$tld.
            $recordString
        );
        return $this->makeTheRequest($response);
    }

    private function makeTheRequest($request) {
        str_replace("@", "", $request);
        $xml = simplexml_load_string($request);
        return json_encode($xml);
    }
}
