# Namecheap API implementation in PHP

## search($domain)
Searches a domain name and returns a `JSON` response.

## buy($domain, $address, $years)
Buys a domain name and returns a `JSON` response.

 - `$domain` (`string`) - the domain name you wish to purchase.
 - `$address` (`array`) - an array with First Name, Last Name, Address, City, Zip, State, Phone, Email
 - `$years` (`int`) [`optional`] - number of years you wish to purchase the domain for, *defaults to 1*. 

## setHosts($sld, $tld, $records)
Sets a record for the domain and returns a `JSON` response.

 - `$sld` (`string`) - the sld of the domain *(i.e. from domain.com -> the **domain**)*
 - `$tld` (`string`) - the tld of the domain
 - `$records` (`array of objects`) - each object should contain a record **name**, and record **type**. 
   - `$record->ip` (`string`) [`optional`] - the record ip is optional

## setDefault($sld, $tld) 
Sets the domain DNS to Namecheap Basic and returns a `JSON` response. If you don't set the domain DNS to Basic, it'll point to your namecheap hosting account.

 - `$sld` (`string`) - the sld of the domain *(i.e. from domain.com -> the **domain**)*
 - `$tld` (`string`) - the tld of the domain
 
 
 
### Sorry about the limited implementation. I'll add more functionality as I'm using it.
 
[Artur Grigio](https://www.linkedin.com/in/artur-grigio-06179546)