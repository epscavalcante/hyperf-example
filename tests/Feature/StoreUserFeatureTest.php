<?php

describe('Store User Feature Test', function () {
    it('Should receives invalidate response - invalid email', function () {
        $response = $this->json(
            '/users', 
            [
                'name' => 'John Doe',
                'email' => 'invalid-email',
            ]
        );
        $response->assertUnprocessable();
    });

    it('Should receives valid response', function () {
        $response = $this->json(
            '/users', 
            [
                'name' => 'John Doe',
                'email' => 'john.doe@eail.com',
            ]
        );
        $response->assertCreated();
        $response->assertJsonStructure([
            'user_id',
        ]);
    });
});
