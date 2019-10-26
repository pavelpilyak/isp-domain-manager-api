<?php

namespace pavelpilyak\ISPManagerAPI\Traits;

trait Domains {
    /**
     * Add domain.
     *
     * @param string $name   Domain name (domain.com).
     * @param string $email  Email address.
     * @param string $ip     Master IP.
     * @return string
     */
    public function addDomain(string $name, string $email, string $ip): string
    {
        $response = $this->request('domain.edit', [
            'name'     => $name,
            'email'    => $email,
            'masterip' => $ip,
            'dtype'    => 'master',
            'sok'      => 'ok',
        ]);

        return $this->responseHandler($response);
    }

    /**
     * Delete domain.
     *
     * @param $name    Domain name (domain.com).
     * @return string
     */
    public function deleteDomain($name): string
    {
        $response = $this->request('domain.delete', ['elid' => $name]);

        return $this->responseHandler($response);
    }
}
