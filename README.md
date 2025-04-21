# Laravel Event Booking API

This is a simple Event Booking API built using **Laravel** to manage events, attendees, and bookings. The API supports features such as event creation, attendee registration, and booking management with validation and error handling.

## Features

- **Create, Update, Delete, List Events**
- **Register Attendees**
- **Book Events**
- **Prevent Overbooking and Duplicate Bookings**
- **Validation for emails and booking logic**

## Table of Contents
- [Installation](#installation)
- [Setup](#setup)
- [API Endpoints](#api-endpoints)
- [Testing](#testing)
- [Assumptions](#assumptions)
- [Architecture](#architecture)

## Installation

### Prerequisites:
- PHP >= 8.1
- Composer
- MySQL
- Laravel 10.x

### Step-by-Step Setup:
1. Clone the repository:
   ```bash
   git clone https://github.com/mborhade/laravel_event_booking_api.git
   cd event-booking-api
2. Install dependencies:
    composer install
3. Copy .env.example to .env:
    cp .env.example .env
4. Generate an application key:
    php artisan key:generate
5. Configure your .env file with database credentials:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=event_booking
    DB_USERNAME=root
    DB_PASSWORD=
6. Run migrations to create the necessary database tables:
    php artisan migrate
7. Seed the database with some sample data:
    php artisan db:seed
8. Start the local development server:
    php artisan serve

The API will be accessible at http://127.0.0.1:8000

Setup
Once the setup is complete, the API should be running and ready for use. Below is a list of the available API endpoints.

API Endpoints
1. Create Event
URL: /api/events

Method: POST

Parameters:

title: string (required)

description: string (optional)

location: string (required)

date: string (required, date format)

capacity: integer (required)

Success Response:

201 Created: Event created successfully

Example Request:

{
    "title": "Tech Summit 2024",
    "description": "Annual technology conference",
    "location": "New York",
    "date": "2024-05-20T10:00:00",
    "capacity": 150
}

2. List Events
URL: /api/events

Method: GET

Success Response:

200 OK: List of events

Example Response:

[
    {
        "id": 1,
        "title": "Tech Summit 2024",
        "description": "Annual technology conference",
        "location": "New York",
        "date": "2024-05-20T10:00:00",
        "capacity": 150
    },
    ...
]

3. Register Attendee
URL: /api/attendees

Method: POST

Parameters:

name: string (required)

email: string (required, unique, valid email)

Success Response:

201 Created: Attendee registered successfully

Example Request:

{
    "name": "John Doe",
    "email": "john.doe@example.com"
}

4. Book Event
URL: /api/bookings

Method: POST

Parameters:

event_id: integer (required)

attendee_id: integer (required)

Success Response:

201 Created: Booking successful

Error Response:

400 Bad Request: If attendee is already booked or event is full

Example Request:

{
    "event_id": 1,
    "attendee_id": 2
}

Testing
To run tests for the API, follow these steps:

Ensure you have set up the database and the .env file correctly.

Run the tests using:

php artisan test

The tests will check the following scenarios:

Event creation

Attendee registration

Booking validation (duplicate bookings, overbooked events)

Build and Run
In your Laravel root folder (where docker-compose.yml is), run:

docker-compose up -d --build
