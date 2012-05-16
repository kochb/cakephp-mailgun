CakePHP Mailgun Plugin
======================

Provides utilities for interacting with Mailgun in CakePHP.

Usage
-----
This package currently provides two Mailgun transports - one implemented using
CakePHP's HttpRequest utility and the other using curl.

To enable the transport, add the following information to your Config/email.php:

    class EmailConfig {
        public $mailgun = array(
            'transport' => 'Mailgun.basic',
            'domain'    => 'my-mailgun-domain.com',
            'api_key'   => 'MY_MAILGUN_API_KEY'
        );
    }

