# api-project
[![CircleCI](https://circleci.com/gh/gabrielanhaia/api-project/tree/master.svg?style=svg)](https://circleci.com/gh/gabrielanhaia/api-project/tree/master)

[PORTUGUESE VERSION](www.google.com)

## Description

Implementation of the integration with the API from the journal to list articles using the framework shared. The objective was to build a solution able with OO (Object Orientation), following the SOLID principles and applying some design patterns that could make sense.

### Technologies

- PHP 7.3
- Sample Framework
- PHPUnit
- Circle CI
- Docker

### Design Patterns used
- Simple Factory
- Factory Method
- Abtract Factory
- Strategy

### .ENV

Before run the project it is necessary to copy the file *.env.example* and change the envorinment variables:

DEMO_MODE=false
API_JOURNAL_USERNAME=USERNAME_HERE
API_JOURNAL_PASSWORD=PASSWORD_HERE
API_JOURNAL_BASE_URL=https://api.thejournal.ie/v3/sample/

### Running the tests

To run the Unit tests (PHPUnit) you can configurate it on your IDE or you can just open the project with the terminal and run:
`php vendor/bin/phpunit`

