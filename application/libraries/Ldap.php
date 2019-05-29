<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ldap {

	function auth($PHP_AUTH_USER1,$PHP_AUTH_PW1)
	{
		//for local		
		$auth=0;
		global $nama;
		$ldapconfig['host'] = 'ldap.telkom.co.id'; 
		$ldapconfig['authrealm'] = 'User Intranet Telkom ND';
		if ($PHP_AUTH_USER1 != "" && $PHP_AUTH_PW1 != "") 
		{
			$ds=ldap_connect($ldapconfig['host']);
			$r = ldap_search( $ds, " ", 'uid=' . $PHP_AUTH_USER1);
			if ($r) {
				$result = ldap_get_entries( $ds, $r);
				if (isset($result[0])) {
					if (@ldap_bind( $ds, $result[0]['dn'], $PHP_AUTH_PW1) ) {
						$auth=1;
					}
				}
			}
		}
		return $auth;
	
	}

	function bind($PHP_AUTH_USER1)
	{
		$ldapconfig['host'] = '10.0.32.230'; 
		$ldapconfig['authrealm'] = 'User Intranet Telkom ND';
		$ds=@ldap_connect($ldapconfig['host']);

		if ($ds) {
			$r = @ldap_search( $ds, " ", 'uid=' . $PHP_AUTH_USER1);
			if ($r) {
				$result = @ldap_get_entries( $ds, $r);
				if (isset($result[0])) {
					if (@ldap_bind( $ds, $result[0]['dn'], $PHP_AUTH_PW1) ) {
						$auth=1;
					}
				}
			}
		}
		return $result;
	
	}

}

/* End of file Ldap.php */
/* Location: ./application/libraries/Ldap.php */