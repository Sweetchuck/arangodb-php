<?php

/**
 * ArangoDB PHP client: admin document handler
 *
 * @package   ArangoDBClient
 * @author    Jan Steemann
 * @author    Frank Mayer
 * @copyright Copyright 2012, triagens GmbH, Cologne, Germany
 * @since     1.2
 */

namespace ArangoDBClient;

/**
 * Provides access to ArangoDB's administration interface
 *
 * The admin handler utilizes ArangoDB's Admin API.
 *
 * @package   ArangoDBClient
 * @since     1.2
 */

class AdminHandler extends Handler
{
    /**
     * details for server version
     */
    const OPTION_DETAILS = 'details';
    
    /**
     * Get the server's storage engine 
     *
     * This will throw if the engine data cannot be retrieved
     *
     * @throws Exception
     *
     * @return mixed - an object returning the engine information
     * @since 3.2
     */
    public function getEngine() 
    {
        $response = $this->getConnection()->get(Urls::URL_ENGINE);
        return $response->getJson();
    }
    
    /**
     * Get the server's storage engine statistics
     *
     * This will throw if the engine data cannot be retrieved
     *
     * @throws Exception
     *
     * @return mixed - an object returning the engine statistics
     * @since 3.8
     */
    public function getEngineStats() 
    {
        $response = $this->getConnection()->get(Urls::URL_ENGINE_STATS);
        return $response->getJson();
    }

    /**
     * Get the server version
     *
     * This will throw if the version cannot be retrieved
     *
     * @param bool $details - True to get a more detailed response
     *
     * @throws Exception
     *
     * @return string - a string holding the ArangoDB version
     * @since 1.2
     */
    public function getServerVersion($details = false)
    {
        $url = Urls::URL_ADMIN_VERSION;

        if ($details) {
            $url = UrlHelper::appendParamsUrl($url, ['details' => true]);
        }

        $response = $this->getConnection()->get($url);
        $data     = $response->getJson();

        if ($details) {
            return $data;
        }

        return $data['version'];
    }

    /**
     * Get the server role
     *
     * This will throw if the role cannot be retrieved
     *
     * @throws Exception
     *
     * @return string - a string holding the server role (e.g. UNDEFINED, COORDINATOR, DBSERVER)
     * @since 2.0
     */
    public function getServerRole()
    {
        $url      = Urls::URL_ADMIN_SERVER_ROLE;
        $response = $this->getConnection()->get($url);
        $data     = $response->getJson();

        return $data['role'];
    }


    /**
     * Get the server time
     *
     * This will throw if the time cannot be retrieved
     *
     * @throws Exception
     *
     * @return double - a double holding the timestamp
     * @since 1.2
     */
    public function getServerTime()
    {
        $response = $this->getConnection()->get(Urls::URL_ADMIN_TIME);
        $data     = $response->getJson();

        return $data['time'];
    }
    
    
    /**
     * Get the server's current log levels
     *
     * This will throw if the log levels cannot be retrieved
     *
     * @throws Exception
     *
     * @return array - an array holding the various log levels
     * @since 3.9
     */
    public function getServerLogLevels()
    {
        $url      = UrlHelper::appendParamsUrl(Urls::URL_ADMIN_LOG_LEVEL, []);
        $response = $this->getConnection()->get($url);

        return $response->getJson();
    }
    
    
    /**
     * Set the server's current log levels
     *
     * This will throw if the log levels cannot be adjusted
     *
     * @throws Exception
     *
     * @param array $levels - an array of topic => level settings
     *
     * @return array - an array holding the various log levels
     * @since 3.9
     */
    public function setServerLogLevels(array $levels)
    {
        $url      = UrlHelper::appendParamsUrl(Urls::URL_ADMIN_LOG_LEVEL, []);
        $response = $this->getConnection()->put($url, $this->json_encode_wrapper($levels));

        return $response->getJson();
    }
    
    
    /**
     * Get the server log entries
     *
     * This will throw if the log cannot be retrieved
     *
     * @throws Exception
     *
     * @param array $options - an array of options that define the result-set:
     *
     * <p>Options are :<br>
     * <li>'upto' - returns all log entries up to a log-level. Note that log-level must be one of:</li>
     * <p>
     * <li>fatal / 0</li>
     * <li>error / 1</li>
     * <li>warning / 2</li>
     * <li>info / 3</li>
     * <li>debug / 4</li>
     * </p>
     * <li>'level'  -  limits the log entries to the ones defined in level. Note that `level` and `upto` are mutably exclusive.</li>
     * <li>'offset' -  skip the first offset entries.</li>
     * <li>'size'   -  limit the number of returned log-entries to size.</li>
     * <li>'start'  -  Returns all log entries such that their log-entry identifier is greater or equal to lid.</li>
     * <li>'sort'   -  Sort the log-entries either ascending if direction is asc, or descending if it is desc according to their lid. Note that the lid imposes a chronological order.</li>
     * <li>'search' -  Only return the log-entries containing the text string...</li>
     * </p>
     *
     * @return array - an array holding the various attributes of a log: lid, level, timestamp, text and the total amount of log entries before pagination.
     * @since 1.2
     */
    public function getServerLogEntries(array $options = [])
    {
        $url      = UrlHelper::appendParamsUrl(Urls::URL_ADMIN_LOG_ENTRIES, $options);
        $response = $this->getConnection()->get($url);

        return $response->getJson();
    }


