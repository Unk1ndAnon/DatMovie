<?php

namespace app\api\modules;

use app\api\config\TMDB_config;
use Exception;

class TMDB_api
{
    private $key;
    private $error;

    public function __construct($key = null, $params = array())
    {
        $this->key = TMDB_config::getTmdbApiKey();

        if (!empty($key)) {
            $this->key = $key;
        }
    }

    public function request($endpoint, $params = array())
    {
        $baseUrl = TMDB_config::getTmdbBaseUrl();
        $key = $this->key;

        $uri = $baseUrl . $endpoint . '?api_key=' . $key;

        if (is_array($params)) {
            $uri .= '&';

            foreach ($params as $key => $value) {
                if (empty($value)) continue;

                $uri .= $key . '=' . urlencode($value) . '&';
            }

            $uri = substr($uri, 0, -1);
            $responde = @file_get_contents($uri);
            return json_decode($responde, true);
        } else {
            $this->erro = true;
            throw new Exception('segundo parâmetro deve ser um array!');
        }
    }

    public function request_error()
    {
        return $this->error;
    }

    public function destaques($qtd = 3)
    {
        $params = array(
            'language' => 'pt-BR',
        );

        try {
            $data = $this->request('movie/top_rated', $params);
        } catch (Exception $e) {
            $this->error = true;
            return $e->getMessage();
        }

        $destaques = array();

        for ($i = 0; $i < $qtd; $i++) {
            array_push($destaques, $data['results'][$i]);
        }

        return $destaques;
    }

    public function filmesPopulares($page)
    {
        $params = array(
            'language' => 'pt-BR',
            'page' => $page
        );
        try {
            $data = $this->request('movie/popular', $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }

    public function seriesPopulares($page)
    {
        $params = array(
            'language' => 'pt-BR',
            'page' => $page
        );
        try {
            $data = $this->request('tv/popular', $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }
}
