# LARAVEL MEETING APP DEMO

A sample of meeting scheduler application built with Laravel, Bootstrap, Vuejs and PostgreSQL, with an REST API routes.

Docker image: ...

API documentation: ...

SPA frontend (Angular smaple): ...

## DATABASE STRUCTURE

| TABLE                         | FIELDS                                                          | 
|-------------------------------|-----------------------------------------------------------------|
| User                          | login - name - passwd                                           |
| Customer                      | name - email - meeting_preferencies { week_day - time }         |
| contacts                      | email - phones \[array\]                                        |
| meetings                      | customer - datetime - duration                                  |
