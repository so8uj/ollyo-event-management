![My Profile Picture](https://oem.watermarkbd.com/homepage_sample.png)

# Ollyo Event Management
This is a Simple Ollyo Event Management Task for the job post of PHP Developer.

## Project Overview
This is a simple, web-based event management system that allows users to register on this site, register event from this site and create, manage, and view events, as well as register attendees and generate their event reports. Admin can Manage all the users and events.

## Features
* Two Homepage one with API and other with PHP RAW data from database.
* Paginated Data with Search, Filter and Group by event owner.
* View Event Details with Avaiable Event Slots 
* Authentication using secure password hasing 
*  Event Attendee Registration
* Event Managemanet (Create, View, Edit, Delete)
* Event Attendee Registration Report
* View all Users and Events from Admin Panel

## 🌐 Get a Look - [Ollyo Event Management 🔗](https://oem.watermarkbd.com/) 
* [View Demo 🔗](https://oem.watermarkbd.com/) 

## Credentials
### Admin
* Username: Admin
* Password: admin@123

### User
* Username: user, user2, user3, user4, user5
* Password: user@123

## Getting Started

### Installing

* Download or Clone  the Repository
```
https://github.com/so8uj/ollyo-event-management.git
```
* Upload the Ripository in your Server/Localhost
* Upload the datase.sql in your database
* Goto core/dabatase.php and change Database Credentials to your Database Credentials
```
core/dabatase.php
    $username = "your database username";
    $pass = "your database password";
    $db_name = "your database dabatase name";
```
* If dashboard sidemenu not Active then 
```
Goto includes/backend/header.php 
    $path = $path[1] // 1 for Live. 2 for local
```

#### Ready to Rock Now.

## API Documentation

### Endpoints

| Environment | Endpoint URL |
|------------|-------------|
| **Internal**  | `/api/fetch_data.php` |
| **Extranal**   | `https://oem.watermarkbd.com/api/fetch_data.php` |

### Request Details

| Method  | Description             |
|---------|-------------------------|
| `GET`   | Fetches data            |

### Request Parameters

| Parameter    | Type     | Required | Description                     |
|-------------|---------|----------|---------------------------------|
| `table_name` | String |  Yes   |   `events`                        |
| `request_for` | String  | Yes   | `all_data`           |
| `limit`     | Integer  |  Yes    | Number of results to return     |
| `paginate` | Boolean | Optional| `true` or `false` Enable pagination  |
| `page` | Integer | Optional| Pagination page number  |
| `search_field` | String | Optional  | Default: `null`, Enable Search with your expected field |
| `search_value` | String | Optional| Default: `null`, Search Value  |

## Author
#### Mohammad Sobuj 
* Email: [developersobuj@gmail.com](mailto:developersobuj@gmail.com)
* Linkedin: [https://www.linkedin.com/in/so8uj-/](https://www.linkedin.com/in/so8uj-/)

### Feel free to ask me anything!




