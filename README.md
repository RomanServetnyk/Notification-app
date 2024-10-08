# Laravel Notification System

## Description

This project is a Laravel-based notification system that supports real-time notifications via email and asynchronous notifications via a queue system. Users can subscribe to various types of notifications, which are processed and sent based on user preferences. The entire application is containerized using Docker.

## Requirements

- Docker & Docker Compose
- PHP 8+
- Composer

## Features

- User subscriptions to different notification types.
- Real-time notifications using WebSockets (Laravel Echo + Pusher).
- Asynchronous email notifications using queues.
- Containerized setup using Docker.

## Installation

1. **Clone the repository:**

    ```bash
    git clone <repository-url>
    cd <repository-directory>
    ```

2. **Create `.env` file:**

    Copy the example environment file and modify according to your settings.

    ```bash
    cp .env.example .env
    ```

3. **Run Docker containers:**

    ```bash
    docker-compose up -d --build
    ```


4. **Set up Pusher and Mail:**

    Edit `.env` file to include your Pusher and Mail credentials.

    ```dotenv
    BROADCAST_DRIVER=pusher
    PUSHER_APP_ID=your-pusher-app-id
    PUSHER_APP_KEY=your-pusher-app-key
    PUSHER_APP_SECRET=your-pusher-app-secret
    PUSHER_APP_CLUSTER=mt1
    ```

    ```dotenv
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=465
    MAIL_USERNAME=your-mail-address
    MAIL_PASSWORD=your-mail-password
    MAIL_ENCRYPTION=ssl
    ```
5. **Test by Postman:**

## Usage
- **Register:**
  
  You can register with name and email by making a POST request to `/api/resiter`.

  ```json
  {
    "name": "username",
    "email": "example@gmail.com"
  }

- **Setting Notification Type:**
  
  You can set type of notification by making a POST request to `/api/notification-type`.

  ```json
  {
    "notification_type": "update" 
  }
    alert, new, update ...

- **Subscribe Notifications:**
  
  You can subscribe notification by making a POST request to `/api/subscribe-notifications`.

  ```json
  {
    "user_id": "1",
    "types": [1,3]
  }
- **Trigger Notifications:**
  
  You can trigger notifications by making a POST request to `/api/trigger-notification`.

  ```json
  {
    "type": 1,
    "message": "This is a test notification"
  }
    ```

Then all users will receive notifications via email and show real-time notifications on `https:\\localhost:8000`