    /**
     * Get the server log
     *
     * This will throw if the log cannot be retrieved
     *
     * @throws Exception
     *
     * @param array $options - an array of options that define the result-set:
     *
     * <p>Options are :<br>
     * <li>'upto' - returns all log entries up to a log-level. Note that log-level must be one of:</li>
     * <p>
     * <li>fatal / 0</li>
     * <li>error / 1</li>
     * <li>warning / 2</li>
     * <li>info / 3</li>
     * <li>debug / 4</li>
     * </p>
     * <li>'level'  -  limits the log entries to the ones defined in level. Note that `level` and `upto` are mutably exclusive.</li>
     * <li>'offset' -  skip the first offset entries.</li>
     * <li>'size'   -  limit the number of returned log-entries to size.</li>
     * <li>'start'  -  Returns all log entries such that their log-entry identifier is greater or equal to lid.</li>
     * <li>'sort'   -  Sort the log-entries either ascending if direction is asc, or descending if it is desc according to their lid. Note that the lid imposes a chronological order.</li>
     * <li>'search' -  Only return the log-entries containing the text string...</li>
     * </p>
     * @deprecated use getServerLogEntries() instead
     *
     * @return array - an array holding the various attributes of a log: lid, level, timestamp, text and the total amount of log entries before pagination.
     * @since 1.2
     */
    public function getServerLog(array $options = [])
    {
        $url      = UrlHelper::appendParamsUrl(Urls::URL_ADMIN_LOG, $options);
        $response = $this->getConnection()->get($url);

        return $response->getJson();
    }


