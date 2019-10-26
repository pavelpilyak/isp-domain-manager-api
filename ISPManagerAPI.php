<?php

namespace pavelpilyak\ISPManagerAPI;

use pavelpilyak\ISPManagerAPI\Traits\Domains;
use pavelpilyak\ISPManagerAPI\Traits\Records;

class ISPManagerAPI
{
    use Domains, Records;

    /**
     * @var string $host   Host name of ISPManager.
     * @var string $token  Authentication token.
     */
    protected $host, $token;


    /**
     * ISPManagerAPI constructor.
     * @param string $host      Hostname of ISPManager.
     * @param string $username  Username of ISPManager user.
     * @param string $password  Password of ISPManager user.
     */
    public function __construct(string $host, string $username, string $password)
    {
        $this->host = $host;
        $this->auth($username, $password);
    }

    /**
     * Making a request to ISPManager.
     *
     * @param string $function  Name of API function (https://doc.ispsystem.ru/index.php/ISPmanager_API).
     * @param array $params     Function's parameters.
     * @return mixed
     */
    protected function request(string $function, array $params = [])
    {
        if ($this->token) {
            $params['auth'] = $this->token; // auth token
        }
        $params['out']  = 'json'; // response type
        $params['func'] = $function; // function name

        $response = file_get_contents($this->host . '?' . http_build_query($params));

        return json_decode($response, true);
    }

    /**
     * Authentication.
     *
     * @param string $username  Username of ISPManager user.
     * @param string $password  Password of ISPManager user.
     */
    private function auth($username, $password)
    {
        $response = $this->request('auth', [
            'username' => $username,
            'password' => $password,
        ]);

        $this->token = $response['doc']['auth']['$'];
    }

    /**
     * Response handler.
     *
     * @param array $response  ISPManager response.
     * @return string
     */
    protected function responseHandler(array $response): string
    {
        if (isset($response['doc']['ok'])) {
            return 'success';
        }

        if (isset($response['doc']['error']['msg']['$'])) {
            return 'Error: ' . $response['doc']['error']['msg']['$'];
        }

        return 'unrecognized';
    }
}
