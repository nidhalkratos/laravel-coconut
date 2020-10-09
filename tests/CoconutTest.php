<?php

namespace Tests;

use Nidhalkratos\Coconut;
use Nidhalkratos\HttpClient;
use GuzzleHttp\Client;

class CoconutTest extends TestCase
{
    public function testGetConfig()
    {
        $coconut = app(Coconut::class);

        $coconut->setSource('https://s3-eu-west-1.amazonaws.com/files.coconut.co/test.mp4')
            ->setWebhook('http://mysite.com/webhook')
            ->setOutput('jpg:1080x1920', '/test.jpg', ['every' => '1', 'fit' => 'crop'])
            ->setOutput('mp4:1080x1920_30fps_h264_4000k:aac_stereo_128k', '/test.mp4', ['fit' => 'crop']);

        $expected = join("\n", [
            'set source = https://s3-eu-west-1.amazonaws.com/files.coconut.co/test.mp4',
            'set webhook = http://mysite.com/webhook',
            '',
            '-> jpg:1080x1920 = s3://key:secret@bucket/test.jpg, every=1, fit=crop',
            '-> mp4:1080x1920_30fps_h264_4000k:aac_stereo_128k = s3://key:secret@bucket/test.mp4, fit=crop',
        ]);

        $this->assertEquals($expected, $coconut->getConfig());
    }
}
