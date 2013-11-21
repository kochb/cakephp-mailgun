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
class BasicTransport extends AbstractTransport {

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

        $url = 'https://api.mailgun.net/v2/' . $this->_config['mailgun_domain'] . '/messages';
        $post = array();
        $post_preprocess = array_merge(
            $email->getHeaders(array('from', 'sender', 'replyTo', 'readReceipt', 'returnPath', 'to', 'cc', 'bcc', 'subject')),
            array(
                'text' => $email->message(CakeEmail::MESSAGE_TEXT),
                'html' => $email->message(CakeEmail::MESSAGE_HTML)
            )
        );
        foreach ($post_preprocess as $k => $v) {
            if (! empty($v)) {
                $post[strtolower($k)] = $v;
            }
        }
        $request = array(
            'auth' => array(
                'method' => 'Basic',
                'user' => 'api',
                'pass' => $this->_config['api_key']
            )
        );

        $response = $http->post($url, $post, $request);
        if ($response === false) {
            throw new SocketException("Mailgun BasicTransport error, no response", 500);
        }

        $http_status = $response->code;
        if ($http_status != 200) {
            throw new SocketException("Mailgun request failed.  Status: $http_status, Response: {$response->body}", 500);
        }

        return array(
            'headers' => $this->_headersToString($email->getHeaders(), PHP_EOL),
            'message' => implode(PHP_EOL, $email->message())
        );
    }

}
