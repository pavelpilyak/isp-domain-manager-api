<?php

namespace pavelpilyak\ISPManagerAPI\Traits;

trait Records
{
    /**
     * @param string $domain  Domain name (domain.com).
     * @param string $name    Subdomain name or @.
     * @param string $type    Record type (txt, a, mx, etc)
     * @param string $value   Record value.
     * @param string $ip      Server IP.
     * @param string $info    Record additional information.
     * @param int $ttl
     * @return mixed
     */
    public function addRecord(string $domain, string $name, string $type,
                              string $value, string $ip = '', string $info = '',
                              int $ttl = 3600)
    {
        $response = $this->request('domain.record.edit', [
            'plid'  => $domain,
            'name'  => $name,
            'rtype' => $type,
            'value' => $value,
            'ip'    => $ip,
            'ttl'   => $ttl,
            'info'  => $info,
            'sok'   => 'ok',
        ]);

        return $this->responseHandler($response);
    }
}
