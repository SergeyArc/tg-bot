## Telegram Messaging Web Service

This is a web service that enables communication between a user of the service via a Telegram bot. The user can send messages to the bot, which are then saved by the web service. The user of the web service can respond to the messages.

## Requirements

- **Laravel** framework
- **Docker** and **Docker Compose** for running the service
- **Telegram Bot API** for integration with the Telegram bot
- **Composer** for dependency management

## Features

- Messages sent to the Telegram bot are forwarded and saved by the web service.
- The web service user can view and respond to these saved messages.
- The response will be sent back to the user via the Telegram bot.

## Installation

### 1. Clone the repository
Clone this repository to your local machine:

### 2. Run make init

```bash
make init
```

### 3. Set up environment variables

You need to configure the environment variables for your application.

**Edit the .env file:**:
   Open the .env file and set up the following:
- TELEGRAM_BOT_TOKEN=your-telegram-bot-token 

### 4. After changing the variables, restart the application
```bash
make restart
```

### 5. Access the application
You can access the application at http://localhost:8100/api

Default credentials:
admin@localhost.local
password
