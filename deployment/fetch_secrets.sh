#!/bin/bash
cd /var/www/html/console/deployment
python3 fetch_secrets.py
cp -Rv /opt/env /var/www/html/console/.env
#aws s3 sync s3://bitswilpconvocation-assets-backend /var/www/html/se/
