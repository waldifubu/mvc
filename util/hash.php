<?php
# hash
namespace Util;

class Hash
{	
	/**
	* call: Hash::create('md5', 'password', 'Salt');	
	* @param string $algo Algorhitmus
	* @param string $data Daten zu verschlüsseln
	* @param string $salt Salz
	* 
	* @return string Gesalzen/verschlüsselt
	*/
	public static function create($algo, $data, $salt)
	{
		$context = hash_init($algo, HASH_HMAC, $salt);
		hash_update($context, $data);
		
		return hash_final($context);
	}
		
}
