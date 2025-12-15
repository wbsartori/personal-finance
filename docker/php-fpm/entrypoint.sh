#!/bin/bash
set -euo pipefail
cd /var/www

if [ "$#" -eq 0 ]; then
  set -- php-fpm
fi

exec "$@"
