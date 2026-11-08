<?php
namespace Datacircle;

class Client
{
    private $base;

    public function __construct($base = 'https://api.datacircle.dev/v1')
    {
        $this->base = rtrim($base, '/');
    }

    public function get($path, array $query = [])
    {
        $url = $this->base . '/' . ltrim($path, '/');
        if ($query) {
            $url .= '?' . http_build_query($query);
        }
        $body = file_get_contents($url);
        return json_decode($body, true);
    }

    public function apis()
    {
        return $this->get('apis');
    }

    public function best($slug)
    {
        return $this->get('apis/' . rawurlencode($slug) . '/best');
    }

    public function plans(array $query = [])
    {
        return $this->get('plans', $query);
    }

    public function provider($slug)
    {
        return $this->get('providers/' . rawurlencode($slug));
    }
}
