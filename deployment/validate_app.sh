#!/bin/bash

# Set the service URL and endpoint
SERVICE_URL="localhost"

# Wait for 60 seconds
sleep 60

# Make a GET request to the health endpoint and capture the HTTP status code
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" "$SERVICE_URL")

# Check if the status code is 200 (OK)
if [ "$HTTP_STATUS" -eq 200 ]; then
  echo "Service health check succeeded. HTTP status code 200 (OK) received."
  exit 0  # Exit with a success status code
else
  echo "Service health check failed. HTTP status code: $HTTP_STATUS"
  exit 1  # Exit with an error status code
fi
