<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 *
 * @document https://hyperf.wiki
 *
 * @contact  group@hyperf.io
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
describe('Hello Feature Test', function () {
    it('should return ok response', function () {
        $response = $this->get('/hello');
        $response->assertOk();
        $response->assertSee('Hello');
    });
});
