# Job Finder API

A RESTful API built with Laravel for a Job Finder application. This project provides authentication, user profile management, job-related features, and API integration to support a modern job search platform.

## Overview

The Job Finder API serves as the backend for a mobile application developed with Flutter. It handles user authentication, profile management, data storage, and communication with external job services.

## Features

### Authentication

* User Registration
* User Login
* User Logout
* Token-based Authentication
* Protected API Routes

### User Profile

* View Profile Information
* Update Profile Details
* Upload User Avatar
* Manage Account Information

### Job Features

* Search Jobs
* View Job Details
* Save Jobs
* Remove Saved Jobs
* Track Applied Jobs
* Application History

### API Integration

* Integration with External Job APIs
* JSON Data Processing
* API Request and Response Handling

### Database Management

* Relational Database Design
* Data Validation
* Eloquent ORM Relationships
* Migration Management

## Technology Stack

### Backend

* PHP
* Laravel

### Database

* MySQL

### Authentication

* Laravel Sanctum

### Tools

* Git
* GitHub
* Postman

## Installation

### Clone Repository

```bash
git clone https://github.com/sovathyut45-coder/job-finder-api.git
```

### Navigate to Project

```bash
cd job-finder-api
```

### Install Dependencies

```bash
composer install
```

### Create Environment File

```bash
cp .env.example .env
```

### Configure Database

Update the following values in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_finder
DB_USERNAME=root
DB_PASSWORD=
```

### Generate Application Key

```bash
php artisan key:generate
```

### Run Database Migrations

```bash
php artisan migrate
```

### Create Storage Link

```bash
php artisan storage:link
```

### Start Development Server

```bash
php artisan serve
```

The API will be available at:

```text
http://127.0.0.1:8000
```

## API Testing

This project can be tested using:

* Postman
* Thunder Client
* Insomnia

## Development Practices

* RESTful API Design
* MVC Architecture
* Database Migrations
* Request Validation
* Clean Code Principles
* Version Control with Git

## Future Improvements

* Role-Based Access Control (RBAC)
* Email Verification
* Password Reset
* API Documentation
* Notification System
* Advanced Search and Filtering

## Author

Phai Sovathyut

Final-Year Computer Science Student
Royal University of Phnom Penh (RUPP)

Email: sovathyut45@gmail.com

GitHub: https://github.com/sovathyut45-coder

## License

This project is created for educational, learning, and portfolio purposes.
