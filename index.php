<?php if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Text to send if user hits Cancel button';
    exit;
} else {
    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
    echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
    $ldap = ldap_connect("ldap.forumsys.com");
    $username=$_SERVER['PHP_AUTH_USER'];
    $password=$_SERVER['PHP_AUTH_PW'];




$ldapconfig['host'] = 'ldap.forumsys.com';//CHANGE THIS TO THE CORRECT LDAP SERVER

$ldapconfig['port'] = '389';

$ldapconfig['basedn'] = 'cn=read-only-admin,dc='.$username.',dc=com';//CHANGE THIS TO THE CORRECT BASE DN

//$ldapconfig['usersdn'] = 'ou=mathematicians';//CHANGE THIS TO THE CORRECT USER OU/CN

$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);



ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);







if ($bind=ldap_bind($ds, $ldapconfig['basedn'], $password)) {
echo"done";
 echo("<script>alert('Login correct Welcome user $username')</script>");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;

} else {



echo "<script>alert('Login Failed: Please check your username or password'</script>)";

}


}
?>
