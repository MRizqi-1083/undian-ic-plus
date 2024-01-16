<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LdapModel extends Model
{


    public function ldapMode($uname, $pass)
    {
        $ldapuri = "";

        try {
            $ldapconn = ldap_connect($ldapuri) or die("Could not connect to $ldapuri");
        } catch (\Exception $e) {
            return $data = [];
        }

        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

        if (!@ldap_bind($ldapconn, "iconpln\\" . $uname, $pass)) {
            return $data = [];
        } else {

            try {
                $ldap_dn = "DC=iconpln,DC=co,DC=id";
                $filter = "(sAMAccountName=" . $uname . ")";
                $attributes = array("displayName");

                $result = ldap_search($ldapconn, $ldap_dn, $filter, $attributes) or die("Error in search query: " . ldap_error($ldapconn));
                $data = ldap_get_entries($ldapconn, $result);
                $data = array(
                    'icp_nama' => $this->ldapAttribute($ldapconn, $uname, "displayname"),
                    'icp_email' => $this->ldapAttribute($ldapconn, $uname, "mail"),
                    'icp_jabatan' => $this->ldapAttribute($ldapconn, $uname, "title"),
                    'icp_divisi' => $this->ldapAttribute($ldapconn, $uname, "department"),
                    'icp_instansi' => $this->ldapAttribute($ldapconn, $uname, "company"),
                    'icp_nip' => $this->ldapAttribute($ldapconn, $uname, "employeeid"),
                );
                return $data;
            } catch (\Exception $e) {
                return $data = [];
            }
        };

        ldap_close($ldapconn);
    }

    private function ldapAttribute($ds, $user, $attribute)
    {
        $ldap_base_dn = 'DC=iconpln,DC=co,DC=id';
        try {
            $attributes = array($attribute);
            $search_filter = "sAMAccountName=" . $user . "";
            $result = ldap_search($ds, $ldap_base_dn, $search_filter, $attributes);
            $entries = ldap_get_entries($ds, $result);
            if ($entries["count"] > 0) {
                if (isset($entries[0][$attribute])) {
                    return $entries[0][$attribute][0];
                } else {
                    return "";
                }
            } else {
                return "";
            }
        } catch (\Exception $e) {
            ldap_unbind($ds);
            return;
        }
    }
}
