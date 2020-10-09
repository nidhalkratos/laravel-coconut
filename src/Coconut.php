<?php

namespace Nidhalkratos;

class Coconut
{
    protected $client;
    protected $source;
    protected $webhook;
    protected $outputs;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function setSource(string $source) : Coconut
    {
        $this->source = "set source = {$source}";

        return $this;
    }
    
    public function setWebhook(string $webhook) : Coconut
    {
        $this->webhook = "set webhook = {$webhook}";

        return $this;
    }
   
    public function setOutput(string $format, string $path, array $params = []) : Coconut
    {
        $output = sprintf('-> %s = %s', $format, $this->formatPath($path));

        if ($params) {
            $output .= sprintf(', %s', urldecode(http_build_query($params, '', ', ')));
        }
        
        $this->outputs[] = $output;

        return $this;
    }

    public function getConfig() : string
    {
        return join("\n", [
            $this->source,
            $this->webhook,
            '',
            $this->formatOutputs(),
        ]);
    }

    public function createJob()
    {
        return $this->client->post('job', $this->getConfig());
    }

    protected function formatPath(string $path) : string
    {
        $config = config('coconut.s3');

        return sprintf('s3://%s:%s@%s%s', $config['access_key'], $config['secret_key'], $config['bucket'], $path);
    }

    protected function formatOutputs() : string
    {
        return join("\n", $this->outputs);
    }
}