    /**
     * Reload the server's routing information
     * The call triggers a reload of the routing information from the _routing collection
     *
     * This will throw if the routing cannot be reloaded
     *
     * @throws Exception
     *
     * @deprecated not necessary anymore
     *
     * @return bool
     * @since 1.2
     */
    public function reloadServerRouting()
    {
        $this->getConnection()->post(Urls::URL_ADMIN_ROUTING_RELOAD, '');

        return true;
    }
    
    
    /**
     * Get the server metrics
     * Returns the server metrics, as a structured array
     *
     * @link  https://www.arangodb.com/docs/stable/http/administration-and-monitoring.html
     *
     * This will throw if the metrics cannot be retrieved
     *
     * @throws Exception
     *
     * @return array
     *
     * @since 3.8
     */
    public function getServerMetrics()
    {
        $url      = UrlHelper::appendParamsUrl(Urls::URL_ADMIN_METRICS, []);
        $response = $this->getConnection()->get($url);

        $metrics = [];

        foreach (explode("\n", $response->getBody()) as $line) {
            if (trim($line) == "") {
                continue;
            }
            if ($line[0] == "#") {
                // type or help
                if (!preg_match("/^#\s*([^\s]+)\s+([^\s]+)\s+(.*)$/", $line, $matches)) {
                  throw new ClientException('Invalid metrics API output line: "' . $line. '"');
                }

                $metric = $matches[2];
                if (!isset($metrics[$metric])) {
                    $metrics[$metric] = ["name" => $metric];
                }

                $metrics[$metric][strtolower($matches[1])] = $matches[3];
            } else {
                // metric value
                if (!preg_match("/^([^\s]+?)(\{.*?\})?\s+(.+)$\s*$/", $line, $matches)) {
                  throw new ClientException('Invalid metrics API output line: "' . $line. '"');
                }
                
                $metric = $matches[1];
                $sub = null;
                if (preg_match("/_(sum|count|bucket)$/", $metric, $sub)) {
                    // sum, count, buckets
                    $metric = substr($metric, 0, -1 - strlen($sub[1]));
                }
                
                if (!isset($metrics[$metric])) {
                    $metrics[$metric] = [];
                }

                $le = null;
                // labels
                if ($matches[2] != "") {
                    $labels = substr($matches[2], 1, strlen($matches[2]) - 2);
                    foreach (explode(",", $labels) as $label) {
                        $parts = explode("=", $label);
                        $key = trim($parts[0]);
                        $value = trim($parts[1], " \"");
                        if (!isset($metrics[$metric]["labels"])) {
                            $metrics[$metric]["labels"] = []; 
                        }
                        if ($key != "le") {
                            $metrics[$metric]["labels"][$key] = $value;
                        } else {
                            $le = $value;
                        }
                    }
                }
                
                // cast to number
                $value = $matches[3] + 0;
                
                if ($sub == null) {
                    // counter
                    $metrics[$metric]["value"] = $value;
                } else if ($sub[1] == "bucket") {
                    // bucket value
                    if (!isset($metrics[$metric]["buckets"])) {
                        $metrics[$metric]["buckets"] = [];
                    }
                    $metrics[$metric]["buckets"][$le] = $value;
                } else {
                    // sum, count
                    $metrics[$metric][$sub[1]] = $value;
                }
            }
        }

        return $metrics;
    }


    /**
     * Get the server statistics
     * Returns the statistics information. The returned objects contains the statistics figures, grouped together
     * according to the description returned by _admin/statistics-description.
     * For instance, to access a figure userTime from the group system, you first select the sub-object
     * describing the group stored in system and in that sub-object the value for userTime is stored in the
     * attribute of the same name.In case of a distribution, the returned object contains the total count in count
     * and the distribution list in counts.
     * For more information on the statistics returned, please lookup the statistics interface description at
     *
     * @link  https://www.arangodb.com/docs/stable/http/administration-and-monitoring.html
     *
     * This will throw if the statistics cannot be retrieved
     *
     * @throws Exception
     *
     * @return array
     *
     * @see   getServerStatisticsDescription()
     *
     * @deprecated use metrics API instead
     *
     * @since 1.3
     */
    public function getServerStatistics()
    {
        $url      = UrlHelper::appendParamsUrl(Urls::URL_ADMIN_STATISTICS, []);
        $response = $this->getConnection()->get($url);

        return $response->getJson();
    }


    /**
     * Returns a description of the statistics returned by getServerStatistics().
     * The returned objects contains a list of statistics groups in the attribute groups
     * and a list of statistics figures in the attribute figures.
     * For more information on the statistics returned, please lookup the statistics interface description at
     *
     * @link  https://www.arangodb.com/docs/stable/http/administration-and-monitoring.html
     *
     * This will throw if the statistics-description cannot be retrieved
     *
     * @throws Exception
     *
     * @param array $options - an array of options that define the result-set:
     *
     * <p>Options are :<br>
     * <li>'granularity' - use minutes for a granularity of minutes, hours for hours, and days for days. The default is minutes.</li>
     * <li>'figures' - a list of figures, comma-separated. Possible figures are httpConnections. You can use all to get all figures. The default is httpConnections.</li>
     * <li>'length' - If you want a time series, the maximal length of the series as integer. You can use all to get all available information. You can use current to get the latest interval.</li>
     *
     * @return array
     *
     * @see   getServerStatistics()
     *
     * @deprecated use metrics API instead
     *
     * @since 1.3
     */
    public function getServerStatisticsDescription(array $options = [])
    {
        $url      = UrlHelper::appendParamsUrl(Urls::URL_ADMIN_STATISTICS_DESCRIPTION, $options);
        $response = $this->getConnection()->get($url);

        return $response->getJson();
    }
}

class_alias(AdminHandler::class, '\triagens\ArangoDb\AdminHandler');
