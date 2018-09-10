# Task Management Extension

## Installation

Download the extension as a ZIP file from this repository and extract in app/code.

Run below command
```
php bin/magento setup:upgrade
php bin/magento setup:di:compile
```

## Requirements
- PHP >= 5.6
- Magento >= 2.1

## Description
Basic Task management system which enables admin to view list of tasks, add or edit tasks.

Form contains following fields:
- Task Name
- Task Description
- Start Time
- End Time
- Assigned Person
- Status