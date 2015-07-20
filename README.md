[![Build Status](https://travis-ci.org/fkooman/php-lib-rest-plugin-authentication-mellon.svg?branch=master)](https://travis-ci.org/fkooman/php-lib-rest-plugin-authentication-mellon)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fkooman/php-lib-rest-plugin-authentication-mellon/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fkooman/php-lib-rest-plugin-authentication-mellon/?branch=master)

# Introduction
This plugin enables one to use SAML authentication with `fkooman/rest`. 

# Configuation
You need to configure Apache as a SAML SP and configure it. See the 
References section for a link to generic installation instructions. The example
below worked while developing `fkooman/rest`:

    <Location />
        MellonEnable "info"
        MellonSPPrivateKeyFile /etc/httpd/mellon/https_example.org_saml.key
        MellonSPCertFile /etc/httpd/mellon/https_example.org_saml.cert
        MellonSPMetadataFile /etc/httpd/mellon/https_example.org_saml.xml
        MellonIdPMetadataFile /etc/httpd/mellon/https_openidp_feide_no.xml
        MellonEndpointPath /saml
    </Location>

    <Location /app>
        MellonEnable "auth"
    </Location>

If you want to just test `mod_auth_mellon` support you can also use the 
following in your Apache configuration:

    RequestHeader set MELLON-NAME-ID foo

# References
- [https://github.com/UNINETT/mod_auth_mellon/wiki/GenericSetup](https://github.com/UNINETT/mod_auth_mellon/wiki/GenericSetup)
