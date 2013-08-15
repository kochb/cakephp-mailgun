CakePHP Mailgun Plugin
======================

This package provides two Mailgun transports - one implemented using CakePHP's HttpRequest utility and the other using curl.

Installation
------------
If you haven't already, sign up for a [Mailgun](http://www.mailgun.com/) account.

Install this package as a [CakePHP Plugin](http://book.cakephp.org/2.0/en/plugins.html).

    git clone https://github.com/kochb/cakephp-mailgun.git app/Plugin/Mailgun
    # If you prefer, use a submodule
    git submodule add https://github.com/kochb/cakephp-mailgun.git app/Plugin/Mailgun

Load the plugin in your bootstrap.php.

    CakePlugin::load('Mailgun');

Usage
-----
To enable the transport, add the following information to your Config/email.php:

    class EmailConfig {
        public $mailgun = array(
            'transport' => 'Mailgun.Basic',
            'mailgun_domain'    => 'my-mailgun-domain.com',
            'api_key'   => 'MY_MAILGUN_API_KEY'
        );
    }


Use the [CakeEmail class](http://book.cakephp.org/2.0/en/core-utility-libraries/email.html) as normal, invoking the new configuration settings.

    $email = new CakeEmail('mailgun');
