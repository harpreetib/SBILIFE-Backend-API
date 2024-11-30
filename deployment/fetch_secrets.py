"""
AWS Secrets Manager Example

This script retrieves a secret from AWS Secrets Manager based on EC2 instance tags and
saves it to a file in the /opt directory. It uses the instance's metadata to determine
the region and other necessary information.
"""

import os
import boto3

# Initialize the AWS Secrets Manager client
session = boto3.session.Session()

# Retrieve the instance metadata to get the instance ID and availability zone
instance_id = os.popen('curl -s http://169.254.169.254/latest/meta-data/instance-id').read()
availability_zone = os.popen('curl -s http://169.254.169.254/latest/meta-data/placement/availability-zone').read()

# Extract the region from the availability zone (e.g., us-east-1a -> us-east-1)
region_name = availability_zone[:-1]

# Initialize the Secrets Manager client with the dynamically determined region
client = session.client(service_name='secretsmanager', region_name=region_name)

try:
    # Initialize the EC2 client to describe the instance and retrieve its tags
    ec2 = boto3.client('ec2', region_name=region_name)

    # Retrieve the instance information to get the tags
    instance_info = ec2.describe_instances(InstanceIds=[instance_id])

    # Extract the tags from the instance information
    tags = instance_info['Reservations'][0]['Instances'][0]['Tags']

    # Find the tags with keys 'application' and 'env' and construct the secret name
    APP_TAG = None
    ENV_TAG = None
    for tag in tags:
        if tag['Key'] == 'application':
            APP_TAG = tag['Value']
        elif tag['Key'] == 'Environment':
            ENV_TAG = tag['Value']

    if APP_TAG is not None and ENV_TAG is not None:
        #secret_name = f"{APP_TAG}/{ENV_TAG}/secret"
        secret_name = APP_TAG + '/' + ENV_TAG + '/secret'

        # Retrieve the secret value from Secrets Manager
        get_secret_value_response = client.get_secret_value(SecretId=secret_name)
        secret_value = get_secret_value_response['SecretString']

        # Create the file name with the format ENV_TAG.env (without the "$" symbol)
        #file_name = f"{ENV_TAG}.env"
        file_name = 'env'

        # Specify the full path to save the file in /opt
        file_path = os.path.join('/opt', file_name)
        with open(file_path, 'w', encoding='utf-8') as value_file:
            value_file.write(secret_value)

        #print(f"Secret value saved to '/opt/{file_name}'")
        print("Secret value saved to '/opt/" + file_name + "'")

    else:
        print("Missing 'application' and/or 'env' tags on the instance.")

except Exception as e:
    #print(f"Error retrieving or saving secret: {str(e)}")
    print("Error retrieving or saving secret: " + str(e))
