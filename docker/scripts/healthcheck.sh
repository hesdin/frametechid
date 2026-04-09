#!/usr/bin/env sh
set -eu

php -r '$headers = @get_headers("http://127.0.0.1/up"); exit($headers !== false && str_contains($headers[0], "200") ? 0 : 1);'
