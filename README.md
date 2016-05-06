# Azure Active Directory Graph API
`azure-graph` is an API wrapper for the Azure Active Directory Graph API.

## Installation
Add the following to your `composer.json` file:
```json
{
    "require": {
        "jeffreyhyer/azure-graph": "dev-master"
    }
}
```
And run `composer install` or `composer update` to install the correct
version
of the package.

## Usage
*TODO: Generate docs and put them in the `/docs/` directory*

### Application Setup
*TODO: Instructions for setting up the app in Azure AD Management Portal*

Note your `ClientID` and `ClientSecret` for your application as well as the
`Tenent` for your Active Directory instance as we'll need those below.

### Quick Start
```php
<?php

require('vendor/autoload.php');

use Azure;

$azure = new Azure($clientId, $clientSecret, $tenant);

// Return all Users in the Active Directory
$users = $azure->users()->all();

// Return a single user identified by the Azure objectId or the user's
// principalName (usually the email they use to login to their account)
$user = $azure->users()->one('abcd1234-12ab-34cd-a123-a123456789e');
```
