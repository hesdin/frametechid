<?php

test('health endpoint responds successfully', function (): void {
    $this->get('/up')->assertSuccessful();
});
