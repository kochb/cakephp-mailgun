<?php
App::uses('HttpSocket', 'Network/Http');
/**
 * Mailgun class
 *
 * Enables sending of email over mailgun
 *
 * Licensed under The MIT License
 * 
 * @author Brad Koch <bradkoch2007@gmail.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class MailgunBasicTransport extends AbstractTransport {

/**
 * Configurations
 *
 * @var array
 */
	protected $_config = array();

/**
 * Send mail
 *
 * @params CakeEmail $email
 * @return array
 */
	public function send(CakeEmail $email) {
        $http = new HttpSocket();
        
        $url = 'https://api.mailgun.net/v2/' . $this->_config['domain'] . '/messages';
        $headers = $email->getHeaders();
        $data = array_merge(
            $headers,
            array(
                'text' => $email->message(CakeEmail::MESSAGE_TEXT),
                'html' => $email->message(CakeEmail::MESSAGE_HTML)
            )
        );
        $request = array(
            'auth' => array(
                'method' => 'Basic',
                'user' => 'api',
                'pass' => $this->_config['api_key']
            )
        );

        $http->post($url, $data, $request);
        
        return array(
            'headers' => $this->_headersToString($headers, PHP_EOL),
            'message' => implode(PHP_EOL, $email->message())
        );
    }

}
