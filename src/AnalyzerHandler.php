<?php

declare(strict_types = 1);

/**
 * ArangoDB PHP client: analyzer handler
 *
 * @package   ArangoDBClient
 * @author    Jan Steemann
 * @copyright Copyright 2019, ArangoDB GmbH, Cologne, Germany
 *
 * @since     3.6
 */

namespace ArangoDBClient;

/**
 * A handler that manages analyzers.
 *
 * @package ArangoDBClient
 * @since   3.6
 */
class AnalyzerHandler extends Handler
{
    /**
     * Create an analyzer.
     *
     * This will create an analyzer using the given analyzer object and return
     * an array of the created analyzer object's attributes.
     *
     *
     * @param Analyzer $analyzer
     *   The analyzer object which holds the information of the analyzer to be
     *   created.
     *
     * @return array
     *
     * @throws Exception
     *
     * @since 3.6
     */
    public function create(Analyzer $analyzer)
    {
        $params   = [
            Analyzer::ENTRY_NAME       => $analyzer->getName(),
            Analyzer::ENTRY_TYPE       => $analyzer->getType(),
            Analyzer::ENTRY_FEATURES   => $analyzer->getFeatures(),
        ];

        $properties = $analyzer->getProperties();
        if (count($properties) > 0) {
            $params[Analyzer::ENTRY_PROPERTIES] = $properties;
        }

        $url      = Urls::URL_ANALYZER;
        $response = $this->getConnection()->post($url, $this->json_encode_wrapper($params));
        $json     = $response->getJson();

        return $analyzer->getAll();
    }

    /**
     * Get an analyzer.
     *
     * This will get an analyzer.
     *
     * @param string $analyzer
     *   The name of the analyzer.
     *
     * @return Analyzer
     *
     * @throws \ArangoDBClient\ClientException
     * @throws \ArangoDBClient\Exception
     *
     * @since 3.6
     */
    public function get($analyzer)
    {
        $url = UrlHelper::buildUrl(Urls::URL_ANALYZER, [$analyzer]);

        $response = $this->getConnection()->get($url);
        $data = $response->getJson();

        $result = new Analyzer(
            $data[Analyzer::ENTRY_NAME],
            $data[Analyzer::ENTRY_TYPE],
            $data[Analyzer::ENTRY_PROPERTIES],
            $data[Analyzer::ENTRY_FEATURES]
        );

        return $result;
    }

    /**
     * Get all analyzers.
     *
     * @return array
     *   Returns an array of available analyzers.
     *
     * @throws \ArangoDBClient\Exception
     *
     * @since 3.6
     */
    public function getAll()
    {
        $url = UrlHelper::buildUrl(Urls::URL_ANALYZER, []);
        $result = $this->getConnection()->get($url);

        return $result->getJson();
    }

    /**
     * Get an analyzer's properties.
     *
     * @param string|\ArangoDBClient\Analyzer $analyzer
     *   Analyzer name as a string or instance of Analyzer.
     *
     * @return array
     *   Returns an array of attributes.
     *
     * @throws Exception
     *
     * @since 3.6
     */
    public function properties($analyzer)
    {
        if ($analyzer instanceof Analyzer) {
            $analyzer = $analyzer->getName();
        }

        $url = UrlHelper::buildUrl(Urls::URL_ANALYZER, [$analyzer]);
        $result = $this->getConnection()->get($url);

        return $result->getJson();
    }

    /**
     * Drop an analyzer.
     *
     * @param string|\ArangoDBClient\Analyzer $analyzer
     *   Analyzer name as a string or instance of Analyzer.
     *
     * @return true
     *
     * @throws \ArangoDBClient\Exception
     *
     * @since 3.6
     */
    public function drop($analyzer)
    {
        if ($analyzer instanceof Analyzer) {
            $analyzer = $analyzer->getName();
        }

        $url = UrlHelper::buildUrl(Urls::URL_ANALYZER, [$analyzer]);
        $this->getConnection()->delete($url);

        return true;
    }
}
