<?php

describe('Hello Feature Test', function () {
    it('should return ok response', function () {
        $response = $this->get('/hello');
        $response->assertOk();
        $response->assertSee('Hello');
    });
});
