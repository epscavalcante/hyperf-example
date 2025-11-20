<?php

describe('Signup Feature Test', function () {
    it('should return ok response', function () {
        $response = $this->json(
            '/auth/signup',
            [
                'name' => 'John Doe',
                'email' => 'john.doe' . uniqid() . '@email.com',
            ]
        );
        $response->assertCreated();
        $response->assertJsonStructure([
            'account_id',
        ]);
    });
});
