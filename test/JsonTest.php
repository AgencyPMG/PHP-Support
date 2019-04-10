<?php declare(strict_types=1);

/**
 * This file is part of pmg/support
 *
 * Copyright (c) PMG <https://www.pmg.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMG\Support;

use PMG\Support\Json\JsonDecodeError;
use PMG\Support\Json\JsonEncodeError;

class JsonTest extends TestCase
{
    public function testDecodeErrorsWhenJsonIsInvalid()
    {
        $this->expectException(JsonDecodeError::class);
        Json::decode('["one"');
    }

    public function testDecodeReturnsArrayWhenGivenValidJson()
    {
        $out = Json::decode('["one"]');

        $this->assertSame(['one'], $out);
    }

    public function testEncodeErrorsWithInvalidInputs()
    {
        $this->expectException(JsonEncodeError::class);
        $in = fopen('php://temp', 'w');
        try {
            Json::encode($in);
        } finally {
            fclose($in);
        }
    }

    public function testEncodeReturnsJsonStringWhenSuccessful()
    {
        $out = Json::encode(['one']);

        $this->assertSame('["one"]', $out);
    }
}
